<?php

class GalleryController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */

        // Load Navigation
        $currentPath = rtrim($this->getRequest()->getPathInfo(), '/');

        $nav = new Model_Navigation();
        $nav->buildNavigationArray($currentPath);

        $this->view->nav = $nav->navItems;
        $this->view->headMeta()->appendName('description','Doncaster Music Gallery');


    }

    public function indexAction() {

    }
}