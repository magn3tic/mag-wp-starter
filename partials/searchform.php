<?php

/*************** Search Form *******************/
// Create a search input anywhere in your templates with get_search_form()
// you can modify how the search form functions w/ hidden inputs

?>

<div id="searchform">
	<form method="get" role="search">
	
		<label for="s">Search</label>
		<input type="search" name="s" value="<?php the_search_query(); ?>">
		<input id="searchsubmit" type="submit" value="Go">

	</form>
</div>
