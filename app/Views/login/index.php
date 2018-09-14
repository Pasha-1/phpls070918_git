<div class="form-container">
    <?php if(!$loginStatus): ?>
    <form class="form-horizontal" action="/login/index" method="post">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Логин">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Пароль">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Войти</button>
                <br><br>
                Нет аккаунта? <a href="/login/register">Зарегистрируйтесь</a>
            </div>
        </div>
    </form>
    <?php else: ?>
        <h3>Успешно! <a href="/profile">Перейти в профиль</a></h3>
    <?php endif ?>
</div>