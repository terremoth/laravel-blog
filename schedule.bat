:loop
php artisan schedule:run 1>> NUL 2>&1
timeout 1 > NUL
goto loop
