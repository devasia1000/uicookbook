window.onload = function decideButtons() {
	userLoggedIn = confirm('Are you logged in?');

	if(userLoggedIn) {
		document.getElementById("nav-bar-signin").style.display="none";
		document.getElementById("nav-bar-signup").style.display="none";
	}
	else {
		document.getElementById("nav-bar-home").style.display="none";
		document.getElementById("nav-bar-signout").style.display="none";
	}
}