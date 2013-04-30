<?php
class Model_DbTable_Venues extends Zend_Db_Table
{

  //
  // Venue Functions
  //

	protected $_name = 'venue';
	protected $_primary = 'venue_id';

        public function getVenues($filter ='', $sort = '')
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
              $noVenues = array(array('venue_name' => 'NO VENUES'));
              return $noVenues;
          }
        }

        public function addVenue($venue)
        {
          $rows = $this->insert($venue);

          if(isset($rows)){
            return "Success!";
          } else{
            return "Fail!";
          }
        }


  //////////////////////////////////////////////////////////////////////////////////////
 //                                     map page functions                           //
//////////////////////////////////////////////////////////////////////////////////////


        public function getArrayForGoogleQuery(){
          $rows= $this->fetchAll($this->select()
                                   ->where("venue_glat = NULL")
                                  );
          if(isset($rows)){
            return $rows->toArray();
          } else{
              $noVenues = array(array('venue_name' => 'NO VENUES'));
              return $noVenues;
          }
        }


        public function saveGeocodingToDatabase($lat, $lon, $id){
             $data = array('venue_glat'   => $lat,
                            'venue_glon'   => $lon);
             $result = $this->update($data, 'venue_id = '.$id);

        }

    public function getIndividualPoint($lead_id){
            $sql = "SELECT
                                    connum,
                                    school_name,
                                    school_address,
                                    lead_id,
                                    school_postcode,
                                    school_telephone,
                                    school_website,
                                    g_lon AS lon,
                                    g_lat AS lat
                            FROM contact_details
                            WHERE g_lat IS NOT NULL
                                    AND lead_id=".$lead_id;
            $data = array();
            $results = $this->db->fetchRow($sql);
            $data[] = $results;
            if(!empty($results['connum'])){
                    return $data;
            }else{
                    $sql = "SELECT
                                            contact_details.school_name AS school_name,
                                            contact_details.connum AS connum,
                                            contact_details.school_address AS school_address,
                                            contact_details.lead_id AS lead_id,
                                            contact_details.school_postcode AS school_postcode,
                                            contact_details.school_telephone AS school_telephone,
                                            contact_details.school_website AS school_website,
                                            my_school_gmaps.lng AS lon,
                                            my_school_gmaps.lat AS lat
                                    FROM  contact_details
                                            INNER JOIN my_references
                                            ON contact_details.connum = my_references.reference
                                            INNER JOIN my_school_gmaps
                                            ON my_references.school = my_school_gmaps.school
                                    WHERE my_references.ref_type = '1'
                                            AND my_school_gmaps.lng != ''
                                            AND contact_details.g_lat IS NULL
                                            AND contact_details.lead_id = ".$lead_id;

                    $data = array();
                    $result = $this->db->fetchRow($sql);
                    $data[] = $result;

                    if(count($result) > 0){
                            return $data;
                    }
                    else{
                            $data = array();
                            $data[0]['school_name'] = "OOPS! Crom made a cockup. Please refresh the page, and complain to someone if the problem persists.";
                            var_dump($this->db->fetchAll($sql));
            exit;
                            return $data;
                    }
            }
    }

    public function checkMapCol(){
            $sql = "SELECT
                                    school_name,
                                    school_address,
                                    lead_id,
                                    connum,
                                    school_postcode,
                                    school_telephone,
                                    school_website,
                                    g_lon AS lon,
                                    g_lat AS lat
                            FROM contact_details
                            WHERE g_lat IS NOT NULL
                                    AND active = 'Yes'";

            return $this->db->fetchAll($sql);
    }
}

?>