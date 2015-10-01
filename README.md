Yii2 Config Variables
=====================

A Yii2 Module to handle application configuration via database. Allows to modify 
variables content without tedious production deployments. 

The Module includes the controller and views with the basic CRUD operations to 
include in your backend application, allowing you to modify the values of the 
configuration params directly in the production environment.

## Introduction

Configuration variables are used in the application in order to store application 
configuration parameters. The motivation of this package is to avoid the use of 
of ``` Yii::$app->params ``` array because every time you want to change the 
value of some of these params, you must do it writting the params.php file and 
doing a production deployment. 

With this plugin, you would be allowed to modify the configuration params of your 
application in your backend area without production deployments.

## Installation

To install, either run

```bash
$ php composer.phar require jlorente/yii2-config-variables "*"
```

or add

```json
    "require": {
        "jlorente/yii2-config-variables": "*"
    }
```

to the ```require``` section of your `composer.json` file and run the following 
commands from your project directory.
```bash
$ composer update
$ ./yii migrate --migrationPath=@vendor/jlorente/yii2-config-variables/src/migrations
```
The last command will create the table needed to handle the config variables.

*IMPORTANT!:* If you downloaded the prerelease (<1.0.0) you should run the migration 
again.

## Usage

#### Creating Variables

Configuration variables are used as part of the code to check its values at 
runtime, so should exist in order to be used and that is why they can't be 
created in the backend application directly but in a migration. In order to 
create a variable in a migration write:

```php
class mXXXXXX_XXXXXX_a_simple_configuration_variable_creation extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $v = new Variable([
            'code' => 'CODE-OF-MY-CONFIGURATION-VARIABLE',
            'name' => 'A simply boolean configuration variable',
            'type' => Variable::TYPE_BOOLEAN,
            'value' => true
        ]);
        if ($v->save() === false) {
            throw new Exception('Unable to save the configuration variable');
        }
    }
}
```

Configuration variables available types are TYPE_INT, TYPE_FLOAT, TYPE_STRING, 
TYPE_BOOLEAN and TYPE_OBJECT. 

TYPE_OBJECT is an special type that should be declared as a php associative 
array and its value checked as and stdObject class. An example of TYPE_OBJECT 
creation could be:

```php
class mXXXXXX_XXXXXX_a_type_object_variable_creation extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $v = new Variable([
            'code' => 'CODE-OF-MY-TYPE_OBJECT-VARIABLE',
            'name' => 'Posts Ranking weights',
            'type' => Variable::TYPE_OBJECT,
            'value' => [
                'postsNumber' => 40,
                'postsValoration' => 40,
                'commentsNumber' => 20
            ]
        ]);
        if ($v->save() === false) {
            throw new Exception('Unable to save the configuration variable');
        }
    }
}
```

#### Listing, viewing and updating Variables values.

The extension comes along with a module to be set in your backend area in order 
to have the basic user interface operations for the Variable model. This module 
provides the actions to list all the variables of the application and to modify 
its values. 

To load this module you must include it in your backend application.

./your-app/config/main.php
```php
    // ... other configurations ...
    "modules" => [
        // ... other modules ...
        "config" => [
            "class" => "jlorente\config\Module"
        ]
    ]
```

In this example I have used "config" as moduleId and will use this name for the 
rest of the examples, but you can use whatever name you want.

The route to the controller actions are:
* config/variable/index 
* config/variable/view?id=X
* config/variable/update?id=X

Maybe you would want to include a link to the *config/variable/index* route in 
your backend navbar to make it accessible.

The module comes with english and spanish translations. If you want to include 
your own translations, you can do this by providing the "messageConfig" property 
in the module configuration:

./your-app/config/main.php
```php
    // ... other configurations ...
    "modules" => [
        // ... other modules ...
        "config" => [
            "class" => "jlorente\config\Module",
            "messageConfig" => [
                "basePath" => "PATH-TO-MY-TRANSLATION",
            ]
        ]
    ]
```

Remember that all the module translations are stored in the file jlorente/config.php

You can also use your own layout for the module views by setting the path in the 
layout property in the module configuration:

./your-app/config/main.php
```php
    // ... other configurations ...
    "modules" => [
        // ... other modules ...
        "config" => [
            "class" => "jlorente\config\Module",
            "layout" => "PATH-TO-MY-LAYOUT"
        ]
    ]
```

#### Using the Variables in the code

The Variable model is the one that should be used to check the values of your 
configuration params. In order to do that use the static method value.

```php
    $value = Variable::value('CODE-OF-MY-CONFIGURATION-VARIABLE');
```

The returned value will be of the type of the variable.

Variables of TYPE_OBJECT type will return an instance of a stdObject class. 
Following the previous example, if I want to check the values of my 
'CODE-OF-MY-TYPE_OBJECT-VARIABLE' variable I should do.

```php
    $value = Variable::value('CODE-OF-MY-TYPE_OBJECT-VARIABLE');
    echo $value->postsNumber;
    echo $value->postsValoration;
    echo $value->commentsNumber;
```

## Further considerations

Remember to bootstrap the Module if you want to extend the VariableController 
and preserve the provided translations. If you don't do it, the Module and the 
translation configuration will never be loaded. 

If that is your case include:

./your-app/config/main.php
```php
    // ... other configurations ...
    "bootstrap" => [
        // ... other module ids ...
        , "config"
    ],
```

## License 
Copyright &copy; 2015 José Lorente Martín <jose.lorente.martin@gmail.com>.

Licensed under the MIT license. See LICENSE.txt for details.
