<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_Export_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function import_power_calc( $file_full_path = '' ) {
		$this->load->library('Excel');
		$this->load->dbforge();
		
		//trapping error: file_exists
		if ( ! file_exists($file_full_path) ) {
			throw new Exception('The file does not exist. Please check your files and try again.', 12);
			return false;
		}
			
		$objPHPExcel = PHPExcel_IOFactory::load($file_full_path);
		
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		// var_dump($sheetData);
		
		$this->dbforge->drop_table('import_power_calc');
		$fields = array(
                        'id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'period_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'period_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'unit_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'unit_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'power_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'power_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'customer_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'customer_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'last' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'curr' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          )
                );
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('import_power_calc', TRUE);
		
		$row 	 = count($sheetData);
		//echo '<br />';
		for ( $x=2; $x <= $row; $x++ ) {
			//var_dump($sheetData[$x]);
			
			$values = '';
			$i 	 = 1;
			foreach ($sheetData[$x] as $key => $val) {
				if ( $i == 1 ) 
					$values .= "'".$sheetData[$x][$key]."'";
				else
					$values .= ", '".$sheetData[$x][$key]."'";
				//echo $values;
				
				$i++;
			} 
			//trapping error: fields on excel file not same with on the table.
			if ( $i !== 12 ) {
				throw new Exception("Wrong file excel !. The fields is not same with the table.", 12);
				return false;
			}
			
			$query = "INSERT INTO import_power_calc (id, period_id, period_name, unit_id, unit_name, power_id, power_name, customer_id, customer_name, last, curr) ";
			$query .= "VALUES ($values)";
			//echo $query;
			$this->db->query($query);
			
			//update data to table power_calc
			$query = "UPDATE power_calc pc, import_power_calc ipc SET pc.curr = ipc.curr WHERE pc.id = ipc.id";
			$this->db->query($query);
		}
		return true;
	}

	public function import_water_calc( $file_full_path = '' ) {
		$this->load->library('Excel');
		$this->load->dbforge();
		
		//trapping error: file_exists
		if ( ! file_exists($file_full_path) ) {
			throw new Exception('The file does not exist. Please check your files and try again.', 12);
			return false;
		}
			
		$objPHPExcel = PHPExcel_IOFactory::load($file_full_path);
		
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		// var_dump($sheetData);
		
		$this->dbforge->drop_table('import_water_calc');
		$fields = array(
                        'id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'period_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'period_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'unit_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'unit_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'water_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'water_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'customer_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'customer_name' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100'
                                          ),
                        'last' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'curr' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          )
                );
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('import_water_calc', TRUE);
		
		$row 	 = count($sheetData);
		//echo '<br />';
		for ( $x=2; $x <= $row; $x++ ) {
			//var_dump($sheetData[$x]);
			
			$values = '';
			$i 	 = 1;
			foreach ($sheetData[$x] as $key => $val) {
				if ( $i == 1 ) 
					$values .= "'".$sheetData[$x][$key]."'";
				else
					$values .= ", '".$sheetData[$x][$key]."'";
				//echo $values;
				
				$i++;
			} 
			//trapping error: fields on excel file not same with on the table.
			if ( $i !== 12 ) {
				throw new Exception("Wrong file excel !. The fields is not same with the table.", 12);
				return false;
			}
			
			$query = "INSERT INTO import_water_calc (id, period_id, period_name, unit_id, unit_name, water_id, water_name, customer_id, customer_name, last, curr) ";
			$query .= "VALUES ($values)";
			//echo $query;
			$this->db->query($query);
			
			//update data to table water_calc
			$query = "UPDATE water_calc pc, import_water_calc ipc SET pc.curr = ipc.curr WHERE pc.id = ipc.id";
			$this->db->query($query);
		}
		return true;
	}

	public function export_data_calc( $view = '', $period_id = '1' ) {
		$this->load->library('Excel');

		$query = $this->db->query("SELECT * FROM $view WHERE period_id = '$period_id'");
		if(!$query)
            return false;
			
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
		
		// Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }
 
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        //header('Content-Disposition: attachment;filename="'.$view.'_'.date('dMy').'.xls"');
        header('Content-Disposition: attachment;filename="'.$view.'_period_'.$period_id.'.xls"');
        header('Cache-Control: max-age=0');
		
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
	}

	
}