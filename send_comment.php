<?php

require_once "includes/db.php";


$messageError = '';
$comment_name = '';
$comment_text = '';


/* Field Check  */
if (empty($_POST["comment_name"])) {
    $messageError .= '<p class="text-danger">* Поле Имя должно быть заполнено.</p>';
} else {
    $comment_name = $_POST["comment_name"];
}

if (empty($_POST["comment_text"])) {
    $messageError .= '<p class="text-danger">* Поле Коментарий не должно быть пустым.</p>';
} else {
    $comment_text = $_POST["comment_text"];
}

if ($messageError == '') {
    $query = "INSERT INTO commentstable 
 (parent_comment_id, comment, comment_name_sender) 
 VALUES (:parent_comment_id, :comment, :comment_name_sender)";
    
    $statement = $connection->prepare($query);
    $statement->execute(array(
        ':parent_comment_id' => $_POST["comment_id"],
        ':comment' => $comment_text,
        ':comment_name_sender' => $comment_name
    ));
    $messageError = '<label class="text-success">Комментарий отправлен!</label>';
}

$data = array(
    'error' => $messageError
);

echo json_encode($data);

?>