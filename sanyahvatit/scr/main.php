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


$logn = htmlspecialchars($_POST["Login"]);
$pasw = htmlspecialchars($_POST["Password"]);

$host = 'localhost';
$database = 'users';
$user = 'root';
$password = '';
$link = mysqli_connect($host, $user, $password, $database) or die ("ERROR" .mysqli_error($link));
// $handshake = createHandShake();
// echo '{"log":"'.$logn.'", "pas":"'.$handshake.'"}';

if($logn != "" && $pasw != ""){
    $handshake = createHandShake();
    $query = "INSERT INTO `bd_user` (`Id`, `Login`, `Password`, `Hand`) VALUES (NULL, '$logn', '$pasw', '$handshake')";
    $result = mysqli_query($link, $query) or die ("ERROR" .mysqli_error($link));
    if($result){
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