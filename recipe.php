<?php require 'html_header.php'; ?>
<body>
    <?php require 'header.php';?>
    <?php

    require 'database_interface.php';
    // To be used to establish a favorite/rating system; must be logged-in in order to do these.
    if(isset($_SESSION['userEmail'])) {
        $userEmail = $_SESSION['userEmail'];
    }
    else $userEmail = null;

    $recipeID = $_GET["id"];

    $recipe = recipeSearch($recipeID, "", "", "")[0];
    $ingredients = getRecipeIngredients($recipeID)
    ?>
    <script>
        function handleFavorite() {
            var userEmail = "<?php echo $userEmail;?>";
            var recipeId = "<?php echo $recipeID;?>";

            favoriteRecipe(recipeId, userEmail);
            location.reload();
        }
        function handleUnfavorite() {
            var userEmail = "<?php echo $userEmail;?>";
            var recipeId = "<?php echo $recipeID;?>";

            unfavoriteRecipe(recipeId, userEmail);
            location.reload();
        }
    </script>

    <div id="page-wrapper">
        <div class = "container-fluid">
            <h1 style="float: left;text-decoration:underline;"><?php echo $recipe["recipeName"]?> </h1>
            <?php if($userEmail != null) {?>
                <?php if(hasUserFavorited($userEmail, $recipeID)) {?>
                    <button id="nav-bar-home" style="float: left;" type="submit" class="btn btn-info"
                            onclick="handleUnfavorite()">
                        <a class="button-text">Unfavorite</a>
                    </button>
                <?php } else { ?>
                    <button id="nav-bar-home" style="float: left;" type="submit" class="btn btn-info"
                            onclick="handleFavorite()">
                        <a class="button-text">Favorite</a>
                    </button>
                <?php } ?>
            <?php }?>

        </div>
        <h3 style="margin-left:15px;margin-top:35px;margin-bottom:0;">
            By: <?php echo $recipe["userEmail"]; ?>
        </h3>
        <br/>
        <div style="padding-left: 20px">
            <h4 style="text-decoration:underline;margin-top:0;margin-bottom:10px">Ingredients</h4>
            <ul style="padding-left:20px;">
            <?php foreach($ingredients as $ingredient){ ?>
                <li><?php echo $ingredient[1]?> <?php echo $ingredient[0]?></li>
            <?php } ?>
            </ul>
        </div>
        <div style="padding-left: 20px">
            <h4 style="text-decoration:underline;margin-top:0;margin-bottom:10px">Instructions</h4>
            <div><?php echo nl2br($recipe["steps"]); ?></div>
        </div>



    </div>
</body>
<?php require 'html_footer.php';?>