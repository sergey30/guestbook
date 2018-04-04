<?php
// получение всех сообщений пользователя, id пользователя берется из $_POST["session_id"]
if (isset($_POST['session_id'])) {
    try {
        $dbh = new PDO('mysql:dbname=guestbook_db;host=localhost', 'guestbook', '1');
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $sth = $dbh->prepare('SELECT id, first_name, last_name, date_created, message FROM messages WHERE
                            uid = :uid');
    $sth->execute(array('uid' => $_POST['session_id']));
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($array);

}
?>
