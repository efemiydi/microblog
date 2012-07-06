<h1>Profili güncelle</h1>

<?php if (!empty($errors)) : ?>
<div class="errorbox">
    <ul>
        <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>

<form action="" method="post" enctype="multipart/form-data">
    <label for="name" class="label">Adınız</label>
    <input type="text" id="name" name="name" value="<?php echo $user_info['name'] ?>" />
    
    <br />
    
    <label for="surname" class="label">Soyadınız</label>
    <input type="text" id="surname" name="surname" value="<?php echo $user_info['surname'] ?>" />
    
    <br />
    
    <label for="email" class="label">E-mail adresiniz</label>
    <input type="text" id="email" name="email" value="<?php echo $user_info['email'] ?>" />
    
    <br />
    
    <label for="username" class="label">Kullanıcı adınız</label>
    <?php echo $user_info['username'] ?>
    
    <br />
    <br />
    
    <label for="password" class="label">Parola</label>
    <input type="password" id="password" name="password" /> parolanızı güncellemek istemiyorsanız boş bırakın
    
    <br />
    
    <label for="password_confirm" class="label">Parola (tekrar)</label>
    <input type="password" id="password_confirm" name="password_confirm" />
    
    <br />
    
    <label class="label">Profil resmi</label>
    <input type="file" name="profile_image" />
    
    <br />
    
    <label class="label">&nbsp;</label>
    <input type="hidden" name="action" value="update_user" />
    <input type="submit" class="button" value="Güncelle" />
</form>