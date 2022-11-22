<?php
    use Illuminate\Support\Facades\DB;

    if (!function_exists('get_all_users')) {
        function get_all_users()
        {
            $query = "select * from users";
            $user = DB::select($query);
            return $user;
        }
    }

    if(!function_exists('convert_currency')){
     function convert_currency($value){
            return number_format($value,2);
     }
    }
    
    if(!function_exists('date_formatter')){
        function date_formatter($value){
            $date = $value->format('d.m.20y');
            return $date;
        }
    }

?>