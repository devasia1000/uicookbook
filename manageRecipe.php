<?php require 'html_header.php'; ?>
    <body>
        <?php require 'header.php';?>
        <?php
        require 'database_interface.php';
        if(isset($_SESSION['userEmail'])) {
            $userEmail = $_SESSION['userEmail'];
        }
        else {
            echo "This page can only be accessed if you're logged in";
            exit;
        }

        if (isset($_GET["id"]) ) {
            $recipeID = $_GET["id"];
        }
        else $recipeID = null;

        if ($recipeID != null) {
            $recipe = recipeSearch($recipeID, "", "", "")[0];
            $ingredients = getRecipeIngredients($recipeID);
        }
        ?>
        <div id="page-wrapper">

            <form action="<?php if($recipeID == null) echo "addRecipe.php"; else echo "updateRecipe.php"?>"
                  method="post" id="recipeForm">
                <?php if($recipeID != null) { ?>
                    <input type="hidden" name="recipeID" value="<?php echo $recipeID;?>">
                <?php } ?>
                <table>
                    <tr>
                        <td colspan="2">
                            <label for="recipeName">
                                Recipe Name:
                            </label>
                            <input type="text" name="recipeName"
                                   <?php
                                    if(isset($recipe)) {
                                        echo 'value="' . $recipe["recipeName"] . '" ';
                                        echo "readonly";
                                    }
                                    ?>><br>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="ingredients">Ingredients</label></td>
                        <td><label for="ingredients">Amount</label></td>
                    </tr>
                    <?php $i =0;?>
                    <?php if(isset($ingredients)) { foreach($ingredients as $ingredient) { ?>
                        <tr>
                            <td>
                                <input name="ingredients[<?php echo $i; ?>][name]" type="text"
                                    value="<?php echo $ingredient[0];?>" size="30">
                            </td>
                            <td>
                                <input name="ingredients[<?php echo $i; ?>][amount]" type="text"
                                       size="20" value="<?php echo $ingredient[1];?>">
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php } } ?>
                    <?php for(; $i < 12; $i++) { ?>
                    <tr>
                        <td>
                            <input name="ingredients[<?php echo $i; ?>][name]" type="text" size="30">
                        </td>
                        <td>
                            <input name="ingredients[<?php echo $i; ?>][amount]" type="text" size="20">
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <label for="steps" style="color: #ffffff">
                    Steps:
                </label><br/>
                <textarea name="steps" form="recipeForm" rows="20" cols="100"><?php
                    if(isset($recipe)) {
                        echo $recipe["steps"];
                    }
                    ?></textarea>
                <br/>
                <input type="submit" class="btn btn-info btn-text" style="color:#ffffff"
                       value="<?php if($recipeID == null) echo "Add Recipe"; else echo "Submit"?>"
                    >
            </form>
        </div>
    </body>
<?php require 'html_footer.php';?>