Yii2 Config Variables (In development)
======================================

A Yii2 Module to handle application configuration via database. Allows to modify 
variables content without tedious production deployments. 

The Module includes the controller and views with the basic CRUD operations to 
include in your backend application, allowing you to modify the values of the 
configuration params directly in the production environment.

## Installation

To install, either run

```bash
$ php composer.phar require jlorente/yii2-config-variables "*"
```

or add

```json
...
    "require": {
        // ... other configurations ...
        "jlorente/yii2-config-variables": "*"
    }
```

to the ```require``` section of your `composer.json` file and run the following 
commands from your project directory.
```bash
$ composer update
$ ./yii migrate --migrationPath=@app/vendor/jlorente/yii2-config-variables/src/migrations
```
The last command will create the table needed to handle the config variables.

## License 
Copyright &copy; 2015 José Lorente Martín <jose.lorente.martin@gmail.com>.

Licensed under the MIT license. See LICENSE.txt for details.