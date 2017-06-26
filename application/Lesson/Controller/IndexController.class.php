<?php
/**
 * 后台首页
 */
namespace Lesson\Controller;

use Common\Controller\AdminbaseController;

class IndexController extends AdminbaseController {
	
    public function index() {
        $problems=array(1,2);
        		
        $this->assign('problems',$problems);
       	$this->display();	
    }
    
    public function ans_post(){
		if(IS_POST){
			$user=$id=sp_get_current_admin_id();#I('request.user');
			$p_id=I('request.p_id');
			$ans=I('request.'+$p_id+'_ans');
			$data=array('user'=>$user,'p_id'=>$p_id,'ans'=>$ans);
			$r=M('exam_result')->add($data);
			if($r){
				$this->success("添加成功！");
			}else{
				$this->error("失败！");
			}
		}
	}

}

