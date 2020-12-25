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
        <h2><?= $title?></h2>
    </div>
    <?php
    $disabled = false;
    if ($user->isAdmin() && $model->id) $disabled = true;
     ?>
    <div class="row">
        <div class="col-md-12 order-md-1">
            <form action="/site/<?= $model->id ? "update?id=" . $model->id : "create" ;?>" method="post" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Имя пользователя</label>
                        <input type="text" <?php if ($disabled) echo "disabled";?> class="form-control <?= $model->hasError('username') ? "is-invalid" : "";?>" id="firstName" placeholder="" value="<?= $model->username?>" name="username" required>
                        <div class="invalid-feedback">
                            <?= $model->getError('username');?>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" <?php if ($disabled) echo "disabled";?> class="form-control <?= $model->hasError('email') ? "is-invalid" : "";?>" id="email" name="email" value="<?= $model->email?>" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            <?= $model->getError('email');?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="text" class="form-label">Текст</label>
                    <textarea class="form-control <?= $model->hasError('text') ? "is-invalid" : "";?>" id="text" name="text" rows="3"><?= $model->text;?></textarea>
                    <div class="invalid-feedback">
                        <?= $model->getError('text');?>
                    </div>
                </div>
                <?php if ($user->isAdmin()): ?>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input " value="<?= $model->done;?>" <?php if ($model->done == 1)  echo "checked='checked'";?> id="done" name="done">
                        <label class="custom-control-label" for="done">
                            Завершено
                        </label>
                    </div>
                <?php endif; ?>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Сохранить</button>
                <a href="/site/index" class="btn btn-primary btn-lg btn-block" >Назад</a>
            </form>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2020-2021 Company Name</p>
    </footer>
</body>
</html>
<script>
    const checkbox = document.getElementById('done')

    checkbox.addEventListener('change', (event) => {
        if (event.target.checked) {
            checkbox.value = 1;
        } else {
            checkbox.value = 0;
        }
    })
    </script>
