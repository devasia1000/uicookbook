<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/html_header.php';  // Works on Server
require 'html_header.php';
session_start();
?>
<body>
    <?php
    // require $_SERVER['DOCUMENT_ROOT'] . '/header.php';
    require 'header.php';
    ?>
    <script type="text/javascript">
    
    	function displaySearchResults(search_result) {
    		var resultString = "";
    		var temp = search_result.split("///");
		for (var i = 0; i < temp.length; i++) {
			var temp2 = temp[i].split(";;;");
			for (var j = 0 ; j < temp2.length ; j++) {
				if (j == 0 && !(temp2[j]==='')) {
					resultString += "\nRecipeId: " + temp2[j];
				} else if (j == 1) {
					resultString += "\nRecipe Name: " + temp2[j];
				} else if (j == 2) {
					resultString += "\nRecipe Steps:\n\t" + temp2[j].replace(/\n/g, '\n\t');
				} else if (j == 3) {
					resultString += "\nUser Email: " + temp2[j];
				}
			}
			
			resultString += '\n\n';
			
		}
		
		resultsBox = document.getElementById("results");
		resultsBox.value = resultString;
    	}
    
    	function handleSearch() {
    	    field = document.getElementById("search-fields").value;
    	    search = document.getElementById("search-bar").value;
    	    resultsBox = document.getElementById("results");
	
    	    var finalString = "";
    	    
    	    if(field == "Recipe Name") {
    	    	//resultsBox.value = searchRecipe("", search, "", "", "");
		displaySearchResults(searchRecipe("", search, "", "", ""));

    	    }
    	    if(field == "User Email") {
    	    	//resultsBox.value = searchRecipe("", "", "", "", search);
   	    	displaySearchResults(searchRecipe("", "", "", "", search));
    	    }
    	}
    	
    </script>	
    <div id="page-wrapper">
        <h1>Search Recipes</h1>
        <table width="100%">
        <tr>
            <td width="150px">
            <div class="form-group" style="margin-bottom:0px;">

                <select id="search-fields" class="form-control">
                    <option><b>Recipe Name</b></option>
                    <option><b>User Email</b></option>
                </select>
            </div>
            </td>
            <td>
            <div class="form-group input-group" style="margin-bottom:0px;">
                <input id="search-bar" type="text" placeholder = "Search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" onClick="handleSearch()">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            </td>
        </tr>
        <tr>
        	<td></td>
         	<td>
         		<textarea rows="15" cols="200" id="results" type="text" value="" style="color:#000000;width:100%;"></textarea>
         	</td>
        </tr>
        </table>
    </div>
</body>
<?php
// require $_SERVER['DOCUMENT_ROOT'] . '/html_footer.php';
require 'html_footer.php';
?>