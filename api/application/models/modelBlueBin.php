<?php defined('BASEPATH') or exit('No direct script access allowed');

class modelBlueBin extends CI_Model
{
  protected $bin_table = 'mdatabin';
  
  
  public function getData_BlueBin($OnSite = null, $BinID = null)
  {
    // if ($BinID === null) {
    //   return $this->db->get('mdatabin')->row();
    // } else {
    //   return $this->db->get_where('mdatabin', array('OnSite' => $OnSite, 'BinID' => $BinID))->row();
    // }

    if ($BinID === null) {
      return $this->db->get('mdatabin')->row();
    } else {
      $sql_sp = "spGetDataBluebin '$OnSite', '$BinID', '0'";
      return $this->db->query($sql_sp)->row();
    }

  }
  
  public function insert($tabel, $arr)
  {
    $cek = $this->db->insert($tabel, $arr);
    return $cek;
  }
  
  
}
