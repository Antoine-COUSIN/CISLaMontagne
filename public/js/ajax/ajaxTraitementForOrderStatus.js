document.getElementById("formFruit").addEventListener("input", function(e) {
    e.preventDefault();

    var data = new FormData(this);

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log(this.response);
        }else if (this.readyState == 4) {
            alert("Une erreur est survenue...")
        }
    };

    xhr.open("POST", "../php/traitement_ajax.php", true);
    xhr.responseType = "json";
    xhr.send(data);

    return false;
})