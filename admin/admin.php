<?php

/** Step 2. Menu */
function AIPWP_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	   	global $wpdb;
		$table_name = $wpdb->prefix . "AIPWP_ADS"; 
		global $wpdb;
		
		
	echo '<div class="admin_page">';
	echo '<div class="postbox">
    <div class="inside"><table class="form-table"><tr><td><h3>Adsense Inside Post - Settings</h3> <i><h4>Plugin by MyTrickPages.com <a target="_blank" href="http://www.mytrickpages.com/aipwp" > Visit Plugin Page</a> | Got a problem ? <a target="_blank" href="http://www.mytrickpages.com/aipwpdoc"> Read Our Documentation</a></h4></i>
	<h4>Now You Can Easily Place Responsive Google AdSense Ads Inside Your Post..!</h4></td></tr></table><hr/></div></div> ';
	if(isset($_POST['update']))
{
	update($_POST['AD_ID'],$_POST['AD_CODE'],$_POST['style']);
	echo '<div class="updated"><h3>AD Has Been Updated!</h3></div><br/>';
	}
	
if(isset($_POST['delete']))
{
	delete($_POST['AD_ID']);
	echo '<div class="error"><h3>AD Has Been Deleted!</h3></div><br/>';
	}
	if(isset($_POST['save']))
{insert($_POST['ADNAME'],$_POST['ADCODE'],$_POST['style']);
echo '<div class="updated"><h3>New AD Has Been Added!</h3></div><br/>';
}
	echo '<table><tr><td width=70% style="vertical-align: text-top"><form class="form-table" action="" method="post" name="adcodecheck">
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
  <input class="button-primary" type="submit" value="Modify" name="modify" />
  OR
   <input class="button-primary" type="submit" value="ADD New" name="addnew" />
  OR
  <input class="button-primary" type="submit" value="ADD New Responsive Ad" name="addnewresp" />
</form>';

if (isset($_POST['addnew']))
{
	echo '<form action="" method="post">
<table class="form-table">
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
<td ><input class="button-primary" type="submit" value="Save AD Code" name="save" /></td>
</tr>
</table></from>';

}

