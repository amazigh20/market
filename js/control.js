
function control_mdp() {
    let a = document.getElementById("mdp").value;
    let b = document.getElementById("mdp2").value;
    if (a !== b) {
        document.getElementById("mdp").focus();
        alert("Les mots de passe ne sont pas identiques ");
        document.getElementById("mdp2").value="";
    }

}

function control_email() {
    let a = document.getElementById("email").value;
    let b = document.getElementById("email2").value;
    if (a !== b) {
        document.getElementById("email").focus();
        alert("Les adresses Email ne sont pas identiques ");
        document.getElementById("email2").value="";
        

    }
}

function correcte_email() {
    let cm = document.getElementById('email').value;
    if (!cm.match(/\S+@\S+\.\S+/) || !em.match(/\S+/)) {
        alert("Email incorrecte ! email@exemple.com ");
        
    }
}
function control_pseudo()
    {
        let pseudo = document.getElementById("pseudo").value;
        if (pseudo.length > 15 ) {
          alert("le pseudo ne doit pas depassé 15 caractères! ")  
          
        }
    }
    