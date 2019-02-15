<?php
    session_start();
    $login = 'guest';
    if(isset($_SESSION['login']))
    {
        $login = $_SESSION['login'];
    }
    require_once('vote_db.php');
    $basename = basename(__FILE__);
    $query = "SELECT * FROM question ORDER BY created DESC";
    $result = mysqli_query($link, $query);
?>
<html>
<head>
    <title>Voting</title>
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/styles.css?<?php echo time();?>" type="text/css">
</head>
    <body>
        <?php
            include('my_header.php');
        ?>

        <div class="row justify-content-center">
            <ul class="list-group question-list">
                <li class="h3 question-list-heading">Questions</li>
            <?php
            while($array = mysqli_fetch_array($result))
            {?>
                <?php
                    if(!$array['solved'])
                    {
                ?>
                <li class="list-group-item list-group-item-action">
                    <?php
                    if($login != 'guest')
                    {
                        ?>
                    <a href="detail.php?question=<?php echo $array['id']?>"><?php echo $array['text']?></a>
                    <?php }
                        else { ?>
                    <a href="results.php?question=<?php echo $array['id']?>"><?php echo $array['text']?></a>
                    <?php } ?>
                </li>
                        <?php }
                        else { ?>
                <li class="list-group-item list-group-item-action" style="background: #5cb85c">
                    <a style="color: white" href="results.php?question=<?php echo $array['id']?>"><?php echo $array['text']?></a>
                </li>
                <?php } ?>
            <?php } ?>
            </ul>
        </div>
    </body>
</html>