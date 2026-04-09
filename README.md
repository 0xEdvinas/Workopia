# 💼 Workopia

This repo contains code for the project I built while taking a [course](https://github.com/0xEdvinas/Udemy-PHP) on PHP and backend development.

<img width="1000" height="476" alt="image" src="https://github.com/user-attachments/assets/e5dca9b9-9654-4119-9c00-210cffb5107a" />

## ℹ️ About

Workopia is a simple job listing site written in vanilla PHP that has the following features:

* Authentication
* CRUD operations
  * Add listing
  * Remove listing
  * Edit listing
* MySQL integration

## 🏗️ Requirements

* Docker
* Docker Compose

## 🏃‍♂️ Running

1. Git clone

```bash
git clone https://github.com/0xEdvinas/Workopia.git
cd Workopia
```

2. Run docker

```bash
docker compose up
```

3. Setup the database
* Create listings table

```SQL
CREATE TABLE `workopia`.`listings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NULL,
  `salary` VARCHAR(45) NULL,
  `tags` VARCHAR(255) NULL,
  `company` VARCHAR(45) NULL,
  `address` VARCHAR(255) NULL,
  `city` VARCHAR(45) NULL,
  `state` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `requirements` LONGTEXT NULL,
  `benefits` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
```

* Create users table

```SQL
CREATE TABLE `workopia`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `city` VARCHAR(45) NULL,
  `state` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
```

* Make foreign key for user_id on listings table(on update, delete: CASCADE)

```SQL
ALTER TABLE `workopia`.`listings`
ADD CONSTRAINT `fk_user_id`
FOREIGN KEY (`user_id`) REFERENCES `workopia`.`users`(`id`)
ON DELETE CASCADE
ON UPDATE CASCADE;
```

* Optional: add dummy data

Default db credentials are:

```
Host: localhost
Port: 3306
```

```php
return [
    'host' => 'db',
    'port' => 3306,
    'dbname' => 'workopia',
    'username' => 'workopia_user',
    'password' => 'workopia_pass'
];
```


4. Open in browser

```
http://localhost:8080
```

5. Stop containers

```bash
docker compose down
```

## 🤝 Credits

[Brad Traversy](https://www.udemy.com/user/brad-traversy/) for the course


You can find the course [here](https://www.udemy.com/course/php-from-scratch-course/)
