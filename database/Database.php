<?php

namespace Database;

use PDO;
use PDOException;
use Exception;

class Database
{
    protected $con = null;
    /**
     * Contructor that establishes connection with database
     */
    public function __construct()
    {
        try {
            $dsn = DB_DRIVER .
                ":host=" . DB_HOST .
                ";port=" . DB_PORT .
                ";dbname=" . DB_NAME;
            $options =
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ];
            $this->con = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


    /**
     * Method to select row/s from database
     */
    public static function select($query = "", $params = [])
    {
        try {
            $statement = self::prepareBindAndExecute($query, $params);
            return $statement;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }
    /**
     * Method to insert a new row in database
     */
    public static function insert($query = "", $params = [])
    {
        try {
            $statement = self::prepareBindAndExecute($query, $params);
            $result = $statement->rowCount();

            $statement = null;

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Method to update a row in database
     */
    public static function update($query = "", $params = [])
    {
        try {
            $statement = self::prepareBindAndExecute($query, $params);
            $result = $statement->rowCount();
            $statement = null;

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Method to delete a row from database
     */
    public static function delete($query = "", $params = [])
    {
        try {
            $statement = self::prepareBindAndExecute($query, $params);
            $result = $statement->rowCount();
            $statement = null;

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Method to prepare, bind and execute the query
     * @param query sql query string
     * @param params bind parameter to the specified variable name with its tyoe
     *
     * Example: $params = ['param' => [$param_value, PDO::PARAM_STR]]
     */
    private static function prepareBindAndExecute(string $query = "", array $params = [])
    {
        try {
            // creating an instance of a class as cannot call non static property in static function
            $statement = (new self)->con->prepare($query);
            if ($statement === false) {
                throw new PDOException("Unable to prepare the statement.");
            }

            // $params = [VARIABLE_NAME => [VARIABLE_VALUE, VARIBLE_TYPE]];
            if (count($params) > 0) {
                foreach ($params as $param => $values) {
                    $statement->bindParam($param, $values[0], $values[1]);
                }
            }

            $statement->execute();
            return $statement;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
