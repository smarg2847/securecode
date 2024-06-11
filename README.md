# securecode

## Overview

A Laravel package to generate secure codes with different validation rules and of upto nth characters long.

## Installation


### Requirements

The package has been developed to work with the following minimum requirements:

- PHP 8.x
- Laravel 10.x

### Install the Package

Put the following in root composer.json file

```php
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/smarg2847/securecode"
        }
    ],
```

Then install the package via Composer:

```bash
composer require smarg2847/securecode
```

### Publish the Config and Migrations

You can then publish the package's config file and database migrations by using the following command:
```bash
php artisan vendor:publish --provider="Smarg2847\SecureCode\Providers\SecureCodeProvider"
```
Or if you are working with sail
```bash
./vendor/bin/sail php artisan vendor:publish --provider="Smarg2847\SecureCode\Providers\SecureCodeProvider"
```

### Migrate the Database

With the vendor:publish in the previous step, a migration is alsp published to the root code base. You need to run the migration to create the database table `secure_code`:
```bash
php artisan migrate
```
Or if you are working with sail
```bash
./vendor/bin/sail php artisan migrate
```

## Implementation

### List Secure Codes available in Database

Patch to use to get the list of available codes.
```php
use Smarg2847\SecureCode\Services\SecureCodeOperations;

$manager = new SecureCodeOperations();
$secureCodes = $manager->getSecureCodes();
dump($secureCodes); /// this dump is used to view the data only. You should go with the standard flow and use the list appropriately.
```

### Generating Secure Codes / Store generated secure codes

The code generator can handle both, random/automated code generation and manually provided codes The quickest way to get started with generating a secure code is by using the snippet below.
```php
use Smarg2847\SecureCode\Services\SecureCodeGenerator;

$secureCode = $request->secureCode;
$customCode = true;

if (!$request->secureCode) {
  $generate = new SecureCodeGenerator();
  $secureCode = $generate->generate();
  $customCode = false;
}

$manager->saveCode($secureCode : $generate->generate(), $customCode); /// 2nd param is important as validations will be performed to the code passed in 1st param is customCode.

echo "Secure code: $secureCode";
```

### Assigning a Secure Code to a record

To assign a secure code to a primary record in any module, use the following patch method:

```php
use Smarg2847\SecureCode\Services\SecureCodeOperations;

$manager = new SecureCodeOperations();
$manager->assignSecureCode($secureCode,$moduleRecord);

echo "Assigned secure code is: $secureCode";
```

### Resetting a Secure Code

To reset a secure code and releasing it for further use, use the following patch:

```php
use Smarg2847\SecureCode\Services\SecureCodeOperations;

$manager = new SecureCodeOperations();
$manager->resetCode($secureCode);

echo "Secure code has been reset: $secureCode";
```

### Destroying a Secure Code

To permanently destroy a code, you can use the destroyCode method:

```php
use Smarg2847\SecureCode\Services\SecureCodeOperations;

$manager = new SecureCodeOperations();
$manager->destroyCode($request->secureCode);

echo "Secure code has been removed: $secureCode";
```
### Validation

This package comes with a set of validation rules
1. Secure code is not a Palindrome.
2. Secure code should consist of `n` unique characters, where `n` is configurable.
3. Secure code should not contain `n` characters in forward or reverse sequences, where `n` is configurable.
