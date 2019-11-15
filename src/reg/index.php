//= inc/header.php
<div class="container" width="50%">
    <h1>Form Reg</h1>

    <form id="reg" action="../send.php?action=reg" method="post">

        <div class="grid">
            <div class="field col-1-2">
                <label for="inp" class="inp">
                    <input type="text" placeholder="&nbsp;" pattern="[0-9a-zA-Z]{3,15}" maxlength="15" oninvalid="this.setCustomValidity('Укажите корретный логин, длинна логина должна быть не менее 3 символов и не более 15')" oninput="this.setCustomValidity('')" name="name" required>
                    <span class="label">Login</span>
                    <span class="border"></span>
                </label>
            </div>

            <div class="field col-1-2">
                <label for="inp" class="inp">
                    <input type="password" placeholder="&nbsp;" pattern='[0-9a-zA-Z!@#$%^&*()-_+]{6,25}' maxlength="25" oninvalid="this.setCustomValidity('Укажите корректный пароль, длинна пароля должна быть не менее 6 символов и не более 25 и не содержать в себе запрещенных знаков, !@#$%^&*()-_+ ')" oninput="this.setCustomValidity('')" name="password" required >
                    <span class="label">Password</span>
                    <span class="border"></span>
                </label>
            </div>

            <div class="field col-1-2">
                <label for="inp" class="inp">
                    <input type="password" placeholder="&nbsp;" pattern='[0-9a-zA-Z!@#$%^&*()-_+]{6,25}' maxlength="25" oninvalid="this.setCustomValidity('Укажите корректный пароль, длинна пароля должна быть не менее 6 символов и не более 25 и не содержать в себе запрещенных знаков, !@#$%^&*()-_+ ')" oninput="this.setCustomValidity('')" name="password2" required>
                    <span class="label">Password2</span>
                    <span class="border"></span>
                </label>
            </div>

            <div class="field col-1-2">
                <label for="inp" class="inp">
                    <input type="email" placeholder="&nbsp;" pattern='[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$' maxlength="25" oninvalid="this.setCustomValidity('Укажите корректный email')" oninput="this.setCustomValidity('')" name="email" required>
                    <span class="label">E-mail</span>
                    <span class="border"></span>
                </label>
            </div>

            <input type="hidden" id="js" name="js" value="">
            <div width="25%" class="button field"><button id="send-form" class="show_popup">Зарегистрироватся</button></div>
        </div>
    </form>
</div>

<?php
include_once('../inc/footer.php');
?>
</body>
</html>