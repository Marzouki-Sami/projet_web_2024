//activer la zone de text nom si le boutton modifnom est cliqué
function activer_nom(){
    document.getElementById("nom").disabled = false;
}
//activer la zone de text prenom si le boutton modifprenom est cliqué
function activer_pnom(){
    document.getElementById("pnom").disabled = false;
}
//activer la zone de text mdp si le boutton modifmdp est cliqué
function activer_mdp(){
    document.getElementById("mdp").disabled = false;
}
//activer la zone de text mail si le boutton modifmail est cliqué
function activer_mail(){
    document.getElementById("mail").disabled = false;
}


//activer la zone de text nom si le boutton modifnom est cliqué avec addEventListener
document.getElementById("modifnom").addEventListener("click",activer_nom);
//activer la zone de text prenom si le boutton modifprenom est cliqué avec addEventListener
document.getElementById("modifpnom").addEventListener("click",activer_pnom);
//activer la zone de text mdp si le boutton modifmdp est cliqué avec addEventListener
document.getElementById("modifmdp").addEventListener("click",activer_mdp);
//activer la zone de text mail si le boutton modifmail est cliqué avec addEventListener
document.getElementById("modifmail").addEventListener("click",activer_mail);

document.fprofile.addEventListener("submit",function(e){    
    if(!validemodif()){
        e.preventDefault();
    }
});

        
function validemodif(){

    let regex = /^[a-zA-Z ]+$/;
    
    if(document.getElementById("nom").disabled == false){
        let nom = document.getElementById("nom").value;
        if(!regex.test(nom)){
            document.getElementById("nom").style.borderColor = "red";
            alert("le nom doit être composé de caractère alphabétique");
            return false;
        }
    }
    if(document.getElementById("pnom").disabled == false){
        let prenom = document.getElementById("pnom").value;
        if(!regex.test(prenom)){
            document.getElementById("pnom").style.borderColor = "red";
            alert("le prenom doit être composé de caractère alphabétique");
            return false;
        }
    }
    if(document.getElementById("mdp").disabled == false){
        let mdp = document.getElementById("mdp").value;
        if(mdp.length < 8){
            document.getElementById("mdp").style.borderColor = "red";
            alert("le mot de passe doit être composé de 8 caractère minimum");
            return false;
        }
    } 
    if(document.getElementById("mail").disabled == true){
        return true;
    }
    return true;
}
