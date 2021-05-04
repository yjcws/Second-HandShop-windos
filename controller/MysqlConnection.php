<?php
include $_SERVER['DOCUMENT_ROOT']."/controller/db.php";
$config = include  $_SERVER['DOCUMENT_ROOT']."/config/database.php";
$Mysql = new db($config['mysql']['host'],$config['mysql']["user"],$config['mysql']['password'],$config['mysql']['dbname']);