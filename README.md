# Fabrica de SMS SDK integration

* [About](#about)
* [Usage](#usage)

<a name="about"></a>
## About:

This is a simple SDK to consume the [Fabrica de SMS](fabricadesms.com.br) API.

<a name="usage"></a>
## Usage:

```
{
    require: {
        "ericmaicon/fabricadesms": "v1.0.1"
    }
}
```

### Your config array

```php
array(
    'login' => 'USERNAME',
    'password' => 'PASSWORD',
);
```

### Send a SMS

```php
require_once ('vendor/autoload.php');

$config = array(
  'login' => 'USERNAME',
  'password' => 'PASSWORD',
);

$sms = new fabricadesms\Sms($config);
$sms->sendSms(6281818181, 'message here');
```

### Send Multiple SMS

```php
require_once ('vendor/autoload.php');

$config = array(
  'login' => 'USERNAME',
  'password' => 'PASSWORD',
);

$sms = new fabricadesms\Sms($config);
$sms->sendMultipleSms(array(
    6281818181,
    6281818182
    ), 'message here');
```

### Schedule a SMS

```php
require_once ('vendor/autoload.php');

$config = array(
  'login' => 'USERNAME',
  'password' => 'PASSWORD',
);

$sms = new fabricadesms\Sms($config);
$sms->sendMultipleSms(6281818181, 'message here', '24/12/2015', '16:00');
```

### Get Balance

```php
require_once ('vendor/autoload.php');

$config = array(
  'login' => 'USERNAME',
  'password' => 'PASSWORD',
);

$sms = new fabricadesms\Sms($config);
$sms->getBalance();
```