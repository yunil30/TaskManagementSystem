<?php
    define('BASE_URL', 'http://localhost:8030/');

    if (!function_exists('host_url')) {
        function host_url() {
            return BASE_URL;
        }
    }

    if (!function_exists('hashPassword')) {
        function hashPassword($password) {
            return sha1(md5($password));
        }
    }

    if (!function_exists('show_header')) {
        function show_header() {
            return view('components/header_container');
        }
    }

    if (!function_exists('show_footer')) {
        function show_footer() {
            return view('components/footer_container');
        }
    }

    if (!function_exists('css_container')) {
        function css_container() {
            return view('components/css_container');
        }
    }

    if (!function_exists('js_container')) {
        function js_container() {
            return view('components/js_container');
        }
    }

    if (!function_exists('create_folder')) {
        function create_folder() {
            $Year = date('Y');
            $Num = rand(1,100).time();
   
            return $Year.'-'.$Num;
        }
    }

    if (!function_exists('TaskDocuments_url')) {
        function TaskDocuments_url() {
            return BASE_URL . 'TaskDocuments/';
        }    
    }

?>