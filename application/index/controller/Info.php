<?php

namespace app\index\controller;
use think\Controller;
use app\index\model\Info as I;
class Info extends Controller
{
    public function index(){        
        $infoid = input('infoid');
        $info = db('info')->where('infoid','=',$infoid)->select();
        $infolist = db('info')->order('create_time desc')->limit(5)->select();
        return view('info/info',[
            'info'=>$info,
            'infolist'=>$infolist
        ]);
    }

}
