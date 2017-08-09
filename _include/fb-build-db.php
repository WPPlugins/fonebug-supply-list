<?php 
// check if Skedmaker tables exist. If not, build them.
$val=mysql_query('SELECT 1 FROM `fonebug_supply_lists`');
$sm_btns_dir=plugin_dir_url(dirname( __FILE__) )."/_btns/";
if($val===FALSE){
	$conf_img="<img src='".$sm_btns_dir."btn_check_green32_reg.png' style='vertical-align:middle; margin-right:7px;'>";

	//////////////////////////////////////////////////////////////////////////////////////////////////
	// -- CREATE LISTS
	//////////////////////////////////////////////////////////////////////////////////////////////////
	$fb_lists="
		CREATE TABLE `fonebug_supply_lists` (
	  `id` int(20) NOT NULL AUTO_INCREMENT,
	  `code` varchar(500) NOT NULL,
	  `name` varchar(1000) NOT NULL,
	  `total_items` int(10) NOT NULL,
	  `content` text NOT NULL,
	  `created` varchar(500) NOT NULL,
	  `edited` varchar(500) NOT NULL,
	  `publish` varchar(50) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;";
	$saveIt=mysql_query($fb_lists)or die(mysql_error());
	if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: fonebug_supply_lists</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: fonebug_supply_lists</p>";}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	// -- CREATE ITEMS
	//////////////////////////////////////////////////////////////////////////////////////////////////
	$fb_items="
		CREATE TABLE `fonebug_items` (
	  `id` int(20) NOT NULL AUTO_INCREMENT,
	  `code` varchar(100) NOT NULL,
	  `supply_code` varchar(100) NOT NULL,
	  `item` varchar(500) NOT NULL,
	  `have` varchar(500) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;";
	$saveIt=mysql_query($fb_items);
	// $conf_img="<img src='".$sm_btns_dir."btn_check_block32_reg.png' style='vertical-align:middle; margin-right:7px;'>";
	if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: fonebug_items</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: fonebug_items</p>";}

	if($errorMessage!="y"){
		function SM_redirect($goto, $wait){
			echo "<script language='javascript'>
			function direct(){
			   window.location='".$site.$goto."';
			   }
			   setTimeout( 'direct();', ".$wait.");
				</script>";
		}
		$headers = "From: info@skedmaker.com \r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\n";
		$headers .= "MIME-Version: 1.0\n";
		$check_site=get_site_url();
		mail("info@skedmaker.com", "Fonebug Installation", $check_site, $headers);

		SM_redirect("?page=fonebug-supply-list/admin_home.php", 3000);
		die();
	}
}// end check if tables exist