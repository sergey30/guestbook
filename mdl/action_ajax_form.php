<?php

if (isset($_POST["message"]) && isset($_POST["id"])) {
    try {
        $dbh = new PDO('mysql:dbname=guestbook_db;host=localhost', 'guestbook', '1');
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $sth = $dbh->prepare("SELECT first_name, last_name FROM users WHERE
        id = :id");
    $sth->execute(array('id' => $_POST['id']));
    $array = $sth->fetch(PDO::FETCH_ASSOC);

    $sth = $dbh->prepare("INSERT INTO messages SET
        uid = :uid,
        first_name = :first_name,
        last_name = :last_name,
        message = :message,
        date_created = :date_created");
    $sth->execute(array('uid' => $_POST['id'],
                        'first_name' => $array['first_name'],
                        'last_name' => $array['last_name'],
                        'message' => $_POST['message'],
                        'date_created' => date('Y-m-d H:i:s')));



}

?>
