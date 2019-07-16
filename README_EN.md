<p align="center"><img src="https://github.com/guyueyingmu/avbook/blob/master/public/avbook/logo.png?raw=true"></p>

<p align="center">

<img src="https://travis-ci.org/laravel/framework.svg"> 
<img src="https://img.shields.io/packagist/php-v/symfony/symfony.svg"> 
<img src="https://img.shields.io/badge/mysql-%3E%3D5.7-brightgreen.svg"> 
<img src="https://img.shields.io/apm/l/vim-mode.svg">

</p>

## About AVBook

AVBook is a web application based on `Larvel`. It use `Artisan` Console to browses data from `avmoo`,``javbus``,`javlibrary` to `mysql`.
The front-end development is recreated from `javbus` with some features like `javlibrary`.
AVBook is basically a combination of those 3 websites which makes you management with your Adult Video more convenient.  

## Screen Shot

**（<font color=red>WARNING</font>：Not Safe For Work!）**

<a  target="_blank"   href ="https://raw.githubusercontent.com/guyueyingmu/avbook/master/public/avbook/scrshot_index.png" >🔞 Homepage</a>

<a  target="_blank"   href ="https://raw.githubusercontent.com/guyueyingmu/avbook/master/public/avbook/scrshot_movie.png" >🔞 Detail Page</a>


## Get Started

### For Linux

```bash
git clone https://github.com/guyueyingmu/avbook.git

cd avbook;cp .env.example .env #Copy .env.example to .env and set database information

composer install

php artisan migrate

#Replace domain address in avbook/config/urlconfig.php  to latest # Get from GFW：avmoo.com ;javbus.com;javlib.com

php artisan avbook:avmoo  # Start avmoo web crawler

php artisan avbook:javbus --movie=1 --page=10 --magpage=10 # Start javbus web crawler

php artisan scandir --path='/moviefiles' #Browse files in moviefiles. Match AV Number and set to `owned` status.

php artisan avbook:javlib --genre --movie  #start javlibrary web crawler
```

### For windows

Here is a Ready-to-use Archive [avbook_laragon.7z](https://pan.baidu.com/s/1LPeGNNy-3MEDC0g9EbusLg).

[Download Link](https://pan.baidu.com/s/1LPeGNNy-3MEDC0g9EbusLg) Extract Code: gmmg

Archive contains all up-to-date data until 5/12/2019 


#### Usage:

```bash
# 1. Decompress to `Laragon`
# 2. Excute `Laragon\laragon.exe` and Click `启动所有`
# 3. Click `网站` or Visit [http://avbook.test](http://avbook.test)
# 4. Enjoy.

# PS

# 1. You need to change Nginx Configure for the file path. And add a new line in hosts file: `127.0.0.1 avbook.test`
# 2. `git pull` to latest before running the web crawler of laragon.
```

## Notice

`avmoo` has anti-crawling mechanism. Currently, Anti-Anti-Crawling method is to modify `User-Agent` but it will not work 
if too many people use it. We recommend to download [avbook_laragon.7z](https://pan.baidu.com/s/1LPeGNNy-3MEDC0g9EbusLg) to 
to load database and update with increment data.

`mysql` has limited performance in `Windows`. Please be patient. We recommend to load database [homestead](https://github.com/laravel/homestead).

If you have enough bandwidth, `php artisan avbook:avmoo --max=500` will set Concurrency to 500. It can collect almost 300K movies in `avmoo` within 1 hour.
We recommend to add a layer of connection pool [SMProxy](https://github.com/louislivi/smproxy) to speed up when you face a very large mount of concurrency.

Please start `javbus` crawler after `avmoo` crawler complete.

Finally, being dynamite in the sack carefully.

## License

The AVBook is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
