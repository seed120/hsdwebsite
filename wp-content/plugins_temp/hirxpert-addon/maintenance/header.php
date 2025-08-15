<?php

/**

 * Template coming soon default

 */

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js no-svg">

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="https://gmpg.org/xfn/11">

<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php endif; ?>

<?php wp_head(); ?>



<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css?family=Comfortaa|Fredoka+One" rel="stylesheet">

<style>

.maintenance-wrap {

	margin-top: 80px;

	font-family: 'Comfortaa';

}

.maintenance-wrap h4, .maintenance-wrap h5, .maintenance-wrap h1 {

	font-family: 'Fredoka One';

}

.maintenance-title {

	padding-top: 60px; padding-bottom: 60px;

}

.maintenance-footer {

	padding-top: 60px; padding-bottom: 60px;

}

.maintenance-phone, .maintenance-address, .maintenance-email {

	margin-top: 30px;

}

</style>

</head>



<body <?php body_class(); ?>>

	<div id="page" class="hirxpert-wrapper">

		<div class="hirxpert-content-wrapper">