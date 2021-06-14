<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagination extends CI_Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pagination'
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('pagination/sample');
        $this->load->view('layout/footer');
    }

    public function loadRecord($page = 0)
    {
        $per_page = 8;
        $id = $_SESSION['pt'];

        $start = $page;
        if ($page != 0) {
            $page = ($page - 1) * $page;
        }

        $query = $this->db->query('SELECT nama, hp, id_visit FROM visit WHERE pt = ' . $id);
        $count = $query->num_rows();

        $this->db->limit($per_page, $page);
        $this->db->where('pt', $id);
        $result = $this->db->get('visit')->result();

        $config['base_url'] = base_url() . 'pagination/loadRecord';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $count;
        $config['per_page'] = $per_page;

        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $result;
        $data['row'] = $page;

        echo json_encode($data);
    }
}
