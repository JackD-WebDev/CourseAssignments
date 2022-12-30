<?php
const DB_USER = 'root';
const DB_PASSWORD = 'secret';
const DB_HOST = 'mysql';
const DB_NAME = 'sitename';

$dbc = @mysqli_connect(
    DB_HOST,
    DB_USER,
    DB_PASSWORD,
    DB_NAME
) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

mysqli_set_charset($dbc, 'utf8');
