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

Then add following lines to `config/app.php`:

```php
    'providers' => [
        // ...
        NycuCsit\Impersonation\ImpersonationServiceProvider::class
    ],
```

## Configuration

```shell
php artisan vendor:publish --tag=impersonation
```

Available options:

- `enabled`: Whether to enable this package or not.
- `post_impersonation_route`: The path to redirect to after impersonation.
- `display_columns`: Array of columns getting displayed. Leave empty for showing all columns.

## Test

```shell
./vendor/bin/phpunit
```

## Customization

To customize the behaviour of the controller, you have to

1. Write a controller that extends the controller from this package. (see: [workbench/app/Http/Controllers/CustomImpersonationController.php](./workbench/app/Http/Controllers/CustomImpersonationController.php))
2. Write a service provider that extends the service provider from this package and bind the controller to your version. (see: [workbench/app/Providers/CustomImpersonationServiceProvider.php](./workbench/app/Providers/CustomImpersonationServiceProvider.php))
3. Register your version of service provider to `config/app.php`.
