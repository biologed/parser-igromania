<?php //session_start(); ?>
<!--<!DOCTYPE html>-->
<!--<html lang="ru">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
<!--    //= inc/head.php-->
<!--    <title>Парсер</title>-->
<!--    <link rel="stylesheet" href="/css/main.css">-->
<!--    <script src="/js/main.js"></script>-->
<!--</head>-->
<!--    //= inc/header.php-->
<!--<div class="container">-->
<!--    --><?php
//    ini_set('max_execution_time', 9000);
//    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
//    header("Cache-Control: post-check=0, pre-check=0", false);
//    header("Pragma: no-cache");
//
//    include_once($_SERVER['DOCUMENT_ROOT'].'/inc/simple_html_dom.php');
//
//    function url_slug($str, $options = array()) {
//        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
//        $defaults = array(
//            'delimiter' => '-',
//            'limit' => null,
//            'lowercase' => true,
//            'replacements' => array(),
//            'transliterate' => false,
//        );
//        $options = array_merge($defaults, $options);
//        $char_map = array(
//            // Latin
//            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
//            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
//            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
//            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
//            'ß' => 'ss',
//            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
//            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
//            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
//            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
//            'ÿ' => 'y',
//            // Latin symbols
//            '©' => '(c)',
//            // Greek
//            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
//            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
//            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
//            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
//            'Ϋ' => 'Y',
//            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
//            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
//            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
//            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
//            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
//            // Turkish
//            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
//            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
//            // Russian
//            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
//            'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
//            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
//            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
//            'Я' => 'Ya',
//            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
//            'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
//            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
//            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
//            'я' => 'ya',
//            // Ukrainian
//            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
//            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
//            // Czech
//            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
//            'Ž' => 'Z',
//            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
//            'ž' => 'z',
//            // Polish
//            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
//            'Ż' => 'Z',
//            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
//            'ż' => 'z',
//            // Latvian
//            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
//            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
//            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
//            'š' => 's', 'ū' => 'u', 'ž' => 'z'
//        );
//        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
//        if ($options['transliterate']) {$str = str_replace(array_keys($char_map), $char_map, $str);}
//        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
//        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
//        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
//        $str = trim($str, $options['delimiter']);
//        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
//    }
//
//    function metaKeywordsGenerator($string)
//    {
//        $stopWords = array(
//            'raquo', 'laquo', 'mdash'
//        );
//        $string = strip_tags($string);
//        $string = mb_strtolower($string);
//        $string = preg_replace('/[^A-Za-z0-9]+/i', ' ', $string);
//        $array = preg_split('/\s+/', $string);
//        $array = array_diff($array, $stopWords);
//
//        $mass = array_unique($array);
//        for($i=0; $i<count($mass);$i++ ) {
//            if(empty($mass[$i])) {
//                array_splice($mass,$i,1);
//            }
//        }
//        $string = implode(",", $mass);
//        return $string;
//        $string = '';
//    }
//
//    date_default_timezone_set('Europe/Moscow');
//    mb_internal_encoding("UTF-8");
//    mb_http_output("UTF-8");
//    mb_http_input("UTF-8");
//
//    $category_linkes = array();
//    $list_category = array();
//    $list_link_category = array();
//    $time = date('d-m-Y-H');
//    if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/category.txt')) {
//        $sql = mysqli_connect("localhost", "root", "", "test") or die(mysqli_error());
//        if (mysqli_connect_errno()) exit();
//        mysqli_set_charset($sql, "utf8");
//        if ($stmt = mysqli_prepare($sql, "SELECT link FROM category")) {
//            mysqli_stmt_execute($stmt);
//            mysqli_stmt_bind_result($stmt, $reso['category_link']);
//            mysqli_stmt_store_result($stmt);
//            if (mysqli_stmt_num_rows($stmt)) {
////                mysqli_stmt_fetch($stmt);
//                while($data = mysqli_stmt_fetch($stmt)) {
//                    $category_linkes[] = $reso['category_link'];
//                }
//                mysqli_stmt_free_result($stmt);
//            }
//        }
//        mysqli_stmt_close($stmt);
//        mysqli_close($sql);
//        $category_linkes = array_unique($category_linkes);
//        $category_linkes = implode(',',$category_linkes);
//        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/category.txt', $category_linkes);
//    } else if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/'.$time.'.txt')) {
//        $file_list_category = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/category.txt');
//        $list_category = explode(',',$file_list_category);
//        for($z=0;$z<count($list_category);$z++) {
//            $list_cat[$z] = strstr(str_replace('/game/','',$list_category[$z]),'/',true);
//            $cat = file_get_html('https://m.igromania.ru/game/news/'.$list_cat[$z].'/');
//            foreach ($cat->find('.info_block_content') as $item) {
//                foreach ($item->find('a') as $element) {
//                    if(strripos($element,'/news/')) {
//                        $list_link_category[] = 'https://www.igromania.ru' . $element->href;
//                    }
//                }
//            }
//        }
//        $list_link_category = implode(',',$list_link_category);
//        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/'.$time.'.txt', $list_link_category);
//    } else {
//        echo '<script>console.log("файл категорий уже обработан")</script>';
//    }
//
//    $cat_dir = $_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/';
//    $cat_files = scandir($cat_dir);
//    if(count($cat_files) > 1) {
//        $cat_result = array();
//        $cat_res = array();
//        $cat_store[] = &$cat_result;
//        for($cat_f = 0; $cat_f < count($cat_files); $cat_f++) {
//            $cat_path_parts = pathinfo($cat_files[$cat_f]);
//            $cat_path_name[$cat_f] = $cat_path_parts['basename'];
//            if (strripos($cat_path_name[$cat_f],'txt') && !strripos($cat_path_name[$cat_f],'category')) {
//                $cat_file_store = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/src/news/igromania/txt/category/' . $cat_path_name[$cat_f]);
//                $cat_store[] = explode(',', $cat_file_store);
//            }
//        }
//        $cat_new_array = array();
//        $cat_max = max(array_keys($cat_store));
//        for ($cat_i = 1; $cat_i < $cat_max; $cat_i++) {
//            $cat_store[0] = array_merge(
//                $cat_store[0],
//                $cat_store[$cat_i]
//            );
//        }
//        $cat_rez = array_values(array_unique($cat_result));
//        $cat_rez = implode(',',$cat_rez);
//        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/unique.txt', $cat_rez);
//    }
//    if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/'. $time.'.txt')) {
//        $html = file_get_html('https://m.igromania.ru/news/game/');
//        $links = array();
//        foreach ($html->find('.info_block_box') as $item) {
//            foreach ($item->find('a') as $element) {
//                if(strripos($element,'/news/')) {
//                    $links[] = 'https://www.igromania.ru'.$element->href;
//                }
//            }
//        }
//        $links = implode(',',$links);
//        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/'.$time.'.txt', $links);
//    }
//    $dir = $_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/';
//    $files = scandir($dir);
//    if(count($files) > 1) {
//        $result = array();
//        $res = array();
//        $store[] = &$result;
//        for ($f = 0; $f < count($files); $f++) {
//            $path_parts = pathinfo($files[$f]);
//            $path_name[$f] = $path_parts['basename'];
//            if (strripos($path_name[$f], 'txt')) {
//                $file_store = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/src/news/igromania/txt/' . $path_name[$f]);
//                $store[] = explode(',', $file_store);
//            }
//        }
//        $new_array = array();
//        $max = max(array_keys($store));
//        for ($i = 1; $i < $max; $i++) {
//            $store[0] = array_merge(
//                $store[0],
//                $store[$i]
//            );
//        }
//        $rez = array_values(array_unique($result));
//        $rez = implode(',', $rez);
//        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/src/news/igromania/txt/unique.txt', $rez);
//    }
//    echo '<script>console.log("файл '.$time.'.txt получен")</script>';
//    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/unique.txt') && file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/awersome.txt')) {
//        $list_link = 'unique.txt';
//        echo '<script>console.log("файл '.$list_link.' загружен")</script>';
//        unlink($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/awersome.txt');
//    } else if(file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/unique.txt')) {
//        $list_link = 'category/unique.txt';
//        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/awersome.txt', '');
//        echo '<script>console.log("файл '.$list_link.' загружен")</script>';
//    } else {
//        $list_link = $time.'.txt';
//        echo '<script>console.log("файл '.$list_link.' загружен")</script>';
//    }
//    //    $list_link = '21-10-2019-12.txt'; //test
//    $list_linked = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/'.$list_link);
//    $urles = explode(',',$list_linked); //ссылки из файла
//    $dired = $_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/';
//    $filesed = scandir($dired);
//    $names = array();
//    $array_diff = array();
//    for($u = 0; $u < count($urles); $u++) {
//        $urles[$u] = str_replace('.html','',str_replace('/','-',str_replace('https://www.igromania.ru/news/','',strtolower(str_replace('_','-',$urles[$u])))));
//    }
//    for($f = 0; $f < count($filesed); $f++) {
//        $path_partsed = pathinfo($filesed[$f]);
//        $path_exted[$f] = $path_partsed['basename'];
//        if (strripos($path_exted[$f],'php')) {
//            $names[$f] = $path_partsed['filename']; //названия файлов котоыре уже есть
//        }
//    }
//    $array_diff = array_values(array_diff($urles,$names));
//    $count = count(array_diff($urles,$names));
//    //    print_r(array_values($array_diff));
//    if($count > 0) {
//        for($j = 0; $j < $count; $j++) {
//            $is_array = false;
//            $array_diff[$j] = str_replace('-','_',preg_replace('/-/','/',$array_diff[$j],1));
//            $html = file_get_html('https://www.igromania.ru/news/'.$array_diff[$j].'.html');
//            //title
//            foreach ($html->find('.page_news_ttl') as $element) {
//                $name = $element->innertext;
//            }
//            $name = str_replace('&nbsp;', ' ', $name);
//            $link =  str_replace('_','-',preg_replace('/\//','-',$array_diff[$j],1));
//            //category
//            $category_id = array();
//            $category_name = array();
//            $category_link = array();
//            if (strripos($html->find('.rbox')[0]->attr['id'],'specials')) {
//                if(empty($html->find('.rbox')[1]->attr['id'])) {
//                    $page_news = $html->find('.rbox')[1];
//                } else if (strripos($html->find('.rbox')[1]->attr['id'],'linkedgames')) {
//                    $page_news = $html->find('.rbox')[1];
//                } else {
//                    array_splice($category_name,1);
//                    $category_name[] = 'Игровые новости';
//                }
//            } else {
//                if(empty($html->find('.rbox')[0]->attr['id'])) {
//                    $page_news = $html->find('.rbox')[0];
//                }
//                else if (strripos($html->find('.rbox')[0]->attr['id'],'linkedgames')) {
//                    $page_news = $html->find('.rbox')[0];
//                } else {
//                    if(count($category_name) > 0) {
//                        array_splice($category_name,count($category_name));
//                    }
//                    $category_name[] = 'Игровые новости';
//                }
//            }
//            if(!empty($page_news)) {
//                $page_news_info = $page_news->children;
//                foreach ($page_news_info as $child) {
//                    if(!empty($child->attr['class'] == 'rbox_line1 clearfix')) {
//                        if(!empty($child->find('.rline_textbox_in')[0])) {
//                            $category_name[] = str_replace('&nbsp;', ' ', $child->find('.rline_textbox_in')[0]->plaintext);
//                        }
//                        $category_link[] = $child->href;
//                    } else {
//                        if(!empty($child->find('.rbox_info_ttl')[0])) {
//                            if(!empty($child->attr['class'] == 'outer_link')) {
//                                $category_link[] = $child->href;
//                            }
//                            $span = $child->find('.rbox_info_ttl')[0];
//                            if(!empty($span->innertext)) {
//                                $category_name[] = str_replace('&nbsp;', ' ', $span->innertext);
//                            }
//                        }
//                    }
//                }
//            }
//            for ($t = 0; $t < count($category_name); $t++) {
//                $sql = mysqli_connect("localhost", "root", "", "test") or die(mysqli_error());
//                if (mysqli_connect_errno()) exit();
//                mysqli_set_charset($sql, "utf8");
//                if ($stmt = mysqli_prepare($sql, "SELECT id, name FROM category WHERE name=? LIMIT 1")) {
//                    mysqli_stmt_bind_param($stmt, "s", $category_name[$t]);
//                    mysqli_stmt_execute($stmt);
//                    mysqli_stmt_bind_result($stmt, $res['category_id'], $res['category_name']);
//                    mysqli_stmt_store_result($stmt);
//                    if (mysqli_stmt_num_rows($stmt)) {
//                        mysqli_stmt_fetch($stmt);
//                        mysqli_stmt_free_result($stmt);
//                        $category_id[$t] = $res['category_id'];
//                    } else {
//                        $zero = 0;
//                        $stmt = mysqli_prepare($sql, "INSERT INTO category (id, name, link) VALUES (?, ?, ?)");
//                        mysqli_stmt_bind_param($stmt, "iss", $zero, $category_name[$t], $category_link[$t]);
//                        mysqli_stmt_execute($stmt);
//                        $category_id[$t] = mysqli_stmt_insert_id($stmt);
//                    }
//                }
//                mysqli_stmt_close($stmt);
//                mysqli_close($sql);
//            }
//            if($category_id > 0) {
//                $category_id = implode(',', $category_id);
//            }
//            if($category_name > 0) {
//                $category_name = implode(',', $category_name);
//            }
/*            $page .= '<?php session_start(); ?><!DOCTYPE html><html lang="ru"><head>*/
//<meta charset="utf-8">
//<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
//<link rel="stylesheet" href="/css/main.css">
//<script src="/js/main.js"></script>
//<title>'.$name.'</title></head>
//<body id="body" class="hidden opacity1">
//<div id="loader" class="container visible">
//    <div class="item-1"></div>
//    <div class="item-2"></div>
//    <div class="item-3"></div>
//    <div class="item-4"></div>
//    <div class="item-5"></div>
//</div>
//<div class="overlay_popup"></div>
//<div class="popup" id="popup1">
//    <div class="object">
//        <div class="container-fluid mt-5">
//            <div class="container">
//                <div class="row justify-content-center align-items-center">
//                    <div class="col-xl-4">
//                        <div class="card">
//                            <img src="" class="card-img-top" alt="">
//                            <div class="card-body">
//                                <h3 class="card-title"></h3>
//                                <p class="card-text"></p>
//                                <div id="back-btn" class="btn btn-primary">Вернуться на сайт</div>
//                            </div>
//                        </div>
//                    </div>
//                </div>
//            </div>
//        </div>
//    </div>
//</div>
//<header>
//    <nav>
//        <a href="/">Главная</a>
//        <a href="/news/igromania/">Игромания</a>
//        <a class="nav-right active" href="/login/">Sign in</a>
//        <a class="nav-right" href="/reg/">Sign up</a>
//    </nav>
//</header>
//<div class="container">';
//            $page .= '<h1 class="ttl">' . $name . '</h1>';
//            //time
//            $page_news_info = $html->find('.page_news_info');
//            $children = $page_news_info[0]->children;
//            foreach ($children as $child) {
//                $child->outertext = '';
//            }
//            $page .= '<br>' . str_replace('&nbsp;', '', str_replace('|', '', $page_news_info[0]->innertext));
//            $timestamp = strtotime(str_replace('&nbsp;', '', str_replace('|', '', $page_news_info[0]->innertext)));
//            //author
//            foreach ($html->find('.page_news_info span a span') as $element) {
//                $page .= $element->innertext . ' @Игромания <br>';
//                $author = $element->innertext;
//            }
//            //image
//            foreach ($html->find('.main_pic_container img') as $element) {
//                $image = $element->src;
//            }
//            $path_parts = pathinfo($image);
//            $path_image_url = $path_parts['basename'];
//            $path_image_ext = $path_parts['extension'];
//            if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/' . $path_image_url)) {
//                $link_image = $link . '.' . $path_image_ext;
//                $link_image_to_base = '/minify/igromania/' . $link . '.' . $path_image_ext;
//                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/' . $link_image, file_get_contents($image));
//            }
//            $page .= '<img src="' . $link_image . '" alt="' . $name . '" title="' . $name . '">';
//            //tags
//            $page_news = $html->find('.page_news_content .universal_content');
//            $children = $page_news[0]->children;
//            foreach ($children as $i => $content) {
//                $disc[$i] = str_replace('    ', '', str_replace('&nbsp;', ' ', $content->plaintext));
//                if (!empty($content->attr['class']) && $content->attr['class'] == "video_block") {
//                    $page .= '<div class="video_block">' . $content->innertext . '</div>';
//                } else if (!empty($content->attr['class']) && $content->attr['class'] == "grayblock_nom") {
//                    $content->outertext = '';
//                } else if (!empty($content->find('a', 0))) {
//                    $page .= '<div>' . $content->plaintext . '</div>';
//                } else {
//                    $page .= $content->outertext;
//                }
//            }
//
//            $new_array = implode($disc);
//            $tags = metaKeywordsGenerator($new_array);
//            echo '<br/>';
//            $tegi = explode(',', $tags);
//            for ($i = 0; $i < count($tegi); $i++) {
//                $tegi[$i] = '<p><a href="#">#' . $tegi[$i] . '</a></p>';
//            }
//            $tegi = implode('', $tegi);
//            $page .= '<div class="tags"><div class="name">Теги: </div><div class="list">' . $tegi . '</div></div>';
//            $page .= '<div class="source"><div class="name">Источник: </div><div class="list"><p><a href="' . $array_diff[$j] . '" target="_blank" rel="nofollow">Игромания</a></p></div></div>';
//            $page .= '<div class="source"><div class="name">Категория: </div><div class="list"><p><a href="#">'.$category_name.'</a></p></div></div>';
//            $page .= '</div>
//<div style="height: 50px"></div>
//</body></html>';
//            if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/' . $link . '.php')) {
//                $sql = mysqli_connect("localhost", "root", "", "test") or die(mysqli_error());
//                if (mysqli_connect_errno()) exit();
//                mysqli_set_charset($sql, "utf8");
//                if ($stmt = mysqli_prepare($sql, "SELECT name FROM news WHERE name=? LIMIT 1")) {
//                    mysqli_stmt_bind_param($stmt, "s", $name);
//                    mysqli_stmt_execute($stmt);
//                    mysqli_stmt_bind_result($stmt, $res["name"]);
//                    mysqli_stmt_store_result($stmt);
//                    if (!mysqli_stmt_num_rows($stmt)) {
//                        mysqli_stmt_fetch($stmt);
//                        mysqli_stmt_free_result($stmt);
//                        $zero = 0;
////                        var_dump($category_name);
//                        $stmt = mysqli_prepare($sql, "INSERT INTO news (id, name, author, link, image, timestamp, tags, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
//                        mysqli_stmt_bind_param($stmt, "issssiss", $zero, $name, $author, $link, $link_image_to_base, $timestamp, $tags, $category_id);
//                        mysqli_stmt_execute($stmt);
//                        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/' . $link . '.php', $page);
//                        echo $array_diff[$j] . ' <b>успешно создан</b><br>';
//                    } else {
//                        echo 'файл <b>' . $name . '</b> уже создан<br>';
//                    }
//                }
//                mysqli_stmt_close($stmt);
//                mysqli_close($sql);
//            } else {
//                echo 'файл <b>' . $name . '</b> уже создан<br>';
//            }
//            $page = '';
//            unset($category_id);
//            unset($category_name);
//        }
//    } else {
//        echo '<b>уже созданы</b>';
//    }
//    ?>
<!--</div>-->
<!--//= inc/footer.php-->
<!--</body>-->
<!--</html>-->
