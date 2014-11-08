<?php require 'html_header.php';?>
<body>
    <?php require 'header.php';?>
    <script type="text/javascript">
    	function handleSearch() {
            var field = document.getElementById("search-fields").value;
            var search = document.getElementById("search-bar").value;

            parent.location= 'results.php?col=' + field + "&query=" + search;
        }
    </script>
    <div id="page-wrapper">
        <h1>Search Recipes</h1>

        <div class="container-fluid">
            <div class="form-group" style="margin-bottom:0;width:18%;float:left;">
                <select id="search-fields" class="form-control">
                    <option>Recipe Name</option>
                    <option>User Email</option>
                </select>
            </div>
            <div class="form-group input-group" style="margin-bottom:0;min-width:70%;">
                <input id="search-bar" type="text" placeholder = "Search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" onClick="handleSearch()">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</body>
<?php require 'html_footer.php';?>