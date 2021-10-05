##  Laravel Booksto Step by Step by LocDo
1. Clone or download file.
2. Import database "dbbookstore.sql" to MySQL from database folder
3. Run cmd: 
   - coppy .env.example to .env
   - npm install 
   - composer install 
   - php artisan key:generate
   - php artisan serve --host=booksto.tk
   - php artisan websockets:serve 
   - php artisan queue:work or php artisan schedule:work

4. URL admin : "admin/auth/login".

*Note: To use the Caching feature, you must have Redis installed on your computer.