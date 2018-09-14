<?php
namespace App\Models;
class File extends MainModel
{
    public function getFilesById($userId)
    {
        $stm = $this->dbConnection->prepare('SELECT id, file FROM files WHERE user_id=:user_id');
        $stm->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    public function addImg($userId, $file)
    {
        $stm = $this->dbConnection->prepare('INSERT INTO files (user_id, file) VALUES (:user_id, :file)');
        $stm->bindParam(':user_id', $userId, \PDO::PARAM_STR);
        $stm->bindParam(':file', $file, \PDO::PARAM_STR);
        $stm->execute();
        if ($stm->rowCount() != 1) {
            return false;
        }
        return true;
    }
}