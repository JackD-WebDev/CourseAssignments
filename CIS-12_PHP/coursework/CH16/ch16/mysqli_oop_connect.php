<?php
// Jack Daly 🥷
// CSC 12-43560
// Updated 06/03/22

const DB_USER = 'root';
const DB_PASSWORD = 'secret';
const DB_HOST = 'mysql';
const DB_NAME = 'sitename';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if($mysqli->connect_error) {
    echo $mysqli->connect_error;
    unset($mysqli);
} else {
    $mysqli->set_charset('utf8');
}