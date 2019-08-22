var answer_link = document.querySelectorAll('.answer-link');
var commit_input = document.querySelector('.commit-input');

for(var i = 0; i < answer_link.length; i++) {
	answer_link[i].onclick = input_focus;
}

function input_focus() {
	document.querySelector('#getter_name').value = this.nextElementSibling.innerHTML;
	commit_input.focus();
}

var commit_button = document.querySelector('#commit-button');
commit_input.onkeyup = function () {
	if (this.value.length > 0 && this.value.length != null) {
		commit_button.disabled = false;
	} else {
		commit_button.disabled = true;
	}

	var x = this.value.replace(/&/g, '&amp;')
		.replace(/>/g, '&gt;')
		.replace(/</g, '&lt;')
		.replace(/ /g, '&nbsp;')
		.replace(/\n/g, '<br>');

	document.querySelector('.clone-textarea-commit').innerHTML =  x + '&nbsp;';
	this.style.height = (document.querySelector('.clone-textarea-commit').offsetHeight) + "px";
}

commit_input.onfocus = function () {
	document.querySelector('.textarea-block').style.borderBottomColor = '#007BFF';
}

commit_input.addEventListener('blur', function () {
	document.querySelector('.textarea-block').style.borderBottomColor = '#cccccc';
});

var commit_count = document.querySelector('.commit-count');
commit_count.onclick = function () {
	document.querySelector('.commits-block').classList.toggle('commits-block-hidden');
}