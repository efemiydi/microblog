<h1>Üye girişi</h1>

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
    <label for="username" class="label">Kullanıcı adınız</label>
    <input type="text" id="username" name="username" value="<?php echo $_POST['username'] ?>" />
    
    <br />
    
    <label for="password" class="label">Parola</label>
    <input type="password" id="password" name="password" />
    
    <br />
    
    <label class="label">&nbsp;</label>
    <input type="hidden" name="action" value="login" />
    <input type="submit" class="button" value="Giriş yap" />
    <a href="<?php echo DOC_ROOT ?>/forgot.php">parolamı unuttum</a>
</form>
