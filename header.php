<?php
/**
 * @package WordPress
 * @subpackage Constructor
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('&raquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />    
    <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_get_archives('type=monthly&format=link'); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(get_constructor_category_class()); ?>>
	
<div id="body">
   <div id="wrapheader" class="wrapper">
       <div id="header">
            <?php get_constructor_menu()  ?>
            <div class="logo">
                <h1><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); echo " &raquo; "; bloginfo('description');?>"><?php bloginfo('name'); ?></a></h1>
                <h2><?php bloginfo('description');?></h2>
            </div>
       </div>
   </div>
   
   <?php get_constructor_slideshow() ?>
   <div id="wrapcontent" class="wrapper">
       <div id="content" class="box shadow opacity">