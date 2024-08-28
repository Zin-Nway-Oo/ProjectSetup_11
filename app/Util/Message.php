<?php
namespace App\Util;
class Message
{
    private $language;
    public $eng_messageCode=array(
            "01"=>"Successfully Save Data",
            "02"=>"Successfully Update Data",
            "03"=>"Successfully Delete Data",
            "04"=>"Successfully Fetch Data",
            "10"=>"Error with selecting data",
            "11"=>"Processing Error in Server ",
    );
    public  function __construct($language="eng")
    {
        $this->language=$language;
        
    }
    public function responseMessage($code)
    {
        return $this->eng_messageCode[$code];
    }
}

?>