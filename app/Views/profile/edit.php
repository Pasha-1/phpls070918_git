<h2>Редактировать профиль</h2>
<?php if ($pageUpdate): ?>
<h3>Профиль обновлен!</h3>
<?php endif ?>
<form enctype="multipart/form-data" action="/profile/edit" method="post">
    <div class="form-group">
        <?php if (!$userInfo['img']): ?>
            <img height="200" src="/img/no-photo.jpg"/>
        <?php else: ?>
            <img height="200" src="/img/profiles/<?php echo $userId ?>/<?php echo $userInfo['img'] ?>"/>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Выберите файл (jpeg, jpg, png)</label>
        <input type="file" name="logo" id="exampleInputFile">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Ваше имя / Логин</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ваше имя / Логин" name="name" value="<?php echo htmlspecialchars($userInfo['name']); ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">Ваш возраст</label>
        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Ваш возраст" name="age" value="<?php echo $userInfo['age']; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail3">Информация</label>
        <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Информация" name="description" value="<?php echo htmlspecialchars($userInfo['description']); ?>">
    </div>
        <button type="submit" class="btn btn-default">Сохранить</button>
    <?php foreach ($errors as $error): ?>
    <div class="form-group">
        <p class="text-danger"><?php echo $error; ?></p>
     </div>
    <?php endforeach ?>
</form>