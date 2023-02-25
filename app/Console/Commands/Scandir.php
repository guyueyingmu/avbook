<?php

namespace App\Console\Commands;

use App\Console\Tools\MedooEx;
use Illuminate\Console\Command;
use TheSeer\DirectoryScanner\DirectoryScanner;

class Scandir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scandir {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $database = new  MedooEx([
            'database_type' => 'mysql',
            'database_name' => env('DB_DATABASE', 'avbook'),
            'server' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
        ]);
        $path = str_replace(['"', "'"], '', $this->option('path'));
        $this->info($path);
        $tmp = new DirectoryScanner();
        $files = $tmp->getFiles($path);
        $fileskey = [];
        foreach ($files as $file) {
            $value = trim($file->getPathname());
            if (strrpos($value, 'torrent') === false && strrpos($value, '.mht') === false && strrpos($value, '.png') === false && strrpos($value, '.gif') === false && strrpos($value, '.jpg') === false) {
                $fileskey[$value] = 1;
            }
        }
        $fileskey = array_keys($fileskey);
        $arr_movieid = [];
        foreach ($fileskey as  $value) {
            echo $value ,"\n";
            preg_match_all('/([a-zA-Z]{2,6})[-|_|\s]{0,3}([0-9]{3,4})(.*?)/', $value, $out);
            foreach ($out[1] as $key => $value) {
                $arr_movieid[strtoupper($out[1][$key]).'-'.$out[2][$key]] = 1; //."({$out[0][$key]})"
            }
        }
        $arr_movieid = array_keys($arr_movieid);
        if (! empty($arr_movieid)) {
            $t = implode("','", $arr_movieid);
            $ssql = "update avbook_avmoo_movie set have_file = 3,have_mg=1,owned=1 where censored_id in ('{$t}') ";
            var_dump($ssql);
            $database->query($ssql);
            $this->info('id数量：'.count($arr_movieid));
        } else {
            $this->warn('无匹配的id');
        }
    }
}
