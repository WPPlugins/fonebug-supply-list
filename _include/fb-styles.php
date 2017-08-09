<?php 
$sm_btns_dir=plugin_dir_url(dirname( __FILE__) )."/_btns/"; // use dirname to go up one directory
$css_img_dir=$sm_btns_dir;
$b1_color="233C49";	
$b1_highlight="09F";
$b2_color="E0E9E9";
$b3_color="69C";
$round=" -moz-border-radius:7px !important; -webkit-border-radius:7px !important; border-radius:7px !important; overflow:hidden !important;";
?>
<style type="text/css">

body,td,th {font-family:Verdana, Geneva, sans-serif;font-size:14px; color:#000; margin:0px}

/*=================================================
======= IMAGES =======
=================================================*/
img.btn {border:none; margin-right:7px; vertical-align:middle;}

/*=================================================
======= FORMS=======
=================================================*/
.form_textfield{
	border:1px solid #999 !important;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#333333;
	width:100%;
	padding:7px;
	height:35px;
	vertical-align:middle;
	<?php echo $round;?>
}

.form_area{
	border:1px solid #999999 !important;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#333333;
	padding:7px;
	width:100%;
	<?php echo $round;?>
}

.form_select{
	border:1px solid #999999 !important;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#333333;
	padding:5px;
	height:28px;
	-moz-border-radius:7px 0px 0px 7px;
    -webkit-border-radius:7px 0px 0px 7px;
    border-radius:7px 0px 0px 7px;
	padding-left:7px;
}

.nav-tab-left a:link{
	display: block;	background-color:#<?php echo $b1_color;?>;	color:#fff; text-decoration: none; padding:7px;
	-moz-border-radius-topleft: 7px;
    -webkit-border-top-left-radius: 7px;
    border-top-left-radius:7px;
}
.nav-tab-left a:visited{
	display: block;	background-color:#<?php echo $b1_color;?>;	color:#fff; text-decoration: none; padding:7px;
	-moz-border-radius-topleft: 7px;
    -webkit-border-top-left-radius: 7px;
    border-top-left-radius:7px;
}
.nav-tab-left a:hover{
	display: block;	background-color:#<?php echo $b1_highlight;?>;	color:#fff; text-decoration: none; padding:7px;
	-moz-border-radius-topleft: 7px;
    -webkit-border-top-left-radius: 7px;
    border-top-left-radius:7px;
}
.nav-tab-left a:active{
	display: block;	background-color:#<?php echo $b1_highlight;?>;	color:#fff; text-decoration: none; padding:7px;
	-moz-border-radius-topleft: 7px;
    -webkit-border-top-left-radius: 7px;
    border-top-left-radius:7px;
}

.nav-tab-middle a:link{		display: block;	background-color:#<?php echo $b1_color;?>;	color:#fff; text-decoration: none; padding:7px;}
.nav-tab-middle a:visited{	display: block;	background-color:#<?php echo $b1_color;?>;	color:#fff; text-decoration: none; padding:7px;}
.nav-tab-middle a:hover{	display: block;	background-color:#<?php echo $b1_highlight;?>;	color:#fff; text-decoration: none; padding:7px;}
.nav-tab-middle a:active{	display: block;	background-color:#<?php echo $b1_highlight;?>;	color:#fff; text-decoration: none; padding:7px;}


/*=================================================
======= LINKS =======
=================================================*/
a.sked:link 	{color:#000; text-decoration:none; font-weight:bold;}
a.sked:visited 	{color:#000; text-decoration:none; font-weight:bold;}
a.sked:hover 	{color:#<?php echo $b1_color;?>; text-decoration:none; font-weight:bold;}
a.sked:active 	{color:#366; text-decoration:none; font-weight:bold;}

a.skedblue:link 	{color:#06F; text-decoration:none; font-weight:bold;}
a.skedblue:visited 	{color:#06F; text-decoration:none; font-weight:bold;}
a.skedblue:hover 	{color:#06F; text-decoration:none; font-weight:bold;}
a.skedblue:active 	{color:#06F; text-decoration:none; font-weight:bold;}

a.b2w :link 	{color:#000; text-decoration:none; font-weight:regular;}
a.b2w :visited	{color:#000; text-decoration:none; font-weight:regular;}
a.b2w :hover	{color:#fff; text-decoration:none; font-weight:regular;}
a.b2w :active	{color:#fff; text-decoration:none; font-weight:regular;}

a.cancel:link {color:#F00;text-decoration:none; font-weight:normal;}
a.cancel:visited {text-decoration:none;color:#F00; font-weight:normal;}
a.cancel:hover {text-decoration:none;color:#F00; font-weight:normal;}
a.cancel:active {text-decoration:none;color:#F00; font-weight:normal;}

a.smallG:link {color:#666;text-decoration:none; font-weight:normal; font-size:10px}
a.smallG:visited {color:#666;text-decoration:none; font-weight:normal; font-size:10px}
a.smallG:hover {color:#233C49;text-decoration:none; font-weight:normal; font-size:10px}
a.smallG:active {color:#233C49;text-decoration:none; font-weight:normal; font-size:10px}

a.header:link {font-size:28px; font-weight:normal; color:#000; text-decoration:none;}
a.header:visited {font-size:28px; font-weight:normal; color:#000; text-decoration:none;}
a.header:hover {font-size:28px; font-weight:normal; color:#000; text-decoration:none;}
a.header:active {font-size:28px; font-weight:normal; color:#000; text-decoration:none;}

input[type=submit]{padding:7px;}

/*=================================================
======= HR =======
=================================================*/
hr {background-color:#366; color:#366; height:2px; border:0;}

/*=================================================
======= TABLES =======
=================================================*/
<?php 
if ( wp_is_mobile() ){ ?>
table.cc100{border:none; padding:0px; border-spacing:0px; width:100%; *border-collapse:expression('separate', cellSpacing = '0px') !important;  margin:0px !important;}
table.cc600{border:none; padding:0px; border-spacing:0px; width:100%; *border-collapse:expression('separate', cellSpacing = '0px') !important; margin:0px !important;}
table.cc800{border:none; padding:0px; border-spacing:0px; width:100%; *border-collapse:expression('separate', cellSpacing = '0px') !important; margin:0px !important;}

<?php }else{ ?>
table.cc100{border:none; padding:0px; border-spacing:0px; width:100%; *border-collapse:expression('separate', cellSpacing = '0px') !important;}
table.cc600{border:none; padding:0px; border-spacing:0px; width:600px; *border-collapse:expression('separate', cellSpacing = '0px') !important;}
table.cc800{border:none; padding:0px; border-spacing:0px; width:800px; *border-collapse:expression('separate', cellSpacing = '0px') !important;}

<?php } ?>

/*=================================================
======= TR =======
=================================================*/
tr.g666{background-color:#e9e9e9; <?php echo $round;?>}
tr.menu{background-color:#ccc; border-bottom:1px dotted #666;}

/*=================================================
======= TD =======
=================================================*/
td.menu{border-bottom:1px dotted #666; padding:0px;}
.gBox{ background-color:#E6E6E6; text-align:left; padding:5;}
td.redBox{background-color:#FCC;padding:14px;border:3px solid #F00; -moz-border-radius:7px !important; -webkit-border-radius:7px !important; border-radius:7px !important; overflow:hidden !important;}
td.greenBox{background-color:#CFC; padding:14px; border:3px solid #093; <?php echo $round;?>}
td.blueBox{padding:14px; text-align:center; background-color:#E2F8FE; border:3px solid #06F;<?php echo $round;?>}
td.btn{background-color:#88B3CA; border:1px solid #233C49; padding:0px; vertical-align:middle;}
td.orangeBox{background-color:#FFC; padding:14px; border:2px solid #F63; color:#F63; font-weight:bold; <?php echo $round;?>}

.rBox{ background-color:#FCCAC5; border:1px solid #900; text-align:left; padding:7px;}

td.blueBanner1{
    -moz-border-radius-topleft:7px;
    -webkit-border-top-left-radius:7px;
    border-top-left-radius:7px;
    -moz-border-radius-topright:7px;
    -webkit-border-top-right-radius:7px;
    border-top-right-radius:7px;	
	overflow:hidden;
	background-color:#<?php echo $b1_color;?>;padding:7px 7px 7px 14px;color:#fff; font-weight:bold;
	<?php if(wp_is_mobile()){?>font-size:16px;<?php }else{?> font-size:18px; <?php } ?>text-align:left;
	border:none !important;
}

td.blueBanner2{
	 border:none !important;
	background-color:#<?php echo $b2_color;?> ;padding:10px; border:1px solid #<?php echo $b1_color; ?> !important; text-align:left;
    -moz-border-radius-bottomleft:7px !important;
    -webkit-border-bottom-left-radius:7px !important;
    border-bottom-left-radius:7px !important;
    -moz-border-radius-bottomright:7px !important;
    -webkit-border-bottom-right-radius:7px !important;
    border-bottom-right-radius:7px; !important;
	overflow:hidden !important;
}

td.b2-only{background-color:#<?php echo $b2_color;?>;padding:10px;border:1px solid #<?php echo $b1_color; ?>; text-align:left;<?php echo $round; ?>}

/*=================================================
======= PADDING TD
=================================================*/
td.nopad{padding:0px; text-align:left;border:none;}
td.pad5{padding:5px; text-align:left;border:none;}
td.pad7{padding:7px; text-align:left;border:none;}
td.pad10{padding:10px; text-align:left;border:none;}
td.pad14{padding:14px; text-align:left;border:none;}
td.pad21{padding:21px; text-align:left;border:none;}

/*=================================================
======= FORM LABEL TDs
=================================================*/

<?php if(wp_is_mobile()){
	$label150="15%";
}else{
	$label150="150px";	
}
?>

td.label50{padding:7px; text-align:right; font-weight:bold; vertical-align:middle; width:50px; font-size:10px;border:none; }
td.label100{padding:7px; text-align:right; font-weight:bold; vertical-align:middle; width:100px; font-size:14px;border:none; }
td.label100top{padding:7px; text-align:right; font-weight:bold; vertical-align:top; width:100px;border:none; }
td.label150{padding:7px; text-align:right; font-weight:bold; vertical-align:middle; width:15%;border:none; }
td.label150top{padding:7px; text-align:right; font-weight:bold; vertical-align:top; width:150px;border:none; }
td.label150s{padding:5px; text-align:right; font-weight:bold; vertical-align:middle; width:150px; font-size:10px;border:none; }
td.label200{padding:7px; text-align:right; font-weight:bold; vertical-align:middle; width:200px; font-size:14px;border:none; }

/*=================================================
======= COLUMN HEADERS ON LISTS
=================================================*/
.tab{
	background-color:#<?php echo $b1_color;?>;
	text-align:left;
	font-weight:bold;
	color:#fff;
	font-size:14px;
	padding:0px; 
}

.tab-left{
	background-color:#<?php echo $b1_color;?>;
	text-align:left;
	font-weight:bold;
	color:#fff;
	font-size:14px;
	padding:0px; 
	border-left:1px solid #<?php echo $b1_color;?>;
    -moz-border-radius-topleft:7px;
    -webkit-border-top-left-radius:7px;
    border-top-left-radius:7px;
}

.tab-right-ops{
	border-bottom:0px;
	background-color:#<?php echo $b1_color;?>;
	text-align:left;
	font-weight:bold;
	color:#fff;
	font-size:14px;
	padding:0px !important; 
    -moz-border-top-right-radius:7px;
    -webkit-border-top-right-radius:7px;
    border-top-right-radius:7px;
}

.tab-bottom-right{
	background-color:#<?php echo $b1_color;?>;
	text-align:left;
	font-weight:bold;
	color:#fff;
	font-size:14px;
	padding:0px; 
	
    -moz-border-bottom-right-radius:7px;
    -webkit-border-bottom-right-radius:7px;
    border-bottom-right-radius:7px;
}

.tab-bottom-left{
	background-color:#<?php echo $b1_color;?>;
	text-align:left;
	font-weight:bold;
	color:#fff;
	font-size:14px;
	padding:0px; 
	
    -moz-border-bottom-left-radius:7px;
    -webkit-border-bottom-left-radius:7px;
    border-bottom-left-radius:7px;
}

td.tab-left{
	background-color:#<?php echo $b1_color;?>;	
	color:#fff; 
	font-weight:bold;
	padding:0px !important;
	-moz-border-radius-topleft: 7px;
    -webkit-border-top-left-radius: 7px;
    border-top-left-radius:7px;
	border:0px;
}

td.tab-middle{
	background-color:#<?php echo $b1_color;?>;	
	font-weight:bold;
	color:#fff; 
	padding:0px !important;
	border:0px;
}

/*=================================================
======= LIST ITEM TDs 
=================================================*/
td.list_left{border-left:1px solid #<?php echo $b1_color;?>; padding:0px; border-right:1px dotted #666; text-align:left;}
td.list_center{border-right:1px dotted #666;  padding-left:14px; text-align:left;}
td.list_right{border-right:1px solid #<?php echo $b1_color;?>; padding:7px;}
td.list_bottom{border-top:1px solid #<?php echo $b1_color;?>; padding:0px;}

/*=================================================
======= SMALL MENU BUTTONS
=================================================*/
td.g666{background-color:#<?php echo $b3_color;?>; padding:0px; border:1px solid #000; text-align:center; vertical-align:middle; margin:0px; <?php echo $round;?>}

/*=================================================
======= TEXT =======
=================================================*/
.header {font-size:28px; font-weight:normal; color:#000;}
.redText {font-family:Verdana; font-size:14px; color:#F00; font-weight:bold;}
.greenText {font-family:Verdana; font-size:14px; color:#009900;font-weight:bold;}
.blueText {font-family:Verdana; font-size:14px; color:#06F;font-weight:bold;}
.smallRed{font-family:Verdana; font-size:10px; color:#F00; font-weight:bold;}
.smallGreen{font-family:Verdana; font-size:10px;  color:#009900; font-weight:bold;}
.smallBlue{font-family:Verdana; font-size:10px; color:#06F; font-weight:bold;}
.smallText {font-family:Verdana; font-size:10px; color:#000;}
.smallBold {font-family:Verdana; font-size:10px; color:#000; font-weight:bold;}
.smallG{font-family:Verdana; font-size:10px; color:#666;}
.smallG12{font-family:Verdana; font-size:12px; color:#666;}
.whiteText {font-family:Verdana; font-size:14px; color:#FFF; font-weight:bold;}
.smallWhite{font-family:Verdana; font-size:10px; color:#FFF;}
.whiteBold{font-family:Verdana; font-size:14px;color:#FFF; font-weight:bold;}
.headerBold{font-family:Verdana, Geneva, sans-serif; font-size:18px;font-weight:bold;color:#000;}

/*=================================================
======= NAVS =======
=================================================*/
.navb1 a:link			{display:block;	background-color:#<?php echo $b1_color;?>; 			color:#fff; text-decoration:none; padding:7px; padding-left:14px;text-align:left;<?php echo $round; ?>}
.navb1 a:visited		{display:block;	background-color:#<?php echo $b1_color;?>; 			color:#fff; text-decoration:none; padding:7px; padding-left:14px; text-align:left;<?php echo $round; ?>}
.navb1 a:hover			{display:block;	background-color:#<?php echo $b1_highlight;?>;		color:#fff; text-decoration:none; padding:7px; padding-left:14px; text-align:left;<?php echo $round; ?>}
.navb1 a:active			{display:block;	background-color:#<?php echo $b1_highlight;?>;		color:#fff; text-decoration:none; padding:7px; padding-left:14px; text-align:left;<?php echo $round; ?>}

.navNotes a:link	{display:block;	background-color:none; text-decoration:none; color:#000; padding:7px; padding-left:14px;}
.navNotes a:visited	{display:block;	background-color:none; text-decoration:none; color:#000; padding:7px; padding-left:14px;}
.navNotes a:hover	{display:block;	background-color:#<?php echo $b1_highlight;?>;	text-decoration:none; color:#fff !important; padding:7px; padding-left:14px;}
.navNotes a:active	{display:block;	background-color:#<?php echo $b1_highlight;?>;	text-decoration:none; color:#fff !important; padding:7px; padding-left:14px;}

.navMenuRound a:link	{display:block;	background-color:none; text-decoration:none; color:#000; padding:7px; cursor:pointer; <?php echo $round; ?>}
.navMenuRound a:visited	{display:block;	background-color:none; text-decoration:none; color:#000; padding:7px; cursor:pointer; <?php echo $round; ?>}
.navMenuRound a:hover	{display:block;	background-color:#<?php echo $b1_highlight;?>;	text-decoration:none; color:#fff; padding:7px; cursor:pointer; <?php echo $round; ?>}
.navMenuRound a:active	{display:block;	background-color:#<?php echo $b1_highlight;?>;	text-decoration:none; color:#fff; padding:7px; cursor:pointer; <?php echo $round; ?>}

.nav666 a:link		{display:block;	background-color:#<?php echo $b1_color;?>;		border:1px solid #<?php echo $b1_color;?>; text-decoration:none; padding:4px; color:#e9e9e9; font-size:10px; <?php echo $round;?>}
.nav666 a:visited	{display:block;	background-color:#<?php echo $b1_color;?>; 		border:1px solid #<?php echo $b1_color;?>; text-decoration:none; padding:4px;color:#e9e9e9; font-size:10px; <?php echo $round;?>}
.nav666 a:hover		{display:block;	background-color:#<?php echo $b1_highlight;?>;	border:1px solid #<?php echo $b1_color;?>; text-decoration:none; padding:4px;color:#fff; font-size:10px; <?php echo $round;?>}
.nav666 a:active	{display:block;	background-color:#<?php echo $b1_highlight;?>;	border:1px solid #<?php echo $b1_color;?>; text-decoration:none; padding:4px;color:#fff; font-size:10px; <?php echo $round;?>}

#button{
    background-color:#<?php echo $b1_color;?>;
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border-radius:6px;
    color:#fff;
    font-size:14px;
    text-decoration:none;
    cursor:pointer;
    border:none;
	padding:7px;
	padding-left:28px;
	padding-right:14px;
	background:#<?php echo $b1_color;?> url("<?php echo $css_img_dir;?>btn_save16_g.png") no-repeat scroll 5px center;
}
#button:hover {
    border:none;
	background:#<?php echo $b1_highlight;?> url("<?php echo $css_img_dir;?>btn_save16_reg.png") no-repeat scroll 5px center;
    box-shadow:0px 0px 1px #777;
}

#trash {
    background-color:#<?php echo $b1_color;?>;
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border-radius:6px;
    color:#fff;
    font-size:14px;
    text-decoration:none;
    cursor:pointer;
    border:none;
	padding-left:28px;
	padding-right:14px;
	background:#900 url("<?php echo $css_img_dir;?>btn_delete16_reg.png") no-repeat scroll 5px center;
}

#trash:hover {
    border:none;
    box-shadow:0px 0px 1px #777;
	background:#F00 url("<?php echo $css_img_dir;?>btn_delete16_reg.png") no-repeat scroll 5px center;
}
/* *********************************************************************************************************END STYLES **********************************************************************/
</style>