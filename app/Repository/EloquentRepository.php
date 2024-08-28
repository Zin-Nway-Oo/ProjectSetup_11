<?php
namespace App\Repository;

use App\Util\SearchRequest;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
interface EloquentRepository
{
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;
   public function findByID($id): ?Model;
   public function update(array $conditions,array $attributes);
   public function delete($id);
   public function findByUUID($uuid): ?Model;
   public  function all(): Collection;
   public  function selectByAll(array $conditions): Collection;
   public function searchList(SearchRequest $request);
   public function selectPaginatedList(array $conditions): Collection;
}
?>