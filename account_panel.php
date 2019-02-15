<?php
    session_start();
    if($_SESSION['id_login'])
    {
        $id_login = $_SESSION['id_login'];
    }
    require_once("vote_db.php");
    $query = "SELECT * FROM user WHERE id = $id_login";
    $result = mysqli_query($link, $query);
    $user_array = mysqli_fetch_array($result);
?>
<html>
    <head>
        <link rel="stylesheet" href="styles/account_panel.css?<?php echo time();?>">
        <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    </head>
    <body>
        <div class="panel">
            <div class="user-info row justify-content-center">

                <ul>
                    <li><h5>Account info</h5></li>
                    <li><p>Username: <span class="user-data"><?php echo $user_array['login']?></span></p></li>
                    <li><p>Email: <span class="user-data"><?php echo $user_array['email']?></span></p></li>
                    <li><p>Birthdate: <span class="user-data"><?php echo $user_array['birthdate']?></span></p></li>
                    <li><p>Gender: <span class="user-data"><?php echo $user_array['gender']?></span></p></li>
                    <li><p>Country: <span class="user-data"><?php echo $user_array['country']?></span></p></li>
                    <li><p>Region: <span class="user-data"><?php echo $user_array['region']?></span></p></li>
                </ul>
            </div>
            <div class="divide"></div>
            <div class="votes row justify-content-center">
                <ul class="choice-list">
                    <li><h5>Your votes</h5></li>
                    <?php
                        $choice_query = "SELECT question.text AS q, question.id AS q_id, choice.text AS ch FROM userchoice INNER JOIN choice ON choice.id = userchoice.id_choice INNER JOIN question ON question.id = choice.question_id WHERE id_user = $id_login";
                        $choice_result = mysqli_query($link, $choice_query) or trigger_error(mysqli_error() . " in " . $choice_query);
                        while($choice_array = mysqli_fetch_array($choice_result))
                        {
                            $q = $choice_array['q'];
                            $q_id = $choice_array['q_id'];
                            $ch = $choice_array['ch'];
                    ?>
                    <li><a href="results.php?question=<?php echo $q_id; ?>&back=1"><?php echo $q; ?></a><?php echo " - " . "$ch"?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="divide"></div>
            <?php
                if($user_array['rights'] == 'a')
                {
                    $question_query = "SELECT * FROM question WHERE user_id = $id_login";
                    $question_result = mysqli_query($link, $question_query);
            ?>
            <div class="questions row justify-content-center">
                <ul class="question-list">
                    <li><h5>Your questions</h5></li>
                    <?php
                    while($question_array = mysqli_fetch_array($question_result))
                    {
                        ?>
                    <li class="question-element">
                        <p><a href="results.php?question=<?php echo $question_array['id']?>&back=1"><?php echo $question_array['text']?></a></p>
                        <p>Start date: <span class="user-data"><?php echo $question_array['created']?></span></p>
                        <?php
                            if(!$question_array['solved'])
                            {
                                ?>
                                <a id="endQuestion" href="end_question.php?question=<?php echo $question_array['id']?>">End question</a>
                        <?php
                            }
                            else
                            {
                                ?>
                                <p><span class="user-data">Solved</span> <span><a id="delete" href="delete_question.php?question=<?php echo $question_array['id']?>">Delete</a></span></p>
                        <?php
                            }
                        ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="add-question row justify-content-center">
                <a href="add_question.php">Add question</a>
            </div>
            <?php } ?>
            <div class="row justify-content-center">
                <a href="default.php">Back to home page</a>
            </div>
        </div>
    </body>
</html>