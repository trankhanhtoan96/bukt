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
 * @property User_model user_model
 * @property CI_Router router
 * @property Email_model email_model
 * @property Role_model role_model
 * @property Email_template_model email_template_model
 * @property Email_sent_model email_sent_model
 * @property Email_sent_user_model email_sent_user_model
 * @property Email_sent_email_model email_sent_email_model
 * @property Setting_model setting_model
 */
class Email extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('userLogined')) redirect('/login', 'refresh');
    }

    function index()
    {
        if (!checkRole($this->router->class . '_view')) redirect('/', 'refresh');
        $dataView = $this->{$this->router->class . '_model'}->get_list();
        foreach ($dataView as $key => $value) {
            $dataView[$key]['user_created'] = $this->user_model->get($dataView[$key]['user_created']);
            $dataView[$key]['user_modifiled'] = $this->user_model->get($dataView[$key]['user_modifiled']);
        }
        $data = array(
            'meta_title' => lang($this->router->class),
            'data_header' => lang($this->router->class),
            'data' => $dataView
        );

        //load view to display
        $this->load->view($this->router->class . '/list', $data);
    }

    function edit($id = '')
    {
        if (!checkRole($this->router->class . '_edit')) redirect('/', 'refresh');
        if ($this->input->post('email_address')) {
            if ($id) {
                $dataEdit = $this->input->post();
                $dataEdit['id'] = $id;
                $this->{$this->router->class . '_model'}->update($dataEdit);
                redirect('/' . $this->router->class . '/detail/' . $id);
            } else {
                $dataEdit = $this->input->post();
                unset($dataEdit['id']);
                $dataId = '';
                $this->{$this->router->class . '_model'}->insert($dataEdit, $dataId);
                redirect('/' . $this->router->class . '/detail/' . $dataId);
            }
        }
        $dataView = $this->{$this->router->class . '_model'}->get($id);
        if ($id == '') $dataView['validation'] = '1';
        $data = array(
            'meta_title' => $id ? $dataView['name'] : lang($this->router->class),
            'data_header' => $id ? lang($this->router->class) . ':' . $dataView['name'] : lang('create_' . $this->router->class),
            'data_id' => $id,
            'data' => $dataView
        );
        $this->load->view($this->router->class . '/edit', $data);
    }

    function detail($id = '')
    {
        if (!checkRole($this->router->class . '_view')) redirect('/', 'refresh');
        if ($id == '') redirect('/' . $this->router->class . '/index');
        $dataView = $this->{$this->router->class . '_model'}->get($id);
        unset($dataView['id']);
        $dataView['user_created'] = $this->user_model->get($dataView['user_created']);
        $dataView['user_modifiled'] = $this->user_model->get($dataView['user_modifiled']);
        $data = array(
            'meta_title' => $dataView['name'],
            'data_header' => lang($this->router->class) . ':' . $dataView['name'],
            'data_id' => $id,
            'data' => $dataView
        );
        $this->load->view($this->router->class . '/detail', $data);
    }

    function delete($id = '')
    {
        if (!checkRole($this->router->class . '_delete')) redirect('/', 'refresh');
        $this->{$this->router->class . '_model'}->delete($id);
        redirect('/' . $this->router->class . '/index');
    }

    function deleteList()
    {
        if (!checkRole($this->router->class . '_delete')) redirect('/', 'refresh');
        if ($recods = $this->input->post('record_selected')) {
            foreach ($recods as $id) {
                $this->{$this->router->class . '_model'}->delete($id);
            }
        }
        redirect('/' . $this->router->class . '/index');
    }

    function send_mail($email_template_id = '')
    {
        if (!checkRole('email_send_mail')) redirect('/', 'refresh');

        //send mail when submit
        if ($this->input->post('subject')) {

            //lưu email gởi
            $dataEmailSent = array(
                'name' => $this->input->post('subject'),
                'content' => $this->input->post('body_email')
            );
            $idEmailSent = '';
            $this->email_sent_model->insert($dataEmailSent, $idEmailSent);

            //tiến hành gởi mail
            $this->load->library('email');
            $sendSuccess = 0;
            $sendError = 0;
            $addressTO = explode(',', $this->input->post('email_to'));
            foreach ($addressTO as $address) {
                $address = trim($address);
                if ($this->email->mailer->addAddress($address)) {
                    $this->email->mailer->Subject = $this->input->post('subject');
                    $this->email->mailer->Body = $this->input->post('body_email');
                    $this->email->mailer->Body .= $this->setting_model->get('mail_signature');
                    $this->email->mailer->Body .= "<img style='width:0;height:0' src='" . site_url('public_action/check_read_email/' . urlencode($address) . '/' . $idEmailSent) . "' />";
                    if ($this->email->mailer->send()) {
                        $sendSuccess++;
                        $this->saveEmailRelationship($idEmailSent, $address, 'sent');
                        //lưu quan hệ
                    } else {
                        $sendError++;

                        //lưu quan hệ
                        $this->saveEmailRelationship($idEmailSent, $address, 'sent_error');
                    }

                    //xóa email đã gởi để add email mới cho lần gởi tiếp theo
                    $this->email->mailer->clearAddresses();
                } else {
                    $sendError++;

                    //lưu quan hệ
                    $this->saveEmailRelationship($idEmailSent, $address, 'sent_error');
                }
            }

            //thông báo ra màn hình
            if ($sendSuccess > 0) {
                $alert = $this->load->view('alert/success', array('message' => lang('send_mail_success') . ' : ' . $sendSuccess), true);
            }
            if ($sendError > 0) {
                $alert = $this->load->view('alert/error', array('message' => lang('send_mail_error') . ':' . $sendError), true);
            }
        }

        $dataView = array();

        //table_user_email
        $users = $this->user_model->get_list();
        $dataTableUserEmail = array(
            'dataTbody' => array(),
            'dataIds' => array()
        );
        foreach ($users as $item) {
            $dataTableUserEmail['dataTbody'][] = array(
                $item['first_name'] . ' ' . $item['last_name'],
                $item['email'],
                $item['admin'] == 1 ? 1 : $this->role_model->get($item['role_id'], 'name')['name']
            );
            $dataTableUserEmail['dataIds'][] = $item['id'];
        }
        $dataView['table_user_email'] = $this->load->view('email/template/table_user', $dataTableUserEmail, true);

        //table_email
        $users = $this->email_model->get_list();
        $dataTableEmail = array(
            'dataTbody' => array(),
            'dataIds' => array()
        );
        foreach ($users as $item) {
            $dataTableEmail['dataTbody'][] = array(
                $item['name'],
                $item['email_address']
            );
            $dataTableEmail['dataIds'][] = $item['id'];
        }
        $dataView['table_email'] = $this->load->view('email/template/table_email', $dataTableEmail, true);

        //email template
        if ($email_template_id != '') {
            $emailTemplate = $this->email_template_model->get($email_template_id);
            $dataView['subject'] = $emailTemplate['name'];
            $dataView['body_email'] = $emailTemplate['content'];
        }

        $data = array(
            'meta_title' => lang('send_mail'),
            'data_header' => lang('send_mail'),
            'data_id' => '',
            'alert' => !empty($alert) ? $alert : '',
            'data' => $dataView
        );
        $this->load->view('email/send_mail', $data);
    }

    //filter user on ajax so return json
    function filter_duplicate()
    {
        if (!checkRole('email_filter_duplicate')) redirect('/', 'refresh');
        $emails = $this->email_model->get_list('id, email_address', array(), 'date_modifiled', 'ASC');
        $emailUser = $this->user_model->get_list('email');
        $temp = array();
        foreach ($emailUser as $item) {
            $temp[] = $item['email'];
        }
        $emailUser = $temp;

        for ($i = 0; $i < count($emails) - 1; $i++) {
            $temp = subArray($emails, $i + 1, count($emails) - 1);
            $a = array();
            foreach ($temp as $item) {
                $a[] = $item['email_address'];
            }
            if (in_array($emails[$i]['email_address'], $a)) {
                $this->email_model->delete($emails[$i]['id']);
                unset($emails[$i]);
                $i--;
            } else {
                //kiểm tra trùng với email của user
                if (in_array($emails[$i]['email_address'], $emailUser)) {
                    $this->email_model->delete($emails[$i]['id']);
                    unset($emails[$i]);
                    $i--;
                }
            }
        }
        if (in_array($emails[$i]['email_address'], $emailUser)) {
            $this->email_model->delete($emails[$i]['id']);
            unset($emails[$i]);
            $i--;
        }
        echo json_encode(array(
            'success' => 1
        ));
    }

    //filter use on ajax so return json
    function filter_valid_email()
    {
        if (!checkRole('email_filter_valid_email')) redirect('/', 'refresh');
        require_once 'vendors/PHPMailer/PHPMailer.php';
        $emails = $this->email_model->get_list('id, email_address');
        foreach ($emails as $item) {
            if (!\PHPMailer\PHPMailer\PHPMailer::validateAddress($item['email_address'])) {
                $this->email_model->delete($item['id']);
            }
        }
        echo json_encode(array(
            'success' => 1
        ));
    }

    function saveEmailRelationship($idEmailSent, $email_address, $status)
    {
        //lưu quan hệ
        $sql = "SELECT id FROM user WHERE email='{$email_address}'";
        $result = $this->db->query($sql)->result_array();
        if (count($result) > 0) {
            foreach ($result as $userId) {
                $dataTemp = array(
                    'user_id' => $userId['id'],
                    'email_sent_id' => $idEmailSent,
                    'status' => $status
                );
                $this->email_sent_user_model->insert($dataTemp);
            }
        } else {

            //lưu quan hệ với danh sách email
            $sql = "SELECT id FROM email WHERE email_address='{$email_address}'";
            $result = $this->db->query($sql)->result_array();
            if (count($result) > 0) {
                foreach ($result as $emailId) {
                    $dataTemp = array(
                        'email_id' => $emailId['id'],
                        'email_sent_id' => $idEmailSent,
                        'status' => $status
                    );
                    $this->email_sent_email_model->insert($dataTemp);
                }
            }
        }
    }
}