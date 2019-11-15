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
<div class="container" width="50%">
    <h1>Form Auth</h1>
    <form id="login" action="../send.php?action=login" method="post">

        <div class="grid">
            <div class="field col-1-2">
                <label for="inp" class="inp">
                    <input type="text" placeholder="&nbsp;" pattern="[0-9a-zA-Z._%+-@]{3,25}" maxlength="25" oninvalid="this.setCustomValidity('Укажите корретный логин или почту, длинна логина должна быть не менее 3 символов и не более 25')" oninput="this.setCustomValidity('')" name="name" required>
                    <span class="label">Login/Email</span>
                    <span class="border"></span>
                </label>
            </div>
            <div class="field col-1-2">
                <label for="inp" class="inp">
                    <input type="password" placeholder="&nbsp;" pattern='[0-9a-zA-Z!@#$%^&*()-_+]{6,25}' maxlength="25" oninvalid="this.setCustomValidity('Укажите корректный пароль, длинна пароля должна быть не менее 6 символов и не более 25 и не содержать в себе запрещенных знаков, !@#$%^&*()-_+ ')" oninput="this.setCustomValidity('')" name="password" required>
                    <span class="label">Password</span>
                    <span class="border"></span>
                </label>
            </div>
            <input type="hidden" id="js" name="js" value="">
            <div width="" class="button field"><button id="loginform" class="show_popup">Войти</button></div>
            <div width="" class="button field"><a href="/forgot/" class="button">Забыли парлль?</a></div>
        </div>
    </form>
</div>
<?php
include_once('../inc/footer.php');
?>
</body>
</html>