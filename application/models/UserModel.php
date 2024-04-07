<?php 
class UserModel extends CI_Model{
    
    function getAllUsers(){
        $users = $this->db->get('users')->result_array();
        return $users;
    }

    function create($formArray){
       $result = $this->db->insert('users', $formArray); //insert into user table

       return $result;
    }


    function getUser($userId){
        $this->db->where('user_id', $userId);
        $user = $this->db->get('users')->row_array();
        return $user;   
    }

    function updateUser($userId, $formArray){
       $result = $this->db->where('user_id', $userId)->update('users', $formArray);
      
       return $result;

    }

    function deleteUser($userId){
        $this->db->where('user_id', $userId);
        $result = $this->db->delete('users');

        return $result;
    }
}
?>