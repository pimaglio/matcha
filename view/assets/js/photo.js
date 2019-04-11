function UploadPic() {
    var canvas = document.getElementById('canvas_pp');
    var dataURL = canvas.toDataURL();
    document.getElementById('hidden_data').value = dataURL;
    var fd = new FormData(document.forms["form1"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../controllers/PhotosController.php");


    xhr.send(fd);

    alert('Image ajoutée avec succès :)');


    window.location.reload();
}

document.getElementById('imagepp').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawpp;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawpp() {
    var canvas = document.getElementById('canvas_pp');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
}

document.getElementById('imagep1').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawp1;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawp1() {
    var canvas = document.getElementById('canvas_p1');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
}

document.getElementById('imagep2').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawp2;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawp2() {
    var canvas = document.getElementById('canvas_p2');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
}

document.getElementById('imagep3').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawp3;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawp3() {
    var canvas = document.getElementById('canvas_p3');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
}

document.getElementById('imagep4').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawp4;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawp4() {
    var canvas = document.getElementById('canvas_p4');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
}


function failed() {
    console.error("The provided file couldn't be loaded as an Image media");
}
