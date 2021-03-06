zf2master
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.

Installation
------------

Using Composer (recommended)
----------------------------
Clone the repository and manually invoke `composer` using the shipped `composer.phar`:
    cd /var/www/html
    git clone https://github.com/willianmano/zf2master.git
    cd zf2master
    php composer.phar self-update
    php composer.phar install

Virtual Host
------------
    <VirtualHost *:80>
        ServerName zf2master.dev
        DocumentRoot /var/www/html/zf2master/public
        SetEnv APPLICATION_ENV "development"
        SetEnv PROJECT_ROOT "/var/www/html/zf2master" 
        <Directory /var/www/html/zf2master/public>
                DirectoryIndex index.php
                AllowOverride All
                Order allow,deny
                Allow from all
            </Directory>
    </VirtualHost>