<?php
include "db.php";
class Student
{
    private $table = "studenttable";
    private $name;
    private $department;
    private $age;
    public function setValue($name, $department, $age)
    {
        $this->name = $name;
        $this->department = $department;
        $this->age = $age;
    }

    public function insertData()
    {
        $sql = "INSERT INTO $this->table(name, department, age) VALUES (:name, :department, :age)";
        $stmt = DB::getConnection($sql);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":age", $this->age);
        return $stmt->execute();
    }

    public function readAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = DB::getConnection($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function readByID($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = DB::getConnection($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function updateData($id)
    {
        $sql = "UPDATE $this->table SET name = :name, department = :department, age = :age WHERE id = :id";
        $stmt = DB::getConnection($sql);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function deleteData($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = DB::getConnection($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
