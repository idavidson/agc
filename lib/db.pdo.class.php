<?php
/**
 * Wrapper around pdo class, defines a singleton class for getting and maintaining a database connection
 *
 * PHP version 5
 *
 * @category   Core
 * @package    Core
 * @subpackage Util
 * @author     SPSA <scope@spsa.pnn.police.uk>
 * @copyright  2012 SPSA
 * @license    http://tpscope/licence SPSA Licence
 * @link       http://tpscope/docs/
 */
/**
 * PdoDatabaseConnection
 *
 * Singleton pattern that handles getting a database connection
 *
 * PHP version 5
 *
 * @category   Core
 * @package    Core
 * @subpackage Util
 * @author     SPSA <scope@spsa.pnn.police.uk>
 * @copyright  2012 SPSA
 * @license    http://tpscope/licence SPSA Licence
 * @version    Release: 1.0
 * @link       http://tpscope/docs/
 */
class PdoDatabaseConnection
{
    protected $dbConnection;
    private $_connectionProperties = array();
    protected static $dsnConns = array();
    private $_locks = array();

    /**
     * Constructor, declared as private, responsible for instantiating
     * the database connection
     *
     * @param string $dsn String with the database connection parameters
     *                    host:port|username|password|database
     *
     * @access private
     * @return void
     * @throws DatabaseConnectionException
     */
    private function __construct($dsn)
    {
        try{
            if ($dsn == '' || !is_string($dsn) || strpos($dsn, "|") === false) {
                throw new PdoDsnException("The DSN needs to be a string with values separated by pipe character (|)\n i.e. host:port|username|password|database");
            }
            $this->_connectionProperties = explode("|", $dsn);
            if (count($this->_connectionProperties) != 4) {
                throw new PdoDsnException("The DSN needs to be a string with values separated by pipe character (|)\n i.e. host:port|username|password|database");
            }
            if (stristr($this->_connectionProperties[0], ':')) {
                $hostport = explode(':', $this->_connectionProperties[0]);
                $host = $hostport[0];
                $port = $hostport[1];
                if (array_key_exists(2, $hostport)) {
                    $socket = ";unix_socket=$hostport[2]";
                } else {
                    $socket = "";
                }
            } else {
                $host = $this->_connectionProperties[0];
                $port = Settings::DEFAULT_MYSQL_PORT;
                $socket = "";
            }

            $this->dbConnection = new PDO("mysql:host=$host;dbname={$this->_connectionProperties[3]};port=$port$socket", $this->_connectionProperties[1], $this->_connectionProperties[2], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            throw $e;
        }
    }

    /**
     * This static function is responsible for returning
     * an instance of the DatabaseConnection class
     *
     * @param string $dsn String with the database connection parameters
     *                    host:port|username|password|database
     *
     * @access public
     * @return DatabaseConnection A DatabaseConnection object
     */
    public static function getInstance($dsn=Settings::MASTER_DSN)
    {
        if (!array_key_exists($dsn, self::$dsnConns)) {
            self::$dsnConns[$dsn] = new PdoDatabaseConnection($dsn);
        }

        return self::$dsnConns[$dsn];
    }

    /**
     * Return the database connection object
     *
     * @access public
     * @return object A mysqli database connection object
     */
    public function getConnection()
    {
        return $this->dbConnection;
    }

    /**
     * Determines if the requested lock name is already used as a lock.
     *
     * @param string $lockName The name of the lock
     *
     * @access private
     * @return boolean
     */
    private function _isLocked($lockName)
    {
        $checkLock = "SELECT IS_FREE_LOCK('$lockName')";
        $result = $this->dbConnection->query($checkLock);
        $check = $result->fetch(PDO::FETCH_NUM);

        if ($check[0] == 0) {
            //is locked
            return true;
        } else {
            //is not locked
            return false;
        }
    }

    /**
     * Determines if the lock is in use by this database instance.
     *
     * @param string $lockName The name of the lock
     *
     * @access private
     * @return integer|boolean Will return either the key in the $this->_locks array or false
     */
    private function _alreadyHaveLock($lockName)
    {
         return array_search($lockName, $this->_locks);
    }

    /**
     * Implementation of the mysql function GET_LOCK.  Attempts to obtain a lock with the
     * name passed in.
     *
     * Note that calling a subsequent DatabaseConnection::getLock in your code will automatically release
     * any lock that came before it.  This is the default behaviour of MySQL.
     *
     * @param string  $lockName The name of the lock
     * @param integer $timeOut  Time in seconds to wait for a lock
     *
     * @access public
     * @return boolean Will return true if lock was successful otherwise will return false
     */
    public function getLock($lockName, $timeOut=10)
    {
        if ($this->dbConnection->getAttribute(PDO::ATTR_DRIVER_NAME) != 'mysql') {
            // @codeCoverageIgnoreStart
            throw new Exception("get Lock is only implemented for MySQL drivers");
            // @codeCoverageIgnoreEnd
        }

        if ($this->_isLocked($lockName)) {
            if ($this->_alreadyHaveLock($lockName) !== false) {
                return true;
            } else {
                return false;
            }
        }

        $getLock = "SELECT GET_LOCK('$lockName',$timeOut)";
        $result = $this->dbConnection->query($getLock);

        $lockRecord = $result->fetch(PDO::FETCH_NUM);

        if ($lockRecord[0] == 0) {
            // @codeCoverageIgnoreStart
            return false;
            // @codeCoverageIgnoreEnd
        } else {
            $key = $this->_alreadyHaveLock($lockName);

            if ($key === false) {
                 $this->_locks[] = $lockName;
            }

            return true;
        }
    }

    /**
     * Implementation of the mysql function RELEASE_LOCK.  Attempts to free
     * the lock with the name passed in.
     *
     * @param string $lockName The name of the lock
     *
     * @access public
     * @return void
     */
    public function freeLock($lockName)
    {
        if ($this->dbConnection->getAttribute(PDO::ATTR_DRIVER_NAME) != 'mysql') {
            // @codeCoverageIgnoreStart
            throw new Exception("Free Lock is only implemented for MySQL drivers");
            // @codeCoverageIgnoreEnd
        }

        $freeLock = "SELECT RELEASE_LOCK('$lockName')";
        $result = $this->dbConnection->query($freeLock);

        $lockRecord = $result->fetch(PDO::FETCH_NUM);

        if ($lockRecord[0] == 1) {
            $key = $this->_alreadyHaveLock($lockName);

            if ($key !== false) {
                unset($this->_locks[$key]);
            }
        }

    }

    // @codeCoverageIgnoreStart
    /**
     * __destruct
     *
     */
    public function __destruct()
    {
        foreach ($this->_locks as $value) {
            $this->freeLock($value);
        }
        $this->dbConnection = null;
    }
    // @codeCoverageIgnoreEnd

    /**
     * This method sets the error handling to silent, no exceptions or warnings will be produced
     * developers will need to handle errors themselves using errorCode() and errorInfo().
     * Script execution will continue if errors are not checked and handled.
     *
     * @return void
     */
    public function setSilent()
    {
        $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    }

    /**
     * This method sets the error handling to warning, no exceptions will be produced
     * developers will need to handle errors themselves using errorCode() and errorInfo().
     * Script execution will continue if errors are not checked and handled.
     *
     * @return void
     */
    public function setWarning()
    {
        $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    /**
     * This method sets the error handling to exceptions
     * Any PDO errors encountered will throw a PDOException.
     * This is the default for this class
     *
     * @return void
     */
    public function setException()
    {
        $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}

// @codeCoverageIgnoreStart
/**
 * PdoDsnException
 *
 * Custom exception
 *
 * PHP version 5
 *
 * @category   Core
 * @package    Core
 * @subpackage Util
 * @author     SPSA <scope@spsa.pnn.police.uk>
 * @copyright  2012 SPSA
 * @license    http://tpscope/licence SPSA Licence
 * @version    Release: 1.0
 * @link       http://tpscope/docs/
 */
class PdoDsnException extends Exception
{

}
// @codeCoverageIgnoreEnd
?>
