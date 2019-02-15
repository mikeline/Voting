<?php
    require_once('vote_db.php');
    $login = $_POST['user'];
    $password = $_POST['pass'];
    if(isset($login) && isset($password))
    {
        $query = "SELECT * FROM user WHERE login = '$login' AND password = '$password'";
        $send_query = mysqli_query($link, $query);
        $user_array = mysqli_fetch_array($send_query);
        $id_login = $user_array['id'];
        $login = $user_array['login'];
        $rights = $user_array['rights'];
        $email = $user_array['email'];
        $count = mysqli_num_rows($send_query);
        if ($count > 0)
        {
            session_start();
            $_SESSION['id_login'] = $id_login;
            $_SESSION['login'] = $login;
            $_SESSION['rights'] = $rights;
            $_SESSION['email'] = $email;
            header( "refresh:1;url = default.php" );
        }
        else
        {
            echo "<script type='text/javascript'>alert('Неправильное имя пользователя или пароль'); window.location.href = 'login.html'</script>";

        }
    }
