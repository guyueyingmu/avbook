<p align="center"><img src="https://github.com/guyueyingmu/avbook/blob/master/public/avbook/logo.png?raw=true"></p>

<p align="center">

<img src="https://travis-ci.org/laravel/framework.svg"> 
<img src="https://img.shields.io/packagist/php-v/symfony/symfony.svg"> 
<img src="https://img.shields.io/badge/mysql-%3E%3D5.7-brightgreen.svg"> 
<img src="https://img.shields.io/apm/l/vim-mode.svg">

</p>

## 关于 AVBook

AVBook 是基于 Laravel 开发的 Web 应用程序，通过 Artisan 控制台实现`avmoo`,``javbus``,`javlibrary`的爬虫采集数据入库mysql，前端页面模仿``javbus``，并添加一些类似`javlibrary`的功能。该系统相当于以上三个网站的结合体，能够使你更加方便地管理你的影片。

## 预览

**（<font color=red>FBI WARNING</font>：不要在公共场所打开以下图片）**

<a  target="_blank"   href ="https://raw.githubusercontent.com/guyueyingmu/avbook/master/public/avbook/scrshot_index.png" >🔞 首页截图</a>

<a  target="_blank"   href ="https://raw.githubusercontent.com/guyueyingmu/avbook/master/public/avbook/scrshot_movie.png" >🔞 详情页截图</a>


## Get Started

    git clone https://github.com/guyueyingmu/avbook.git

    cd avbook;cp .env.example .env #复制 .env.example 为 .env 并设置数据库信息

    composer install

    php artisan migrate

    #替换  avbook/config/urlconfig.php  文件中的域名为最新域名 #从被墙域名获取：avmoo.com ;javbus.com;javlib.com

    php artisan avbook:avmoo  #启动avmoo爬虫

    php artisan avbook:javbus --movie=1 --page=10 --magpage=10 #启动javbus爬虫

    php artisan scandir --path='/moviefiles' #扫描指定目录 /moviefiles 中的文件，正则匹配番号，设置为已拥有状态

    php artisan avbook:javlib --genre --movie  #javlibrary 爬虫

以上操作适用于Linux环境

## For windows 用户

这里提供一份开箱即用的压缩包 [avbook_laragon.7z](https://pan.baidu.com/s/1JCfISyckxy9qNtYjo5RH-w)

链接：<https://pan.baidu.com/s/1JCfISyckxy9qNtYjo5RH-w> 
提取码：xug8 

压缩包中包含更新到2019.5.12的全部数据


#### 使用方法:

   >1.解压到 D:\laragon <br>
    2.打开 D:\laragon\laragon.exe ,点击 `启动所有`<br>
    3.点击 `网站` 或者访问 <http://avbook.test>  enjoy it
    
   >ps:<br>
     Ⅰ. 如果没有解压到 D:\laragon 需自行修改Nginx配置，php.ini配置，并在hosts文件新增一行 ：`127.0.0.1      avbook.test` <br>
     Ⅱ. laragon终端启动爬虫前先 `git pull ` 更新到最新版本。

## 其他注意事项

avmoo 有反爬虫机制，目前的反反爬虫方法是修改 User-Agent ，用的人多了应该会失效，建议下载[avbook_laragon.7z](https://pan.baidu.com/s/1JCfISyckxy9qNtYjo5RH-w)导入数据库，进行增量更新。

windows 下 mysql 性能有限，需耐心等待，建议将数据库导入 [homestead](https://github.com/laravel/homestead) 使用。

在带宽够用的情况下 `php artisan avbook:avmoo --max=500` 将并发设置为500可在1小时内采集完 avmoo 全站30余万条电影信息，并发过大时建议使用 [SMProxy](https://github.com/louislivi/smproxy) 加一层连接池提高速度。

必须等 avmoo 采集完成，才能启动 javbus 爬虫。

~~最后，北京第三区交通委提醒您：道路千万条，安全第一条。飙车一时爽，一直飙一直爽。。。~~

2019.7.19 up，不好意思，你来晚了，爬虫已失效[#issues/60](https://github.com/guyueyingmu/avbook/issues/60)，车暂时开不动了，重新发车时间待定，关注公众号：guyueyingmu （孤月盈木）接收通知。

## License

The AVBook is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

gyym.avbook.bt.01