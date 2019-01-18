<?php
class Excel {
    public static function accounting($cells) {
    //	FORMAT_ACCOUNTING = '_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)';
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> getNumberFormat()
            -> setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_ACCOUNTING);
    }
    public static function autosizecolumn($column) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getColumnDimension($column)
            -> setAutoSize(true);
    }
    public static function bgColor($cells, $color) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> applyFromArray(
                array(
                    "fill" => array(
                        "type" => PHPExcel_Style_Fill::FILL_SOLID,
                        "color" => array("rgb" => $color)
                    )
                )
            );
    }
    public static function bold($cells) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> getFont()
            -> setBold(true);
    }
    public static function center($cells) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> applyFromArray(array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)));
    }
    public static function columnwidth($column, $size) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getColumnDimension($column)
            -> setWidth($size);
    }
    public static function compare($currentcell, $cell1, $cell2) {
        write($currentcell, "=".$cell1."=".$cell2);
        conditionalColor($currentcell, "FALSE", "FF0000");
    }
    public static function conditionalColor($cells, $text, $color) {
        $conditional = new PHPExcel_Style_Conditional();
        $conditional->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS);
        $conditional->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_EQUAL);
        $conditional->addCondition($text);
        $conditional->getStyle()->getFont()->getColor()->setRGB($color);
        $conditional->getStyle()->getFont()->setBold(true);
        $styles = $GLOBALS['sheet']->getActiveSheet()->getStyle($cells)->getConditionalStyles();
        array_push($styles, $conditional);
        $GLOBALS['sheet']->getActiveSheet()->getStyle($cells)->setConditionalStyles($styles);
    }
    public static function font($cells, $font) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> applyFromArray(
                array(
                    "font"  => array(
                        "name"  => $font
                    )
                )
            );
    }
    public static function fontcolor($cells, $color) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> applyFromArray(
                array(
                    "font"  => array(
                        "color" => array("rgb" => $color)
                    )
                )
            );
    }
    public static function fontsize($cells, $size) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> getFont()
            -> setSize($size);
    }
    public static function formatDate($cells) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> getNumberFormat()
            -> setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_XLSX14);
    }
    public static function getCellValue($cell) {
        return $GLOBALS['sheet']
            -> getActiveSheet()
            -> getCell($cell)
            -> getValue();
    }
    public static function merge($cells) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> mergeCells($cells);
    }
    public static function number($cells) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> getNumberFormat()
            -> setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    }
    public static function output($file_name) {
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($GLOBALS['sheet'], 'Xlsx');
        $writer->save('php://output');
    }
    public static function text($cells) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cells)
            -> getNumberFormat()
            -> setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
    }
    public static function write($cell, $data) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> setCellValue($cell, $data);
    }
    public static function writeDate($cell, $data) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> setCellValue($cell, $data);
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> getStyle($cell)
            -> getNumberFormat()
            -> setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
    }
    public static function writeExplicit($cell, $data) {
        if(substr($data, 0, 1) != "=")
            $GLOBALS['sheet']
                -> getActiveSheet()
                -> setCellValue($cell, $data);
        else
            $GLOBALS['sheet']
                -> getActiveSheet()
                -> setCellValueExplicit($cell, $data);
    }
    public static function writeRow($cell, $array) {
        $GLOBALS['sheet']
            -> getActiveSheet()
            -> fromArray($array, NULL, $cell);
    }
}
?>