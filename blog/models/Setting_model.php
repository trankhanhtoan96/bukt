<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Setting_model
 * @property CI_DB $db
 */
class Setting_model extends CI_Model
{
    private $data = array();
    private $tableName = 'setting';

    /**
     * Setting_model constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->db->reset_query();
        $this->db->from($this->tableName);
        $result = $this->db->get();
        $result = $result->result_array();
        foreach ($result as $row) {
            $this->data[$row['name']] = $row['value'];
        }
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        if (!empty($this->data[$name])) return $this->data[$name];
        return null;
    }

    /**
     * @return array
     */
    function get_list()
    {
        return $this->data;
    }
}