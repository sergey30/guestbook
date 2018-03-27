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
            <div class="col-2 mr-2 p-2 text-primary text-center border border-primary">
                id <?php echo $fb->user_info["id"] ?>
            </div>
            <div class="col-2 mr-2 p-2 text-primary text-center border border-primary">
                name <?php echo $fb->user_info["first_name"] ?>
            </div>
            <div class="col-2 mr-2 p-2 text-primary text-center border border-primary">
                surname <?php echo $fb->user_info["last_name"] ?>
            </div>
            <a href="#" class="col-2 p-2 btn btn-outline-secondary rounded-0">
                Logout
            </a>
        </div>

        <?php require 'list_scripts.html'; ?>
    </body>
</html>
