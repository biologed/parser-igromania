<?php

date_default_timezone_set('Europe/Moscow');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

function GetRealIp()
{
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function sendme($operation = "", $email = "", $name = "", $phone = "", $message = "") {
    $options = get_browser(null,true); // получение информации о браузере пользователя
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPDebug = 2;
    $mail->host = "smtp.yandex.ru";
    $mail->port = "465";
    $mail->SMTPAuth = true;
    $mail->CharSet = 'UTF-8';
    $mail->addAddress("super.gird2012@yandex.ru");
    $mail->isSendmail();
    $mail->setFrom('super.gird2012@yandex.ru', 'Администратор');
    $mail->isHTML(true);
    if($operation = "order") {
        $phone = "+".substr($phone,0,1)." (".substr($phone,1,3).") ".substr($phone,4,3)."-".substr($phone,7,2)."-".substr($phone,9,2);
        $mail->Subject = 'Заявка на сайте';
        $mail->Body = '<html>
        <head>
        <title>Заявка на сайте</title>
        </head>
        <body>
        <p>Здраствуйте!</p>
        <p>'.$name.', только что оставил заявку на сайте '.$_SERVER['HTTP_HOST'].',</p>
        <p>Его телефон: '.$phone.' и почта: '.$email.'</p>
        <p>Сообщение:</p>
        <p>'.$message.'</p>
        <p>Браузер: '.$options["browser"].'</p>
        <p>Версия браузера: '.$options["version"].'</p>
        <p>Операционная система: '.$options["platform"].'</p>
        <p>Время отправки запроса: '.date('d.m.Y H:i:s e O', time()).'</p>
        <p>В файле  "history/'.$name.'.history" сделана соответствующая запись</p>
        </body>
        </html>';
        $sql = mysqli_connect("127.0.0.1", "root", "", "test") or die(mysqli_error());
        mysqli_set_charset($sql, "utf8");
        $query = 'INSERT INTO users VALUES (0,"'.$name.'","'.$options["browser"].'","'.$options["version"].'","'.$options["platform"].'","'.time().'")';
        $result = mysqli_query($sql, $query) or die(mysqli_error($sql));
        $data_to_write = "Заявка на сайте | ". $_SERVER['HTTP_USER_AGENT'].' | Время: '.date('d.m.Y H:i:s e O', time());
        $file_path = dirname(__FILE__)."/history/" . $name . ".history";
        $file_handle = fopen($file_path, 'a');
        fwrite($file_handle, $data_to_write."\n");
        fclose($file_handle);
    }
    if($operation = "forgotten") {
        $mail->Subject = 'Сброс пароля на сайте';
        $mail->Body = '<html>
        <head>
        <title>Сброс пароля на сайте</title>
        </head>
        <body>
        <p>Здраствуйте!</p>
        <p>'.$name.', с IP-адресом '.GetRealIp().' только что запросил сброс пароля на сайте '.$_SERVER['HTTP_HOST'].',</p>
        <p>Его почта: '.$email.'</p>
        <p>Сообщение:</p>
        <p>Браузер: '.$options["browser"].'</p>
        <p>Версия браузера: '.$options["version"].'</p>
        <p>Операционная система: '.$options["platform"].'</p>
        <p>Время отправки запроса: '.date('d.m.Y H:i:s e O', time()).'</p>
        <p>В файле  "history/'.$name.'.history" сделана соответствующая запись</p>
        </body>
        </html>';
        $sql = mysqli_connect("127.0.0.1", "root", "", "test") or die(mysqli_error());
        mysqli_set_charset($sql, "utf8");
        $query = "SELECT login FROM users WHERE login=\"$name\" LIMIT 1";
        $result = mysqli_query($sql, $query) or die(mysqli_error($sql));
        if(mysqli_num_rows($result)) {
            $query = 'UPDATE users SET browser="'.$options["browser"].'", browser_ver="'.$options["version"].'", os="'.$options["platform"].'", time="'.time().'" WHERE login="'.$name.'" LIMIT 1';
            $result = mysqli_query($sql, $query) or die(mysqli_error($sql));
        } else {
            $query = 'INSERT INTO users VALUES (0,"'.$name.'","'.$options["browser"].'","'.$options["version"].'","'.$options["platform"].'","'.time().'")';
            $result = mysqli_query($sql, $query) or die(mysqli_error($sql));
        }

        $data_to_write = "Сброс пароля | ". $_SERVER['HTTP_USER_AGENT'].' | Время: '.date('d.m.Y H:i:s e O', time());
        $file_path = dirname(__FILE__)."/history/" . $name . ".history";
        $file_handle = fopen($file_path, 'a');
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);
    }
    $mail->send();
}

