<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Home_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        
        define('error', 'Error');
        define('success', 'Success');
    }
    
    private function checkLogin(){
        
        if($this->session->userdata('admin_login') == FALSE){
            $this->session->set_userdata('msg', 'You are not Logged In, Please login first');
            redirect('admin');
        }
    }
    
    public function index(){
        
        $this->load->view('admin/header');
        $this->load->view('admin/login');
        $this->load->view('admin/footer');
    }
    
    public function login(){

        if($_POST['username'] == 'admin' && $_POST['password'] == 'admin'){
            $this->session->set_userdata('admin_login', 'visa-admin');
            redirect('admin/dashboard');
        }
    }
    
    public function logout(){

        $this->session->unset_userdata('admin_login');
        session_destroy();
        redirect('admin');
    }
    
    public function dashboard(){        
        $this->checkLogin();
        
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }
    
    function addVisa(){
        $this->checkLogin();

        $this->load->view('admin/header');
        $this->load->view('admin/add_visa');
        $this->load->view('admin/footer');
    }

    function viewVisas()
    {
        $this->checkLogin();

        $result['areas'] = $this->Admin_model->getAllAreas();

        $this->load->view('admin/header');
        $this->load->view('admin/viewVisas', $result);
        $this->load->view('admin/footer');
    }

    public function saveVisa()
    {
        $this->form_validation->set_rules('days', 'Days', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('steps', 'Steps', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/addVisa');
        }
        else {
            $data = array(
                'days' => $this->input->post('days'),
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'steps' => $this->input->post('steps'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->saveRecord('visas', $data);

            if ($res > 0) {
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewVisas');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/addVisa');
            }
        }
    }

    function editVisa($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);
        
        $result['visa'] = $this->Home_model->checkRecord('visas', array('id' => $id));
        $this->load->view('admin/header');
        $this->load->view('admin/addVisa', $result);
        $this->load->view('admin/footer');
    }

    public function updateVisa()
    {
        $this->form_validation->set_rules('days', 'Days', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('steps', 'Steps', 'required');

        if ($this->form_validation->run() == FALSE) {

            redirect('admin/editVisa/' . $_POST['visa_id']);
        }
        else {
            $id = pack("H*", $_POST['visa_id']);

            $data = array(
                'days' => $this->input->post('days'),
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'steps' => $this->input->post('steps'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->updateRecord('visas', ['id' => $id], $data);

            if ($res > 0) {
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewVisas');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/editVisa/' . $_POST['area_id']);
            }
        }
    }

    function deleteVisa($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);

        $res = $this->Home_model->deleteRecord('visas', array('id' => $id));
        if ($res) {
            $this->session->set_userdata('msg', "Successfully Deleted!");
        }
        else {
            $this->session->set_userdata('msg', "Could not be Deleted!");
        }
        redirect('admin/viewVisas');
    }
          
}
