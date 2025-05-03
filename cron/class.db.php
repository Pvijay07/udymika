<?php
 
// Database: CRUD
class DB extends PDO
{

    // ------------------------------------------------------------------------
    
    /**
     * Instantiate a PDO Instance with CRUD functionality
     * 
     * @param string $db_type
     * @param string $db_name
     * @param string $db_host
     * @param string $db_user
     * @param string $db_pass
     * 
     * @return void
     */
    public function __construct($db_type, $db_name, $db_host, $db_user, $db_pass = '') 
    {
        try {
            $dsn = "$db_type:dbname=$db_name;host=$db_host";
            parent::__construct($dsn, $db_user, $db_pass);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * Select
     * 
     * @param mixed $columns String or Array
     * @param array $data Must be Associative Array ['Column' => 'Value']
     * 
     * @return array
     */
    public function select($table, $columns, $where = null, $statement = null) {
        
        
        if (is_array($columns)) {
            $columns = implode(',', $columns);
        }
        
        // Build the WHERE Statement
        $where_stmt = $this->_whereBuilder($where);
        if (!is_array($where)) {
            $where = "'primary_key' => $where";
        }
        
		
        // Run the Query
        $stmt = $this->prepare("SELECT $columns FROM `{$table}` $where_stmt $statement");
        $stmt->execute($where);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
	
	
	public function selectAll($table, $columns, $statement = null) {
        
        if (is_array($columns)) {
            $columns = implode(',', $columns);
        }
		
        // Run the Query
        $stmt = $this->prepare("SELECT $columns FROM `{$table}` $statement");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    // ------------------------------------------------------------------------
	
	 public function selectRow($table, $columns, $where = null, $statement = null) {
        
        
        if (is_array($columns)) {
            $columns = implode(',', $columns);
        }
        
        // Build the WHERE Statement
        $where_stmt = $this->_whereBuilder($where);
        if (!is_array($where)) {
            $where = array('primary_key' => $where);
        }
       
        // Run the Query
        $stmt = $this->prepare("SELECT $columns FROM `{$table}` $where_stmt $statement");
        $stmt->execute($where);
		$count = $stmt->rowCount();
		if($count){
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			$result = $count;
		}
        return $result;
    }
	
	
    
    // ------------------------------------------------------------------------
    
    /**
     * Inserts data into database
     * 
     * @param array $data Must be Associative Array ['Column' => 'Value']
     * 
     * @return mixed Boolean or insertID
     */
    public function insert($table, $data) 
    {
        
        $keys_array = array_keys($data);
        $keys       = '`' . implode('`, `', $keys_array) . '`';
        $params     = ':' . implode(', :', $keys_array);
        
        $sth = $this->prepare("INSERT INTO `{$table}` ($keys) VALUES($params)");
        $result = $sth->execute($data);
        
        if ($result == 1) {
            return $this->lastInsertId();
        }

        return false;
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * Update
     * 
     * @param array $data   Associate key/value pairs to changes
     * @param mixed $where  Either an array or a numeric primary key index
     * 
     * @return integer Total affected rows
     */
    public function update($table, $data, $where) {
                
        // Create the string for SET {here}
        $set = '';
        foreach ($data as $_key => $_value) {
            $set .= "`$_key` = :$_key,";
        }
        
        // Remove the trailing comma
        $set = rtrim($set, ',');
        
        // Build the WHERE Statement
        $where_stmt = $this->_whereBuilder($where);
        if (!is_array($where)) {
            $where = array('primary_key' => $where);
        }
        
        // Combine the DATA and WHERE to bind to both parameters
        $data = array_merge($data, $where);
        
        // Run the Query
        $sth = $this->prepare("UPDATE `{$table}` SET $set $where_stmt");
        $sth->execute($data);
        return $sth->rowCount();
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * Delete
     * 
     * @param mixed $where  Either an array or a numeric primary key index
     * 
     * @return boolean
     */
    public function delete($table, $where) 
    {
        
        // Build the WHERE Statement
        $where_stmt = $this->_whereBuilder($where);
        if (!is_array($where)) {
            $where = "'primary_key' => $where";
        }
        
        // Tun the Query
        $sth = $this->prepare("DELETE FROM `{$table}` $where_stmt");
        $sth->execute($where);
        return $sth->rowCount();
    }
    
    // ------------------------------------------------------------------------
    
    /**
     * Builds the MySQL WHERE Clause
     * 
     * @param mixed $where
     * 
     * @return mixed Could be empty or a where condition
     */
    private function _whereBuilder($where)
    {
        $where_stmt = null;
        if (is_numeric($where)) 
        {
            $primary = 'id';
            $where_stmt = " WHERE `$primary` = :primary_key";
        }
        elseif (is_array($where)) 
        {
            // Build the Where Statement
            $where_stmt = '';
            foreach ($where as $_key => $_value) {
                $where_stmt .= "`$_key` = :$_key AND ";
            }
            $where_stmt = " WHERE " . rtrim($where_stmt, ' AND ');
        }
        return $where_stmt;
    }
	
	public function check_duplicate($table, $where) {
        
        
        // Build the WHERE Statement
        $where_stmt = $this->_whereBuilder($where);
        if (!is_array($where)) {
            $where = "'primary_key' => $where";
        }
       
        // Run the Query
        $stmt = $this->prepare("SELECT * FROM `{$table}` $where_stmt");
        $stmt->execute($where);
		$count = $stmt->rowCount();
		
        return $count;
    }
    
    // ------------------------------------------------------------------------
	
	
	
   
    
}
/** EOF */