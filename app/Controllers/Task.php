<?php

namespace App\Controllers;
use App\Models\Taskmodel;

class Task extends BaseController {
    private $postRequest;
    private $session;
    private $Taskmodel;

    public function __construct() {
        helper('utility_helpers');
        $this->postRequest = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->Taskmodel = new Taskmodel();
    }

    public function SaveTaskResponse() {
        $requestJson = $this->postRequest->getJSON();

        $data = [
            'TaskID'        => $requestJson->taskNo,
            'task_response' => $requestJson->taskResponse
        ];

        $insertedID = $this->Taskmodel->InsertData('tbl_task_response', $data);

        if ($insertedID) {
            $this->Taskmodel->UpdateData(['TaskID' => $requestJson->taskNo], 'tbl_task_list', ['task_status' => 3]);
            return $this->response
                        ->setStatusCode(200)
                        ->setJSON(['message' => 'Task response successfully added.',
                                    'RecID'  => $insertedID]);
        } else {
            return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Task response could not be added.']);
        }
    }

    public function UploadTaskDocument() {
        $folder = create_folder();
        $path = './TaskDocuments/' . $folder;

        $fileFields = [
            'Document'
        ];

        if (!is_dir($path)) {
            if (mkdir($path, 0777, true)) {
                foreach ($fileFields as $field) {

                    $file = $this->postRequest->getFile($field);

                    if ($file && $file->getSize() > 0) {
                        $fileName = uniqid() . '.' . $file->getExtension();
                        $file->move($path, $fileName);
                    } 
                }

                $fields = [
                    'RecID' => $this->request->getPost('RecID')
                ];
                
                $data = [
                    'doc_folder' => $folder,
                    'doc_name' => $fileName
                ];

                if ($this->Taskmodel->UpdateData($fields, 'tbl_task_response', $data)) {
                    return $this->response
                                ->setStatusCode(200)
                                ->setJSON(['message' => 'Task response successfully added.']);
                } else {
                    return $this->response
                                ->setStatusCode(500)
                                ->setJSON(['error' => 'Task response could not be added.']);
                }
            }
        }
    }

    public function GetPendingTaskList() {
        $UserID = $this->session->get('session_userno'); 
        
        return json_encode($this->Taskmodel->GetPendingTaskList($UserID));
    }

    public function GetCompletedTaskList() {
        $UserID = $this->session->get('session_userno'); 
        
        return json_encode($this->Taskmodel->GetCompletedTaskList($UserID));
    }
    
    public function GetTaskDetails() {
        $requestJson = $this->postRequest->getJSON();

        return json_encode($this->Taskmodel->GetTaskDetails($requestJson->taskNo));
    }
}
