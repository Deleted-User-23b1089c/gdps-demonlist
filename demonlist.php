<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YourGDPS - Demonlist</title>
</head>
<body>
    <div id="nav" class="nav">
        <div class="line"></div>
        <div class="logo">
            <div class="logo1"></div>
        </div>
        <button type="button" id="login" class="login">Войти</button>
        <h1 class="logo-title">Demonlist</h1>
    </div>
    <div class="demonlist">
<?php
include "../include/lib/connection.php";

$query = $db->prepare("SELECT count(*) FROM demonlist");
$query->execute();
$count = $query->fetchColumn();

for($i = 1;$i < $count;$i++){
    $query = $db->prepare("SELECT id FROM demonlist WHERE place = :place");
    $query->execute([
        ":place" => $i
    ]);
    $demonid = $query->fetchColumn();
    
    $query = $db->prepare("SELECT levelName, userID FROM levels WHERE levelID = :id");
    $query->execute([
    	":id" => $demonid	
    ]);
    $demoninfo = $query->fetchAll();
    
    $query = $db->prepare("SELECT userName FROM users WHERE userID = :userID");
    $query->execute([
        ":userID" => $demoninfo[0]["userID"]
    ]);
    $author = $query->fetchColumn();
    switch($i){
        case 1:
        echo '<div class="level">
            <span class="num-top">'.$i.'</span>
            <div class="name">'.$demoninfo[0]["levelName"].'</div>
            <div class="author">@'.$author.'</div>
        </div>';
        break;
        case 2:
            echo '<div class="level">
            <span class="num-sec">'.$i.'</span>
            <div class="name">'.$demoninfo[0]["levelName"].'</div>
            <div class="author">@'.$author.'</div>
        </div>';
        break;
        default:
            echo '<div class="level">
                <span class="num-def">'.$i.'</span>
                <div class="name">'.$demoninfo[0]["levelName"].'</div>
                <div class="author">@'.$author.'</div>
            </div>';
        break;
    }
}
?>
</body>
</html>