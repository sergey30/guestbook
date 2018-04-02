<!doctype html>
<html lang="en">
    <head>
        <?php require 'head.html'; ?>
        <title>Guestbook</title>
    </head>
    <body class="container">

        <div class="row">
            <h1 class="col-12 text-center bg-primary text-white p-4 mt-2 mb-0">Guestbook</h1>
        </div>
        <div class="row">
            <div class="col-9 mt-4">
                <form action="" method="post" id="send_message" class="d-flex">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
                    <textarea name="message" class="form-control rounded-0"></textarea>
                    <button type="submit" name="submit" value="ok" id="btn_send_message" class="btn btn-primary ml-2 rounded-0">
                        Submit
                    </button>
                </form>
                <div id="result_form" class="mt-3"></div>
            </div>
            <div class="col-3">
                <!-- будут показаны краткие данные пользователя -->
                <div class=" mt-4 p-2 text-primary text-center border border-primary">
                    id <?php echo $array['id_social_net'] ?>
                </div>
                <div class=" mt-2 p-2 text-primary text-center border border-primary">
                    first name <?php echo $array['first_name'] ?>
                </div>
                <div class=" mt-2 p-2 text-primary text-center border border-primary">
                    last name <?php echo $array['last_name'] ?>
                </div>
                <!-- кнопка для выхода из аккаунта -->
                <a href="https://fortest.xyz/?action=out" class="d-block mt-2 p-2 btn btn-outline-secondary rounded-0">
                    Logout
                </a>
            </div>
        </div>



        <?php require 'list_scripts.html'; ?>
        <script src="../js/ajax.js"></script>
    </body>
</html>
