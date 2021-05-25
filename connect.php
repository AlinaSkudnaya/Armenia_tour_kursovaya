<?php
$connect = mysqli_connect('localhost', 'root', '', 'Booking_base');

if (!$connect) {
die('Error connect to DataBase');
}
