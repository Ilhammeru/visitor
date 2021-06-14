<?php
defined('BASEPATH') OR defined('No direct script allowed');

class Database extends CI_Model {
  public function getData($query, $db) {

    if ($db == 'visitor') {
        $result =  $this->db->query($query);
    } else {
        $db = $this->load->database($db, true);
        $result = $db->query($query);
        $db->close();
    }
    return $result;

  }
}

 ?>
