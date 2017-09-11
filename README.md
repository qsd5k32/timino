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
composer create-project timino/timino projectName

```
- Manually:
- Clone from github via SSH or HTTPS

``` 
SSH  : git clone git@github.com:lotfio-lakehal/timino.git
HTTPS : git clone https://github.com/lotfio-lakehal/timino.git

```
- Or download it directly from github as a compressed file

 Configuration :
 ================

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

Usage :
=======
### 1-  configuration :
* all configuration files are inside the config folder Database, Mailer, Routes, and Regular Expressions :
* Configure your database credentials 
* configure your mailer credentials 

### 2- Create your first controller :
* make sure it starts with a capital letter

```
<?php

namespace App\Controllers;

use App\Core\Controller;

class Test extends Controller
{
    public function manage()
    {
      // echo "this is the default action you can change it from the routes.conf file but make sure you change the default method on the base controller App\Core\Controller to the same name";
    }
}

```

### 3- load views :
* Create a folder inside the views folder which should be named exactly as the controller name so lets create a Test folder inside views folder
* make sure it starts with a capital letter 

````
public function manage()
  {
    $this->load->view("view folder", array("viewPageOne", "viewPageTo","and so one you can also use comma separated string instead of array"), "pageTitle");
  }
    
````


### 4- load model data and pass it to the view :
* create a model inside the models folder 
* make sure it starts with a capital letter 



````
<?php

namespace App\Models;

use App\Core\Model;

class Test extends Model
{
    public function testModelData()
    {
      return array(
                    "name" => "lotfio"
                     "age" => "24years"
                    );
    }
}
````

* On your controller method load it like that :

````
  public function manage()
  {
     $data["user"] = $this->load->model("test")->testModelData();
        
     $this->load->view("view folder",[pages], "title", $data);
  }
  
````

### 5- use data inside the view :
* In your Test view folder ``Views/Test`` create your Manage.php file this is the file that matches you default method name manage method and of course each view will take the name of the method.
* Data passed to the view is stored in ``$modelData`` variable which is casted to object type so ``$modelData`` to show your data and deal with it like an object

````
// Manage.php page inside Views\Test

<?php
 var_dump($modelData); // here you will get an object of data returned from the model
 
````

# Dealing with Database : 
* Timino helps you to query the database in a very simple an efficient way using the active record pattern service:

### 1-  Insert :
* insert data into the database 

### 2-  Select :
### 3-  Update :
### 4-  Delete :
