<?php require 'html_header.php'; ?>
<body>
    <?php require 'header.php';?>
    <?php

    require 'database_interface.php';
    // To be used to establish a favorite/rating system; must be logged-in in order to do these.
    if(isset($_SESSION['userEmail'])) {
        $username = $_SESSION['userEmail'];
    }
    else $username = null;

    $recipeID = $_GET["id"];

    $recipe = recipeSearch($recipeID, "", "", "")[0];
    $ingredients = getRecipeIngredients($recipeID)
    ?>
    <div id="page-wrapper">
        <div class = "container-fluid">
            <h1 style="float: left;text-decoration:underline;"><?php echo $recipe["recipeName"]?> </h1>
            <h3 style="float: left;margin-left:15px;margin-top:35px;margin-bottom:0;">
                By: <?php echo $recipe["userEmail"]; ?>
            </h3>
        </div>
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