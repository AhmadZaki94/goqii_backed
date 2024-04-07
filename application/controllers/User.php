<?php 
class User extends CI_controller{

    function getAllUsers(){
        $this->load->model('UserModel');
        $users = $this->UserModel->getAllUsers();
        
        if($users){
            $this->output->set_status_header(200);
            $data['status'] = 'success';
            $data['message'] = 'Users found';
            $data['data'] = $users;
        }
        else{
            $this->output->set_status_header(404);
            $data['status'] = 'error';
            $data['message'] = 'No users found';
            $data['data'] = [];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    function createUser(){
       $this->load->model('UserModel');
       
       $formArray = array();
       $formArray['name'] = $this->input->post('name');
       $formArray['email'] = $this->input->post('email');
       $formArray['password'] = $this->input->post('password');
       $formArray['dob'] = $this->input->post('dob');

       $createUser = $this->UserModel->create($formArray);
    
       if($createUser)
       {
        $data = array(
            'status' => 'success',
            'message' => 'User created successfully',
        );
       }
       else{
        $data = array(
            'status' => 'error',
            'message' => 'Something went wrong',
        );
       }
       $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    function editUser($userId){
        $this->load->model('UserModel');
        $user = $this->UserModel->getUser($userId);
        $formArray = array();

        if($this->input->post('name') != ''){
            $formArray['name'] = $this->input->post('name');
        }
        else{
            $formArray['name'] = $user['name'];
        }

        if($this->input->post('email') != ''){
            $formArray['email'] = $this->input->post('email');    
        }
        else{
            $formArray['email'] = $user['email'];
        }

        if($this->input->post('dob') != ''){
            $formArray['dob'] = $this->input->post('dob');    
        }
        else{
            $formArray['dob'] = $user['dob'];
        }

        $updateUser = $this->UserModel->updateUser($userId, $formArray);

        if($updateUser)
        {
         $data = array(
             'status' => 'success',
             'message' => 'User updated successfully',
             'Data' => $formArray
         );
        }
        else{
         $data = array(
             'status' => 'error',
             'message' => 'Something went wrong',
         );
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
    }

    function deleteUser($userId){
        $this->load->Model('UserModel');

        $deleteUser = $this->UserModel->deleteUser($userId);

        if($deleteUser)
        {
         $data = array(
             'status' => 'success',
             'message' => 'User is Deleted successfully',
         );
        }
        else{
         $data = array(
             'status' => 'error',
             'message' => 'user not found',
         );
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
?>