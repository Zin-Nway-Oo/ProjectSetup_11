<?php
namespace App\Util;
use Kutia\Larafirebase\Facades\Larafirebase;
class ConvertDataType
{
    /**
     * to convert json from string
     */
    public function convertJson ($data) {
        if ( $data != "{}") {
     
            $string = $data; 
       
            // Remove curly braces 
            $cleanedString = str_replace(['{', '}'], '', $string); 
           
            // Split key-value pairs 
            $keyValuePairs = explode(',', $cleanedString); 
            
            // Initialize an empty array to store the result 
            $paramArray = []; 
           
            // Iterate through key-value pairs 
            foreach ($keyValuePairs as $pair) { 
                // Split each pair into key and value 
                list($key, $value) = array_map('trim', explode(':', $pair, 2)); 
            
                // Add to the result array 
                $paramArray[$key] = $value; 
            }
            $data = $paramArray;
        } else {
            $data = [];
        }
        return $data;

    }

}

?>