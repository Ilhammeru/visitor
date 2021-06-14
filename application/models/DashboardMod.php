<?php
defined('BASEPATH') or exit('No direct script allowed');

class DashboardMod extends CI_Model
{
    public function getDb($database)
    {
        if ($database == 'we') {
            $this->databaseLoad = $this->load->database('we', true);
        } else {
            $this->databaseLoad = $this->load->database($database, true);
        }

        return $this->databaseLoad;
    }
}
