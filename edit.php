<?php
// including the database connection file
include_once("config.php");

public function datakelas()
    {
        $arr = array();
		
		 $query = $this->db->query("select kelas,idkelas from tkelas" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        return  json_encode($arr);
    }
?>
