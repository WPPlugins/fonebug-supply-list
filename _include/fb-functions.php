<?php
$b1_color="233C49";	
$b1_highlight="09F";
$b2_color="E0E9E9";
$b3_color="69C";

if(!function_exists('fb_char_lim')){function fb_char_lim($str, $n, $end_char = '&#8230;'){
	if (strlen($str) < $n){return $str;}
    $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));
    if (strlen($str) <= $n){return $str;}
    $out = "";
    foreach (explode(' ', trim($str)) as $val){
        $out .= $val.' ';
        if (strlen($out) >= $n){
            $out = trim($out);
            return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
        }       
    }
}}

if(!function_exists('fb_total_supplies')){function fb_total_supplies($supply_code){
	$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$supply_code'");
	$total_items=mysql_num_rows($countIt);
	$edited=fb_ts();
	@mysql_query("UPDATE fonebug_supply_lists SET total_items='$total_items', edited='$edited' WHERE code='$supply_code'");	
}}

//==================================================================================================
//======= check_text
//==================================================================================================
if(!function_exists('fb_check_text')){function fb_check_text($text, $check){if($check=='y'){echo "<span class='redText'>".$text."</span>";}else{echo "<b>".$text."</b>";}}}

//==================================================================================================
//======= saveIt_loop
//==================================================================================================
if(!function_exists('fb_saveIt_loop')){function fb_saveIt_loop($saveIt){if(!$saveIt){fb_redBox("Error!", 250, 21);}}}

/////////////////////////////////////////////////////////////////////////////////////////////////
//=======  Boxes
//////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('fb_redBox')){function fb_redBox($msg, $width, $redBoxFontSize){	
	if(wp_is_mobile() || $width=="100%"){$width="100%";}else{$width=$width."px";}
	echo "<table style='width:".$width."; margin:0px; border:0px; border-collapse:separate;'><tr><td class='redBox' style='text-align:center; -moz-border-radius:7px !important; -webkit-border-radius:7px !important; border-radius:7px !important; overflow:hidden !important;'><span class='redText' style='font-size:".$redBoxFontSize."px;'>".$msg."</span></td></tr></table>";
}}

if(!function_exists('fb_greenBox')){function fb_greenBox($msg, $width, $font_size){
	if(wp_is_mobile() || $width=="100%"){$width="100%";}else{$width=$width."px";}
	echo "<table style='width:".$width."; margin:0px; border:0px; border-collapse:separate;'><tr><td class='greenBox' style='text-align:center; -moz-border-radius:7px !important; -webkit-border-radius:7px !important; border-radius:7px !important; overflow:hidden !important;'><span class='greenText' style='font-size:".$font_size."px;'>".$msg."</span></td></tr></table>";
}}

if(!function_exists('fb_blueBox')){function fb_blueBox($msg, $width, $fontSize){
	if(wp_is_mobile() || $width=="100%"){$width="100%";}else{$width=$width."px";}
	echo "<table style='width:".$width.";'><tr><td class='blueBox'><span style='font-size:".$fontSize."px; font-weight:bold; color:#06F;'>".$msg."</span></td></tr></table>";
}}

if(!function_exists('fb_orangeBox')){function fb_orangeBox($msg, $width, $fontSize){	
	if(wp_is_mobile() || $width=="100%"){$width="100%";}else{$width=$width."px";}
	echo "<table style='width:".$width."; margin:0px; border:0px; border-collapse:separate;'><tr><td class='orangeBox' align='center'><span style='font-size:".$fontSize."px'>".$msg."</span></td></tr></table>";
}}



