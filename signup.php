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
    function handleRegister() {
        var username = $("#username").val();
        var emailAddress = $("#emailAddress").val();
        var password = $("#password").val();
        var result = registerUser(username, emailAddress, password);
        if(!result) {
            return;
        }
        alert("Successfully Registered");
        // take to login page
        parent.location='login.php'
    }
</script>
    <div id="page-wrapper">
        <div class="row text-center">
            <h2>Sign Up</h2>
        </div>
        <div>
            <label for="username" class="col-md-2">
                Username:
            </label>
            <div class="col-md-9">
                <input type="username" class="form-control" id="username" placeholder="Enter username">
            </div>
        </div>
        <div>
            <label for="emailaddress" class="col-md-2">
                Email Address:
            </label>
            <div class="col-md-9">
                <input type="email" class="form-control" id="emailAddress" placeholder="Enter email address">
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
                <button type="submit" class="btn btn-primary" onclick="handleRegister()">
                    <a class="bullshit"><font color = "black">Register</font></a>
                </button>
            </div>
        </div>
    </div>
</body>
<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/html_footer.php';
require 'html_footer.php';
?>
