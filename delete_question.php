<?php
    require_once('vote_db.php');
    $question_id = $_GET['question'];
    $query = "DELETE FROM question WHERE id = $question_id";
    $query_result = mysqli_query($link, $query);
    if($query_result)
    {
        echo '<script>alert("Deleted successfully"); window.location.href = "account_panel.php"</script>';
    }
    else
    {
        echo '<script>alert("Not deleted"); window.location.href = "account_panel.php"</script>';
    }