<?php
    require_once("vote_db.php");
    $username = $_POST['username'];
    $email = $_POST['my_mail'];

    // search for errors
    $query_check = "SELECT * FROM user WHERE login = '$username'";
    $send_query_check = mysqli_query($link, $query_check);
    $count = mysqli_num_rows($send_query_check);
    if($username == 'guest')
    {
        echo "Forbidden username";
        header("refresh:1;url=signup.html");
    }
    else if($count > 0)
    {
        echo "The username already exists";
        header("refresh:1;url=signup.html");
    }
    else if(!strpos($email,'@'))
    {
        echo "Incorrect email";
        header("refresh:1;url=signup.html");
    }
    else
    {
        $password = $_POST['pass'];
        $birth_date = $_POST['birthday'];
        $birth_date = explode("/", $birth_date);
        $birth_date = date("Y-m-d", mktime(0,0,0,$birth_date[1],$birth_date[0],$birth_date[2]));
        $gender = $_POST['gender'];
        if($gender == "Male")
        {
            $gender = 'm';
        }
        else
        {
            $gender = 'f';
        }
        $country = $_POST['country'];
        $region = $_POST['region'];
        $rights = $_POST['rights'];

        $query = "INSERT INTO user(id, login, password, rights, birthdate, gender, country, region, email) VALUES (NULL, '$username', '$password', '$rights', '$birth_date', '$gender', '$country', '$region', '$email' )";
        $result = mysqli_query($link, $query);
        if ($result) {
            header("refresh:1;url=default.php");
            echo "You are successfully registered";
        }
        else
        {
            header("refresh:1;url=default.php");
            echo "Failed to register";
        }

    }



