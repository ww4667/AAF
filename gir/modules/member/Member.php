<?php 
/**
 * 
 * @author undead
 *
 */
class Member extends User {
	
	protected $_OBJECT_NAME = "member";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"First Name","field"=>"first_name"),
                                          array("type"=>"text","label"=>"Last Name","field"=>"last_name"),
                                          array("type"=>"text","label"=>"Company","field"=>"company"),
                                          array("type"=>"text","label"=>"Address","field"=>"address"),
                                          array("type"=>"text","label"=>"City","field"=>"city"),
                                          array("type"=>"text","label"=>"State","field"=>"state"),
                                          array("type"=>"text","label"=>"Zip Code","field"=>"zip_code"),
                                          array("type"=>"text","label"=>"Phone Number","field"=>"phone_number"),
                                          array("type"=>"text","label"=>"Term","field"=>"term"),
                                          array("type"=>"number","label"=>"Paid","field"=>"paid"),
                                          array("type"=>"number","label"=>"Letter Sent","field"=>"letter_sent")
											);
	function __construct(){
		parent::__construct();
		foreach($this->_OBJECT_PROPERTIES as $p) {
			$this->{$p['field']} = "";
		}
	}
}
?>