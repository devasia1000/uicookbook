<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/html_header.php';  // Works on Server
require 'html_header.php';
?>
<body>
<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
require 'header.php';
?>
<script>
    function handleAuthentication() {
        var loginID = $("#identity").val();
        var password = $("#password").val();
        var result = checkLogin(loginID, password);
        if(result === "1") {
            alert("Success");
            parent.location='home.php';
        }
        else {
            alert("Fail");
        }
    }
</script>
<div id="page-wrapper">
    <div class="row text-center">
        <h2>Login</h2>
    </div>
    <div>
        <label for="username" class="col-md-2">
            Username or Email:
        </label>
        <div class="col-md-9">
            <input type="username" class="form-control" id="identity" placeholder="Enter username / email">
        </div>
    </div>
    <div>
        <label for="password" class="col-md-2">
            Password:
        </label>
        <div class="col-md-9">
            <input type="password" class="form-control" id="password" placeholder="Enter Password">
            <p class="help-block">
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
            <button type="submit" class="btn btn-primary" onclick="handleAuthentication()">
                <a class="bullshit"><font color = "black">Sign-In</font></a>
            </button>
        </div>
    </div>
</div>
</body>
<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/html_footer.php';
require 'html_footer.php';
?>
