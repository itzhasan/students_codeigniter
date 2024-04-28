<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentsModel;
use CodeIgniter\HTTP\ResponseInterface;

class StudentsController extends BaseController
{
    private $db;
    private $table;
    private $studentModel;
    public function __construct()
    {
        $this->db = db_connect();
        $this->table = $this->db->table("students");
        $this->studentModel = new StudentsModel();
    }

    public function getStudents()
    {
        $studentObject = new StudentsModel();
        $students = $studentObject->findAll();
        $response = [];
        if (!empty($students)) {
            $response = [
                "status" => true,
                "message" => "done!",
                "data" => $students
            ];
        } else {
            $response = [
                "status" => false,
                "message" => "empty!",
            ];
        }
        return $this->response->setJSON($response);
    }

    public function getStudent($student_id)
    {
        $student = $this->studentModel->find($student_id);
        return $this->response->setJSON($student);
    }
    public function insert()
    {

        $rules = [
            'name' => 'required',
        ];
        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'msg' => $this->validator->getErrors(),
                'data' => []
            ];

        } else {
            $data = [
                'name' => $this->request->getVar('name'),
                'age' => $this->request->getVar('age')
            ];
            if ($this->table->insert($data)) {
                $response = [
                    'status' => true,
                    'msg' => 'done!',
                    'data' => []
                ];

            } else {
                $response = [
                    'status' => false,
                    'msg' => 'false!',
                    'data' => []
                ];
            }
        }
        return $this->response->setJSON($response);
    }
    public function update($student_id)
    {
        $studentObject = new StudentsModel();
        $student = $studentObject->find($student_id);

        if (!empty($student)) {

            $name = $this->request->getVar('name');

            if (isset($name) && !empty($name)) {
                $student->name = $name;
            }
            $age = $this->request->getVar('age');
            if (isset($age) && !empty($age)) {
                $student->age = $age;
            }
            if ($studentObject->update($student_id, $student)) {
                $response = [
                    'status' => true,
                    'msg' => 'updated!',
                ];
            }

        } else {
            $response = [
                "status" => false,
                "message" => "Student not found!",
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete($student_id)
    {
        $studentObject = new StudentsModel();
        $student = $studentObject->find($student_id);
        if (!empty($student)) {
            if ($studentObject->delete($student_id)) {
                $response = [
                    'status' => true,
                ];
            }
        } else {
            $response = [
                "status" => false,
                "message" => "Student not found!",
            ];
        }
        return $this->response->setJSON($response);

    }
}
