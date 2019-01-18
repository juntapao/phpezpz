<?php
class HTML {
    public static function a($contents, $attributes) {
        return '<a'.Common::getAttributes($attributes).'>'.$contents.'</a>';
    }
    public static function b($contents, $attributes) {
        return '<b'.Common::getAttributes($attributes).'>'.$contents.'</b>';
    }
    public static function button($contents, $attributes) {
        return '<button'.Common::getAttributes($attributes).'>'.$contents.'</button>';
    }
    public static function div($attributes) {
        return '<div'.Common::getAttributes($attributes).'>';
    }
    public static function endDiv() {
        return '</div>';
    }
    public static function endForm() {
        return '</form>';
    }
    public static function endHeader() {
        return '</header>';
    }
    public static function endMain() {
        return '</main>';
    }
    public static function endNav() {
        return '</nav>';
    }
    public static function endScript() {
        return '</script>';
    }
    public static function endStyle() {
        return '</style>';
    }
    public static function endTable() {
        return '</table>';
    }
    public static function endThead() {
        return '</thead>';
    }
    public static function endTbody() {
        return '</tbody>';
    }
    public static function endTr() {
        return '</tr>';
    }
    public static function endUl() {
        return '</ul>';
    }
    public static function form($attributes) {
        return '<form'.Common::getAttributes($attributes).'>';
    }
    public static function h1($contents, $attributes) {
        return '<h1'.Common::getAttributes($attributes).'>'.$contents.'</h1>';
    }
    public static function h2($contents, $attributes) {
        return '<h2'.Common::getAttributes($attributes).'>'.$contents.'</h2>';
    }
    public static function h3($contents, $attributes) {
        return '<h3'.Common::getAttributes($attributes).'>'.$contents.'</h3>';
    }
    public static function h4($contents, $attributes) {
        return '<h4'.Common::getAttributes($attributes).'>'.$contents.'</h4>';
    }
    public static function h5($contents, $attributes) {
        return '<h5'.Common::getAttributes($attributes).'>'.$contents.'</h5>';
    }
    public static function h6($contents, $attributes) {
        return '<h6'.Common::getAttributes($attributes).'>'.$contents.'</h6>';
    }
    public static function header($attributes) {
        return '<header'.Common::getAttributes($attributes).'>';
    }
    public static function i($contents, $attributes) {
        return '<i'.Common::getAttributes($attributes).'>'.$contents.'</i>';
    }
    public static function img($attributes) {
        return '<img'.Common::getAttributes($attributes).' />';
    }
    public static function input($attributes) {
        return '<input'.Common::getAttributes($attributes).' />';
    }
    public static function label($contents, $attributes) {
        return '<label'.Common::getAttributes($attributes).'>'.$contents.'</label>';
    }
    public static function li($contents, $attributes) {
        return '<li'.Common::getAttributes($attributes).'>'.$contents.'</li>';
    }
    public static function link($attributes) {
        return '<link'.Common::getAttributes($attributes).' />';
    }
    public static function main($attributes) {
        return '<main'.Common::getAttributes($attributes).'>';
    }
    public static function meta($attributes) {
        return '<meta'.Common::getAttributes($attributes).'>';
    }
    public static function nav($attributes) {
        return '<nav'.Common::getAttributes($attributes).'>';
    }
    public static function option($contents, $attributes) {
        return '<option'.Common::getAttributes($attributes).'>'.$contents.'</option>';
    }
    public static function p($contents, $attributes) {
        return '<p'.Common::getAttributes($attributes).'>'.$contents.'</p>';
    }
    public static function select($contents, $attributes) {
        return '<select'.Common::getAttributes($attributes).'>'.$contents.'</select>';
    }
    public static function script($attributes) {
        return '<script'.Common::getAttributes($attributes).'>';
    }
    public static function small($contents, $attributes) {
        return '<small'.Common::getAttributes($attributes).'>'.$contents.'</small>';
    }
    public static function span($contents, $attributes) {
        return '<span'.Common::getAttributes($attributes).'>'.$contents.'</span>';
    }
    public static function style() {
        return '<style>';
    }
    public static function table($attributes) {
        return '<table'.Common::getAttributes($attributes).'>';
    }
    public static function textarea($value, $attributes) {
        return '<textarea'.Common::getAttributes($attributes).'>'.$value.'</textarea>';
    }
    public static function tbody($attributes) {
        return '<tbody'.Common::getAttributes($attributes).'>';
    }
    public static function td($contents, $attributes) {
        return '<td'.Common::getAttributes($attributes).'>'.$contents.'</td>';
    }
    public static function th($contents, $attributes) {
        return '<th'.Common::getAttributes($attributes).'>'.$contents.'</th>';
    }
    public static function thead($attributes) {
        return '<thead'.Common::getAttributes($attributes).'>';
    }
    public static function title($title) {
        return '<title>'.$title.'</title>';
    }
    public static function tr($attributes) {
        return '<tr'.Common::getAttributes($attributes).'>';
    }
    public static function u($contents, $attributes) {
        return '<u'.Common::getAttributes($attributes).'>'.$contents.'</u>';
    }
    public static function ul($attributes) {
        return '<ul'.Common::getAttributes($attributes).'>';
    }
}
?>