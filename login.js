document.flog.addEventListener("submit",function(e){    
    if(!validelogin()){
        e.preventDefault();
    }
});

function validelogin(){
    let mdp = document.getElementById("mdp").value;
    if(mdp.length < 8){
        alert("le mot de passe doit être composé de 8 caractère minimum");
        return false;
    }
    return true;
}