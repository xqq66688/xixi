<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    $page = I('get.p',1);
    $search=I("get.search");
    
    if ($search=="") {
        $data['list'] = D('goods')
        ->join("brand on brand.b_id = goods.b_id")
        ->join("cart on cart.c_id = goods.c_id")
        ->join("shop on shop.s_id = goods.s_id")->order('g_id')
        ->page($page,3)->select();
        $data['type']=0;
    }
    if ($search=="1") {
        $data['list']=D("goods")->join("brand on goods.b_id = brand.b_id")->page($page,3)->select();
        $data['type']=1;
    }else if($search=="2"){
        $data['list']=D("goods")->join("shop on goods.s_id = shop.s_id")->page($page,3)->select();
        $data['type']=2;
    }else if($saerch=="3"){
        $data['list']=D("goods")->join("cart on goods.c_id = cart.c_id")->page($page,3)->select();
        $data['type']=3;
    }
    $count        = D('goods')->where($where)->count();// 查询满足要求的总记录数
    $Page         = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    $data['page'] = $Page->show();// 分页显示输出
    if(IS_AJAX){
        $this->ajaxReturn($data);
    }

        $data['cart'] = D('cart')->select();
        $data['brand'] = D('brand')->select();
        $data['shop'] =  D('shop')->select();
        $this->assign("data",$data);
        $this->display();
    }
}