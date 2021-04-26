# luby-challenge

<img src='lub_react/src/assets/logo.png'>

<h2>Requirements</h2>

<h3>Tools</h3>
<p align="center">
  <img src="https://img.shields.io/badge/react%20-%2320232a.svg?&style=for-the-badge&logo=react&logoColor=%2361DAFB" height="25"/>
  <img src="https://img.shields.io/badge/mysql-%23316192.svg?&style=for-the-badge&logo=mysql&logoColor=white" height="25"/>
  <img src="https://img.shields.io/badge/docker-%23316192.svg?&style=for-the-badge&logo=docker&logoColor=white" height="25"/>
  <img src="https://img.shields.io/badge/php%20-%23777BB4.svg?&style=for-the-badge&logo=php&logoColor=white" height="25"/>
<img src="https://img.shields.io/badge/laravel%20-%23FF2D20.svg?&style=for-the-badge&logo=laravel&logoColor=white" height="25"/>
</p>
<ul>
  <li>Node ^14</li>
  <li>YARN or NPM</li>
  <li>docker-composer ^1.28</li>
  <li>composer ^1.10</li>
</ul>

**BACK-END**

```cd ./lub-challenge/```
<br><br>
```composer install```
<br>

After You'll need to config file **.env** you only rename **.env.example** to **.env**
Check if the same name of docker-compose.yml of image mysql stay in your **.env** 
 
<h3>Run</h3>

```docker-compose up -d```
<br><br>
```php artisan migrate```
<br><br>
```php artisan db:seed```
<br><br>
```php -S localhost:8000 -t public```

You can use file **Insomnia 2021-04-25.json** import to your Insomnia. 

**FRONT-END**

```cd ./lub_react/```
<br><br>
```yarn``` or ```npm install```
<br><br>
```yarn start``` or ```npm start```