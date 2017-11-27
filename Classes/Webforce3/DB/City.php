<?php

namespace Classes\Webforce3\DB;

use Classes\Webforce3\Config\Config;
use Classes\Webforce3\Exceptions\InvalidSqlQueryException;

class City extends DbObject {
    /** @var string */
    protected $name;
    /** @var Country */
    protected $country;
    
    
    public function __construct($id=0, $name='', $inserted='', $country=null) {
        $this->name = $name;
        if(empty($country)){
            $this->country = new Country();
        }else{
            $this->country = $country;
        }
        
        echo ("inserted vaut {$inserted}<br>"); // DEBUG
        
        parent::__construct($id, $inserted);
    } // fin du constructeur de la Classe City
    
    
    /**
     * @param int $id
     * @return DbObject
     */
    public static function get($id) {
        $sql = '
            SELECT cit_id, cit_name, cit_inserted, country_cou_id
            FROM city
            WHERE cit_id = :id;
        ';
        echo $sql; // DEBUG
        $stmt = Config::getInstance()->getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        echo "<br> J'ai selectionné la cité ayant pour id {$id}<br>"; // DEBUG

        if ($stmt->execute() === false) {
            throw new InvalidSqlQueryException($sql, $stmt);
        }
        else {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!empty($row)) {
                echo "<br>Je vais créer un currentObject de la Classe City, avec cit_id={$row['cit_id']} et cit_name={$row['cit_name']}<br>"; // DEBUG
                $currentObject = new City(
                    $row['cit_id'],
                    $row['cit_name'],
                    $row['cit_inserted'],    
                    new Country($row['country_cou_id'])
                );
                return $currentObject;
            }
        }

        return false;
    } // fin de la méthode get($id) de la Classe City

    /**
     * @return DbObject[]
     */
    public static function getAll() {
        // TODO: Implement getAll() method.
    } // fin de la méthode getAll() de la Classe City

    /**
     * @return array
     */
    public static function getAllForSelect() {
        $returnList = array();

        $sql = '
            SELECT cit_id, cit_name, country_cou_id
            FROM city
            WHERE cit_id > 0
            ORDER BY cit_name ASC
        ';
        $stmt = Config::getInstance()->getPDO()->prepare($sql);
        if ($stmt->execute() === false) {
            print_r($stmt->errorInfo());
        }
        else {
            $allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($allDatas as $row) {
                $returnList[$row['cit_id']] = $row['cit_name'];
            }
        }

        return $returnList;
    } // fin de la méthode getAllForSelect() de la Classe City

    /**
     * @return bool
     */
    public function saveDB() {
        if ($this->id > 0) {
            $sql = '
                UPDATE city
                SET cit_name = :name,
                country_cou_id = :country
                WHERE cit_id = :id
            ';
            $stmt = Config::getInstance()->getPDO()->prepare($sql);
            $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
            print_r($this->name);
            $stmt->bindValue(':name', $this->name);
            $stmt->bindValue(':country', $this->country->getId());

            if ($stmt->execute() === false) {
                throw new InvalidSqlQueryException($sql, $stmt);
            }
            else {
                    return true;
            }
        } // fin du cas UPDATE dans saveDB()
        else {
            $sql = '
                INSERT INTO city (cit_name)
                VALUES (:name)
            ';
            $stmt = Config::getInstance()->getPDO()->prepare($sql);
            $stmt->bindValue(':name', $this->name);

            if ($stmt->execute() === false) {
                throw new InvalidSqlQueryException($sql, $stmt);
            }
            else {
                $this->id = Config::getInstance()->getPDO()->lastInsertId();
                return true;
            }
        } // fin du cas INSERT dans saveDB()

        return false;
    } // fin de la méthode saveDB() de la Classe City

    /**
     * @param int $id
     * @return bool
     */
    public static function deleteById($id) {
        // TODO: Implement deleteById() method.
    }

    function getName() {
        return $this->name;
    }

        
    /**
     * @return Country
     */
    public function getCountry() {
            return $this->country;
    } // fin de la méthode getCountry() de la Classe City
    
    
} // end of Class City