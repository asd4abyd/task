## This is a task

it should done before 2017/01/29 12:00:00

Requirements
============

* PHP >= 5.5


Installation
============

download project 

    git clone git@github.com:asd4abyd/task.git
    
for download composer packages you have to use terminal
        
        composer install

You have to change some attribute in config/app.php
    [] url = set url you are using
     
You have to change some attribute in config/database.php
    [] mysql[database] = database name
    [] mysql[username] = database username
    [] mysql[password] = database password
    
    
to install database you have to use terminal

    php artisan migrate
    php artisan db:seed

or you can use db.sql file to setup db


you gave to point apache server to public server or you can use artisan for make server

    php artisan serv
     

Usage
=====

The admin access info is:
username: admin@mytask.local
password: 123456


Credits
=======

* Abdelqader osama al dweik https://github.com/asd4abyd/task

