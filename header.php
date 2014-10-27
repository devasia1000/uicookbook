<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">UIUC COOKBOOK</a>
</div>

    <ul class="nav navbar-nav navbar-right navbar-user">
        
 
        <li class = "container-fluid" style="padding-right:5px;">
            <div class="">
                <button id="nav-bar-signin" type="submit" class="btn btn-info">
                    <a class="button-text" href="signin.php">Sign In</a>
                </button>
                <button id="nav-bar-signup" type="submit" class="btn btn-info">
                    <a class="button-text" href="register.php">Sign Up</a>
                </button>
                <button id="nav-bar-home" type = "submit" class = "btn btn-info">
                    <a class="button-text" href = "home.php">Home </a>
                </button>
                <button id="nav-bar-signout" type = "submit" class = "btn btn-info">
                    <a class="button-text" href = "index.php">Sign Out</a>
                </button>
            </div>
        <li class="divider-horizontal"></li>
        <li>
            <div class="navbar-search" style="padding-right:0px;">
                <select class="form-control" style="margin-bottom:0px;">
                    <option>Recipe Name</option>
                    <option>Author</option>
                    <option>Ingredient</option>
                </select>
            </div>
        </li>
        <li>
            <form class="navbar-search">
                <input type="text" placeholder="Search" class="form-control">
            </form>
        </li>
    </ul>
</div>
</nav>