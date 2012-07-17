<?php
require 'includes/config.php';
require 'includes/functions.php';

// veri tabanına bağlan
connect_db();

if ($_POST['action'] == 'send_mail' && $_POST['email']) {
    $email = mysql_real_escape_string($_POST['email']);
    $query = mysql_query("SELECT id FROM users WHERE email = '$email'");

    if (mysql_num_rows($query) > 0) {
        $user_id  = mysql_result($query, 0);
        $password = substr(md5(rand()), 0, 6);
        $password_hash = sha1($password);
        $query = mysql_query("UPDATE users SET password = '$password_hash' WHERE id = '$user_id'");
    }
}

require 'views/layout/header.php';
require 'views/forgot.php';
require 'views/layout/footer.php';
