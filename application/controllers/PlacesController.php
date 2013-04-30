<?php

class PlacesController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */

        // Load Navigation
        $currentPath = rtrim($this->getRequest()->getPathInfo(), '/');

        $nav = new Model_Navigation();
        $nav->buildNavigationArray($currentPath);

        $this->view->nav = $nav->navItems;
        $this->view->headMeta()->appendName('description','GigHub Places listings');
        
        
        $places = new Model_DbTable_Places();
        $placeInfo = $places->getPlaces();
        $this->view->places = $placeInfo;
  

    }

    public function indexAction() {

    }
}

