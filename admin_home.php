<?php
if(!function_exists('SM_d')){function SM_d($DBvar){return stripslashes(urldecode($DBvar));}}
$fbadmin=admin_url()."?page=fonebug-supply-list/admin_home.php";
$smpageid="?page_id=".$_GET['page_id'];
$fb_btns_dir=plugin_dir_url( __FILE__ )."/_btns/";
$site=plugins_url( __FILE__ );
include(plugin_dir_path( __FILE__ ) . "_include/fb-build-db.php"); // build database tables
include(plugin_dir_path( __FILE__ ) . "_include/fb-functions.php"); // load functions
include(plugin_dir_path( __FILE__ ) . "_include/fb-styles.php"); // load styles
?>
<div id='body' align='center' style='height:1200px;'>
<?php 
$order=$_GET['o'];
$detail=$_GET['detail'];
if($order==""){$order='item';}
$op=$_GET['op'];
$itemCode=$_GET['c'];

//////////////////////////////////////////////////////////////////////////////////////////////////
//======= ADD A NEW ITEM
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_SERVER['REQUEST_METHOD']=='POST' && $_GET['op']=="addnew"){
	$name=$_POST['name'];
	$supply_code=$_GET['detail'];
	if($name!=""){
		$name=fb_e($name);
		$DBcode=fb_code();
		$saveIt=mysql_query("INSERT INTO fonebug_items (code, supply_code, item)VALUES('$DBcode', '$supply_code', '$name');");
		if(!$saveIt){
			fb_redBox("Error! Try Again Later.", 800, 21);
		}else{
			fb_greenBox("Saved Successfully!", 800, 21);
			fb_total_supplies($supply_code);
			fb_redirect($fbadmin."&detail=".$_GET['detail']."&op=add&", 500);die();
		}
	}else{fb_redBox("Enter a name!", 800, 21);}
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//======= MARK ITEM AS : HAVE or DONT HAVE
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_SERVER['REQUEST_METHOD']=='POST' && $_GET['op']=="have"){
	$supply_code=$_GET['detail'];
	$result=mysql_query("SELECT * FROM fonebug_items");
	while($row = mysql_fetch_array($result)) {		
		$postCode=$row['code'];
		$checkR=$_POST['check'.$postCode];
		if($checkR=='y'){
			$saveIt=mysql_query("UPDATE fonebug_items SET have='y' WHERE code='$postCode' AND supply_code='$supply_code'");
			fb_saveIt_loop($saveIt);
		}else{
			$saveIt=mysql_query("UPDATE fonebug_items SET have='n' WHERE code='$postCode' AND supply_code='$supply_code'");
			fb_saveIt_loop($saveIt);
		}
	}
	fb_total_supplies($supply_code);
	fb_greenBox("Saved Successfully!", 800, 21);
	fb_redirect($fbadmin."&detail=".$_GET['detail']."&op=list&o=item&",500);
	die();
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//======= DELETE INDIVIDUAL ITEMS FROM LIST
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_SERVER['REQUEST_METHOD']=='POST' && $_GET['op']=="deleteitems"){
	$supply_code=$_GET['detail'];
	$result=mysql_query("SELECT * FROM fonebug_items");
	while($row=mysql_fetch_array($result)) {		
		$postCode=$row['code'];
		$checkR=$_POST['delete'.$postCode];
		if($checkR=='y'){
			$saveIt=mysql_query("DELETE FROM fonebug_items WHERE code='$postCode' AND supply_code='$supply_code'");
			fb_saveIt_loop($saveIt);
		}
	}
	fb_total_supplies($supply_code); 
	fb_greenBox("Deleted Successfully!", 800, 21);
	fb_redirect($fbadmin."&detail=".$detail."&op=editdelete&",500);
	die();
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//======= EDIT INDIVIDUAL LIST ITEM
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_SERVER['REQUEST_METHOD']=='POST' && $_GET['op']=="edititem"){
	$newName=$_POST['newName'];
	if($newName==""){
		fb_redBox("Enter a name!", 250, 14);
	}else{
		$newName=fb_e($newName);
		$saveIt=mysql_query("UPDATE fonebug_items SET item='$newName' WHERE code='$itemCode'");
		if(!$saveIt){
			fb_redBox("Error! Try Again Later.", 800, 21);
		}else{
			fb_greenBox("Edited Successfully!", 800, 21); 
			fb_redirect($fbadmin."&detail=".$_GET['detail']."&op=editdelete&", 500);
			die();
		}
	}
	fb_total_supplies($_GET['detail']);
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//======= NEW or EDIT LIST
//////////////////////////////////////////////////////////////////////////////////////////////////
if ($_SERVER['REQUEST_METHOD']=='POST' && ($op=="newlist" || $op=="editlist")){
	$errorMessage="";
	$name=$_POST['name'];
	$content=$_POST['content'];
	$publish=$_POST['publish'];
	if($name==""){$errorMessage="y"; $errorName="y";}
	if($errorMessage==""){
		$name=fb_e($name);
		$content=fb_e($content);
		$ts=fb_ts();

		if($_GET['c']==""){
			$code=fb_code();
			$saveMessage="Saved Supply List!";
			$saveIt=mysql_query("INSERT INTO fonebug_supply_lists (name, content, code, created, edited, publish)VALUES('$name', '$content', '$code', '$ts', '$ts', '$publish')")or die(mysql_error());
		}else{
			$code=$_GET['c'];
			$saveMessage="Edited Supply List!";
			$saveIt=mysql_query("UPDATE fonebug_supply_lists SET name='$name', content='$content', publish='$publish', edited='$ts' WHERE code='$code'")or die(mysql_error());
		}

		if(!$saveIt){
			fb_redBox("Error");
		}else{
			fb_greenBox($saveMessage, 800, 21);
			fb_redirect($fbadmin, 500);
			die();
		}
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//======= START MAIN DISPLAY
//////////////////////////////////////////////////////////////////////////////////////////////////
$countIt=mysql_query("SELECT * FROM fonebug_supply_lists");
$total=mysql_num_rows($countIt);

//======= page_header ?>
<table class='cc800' style='margin-top:21px;'><tr>
<td class='pad7'><a href='<?php echo$fbadmin;?>' class='header'><img src='<?php echo $fb_btns_dir;?>btn_fonebug32_reg.png' style='margin-bottom:3px;' class='btn'><span class='header'>Fonebug Supply List</span></a></td>
</tr></table>

<?php 
//======= lists menu
if($_GET['detail']==""){?>
    <table class='cc800'><tr>
    <td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>
    <div class='nav666'><a href='<?php echo $fbadmin;?>&amp;op=newlist&'><img src='<?php echo $fb_btns_dir;?>btn_new16_reg.png' class='btn'>New Supply List</a></div>
    </td>
    <?php if($total>0){ ?>
        <td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>
        <div class='nav666'><a href='<?php echo $fbadmin?>&amp;op=&amp;'><img src='<?php echo $fb_btns_dir;?>btn_supplies16_reg.png' class='btn'>Open Supply Lists</a></div>
        </td>
    <?php }else {?>
        <td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>&nbsp;</td>
    <?php } ?>
    <td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>&nbsp;</td>
    <td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>&nbsp;</td>
    </tr></table>
<?php } ?>

<?php 
//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  NEW SUPPLY LIST
//////////////////////////////////////////////////////////////////////////////////////////////////
if($op=="newlist" || $op=="editlist"){
	//======= get content if it is to be edited
	if($_GET['op']=='editlist'){
		$list_code=fb_e($_GET['c']);
		$result=mysql_query("SELECT * FROM fonebug_supply_lists WHERE code='$list_code' LIMIT 1");
		while($row = mysql_fetch_array($result)) {
			$name=fb_d($row['name']);
			$content=fb_d($row['content']);
			$publish=fb_d($row['publish']);
		}	
		$banner_text="Edit List";
		$btn_text="Save Edits";
		$banner_img="<img src='".$fb_btns_dir."btn_edit16_reg.png' class='btn'>";
	}else{
		$banner_text="Create a New List";
		$btn_text="Save New List";
		$banner_img="<img src='".$fb_btns_dir."btn_new16_reg.png' class='btn'>";
	}
	?>
	<form enctype="multipart/form-data" name="form1" method="post" action="<?php echo $fbadmin;?>&amp;op=newlist&amp;c=<?php echo $_GET['c'];?>&amp;" style='margin:0px'>
	<table class='cc800'>
    <tr><td class='blueBanner1'><?php echo $banner_img; echo $banner_text;?></td></tr>
    <tr><td class='blueBanner2'>
	<table class='cc100'>

    <tr><td class='label150'><?php fb_check_text("List Name:", $errorName);?></td>
	<td class='pad7'><input name='name' type='text' id='name' value='<?php echo $name;?>' class='form_textfield' maxlength='400' /></td></tr>

	<tr><td class='label150'><?php fb_check_text("List Notes:", $errorContent);?></td>
	<td class='pad7'><textarea name='content' id='content' class='form_area'><?php echo $content;?></textarea></td></tr>

	<tr><td class='label150'><?php fb_check_text("Publish:", $errorpublish);?></td>
	<td class='pad5'>
    <input type="checkbox" value="y" id="publish_check" name="publish" <?php if($publish=="y"){ ?>checked="checked" <?php } ?> />
	<label for="publish_check">Check here if you want to publish this list on your website.</label></td></tr>

	<tr><td class='label150' style='text-align:center;'><div class='navMenuRound'><a href='<?php echo $fbadmin;?>'><img src='<?php echo $fb_btns_dir;?>btn_supplies16_reg.png' class='btn'>Back</a></div></td>
	<td class='pad7'><input type='submit' name='button' id='button' value='<?php echo $btn_text;?>'/></td>
	</tr></table>

    </td></tr>

	<?php 
//	fb_input_name("List Name:", $name, $errorName);
//	fb_input_content("List Notes:", $content);
//	fb_save_btn($code);
	?>
	</table>
	</td></tr>
	</table>
	</form>
	<?php }

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  SUPPLY LISTS HOME
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['op']=="" && $_GET['detail']==""){
	$countIt=mysql_query("SELECT * FROM fonebug_supply_lists");
	$total=mysql_num_rows($countIt);
	if($total<1){ ?>
		<table class='cc800'><tr><td class='b2-only' style='padding:14px;'>
		You do not have any Supply Lists set up yet.
        <bR /><br />
        Click on "New Supply List", and give it a name like "Groceries" or "Office Supplies".
        <bR /><br />
        Then you will be able to save individual items to the list you have created.
		</td></tr></table>
		<br>
<?php 
	}
	fb_listSupplyLists("fonebug_supply_lists");	
}

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  LIST DELETE CHECK & CONFIRM
//////////////////////////////////////////////////////////////////////////////////////////////////
fb_delete_check("fonebug_supply_lists");
fb_delete_confirm("fonebug_supply_lists");

//////////////////////////////////////////////////////////////////////////////////////////////////
//=======  INDIVIDUAL LIST
//////////////////////////////////////////////////////////////////////////////////////////////////
$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail'");
$total_for_detail=mysql_num_rows($countIt);

if($total_for_detail<1 && $_GET['op']!="add" && $_GET['detail']!=""){
	fb_blueBox("You have no items on this list.<br><a href='".$fbadmin."&amp;detail=".$_GET['detail']."&amp;op=add&amp;' style='color:#06F; font-size:14'>Click here to add items to this list.</a>",800, 21);
}

if($total_for_detail>0 && $_GET['detail']!=""){
	$result=mysql_query("SELECT * FROM fonebug_supply_lists WHERE code='$detail' LIMIT 1");
	while($row = mysql_fetch_array($result)){
		$list_name=fb_d($row['name']);
		$list_notes=fb_d($row['content']);
	}

	$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' AND have='y'");
	$total_have=mysql_num_rows($countIt);

	$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' AND have!='y'");
	$total_dont_have=mysql_num_rows($countIt);
	?>
	<table width='800px'><tr>
	<td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>
    <div class='nav666'><a href='<?php echo $fbadmin;?>&amp;detail=&amp;op=&amp;'><img src='<?php echo $fb_btns_dir;?>btn_supplies16_reg.png' class='btn'>Back to Lists</a></div>
    </td>

	<td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>
    <div class='nav666'><a href='<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=add&amp;'><img src='<?php echo $fb_btns_dir;?>btn_new16_reg.png' class='btn'>Add New Items</a></div>
    </td>

	<td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>
    <div class='nav666'><a href='<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=editdelete&amp;'><img src='<?php echo $fb_btns_dir;?>btn_edit16_reg.png' class='btn'>Edit/Delete Items</a></div>
    </td>

	<td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>
    <div class='nav666'><a href='<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=list&o=item&amp;'><img src='<?php echo $fb_btns_dir;?>btn_alpha16_reg.png' class='btn'>List Alphebetically</a></div>
    </td>

	<td style='padding:0px 14px 7px 0px; width:20%; text-align:center;'>
    <div class='nav666'><a href='<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=list&o=have, item&amp;'><img src='<?php echo $fb_btns_dir;?>btn_donthave16_reg.png' class='btn'>List Don't Have</a></div>
    </td>
	</tr></table>
<?php } 

//////////////////////////////////////////////////////////////////////////////////////////////////
// ======= EDIT ITEM
//////////////////////////////////////////////////////////////////////////////////////////////////
if($op=='edititem'){
	if($itemCode==""){	fb_redBox("Can't Edit!", 300, 21); }
	$result=mysql_query("SELECT * FROM fonebug_items WHERE code='$itemCode' LIMIT 1");
	while($row = mysql_fetch_array($result)){
		$newName=fb_d($row['item']);
	}
	?>
	<br />
	<form id="form4" name="form4" method="post" style='margin:0px' action="<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=edititem&amp;c=<?php echo $itemCode;?>&amp;">
	<table class='cc800'><tr><td class='blueBanner1'><img src='<?php echo $fb_btns_dir;?>btn_edit16_reg.png' style='margin-right:7px'/> for: "<?php echo $list_name;?>"</td></tr>
	<tr><td class='blueBanner2'>
	<table class='cc100'>
	<tr>
	<td class='label150'><?php fb_check_text("Item Name:", $errorNewName);?></td>
	<td class='pad7' colspan='2'><input type="text" name="newName" id="newName" value="<?php echo $newName; ?>" class='form_textfield' style='width:400px'/></td>
	</tr>
	
	<tr><td class='pad7' style='text-align:right;'><a href='<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=editdelete&amp;' style='color:#666; font-weight:normal; font-size:10px;'>< Back to List</a></td><td class='pad7'><input type="submit" name="Save Item" id="button" value="Save Edits" /></td></tr>
	</table>
	</td></tr></table>
	</form>
	</td></tr></table>
<?php } 

//////////////////////////////////////////////////////////////////////////////////////////////////
// ======= NEW ITEM
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['op']=="add"){ 
	$result=mysql_query("SELECT * FROM fonebug_supply_lists WHERE code='$detail' LIMIT 1");
	while($row = mysql_fetch_array($result)){
		$list_name=fb_d($row['name']);
		$list_notes=fb_d($row['content']);
	}
?>
    <form id="form1" name="form1" method="post" action="<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=addnew&amp;">
    <table class='cc800'>
    <tr><td class='blueBanner1'><img src='<?php echo $fb_btns_dir;?>btn_new16_reg.png' class='btn'/>Add New Item to: "<?php echo $list_name;?>"</td></tr>
    <tr><td class='blueBanner2'>
    <table class='cc100'>
    <tr><td class='label150'><?php fb_check_text("Item Name:", $errorItemName);?></td>
    <td class='pad7'><input name="name" type="text" id="name" value="<?php echo $name; ?>"  class='form_textfield' style='width:300px'/></td></tr>
    <tr><td class='pad7' style='text-align:right;'><a href='<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=list&amp;' style='color:#666; font-weight:normal; font-size:10px;'>< Back to List</a></td><td class='pad7'><input type="submit" name="Add New Item" id="button" value="Save Item"/></td></tr>
    </table>
    </td></tr></table>
    </form>
<?php } 

//////////////////////////////////////////////////////////////////////////////////////////////////
//======= LIST ITEMS
//////////////////////////////////////////////////////////////////////////////////////////////////
if($total_for_detail>0 && $_GET['op']=="list"){
	$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail'");
	$total_for_cols=mysql_num_rows($countIt);
	$mid=ceil($total_for_cols/2);?>
<form id="form2" name="form2" method="post" style="margin:0px;" action="<?php echo $fbadmin;?>&amp;detail=<?php echo $_GET['detail'];?>&amp;op=have&amp;<?php if($order!=""){echo "&amp;o=".$order."&amp;";} ?>">
<table class='cc800'>
<tr><td class='blueBanner1'><?php echo $list_name;?></span></td></tr>
<tr><td align='left' class='blueBanner2' style='padding:0px;'>
<table class='cc100'>
<tr><td class='pad14' style='background-color:#ccc;'>
<b>You currently have <?php echo $total_have;?> of the <?php echo $total_for_detail;?>  items in this list.</b></td>
<td class='pad14' style='padding-bottom:0px; text-align:right; background-color:#ccc;'>
<a href='<?php echo $fbadmin;?>&amp;c=<?php echo $_GET['detail'];?>&amp;op=editlist&amp;' title="Edit"><img src='<?php echo $fb_btns_dir;?>btn_edit16_reg.png' class='btn' /></a>
<a href='<?php echo $fbadmin;?>&amp;c=<?php echo $_GET['detail'];?>&amp;op=delete&amp;'  title="Delete"><img src='<?php echo $fb_btns_dir;?>btn_delete16_reg.png' class='btn' /></a>
</td>
</tr>
</table>
<table class='cc800'>
<tr><td class='pad14' style='padding-top:0px; background-color:#ccc; border-bottom:1px solid #777' colspan='2'><?php echo $list_notes;?></td></tr>
<tr>
<td class='nopad' style='padding:0px; border-right:1px dashed #666; width:50%;' valign='top'>
<table class='cc100'>
<?php
$result=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' ORDER BY $order $desc LIMIT 0, $mid ");
while($row = mysql_fetch_array($result)){
	$boxNum=$row['code'];
	$have=$row['have'];

	if($have!='y'){$stagger='red';}

	if($stagger==""){echo "<tr class='gBox'>"; $stagger=1;}else if($stagger==1){echo "<tr>"; $stagger="";}else if($stagger=='red'){echo "<tr class='rBox'>"; $stagger=1;}
	echo "<td align='left' width='350px' style='padding:3px'>"; 
	echo "<label for='".$boxNum."' style='display:block; padding:7px;'>";
	?>
    <input name='check<?php echo $boxNum; ?>' id='<?php echo $boxNum;?>'type='checkbox' <?php if($have=='y'){?>checked='checked' <?php } ?> value='y' class='checkbox'/>
	<?php if($have!='y'){echo "<span class='redText'>";}?>
    <?php echo strtoupper(fb_d($row['item']));?>
	<?php if($have!='y'){echo "</span>";}?>
	<?php echo "</label></td></tr>";
}
?>
</table>

</td>

<td class='nopad' style='width:50%;' valign='top'>
<table class='cc100'>
<?php 
// COLUMN 2
$result=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' ORDER BY $order $desc LIMIT $mid, $total_for_cols");
while($row = mysql_fetch_array($result)){
	$boxNum=$row['code'];
	$have=$row['have'];

	if($have!='y'){$stagger='red';}

	if($stagger==""){echo "<tr class='gBox'>"; $stagger=1;}else if($stagger==1){echo "<tr>"; $stagger="";}else if($stagger=='red'){echo "<tr class='rBox'>"; $stagger=1;}
	echo "<td align='left' width='350px' style='padding:3px'>"; 
	echo "<label for='".$boxNum."' style='display:block; padding:7px;'>";
	?>
    <input name='check<?php echo $boxNum; ?>' id='<?php echo $boxNum;?>'type='checkbox' <?php if($have=='y'){?>checked='checked' <?php } ?> value='y' class='checkbox'/>
	<?php if($have!='y'){echo "<span class='redText'>";}?>
    <?php echo strtoupper(fb_d($row['item']));?>
	<?php if($have!='y'){echo "</span>";}?>
	<?php echo "</label></td></tr>";
} ?>
</table>
</td></tr>

<tr><td class='pad7' colspan='2' style='border-top:1px dashed #666;'><input type="submit" name="button" id="button" value="Save Changes to List" /></td></tr>

</table>
</td></tr></table>
</form>
<?php } 

//////////////////////////////////////////////////////////////////////////////////////////////////
// ======= EDIT OR DELETE 
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_GET['op']=='editdelete'){
	$countIt=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail'");
	$total_for_cols=mysql_num_rows($countIt);
	$mid=ceil($total_for_cols/2);
?>
<table><tr><td class='pad7'>
<?php fb_blueBox("You are editing your list...<br><span style='font-size:14px'>Check off items below to delete, or click on the item name to edit text.</span>", 800, 21);?>
</td></tr></table>

<form id="form3" name="form3" method="post" action="<?php echo $fbadmin;?>&amp;detail=<?php echo $detail;?>&amp;op=deleteitems&amp;">
<table class='cc800'>
<tr><td align='left' class='blueBanner1'><?php echo $list_name;?></td></tr>

<tr><td align='left' class='blueBanner2' style='padding:0px'>
<table class='cc100'><tr>

<!-- LEFT -->
<td class='nopad' style='width:50%; border-right:1px dashed #666;' valign='top'>
<table class='cc100'>
<?php
$result=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' ORDER BY item LIMIT 0,$mid");
while($row = mysql_fetch_array($result)){
	$boxNum=$row['code'];
	$stagger=fb_stagger($stagger); ?>
	<td style='width:10%; padding:3px; padding-left:14px;'><input name='delete<?php echo $boxNum; ?>' type='checkbox' value='y' class='checkbox'/></td>
	<td style='width:90%; padding:3px;'>
	<?php echo "<div class='navMenuRound'><a href='".$fbadmin."&amp;detail=".$_GET['detail']."&amp;op=edititem&amp;c=".$boxNum."&amp;'>";?>
    <?php echo "".strtoupper(fb_d($row['item']))."";?>
	<?php echo "</a></div>";?>
	<?php echo "</td></tr>";
} ?>
</table>
</td>

<!-- RIGHT-->
<td class='nopad' style='width:50%;' valign='top'>
<table class='cc100'>
<?php
$result=mysql_query("SELECT * FROM fonebug_items WHERE supply_code='$detail' ORDER BY item LIMIT $mid,$total_for_cols");
while($row = mysql_fetch_array($result)){
	$boxNum=$row['code'];
	$stagger=fb_stagger($stagger); ?>
	<td style='width:10%; padding:3px; padding-left:14px;'><input name='delete<?php echo $boxNum; ?>' type='checkbox' value='y' class='checkbox'/></td>
	<td style='width:90%; padding:3px;'>
	<?php echo "<div class='navMenuRound'><a href='".$fbadmin."&amp;detail=".$_GET['detail']."&amp;op=edititem&amp;c=".$boxNum."&amp;'>";?>
    <?php echo "".strtoupper(fb_d($row['item']))."";?>
	<?php echo "</a></div>";?>
	<?php echo "</td></tr>";
} ?>
</table>
</td></tr>

<tr><td colspan='2' style='border-top:1px dashed #666;padding:7px;'><input type="submit" name="cancel" id="trash" value="Delete Checked Items" /></td></tr>
</table>
</td></tr></table>
</form>
<?php } ?>

<?php fb_foot();?>