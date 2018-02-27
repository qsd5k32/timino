# Timino, Simple lightweight and S.O.L.I.D PHP MVC framework 
![logo](https://user-images.githubusercontent.com/18489496/31467436-e0e2d408-aed1-11e7-95f5-07174228327a.png)
#
![Licence](https://img.shields.io/badge/Licence-MIT-f1c40f.svg)
![PHP7](https://img.shields.io/badge/PHP-7-3498db.svg)
![version](https://img.shields.io/badge/version-1.0.0-27ae60.svg)
![build](https://img.shields.io/badge/build-passing-8e44ad.svg)
![coverage](https://img.shields.io/badge/coverage-15%25-95a5a6.svg)
![downloads](https://img.shields.io/badge/downloads-100-c0392b.svg)
### Introduction :
Timino is a simple, lightweight and S.O.L.I.D PHP MVC framework. Timino is a practical, easy to understand and suitable for small projects, Timino is not very complicated so you don't need to be an advanced PHP developer just some solid basic knowledge and you are ready to go.
. In addition you don't need to learn a very complicated documentation Besides it is customizable so you can customize and add different functionality and services.

### Features : 
- Simple and easy to understand. 
- Clean and documented code.
- Tries to follows S.O.L.I.D principles.
- Uses PHP >= 7. 
- Psr-4 autoloading. 
- Tries to follow PSR coding guidelines.
- Timino cli (console) for easy development.
- Uses PDO for any database requests.
- simple crud system (_select, _update, _delete, _insert)
- Uses Services to perform different tasks. 
- Ability to create own services.
- Ability to extends any PHP package with composer.

### Requirements :
- PHP 7.0 or newer version
- MySQL (if you work with databases)
- mod_rewrite activated (Apache module of course)
- basic knowledge of Composer for sure

### Installation :
- Via composer :

```
composer create-project lotfio-lakehal/timino projectName
```

 Configuration :
 ================

  ### Web server configuration 
  #### Apache
  * Apache rewrite module must be activated
  * Your apache config file for this application should look something like this :

```apache
<VirtualHost *:80>
    
    ServerAdmin  webmaster@localhost
    DocumentRoot /var/www/yourproject/pub
    ServerName   yourproject.dev
     
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
    
    <Directory /var/www/yourproject/pub>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    

</VirtualHost>
```

  #### Nginx 
  * If you are using nginx your config file should look like this :
```nginx
server{
    listen       80 default_server;
    server_name  yourproject.dev;
    error_log    /var/log/nginx/error.log;
    
    root /var/www/yourproject/pub;
    
    client_max_body_size 500M;
    server_tokens off;
    

    location / {
        index index.php index.html index.htm;
        try_files /$uri /$uri/ /index.php?uri=$uri&$query_string;
    }

    location ~ \.(php)$ {
        fastcgi_pass   unix:/var/run/php/php7.1-fpm.sock;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

}
```
