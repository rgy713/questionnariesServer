-requirment
apache2, PHP7.2~, Mysql 5.7~
-Database installing
1. create database name "db_rasp"
2. import file "db_rasp.sql"
-PHP Source code install
1. unzip file questionnariesServer.zip to path /var/www/html/questionnariesServer
2. chmod -R 777 /var/www/html/questionnariesServer
3. edit file /etc/apache2/sites-available/laravel.conf

<VirtualHost *:80>   
  ServerAdmin admin@example.com
     DocumentRoot /var/www/html/questionnariesServer/public
     ServerName example.com

     <Directory /var/www/html/questionnariesServer/public>
        Options +FollowSymlinks
        AllowOverride All
        Require all granted
     </Directory>

     ErrorLog ${APACHE_LOG_DIR}/error.log
     CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

4. fix file "questionnariesServer/.env"
DB_DATABASE=db_rasp
DB_USERNAME=root
DB_PASSWORD=your password

5.create admin user
cd /var/www/html/questionnariesServer
php artisan tinker
$admin = new App\Admin();
$admin->email = 'your email address';
$admin->password = Hash::make('your password');
$admin->save();

url of your site
user page 
your domain or ip/
admin page
your domain or ip/admin/



