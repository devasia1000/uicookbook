<?php require 'html_header.php'; ?>
<?php require 'database_interface.php'; ?>
<body>
<?php require 'header.php';?>
<div id="page-wrapper">
    <?php
    if(!isset($_SESSION['userEmail'])) {
        echo "This page can only be accessed if you're logged in";
        exit;
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1>Homepage - UI Cookbook</h1>
        </div>
    </div>
    <!-- #################################### YOUR RECIPES  #################################### -->
    <div class="column">
    <?php $recipes = getUserRecipes($_SESSION['userEmail']);?>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"> Your Recipes</h3>
            </div>
            <div class="panel-body feed">
                <?php foreach ($recipes as $recipe) { ?>
                    <section class="feed-item">
                        <div class="feed-item-body">
                            <a href="recipe.php?id=<?php echo $recipe["recipeid"];?>">
                                <?php echo $recipe["recipeName"];?>
                            </a>
                           <button type="button" class="btn btn-info"
                                   onclick="parent.location='manageRecipe.php?id=<?php echo $recipe["recipeid"];?>'">
                                <a class="button-text">Edit</a>
                            </button>
                            <button type = "button" class = "btn btn-info" onclick ="handleDelete('<?php echo $recipe["recipeid"];?>')">
                                <a class="button-text">Delete</a>
                            </button>
                            Rating:
                            <?php
                            $recipeRating = getRecipeRating($recipe["recipeid"]);
                            if ($recipeRating != null) {
                                echo $recipeRating;
                            } else echo "Not Yet Rated";
                            ?>
                        </div>
                    </section>
                <?php } ?>
            </div>
            <button type = "button" id="addRecipe" class = "btn btn-info button-text"
                    onclick="parent.location='manageRecipe.php'">
             Add
            </button>
        </div>
    </div>
    </div>
    <script>
    function handleDelete(recipeid) {
        deleteRecipe(recipeid);
        alert("Recipe has been deleted");
        location.reload();
    }
    </script>
    <!-- #################################### FAVORITES #################################### -->
    <div class="column">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> Favorites</h3>
                </div>
                <div class="panel-body feed">
                    <?php $thisUsersFavorites = getUserFavorites($_SESSION['userEmail']);
                        foreach($thisUsersFavorites as $row) { ?>
                        <a href="recipe.php?id=<?php echo $row["recipeID"];?>">
                            <?php echo $row["recipeName"];?>
                        </a><br/>
                     <?php } ?>
                    <section class="feed-item">
                        <div class="feed-item-body">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- #################################### Shopping List #################################### -->
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"> Your Shopping List</h3>
            </div>
            <div class="panel-body feed">
                <?php if(isset($_SESSION["shopping_list"])) { ?>
                    <?php
                    foreach($_SESSION["shopping_list"] as $id => $name) { ?>
                        <a href="recipe.php?id=<?php echo $id;?>"><?php echo $name?></a>
                        <br/>
                    <?php } ?>
                <?php } ?>
            </div>
            <?php if(isset($_SESSION["shopping_list"])) { ?>
                <button type = "submit" id="generateSL" class = "btn btn-info button-text" onclick="parent.location='shoppinglist.php'">
                    Generate
                </button>
                <button type = "submit" id="removeSL" class = "btn btn-info button-text" style="float: right;" onclick="parent.location='removeallsl.php'">
                    Delete Entire Shopping List
                </button>
            <?php } ?>
        </div>
    </div>
</div>


</body>
<?php require 'html_footer.php';?>