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
                id <?php echo $array['id_social_net'] ?>
            </div>
            <div class="col-2 mr-2 p-2 text-primary text-center border border-primary">
                first name <?php echo $array['first_name'] ?>
            </div>
            <div class="col-2 mr-2 p-2 text-primary text-center border border-primary">
                last name <?php echo $array['last_name'] ?>
            </div>

            <a href="https://fortest.xyz/?action=out" class="col-2 p-2 btn btn-outline-secondary rounded-0">
                Logout
            </a>

            <!-- <div class="col-2 btn btn-outline-secondary rounded-0">
                <form class="" action="index.html" method="post">
                    <button type="submit" class="">Logout</button>
                </form>
            </div> -->


        </div>

        <?php require 'list_scripts.html'; ?>
    </body>
</html>