function sendto($operation = "", $email = "", $name = "", $phone = "", $code = "") {
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPDebug = 2;
    $mail->host = "smtp.yandex.ru";
    $mail->port = "465";
    $mail->SMTPAuth = true;
    $mail->CharSet = 'UTF-8';
    $mail->addAddress($email);
    $mail->isSendmail();
    $mail->setFrom('super.gird2012@yandex.ru', 'Администратор');
    $mail->isHTML(true);
    if($operation == "order") {
        $phone = "+".substr($phone,0,1)." (".substr($phone,1,3).") ".substr($phone,4,3)."-".substr($phone,7,2)."-".substr($phone,9,2);
        $mail->Subject = 'Заявка на сайте';
        $mail->Body = '<html>
        <head>
        <title>Заявка на сайте</title>
        </head>
        <body>
        <p>Здраствуйте '.$name.'!</p>
        <p>Спасибо, что оставили заявку на сайте '.$_SERVER['HTTP_HOST'].',
        менеджер нашей компании свяжется с вами в течении 5 минут по указаному вами телефону '.$phone.'
        </p>
        </body>
        </html>';
    }
    if($operation == "verification") {
        $link = "http://".$_SERVER['HTTP_HOST']."/send.php?action=verification&code=".$code;
        $mail->Subject = 'Запрос на подтверждение адреса электронной почты';
        $mail->Body = '<html>
        <head>
        <title>Запрос на подтверждение адреса электронной почты</title>
        </head>
        <body>
        <p>Кто-то (возможно вы) с IP-адресом '.GetRealIp().' зарегистрировался
        на сервере проекта учётную запись '.$name.',
        указав этот адрес электронной почты.</p>
        <p>Чтобы подтвердить, что эта учётная запись действительно
        принадлежит вам и включить возможность отправки электронной почты
        с сайта '.$_SERVER['HTTP_HOST'].', откройте приведённую ниже ссылку в браузере:</p>
        <p>Ссылка в письме действует 30 минут</p>
        <a target="_blank" href="'.$link.'">'.$link.'</a>
        </body>
        </html>';
    }
    if($operation == "pass") {
        $link = "http://".$_SERVER['HTTP_HOST']."/send.php?action=forgotten&code=".$code;
        $mail->Subject = 'Запрос на срос пароля';
        $mail->Body = '<html>
        <head>
        <title>Запрос на срос пароля</title>
        </head>
        <body>
        <p>Кто-то (возможно вы) с IP-адресом '.GetRealIp().' запросил сброс пароля
        на сервере проекта учётную запись '.$name.'.</p>
        <p>Чтобы подтвердить, что это действие действительно
        принадлежит вам и вы желаете сбросить пароль на сайте '.$_SERVER['HTTP_HOST'].',
        откройте приведённую ниже ссылку в браузере:</p>
        <p>Ссылка в письме действует 30 минут</p>
        <a target="_blank" href="'.$link.'">'.$link.'</a>
        </body>
        </html>';
    }
    $mail->send();
}

function clean($result = "") {
    $result = trim($result);
    $result = stripslashes($result);
    $result = strip_tags($result);
    $result = htmlspecialchars($result);
    $result = addslashes($result);
    return $result;
}

function better_crypt($input) {
    $crypt_options = [
        'salt' => bin2hex(random_bytes(32)),
        'cost' => 12,
        'memory_cost' => 1<<17,
        'time_cost' => 4,
        'threads' => 2
    ];
    return password_hash($input, PASSWORD_ARGON2I, $crypt_options);
}

