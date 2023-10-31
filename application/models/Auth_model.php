<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function check_login($client_email, $password)
    {
        $this->db->where('client_email', $client_email);
        $this->db->where('client_password', md5($password)); // You should use a secure hashing method.
        $query = $this->db->get('client_data');

        return $query->num_rows() > 0;
    }

    public function register_user($client_name, $client_email, $client_password) {
        $data = array(
            'client_name' => $client_name,
            'client_email' => $client_email,
            'client_password' => $client_password
        );

        return $this->db->insert('client_data', $data);
    }

    function check_user_exists($client_email){
        return $this->db->get_where('client_data',array('client_email'=>$client_email))->row_array();
    }

    function getProfile($client_id){
        return $this->db->get_where('client_data',array('id'=>$client_id))->row_array();
    }
}   


/* End of file Auth_model.php and path /application/models/Auth_model.php */
