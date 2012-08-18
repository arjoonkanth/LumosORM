<?php
/**
* database connection
*/
class databaseConnection 
{
	private static $host = "mysql:host=localhost;dbname=yourDatabaseNameHere";
    private static $dbuser = 'Username';
    private static $dbpass = 'Password';

    private static $instance;

    private function __construct(){}

    static public function getInstance()
    {
        if (!self::$instance) {
            try {
                self::$instance = new PDO(self::$host,self::$dbuser,self::$dbpass,array(PDO::ATTR_PERSISTENT=>true));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                //echo "Database Connected";
            } catch (PDOException $e) {
                echo "Database Not Connected - " . $e->getMessage();
                exit();
            }
        }
        return self::$instance;
    }
}