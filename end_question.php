<?php
    require_once('vote_db.php');
    $question_id = $_GET['question'];
    $query = "UPDATE question SET solved = 1 WHERE id = $question_id";
    $query_result = mysqli_query($link, $query);
    if($query_result)
    {
        echo '<script>alert("Ended successfully"); window.location.href = "account_panel.php"</script>';
    }
    else
    {
        echo '<script>alert("Not ended"); window.location.href = "account_panel.php"</script>';
    }