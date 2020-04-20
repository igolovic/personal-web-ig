<?php
if(!class_exists("galleryObject"))
{
	class galleryObject
	{
		public $name;
		public $el = array();
		
		function addName($_name)
		{
			$this->name = $_name;
		}
		
		function addElement($_el)
		{
			$this->el[] = $_el;
		}
		
		function get_name(){ return $this->name; }
		
		function get_el(){ return $this->el; }
	}
}

if(!class_exists("connect"))
{
	class connect
	{
		public $dbhost = 'localhost';
		public $dbuser = 'root';
		public $dbpass = '';
		public $dbname = '';
		public $mysqli;
		
		function __construct()
		{
			if(!isset($_SESSION['lang']) || $_SESSION['lang'] == "cro")
			{
				$this->dbname = "personal-web-ig_hr"; 
			} 
			
			if(isset($_SESSION['lang']) && $_SESSION['lang'] == "eng")
			{
				$this->dbname = "personal-web-ig_en"; 
			}

			$this->mysqli = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
			$this->mysqli->set_charset('utf8');
			$this->mysqli->query("set collation_connection = utf8_general_ci");
			$this->mysqli->query("set names UTF-8");
		}
		
		function __destruct()
		{
			$this->mysqli->close();
		}
		
		function selectDb($id)
		{
			$this->dbname = ($id == "hr" ? "personal-web-ig_hr" : "personal-web-ig_en");
			$this->mysqli->select_db($this->dbname);
		}
	}
}

?>
