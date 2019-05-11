<p align="center"><img src="https://github.com/guyueyingmu/avbook/blob/master/public/avbook/logo.png?raw=true"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 关于 AVBook

AVBook 是基于Laravel开发的Web应用程序，通过Artisan 控制台实现 avmoo 、javbus 的爬虫采集数据入库mysql，前端页面模仿javbus，并添加一些类似javlibrary的功能。该系统相当于以上三个网站的结合体，能够使你更加方便地管理你的影片

<a  target="_blank"   href ="https://raw.githubusercontent.com/guyueyingmu/avbook/master/public/avbook/scrshot_index.png" >首页截图</a>

<a  target="_blank"   href ="https://raw.githubusercontent.com/guyueyingmu/avbook/master/public/avbook/scrshot_movie.png" >详情页截图</a>

## 开发环境

php7.1+  
mysql 5.7+

## Get Started

---

git clone https://github.com/guyueyingmu/avbook.git

cd avbook;cp .env.example .env #复制 .env.example 为 .env 并设置数据库信息

composer install

php artisan migrate

替换 avbook\app\inc\urlconfig.php 文件中的域名为最新域名 

php artisan avbook:avmoo  #启动avmoo爬虫

php artisan avbook:javbus --movie=1 --page=10 --magpage=10 #启动javbus爬虫

---

以上操作适用于Linux环境

## For windows 用户

这里提供一份开箱即用的压缩包 [avbook_laragon.7z](https://pan.baidu.com/s/1LPeGNNy-3MEDC0g9EbusLg)

链接：<https://pan.baidu.com/s/1LPeGNNy-3MEDC0g9EbusLg> 
提取码：gmmg 

压缩包中包含更新到2019.5.12的全部数据

####使用方法:
   1.解压到 D:\laragon 

   2.打开 D:\laragon\laragon.exe ,点击 “启动所有”
    
   3.访问 <http://127.0.0.1> 或者 <http://avbook.test>  enjoy it
   
   ps:如果没有解压到 D:\laragon 需自行修改Nginx配置，并在hosts文件新增一行 ：127.0.0.1      avbook.test

## 其他注意事项

avmoo有反爬虫机制，目前的反反爬虫方法是修改 User-Agent ，用的人多了应该会失效，建议下载[avbook_laragon.7z](https://pan.baidu.com/s/1LPeGNNy-3MEDC0g9EbusLg)导入数据库，进行增量更新。

在带宽够用的情况下 php artisan avbook:avmoo --max=500 将并发设置为500可在1小时内采集完avmoo全站30余万条电影信息

必须等avmoo采集完成，才能启动javbus爬虫

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
