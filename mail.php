<?php

require __DIR__ . '/vendor/autoload.php';   

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class Mail {
    public $mail = null;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = 2;         
        $this->mail->isSMTP();                                            
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;   
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = 587;   
        $this->mail->isHTML(true);  
    }

    public function sender($username, $password) {
        $this->mail->Username   = $username;      
        $this->mail->Password   = $password;               
                                    
        // Recipients
        $this->mail->setFrom($username);   
    }

    public function reciever($username) {
        $this->mail->addAddress($username); 
    }

    public function borrow_mail($user, $borrowDetail) {
        $this->mail->Subject = 'Borrowing Confirmation and Return Date';
        $this->mail->Body    = 
        "
        <html>
        <body>
            <p>Dear " . $user['full_name'] . " ,</p>
            <p>We are pleased to inform you that your borrowing request for the following item has been successfully processed:</p>
            <ul>
                <li><strong>Book Title:</strong> " . $borrowDetail['title'] . "</li>
                <li><strong>Borrow Date:</strong> " . $borrowDetail['BDate'] . "</li>
                <li><strong>Return Date:</strong> " . $borrowDetail['RDate'] . "</li>
            </ul>
            <p>Please ensure that the book is returned on or before the return date to avoid any late fees.</p>
            <p>If you have any questions or need further assistance, feel free to contact us at <a href='mailto:libraryContact'>libraryContact</a>.</p>
            <p>Thank you for using our library services!</p>
            <p>Best regards,<br>Library Management System</p>
        </body>
        </html>
        ";
    }

    public function send() {
        try {
            ob_start(); 
            $this->mail->send();
            echo 'Message has been sent';
            ob_end_clean();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function return_mail($user, $borrowDetail) {
        $this->mail->Subject = "Book Return Confirmation";
        $this->mail->Body    = "
        <html>
        <body>
            <p>Dear " . $user['full_name'] . " ,</p>
            <p>We are pleased to inform you that your return of the following item has been successfully processed:</p>
            <ul>
                <li><strong>Book Title:</strong> " . $borrowDetail['title'] . " </li>
                <li><strong>Return Date:</strong> " . $borrowDetail['RDate'] . " </li>
            </ul>
            <p>Thank you for returning the book on time. If you have any further inquiries or need assistance, please do not hesitate to contact us at <a href='mailto:libraryContact'>libraryContact</a>.</p>
            <p>We hope to see you again soon!</p>
            <p>Best regards,<br>Library Management System</p>
        </body>
        </html>
        ";
    }

    public function set_email($subject, $body) {
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
    }
}

















// try {
    
//     $this->mail->AltBody = 
//     " Dear $borrowerName,\n\n"
//         . "We are pleased to inform you that your borrowing request for the following item has been successfully processed:\n\n"
//         . "Book Title: $bookTitle\n"
//         . "Borrow Date: $borrowDate\n"
//         . "Return Date: $returnDate\n\n"
//         . "Please ensure that the book is returned on or before the return date to avoid any late fees.\n\n"
//         . "If you have any questions or need further assistance, feel free to contact us at $libraryContact.\n\n"
//         . "Thank you for using our library services!\n\n"
//         . "Best regards,\n"
//         . "Library Management System";

//     // $this->mail->send();
//     // echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
// }
