<!doctype html>
<html lang="en">
    <head>
        <?php require 'head.html'; ?>
        <title>Guestbook</title>
    </head>
    <body class="container">
        <div class="row">
            <h1 class="col-12 text-center bg-primary text-white p-4 mt-2">Guestbook</h1>
        </div>
        <div class="row">
            <!-- ссылка на вход через фб -->
            <a href="<?php echo $link_fb ?>" class="btn btn-primary rounded-0 ">Login with Facebook</a>
        </div>
        <?php require 'list_scripts.html'; ?>
    </body>
</html>
