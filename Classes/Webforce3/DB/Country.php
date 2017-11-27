<?php

namespace Classes\Webforce3\DB;

use Classes\Webforce3\Config\Config;
use Classes\Webforce3\Exceptions\InvalidSqlQueryException;

class Country extends DbObject {
    /** @var string */
	protected $name;
    /**
     * @param int $id
     * @return DbObject
     */
    
    public function __construct($id=0, $name='', $inserted='') {
        $this->name = $name;
	parent::__construct($id, $inserted);
    } // fin du constructeur de la Classe Country
        
        
    public static function get($id) {
        $sql = '
            SELECT cou_id, cou_name, cou_inserted
            FROM country
            WHERE cou_id = :id;
        ';
        echo $sql; // DEBUG
        $stmt = Config::getInstance()->getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        echo "<br> J'ai selectionné le pays ayant pour id {$id}<br>"; // DEBUG

        if ($stmt->execute() === false) {
            throw new InvalidSqlQueryException($sql, $stmt);
        }
        else {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!empty($row)) {
                echo "<br>Je vais créer un currentObject de la Classe Country, avec cou_id={$row['cou_id']} et cou_name={$row['cou_name']}<br>"; // DEBUG
                $currentObject = new Country(
                    $row['cou_id'],
                    $row['cou_name']
                );
                return $currentObject;
            }
        }

        return false;
    } // fin de la méthode get($id) de la Classe Country

    /**
     * @return DbObject[]
     */
    public static function getAll() {
            // TODO: Implement getAll() method.
    }

    /**
     * @return array
     */
    public static function getAllForSelect() {
            $returnList = array();

            $sql = '
                    SELECT cou_id, cou_name
                    FROM country
                    WHERE cou_id > 0
                    ORDER BY cou_name ASC
            ';
            $stmt = Config::getInstance()->getPDO()->prepare($sql);
            if ($stmt->execute() === false) {
                    print_r($stmt->errorInfo());
            }
            else {
                    $allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    foreach ($allDatas as $row) {
                            $returnList[$row['cou_id']] = $row['cou_name'];
                    }
            }

            return $returnList;
    } // fin de la méthode getAllForSelect() de la Classe Country

    /**
     * @return bool
     */
    public function saveDB() {
        if ($this->id > 0) {
            $sql = '
                UPDATE country
                SET cou_name = :name
                WHERE cou_id = :id
            ';
            $stmt = Config::getInstance()->getPDO()->prepare($sql);
            $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
            $stmt->bindValue(':name', $this->name);

            if ($stmt->execute() === false) {
                throw new InvalidSqlQueryException($sql, $stmt);
            }
            else {
                    return true;
            }
        } // fin du cas UPDATE dans saveDB()
        else {
            $sql = '
                INSERT INTO country (cou_name)
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
    } // fin de la méthode saveDB() de la Classe Country
    
    /**
     * @param int $id
     * @return bool
     */
    public static function deleteById($id) {
        $sql = '
            DELETE FROM country WHERE cou_id = :id
        ';
        $stmt = Config::getInstance()->getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute() === false) {
            print_r($stmt->errorInfo());
        }
        else {
            return true;
        }
        return false;
    }
    
    
    /**
     * @return string
     */
    public function getName() {
            return $this->name;
    } // fin de la méthode getname() de la Classe country

} // end of Class Country