<?php
namespace App\Models;
class Autorization extends MainModel
{
    public function checkUserByCookieHash($userId, $hash)
    {
        $stm = $this->dbConnection->prepare('SELECT id FROM users WHERE id=:id AND hash=:hash');
        $stm->bindParam(':id', $userId, \PDO::PARAM_INT);
        $stm->bindParam(':hash', $hash, \PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchColumn();
        return $result;
    }
    public function checkUserByPassword($name, $password)
    {
        $stm = $this->dbConnection->prepare('SELECT id FROM users WHERE LOWER(name)=:name AND pswhash=:pswhash');
        $stm->bindParam(':name', $name, \PDO::PARAM_STR);
        $stm->bindParam(':pswhash', $password, \PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchColumn();
        return $result;
    }
    public function setCookieHash($userID, $hash)
    {
        $stm = $this->dbConnection->prepare('UPDATE users SET hash=:hash WHERE id=:id');
        $stm->bindParam(':id', $userID, \PDO::PARAM_INT);
        $stm->bindParam(':hash', $hash, \PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() != 1) {
            return false;
        }
        return true;
    }
    public function checkUserByLowerName($name)
    {
        $stm = $this->dbConnection->prepare('SELECT id FROM users WHERE LOWER(name)=:name');
        $stm->bindParam(':name', $name, \PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchColumn();
        return $result;
    }
    public function addNewUser($name, $age, $password)
    {
        $stm = $this->dbConnection->prepare('INSERT INTO users (name, age, pswhash) VALUES (:name, :age, :pswhash)');
        $stm->bindParam(':name', $name, \PDO::PARAM_STR);
        $stm->bindParam(':age', $age, \PDO::PARAM_INT);
        $stm->bindParam(':pswhash', $password, \PDO::PARAM_STR);
        $stm->execute();
        return $this->dbConnection->lastInsertId();
    }
}