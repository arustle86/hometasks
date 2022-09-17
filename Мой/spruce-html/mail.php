<?php
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);        
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // Note:  Update this to your desired email address.
        $recipient = "a.tsurkanu@gmail.com";

        // Set the email subject.
        $subjectname = "Новое сообщение $name";

        // Build the email content.
        $email_content = "Имя: $name  \r\n\n";
        $email_content .= "Адрес: $email \r\n\n";
        $email_content .= "Сообщение: $message \r\n\n";

        // Build the email headers.
        $email_headers = "От: $name <$email>";

        // Send the email.
        if (mail($recipient, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Спасибо! Ваше сообщение отправлено";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Упс! Что - то пошло не так";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Ошибка, попробуйте еще раз";
    }

?>