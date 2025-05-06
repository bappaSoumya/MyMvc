<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Email {
    protected $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);

        // SMTP configuration
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.example.com'; // Replace with your SMTP host
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'your_email@example.com'; // Replace with your email
        $this->mailer->Password = 'your_password'; // Replace with your email password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587; // Typically 587 for TLS
    }

    public function send($to, $subject, $body, $from = 'your_email@example.com', $fromName = 'MyMvc Framework') {
        try {
            // Set sender details
            $this->mailer->setFrom($from, $fromName);

            // Add recipient
            $this->mailer->addAddress($to);

            // Email subject and body
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->isHTML(true); // Set email format to HTML

            // Send the email
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            // Log the error or handle it as needed
            error_log('Email error: ' . $this->mailer->ErrorInfo);
            return false;
        }
    }
}