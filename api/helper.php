<?php

/**
 * idParamsValidation is a function to validate given id in route params. Id must be an integer and non-negative
 * @return boolean indicating valid or not.
 */
function idParamsValidation(){
    // Validate existence.
    if (!isset($_GET['id'])){
        return false;
    }

     $id = $_GET['id'];
    // Validate type.
    if (!is_numeric($id)){
        return false;
    }
    // Validate value.
    $id = intval($id);
    if ($id < 1){
        return false;
    }

    return true;
}

/**
 * arrayPaginate is a function to transform one dimensional array to two dimensional array.
 * Used for making pagination easier. The number each row/page depend on input.
 * @return array representing paginated assosiative array.
 */
function arrayPaginate($arr, $itemPerPage){
    // Edge case.
    if($itemPerPage <= 0){
        return $arr;
    };

    // Initiate empty array.
    $paginated = array();

    // Initiate paginated array index for looping.
    $page = ceil(count($arr)/$itemPerPage);
    for ($i = 0; $i < $page; $i++) {
        $paginated[$i] = ["page" => $i+1, "content" => []];
    };

    // Loop for filling array.
    $i = 0;
    $j = 0;
    foreach ($arr as $val) {
        $paginated[$j]['content'][$i] = $val;
        $i++;
        if ($i == $itemPerPage){
            $i = 0;
            $j++;
        }
    }
    return $paginated;
}
/**
 * startsWith is a function to check string starting with given substring.
 * @param string $string : This parameter is used to hold the text which need to test.
 * @param string $startString : The text to search at the beginning of String. If it is an empty string, then it returns true.
 * @return bool : This function returns True on success or False on failure.
 */

function startsWith ($string, $startString){
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}