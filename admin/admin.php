<?php

/** Step 1. Menu */
function AIPWP_menu() {
	add_options_page( 'Ads Inside Post Plugin Options', 'Ads Inside Post', 'manage_options', 'AIPWP', 'AIPWP_options' );
}

/** Step 2. Menu */
function AIPWP_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	   	global $wpdb;
		$table_name = $wpdb->prefix . "AIPWP_ADS"; 
		global $wpdb;
		
	echo '<div class="admin_page">';
	echo '<table><tr><td><h1>Adsense Inside Post</h1> <h3>by Rajika Nanayakkara <a target="_blank" href="http://www.mytrickpages.com/aipwp" > Visit Plugin Page</a></h3><h4>Use Shortcode "[showads ad=your_ad_name]" Inside Your Post To Display Ads. <br/> Read Documentation 
	For More Instructions <a target="_blank" href="http://www.mytrickpages.com/aipwpdoc"> View Documentation</a></h4></td>
	<td><a target="_blank" href="http://secure.hostgator.com/~affiliat/cgi-bin/affiliates/clickthru.cgi?id=rajika4ever-"><img src="http://tracking.hostgator.com/img/WordPress_Hosting/728x90-animated.gif" border="0"></a></td></tr></table><hr/> ';
	if(isset($_POST['save']))
{insert($_POST['ADNAME'],$_POST['ADCODE'],$_POST['style']);
echo '<br/><br/><h3>New AD Has Been Added!</h3><br/><br/>';
}
	echo '<form action="" method="post" name="adcodecheck">
<label>Ad Code Name : </label> <select name="adname">';

$rese = $wpdb->get_results("SELECT AIPWP_AD_NAME FROM $table_name");
foreach ($rese as $rse) {
	if($CHK==$rse->AIPWP_AD_NAME)
	{
		echo '<option selected="selected" value="'.$rse->AIPWP_AD_NAME.'" >'.$rse->AIPWP_AD_NAME.'</option>';
		}else{
 echo '<option value="'.$rse->AIPWP_AD_NAME.'">'.$rse->AIPWP_AD_NAME.'</option>';
		}
}
echo '
  </select>
  <input type="submit" value="Modify" name="modify" />
  OR
   <input type="submit" value="ADD New" name="addnew" />
</form>';

if (isset($_POST['addnew']))
{
	echo '<form action="" method="post">
<table>
<tr>
<td><p>AD Name</p></td>
<td><input type="text" name="ADNAME"/></td>
</tr>
<tr>
<td><p>AD Code</p></td>
<td><textarea rows="6" cols="80" name="ADCODE"></textarea></td>
</tr>
<tr>
<td><p>AD Style</p></td>
<td>
<input type="radio" name="style" value="ad_left">Align Left<br/>
<input type="radio" name="style" value="ad_right">Align Right<br/>
<input type="radio" name="style" value="ad_center">Align Center<br/>
<input type="radio" name="style" value="no" checked="checked">No Style
</td>
</tr>
<tr><td>
</td>
<td ><input type="submit" value="Save AD Code" name="save" /></td>
</tr>
</table></from>';

}

if(isset($_POST['update']))
{
	update($_POST['AD_ID'],$_POST['AD_CODE'],$_POST['style']);
	echo '<br/><br/><h3>AD Has Been Updated!</h3><br/><br/>';
	}
	
if(isset($_POST['delete']))
{
	delete($_POST['AD_ID']);
	echo '<br/><br/><h3>AD Has Been Deleted!</h3><br/><br/>';
	}


if (isset($_POST['modify']))
{
		$CHK = $rs->AIPWP_AD_NAME;
		$res = $wpdb->get_results("SELECT * FROM $table_name WHERE AIPWP_AD_NAME = '$_POST[adname]'");
		foreach ($res as $rs) {
echo '<form action="" method="post">
<table cellpadding="10px">
<tr>
<td><p>AD ID</p></td>
<td>'.$rs->AIPWP_AD_ID.'</td>
<input type="hidden" name="AD_ID" value="'.$rs->AIPWP_AD_ID.'"/>
</tr>
<tr>
<td><p>AD Name</p></td>
<td>'.$rs->AIPWP_AD_NAME.'</td>

</tr>
<tr>
<td><p>AD Code</p></td>
<td><textarea rows="6" cols="80" name="AD_CODE"> '.stripslashes($rs->AIPWP_AD_CODE).'</textarea></td>
</tr>
<tr>
<td><p>AD Style</p></td>
<td>';

echo '<input type="radio" name="style" value="ad_left"';if($rs->AIPWP_AD_STYLE=='ad_left') echo 'checked="checked"';
echo ' >Align Left<br/>';
echo '<input type="radio" name="style" value="ad_right"';if($rs->AIPWP_AD_STYLE=='ad_right') echo 'checked="checked"';
echo ' >Align Right<br/>';
echo '<input type="radio" name="style" value="ad_center"';if($rs->AIPWP_AD_STYLE=='ad_center') echo 'checked="checked"';
echo ' >Align Center<br/>';
echo '<input type="radio" name="style" value="no"'; if($rs->AIPWP_AD_STYLE=='no') echo 'checked="checked"';
echo ' >No Style';
echo '</td>
</tr>
<tr>
<td>
</td>

<td ><input type="submit" value="Update" name="update" />
<input type="submit" value="Delete" name="delete" />
</td>
</tr>
</table>
</form>';
}}

	echo '</div>';
	
}
?>