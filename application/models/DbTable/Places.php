<?php
class Model_DbTable_Places extends Zend_Db_Table
{

  //
  // Places Functions
  //
  
	protected $_name = 'place';
	protected $_primary = 'place_id';

        public function getPlaces($filter ='', $sort = '')
        {
          if($filter != ''){
            $rows = $this->fetchAll($this->select()
            
                                     ->where($filter)
                                     );
          } else{
            $rows = $this->fetchAll($this->select()
                                     );
          }
          if(isset($rows)){
            return $rows->toArray();
          } else{
              $noPlaces = array(array('place_name' => 'NO PLACES'));
              return $noPlaces;
          }
        }
        
        public function addPlace($place)
        {
          $rows = $this->insert($place);
          
          if(isset($rows)){
            return "Success!";
          } else{
            return "Fail!";
          }
        }

}

?>