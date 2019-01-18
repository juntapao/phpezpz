<?php
require_once '../includes/ezpz/includes.php';
$file_name = 'Cancellation Detailed Report';
class_alias('Excel', 'X');
$result = Common::fetchAll(returnQuery());
$row = 2;
prepareSheet();
if($result) {
    foreach($result as $r) {
		X::write("A".$row, $r["control_number"]);
		X::write("B".$row, $r["from"]);
		X::write("C".$row, $r["agent_code"]);
		X::write("D".$row, $r["agent_name"]);
		X::write("E".$row, $r["sub_agent_code"]);
		X::write("F".$row, $r["sub_agent_name"]);
		X::write("G".$row, $r["policy_number"]);
		X::write("H".$row, $r["insured"]);
		X::writeDate("I".$row, $r["effectivity_from"]);
//		X::write("I".$row, PHPExcel_Shared_Date::FormattedPHPToExcel(explode("-",$r["effectivity_from"])[0], explode("-",$row["effectivity_from"])[1], explode("-",$row["effectivity_from"])[2]));
//		X::write("J".$row, PHPExcel_Shared_Date::FormattedPHPToExcel(explode("-",$r["effectivity_to"])[0], explode("-",$row["effectivity_to"])[1], explode("-",$row["effectivity_to"])[2]));
		X::write("K".$row, $r["reason_description"]);
		X::write("L".$row, $r["branch_manager"]);
		X::write("M".$row, $r["date_status"]);
		X::write("N".$row, $r["remarks"]);
//		X::write("O".$row, PHPExcel_Shared_Date::FormattedPHPToExcel(explode("-",$r["marketing_date"])[0], explode("-",$row["marketing_date"])[1], explode("-",$row["marketing_date"])[2]));
//		X::write("P".$row, PHPExcel_Shared_Date::FormattedPHPToExcel(explode("-",$r["claims_date"])[0], explode("-",$row["claims_date"])[1], explode("-",$row["claims_date"])[2]));
//		X::write("Q".$row, PHPExcel_Shared_Date::FormattedPHPToExcel(explode("-",$r["accounting_date"])[0], explode("-",$row["accounting_date"])[1], explode("-",$row["accounting_date"])[2]));
//		X::write("R".$row, PHPExcel_Shared_Date::FormattedPHPToExcel(explode("-",$r["executive_date"])[0], explode("-",$row["executive_date"])[1], explode("-",$row["executive_date"])[2]));
//		X::write("S".$row, PHPExcel_Shared_Date::FormattedPHPToExcel(explode("-",$r["underwriting_date"])[0], explode("-",$row["underwriting_date"])[1], explode("-",$row["underwriting_date"])[2]));
		X::write("T".$row, $r["endorsement_number"]);
//		X::write("U".$row, PHPExcel_Shared_Date::FormattedPHPToExcel(explode("-",$r["date_created"])[0], explode("-",$row["date_created"])[1], explode("-",$row["date_created"])[2]));
		X::formatDate("I".$row.":J".$row);
		X::formatDate("O".$row.":S".$row);
		X::formatDate("U".$row.":U".$row);
        $row++;
    }
}
X::output($file_name);
function prepareSheet() {
	X::write("A1", "CONTROL NUMBER");
	X::write("B1", "FROM");
	X::write("C1", "AGENT CODE");
	X::write("D1", "AGENT NAME");
	X::write("E1", "SUB AGENT CODE");
	X::write("F1", "SUB AGENT NAME");
	X::write("G1", "POLICY NUMBER");
	X::write("H1", "INSURED");
	X::write("I1", "EFFECTIVITY FROM");
	X::write("J1", "EFFECTIVITY TO");
	X::write("K1", "REASONS");
	X::write("L1", "BRANCH MANAGER");
	X::write("M1", "STATUS");
	X::write("N1", "REMARKS");
	X::write("O1", "MARKETING APPROVED");
	X::write("P1", "CLAIMS APPROVED");
	X::write("Q1", "ACCOUNTING APPROVED");
	X::write("R1", "EXECUTIVE APPROVED");
	X::write("S1", "UNDERWRITING APPROVED");
	X::write("T1", "ENDORSEMENT NUMBER");
	X::write("U1", "DATE CREATED");
	X::bold("A1:U1");
}
function returnQuery() {
	return "
        SELECT *,IFNULL(marketing_date, '0000-00-00') AS marketing_date
            ,IFNULL(claims_date, '0000-00-00') AS claims_date
            ,IFNULL(accounting_date, '0000-00-00') AS accounting_date
            ,IFNULL(executive_date, '0000-00-00') AS executive_date
            ,IFNULL(underwriting_date, '0000-00-00') AS underwriting_date
        FROM requests
		WHERE date_created BETWEEN '".Common::dateFormatToDB($_GET["f"])." 00:00:00' AND '".Common::dateFormatToDB($_GET["t"])." 23:59:59'
		;
	";
}
?>