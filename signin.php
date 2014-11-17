<?php require 'html_header.php'; ?>
<body>
<?php require 'header.php';?>
<div id="page-wrapper">
    <form action="authenticate.php" method="post" id="recipeForm">
        <div class="row text-center"><h2>Login</h2></div>
        <div class="row">
            <label for="username" class="col-md-2">Username or Email:</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="identity"
                       placeholder="Enter Username or Email">
            </div>
        </div>
        <div class="row">
            <label for="password" class="col-md-2">Password:</label>
            <div class="col-md-9">
                <input type="password" class="form-control" name="password"
                       placeholder="Enter Password">
                <p class="help-block">
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-10" style="padding-left: 35px;">
                <button type="submit" class="btn btn-info">
                    <a class="button-text">Login</a>
                </button>
            </div>
        </div>
    </form>
</div>
<?php if(isset($_GET['status'])): ?>
    <script>
        alert('Sign In Failed');
    </script>
<?php endif; ?>
</body>
<?php require 'html_footer.php'; ?>
