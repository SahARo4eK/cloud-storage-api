Описание сервиса:

Макет облачого хранилища с API. После авторизации пользователю предлагается директория для хранения файлов.

На клиентской части возможны действия:
1. Создание папок
2. Загрузка файлов в директорию или в созданные папки
3. Удаление файлов и папок
4. Переименование файлов и папок
5. Скачивание файлов
6. Получение размера папки или всей пользовательской директории
7. Получение ссылки на файлы

- Максимальный объем всех файлов на диске одного пользователя - 100 мб
- Максимальный размер загружаемого файла 20мб
- Запрещено загружать *.php файлы

Адреса запросов API:
- http://80.249.144.53/get-directory - GET - директория пользователя
- http://80.249.144.53/get-user-name - GET - имена зарегистрированых пользователей
- http://80.249.144.53/get-directory-size - GET - параметры: folder - размер директории
- http://80.249.144.53/get-public-url - GET - параметры: fileName - публичная ссылка на файл
- http://80.249.144.53/create-folder - POST - параметры: folderName - создание папки
- http://80.249.144.53/upload-file - POST - параметры: file, folder - загрузка файла в папку
- http://80.249.144.53/delete-item - POST - параметры: itemName - удаление файла или папки
- http://80.249.144.53/rename-item - POST - параметры: itemName, newName - переименование файла и папки


Этапы установки на сервер:

1. Установка Git
2. Установка php 8.1^, unzip
3. Установка apt install php-xml php-dom php-curl
4. Установка Composer (https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04-ru)
5. Установка Docker (version 20.10.17, build 100c701) (https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04-ru)
6. Установка Docker compose (version 1.26.0, build d4451659) (https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04-ru)
7. Пулим проект в папку /var/www/html - git pull git@github.com:SahARo4eK/cloud-storage-api.git   Если папки нет — создаем.
8. Устанавливаем sail через composer require laravel/sail
9. apt install php-pgsql
10. Перенастроить адрес связи с БД, адрес сервиса
11. установить права
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
sudo chown -R $USER:www-data public/users-files/

В директории проекта запустить ./vendor/bin/sail up


Postman коллекция запросов прилагается