var x = document.getElementById('myTopnav');
var menu = document.getElementById('menu');
menu.onclick = function myFunction() {
	
	if(x.className === "ownTopnav") {
		x.className += " responsive";
		ownModal.style.display = "block";
	}else{
		x.className = "ownTopnav";
	}
}

var ownModal = document.getElementById('ownModal');
var exeDDM = document.getElementById('exeDDM');
var arrow = document.getElementById('arrow');
var dropDownLby = document.getElementById('dropDownLby').onclick = function () {
	if(exeDDM.className === "") {
		exeDDM.className += "exeDDM";
		exeDDM.style.display = "block";
		arrow.innerHTML = '&#9660;';
		ownModal.style.display = "block";
	} else {
		exeDDM.className = "";
		exeDDM.style.display = "none";
		arrow.innerHTML = '&#9668;';
	} 
}

var current_user_profile = document.getElementById('current_user_profile');
var current_user = document.getElementById('current_user').onclick = function () {
	current_user_profile.style.display = "block";
	ownModal.style.display = "block";
} 

ownModal.onclick = function () {
	this.style.display = "none";
	exeDDM.className = "";
	exeDDM.style.display = "none";
	arrow.innerHTML = '&#9668;';
	x.className = "ownTopnav";
	current_user_profile.style.display = "none";
}
