<?php
    session_start();
    if(isset($_SESSION['id_login']))
    {
        $id_login = $_SESSION['id_login'];
    }
    else
    {
        header('Location: default.php');
    }
    require_once('vote_db.php');
    ?>
<html>
    <head>
        <link rel="stylesheet" href="styles/add_question.css">
        <script>
            function addChoice() {
                let container = document.getElementById("more-options");
                let newLabel = document.createElement('label');
                let option = 'Option: <br>\n' +
                    '<textarea name="choice[]" cols="30" rows="10" required></textarea><br>';
                newLabel.innerHTML += option;
                container.appendChild(newLabel);
            }
        </script>
    </head>
    <body>
        <form action="add_question.php" method="post">
            <label>
                Question text: <br>
                <textarea name="issue" cols="30" rows="5" required></textarea>
            </label><br>
            <label>
                Option: <br>
                <textarea name="choice[]" cols="30" rows="10" required></textarea><br>
            </label><br>
            <label>
                Option: <br>
                <textarea name="choice[]" cols="30" rows="10" required></textarea><br>
            </label><br>
            <div id="more-options"></div>
            <button onclick="addChoice()">Add option</button>
            <input type="submit" name="submit" value="Submit">
        </form>
        <a href="account_panel.php">Back to account panel</a>
        <?php
            if(isset($_POST['issue']) and isset($_POST['choice']))
            {
                $question_text = $_POST['issue'];
                $choice_array = $_POST['choice'];
                $date = $_POST['created'];

                $query_question = "INSERT INTO question(id, text, created, solved, user_id) VALUES (NULL, '$question_text', now(), 0, $id_login)";
                $question_result = mysqli_query($link, $query_question);

                $query_question_again = "SELECT id FROM question WHERE text LIKE '$question_text' AND user_id = $id_login";
                $question_again_result = mysqli_query($link, $query_question_again);
                $question_id = mysqli_fetch_array($question_again_result);
                $question_id = $question_id['id'];

                for($i = 0; $i < count($choice_array); $i++)
                {
                    $choice = $choice_array[$i];
                    $query_choice = "INSERT INTO choice(id, text, count, question_id) VALUES (NULL, '$choice', 0, $question_id)";
                    $choice_result = mysqli_query($link, $query_choice);
                }
                if($question_result && $choice_result)
                {
                    echo '<script>alert("Question is successfully added"); window.location.href = "account_panel.php"</script>';
                }
                else
                {
                    echo '<script>alert("Something went wrong"); window.location.href = "account_panel.php"</script>';
                }
            }

        ?>
    </body>
</html>
