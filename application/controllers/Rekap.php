<?php
defined('BASEPATH') or exit('No direct script allowed');

class Rekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel', 'database');
    }

    public function index()
    {
        $data['title'] = 'Rekap data';

        $this->load->view('layout/header', $data);
        $this->load->view('rekap/index', $data);
        $this->load->view('layout/footer');
    }

    public function showRekap() {
      $kategori = $this->input->post('kategori');
      $tanggalAwal = $this->input->post('tanggalAwal');
      $tanggalAkhir = $this->input->post('tanggalAkhir');
      $joinInput = $_POST['join'];
      $role = $_SESSION['role'];
      $sessPt = $_SESSION['pt'];

      if ($role == 0 || $role == 5) {
      // ################################################## get all data for pemasaran ######################################################## //

          if ($sessPt != 41) {
            $queryDb = "SELECT db 
                                FROM ansena_department
                                WHERE income = 1";
  
            $resultDb = $this->database->getData($queryDb, 'we')->result();
  
            foreach($resultDb as $d) {
                $dbList[] = $d->db;
            }
            // end get database list
  
            //get pt list base on db list
            $dataMaster = array();
            $x = 0;
            for ($i = 0; $i < count($dbList); $i++) {
                $queryPt = "SELECT id
                                FROM ansena_department 
                                WHERE db = '$dbList[$i]'
                                AND income = 1";
                $resultPt = $this->database->getData($queryPt, 'we')->result();
  
                $queryBrand = "SELECT id_franchise, slug_franchise
                                    FROM ansena_franchise_list";
                $resultBrand = $this->database->getData($queryBrand, $dbList[$i])->result();
  
                //looping and set array -> key = pt id, value = brand id
                // $brandName = array();
                foreach($resultPt as $p) {
                    foreach ($resultBrand as $b) {
                        $dataMaster[$x][$p->id][] = $b->id_franchise;
                        $brandName[] = $b->slug_franchise;
                        $brandId[] = $b->id_franchise;
                        // $brandName['b' . $p->id . $b->id_franchise] = $b->nama_franchise;
                    }
                }
  
  
                $x++;
            }
  
            $z = 0;
            foreach ($dataMaster as $key => $value) {
                $ptId = array_keys($value); // array's key = pt id
                
                $brandd = array(); //defined array
                for ($ar = 0; $ar < count($ptId); $ar++) {
                    $brandd = $value[$ptId[$ar]];
                    for ($xx = 0; $xx < count($brandd); $xx++) {
                        $ptIdArr[] = $ptId[0];
  
                        $queryRes = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $ptId[0]
                                                        AND brand = $brandd[$xx]
                                                        AND kategori = 3
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");
  
                        $queryNo = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $ptId[0]
                                                        AND brand = $brandd[$xx]
                                                        AND kategori = 2
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");
  
                        $queryAn = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $ptId[0]
                                                        AND brand = $brandd[$xx]
                                                        AND kategori = 1
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");
  
                        $queryAll = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $ptId[0]
                                                        AND brand = $brandd[$xx]
                                                        AND kategori > 0
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");       
                               
                        if ($joinInput == 1) {
                            $queryJoin = $this->db->query("SELECT id_visit 
                                                            FROM visit 
                                                            WHERE pt = $ptId[0]
                                                            AND brand = $brandd[$xx]
                                                            AND tanggal_join IS NOT NULL
                                                            AND tanggal_input >= '$tanggalAwal' 
                                                            AND tanggal_input <= '$tanggalAkhir'");
                        }
  
                        $respon[] = $queryRes->num_rows();
                        $noRespon[] = $queryNo->num_rows();
                        $anak[] = $queryAn->num_rows();
                        $all[] = $queryAll->num_rows();
  
                        if ($joinInput == 1) {
                            $join[] = $queryJoin->num_rows();
                        } else {
                            $join = '';
                        }
                    }
                }
            }
            
          } else {
            $ptIdArr[] = '41';
            $brandName[] = 'Pola kain';
            $brandId[] = '41';

            $queryRes = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = 41
                                                    AND kategori = 3
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

            $queryNo = $this->db->query("SELECT id_visit 
                                                FROM visit 
                                                WHERE pt = $sessPt 
                                                AND brand = 41
                                                AND kategori = 2
                                                AND tanggal_input >= '$tanggalAwal' 
                                                AND tanggal_input <= '$tanggalAkhir'");

            $queryAn = $this->db->query("SELECT id_visit 
                                                FROM visit 
                                                WHERE pt = $sessPt 
                                                AND brand = 41
                                                AND kategori = 1
                                                AND tanggal_input >= '$tanggalAwal' 
                                                AND tanggal_input <= '$tanggalAkhir'");

            $queryAll = $this->db->query("SELECT id_visit 
                                                FROM visit 
                                                WHERE pt = $sessPt 
                                                AND brand = 41
                                                AND kategori > 0
                                                AND tanggal_input >= '$tanggalAwal' 
                                                AND tanggal_input <= '$tanggalAkhir'");

            if ($joinInput == 1) {
                $queryJoin = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = 41
                                                    AND tanggal_join IS NOT NULL
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");                                   
            }

            $respon[] = $queryRes->num_rows();
            $noRespon[] = $queryNo->num_rows();
            $anak[] = $queryAn->num_rows();
            $all[] = $queryAll->num_rows();

            if ($joinInput == 1) {
                $join[] = $queryJoin->num_rows();
            } else {
                $join = '';
            }
          }

      // ################################################## end get all data for pemasaran ######################################################## //
      } else {

      // ################################################## get all data per pt ######################################################## //

          if ($sessPt != '41') {

            $queryDb = "SELECT db 
                          FROM ansena_department
                          WHERE id = $sessPt";
            $resultDb = $this->database->getData($queryDb, 'we')->row_array();

            //query for get pt 
            $queryBrand = "SELECT id_franchise, slug_franchise
                                FROM ansena_franchise_list";
            
            $resultBrand = $this->database->getData($queryBrand, $resultDb['db'])->result();

            $brandName = array();
            foreach($resultBrand as $b) {
                $ptIdArr[] = $sessPt;

                $brandName[] = $b->slug_franchise;
                $brandId[] = $b->id_franchise;

                $queryRes = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = $b->id_franchise
                                                    AND kategori = 3
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");
                echo json_encode($queryRes->result);
                
                $queryNo = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = $b->id_franchise
                                                    AND kategori = 2
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

                $queryAn = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = $b->id_franchise
                                                    AND kategori = 1
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

                $queryAll = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = $b->id_franchise
                                                    AND kategori > 0
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

                if ($joinInput == 1) {
                    $queryJoin = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $sessPt 
                                                        AND brand = $b->id_franchise
                                                        AND tanggal_join IS NOT NULL
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");                                   
                }

                $respon[] = $queryRes->num_rows();
                $noRespon[] = $queryNo->num_rows();
                $anak[] = $queryAn->num_rows();
                $all[] = $queryAll->num_rows();

                if ($joinInput == 1) {
                    $join[] = $queryJoin->num_rows();
                } else {
                    $join = '';
                }
            }

          } else {
            $ptIdArr[] = '41';
            $brandName[] = 'Pola kain';
            $brandId[] = '41';

            $queryRes = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = 41 
                                                    AND brand = 41
                                                    AND kategori = 3
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

            $queryNo = $this->db->query("SELECT id_visit 
                                                FROM visit 
                                                WHERE pt = $sessPt 
                                                AND brand = 41
                                                AND kategori = 2
                                                AND tanggal_input >= '$tanggalAwal' 
                                                AND tanggal_input <= '$tanggalAkhir'");

            $queryAn = $this->db->query("SELECT id_visit 
                                                FROM visit 
                                                WHERE pt = $sessPt 
                                                AND brand = 41
                                                AND kategori = 1
                                                AND tanggal_input >= '$tanggalAwal' 
                                                AND tanggal_input <= '$tanggalAkhir'");

            $queryAll = $this->db->query("SELECT id_visit 
                                                FROM visit 
                                                WHERE pt = $sessPt 
                                                AND brand = 41
                                                AND kategori > 0
                                                AND tanggal_input >= '$tanggalAwal' 
                                                AND tanggal_input <= '$tanggalAkhir'");

            if ($joinInput == 1) {
                $queryJoin = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = 41
                                                    AND tanggal_join IS NOT NULL
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");                                   
            }

            $respon[] = $queryRes->num_rows();
            $noRespon[] = $queryNo->num_rows();
            $anak[] = $queryAn->num_rows();
            $all[] = $queryAll->num_rows();

            if ($joinInput == 1) {
                $join[] = $queryJoin->num_rows();
            } else {
                $join = '';
            }
          }
          

      // ################################################## end get all data per pt ######################################################## //

      }
     
      $data = [
          'brandId' => $brandId,
          'brandName' => $brandName,
          'ptId'  => $ptIdArr,
          'respon'    => $respon,
          'noRespon'  => $noRespon,
          'anak'  => $anak,
          'all'   => $all,
          'join'  => $join
      ];
      echo json_encode($data);
      return false;
      
    }

    public function detailBrand()
    {

      $tanggalAwal = $this->input->post('tanggalAwal');
      $tanggalAkhir = $this->input->post('tanggalAkhir');
      $idBrand = $this->input->post('idBrand');
      $kategori = $this->input->post('kategori');
      $dbInput = $this->input->post('dbName');
      $idPt = $_SESSION['pt'];
      $role = $_SESSION['role'];

      $tanggal = date('d M Y', strtotime($tanggalAwal)) . ' - ' . date('d M Y', strtotime($tanggalAkhir));

      //brand name
      $queryDb = "SELECT db
                FROM ansena_department
                WHERE id = $idPt";
      $resultDb = $this->database->getData($queryDb, 'we')->row_array();

      $db = $resultDb['db'];

      $queryBrand = "SELECT id_franchise, nama_franchise
                  FROM ansena_franchise_list";
      $resultBrand = $this->database->getData($queryBrand, $dbInput);

      $brandArray = array();
      foreach($resultBrand->result() as $br) {

        $brandArray['b' . $br->id_franchise] = $br->nama_franchise;

      }

      //alasan array
      $queryAlasan = "SELECT id, alasan
                    FROM alasan
                    WHERE role > 0";
      $resultAlasan = $this->database->getData($queryAlasan, 'visit');

      $alaranArray = array();
      foreach($resultAlasan->result() as $al) {

        $alasanArray['al' . $al->id] = $al->alasan;

      }

      //main table

      if($kategori == 0) {

        $newKategori = ' > 0';

        if ($role == 5) {
          $query = "SELECT nama, hp, alasan, brand, tanggal_input, prospek, kategori, sumber
                  FROM visit
                  WHERE brand = $idBrand
                  AND tanggal_input >= '$tanggalAwal'
                  AND tanggal_input <= '$tanggalAkhir'
                  ORDER BY tanggal_input ASC, kategori DESC, prospek DESC";
                                  
        }  else {
          $query = "SELECT nama, hp, alasan, brand, tanggal_input, prospek, kategori, sumber
                  FROM visit
                  WHERE brand = $idBrand
                  AND pt = $idPt
                  AND tanggal_input >= '$tanggalAwal'
                  AND tanggal_input <= '$tanggalAkhir'
                  ORDER BY tanggal_input ASC, kategori DESC, prospek DESC";
        }

      } else {

        $newKategori = ' = ' . $kategori;

        if ($role == 5) {
          $query = "SELECT nama, hp, alasan, brand, tanggal_input, prospek, kategori, sumber
                  FROM visit
                  WHERE kategori $newKategori
                  AND brand = $idBrand
                  AND tanggal_input >= '$tanggalAwal'
                  AND tanggal_input <= '$tanggalAkhir'
                  ORDER BY tanggal_input ASC, kategori DESC, prospek DESC";
        } else {
          $query = "SELECT nama, hp, alasan, brand, tanggal_input, prospek, kategori, sumber
                  FROM visit
                  WHERE kategori $newKategori
                  AND pt = $idPt
                  AND brand = $idBrand
                  AND tanggal_input >= '$tanggalAwal'
                  AND tanggal_input <= '$tanggalAkhir'
                  ORDER BY tanggal_input ASC, kategori DESC, prospek DESC";
        }

      }

    $queryIg = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $idBrand 
                                            AND tanggal_input >= '$tanggalAwal' 
                                            AND tanggal_input <= '$tanggalAkhir'
                                            AND sumber = 1")->num_rows();

    $queryFb = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $idBrand 
                                            AND tanggal_input >= '$tanggalAwal' 
                                            AND tanggal_input <= '$tanggalAkhir'
                                            AND sumber = 2")->num_rows();

    $queryAyo = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $idBrand 
                                            AND tanggal_input >= '$tanggalAwal' 
                                            AND tanggal_input <= '$tanggalAkhir'
                                            AND sumber = 3")->num_rows();

    $queryWar = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $idBrand 
                                            AND tanggal_input >= '$tanggalAwal' 
                                            AND tanggal_input <= '$tanggalAkhir'
                                            AND sumber = 4")->num_rows();

    $queryDun = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $idBrand 
                                            AND tanggal_input >= '$tanggalAwal' 
                                            AND tanggal_input <= '$tanggalAkhir'
                                            AND sumber = 5")->num_rows();

    $queryWeb = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $idBrand 
                                            AND tanggal_input >= '$tanggalAwal' 
                                            AND tanggal_input <= '$tanggalAkhir'
                                            AND sumber = 6")->num_rows();

    $queryDir = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $idBrand 
                                            AND tanggal_input >= '$tanggalAwal' 
                                            AND tanggal_input <= '$tanggalAkhir'
                                            AND sumber = 7")->num_rows();

      $result = $this->database->getData($query, 'visit');

      foreach($result->result() as $row) {

        //alasan
        if($row->alasan == 0) {

          $alasan[] = '-';

        } else {

          if (isset($alasanArray['al' . $row->alasan])) {

              $alasan[] = $alasanArray['al' . $row->alasan];

          }

        }

        //brand
        if (isset($brandArray['b' . $row->brand])) {

          $brandName = $brandArray['b' . $row->brand];

        }

        // kategori
        if($row->kategori == 3) {

          $kategoriName[] = "Respon";

        } else if ($row->kategori == 2) {

          $kategoriName[] = "No respon";

        } else if ($row->kategori == 1) {

          $kategoriName[] = "Anak - anak";

        }

        //other
        $tanggalInput = array();

        $nama[] = $row->nama;
        $hp[] = $row->hp;
        $tanggalFix[] = date('d M Y', strtotime($row->tanggal_input));
        $cekTanggal[] = $row->tanggal_input;
        $prospek[] = $row->prospek;
        
        if ($row->sumber == '') {
          $sumber[] = '-';
        } else if ($row->sumber == 1) {
          $sumber[] = 'Instagram Ads';
        } else if ($row->sumber == 2) {
          $sumber[] = 'Facebook Ads';
        } else if ($row->sumber == 3) {
          $sumber[] = 'Ayo Waralaba';
        } else if ($row->sumber == 4) {
          $sumber[] = 'Waralabaku';
        } else if ($row->sumber == 5) {
          $sumber[] = 'Dunia Franchise';
        } else if ($row->sumber == 6) {
          $sumber[] = 'Website';
        } else {
          $sumber[] = 'direct';
        }

      }

      //get data by cek tanggal
      $params = array_count_values($cekTanggal);
      $paramsKey = array_keys($params);

      //change params format date
      for($c = 0; $c < count($paramsKey); $c++) {

        $newParams[] = date('d M Y', strtotime($paramsKey[$c]));

      }

      //loop to get rows of params key
      $trigger = array();
      for($par = 0; $par < count($paramsKey); $par++) {

        if($kategori == 0) {

          if ($role == 0 || $role == 5) {
            $triggerRes[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND kategori = 3 AND tanggal_input = '$paramsKey[$par]'";
            $triggerNo[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND kategori = 2 AND tanggal_input = '$paramsKey[$par]'";
            $triggerAn[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND kategori = 1 AND tanggal_input = '$paramsKey[$par]'";
          } else {
            $triggerRes[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND pt = $idPt AND kategori = 3 AND tanggal_input = '$paramsKey[$par]'";
            $triggerNo[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND pt = $idPt AND kategori = 2 AND tanggal_input = '$paramsKey[$par]'";
            $triggerAn[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND pt = $idPt AND kategori = 1 AND tanggal_input = '$paramsKey[$par]'";
          }

        } else if ($kategori == 3) {

          if ($role == 0 || $role == 5) {
            $triggerRes[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND kategori = 3 AND tanggal_input = '$paramsKey[$par]'";
          } else {
            $triggerRes[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND pt = $idPt AND kategori = 3 AND tanggal_input = '$paramsKey[$par]'";
          }
          $triggerNo[] = 0;
          $triggerAn[] = 0;

        } else if ($kategori == 2 || $role == 5) {

          if ($role == 0 || $role == 5) {
            $triggerNo[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND  kategori = 2 AND tanggal_input = '$paramsKey[$par]'";
          } else {
            $triggerNo[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND pt = $idPt AND  kategori = 2 AND tanggal_input = '$paramsKey[$par]'";
          }
          $triggerRes[] = 0;
          $triggerAn[] = 0;

        } else if ($kategori == 1 || $role == 5) {

          if ($role == 0) {
            $triggerAn[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND  kategori = 1 AND tanggal_input = '$paramsKey[$par]'";
          } else {
            $triggerAn[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $idBrand AND pt = $idPt AND  kategori = 1 AND tanggal_input = '$paramsKey[$par]'";
          }
          $triggerRes[] = 0;
          $triggerNo[] = 0;

        }

      }

      if($kategori == 3) {

        foreach($triggerRes as $key) {

          $getResult = $this->database->getData($key, 'visit');

          $resultRes[] = $getResult->num_rows();

        }

        $resultNo[] = 0;
        $resultAn[] = 0;

      } else if ($kategori == 2) {

        foreach($triggerNo as $key) {

          $getResult = $this->database->getData($key, 'visit');

          $resultNo[] = $getResult->num_rows();

        }

        $resultRes[] = 0;
        $resultAn[] = 0;

      } else if ($kategori == 1) {

        foreach($triggerAn as $key) {

          $getResult = $this->database->getData($key, 'visit');

          $resultAn[] = $getResult->num_rows();

        }

        $resultRes[] = 0;
        $resultNo[] = 0;

      } else if ($kategori == 0) {

        foreach($triggerRes as $key) {

          $getResult = $this->database->getData($key, 'visit');
          $resultRes[] = $getResult->num_rows();

        }

        foreach($triggerNo as $keyNo) {

          $getResultNo = $this->database->getData($keyNo, 'visit');

          $resultNo[] = $getResultNo->num_rows();

        }

        foreach($triggerAn as $keyAn) {

          $getResultAn = $this->database->getData($keyAn, 'visit');

          $resultAn[] = $getResultAn->num_rows();

        }

      }

      $data['alasan'] = $alasan;
      $data['brandName'] = $brandName;
      $data['nama'] = $nama;
      $data['hp'] = $hp;
      $data['tanggalInput']  = $tanggalFix;
      $data['prospek'] = $prospek;
      $data['kategoriName'] = $kategoriName;
      $data['tanggal'] = $tanggal;
      $data['params'] = $newParams;
      $data['paramsRespon'] = $resultRes;
      $data['paramsNorespon'] = $resultNo;
      $data['paramsAnak'] = $resultAn;
      $data['paramsKategori'] = $kategori;
      $data['sumber'] = $sumber;
      $data['ig'] = $queryIg;
      $data['fb'] = $queryFb;
      $data['ayo'] = $queryAyo;
      $data['war'] = $queryWar;
      $data['dun'] = $queryDun;
      $data['web'] = $queryWeb;
      $data['dir'] = $queryDir;
      $data['role'] = $query;

      echo json_encode($data);

    }



    // ################################################## backup ######################################################## //
    public function show_rekap() {
        $kategori = $this->input->post('kategori');
        $tanggalAwal = $this->input->post('tanggalAwal');
        $tanggalAkhir = $this->input->post('tanggalAkhir');
        $role = $_SESSION['role'];
        $sessPt = $_SESSION['pt'];

        if ($role == 0 || $role == 5) {
        // ################################################## get all data for pemasaran ######################################################## //

            $queryDb = "SELECT db 
                                FROM ansena_department
                                WHERE income = 1";

            $resultDb = $this->database->getData($queryDb, 'we')->result();

            foreach($resultDb as $d) {
                $dbList[] = $d->db;
            }
            // end get database list

            //get pt list base on db list
            $dataMaster = array();
            $x = 0;
            for ($i = 0; $i < count($dbList); $i++) {
                $queryPt = "SELECT id
                                FROM ansena_department 
                                WHERE db = '$dbList[$i]'
                                AND income = 1";
                $resultPt = $this->database->getData($queryPt, 'we')->result();

                $queryBrand = "SELECT id_franchise, slug_franchise
                                    FROM ansena_franchise_list";
                $resultBrand = $this->database->getData($queryBrand, $dbList[$i])->result();

                //looping and set array -> key = pt id, value = brand id
                // $brandName = array();
                foreach($resultPt as $p) {
                    foreach ($resultBrand as $b) {
                        $dataMaster[$x][$p->id][] = $b->id_franchise;
                        $brandName[] = $b->slug_franchise;
                        $brandId[] = $b->id_franchise;
                        // $brandName['b' . $p->id . $b->id_franchise] = $b->nama_franchise;
                    }
                }


                $x++;
            }

            $z = 0;
            foreach ($dataMaster as $key => $value) {
                $ptId = array_keys($value); // array's key = pt id
                
                $brandd = array(); //defined array
                for ($ar = 0; $ar < count($ptId); $ar++) {
                    $brandd = $value[$ptId[$ar]];
                    for ($xx = 0; $xx < count($brandd); $xx++) {
                        $ptIdArr[] = $ptId[0];

                        $queryRes = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $ptId[0]
                                                        AND brand = $brandd[$xx]
                                                        AND kategori = 3
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");

                        $queryNo = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $ptId[0]
                                                        AND brand = $brandd[$xx]
                                                        AND kategori = 2
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");

                        $queryAn = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $ptId[0]
                                                        AND brand = $brandd[$xx]
                                                        AND kategori = 1
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");

                        $queryAll = $this->db->query("SELECT id_visit 
                                                        FROM visit 
                                                        WHERE pt = $ptId[0]
                                                        AND brand = $brandd[$xx]
                                                        AND kategori > 0
                                                        AND tanggal_input >= '$tanggalAwal' 
                                                        AND tanggal_input <= '$tanggalAkhir'");
                        $respon[] = $queryRes->num_rows();
                        $noRespon[] = $queryNo->num_rows();
                        $anak[] = $queryAn->num_rows();
                        $all[] = $queryAll->num_rows();
                    }
                }
            }

        // ################################################## end get all data for pemasaran ######################################################## //
        } else {

        // ################################################## get all data per pt ######################################################## //

            $queryDb = "SELECT db 
                            FROM ansena_department
                            WHERE id = $sessPt";
            $resultDb = $this->database->getData($queryDb, 'we')->row_array();

            //query for get pt 
            $queryBrand = "SELECT id_franchise, slug_franchise
                                FROM ansena_franchise_list";
            
            $resultBrand = $this->database->getData($queryBrand, $resultDb['db'])->result();

            $brandName = array();
            foreach($resultBrand as $b) {
                $ptIdArr[] = $sessPt;

                $brandName[] = $b->slug_franchise;
                $brandId[] = $b->id_franchise;

                $queryRes = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = $b->id_franchise
                                                    AND kategori = 3
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

                $queryNo = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = $b->id_franchise
                                                    AND kategori = 2
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

                $queryAn = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = $b->id_franchise
                                                    AND kategori = 1
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

                $queryAll = $this->db->query("SELECT id_visit 
                                                    FROM visit 
                                                    WHERE pt = $sessPt 
                                                    AND brand = $b->id_franchise
                                                    AND kategori > 0
                                                    AND tanggal_input >= '$tanggalAwal' 
                                                    AND tanggal_input <= '$tanggalAkhir'");

                $respon[] = $queryRes->num_rows();
                $noRespon[] = $queryNo->num_rows();
                $anak[] = $queryAn->num_rows();
                $all[] = $queryAll->num_rows();
            }

        // ################################################## end get all data per pt ######################################################## //

        }
       
        $data = [
            'brandId' => $brandId,
            'brandName' => $brandName,
            'ptId'  => $ptIdArr,
            'respon'    => $respon,
            'noRespon'  => $noRespon,
            'anak'  => $anak,
            'all'   => $all
        ];
        echo json_encode($data);
        return false;
        
    }

    public function detail_brand() {
        $brandId = $this->input->post('brandId');
        $ptId = $this->input->post('ptId');
        $awal = $this->input->post('tanggalAwal');
        $akhir = $this->input->post('tanggalAkhir');
        $kategori = $this->input->post('kategori');
        $role = $_SESSION['role'];
        $sessPt = $_SESSION['pt'];

        $tanggal = date('d M Y', strtotime($awal)) . ' - ' . date('d M Y', strtotime($akhir));

        if ($kategori == 0) {
            $newKategori = ' > 0';
        } else {
            $newKategori = ' = ' . $kategori;
        }

        $query = $this->db->query("SELECT id_visit, kategori, prospek, nama, hp, tanggal_input, sumber, alasan, brand
                        FROM visit 
                        WHERE brand = $brandId 
                        AND pt = $ptId
                        AND kategori $newKategori
                        AND tanggal_input >= '$awal'
                        AND tanggal_input <= '$akhir'")->result();

        $queryIg = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $brandId
                                            AND kategori $newKategori
                                            AND pt = $ptId 
                                            AND tanggal_input >= '$awal' 
                                            AND tanggal_input <= '$akhir'
                                            AND sumber = 1")->num_rows();

        $queryFb = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $brandId
                                            AND kategori $newKategori
                                            AND pt = $ptId 
                                            AND tanggal_input >= '$awal' 
                                            AND tanggal_input <= '$akhir'
                                            AND sumber = 2")->num_rows();

        $queryAyo = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $brandId
                                            AND kategori $newKategori
                                            AND pt = $ptId 
                                            AND tanggal_input >= '$awal' 
                                            AND tanggal_input <= '$akhir'
                                            AND sumber = 3")->num_rows();

        $queryTik = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $brandId
                                            AND kategori $newKategori
                                            AND pt = $ptId 
                                            AND tanggal_input >= '$awal' 
                                            AND tanggal_input <= '$akhir'
                                            AND sumber = 8")->num_rows();

        $queryWar = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $brandId
                                            AND kategori $newKategori
                                            AND pt = $ptId 
                                            AND tanggal_input >= '$awal' 
                                            AND tanggal_input <= '$akhir'
                                            AND sumber = 4")->num_rows();

        $queryDun = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $brandId
                                            AND kategori $newKategori
                                            AND pt = $ptId 
                                            AND tanggal_input >= '$awal' 
                                            AND tanggal_input <= '$akhir'
                                            AND sumber = 5")->num_rows();

        $queryWeb = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $brandId
                                            AND kategori $newKategori
                                            AND pt = $ptId 
                                            AND tanggal_input >= '$awal' 
                                            AND tanggal_input <= '$akhir'
                                            AND sumber = 6")->num_rows();

        $queryDir = $this->db->query("SELECT id_visit
                                            FROM visit 
                                            WHERE brand = $brandId
                                            AND kategori $newKategori
                                            AND pt = $ptId 
                                            AND tanggal_input >= '$awal' 
                                            AND tanggal_input <= '$akhir'
                                            AND sumber = 7")->num_rows();

         // alasan array
        $resultAlasan = $this->db->query("SELECT id, alasan 
                                                FROM alasan
                                                WHERE role > 0");                                   

        $alasanArray = array();
        foreach ($resultAlasan->result() as $al) {

            $alasanArray['al' . $al->id] = $al->alasan;
        }

        // brand array 
        if ($ptId != '41') {
          $dbSelect = "SELECT db FROM  ansena_department WHERE id = $ptId";
          $resultDb = $this->database->getData($dbSelect, 'we')->row_array();
  
          $queryHelperBrand = "SELECT id_franchise, nama_franchise FROM ansena_franchise_list";
          $resultHelperBrand = $this->database->getData($queryHelperBrand, $resultDb['db'])->result();
  
          $brandArray = array();
          foreach ($resultHelperBrand as $bb) {
              $brandArray['b' . $bb->id_franchise] = $bb->nama_franchise;
          }
        }

        foreach ($query as $row) {
            $nama[] = $row->nama;
            $hp[] = $row->hp;
            $prospek[] = $row->prospek;
            $cekTanggal[] = $row->tanggal_input;
            $tanggalFix[] = date('d M Y', strtotime($row->tanggal_input));

            //sumber 
            if ($row->sumber == '') {
                $sumber[] = '-';
            } else if ($row->sumber == 1) {
                $sumber[] = 'Instagram Ads';
            } else if ($row->sumber == 2) {
                $sumber[] = 'Facebook Ads';
            } else if ($row->sumber == 3) {
                $sumber[] = 'Ayo Waralaba';
            } else if ($row->sumber == 4) {
                $sumber[] = 'Waralabaku';
            } else if ($row->sumber == 5) {
                $sumber[] = 'Dunia Franchise';
            } else if ($row->sumber == 6) {
                $sumber[] = 'Website';
            } else if ($row->sumber == 7) {
                $sumber[] = 'direct';
            } else {
              $sumber[] = 'Tiktok Ads';
            }

            //alasan
            if ($sessPt != '41') {
              if ($row->alasan == 0) {
  
                  $alasan[] = '-';
              } else {
  
                  if (isset($alasanArray['al' . $row->alasan])) {
  
                      $alasan[] = $alasanArray['al' . $row->alasan];
                  }
              }
            } else {
              $alasan = [
                '0' => 'Rundingan',
                '1' => 'Modal',
                '2' => 'Design sendiri',
                '3' => 'Tidak tertarik katalog',
                '4' => 'Ongkir',
                '5' => 'Beli satuan'
              ];
            }

            //brand
            if (isset($brandArray['b' . $row->brand])) {

                $brandName = $brandArray['b' . $row->brand];

            } else {

              $brandName = 'Pola kain';

            }

            // kategori
            if ($row->kategori == 3) {

                $kategoriName[] = "Respon";
            } else if ($row->kategori == 2) {

                $kategoriName[] = "No respon";
            } else if ($row->kategori == 1) {

                $kategoriName[] = "Anak - anak";
            }
        }

        //get data by cek tanggal
        $params = array_count_values($cekTanggal);
        $paramsKey = array_keys($params);

        //change params format date
        for ($c = 0; $c < count($paramsKey); $c++) {
            $newParams[] = date('d M Y', strtotime($paramsKey[$c]));
        }

        for ($par = 0; $par < count($paramsKey); $par++) {

            if ($kategori == 0) {

                if ($role == 0 || $role == 5) {
                    $triggerRes[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 3 AND tanggal_input = '$paramsKey[$par]'";
                    $triggerNo[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 2 AND tanggal_input = '$paramsKey[$par]'";
                    $triggerAn[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 1 AND tanggal_input = '$paramsKey[$par]'";
                } else {
                    $triggerRes[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 3 AND tanggal_input = '$paramsKey[$par]'";
                    $triggerNo[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 2 AND tanggal_input = '$paramsKey[$par]'";
                    $triggerAn[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 1 AND tanggal_input = '$paramsKey[$par]'";
                }
            } else if ($kategori == 3) {

                if ($role == 0 || $role == 5) {
                    $triggerRes[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 3 AND tanggal_input = '$paramsKey[$par]'";
                } else {
                    $triggerRes[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 3 AND tanggal_input = '$paramsKey[$par]'";
                }
                $triggerNo[] = 0;
                $triggerAn[] = 0;
            } else if ($kategori == 2) {

                if ($role == 0 || $role == 5) {
                    $triggerNo[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 2 AND tanggal_input = '$paramsKey[$par]'";
                } else {
                    $triggerNo[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND  kategori = 2 AND tanggal_input = '$paramsKey[$par]'";
                }
                $triggerRes[] = 0;
                $triggerAn[] = 0;
            } else if ($kategori == 1) {

                if ($role == 0 || $role == 5) {
                    $triggerAn[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND kategori = 1 AND tanggal_input = '$paramsKey[$par]'";
                } else {
                    $triggerAn[] = "SELECT id_visit, nama, tanggal_input FROM visit WHERE brand = $brandId AND pt = $ptId AND  kategori = 1 AND tanggal_input = '$paramsKey[$par]'";
                }
                $triggerRes[] = 0;
                $triggerNo[] = 0;
            }
        }

        if ($kategori == 3) {

            foreach ($triggerRes as $key) {

                $getResult = $this->database->getData($key, 'visit');

                $resultRes[] = $getResult->num_rows();
            }

            $resultNo[] = 0;
            $resultAn[] = 0;
        } else if ($kategori == 2) {

            foreach ($triggerNo as $key) {

                $getResult = $this->database->getData($key, 'visit');

                $resultNo[] = $getResult->num_rows();
            }

            $resultRes[] = 0;
            $resultAn[] = 0;
        } else if ($kategori == 1) {

            foreach ($triggerAn as $key) {

                $getResult = $this->database->getData($key, 'visit');

                $resultAn[] = $getResult->num_rows();
            }

            $resultRes[] = 0;
            $resultNo[] = 0;
        } else if ($kategori == 0) {

            foreach ($triggerRes as $key) {

                $getResult = $this->database->getData($key, 'visit');
                $resultRes[] = $getResult->num_rows();
            }

            foreach ($triggerNo as $keyNo) {

                $getResultNo = $this->database->getData($keyNo, 'visit');

                $resultNo[] = $getResultNo->num_rows();
            }

            foreach ($triggerAn as $keyAn) {

                $getResultAn = $this->database->getData($keyAn, 'visit');

                $resultAn[] = $getResultAn->num_rows();
            }
        }

        $data['alasan'] = $alasan;
        $data['brandName'] = $brandName;
        $data['nama'] = $nama;
        $data['hp'] = $hp;
        $data['tanggalInput']  = $tanggalFix;
        $data['prospek'] = $prospek;
        $data['kategoriName'] = $kategoriName;
        $data['tanggal'] = $tanggal;
        $data['params'] = $newParams;
        $data['paramsRespon'] = $resultRes;
        $data['paramsNorespon'] = $resultNo;
        $data['paramsAnak'] = $resultAn;
        $data['paramsKategori'] = $kategori;
        $data['sumber'] = $sumber;
        $data['ig'] = $queryIg;
        $data['fb'] = $queryFb;
        $data['ayo'] = $queryAyo;
        $data['tik'] = $queryTik;
        $data['war'] = $queryWar;
        $data['dun'] = $queryDun;
        $data['web'] = $queryWeb;
        $data['dir'] = $queryDir;

       echo json_encode($data);
    
    }
    // ################################################## end backup ######################################################## //
}
