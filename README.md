# Impersonation

This package is aimed for role-based Laravel site, enabling user to impersonate as another user.

## Usage

This package will register a route of `/impersonation`, which list all of the users.

After impersonating as an user, you have to logout then login again in order to getting back to your accout.

Since this package uses `Auth::loginUsingId()`, when impersonating, the user getting impersonated will be shown on the debugbar.

## Installation

Add following lines to your `composer.json`:

```json
    "repositories": [
        {
          "type": "vcs",
          "url": "https://gitlab.it.cs.nycu.edu.tw/nycu-csit/laravel-impersonation"
        }
    ],
    "require": {
        "nycu-csit/laravel-impersonation": "^1.0.0"
    }
```

## Configuration

```shell
php artisan vendor:publish --tag=impersonation
```

Available options:

- `enabled`: Whether to enable this package or not.
- `impersonable_roles`: Array of role names that can impersonate as other users.
- `post_impersonation_route`: The path to redirect to after impersonation.
- `display_columns`: Array of columns getting displayed. Leave empty for showing all columns.
- `policy`: The policy class to decide which user can impersonate others.

## Test

```shell
./vendor/bin/phpunit
```

## Customize Policy

Create file `app/Policies/ImpersonationPolicy.php`, the policy should implement `NycuCsit\Impersonation\Policies\ImpersonationPolicyInterface`.
Here is an example of letting those users who has the role of `admin` could impersonate as other users.

```php
<?php

namespace App\Policies;

use App\User;
use NycuCsit\Impersonation\Interfaces\ImpersonationPolicyInterface;

/**
 * @implements ImpersonationPolicyInterface<User>
 */
class ImpersonationPolicy implements ImpersonationPolicyInterface
{
    public function impersonate($user): bool
    {
        $roles = $user->roles()->pluck('name');
        return $roles->contains(
            fn ($role) => in_array($role, ['admin'])
        );
    }
}
```

For more examples, you can see [workbench/app/Policies/CustomImpersonationPolicy.php](./workbench/app/Policies/CustomImpersonationPolicy.php).