if(!function_exists('fb_permalink')){function fb_permalink(){
	$countIt=mysql_query("SELECT * FROM wp_options WHERE option_name='permalink_structure' AND option_value='/%postname%/' LIMIT 1");
	$uses_perm=mysql_num_rows($countIt);

	$countIt=mysql_query("SELECT * FROM wp_options WHERE option_name='permalink_structure' AND option_value='' LIMIT 1");
	$uses_default=mysql_num_rows($countIt);

	// check if using permalinks
	if($uses_perm>0){
		$result=mysql_query("SELECT post_name FROM wp_posts WHERE post_content LIKE '%fonebug-supply-list%' AND post_status='publish' LIMIT 1");
		while($row = mysql_fetch_array($result)){
			$fb_ID=fb_d($row['post_name']);
			$fb_permalink=get_site_url()."/".$fb_ID."?";
		}

	// check if using default
	}else if($uses_default>0){
		$result=mysql_query("SELECT ID FROM wp_posts WHERE post_content LIKE '%fonebug-supply-list%' AND post_status='publish' LIMIT 1");
		while($row = mysql_fetch_array($result)) {
			$fb_ID=fb_d($row['ID']);
			$fb_permalink=get_site_url()."/?page_id=".$fb_ID;
		}
	}else{
		$fb_permalink="?";	
	}
	return $fb_permalink;
}}

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  Coding and decoding
//////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('fb_d')){function fb_d($DBvar){return stripslashes(urldecode($DBvar));}}
if(!function_exists('fb_e')){function fb_e($DBvar){return urlencode(nl2br(trim($DBvar)));}}
if(!function_exists('fb_dcontent')){function fb_dcontent($DBvar){return str_replace("<br />", "", stripslashes(urldecode($DBvar)));}}

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  Create a random Code
//////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('fb_code')){function fb_code(){
            //------- create unique validation code
			$codedate=fb_timestamp(date("Y-m-d H:i.s"));
            $len = 5;
            $base='BCDFHKLNPRTWXYZ';
            $max=strlen($base)-1;
            $code='';
            mt_srand((double)microtime()*1000000);
            while (strlen($code)<$len+1)
                $code.=$base{mt_rand(0,$max)
            };
            $DBcode=$codedate."".$code;
			return $DBcode;
}}

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  timestamp functions
//////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('fb_ts')){function fb_ts(){$date=strtotime(date("Y-m-d H:i.s")); return $date;}}
if(!function_exists('fb_timestamp')){function fb_timestamp($timeDateVar){return strtotime($timeDateVar);}}
if(!function_exists('fb_apt')){function fb_apt($APTtimestamp){global $timezone; $APTtimestamp=$APTtimestamp+($timezone);return date("l, F d, Y, g:i a", $APTtimestamp);}}
if(!function_exists('fb_apt_short')){function fb_apt_short($APTtimestamp){global $timezone; $APTtimestamp=$APTtimestamp+($timezone);return date("D, M d, Y, g:i a", $APTtimestamp);}}
if(!function_exists('fb_dateText')){function fb_dateText($dateTimestamp){if($dateTimestamp!=""){return date("l, F d, Y", $dateTimestamp);}}}
if(!function_exists('fb_dateTextShort')){function fb_dateTextShort($dateTimestamp){if($dateTimestamp!=""){return date("M d, Y", $dateTimestamp);}}}
if(!function_exists('fb_dateNum')){function fb_dateNum($dateTimestamp){if($dateTimestamp!=""){return date("m/d/Y", $dateTimestamp);}}}
if(!function_exists('fb_aptNum')){function fb_aptNum($APTtimestamp){return date("m/d/Y g:i a", $APTtimestamp);}}

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  delete_check
//////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('fb_delete_check')){function fb_delete_check($DBtable){
	global $code;
	global $fbadmin;
	if ($_GET['op']=='delete'){
		$code=fb_e($_GET['c']);
		$result=mysql_query("SELECT * FROM `$DBtable` WHERE code='$code' LIMIT 1");
		while($row = mysql_fetch_array($result)) {
			$name=fb_d($row['name']);
			$content=fb_d($row['content']);
			$created=fb_d($row['created']);
			$edited=fb_d($row['edited']);
			$total_items=fb_d($row['total_items']);
		}
		
		if($total_items==1){$item_word="item";}else{$item_word="items";}

		$delete_msg="<img src='".plugin_dir_url(dirname( __FILE__) )."/_btns/btn_largeex_reg.png' style='float:left; margin-right:-28px;' border='0px'><span style='font-size:21px;'>Are you SURE you want this deleted? </span><br><br>This action can NOT be undone.";

		$action="";
		if($_GET['c']!=""){$action=$action."&c=".$_GET['c'];}
		if($_GET['f']!=""){$action=$action."&f=".$_GET['f'];}
		if($_GET['detail']!=""){$action=$action."&detail=".$_GET['detail'];}
		?>
		<form id="form2" name="form2" method="post" action="<?php echo $fbadmin;?>&amp;op=delete_confirm&amp;c=<?php echo $_GET['c'];?>&amp;">
		<?php fb_redBox($delete_msg, 800, 16);?>
		<bR />
		<table class='cc800'>
		<tr><td class='pad7'><span style='font-size:28px;'><?php echo $name; ?></span></td></tr>
        <tr><td class='blueBanner1'><?php echo $total_items." ".$item_word; ?> in this list</td></tr>
		<tr><td class='blueBanner2' style='vertical-align:top;'>
        <table class='cc100'>
		<tr><td class='pad14' colspan='2'><b>NOTES: </b><?php echo $content; ?></td></tr>
		<tr><td style='width:40%; text-align:center' class='pad7'>
        <div class='navMenuRound'><a href='<?php echo $fbadmin;?>'><img src='<?php echo plugin_dir_url(dirname( __FILE__) );?>/_btns/btn_supplies16_reg.png' class='btn' />No, Don't Delete go Back to Lists</a></div>
        </td>
        <td style='width:60%; text-align:center' class='pad7'><input type="submit" name="trash" id="trash" value="Yes, Delete this List and its Items" /></td>
        </tr></table>
		</td></tr></table>
        </form>
		<?php 
	}
}}

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  delete_confirm
//////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('fb_delete_confirm')){function fb_delete_confirm($DBtable){
	global $fbadmin;
	if ($_SERVER['REQUEST_METHOD']=='POST' && $_GET['op']=='delete_confirm'){
		$code=$_GET['c'];
		$saveIt=mysql_query("DELETE FROM `$DBtable` WHERE code='$code' LIMIT 1")or die(mysql_error());
		if(!$saveIt){
			fb_redBox("Error", 800, 21);
		}else{
			mysql_query("DELETE FROM fonebug_items WHERE supply_code='$code'")or die(mysql_error());
			fb_greenBox("Deleted!", 800, 21);
			fb_redirect($fbadmin."&amp;op=newlist", 500);
			die();
		}
	}
}}

