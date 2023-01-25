<?php

class Model_post extends CI_Model{

    public function insert_post($post) {
        $data = array(
            'userId' => $post['userId'],
            'description' => $post['description'],
            'post_image' => $post['post_image'],
            'createddate' => $post['createddate']
            
        );

        $this->db->insert('post', $data);
        return $this->db->affected_rows();
    }

    public function edit_post($post) {
        if ( $post['post_image']) {
            $data = array(
                'userId' => $post['userId'],
                'description' => $post['description'],
                'post_image' => $post['post_image'],
                'createddate' => $post['createddate']    
            );
        } else {
            $data = array(
                'userId' => $post['userId'],
                'description' => $post['description'],
                'createddate' => $post['createddate']    
            );
        }
        

        $this->db->where('postId',$post['postId']);

        $this->db->update('post', $data);
        return $this->db->affected_rows();
    }

    public function delete_post($postId){

        $this->db->where('postId',$postId);

        $this->db->delete('post');
        return $this->db->affected_rows();
    }

    public function getTimelinePosts($userId) {

        $userPosts = array();
        $otherPosts = array();
        $followingsIds = array();
        $this->db->select('post.postId, post.description, users.userId, post.post_image, users.userName, post.createddate ');
        $this->db->from('post');
        $this->db->join('users', 'users.userId = post.userId');
        $this->db->where('users.userId', $userId);
        $this->db->order_by('post.createddate', 'desc');
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $userPosts = $result->result();
        }
        
        $this->db->where('userId',$userId);
        $followings = $this->db->get('followings');

        if ($followings->num_rows() > 0) {
            $records = $followings->result();
            foreach($records as $follow) {
                array_push($followingsIds ,$follow->followingUserId);
                
            }
        }
        if (count($followingsIds)!=0) {
            $this->db->select('post.postId, post.description, users.userId, post.post_image, users.userName, post.createddate ');
            $this->db->from('post');
            $this->db->join('users', 'users.userId = post.userId');
            $this->db->where_in('users.userId', $followingsIds);
            $this->db->order_by('post.createddate', 'desc');
            $timelineResult = $this->db->get();

            if($timelineResult->num_rows() > 0){
                $otherPosts = $timelineResult->result();
            }
        }

        if(count($userPosts)!=0 AND count($otherPosts)!=0) {
            $allPosts = array_merge($userPosts, $otherPosts);

            usort($allPosts, function($a, $b) {
                return strtotime($b->createddate) - strtotime($a->createddate);
            });

            return $allPosts;
        } elseif(count($userPosts)!=0 AND count($otherPosts)==0) {
            return $userPosts;
        } elseif(count($userPosts)==0 AND count($otherPosts)!=0) {
            return $otherPosts;
        } else {
            return null;
        }

    }

    public function getUserPosts($userId) {

        $userPosts = array();
        $otherPosts = array();
        $this->db->select('post.postId, post.description, users.userId, post.post_image, users.userName, post.createddate ');
        $this->db->from('post');
        $this->db->join('users', 'users.userId = post.userId');
        $this->db->where('users.userId', $userId);
        $this->db->order_by('post.createddate', 'desc');
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $userPosts = $result->result();
        }

        return $userPosts;

    }

    public function getOtherUsersAllPosts($userId) {

        $userPosts = array();
        $ignore = array($userId);
        $this->db->select('post.postId, post.description, users.userId, post.post_image, users.userName, post.createddate ');
        $this->db->from('post');
        $this->db->join('users', 'users.userId = post.userId');
        $this->db->where_not_in('users.userId', $ignore);
        $this->db->order_by('post.createddate', 'desc');
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $userPosts = $result->result();
        }


        return $userPosts;

    }

    function getPostById($postId){

        $this->db->where('postId',$postId);

        $respond = $this->db->get('post');
        if ($respond->num_rows()==1){
            return $respond->row(0);
        }else{
            return false;
        }
    }

}