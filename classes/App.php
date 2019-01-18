<?php
class App {
    public function __construct() {
        include_once '../includes/config.php';
    }
    public static function cashierList($id, $full_name) {
        EZPZ::a($full_name, ['id' => 'cashier_'.$id, 'class' => 'cashierName btn-large waves-effect waves-teal blue darken-4']);
    }
    public static function fetchCashiers() {
        return Common::fetch('cashiers');
    }
    public static function keypad() {
        EZPZ::row(['class' => 'btn-keypad']);
            self::keypad_part('1');
            self::keypad_part('2');
            self::keypad_part('3');
            self::keypad_part('4');
            self::keypad_part('5');
            self::keypad_part('6');
            self::keypad_part('7');
            self::keypad_part('8');
            self::keypad_part('9');
            EZPZ::col(['small' => '4', 'class' => 'btn-common']);
                EZPZ::a('Clear', ['id' => 'keypad_c', 'class' => 'btn-keypad btn-large waves-effect waves-light blue-grey']);
            EZPZ::endCol();
            self::keypad_part('0');
            EZPZ::col(['small' => '4', 'class' => 'btn-common']);
                EZPZ::a(EZPZ::icon('backspace', ''), ['id' => 'keypad_b', 'class' => 'btn-keypad btn-large waves-effect waves-light blue-grey']);
            EZPZ::endCol();
        EZPZ::endRow();
    }
    public static function keypad_part($number) {
        EZPZ::col(['small' => '4', 'class' => 'btn-common']);
            EZPZ::a($number, ['id' => 'keypad_'.$number, 'class' => 'btn-keypad btn-large waves-effect waves-light blue-grey']);
        EZPZ::endCol();
    }
}
?>