### <p align="center">Task Manager</p>


## Stack

- > Laravel 8;
- > (>=)PHP 7.3;
- > Apache2;
- > js;
- > Bootstrap.


## Installation
Склонировать проект в ```/var/www```

Выполнить команду ```composer install```

 Настроить хосты:
```sudo nano /etc/hosts```

Поменять название хоста петли ```127.0.0.1       example.com```

 Необходимо настроить apache2:
```cd /etc/apache2/sites-available```
```sudo cp 000-default.conf taskmanager.conf```
Открыть taskmanager.conf через nano, либо ручками, прописать следующее:
```
<VirtualHost *:80>
           # The ServerName directive sets the request scheme, hostname and port that
           # the server uses to identify itself. This is used when creating
           # redirection URLs. In the context of virtual hosts, the ServerName
           # specifies what hostname must appear in the request's Host: header to
           # match this virtual host. For the default virtual host (this file) this
           # value is not decisive as it is used as a last resort host regardless.
           # However, you must set it for any further virtual host explicitly.
           #ServerName www.example.com
   
           ServerAdmin yourmail@example.com
           ServerAlias example.com
           DocumentRoot /var/www/TaskManager/public
   
           <Directory /var/www/TaskManager/public>
              Options -Indexes +FollowSymLinks +MultiViews
               AllowOverride All
               Require all granted
               <FilesMatch \.php$>
                  #Change this "proxy:unix:/path/to/fpm.socket"
                  #if using a Unix socket
                  #SetHandler "proxy:fcgi://127.0.0.1:9000"
               </FilesMatch>
           </Directory>
   
           # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
           # error, crit, alert, emerg.
           # It is also possible to configure the loglevel for particular
           # modules, e.g.
           #LogLevel info ssl:warn
   
           ErrorLog ${APACHE_LOG_DIR}/error.log
           CustomLog ${APACHE_LOG_DIR}/access.log combined
   
           # For most configuration files from conf-available/, which are
           # enabled or disabled at a global level, it is possible to
           # include a line for only one particular virtual host. For example the
           # following line enables the CGI configuration for this host only
           # after it has been globally disabled with "a2disconf".
           #Include conf-available/serve-cgi-bin.conf
   </VirtualHost>
```
Сохранить и активировать данный сайт:
```sudo a2ensite taskmanager.conf```

 Ребутнуть apache2: ```sudo service apache2 restart```
 
 Установить пермишены в проекте: ```sudo chmod -R 755 ./storage```
 
 Создать файл sqlite ```cd database ```
```sqlite3 database.sqlite```

 Скопировать .env ```cp .env.example .env``` и кое-что изменить:
```DB_CONNECTION=sqlite
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=/home/pticagnom/www/TaskManager/database/database.sqlite
   DB_USERNAME=root
   DB_PASSWORD=
```
```
QUEUE_CONNECTION=database
```
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=056c5c89e9fd43
MAIL_PASSWORD=b03f1fb7c04fcc
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=taskmanager@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```
```
Это добавить
GOOGLE_CLIENT_ID=54263038706-de4497dbiekfcnkb3kfc86u8mrao2421.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=zpK7LIFFSYlOrEELJ_2X3_c6
GOOGLE_REDIRECT=http://example.com/google/callback
```
Выполнить команды: ```php artisan config:cache``` ```php artisan cache:clear``` ```php artisan migrate --seed``` ```php artisan queue:work```

### Тестирование
Запустить команду
```php artisan test```

### Endpoints
Перейти по ссылке <a href="http://example.com/api/documentation">Документация</a>