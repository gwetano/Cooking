function vaiAllaRicetta(event, id) {
  event.stopPropagation(); //evito il bubbling
  window.location.href = "ricetta.php?id=" + id; //query string usata per passare l'id della ricetta
}

function vaiAIndex(event) {
  event.stopPropagation();
  window.location.href = "index.php";
}

function registerOrLogin(event, id) {
  event.stopPropagation();
  window.location.href = "accesso.php?id=" + id;
}

function chiudiFinestra() {
  window.location.reload();
}

function toggleFavorite(event, id, isFavorite) {
  event.stopPropagation();
  const star = document.getElementById("addPreferiti" + id);

  const action = isFavorite ? "remove" : "add"; //decido l'action in base al valore di isFavorite
  const newIsFavorite = !isFavorite;

  const formData = new FormData();
  formData.append("id", id);
  formData.append("action", action); 
  //invece di passare l'azione nella xhr.open la passo nel form in quanto
  //non avrei  potuto far variare action a seconda della situazione !(vedi sotto)

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "home.php"/*home.php?action=add/remove*/, true);  
  xhr.onload = function () {
    if (xhr.status == 200) {
      var response = JSON.parse(xhr.responseText);
      if (response.success == true) {
        star.src = newIsFavorite
          ? "./img/preferiti.png"
          : "./img/nonPreferiti.png";
        star.setAttribute(
          "onclick",
          `toggleFavorite(event, ${id}, ${newIsFavorite})` 
          //aggiorno l'attributo onClick aggiornando la variabile isFavorite per i prossimi click
          //Se non aggiornassi l’attributo onclick, il valore passato alla funzione toggleFavorite(event, id, isFavorite) 
          //rimarrebbe sempre lo stesso valore iniziale, anche dopo aver modificato lo stato dell’elemento.
        );
      } else {
        alert("C’è stato un errore durante l’operazione!");
      }
    } else {
      alert("Errore nel caricamento;");
    }
  };
  xhr.send(formData);
}

function uploadFiles(file) {
  const formData = new FormData();
  formData.append("file", file);

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "account.php", true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      alert(xhr.responseText);
      window.location.href = "account.php";
    } else {
      alert("Errore nel caricamento: " + xhr.statusText);
    }
  };

  xhr.send(formData);
}
