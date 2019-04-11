function UploadPic() {
    var canvas = document.getElementById('canvas');
    var dataURL = canvas.toDataURL();
    document.getElementById('hidden_data').value = dataURL;
    var fd = new FormData(document.forms["form1"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../controllers/download.php");


    xhr.send(fd);

    alert('Image ajoutée avec succès :)');


    window.location.reload();
}

document.getElementById('fichier').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = UploadPic;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

///////
