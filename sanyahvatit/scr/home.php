<?php
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

$cookie = htmlspecialchars($_POST["cookie"]);

$host = 'localhost';
$database = 'users';
$user = 'root';  
$password = '';
$link = mysqli_connect($host, $user, $password, $database) or die ("ERROR" .mysqli_error($link));

if($cookie != ""){
    $handshake = createHandShake();
    $query = "SELECT * FROM `bd_user` WHERE `Hand` = '$cookie'";
    $result = mysqli_query($link, $query) or die ("ERROR" .mysqli_error($link));
    if($result->num_rows){
        $row = mysqli_fetch_array($result)
    }
    if($row){ 
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