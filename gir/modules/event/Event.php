<?php 
/**
 * 
 * @author undead
 *
 */
class Event extends Crud {
	
	protected $_OBJECT_NAME = "event";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	  array("type"=>"text","label"=>"Event Title","field"=>"event_title"),
                                              array("type"=>"text","label"=>"Event Location","field"=>"event_location"),
                                              array("type"=>"text","label"=>"Event Details","field"=>"event_details"),
                                              array("type"=>"date","label"=>"Event Start Date","field"=>"event_start_date"),
                                              array("type"=>"date","label"=>"Event End Date","field"=>"event_end_date"),
                                              array("type"=>"text","label"=>"Full Name","field"=>"name"),
                                              array("type"=>"text","label"=>"Your Email","field"=>"email"),
                                              array("type"=>"text","label"=>"Your Phone Number","field"=>"phone_number")
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
    
    public function showApprovedEvents(){
        $items = $this->GetAllItemsObj();
        $items = $this->QueryObjectItems("event_title != ''");
        return $items;
    }
    
    public function showEventDetail($event){
        $theEvent = $this->GetItem( $event);
        return $theEvent;
                   
    }
}
?>