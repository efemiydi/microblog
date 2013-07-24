<?php
require 'includes/config.php';
require 'includes/functions.php';

connect_db();

if ($_GET['action'] == 'logout') { // çıkış yap linkine tıklanmışsa
    session_destroy();
    header("Location: " . DOC_ROOT . "/index.php");
    exit;
}

if ($_SESSION['user_id'] > 0) { // kullanıcı girişi yapılmışsa
    if ($_POST['action'] == 'save_message' && $_POST['message']) {
        $message = mysql_real_escape_string($_POST['message']);
        $message = htmlspecialchars($message);
        
        $query = mysql_query("INSERT INTO messages
             (user_id, message, created_at)
             VALUES
             ('{$_SESSION['user_id']}', '$message', NOW())
             ") or die(mysql_error());
    }
}

$query = mysql_query("SELECT * FROM messages ORDER BY created_at DESC") or die(mysql_error());

while ($info = mysql_fetch_assoc($query)) {
    $messages[] = $info;
}

require 'views/layout/header.php';
require 'views/index.php';
require 'views/layout/footer.php';
