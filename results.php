<?php
    require_once('vote_db.php');
    $question_id = $_GET['question'];

    $query_question = "SELECT * FROM question WHERE id = $question_id";
    $send_query_question = mysqli_query($link, $query_question);
    $question_array = mysqli_fetch_array($send_query_question);

    $query_choice = "SELECT * FROM choice WHERE question_id = $question_id";
    $send_query_choice = mysqli_query($link, $query_choice);
    $i = 0;
    $total = 0;
    $choice_info_array = array();
    while($choice_array = mysqli_fetch_array($send_query_choice))
    {
        $total += $choice_array['count'];
        $choice_info_array[$i] = array($choice_array['text'], $choice_array['count']);
        $i++;
    }
    $choice_info_array = array_reverse($choice_info_array);
    if($total != 0)
    {
        for ($j = 0; $j < count($choice_info_array); $j++) {
            $choice_info_array[$j][1] = ($choice_info_array[$j][1] / $total) * 100;
        }
    }



?>
<html>
<head>
    <link rel="stylesheet" href="styles/results.css?<?php echo time();?>" type="text/css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,

                title:{
                    text:"<?php echo $question_array['text'] ?>"
                },
                axisX:{
                    interval: 1
                },
                axisY2:{
                    interlacedColor: "rgba(1,77,101,.2)",
                    gridColor: "rgba(1,77,101,.1)",
                    suffix: "%",
                    title: "Total votes: <?php echo $total;?>"
                },
                data: [{
                    type: "bar",
                    name: "votes",
                    axisYType: "secondary",
                    yValueFormatString: "#,##0\"%\"",
                    color: "#014D65",
                    dataPoints: [
                        <?php
                            for($j = 0; $j < count($choice_info_array); $j++)
                        {
                        ?>
                        {y: <?php echo $choice_info_array[$j][1]?>, label: "<?php echo $choice_info_array[$j][0]?>"},
                        <?php
                        }
                        ?>
                    ]
                }]
            });
            chart.render();

        }
    </script>
</head>
<body class="results">
    <h1 class="display-4" style="margin-bottom: 20px;">Voting results</h1>
    <div id="chartContainer" style="height: 370px; width: 90%;"></div>
    <div class="wrapper">
        <?php if(isset($_GET['back']))
        { ?>
        <a class="second after" href="account_panel.php">Back to account panel</a>
        <?php } else { ?>
        <a class="second after" href="list.php">Back to question list</a>
        <?php } ?>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>