<?php

namespace App\Repository\EloquentImpl;
use App\Util\SearchRequest;
use App\Repository\EloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
class BaseRepositoryImpl implements EloquentRepository
{
    /**
     * @var Model
     */
     protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
    * @param $id
    * @return Model
    */
    public function searchList(SearchRequest $request)
    {
        if($request->multisearch==true)
        {
            if($request->sortableField!=""   && count($request->searchKeywords)>0)
            {
                if(count($request->searchKeywords)<2)
                {
                     $keyword=$request->searchKeywords[0];
                    return $this->model::whereLike($request->searchColumn, $keyword)
                    ->orderBy($request->sortableField, $request->sortBy)
                    ->paginate($request->totalpage);
                }
                else
                {
                   return "null";
                }

            }
            else if($request->sortableField==""&& count($request->searchKeywords)>0)
            {
                if(count($request->searchKeywords)<2)
                {
                     $keyword=$request->searchKeywords[0];
                    return $this->model::where('status',config('global.status.ACTIVE'))->whereLike($request->searchColumn, $keyword)->paginate($request->totalpage);
                }
                else
                {
                   return "null";
                }
            }
            else if($request->sortableField!=""&& count($request->searchKeywords)==0)
            {
                return  $this->model::where('status',config('global.status.ACTIVE'))
                ->orderBy($request->sortableField, $request->sortBy)->
                paginate($request->totalpage);
            }
            else
            {
                return $this->model::where('status',config('global.status.ACTIVE'))->paginate($request->totalpage);
            }
        }
        else
        {//searchcol
            //
            if($request->sortableField!=""   && $request->searchword!="")
            {
                if(count($request->searchKeywords)<2)
                {
                     $keyword=$request->searchKeywords[0];
                    return $this->model::where('status',config('global.status.ACTIVE'))
                    ->where($request->searchcol,"LIKE",'%'.$request->searchword.'%')
                    ->orderBy($request->sortableField, $request->sortBy)
                    ->paginate($request->totalpage);
                }
                else
                {
                   return "null";
                }

            }
            else if($request->sortableField==""&& $request->searchword!="")
            {
                if(count($request->searchKeywords)<2)
                {
                     $keyword=$request->searchKeywords[0];
                    return $this->model::where('status',config('global.status.ACTIVE'))->where($request->searchcol,"LIKE",'%'.$request->searchword.'%')->paginate($request->totalpage);
                }
                else
                {
                   return "null";
                }
            }
            else if($request->sortableField!=""&&  $request->searchword=="")
            {
                return  $this->model::where('status',config('global.status.ACTIVE'))
                ->orderBy($request->sortableField, $request->sortBy)->
                paginate($request->totalpage);
            }
            else
            {
                return $this->model::where('status',config('global.status.ACTIVE'))->paginate($request->totalpage);
            }
        }


    }
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
    public function findByID($id): ?Model
    {
        return $this->model->find($id);
    }
    public function findByUUID($uuid):?Model
    {
        return $this->model::where("uuid",$uuid)->first();
    }
    public function update(array $conditions,array $attributes)
    {
        /**$whereData = [
    ['name', 'test'],
    ['id', '<>', '5']
];

$users = DB::table('users')->where($whereData)->get();  */
         return $this->model::where($conditions)->update( $attributes);

    }
    public function all(): Collection
    {
        return $this->model::paginate(2);
    }
    public function selectByAll(array $conditions): Collection
    {
        return $this->model::where($conditions)->get();
    }
    public function selectPaginatedList(array $conditions): Collection
    {
        return $this->model::where($conditions)->get();
    }
    public function delete($uuid)
    {
        $model= $this->findByUUID($uuid);
        //dd($model);
           $model->status=config('global.status.INACTIVE');
           $model->save();
    }
}
?>
