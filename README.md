# Timino PHP S.O.L.I.D MVC framework 
# Note : This is version 1.0.0 alpha
### Introduction :
Timino is a simple and lightweight PHP MVC framework practical and easy to understand and suitable for small projects, Timino is not very complicated so you dont need to be an advanced php developer just some solid basic knowledge and you are ready to go 
. Timino is simple framework you don't need to learn a very complicated documentation Besides it is customizable so you can customize and add different functionality and services

### Features : 
- Simple and easy to understand 
- Clean and documented code 
- Tries to follows SOLID principles
- Uses PHP >= 7 
- Psr-4 autoloading 
- Tries to follow PSR coding guidelines
- Uses PDO for any database requests, comes with an additional PDO debug tool to emulate your SQL statements
commented code
- Uses only native PHP code, so people don't have to learn a framework
- Uses Services to perform different tasks 
- Ability to create own services

### Requirements :
- PHP 7.0 or newer version
- MySQL (if you work with databases)
- mod_rewrite activated (Apache module of course)
- basic knowledge of Composer for sure

### Instalation :
- Via composer :
```
composer require timino/timino
```
- Manually:
- Clone from github via SSH or HTTPS
 
```
SSH  : git clone git@github.com:lotfio-lakehal/timino.git
HTTPS : git clone https://github.com/lotfio-lakehal/timino.git
```
- Or download it directly from github as a compressed file

### Configuration :

- After downloading the package with composer you will get something structured like this
```
 Your project
 └── vendor
     ├── composer
     └── timino
         └── timino // move all this folder content to Your base project
             ├── App
             │ 
             └── pub
 ```
 - Move App and pub and composer.json from timino to your base folder your project folder
 
 - *It should look like this* :
 ```
 Your project 
 ├── App
 │   
 ├── pub
 │ --- composer.json 
 │ --- composer.lock
 └── vendor
 ```
 - now run 

 ```
 composer dump-autoload 
 ```
  - to generate the autoloading files .
  
  ### Web server configuration 
  #### Apache
  * Apache rewrite module must be activated
  * Your apache config file for this application should look something like this :
  ```
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
  * If you are using nginx you config file should look like this
```
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
