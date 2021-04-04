## Setup Laravel

Pakai GitHub Dekstop agar mudah melakukan clone,push dan pull
Link github dekstop (https://desktop.github.com/).

- Langkah pertama setelah melakukan clone
Lakukan perintah composer update di directory tempat kalian cloning repo nya
``` 
composer update 
```
- Langkah kedua adalah copy paste file env.example dan merubah nya menjadi env saja (jadinya kita punya 2 file yaitu .env dan .env.example), kemudian buat key dengan perintah php artisan key:generate
```
.env
php artisan key:generate
```
- Langkah ketiga adalah lakukan konfigurasi database
