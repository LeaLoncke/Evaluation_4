<?php

declare(strict_types = 1);

class AccountManager
{
    private $_db;

    /**
     * Constructor
     * 
     * @param PDO $db
     */
    public function __construct(PDO $db) {
        $this->setDb($db);
    }

    /**
     * Set the value of database
     * 
     * @param PDO $db
     */
    public function setDb(PDO $db) {
        $this->_db = $db;
    }

    /**
     * Get the value of database
     */
    public function getDb() {
        return $this->_db;
    }

    /**
     * Get all the accounts in the database
     * 
     * @return array $arrayOfAccounts
     */
    public function getAccounts() {
        $arrayOfAccounts = [];

        $query = $this->getDb()->query("SELECT * FROM accounts");
        $dataAccounts = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($dataAccounts as $dataAccount) {
            $arrayOfAccounts[] = new Account($dataAccount);
        }

        return $arrayOfAccounts;
    }

    /**
     * Get an account according to the id sent as parameter
     * 
     * @param int $id
     * @return Account
     */
    public function getAccount(int $id) {
        $query = $this->getDb()->prepare("SELECT * FROM accounts WHERE id = :id");
        $query->bindValue("id", $id, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return new Account($data);
    }

    /**
     * Add an account in the database
     * 
     * @param string $name
     */
    public function addAccount(string $name) {
        $query = $this->getDb()->prepare("INSERT INTO accounts (name, balance) VALUES (:name, :balance)");
        $query->bindValue("name", $name, PDO::PARAM_STR);
        $query->bindValue("balance", 80, PDO::PARAM_INT);
        $query->execute();
    }
    
    /**
     * Update an account in the database
     * 
     * @param int $id
     * @param int $balance
     */
    public function updateAccount(int $id, int $balance) {
        $query = $this->getDb()->prepare("UPDATE accounts SET balance = :balance WHERE id = :id");
        $query->bindValue("id", $id, PDO::PARAM_INT);
        $query->bindValue("balance", $balance, PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * Delete an account in the database
     * 
     * @param int $id
     */
    public function deleteAccount(int $id) {
        $query = $this->getDb()->prepare("DELETE FROM accounts WHERE id = :id");
        $query->bindValue("id", $id, PDO::PARAM_INT);
        $query->execute();
    }

}
