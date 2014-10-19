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