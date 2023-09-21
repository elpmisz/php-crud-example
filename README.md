# CRUD Example

# Install
git clone https://github.com/elpmisz/php-crud-example \
cd php-crud-example \
composer update 

# Create Database
CREATE TABLE `crud` ( \
  `id` int(11) NOT NULL, \
  `name` varchar(100) NOT NULL, \
  `email` varchar(100) NOT NULL, \
  `created` DATETIME DEFAULT CURRENT_TIMESTAMP \
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 

ALTER TABLE `crud` \
  ADD PRIMARY KEY (`id`), \
  ADD UNIQUE KEY `email` (`email`); 

ALTER TABLE `crud` \
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; 

INSERT INTO  \
  `crud` (`id`, `name`, `email`)  \
VALUES \
  (1, 'admin', 'admin@test.com'), \
  (2, 'user', 'user@test.com'); 

# Edit classes/Database.php
DB_USER \
DB_PASSWORD

# Run 
php -S localhost:3000
