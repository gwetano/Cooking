function vaiAllaRicetta(event, id) {
  // Cambia la pagina in base all'ID della ricetta
  event.stopPropagation();
  window.location.href = "ricetta.php?id=" + id;
}

function vaiAIndex(event) {
  event.stopPropagation();
  window.location.href = "index.php";
}

function registerOrLogin(event,id) {
  event.stopPropagation;
  window.location.href = "accesso.php?id="+ id;
}

function favorites(event, id, toggle) {
  event.stopPropagation();
  const star = document.getElementById("addPreferiti" + id);
  fetch("home.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: id,
      action: toggle ? "remove" : "add",
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        if (toggle) {
          star.src = "./img/nonPreferiti.png";
        } else {
          star.src = "./img/Preferiti.png";
        }
      } else {
        alert("C’è stato un errore durante l’operazione!");
      }
    })
    .catch((error) => {
      console.error("Errore:", error);
      alert("C’è stato un errore durante l’operazione!" + error);
    });
}

function toggleFavorite(event, id, isFavorite) {
    event.stopPropagation();  // Previene il click sulla ricetta
    const star = document.getElementById('addPreferiti' + id);

    // Inverti il valore di isFavorite
    const action = isFavorite ? 'remove' : 'add';
    const newIsFavorite = !isFavorite;  // Nuovo stato di isFavorite

    fetch('home.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: id,
            action: action
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parso sempre come JSON
        })
        .then(data => {
            if (data.success) {
                star.src = newIsFavorite ? './img/preferiti.png' : './img/nonPreferiti.png';
                star.setAttribute('onclick', `toggleFavorite(event, ${id}, ${newIsFavorite})`);
            } else {
                alert('Errore durante l’operazione: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Errore:', error);
            alert('Errore durante l’operazione!');
        });
}

function handleFiles(files) {
    const fileArray = Array.from(files)[0];
    fileList.innerHTML = '';
    const p = document.createElement('p');
    p.textContent = fileArray.name;
    fileList.appendChild(p);

    uploadFiles(fileArray);
}

function uploadFiles(files) {
    const formData = new FormData();

    formData.append('file', files);

    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'account.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Caricamento completato:' + xhr.responseText);
            window.location.href = 'account.php';
        } else {
            alert('Errore nel caricamento: ' + xhr.statusText);
        }
    };

    xhr.send(formData);
}

function chiudiFinestra() {
    window.location.reload();
}