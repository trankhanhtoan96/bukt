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
 * @property Blog_category_model blog_category_model
 * @property Blog_model blog_model
 */
class Blog extends CI_Controller
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

            //get blog category name and assign to html ul li
            $blogCategory = $this->blog_model->getBlogCategory($dataView[$key]['id']);
            $dataView[$key]['blog_category'] = "<ul>";
            foreach ($blogCategory as $item) {
                $category = $this->blog_category_model->get($item['blog_category_id'], 'name');
                $dataView[$key]['blog_category'] .= "<li>{$category['name']}</li>";
            }
            $dataView[$key]['blog_category'] .= "</ul>";
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
        if ($this->input->post('name')) {
            if ($id) {
                $dataEdit = $this->input->post();
                $dataEdit['id'] = $id;

                //rewrite url--------------------------------------------------
                $routerName = rewrite($this->input->post('rewrite_url'));
                if (!$routerName) {
                    $routerName = rewrite($this->input->post('name'));
                }
                if (checkExistRouter($routerName, array($id))) {
                    $i = 0;
                    while (checkExistRouter($routerName . $i, array($id))) $i++;
                    $routerName .= $i;
                }
                $sql = "UPDATE router SET name='{$routerName}' WHERE target_id='{$id}'";
                $this->db->query($sql);

                $this->{$this->router->class . '_model'}->update($dataEdit);

                //insert relationship-------------------------------------------
                $sql = "DELETE FROM blog_category_blog WHERE blog_id='{$id}'";
                $this->db->simple_query($sql);
                foreach ($dataEdit['blog_category'] as $item) {
                    $sql = "INSERT INTO blog_category_blog(id,blog_category_id,blog_id) VALUES('" . createId() . "','{$item}','{$id}')";
                    $this->db->simple_query($sql);
                }

                redirect('/' . $this->router->class . '/detail/' . $id);
            } else {
                $dataEdit = $this->input->post();
                unset($dataEdit['id']);
                $dataId = '';
                $this->{$this->router->class . '_model'}->insert($dataEdit, $dataId);

                //rewrite url-----------------------------------------------
                $routerName = rewrite($this->input->post('rewrite_url'));
                if (!$routerName) {
                    $routerName = rewrite($this->input->post('name'));
                }
                if (checkExistRouter($routerName)) {
                    $i = 0;
                    while (checkExistRouter($routerName . $i)) $i++;
                    $routerName .= $i;
                }
                $routerId = createId();
                $sql = "INSERT INTO router(id,name,target_id) VALUES('{$routerId}','{$routerName}','{$dataId}')";
                $this->db->query($sql);

                //insert relationship--------------------------------------------
                foreach ($dataEdit['blog_category'] as $item) {
                    $sql = "INSERT INTO blog_category_blog(id,blog_category_id,blog_id) VALUES('" . createId() . "','{$item}','{$dataId}')";
                    $this->db->simple_query($sql);
                }

                redirect('/' . $this->router->class . '/detail/' . $dataId);
            }
        }
        $dataView = $this->{$this->router->class . '_model'}->get($id);
        $parent = $this->blog_category_model->get_list('id,name,parent_id');
        $dataView['parent'] = array();
        sortBlogCategory($parent, '0', $dataView['parent']);
        $parentIds = $this->blog_model->getBlogCategory($id);
        $dataView['parent_ids'] = array();
        foreach ($parentIds as $item) {
            $dataView['parent_ids'][] = $item['blog_category_id'];
        }
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

        //rewrite url-------------------------------------------------------------
        $sql = "SELECT name FROM router WHERE target_id='{$id}'";
        $result = $this->db->query($sql)->result_array();
        $dataView['rewrite_url'] = $result[0]['name'];

        //get blog category name and assign to html ul li
        $blogCategory = $this->blog_model->getBlogCategory($id);
        $dataView['blog_category'] = "<ul>";
        foreach ($blogCategory as $item) {
            $category = $this->blog_category_model->get($item['blog_category_id'], 'name');
            $dataView['blog_category'] .= "<li>{$category['name']}</li>";
        }
        $dataView['blog_category'] .= "</ul>";

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

        //delete router
        $sql = "DELETE FROM router WHERE target_id='{$id}'";
        $this->db->query($sql);

        //delete relation ship
        $sql = "DELETE FROM blog_category_blog WHERE blog_id='{$id}'";
        $this->db->query($sql);

        redirect('/' . $this->router->class . '/index');
    }

    function deleteList()
    {
        if (!checkRole($this->router->class . '_delete')) redirect('/', 'refresh');
        if ($recods = $this->input->post('record_selected')) {
            foreach ($recods as $id) {
                //delete router
                $sql = "DELETE FROM router WHERE target_id='{$id}'";
                $this->db->query($sql);

                //delete relation ship
                $sql = "DELETE FROM blog_category_blog WHERE blog_id='{$id}'";
                $this->db->query($sql);

                $this->{$this->router->class . '_model'}->delete($id);
            }
        }
        redirect('/' . $this->router->class . '/index');
    }
}