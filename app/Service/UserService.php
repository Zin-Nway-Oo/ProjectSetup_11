<?php
namespace App\Service;
use App\Model\User;
use App\Response\ResponseForm;
use App\Util\SearchRequest;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;   
interface UserService
{
    public function getList(SearchRequest $request):ResponseForm;
    public function save(array $attributes):ResponseForm;
    public function deleteRecord($guid):ResponseForm;
    public function updateRecord(array $attributes,$uuid):ResponseForm;

}
?>