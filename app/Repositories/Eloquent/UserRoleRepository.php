<?php
namespace App\Repositories\Eloquent;

use App\Models\UserRole;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\UserRoleRepositoryInterface;

class UserRoleRepository extends BaseRepository implements UserRoleRepositoryInterface{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor
     * 
     * @param Model $model
     */
    public function __construct(UserRole $model) {
        $this->model = $model;
    }
    public function add(array $payload){
        // \DB::connection()->enableQueryLog();
        $model =  $this->model->insert($payload);
        // $queries = \DB::getQueryLog();
        // dd($queries);
        return true;
    }
    public function delete(array $payload):bool{
        // \DB::connection()->enableQueryLog();
        return $this->model->where($payload)->delete();
        // $queries = \DB::getQueryLog();
        // dd($queries);
    }
    /**
     * 
     */
    public function insertMulti(array $data){
        $this->model->insert($data);
    }
    public function findByArray(array $payload) : ?Model {
        // \DB::connection()->enableQueryLog();
        $model =  $this->model->where($payload)->first();
        return $model;
        //  $queries = \DB::getQueryLog();
        // dd($queries, $model);
    }
}