if (isset($_POST['addnewresp']))
{
	echo '<form action="" method="post">
<table class="form-table">
<th colspan="2"><h3>Responsive Ads Only Support With Google Adsense</h3></th>
<tr>
<td><p>Google AD Client</p></td>
<td><input type="text" name="ADCLIENT" id="ADCLIENT"/></td>
</tr>
<tr>
<td><p>Google AD Slot</p></td>
<td><input type="text" name="ADSLOT" id="ADSLOT"/></td>
</tr>
<tr>
<td><p>AD Name</p></td>
<td><input type="text" name="ADNAME"/></td>
</tr>
<tr>
<td><p>AD Type</p></td> 
<td><input type="radio" name="adtype" id="recop" value="Rectangle" onclick="adtype(this)" checked/>Rectangle<br/>
<input type="radio" name="adtype" id="hor" value="Horizontal" onclick="adtype(this)"/>Horizontal<br/>
<input type="radio" name="adtype" id="ver" value="Vertical" onclick="adtype(this)"/>Vertical<br/>
<input type="radio" name="adtype" id="squ" value="Square" onclick="adtype(this)"/>Square<br/></td>
</tr>
<tr>
<td>
<div id="try"></div>
</td>
<td>
<input class="button-primary" type="button" value="Load Conditions" name="load" onclick="option()" />
</td>
</tr>
<tr>
<td>
</td>
<td>';

//Print Rectangle Settings
echo '<table class="form-table" id="cond" style="display:none" border="1">
<tr><td>Condition 1</td>
<td>
If Screen Width > <input type="text" value="1200" name="width1" id="width1r"/>
</td>
</tr>
<tr>
<td>Condition 1 Ad</td>
<td>
<select name="size1" id="r1">
<option value="0">336 x 280</option>
<option value="1">300 x 250</option>
<option value="2">180 x 150</option>
<option value="3">320 x 50</option>
</section>
</td>
</tr>
<tr>
<td>Condition 2</td>
<td>
If Screen Width > <input type="text" value="768" name="width2" id="width2r"/>
</td>
</tr>
<tr>
<td>Condition 2 Ad</td>
<td>
<select name="size2" id="r2">
<option value="0">336 x 280</option>
<option value="1">300 x 250</option>
<option value="2">180 x 150</option>
<option value="3">320 x 50</option>
</section>
</td>
</tr>
<tr>
<td>Else Condition</td>
<td>
</td>
</tr>
<tr>
<td>Else Condition Ad</td>
<td>
<select name="size3" id="r3">
<option value="0">336 x 280</option>
<option value="1">300 x 250</option>
<option value="2">180 x 150</option>
<option value="3">320 x 50</option>
</section>
</td>
</tr>
<tr>
<td colspan="2">';
echo "
<input class='button-primary' type='button' value='Genarate Ad Code' name='genarate' onclick='adgen(1)' />
</td>

</tr>
</table>";
//Rectangle Settings Ends

//Horizontal Settings
echo'<table class="form-table" id="condH" style="display:none" border="1">
<tr><td>Condition 1</td>
<td>
If Screen Width > <input type="text" value="1200" name="width1" id="width1H"/>
</td>
</tr>
<tr>
<td>Condition 1 Ad</td>
<td>
<select name="size1" id="H1">
<option value="0">234 x 60</option>
<option value="1">320 x 100</option>
<option value="2">468 x 60</option>
<option value="3">970 x 90</option>
<option value="4">970 x 250</option>
</section>
</td>
</tr>
<tr>
<td>Condition 2</td>
<td>
If Screen Width > <input type="text" value="768" name="width2" id="width2H"/>
</td>
</tr>
<tr>
<td>Condition 2 Ad</td>
<td>
<select name="size2" id="H2">
<option value="0">234 x 60</option>
<option value="1">320 x 100</option>
<option value="2">468 x 60</option>
<option value="3">970 x 90</option>
<option value="4">970 x 250</option>
</section>
</td>
</tr>
<tr>
<td>Else Condition</td>
<td>
</td>
</tr>
<tr>
<td>Else Condition Ad</td>
<td>
<select name="size3" id="H3">
<option value="0">234 x 60</option>
<option value="1">320 x 100</option>
<option value="2">468 x 60</option>
<option value="3">970 x 90</option>
<option value="4">970 x 250</option>
</section>
</td>
</tr>
<tr>
<td colspan="2">
<input class="button-primary" type="button" value="Genarate Ad Code" name="genarate" onclick="adgen(2)" />
</td>

</tr>
</table>';
//Horizontal Settings Ends

//Vertical Settings
echo'<table class="form-table" id="condV" style="display:none" border="1">
<tr><td>Condition 1</td>
<td>
If Screen Width > <input type="text" value="1200" name="width1" id="width1V"/>
</td>
</tr>
<tr>
<td>Condition 1 Ad</td>
<td>
<select name="size1" id="V1">
<option value="0">120 x 600</option>
<option value="1">120 x 240</option>
<option value="2">300 x 600</option>
<option value="3">300 x 1050</option>
</section>
</td>
</tr>
<tr>
<td>Condition 2</td>
<td>
If Screen Width > <input type="text" value="768" name="width2" id="width2V"/>
</td>
</tr>
<tr>
<td>Condition 2 Ad</td>
<td>
<select name="size2" id="V2">
<option value="0">120 x 600</option>
<option value="1">120 x 240</option>
<option value="2">300 x 600</option>
<option value="3">300 x 1050</option>
</section>
</td>
</tr>
<tr>
<td>Else Condition</td>
<td>
</td>
</tr>
<tr>
<td>Else Condition Ad</td>
<td>
<select name="size3" id="V3">
<option value="0">120 x 600</option>
<option value="1">120 x 240</option>
<option value="2">300 x 600</option>
<option value="3">300 x 1050</option>
</section>
</td>
</tr>
<tr>
<td colspan="2">
<input class="button-primary" type="button" value="Genarate Ad Code" name="genarate" onclick="adgen(3)" />
</td>

</tr>
</table>';
//Vertical Settings Ends

//Square Settings
echo'<table class="form-table" id="condS" style="display:none" border="1" >
<tr><td>Condition 1</td>
<td>
If Screen Width > <input type="text" value="1200" name="width1" id="width1S"/>
</td>
</tr>
<tr>
<td>Condition 1 Ad</td>
<td>
<select name="size1" id="S1">
<option value="0">250 x 250</option>
<option value="1">200 x 200</option>
<option value="2">180 x 150</option>
<option value="3">125 x 125</option>
</section>
</td>
</tr>
<tr>
<td>Condition 2</td>
<td>
If Screen Width > <input type="text" value="768" name="width2" id="width2S"/>
</td>
</tr>
<tr>
<td>Condition 2 Ad</td>
<td>
<select name="size2" id="S2">
<option value="0">250 x 250</option>
<option value="1">200 x 200</option>
<option value="2">180 x 150</option>
<option value="3">125 x 125</option>
</section>
</td>
</tr>
<tr>
<td>Else Condition</td>
<td>
</td>
</tr>
<tr>
<td>Else Condition Ad</td>
<td>
<select name="size3" id="S3">
<option value="0">250 x 250</option>
<option value="1">200 x 200</option>
<option value="2">180 x 150</option>
<option value="3">125 x 125</option>
</section>
</td>
</tr>
<tr>
<td colspan="2">
<input class="button-primary" type="button" value="Genarate Ad Code" name="genarate" onclick="adgen(4)" />
</td>

</tr>
</table>';
//Square Settings Ends
echo '</td>
</tr>
<tr>
<td><p>AD Code</p></td>

<td><textarea rows="6" cols="80" name="ADCODE" readonly id="adcodetxt"></textarea></td>

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
<td ><input class="button-primary" type="submit" value="Save AD Code" name="save" /></td>
</tr>';
echo '

</table></from>';

}

