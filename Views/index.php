<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <title>ТЕСТ</title>
</head>
<body>
<div class="container">
    <div class="py-5 text-center">
        <h2>Задачи</h2>
    </div>
    <a href="/site/create" class="btn btn-primary btn-lg btn-block" >Добавить</a>
    <?php if (! $user->isAdmin()) : ?>
        <a href="/site/login" class="btn btn-primary btn-lg btn-block" >Авторизация</a>
    <?php endif;?>
    <?php if ($user->isAdmin()) : ?>
        <a href="/site/logout" class="btn btn-primary btn-lg btn-block" >Выход</a>
    <?php endif;?>
    <?php if ($models): ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <a class="page-link " href="/site/index?page=<?= $page?>&username=<?= isset($orderBy['username']) ? ($orderBy['username'] == "DESC" ? "ASC" : "DESC") :  "ASC"?>">
                        Имя пользователя
                    </a>
                </th>
                <th scope="col">
                    <a class="page-link " href="/site/index?page=<?= $page?>&email=<?= isset($orderBy['email']) ? ($orderBy['email'] == "DESC" ? "ASC" : "DESC") : "ASC"?>">
                        email
                    </a>
                </th>
                <th scope="col">
                    Задача
                </th>
                <th scope="col">
                    <a class="page-link " href="/site/index?page=<?= $page?>&done=<?= isset($orderBy['done']) ? ($orderBy['done'] == "DESC" ? "ASC" : "DESC") : "ASC"?>">
                        Завершено
                    </a>
                </th>
                <?php if ($user->isAdmin()) : ?>
                    <th scope="col">Действия</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($models as $model): ?>
                    <tr>
                        <th scope="row"><?= $model['id']; ?></th>
                        <td><?= $model['username']; ?></td>
                        <td><?= $model['email']; ?></td>
                        <td><?= $model['text']; ?></td>
                        <td><?= $model['done'] == 0 ? "Нет" : "Да"; ?></td>
                        <?php if ($user->isAdmin()) : ?>
                            <td><a href="/site/update?id=<?= $model['id']; ?>" class="btn btn-primary">Редактировать</a></td>
                        <?php endif;?>
                    </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php if ($pageCount > 1) :?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i=0; $i<$pageCount; $i++):?>
                        <li class="page-item <?php if ($page == $i) echo "active";?>">
                            <a class="page-link " href="/site/index?page=<?= $i?>">
                                <?= $i+1;?>
                            </a>
                        </li>
                    <?php endfor;?>
                </ul>
            </nav>
        <?php endif;?>
    <?php else:?>
        <br/><br/>
        <div class="alert alert-primary" role="alert">
             Нет задач
        </div>
    <?php endif;?>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2020-2021 Company Name</p>
    </footer>
</body>
</html>