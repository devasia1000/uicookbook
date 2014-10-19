function checkCookie()
{
	var username = getCookie("username");
	if (username != "" && username != NULL)
		alert("Welcome again, you lazy sloth " + username);
	else
	{
		username = prompt("Please enter your name:", "");
		while (username == "" || username == NULL)
		{
			alert("Ray, stop trying to break my program!!");
			username = prompt("Please enter a valid name:", "");
		}
		setCookie("username", username, 365);
	}
}