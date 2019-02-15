<?php
    session_start();
    $login = 'guest';
    if(isset($_SESSION['login']))
    {
        $login = $_SESSION['login'];
    }
    require_once('vote_db.php');
    $basename = basename(__FILE__);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Voting</title>
        <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
        <link rel="stylesheet" href="./styles/styles.css?<?php echo time();?>" type="text/css" >
    </head>
    <body>
    <?php
        include("my_header.php");
    ?>
    <div class="welcome row justify-content-center">
        <h2 class="display-3">Welcome to the voting site!</h2>
        <h3 class="display-4">Here you can vote for a solution of an issue</h3>
    </div>
    <div class="logo row justify-content-center">
        <a href="list.php"><img src="images/tick.png" width="198" height="256" alt=""></a>
    </div>
    </body>
</html>
