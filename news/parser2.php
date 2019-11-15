<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/main.js"></script>
    <title>Парсер</title>
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/main.js"></script>
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
    ini_set('max_execution_time', 9000);
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    include_once($_SERVER['DOCUMENT_ROOT'].'/inc/simple_html_dom.php');

    function url_slug($str, $options = array()) {
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => false,
        );
        $options = array_merge($defaults, $options);
        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        if ($options['transliterate']) {$str = str_replace(array_keys($char_map), $char_map, $str);}
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        $str = trim($str, $options['delimiter']);
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }

    function add_weekday($date) {
        $ru_months = array( 'начало',   'конец',    'весь',         'iv квартал',   'iii квартал',  'ii квартал',   'i квартал',    'январь',       'января',
                            'год',      'февраль',  'февраля',      'март',         'апрель',       'апреля',       'май',
                            'мая',      'июнь',     'июня',         'июль',         'июля',         'август',      'сентябрь',     'сентября',
                            'октябрь',  'октября',  'ноябрь',       'ноября',       'декабрь',      'декабря');
        $en_months = array( 'january',  'january',  'january',      'january',      'january',      'january',      'january',      'january',      'january',
                            '',         'february', 'february',     'march',        'april',        'april',        'may',
                            'may',      'june',     'june',         'july',         'july',         'august',       'september',    'september',
                            'october',  'october',  'november',     'november',     'december',     'december');
        if(str_replace('августа', 'август',$date)) {
            $date = str_replace('августа', 'август',$date);
        }
        if(str_replace('марта', 'март',$date)) {
            $date = str_replace('августа', 'август',$date);
        }
        if(str_replace('года', 'год',$date)) {
            $date = str_replace('августа', 'август',$date);
        }
        $date = str_replace($ru_months, $en_months, mb_strtolower($date, 'UTF-8'));
        return $date;
        $date = '';
    }

    function metaKeywordsGenerator($string)
    {
        $stopWords = array(
            'raquo', 'laquo', 'mdash'
        );
        $string = strip_tags($string);
        $string = mb_strtolower($string);
        $string = preg_replace('/[^A-Za-z0-9]+/i', ' ', $string);
        $array = preg_split('/\s+/', $string);
        $array = array_diff($array, $stopWords);

        $mass = array_unique($array);
        for($i=0; $i<count($mass);$i++ ) {
            if(empty($mass[$i])) {
                array_splice($mass,$i,1);
            }
        }
        $string = implode(",", $mass);
        return $string;
        $string = '';
    }

    date_default_timezone_set('ETC/GMT+3');
    mb_internal_encoding("UTF-8");
    mb_http_output("UTF-8");
    mb_http_input("UTF-8");
    $item_data = array();
    $time = date('d-m-Y-H');
    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/'.$time.'.txt')) {
        $cat = file_get_html('https://m.igromania.ru/games/');
        $item_page = $cat->find('.pages',0)->find('a',8)->plaintext;
        for($i = 1; $i<=$item_page; $i++) {
        $game = file_get_html('https://m.igromania.ru/games/all/all/'.$i.'/2/');
            $info_block_content = $game->find('.info_block_content',0);
            foreach($info_block_content->find('.info_block_box') as $element) {
                if(mb_strtolower($element->find('.release_data',0)->plaintext, 'UTF-8') != mb_strtolower('Дата выхода неизвестна', 'UTF-8')) {
                    if(strtotime(add_weekday($element->find('.release_data',0)->plaintext)) >= strtotime(date('2019-01-01'))) {
                        $item_data[] = strtotime(add_weekday($element->find('.release_data',0)->plaintext));
                    } else {
                        $i = $item_page;
                    }
                }
            }
        }
        echo $i;
        echo '<br>';
        print_r($item_data);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/src/news/igromania/txt/category/'.$time.'.txt', $item_data);
    } else {
        echo '<script>console.log("файл категорий уже обработан")</script>';
    }
    ?>
</div>
<div style="height: 50px"></div>
</body>
</html>