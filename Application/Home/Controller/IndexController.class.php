<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    /**
     * 阿里大于短信验证码
     */
    public function obtainyzm(){

        $mobile = $_POST['mobile'];//获取手机号码
        $admin =$_POST['admin'];//获取用户名

        $user = M('admin')->where(array('username'=>$admin))->find();

        /************引入*************/
        Vendor('Alidayu.TopClient');
        Vendor('Alidayu.AlibabaAliqinFcSmsNumSendRequest');
        Vendor('Alidayu.ResultSet');
        Vendor('Alidayu.RequestCheckUtil');

        $c = new \Vendor\Alidayu\TopClient;
        $req = new \Vendor\Alidayu\AlibabaAliqinFcSmsNumSendRequest;

        /*************配置***************/
        $code = 5643;//randCode(4);//随机验证码
        $c->appkey = '23******';
        $c->secretKey = '6f73a******************';
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("xx的测试");
        $req->setSmsParam("{code:'$code'}");
        $req->setRecNum("$mobile");
        $req->setSmsTemplateCode("SMS_3******");

        if($user)
        {
            if($user['mobile'] == $mobile)
            {
                /*************发送验证码短信，并把验证码作为新密码保存到服务器上***************/
                //$c->execute($req);  //不要开启，开启后就会有短信到账，一次几分钱..在服务器上看新密码就好
                $newpwd['pwd'] = md5($code);
                D('admin')->where(array('username'=>$user['username']))->save($newpwd);
                $this->ajaxreturn(0);//用户名密码匹配
            }
            else
            {
                $this->ajaxreturn(1);//用户名和手机号不匹配
            }
        }
        else
        {
            $this->ajaxreturn(2); //用户名不存在
        }
      //  $this->display();
    }//获取验证码
}