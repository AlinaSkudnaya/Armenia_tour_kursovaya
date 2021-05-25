<?php

    $connect = mysqli_connect('localhost', 'root', 'root', 'booking');

    if (!$connect) {
        die('Error connect to DataBase');
    }