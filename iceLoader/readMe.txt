1) use debian 8 x64 or ubuntu 14.0.1 .etc. have not tried this with CENT OS yet, make sure u got your lamp installed (php,mysql,apache2)
2) go to /portal/application/config.php and change the 1c3key with the one you compiled with and base_url with your site's name
3) go to /portal/application/database.php change username,password
4) go to your mysql-server and make a new database name it portal and use portal.sql to populate it
5) upload portal folder to your /var/www/html folder
6) ur good to go if u got any questions let me know ;)

use visual studio 2013 to compile