<?php
    require_once("vote_db.php");

    //Поиск по фразе (по содержанию заметки)
    $user_search = $_GET['search'];
    $where_list = array();
    $query_user_search = "SELECT * FROM question";
    $clean_search = str_replace(',', ' ', $user_search);
    $search_words = explode(' ', $clean_search);

    //Создаем еще один массив с окончательными результатами
    $final_search_words = array();

    //Проходим в цикле по каждому элементу массива $search_words.
    //Каждый непустой элемент добавляем в массив $final_search_words
    if (count($search_words) > 0)
        {
            foreach($search_words as $word)
                {
                    if(!empty($word))
                    {
                        $final_search_words[] = $word;
                    }
                }
        }

    //работа с использованием массива $final_search_words
    foreach ($final_search_words as $word)
    {
        $where_list[] = " text LIKE '%$word%'";
    }
    $where_clause = implode(' OR ', $where_list);
    if (!empty($where_clause))
    {
        $query_user_search .=" WHERE $where_clause";
    }
    $res_query = mysqli_query($link, $query_user_search);
?>
<html>
<head>
    <title>Search</title>
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php
        include('my_header.php');
    ?>
    <div class="row justify-content-center">
        <ul class="list-group question-list">
            <li class="h3 question-list-heading">Search results</li>
            <?php
                while ($array = mysqli_fetch_array($res_query))
                {
            ?>
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
