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
        <h2>Авторизаия</h2>
    </div>

    <div class="row">
        <div class="col-md-12 order-md-1">
            <form action="/site/login" method="post" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Логин</label>
                        <input type="text" class="form-control <?= $model->hasError('login') ? "is-invalid" : "";?>" id="firstName" placeholder="" value="<?= $model->login?>" name="login" required>
                        <div class="invalid-feedback">
                            <?= $model->getError('login');?>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Пароль</label>
                        <input type="text" class="form-control <?= $model->hasError('password') ? "is-invalid" : "";?>" id="firstName" placeholder="" value="<?= $model->password?>" name="password" required>
                        <div class="invalid-feedback">
                            <?= $model->getError('password');?>
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Войти</button>
            </form>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2020-2021 Company Name</p>
    </footer>
</body>
</html>