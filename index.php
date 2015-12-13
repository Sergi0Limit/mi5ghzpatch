<?php
/**
 * Created by PhpStorm.
 * User: smuravjev
 * Date: 7/17/15
 * Time: 21:26
 */
?>
<!DOCTYPE html>
<!-- saved from url=(0050)http://rutheme.ru/demo/templates/html/4/index.html -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title>mi.freize.org</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Патчер для XRMWRT.">
    <link rel="shortcut icon" href="http://freize.net/favicon.png" type="image/x-icon">
    <link rel="canonical" href="http://mi.freize.org/">

    <!-- CSS -->
    <link rel="stylesheet" href="./files/style.css" type="text/css">
    <link href="files/css" rel="stylesheet" type="text/css">
    <style type="text/css">/* This is not a zero-length file! */</style>
    <style type="text/css">/* This is not a zero-length file! */</style>
</head>

<body class="body-coming">
<div class="page-body">
    <section class="page-section">
        <div class="logo">
            <img src="./files/logo.png" alt="Название компании" title="Название компании">
        </div>
        <aside class="text">
            <p>
                Сервис патча файла mtd2.bin по инструкции
                <ff><a href="http://forum.ixbt.com/topic.cgi?id=14:61988-78#2947"><i
                            class="tt"></i><span>forum.ixbt.com</span></a></ff>
                от Padavan или более подробно
                <ff><a href="http://4pda.ru/forum/index.php?showtopic=596689&st=3660#entry41511968"><i
                            class="tt"></i><span>4pda.ru</span></a></ff>
            </p>

        </aside>
        <aside class="input-email">
            <form action="" method="post" enctype="multipart/form-data"
                  style="border: 1px solid gray;padding: 20px;margin: 10px">
                Выберите скопированный с роутера файл mtd2.bin и нажмите загрузить:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Загрузить" name="submit">
                <p><ff><a href="http://4pda.ru/forum/index.php?showtopic=596689&st=3660#entry41511968">1. Вариант</a> с RFOffset </ff> <input type="radio" name="variant" value="1" /></p>
                <p><ff><a href="http://4pda.ru/forum/index.php?s=&showtopic=596689&view=findpost&p=41980018">2. Вариант</a> без RFOffset </ff><input type="radio" name="variant" value="2" checked="checked"/></p>
                <!--                <p><ff><a href="http://4pda.ru/forum/index.php?s=&showtopic=596689&view=findpost&p=41980018">3. Вариант</a> вариант 1 + 2) </ff><input type="radio" name="variant" value="3"/></p>-->
            </form>
            <div style="border: 1px solid gray;padding: 40px;margin: 10px">
                <?php
                if ((int)$_POST["variant"]==1 || (int)$_POST["variant"]==3){
                    include_once "var1.php";
                } else {
                    include_once "var2.php";
                }
                ?>
            </div>
        </aside>
    </section>
</div>

</body>
</html>
