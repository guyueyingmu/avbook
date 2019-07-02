<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
class Bttool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bttool';

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


/*
        $encoder = new \PHP\BitTorrent\Encoder();
        $decoder = new \PHP\BitTorrent\Decoder($encoder);

//        $decodedFile = $decoder->decodeFile('resources/t2.torrent');
        $torrent = \PHP\BitTorrent\Torrent::createFromTorrentFile('resources/t2.torrent');
        var_dump($torrent->getFileList());
die;*/
//        $data = Bencode::load('resources/t2.torrent');
//        var_dump(json_encode($data,true));

        $bcoder = new \Bhutanio\BEncode\BEncode;
//        $bcoder->set([
//            'announce'=>'http://www.private-tracker.com',
//            'comment'=>'Downloaded from Private Tracker',
//            'created_by'=>'PrivateTracker v1.0'
//        ]);

        // decode Torrent file
//        var_dump(file_get_contents('resources/t2.torrent')[0]);die;
        $torrent = $bcoder->bdecode( file_get_contents('resources/t2.torrent'));
//        var_dump(array_keys($torrent['info']));
//        die;
//        print_r($torrent['info']['files']);
        $Files = $torrent['info']['files'];
        function create_ed2k($fname, $fsize, $fhash){
            $ed2k_out = 'ed2k://|file|' . $fname . '|' . $fsize . '|' . $fhash . '|/';
            return $ed2k_out;
        }
        function create_magnet($dn, $xl = false, $btih = '', $sha1 = '', $ed2k = '', $tree_tiger = '', $md5 = '')
        {
            $magnet = 'magnet:?';
            if ($dn){
                $magnet .= 'dn=' . $dn; // download name
            }
            if ($xl){
                $magnet .= '&xl=' . $xl; // size
            }
            if ($btih){
                $magnet .= '&xt=urn:btih:' . $btih; // bittorrent info_hash (Base32)
            }
            if ($sha1){
                $magnet .= '&xt=urn:sha1:' . $sha1; // gnutella sha1 (base32)
            }
            if ($ed2k){
                $magnet .= '&xt=urn:ed2k:' . $ed2k; // emule hash (Hex)
            }
            if ($tree_tiger){
                $magnet .= '&xt=urn:tree:tiger:' . $tree_tiger; // tiger (Base32)
            }
            if ($sha1 && $tree_tiger) {
                $magnet .= '&xt=urn:bitprint:' . $sha1 . '.' . $tree_tiger; // Gnutella 2 (Shareaza) bitprint (Base32)
            }
            if ($md5){
                $magnet .= '&xt=urn:md5:' . $md5; // md5 hash (Hex)
            }
            return $magnet;
        }




        //var_dump($Files);//
        foreach($Files as $File) {

            if(isset( $File['ed2k'])){


//                $hex = bin2hex($File['ed2k'] );//二进制转成16进制
                $f = $File;
                $f["filehash"] =isset($f["filehash"]) ? bin2hex($f["filehash"]) : '';
                $f["ed2k"] =bin2hex($f["ed2k"]);
                var_dump($f);
                $sha1  ='';//isset($f["filehash"]) ? strtoupper(base32_encode($f["filehash"]))  : ''; //isset($f["sha1"]) ? strtoupper(base32_encode($f["sha1"])) : '';
                $ed2k  = $f["ed2k"];
                $tiger = isset($f["tiger"]) ? strtoupper(base32_encode($f["tiger"])) : '';
                $md5   = isset($f["md5sum"]) ? bin2hex($f["md5sum"]) : '';
                //hashes is set?
                $ext_hashes = (isset($f["ed2k"]) || isset($f["sha1"]) || isset($f["tiger"]) || isset($f["md5sum"]));
                if ($ext_hashes && isset($f["length"]))
                {
                    if (isset($f["ed2k"]))
                    {
                        echo create_ed2k(max($f['path']), $f["length"],  $f["ed2k"] ) ."\n";
                    }
                    else
                    {

                    }
                   // echo @create_magnet(max($f['path']), $f["length"], '', $sha1, $ed2k, $tiger, $md5)."\n\n";

                }
/*
                $s = create_ed2k(max($f['path']), $f["length"], bin2hex($f["ed2k"]));
                var_dump($s);
                die;

                var_dump($hex);//die;
                var_dump(chr(hexdec($hex)));
                $string='';
                for ($i=0; $i < strlen($hex)-1; $i+=2){
                    $string .= chr(hexdec($hex[$i].$hex[$i+1]));
                }
               // $string = iconv("GBK","utf-8", $string);

                var_dump($string);die;
//                $s =iconv('UTF-8//TRANSLIT', 'utf-8//TRANSLIT', $File['ed2k']);


//                $encode = mb_detect_encoding($File['ed2k']);
                $encode = mb_detect_encoding($File['ed2k'],array("ASCII","GB2312","GBK",'BIG5','UTF-8'));
var_dump($encode);

var_dump($File['ed2k']);

                $s =iconv( $encode,'UTF-8//IGNORE', $File['ed2k']);;
//                $s =  utf8_encode( $File['ed2k']) ;
                var_dump($s);
                die;*/
            }


        }

        // show Torrent contents
        $files = $bcoder->filelist( $torrent );
//        print_r($files);
die;
        //
