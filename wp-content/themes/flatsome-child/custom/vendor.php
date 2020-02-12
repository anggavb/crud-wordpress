<?php
/**
* Template Name: Vendor Form
*/

$user_id = get_current_user_id();

if ( !$user_id ) {
	echo "<script>window.location = '".site_url()."/login-vendor/'</script>";
}

?>

<?php get_header(); ?>

<h1>Hello World</h1>

<?php get_footer(); ?>
