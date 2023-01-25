<?php

class Model_user extends CI_Model{

    function insertUserdata(){
        $firstName = $this->input->post('fname');
        $lastName = $this->input->post('lname');
        $username = $firstName." ".$lastName;
        $data = array(

            'firstname' => $this->input->post('fname',TRUE),
            'lastname' => $this->input->post('lname',TRUE),
            'username' => $username,
            'email' => $this->input->post('email',TRUE),
            'password' => sha1($this->input->post('password',TRUE))
        );
            return $this->db->insert('users',$data);
    }

    function LoginUser() {

        $email =  $this->input->post('email');
        $password = sha1($this->input->post('password'));

        $this->db->where('email',$email);
        $this->db->where('password',$password);

        $respond = $this->db->get('users');
        print_r($respond)
        if ($respond->num_rows()==1){
            return $respond->row(0);
        }else{
            return false;
        }
    }

    function follow_user($followData){
        $data = array(
            'userId' => $followData['userId'],
            'followingUserId' => $followData['followingUserId'],
        );

        return $this->db->insert('followings',$data);
    }

    public function unfollow_user($loggedUserId, $followId){

        $this->db->where('userId',$loggedUserId);
        $this->db->where('followingUserId',$followId);

        $this->db->delete('followings');
        return $this->db->affected_rows();
    }

    function getFollowedStatus($loggedUserId,$userId) {

        $this->db->where('userId',$loggedUserId);
        $this->db->where('followingUserId',$userId);

        $respond = $this->db->get('followings');
        if ($respond->num_rows() >= 1){
            return 'true';
        }else{
            return 'false';
        }
    }

}