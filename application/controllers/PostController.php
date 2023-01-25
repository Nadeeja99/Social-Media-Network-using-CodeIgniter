<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostController extends CI_Controller {

    public function createPost() {
		$this->load->view('CreatePost');
	}

    public function editPost($postId) {
        $userPost = $this->Model_post->getPostById($postId);
        $this->load->view('EditPost', array('userPost' => $userPost));
	}

    public function submitNewPost() {
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';

        $this->load->library('upload',$config);
        $data = $this->upload->data();
        if ($this->upload->do_upload('postimg')) {
            $postData = array(
                'userId' => $this->session->userdata('userId'),
                'description' => $this->input->post('description'),
                'post_image' => $this->upload->data()['file_name'],
                'createddate' => date("Y-m-d h:i:sa")
            );
            $result = $this->Model_post->insert_post($postData);
            $this->userTimeLine();
        } else {
            $this->load->view('CreatePost');
        }
    }

    
    public function edit_post($postId){
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';

        $this->load->library('upload',$config);
        $data = $this->upload->data();
        if ($this->upload->do_upload('updateimg')) {
            $postData = array(
                'postId' => $postId,
                'userId' => $this->session->userdata('userId'),
                'description' => $this->input->post('description'),
                'post_image' => $this->upload->data()['file_name'],
                'createddate' => date("Y-m-d h:i:sa")
            );
            $result = $this->Model_post->edit_post($postData);
            $this->userProfileView();
        } else {
            $postData = array(
                'postId' => $postId,
                'userId' => $this->session->userdata('userId'),
                'description' => $this->input->post('description'),
                'post_image' => null,
                'createddate' => date("Y-m-d h:i:sa")
            );
            $result = $this->Model_post->edit_post($postData);
            $this->userProfileView();
        }
    }

    public function delete_post($postId){
        $result = $this->Model_post->delete_post($postId);
        
        $this->userProfileView();
    }

    public function userTimeLine() {

        $userId = $this->session->userdata('userId');
        $timelinePostsResult = $this->Model_post->getTimelinePosts($userId);
        $this->load->view('UserTimeLine', array('timelinePosts' => $timelinePostsResult));
    }

    public function getAllUserPost() {

        $userId = $this->session->userdata('userId');
        $timelinePostsResult = $this->Model_post->getOtherUsersAllPosts($userId);
        $this->load->view('UserTimeLine', array('timelinePosts' => $timelinePostsResult));
    }

    public function userPosts() {

        $userId = $this->session->userdata('userId');
        $userPosts = $this->Model_post->getUserPosts($userId);
        $this->load->view('UserProfile', array('userPosts' => $userPosts));
    }

    public function userProfileView()
	{
		$this->userPosts();
	}

    public function viewUserProfile($userId) {

        $loggedUserId = $this->session->userdata('userId');
        if ($userId == $loggedUserId) {
            $userPosts = $this->Model_post->getUserPosts($loggedUserId);
            $this->load->view('UserProfile', array('userPosts' => $userPosts));
        } else {
            $data['viewUserId'] = $userId;
            $data['isFollowed'] = $this->Model_user->getFollowedStatus($loggedUserId,$userId);
            $data['userPosts'] = $this->Model_post->getUserPosts($userId);
            $this->load->view('ViewProfile', array('data' => $data));
        }
       
    }

}
