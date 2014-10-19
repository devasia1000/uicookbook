function setCookie(cookieName, cookieValue, daysToExpire)
{
	var d = new Date();
	d.setTime(d.getTime() + (daysToExpire*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cookieName + "=" + cookieValue + "; " + expires;
}