<?php

class MapController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */

        // Load Navigation
        $currentPath = rtrim($this->getRequest()->getPathInfo(), '/');

        $nav = new Model_Navigation();
        $nav->buildNavigationArray($currentPath);

        $this->view->nav = $nav->navItems;
        $this->view->headMeta()->appendName('description','The only system your business needs.');


    		$localkey = 'ABQIAAAAqgL_58suZ5QC3cPDhUi8QhRUtx3lJlhLUZx09zLKFxLGEJsO1RTs_YVi0eBo7ft2j-zXwtBzXgBuZw';
    		$key      = 'ABQIAAAA2GRlcp6tT_wy-e1jW2u4LRQzY27NcrdqSj0KqWsc7u4X1R-I7xQMs9OUThMJTNMuj6Zrpx5a9mVJew';
            // New key for live March 2013 : AIzaSyDQCCd8nApi2pObplATRCmJNIeHjzKzYgg

        $this->view->headScript()->setFile('http://maps.google.com/maps/api/js?sensor=false', $type = 'text/javascript', $attrs = array());
        $this->view->inlineScript()->setFile('http://maps.google.com/maps?sensor=false&file=api&v=3&key='.$key, $type = 'text/javascript', $attrs = array());
        $this->view->inlineScript()->appendFile('/js/map.js', $type = 'text/javascript', $attrs = array());
        $this->view->inlineScript()->appendFile('/js/geocode.js', $type = 'text/javascript', $attrs = array());


    }


	public function indexAction() {

    $venues = new Model_DbTable_Venues();
    $filter = "venue_glat IS NULL";
    $google = $venues->getVenues($filter);
    $this->view->google = $google;

    $filter = "venue_glat IS NOT NULL";
    $mapdata = $venues->getVenues($filter);
    $this->view->mapdata = $mapdata;

    /*
    if (!empty($lead_id)){
            //$data = $this->dbMapper->getIndividualPoint();
    } else {
            $one = $this->dbMapper->checkMasterSchools();
            $two = $this->dbMapper->checkMapCol();

            $data = array_merge($one, $two);

    }
    $total = count($data);
    for($i = 0; $i<$total; $i++){
            $data[$i]['school_address'] = nl2br($data[$i]['school_address']);
            $data[$i]['school_telephone'] = $data[$i]['school_telephone'] == null ? "" : $data[$i]['school_telephone'];
            $data[$i]['school_website'] = $data[$i]['school_website'] == null ? "" : $data[$i]['school_website'];
    }

		$this->view->data = $data;
		$devKey='ABQIAAAA0k3KxRX6269U70c4Oe3kbBQSLCAXqqQeDjec3nvy3XseM3eQQBTJt2F2Xh8V-aFeuMlVL-qjPk90PQ';
		$localKey = 'ABQIAAAA2GRlcp6tT_wy-e1jW2u4LRSkXk1FiIyoWGO6Sme_117wVXpRhhQsWWu9nS9_XBwaBubHQ2n_ug-wkA';
		$livekey = "ABQIAAAA2GRlcp6tT_wy-e1jW2u4LRR5CdDKZ2jCOIon2X0nVz7Ls7_G-RQXR2PqdfFAiqiBpuaN2YrhoHajNQ";
		$newliveKey = 'ABQIAAAA2GRlcp6tT_wy-e1jW2u4LRTui6UTTaC_4ii7yb1dkX0-wRwc8RQMrv9ALvTf8kyb4sKZJhd8YMD6qg';
		$key = $newliveKey;


        $this->view->css[] = "/css/demo.css";
		$this->view->js[] = 'http://maps.google.com/maps/api/js?sensor=false';
		$this->view->js[] = 'http://maps.google.com/maps?sensor=false&file=api&v=2&key='.$key;
        $this->view->js[] = '/js/geocode.js';
		$this->view->js[] = '/js/map.js';
        //$this->view->js[] = '/js/etcetc.js';


	   	$this->view->contentView = 'map/map.phtml';
        $this->renderView('map.phtml');*/
    }


	public function saveAction()
	{
    $venues = new Model_DbTable_Venues();
		$geocoding = $venues->saveGeocodingToDatabase($_POST['venue_glat'], $_POST['venue_glon'], $_POST['venue_id']);
	}
}
?>