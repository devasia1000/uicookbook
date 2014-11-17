<?php require 'html_header.php';?>
<?php require 'database_interface.php';?>
<?php
$field = $_POST["col"];
$query = $_POST["query"];

$results = array();

if ($field == 'Recipe Name') {
    $results = recipeSearch('', $query, '', '');
}
if ($field == 'User Email') {
    $results = recipeSearch('', '', '', $query);
}
?>
<body>
    <?php require 'header.php';?>
    <div id="page-wrapper">
        <?php if(empty($results)) echo "<h2>" . "No matching results" . "</h2>"; ?>
        <?php $alternator = 0; ?>
        <?php foreach($results as $result) {?>
            <?php if($alternator % 2 == 0) { ?>
                <div style="background-color:#BDBDBD;color:#000000;padding: 20px">
                    <h3 style="margin:0"><b><a href="recipe.php?id=<?php echo $result["recipeid"];?>">
                            <?php echo $result["recipeName"];?>
                    </a></b></h3>
                    By: <?php echo $result["userEmail"];?>
                    <?php $currentRating = getRecipeRating($result["recipeid"]);?>
                    <?php if($currentRating == null) {?> <p>Rating: <?php echo 'Recipe Not Yet Rated';?></p><?php } ?>
                    <?php if($currentRating != null) {?><p>Rating: <?php echo $currentRating;?></p><?php }?>
                </div>
            <?php } else {?>
                <div style="background-color:#757575;color:#000000;padding: 20px">
                    <h3 style="margin:0"><b><a href="recipe.php?id=<?php echo $result["recipeid"];?>">
                        <?php echo $result["recipeName"];?>
                    </a></b></h3>
                    By: <?php echo $result["userEmail"];?>
                    <?php $currentRating = getRecipeRating($result["recipeid"]);?>
                    <?php if($currentRating == null) {?> <p>Rating: <?php echo 'Recipe Not Yet Rated';?></p><?php } ?>
                    <?php if($currentRating != null) {?><p>Rating: <?php echo $currentRating;?></p><?php }?>
                </div>
            <?php }?>
        <?php $alternator++; } ?>
    </div>
</body>
<?php require 'html_footer.php';?>