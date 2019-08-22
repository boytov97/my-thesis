var modal = document.getElementById('myModal');
var img = document.querySelectorAll('#myImg');
var modalImg = document.getElementById('img01');
var captionText = document.getElementById('caption');
var link_to_download = document.querySelector('.modal-download');

for (var i = 0; i < img.length; i++) {
	img[i].onclick = modal_view;
}

function modal_view() {
	modal.style.display = "block";
	modalImg.src = this.nextElementSibling.src;
	captionText.innerHTML = this.alt;
	link_to_download.href = this.nextElementSibling.src;
}

var span = document.querySelector(".modal-close");
span.onclick = function() {
	modal.style.display = "none";
}

var image_id;

function plusSlidesModal(num) {

	for (var i = 0; i < img.length; i++) {
		if (modalImg.src == img[i].nextElementSibling.src) {
			image_id = i;
		}
	}

	if (image_id == img.length - 1) {
		image_id = -1;
	}

	modalImg.src = img[image_id + num].nextElementSibling.src;
	captionText.innerHTML = img[image_id + num].alt;
	link_to_download.href = img[image_id + num].nextElementSibling.src;
}

function minusSlidesModal(num) {

	for (var i = 0; i < img.length; i++) {
		if (modalImg.src == img[i].nextElementSibling.src) {
			image_id = i;
		}
	}

	if (image_id == 0) {
		image_id = img.length;
	}

	modalImg.src = img[image_id + num].nextElementSibling.src;
	captionText.innerHTML = img[image_id + num].alt;
	link_to_download.href = img[image_id + num].nextElementSibling.src;
}