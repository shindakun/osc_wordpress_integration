osCommerce Wordpress Integration Version 1.1 - 12/29/05
*Released With No Guaranteed Support Or Warranty*

Background
_______________________ _  _
	For my upcoming store I wanted more then just a similar themed
	blog section.  I wanted a more integrated feel.  So, I decided
	to do away with the 'customer greeting' on the osCommerce index
	page and replaced it with the latest post from a Wordpress blog
	running on the same MySQL database.

Version 1.1 Change Log
_______________________ _  _
	Updated script for use with Wordpress 2.0.



Instructions
_______________________ _  _
Step 1:
In your catalog directory find INDEX.PHP find the following:

<tr>
	<td class="main"><?php echo tep_customer_greeting(); ?></td>
</tr>

And replace it with:

<tr>
	<td class="main"><?php include ('wp.php');//echo tep_customer_greeting(); ?></td>
</tr>

Step 2:

Go into your Wordpress admin control panel (wp-admin/categories.php) and
add a new category just for store news.  Make a note of the ID number for
the category.  For my store it's number 2.

Step 3:

In WP.PHP find:

/**********************************************
BEGIN CONFIG SECTION
**********************************************/
$category = '2';
$use_nicenick = false;
/**********************************************
END CONFIG SECTION
**********************************************/

Edit the number to the category number you noted earlier.

Step 3*:

If you want to use the first name of the person who posted *AND* you have
them set for yourself (wp-admin/profile.php) and for your users (wp-admin/users.php)
then do not change '$use_nicenick'.  However, if you didn't set first names
then switch '$use_nicenick = true'.


Step 4:

Upload WP.PHP to your catalog directory.

Step 5:

Test install.

Notes:
_______________________ _  _
	This will is only set to work with a default Wordpress install
	using the default Wordpress database tables (for now anyway).
	Also all the tables (osCommerce and Wordpress) are on the same
	database.  If your using different ones it shouldn't be to hard
	to modify so, I'll leave that to you.

	Merry Christmas!