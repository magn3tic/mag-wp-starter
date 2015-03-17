<?php

/********** Sidebar Template ************/
// include in other templates with get_sidebar()

?>

<aside class="sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<div class="sidebar-liner">

		<div class="sidebar-search">
			<?php 
			global $magconfig;
			var_dump($magconfig);
			//Site Search Form
			//template: partials/searchform.php
			get_search_form(); ?>
		</div>
		
	</div>
</aside>