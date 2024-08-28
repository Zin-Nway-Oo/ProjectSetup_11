<?php
namespace App\Service\ServiceImpl;

use App\Service\UserService;
use App\Model\User;
use App\Util\SearchRequest;
use App\Util\Message;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;  
use App\Repository\UserRepository;  
use  App\Response\ResponseForm;
use Exception;
use Illuminate\Support\Str;
class UserServiceImpl implements UserService
{  private $message;
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->message=new Message();
        $this->userRepository = $userRepository;
    }
    public function getList(SearchRequest $request):ResponseForm
    {
        $response=new ResponseForm();
  
        try
        {
            $data=$this->userRepository->allRecords( $request);
            $response->successPaginatedRespone($data->items(), $this->message->responseMessage("04"),
            $data->currentPage(),$data->lastPage(),$data->total());
        }catch(Exception $e){
            $response->errorRespone($e->getCode(), $e->getMessage());
        }
        return $response;
    }
    public function save(array $attributes):ResponseForm
    {
        $response=new ResponseForm();
  
        try
        {
            $attributes["uuid"]=Str::uuid()->toString();
            $result= $this->userRepository->saveRecord( $attributes);
            $response->successRespone($result, $this->message->responseMessage("01"));
        }catch(Exception $e){
            $response->errorRespone($e->getCode(), $e->getMessage());
        }
        return $response;
    }
    public function updateRecord(array $attributes,$uuid):ResponseForm
    {
        $response=new ResponseForm();
  
        try
        {
            $result=$this->userRepository->updateRecord( $attributes,$uuid);
            $response->successRespone($result, $this->message->responseMessage("02"));

        }catch(Exception $e){
            $response->errorRespone($e->getCode(), $e->getMessage());
            }
        return $response;
    }

    public function deleteRecord($guid):ResponseForm
    {
        $response=new ResponseForm();  
        try
        {     
            $result= $this->userRepository->deleteRecord( $guid);
            $response->successRespone($result, $this->message->responseMessage("03"));
        }catch(Exception $e){
            $response->errorRespone($e->getCode(), $e->getMessage());
            }
        return $response;
    }
}
?>