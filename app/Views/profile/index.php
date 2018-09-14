<h2>Личный кабинет</h2>
<div>
<?php if (!$userInfo['img']): ?>
    <img height="200" src="/img/no-photo.jpg"/>
<?php else: ?>
    <img height="200" src="/img/profiles/<?php echo $userId ?>/<?php echo $userInfo['img'] ?>"/>
<?php endif ?>
</div>
<h3>Ваше имя / Логин: <?php echo htmlspecialchars($userInfo['name']); ?></h3>
<p>Ваш возраст: <?php echo $userInfo['age']; ?></p>
<p>Информация: <?php echo htmlspecialchars($userInfo['description']); ?></p>
<a class="btn btn-default" href="/profile/edit">Редактировать профиль</a><br/>

<?php if ($fileData): ?>
<h4>Загруженные файлы:</h4>
<?php foreach ($fileData as $file): ?>
<div><a href="/img/files/<?php echo $userId; ?>/<?php echo $file['file']; ?>"><?php echo $file['file']; ?></a></div>
<?php endforeach ?>
<?php else: ?>
<h4>Загруженных файлов еще нет.</h4>
<?php endif ?>
<a class="btn btn-default" href="/profile/addfile">Загрузить файлы</a>
