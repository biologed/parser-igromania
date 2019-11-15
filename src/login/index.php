//= inc/header.php
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