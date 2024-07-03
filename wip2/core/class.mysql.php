<?php
/**
 * This class handles MySql connections and queries.
 * Example Usage: To Connect to DB use something like this,
 * $connection = &new MySql($hostname, $username, $password, $dbname);
 */
 
class MySql {

    var $hostname;	// Hostname of MySql server
    var $username;	// username for the database
    var $password;	// password for the database
    var $dbname;	// which table are we using?
    var $dblink;	// link identifier
    var $conError;	// Catches errors

// Constructor. Set variables. Call connection function.
function __construct($hostname, $username, $password, $dbname) {
    $this->hostname = $hostname;
    $this->username = $username;
    $this->password = $password;
    $this->dbname = $dbname;
    $this->databaseConnect();
}

function databaseConnect() {
    // Establish connection to database.
    if (!$this->dblink = @mysql_connect ($this->hostname,
			$this->username, $this->password)) {
        trigger_error('Could not connect to database server: ' . mysql_error());
		$this->conError = true;
    }
    // Select the database.
    else if (!@mysql_select_db($this->dbname, $this->dblink)) {
        trigger_error('Could not select the database: ' . mysql_error());
		$this->conError = true;
    }
}

// Error check function.
function isError() {
    if ($this->conError) {
        return true;
    }

    $error = mysql_error($this->dblink);
    if (empty($error)) {
        return false;
    } else {
		return true;
    }
}

// Return MySqlResult instance of results.
function &query($sql) {
    if (!$queryResource = mysql_query($sql, $this->dblink)) {
	trigger_error('Query failed: ' . mysql_error($this->dblink)
			. ' SQL: ' . $sql);
    }
    return new MySqlResult($this, $queryResource);
}

} 

// A class to generate the results from the query and
// return the results to the previous class.
class MySqlResult {

var $mysql;
var $query;

function __construct(&$mysql, $query) {
    $this->mysql = &$mysql;
    $this->query = $query;
}

// Fetch a row from results.
function fetch() {
    if ($row = mysql_fetch_array($this->query, MYSQL_ASSOC)) {
        return $row;
    }
    else if ($this->size() > 0) {
        mysql_data_seek($this->query, 0);
	return false;
    } else {
	return false;
}
}

/**
 * Returns the Row count of the query.
 * Usage Example: echo 'Found ' . $result->size() . ' rows.';
 */
function size() {
    return mysql_num_rows($this->query);
}

function isError() {
    return $this->mysql->isError();
}

/**
 * Safely escape strings for SQL queries.
 * Usage Example: Select * From accounts where name= '"
 *		. safeEscapeString('name') . "'
 */
function safeEscapeString($string) {
    if (get_magic_quotes_gpc()) {
	return $string;
} else {
	return mysql_real_escape_string($string);
}

}

/**
 * Provide the ID of the last inserted Row.
 * Usage Example: echo 'Row ID is: ' . $result->getInsertId();
 */
function getInsertId() {
    return mysql_insert_id($this->mysql->dblink);
}

}
?>
