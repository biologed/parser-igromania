<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/main.js"></script>
    <title>Новости</title>
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
</div>
<div style="height: 50px"></div>
</body>
</html>