if (isset($_POST['modify']))
{
		$CHK = $rs->AIPWP_AD_NAME;
		$res = $wpdb->get_results("SELECT * FROM $table_name WHERE AIPWP_AD_NAME = '$_POST[adname]'");
		foreach ($res as $rs) {
echo '<form action="" method="post">
<table class="form-table" cellpadding="10px">
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

<td ><input class="button-primary" type="submit" value="Update" name="update" />
<input class="button-primary" type="submit" value="Delete" name="delete" />
</td>
</tr>
</table>
</form>';
}}

$rss = fetch_feed('http://www.mytrickpages.com/feed');


if (!is_wp_error( $rss ) ) : 
	
    $maxitems = $rss->get_item_quantity(5); 
    $rss_items = $rss->get_items(0, $maxitems); 
endif;

	echo '</div></td><td style="vertical-align: text-top"><div class="postbox" ><h3 class="hndle"><a href="http://www.mytrickpages.com" target="_blank" style="margin-left:8px; font-size: 15px;">Recent Post From MyTrickPages.com</a></h3><div class="inside"><ul class="rss-items" id="wow-feed">';
    
    	if ($maxitems == 0) echo '<li>No items.</li>';
    	else 
    	foreach ( $rss_items as $item ) : 
    
echo '<li class="item">
        <span class="data">
        	<h5><a target="_blank" href=';
echo esc_url( $item->get_permalink() );  
echo ' title=';
echo esc_html( $item->get_title() ); 
echo '>';
echo '> '.esc_html( $item->get_title() );
echo '</a></h5> 	
        </span>
    </li>';
    endforeach;
echo '</ul></div></div></div></td></tr></table>';
	
}

?>


