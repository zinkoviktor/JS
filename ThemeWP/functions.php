<?php
/**
* downloadable styles and scripts
**/
add_theme_support( 'post-thumbnails' ); 
/**
* download styles and scripts
**/

function mc_remote_db() {
	$mcdb = new wpdb('DB_USER','DB_PASSWORD','DB_NAME','DB_ADDRESS');
	return $mcdb;
}

function MyCal(){
 global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
 
 $cache = array();
 $key = md5( $m . $monthnum . $year );
 if ( $cache = wp_cache_get( 'get_calendar', 'calendar' ) ) {
 if ( is_array($cache) && isset( $cache[ $key ] ) ) {
 echo $cache[ $key ];
 return;
 }
 }
 
 if ( !is_array($cache) )
 $cache = array();
 
 // Quick check. If we have no posts at all, abort!
 if ( !$posts ) {
 $gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
 if ( !$gotsome ) {
 $cache[ $key ] = '';
 wp_cache_set( 'get_calendar', $cache, 'calendar' );
 return;
 }
 }
 
 ob_start();
 if ( isset($_GET['w']) )
 $w = ''.intval($_GET['w']);
 
 // week_begins = 0 stands for Sunday
 $week_begins = intval(get_option('start_of_week'));
 
 // Let's figure out when we are
 if ( !empty($monthnum) && !empty($year) ) {
 $thismonth = ''.zeroise(intval($monthnum), 2);
 $thisyear = ''.intval($year);
 } elseif ( !empty($w) ) {
 // We need to get the month from MySQL
 $thisyear = ''.intval(substr($m, 0, 4));
 $d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
 $thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('${thisyear}0101', INTERVAL $d DAY) ), '%m')");
 } elseif ( !empty($m) ) {
 $thisyear = ''.intval(substr($m, 0, 4));
 if ( strlen($m) < 6 )
 $thismonth = '01';
 else
 $thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
 } else {
 $thisyear = gmdate('Y', current_time('timestamp'));
 $thismonth = gmdate('m', current_time('timestamp'));
 }
 
 $unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
 
 // Get the next and previous month and year with at least one post
 $previous = $wpdb->get_row("SELECT DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year
 FROM $wpdb->posts
 WHERE post_date < '$thisyear-$thismonth-01'
 AND post_type = 'post' AND post_status = 'publish'
 ORDER BY post_date DESC
 LIMIT 1");
 $next = $wpdb->get_row("SELECT    DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year
 FROM $wpdb->posts
 WHERE post_date >    '$thisyear-$thismonth-01'
 AND MONTH( post_date ) != MONTH( '$thisyear-$thismonth-01' )
 AND post_type = 'post' AND post_status = 'publish'
 ORDER    BY post_date ASC
 LIMIT 1");
 
 /* translators: Calendar caption: 1: month name, 2: 4-digit year */
 $calendar_caption = _x('%1$s %2$s', 'calendar caption');
 echo '<table id="wp-calendar" summary="' . __('Calendar') . '" cellspacing="0">
 <thead>
 <tr>';
 
 $myweek = array();
 
 for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
 $myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
 }
 
 foreach ( $myweek as $wd ) {
 $day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
 echo "\n\t\t<th abbr=\"$wd\" scope=\"col\" title=\"$wd\">$day_name</th>";
 }
 
 echo '
 </tr>
 </thead>
 
 <tfoot>
 <tr>';
 if ( $previous ) {
 echo "\n\t\t".'<th colspan="3"><a href="' .
 get_month_link($previous->year, $previous->month) . '" title="' . sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($previous->month),
 date('Y', mktime(0, 0 , 0, $previous->month, 1, $previous->year))) . '">&laquo; ' . $wp_locale->get_month($previous->month) . '</a></th>';
 } else {
 echo "\n\t\t".'<th colspan="3">&nbsp;</th>';
 }
 
 echo "\n\t\t".'<th>&nbsp;</th>';
 
 if ( $next ) {
 echo "\n\t\t".'<th colspan="3" style="border-right: 1px solid #9DABCE;"><a href="' .
 get_month_link($next->year, $next->month) . '" title="' . sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($next->month),
 date('Y', mktime(0, 0 , 0, $next->month, 1, $next->year))) . '">' . $wp_locale->get_month($next->month) . ' &raquo;</a></th>';
 } else {
 echo "\n\t\t".'<th colspan="3" style="border-right: 1px solid #9DABCE;">&nbsp;</th>';
 }
 
 echo '
 </tr>
 </tfoot>
 
 <tbody>
 <tr>';
 
 // Get days with posts
 $dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
 FROM $wpdb->posts WHERE MONTH(post_date) = '$thismonth'
 AND YEAR(post_date) = '$thisyear'
 AND post_type = 'post' AND post_status = 'publish'
 AND post_date < '" . current_time('mysql') . '\'', ARRAY_N);
 if ( $dayswithposts ) {
 foreach ( (array) $dayswithposts as $daywith ) {
 $daywithpost[] = $daywith[0];
 }
 } else {
 $daywithpost = array();
 }
 
 if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'camino') !== false || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'safari') !== false)
 $ak_title_separator = "\n";
 else
 $ak_title_separator = ', ';
 
 $ak_titles_for_day = array();
 $ak_post_titles = $wpdb->get_results("SELECT post_title, DAYOFMONTH(post_date) as dom "
 ."FROM $wpdb->posts "
 ."WHERE YEAR(post_date) = '$thisyear' "
 ."AND MONTH(post_date) = '$thismonth' "
 ."AND post_date < '".current_time('mysql')."' "
 ."AND post_type = 'post' AND post_status = 'publish'"
 );
 if ( $ak_post_titles ) {
 foreach ( (array) $ak_post_titles as $ak_post_title ) {
 
 $post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title ) );
 
 if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
 $ak_titles_for_day['day_'.$ak_post_title->dom] = '';
 if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
 $ak_titles_for_day["$ak_post_title->dom"] = "<li><span class=\"title\">".$post_title."</span></li>";
 else
 $ak_titles_for_day["$ak_post_title->dom"] .= "<li><span class=\"title\">".$post_title."</span></li>";
 }
 }
 
 // See how much we should pad in the beginning
 $pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
 if ( 0 != $pad )
 echo "\n\t\t".'<td colspan="'.$pad.'">&nbsp;</td>';
 
 $daysinmonth = intval(date('t', $unixmonth));
 for ( $day = 1; $day <= $daysinmonth; ++$day ) {
 if ( isset($newrow) && $newrow )
 echo "\n\t</tr>\n\t<tr>\n\t\t";
 $newrow = false;
 
 if ( in_array($day, $daywithpost) ){ // any posts today?
 echo "<td class=\"date_has_event\"><a href=\"".get_day_link($thisyear, $thismonth, $day)."\" class=\"date_has_event\">$day</a><div class=\"events\">
 <ul>
 $ak_titles_for_day[$day]
 </ul>
 
 </div>";
 } 
 
 if(!in_array($day, $daywithpost)){
 if ( $day == gmdate('j', (time() + (get_option('gmt_offset') * 3600))) && $thismonth == gmdate('m', time()+(get_option('gmt_offset') * 3600)) && $thisyear == gmdate('Y', time()+(get_option('gmt_offset') * 3600)) ){
 echo '<td>'.$day;}  else {            
echo '<td>'.$day; }
 }
 
 echo '</td>';
 
 if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
 $newrow = true;
 }
 
 $pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
 if ( $pad != 0 && $pad != 7 )
 echo "\n\t\t".'<td colspan="'.$pad.'">&nbsp;</td>';
 echo '    <thead>
 <tr>';
 
 $myweek = array();
 
 for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
 $myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
 }
 
 foreach ( $myweek as $wd ) {
 $day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
 echo "\n\t\t<th abbr=\"$wd\" scope=\"col\" title=\"$wd\">$day_name</th>";
 }
 
 echo '
 </tr>
 </thead>';
 
 echo "\n\t</tr>\n\t</tbody>\n\t</table>";
 
 $output = ob_get_contents();
 ob_end_clean();
 echo $output;
 $cache[ $key ] = $output;
 wp_cache_set( 'get_calendar', $cache, 'calendar' );
}
?>