<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        echo "default controller index function.";
    }

    public function login()
    {
        $data = array();

        if ($this->input->post('login')) {
            $client_email = $this->input->post('client_email');
            $client_password = $this->input->post('client_password');

            // var_dump();
            // exit;
            if(!$client = $this->Auth_model->check_user_exists($client_email)){
                $this->session->set_flashdata('error', 'This user does not exists.');
                $this->load->view('login', $data);
                return;
            }
            // print_r($client);
            // exit;
            // Check if the username and password are valid
            if ($this->verify_password($client_email, $client_password)) {
                $this->session->set_userdata('logged_in', TRUE);
                $this->session->set_userdata('client_id', $client->id);
                redirect(base_url('profile')); // Change 'dashboard' to your desired destination after login.
            } else {
                $data['error'] = 'Invalid username or password';
            }
        }

        $this->load->view('login', $data); // Create a login form view
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('auth/login'); // Redirect to the login page after logout.
    }

    function profile() {
        $data = array();
        
        $profile = $this->Auth_model->getProfile();
        $data['profile'] = $profile;
        $this->load->view('profile', $data);
        
    }

    public function register() {
        $data = array();

        if ($this->input->post('register')) {
            $client_name = $this->input->post('client_name');
            $client_email = $this->input->post('client_email');
            $client_password = password_hash($this->input->post('client_password'),PASSWORD_BCRYPT);

            // Call the model function to insert data
            $inserted = $this->Auth_model->register_user($client_name, $client_email, $client_password);

            if ($inserted) {
                $data['success'] = 'Registration successful!';
                $this->load->view('login',$data);
                return;
            } else {
                $data['error'] = 'Registration failed. Please try again.';
            }
        }

        $this->load->view('register', $data); // Create a view for registration success or failure.
        return;
    }

    public function verify_password($client_email, $password) {
        $this->db->select('client_password');
        $this->db->from('client_data');
        $this->db->where('client_email', $client_email);
        $query = $this->db->get();
    
        if ($query->num_rows() === 1) {
            $row = $query->row();
            $hashed_password = $row->client_password;
    
            if (password_verify($password, $hashed_password)) {
                return true; // Passwords match
            }
        }
    
        return false; // Passwords don't match
    }
}

/* End of file Auth.php and path /application/controllers/Auth.php */
