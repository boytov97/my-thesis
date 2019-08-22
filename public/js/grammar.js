var accordion = document.querySelectorAll('.block-accordion');
var childsOfAccordion = document.querySelectorAll('.list');

for (var i = 0; i < accordion.length; i++) {
	accordion[i].onclick = show;
}

function show () {
	this.children[1].classList.toggle('list-hidden');
}

var show_categories_button = document.querySelector('.categories-show-button');
var onMenuModal = document.getElementById('onMenuModal');
var sideMenu_close = document.querySelector('.sideMenu-close');

show_categories_button.onclick = function () {
	document.querySelector('.hidden-sideMenu').classList.toggle('categories-responsive');
	onMenuModal.style.display = 'block';
}

onMenuModal.onclick = close;
sideMenu_close.onclick = close;

function close() {
	onMenuModal.style.display = "none";
	document.querySelector('.hidden-sideMenu').classList.toggle('categories-responsive');

	for (var j = 0; j < childsOfAccordion.length; j++) {
		childsOfAccordion[j].classList.add('list-hidden');
	}
}