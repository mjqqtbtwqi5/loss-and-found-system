function updateImageView(fromID, toID) {
    var imageFile = document.getElementById(fromID).files[0];
    var imageView = document.getElementById(toID);
    var reader = new FileReader();

    reader.onload = function () {
        imageView.src = this.result
    }
    reader.readAsDataURL(imageFile);
}

function confirmBeforeSubmit(e, msg) {
    if(!confirm(msg)) {
        e.preventDefault();
    }
}

function testing()
{
    alert();
}