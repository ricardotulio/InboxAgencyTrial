<?php

namespace InboxAgency\Purchase\Service;

use Slim\Views\Twig;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use InboxAgency\Purchase\Entity\Purchase as PurchaseEntity;

class Purchase
{
    private $qeueConnection;

    private $view;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        AMQPStreamConnection $qeueConnection,
        Twig $view
    ) {
        $this->qeueConnection = $qeueConnection;
        $this->view = $view;
    }

    public function sendPurchaseEmail(PurchaseEntity $purchase)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = getenv('SMTP_HOST');
            $mail->SMTPAuth = getenv('SMTP_AUTH');
            $mail->Username = getenv('SMTP_USER');
            $mail->Password = getenv('SMTP_PASS');
            $mail->SMTPSecure = getenv('SMTP_SECURE');
            $mail->Port = getenv('SMTP_PORT');

            $mail->setFrom(getenv('SMTP_FROM'), 'Mailer');
            $mail->addAddress($purchase->getUser()->getEmail(), 'Joe User');

            $mail->isHTML(true);
            $mail->Subject = 'Sua compra na loja InboxAgency';
            $mail->Body = $this->view->getEnvironment()
                ->render('mail/purchase.html', [
                    'purchase' => $purchase
                ]);

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public function finishPurchase(PurchaseEntity $purchase)
    {
        $channel = $this->qeueConnection->channel();
        $channel->queue_declare('hello', false, false, false, false);

        $data = serialize($purchase);

        $msg = new AMQPMessage(
            $data,
            [
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
            ]
        );

        $channel->basic_publish($msg, '', 'mail_queue');
    }

    public function runMailWorker()
    {
        $channel = $this->qeueConnection->channel();
        $channel->queue_declare('mail_queue', false, false, false, false);

        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            echo " [x] Received ", $msg->body, "\n";

            $purchase = unserialize($msg->body);
            $this->sendPurchaseEmail($purchase);

            echo " [x] Done", "\n";
        };

        $channel->basic_qos(null, 1, null);
        $channel->basic_consume(
            'mail_queue',
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}
