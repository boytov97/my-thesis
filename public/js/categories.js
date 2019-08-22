window.FontAwesomeConfig = {searchPseudoElements: true};

var show_categories_button = document.querySelector('.categories-show-button');
var onMenuModal = document.getElementById('onMenuModal');

show_categories_button.onclick = function () {
	document.querySelector('.hidden-sideMenu').classList.toggle('categories-responsive');
	onMenuModal.classList.toggle('onMenuModalResponsive');
}

onMenuModal.onclick = close;

function close() {
	onMenuModal.classList.toggle('onMenuModalResponsive');
	document.querySelector('.hidden-sideMenu').classList.toggle('categories-responsive');
}

$(document).ready(function () {
	$('.parent_list').click(function () {
		$(this).toggleClass('in');

		var child_class = '.child' + $(this).attr('class').split(' ')[1];
		$(child_class).slideToggle();
	});
});