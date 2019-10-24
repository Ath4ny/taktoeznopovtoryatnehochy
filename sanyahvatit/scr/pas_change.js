//proverka cookie
(() =>{
    let cookies = document.cookie;

if(cookies != ""){
    cookies = cookies.split("=");

    cookdata = new FormData();

    cookdata.append('cookie', cookies[1]);
    
    fetch("http://sanyahvatit/scr/home.php", {
        method: 'POST',  
        body: cookdata   
    })
        .then(resp => resp.json())
        .then(responce => {
            
            console.log(responce);
            if(responce.mes == "GOOD"){
                alert("Welcome home");
            }
            if(responce.mes == "ERROR"){
                document.location.href = "../page/login.html";
                document.cookie = document.cookie + ";max-age=0"; // ; path=/
            }
        })
    
    }
    else{
        document.location.href = "../page/login.html";
        document.cookie = document.cookie + ";max-age=0";
    }
})();
//smena parolya
document.getElementById("pas_change").onclick = ()=>{
    let inp_pas = document.getElementsByClassName("field");

    if(inp_pas[0].value !="" && inp_pas[1].value !="" && inp_pas[2].value !="" ){
        if(inp_pas[1].value == inp_pas[2].value){

            new_pas = new FormData();

            new_pas.append('Old_pas', inp_pas[0].value);
            new_pas.append('New_pas', inp_pas[2].value);

            fetch("http://sanyahvatit/scr/pas_change.php",{
            method: 'POST',
            body: new_pas
            })

            .then(resp => resp.json())
            .then(responce =>{
                console.log(responce);
                if (responce.mes == "GOOD") {
                    document.location.href = "../page/login.html";
                    document.cookie = document.cookie + ";max-age=0";
                }
                if (responce.mes == "ERROR") {
                    alert("Кажется, что-то пошло не так");
                }
            })
        }
        else{
            alert("Новый пароль не совпадает");
        }
    }
    else{
        alert("Одно или несколько полей не заполнены!");
    }
}