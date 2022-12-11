<?php
use Illuminate\Support\Str;

function string_slug($string, $separator = '-')
{
    return Str::slug($string, $separator, false);
}

function string_grouping($string_array)
{
    $data = [];
    foreach ($string_array as $string) {
        $needle=NULL;
        foreach(trans('permissions.modules') as $module) {
            if(Str::endsWith($string,$module)) {
                $needle = $module;
            }
        }
        if($needle) {
            foreach($string_array as $i => $str) {
                if(Str::contains( $str , $needle )) {
                    $sub_str = Str::replaceFirst( $needle , '' ,$str );
                    if($sub_str != "") {
                        $data[$needle][$str] = $sub_str;
                    }else {
                        $data[$needle] = $needle;
                    }
                    unset($string_array[$i]);
                }
            }
        }
    }
    return $data;
}
