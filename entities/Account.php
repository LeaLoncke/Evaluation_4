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
    public function debit(int $accountId, int $balance) {
        
    }

    public function payment(int $accountId, int $balance) {
        
    }

    public function transfer(int $idDebit, int $idPayment, int $balance) {
        
    }

}
