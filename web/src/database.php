<?php
	class Database {
		private static $dbName = 'if0_35733253_meelyl2telecom'; 
		private static $dbHost = 'sql113.infinityfree.com';
		private static $dbUsername = 'if0_35733253';
		private static $dbUserPassword = 'cJGrslo5BxHeCK';
		 
		private static $cont  = null;
		 
		public function __construct() {
			die('Init function is not allowed');
		}
		 
		public static function connect() {
      // One connection through whole application
      if ( null == self::$cont ) {     
        try {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        } catch(PDOException $e) {
          die($e->getMessage()); 
        }
      }
      return self::$cont;
		}
		 
		public static function disconnect() {
			self::$cont = null;
		}
	}
?>