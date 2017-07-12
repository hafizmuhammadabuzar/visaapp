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
        
        define('error', 'Error');
        define('success', 'Success');
    }
    
    private function checkLogin(){
        
        if($this->session->userdata('admin_login') == FALSE){
            $this->session->set_userdata('admin_login', 'You are not Logged In, Please login first');
            redirect('admin/index');
        }
    }
    
    public function index(){
        
        $this->load->view('admin/header');
        $this->load->view('admin/login');
        $this->load->view('admin/footer');
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
        $this->form_validation->set_rules('area', 'Area Name', 'required');
        $this->form_validation->set_rules('polygon', 'Polygon', 'required');

        if ($this->form_validation->run() == FALSE) {

            redirect('admin/addVisa');
        }
        else {
            $area_data = array(
                'area' => $this->input->post('area'),
                'polygon' => $this->input->post('polygon'),
                'is_restricted' => $this->input->post('restricted'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->saveRecord('areas', $area_data);

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

        $result['area'] = $this->Home_model->checkRecord('areas', array('area_id' => $id));
        $this->load->view('admin/header');
        $this->load->view('admin/addVisa', $result);
        $this->load->view('admin/footer');
    }

    public function updateVisa()
    {

        $this->form_validation->set_rules('area', 'Area Name', 'required');
        $this->form_validation->set_rules('polygon', 'Polygon', 'required');

        if ($this->form_validation->run() == FALSE) {

            redirect('admin/editVisa/' . $_POST['area_id']);
        }
        else {
            $id = pack("H*", $_POST['area_id']);

            $area_data = array(
                'area' => $this->input->post('area'),
                'polygon' => $this->input->post('polygon'),
                'is_restricted' => $this->input->post('restricted'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $res = $this->Home_model->updateRecord('areas', ['area_id' => $id], $area_data);

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

        $res = $this->Home_model->deleteRecord('areas', array('area_id' => $id));
        if ($res) {
            $this->session->set_userdata('msg', "Successfully Deleted!");
        }
        else {
            $this->session->set_userdata('msg', "Could not be Deleted!");
        }
        redirect('admin/viewVisas');
    }
          
}
