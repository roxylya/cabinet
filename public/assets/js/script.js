
// Fonction pour désactiver le readOnly
function notReadOnly() {
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

  function removeClass() {
    var inputs = document.querySelectorAll("input");
    var selects = document.querySelectorAll("select");
   inputs.forEach(input => {
         input.classList.remove("noEdit");
    });
    selects.forEach(select => {
      select.classList.remove("noEdit");
 });
 
  }

  function notDisabled(){
    let dateAppointment = document.getElementById("dateAppointment");
    let hourSelect = document.getElementById("hour-select");
    let minutSelect = document.getElementById("minut-select");
    let idPatient = document.getElementById("idPatient");

    dateAppointment.readOnly = false;
    hourSelect.disabled = false;
    minutSelect.disabled = false;
    idPatient.disabled = false;
  }
  
  // Ajouter un écouteur d'évènements sur le bouton modifier :
  let pen = document.getElementById("pen"); 
  pen.addEventListener("click", notReadOnly, false);
  pen.addEventListener("click", removeClass, false);
  pen.addEventListener("click", notDisabled, false);

