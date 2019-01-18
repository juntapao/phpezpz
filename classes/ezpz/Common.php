<?php
class Common {
    public static function dateFormat($date) { // YYYY-MM-DD to MM/DD/YYYY
        return date_format(date_create($date), DAT);
    }
    public static function dateFormatToDB($date) { // MM/DD/YYYY to YYYY-MM-DD
        return date('Y-m-d', strtotime($date));
    }
    public static function delete($table, $id, $hard_delete) {
        if($hard_delete) {
            $query = $GLOBALS['pdo']->prepare("
                DELETE FROM `".$table."`
                WHERE `id` = ".$id."
            ;");
        } else {
            $query = $GLOBALS['pdo']->prepare("
                UPDATE `".$table."`
                SET `active` = 0
                    ,`user_modified` = ".$_SESSION[APP.'_user_id']."
                WHERE `id` = ".$id."
            ;");
        }
        $result = $query->execute();
        if($result) return $result;
        else return addslashes(htmlspecialchars($query->errorInfo()[2], true));
    }
    public static function execute($query) {
        $query = $GLOBALS['pdo']->prepare($query);
        $result = $query->execute();
        if($result) return $result;
        else return addslashes(htmlspecialchars($query->errorInfo()[2], true));
    }
    public static function fetch($table) {
        return self::fetchAll("
            SELECT *
                ,DATE_FORMAT(`date_created`,'%m/%d/%Y %I:%i %p') AS created
                ,DATE_FORMAT(`date_modified`,'%m/%d/%Y %I:%i %p') AS modified
            FROM `".$table."`
            WHERE `active` = 1
        ;");
    }
    public static function fetchAll($query) {
        $query = $GLOBALS['pdo']->prepare($query);
        $query->execute();
        return $query->fetchAll();
    }
    public static function fetchChildMenu() {
        return self::fetchAll("
            SELECT m.`name`, m.`label`, m.`parent`, m.`link`, m.`icon`
                ,(SELECT `label` FROM menus WHERE `name` = m.`parent`) AS parent_label
                ,(SELECT `icon` FROM menus WHERE `name` = m.`parent`) AS parent_icon
            FROM menus AS m
            WHERE m.`active` = 1
                AND m.`id` in (".(isset($_SESSION[APP.'_menu_access']) ? $_SESSION[APP.'_menu_access'] : '').")
            ORDER BY IF(`parent` IS NULL, `label`, (SELECT `label` FROM menus WHERE `name` = m.`parent`))
        ;");
    }
    public static function fetchOne($query) {
        $query = $GLOBALS['pdo']->prepare($query);
        $query->execute();
        return $query->fetch();
    }
    public static function fetchParentMenu() {
        return self::fetchAll("
            SELECT `name`,`label`,`icon`
            FROM menus
            WHERE `active` = 1
                AND `name` IN (SELECT DISTINCT `parent` FROM menus WHERE `id` in (".(isset($_SESSION[APP.'_menu_access']) ? $_SESSION[APP.'_menu_access'] : '')."))
                AND `link` IS NULL
            ORDER BY `label`
        ;");
    }
    public static function fetchSelectData($table, $value_field, $name_field, $condition, $group_field, $order_field) {
        $return = array();
        $result = self::fetchAll("
            SELECT `".$value_field."` AS value
                ,`".$name_field."` AS name
            FROM `".$table."`
            WHERE `active` = 1
                ".($condition ? "AND ".$condition : "")."
            ".($group_field ? "GROUP BY `".$group_field."`" : "")."
            ORDER BY `".$order_field."`
        ;");
        foreach($result as $value=>$row)
            $return[$row['value']] = $row['name'];
        return $return;
    }
    public static function get($table, $field, $key) {
        return self::fetchOne("
            SELECT *
                ,DATE_FORMAT(`date_created`,'%m/%d/%Y %I:%i %p') AS created
                ,DATE_FORMAT(`date_modified`,'%m/%d/%Y %I:%i %p') AS modified
            FROM `".$table."`
            WHERE `active` = 1
                AND `".$field."` = '".$key."'
        ;");
    }
    public static function getAttributes($attributes) {
        $keys = array_keys($attributes);
        $return = '';
        $counter = 0;
        foreach($attributes as $value) {
            if($value) $return .= $keys[$counter].'="'.$value.'" ';
            else $return .= $keys[$counter].' ';
            $counter++;
        }
        return ($counter ? ' ' : '').substr($return, 0, -1);
    }
    public static function getClassColor() {
        switch(DES) {
            case 'Materialize':
                switch(THM) {
                    case 'blue': return ' blue darken-4'; break;
                    case 'grey': return ' grey darken-2'; break;
                    case 'green': return ' green darken-4'; break;
                    case 'red': return ' red darken-4'; break;
                    case 'yellow': return ' yellow darken-2 black-text'; break;
                    case 'cyan': return ' cyan darken-2'; break;
                    case 'light': return ' grey lighten-5 black-text'; break;
                    case 'purple': return ' purple darken-4'; break;
                    default : return ' grey darken-4'; break;
                } 
                break;
            case 'Bootstrap':
                switch(THM) {
                    case 'blue': return ' bg-primary navbar-dark text-white'; break;
                    case 'grey': return ' bg-secondary navbar-dark text-white'; break;
                    case 'green': return ' bg-success navbar-dark text-white'; break;
                    case 'red': return ' bg-danger navbar-dark text-white'; break;
                    case 'yellow': return ' bg-warning navbar-light text-black'; break;
                    case 'cyan': return ' bg-info navbar-dark text-white'; break;
                    case 'light': return ' bg-light navbar-light text-black'; break;
                    case 'purple': return ' bg-purple navbar-dark text-white'; break;
                    default: return ' bg-dark navbar-dark text-white'; break;
                }
                break;
        }
    }
}
?>