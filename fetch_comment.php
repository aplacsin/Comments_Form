<?php

require_once "includes/db.php";


$query = "SELECT * FROM commentstable WHERE parent_comment_id = '0' ORDER BY comment_id DESC";

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '';


foreach ($result as $row) {
    $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">От <b>' . $row["comment_name_sender"] . '</b> в <i>' . $row["date_sending_comment"] . '</i></div><hr>
  <div class="panel-body">' . $row["comment"] . '</div><hr>
  <div class="panel-footer" align="right"><button type="button" class="reply" id="' . $row["comment_id"] . '">Ответить</button></div>
 </div>
 ';
    $output .= get_reply_comment($connection, $row["comment_id"]);
}

echo $output;

function get_reply_comment($connection, $parent_id = 0, $marginleft = 0)
{
    $query     = "SELECT * FROM commentstable WHERE parent_comment_id = '" . $parent_id . "'";
    $output    = '';
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $count  = $statement->rowCount();
    
    
    if ($parent_id == 0) {
        $marginleft = 0;
    } else {
        $marginleft = $marginleft + 50;
    }
    if ($count > 0) {
        foreach ($result as $row) {
            $output .= '
   <div class="panel panel-default" style="margin-left:' . $marginleft . 'px">
    <div class="panel-heading">От <b>' . $row["comment_name_sender"] . '</b> в <i>' . $row["date_sending_comment"] . '</i></div><hr>
    <div class="panel-body">' . $row["comment"] . '</div><hr>
    <div class="panel-footer" align="right"><button type="button" class="reply" id="' . $row["comment_id"] . '">Ответить</button></div>
   </div>
   ';
            $output .= get_reply_comment($connection, $row["comment_id"], $marginleft);
        }
    }
    
    return $output;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    
</body>
</html>