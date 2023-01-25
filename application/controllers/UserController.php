<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function RegisterUser() {
		$this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passwordagain', 'Again Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('Register');
        }
        else {

            $this->load->model('Model_user');
            $response = $this->Model_user->insertUserdata();
            if ($response){

                $this->session->set_flashdata('msg','Registered Successfully..please Login');
                redirect('Home/Login');
            }else {
                $this->session->set_flashdata('msg','something went wrong');
                redirect('Home/Register');
            }

        }
	}

    public function LoginUser() {

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('Login');
        }
        else {

            $this->load->model('Model_user');
            $result = $this->Model_user->LoginUser();

            if ($result != false){

                $user_data = array(
                    'userId'=>$result->userId,
                    'username'=>$result->username,
                    'email'=>$result->email,
                    'loggedin'=>TRUE
                );

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('welocme','Welcome back');
                redirect('PostController/userTimeLine');

            } else {

                $this->session->set_flashdata('errmsg','Wrong email and password');
                redirect('Home/Login');

            }
        }
    }

    public function LogoutUser() {

        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('loggedin');
        redirect('Home/Login');
    }

    public function followUser($followId) {
        $followData = array(
            'userId' => $this->session->userdata('userId'),
            'followingUserId' => $followId,
        );
        $result = $this->Model_user->follow_user($followData);
        redirect('PostController/viewUserProfile/'.$followId);
 
	}

    public function unfollowUser($followId) {
        $loggedUserId = $this->session->userdata('userId');
        $result = $this->Model_user->unfollow_user($loggedUserId, $followId);
        redirect('PostController/viewUserProfile/'.$followId);
 
	}

}
