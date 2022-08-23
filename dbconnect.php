<?php

$connect = mysqli_connect('localhost', 'root', 'root', 'test');

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
