<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<!-- Mobile Meta -->
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- Favicons and Icons -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

	</head>

	<body <?php body_class(); ?>>
		<div class="page-wrapper">
			<!-- Main Header--><?php
			$blog_info = get_bloginfo( 'name' );
			$logo_full = "full";
			$attachment_image = get_field('logo', 'option');
			$logo_array = wp_get_attachment_image_src( $attachment_image['ID'], $logo_full ); ?>
			<header class="main-header">
   				<!-- Header-Upper -->
        		<div class="header-upper">
        			<div class="container-fluid">
            			<div class="clearfix home-menu">
							<div class="pull-left logo-box">
                    			<div class="logo"><?php
									if ( !empty($logo_array) ) { ?>
										<div class="site-logo">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
												<img src="<?php echo $logo_array[0]; ?>" alt="<?php echo $blog_info; ?>" title="<?php echo $blog_info; ?>" />
											</a>
										</div><?php
									} else {
										if ( ! empty( $blog_info ) ) {
											if ( is_front_page() && is_home() ) { ?>
												<h1 class="site-title">
													<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
														<?php echo $blog_info; ?>
													</a>
												</h1><?php
											} else { ?>
												<p class="site-title">
													<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
														<?php echo $blog_info; ?>
													</a>
												</p><?php
											}
										}
									} ?>
								</div>
                    		</div>
							<div class="nav-outer clearfix">
								<!--Mobile Navigation Toggler For Mobile-->
								<div class="mobile-nav-toggler">
									<span class="icon flaticon-menu-4"></span>
								</div>
								<nav class="main-menu mega navbar-expand-md pull-right">
									<div class="navbar-header">
										<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>
									<div class="navbar-collapse collapse scroll-nav clearfix" id="navbarSupportedContent">
										<?php
											wp_nav_menu(
												array(
													'theme_location' => 'primary-navigation',
													'menu_class'     => 'primary-navigation navigation clearfix',
													'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
												)
											);
										?>
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>
		        <!-- End Header Upper -->

				<!-- Sticky Header-->
				<div class="sticky-header">
					<div class="container-fluid clearfix">
						<!-- Mobile Logo-->
						<div class="logo pull-left">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="img-responsive"><?php
								if ( !empty($logo_array) ) { ?>
									<img src="<?php echo $logo_array[0]; ?>" alt="<?php echo $blog_info; ?>" title="<?php echo $blog_info; ?>" /><?php
								} else {
									echo $blog_info;
								} ?>
							</a>
						</div>
						<!-- Mobile Logo-->
						<!-- Right Col-->
						<div class="right-col pull-right">
							<!-- Main Menu -->
							<nav class="main-menu navbar-expand-md">
								<div class="navbar-collapse collapse clearfix" id="navbarSupportedContent1">
									<ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
								</div>
							</nav>
							<!-- Main Menu End-->
						</div>
						<!-- Right Col-->
					</div>
				</div>
				<!--End Sticky Header-->

				<!-- Mobile Menu  -->
				<div class="mobile-menu">
					<div class="menu-backdrop"></div>
					<div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
					<!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
					<nav class="menu-box">
						<div class="nav-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="img-responsive"><?php
								if ( !empty($logo_array) ) { ?>
									<img src="<?php echo $logo_array[0]; ?>" alt="<?php echo $blog_info; ?>" title="<?php echo $blog_info; ?>" /><?php
								} else {
									echo $blog_info;
								} ?>
							</a>
						</div>
						<ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
					</nav>
				</div>
				<!-- End Mobile Menu -->
    		</header><!-- End Main Header -->
