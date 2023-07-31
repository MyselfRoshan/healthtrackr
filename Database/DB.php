<?php
class DB {
    protected $conn = null;
    /**
     * Contructor that establishes connection with database
     */
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . 
                                    ";dbname=" . DB_NAME,
                                    DB_USERNAME, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    /**
     * Method to select row/s from database
     */
    static public function select($query = "" , $params = [])
    {
        try {
            $stmt = DB::prepareBindAndExecute( $query, $params );
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);               
            $stmt = null;
 
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
    }
    /**
     * Method to insert a new row in database
     */
    static public function insert($query = "", $params = []){
        try {
            $stmt = DB::prepareBindAndExecute($query, $params);
            $result = $stmt->rowCount();
            $stmt = null;

            return $result;
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }
    }

    /**
     * Method to update a row in database
     */
    static public function update($query = "", $params = []) {
        try {
            $stmt = DB::prepareBindAndExecute($query, $params);
            // $result = $stmt->rowCount();
            $stmt = null;

            return true;
        } catch (Exception $e) {
            throw New Exception($e->getMessage());
        }
    }

    /**
     * Method to delete a row from database
     */
    static public function delete($query = "", $params = []) {
        try {
            $stmt = DB::prepareBindAndExecute($query, $params);
            $result = $stmt->rowCount();
            $stmt = null;

            return $result;
        } catch (Exception $e) {
            throw New Exception($e->getMessage());
        }
    }

    /**
     * Method to prepare, bind and execute the query
     */
    private function prepareBindAndExecute($query = "", $params = []) {
        try {
            $stmt = $this->conn->prepare($query);

            if($stmt === false) {
                throw new PDOException("Unable to prepare the statement.");
            }

            if(count($params) > 0) {
                foreach($params as $key=>$value) {
                    $stmt->bindParam($key, $value[0], $value[1]);
                }
            }

            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
?>