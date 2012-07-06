<div class="content_div">
    <div class="title">
        <div class="float-left">Mesajlar</div>
    </div>
</div>

<div class="spacer clearboth"></div>

<?php if (!empty($messages)) : ?>
<?php foreach ($messages as $message) : ?>
<div class="content_div">
    <div class="subtitle">
        <div class="float-left"><?php echo get_username($message['user_id']) ?></div>
        <div class="float-right timestamp"><?php echo strtotime($message['created_at']) ?></div>
    </div>
    <div class="rows">
        <div class="text">
            <div class="float-left">
                <?php if (file_exists('public/uploads/' . $message['user_id'] . '_t.jpg')) : ?>
                <img src="<?php echo DOC_ROOT ?>/public/uploads/<?php echo $message['user_id'] ?>_t.jpg" alt="" />
                <?php else : ?>
                <img src="<?php echo DOC_ROOT ?>/public/images/user_avatar.png" alt="" />
                <?php endif ?>
            </div>
            <div class="float-left" style="padding-left: 5px;">
                <?php echo $message['message'] ?>
            </div>
            <?php if ($_SESSION['user_id'] == $message['user_id']) : ?>
            <div class="float-right">
                <a href="<?php echo DOC_ROOT ?>/delete.php?message_id=<?php echo $message['id'] ?>" onclick="javascript: return confirm('Silmek istediğinize emin misiniz?');">
                    <img src="<?php echo DOC_ROOT ?>/public/images/ico-delete.png" alt="" />
                </a>
            </div>
            <?php endif ?>
            <div class="clearboth"></div>
        </div>
    </div>
</div>
<div class="spacer clearboth"></div>
<?php endforeach ?>
<?php endif ?>

<div class="spacer clearboth"></div>

<div class="content_div">
    <div class="title">
        <div class="float-left">Mesaj yaz</div>
    </div>
    
    <div class="rows">
        <div class="text">
            <?php if ($_SESSION['user_id'] > 0) : ?>
            <form action="" method="post">
                <textarea name="message" cols="70" rows="3"></textarea>
                <br />
                <input type="hidden" name="action" value="save_message" />
                <input type="submit" class="button" value="Gönder" />
            </form>
            <?php else : ?>
            Mesaj gönderebilmek için
            <a href="<?php echo DOC_ROOT ?>/login.php">üye girişi</a>
            yapmanız gerekmektedir.
            <?php endif ?>
        </div>
    </div>
</div>