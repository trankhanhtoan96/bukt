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
 * @property Mail mail
 * @property Email_template_model email_template_model
 * @property Email_sent_model email_sent_model
 * @property Email_sent_user_model email_sent_user_model
 * @property Email_sent_email_model email_sent_email_model
 */
class Public_action extends CI_Controller
{
    function check_read_email($email_address, $email_sent_id)
    {
        $email_address = urldecode($email_address);
        //tabel email_sent_user
        $sql = "SELECT esu.id
                FROM user as u
                INNER JOIN email_sent_user as esu on u.id=esu.user_id
                INNER JOIN email_sent as es on es.id=esu.email_sent_id
                WHERE u.email='{$email_address}' AND esu.email_sent_id='{$email_sent_id}'";
        $result = $this->db->query($sql)->result_array();
        if (count($result) == 1) {
            $data = array(
                'id'=>$result[0]['id'],
                'status'=>'read',
                'date_modifiled'=>date("Y-m-d H:i:s")
            );
            $this->email_sent_user_model->update($data);
        } else {

            //table email_sent_email
            $sql = "SELECT ese.id
                FROM email as e
                INNER JOIN email_sent_email as ese on e.id=ese.email_id
                INNER JOIN email_sent as es on es.id=ese.email_sent_id
                WHERE e.email_address='{$email_address}' AND ese.email_sent_id='{$email_sent_id}'";
            $result = $this->db->query($sql)->result_array();
            if (count($result) == 1) {
                $data = array(
                    'id'=>$result[0]['id'],
                    'status'=>'read',
                    'date_modifiled'=>date("Y-m-d H:i:s")
                );
                $this->email_sent_email_model->update($data);
            }
        }
    }
}