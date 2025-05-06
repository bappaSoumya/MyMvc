<?php
    function csrf(){
        $csrf_field = '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
        return $csrf_field;
    }
?>