<?php
require_once '../includes/ezpz/includes.php';
$file_name = 'Users';
$result = Common::fetchAll("
    SELECT *
    FROM users
    WHERE `active` = 1
;");
if($_GET['t'] == 'pdf') {
    class MYPDF extends TCPDF {
        public function Header() {
            $header = HTML::table([])
                .HTML::tr([])
                .HTML::td(HTML::h1(HTML::b(NAM, []), []), ['width' => '100%', 'align' => 'center'])
                .HTML::endTr()
            .HTML::endTable();
            $GLOBALS['pdf']->writeHTML($header, false, false, false, false, '');
        }
        public function Footer() {}
    }
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetAutoPageBreak(true, 0);
    $pdf->SetPrintHeader(true);
    $pdf->setHeaderMargin(10);
    $pdf->SetMargins(10, 25, 10);
    $pdf->AddPage('P', 'A4');
    $print = HTML::table(['border' => '1']);
    $print .= HTML::tr([])
        .HTML::td(HTML::b('ID', []), [])
        .HTML::td(HTML::b('Username', []), [])
        .HTML::td(HTML::b('Role Name', []), [])
    .HTML::endTr();
    if($result) {
        foreach($result as $r) {
            $print .= HTML::tr([])
                .HTML::td($r['id'], [])
                .HTML::td($r['username'], [])
                .HTML::td($r['role_name'], [])
            .HTML::endTr();
        }
    }
    $print .= HTML::endTable();
    $pdf->writeHTML($print, false, false, false, false, '');
    $pdf->Output($file_name.'.pdf', 'I');
} elseif($_GET['t'] == 'excel') {
    Excel::bold('A1:C2');
    Excel::write('A1', NAM);
    Excel::write('A2', 'ID');
    Excel::write('B2', 'Username');
    Excel::write('C2', 'Role Name');
    $row = 3;
    if($result) {
        foreach($result as $r) {
            Excel::write('A'.$row, $r['id']);
            Excel::write('B'.$row, $r['username']);
            Excel::write('C'.$row, $r['role_name']);
            $row++;
        }
    }
    Excel::output($file_name);
}
?>