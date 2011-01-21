<?php 
/**
 * 
 * @author undead
 *
 */
class Membership_Classification extends Crud {
	
	protected $_OBJECT_NAME = "membership_classification";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	array("type"=>"text","label"=>"Description","field"=>"description"),
                                          array("type"=>"number","label"=>"Fee","field"=>"fee")
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
    
    public function formBuilder($type, $selected = null){
        $items = $this->GetAllItemsObj();
       
        switch ($type){
            case "select":
                ?>
                <select name = "classification">
                <?                
                   foreach($items as $c){
                       ?>
                        <option value = "<?= $c->fee ?>"<?= ($selected == $c->description) ?  " selected" :  "" ;?>><?= $c->description ?></option>   
                       <?                       
                   }                
                ?>                
                </select>
                <?               
               
            break;
               
            case "radio":               
                ?>
                
                <?                
                   foreach($items as $c){
                       ?>
                        <li><input class="radio_check" type = "radio" value = "<?= $c->description ?>" name = "classification" id = "classification<?= $c->id ?>" /><label class="radio_check" for ="classification<?= $c->id ?>"><?= $c->description ?></label></li>
                       <?                       
                   }                
                ?>
                
                </select>
                <?     
            break;
           
           
        }     
        
        
    }
}
?>