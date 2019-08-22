var pmenu_header = document.querySelector('.pmenu-header');
var menu_list = document.querySelector('.menu-list');

pmenu_header.onclick = function () {
	menu_list.classList.toggle('list-hidden');
}