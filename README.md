# php-lmsensors-wrapper
lm-sensors cpu temperature to json 


## Install
via packagist
```
composre require takuya/php-lmsensors-wrapper
```
via git
```
repo=git@github.com:takuya/php-lmsensors-wrapper.git
composer config repositories.takuya/php-lmsensors-wrapper vcs $repo
composer require takuya/php-lmsensors-wrapper
```
## Example 01
```php
$obj = new Sensors();
$obj->execute('ssh 192.168.1.1 -- sensors');
$json = $obj->toJson();
```
## Example 02
```php
$obj = new Sensors();
$ret = `ssh 192.168.1.1 -- sensors`
$obj->setResult($ret);
$json = $obj->toJson();
```

## requirements
```
sudo apt install lm-sensors
```



