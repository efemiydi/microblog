<?php
require 'includes/config.php';
require 'includes/functions.php';

connect_db();

$message_id = (int) $_GET['message_id'];

if ($message_id > 0) {
    $query = mysql_query("DELETE FROM messages WHERE id = '$message_id' AND user_id = '{$_SESSION['user_id']}'") or die(mysql_error());
}

header("Location: " . DOC_ROOT . "/index.php");

