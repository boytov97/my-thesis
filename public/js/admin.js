var ownModal = document.getElementById('ownModal');

var current_user_profile = document.getElementById('current_user_profile');
var current_user = document.getElementById('current_user').onclick = function () {
	current_user_profile.style.display = "block";
	ownModal.style.display = "block";
} 

ownModal.onclick = function () {
	this.style.display = "none";
	current_user_profile.style.display = "none";
}

$(document).ready(function () {
	$('.panel_heading').click(function () {
		$(this).toggleClass('in');
		$(this).next().slideToggle();
	});
});

var changeImg = function (){
    $('.check_img_name').html($('#input_image').get(0).files[0].name);
}

$('#input_image').change(changeImg);

var changeFile = function (){
	$('.check_file_name').html($('#input_file').get(0).files[0].name);
}

$('#input_file').change(changeFile);

$('.destroyIcon').on('click', function() {
	$(this).next().slideToggle();
});

$('.stop_action').on('click', function() {
	$(this).parent().parent().slideToggle();
});

$('.destroyImageIcon').on('click', function() {
	$('.destroy_image_modal').slideToggle();
});

$('.destroyFileIcon').on('click', function() {
	$('.destroy_file_modal').slideToggle();
});

$('.stop_ImageAction').on('click', function() {
	$('.destroy_image_modal').slideToggle();
});

