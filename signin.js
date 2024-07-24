//controle de la saisie du formulaire fsign si il y a un erreur on affiche un message d'erreur avec alert et on bloque le formulaire
 document.fsign.addEventListener("submit",function(e){    
     if(!validesignin()){
         e.preventDefault();
     }
 }
 );

//crée une fontion qui permet de verifier si le chapms nom est composé de caractère alphabétique
 function validesignin(){
     let nom = document.getElementById("nom").value;
     let prenom = document.getElementById("pnom").value;
     let mdp = document.getElementById("mdp").value;
     let regex = /^[a-zA-Z ]+$/;
     if(!regex.test(nom)){
         alert("le nom doit être composé de caractère alphabétique");
         return false;
     }
     if(!regex.test(prenom)){
         alert("le prenom doit être composé de caractère alphabétique");
         return false;
     }
     if(mdp.length < 8){
         alert("le mot de passe doit être composé de 8 caractère minimum");
         return false;
     }
    if(mdp != document.getElementById("cmdp").value){
        alert("le mot de passe et le mot de passe de confirmation ne sont pas identique");
        return false;
    }
     return true;
 }
