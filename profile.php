<?php
require 'includes/config.php';
require 'includes/functions.php';

// veri tabanına bağlan
connect_db();

if ($_POST['action'] == 'update_user') { // güncelleme formu postlanmışsa
    if (!$_POST['name'] || !$_POST['surname']) { // isim ve soyisim girilmemişse
        $errors[] = 'Adınızı ve soyadınızı girmeniz gerekiyor.';
    }

    if (!$_POST['email']) { // email girilmemişse
        $errors[] = 'E-mail adresinizi girmediniz.';
    } else if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) { // email girilmişse, uygun bir email değilse
        $errors[] = 'Lütfen geçerli bir e-mail adresi giriniz.';
    } else { // email düzgün ise aynı email adresine sahip başka bir kullanıcı mevcut mu?
        $email = mysql_real_escape_string($_POST['email']);
        $email = trim($email);
        $query = mysql_query("SELECT 1 FROM users WHERE email = '" . $email . "' AND id != '{$_SESSION['user_id']}'") or die(mysql_error());

        if (mysql_num_rows($query) > 0) {
            $errors[] = 'Bu e-mail adresine sahip bir kullanıcı zaten var.';
        }
    }
    
    $add_sql = ""; // register_globals aciksa SQL injection olabilir.

    if ($_POST['password']) {
        if ($_POST['password'] != $_POST['password_confirm']) { // parola girilmişse ve confirm alanı ile aynı ise...
            $errors[] = 'Girdiğiniz iki parola birbirinden farklı.';
        } else if (!preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})$/", $_POST['password'])) {
            $errors[] = 'Parolanız 6-20 karakter aralığında olmalıdır. Minimum 1 küçük, 1 büyük harf ve 1 rakam içermelidir. @#$% özel karakterlerinden birisini içermelidir.';
        } else {
            $password = sha1($_POST['password']); // parola sha1 algoritması ile hashleniyor
            $add_sql = ", password = '$password'";
        }
    }
    
    if (empty($errors)) { // bütün alanlar kontrol edildiyse ($errors dizisi boş ise)
        // kullanıcıdan gelen veriler filtreleniyor
        $name     = mysql_real_escape_string($_POST['name']);
        $surname  = mysql_real_escape_string($_POST['surname']);
        $email    = mysql_real_escape_string($_POST['email']);
        
        // kayıt güncelleniyor
        $query = mysql_query("UPDATE users SET
            name    = '$name',
            surname = '$surname',
            email   = '$email'
            $add_sql
            WHERE id = '{$_SESSION['user_id']}'
            ") or die(mysql_error());
        
        $_SESSION['name']    = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['email']   = $email;
        
        if (is_uploaded_file($_FILES['profile_image']['tmp_name'])) {
            switch($_FILES['profile_image']['type']) {
                case 'image/jpeg':
                case 'image/pjpeg':
                case 'image/png':
                case 'image/gif':
                    $upload_dir = 'public/uploads/';
                    $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
                    $extension = strtolower($extension);
                    move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_dir . $_SESSION['user_id'] . '.' . $extension);
                    
                    require_once 'includes/phpthumb/ThumbLib.inc.php';

                    $thumb = PhpThumbFactory::create($upload_dir . $_SESSION['user_id'] . '.' . $extension);
                    $thumb->resize(640, 480);
                    $thumb->save($upload_dir . $_SESSION['user_id'] . '.jpg', 'jpg');
                    $thumb->adaptiveResize(34, 33);
                    $thumb->drawBorder(0, 2);
                    $thumb->save($upload_dir . $_SESSION['user_id'] . '_t.jpg', 'jpg');
                    break;
            }
        }
        
        // register_complete.php adresine yönlendirilme yapılıyor
        header("Location: " . DOC_ROOT . "/index.php");
        exit;
    }
}

$query     = mysql_query("SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'");
$user_info = mysql_fetch_assoc($query);

require 'views/layout/header.php';
require 'views/profile.php';
require 'views/layout/footer.php';
