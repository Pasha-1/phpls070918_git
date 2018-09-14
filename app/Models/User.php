<?php
namespace App\Models;
class User extends MainModel
{
    const ADULT_AGE = 18;
    const ASC_SORT = 'ASC';
    const DESC_SORT = 'DESC';
    const ADULT_ALIAS = 'Cовершеннолетний';
    const MINOR_ALIAS = 'Несовершеннолетний';
    public function getAllUsersData()
    {
        $stm = $this->dbConnection->query('SELECT id, name, age, description, img FROM users');
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function getUserDataById($userId)
    {
        $stm = $this->dbConnection->prepare('SELECT id, name, age, description, img FROM users WHERE id=:id');
        $stm->bindParam(':id', $userId, \PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function updateUserDataById($userId, string $name, $age, string $description)
    {
        $sql = 'UPDATE users SET name=:name, age=:age, description=:description WHERE id=:id';
        $stm = $this->dbConnection->prepare($sql);
        $stm->bindParam(':id', $userId, \PDO::PARAM_INT);
        $stm->bindParam(':name', $name, \PDO::PARAM_STR);
        $stm->bindParam(':age', $age, \PDO::PARAM_INT);
        $stm->bindParam(':description', $description, \PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() != 1) {
            return false;
        }
         return true;
    }
    public function getAgeUsersInfo($sortMethod)
    {
        
        $sort = self::ASC_SORT;
        if (mb_strtolower($sortMethod) == mb_strtolower(self::DESC_SORT)) {
            $sort = self::DESC_SORT;
        }
        $sql = 'SELECT id, name, age, description, img, ';
        $sql .= 'IF (age < ' . self::ADULT_AGE . ', \'' . self::MINOR_ALIAS . '\', \'';
        $sql .= self::ADULT_ALIAS . '\') AS adult ';
        $sql .= 'FROM users ORDER BY age ' . $sort;
        $stm = $this->dbConnection->query($sql);
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function updateImg($userId, $img)
    {
        $stm = $this->dbConnection->prepare('UPDATE users SET img=:img WHERE id=:id');
        $stm->bindParam(':id', $userId, \PDO::PARAM_INT);
        $stm->bindParam(':img', $img, \PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() != 1) {
            return false;
        }
        return true;
    }
}