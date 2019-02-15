<?php
$link = mysqli_connect("localhost", "root", "");
$query = "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' IDENTIFIED BY 'admin' WITH GRANT OPTION";
$create_user = mysqli_query($link, $query);
if ($create_user) {
    echo "Пользователь создан";
}
else {
    echo "Пользователь не создан";
}