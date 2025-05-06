<?php
    function csrf(){
        $csrf_field = '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
        return $csrf_field;
    }

    function form_text($name, $value = '', $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<input type="text" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '"' . $attr_string . '>';
    }
    function form_password($name, $value = '', $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<input type="password" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '"' . $attr_string . '>';
    }
    function form_textarea($name, $value = '', $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<textarea name="' . htmlspecialchars($name) . '"' . $attr_string . '>' . htmlspecialchars($value) . '</textarea>';
    }
    function form_dropdown($name, $options = [], $selected = '', $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        $dropdown = '<select name="' . htmlspecialchars($name) . '"' . $attr_string . '>';
        foreach ($options as $key => $val) {
            $dropdown .= '<option value="' . htmlspecialchars($key) . '"' . ($key == $selected ? ' selected' : '') . '>' . htmlspecialchars($val) . '</option>';
        }
        $dropdown .= '</select>';
        return $dropdown;
    }
    function form_checkbox($name, $value = '', $checked = false, $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<input type="checkbox" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '"' . ($checked ? ' checked' : '') . $attr_string . '>';
    }
    function form_radio($name, $value = '', $checked = false, $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<input type="radio" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '"' . ($checked ? ' checked' : '') . $attr_string . '>';
    }
    function form_submit($name, $value = '', $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<input type="submit" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '"' . $attr_string . '>';
    }
    function form_button($name, $value = '', $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<button name="' . htmlspecialchars($name) . '"' . $attr_string . '>' . htmlspecialchars($value) . '</button>';
    }
    function form_reset($name, $value = '', $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<input type="reset" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '"' . $attr_string . '>';
    }
    function form_file($name, $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<input type="file" name="' . htmlspecialchars($name) . '"' . $attr_string . '>';
    }
    function form_hidden($name, $value = '', $attributes = []) {
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $exploaded_val = explode('=', $val);
            if (count($exploaded_val) > 1) {
                $key = $exploaded_val[0];
                $val = $exploaded_val[1];
            }
            $attr_string .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
        return '<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '"' . $attr_string . '>';
    }
?>