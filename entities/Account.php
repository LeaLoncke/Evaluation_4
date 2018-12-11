<?php

declare(strict_types = 1);

class Account
{
    protected $id,
              $name,
              $balance;

    /**
     * Constructor
     * 
     * @param array $data
     */
    public function __construct(array $data = []) {
        $this->hydrate($data);
    }

    /**
     * Hydratation
     * 
     * @param array $array
     */
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {

            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Set the value of id
     * 
     * @param int $id
     * @return self
     */
    public function setId($id) {
        $id = (int) $id;
        $this->id = $id;
        return $this;
    }

    /**
     * Set the value of name
     * 
     * @param string $name
     * @return self
     */
    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Set the value of balance
     * 
     * @param int $balance
     * @return self
     */
    public function setBalance($balance) {
        $balance = (int) $balance;
        $this->balance = $balance;
        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName() {
        return $this->name;
    }
    /**
     * Get the value of balance
     */
    public function getBalance() {
        return $this->balance;
    }

    /**
     * Debit an account
     * 
     * @param int $balance
     * @return int $actualBalance
     */
    public function debit(int $balance) {
        $actualBalance = $this->getBalance();
        $actualBalance -= $balance;
        $this->setBalance($actualBalance);
        return $actualBalance;
    }

    /**
     * Credit an account
     * 
     * @param int $balance
     * @return int $actualBalance
     */
    public function credit(int $balance) {
        $actualBalance = $this->getBalance();
        $actualBalance += $balance;
        $this->setBalance($actualBalance);
        return $actualBalance;
    }

}
