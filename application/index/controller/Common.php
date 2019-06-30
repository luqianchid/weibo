<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2019/1/15
 * Time: 17:42
 */
namespace app\index\controller;
use think\Controller;
use \think\template\driver\File;
use think\Db;
use app\index\model\User;
use think\Session;
class Common extends Controller
{
    // 生成公告区，左侧导航 静态页面
    protected function buildHtml($htmlfile = '', $htmlpath = '', $templateFile = '')
    {
        $content = $this->fetch($templateFile);
        $htmlpath = !empty($htmlpath) ? $htmlpath : './appTemplate/';
        $htmlfile = $htmlpath . $htmlfile . '.'.config('url_html_suffix');
        $File = new File();
        $File->write($htmlfile, $content);
        return $content;
    }
    public function rightbar(){//公告榜
        
        $infolist = db('info')->order('create_time desc')->limit(5)->select();//公告 
        $this->assign('infolist',$infolist);        
        $id="rightbar";        
        $this->buildHtml($id,APP_PATH.'index/view/common/',APP_PATH.'index/view/common/right2.html');
    }
    public function leftnav(){
        $catelist = db('unit')->select();
        $this->assign('catelist',$catelist);
        $id = 'leftbar';
        $this->buildHtml($id,APP_PATH.'index/view/common/',APP_PATH.'index/view/common/left.html');
    }


}



//$this->buildHtml($id,APP_PATH.'app/view/content/',APP_PATH.'app/tpl/activity.html');
