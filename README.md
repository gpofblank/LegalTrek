# How to run it?

### First you should have a new DB (in my case: `Invoices`)

### Second install required dependencies:
```
composer install
```

### Third migrate the required migrations:
```
php artisan migrate
```

### Next seed the DB:
```
php artisan db:seed
```

### Finally, lauch your localhost:

```
php artisan serve
```