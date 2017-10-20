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
 */
class Development extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //check login and redirect to login if not yet
        if (!$this->session->has_userdata('userLogined')) redirect('admin.php/login', 'refresh');
    }

    function index()
    {
        if (!checkRole('', true)) redirect('/', 'refresh');
        echo "<form acton='' method='post'><input type='text' name='module_name' /></form>";
        if ($moduleName = $this->input->post('module_name')) {
            $name = ucfirst(trim($moduleName));
            if ($name == '') die('please input module name!');

            //controller
            $data = file_get_contents(APPPATH . 'core/template/controller.php');
            $data = str_replace('class Controller extends CI_Controller', "class {$name} extends CI_Controller", $data);
            file_put_contents(APPPATH . 'controllers/' . $name . '.php', $data, FILE_APPEND | LOCK_EX);

            //model
            $data = file_get_contents(APPPATH . 'core/template/model.php');
            $data = str_replace('class Model extends CI_Model', "class {$name}_model extends CI_Model", $data);
            $data = str_replace("private \$tableName = 'table';", "private \$tableName = '" . strtolower($name) . "';", $data);
            file_put_contents(APPPATH . 'models/' . $name . '_model.php', $data, FILE_APPEND | LOCK_EX);

            //autoload
            $data = "\n\n//auto_generate_{$name}\n\$autoload['model'][] = '" . strtolower($name) . "_model';\n//auto_generate_{$name}";
            file_put_contents(APPPATH . 'config/autoload.php', $data, FILE_APPEND | LOCK_EX);

            //view
            mkdir(APPPATH . 'views/' . strtolower($name));
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/edit.css', '', FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/edit.js', '', FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/detail.css', '', FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/detail.js', '', FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/list.css', '', FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/list.js', '', FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/list_subpanel.js', '', FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/list_subpanel.css', '', FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/edit.php', file_get_contents(APPPATH . 'core/template/edit.php'), FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/detail.php', file_get_contents(APPPATH . 'core/template/detail.php'), FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/list.php', file_get_contents(APPPATH . 'core/template/list.php'), FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/menu_edit.php', file_get_contents(APPPATH . 'core/template/menu_edit.php'), FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/menu_detail.php', file_get_contents(APPPATH . 'core/template/menu_detail.php'), FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/menu_list.php', file_get_contents(APPPATH . 'core/template/menu_list.php'), FILE_APPEND | LOCK_EX);
            file_put_contents(APPPATH . 'views/' . strtolower($name) . '/list_subpanel.php', file_get_contents(APPPATH . 'core/template/list_subpanel.php'), FILE_APPEND | LOCK_EX);

            //create database
            $fields = array(
                'id' => array(
                    'type' => 'varchar',
                    'constraint' => 36
                ),
                'date_entered' => array(
                    'type' => 'datetime'
                ),
                'date_modifiled' => array(
                    'type' => 'datetime'
                ),
                'user_created' => array(
                    'type' => 'varchar',
                    'constraint' => 36
                ),
                'user_modifiled' => array(
                    'type' => 'varchar',
                    'constraint' => 36
                ),
                'name' => array(
                    'type' => 'varchar',
                    'constraint' => 255
                )
            );
            $this->load->dbforge();
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(strtolower($name), true);

            //update main menu
            $data = "\n<!--auto_generate_{$name}-->
<?php if(checkRole('".strtolower($name)."_edit') || checkRole('".strtolower($name)."_view')): ?>
<li><a><i class='fa fa-cube'></i><?= lang('" . strtolower($name) . "') ?><span class='fa fa-chevron-down'></span></a>
<ul class='nav child_menu'>
<?php if(checkRole('".strtolower($name)."_edit')): ?>
<li><a href='<?= base_url('admin.php/" . strtolower($name) . "/edit') ?>'><?= lang('create') ?></a></li>
<?php endif; ?>
<?php if(checkRole('".strtolower($name)."_view')): ?>
<li><a href='<?= base_url('admin.php/" . strtolower($name) . "/index') ?>'><?= lang('list') ?></a></li>
<?php endif; ?>
</ul>
</li>
<?php endif; ?>
<!--auto_generate_{$name}-->";
            file_put_contents(APPPATH . 'views/menu.php', $data, FILE_APPEND | LOCK_EX);

            echo 'tạo thành công module có tên:[' . $name . "]\nvui lòng tạo language: [" . strtolower($name) . "] và [create_" . strtolower($name) . "]";
        }
    }

    function delete($name)
    {
        if (!checkRole('', true)) redirect('/', 'refresh');
        $name = ucfirst($name);

        $data = file_get_contents(APPPATH . 'config/autoload.php');
        $a = "\n\n//auto_generate_{$name}\n\$autoload['model'][] = '" . strtolower($name) . "_model';\n//auto_generate_{$name}";
        $data = str_replace($a, '', $data);
        file_put_contents(APPPATH . 'config/autoload.php', $data);


        $a = "\n<!--auto_generate_{$name}-->
<?php if(checkRole('".strtolower($name)."_edit') || checkRole('".strtolower($name)."_view')): ?>
<li><a><i class='fa fa-cube'></i><?= lang('" . strtolower($name) . "') ?><span class='fa fa-chevron-down'></span></a>
<ul class='nav child_menu'>
<?php if(checkRole('".strtolower($name)."_edit')): ?>
<li><a href='<?= base_url('admin.php/" . strtolower($name) . "/edit') ?>'><?= lang('create') ?></a></li>
<?php endif; ?>
<?php if(checkRole('".strtolower($name)."_view')): ?>
<li><a href='<?= base_url('admin.php/" . strtolower($name) . "/index') ?>'><?= lang('list') ?></a></li>
<?php endif; ?>
</ul>
</li>
<?php endif; ?>
<!--auto_generate_{$name}-->";
        $data = file_get_contents(APPPATH . 'views/menu.php');
        $data = str_replace($a, '', $data);
        file_put_contents(APPPATH . 'views/menu.php', $data);

        if (is_dir(APPPATH . 'views/' . strtolower($name) . '/')) {
            delete_files(APPPATH . 'views/' . strtolower($name) . '/');
            rmdir(APPPATH . 'views/' . strtolower($name) . '/');
        }
        if (is_file(APPPATH . 'controllers/' . $name . '.php')) {
            unlink(APPPATH . 'controllers/' . $name . '.php');
        }
        if (is_file(APPPATH . 'models/' . $name . '_model.php')) {
            unlink(APPPATH . 'models/' . $name . '_model.php');
        }

        //delete table
        $this->load->dbforge();
        $this->dbforge->drop_table(strtolower($name),true);

        echo "success!\n<a href='".site_url()."'>".lang('come_back_home')."</a>";
    }
}