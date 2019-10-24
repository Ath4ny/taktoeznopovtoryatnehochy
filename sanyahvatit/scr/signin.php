<?php
// echo '{"old":"'.$_POST["Old_pas"].'", "new":"'.$_POST["New_pas"].'"}';
function createHandShake(){
    $hand_str = "";
    for($i=0;$i<60;$i++){
        $char = mt_rand(48,122);
        if(!(($char>57 && $char<65) || ($char>90 && $char<97))){
            $hand_str .=chr($char);
    }
}
return $hand_str;
}

$logn = htmlspecialchars($_POST["Login"]);
$pasw = htmlspecialchars($_POST["Password"]);

$host = 'localhost';
$database = 'users';
$user = 'root';  
$password = '';
$link = mysqli_connect($host, $user, $password, $database) or die ("ERROR" .mysqli_error($link));

if($logn!= "" && $pasw!= ""){
    $handshake = createHandShake();
    $query = "SELECT * FROM `bd_user` WHERE `Password` = '$pasw' AND `Login` = '$logn'";
    $result = mysqli_query($link, $query) or die ("ERROR" .mysqli_error($link));
    if($result->num_rows){
        $row = mysqli_fetch_array($result);
        $query_hand = "UPDATE `bd_user` SET `Hand` = '$handshake' WHERE `bd_user`.`Id` = '$row[0]' ";
        $result_hand = mysqli_query($link,$query_hand)or die("ERROR ".mysqli_error($link));
    }
    if($result_hand){ 
    echo '{"mes":"GOOD", "Handshake":"'.$handshake.'"}';
    }
    else{
    echo '{"mes":"ERROR", "Handshake":"'.createHandShake().'"}';
    }
}
else{
    echo '{"mes":"ERROR", "Handshake":"'.createHandShake().'"}';
}
?>