<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class User_model
 * @property CI_DB $db
 */
class User_model extends CI_Model
{
    private $tableName = 'user';
    private $fields = array();

    function __construct()
    {
        parent::__construct();
        $this->fields = $this->db->list_fields($this->tableName);
    }

    /**
     * @param string $select
     * @param string $orderBy
     * @param string $direction [ACS,DESC]
     * @param int $limit
     * @param int $ofset
     * @return array
     */
    function get_list($select = '*', $orderBy = 'date_entered', $direction = 'DESC', $limit = 0, $ofset = 0)
    {
        $this->db->reset_query();
        $this->db->select($select);
        $this->db->from($this->tableName);
        if ($orderBy != '' && $direction != '') {
            $this->db->order_by($orderBy, $direction);
        }
        if ($limit != 0) {
            $this->db->limit($limit, $ofset);
        }
        return $this->db->get()->result_array();
    }

    /**
     * @param $id
     * @param string $select
     * @return array
     */
    function get($id, $select = '*')
    {
        $this->db->reset_query();
        $this->db->select($select);
        $this->db->from($this->tableName);
        $this->db->where('id', $id);
        $result = $this->db->get();
        $arr = array();
        if ($result->num_rows() == 1) {
            $arr = $result->result_array();
            $arr = $arr[0];
        }
        return $arr;
    }

    function getByUsername($userName, $select = '*')
    {
        $this->db->reset_query();
        $this->db->select($select);
        $this->db->from($this->tableName);
        $this->db->where('username', $userName);
        $result = $this->db->get();
        $arr = array();
        if ($result->num_rows() == 1) {
            $arr = $result->result_array();
            $arr = $arr[0];
        }
        return $arr;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    function verify($username, $password)
    {
        $this->db->reset_query();
        $this->db->select('password');
        $this->db->where('username', $username);
        $this->db->from($this->tableName);
        $result = $this->db->get();
        if ($result->num_rows() == 1) {
            $row = $result->result_array();
            $row = $row[0];
            if (password_verify($password, $row['password'])) return true;
        }
        return false;
    }
}