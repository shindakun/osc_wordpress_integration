<?php
/*
  $Id: wp.php,v 1.1 2005/12/29 12:26:32 Exp $

  Wordpress Latest News Contribution by shindakun (steve at shindakun.net)
  *Released With No Guaranteed Support Or Warranty*

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

/**********************************************
BEGIN CONFIG SECTION
**********************************************/
$category = '2';
$use_nicenick = false;
/**********************************************
END CONFIG SECTION
**********************************************/

function convert_datetime($datestamp, $format) {
    if ($datestamp!=0) {
        list($date, $time)=split(" ", $datestamp);
        list($year, $month, $day)=split("-", $date);
        list($hour, $minute, $second)=split(":", $time);
        $stampeddate=mktime($hour,$minute,$second,$month,$day,$year);
        $datestamp=date($format,$stampeddate);
        return $datestamp;
    }
}

$wp_post2cat_query = tep_db_query("select * from wp_post2cat where category_id = '$category' order by rel_id desc limit 1");
$wp_post2cat = tep_db_fetch_array($wp_post2cat_query);
$getpost =  $wp_post2cat['post_id'];
$wp_post_query = tep_db_query("select * from wp_posts WHERE id = '$getpost' limit 1");
$wp_post = tep_db_fetch_array($wp_post_query);
$getauthor =  $wp_post['post_author'];

if ($use_nicenick == true) {
	$wp_author_query = tep_db_query("select * from wp_users WHERE id = '$getauthor' limit 1");
	$wp_author = tep_db_fetch_array($wp_author_query);
} else { 
	$wp_author_query = tep_db_query("select * from wp_usermeta WHERE user_id = '$getauthor' AND meta_key = 'first_name' limit 1");
	$wp_author = tep_db_fetch_array($wp_author_query);
}



$post_date = convert_datetime($wp_post['post_date'], "F j, Y  g:ia");
?>
<!-- / wordpress contrib by shindakun / !-->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td class="infoBoxHeading" height="14"><img src="images/pixel_trans.gif" alt="" border="0" height="14" width="11"></td>
    <td class="infoBoxHeading" height="14" width="100%">Latest News - <a href="<?php echo $wp_post['guid'];?>" class="headerNavigation"><?php echo $wp_post['post_title'];?> (<?php echo $post_date;?>)</a></td>
    <td class="infoBoxHeading" height="14"><img src="images/pixel_trans.gif" alt="" border="0" height="14" width="11"></td>
  </tr>
</tbody></table>
<table class="infoBox" border="0" cellpadding="1" cellspacing="0" width="100%">
  <tbody><tr>

    <td><table class="infoBoxContents" border="0" cellpadding="4" cellspacing="0" width="100%">
  <tbody>
  <tr>
    <td class="smallText" valign="top"><?php echo $wp_post['post_content'];?></td>
  </tr>
  <tr>
    <td class="smallText" valign="top"><div align="right">- <a href="mailto:<?php echo $wp_author['user_email'];?>"><?php if ($use_nicenick == true) {echo $wp_author['user_nicename'];} else {echo $wp_author['meta_value'];}?></a></div></td>
  </tr>
</tbody></table>