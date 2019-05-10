<?php
return [
    'title' => 'Avbook',
    'cen_per_page' => 30,
    'filter' =>[
        'hd=1'=>'已有高清',
        'sub=1'=>'有字幕',
        'owned=1'=>'已拥有',
        'owned=0'=>'排除已拥有',
        'favorite=1'=>'收藏的',
        'watched=1'=>'看过的',
        'wanted=1'=>'想要的',

        'gc[]=4m'=>'主观视角',
        'notgc[]=4m'=>'排除主观视角',
        'gc[]=7x'=>'VR',
        'notgc[]=7x'=>'排除VR',
        'gc[]=8'=>'眼镜',
        'gc[]=1g'=>'第一人稱攝影',
        'notSeries=_'=>'系列',
        'orderby=release_date'=>'按日期排序',
        'orderby=code_10'=>'按id排序',
        ]
];