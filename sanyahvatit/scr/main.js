document.getElementById("btn").onclick = () =>{
    let auth_data = document.getElementsByClassName("field");

if(auth_data[0].value != "" && auth_data[1].value != ""){ 

    auth_datt = new FormData() ;

    auth_datt.append('Login', auth_data[0].value);
    auth_datt.append('Password', auth_data[1].value);

    fetch("http://sanyahvatit/scr/main.php",{
    method: 'POST',
    body: auth_datt
    })
    .then(resp => resp.json())
    .then(responce =>{
        console.log(responce);
        if(responce.mes == "GOOD"){
            document.cookie = `Key=${responce.Handshake};max-age=${3600*24*7}`;
            document.location.href = "../page/home.html";
        }
        if(responce.mes == "ERROR"){
            alert("Что-то пошло не так!");
        }
    })
}   
else{
    alert("Одно или несколько полей не заполнены");
}
}