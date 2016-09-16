# BitMask 

[![Build Status](https://travis-ci.org/pavlunya/Bitmask.svg?branch=master)](https://travis-ci.org/pavlunya/Bitmask)

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
    
    public functions isAdmin()
    {
        return $this->roles->has(self::ROLE_ADMIN);
    }
    
    ...
    
    pulic function isCustomer()
    {
        eturn $this->roles->has(self::ROLE_CUSTOMER);
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