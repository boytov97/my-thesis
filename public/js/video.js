var video_title = document.querySelectorAll('.video-title'); 

for (var i = 0; i < video_title.length; i++) {
	video_title[i].onmouseover = ownOnmouseover;
	video_title[i].onmouseout = ownOnmouseout;
}

function ownOnmouseover () {
	this.nextElementSibling.style.display = 'block';
}

function ownOnmouseout () {
	this.nextElementSibling.style.display = 'none';
}