<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js no-svg">

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php \anyna\skip_link(); ?>

<?php wp_body_open(); ?>

<div id="page" class="site">

<?php get_template_part("template-parts/header"); ?>

<div class="main-wrapper">

<div id="main">

<?php if( !is_page() ){ ?>

<?php get_template_part("template-parts/main-parts/top"); ?>

<div id="center" class="<?php  \anyna\center_class(); ?>">

<div id="content">

<?php } ?>