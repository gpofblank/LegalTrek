# How to run it?

### First, you should have a new DB (in my case: `Invoices`)

### Second, migrate the required migrations:
```
php artisan migrate
```

### Next, seed the DB:
```
php artisan db:seed
```

### Finally, lauch your localhost:

```
php artisan serve
```