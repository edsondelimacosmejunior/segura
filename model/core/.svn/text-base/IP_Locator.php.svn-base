<?php
/**
 * IP_Locator
 * 
 * @package    Models
 * @subpackage Core
 */
class IP_Locator extends AutoClass
{

	public $country_code;
	public $country_name;
	public $region_name;
	public $city;
	public $zippostalcode;
	public $latitude;
	public $longitude;
	public $timezone;
	public $gmtoffset;
	public $dstoffset;

    function __construct($ip)
    {
    	
		@$d = file_get_contents("http://www.ipinfodb.com/ip_query.php?ip=$ip&output=json");
	 
		//Use backup server if cannot make a connection
		if (!$d){
			@$backup = file_get_contents("http://backup.ipinfodb.com/ip_query.php?ip=$ip&output=json");
			$answer = json_decode($backup);
			
			if (!$backup) return false; // Failed to open connection
		}else{
			$answer = json_decode($d);
		}
	 
		$this->country_code = $answer->CountryCode;
		$this->country_name = $answer->CountryName;
		$this->region_name = $answer->RegionName;
		$this->city = $answer->City;
		$this->zippostalcode = $answer->ZipPostalCode;
		$this->latitude = $answer->Latitude;
		$this->longitude = $answer->Longitude;
		$this->timezone = $answer->Timezone;
		$this->gmtoffset = $answer->Gmtoffset;
		$this->dstoffset = $answer->Dstoffset;
	 
	}

}

?>
