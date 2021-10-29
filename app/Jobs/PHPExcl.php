<?php

namespace App\Jobs;
use PHPExcel; 
use PHPExcel_IOFactory;
use PHPExcel_Style;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Border;
use PHPExcel_Writer_Excel2007;
use File;
use Str;
class PHPExcl
{
    public function createFile($clubs){

    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $main = new PHPExcel_Style();
    $table= new PHPExcel_Style();
    $yellow= new PHPExcel_Style();
    $bold= new PHPExcel_Style();
    $main->applyFromArray(
        array('fill'    => array(
            'type'      => PHPExcel_Style_Fill::FILL_SOLID,
            'color'     => array('rgb' => 'D3D3D3')
            ),
            'borders' => array(
                'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right'     => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            ),
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '000000'),
                'size'  => 16,
                'name'  => 'Calibri'
            )
    ));
    $yellow->applyFromArray(
        array(
            'fill'    => array(
                'type'      => PHPExcel_Style_Fill::FILL_SOLID,
                'color'     => array('rgb' => 'FFFF00')
        ),
        'font'  => array(
            'bold'  => true,
            'name'  => 'Calibri'
        )
    ));
    $bold->applyFromArray(
        array( 'font'  => array(
            'bold'  => true,
            'name'  => 'Calibri'
        )
    ));
    $table=array('borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('argb' => '766f6e')
        )
        )
     );
    $rowCount = 1;
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
    
    
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'№')->setSharedStyle($main, 'A'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,'Название')->setSharedStyle($main, 'B'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,'Город')->setSharedStyle($main, 'C'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,'Адрес')->setSharedStyle($main, 'D'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,'Регион')->setSharedStyle($main, 'E'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,'Email')->setSharedStyle($main, 'F'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,'Телефон')->setSharedStyle($main, 'G'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,'Клуб на сайте')->setSharedStyle($main, 'H'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,'Внешняя ссылка')->setSharedStyle($main, 'I'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,'Ссылка на Instagram')->setSharedStyle($main, 'J'.$rowCount);
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,'группа вк')->setSharedStyle($main, 'K'.$rowCount);
    
    

    $objPHPExcel->getActiveSheet()->getStyle("A".$rowCount.":A".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("B".$rowCount.":B".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("C".$rowCount.":C".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("D".$rowCount.":D".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("E".$rowCount.":E".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("F".$rowCount.":F".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("G".$rowCount.":G".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("H".$rowCount.":H".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("I".$rowCount.":I".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("J".$rowCount.":J".($rowCount + count($clubs)))->applyFromArray($table);
    $objPHPExcel->getActiveSheet()->getStyle("K".$rowCount.":K".($rowCount + count($clubs)))->applyFromArray($table);
    $rowCount = 2;
    foreach($clubs as $club){
    
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,strval($club->id));
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$club->club_name);
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$club->city->name);
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$club->club_address);
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$club->city->parentName);
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$club->club_email);
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$club->phone);
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name));
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$club->club_link);
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,$club->club_instagram_link);
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,$club->club_vk_link);
        $rowCount ++;
    }
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="club_list.xls"');
    $objWriter->save('php://output');
}

}?>