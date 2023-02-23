<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usagePrint extends CI_Controller {

	    public function __construct() {
        parent::__construct();
		/*if($this->session->userdata('admin_valid') != TRUE ){
			redirect("login");
		}*/
        //$this->load->model('mkaryawan');
    }
    
    public function dataUserDepartment()
    {
        $arr = array();
		
		 $query = $this->db->query("select distinct UserDepartment  FROM  mdepartement where  UserDepartment is not null" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        echo json_encode($arr);
    }

    public function dataPrinterModel()
    {
        $arr = array();
		
		 $query = $this->db->query("select distinct PrinterModel  FROM  mprinter_model where  PrinterModel is not null" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        echo json_encode($arr);
    }

    public function dataPrinterLoc()
    {
        $arr = array();
		
		 $query = $this->db->query("select distinct Section as PrinterLoc FROM  tphoto_copier where  Section is not null" );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        echo json_encode($arr);
    }
    
    public function datasite()
    {
        $arr = array();
		
		 $query = $this->db->query("select distinct site as datasite  FROM  tphoto_copier where  site is not null union select 'ALL' " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        echo json_encode($arr);
    }
    public function Site()
    {
        $arr = array();
		
		 $query = $this->db->query("select distinct Site  FROM  tphoto_copier where  site is not null union select 'ALL'  " );

        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
        }
        echo json_encode($arr);
    }
  public function showdata()
  {
        $arr = array();
        $where = "";
        $flagsrc=$this->input->get('flagsrc');
        $tgl=$this->input->get('tgl');
        $site=$this->input->get('site');
       
        
          
            if ($site=="ALL")
            {
                $where = "where (format(month,'MMM-yyyy') = '$tgl' )";
            }
            else
            {
                $where = "where (format(month,'MMM-yyyy') = '$tgl' ) and lower(site) = '". strtolower($site) ."' ";
            }
        
        //echo "Select idphoto_copier,Site,Section,PrinterModel,format(month,'MMM-yyyy') as Month,UserDepartment,Usage  from tphoto_copier   " .$where. "  order by idphoto_copier desc";

		$sql = "Select idphoto_copier,Site,Section,PrinterModel,format(month,'MMM-yyyy') as Month,UserDepartment,Usage, ColTotalUsg,BwTotalUsg,	ColCopy,ColScan,ColPrint,BWCopy,BWScan,	BWPrint  from tphoto_copier   " .$where. "  order by idphoto_copier desc";

	
        $query = $this->db->query($sql);
	
        foreach($query->result_object() as $rows )
        {
            $arr[] = $rows;
			
        }
           
            echo  json_encode($arr);
    }

  public function savedata()
  {
      
        $field=$this->input->post('arr');
          $field1=json_decode($field,true);
    
        $save=0; 
        $tgl = date("Y-m-d");
        foreach ($field1 as $val)
        {
            $Site=$val['Site'];
            // echo $Site;
            $Add = $val['Add'];
            $Section=$val['Section'];
            $PrinterModel=$val['PrinterModel'];
            $date = new DateTime($val['Month']);
            $date->modify('+1 day');
              $Month =  $date->format('Y-m-d');
            $UserDepartment=$val['UserDepartment'];
            $Usage=$val['Usage'];
	    $model =$this->db->query("select TOP 1 PrinterID FROM  mprinter_model where  PrinterModel = '".$PrinterModel."'   " );
	    

            if ($val['Site'] != '' && $val['Section'] != '' && $val['PrinterModel'] != ''&& $val['Month'] != '' && $val['UserDepartment'] != '' && $val['Usage'] > 0 && $val['Add'] = 1)
			{
	
				$query = $this->db->query("insert into tphoto_copier (Site,Section,PrinterModel,Month,UserDepartment,Usage,createdate) 
								           values ('$Site','$Section','$PrinterModel','$Month','$UserDepartment','$Usage','$tgl')");
		
                            if($query)        
                                 { $save = 1;  }
                             else
                                  {$save = 0; }
			}
            else
            {
                $message = [
					'status' => false,
					'message' => "Please fill in the blank data"
				  ];
				  echo json_encode($message);
            }
			
        }
            if($save === 1)        
            {          
                $message = [
                    'status' => true,
                    'message' => "Insert Success"
                ];
                echo json_encode($message);
            }
            else
            {
                $message = [
                    'status' => true,
                    'message' => "Error Update"
                ];
                echo json_encode($message);
            }
           
    }
    public function updatedata()
    {
          $field=$this->input->post('arr');
          $field1=json_decode($field,true);
          $tgl1 = date("Y-m-d");
          $save=0; 
          foreach ($field1 as $val)
          {
              $idphoto_copier=$val['idphoto_copier'];
              $Site=$val['Site'];
              $Section=$val['Section'];
              $PrinterModel=$val['PrinterModel'];
              $date = new DateTime($val['Month']);
              $date->modify('+1 day');
              $Month =  $date->format('Y-m-d');

              $UserDepartment=$val['UserDepartment'];
              $Usage=$val['Usage'];
              
              
              if ($val['Section'] !== '' && $val['PrinterModel'] !== '' && $val['Month'] !== '' && $val['UserDepartment'] !== '' && $val['Usage'] !== '')
              {
             
                  $query = $this->db->query("update tphoto_copier set Site = '$Site',Section='$Section',PrinterModel='$PrinterModel',Month='$Month',UserDepartment='$UserDepartment',Usage='$Usage',updatedate='$tgl1' where  idphoto_copier = '$idphoto_copier' "); 
                  if($query)        
                    { $save = 1;  }
                  else
                    {$save = 0; }
			}
            else
            {
                $message = [
					'status' => false,
					'message' => "Please fill in the blank data"
				  ];
				  echo json_encode($message);
            }
        }
             
                if($save === 1)        
                {          
                    $message = [
                        'status' => true,
                        'message' => "Update Success"
                    ];
                    echo json_encode($message);
                }
                else
                {
                    $message = [
                        'status' => true,
                        'message' => "Error Update"
                    ];
                    echo json_encode($message);
                }

    }

      public function deletedata()
    {
          $field=$this->input->get('arr');
      
        
         
              $idphoto_copier=$this->input->get('idphoto_copier');
              
            
              if ($idphoto_copier !== '' )
              {

               
                  $query = $this->db->query("delete from tphoto_copier where  idphoto_copier = '$idphoto_copier' "); 
                  if($query)        
                  {
                    $message = [
                        'status' => true,
                        'message' => "Data Deleted"
                    ];
                  }
                  else     
                  {
                    $message = [
                        'status' => false,
                        'message' => "Data Not Deleted"
                    ];
                  }
				  echo json_encode($message);                           
              }
              
        
             
      }
}
