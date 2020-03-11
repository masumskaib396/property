<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agni Framework
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_html( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php wp_head(); ?>
</head>

</head>
	<body <?php body_class() ?>>
		<div class="vdm-tab-section">
			<div class="vdm-tab-header">
				<div class="vdm-container">
					<div class="vdm-tab-header-wrap">
						<div class="vdm-logo">
							<?php the_custom_logo() ?>
						</div>
						
						<?php 
							if(is_user_logged_in()){
								?>
								<a class="vdm-logout" href="<?php echo wp_logout_url(); ?>">log out</a>
								<?php
							}else{
								?>
								<a href="<?php echo esc_url(home_url('registration')) ?>" class="vdm-logout" >Registration Now</a>
								<?php
							}
						?>
					</div>
				</div>
			</div>