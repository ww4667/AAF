<?php 
/**
 * 
 * @author undead
 *
 */
class Business extends Crud {
	
	protected $_OBJECT_NAME = "business";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Business Name","field"=>"business_name"),
											array("type"=>"text","label"=>"Phone","field"=>"phone")
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
}
?>