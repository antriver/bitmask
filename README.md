# BitMask 

[![Build Status](https://img.shields.io/travis/pavlunya/Bitmask.svg?style=flat-square)](https://travis-ci.org/pavlunya/Bitmask)
[![Code Coverage](https://img.shields.io/codecov/c/github/pavlunya/Bitmask.svg?style=flat-square)](https://codecov.io/gh/pavlunya/Bitmask)
[![Packagist](https://img.shields.io/packagist/v/abibidu/bitmask.svg?style=flat-square)](https://packagist.org/packages/abibidu/bitmask)
[![MIT License](https://img.shields.io/github/license/pavlunya/Bitmask.svg?style=flat-square)](https://github.com/pavlunya/Bitmask/blob/master/LICENSE.md)


## Installation

Add the following dependency to your composer.json file.

```json
{
    "require": {
        "abibidu/bitmask": "^1.0"
    }
}
```

## Example usage

For example we have User class that can have different roles.

```php
use Abibidu\Bit\Mask;

class User
{
    const ROLE_ADMIN = Mask::FLAG_1;
    const ROLE_MANGER = Mask::FLAG_2;
    const ROLE_CUSTOMER = Mask::FLAG_3;

    /**
     * @var Mask
     */
    private $roles;
    
    public function __construct()
    {
        $this->roles = new Mask();
    }
    
    public function becomeAdmin()
    {
        $this->roles->add(self::ROLE_ADMIN);
    }
    
    public function isAdmin()
    {
        return $this->roles->has(self::ROLE_ADMIN);
    }
    
    ...
    
    public function isCustomer()
    {
        return $this->roles->has(self::ROLE_CUSTOMER);
    }
    
    ...
}
```

Now we are able to create a user.

```php
$user = new User();

$user->becomeAdmin(); // User now has admin role
$user->becomeAdmin(); // Throws MaskException because role has been already set
                      // and mask is in strict mode

$user->isAdmin(); // Returns true
$user->isCustomer(); // Returns false
```