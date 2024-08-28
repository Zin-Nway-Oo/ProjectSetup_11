<?php
namespace App\Repository\EloquentImpl;   
use App\Models\User;
use App\Util\SearchRequest;
use App\Repository\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UserRepositoryImpl extends BaseRepositoryImpl implements UserRepository
{  
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getByID($id)
    {
        $user=User::where('id','=',$id)->first();
        if($user->type=="Doctor")
        {
            $data=DB::table('users')                    
                    ->where('users.id','=',$id)                    
                    ->select('users.*')
                    ->get();
        }
        else{
            $data=DB::table('users')
                    ->join('user_branches','users.id','=','user_branches.user_id')
                    ->join('branches','branches.id','=','user_branches.branch_id')
                    ->where('users.id','=',$id)                    
                    ->select('users.*','branches.branchname','branches.uuid as branchUuid')
                    ->get();
        }
        
        // $data=DB::table('users')->get();
                    // ->paginate($request->totalpage); 
                   //dd($data);
     return $data;
    }
    public function allRecords(SearchRequest $request)
    {        
       return $this->searchList($request);
    }
    public function saveRecord(array $attribute): Model
    {
        return $this->create($attribute);    
    }
    public function deleteRecord($guid)
    {
      $this->delete($guid);
      $request=new SearchRequest(new Request());
      return $this->searchList($request);

    }
    public function updateRecord(array $attribute,$id)
    {
        /*
        multi condition for updating
        $query->where([
            ['column_1', '=', 'value_1'],
            ['column_2', '<>', 'value_2'],
            [COLUMN, OPERATOR, VALUE],
            ...
        ])*/
     // Single condition for updating $conditions=array('uuid'=>$id);
    //  return  $this->update([
    //     ['name', '=', '280'],
    //     ['status', '>', 10],
    // ],$attribute);

    $conditions=array('uuid'=>$id);
    return $this->update($conditions,$attribute);

    }
}
?>