<?php
namespace Student\Controller;

use Common\Controller\AdminbaseController;

class StudentController extends AdminbaseController{

	//列表
	public function index(){
		//$where = array("user_type"=>1);
		/**搜索条件**/
		/*$user_login = I('request.user_login');
		$user_email = trim(I('request.user_email'));
		if($user_login){
			$where['user_login'] = array('like',"%$user_login%");
		}
		
		if($user_email){
			$where['user_email'] = array('like',"%$user_email%");;
		}
		

		$count=$this->students_model->where($where)->count();
		$page = $this->page($count, 20);
        $users = $this->students_model
            ->where($where)
            ->order("create_time DESC")
            ->limit($page->firstRow, $page->listRows)
            ->select();
		$roles_src=$this->role_model->select();
		$roles=array();
		foreach ($roles_src as $r){
			$roleid=$r['id'];
			$roles["$roleid"]=$r;
		}
		$this->assign("page", $page->show('Admin'));
		$this->assign("roles",$roles);
		$this->assign("users",$users);*/
		$students = M("students")->select();
		$this->assign("students",$students);
		$this->display();
	}

	// 学生添加
	public function add(){			
		$this->display();
	}

	// 学生添加提交
	public function add_post(){
		if(IS_POST){
			if(!empty($_POST['user_name'])){
				$data=array('name'=>$_POST['user_name']);
				$result=M("students")->add($data);
				if($result){
					$this->success("添加成功！", U("student/index"));
				}
				else {
					$this->error("添加失败！");
				}
				
			}else{
				$this->error("请输入姓名！");
			}

		}
	}

	// 学生编辑
	public function edit(){
	    $id = I('get.id',0,'intval');
		$student=M("students")->where(array("id"=>$id))->find();
		$this->assign('student',$student);
		$this->display();
	}

	// 学生编辑提交
	public function edit_post(){
		if (IS_POST) {
			if(!empty($_POST['student_name']) ){
				$student = M("students");
				$id = I("request.id",0,'intval');
	            $data=array('name' => $_POST['student_name']);
	            $result=$student->where(array("id" => $id))->save($data);
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

	// 学生删除
	public function delete(){
	    $id = I('get.id',0,'intval');
		if($id==1){
			$this->error("最高学生不能删除！");
		}

		if ($this->students_model->delete($id)!==false) {
			M("RoleUser")->where(array("user_id"=>$id))->delete();
			$this->success("删除成功！");
		} else {
			$this->error("删除失败！");
		}
	}

	// 学生个人信息修改
	public function userinfo(){
		$id=sp_get_current_admin_id();
		$user=$this->students_model->where(array("id"=>$id))->find();
		$this->assign($user);
		$this->display();
	}

	// 学生个人信息修改提交
	public function userinfo_post(){
		if (IS_POST) {
			$_POST['id']=sp_get_current_admin_id();
			$create_result=$this->students_model
			->field("id,user_nicename,sex,birthday,user_url,signature")
			->create();
			if ($create_result!==false) {
				if ($this->students_model->save()!==false) {
					$this->success("保存成功！");
				} else {
					$this->error("保存失败！");
				}
			} else {
				$this->error($this->students_model->getError());
			}
		}
	}

	// 停用学生
    public function ban(){
        $id = I('get.id',0,'intval');
    	if (!empty($id)) {
    		$result = $this->students_model->where(array("id"=>$id,"user_type"=>1))->setField('user_status','0');
    		if ($result!==false) {
    			$this->success("学生停用成功！", U("user/index"));
    		} else {
    			$this->error('学生停用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }

    // 启用学生
    public function cancelban(){
    	$id = I('get.id',0,'intval');
    	if (!empty($id)) {
    		$result = $this->students_model->where(array("id"=>$id,"user_type"=>1))->setField('user_status','1');
    		if ($result!==false) {
    			$this->success("学生启用成功！", U("user/index"));
    		} else {
    			$this->error('学生启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }



}