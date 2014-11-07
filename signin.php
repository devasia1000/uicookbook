<?php
require 'html_header.php';
?>
<body>
<?php
require 'header.php';
?>
<script>
    function handleAuthentication() {
        var loginID = $("#identity").val();
        var password = $("#password").val();
        parent.location = 'authenticate.php?identityToken=' + loginID + "&password=" +password;
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
            <input type="username" class="form-control" id="identity" placeholder="Enter Username or Email">
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
        <div class="col-md-10" style="padding-left: 35px;">
            <button type="submit" class="btn btn-info" onclick="handleAuthentication()">
                <a class="button-text">Login</a>
            </button>
        </div>
    </div>
</div>
<?php if(isset($_GET['status'])): ?>
    <script>
        alert('Sign In Failed');
    </script>
<?php endif; ?>
</body>
<?php
require 'html_footer.php';
?>
