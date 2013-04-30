<?php

class AddvenueController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    
        // Load Navigation
        $currentPath = rtrim($this->getRequest()->getPathInfo(), '/');

        $nav = new Model_Navigation();
        $nav->buildNavigationArray($currentPath);
        
        $this->view->nav = $nav->navItems;
        $this->view->headMeta()->appendName('description','The only system your business needs.');
        
        // if(!isset($_GET['keycode']) || $_GET['keycode'] != 'shabang'){
        //   header("Location:/venues/");
        // }    
                
        $newVenue = $this->getRequest()->getPost();
        if(isset($newVenue['venue_name'])){
           unset($newVenue['submit']);
           foreach($newVenue as $key=>$val){
            $newVenue[$key] = mysql_real_escape_string($val);
           }
    	     $venues = new Model_DbTable_Venues();
           $result = $venues->addVenue($newVenue);
           $this->view->result = $result;
        }
        

    }

    public function indexAction() {

    }
}

