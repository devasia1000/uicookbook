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
    $recipeRating = getRecipeRating($recipeID);

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
    <script>
        function handleRate() {
            var userEmail = "<?php echo $userEmail;?>";
            var recipeID = "<?php echo $recipeID;?>";
            var rating = $("#rating-fields").val();

            if (rating == "N/A") {
                alert("You must select a rating in order to rate a recipe.");
                return;
            }

            rateRecipe(recipeID, userEmail, rating);
            location.reload();
        }
    </script>
    <script>
        function handleAddToSL(){
            var recipeName = "<?php echo $recipe["recipeName"];?>";
            var recipeID = "<?php echo $recipeID;?>";
            parent.location = 'addsl.php?recipeName=' + recipeName + '&id=' + recipeID;
        }
        function handleRemoveFromSL() {
            var recipeName = "<?php echo $recipe["recipeName"];?>";
            var recipeID = "<?php echo $recipeID;?>";
            parent.location = 'removesl.php?recipeName=' + recipeName + '&id=' + recipeID;
        }
    </script>

    <div id="page-wrapper">
        <div class = "container-fluid">
            <h1 style="float: left;text-decoration:underline;"><?php echo $recipe["recipeName"]?> </h1>
            <?php if($userEmail != null) {?>
                <?php if(hasUserFavorited($userEmail, $recipeID)) {?>
                    <button id="nav-bar-home" style="float: left; margin-left: 10px;" type="submit" class="btn btn-info"
                            onclick="handleUnfavorite()">
                        <a class="button-text">Unfavorite</a>
                    </button>
                <?php } else { ?>
                    <button id="nav-bar-home" style="float: left; margin-left: 10px;" type="submit" class="btn btn-info"
                            onclick="handleFavorite()">
                        <a class="button-text">Favorite</a>
                    </button>
                <?php } ?>
                <?php if(isset($_SESSION["shopping_list"][$recipeID])) {?>
                    <button id="remove-from-SL" style="margin-left: 10px;" type="submit" class="btn btn-info" onclick="handleRemoveFromSL()">
                        <a class="button-text">Remove From Shopping List</a>
                    </button>
                <?php } else { ?>
                    <button id="add-to-SL" style="margin-left: 10px;" type="submit" class="btn btn-info" onclick="handleAddToSL()">
                            <a class="button-text">Add to Shopping List</a>
                    </button>
                <?php } ?>
            <?php }?>

        </div>
        <h3 style="margin-left:15px;margin-top:35px;margin-bottom:0;">Rating:
            <?php
            if ($recipeRating != null) {
                echo $recipeRating;
            } else echo "Not Yet Rated";
            ?></h3>
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
        <br/>
        <?php if($userEmail == null) {?>
            <h3 style="padding-left: 20px;">Like This Recipe?  Sign in to rate recipes!  It's free! </h3>
        <?php } ?>
        <?php if($userEmail != null) {?>
            <h3 style="padding-left: 20px;">Like This Recipe?  Rate it below: </h3>
            <div class="container-fluid">
                <div class="form-group" style="margin-bottom:0;width:100px;float:left;margin-left: 5px;">
                    <?php $myRating = getUserRating($userEmail, $recipeID);?>
                    <select id="rating-fields" class="form-control">
                        <?php if($myRating == null) { ?>
                            <option selected="selected">N/A</option>
                        <?php } ?>
                        <?php for($i=5; $i > 0; $i--) { ?>
                            <option <?php if($myRating == $i) { ?><?php echo 'selected="selected"';?><?php }?> ><?php echo $i?></option>
                        <?php } ?>
                    </select>
                </div>
                <button id="rate recipe submit" type = "button" class = "btn btn-info" onclick="handleRate()">
                    <i class="button-text"> Submit Rating </i>
                </button>
             </div>
        <?php } ?>

    </div>
</body>
<?php require 'html_footer.php';?>