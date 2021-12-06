let forms = document.querySelectorAll('.statusChange'); // Selection des formulaire qui possède la class="testForm"

forms.forEach((form) => {

    form.addEventListener('input', function(e) { // J'indique ce qui doit se passer a l'évènement "submit"
        e.preventDefault(); // Je stop le déroulement standard du formulaire
        
        let data = new FormData(this); //Récupèration des données du formulaire dans le nouvel objet data
    
        let xhr = new XMLHttpRequest; // J'apelle un nouvel object xhr
    
        xhr.onreadystatechange = function() { //Au changement d'état du formulaire j'indique les actions à effectuer
            if(this.readyState == 4 && this.status == 200) {
                console.log(this.response); // Je lis les données récupérer dans data en console
            }
            else if (this.readyState == 4) {
                alert("Une erreur est survenue...")
            }
        }

        xhr.open("POST", "https://127.0.0.1:8000/order_required/", true);
        xhr.responseType = "json";
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest")
        xhr.send(data);
    
        return false; // je retourne false pour m'assurer que le comportement de base du formulaire soit bien arrêté
    });
})