<?php
class Login {
    public function __construct() {
        include_once '../includes/config.php';
    }
    public static function validate($username, $password) {
        $query = $GLOBALS['pdo']->prepare("
            SELECT c.`id`, c.`full_name`
            FROM cashiers AS c
            WHERE c.`active` = 1
                AND c.`id` = '".$id."'
                AND c.`pin` = MD5('".$pin."')
        ;");
        $query->execute();
        $result = $query->fetch();
        if($result) {
            $_SESSION[APP.'_cashier_id'] = $result['id'];
            $_SESSION[APP.'_full_name'] = $result['full_name'];
            $_SESSION[APP.'_success_message'] = 'Welcome '.$result['full_name'].'!';
            return $result;
        }
        return null;
    }
    public static function getSystemValue($setting_name) {
        $query = $GLOBALS['pdo']->prepare("
            SELECT `value`
            FROM `settings`
            WHERE `active` = 1
                AND `name` = '".substr($setting_name, strlen(APP) - strlen($setting_name))."'
        ;");
        $query->execute();
        $setting = $query->fetch();
        $_SESSION[$setting_name] = $setting['value'];
    }
}
?>