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
```

2. Run docker

```bash
docker compose up
```

3. Setup the database
* Create listings table

<img width="416" height="336" alt="image" src="https://github.com/user-attachments/assets/45b89651-c08c-4d39-a060-ceb84c88fce3" />

* Create users table

<img width="416" height="185" alt="image" src="https://github.com/user-attachments/assets/ddc4ac71-1790-4398-a965-1950e83d1791" />
  
* Make foreign key for user_id on listings table(on update, delete: CASCADE)
* Optional: add dummy data

Default db credentials are:

```php
return [
    'host' => 'db',
    'port' => 3306,
    'dbname' => 'workopia',
    'username' => 'workopia_user',
    'password' => 'workopia_pass'
];
```


5. Open in browser

```
http://localhost:8080
```

## 🤝 Credits

[Brad Traversy](https://www.udemy.com/user/brad-traversy/) for the course


You can find the course [here](https://www.udemy.com/course/php-from-scratch-course/)
