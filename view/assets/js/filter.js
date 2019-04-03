
const button = document.querySelector('button');

function take() {
    var ctx = document.getElementById('canvas');
    var ctx3 = document.getElementById('canvastest');
    var ctx2 = document.getElementById('canvas2');
    ctx.width = video.videoWidth;
    ctx.height = video.videoHeight;
    ctx.getContext('2d').drawImage(video, 0, 0, ctx.width, ctx.height);
    ctx.getContext('2d').drawImage(ctx3, 0, 0, ctx.width, ctx.height);
    ctx.getContext('2d').drawImage(ctx2, 0, 0, ctx.width, ctx.height);
    document.getElementById("btn-save").disabled = false;
    document.getElementById("btn-save").style.cursor = "pointer";
    document.getElementById("btn-save").style.opacity = "1";
};

function draw1(filtername) {
    var url = "../upload/filter/";
    var img = new Image();
    img.src = filtername;
    img.onload = drawfilter;
}

function drawfilter() {
    var canvas = document.getElementById('canvas2');
    canvas.width = this.width;
    canvas.height = this.height;
    var ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(this, 0,0);
    document.getElementById("btn-take").disabled = false;
    document.getElementById("btn-take").style.cursor = "pointer";
    document.getElementById("btn-take").style.opacity = "1";
}


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
        img.onload = draw;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};
function draw() {
    var canvas = document.getElementById('canvastest');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
}
function failed() {
    console.error("The provided file couldn't be loaded as an Image media");
}


///////
