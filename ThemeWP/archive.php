<!DOCTYPE html>
<html lang="en">
    <head>

	<title>Hermes-TM - БЛОГ</title>
<link rel="icon" href="http://hermes-tm.com.ua/favicon.png" type="image/x-icon" />
<link rel="shortcut icon" href="http://hermes-tm.com.ua/favicon.png" type="image/x-icon" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="Hermes-TM - Розміщення оголошень, контекстна реклма в інтернеті" />
	<link href="/wp-content/themes/ThemeWP/css/style.css" rel="stylesheet"/>
	<link href="/wp-content/themes/ThemeWP/css/styleblog.css" rel="stylesheet"/>
    </head>
<body>
<div class="site-container">
<div class="menu">
<a href="#view-1"><img src="<?php echo get_template_directory_uri(); ?>/img/hm_tm_g_logo.png" class="dsp-non menu-logo2" alt="HERMES TM"></a>
<img src="<?php echo get_template_directory_uri(); ?>/img/btn_menu.png" class="dsp-non menu-button" id="menu-button" alt="btn">
<div class="menu-center">
<a href="#view-1"><img src="<?php echo get_template_directory_uri(); ?>/img/hm_tm_g_logo.png" class="menu-logo" alt="HERMES TM"></a>	
<a href="http://hermes-tm.com.ua/#view-1" class="vs-anchor f-b">головна</a>	
<a href="http://hermes-tm.com.ua/#view-5" class="vs-anchor f-b">оформити замовлення</a>	
<a href="http://hermes-tm.com.ua/#view-4" class="vs-anchor f-b">тарифи</a>		
<a href="http://hermes-tm.com.ua/#view-6" class="vs-anchor f-b">оплата</a>	
<a href="http://hermes-tm.com.ua/#view-3" class="vs-anchor f-b">про нас</a>	
<a href="http://hermes-tm.com.ua/blog" class="vs-anchor f-b">блог</a>	
</div>
</div>

<header id="header" class="site-header" role="banner" itemscope="itemscope">
<div class="wrap">
<div class="title-area">
<h1 class="site-title" itemprop="headline"><a href="http://hermes-tm.com.ua" title="HERMES-TM">HERMES-TM</a></h1>
<h3 class="site-description"><span>Blog</span></h3>
</div>
</div>
</header>
<div class="wrap">
<main class="content">
<section class="best-contents">
		<?php if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); ?>
				<section id="best-post-<?php the_ID(); ?>" <?php post_class( 'best-post' ); ?>>
					<header class="page-header">
						<h2 class="best-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute( array( 'before' => __( 'Permalink to ', 'best' ), 'after' => '' ) ); ?>"><?php the_title(); ?></a>
						</h2>
						<p class="best-p-post-data">
							<span class="post-data"><?php _e( 'posted on', 'best' ); ?> </span>
							<a href="<?php the_permalink(); ?>">
								<?php echo get_the_date(); ?>
							</a>
							<span class="post-data"> <?php _e( 'by', 'best' ); ?> </span>
							<?php the_author_posts_link();
							if ( has_category() ) { ?>
								<span class="post-data"> <?php _e( 'in', 'best' ); ?> </span>
								<?php the_category( ', ' );
							}
							edit_post_link( __( 'Edit', 'best' ), '<span class="best-edit-link">', '</span>' ); ?>
						</p>
					</header><!-- .page-header -->
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="best-content-image">
							<?php the_post_thumbnail( 'best_image_content_size' );
							do_action( 'best_the_post_thumbnail_caption' ); ?>
						</div> <!-- content_image -->
					<?php } // has_post_thumbnail() ?>
					<article class="best-content">
						<?php the_content();
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'best' ) . ':' . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) ); ?>
						<footer class="best-tags">
							<?php if ( has_tag() ) {
								the_tags( '', ', ', '' );
							} ?>
						</footer> <!-- .best-tags -->
					</article> <!-- .best-content -->
				</section> <!-- #best-post -->
			<?php } // while have_posts() ?>
			<nav class="best-link">
				<div class="best-previous-posts-link">
					<?php next_posts_link( __( 'Previous posts', 'best' ) . ' ' ); ?>
				</div> <!-- best-previous-posts-link -->
				<div class="best-next-posts-link">
					<?php previous_posts_link( ' ' . __( 'Next posts', 'best' ) ); ?>
				</div> <!-- best-next-posts-link -->
			</nav> <!-- .best-link -->
			<div class="best-clear"></div>
		<?php } else { ?>
			<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'best' ); ?></p>
			<?php get_search_form(); ?>
			<div class="best-clear"></div>
		<?php } // if have_posts() ?>
	</section> <!-- .best-contents -->
</main>

<aside class="sidebar sidebar-primary widget-area">

<section id="search-4" class="widget widget-1 even widget-first widget_search"><div class="widget-wrap"><h4 class="widget-title">Пошук</h4>
<?php get_search_form(); ?>
</div></section>

<?php get_calendar(false); ?>

<section id="recent-posts-2" class="widget widget-2 odd widget_recent_entries">
<div class="widget-wrap">		
<h4 class="widget-title">Останні пости</h4>
<ul>
<?php 
$args = array(
	'numberposts' => 6,
	'post_status' => 'publish',
); 
$result = wp_get_recent_posts($args);
foreach( $result as $p ){ 
?>		
<li><a href="<?php echo get_permalink($p['ID']) ?>"><?php echo $p['post_title'] ?></a></li>	
    
<?php 
} 
?>
</ul>
</div>
</section>


</aside>
</div>
</div>
<footer id="footer" class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter"><div class="wrap"><div class="footer-content footer-insert"><p class="copyright">Copyright © 2017</p>

<p class="credit"><a class="theme-link" href="HERMES-TM">Hermes-TM</a></p></div></div></footer>

<script src="/wp-content/themes/ThemeWP/js/jquery-3.1.0.min.js"></script>
<script>
window.onload=function (){if(window.location=="http://hermes-tm.com.ua/#view-5")setTimeout(function(){window.location.replace("http://hermes-tm.com.ua/#v5");},1000);};
$( "#menu-button" ).click(function() {

if($(".menu-center").css("display")=="none"){$(".menu-center").css("display","block");}
else{$(".menu-center").css("display","none");}
});
if($(window).width()<= '898'){
$( ".f-b" ).click(function() {
$(".menu-center").css("display","none");
})
}
</script>
</body>
</html>