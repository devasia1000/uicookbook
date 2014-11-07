<?php
//    require $_SERVER['DOCUMENT_ROOT'] . '/html_header.php';
//    require $_SERVER['DOCUMENT_ROOT'] . '/database_interface.php';
    require 'html_header.php';
    require 'database_interface.php';

?>

<?php
if (isset($_SESSION['userEmail'])) {
    $GLOBALS['userEmail'] = $_SESSION['userEmail'];
}
?>

<body>
<script>
   
</script>

<style>
.ui-widget {
    font-family: Verdana,Arial,sans-serif;
    font-size: .8em;
}

.ui-widget-content {
    background: #F9F9F9;
    border: 2px solid #2a9fd6;
    color: #222222;
}

.ui-dialog {
    left: 0;
    height: 300px;
    outline: 0 none;
    padding: 0 !important;
    position: absolute;
    top: 0;
}

#addRecipeDialog {
    padding: 0;
    margin: 0; 
}

.ui-dialog .ui-dialog-content {
    background: none repeat scroll 0 0 transparent;
    border: 0 none;
    overflow: auto;
    position: relative;
    padding: 0 !important;
}

.ui-widget-header {
    background: #2a9fd6;
    border: 0;
    color: #fff;
    font-weight: normal;
}

.ui-dialog .ui-dialog-titlebar {
    height: 40px;
    padding: 0.1em .5em;
    position: relative;
    font-size: 2em;
}

.ui-corner-all {
    border-radius: 0px;
}

</style>
    <?php
    // require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
    require 'header.php';
    ?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Homepage - UI Cookbook</h1>
        </div>
    </div>




    <div class="column">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> Your Recipes</h3>
                </div>
                <div class="panel-body feed">
                    <?php 
                    
                    // echo checkLogin('devasia', 'password1');
                    $recipeTitle = 'Ramen';
                    $recipes = getUserRecipes($GLOBALS['userEmail']);
                    foreach ($recipes as $recipe) {
                        echo '<section class="feed-item"><div class="feed-item-body">';
                                
                                echo '<a href="recipe.php?id=';
                                echo $recipe["recipeid"];
                                echo '">';
                                                                echo $recipe["recipeName"];
                                                                echo "    ";
                               echo '</a>';
                                
                               $echoString = 
               '<button type="button" class="btn btn-info" onclick ="handleEdit(\'' . $recipe["recipeid"] . '\')">
                    <a class="button-text">Edit</a>
                </button>
                <button type = "button" class = "btn btn-info" onclick ="handleDelete(\'' . $recipe["recipeid"] . '\')">
                    <a class="button-text">Delete</a>
                </button>';
                
                	echo $echoString;
                        echo '</div></section>';
                    } 
                    ?>
                    <section class="feed-item">
                        <div class="feed-item-body">
                        
                        </div>
                    </section>
                    
                </div>
                <button type = "button" id="addRecipe" class = "btn btn-info button-text">
                 Add
             </button>
            </div>
        </div>
    </div>
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

<script>

function handleEdit(recipeid) {
	var results = searchRecipe (recipeid, '', '', '').split(";;;");
	var recipeName = results[1];
	var recipeSteps = results[2];

	$("#dialog_submitChanges").off("click");
	$("#dialog_submitChanges").click({id: recipeid}, submitEditHandler);
	$("#editRecipeDialog").dialog("open");
	$("#editName").val(recipeName);
	$("#editSteps").val(recipeSteps);

    results = getRecipeIngredients(recipeid);

    var ingredients = results.split("///");
    for (var i = 0; i < ingredients.length; i++) {
        var ingredient = ingredients[i].split(";;;");

        $("#edit_ingredient_name_" + (i + 1)).val(ingredient[0]);
        $("#edit_ingredient_amount_" + (i + 1)).val(ingredient[1]);
    }
}

