# Keep track of user activity with laravel

## Intruction

Download Recordable.php to you app, app/Traits/Recordable.php or anywhere where it can be loaded with composer.

Create a model with Resources and migration

```
php artisan make:model Activity -mr

```
Modify activities table

```
Schema::create('activities', function (Blueprint $table) {
  $table->increments('id');
  $table->string('type');
  $table->unsignedInteger('user_id');
  $table->unsignedInteger('subject_id');
  $table->string('subject_type');
  $table->timestamps();
  });
  
```

Running Migrations

```
php artisan migrate

```

Use Trait in your Model

```
<?php

namespace App;


use App\Traits\Recordable;
use Illuminate\Database\Eloquent\Model;


class Email extends Model
{
    use Recordable;

```
