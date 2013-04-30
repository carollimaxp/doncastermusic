<?php

class ErrorController extends Zend_Controller_Action
{



    public function errorAction()
    {
       // $errors = $this->_getParam('error_handler');

        $currentPath = rtrim($this->getRequest()->getPathInfo(), '/');

        $nav = new Model_Navigation();
        $nav->buildNavigationArray($currentPath);

        $this->view->nav = $nav->navItems;
        $errors = $this->_getParam('error_handler');
        $this->view->headLink()->appendStylesheet('/css/codemason.css');

        $this->view->exception = $errors->exception;
        $this->view->request   = $errors->request;
        var_dump($errors->exception);
        exit;
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                //ECHO SHIT
                //var_dump($errors->exception);
                //$this->view->errorTitle = 'Error 404 - Page not found';
                $content = $this->view->render('/error/404.phtml');
                $this->view->content = $content;
                break;
            default:
                // application error

                $this->getResponse()->setHttpResponseCode(500);
                $this->view->content  = '<h3>You should not be seeing this.</h3>';
                $this->view->content .= '<p>Page error.</p>';
                break;
        }

    }

}