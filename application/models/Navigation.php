<?php
class Model_Navigation
{

	public $navItems = array();

	public function buildNavigationArray($currentPath)
	{
		// $this->navItems[] = array('url' => '/addvenue',
		// 					           'regex' => '#^/addvenue#',
		// 					           'label' => 'Add New Venue');

		// $this->navItems[] = array('url' => '/addplace',
		// 					           'regex' => '#^/addplace#',
		// 					           'label' => 'Add New Place');

		$this->navItems[] = array('url' => '/venues',
							           'regex' => '#^/venues$#',
							           'label' => 'Venues');

		// $this->navItems[] = array('url' => '/places',
		// 					           'regex' => '#^/places$#',
		// 					           'label' => 'Places');

		$this->navItems[] = array('url' => '/map/',
							           'regex' => '#^/map$#',
							           'label' => 'Map');

		$this->navItems[] = array('url' => '/events',
							           'regex' => '#^/events$#',
							           'label' => 'Events');

		// $this->navItems[] = array('url' => '/gallery',
		// 					           'regex' => '#^/gallery$#',
		// 					           'label' => 'Gallery');

		$this->navItems[] = array('url' => '/about',
							           'regex' => '#^/about$#',
							           'label' => 'About');

    foreach ($this->navItems as $i=>$navItem):
      if(preg_match($navItem['regex'], $currentPath)) {
        $this->navItems[$i]['is_selected'] = true;
      } else {
        $this->navItems[$i]['is_selected'] = false;
      }
    endforeach;

	}


}