# Tuition Attendance
A Laravel project to manage student's attendance.  

## Features
- Login page for Admin and Teacher.
- Admin able to create/remove classes for teachers.
- Admin able to register student and assign to classes.
- Teacher able to take attendance for assigned classes.
- Teacher able to check attendance for assigned classes.

## How to Use
Modify the **.env** file according to your database connected. 

![](https://i.imgur.com/KIKWTRD.png)

Execute **cmd** in the folder and run the following commands.

```console
php artisan migrate
```
```console
php artisan db:seed --class=UsersSeeder
```

The webiste are ready to used now. Run the following command.

```console
php artisan serve
```

Go to **http://127.0.0.1:8000/admin-home** and you should see it. (address depends on your database host) 

![](https://i.imgur.com/lxyAmk7.png)

## Default Login Details
The default login details are as below:

>Username: admin  
>Password: admin

You should edit **UsersSeeder.php** if you were to change the details.




