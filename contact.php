<html>
    <head>
        <title>Contact us</title>
        <link rel="stylesheet" href="styles/contact.css">
    </head>
    <body style="overflow-x: hidden;">
        <div class="card">
            <form action="contact.php" method="post">
                <h1>Share Your Feedback With Us</h1>
                <hr>
                <ul class="form-section">
                    <li>
                        <label>
                            First name <span class="form-required">*</span><br>
                            <input type="text" name="first_name">
                        </label>
                    </li>
                    <li>
                        <label>
                            Last name <span class="form-required">*</span><br>
                            <input type="text" name="last_name">
                        </label>
                    </li>
                    <li>
                        <label>
                            Your email <span class="form-required">*</span><br>
                            <input type="email" name="your_email">
                        </label>
                    </li>
                    <li>
                        <label>
                            Subject <span class="form-required">*</span><br>
                            <input type="text" name="subject">
                        </label>
                    </li>
                    <li>
                        <label>
                            Your feedback <span class="form-required">*</span><br>
                            <textarea name="content" id="id_content" cols="40" rows="6" required></textarea>
                        </label>
                    </li>
                    <li>
                        <button type="submit" class="form-submit-button" data-component="button">
                            Submit
                        </button>
                        <a href="default.php">Back to home page</a>
                    </li>
                </ul>
            </form>
        </div>
    <?php
        if(isset($_POST['subject']) and isset($_POST['content']))
        {
            // принимаем данные из массива
            $subject = $_POST['subject'];
            $content = $_POST['content'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['your_email'];
            // преобразуем специальные символы
            $subject = htmlspecialchars($subject);
            $content = htmlspecialchars($content);
            // декодируем url
            $subject = urldecode($subject);
            $content = urldecode($content);
            // удаляем пробелы с начала и конца строки
            $subject = trim($subject);
            $content = trim($content);
            $header = 'MIME-Version: 1.0' . "\n" . 'Content-type: text/plain; charset=UTF-8';
            if (mail("example@mail.ru", $subject, $content, $header . "\n" . "From: example2@mail.ru \r\n $first_name $last_name")) {
                echo "<script> alert('Сообщение успешно отправлено'); window.location.href = 'default.php'</script>";
            } else {
                echo "<script> alert('Сообщение не отправлено'); window.location.href = 'default.php'</script>";
            }
        }
    ?>
    </body>
</html>