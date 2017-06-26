<?php
/**
 * 后台首页
 */
namespace Student\Controller;

use Common\Controller\AdminbaseController;

class ManageController extends AdminbaseController {
	

    public function index() {
        echo 'index';
       	//$this->display();	
    }
    public function chuqin() {
        
       	$this->display();	
    }

}

