<?php

declare(strict_types = 1);

class Account
{
    protected $id,
              $name,
              $balance;

    public function __construct(array $data = []) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {

            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Setters
    public function setId($id) {
        $id = (int) $id;
        $this->id = $id;
        return $this;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function setBalance($balance) {
        $balance = (int) $balance;
        $this->balance = $balance;
        return $this;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getBalance() {
        return $this->balance;
    }

    // Other functions
    public function debit(int $balance) {
        $actualBalance = $this->getBalance();
        $actualBalance -= $balance;
        $this->setBalance($actualBalance);
        return $actualBalance;
    }

    public function credit(int $balance) {
        $actualBalance = $this->getBalance();
        $actualBalance += $balance;
        $this->setBalance($actualBalance);
        return $actualBalance;
    }

    public function transfer(int $idDebit, int $idCredit, int $balance) {
        
    }

}
