<?php
namespace Student\Controller;

use Common\Controller\AdminbaseController;

class SemesterController extends AdminbaseController{

	//列表
	public function index(){		
		$semesters = M("semesters")->order('start desc')->select();
		$this->assign("semesters",$semesters);
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
				$data=array('name'=>$_POST['name'],'start'=>$_POST['start']);
				$result=M("semesters")->add($data);
				
				if($result){
					$this->success($result+"添加成功！", U("semester/index"));
				}
				else {
					$this->error("添加失败！");
				}
				
			}else{
				$this->error("请输入名称！");
			}

		}
	}

	// 班级编辑
	public function edit(){
	    $id = I('get.id',0,'intval');
		$semester=M("semesters")->where(array("id"=>$id))->find();
		$this->assign('semester',$semester);
		$this->display();
	}

	// 班级编辑提交
	public function edit_post(){
		if (IS_POST) {
			if(!empty($_POST['name']) ){
				$semester = M("semesters");
				$id = I("request.id",0,'intval');
	            $data=array('name' => $_POST['name']);
	            $result=$semester->where(array("id" => $id))->save($data);
				if ($result) {
					$this->success("保存成功！");
				} else {
					$this->error("保存失败！");
				}
				
			}else{
				$this->error("请输入名称！");
			}

		}
	}

	// 班级管理
	public function manage(){			
		$id = I('get.id',0,'intval');
		$semester=M("semesters")->where(array("id"=>$id))->find();
		$this->assign('semester',$semester);

		//classroom
		$classrooms = M("classrooms")->select();
		$this->assign("classrooms",$classrooms);

		$this->display();
	}

}