<?php

class EmployeesController extends Controller
{
    private $db;
    private $Connection;

    public function __construct()
    {
        //require_once __DIR__ . "/../core/Database.php";

       // $employee = $this->loadModel('employee');
        $this->db = new Database();
        $this->Connection = $this->db->Connection();
    }

    public function index()
    {
        $employee = $this->loadModel("employee",$this->Connection);

        $data['employees'] = $employee->getAll();
        $data['title'] = "PHP app";

        $this->view("employee/index.view", $data);
    }

    public function details($id)
    {
        $employee = $this->loadModel("employee",$this->Connection);

        $data['employee'] = $employee->getById($id);
        $data['title'] = "PHP app | User Details";

        $this->view("employee/details.view", $data);
    }

    public function create()
    {
        if (isset($_POST["name"])) {

//            $employee = new Employee($this->Connection);
            $employee = $this->loadModel("employee",$this->Connection);
            $employee->setName($_POST["name"]);
            $employee->setSurname($_POST["surname"]);
            $employee->setEmail($_POST["email"]);
            $employee->setphone($_POST["phone"]);
            $save = $employee->save();
        }
        header('Location:' .ROOT. 'index.view.php');
    }


    public function update()
    {
        if (isset($_POST["id"])) {

//            $employee = new Employee($this->Connection);
            $employee = $this->loadModel("employee",$this->Connection);
            $employee->setId($_POST["id"]);
            $employee->setName($_POST["name"]);
            $employee->setSurname($_POST["surname"]);
            $employee->setEmail($_POST["email"]);
            $employee->setphone($_POST["phone"]);
            $save = $employee->update();
        }
        header('Location:' .ROOT. 'index.view.php');
    }

    public function delete($id)
    {
        $employee = $this->loadModel("employee",$this->Connection);

        $data['employee'] = $employee->deleteById($id);
        $data['title'] = "PHP app";
        header('Location:' .ROOT. 'index.view.php');
    }


}
