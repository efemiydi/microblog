<?php
require 'includes/config.php';
require 'includes/functions.php';

// veri tabanına bağlan
connect_db();

if ($_POST['action'] == 'login') {
    if (!$_POST['username'] || !$_POST['password'])
        $errors[] = 'Kullanıcı adı ve parolanızı girmeniz gerekmektedir.';
    else {
        $username = mysql_real_escape_string($_POST['username']);
        $password = sha1($_POST['password']);
        
        $query = mysql_query("SELECT * FROM users WHERE
            username = '$username'
            AND password = '$password'
            ") or die(mysql_error());
        
        if (mysql_num_rows($query) > 0) {
            $user_info = mysql_fetch_assoc($query);
            
            $_SESSION['user_id'] = $user_info['id'];
            $_SESSION['name']    = $user_info['name'];
            $_SESSION['surname'] = $user_info['surname'];
            
            header("Location: " . DOC_ROOT . "/index.php");
            exit;
        } else {
            $errors[] = 'Kullanıcı adı veya parolanız geçersiz.';
        }
    }
}

require 'views/layout/header.php';
require 'views/login.php';
require 'views/layout/footer.php';