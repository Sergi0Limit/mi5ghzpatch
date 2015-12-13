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




    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>



    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>



    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">



    <script type="text/javascript" src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/rollups/md5.js"></script>
    <script type="text/javascript">//<![CDATA[
        window.onload=function(){
            function getPass(serial) {
                var salt = '6d2df50a-250f-4a30-a5e6-d44fb0960aa0';
                var hash = CryptoJS.MD5(serial+salt);

                return hash.toString().substr(0, 8);
            }

            $(function(){
                $('#pwn-btn').on('click', function(){
                    var serial = $('#router-serial').val();
                    var pass = getPass(serial);
                    $('#generated-serial').text('Password: ' + pass);
                });
            });
        }//]]>

    </script>
    <!-- CSS -->
    <link rel="stylesheet" href="./files/style.css" type="text/css">
    <link href="files/css" rel="stylesheet" type="text/css">
    <style type="text/css">/* This is not a zero-length file! */</style>
    <style type="text/css">/* This is not a zero-length file! */</style>

<style>
    label {
        color: #189E18;
    }
</style>
</head>

<body class="body-coming">
<div class="page-body">
    <section class="page-section">
        <div class="logo">
            <img src="./files/logo.png" alt="Название компании" title="Название компании">
        </div>
        <aside class="text">
            <p>
                Генератор пароля ssh к роутеру
                <ff><a href="http://jsfiddle.net/p0rsche/tqz3eqru/"><i
                            class="tt"></i><span>оригинал</span></a></ff>

            </p>

        </aside>

        <div class="container">
            <div class="form-group">
                <input type="text" class="form-control" id="router-serial" placeholder="Serial">
            </div>
            <a class="btn btn-default btn-danger" id="pwn-btn" href="#" role="button">Pwnd!</a>
            <span class="badge" id="generated-serial"></span>
        </div>
        <br>
    </section>

</div>

</body>
</html>
