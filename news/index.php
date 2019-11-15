<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/main.js"></script>
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
<body id="body" class="hidden opacity1">
<div id="loader" class="container visible">
    <div class="item-1"></div>
    <div class="item-2"></div>
    <div class="item-3"></div>
    <div class="item-4"></div>
    <div class="item-5"></div>
</div>
<div class="overlay_popup"></div>
<div class="popup" id="popup1">
    <div class="object">
        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-4">
                        <div class="card">
                            <img src="" class="card-img-top" alt="">
                            <div class="card-body">
                                <h3 class="card-title"></h3>
                                <p class="card-text"></p>
                                <div id="back-btn" class="btn btn-primary">Вернуться на сайт</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<header>
    <nav>
        <a href="/">Главная</a>
        <a href="/news/igromania/">Игромания</a>
        <a class="nav-right active" href="/login/">Sign in</a>
        <a class="nav-right" href="/reg/">Sign up</a>
    </nav>
</header>
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
<div style="height: 50px"></div>
</body>
</html>