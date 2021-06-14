<?php
if (!function_exists('Maindb')) {
    function ambilDataDb($database, $table)
    {
        $b = get_instance();
        $db = $b->load->database($database, true);
        $hasil = $db->get($table);
        return $hasil;
    }

    function ambilDataDbWhere($database, $table)
    {
        $b = get_instance();
        $db = $b->load->database($database, true);
        $hasil = $db->query("SELECT id, name FROM $table WHERE income = 1");
        return $hasil;
    }

    function ambilDataDua($table)
    {
        $b = get_instance();
        $db2 = $b->load->database('we', true);
        $hasil = $db2->get($table);
        return $hasil;
    }

    function ambilDataEmpat($table)
    {
        $b = get_instance();
        $db2 = $b->load->database('we', true);
        $hasil = $db2->get($table);
        return $hasil;
    }

    function ambilNama($id)
    {
        $b = get_instance();
        $db2 = $b->load->database('we', true);
        if ($id == 14) {
            $user   = $db2->query("SELECT name, id FROM ac_payroll_item WHERE office = $id AND is_active = 1 ORDER BY name ASC ")->result();
        } else {
            $user   = $db2->query("SELECT name, id FROM ac_payroll_item WHERE office = $id AND is_active = 1 ORDER BY name ASC ")->result();
            // $user   = $db2->query("SELECT api.name, api.id FROM ac_payroll_item api, ansena_division ad WHERE api.division = ad.id AND ad.type = 2 AND api.office = $id AND api.is_active = 1 ORDER BY api.name ASC ")->result();
        }
        $db2->close();
        return $user;
    }

    function ambilBrand($id)
    {
        $b = get_instance();

        $db2 = $b->load->database('we', true);
        $hasil  = $db2->query('SELECT id, db FROM ansena_department WHERE id = ' . $id)->row_array();
        $db2->close();
        $db = $hasil['db'];

        $db3 = $b->load->database($db, true);
        $idDept = $hasil['id'];
        $brand   = $db3->query('SELECT nama_franchise, id, id_franchise FROM we.ansena_franchise_list')->result();
        $db3->close();
        return $brand;
    }

    function ambilAlasan($data)
    {
        $b = get_instance();
        $hasil = $b->db->query("SELECT * FROM alasan WHERE id in('$data')");
        return $hasil;
    }
}
