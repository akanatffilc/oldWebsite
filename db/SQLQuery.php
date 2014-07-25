<?php
class SQLQuery {
  protected $_dbHandle;
  protected $_result;
  protected $_query;
  protected $_numRows;
  protected $_insertID;

  /** Connects to database **/

  function connect($dbname) {
    $mystring = $_SERVER['HTTP_HOST'];
    $findme = 'local';
    $pos = strpos($mystring, $findme);
    $name = '';
    $address = '';
    $account = '';
    $pwd = '';
    if( $pos !== false ){
      $address = 'localhost';
      $account = 'root';
      $pwd = 'root';
      $name = "clifftanaka";
    } else {
      $address = 'clifftanakacom1.ipagemysql.com';
      $account = 'kurifu';
      $pwd = 'kosenrufu';
      $name = "clifftanaka";
    }
    $this->_dbHandle = @mysql_connect($address, $account, $pwd);

    if ($this->_dbHandle != 0) {
      if (mysql_select_db($name, $this->_dbHandle)) {
        return 1;
      } else {
        echo mysql_error();
        return 0;
      }
    }
    else {
      return 0;
    }
  }



  /** Disconnects from database **/

  function disconnect() {
    if (@mysql_close($this->_dbHandle) != 0) {
      return 1;
    }  else {
      return 0;
    }
  }

  function selectAll() {
  	$query = 'select * from `'.$this->_table.'`';
  	return $this->query($query);
  }

  function select($id) {
  	$query = 'select * from `'.$this->_table.'` where `id` = \''.mysql_real_escape_string($id).'\'';
  	return $this->query($query, 1);
  }

  /** Custom SQL Query **/

	function query($query, $singleResult = 0) {
    $this->_numRows = 0;
    $this->_query = $query;
		$this->_result = mysql_query($query, $this->_dbHandle);
    $this->_insertID = mysql_insert_id();
    if( $this->_result ){
      if (preg_match("/select/i",$query)) {
    		$result = array();
    		$table = array();
    		$field = array();
    		$tempResults = array();
    		$numOfFields = mysql_num_fields($this->_result);
    		for ($i = 0; $i < $numOfFields; ++$i) {
    		  array_push($table,mysql_field_table($this->_result, $i));
    		  array_push($field,mysql_field_name($this->_result, $i));
    		}
  			while ($row = mysql_fetch_row($this->_result)) {
          $this->_numRows++;
  				for ($i = 0;$i < $numOfFields; ++$i) {
  					$table[$i] = trim(ucfirst($table[$i]),"s");
  					$tempResults[$table[$i]][$field[$i]] = $row[$i];
  				}
  				if ($singleResult == 1) {
  		 			mysql_free_result($this->_result);
  					return $tempResults;
  				}
  				array_push($result,$tempResults);
  			}
  			mysql_free_result($this->_result);
        return($result);
  		}
    }
	}

  /** Get result **/
  function getInsertID() {
      return ($this->_insertID);
  }

  /** Get result **/
  function getQuery() {
      return ($this->_query);
  }

  /** Get result **/
  function getResult() {
      return ($this->_result);
  }
  
  /** Get number of rows **/
  function getNumRows() {
      return $this->_numRows;
  }

  /** Free resources allocated by a query **/

  function freeResult() {
      mysql_free_result($this->_result);
  }

  /** Get error string **/

  function getError() {
      return mysql_error($this->_dbHandle);
  }
}