<?php
// echo '{"old":"'.$_POST["Old_pas"].'", "new":"'.$_POST["New_pas"].'"}';

$old_pas = htmlspecialchars($_POST["Old_pas"]);
$new_pas = htmlspecialchars($_POST["New_pas"]);

$host = 'localhost';
$database = 'users';
$user = 'root';  
$password = '';
$link = mysqli_connect($host, $user, $password, $database) or die ("ERROR" .mysqli_error($link));

if($old_pas!= "" && $new_pas!= ""){
    $query = "SELECT * FROM `bd_user` WHERE `Password` = '$old_pas'";
    $result = mysqli_query($link, $query) or die ("ERROR" .mysqli_error($link));
    if($result->num_rows){
        $row = mysqli_fetch_array($result);
        $query_hand = "UPDATE `bd_user` SET `Password` = '$new_pas' WHERE `bd_user`.`Id` = '$row[0]' ";
        $result_hand = mysqli_query($link,$query_hand)or die("ERROR ".mysqli_error($link));
    }
    if($result_hand){ 
    echo '{"mes":"GOOD"}';
    }
    else{
    echo '{"mes":"ERROR"}';
    }
}
else{
    echo '{"mes":"ERROR"}';
}
?>