# RSS Reader

### Working with a static address, just now

##### DB & Table Creating
MySQL version 14.14 used. Schema;

    CREATE DATABASE rsstask;
    CREATE TABLE `user` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(128) NOT NULL DEFAULT '',
    `password` varchar(256) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

