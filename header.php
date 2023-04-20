<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<!--

    This website is made with the Fat Cat Theme

            [meow, meow, meow]
                     /
                    /

        /\_____/\
       /  o   o  \
      ( ==  ^  == )
       )         (
      (           )
     ( (  )   (  ) )
    (__(__)___(__)__)

    developed by Manuel Urak, who is very handsome and good looking.
    https://manuelurak.dev

	-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(array('loading')); ?>>
		<?php 
        
        get_template_part('template-parts/header');