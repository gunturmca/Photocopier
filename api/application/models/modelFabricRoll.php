<?php defined('BASEPATH') or exit('No direct script access allowed');

class modelFabricRoll extends CI_Model
{
  protected $rolltable = 'mFabricRoll';
  
  
  public function getData_RollFabric($OnSite, $RollID = null)
  {
    if ($RollID === null) {
      return $this->db->get_where('mFabricRoll', array('OnSite' => $OnSite))->row();
      
    } else {
      return $this->db->get_where('mFabricRoll', array('OnSite' => $OnSite, 'QRNumber' => $RollID))->row();
      
    }
  }

  public function getData_InfoRoll($OnSite, $RollID = null)
  {
    return $this->db->get_where('mdataqr', array('OnSite' => $OnSite, 'QRNumber' => $RollID, 'QRStatus' => 1))->row();
  }

  public function getData_RollFabricInspect($OnSite, $RollID = null)
  {
    if ($RollID === null) {
      return $this->db->get_where('mFabricRoll', array('OnSite' => $OnSite))->row();
      
    } else {
      return $this->db->get_where('mFabricRoll', array('OnSite' => $OnSite, 'QRNumber' => $RollID, 'InspectStatus' => 0))->row();
    }
  }

  public function generateQR($OnSite, $forDate, $type)
  {
    
    $sql_sp = "spGenQRollNew '$OnSite', '$forDate', '$type'";
    $genRoll = $this->db->query($sql_sp);
    
    if ($genRoll->num_rows()) {
      return $genRoll->row();
    } else {
      return FALSE;
    }
  }
  
  public function insert($tabel, $arr)
  {
    $cek = $this->db->insert($tabel, $arr);
    return $cek;
  }
  
  
}
