<?php
require $_SERVER['DOCUMENT_ROOT'] . '/html_header.php';
?>
<body>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
    ?>
    <div id="page-wrapper">
        <h1>
            You are now looking at recipe with id number equal to:
            <?php
                echo $_GET["id"];
            ?>
        </h1>
    </div>
</body>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/html_footer.php';
?>