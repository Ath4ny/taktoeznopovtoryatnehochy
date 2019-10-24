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


document.getElementById("exit").onclick = () => {
    document.cookie = document.cookie + ";max-age=0";
    document.location.href = "../page/login.html";
}
document.getElementById("pas_change").onclick = () => {
    document.location.href = "pas_change.html";
}


