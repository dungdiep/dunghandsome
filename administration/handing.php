<?php
require_once "define.php";

function getData($sql)
{
    $conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
    $data = [];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $data[] = $row;
    }
    mysqli_close($conn);
    return $data;
}