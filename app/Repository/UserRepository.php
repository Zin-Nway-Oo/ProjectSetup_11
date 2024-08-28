<?php
namespace App\Repository;
use App\Util\SearchRequest;
use App\Model\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;   
interface UserRepository
{
    public function allRecords(SearchRequest $request);
    public function saveRecord(array $attributes): Model;
    public function deleteRecord($guid);
    public function updateRecord(array $attribute,$id);
    public function getByID($id);

}
?>