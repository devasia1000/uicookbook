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
        var confirm = $("#confirm").val();

        var result = registerUser(username, emailAddress, password, confirm);
        if(!result) {
            return;
        }
        alert("Successfully Registered");
        // take to login page
        parent.location='signin.php'
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
                <input type="username" class="form-control" id="username" placeholder="Enter Username">
            </div>
        </div>
        <div>
            <label for="emailAddress" class="col-md-2">
                Email Address:
            </label>
            <div class="col-md-9">
                <input type="email" class="form-control" id="emailAddress" placeholder="Enter Email Address">
            </div>
        </div>
        <div>
            <label for="password" class="col-md-2">
                Password:
            </label>
            <div class="col-md-9">
                <input type="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
        </div>
        <div>
            <label for="password" class="col-md-2">
                Confirm Password:
            </label>
            <div class="col-md-9">
                <input type="password" class="form-control" id="confirm" placeholder="Confirm Password">
                <p class="help-block">
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-10" style="padding-left: 35px;">
                <button type="submit" class="btn btn-info" onclick="handleRegister()">
                    <a class="button-text">Register</a>
                </button>
            </div>
        </div>
    </div>
</body>
<?php require 'html_footer.php'; ?>
