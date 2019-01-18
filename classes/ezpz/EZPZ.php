<?php
class EZPZ {
    public function __construct() {
        include_once '../includes/config.php';
    }
    public static function a($contents, $attributes) {
        echo HTML::a($contents, $attributes);
    }
    public static function asterisk() {
        $classes = '';
        switch(DES) {
            case 'Materialize': $classes = 'fa-xs red-text'; break;
            case 'Bootstrap': $classes = 'text-danger'; break;
        }
        return '&nbsp;'.self::icon('asterisk', 'fa-xs'.($classes ? ' '.$classes : ''));
    }
    public static function button($label, $options) {
        $class = 'btn';
        $keys = array_keys($options);
        $counter = 0;
        $attributes = array();
        switch(DES) {
            case 'Materialize':
                foreach($options as $value) {
                    switch($keys[$counter]) {
                        case 'class': $class .= ' '.$value; break;
                        case 'purpose': 
                            switch($value) {
                                case 'success': $class .= ' green'; break;
                            }
                            break;
                        case 'type': $attributes['type'] = $value; break;
                        default: $attributes[$keys[$counter]] = $value;
                    }
                    $counter++;
                }
                break;
            case 'Bootstrap':
                foreach($options as $value) {
                    switch($keys[$counter]) {
                        case 'class': $class .= ' '.$value; break;
                        case 'purpose': 
                            switch($value) {
                                case 'success': $class .= ' btn-success'; break;
                            }
                            break;
                        case 'type': $attributes['type'] = $value; break;
                        default: $attributes[$keys[$counter]] = $value;
                    }
                    $counter++;
                }
                break;
        }
        $attributes['class'] = $class;
        echo HTML::button($label, $attributes);
    }
    public static function checkbox($id, $label, $value, $required, $size, $attributes) {
        if($value) {
            $attributes['value'] = '1';
            $attributes_dummy['checked'] = 'checked';
        } else {
            $attributes['value'] = '0';
        }
        if($required) $attributes_dummy['required'] = '';
        $attributes['id'] = $id;
        $attributes['name'] = $id;
        $attributes['type'] = 'hidden';
        $attributes_dummy['id'] = $id.'_dummy';
        $attributes_dummy['type'] = 'checkbox';
        if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '']);
        switch(DES) {
            case 'Materialize':
                self::p(HTML::label(HTML::input($attributes_dummy).HTML::span($label.($required ? ' '.self::asterisk() : ''), []), []), []);
                self::input($attributes);
                break;
        }
        if($size) self::endCol();
    }
    public static function class($class_name) {
        self::include('../classes/'.$class_name.'.php');
    }
    public static function container($attributes) {
        $attributes['class'] = 'container'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
        self::div($attributes);
    }
    public static function col($options) {
        $attributes = array();
        $class = 'col';
        $counter = 0;
        $keys = array_keys($options);
        switch(DES) {
            case 'Materialize':
                foreach($options as $value) {
                    switch($keys[$counter]) {
                        case 'class': $class .= ' '.$value; break;
                        case 'for-input': $class .= ' input-field'; break;
                        case 'large': $class .= ' l'.$value; break;
                        case 'medium': $class .= ' m'.$value; break;
                        case 'small': $class .= ' s'.$value; break;
                        default: $attributes[$keys[$counter]] = $value;
                    }
                    $counter++;
                }
                break;
            case 'Bootstrap':
                foreach($options as $value) {
                    switch($keys[$counter]) {
                        case 'class': $class .= ' '.$value; break;
                        case 'for-input': $class .= ' form-group'; break;
                        case 'large': $class .= ' col-lg-'.$value; break;
                        case 'medium': $class .= ' col-md-'.$value; break;
                        case 'small': $class .= ' col-sm-'.$value; break;
                        default: $attributes[$keys[$counter]] = $value;
                    }
                    $counter++;
                }
                break;
        }
        $attributes['class'] = $class;
        self::div($attributes);
    }
    public static function confirmation() {
        switch(DES) {
            case 'Materialize':
                self::div(['id' => 'ezpz_confirmation', 'class' => 'modal']);
                    self::div(['class' => 'modal-content']);
                        self::h5('', ['class' => 'modal-title']);
                        self::p('', ['class' => 'modal-body']);
                    self::endDiv();
                    self::div(['class' => 'modal-footer']);
                        self::button(self::icon('thumbs-up', '').' Yes', ['id' => 'ezpz_modal_yes_confirmation', 'type' => 'button', 'class' => 'modal-action waves-effect waves-green btn-flat']);
//                        echo HTML::button(self::icon('thumbs-up', '').' Yes', ['id' => 'ezpz_modal_yes_confirmation', 'type' => 'button', 'class' => 'modal-action waves-effect waves-green btn-flat']);
                        echo HTML::button(self::icon('thumbs-down', '').' No', ['type' => 'button', 'class' => 'modal-action waves-effect waves-green btn-flat modal-close']);
                    self::endDiv();
                self::endDiv();
                break;
            case 'Bootstrap':
                self::div(['id' => 'ezpz_confirmation', 'class' => 'modal fade', 'tabindex' => '-1', 'role' => 'dialog', 'aria-hidden' => 'true']);
                    self::div(['class' => 'modal-dialog', 'role' => 'document']);
                        self::div(['class' => 'modal-content']);
                            self::div(['class' => 'modal-header']);
                                self::h5('', ['class' => 'modal-title']);
                            self::endDiv();
                            self::div(['class' => 'modal-body']); self::endDiv();
                            self::div(['class' => 'modal-footer']);
                                echo HTML::button(self::icon('thumbs-up', '').' Yes', ['id' => 'ezpz_modal_yes_confirmation', 'type' => 'button', 'class' => 'btn btn-outline-success']);
                                echo HTML::button(self::icon('thumbs-down', '').' No', ['type' => 'button', 'class' => 'btn btn-outline-primary', 'data-dismiss' => 'modal']);
                            self::endDiv();
                        self::endDiv();
                    self::endDiv();
                self::endDiv();
                break;
        }
    }
    public static function date($id, $label, $value, $required, $size, $attributes) {
        if($value) $attributes['value'] = Common::dateFormat($value);
        if($required) $attributes['required'] = ''; 
        $attributes['id'] = $id;
        $attributes['name'] = $id;
        $attributes['type'] = 'text';
        if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '']);
        switch(DES) {
            case 'Materialize':
                $attributes['class'] = 'datepicker'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                self::input($attributes);
                echo HTML::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                break;
            case 'Bootstrap':
                $attributes['class'] = 'form-control datepicker'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                echo HTML::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]).HTML::input($attributes);
                break;
        }
        if($size) self::endCol();
    }
    public static function div($attributes) {
        echo HTML::div($attributes);
    }
    public static function email($id, $label, $value, $required, $size, $attributes) {
        if($value) $attributes['value'] = $value;
        if($required) $attributes['required'] = ''; 
        $attributes['id'] = $id;
        $attributes['name'] = $id;
        $attributes['type'] = 'email';
        if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '']);
        switch(DES) {
            case 'Materialize':
                echo HTML::input($attributes).HTML::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                break;
            case 'Bootstrap':
                $attributes['class'] = 'form-control'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                echo HTML::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]).HTML::input($attributes);
                break;
        }
        if($size) self::endCol();
    }
    public static function endCol() {
        echo HTML::endDiv();
    }
    public static function endContainer() {
        echo HTML::endDiv();
    }
    public static function endDiv() {
        echo HTML::endDiv();
    }
    public static function endForm() {
        echo HTML::endForm();
    }
    public static function endLoginCard() {
        switch(DES) {
            case 'Materialize':
                            echo HTML::endDiv();
                        echo HTML::endDiv();
                    echo HTML::endDiv();
                    echo HTML::div(['class' => 'col s12 m2']).HTML::endDiv();
                echo HTML::endDiv();
                break;
            case 'Bootstrap':
                        echo HTML::endDiv();
                        echo HTML::div(['class' => 'col-sm-12 col-md-2']).HTML::endDiv();
                    echo HTML::endDiv();
                echo HTML::endDiv();
                break;
        }
    }
    public static function endMainContainer() {
        echo HTML::endDiv();
        echo HTML::endMain();
    }
    public static function endRow() {
        echo HTML::endDiv();
    }
    public static function endSaveForm($id, $parameter, $class) {
        self::hidden('ezpz_id', 'id', $id);
        self::hidden('ezpz_token', '_token', $_SESSION[APP.'_token']);
        self::hidden('ezpz_parameter', 'param', $parameter);
        self::hidden('ezpz_class', 'class', $class);
        echo HTML::endForm();
    }
    public static function endStyle() {
        echo HTML::endStyle();
    }
    public static function endTable($parameter, $class) {
        echo HTML::endTbody();
        echo HTML::endTable();
        if($parameter) {
            echo HTML::form(['id' => 'ezpz_form', 'action' => '../includes/ezpz/delete.php', 'method' => 'post']);
                self::hidden('ezpz_id', 'id', '');
                self::hidden('ezpz_token', '_token', $_SESSION[APP.'_token']);
                self::hidden('ezpz_parameter', 'param', $parameter);
                self::hidden('ezpz_class', 'class', $class);
            echo HTML::endForm();
        }
    }
    public static function endTd() {
        echo HTML::endTd();
    }
    public static function endTr() {
        echo HTML::endTr();
    }
    public static function endUl() {
        echo HTML::endUl();
    }
    public static function failure($message) {
        switch(DES) {
            case 'Materialize':
                echo HTML::script([]);
                    echo 'M.toast({html: "'.addslashes($message).'", displayLength: 20000});';
                echo HTML::endScript();
                break;
            case 'Bootstrap':
                echo HTML::div(['class' => 'container']);
                    echo HTML::div(['class' => 'alert alert-danger alert-dismissible fade show', 'role' => 'alert']);
                        echo $message;
                        echo HTML::button(HTML::span('&times;', ['aria-hidden' => 'true']), ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']);
                    echo HTML::endDiv();
                echo HTML::endDiv();
                break;
        }
    }
    public static function field($field) {
        switch(DES) {
            case 'Materialize':
                self::row('');
                    self::col(['small' => '12', 'medium' => '6']);
                        echo $field;
                    self::endCol();
                self::endRow();
                break;
        }
    }
    public static function file($id, $label, $value, $required, $size, $attributes) {
        if($value) $attributes['value'] = $value;
        if($required) $attributes['required'] = ''; 
        $attributes['id'] = $id;
        $attributes['name'] = $id;
        $attributes['type'] = 'file';
        switch(DES) {
            case 'Materialize':
                if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '', 'class' => 'file-field']);
//                echo HTML::input($attributes).HTML::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                self::div(['class' => 'btn']);
                    self::span($label.($required ? ' '.self::asterisk() : ''), []);
                    self::input($attributes);
                self::endDiv();
                self::div(['class' => 'file-path-wrapper']);
                    self::input(['class' => 'file-path validate', 'type' => 'text']);
                self::endDiv();
                break;
            case 'Bootstrap':
                if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '']);
                $attributes['class'] = 'form-control'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                echo HTML::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]).HTML::input($attributes);
                break;
        }
        if($size) self::endCol();
    }
    public static function final() {
        self::include('../includes/ezpz/final.php');
    }
    public static function form($attributes) {
        echo HTML::form($attributes);
    }
    public static function h1($contents, $attributes) {
        echo HTML::h1($contents, $attributes);
    }
    public static function h2($contents, $attributes) {
        echo HTML::h2($contents, $attributes);
    }
    public static function h3($contents, $attributes) {
        echo HTML::h3($contents, $attributes);
    }
    public static function h4($contents, $attributes) {
        echo HTML::h4($contents, $attributes);
    }
    public static function h5($contents, $attributes) {
        echo HTML::h5($contents, $attributes);
    }
    public static function h6($contents, $attributes) {
        echo HTML::h6($contents, $attributes);
    }
    public static function hidden($id, $name, $value) {
        $attributes['id'] = $id;
        $attributes['name'] = $name;
        $attributes['type'] = 'hidden';
        if($value) $attributes['value'] = $value;
        echo HTML::input($attributes);
    }
    public static function icon($name, $classes) {
        return HTML::i('', ['class' => 'fas fa-'.$name.($classes ? ' '.$classes : '')]);
    }
    public static function img($attributes) {
        echo HTML::img($attributes);
    }
    public static function include($full_path) {
        include_once $full_path;
    }
    public static function information() {
        switch(DES) {
            case 'Materialize':
                echo HTML::div(['id' => 'ezpz_information', 'class' => 'modal']);
                    echo HTML::div(['class' => 'modal-content']);
                        echo HTML::h5('', ['class' => 'modal-title']);
                        echo HTML::p('', ['class' => 'modal-body']);
                    echo HTML::endDiv();
                    echo HTML::div(['class' => 'modal-footer']);
                        echo HTML::button(self::icon('thumbs-down', '').' No', ['type' => 'button', 'class' => 'modal-action waves-effect waves-green btn-flat modal-close']);
                    echo HTML::endDiv();
                echo HTML::endDiv();
                break;
            case 'Bootstrap':
                break;
        }
    }
    public static function initial() {
        self::include('../includes/ezpz/initial.php');
    }
    public static function input($attributes) {
        echo HTML::input($attributes);
    }
    public static function label($contents, $attributes) {
        echo HTML::label($contents, $attributes);
    }
    public static function link($attributes) {
        echo HTML::link($attributes);
    }
    public static function loading() {
        switch(DES) {
            case 'Materialize':
                $html = HTML::div(['class' => 'circle-clipper left']).HTML::div(['class' => 'circle']).HTML::endDiv().HTML::endDiv().
                    HTML::div(['class' => 'gap-patch']).HTML::div(['class' => 'circle']).HTML::endDiv().HTML::endDiv().
                    HTML::div(['class' => 'circle-clipper right']).HTML::div(['class' => 'circle']).HTML::endDiv().HTML::endDiv();
                self::div(['id' => 'ezpz_loading', 'style' => 'height: 100%; width: 100%; background: rgba(255, 255, 255, 0.6); position: fixed; top: 0px; z-index: 9999999;']);
                    self::div(['style' => 'position: absolute; width: 0px; z-index: 2000000000; left: 50%; top: 50%;']);
                        self::div(['class' => 'preloader-wrapper big active']);
                            echo HTML::div(['class' => 'spinner-layer spinner-blue']).$html.HTML::endDiv();
                            echo HTML::div(['class' => 'spinner-layer spinner-red']).$html.HTML::endDiv();
                            echo HTML::div(['class' => 'spinner-layer spinner-yellow']).$html.HTML::endDiv();
                            echo HTML::div(['class' => 'spinner-layer spinner-green']).$html.HTML::endDiv();
                        self::endDiv();
                    self::endDiv();
                self::endDiv();
                break;
            case 'Bootstrap':
                self::div(['id' => 'ezpz_loading', 'style' => 'height: 100%; width: 100%; background: rgba(255, 255, 255, 0.6); position: fixed; top: 0px; z-index: 9999999;']);
                    self::div(['class' => 'align-middle progress']);
                        echo HTML::div(['class' => 'progress-bar progress-bar-striped progress-bar-animated', 'role' => 'progressbar', 'aria-valuenow' => '100', 'aria-valuemin' => '0', 'aria-valuemax' => '100', 'style' => 'width: 100%;']).HTML::endDiv();
                    self::endDiv();
                self::endDiv();
                break;
        }
    }
    public static function loginCard($image_url, $title) {
        switch(DES) {
            case 'Materialize':
                self::div(['class' => 'row']);
                    self::div(['class' => 'col s12 m2']); self::endDiv();
                    self::div(['class' => 'col s12 m8']);
                        self::div(['class' => 'card large']);
                            self::div(['class' => 'card-image']);
                                self::img(['src' => $image_url]);
                                self::span($title, ['class' => 'card-title black-text']);
                            self::endDiv();
                            self::div(['class' => 'card-content']);
                break;
            case 'Bootstrap':
                self::div(['class' => 'row']);
                    self::div(['class' => 'col-sm-12 col-md-2']); self::endDiv();
                    self::div(['class' => 'col-sm-12 col-md-8']);
                        self::div(['class' => 'card']);
                            self::div(['class' => 'card-body']);
                                self::div(['style' => 'height: 50%; background: url(\''.$image_url.'\'); background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;']);
                                    self::h5($title, ['class' => 'card-title']);
                                self::endDiv();
                break;
        }
    }
    public static function loginForm($attributes) {
        $attributes['action'] = '../includes/ezpz/login.php';
        $attributes['method'] = 'post';
        EZPZ::form($attributes);
    }
    public static function mainContainer($attributes) {
        $attributes['class'] = 'container'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
        echo HTML::main([]);
        self::div($attributes);
    }
    public static function multiSelect($id, $label, $value, $required, $size, $options, $attributes) {
        $selections = HTML::option('- Select -', ['value' => '', 'disabled' => '']);
        $keys = array_keys($options);
        $count = 0;
        $value = trim($value);
        foreach($options as $option) {
            $option_attributes = array();
            $option_attributes['value'] = $keys[$count];
            if(in_array($keys[$count], json_decode('['.$value.']'))) $option_attributes['selected'] = '';
            $selections .= HTML::option($option, $option_attributes);
            $count++;
        }
        $attributes['id'] = $id.'Dummy';
        $attributes['class'] = 'ezpz_multiselect'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
        $attributes['multiple'] = '';
        if($value) $attributes['value'] = $value;
        if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '']);
        switch(DES) {
            case 'Materialize':
                echo HTML::select($selections, $attributes);
                self::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                break;
            case 'Bootstrap':
                $attributes['class'] = 'custom-select'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                self::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                echo HTML::select($selections, $attributes);
                break;
        }
        self::hidden($id, $id, $value);
        if($size) self::endCol();
    }
    public static function p($contents, $attributes) {
        echo HTML::p($contents, $attributes);
    }
    public static function password() {
        $label = HTML::label('Password '.self::asterisk(), ['for' => 'password']);
        switch(DES) {
            case 'Materialize':
                echo self::icon('lock', 'prefix').HTML::input(['id' => 'password', 'name' => 'password', 'type' => 'password']);
                echo $label;
                break;
            case 'Bootstrap':
                echo $label;
                self::div(['class' => 'input-group']);
                    self::div(['class' => 'input-group-prepend']);
                        self::div(['class' => 'input-group-text']).self::icon('lock', ''); self::endDiv();
                    self::endDiv();
                    self::input(['id' => 'password', 'name' => 'password', 'class' => 'form-control', 'type' => 'password']);
                self::endDiv();
                break;
        }
    }
    public static function pageHeader($icon, $name, $buttons, $attributes) {
        $contents = '';
        $keys = array_keys($buttons);
        $counter = 0;
        switch(DES) {
            case 'Materialize':
                foreach($buttons as $value) {
                    switch($keys[$counter]) {
                        case 'add': $contents .= '&nbsp;'.HTML::a(self::icon('plus', '').' Add', ['href' => '../'.$value.'/add/', 'class' => 'btn-small']); break;
                        case 'back': $contents .= '&nbsp;'.HTML::a(self::icon('arrow-left', '').' Back', ['href' => '../'.$value.'/', 'class' => 'btn-small']); break;
                        case 'refresh': $contents .= '&nbsp;'.HTML::button(self::icon('redo', '').' Refresh', ['id' => 'ezpz_refresh', 'class' => 'btn-small blue']); break;
                    }
                    $counter++;
                }
                self::h5(($icon ? self::icon($icon, '').' ' : '').$name.HTML::div(['class' => 'right']).$contents.HTML::endDiv(), $attributes);
                break;
            case 'Bootstrap':
                foreach($buttons as $value) {
                    switch($keys[$counter]) {
                        case 'add': $contents .= '&nbsp;'.HTML::a(self::icon('plus', '').' Add', ['href' => '../'.$value.'/add/', 'class' => 'btn btn-success btn-sm']); break;
                        case 'back': $contents .= '&nbsp;'.HTML::a(self::icon('arrow-left', '').' Back', ['href' => '../'.$value.'/', 'class' => 'btn btn-success btn-sm']); break;
                        case 'refresh': $contents .= '&nbsp;'.HTML::button(self::icon('redo', '').' Refresh', ['id' => 'ezpz_refresh', 'class' => 'btn btn-primary btn-sm']); break;
                    }
                    $counter++;
                }
                self::div(['class' => 'row justify-content-between']);
                    self::div(['class' => 'col-4']);
                        self::h5(($icon ? self::icon($icon, '').' ' : '').$name, $attributes);
                    self::endDiv();
                    self::div(['class' => 'col-8 text-right']);
                        echo $contents;
                    self::endDiv();
                self::endDiv();
                break;
        }
    }
    public static function row($attributes) {
        $attributes['class'] = 'row'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
        self::div($attributes);
    }
    public static function saveForm($attributes) {
        $attributes['action'] = '../includes/ezpz/save.php';
        $attributes['method'] = 'post';
        self::form($attributes);
    }
    public static function select($id, $label, $value, $required, $size, $options, $attributes) {
        $selections = HTML::option('- Select -', ['value' => '', 'disabled' => '', 'selected' => '']);
        $keys = array_keys($options);
        $count = 0;
        foreach($options as $option) {
            $option_attributes = array();
            $option_attributes['value'] = $keys[$count];
            if(trim($value) == trim($keys[$count])) $option_attributes['selected'] = '';
            $selections .= HTML::option($option, $option_attributes);
            $count++;
        }
        if($required) $attributes['required'] = ''; 
        $attributes['id'] = $id;
        $attributes['name'] = $id;
        if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '']);
        switch(DES) {
            case 'Materialize':
                echo HTML::select($selections, $attributes);
                self::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                break;
            case 'Bootstrap':
                $attributes['class'] = 'custom-select'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                self::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                echo HTML::select($selections, $attributes);
                break;
        }
        if($size) self::endCol();
    }
    public static function span($contents, $attributes) {
        echo HTML::span($contents, $attributes);
    }
    public static function style() {
        echo HTML::style();
    }
    public static function submit($icon, $label) {
        switch(DES) {
            case 'Materialize':
                self::col([]);
                    echo HTML::button(self::icon($icon, '').' '.$label, ['id' => 'ezpz_submit', 'type' => 'submit', 'class' => 'btn green']);
                self::endCol();
                break;
            case 'Bootstrap':
                self::col([]);
                    echo HTML::button(self::icon($icon, '').' '.$label, ['id' => 'ezpz_submit', 'type' => 'submit', 'class' => 'btn btn-success btn-sm']);
                self::endCol();
                break;
        }
    }
    public static function success($message) {
        switch(DES) {
            case 'Materialize':
                echo HTML::script([]);
                    echo 'M.toast({html: "'.addslashes($message).'", displayLength: 4000});';
                echo HTML::endScript();
                break;
            case 'Bootstrap':
                echo HTML::div(['class' => 'container']);
                    echo HTML::div(['class' => 'alert alert-success alert-dismissible fade show', 'role' => 'alert']);
                        echo $message;
                        echo HTML::button(HTML::span('&times;', ['aria-hidden' => 'true']), ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']);
                    echo HTML::endDiv();
                echo HTML::endDiv();
                break;
        }
    }
    public static function stylesheet($name) {
        self::link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => '../includes/'.$name.'.css']);
    }
    public static function table($table_attributes, $fields) {
        switch(DES) {
            case 'Materialize': 
                echo HTML::table($table_attributes);
                    echo HTML::thead([]);
                        foreach($fields as $field) echo HTML::th($field, []);
                    echo HTML::endThead();
                    echo HTML::tBody([]);
                break;
            case 'Bootstrap':
                $table_attributes['class'] = 'table';
                echo '<br />'.HTML::table($table_attributes);
                    echo HTML::thead([]);
                        foreach($fields as $field) echo HTML::th($field, []);
                    echo HTML::endThead();
                    echo HTML::tBody([]);
                break;
        }
    }
    public static function td($contents, $attributes) {
        echo HTML::td($contents, $attributes);
    }
    public static function tdDelete($id) {
        switch(DES) {
            case 'Materialize':
                self::td(HTML::a(self::icon('trash', '').HTML::input(['type' => 'hidden', 'value' => $id]), ['href' => '#ezpz_confirmation', 'class' => 'waves-effect waves-light btn modal-trigger red ezpz_delete']), []);
                break;
            case 'Bootstrap':
                self::td(HTML::a(self::icon('trash', '').HTML::input(['type' => 'hidden', 'value' => $id]), ['class' => 'btn btn-danger text-white ezpz_delete']), []);
                break;
        }
    }
    public static function tdEdit($link) {
        switch(DES) {
            case 'Materialize':
                self::td(HTML::a(self::icon('pencil-alt', ''), ['href' => $link, 'class' => 'btn-small waves-effect yellow darken-4']), []);
                break;
            case 'Bootstrap':
                self::td(HTML::a(self::icon('pencil-alt', ''), ['href' => $link, 'class' => 'btn btn-warning']), []);
                break;
        }
    }
    public static function text($id, $label, $value, $required, $size, $attributes) {
        if($value) $attributes['value'] = $value;
        if($required) $attributes['required'] = ''; 
        $attributes['id'] = $id;
        $attributes['name'] = $id;
        $attributes['type'] = 'text';
        if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '']);
        switch(DES) {
            case 'Materialize':
                self::input($attributes);
                self::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                break;
            case 'Bootstrap':
                $attributes['class'] = 'form-control'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                self::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                self::input($attributes);
                break;
        }
        if($size) self::endCol();
    }
    public static function textarea($id, $label, $value, $required, $size, $attributes) {
        if($value) $attributes['value'] = $value;
        if($required) $attributes['required'] = ''; 
        $attributes['id'] = $id;
        $attributes['name'] = $id;
        if($size) self::col(['small' => '12', 'medium' => $size, 'for-input' => '']);
        switch(DES) {
            case 'Materialize':
                $attributes['class'] = 'materialize-textarea'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                echo HTML::textarea($value, $attributes);
                self::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                break;
            case 'Bootstrap':
                $attributes['class'] = 'form-control'.(isset($attributes['class']) ? ' '.$attributes['class'] : '');
                self::label($label.($required ? ' '.self::asterisk() : ''), ['for' => $id]);
                echo HTML::textarea($value, $attributes);
                break;
        }
        if($size) self::endCol();
    }
    public static function th($contents, $attributes) {
        echo HTML::th($contents, $attributes);
    }
    public static function top($title) {
        if($_SESSION[APP.'_current_page'] != 'login') {
            if($_SESSION[APP.'_current_page'] == 'login') {
            } else {
                $parent_menus = Common::fetchParentMenu();
                $child_menus = Common::fetchChildMenu();
                switch(DES) {
                    case 'Materialize':
                        foreach($parent_menus as $parent_menu) {
                            self::ul(['id' => $parent_menu['name'], 'class' => 'dropdown-content']);
                            foreach($child_menus as $child_menu) {
                                if($parent_menu['name'] == $child_menu['parent'])
                                    echo HTML::li(HTML::a(EZPZ::icon($child_menu['icon'], 'fa-fw').' '.$child_menu['label'], ['href' => '../'.$child_menu['link'].'/']), []);
                            }
                            self::endUl();
                        }
                        echo HTML::nav([]);
                            echo HTML::div(['class' => 'nav-wrapper'.Common::getClassColor()]);
                                echo HTML::a($title, ['href' => $_SESSION[APP.'_current_url'].'../'.HOM.'/', 'class' => 'brand-logo']);
                                echo HTML::ul(['id' => 'nav-mobile', 'class' => 'right hide-on-med-and-down']);
                                if(!(isset($_SESSION[APP.'_user_id']) && $_SESSION[APP.'_user_id'] != '')) {
                                    echo HTML::li(HTML::a(EZPZ::icon('lock', '').' Login', ['href' => '../login/']), []);
                                } else {
                                    $a = array();
                                    foreach($child_menus as $child_menu) {
                                        if($child_menu['parent']) {
                                            if(!in_array($child_menu['parent'], $a)) {
                                                echo HTML::li(HTML::a(EZPZ::icon($child_menu['parent_icon'], '').' '.$child_menu['parent_label'].' '.EZPZ::icon('sort-down', ''), ['class' => 'dropdown-trigger', 'href' => '#', 'data-target' => $child_menu['parent']]), []);
                                                array_push($a, $child_menu['parent']);
                                            }
                                        } else {
                                            echo HTML::li(HTML::a(EZPZ::icon($child_menu['icon'], 'fa-fw').' '.$child_menu['label'], ['href' => '../'.$child_menu['link'].'/']), []);
                                        }
                                    }
                                    echo HTML::li(HTML::a(EZPZ::icon('sign-out-alt', '').' Signout', ['id' => 'ezpz_sign_out', 'href' => '#ezpz_confirmation', 'class' => 'modal-trigger']), []);
                                }
                                echo HTML::endUl();
                            echo HTML::endDiv();
                        echo HTML::endNav();
                        break;
                    case 'Bootstrap':
                        $c = array();
                        foreach($parent_menus as $parent_menu) {
                            $c[$parent_menu['name']] = '';
                            foreach($child_menus as $child_menu) {
                                if($parent_menu['name'] == $child_menu['parent'])
                                    $c[$child_menu['parent']] .= HTML::a(EZPZ::icon($child_menu['icon'], 'fa-fw').' '.$child_menu['label'], ['class' => 'dropdown-item', 'href' => '../'.$child_menu['link'].'/']);
                            }
                        }
                        echo HTML::nav(['class' => 'navbar navbar-expand-lg'.Common::getClassColor()]);
                            echo HTML::a($title, ['class' => 'navbar-brand', 'href' => $_SESSION[APP.'_current_url'].'../'.HOM.'/']);
                            echo HTML::button(HTML::span('', ['class' => 'navbar-toggler-icon']), ['class' => 'navbar-toggler', 'type' => 'button', 'data-toggle' => 'collapse', 'data-target' => 'main_menu', 'aria-controls' => 'main_menu', 'aria-expanded' => 'false', 'aria-label' => 'Toggle navigation']);
                            echo HTML::div(['id' => 'main_menu', 'class' => 'collapse navbar-collapse']);
                                echo HTML::ul(['class' => 'navbar-nav ml-auto']);
                                if(!(isset($_SESSION[APP.'_user_id']) && $_SESSION[APP.'_user_id'] != '')) {
                                    echo HTML::li(HTML::a(EZPZ::icon('lock', '').' Login', ['class' => 'nav-link', 'href' => '../login/']), ['class' => 'nav-item']);
                                } else {
                                    $a = array();
                                    foreach($child_menus as $child_menu) {
                                        if($child_menu['parent']) {
                                            if(!in_array($child_menu['parent'], $a)) {
                                                echo HTML::li(HTML::a(EZPZ::icon($child_menu['parent_icon'], '').' '.$child_menu['parent_label'], ['id' => 'navbar_'.$child_menu['parent'], 'class' => 'nav-link dropdown-toggle' ,'href' => '#', 'role' => 'button', 'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']).
                                                    HTML::div(['class' => 'dropdown-menu', 'aria-labelledby' => 'navbar_'.$child_menu['parent']]).
                                                        $c[$child_menu['parent']].
                                                    HTML::endDiv(), ['class' => 'nav-item dropdown']);
                                                array_push($a, $child_menu['parent']);
                                            }
                                        } else {
                                            echo HTML::li(HTML::a(EZPZ::icon($child_menu['icon'], 'fa-fw').' '.$child_menu['label'], ['class' => 'nav-link', 'href' => '../'.$child_menu['link'].'/']), ['class' => 'nav-item']);
                                        }
                                    }
                                    echo HTML::li(HTML::a(EZPZ::icon('sign-out-alt', '').' Signout', ['id' => 'ezpz_sign_out', 'class' => 'nav-link', 'href' => '#']), ['class' => 'nav-item']);
                                }
                                echo HTML::endUl();
                            echo HTML::endDiv();
                        echo HTML::endNav();
                        break;
                }
            }
        }
    }
    public static function tr($attributes) {
        echo HTML::tr($attributes);
    }
    public static function ul($attributes) {
        echo HTML::ul($attributes);
    }
    public static function username() {
        switch(DES) {
            case 'Materialize':
                echo self::icon('user', 'prefix').HTML::input(['id' => 'username', 'name' => 'username', 'type' => 'text']);
                echo HTML::label('Username '.self::asterisk(), ['for' => 'username']);
                break;
            case 'Bootstrap':
                echo HTML::label('Username '.self::asterisk(), ['for' => 'username']);
                echo HTML::div(['class' => 'input-group']);
                    echo HTML::div(['class' => 'input-group-prepend']);
                        echo HTML::div(['class' => 'input-group-text']).self::icon('user', '').HTML::endDiv();
                    echo HTML::endDiv();
                    echo HTML::input(['id' => 'username', 'name' => 'username', 'class' => 'form-control', 'type' => 'text']);
                echo HTML::endDiv();
                break;
        }
    }
}
?>