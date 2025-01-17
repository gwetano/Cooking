document.getElementById('mostraBannerPass').addEventListener('click', function (event) {
    event.preventDefault();
    const banner = document.getElementsByClassName('banner')[1].style.display = 'flex';
});
document.getElementById('nascondiBannerPass').addEventListener('click', function (event) {
    event.preventDefault();
    const banner = document.getElementsByClassName('banner')[1].style.display = 'none';
});

document.getElementById('mostraBannerImg').addEventListener('click', function (event) {
    event.preventDefault();
    const banner = document.getElementsByClassName('banner')[0].style.display = 'flex';
});
document.getElementById('nascondiBannerImg').addEventListener('click', function (event) {
    event.preventDefault();
    const banner = document.getElementsByClassName('banner')[0].style.display = 'none';
});

document.getElementById('CambiaPasswordForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    fetch('?action=cambiaPassword', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = 'account.php';
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Errore:', error));
});
// Elementi della pagina
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileElem');
const fileList = document.getElementById('file-list');

// Impediamo l'azione di default per il drag and drop
dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.style.backgroundColor = '#e9e9e9'; // cambia colore per feedback
});

dropArea.addEventListener('dragleave', () => {
    dropArea.style.backgroundColor = '#fff'; // ripristina il colore
});

// Gestiamo il drop dei file
dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.style.backgroundColor = '#fff';

    const files = e.dataTransfer.files;
    handleFiles(files);
});

// Quando un file viene selezionato tramite input file
fileInput.addEventListener('change', () => {
    const files = fileInput.files;
    handleFiles(files);
});

// Funzione per mostrare i file selezionati
function handleFiles(files) {
    // Mostra i file nella lista
    const fileArray = Array.from(files)[0];
    fileList.innerHTML = '';
    const p = document.createElement('p');
    p.textContent = fileArray.name;
    fileList.appendChild(p);

    // Chiamata per caricare i file sul server
    uploadFiles(fileArray);
}


// Funzione per caricare i file sul server usando AJAX
function uploadFiles(files) {
    const formData = new FormData();

    formData.append('file', files);
    // Creazione della richiesta XMLHttpRequest
    const xhr = new XMLHttpRequest();
    // Impostiamo il tipo di richiesta e l'URL del server
    xhr.open('POST', 'account.php', true);

    // Impostiamo la funzione di callback che verrà chiamata quando la richiesta è completata
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Se la richiesta ha avuto successo
            alert('Caricamento completato:' + xhr.responseText);
            window.location.reload();
        } else {
            // Se si è verificato un errore
            alert('Errore nel caricamento: ' + xhr.statusText);
        }
    };

    // Invio dei dati tramite AJAX
    xhr.send(formData);
}