function auth($operation = null, $login = '', $email = '', $pass = '', $link = '', $phone = '') {
    if($operation == null) {
        $message = 'Возникла непредвиденая ошибка, пожалуйста обратитесь к администратору<br><a href="/reg/">Вернуться</a>';
        $result = array(false,$message);
        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
    }
    if($operation == 'forgot') { // запрос на сброс пароля
        $sql = mysqli_connect("127.0.0.1", "root", "", "test");
        if(mysqli_connect_errno()) exit();
        mysqli_set_charset($sql, "utf8");
        if($stmt = mysqli_prepare($sql, "SELECT login, email, verification, timepass, varpass FROM auth WHERE login=? OR email=? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "ss", $login, $login);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $res["login"], $res["email"], $res["verification"], $res["timepass"], $res["varpass"]);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt)) {
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_free_result($stmt);
                if($res["verification"] == 1) {
                    if($res["timepass"] - 1200 < time()) {
                        $time = time() + 1800;
                        $link = md5($res["login"] . "+" . $res["email"] . "+forgotten" . time());
                        if(($res["varpass"] >= 1 && $res["varpass"] <= 3) == true || ($res["varpass"] > 3 && $res["timepass"] + 257400 < time()) == true) {
                            if($res["varpass"] > 3 && $res["timepass"] + 257400 < time() == true) {$res["varpass"] = 0;}
                            if($stmt = mysqli_prepare($sql, "UPDATE auth SET linkpass=?, varpass=?, timepass=? WHERE login=? LIMIT 1")) {
                                $once = $res["varpass"] + 1;
                                mysqli_stmt_bind_param($stmt, "siis", $link, $once, $time, $res["login"]);
                                mysqli_stmt_execute($stmt);
                                sendto("pass",$res["email"], $res["login"], "", $link); //отправка письма со ссылкой на сброс пароля
                                sendme("forgotten", $res["email"], $res["login"]); //отправка письма администратору о сбросе пароля
                                $sbk = explode('@', $res["email"]);
                                if($sbk[1] == "gmail.com") { $button = 'Проверить почту'; $href = '//mail.google.com'; }
                                elseif($sbk[1] == "yandex.ru" || $sbk[1] == "ya.ru") { $button = 'Проверить почту'; $href = '//mail.yandex.ru'; }
                                elseif($sbk[1] == "mail.ru" || $sbk[1] == "inbox.ru" || $sbk[1] == "list.ru" || $sbk[1] == "bk.ru") { $button = 'Проверить почту'; $href = '//e.mail.ru'; }
                                else { $button = 'Авторизоваться'; $href = '/login/'; }
                                $message = 'Вы успешно отправили запрос на сброс пароля<br>Вам на почту в течении 5 минут должно придти письмо со ссылкой на сброс пароля вашего аккаунта';
                                $result = array(true, $message, $button, $href);
                                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                            }
                        } else {
                            $message = 'Вы превысили лимит на сброс пароля, лимит сбросится через 72 часа';
                            $result = array(false, $message);
                            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                        }
                    } else {
                        $message = 'Вы уже недавно запрашивали письмо на сброс пароля аккаунта, пожалуйста проверьте папку "спам" в вашем почтовом ящике';
                        $result = array(false,$message);
                        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                    }
                } else {
                    $message = $res["login"].' Вам необходимо активировать свой аккаунт<br>Ссылка в письме действует 30 минут. Не пришло письмо?';
                    $result = array(false,$message);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            } else {
                $message = 'Такого пользователя не сущетсвует';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($sql);
    }

    if($operation == 'send') { //отправка запроса на активацию аккаунта
        $_POST['js'] = 1; //test
        $sql = mysqli_connect("127.0.0.1", "root", "", "test");
        if(mysqli_connect_errno()) exit();
        mysqli_set_charset($sql, "utf8");
        if($stmt = mysqli_prepare($sql, "SELECT login, email, verification, time FROM auth WHERE login=? OR email=? LIMIT 1")) {
            $login = $_GET["login"];
            mysqli_stmt_bind_param($stmt, "ss", $login, $login);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $res["login"], $res["email"], $res["verification"], $res["time"]);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt)) {
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_free_result($stmt);
                if($res["time"] - 1500 < time()) {
                    if($res["verification"] == 0) {
                        $time = time() + 1800;
                        $link = md5($res["login"] . "+" . $res["email"] . "+" . time());
                        if($stmt = mysqli_prepare($sql, "UPDATE auth SET link=?, time=? WHERE login=? LIMIT 1")) {
                            mysqli_stmt_bind_param($stmt, "sis", $link, $time, $res["login"]);
                            mysqli_stmt_execute($stmt);
                            sendto("verification",$res["email"], $res["login"], "", $link); //отправка письма со ссылкой на активацию аккаунта
                            $sbk = explode('@', $res["email"]);
                            if($sbk[1] == "gmail.com") { $button = 'Проверить почту'; $href = '//mail.google.com'; }
                            elseif($sbk[1] == "yandex.ru" || $sbk[1] == "ya.ru") { $button = 'Проверить почту'; $href = '//mail.yandex.ru'; }
                            elseif($sbk[1] == "mail.ru" || $sbk[1] == "inbox.ru" || $sbk[1] == "list.ru" || $sbk[1] == "bk.ru") { $button = 'Проверить почту'; $href = '//e.mail.ru'; }
                            else { $button = 'Авторизоваться'; $href = '/login/'; }
                            $message = 'Вы отправили запрос на активацию аккаунта<br>Вам на почту в течении 5 минут должно придти письмо с активацией вашего аккаунта';
                            $result = array(true, $message, $button, $href);
                            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                        }
                    } else {
                        $message = 'Вы уже активировали свой аккаунт';
                        $result = array(false,$message);
                        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                    }
                } else {
                    $message = 'Вы уже недавно запрашивали письмо на активацию аккаунта, пожалуйста проверьте папку "спам" в вашем почтовом ящике';
                    $result = array(false,$message);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            } else {
                $message = 'Такого пользователя не сущетсвует';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($sql);
    }

    if($operation == 'forgotten') { //сброс пароля аккаунта
        $sql = mysqli_connect("127.0.0.1", "root", "", "test");
        if (mysqli_connect_errno()) exit();
        mysqli_set_charset($sql, "utf8");
        if ($stmt = mysqli_prepare($sql, "SELECT login, pass, linkpass, timepass FROM auth WHERE linkpass=? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "s", $link);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $res["login"],$res["pass"], $res["linkpass"], $res["timepass"]);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt)) {
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_free_result($stmt);
                $time = time();
                $tdata = $res["timepass"] - $time;
                if ($tdata > 0) {
                    if ($stmt = mysqli_prepare($sql, "UPDATE auth SET pass=?, linkpass=?, timepass=?, varpass=?, logintime=? WHERE link=? LIMIT 1")) {
                        $once = 1;
                        $zero = null;
                        $pass = 0;
                        mysqli_stmt_bind_param($stmt, "bsiiis",$pass, $zero, $zero, $once, $time, $res["linkpass"]);
                        mysqli_stmt_send_long_data($stmt, 0, $pass);
                        mysqli_stmt_execute($stmt);
                        $message = $res["login"] . ' Вы успешно сбросили свой пароль, пожалуйста зайдите на сайт используя новые данные<br><br><a style="color:#ffffff;background-color:#07f;text-transform:uppercase;text-decoration:none;padding:10px;cursor:pointer;margin:10px 0;width:max-content;border:0" href="/login/">На главную</a>';
                        $result = array(true, $message, $button, $href);
                        print_r($result);
                    }
                } else {
                    $message = 'Ссылка на сброс пароля истекла<br><br><a style="color:#ffffff;background-color:#07f;text-decoration:none;text-transform:uppercase;padding:10px;cursor:pointer;margin:10px 0;width:max-content;border:0" href="../send.php?action=forgot&login='.$res["login"].'">Отправить еще раз</a>';
                    $result = array(false,$message);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            } else {
                $message = 'Вы не делали запрос на сброс пароля<br><br><a style="color:#ffffff;background-color:#07f;text-transform:uppercase;text-decoration:none;padding:10px;cursor:pointer;margin:10px 0;width:max-content;border:0" href="/">На главную</a>';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        }
    }

    if($operation == 'verification') { //проверка активации аккаунта
        $_POST['js'] = 1; // test
        $sql = mysqli_connect("127.0.0.1", "root", "", "test");
        if(mysqli_connect_errno()) exit();
        mysqli_set_charset($sql, "utf8");
        if($stmt = mysqli_prepare($sql, "SELECT login, verification, link, time FROM auth WHERE link=? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "s", $link);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $res["login"], $res["verification"], $res["link"], $res["time"]);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt)) {
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_free_result($stmt);
                if($res["verification"] != 1) {
                    $time = time();
                    $tdata = $res["time"] - $time;
                    if($tdata > 0) {
                        if($stmt = mysqli_prepare($sql, "UPDATE auth SET verification=?, time=?, link=?, logintime=? WHERE link=? LIMIT 1")) {
                            $once = 1; $zero = null;
                            mysqli_stmt_bind_param($stmt, "iiiis", $once, $zero, $zero, $time, $link);
                            mysqli_stmt_execute($stmt);
                            session_start();
                            $_SESSION['user'] = $res["login"];
                            $_SESSION['start'] = $time;
                            $_SESSION['expire'] = $_SESSION['start'] + 1800;
                            $message = $_SESSION["user"] . ' Вы успешно подтвердили свой адрес электронной почты<br><br><a style="color:#ffffff;background-color:#07f;text-transform:uppercase;text-decoration:none;padding:10px;cursor:pointer;margin:10px 0;width:max-content;border:0" href="/">На главную</a>';
                            $result = array(false, $message);
                            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                        }
                    } else {
                        $message = 'Ссылка с активацией истекла<br><br><a style="color:#ffffff;background-color:#07f;text-decoration:none;text-transform:uppercase;padding:10px;cursor:pointer;margin:10px 0;width:max-content;border:0" href="../send.php?action=send&login='.$res["login"].'">Отправить еще раз</a>';
                        $result = array(false,$message);
                        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                    }
                } else {
                    $message = 'Вы уже прошли активацию<br><br><a style="color:#ffffff;background-color:#07f;text-transform:uppercase;text-decoration:none;padding:10px;cursor:pointer;margin:10px 0;width:max-content;border:0" href="/">На главную</a>';
                    $result = array(false,$message);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            }  else {
                $message = 'Не существует<br><br><a style="color:#ffffff;background-color:#07f;text-transform:uppercase;text-decoration:none;padding:10px;cursor:pointer;margin:10px 0;width:max-content;border:0" href="/">На главную</a>';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($sql);
    }

    if($operation == 'login') { //авторизация на сайте
        $sql = mysqli_connect("127.0.0.1", "root", "", "test");
        if(mysqli_connect_errno()) exit();
        mysqli_set_charset($sql, "utf8");
        if($stmt = mysqli_prepare($sql, "SELECT login, pass, email, verification FROM auth WHERE login=? OR email=? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "ss", $login, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $res["login"], $res["pass"], $res["email"], $res["verification"]);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt)) {
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_free_result($stmt);
                if(password_verify($pass, $res["pass"])) {
                    if($res["verification"] == 1) {
                        if($stmt = mysqli_prepare($sql, "UPDATE auth SET logintime=? WHERE login=? LIMIT 1")) {
                            session_start();
                            $_SESSION['user'] = $res["login"];
                            $_SESSION['start'] = time();
                            $_SESSION['expire'] = $_SESSION['start'] + 1800;
                            $time = time();
                            mysqli_stmt_bind_param($stmt, "is", $time, $res["login"]);
                            mysqli_stmt_execute($stmt);
                            $message = $_SESSION['user'] . ' Вы успешно авторизовались<br><a href="/">На главную</a>';
                            $result = array(true,$message);
                            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                        }
                    } else {
                        $message = $res["login"].' Вам необходимо активировать свой аккаунт<br>Не пришло письмо? Ссылка в письме действует 30 минут <a href="../send.php?action=send&login='.$res["login"].'">Отправить еще раз</a>';
                        $result = array(false,$message);
                        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                    }
                } else {
                    $message = 'Введен неверный пароль. Забыли пароль? <a class="button" href="../send.php?action=forgot&login=' . $res["login"] . '">Сбросить пароль</a>';
                    $result = array(false,$message);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            } else {
                $message = 'Такого пользователя не существует';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($sql);
    }

    if($operation == 'reg') { //регистрация на сайте
        $sql = mysqli_connect("127.0.0.1", "root", "", "test") or die(mysqli_error());
        if(mysqli_connect_errno()) exit();
        mysqli_set_charset($sql, "utf8");
        if($stmt = mysqli_prepare($sql, "SELECT login, email FROM auth WHERE login=? OR email=? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, "ss", $login, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $res["login"],$res["email"]);
            mysqli_stmt_store_result($stmt);
            if(!mysqli_stmt_num_rows($stmt)) {
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_free_result($stmt);
                $link = md5($login . "+" . $email . "+" . time());
                $time = time() + 1800; $regtime = time(); $zero = 0; $once = 1;
                $stmt = mysqli_prepare($sql, "INSERT INTO auth (id, login, pass, email, verification, link, time, linktime, linkpass, varpass, logintime, regtime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "isbsisiisiii", $zero, $login, $pass, $email, $zero, $link, $time, $zero, $zero, $once, $zero, $regtime);
                mysqli_stmt_send_long_data($stmt, 2, $pass);
                mysqli_stmt_execute($stmt);
                $message = 'Вы успешно зарегистрировались<br>Вам на почту в течении 5 минут должно придти письмо с активацией вашего аккаунта';
                sendto("verification", $email, $login, "", $link); //отправка письма со ссылкой на активацию аккаунта
                $sbk = explode('@', $email);
                if($sbk[1] == "gmail.com") { $button = 'Проверить почту'; $href = '//mail.google.com'; }
                elseif($sbk[1] == "yandex.ru" || $sbk[1] == "ya.ru") { $button = 'Проверить почту'; $href = '//mail.yandex.ru'; }
                elseif($sbk[1] == "mail.ru" || $sbk[1] == "inbox.ru" || $sbk[1] == "list.ru" || $sbk[1] == "bk.ru") { $button = 'Проверить почту'; $href = '//e.mail.ru'; }
                else { $button = 'Авторизоваться'; $href = '/login/'; }
                $result = array(true, $message, $button, $href);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            } else {
                $message = 'Пользователь уже сущетсвует';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($sql);
    }

    if($operation == "order") { //заказ звонка на сайте
        $sql = mysqli_connect("127.0.0.1", "root", "", "test") or die(mysqli_error());
        mysqli_set_charset($sql, "utf8");
        $query = "SELECT email, login, phone FROM viorder WHERE email=\"$email\" OR phone=\"$phone\" LIMIT 1";
        $result = mysqli_query($sql, $query) or die(mysqli_error($sql));
        if(!mysqli_num_rows($result)) {
            $query = "INSERT INTO viorder VALUES (0,\"$login\",\"$email\",\"$phone\",\"$message\")";
            $result = mysqli_query($sql, $query) or die(mysqli_error($sql));
            sendto("order", $email, $login, $phone);  //отправка письма пользователю об успешной отправке заявки
            sendme("order", $email, $login, $phone, $message); //отправка письма администратору о новой заявке
            $message = 'Спасибо за заявку мы свяжимся с вами в течении 5 минут';
            $result = array(true,$message);
            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
        } else {
            $message = 'Вы уже отправляли сообщение, мы помним о Вас подождите еще чуть чуть';
            $result = array(false,$message);
            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
        }
        mysqli_close($sql);
    }
}

$array = array("1111111","2222222","3333333","4444444",
    "5555555","6666666","7777777","8888888",
    "9999999","0000000");

if($_GET['action'] == "forgot") {//тригер на сброс пароля
    if(!empty($_POST['name'])) {
        $login = clean(strtolower($_POST['name']));
        if (mb_strlen($login) > 3 && mb_strlen($login) < 25) {
            if(preg_match('/(^[0-9a-zA-Z._%+-@]+)$/', $login)) {
                if(!empty($_GET["login"])) {
                    $login = $_GET["login"];
                    auth("forgot", $login, "","", "", "");
                } elseif(!empty($_POST["name"])) {
                    $login = $_POST["name"];
                    auth("forgot", $login, "","", "", "");
                } else {
                    $message = 'Возникла непредвиденая ошибка, пожалуйста обратитесь к администратору';
                    $button = 'Вернуться на сайт'; $href = '/';
                    $result = array(false,$message,$button,$href);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            }  else {
                $message = 'Логин содержит запрещенные символы';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        }  else {
            $message = 'длинна >3 и <15 логин';
            $result = array(false,$message);
            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
        }
    } else {
        $message = 'Заполните все поля';
        $result = array(false,$message);
        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
    }
}

if($_GET['action'] == "send") { //тригер отправки писем
    if(!empty($_GET["login"])) {
        $login = $_GET["login"];
        auth("send",$login, "","", "", "");
    } else {
        $message = 'Возникла непредвиденая ошибка, пожалуйста обратитесь к администратору';
        $button = 'Вернуться на сайт'; $href = '/';
        $result = array(false,$message,$button,$href);
        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
    }
}

if($_GET['action'] == "phone") { //проверка телефона на валидность
    if(!empty($_POST['phone'])) {
        $result = clean($_POST['phone']);
        if(mb_strlen($result) > 10 && mb_strlen($result) < 19) {
            if(!preg_match('/^[\p{L}\p{Z}]/',$result)) {
                $result = preg_replace('/[^0-9]/','',$result);
                foreach ($array as $arr) {
                    if(strpos(substr($result, -10, 10), $arr) !== false) {
                        $result = 'Номер должен быть валидным';
                        if(isset($_POST['js'])) {
                            print_r($result);
                        } else {
                            echo json_encode($result);
                        }
                        return true;
                    }
                }
                $phone_num = "Ваш номер: +".substr($result,0,1)." (".substr($result,1,3).") ".substr($result,4,3)."-".substr($result,7,2)."-".substr($result,9,2);
                $result = array(true,$phone_num);
                echo json_encode($result);
            } else {
                $message = 'В номере телефона не должно быть букв';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        } else {
            $message = 'Укажите действительный номер телефона';
            $result = array(false,$message);
            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
        }
    } else {
        $message = 'Заполните поле с телефоном';
        $result = array(false,$message);
        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
    }
}

if($_GET['action'] == "login") { //тригер и проверки полей формы авторизации на сайте
    if(!empty($_POST['name']) && !empty($_POST['password'])) {
        $login = clean(strtolower($_POST['name']));
        $pass = clean($_POST['password']);
        if(mb_strlen($login) > 3 && mb_strlen($login) < 25) {
            if(mb_strlen($pass) >= 6 && mb_strlen($pass) < 25) {
                if(preg_match('/(^[0-9a-zA-Z._%+-@]+)$/', $login)) {
                    if(preg_match('/(^[a-zA-Z0-9!@#$%^&*()-_+]+)$/', $pass)) {
                        auth('login',$login,"", $pass,"", "");
                    }  else {
                        $message = 'Пароль содержит запрещенные символы';
                        $result = array(false,$message);
                        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                    }
                }  else {
                    $message = 'Логин содержит запрещенные символы';
                    $result = array(false,$message);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            }  else {
                $message = 'длинна пароля >=6 и <25';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        }  else {
            $message = 'длинна >3 и <15 логин';
            $result = array(false,$message);
            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
        }
    } else {
        $message = 'Заполните все поля';
        $result = array(false,$message);
        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
    }
}

if($_GET['action'] == "reg") { //тригер и проверки полей формы регистрации на сайте
    if(!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])) {
        $login = clean(strtolower($_POST['name']));
        $pass = clean($_POST['password']);
        $pass2 = clean($_POST['password2']);
        $email = clean(strtolower($_POST['email']));
        if(mb_strlen($login) > 3 && mb_strlen($login) < 15) {
            if(mb_strlen($pass) >= 6 && mb_strlen($pass) < 25) {
                if(preg_match('/(^[a-zA-Z0-9]+)$/', $login)) {
                    if(preg_match('/(^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$)/', $email)) {
                        if(preg_match('/(^[a-zA-Z0-9!@#$%^&*()-_+]+)$/', $pass)) {
                            if($pass2 == $pass) {
                                auth('reg', $login, $email, better_crypt($pass),"", "");
                            } else {
                                $message = 'Пароли должны совпадать';
                                $result = array(false,$message);
                                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                            }
                        } else {
                            $message = 'Пароль содержит запрещенные символы';
                            $result = array(false,$message);
                            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                        }
                    } else {
                        $message = 'Email введен не корректно';
                        $result = array(false,$message);
                        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                    }
                } else {
                    $message = 'Логин содержит запрещенные символы';
                    $result = array(false,$message);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            } else {
                $message = 'длинна пароля >=6 и <25';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        } else {
            $message = 'длинна >3 и <15 логин';
            $result = array(false,$message);
            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
        }
    } else {
        $message = 'Заполните все поля';
        $result = array(false,$message);
        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
    }
}

if($_GET['action'] == "verification") {//тригер на верификацию аккаунта пользователя
    if(!empty($_GET['code'])) {
        $code = $_GET['code'];
        auth('verification',"", "", "", $code, "");
    }
}

if($_GET['action'] == "forgotten") {//тригер на восстановление пароля аккаунта пользователя
    if(!empty($_GET['code'])) {
        $code = $_GET['code'];
        $pass = clean($_POST['password']);
        if(preg_match('/(^[a-zA-Z0-9!@#$%^&*()-_+]+)$/', $pass)) {
            auth('forgotten',"","", $pass,$code, "");
        }  else {
            $message = 'Пароль содержит запрещенные символы';
            $result = array(false,$message);
            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
        }
    }
}

if($_GET['action'] == "ordercall") {//тригер и проверки полей формы на заказ звонка на сайте
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['message']) ) {
        $name = clean($_POST['name']);
        $email = clean(strtolower($_POST['email']));
        $phone = clean($_POST['phone']);
        $message = clean($_POST['message']);
        if(preg_match('/(^[a-zA-ZА-Яа-яЁё]+)$/u', $name)) {
            $phone = preg_replace('/[^0-9]/','',$phone);
            if(mb_strlen($phone) > 10 && mb_strlen($phone) < 19) {
                if(!preg_match('/^[\p{L}\p{Z}]/',$phone)) {
                    foreach ($array as $arr) {
                        if(strpos(substr($phone, -10, 10), $arr) !== false) {
                            $message = 'Номер должен быть валидным';
                            $result = array(true,$message);
                            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                            return true;
                        }
                    }
                    if(preg_match('/(^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$)/', $email)) {
                        $phone = substr($phone,0,1).''.substr($phone,1,3).''.substr($phone,4,3).''.substr($phone,7,2).''.substr($phone,9,3);
                        auth("order", $name, $email, "", $message, $phone);
                    } else {
                        $message = 'Указанная почта не валидна';
                        $result = array(false,$message);
                        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                    }
                } else {
                    $message = 'В номере телефона не должно быть букв';
                    $result = array(false,$message);
                    if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
                }
            } else {
                $message = 'Укажите действительный номер телефона';
                $result = array(false,$message);
                if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
            }
        } else {
            $message = 'В имени присутсвуют запрещенные символы';
            $result = array(false,$message);
            if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
        }
    } else {
        $message = 'Заполните все поля';
        $result = array(false,$message);
        if(isset($_POST['js'])) print_r($message); else echo json_encode($result);
    }
}
?>