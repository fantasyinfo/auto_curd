<?php



/**
 * creating database class for database connections
 */
class DB
{
    /**
     * creating required properties
     *
     * @var string
     */
    private $dbHost;
    private $dbUserName;
    private $dbPassword;
    private $dbName;
    public  $conn;

    /**
     * calling construct function at the time of object create
     */
    public function __construct()
    {
        $this->dbHost       = 'localhost';
        $this->dbUserName   = 'root';
        $this->dbPassword   = 'mysql';
        $this->dbName       = 'automobile_crud';

        /**
         * databse PDO connections DSN
         */
        $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName . '';
        /**
         * try catch for connectiong database via PDO
         */
        try {
            $this->conn = new PDO($dsn, $this->dbUserName, $this->dbPassword);
            /**
             * setting attribute for connection to show errors & exceptions
             */
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            /**
             * Display Errors if Connection has errors
             */
            echo $e->getMessage();
        }
    }

    /**
     * closing the database connection after work done in destruct function
     */
    public function __destruct()
    {
        $this->conn = null;
    }
}