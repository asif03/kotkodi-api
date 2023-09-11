# kotkodi-api

cd existing_repo
git remote add origin https://gitlab.com/dare2code.official/kotkodi-api.git
git branch -M main
git push -uf origin main

# laravel Command
php artisan migrate:fresh --seed
php artisan migrate --path=/database/migrations/2021_12_28_025646_create_order_items_table.php

sudo composer dump-autoload
php artisan make:request AddUserDeliveryAddressRequest
php artisan db:seed --class=UserDeliveryAddressSeeder

# Swagger
php artisan l5-swagger:generate
