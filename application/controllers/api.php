<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Home_model');
        $this->load->library('form_validation');
        
        define('error', 'Error');
        define('success', 'Success');
    }
    
    public function admin(){
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }

    public function getList(){

        $version = $this->input->get_post('version');
        $checkVersion = $this->Home_model->getRecords('version');

        if($version < $checkVersion[0]['version'] || empty($version)){
            $select = array('days', 'type', 'price', 'description', 'steps');
            $visas = $this->Home_model->getRecords('visas', $select);
            $countries = $this->Home_model->getRecords('countries', array('country_name'), 'country_name ASC');
            $static = $this->Home_model->getRecords('static');

            $result['status'] = success;
            $result['msg'] = 'Visas List';
            $result['version'] = $checkVersion[0]['version'];
            $result['visas'] = $visas;
            $result['on_arrival'] = $static[0]['on_arrival'];
            $result['restriction'] = $static[0]['restriction'];
            $result['countries'] = $countries;
        }
        else{
            $result['status'] = success;
            $result['msg'] = 'No updates';
        }
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}
