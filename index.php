<?php
	require_once("oauth.php");

	$vk  = new VKAuth(array(
		"client_id" => "6419214",
		"client_secret" => "4MNA0DXg0lvm6b01uaIx",
		"redirect_uri" => "http://fortest.xyz"
	));

	if(isset($_GET["code"])){
		$vk->auth($_GET["code"]);
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>vk</title>
  </head>
  <body>
    <h1>fb</h1>

	<?php
		if($vk->auth_status){
			echo("ID: ".$vk->user_info["id"]);
			echo("<br />");
			echo("Name: ".$vk->user_info["first_name"]);
			echo("<br />");
			echo("Surname: ".$vk->user_info["last_name"]);
		} else {
			echo("<a href='" . $vk->get_link() . "'>Войти</a>");
		}
	?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
