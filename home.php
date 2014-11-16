<?php require 'html_header.php'; ?>
<?php require 'database_interface.php'; ?>



<body>
<?php require 'header.php';?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Homepage - UI Cookbook</h1>
        </div>
    </div>
    <!-- #################################### YOUR RECIPES  #################################### -->
    <div class="column">
<<<<<<< HEAD
        <?php $recipes = getUserRecipes($GLOBALS['userEmail']);?>
=======

<!-- YOUR RECIPES -->
<?php $recipes = getUserRecipes($_SESSION['userEmail']);?>
>>>>>>> origin/master
        <div class="col-md-6">
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
                                Rating: <?php echo getRecipeRating($recipe["recipeid"]);?>
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
<<<<<<< HEAD
    <script>
    function handleDelete(recipeid) {
        deleteRecipe(recipeid);
        alert("Recipe has been deleted");
        location.reload();
    }
    </script>
=======
    <!-- YOUR RECIPES -->
    <!-- #################################### DIALOGS #################################### -->
<div id="addRecipeDialog" title="Add a Recipe">
    <div style="padding:10px;">
        <b>Recipe Name:</b></br>
        <input id="addName"></input>
        <hr style="height:2px;border:none;background-color:#2a9fd6;">
        <table style="color: #000000;">
            <tr style="color: #ffffff;background-color:#2a9fd6">
                <td> #</td>
                <td> Ingredient</td>
                <td> Amount</td>
                <td> #</td>
                <td> Ingredient</td>
                <td> Amount</td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">1</td>
                <td><input id="add_ingredient_name_1"/></td>
                <td><input id="add_ingredient_amount_1" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">6</td>
                <td><input id="add_ingredient_name_6"/></td>
                <td><input id="add_ingredient_amount_6" size="4"/></td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">2</td>
                <td><input id="add_ingredient_name_2"/></td>
                <td><input id="add_ingredient_amount_2" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">7</td>
                <td><input id="add_ingredient_name_7"/></td>
                <td><input id="add_ingredient_amount_7" size="4"/></td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">3</td>
                <td><input id="add_ingredient_name_3"/></td>
                <td><input id="add_ingredient_amount_3" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">8</td>
                <td><input id="add_ingredient_name_8"/></td>
                <td><input id="add_ingredient_amount_8" size="4"/></td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">4</td>
                <td><input id="add_ingredient_name_4"/></td>
                <td><input id="add_ingredient_amount_4" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">9</td>
                <td><input id="add_ingredient_name_9"/></td>
                <td><input id="add_ingredient_amount_9" size="4"/></td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">5</td>
                <td><input id="add_ingredient_name_5"/></td>
                <td><input id="add_ingredient_amount_5" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">10</td>
                <td><input id="add_ingredient_name_10"/></td>
                <td><input id="add_ingredient_amount_10" size="4"/></td>
            </tr>
        </table>
        <hr style="height:2px;border:none;background-color:#2a9fd6;">
        <b>Steps:</b>  </br>
        <textarea id="addSteps" rows="10" cols="75">
I am a text area for steps.
        </textarea>
    </div>
</div>

<div id="editRecipeDialog" title="Edit a Recipe">
    <div style="padding:10px;">
        <b>Recipe Name:</b></br>
        <input id="editName"></input>
        <hr style="height:2px;border:none;background-color:#2a9fd6;">
        Input amount 0 to delete ingredient.
        <table style="color: #000000;">
            <tr style="color: #ffffff;background-color:#2a9fd6">
                <td> #</td>
                <td> Ingredient</td>
                <td> Amount</td>
                <td> #</td>
                <td> Ingredient</td>
                <td> Amount</td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">1</td>
                <td><input id="edit_ingredient_name_1"/></td>
                <td><input id="edit_ingredient_amount_1" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">6</td>
                <td><input id="edit_ingredient_name_6"/></td>
                <td><input id="edit_ingredient_amount_6" size="4"/></td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">2</td>
                <td><input id="edit_ingredient_name_2"/></td>
                <td><input id="edit_ingredient_amount_2" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">7</td>
                <td><input id="edit_ingredient_name_7"/></td>
                <td><input id="edit_ingredient_amount_7" size="4"/></td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">3</td>
                <td><input id="edit_ingredient_name_3"/></td>
                <td><input id="edit_ingredient_amount_3" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">8</td>
                <td><input id="edit_ingredient_name_8"/></td>
                <td><input id="edit_ingredient_amount_8" size="4"/></td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">4</td>
                <td><input id="edit_ingredient_name_4"/></td>
                <td><input id="edit_ingredient_amount_4" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">9</td>
                <td><input id="edit_ingredient_name_9"/></td>
                <td><input id="edit_ingredient_amount_9" size="4"/></td>
            </tr>
            <tr>
                <td style="color: #000000;background-color:#d9d9d9">5</td>
                <td><input id="edit_ingredient_name_5"/></td>
                <td><input id="edit_ingredient_amount_5" size="4"/></td>
                <td style="color: #000000;background-color:#d9d9d9">10</td>
                <td><input id="edit_ingredient_name_10"/></td>
                <td><input id="edit_ingredient_amount_10" size="4"/></td>
            </tr>
        </table>
        <hr style="height:2px;border:none;background-color:#2a9fd6;">
        <b>Steps:</b>  </br>
        <textarea id="editSteps" rows="10" cols="75">
I am a text area for steps.
        </textarea>
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
        <div class="col-md-6">
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
    <!-- #################################### RATINGS #################################### -->



</body>
<?php require 'html_footer.php';?>