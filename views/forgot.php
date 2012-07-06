<h1>Parolamı unuttum</h1>

<?php if (!empty($errors)) : ?>
<div class="errorbox">
    <ul>
        <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>

<?php if (isset($_POST['email'])) : ?>

Parolanız e-mail adresinize gönderilmiştir.<br />
Yeni parolanız: <?php echo $password ?>

<?php else : ?>

<form action="" method="post">
    <label for="email" class="label">E-mail adresiniz</label>
    <input type="text" id="email" name="email" value="" />
    
    <br />
    
    <label class="label">&nbsp;</label>
    <input type="hidden" name="action" value="send_mail" />
    <input type="submit" class="button" value="Parolamı hatırlat" />
</form>
<?php endif ?>