<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Encryption $encryption
 * @property CI_Upload $upload
 * @property CI_Form_validation $form_validation
 * @property CI_FTP $ftp
 * @property CI_Image_lib image_lib
 * @property CI_Input $input
 * @property CI_Javascript $javascript
 * @property CI_Lang $lang
 * @property CI_Loader $load
 * @property CI_DB_forge $dbforge
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Security $security
 * @property CI_Session $session
 * @property CI_Table $table
 * @property CI_URI $uri
 * @property CI_User_agent $agent
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 * @property CI_DB $db
 * @property User_model $user_model
 */
class Login extends CI_Controller
{
    public function index()
    {
        $data = array();
        if ($this->session->has_userdata('userLogined')) redirect('/home', 'refresh');
        if ($this->input->post('username', true) != '' && $this->input->post('password', true) != '') {
            $data = array(
                'username' => $this->input->post('username', true),
                'password' => $this->input->post('password', true)
            );
            if ($this->user_model->verify($data['username'], $data['password'])) {
                $data = $this->user_model->getByUsername($data['username']);
                $this->session->set_userdata('userLogined', $data);
                set_cookie('userLogined',$data['id'],86400);
                redirect('/home', 'refresh');
            } else {
                $data['alert'] = $this->load->view('alert/error', array('message' => lang('error_username_or_password')), true);
            }
        }
        $this->load->view('login/index', $data);
    }

    function logout()
    {
        $this->session->unset_userdata('userLogined');
        set_cookie('userLogined',0,86400);
        redirect('/login', 'refresh');
    }
}
