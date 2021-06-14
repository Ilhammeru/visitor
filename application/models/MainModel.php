<?php
defined('BASEPATH') or exit('No direct script allowed');

class MainModel extends CI_Model
{
  public function getData($query, $database)
  {
      if ($database == 'visit') {
          $this->load->database();
          $result =  $this->db->query($query);
          $this->db->close();

      } else {

          $db = $this->load->database($database, true);
          $result = $db->query($query);
          $db->close();

      }

      return $result;
  }
}
