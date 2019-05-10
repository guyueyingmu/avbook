<p align="center"><img src="https://github.com/guyueyingmu/avbook/blob/master/public/avbook/logo.png?raw=true"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 关于 AVBook

AVBook 是基于Laravel开发的Web应用程序，通过Artisan 控制台实现 avmoo 、javbus 的爬虫采集数据入库mysql，前端页面模仿javbus，并添加一些类似javlibrary的功能。该系统相当于以上三个网站的结合体，能够使你更加方便地管理你的影片

## 开发环境

php7.1+  
mysql 5.7+

## Get Started

git clone https://github.com/guyueyingmu/avbook.git

复制 .env.example 为 .env 并设置数据库信息

composer install

php artisan migrate

替换 avbook\app\inc\urlconfig.php 文件中的域名为最新域名 

php artisan avbook:avmoo  #启动avmoo爬虫

php artisan avbook:javbus --movie=1 --page=10 --magpage=10 #启动javbus爬虫


## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
