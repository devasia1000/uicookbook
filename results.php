<?php require 'html_header.php';?>
<?php require 'database_interface.php';?>
<?php
$field = $_GET["col"];
$query = $_GET["query"];

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
        <?php $alternator = 0; ?>
        <?php foreach($results as $result) {?>
            <?php if($alternator % 2 == 0) { ?>
                <div style="background-color:#BDBDBD;color:#000000;padding: 20px">
                    <h3 style="margin:0"><b><a href="recipe.php?id=<?php echo $result["recipeid"];?>">
                            <?php echo $result["recipeName"];?>
                    </a></b></h3>
                    By: <?php echo $result["userEmail"];?>
                </div>
            <?php } else {?>
                <div style="background-color:#757575;color:#000000;padding: 20px">
                    <h3 style="margin:0"><b><a href="recipe.php?id=<?php echo $result["recipeid"];?>">
                        <?php echo $result["recipeName"];?>
                    </a></b></h3>
                    By: <?php echo $result["userEmail"];?>
                </div>
            <?php }?>
        <?php $alternator++; } ?>
    </div>
</body>
<?php require 'html_footer.php';?>