<?php

class Employee
{
    private $table = "employees";
    private $Connection;
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;

    public function __construct($Connection)
    {
        $this->Connection = $Connection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function save()
    {
        $stmt = $this->Connection->prepare("INSERT INTO " . $this->table . "(name,surname,email,phone)
        VALUES (:name,:surname,:email,:phone)");
        $result = $stmt->execute([
            "name" => $this->name,
            "surname" => $this->surname,
            "email" => $this->email,
            "phone" => $this->phone
        ]);
        $this->Connection = null;
        return $result;
    }

    public function update()
    {
        $stmt = $this->Connection->prepare("
        UPDATE " . $this->table . "
        SET
        name = :name,
        surname = :surname,
        email = :email,
        phone = :phone
        WHERE id = :id
        ");

        $results = $stmt->execute([
            "id" => $this->id,
            "name" => $this->name,
            "surname" => $this->surname,
            "email" => $this->email,
            "phone" => $this->phone
        ]);
        $this->Connection = null;
        return $results;
    }

    public function getAll()
    {
        $stmt = $this->Connection->prepare("SELECT id,name,surname,email,phone FROM " . $this->table);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $this->Connection = null;
        return $results;
    }

    public function getById($id)
    {
        $stmt = $this->Connection->prepare("SELECT id,name,surname,email,phone
        FROM " . $this->table . "  WHERE id = :id");

        $stmt->execute([
            "id" => $id
        ]);

        $results = $stmt->fetchObject();
        $this->Connection = null;
        return $results;
    }

    public function getBy($column, $value)
    {
        $stmt = $this->Connection->prepare("SELECT id,name,surname,email,phone
        FROM " . $this->table . " WHERE :column = :value");
        $stmt->execute([
            "column" => $column,
            "value" => $value
        ]);
        $results = $stmt->fetchAll();
        $this->Connection = null;
        return $results;
    }

    public function deleteById($id)
    {
        try {
            $stmt = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
            $stmt->execute([
                "id" => $id
            ]);
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteById): ' . $e->getMessage();
            return false;
        }
    }

    public function deleteBy($column, $value)
    {
        try {
            $stmt = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE :column = :value");
            $stmt->execute([
                "column" => $value,
                "value" => $value,
            ]);
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteBy): ' . $e->getMessage();
            return false;
        }
    }
}

