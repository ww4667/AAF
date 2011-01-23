<?php 
/**
 * 
 * @author undead
 *
 */
class Member_Application extends Crud {
	
	protected $_OBJECT_NAME = "member_application";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Application Data","field"=>"application_data"),
                                          array("type"=>"text","label"=>"Applicant First Name","field"=>"first_name"),
                                          array("type"=>"text","label"=>"Applicant Last Name","field"=>"last_name"),
                                          array("type"=>"text","label"=>"Applicant Email","field"=>"email"),
                                          array("type"=>"number","label"=>"Approved","field"=>"approved")
                                          );
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
	
	public function getObjectProperties() {
		return $this->_OBJECT_PROPERTIES;
	}
    
    public function viewApplications(){
        $items = $this->GetAllItemsObj();
        $items = $this->QueryObjectItems("approved = ''");
        return $items;
    }
    public function getApplicationData($app_id){
        $theApp = $this->GetItemObj( $app_id);
        return $theApp;
                   
    }
}
?>