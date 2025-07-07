<?php
class Db
{
    protected $dbName = 'ecoomercex';
    /** Database Name */
    protected $dbHost = 'localhost';
    /** Database Host */
    protected $dbUser = 'root';
    /** Database Root */
    protected $dbPass = '';
    /** Databse Password */
    public $dbHandler, $dbStmt;

    /**
     * @param null|void
     * @return null|void
     * @desc Creates or resume an existing database connection...
     **/
    public function __construct()
    {
        // Create a DSN Resource...
        $Dsn = "mysql:host=" . $this->dbHost . ';dbname=' . $this->dbName;
        //create a pdo options array
        $Options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($Dsn, $this->dbUser, $this->dbPass, $Options);
        } catch (Exception $e) {

            $msg = $e->getMessage();
            echo '<script> alert("Could not Establish A Database Connection. Due to the following reason: ' . $msg . '"); </script>';
        }
    }
}
