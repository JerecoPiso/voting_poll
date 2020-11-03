 /*$objPHPExcel->setActiveSheetIndex(0);
       

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DOB');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');       
        // set Row

        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['first_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['last_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['dob']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['contact_no']);
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('application/excel/'.$fileName);
         
       
        // download file
        //header("Content-Type: application/vnd.ms-excel");
        // header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //redirect($fileName);   
        force_download('application/excel/'.$fileName, NULL);
        //redirect('http://localhost/voting/index.php/Export/try/'.HTTP_UPLOAD_IMPORT_PATH.$fileName) ;   */