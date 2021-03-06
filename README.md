Сделана реализация части тестового задания. 
Реализовано на фреймворке Phalcon 3.4.3 + mariadb (докерфайл взял готовый, не хотелось тратить время на конфигурацию)

**Для просмотра и настройки площадки необходимо выполнить:**
1) composer install
2) docker-compose up -d

Необходимо накатить миграции:
1) войти в контейнер "docker exec -it phalcon-server bash"
2) выполнить "cd vendor/ && php bin/phinx migrate"

В случае проблем с доступностью бд, необходимо:
1) получить ip командой
"docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mariadb-server"
2) полученный ip адрес необходимо прописать в rafflePrizes/app/config/params.php
3) повторить накатывание миграций

Миграция создаст 5 таблиц:
1) users - хранилище пользователей
2) wallet - хранилище призов-денег
3) loyalty - хранилище призов-бонусов
4) storage - хранилище призов-предметов
5) things - хранилище физических предметов (используются в storage)
Структуру можно глянуть в миграции:
vendor/db/migrations/20200320121749_create_user_table.php

**Структура проекта:**

точка входа - rafflePrizes/public/index.php,
однако весь основной код в папке rafflePrizes/app.

в файле rafflePrizes/app/config/bootstrap.php идет инициализация ди-контейнера с настройкой всех сервисов.

в файле rafflePrizes/app/config/params.php настройки

в папке rafflePrizes/app/routes - расположены роуты. Все роуты собираются в файле rafflePrizes/app/routes/RouterBuilder.php
в папке rafflePrizes/app/controllers лежат контроллеры. Была попытка сделать тонкие контроллеры, полноценные не получилось сделать

основной код в папке rafflePrizes/app/services.

Добавлено 5 сервисов:
1) AuthService - сервис для входа/выхода и получение текущего пользователя
2) UserService - сервис для работы с пользователем
3) RaffleService - основной сервис приложения. У сервиса один метод получения случайного приза. 
Для создания призов сделана фабрика.
4) DeliveryService - сервис для имитации службы доставки. Метод доставки принимает объекты, реализующий интерфейс 
rafflePrizes/app/interfaces/services/deliveryService/model/DeliverableInterface.php
Данный интерфейс реализует приз типа "физический предмет" (rafflePrizes/app/services/raffleService/factory/prizes/PhysicalPrize.php)
5) ThingsService - сервис достает предметы из хранилища физических предметов. Приз "физический предмет" должен быть одним из этих предметов.
Реализовано не очень хорошо, доставание нужно переносить в слой репозитория, сейчас там достается с помощью
активной модели (я не сторонник использования активных моделей), но сделано так, ввиду дефицита времени.

**Общая логика работы приложения:**
1) При попытке открыть любую страницу, изначально идет проверка авторизации в middleware.
Учитывая особенности фалькона, реализовано в виде плагина "rafflePrizes/app/plugins/SecurityPlugin.php".
2) если пользователь не авторизован - переадресация на страницу авторизации. Там же можно зарегистрироваться.
Миграцией добавляется тестовый пользователь test@mail.ru // test
3) после авторизации открывается главная страница с одной кнопки для участие в розыгрыше
4) после клика идет получение рандомного приза и вывод информации о том какой приз выигран.
Под капотом происходит следующее:
1) получение случайного приза
2) привязка приза к текущему пользователю 
3) применение приза к текущему пользователю (под применением подразумевается индивидуальное действие актуальное для данного приза)

Привязка приза сделана отдельным методом, что бы была возможность сгенерировать призы без привязки к конкретному пользователю.
Это могло бы быть полезно, для реализации требования "консольную команду которая будет отправлять денежные призы на счета пользователей"
Данное требование реализовано не было ввиду дефицита времени.

Применение приза также сделано отдельным методом, что бы была возможность не применять сразу приз.
Это могло бы быть полезно, для реализации требований "Денежный приз может конвертироваться в баллы лояльности с учетом коэффициента. От приза можно отказаться"
Данные требования реализованы не были ввиду дефицита времени.

В целом некоторые моменты сделаны упрощенно или не совсем аккуратно - не хотелось затрачивать слишком много времени.
На тестовое задание затрачено около 7-8 часов.




