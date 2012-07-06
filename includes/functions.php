<?php

/*
 * Veri tabanına bağlanmak için
 */
function connect_db() {
    $db = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
    $connect = mysql_select_db(DB_NAME, $db) or die(mysql_error());
    mysql_query("SET NAMES utf8");
}

/*
 * parametre olarak aldığı id'ye ait kullanıcı adını döndürür
 */
function get_username($user_id) {
    $query = mysql_query("SELECT username FROM users WHERE id = '$user_id'");
    return mysql_result($query, 0);
}