function setCookie(cookieName, cookieValue, daysToExpire)
{
	var d = new Date();
	d.setTime(d.getTime() + (daysToExpire*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cookieName + "=" + cookieValue + "; " + expires + "; path=/";
}

function getCookie(cookieName)
{
	var name = cookieName + "=";
	var cookieArray = document.cookie.split(';');
	for (var i=0; i < cookieArray.length; i++)
	{
		var c = cookieArray[i];
		while (c.charAt(0) == ' ')
			c = c.substring(1);
		if (c.indexOf(name) != -1)
			return c.substring(name.length, c.length); // Found Cookie
	}
	return ""; // Cookie Not Found
}

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