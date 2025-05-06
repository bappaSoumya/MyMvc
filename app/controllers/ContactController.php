<?php


class ContactController extends Controller {
    public function sendEmail() {
        $email = new Email();

        $to = 'recipient@example.com';
        $subject = 'Welcome to MyMvc Framework';
        $body = '<h1>Thank you for signing up!</h1><p>We are excited to have you on board.</p>';

        if ($email->send($to, $subject, $body)) {
            echo 'Email sent successfully!';
        } else {
            echo 'Failed to send email.';
        }
    }
}