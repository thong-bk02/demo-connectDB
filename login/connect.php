<?php

class DBManager
{
    private $_hostName;
    private $_port;
    private $_userName;
    private $_pwd;
    private $_dbName;

    private $_connection;
    private $_sql;

    public function __construct($hostName, $userName, $pwd, $dbName, $port = 3308)
    {
        $this->_hostName = $hostName;
        $this->_userName = $userName;
        $this->_pwd = $pwd;
        $this->_dbName = $dbName;
        $this->_port = $port;
    }

    public function connect()
    {

        if ($this->_connection) {
            return;
        }

        try {
            $this->_connection = mysqli_connect(
                $this->_hostName,
                $this->_userName,
                $this->_pwd,
                $this->_dbName,
                $this->_port
            );
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function close()
    {
        if (!$this->_connection) {
            return;
        }

        try {
            mysqli_close($this->_connection);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function fetchOne($_sql)
    {
        if (!$this->_connection) {
            return null;
        }

        try {
            $result = mysqli_query($this->_connection, $_sql);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                return $row;
            }
            return false;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function fetchAll($_sql)
    {
        if (!$this->_connection) {
            return null;
        }

        try {
            $result = mysqli_query($this->_connection, $_sql);

            $array = array();
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $array[] = $row;
            }
            return $array;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function insert($_table, $_data)
    {
        if (!$this->_connection) {
            return null;
        }

        try {
            //lưu trữ danh sách field
            $field_list = '';
            //lưu trữ danh sách tương ứng với field
            $value_list = '';

            //lấy data từ table
            foreach ($_data as $key => $value) {
                $field_list .= ",$key";
                $value_list .= ",'" . $value . "'";
            }

            $sql = 'INSERT INTO ' . $_table . '(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';

            return mysqli_query($this->_connection, $sql);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function update($_table, $_data, $_where)
    {
        if (!$this->_connection) {
            return null;
        }

        try {
            $this->connect();
            $sql = '';

            foreach ($_data as $key => $value) {
                $sql .= "$key = '" . $value . "',";
            }
            $sql = 'UPDATE ' . $_table . ' SET ' . trim($sql, ',') . ' WHERE ' . $_where;

            return mysqli_query($this->_connection, $sql);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete($_table, $_where)
    {
        if (!$this->_connection) {
            return null;
        }

        try {
            $sql = "DELETE FROM $_table WHERE $_where";
            return mysqli_query($this->_connection, $sql);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function login( $_user, $_password){
        if(!$this->_connection){
            return null;
        }

        try {
            $sql = "SELECT * FROM User WHERE name = '$_user' and password = '$_password' ";
            $result = mysqli_query($this->_connection,$sql);
            $row = mysqli_num_rows($result);
            return $row;
        } catch (Exception $ex){
            throw $ex;
        }
    }
}

// class database
// {
//     private $conn;

//     function connect()
//     {
//         // Nếu chưa kết nối thì thực hiện kết nối
//         if (!$this->conn) {
//             $this->conn = mysqli_connect("localhost", "root", "", "demo") or die('Lỗi kết nối');
//         }
//     }

//     function dis_connect()
//     {
//         if ($this->conn) {
//             mysqli_close($this->conn);
//         }
//     }

//     //fetch data one
//     function fetch_one($sql)
//     {
//         //kết nối
//         $this->connect();

//         $result = mysqli_query($this->conn, $sql);
//         $row = mysqli_fetch_assoc($result);

//         //xóa kết qủa khỏi bộ nhớ
//         mysqli_free_result($result);

//         if ($row) {
//             return $row;
//         }
//         return false;
//     }

//     //fetch data all
//     function fetch_all($sql)
//     {
//         $this->connect();

//         $result = mysqli_query($this->conn, $sql);

//         $array = array();
//         while ($row = mysqli_fetch_assoc($result)) {
//             $array[] = $row;
//         }

//         mysqli_free_result($result);

//         return $array;
//     }

//     //Insert
//     function insert($table, $data)
//     {
//         $this->connect();

//         //lưu trữ danh sách field
//         $field_list = '';
//         //lưu trữ danh sách tương ứng với field
//         $value_list = '';

//         //lấy data từ table
//         foreach ($data as $key => $value) {
//             $field_list .= ",$key";
//             $value_list .= ",'" . $value . "'";
//         }

//         $sql = 'INSERT INTO ' . $table . '(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';

//         return mysqli_query($this->conn, $sql);
//     }

//     //update
//     function update($table, $data, $where)
//     {
//         $this->connect();
//         $sql = '';

//         foreach ($data as $key => $value) {
//             $sql .= "$key = '" . $value . "',";
//         }
//         $sql = 'UPDATE ' . $table . ' SET ' . trim($sql, ',') . ' WHERE ' . $where;

//         return mysqli_query($this->__conn, $sql);
//     }

//     //delete
//     function remove($table, $where)
//     {
//         $this->connect();
//         $sql = "DELETE FROM $table WHERE $where";
//         return mysqli_query($this->conn, $sql);
//     }
// }

/* 
Phuong thuc
- mo ket noi voi db
- dong ket noi voi db
- chay lenh select: fetch data -> one/all
+ fetch one:
    input: sql select
    process: limit 1 record
    output: 1 record: array
- chay lenh excu: insert, update, delete
    tra ve: true/false
*/