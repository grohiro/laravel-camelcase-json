# laravel-camelcase-json

Convert response JSON key to camelCase.

## Usage

**In controller class**

```php
return response()->json($model);
// => ['userName' => 'foo', 'userKey' => 'bar', ...]
```

## Requirements

- Laravel 5+

## Install 

```bash
$ composer require 'grohiro/laravel-camelcase-json' '~1.0'
# Laravel 5.7+
$ composer require 'grohiro/laravel-camelcase-json' '~2.0'
```

Add the service provider.

**config/app.php**

```php
'provider' => [
	// default providers
	// ...
	
	Grohiro\LaravelCamelCaseJson\CamelCaseJsonResponseServiceProvider::class,
],
```
