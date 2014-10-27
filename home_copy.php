<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/html_header.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/database_interface.php';
    $GLOBALS['userEmail'] = 'rfarias2@illinois.edu';
?>


<body>


<style>
.ui-widget {
    font-family: Verdana,Arial,sans-serif;
    font-size: .8em;
}

.ui-widget-content {
    background: #F9F9F9;
    border: 2px solid #00bcd4;
    color: #222222;
}

.ui-dialog {
    left: 0;
    height: 1000px;
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
    background: #00bcd4;
    border: 0;
    color: #fff;
    font-weight: normal;
}

.ui-dialog .ui-dialog-titlebar {
    height: 35px;
    padding: 0.1em .5em;
    position: relative;
    font-size: 2em;
}

.ui-corner-all {
    border-radius: 0px;
}



</style>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
    ?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>HomePage - UI Cookbook</h1>
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
                               echo '</a>';
                                
                                $echoString = '<button type="button" class="btn btn-info">
                    <a class="button-text" href="register.php">Edit</a>
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
                <button type = "button" id="addRecipe" class = "btn btn-info button-text" onclick="handleClick()">
                 Add
             </button>
            </div>
        </div>
    </div>
<div id="addRecipeDialog" title="Add a Recipe">
    </button>
</div>

<script>

function handleDelete(recipeid) {
	deleteRecipe(recipeid);
	alert("Recipe has been deleted");
	location.reload();
}

</script>

<script>

$(document).ready( function(){
// Setup this div as a Dialog
$('#addRecipeDialog').dialog({
    autoOpen: false,
    width: 600,
    modal: true,
    buttons: {
        "Submit": function() {
            $(this).dialog("close");
        },
        "Cancel": function() {
            $(this).dialog("close");
        }
    },
    dialogClass: 'ui-dialog'
    });
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
require $_SERVER['DOCUMENT_ROOT'] . '/html_footer.php';
?>