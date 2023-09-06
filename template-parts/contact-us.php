<?php
/**
 * template name:Contact us
 * The template for displaying all pages
*/

get_header(); ?>
<?php
	// Start the Loop.
	while ( have_posts() ) : the_post(); ?>
<?php 	
	endwhile;
?>


<?php
get_footer();

