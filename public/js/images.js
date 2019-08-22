var img_title = document.querySelectorAll('.img-title');

for (var i = 0; i < img_title.length; i++) {
	img_title[i].onmouseover = ownOnmouseover;
	img_title[i].onmouseout = ownOnmouseout;
}

function ownOnmouseover () {
	this.nextElementSibling.style.display = 'block';
}

function ownOnmouseout () {
	this.nextElementSibling.style.display = 'none';
}