<?php require 'html_header.php';?>
<body>
    <?php require 'header.php';?>
    <div id="page-wrapper">
        <h1>Search Recipes</h1>

        <div class="container-fluid">
            <form action="results.php" method="post" id="recipeForm">
                <div class="form-group" style="margin-bottom:0;width:18%;float:left;">
                    <select id="search-fields" name="col" class="form-control">
                        <option>Recipe Name</option>
                        <option>User Email</option>
                    </select>
                </div>
                <div class="form-group input-group" style="margin-bottom:0;min-width:70%;">
                    <input id="search-bar" type="text" placeholder = "Search" name="query"
                           class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</body>
<?php require 'html_footer.php';?>