//
//        $bcoder = new \Bhutanio\BEncode\BEncode();
//        $bcoder->set([
//            'announce'=>'http://www.private-tracker.com',
//            'comment'=>'Downloaded from Private Tracker',
//            'created_by'=>'PrivateTracker v1.0'
//        ]);
//
//        // decode Torrent file
//        $torrent = $bcoder->bdecode('resources/t2.torrent' );
//        print_r($torrent);
//
        $encoder = new \PHP\BitTorrent\Encoder();
        $decoder = new \PHP\BitTorrent\Decoder($encoder);

        $decodedFile = $decoder->decodeFile('resources/t2.torrent');

//        $decodedFile->
//        $decodedFile = json_decode(json_encode($decodedFile));
//        var_dump($decodedFile);
//        foreach ($decodedFile as $item) {
//            var_dump(json_encode($item));
//        }
        die;
    }
}


class xBEncoder {

    const READY = 0;
    const READ_STR = 1;
    const READ_DICT = 2;
    const READ_LIST = 3;
    const READ_INT = 4;
    const READ_KEY = 5;

    public $y;
    protected $z, $m, $n;
    protected $stat;
    protected $stack;


    /**
     * This method saves the status of current
     * encode/decode work.
     */
    protected function push($newY, $newStat) {
        array_push($this->stack, array($this->y, $this->z, $this->m, $this->n, $this->stat));
        list($this->y, $this->z, $this->m, $this->n, $this->stat) = array($newY, 0, 0, 0, $newStat);
    }


    /**
     * This method restore the saved status of current
     * encode/decode work.
     */
    protected function pop() {
        $t = array_pop($this->stack);
        if ($t) {
            if ($t[4] == self::READ_DICT) {
                $t[0]->{$t[1]} = $this->y;
                $t[1] = 0;
            } elseif ($t[4] == self::READ_LIST)
                $t[0][] = $this->y;
            list($this->y, $this->z, $this->m, $this->n, $this->stat) = $t;
        }
    }


    /**
     * This method initializes the status of work.
     * YOU SHOULD CALL THIS METHOD BEFORE EVERYTHING.
     */
    public function init() {
        $this->stat = self::READY;
        $this->stack = array();
        $this->z = $this->m = $this->n = 0;
    }

    /**
     * This method decode $s($l as length).
     * You can get $obj->y as the result.
     */
    public function decode($s, $l) {
        $this->y = 0;
        for ($i = 0; $i < $l; ++$i) {
            switch ($this->stat) {
                case self::READY:
                    if ($s[$i] == 'd') {
                        $this->y = new xBDict();
                        $this->stat = self::READ_DICT;
                    } elseif ($s[$i] == 'l') {
                        $this->y = array();
                        $this->stat = self::READ_LIST;
                    }
                    break;
                case self::READ_INT:
                    if ($s[$i] == 'e') {
                        $this->y->val = substr($s, $this->m, $i - $this->m);
                        $this->pop();
                    }
                    break;
                case self::READ_STR:
                    if (xBInt::isNum($s[$i]))
                        continue;
                    if ($s[$i] = ':') {
                        $this->z = substr($s, $this->m, $i - $this->m);
                        $this->y = substr($s, $i + 1, $this->z + 0);
                        $i += $this->z;
                        $this->pop();
                    }
                    break;
                case self::READ_KEY:
                    if (xBInt::isNum($s[$i]))
                        continue;
                    if ($s[$i] = ':') {
                        $this->n = substr($s, $this->m, $i - $this->m);
                        $this->z = substr($s, $i + 1, $this->n + 0);
                        $i += $this->n;
                        $this->stat = self::READ_DICT;
                    }
                    break;
                case self::READ_DICT:
                    if ($s[$i] == 'e') {
                        $this->pop();
                        break;
                    } elseif (!$this->z) {
                        $this->m = $i;
                        $this->stat = self::READ_KEY;
                        break;
                    }
                case self::READ_LIST:
                    switch ($s[$i]) {
                        case 'e':
                            $this->pop();
                            break;
                        case 'd':
                            $this->push(new xBDict(), self::READ_DICT);
                            break;
                        case 'i':
                            $this->push(new xBInt(), self::READ_INT);
                            $this->m = $i + 1;
                            break;
                        case 'l':
                            $this->push(array(), self::READ_LIST);
                            break;
                        default:
                            if (xBInt::isNum($s[$i])) {
                                $this->push('', self::READ_STR);
                                $this->m = $i;
                            }
                    }
                    break;
            }
        }
        $rtn = empty($this->stack);
        $this->init();
        return $rtn;
    }

    /**
     * This method encode $obj->y into BEncode.
     */
    public function encode() {
        return $this->_encDo($this->y);
    }

    protected function _encStr($str) {
        return strlen($str).':'.$str;
    }

    protected function _encDo($o) {
        if (is_string($o))
            return $this->_encStr($o);
        if ($o instanceof xBInt)
            return 'i'.$o->val.'e';
        if ($o instanceof xBDict) {
            $r = 'd';
            foreach ($o as $k => $c)
                $r .= $this->_encStr($k).$this->_encDo($c);
            return $r.'e';
        }
        if (is_array($o)) {
            $r = 'l';
            foreach ($o as $c)
                $r .= $this->_encDo($c);
            return $r.'e';
        }
    }
}


class xBDict {}

class xBInt {
    public $val;

    public function __construct($val = 0) {
        $this->val = $val;
    }

    public static function isNum($chr) {
        $chr = ord($chr);
        if ($chr <= 57 && $chr >= 48)
            return true;
        return false;
    }
}