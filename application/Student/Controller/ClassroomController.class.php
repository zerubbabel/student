<?php
namespace Student\Controller;

use Common\Controller\AdminbaseController;

class ClassroomController extends AdminbaseController{

	//列表
	public function index(){		
		$classrooms = M("classrooms")->select();
		$this->assign("classrooms",$classrooms);
		$this->display();
	}

	// 班级添加
	public function add(){			
		$this->display();
	}

	// 班级添加提交
	public function add_post(){
		if(IS_POST){
			if(!empty($_POST['name'])){
				$data=array('name'=>$_POST['name']);
				$result=M("classrooms")->add($data);
				if($result){
					$this->success("添加成功！", U("classroom/index"));
				}
				else {
					$this->error("添加失败！");
				}
				
			}else{
				$this->error("请输入姓名！");
			}

		}
	}

	// 班级编辑
	public function edit(){
	    $id = I('get.id',0,'intval');
		$classroom=M("classrooms")->where(array("id"=>$id))->find();
		$this->assign('classroom',$classroom);
		$this->display();
	}

	// 班级编辑提交
	public function edit_post(){
		if (IS_POST) {
			if(!empty($_POST['name']) ){
				$classroom = M("classrooms");
				$id = I("request.id",0,'intval');
	            $data=array('name' => $_POST['name']);
	            $result=$classroom->where(array("id" => $id))->save($data);
				if ($result) {
					$this->success("保存成功！");
				} else {
					$this->error("保存失败！");
				}
				
			}else{
				$this->error("请输入姓名！");
			}

		}
	}


}