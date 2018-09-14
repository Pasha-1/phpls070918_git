<div class="form-container">
    <?php if(!$registerStatus): ?>
    <form class="form-horizontal" action="/login/register" method="post">
        <?php foreach ($errors as $error): ?>
            <p class="text-danger"><?php echo $error; ?></p>
        <?php endforeach ?>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Логин">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Возраст</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="age" placeholder="Возраст">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Пароль">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword4" class="col-sm-2 control-label">Пароль (Повтор)</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword4" name="password2" placeholder="Пароль">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Зарегистрироваться</button>
                <br><br>
                Зарегистрированы? <a href="/login">Авторизируйтесь</a>
            </div>
        </div>
    </form>
    <?php else: ?>
        <h3>Успешно! <a href="/profile">Перейти в профиль</a></h3>
    <?php endif ?>
</div>