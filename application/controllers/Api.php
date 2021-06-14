<?php 
defined('BASEPATH') OR exit('No direct script allowed');

class Api extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel', 'database');
    }

    function show_data($table)
    {
        $query = $this->db->query("SELECT * FROM $table WHERE id_visit = '55679'")->result();

        echo json_encode($query);
    }

    function show_user()
    {
        $query = $this->db->query("SELECT * FROM user")->result();
        echo json_encode($query);
    }

    public function editData()
    {
        $data = [
            'role' => 0,
            'pt'    => 14
        ];

        $this->db->where('id', '1');
        $this->db->update('user', $data);
    }

    public function deleteData($table, $id)
    {
        $this->db->where('id_visit', $id);
        $this->db->delete($table);
    }
}