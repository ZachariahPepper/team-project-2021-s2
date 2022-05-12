
#!/bin/bash
#make sure you have largon on, and are serving in a terminal

cp .example.env .env
php artisan dusk:chrome-driver
php artisan dusk