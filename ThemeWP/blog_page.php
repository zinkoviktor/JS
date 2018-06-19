<?php 
/*
    Template Name: Blog
*/
?>

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
        <?php // Display blog posts on any page @ http://m0n.co/l
        $temp = $wp_query; $wp_query= null;
        $wp_query = new WP_Query(); $wp_query->query('showposts=3' . '&paged='.$paged);
        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
<header class="entry-header">	
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="Читати більше"><?php the_title(); ?></a></h2>
	<div class="entry-meta">
	<time class="entry-time"><?php the_date(); ?></time>	
	</div>
</header>
<div class="entry-summary">
<a href="<?php the_permalink(); ?>" title="Читати більше"><?php the_post_thumbnail(array(432,170)); ?></a>
	
<?php the_content(); ?>        
 </div>
        <?php endwhile; ?>
 
        <?php if ($paged > 1) { ?>
 
        <nav id="nav-posts" class="navigation  paging-navigation">
            <div class="prev"><?php next_posts_link('&laquo; Попередні пости'); ?></div>
            <div class="next"><?php previous_posts_link('Новіші пости &raquo;'); ?></div>
        </nav>
 
        <?php } else { ?>
 
        <nav id="nav-posts" class="navigation  paging-navigation">
            <div class="prev"><?php next_posts_link('&laquo; Попередні пости'); ?></div>
        </nav>
 
        <?php } ?>
 
        <?php wp_reset_postdata(); ?>
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
