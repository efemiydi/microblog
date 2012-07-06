<h1>Üye ol</h1>

<?php if (!empty($errors)) : ?>
<div class="errorbox">
    <ul>
        <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>

<form action="" method="post">
    <label for="name" class="label">Adınız</label>
    <input type="text" id="name" name="name" value="<?php echo $_POST['name'] ?>" />
    
    <br />
    
    <label for="surname" class="label">Soyadınız</label>
    <input type="text" id="surname" name="surname" value="<?php echo $_POST['surname'] ?>" />
    
    <br />
    
    <label for="email" class="label">E-mail adresiniz</label>
    <input type="text" id="email" name="email" value="<?php echo $_POST['email'] ?>" />
    
    <br />
    
    <label for="username" class="label">Kullanıcı adınız</label>
    <input type="text" id="username" name="username" value="<?php echo $_POST['username'] ?>" />
    
    <br />
    
    <label for="password" class="label">Parola</label>
    <input type="password" id="password" name="password" />
    
    <br />
    
    <label for="password_confirm" class="label">Parola (tekrar)</label>
    <input type="password" id="password_confirm" name="password_confirm" />
    
    <br />
    
    <label class="label">&nbsp;</label>
    <img src="<?php echo $_SESSION['my_captcha']['image_src'] ?>" alt="CAPTCHA" />
    <br />
    <label for="m_captcha" class="label">Güvenlik kodu</label>
    <input type="text" name="m_captcha" /> yukarıdaki güvenlik kodunu boşluğa giriniz
    
    <br />
    
    <label class="label">&nbsp;</label>
    <input type="hidden" name="action" value="save_user" />
    <input type="submit" class="button" value="Kayıt" />
</form>