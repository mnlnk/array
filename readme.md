## Array Helper 0.3


##### Требования:
+ `PHP >= 5.6`


##### Установка:
```
composer require mnlnk/array
```


##### Примеры:

```php
require __DIR__.'/vendor/autoload.php';

use Manuylenko\ArrayHelper\Arr;

$arr = [
    //
];
```

```php
Arr::set($arr, 'key', 'value1');

Arr::set($arr, 'key2.key3', 'value3');
```

```php
$value = Arr::get($arr, 'key'))

$value = Arr::get($arr, 'key.key2'))

$value = Arr::get($arr, 'key', 'fallback'))
```

```php
Arr::has($arr, 'key')
```

```php
Arr::remove($arr, 'key')
```

```php
Arr::wrap($arr, 'value')
```
