# тестовое приложение
# в реализации много условностей сделано чисто для примера

- чистый mvc не стал использовать сознательно. Бизнес логика реализуется в сервисе.
- входной скрипт Web/index.php
- в фаиле Config/Main.php указать доступ до БД
- функционал  query билдера взят из моего репозитория https://github.com/exgamer/php-data-core для экономии времени в свое время был написан на чистом пхп с нуля
- функционал сервисов  взят из моего репозитория https://github.com/exgamer/php-logic-core для экономии времени в свое время был написан на чистом пхп с нуля
- функционал репозиториев взят из моего репозитория  https://github.com/exgamer/php-data-core для экономии времени в свое время был написан на чистом пхп с нуля

# Ограничения приложения

- роутер понимает только url типа 
    /controller/action
    /controller/action/?id=1
- порядок гет параметров тоже важен
- ЧПУ не реализован
- модули не поддерживаются
- из за условий задания композер не прикручен
- dotenv не прикручен
- заточено только для mysql