<?php
/**
 * Description of Export Controller
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Export extends CI_Controller {
  // construct
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
         $this->load->helper('download');
        // load model
        $this->load->model('Export_model', 'export');
        $this->load->library('excel');
    }    
   // export xlsx|xls file
    public function index() {
        $data['page'] = 'export-excel';
        $data['title'] = 'Export Excel data | TechArise';
        $data['employeeInfo'] = $this->export->employeeList();
    // load view file for output
        $this->load->view('export/index', $data);
    }
    // create xlsx
    public function createxls() {
        // create file name
        $fileName = 'data-'.time().'.xlsx';  
        $rowCount = 3;
        // load excel library     
        $empInfo = $this->export->employeeList();
        $objPHPExcel = new PHPExcel();
        for ($col = 'A'; $col != 'J'; $col++) {

           $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $objPHPExcel->getProperties()->setCreator("HOO")->setLastModifiedBy("HOO")
            ->setTitle("Jobs History")
            ->setSubject("PHPExcel Test Document")
            ->setDescription("Test document for PHPExcel, generated using PHP classes.")
            ->setKeywords("office PHPExcel php")
            ->setCategory("Test result file");

      
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Date of Birth');     
         $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');
         //merging the cells
         $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:A2');
         $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B1:B2');
         $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:C2');
         $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:D2');
         $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E1:E2');
        
            foreach($empInfo AS $element){
                   
             // Miscellaneous glyphs, UTF-8
             $objPHPExcel->setActiveSheetIndex(0)
                           
                ->setCellValue('A'.$rowCount, $element['first_name'])
                ->setCellValue('B'.$rowCount,$element['last_name'])
                ->setCellValue('C'.$rowCount,$element['email'])
                ->setCellValue('D'.$rowCount,$element['dob'])
                ->setCellValue('E'.$rowCount,$element['contact_no']);
                           
                $rowCount++;
            }
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('application/excel/'.$fileName);
         
       
        // download file
        //header("Content-Type: application/vnd.ms-excel");
        // header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //redirect($fileName);   
        force_download('application/excel/'.$fileName, NULL);
        //redirect('http://localhost/voting/index.php/Export/try/'.HTTP_UPLOAD_IMPORT_PATH.$fileName) ;

       
    }


    
}
?>