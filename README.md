# Fabrica de SMS SDK integration

* [About](#about)
* [Usage](#usage)

<a name="about"></a>
## About:

This is a SDK to consume the

<a name="usage"></a>
## Usage:

```
{
    require: {
        "ericmaicon/fabricadesms": "1.0.0"
    }
}
```

### Your config file

```php
return array(
    'login' => 'USERNAME',
    'password' => 'PASSWORD',
);
```

### Send a SMS

```php
require_once ('vendor/autoload.php');

$config = require_once('conf/config.php');

$sms = new fabricadesms\Sms($config);
$sms->sendSms(6281818181, 'message here');
```

### Send Multiple SMS

### Schedule a SMS

### Get Balance