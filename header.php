<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip Link -->
<a class="sr-only" href="#main-content"><?php esc_html_e( 'Skip to main content', 'luminar' ); ?></a>

<!-- ============================================================
     SITE HEADER
     ============================================================ -->
<header id="site-header" class="site-header site-header--transparent" role="banner">
	<div class="site-header__inner">

		<!-- Logo -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home" aria-label="<?php bloginfo( 'name' ); ?> — Home">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<img
					src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Luminar Touch Ebvents Logo.jpeg' ); ?>"
					alt="Luminar Touch Events — Event Styling Brisbane"
					height="64"
					width="auto"
					style="height:64px; width:auto; display:block;"
				>
			<?php endif; ?>
		</a>

		<!-- Primary Navigation -->
		<nav id="site-navigation" class="site-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'luminar' ); ?>">
			<ul class="site-nav__list" role="list">
				<li class="site-nav__item">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-nav__link"><?php esc_html_e( 'Home', 'luminar' ); ?></a>
				</li>

				<li class="site-nav__item">
					<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="site-nav__link" aria-haspopup="true" aria-expanded="false">
						<?php esc_html_e( 'Services', 'luminar' ); ?>
					</a>
					<ul class="site-nav__dropdown" role="list">
						<li><a href="<?php echo esc_url( home_url( '/services/baby-shower/' ) ); ?>"><?php esc_html_e( 'Baby Shower', 'luminar' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/services/bridal-shower/' ) ); ?>"><?php esc_html_e( 'Bridal Shower', 'luminar' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/services/gender-reveal/' ) ); ?>"><?php esc_html_e( 'Gender Reveal', 'luminar' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/services/graduation/' ) ); ?>"><?php esc_html_e( 'Graduation', 'luminar' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/services/citizenship/' ) ); ?>"><?php esc_html_e( 'Citizenship Ceremony', 'luminar' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/services/wedding/' ) ); ?>"><?php esc_html_e( 'Weddings', 'luminar' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/services/dinner-party/' ) ); ?>"><?php esc_html_e( 'Dinner Parties', 'luminar' ); ?></a></li>
					</ul>
				</li>

				<li class="site-nav__item">
					<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="site-nav__link"><?php esc_html_e( 'Gallery', 'luminar' ); ?></a>
				</li>

				<li class="site-nav__item">
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="site-nav__link"><?php esc_html_e( 'About', 'luminar' ); ?></a>
				</li>

				<li class="site-nav__item">
					<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="site-nav__link"><?php esc_html_e( 'Blog', 'luminar' ); ?></a>
				</li>
			</ul>
		</nav>

		<!-- Header CTA -->
		<div class="site-header__cta">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--sm">
				<?php esc_html_e( 'Get a Quote', 'luminar' ); ?>
			</a>
		</div>

		<!-- Mobile Toggle -->
		<button class="nav-toggle" aria-label="<?php esc_attr_e( 'Toggle mobile menu', 'luminar' ); ?>" aria-expanded="false" aria-controls="mobile-menu">
			<span></span>
			<span></span>
			<span></span>
		</button>

	</div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu" aria-hidden="true" role="dialog" aria-label="<?php esc_attr_e( 'Mobile navigation', 'luminar' ); ?>">
	<ul class="mobile-menu__list" role="list">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-menu__link"><?php esc_html_e( 'Home', 'luminar' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="mobile-menu__link"><?php esc_html_e( 'Services', 'luminar' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="mobile-menu__link"><?php esc_html_e( 'Gallery', 'luminar' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="mobile-menu__link"><?php esc_html_e( 'About', 'luminar' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="mobile-menu__link"><?php esc_html_e( 'Blog', 'luminar' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="mobile-menu__link"><?php esc_html_e( 'Contact', 'luminar' ); ?></a></li>
	</ul>
	<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary">
		<?php esc_html_e( 'Get a Free Quote', 'luminar' ); ?>
	</a>
</div>

<main id="main-content" role="main">
