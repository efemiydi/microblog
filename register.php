<?php
/*
 * http://www.mkyong.com/regular-expressions/how-to-validate-password-with-regular-expression/
Password Regular Expression Pattern
((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})

Description
(			# Start of group
  (?=.*\d)		#   must contains one digit from 0-9
  (?=.*[a-z])		#   must contains one lowercase characters
  (?=.*[A-Z])		#   must contains one uppercase characters
  (?=.*[@#$%])		#   must contains one special symbols in the list "@#$%"
              .		#     match anything with previous condition checking
                {6,20}	#        length at least 6 characters and maximum of 20	
)			# End of group
 */
echo $degisken;
require 'includes/config.php';
require 'includes/functions.php';

require 'includes/captcha/simple-php-captcha.php';

// veri tabanına bağlan
connect_db();

if ($_POST['action'] == 'save_user') { // kayıt formu postlanmışsa
    if (!$_POST['m_captcha'] || $_POST['m_captcha'] != $_SESSION['my_captcha']['code'])
        $errors[] = 'Güvenlik kodunuzu yanlış girdiniz';
    if (!$_POST['name'] || !$_POST['surname']) // isim ve soyisim girilmemişse
        $errors[] = 'Adınızı ve soyadınızı girmeniz gerekiyor.';
    if (!$_POST['email']) // email girilmemişse
        $errors[] = 'E-mail adresinizi girmediniz.';
    else if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) // email girilmişse, uygun bir email değilse
        $errors[] = 'Lütfen geçerli bir e-mail adresi giriniz.';
    else { // email düzgün ise aynı email adresine sahip başka bir kullanıcı mevcut mu?
        $email = mysql_real_escape_string($_POST['email']);
        $email = trim($email);
        $query = mysql_query("SELECT 1 FROM users WHERE email = '" . $email . "'");
        if (mysql_num_rows($query) > 0)
            $errors[] = 'Bu e-mail adresine sahip bir kullanıcı zaten var.';
    }
    if (!$_POST['username']) // kullanıcı adı girilmemişse
        $errors[] = 'Kullanıcı adınızı girmediniz.';
    else { // kullanıcı adı girilmişse aynı kullanıcı adına sahip başka bir kullanıcı var mı kontrol ediliyor
        $username = mysql_real_escape_string($_POST['username']);
        $username = trim($username);
        $query = mysql_query("SELECT 1 FROM users WHERE username = '" . $username . "'");
        if (mysql_num_rows($query) > 0)
            $errors[] = 'Bu kullanıcı adına sahip bir kullanıcı zaten var.';
    }
    
    if (!$_POST['password']) // parola girilmemişse
        $errors[] = 'Parolanızı girmediniz.';
    elseif ($_POST['password'] != $_POST['password_confirm']) // parola girilmişse ve confirm alanı ile aynı ise...
        $errors[] = 'Girdiğiniz iki parola birbirinden farklı.';
    elseif (!preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})$/", $_POST['password']))
        $errors[] = 'Parolanız 6-20 karakter aralığında olmalıdır. Minimum 1 küçük, 1 büyük harf ve 1 rakam içermelidir. @#$% özel karakterlerinden birisini içermelidir.';
    
    if (empty($errors)) { // bütün alanlar kontrol edildiyse ($errors dizisi boş ise)
        
        // kullanıcıdan gelen veriler filtreleniyor
        $name     = mysql_real_escape_string($_POST['name']);
        $surname  = mysql_real_escape_string($_POST['surname']);
        $email    = mysql_real_escape_string($_POST['email']);
        $username = mysql_real_escape_string($_POST['username']);
        $password = sha1($_POST['password']); // parola sha1 algoritması ile hashleniyor
        
        // kayıt veri tabanına ekleniyor
        $query = mysql_query("INSERT INTO users
            (name, surname, email, username, password)
            VALUES
            ('$name', '$surname', '$email', '$username', '$password')
            ") or die(mysql_error());
        
        // register_complete.php adresine yönlendirilme yapılıyor
        header("Location: " . DOC_ROOT . "/register_complete.php");
    }
    
}

$_SESSION['my_captcha'] = captcha();

require 'views/layout/header.php';
require 'views/register.php';
require 'views/layout/footer.php';