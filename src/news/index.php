<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    //= inc/head.php
    <title>Новости</title>
    <style>
        .link {padding: 10px 15px;background: transparent;border:#bccfd8 1px solid;border-left:0px;cursor:pointer;color:#607d8b}
        .disabled {cursor:not-allowed;color: #bccfd8;}
        .current {background: #bccfd8;}
        .first{border-left:#bccfd8 1px solid;}
        .question {font-weight:bold;}
        .answer{padding-top: 10px;}
        #pagination{margin-top: 20px;padding-top: 30px;border-top: #F0F0F0 1px solid;}
        .dot {padding: 10px 15px;background: transparent;border-right: #bccfd8 1px solid;}
        #overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
        #overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
        .page-content {padding: 20px;margin: 0 auto;}
        .pagination-setting {padding:10px; margin:5px 0px 10px;border:#bccfd8  1px solid;color:#607d8b;}
    </style>
    <script>
        function getresult(url) {
            $.ajax({
                url: url,
                type: "GET",
                data:  {rowcount:$("#rowcount").val(),"pagination_setting":$("#pagination-setting").val()},
                beforeSend: function(){$("#overlay").show();},
                success: function(data){
                    $("#pagination-result").html(data);
                    setInterval(function() {$("#overlay").hide(); },500);
                },
                error: function()
                {}
            });
        }
        function changePagination(option) {
            if(option!= "") {
                getresult("getresult.php");
            }
        }
    </script>
</head>
//= inc/header.php
<div class="container">
<?php
//    date_default_timezone_set('Europe/Moscow');
//    mb_internal_encoding("UTF-8");
//    mb_http_output("UTF-8");
//    mb_http_input("UTF-8");
//        $sql = mysqli_connect("localhost", "root", "", "test") or die(mysqli_error());
//        if(mysqli_connect_errno()) exit();
//        mysqli_set_charset($sql, "utf8");
//        if($stmt = mysqli_prepare($sql, "SELECT * FROM news ORDER BY timestamp DESC LIMIT 16")) {
//            mysqli_stmt_execute($stmt);
//            mysqli_stmt_bind_result($stmt, $res["id"],$res["name"], $res["author"], $res["link"], $res["image"], $res["timestamp"], $res["tags"], $res['category']);
//            echo '<div class="info_block_content clearfix_l"><div id="container" class="ac3">';
//            while (mysqli_stmt_fetch($stmt)) {
//                $time = date('d.m.Y H:i',$res["timestamp"]);
//            echo '<div class="info_block_box ws ht2 ae">
//<a href="/news/igromania/'.$res["link"].'.php" class="outer_link2">
//<div class="info_block_picbox">
//<img src="/news'.$res["image"].'" alt="'.$res["name"].'">
//</div>
//<div class="info_block_textbox">
//<div class="text_block_in">'.$res["name"].'</div>
//</div>
//</a>
//<div class="botline"><div class="info_block_botrt"><span class="icon views"></span>'.$res["author"].'</div>'.$time.'</div>
//</div>';
//}
//echo '</div></div>';
//mysqli_stmt_close($stmt);
//}
//mysqli_close($sql);
//?>
<!--    <div id="overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div>-->
    <div class="page-content">
<!--        <div style="border-bottom: #F0F0F0 1px solid;margin-bottom: 15px;">-->
<!--            Pagination Setting:<br> <select name="pagination-setting" onChange="changePagination(this.value);" class="pagination-setting" id="pagination-setting">-->
<!--                <option value="all-links">Display All Page Link</option>-->
<!--                <option value="prev-next">Display Prev Next Only</option>-->
<!--            </select>-->
<!--        </div>-->

        <div id="pagination-result">
            <input type="hidden" name="rowcount" id="rowcount" />
        </div>
    </div>
    <script>
        getresult("getresult.php");
    </script>

</div>
//= inc/footer.php
</body>
</html>
