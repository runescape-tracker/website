<?php
if(!function_exists('normalise_rs')) {
    function normalise_rs(string $string): string {

        $string = strtolower($string);
        $string = str_ireplace([
            '.',
            ':',
        ], '', $string);
        $string = str_ireplace(' ', '_', $string);
        return $string;
    }
}