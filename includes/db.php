<?php

require_once "config.php";

?>

<?php

try {
$connection = new PDO("mysql:host=$server;dbname=$name;charset=utf8", $username, $password); 


/* Create DB and TABLE */

$createdb = "CREATE DATABASE userdb";

$createtable = "CREATE TABLE `userdb`.`commentstable` ( 
    `comment_id` INT NOT NULL AUTO_INCREMENT , 
    `parent_comment_id` INT NOT NULL , 
    `comment` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `comment_name_sender` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `date_sending_comment` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`comment_id`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;";

$connection->exec($createdb); 
$query = $connection->prepare($createtable);
$connection->exec($createtable); 


}
catch(Exception $connection) {
    $messageError = 'Не удалось подключиться к базе данных!';     
}

?>