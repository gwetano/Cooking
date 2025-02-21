function vaiAllaRicetta(event, id) {
  event.stopPropagation();
  window.location.href = "ricetta.php?id=" + id;
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

  const action = isFavorite ? "remove" : "add";
  const newIsFavorite = !isFavorite;

  const formData = new FormData();
  formData.append("id", id);
  formData.append("action", action);

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "home.php", true);

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
