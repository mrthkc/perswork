# RSS Reader

### Working with a static address, just now
Need following open source softwares before starting;
* Nginx 1.17.0
* PHP 7.1.30
* MySQL 14.14
> For a fast setup Homwbrew could be an option.

##### Database & Table Creating
MySQL version 14.14 used. Schema;

    CREATE DATABASE rsstask;
    CREATE TABLE `user` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(128) NOT NULL DEFAULT '',
    `password` varchar(256) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

##### Configure Your Database
Please check project's database configuration file and do necessary changes;
File: perswork/rss/application/config/database.php

    'hostname' => 'localhost',
	'username' => <your-username>,
	'password' => <your-password>,
	'database' => 'rsstask',
	'dbdriver' => 'mysqli',

##### Virtual Environment Configuration
You can change your virtual environment address from file: perswork/rss/application/config/config.php
In this sample "http://rsstask.test" is used.

    $config['base_url'] = 'http://rsstask.test';

As web server software, Nginx version 1.17.0 is used.
Please add following file in folder etc/nginx/servers/ (if you installed nginx via homebrew: /usr/local/etc/nginx/servers)

    file: rsstask.conf

    server {
            listen       80;
            listen       [::]:80;
            server_name rsstask.test;
            root <project-path>/perswork/rss/;
            index index.html index.php;

            location / {
                    try_files $uri $uri/ /index.php;
            }

            location ~ \.php$ {
                    fastcgi_pass 127.0.0.1:9000;
                    fastcgi_index index.php;
                    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                    include fastcgi_params;
            }
        
        error_page  404     /404.html;
            error_page  403     /403.html;
    }

> Please restart your Nginx web server.
    brew services restart nginx

##### Conclusion
> Please navigate to "http://rsstask.test" with your favorite browser and welcome!

