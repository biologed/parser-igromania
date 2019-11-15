<?php
date_default_timezone_set('Europe/Moscow');
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");
mb_http_input("UTF-8");

require_once("dbcontroller.php");
require_once("pagination.class.php");
$db_handle = new DBController();
$perPage = new PerPage();

$sql = "SELECT * from news ORDER BY timestamp DESC";
$paginationlink = "getresult.php?page=";	
$pagination_setting = 'all-links';//$_GET["pagination_setting"];
				
$page = 1;
if(!empty($_GET["page"])) {
$page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;

$query =  $sql . " limit " . $start . "," . $perPage->perpage; 
$faq = $db_handle->runQuery($query);

if(empty($_GET["rowcount"])) {
$_GET["rowcount"] = $db_handle->numRows($sql);
}

if($pagination_setting == "prev-next") {
	$perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink,$pagination_setting);	
} else {
	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);	
}


$output = '';
$output .=  '<div class="info_block_content clearfix_l"><div id="container" class="ac3">';
foreach($faq as $k => $v) {
    $time = date('d.m.Y H:i',$faq[$k]["timestamp"]);
    $output .= '<div class="info_block_box ws ht2 ae">
<a href="/news/igromania/'.$faq[$k]["link"].'.php" class="outer_link2">
<div class="info_block_picbox">
<img src="/news'.$faq[$k]["image"].'" alt="'.$faq[$k]["name"].'">
</div>
<div class="info_block_textbox">
<div class="text_block_in">'.$faq[$k]["name"].'</div>
</div>
</a>
<div class="botline"><div class="info_block_botrt"><span class="icon views"></span>'.$faq[$k]["author"].'</div>'.$time.'</div>
</div>';
}
$output .= '</div></div>';
if(!empty($perpageresult)) {
$output .= '<div id="pagination">' . $perpageresult . '</div>';
}
print $output;
?>
