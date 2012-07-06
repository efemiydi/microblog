<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Microblog</title>

        <link href="<?php echo DOC_ROOT ?>/public/css/style.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="<?php echo DOC_ROOT ?>/public/js/jquery.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo DOC_ROOT ?>/public/js/jquery.timesago.js" charset="utf-8"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('.timestamp').timesago({
                    /*
                    months: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                    days: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
                    firstday: 1,
                    refresh: 1,
                    hoursago: '%d saat önce',
                    minutesago: '%d dakika önce',
                    secondsago: '%d saniye önce',
                    */
                });
            });
        </script>
        
    </head>
    <body>

        <div class="body">

            <div class="container">

                <div class="header">

                    <div class="float-left">

                        <div id="head_menu">
                            <ul>
                                <li><a href="<?php echo DOC_ROOT ?>/index.php">Ana sayfa</a></li>
                                <?php if (!isset($_SESSION['user_id'])) : ?>
                                <li><a href="<?php echo DOC_ROOT ?>/login.php">Giriş yap</a></li>
                                <li><a href="<?php echo DOC_ROOT ?>/register.php">Üye ol</a></li>
                                <?php endif ?>
                            </ul>
                        </div>

                    </div>
                    
                    <?php if ($_SESSION['user_id'] > 0) : ?>
                    <div class="user_panel">

                        <div class="avatar">
                            <?php if (file_exists('public/uploads/' . $_SESSION['user_id'] . '_t.jpg')) : ?>
                            <img src="<?php echo DOC_ROOT ?>/public/uploads/<?php echo $_SESSION['user_id'] ?>_t.jpg?t=<?php echo time() ?>" alt="" />
                            <?php else : ?>
                            <img src="<?php echo DOC_ROOT ?>/public/images/user_avatar.png" alt="" />
                            <?php endif ?>
                        </div>
                        <div class="text">
                            
                            <?php $hour = date("G"); if ($hour > 4 && $hour < 10) : ?>
                            Günaydın,
                            <?php elseif($hour >= 10 && $hour < 17) : ?>
                            İyi günler,
                            <?php elseif($hour >= 17 && $hour < 20) : ?>
                            İyi akşamlar,
                            <?php elseif($hour >= 20 && $hour < 24) : ?>
                            İyi geceler,
                            <?php else : ?>
                            Yatma zamanı geldi,
                            <?php endif ?>
                            <strong><?php echo $_SESSION['name'] . ' ' . $_SESSION['surname'] ?></strong>
                            <br />
                            <a href="<?php echo DOC_ROOT ?>/profile.php">profili güncelle</a> - 
                            <a href="<?php echo DOC_ROOT ?>/index.php?action=logout">çıkış yap</a>
                        </div>

                    </div>
                    <?php endif ?>

                </div>

                <div class="middle">

                    <div class="content">