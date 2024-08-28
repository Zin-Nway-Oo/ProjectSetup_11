<?php
namespace App\Util;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Responsable;
class SearchRequest 
{
    public $enable="false";
    public $webView="false";
    public $totalpage = 20;
    public  $page=0;
    public $multisearch=false;
    public $sortableField="";
    public $sortBy="DESC";
    public $searchword="";
    public $searchcol="";
    public $searchKeywords=array("");//array
    public $searchColumn=[];//array

    public function  __construct(Request $request)
    {
        $input = $request->all();
        if(isset($input["enable"]))
        {
            $this->enable=$input["enable"];
        }
        if(isset($input["webView"]))
        {
            $this->webView=$input["webView"];
        }
        if(isset($input["totalpage"]))
        {
            $this->totalpage=$input["totalpage"];
        }
        if(isset($input["searchword"]))
        {
            $this->searchword=$input["searchword"];
        }
        if(isset($input["searchcol"]))
        {
            $this->searchcol=$input["searchcol"];
        }
        if(isset($input["page"]))
        {
            $this->page=$input["page"];
        }
        if(isset($input["sortableField"]))
        {
            $this->sortableField=$input["sortableField"];
        }
        if(isset($input["sortBy"]))
        {
            $this->sortBy=$input["sortBy"];
        }
        if(isset($input["searchColumn"]))
        {
            $this->searchColumn=$input["searchColumn"];
        }
        if(isset($input["searchKeywords"]))
        {
            $this->searchKeywords=$input["searchKeywords"];
        }
     
        
        //return $this->all();
    }
    function getAllField()
    {
        
         return   "Page:".$this->page.",sortableField-".  $this->sortableField.",sortBy-".$this->sortBy;
        
    }
   
}

?>