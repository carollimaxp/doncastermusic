<?php

class AddplaceController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    
        // Load Navigation
        $currentPath = rtrim($this->getRequest()->getPathInfo(), '/');

        $nav = new Model_Navigation();
        $nav->buildNavigationArray($currentPath);
        
        $this->view->nav = $nav->navItems;
        $this->view->headMeta()->appendName('description','The only system your business needs.');
        
        // if(!isset($_GET['keycode']) || $_GET['keycode'] != 'shabang'){
        //   header("Location:/places/");
        // }
                
        $newPlace = $this->getRequest()->getPost();
        if(isset($newPlace['place_name'])){
           unset($newPlace['submit']);
           foreach($newPlace as $key=>$val){
            $newPlace[$key] = mysql_real_escape_string($val);
           }
    	     $places = new Model_DbTable_Places();
           $result = $places->addPlace($newPlace);
           $this->view->result = $result;
        }
        

    }

    public function indexAction() {

    }
}

