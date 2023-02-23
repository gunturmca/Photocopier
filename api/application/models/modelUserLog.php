<?php defined('BASEPATH') or exit('No direct script access allowed');

class modelUserLog extends CI_Model
{
  protected $user_table = 'mdatauser';

  //USER
  public function index($id)
  {
    return $this->db->get_where('mdatauser', ['userid' => $id])->row();
  }
  public function indexPengguna($level)
  {
    return $this->db->get_where('mdatauser', ['Status' => $level])->result_array();
  }
  public function detail($id)
  {
    return $this->db->get_where('mdatauser', ['userid' => $id])->row_array();
  }
  //END PENGGUNA
  
  public function getData_User($OnSite = null, $id = null)
  {
    if ($id === null) {
      return $this->db->get('mdatauser')->row();
    } else {
      return $this->db->get_where('mdatauser', array('OnSite' => $OnSite, 'userid' => $id))->row();
      
    }
  }


  public function user_login($OnSite, $userID, $password)
  {
    $array = array('OnSite' => $OnSite, 'userID' => $userID);
    $this->db->where($array);
    $q = $this->db->get($this->user_table);

    //$q = $this->db->get_where('mdatauser', array('OnSite' => $OnSite, 'userid' => $userID))->row();
    if ($q->num_rows()) {
      $user_pass = $q->row('userPassword');
      if (md5($password) === $user_pass) {
        return $q->row();
      }
      return FALSE;
    } else {
      return FALSE;
    }
  }

  public function insert($tabel, $arr)
  {
    $cek = $this->db->insert($tabel, $arr);
    return $cek;
  }
  
  function randomkode($maxlength)
  {
    $chary = array(
      "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
      "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
      "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"
    );
    $return_str = "";
    for ($x = 0; $x < $maxlength; $x++) {
      $return_str .= $chary[rand(0, count($chary) - 1)];
    }
    return $return_str;
  }
  function randomNomor($maxlength)
  {
    $chary = array(
      "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
    );
    $return_str = "";
    for ($x = 0; $x < $maxlength; $x++) {
      $return_str .= $chary[rand(0, count($chary) - 1)];
    }
    return $return_str;
  }
  public function updateUserFoto($data, $id)
  {
    $this->db->update('mdatauser', $data, ['userID' => $id]);
    return $this->db->affected_rows();
  }
}
