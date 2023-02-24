
// Fonction pour désactiver le readOnly
function NotReadOnly() {
    let lastname = document.getElementById("lastname");
    let firstname = document.getElementById("firstname");
    let birthdate = document.getElementById("birthdate");
    let phone = document.getElementById("phone");
    let mail = document.getElementById("mail");
    
    lastname.readOnly = false;
    firstname.readOnly = false;
    birthdate.readOnly = false;
    phone.readOnly = false;
    mail.readOnly = false;
  }

  function removeClass(){
    let input = document.querySelectorAll("input");
    // je supprime la valeur de l'attribut class :
    input.classList.remove("noEdit");
  }
  
  // Ajouter un écouteur d'évènements sur le bouton modifier :
  let pen = document.getElementById("pen"); 
  pen.addEventListener("click", NotReadOnly, removeClass, false);