function fb_redirect($goto, $wait){
	echo "<script language='javascript'>
			function direct(){
			   window.location='".$goto."';
			   }
			   setTimeout( 'direct();', ".$wait.");
				</script>";
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  listIt
//////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('fb_listSupplyLists')){function fb_listSupplyLists($DBtable){
	global $fbadmin;
	$stagger=0;
	$order=$_GET['o'];
	$desc=$_GET['d'];
	if($order==""){$order="created"; $desc="DESC";}
	if($desc!="DESC"){$desc=""; $descending='&amp;d=DESC';}else{$descending='&amp;';}

	if($order=="name"){$listedby="name";}
	if($order=="content"){$listedby="content";}
	if($order=="created"){$listedby="date created";}
	if($order=="edited"){$listedby="date edited";}
	if($desc=="DESC"){$descmsg=" descending order."; $column_sort_desc=" ascending order";}
	if($desc==""){$descmsg=" ascending order.";$column_sort_desc=" descending order";}

	//======= Get the total number of entries and then add up the total amount based on the filters
	$countIt=mysql_query("SELECT * FROM `$DBtable`");
	$total=mysql_num_rows($countIt); 

	if($total>0){
		//======= COLUMN TABS
		echo "<table class='cc800' style='border-collapse:collapse;'><tr>";
		echo "<td class='tab-left' style='width:200px;'><div class='nav-tab-left'><a href='".$fbadmin."&amp;o=name".$descending."&amp;'>LIST NAME</a></div></td>";
		echo "<td class='tab-middle' style='width:150px;'><div class='nav-tab-middle'><a href='".$fbadmin."&amp;o=created".$descending."&amp;'>CREATED</a></div></td>";
		echo "<td class='tab-middle' style='width:150px;'><div class='nav-tab-middle'><a href='".$fbadmin."&amp;o=edited".$descending."&amp;'>EDITED</a></div></td>";
		echo "<td class='tab-middle' style='width:100px;'><div class='nav-tab-middle'><a href='".$fbadmin."&amp;o=total_items".$descending."&amp;'># ITEMS</a></div></td>";
		echo "<td class='tab-middle' style='width:100px;'><div class='nav-tab-middle'><a href='".$fbadmin."&amp;o=publish".$descending."&amp;'>PUB?</a></div></td>";
		echo "<td class='tab-right-ops' width='100px' style='text-align:left; border:none;'>ACTIONS</td>";
		echo "</tr></table>";

		//======= LIST ITEMS
		echo "<table class='cc800' style='border-collapse:separate;'><tr><td class='blueBanner2' style='padding:0px'>";
		echo "<table  class='cc100'>";
		$result=mysql_query("SELECT * FROM `$DBtable` ORDER BY $order $desc");
		while($row = mysql_fetch_array($result)) {
			$code=fb_d($row['code']);
			$name=fb_d($row['name']);
			$created=fb_dateNum(fb_d($row['created']));
			$edited=fb_dateNum(fb_d($row['edited']));
			$notes=fb_d($row['content']);
			$publish=fb_d($row['publish']);
			$total_items=fb_d($row['total_items']);

			//======= Create the individual receipt row and print the information
			$stagger=fb_stagger($stagger);
			$name=fb_char_lim($name, 35);

			echo "<td class='nopad' style='width:200px;'><div class='navNotes'><a href='".$fbadmin."&amp;detail=".$code."&amp;op=list&amp;' class='b2w'>".$name."</span></a></div></td>";
			echo "<td class='nopad' style='width:150px;'><div class='navNotes'><a href='".$fbadmin."&amp;detail=".$code."&amp;op=list&amp;' class='b2w'>".$created."</a></div></td>";
			echo "<td class='nopad' style='width:150px;'><div class='navNotes'><a href='".$fbadmin."&amp;detail=".$code."&amp;op=list&amp;' class='b2w'>".$edited."</a></div></td>";
			echo "<td class='nopad' style='width:100px;'><div class='navNotes'><a href='".$fbadmin."&amp;detail=".$code."&amp;op=list&amp;' class='b2w'>".$total_items."</a></div></td>";
			echo "<td class='nopad' style='width:100px;'><div class='navNotes'><a href='".$fbadmin."&amp;detail=".$code."&amp;op=list&amp;' class='b2w'>".$publish."</a></div></td>";			
			//-- ACTIONS
			echo "<td class='nopad' width='100px'>";
			echo "<a href='".$fbadmin."&amp;op=editlist&amp;c=".$code."&amp;l=r&amp;' title='Edit'><img src='".plugin_dir_url(dirname( __FILE__) )."/_btns/btn_edit16_reg.png' class='btn'></a>";
			if($notes!=""){
				$notes_text=fb_char_lim(fb_d($notes), 35); 
				echo "<a href='".$fbadmin."&amp;detail=".$code."&amp;op=list&amp;' title='".$notes_text."'><img src='".plugin_dir_url(dirname( __FILE__) )."/_btns/btn_notes16_reg.png' class='btn'></a>";
			}
			echo "<a href='".$fbadmin."&amp;op=delete&amp;c=".$code."&amp;l=r&amp;' title='Edit'><img src='".plugin_dir_url(dirname( __FILE__) )."/_btns/btn_delete16_reg.png' class='btn'>";	
			echo "</td>";
			echo "</tr>";
			echo "</label>";
		}
		echo "</table>";
		echo "</td></tr></table>";
	}
}}

//==================================================================================================
//======= Stagger the TR tag
//==================================================================================================
if(!function_exists('fb_stagger')){function fb_stagger($stagger){
	if($stagger==""){echo "<tr>"; $stagger=1;}else{echo "<tr style='background-color:#ccc'>"; $stagger="";}
	return $stagger;
}}


//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  Footer
//////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('fb_foot')){function fb_foot(){
		echo "<p class='smallG' style='font-weight:normal; color:#ccc'><img src='".plugin_dir_url(dirname( __FILE__) )."/_btns/btn_fonebug16_o.png' class='btn'>Fonebug Supply List for WordPress <br>© Copyright www.fonebug.com</p>";
	}
}