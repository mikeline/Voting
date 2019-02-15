<?php
    $localhost = "localhost";
    $db = "VoteDB";
    $user = "admin";
    $password = "admin";

    $link = mysqli_connect($localhost, $user, $password) or trigger_error("Error", E_USER_ERROR);

    // trigger_error выводит на страницу сообщение об ошибке.
    // Первый параметр - сообщение об ошибке
    // в строковом виде, в данном случае возвращается функция mysql_error(), второй - числовой код
    // ошибки(почти всегда используется значение константы E_USER_ERROR, равное 256)

    // Следующие строки необходимы для того, чтобы MySQL воспринимал кириллицу.
    //Параметры функции mysqli_query(): идентификатор соединения с сервером и запрос SQL

    mysqli_query($link, "SET NAMES utf8;") or die();
    mysqli_query($link, "SET CHARACTER SET utf8;") or die();

    //Выбор базы данных на сервере localhost mysqli_select_db($link, $db);
    mysqli_select_db($link, $db);