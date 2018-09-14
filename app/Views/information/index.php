<h2>Список пользователей</h2>
<table class="table table-bordered">
    <tr>
        <th>ID пользователя</th>
        <th>Пользователь(логин)</th>
        <th>Возраст</th>
        <th>Описание</th>
        <th>Совершеннолетие</th>
        <th>Аватар</th>
    </tr>
    <?php foreach ($usersInfo as $userInfo): ?>
    <tr>
        <td><?php echo $userInfo['id']; ?></td>
        <td><?php echo htmlspecialchars($userInfo['name']); ?></td>
        <td><?php echo $userInfo['age']; ?></td>
        <td><?php echo htmlspecialchars($userInfo['description']); ?></td>
        <td><?php echo $userInfo['adult']; ?></td>
        <td>
            <?php if (!$userInfo['img']): ?>
                <img height="100" src="/img/no-photo.jpg"/>
            <?php else: ?>
                <img height="100" src="/img/profiles/<?php echo $userInfo['id'] ?>/<?php echo $userInfo['img'] ?>"/>
            <?php endif ?>
        </td>
        <td>
            <a href="">Удалить пользователя</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
