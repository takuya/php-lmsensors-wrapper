# php-lmsensors-wrapper
lm-sensors cpu temperature to json 

command result 
```text
acpitz-acpi-0
Adapter: ACPI interface
temp1:        +33.0°C  (crit = +100.0°C)

coretemp-isa-0000
Adapter: ISA adapter
Package id 0:  +34.0°C  (high = +105.0°C, crit = +105.0°C)
Core 0:        +33.0°C  (high = +105.0°C, crit = +105.0°C)
Core 2:        +34.0°C  (high = +105.0°C, crit = +105.0°C)
```
this package will convert result to json 
```json
[
    {
        "Name": "acpitz-acpi-0",
        "Adapter": " ACPI interface",
        "Temperature": {
            "temp1": "+33.0°C  (crit = +100.0°C)"
        }
    },
    {
        "Name": "coretemp-isa-0000",
        "Adapter": " ISA adapter",
        "Temperature": {
            "Package id 0": "+34.0°C  (high = +105.0°C, crit = +105.0°C)",
            "Core 0": "+33.0°C  (high = +105.0°C, crit = +105.0°C)",
            "Core 2": "+34.0°C  (high = +105.0°C, crit = +105.0°C)"
        }
    }
]
```

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



