<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 16.11.2014
 * Time: 19:21
 */
?>
<?php require 'database_interface.php';?>
<?php require 'html_header.php';?>
<?php require 'header.php';?>
<?php
//$results = array();
$results = listIngredients($_SESSION["shopping_list"]);
?>

<body>
    <div id="page-wrapper">
        <div class="col-lg-12">
            <h1>Shopping List</h1>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="col-lg-12">
            <table>
                <tr>
                    <td style="padding-right: 20px; margin-left: 20px;">
                        <b>Ingredient:</b>
                    </td>
                    <td>
                        <b>Amount:</b>
                    </td>
                <?php foreach($results as $result) { ?>
                    <tr>
                        <td style="padding-right: 20px; margin-left: 20px;">
                            <?php echo $result["ingredientName"];?>
                        </td>
                        <td>
                            <?php echo $result["amount"];?>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </div>
</body>
<?php require 'html_footer.php';?>
