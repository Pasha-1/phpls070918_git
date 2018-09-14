<h2>Добавить файлы</h2>
<p>Поддерживаются: jpg, jpeg, png, doc</p>
<form enctype="multipart/form-data" action="/profile/addfile" method="post">
    <div class="form-group">
        <label for="exampleInputFile">Выберите файл</label>
        <input type="file" name="document" id="exampleInputFile">
    </div>
    <button type="submit" class="btn btn-default">Добавить</button>
</form>
<?php foreach ($errors as $error): ?>
<p class="text-danger"><?php echo $error; ?></p>
<?php endforeach ?>
<?php if ($fileData): ?>
    <h4>Загруженные файлы:</h4>
<?php foreach ($fileData as $file): ?>
<div><a href="/img/files/<?php echo $userId; ?>/<?php echo $file['file']; ?>"><?php echo $file['file']; ?></a></div>
<?php endforeach ?>
<?php else: ?>
<h4>Загруженных файлов еще нет.</h4>
<?php endif ?>