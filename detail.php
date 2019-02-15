<?php
    ob_start();
    session_start();
    $login = 'guest';
    if(isset($_SESSION['id_login']) && isset($_SESSION['login']))
    {
        $id_login = $_SESSION['id_login'];
        $login = $_SESSION['login'];
    }
    require_once('vote_db.php');
    $id_question = $_GET['question'];

    $query_check = "SELECT * FROM userquestion WHERE id_user = '$id_login' AND id_question = '$id_question'";
    $send_query_check = mysqli_query($link, $query_check);
    $count = mysqli_num_rows($send_query_check);
    if($count > 0)
    {
        header("Location: results.php?question=$id_question");
    }
    else
    {
        // Query to question
        $query_question = "SELECT * FROM question WHERE id = '$id_question'";
        $result_question = mysqli_query($link, $query_question);
        $question_array = mysqli_fetch_array($result_question);

        // Query to choice
        $query_choice = "SELECT * FROM choice WHERE question_id = '$id_question'";
        $result_choice = mysqli_query($link, $query_choice);
?>
<html>
<head>
    <title>Voting</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/styles.css?<?php echo time();?>" type="text/css" >
</head>
<body>
<?php
include('my_header.php');
?>
<div class="row justify-content-center">
    <div class="choice-content">
        <form action="detail.php?question=<?php echo $id_question ?>" method="post">
            <div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">
                <li class="h3 question-list-heading"><?php echo $question_array['text']?></li>
                <?php
                    while($choice_array = mysqli_fetch_array($result_choice))
                    {
                        ?>
                        <label class="btn btn-secondary choice-element">
                            <input type="radio" name="choice" autocomplete="off" value="<?php echo $choice_array['id']?>"> <?php echo $choice_array['text']?>
                        </label>
                <?php
                    }
                ?>
            </div>
            <div class="row justify-content-center vote-submit">
                <input class="btn btn-primary" type="submit" name="submit" value="Vote">
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php
    if(isset($_POST['choice']))
    {
        if($login != 'guest')
        {
            $id_choice = $_POST['choice'];

            $query_choice_select = "SELECT choice.count FROM choice WHERE id = $id_choice";
            $send_query_choice_select = mysqli_query($link, $query_choice_select);
            $choice_select_array = mysqli_fetch_array($send_query_choice_select);
            $i = $choice_select_array['count'];
            $i++;

            $query_choice_update = "UPDATE choice SET choice.count = $i WHERE id = $id_choice";
            $send_query_choice_update = mysqli_query($link, $query_choice_update);

            $query_userquestion = "INSERT INTO userquestion(id_user, id_question) VALUES ($id_login, $id_question)";
            $send_query_userquestion = mysqli_query($link, $query_userquestion);

            $query_userchoice = "INSERT INTO userchoice(id_user, id_choice) VALUES ($id_login, $id_choice)";
            $send_query_userchoice = mysqli_query($link, $query_userchoice);

            header("Location: results.php?question=$id_question");

        }
        else
        {
            header("Location: login.html");
        }
    }
?>
</body>
</html>
<?php } ?>