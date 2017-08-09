<?php
$fb_btns_dir=plugin_dir_url( __FILE__ )."/_btns/";
$site=plugins_url( __FILE__ );
include(plugin_dir_path( __FILE__ ) . "_include/fb-functions.php"); // load functions
include(plugin_dir_path( __FILE__ ) . "_include/fb-styles.php"); // load styles
$countIt=mysql_query("SELECT * FROM fonebug_supply_lists WHERE publish='y'");
$total=mysql_num_rows($countIt);

if($total>0){
	if($_GET['detail']==""){
		echo "<table class='cc100' style='margin:0px;'>";
		$result=mysql_query("SELECT * FROM fonebug_supply_lists WHERE publish='y'");
		while($row = mysql_fetch_array($result)){
			$list_name=fb_d($row['name']);
			$list_code=fb_d($row['code']);
			$total_items=fb_d($row['total_items']);
			$this_code=fb_d($row['code']);
			$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$this_code' AND have='y'");
			$total_have=mysql_num_rows($countIt);

			$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$this_code' AND have!='y'");
			$total_dont_have=mysql_num_rows($countIt);
			
			echo "<tr><td class='pad7' style='padding-bottom:3px;'><a href='".fb_permalink()."&amp;detail=".$list_code."&amp;' style='font-size:16px; font-weight:bold;'>".$list_name."</a></td></tr>";
			echo "<tr><td class='pad7' style='border-bottom:1px dotted #666; padding-top:0px;'><span class='smallG12'>Have: ".$total_have.", Don't Have: ".$total_dont_have.", Total: ".$total."</a></td></tr>";
		}
		echo "</table>";
		echo "<bR>";
	}else{
		$detail=fb_e($_GET['detail']);
		$result=mysql_query("SELECT * FROM fonebug_supply_lists WHERE code='$detail' LIMIT 1");
		while($row = mysql_fetch_array($result)){
			$list_name=fb_d($row['name']);
			$list_notes=fb_d($row['content']);
		}
		
		$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' AND have='y'");
		$total_have=mysql_num_rows($countIt);

		$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' AND have!='y'");
		$total_dont_have=mysql_num_rows($countIt);

		$total=$total_have+$total_dont_have;
		echo "<table class='cc100' style='border-collapse:separate;'>";
		echo "<tr><td class='pad7' colspan='2'><span style='font-size:21px;'><b>".$list_name."</span></td></tr>";
		echo "<tr style='background-color:#666;'>";
		echo "<td class='pad7' style='padding-left:14px; background-color:#666; -moz-border-radius-topleft:7px; -webkit-border-top-left-radius:7px; border-top-left-radius:7px; overflow:hidden; border:0px;'>";
		echo "<span style='color:#fff;'><b>Have: </b>".$total_have.", <b>Don't Have: </b>".$total_dont_have.", <b>Total: </b>".$total."</span>";
		echo "</td>";

		echo "<td class='pad7' style='background-color:#666; -moz-border-radius-topright:7px; -webkit-border-top-right-radius:7px; border-top-right-radius:7px; overflow:hidden; border:0px;'>";
		echo "<a href='".fb_permalink()."' style='font-size:13px; color:#fff; font-weight:normal;'>Back to Lists</a>";
		echo " ~ ";
		echo "<a href='#' onClick='window.print();' style='font-size:13px; font-weight:normal; color:#fff; '>Print Page</a>";
		echo "</td></tr>";
		echo "<tr><td class='pad14' style='-moz-border-radius-bottomleft:7px; -webkit-border-bottom-left-radius:7px; border-bottom-left-radius:7px; -moz-border-radius-bottomright:7px; -webkit-border-bottom-right-radius:7px; border-bottom-right-radius:7px;  overflow:hidden; border:1px solid #666; background-color:#e9e9e9;' colspan='2'>".$list_notes."</td></tr>";
		echo "</table>";
		echo "<table class='cc100' style='margin:0px;'>";
		$result=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' ORDER BY item");
		while($row = mysql_fetch_array($result)){
			$item_name=fb_d($row['item']);
			$have=fb_d($row['have']);
			echo "<tr><td class='pad14' style='padding-top:0px;'>";
			if($have=="y"){
				echo "<img src='".$fb_btns_dir."btn_check_green16_reg.png' class='btn'><span class='greenText' style='font-weight:normal;'>".$item_name."</span>";
			}else{
				echo "<img src='".$fb_btns_dir."btn_donthave16_reg.png' class='btn'><span class='redText' style='font-weight:normal;'>".$item_name."</span><br>";
			}
			echo "</td></tr>";
		}
		echo "</table>";
		echo "<br>";
		
	}

}else{
	echo "No lists are set to public.";
}
fb_foot();