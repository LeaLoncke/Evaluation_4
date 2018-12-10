<?php

declare(strict_types = 1);

class AccountManager
{
    private $_db;

    public function __construct(PDO $db) {
        $this->setDb($db);
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }

    public function getDb() {
        return $this->_db;
    }

    public function getAccounts() {
        $arrayOfAccounts = [];

        $query = $this->getDb()->query("SELECT * FROM accounts");
        $dataAccounts = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($dataAccounts as $dataAccount) {
            $arrayOfAccounts[] = new Account($dataAccount);
        }

        return $arrayOfAccounts;
    }

    public function getAccount(int $id) {
        $query = $this->getDb()->prepare("SELECT * FROM accounts WHERE id = :id");
        $query->bindValue("id", $id, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll();
        return new Account($data);
    }

    public function addAccount($name) {
        $name = (string) $name;
        $query = $this->getDb()->prepare("INSERT INTO accounts (name, balance) VALUES (:name, :balance)");
        $query->bindValue("name", $name, PDO::PARAM_STR);
        $query->bindValue("balance", 80, PDO::PARAM_INT);
        $query->execute();
    }
    
    public function updateAccount(int $id, int $balance) {
        $query = $this->getDb()->prepare("UPDATE accounts SET balance = :balance WHERE id = :id");
        $query->bindValue("id", $id, PDO::PARAM_INT);
        $query->bindValue("balance", $balance, PDO::PARAM_INT);
        $query->execute();
    }

    public function deleteAccount(int $id) {
        $query = $this->getDb()->prepare("DELETE FROM accounts WHERE id = :id");
        $query->bindValue("id", $id, PDO::PARAM_INT);
        $query->execute();
    }

}