function submitEditHandler(event) {
	var userEmail = "<?php echo $GLOBALS['userEmail'];?>";
    var recipeId = event.data.id;
	var recipeName = $("#editName").val();
	var recipeSteps = $("#editSteps").val();

    updateRecipe (recipeId, recipeName, recipeSteps, userEmail);

    for(var i = 1; i <= 10; i++) {
        var recipeIngredientName = $("#edit_ingredient_name_" + i).val();
        var recipeIngredientAmount = $("#edit_ingredient_amount_" + i).val();

        if (recipeIngredientAmount !== "" && recipeIngredientName !== "") {
            if (recipeIngredientAmount == 0) {
                deleteIngredient(recipeId, recipeIngredientName);
            }
            else {
                updateIngredient(recipeId, recipeIngredientName, recipeIngredientAmount)
            }
        }
    }

	alert("Your recipe has been updated");
	location.reload();
}

</script>

<script>


$(document).ready( function(){
// Setup this div as a Dialog
$('#addRecipeDialog').dialog({
    autoOpen: false,
    width: 600,
    height: 500,
    modal: true,
    resizable: false,
    buttons: {
        "Submit": function() {
            var userEmail = "<?php echo $GLOBALS['userEmail'];?>";
            var recipeName = $("#addName").val();
            var recipeSteps = $("#addSteps").val();

            insertRecipe(recipeName, recipeSteps, userEmail);

            var recipeID = searchRecipe("", recipeName, recipeSteps, userEmail).split(";;;")[0];

            for(var i = 1; i <= 10; i++) {
                var recipeIngredientName = $("#add_ingredient_name_" + i).val();
                var recipeIngredientAmount = $("#add_ingredient_amount_" + i).val();

                if (recipeIngredientAmount !== "" && recipeIngredientName !== "") {
                    insertIngredient(recipeID, recipeIngredientName, recipeIngredientAmount)
                }
            }
            

            alert("Recipe Added");
            
            location.reload();           
        }
    },
    dialogClass: 'ui-dialog'
    });
    
$('#editRecipeDialog').dialog({
    autoOpen: false,
    width: 600,
    modal: true,
    resizable: false,
    buttons: {
        "Submit Changes": function() {}
    },
    dialogClass: 'ui-dialog'
    });
   
   $('.ui-dialog-buttonpane button:contains("Submit Changes")').attr("id", "dialog_submitChanges"); 
});

$('#addRecipe').click( function() { 
    $("#addRecipeDialog").dialog("open");
});




</script>
        <!--   
            <div class="column">
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Favorites</h3>
                        </div>
                        <div class="panel-body feed">
                            <section class="feed-item">
                                <div class="feed-item-body">
                                </div>
                            </section>
                            <section class="feed-item">
                                <div class="icon pull-left">
                                </div>
                                <div class="feed-item-body">
                                </div>
                            </section>
                            <section class="feed-item">
                                <div class="icon pull-left">
                                </div>
                                <div class="feed-item-body">
                                </div>
                            </section>

                            <section class="feed-item">
                                <div class="feed-item-body">
                                </div>
                            </section>
                            <section class="feed-item">

                            </section>
                            <section class="feed-item">
                                <div class="icon pull-left">
                                </div>
                                <div class="feed-item-body">
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> One-Click Shopping List</h3>
                        </div>
                        <div class="panel-body feed">
                            <section class="feed-item">
                                <div class="feed-item-body">
                                </div>
                            </section>
                            <section class="feed-item">
                                <div class="icon pull-left">
                                </div>
                                <div class="feed-item-body">
                                </div>
                            </section>
                            <section class="feed-item">
                                <div class="icon pull-left">
                                </div>
                                <div class="feed-item-body">
                                </div>
                            </section>

                            <section class="feed-item">
                                <div class="feed-item-body">
                                </div>
                            </section>
                            <section class="feed-item">

                            </section>
                            <section class="feed-item">
                                <div class="icon pull-left">
                                </div>
                                <div class="feed-item-body">
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div> -->
</body>
<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/html_footer.php';
require 'html_footer.php';
?>