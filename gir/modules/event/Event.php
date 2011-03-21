<?php 
/**
 * 
 * @author undead
 *
 */
 require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Calendar');
 
class Event extends Crud {
	
	protected $_OBJECT_NAME = "event";
	protected $_OBJECT_NAME_ID = "";
	protected $_OBJECT_PROPERTIES = array(	  array("type"=>"text","label"=>"Event Title","field"=>"event_title"),
                                              array("type"=>"text","label"=>"Event Location","field"=>"event_location"),
                                              array("type"=>"text","label"=>"Event Details","field"=>"event_details"),
                                              array("type"=>"date","label"=>"Event Start Date","field"=>"event_start_date"),
                                              array("type"=>"date","label"=>"Event Start Time","field"=>"event_start_time"),
                                              array("type"=>"date","label"=>"Event End Date","field"=>"event_end_date"),
                                              array("type"=>"date","label"=>"Event End Time","field"=>"event_end_time"),
                                              array("type"=>"text","label"=>"Full Name","field"=>"name"),
                                              array("type"=>"text","label"=>"Your Email","field"=>"email"),
                                              array("type"=>"text","label"=>"Your Phone Number","field"=>"phone_number"),
                                              array("type"=>"text","label"=>"Google Calendar ID","field"=>"google_calendar_id")
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
    
    public function gCalStart() {
        return $this->_gCalStart();
    }
    
    private function _gCalStart(){
      // Parameters for ClientAuth authentication
      $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
      $user = "calebsgames@gmail.com";
      $pass = "Mach1395";
      // Create an authenticated HTTP client
      $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
      // Create an instance of the Calendar service
      //$service = new Zend_Gdata_Calendar($client);
      return $client;
    }
    
    public function gCalGetEvents($gCalClient) {
        return $this->_gCalGetEvents($gCalClient);
    }
    
    private function _gCalGetEvents($gCalClient){
        
        $gdataCal = new Zend_Gdata_Calendar($gCalClient);
          $eventFeed = $gdataCal->getCalendarEventFeed();
          // print "<pre>";
          // print_r($eventFeed);
          // print "</pre>";
          echo "<ul>\n";
          foreach ($eventFeed as $event) {
            echo "\t<li>" . $event->title->text .  " (" . $event->id . ")\n";
            echo "\t\t<ul>\n";
            foreach ($event->when as $when) {
              echo "\t\t\t<li>Starts: " . $when->startTime . "</li>\n";
            }
            echo "\t\t</ul>\n";
            echo "\t</li>\n";
          }
          echo "</ul>\n";
        
    }
    
    public function gCalCreateEvent($gCalClient, $event_data) {
        return $this->_gCalCreateEvent($gCalClient, $event_data);
    }
    
    private function _gCalCreateEvent ($gCalClient, $event_data){
          
          if ($event_data['tzOffset']) $event_data['tzOffset'] = "-06";
          $gdataCal = new Zend_Gdata_Calendar($gCalClient);
          $newEvent = $gdataCal->newEventEntry();
          
          $newEvent->title = $gdataCal->newTitle($event_data["event_title"]);
          $newEvent->where = array($gdataCal->newWhere($event_data["event_location"]));
          $newEvent->content = $gdataCal->newContent($event_data['event_details']);
          
          $when = $gdataCal->newWhen();
          $when->startTime = "{$event_data['event_start_date']}T{$event_data['event_start_time']}:00.000{$event_data['tzOffset']}:00";
          $when->endTime = "{$event_data['event_end_date']}T{$event_data['event_end_time']}:00.000{$event_data['tzOffset']}:00";
          $newEvent->when = array($when);
        
          // Upload the event to the calendar server
          // A copy of the event as it is recorded on the server is returned
          $createdEvent = $gdataCal->insertEvent($newEvent);
          return $createdEvent->id->text;
    }
    
    public function gCalUpdateEvent($gCalClient, $gCalId, $event_data) {
        return $this->_gCalUpdateEvent($gCalClient, $gCalId, $event_data);
    }
    
    private function _gCalUpdateEvent ($gCalClient, $gCalId, $event_data){
       $gdataCal = new Zend_Gdata_Calendar($gCalClient);
        if ($eventOld = $this->_gCalGetEvent($gCalClient, $gCalId)) {
          //echo "Old title: " . $eventOld->title->text . "<br />\n";
          $eventOld->title = $gdataCal->newTitle($event_data["event_title"]);
          $eventOld->where = array($gdataCal->newWhere($event_data["event_location"]));
          $eventOld->content = $gdataCal->newContent($event_data['event_details']);
          
          // $when = $gdataCal->newWhen();
          // $when->startTime = "{$event_data['event_start_date']}T{$event_data['event_start_time']}:00.000{$event_data['tzOffset']}:00";
          // $when->endTime = "{$event_data['event_end_date']}T{$event_data['event_end_time']}:00.000{$event_data['tzOffset']}:00";
          // $eventOld->when = array($when);
          
          try {
            $eventOld->save();
          } catch (Zend_Gdata_App_Exception $e) {
            var_dump($e);
            return null;
          }
          $eventNew = $this->_gCalGetEvent($gCalClient, $gCalId);
          //echo "New title: " . $eventNew->title->text . "<br />\n";
          return $eventNew;
        } else {
          return null;
        }

    }
    
    public function gCalGetEvent($gCalClient, $gCalId) {
        return $this->_gCalGetEvent($gCalClient, $gCalId);
    }
    
    private function  _gCalGetEvent($gCalClient, $gCalId){
      $gdataCal = new Zend_Gdata_Calendar($gCalClient);
      $query = $gdataCal->newEventQuery();
      $query->setUser('default');
      $query->setVisibility('private');
      $query->setProjection('full');
      $query->setEvent($gCalId);
    
      try {
        $eventEntry = $gdataCal->getCalendarEventEntry($query);
        return $eventEntry;
      } catch (Zend_Gdata_App_Exception $e) {
        var_dump($e);
        return null;
      }
    }
    
    
}
?>