<?php 
/**
 * 
 * @author undead
 *
 */
class Job extends Crud {
	
	protected $_OBJECT_NAME = "job";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	  array("type"=>"text","label"=>"Job Title","field"=>"job_title"),
                                              array("type"=>"text","label"=>"Company","field"=>"company"),
                                              array("type"=>"text","label"=>"Description","field"=>"description"),
                                              array("type"=>"date","label"=>"Post Job Until","field"=>"post_job_until"),
                                              array("type"=>"text","label"=>"Your Name","field"=>"name"),
                                              array("type"=>"text","label"=>"Your Email","field"=>"email"),
                                              array("type"=>"text","label"=>"Your Phone Number","field"=>"phone_number"),
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
	
    
    public function showApprovedJobs(){
        $items = $this->GetAllItemsObj();
        $items = $this->QueryObjectItems("approved != 1");
        return $items;
    }
    
    public function showJobDetail($job){
        $theJob = $this->GetItem( $job);
        return $theJob;
                   
    }
}
?>