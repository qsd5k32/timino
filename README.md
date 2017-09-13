# Timino PHP S.O.L.I.D MVC framework 
![logo](http://www.simpleimageresizer.com/_uploads/photos/9f3d6cd8/logo_60.png)
# Note : This is version 1.0.0 alpha
![Licence](https://img.shields.io/badge/Licence-MIT-orange.svg)
![PHP7](https://img.shields.io/badge/php-7-blue.svg)
![version Alpha](https://img.shields.io/badge/Alpha-V1.0.0-yellow.svg)
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
  * If you are using nginx you config file should look like this
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

Usage :
=======
### 1-  configuration :
* all configuration files are inside the config folder Database, Mailer, Routes, and Regular Expressions :
* Configure your database credentials 
* configure your mailer credentials 

### 2- Create your first controller :
* Create Controller file ``Test.php`` inside Controllers Folder and create a class Test.
* Make sure it starts with a capital letter both class and file (stadlycaps)

```php
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
* make sure it starts with a capital letter (and the class name is stadlyCaps)
* `view()` method loads an array or coma separated string of views from the `Views/yourviewFolder` and automaticaly  loads the header and the footer from the `Views/_tmp` folder. Besides you can load views dynamically in every call just by puting them inside `_tmp` folder exactly like the header ond the footer and make sure to call them on the view :


````php
public function manage()
  {
    $this->load->view("views folder", array("viewPageOne", "viewPageTo"), "pageTitle");
  }
````
* You can also load a naked view without header and footer like this :
```php
public function manage()
{
  $this->load->nakedView("views folder", array("viewPageOne", "viewPageTo"));
  // here you can pass your title to the view alongside with the data like this $data['title'] = "my title";
}
```

### 4- load model data and pass it to the view :
* create a model inside the models folder 
* make sure it starts with a capital letter (and the class name is stadlyCaps)


````php
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

````php
  public function manage()
  {
     $data["user"] = $this->load->model("test")->testModelData();
        
     $this->load->view("view folder",[pages], "title", $data);
  }
````

### 5- use data inside the view :
* In your Test view folder ``Views/Test`` create your Manage.php file this is the file that matches you default method name manage method and of course each view will take the name of the method.
* Data passed to the view is stored in ``$modelData`` variable which is casted to object type so debug the variable and see the result :

````php
// Manage.php page inside Views\Test

<?php
 var_dump($modelData); // here you will get an object of data returned from the model

````

# Dealing with Database : 
* Timino helps you to query the database in a very simple an efficient way using the active record pattern service:

### 1-  Insert :
* insert data into the database 
```php
<?php
namespace App\Models;

use App\Core\Model;

class Test extends Model
{
    public function insertNewUser()
    {
      $do = $this->record->insert->into("users", array(
          "Name"   => "lotfio",
          "Email"  => "lotfio@gmail.com",
          "Passwd" => SHA1('mypass')
      ));
      
      var_dump($do); // bool true | false
     }
}
```

### 2-  Select :
* Select data from database 
```php
<?php
namespace App\Models;

use App\Core\Model;

class Test extends Model
{
    public function selectFromUsers()
    {
      $do = $this->record->select->from("users", "selection array or coma separated string", array("Name | = " => "lotfio"), "LIMIT 1");
      
      var_dump($do); // mixed object | false
      
      /* conditions can be passed as an array
       WHERE  array("
        
        "Name   |  = "  => "name  | and",
        "Email  | != "  => "hh@kk | or",
        "and so on"       
          
      "); */
     }
}
```
### 3-  Update :
* Update data into database 
```php
<?php
namespace App\Models;

use App\Core\Model;

class Test extends Model
{
    public function updateUser()
    {
       $this->record->update->set("users", array( // values
          "Name" => "John"
      ), array( // conditions
          
          "Email   | = " => "bilal@gmail.com | and",
          "Passwd  | != " => SHA1("123")
       ));
       
     }
}
```
### 4-  Delete :
* Delete data from database 
```php
<?php
namespace App\Models;

use App\Core\Model;

class Test extends Model
{
    public function DeleteUser()
    {
         echo $this->record->delete->from("users",array( // conditions
            "Email | != " => "lotfio@gmail.com | and",
            "Name  |  = " => "timino"
          ));

     }
}
```
