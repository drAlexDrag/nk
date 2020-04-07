<?php
// Require composer autoload
require_once __DIR__ . '../vendor/autoload.php';
require 'connect.php';
// require_once "phpdebug/phpdebug.php";//вывод в консоль
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4'
]);
// $debug = new PHPDebug();
$output = '';
$output_department = '';
$titul = '';
// Write some HTML code:

$beansunit = R::getAll('SELECT * FROM unit WHERE unit_name IS NOT NULL AND id<>1 ORDER BY unit_name');
$zagol.='<ul>';
  foreach($beansunit as $rowunit)
 {
     // $outputunit .='<h1>'.$rowunit["unit_name"].'</h1>';
     $zagol .='<li><a href="#'.$rowunit["unit_name"].'" >'.$rowunit["unit_name"].'</li></a>';
     $dataunit[]=$rowunit['id'];
 }
   $zagol.='</ul>';  
// $dataunit = array(4, 7);
// $debug->debug("подготовили массив управлений", null, LOG);

foreach ($dataunit as $valueunit) {
    # code...
// $debug->debug($valueunit, null, LOG);
// $output_unit.='<h1 style="text-align: center">'.$valueunit.'</h1><br>';
$beansdep=R::getAll('SELECT DISTINCT ncatalog.department_id, department.department_name FROM ncatalog
     INNER JOIN department ON ncatalog.department_id = department.id
    WHERE ncatalog.unit_id=?   ORDER BY department.department_name', [$valueunit]);
foreach($beansdep as $rowdep){
    // $debug->debug("получаем список подразделений по управлению", null, LOG);
	$dep[]=$row['department_id']; 
// }


// foreach ($dep as $rowdep){
$beans=R::getAll('SELECT ncatalog.id, ncatalog.ncatalog_name, ncatalog.ncatalog_number, ncatalog.department_id, ncatalog.ncatalog_cabinet, ncatalog.unit_id, ncatalog.visibility, ncatalog.authority, department.department_name, unit.unit_name
    from ncatalog
    INNER JOIN unit ON ncatalog.unit_id = unit.id
     INNER JOIN department ON ncatalog.department_id = department.id
    WHERE ncatalog.unit_id=? AND ncatalog.department_id=? AND visibility NOT IN ("0") ORDER BY authority ASC', [$valueunit, $rowdep['department_id']]);
// var_dump($beans);

// $output_department .= '<div style="width: 100%">
$output_department .= '
    <table style="width: 100%; border-collapse: collapse;">';
                foreach($beans as $row)
 {
           $output_department .= '
        <tr style="width: 100%">';
            $output_department .= '<td style="width: 70%; border:1px solid black">'.$row["ncatalog_name"].'</td>';
            $output_department .= '<td style="width: 10%; border:1px solid black">'.$row["ncatalog_number"].'</td>';
            $output_department .= '<td style="width: 20%; border:1px solid black">'.$row["ncatalog_cabinet"].'</td>
        </tr>';
         }
 // $output_department .= '</table></div>';
  $output_department .= '</table>';
 $output.='<h3 style="color: black">'.$row["department_name"].'</h3>';
 $output.=$output_department;
 $output_department='';

}
$output_unit.='<a name="'.$row['unit_name'].'"></a><h1 style="text-align: center; color:blue">'.$row['unit_name'].'</h1>';
// $output_unit.=$output;
$alloutput.=$output_unit.$output;
$output_unit='';
$output='';

}
$date = date('d/m/Y H:i:s', time());
// Титульная страница
$mpdf->SetXY(100, 100);
$titul='<div><h1 style="text-align: center">Справочник телефонов</h1><br><h1 style="text-align: center">ОАО Интеграл</h1></div>';
// $mpdf->Image('/images/alpha.jpg', 0, 0, 210, 297, 'jpg', '', true, true);
$titul.='<p style="text-align: center">Сформировано по состоянию на '.$date.'</p>';
// $titul='|Справочник телефонов ОАО Интеграл|';

$mpdf->SetFooter('Сформировано по состоянию на||'.$date.'');
$mpdf->WriteHTML($titul);
// $mpdf->WriteText(50, 100, 'Сформировано по состоянию на '.$date.'');
$mpdf->AddPage();
$mpdf->SetFooter('');
$mpdf->WriteHTML($zagol);
$mpdf->AddPage();
// $print_out.=$zagol;
// $mpdf->WriteHTML($titul);
// $mpdf->WriteHTML('<tocpagebreak />');
// $print_out ='<h1 style="text-align: center">'.$row['unit_name'].'</h1><br>';
// $print_out.=$titul;

$print_out.=$alloutput;
// $mpdf->SetHeader($row['unit_name']);
// $date = date('d/m/Y H:i:s', time());
$mpdf->SetFooter($date);
$mpdf->WriteHTML($print_out);
// Output a PDF file directly to the browser
$date = date('d/m/Y');
header('Set-Cookie:fileDownload=true; path=/catalog');
 header('Content-Disposition: attachment; filename="Справочник телефонов за '.$date.'.pdf"');
 header("Content-Type: application/document");

$mpdf->Output('php://output');//('download/Справочник телефонов.pdf');
//$mpdf->Output('catalog.pdf');
// echo  $print_out;
// die();
?>