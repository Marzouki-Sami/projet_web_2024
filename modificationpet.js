function activer_titre(){
    document.getElementById("titremod").disabled = false;
}
//activer la zone de text mdp si le boutton modifmdp est cliqué
function activer_contenu(){
    document.getElementById("contenumod").disabled = false;
}
document.fprofile.addEventListener("submit",function(e){    
    if(!validemodif()){
        e.preventDefault();
    }
});