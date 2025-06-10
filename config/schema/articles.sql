CREATE TABLE `articles` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `user_id` int NOT NULL,
                            `title` text NOT NULL,
                            `slug` varchar(191) NOT NULL,
                            `body` text,
                            `image` text CHARACTER SET utf8mb4,
                            `published_until` datetime DEFAULT NULL,
                            `created` datetime DEFAULT NULL,
                            `modified` datetime DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `slug` (`slug`),
                            KEY `user_key` (`user_id`),
                            CONSTRAINT `user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
