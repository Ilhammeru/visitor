<?php
defined('BASEPATH') or exit('No direct script allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel', 'database');
    }

    public function index()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['role'] < 3) {
                $data = [
                    'title' => 'Dashboard',
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('home/dashboard');
                $this->load->view('layout/footer');
            } else if ($_SESSION['role'] == 5) {
                redirect('rekap');
            } else {
                $data = [
                    'title'     => 'Data visitor',
                    'visit'     => ambilData('visit')->result(),
                    'jumlah'    => ambilData('visit')->num_rows(),
                    'pt'        => ambilDataDb('we', 'ansena_department')->result(),
                    'marketing' => ambilDataEmpat('ac_payroll_item')->result(),
                    'brand'     => ambilDataDb('we', 'ansena_franchise_list')->result(),
                    'department'    => ambilDataDbWhere('we', 'ansena_department')->result(),
                    'alasan'        => ambilWhere(array('role'  => 1), 'alasan')->result(),
                    'jAlasan'       => ambilData('alasan')->num_rows()
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('visitor/visitor', $data);
                $this->load->view('layout/footer');
            }
        } else {
            redirect('dashboard/redirect');
        }
    }

    public function redirect()
    {
        $this->load->view('errors/error');
    }

    public function ambilDataUtama()
    {
        $no = $this->input->post('no');
        $hasil = $this->db->query('SELECT hp, nama FROM visit WHERE hp = ' . $no)->result();
        echo json_encode($hasil);
    }

    public function find_data($border = '', $key = '', $type = '', $page = '')
    {
        //regex 
        $str = $key;
        $pattern = "/%20/i";
        $match = preg_match($pattern, $str);

        if ($match > 0) {
            $newKey = preg_replace($pattern, ' ', $str);
        } else {
            $newKey = $key;
        }

        // ################################################## condition pagination ######################################################## //

        $perPage = 10;
        if ($page > 0) {
            $page = ($page - 1) * $perPage;
        }

        // ################################################## end condition pagination ######################################################## //

        // ################################################## get array couple of data in array ######################################################## //

        //brand array 
        $brandArray = array();
        $queryBrand = "SELECT id_franchise, nama_franchise 
                            FROM ansena_franchise_list";

        //pt array 
        $ptArray = array();
        $queryPt = "SELECT id, name
                        FROM ansena_department 
                        WHERE income = 1";
        $resultPt = $this->database->getData($queryPt, 'we')->result();

        foreach ($resultPt as $rpt) {
            $ptArray['p' . $rpt->id] = $rpt->name;
        }

        //marketing array 
        $marketingArray = array();
        $queryMar = "SELECT id, name
                        FROM ac_payroll_item
                        WHERE is_active = 1";

        $resultMar = $this->database->getData($queryMar, 'we')->result();
        foreach ($resultMar as $mar) {
            $marketingArray['m' . $mar->id] = $mar->name;
        }

        // ################################################## end get array couple of data in array ######################################################## //



        // ################################################## condition of input search ######################################################## //

        $sessPt = $_SESSION['pt'];
        if ($type == 'hp') {

            if ($sessPt == '41') {
                $query = "SELECT nama, brand, hp, tanggal_input, marketing, alasan, kategori, pt, is_close, tanggal_join, id_visit, prospek
                                FROM visit 
                                WHERE hp LIKE '%$newKey%'
                                AND pt = $sessPt
                                ORDER BY tanggal_input DESC
                                LIMIT $page, $perPage";

            } else {
                $query = "SELECT nama, brand, hp, tanggal_input, marketing, alasan, kategori, pt, is_close, tanggal_join, id_visit, prospek
                                FROM visit 
                                WHERE hp LIKE '%$newKey%'
                                ORDER BY tanggal_input DESC
                                LIMIT $page, $perPage";
            }

            $queryAll = "SELECT tanggal_input
                            FROM visit 
                            WHERE hp LIKE '%$newKey%'";

            $targetTanggal = 0;

            $resultTanggal = $this->database->getData($queryAll, 'visit')->result();

            foreach ($resultTanggal as $t) {
                $newTanggal[] = date('d M Y', strtotime($t->tanggal_input));
            }

            $result = $this->database->getData($query, 'visit');
            $rows = $this->database->getData($queryAll, 'visit')->num_rows();
        } else if ($type == 'name') {
            if ($sessPt == '41') {
                $query = "SELECT nama, brand, hp, tanggal_input, marketing, alasan, kategori, pt, is_close, tanggal_join, id_visit, prospek
                                FROM visit 
                                WHERE nama LIKE '%$newKey%'
                                AND pt = $sessPt
                                ORDER BY tanggal_input DESC
                                LIMIT $page, $perPage";
            } else {
                $query = "SELECT nama, brand, hp, tanggal_input, marketing, alasan, kategori, pt, is_close, tanggal_join, id_visit, prospek
                                FROM visit 
                                WHERE nama LIKE '%$newKey%'
                                ORDER BY tanggal_input DESC
                                LIMIT $page, $perPage";
            }

            $queryAll = "SELECT tanggal_input
                            FROM visit 
                            WHERE nama LIKE '%$newKey%'";

            $targetTanggal = 0;

            $resultTanggal = $this->database->getData($queryAll, 'visit')->result();

            foreach ($resultTanggal as $t) {
                $newTanggal[] = date('d M Y', strtotime($t->tanggal_input));
            }

            $result = $this->database->getData($query, 'visit');
            $rows = $this->database->getData($queryAll, 'visit')->num_rows();
        } else if ($type == 'brand') {

            if ($_SESSION['pt'] == '41' || $str == 'pola kain' || $str == 'Pola kain') {
                $idPt = '41';
                $ptHelper = '41';
            } else {
                $dbQuery = "SELECT db FROM ansena_department WHERE income = 1";
                $resultDbQuery = $this->database->getData($dbQuery, 'we')->result();

                foreach ($resultDbQuery as $x) {
                    $dbList[] = $x->db;
                }

                $querySpesial = "SELECT id_franchise
                                FROM ansena_franchise_list
                                WHERE nama_franchise LIKE '%$newKey%'";

                function arr_filter($value)
                {
                    return $value != 0;
                }


                $jumlah = array();
                for ($i = 0; $i < count($dbList); $i++) {
                    $resultSpesial = $this->database->getData($querySpesial, $dbList[$i]);
                    $jumlah[] = $resultSpesial->num_rows();
                }

                $newJumlah = array_filter($jumlah, 'arr_filter');
                $arrKey = array_keys($newJumlah);
                $selectedDb = $dbList[$arrKey[0]];

                //get pt with db name 
                $queryHelper = $this->db->query("SELECT pt 
                                                FROM user 
                                                WHERE db = '$selectedDb'")->row_array();
                $ptHelper = $queryHelper['pt'];

                $spesial = $this->database->getData($querySpesial, $selectedDb)->row_array();
                $idPt = $spesial['id_franchise'];
            }

            $today = date('Y-m-d');
            $first_month = date('Y-m-d', strtotime('-30 day'));
            $second_month = date('Y-m-d', strtotime('-60 day'));
            $third_month = date('Y-m-d', strtotime('-90 day'));

            if ($border != '') {
                switch ($border) {
                    case '1':
                        $where = "AND prospek = 1 AND tanggal_input >= '$first_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($first_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '2':
                        $where = "AND prospek = 1 AND tanggal_input >= '$second_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($second_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '3':
                        $where = "AND prospek = 1 AND tanggal_input >= '$third_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($third_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '4':
                        $where = "AND prospek = 1";
                        $targetTanggal = 0;
                        break;

                    case '5':
                        $where = "AND prospek = 2 AND tanggal_input >= '$first_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($first_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '6':
                        $where = "AND prospek = 2 AND tanggal_input >= '$second_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($second_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '7':
                        $where = "AND prospek = 2 AND tanggal_input >= '$third_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($third_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '8':
                        $where = "AND prospek = 2";
                        $targetTanggal = 0;
                        break;

                    case '9':
                        $where = "AND prospek = 3 AND tanggal_input >= '$first_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($first_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '10':
                        $where = "AND prospek = 3 AND tanggal_input >= '$second_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($second_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '11':
                        $where = "AND prospek = 3 AND tanggal_input >= '$third_month' AND tanggal_input <= '$today'";
                        $targetTanggal = date('d M Y', strtotime($third_month)) . ' - ' . date('d M Y', strtotime($today));
                        break;

                    case '12':
                        $where = "AND prospek = 3";
                        $targetTanggal = 0;

                    case '0':
                        $where = ' AND brand = ' . $idPt;
                        break;

                    default:
                        # code...
                        break;
                }
            } else {
                $where = ' AND brand = ' . $idPt;
            }

            $query = "SELECT nama, brand, hp, tanggal_input, marketing, alasan, kategori, pt, is_close, tanggal_join, id_visit, prospek
                            FROM visit 
                            WHERE brand = $idPt
                            $where
                            AND pt = $ptHelper
                            ORDER BY tanggal_input DESC
                            LIMIT $page, $perPage";

            $queryAll = "SELECT tanggal_input
                            FROM visit 
                            WHERE brand = $idPt
                            $where
                            AND pt = $ptHelper";

            $resultTanggal = $this->database->getData($queryAll, 'visit')->result();

            foreach ($resultTanggal as $t) {
                $newTanggal[] = date('d M Y', strtotime($t->tanggal_input));
            }

            $result = $this->database->getData($query, 'visit');
            $rows = $this->database->getData($queryAll, 'visit')->num_rows();
        }

        // ################################################## end condition of input search ######################################################## //


        // ################################################## get result data ######################################################## //

        if ($result->num_rows() > 0) {
            //get the db connection for get the brand name
            foreach ($result->result() as $row) {
                $sessionPt = $_SESSION['pt'];

                if ($row->pt != '41') {
                    $queryDb = "SELECT db FROM ansena_department WHERE id = $row->pt";

                    $resultDb = $this->database->getData($queryDb, 'we')->result();
                    foreach ($resultDb as $rd) {
                        $resultBrand = $this->database->getData($queryBrand, $rd->db);

                        foreach ($resultBrand->result() as $rbrand) {
                            $brandArray['b' . $rbrand->id_franchise] = $rbrand->nama_franchise;
                        }
                    }

                    if (isset($brandArray['b' . $row->brand])) {
                        $brandName[] = $brandArray['b' . $row->brand];
                    }
                } else {
                    $brandName[] = 'Pola kain';
                }

                //pt name 
                if (isset($ptArray['p' . $row->pt])) {
                    $ptName[] = $ptArray['p' . $row->pt];
                } else {
                    $ptName[] = 'Pola Kain';
                }

                //marketing name 
                if ($row->pt == '41') {
                    $marketingName[] = 'Pola kain';
                } else {
                    if (isset($marketingArray['m' . $row->marketing])) {
                        $marketingName[] = $marketingArray['m' . $row->marketing];
                    } else {
                        $marketingName[] = '-';
                    }
                }

                //closing status and join status 
                if ($row->tanggal_join == '') {
                    $join[] = 0;
                    $tanggalJoin = '';
                } else {
                    $join[] = 1;
                    $tanggalJoin = date('d M Y', strtotime($row->tanggal_join));
                }

                if ($row->is_close == '') {
                    $isClose[] = 'Belum closing';
                } else {
                    $isClose[] = 'Sudah closing';
                }

                //other main data 
                $nama[] = $row->nama;
                $hp[] = $row->hp;
                $tanggalInput[] = date('d M Y', strtotime($row->tanggal_input));
                $kategori[] = $row->kategori;
                $idVisit[] = $row->id_visit;
                $prospek[] = $row->prospek;
            }
        } else {
            // $data['nama'] = $nama;
            // $data['marketingName'] = $marketingName;
            // $data['hp'] = $hp;
            // $data['tanggal'] = $tanggalInput;
            // $data['kategori'] = $kategori;
            // $data['brandName'] = $brandName;
            // $data['ptName'] = $ptName;
            // $data['close']  = $isClose;
            // $data['join'] = $join;
            // $data['pagination'] = $pagination;
            // $data['idVisit'] = $idVisit;
            // $data['prospek'] = $prospek;
            // $data['key'] = $key;
            // $data['type']   = $type;
            // $data['page'] = $page;
            // $data['rows'] = $rows;
            // $data['allDate'] = $newTanggal;
            // $data['targetTanggal'] = $targetTanggal;
            // $data['targetTanggall'] = $tanggalJoin;
            // $data['query'] = $query;
            $nama = 0;
            $marketingName = 0; 
            $hp = 0;
            $tanggalInput = 0;
            $kategori = 0;
            $brandName = 0;
            $ptName = 0;
            $isClose = 0;
            $join = 0;
            $pagination = 0;
            $idVisit = 0;
            $prospek = 0;
            $key = 0;
            $type = 0;
            $page = 0;
            $rows = 0;
            $newTanggal = 0;
            $targetTanggal = 0;
            $tanggalJoin = 0;
            $query = 0;

            
        }
 
        // ################################################## end get result data ######################################################## //



        // ################################################## config pagination ######################################################## //

        $config['base_url'] = base_url() . 'dashboard/find_data/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $rows;
        $config['per_page'] = $perPage;

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

        $pagination = $this->pagination->create_links();

        // ################################################## end config pagination ######################################################## //

        $data['nama'] = $nama;
        $data['marketingName'] = $marketingName;
        $data['hp'] = $hp;
        $data['tanggal'] = $tanggalInput;
        $data['kategori'] = $kategori;
        $data['brandName'] = $brandName;
        $data['ptName'] = $ptName;
        $data['close']  = $isClose;
        $data['join'] = $join;
        $data['pagination'] = $pagination;
        $data['idVisit'] = $idVisit;
        $data['prospek'] = $prospek;
        $data['key'] = $key;
        $data['type']   = $type;
        $data['page'] = $page;
        $data['rows'] = $rows;
        $data['allDate'] = $newTanggal;
        $data['targetTanggal'] = $targetTanggal;
        $data['targetTanggall'] = $tanggalJoin;
        $data['query'] = $query;
        echo json_encode($data);
        return false;
    }

    public function brand($kunci)
    {
        $db = $this->load->database('we', true);
        $id = $_SESSION['pt'];
        $cekDb = $db->query('SELECT db FROM ansena_department WHERE id = ' . $id)->row_array();
        $dbB = $cekDb['db'];
        $db->close();

        //brand
        $dbBrand = $this->load->database($dbB, true);
        $check  = $dbBrand->query("SELECT id_franchise FROM ansena_franchise_list WHERE nama_franchise = '$kunci' ")->num_rows();
        $dbBrand->close();
        if ($check > 0) {
            $hasil = $dbBrand->query("SELECT id_franchise FROM ansena_franchise_list WHERE nama_franchise = '$kunci' ")->row_array();
            return $hasil;
        } else {
            return 'x';
        }
    }

    public function ambilPerusahaan()
    {
        $no = $this->input->post('no');

        $idPerusahaan = $this->db->query('SELECT pt FROM visit WHERE hp = ' . $no);
        echo json_encode($idPerusahaan->result());
    }

    public function autocomplete()
    {
        $data = $_GET['term'];

        $pt = $_SESSION['pt'];

        if ($pt == '41') {
            $query = $this->db->query("SELECT hp FROM visit WHERE hp LIKE '%$data%' AND pt = $pt")->result();
        } else {
            $query = $this->db->query("SELECT hp FROM visit WHERE hp LIKE '%$data%'")->result();
        }
        $nomor = array();
        foreach ($query as $row) {
            $nomor[]   = $row->hp;
        }
        $arr = array_unique($nomor);
        echo json_encode($arr);
    }

    public function autocompleteName()
    {
        $data = $_GET['term'];
        $query = $this->db->query("SELECT nama FROM visit WHERE nama LIKE '%$data%'")->result();
        $nama = array();
        foreach ($query as $row) {
            $nama[]   = $row->nama;
        }
        $arr = array_unique($nama);
        echo json_encode($arr);
    }

    public function checking_data($data = '') {
        $query = "SELECT db FROM ansena_department WHERE income = 1";
        $result = $this->database->getData($query, 'we')->result();

        foreach($result as $r) {
            $dbList[] = $r->db;
        }

        //brand 
        if ($data != '') {
            $queryBrand = "SELECT id_franchise, nama_franchise FROM ansena_franchise_list WHERE nama_franchise LIKE '%$data%'";
        } else {
            $queryBrand = "SELECT id_franchise, nama_franchise FROM ansena_franchise_list";
        }
        
        for ($i = 0; $i < count($dbList); $i++) {
            $resultBrand = $this->database->getData($queryBrand, $dbList[$i]);

            foreach ($resultBrand->result() as $row) {
                $brandList[] = $row->nama_franchise;
            }
        }

        echo json_encode($brandList);
    }

    public function autocompleteBrand()
    {
        $data = $_GET['term'];

        if ($data == 'pola' || $data == 'pol' || $data == 'pola' || $data == 'pola ' || $data == 'pola k' || $data == 'pola ka' || $data == 'pola kai' || $data == 'pola kain') {
            $brandList[] = 'Pola kain';
        } else {
            $query = "SELECT db FROM ansena_department WHERE income = 1";
            $result = $this->database->getData($query, 'we')->result();
    
            foreach ($result as $r) {
                $dbList[] = $r->db;
            }
    
            //brand 
            $queryBrand = "SELECT id_franchise, nama_franchise FROM ansena_franchise_list WHERE nama_franchise LIKE '%$data%'";
    
            for ($i = 0; $i < count($dbList); $i++) {
                $resultBrand = $this->database->getData($queryBrand, $dbList[$i]);
    
                foreach ($resultBrand->result() as $row) {
                    $brandList[] = $row->nama_franchise;
                }
            }
        }

        echo json_encode($brandList);
    }

    public function editData()
    {
        $id = $this->input->post('id');

        $query = $this->db->query('SELECT prospek FROM visit WHERE id_visit = ' . $id)->row_array();
        echo $query['prospek'];
    }

    public function prosesEdit()
    {
        $rating = $this->input->post('rating');
        $id = $this->input->post('id');

        $data = [
            'prospek'   => $rating
        ];

        edit('visit', $data, array('id_visit' => $id));
    }

    public function show_data($table, $limit1, $limit2) {
        $result = $this->db->query("SELECT * FROM $table LIMIT $limit1, $limit2")->result();

        echo json_encode($result);
    }
}
