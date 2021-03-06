<?php
// удаляется из таблицы сообщение с конкретным id который получен из $_POST["message_id"], далее выводятся все остальные существующие сообщения пользователя
if (isset($_POST['message_id']) && isset($_POST['session_id'])) {
    try {
        $dbh = new PDO('mysql:dbname=guestbook_db;host=localhost', 'guestbook', '1');
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $sth = $dbh->prepare('DELETE from messages where id=:id AND uid=:uid');
    $sth->execute(array('id' => $_POST['message_id'],
                        'uid' => $_POST['session_id']));

    $sth = $dbh->prepare('SELECT id, first_name, last_name, date_created, message FROM messages WHERE
                            uid = :uid');
    $sth->execute(array('uid' => $_POST['session_id']));
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($array);

}
?>
