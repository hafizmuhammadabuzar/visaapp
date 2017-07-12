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
        else{
            $this->session->set_userdata('msg', 'Incorrect username or Password');
            redirect('admin');
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

        $result['visas'] = $this->Home_model->getRecords('visas');

        $this->load->view('admin/header');
        $this->load->view('admin/view_visas', $result);
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
                $this->Home_model->updateVersion();
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
        $this->load->view('admin/add_visa', $result);
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
                $this->Home_model->updateVersion();
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
        if ($res > 0) {
            $this->Home_model->updateVersion();
            $this->session->set_userdata('msg', "Successfully Deleted!");
        }
        else {
            $this->session->set_userdata('msg', "Could not be Deleted!");
        }
        redirect('admin/viewVisas');
    }
    
    function addAR(){
        $this->checkLogin();

        $this->load->view('admin/header');
        $this->load->view('admin/add_ar');
        $this->load->view('admin/footer');
    }

    function viewAR()
    {
        $this->checkLogin();

        $result['ar'] = $this->Home_model->getRecords('static');

        $this->load->view('admin/header');
        $this->load->view('admin/view_ar', $result);
        $this->load->view('admin/footer');
    }

    public function saveAR()
    {
        $this->form_validation->set_rules('arrival', 'On-Arrival', 'required');
        $this->form_validation->set_rules('restriction', 'Restriction', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/addAR');
        }
        else {
            $data = array(
                'on_arrival' => $this->input->post('arrival'),
                'restriction' => $this->input->post('restriction'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->saveRecord('static', $data);

            if ($res > 0) {
                $this->Home_model->updateVersion();
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewAR');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/addAR');
            }
        }
    }

    function editAR($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);
        
        $result['ar'] = $this->Home_model->checkRecord('static', array('id' => $id));
        $this->load->view('admin/header');
        $this->load->view('admin/add_ar', $result);
        $this->load->view('admin/footer');
    }

    public function updateAR()
    {
        $this->form_validation->set_rules('arrival', 'On Arrival', 'required');
        $this->form_validation->set_rules('restriction', 'Restriction', 'required');

        if ($this->form_validation->run() == FALSE) {

            redirect('admin/editAR/' . $_POST['ar_id']);
        }
        else {
            $id = pack("H*", $_POST['ar_id']);

            $data = array(
                'on_arrival' => $this->input->post('arrival'),
                'restriction' => $this->input->post('restriction'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->updateRecord('static', ['id' => $id], $data);

            if ($res > 0) {
                $this->Home_model->updateVersion();
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewAR');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/editAR/' . $_POST['ar_id']);
            }
        }
    }

    function deleteAR($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);

        $res = $this->Home_model->deleteRecord('static', array('id' => $id));
        if ($res > 0) {
            $this->Home_model->updateVersion();
            $this->session->set_userdata('msg', "Successfully Deleted!");
        }
        else {
            $this->session->set_userdata('msg', "Could not be Deleted!");
        }
        redirect('admin/viewAR');
    }
    
    function addCountry(){
        $this->checkLogin();

        $this->load->view('admin/header');
        $this->load->view('admin/add_country');
        $this->load->view('admin/footer');
    }

    function viewCountry()
    {
        $this->checkLogin();

        $result['countries'] = $this->Home_model->getRecords('countries', '', '', 'country_name ASC');

        $this->load->view('admin/header');
        $this->load->view('admin/view_countries', $result);
        $this->load->view('admin/footer');
    }

    public function saveCountry()
    {
        $this->form_validation->set_rules('country', 'Country Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/addCountry');
        }
        else {
            $data = array(
                'country_name' => $this->input->post('country'),
            );

            $res = $this->Home_model->saveRecord('countries', $data);

            if ($res > 0) {
                $this->Home_model->updateVersion();
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewCountry');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/addCountry');
            }
        }
    }

    function editCountry($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);
        
        $result['country'] = $this->Home_model->checkRecord('countries', array('id' => $id));
        $this->load->view('admin/header');
        $this->load->view('admin/add_country', $result);
        $this->load->view('admin/footer');
    }

    public function updateCountry()
    {
        $this->form_validation->set_rules('country', 'Country', 'required');

        if ($this->form_validation->run() == FALSE) {

            redirect('admin/editCountry/' . $_POST['country_id']);
        }
        else {
            $id = pack("H*", $_POST['country_id']);

            $data = array(
                'country_name' => $this->input->post('country'),
            );

            $res = $this->Home_model->updateRecord('countries', ['id' => $id], $data);

            if ($res > 0) {
                $this->Home_model->updateVersion();
                $this->session->set_userdata('msg', "Successfully saved!");
                redirect('admin/viewCountry');
            }
            else {
                $this->session->set_userdata('msg', "Could not be saved!");
                redirect('admin/editCountry/' . $_POST['country_id']);
            }
        }
    }

    function deleteCountry($id)
    {
        $this->checkLogin();
        $id = pack("H*", $id);

        $res = $this->Home_model->deleteRecord('countries', array('id' => $id));
        if ($res > 0) {
            $this->Home_model->updateVersion();
            $this->session->set_userdata('msg', "Successfully Deleted!");
        }
        else {
            $this->session->set_userdata('msg', "Could not be Deleted!");
        }
        redirect('admin/viewCountry');
    }
          
}
