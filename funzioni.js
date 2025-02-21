    function vaiAllaRicetta(event, id) {
    event.stopPropagation();
    window.location.href = "ricetta.php?id=" + id;
    }

    function vaiAIndex(event) {
    event.stopPropagation();
    window.location.href = "index.php";
    }

    function registerOrLogin(event,id) {
    event.stopPropagation();
    window.location.href = "accesso.php?id="+ id;
    }

    function favorites(event, id, toggle) {
    event.stopPropagation();
    const star = document.getElementById("addPreferiti" + id);

    const formData = new FormData();
    formData.append('id', id);
    formData.append('action', toggle ? 'remove' : 'add');

    fetch("home.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            star.src = toggle ? "./img/nonPreferiti.png" : "./img/Preferiti.png";
        } else {
            alert("C’è stato un errore durante l’operazione!");
        }
    })
    .catch(error => {
        console.error("Errore:", error);
        alert("C’è stato un errore durante l’operazione! " + error);
    });
    }

    function toggleFavorite(event, id, isFavorite) {
    event.stopPropagation();  
    const star = document.getElementById('addPreferiti' + id);

    const action = isFavorite ? 'remove' : 'add';
    const newIsFavorite = !isFavorite; 

    const formData = new FormData();
    formData.append('id', id);
    formData.append('action', action);

    fetch('home.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return response.json();
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

    function uploadFiles(file) {
    const formData = new FormData();
    formData.append('file', file);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'account.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText);
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