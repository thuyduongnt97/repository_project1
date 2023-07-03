<?php
namespace App\Repositories\Eloquent;

use App\Models\RolePermission;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\RolePermissionRepositoryInterface;

class RolePermissionRepository extends BaseRepository implements RolePermissionRepositoryInterface{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor
     * 
     * @param Model $model
     */
    public function __construct(RolePermission $model) {
        $this->model = $model;
    }
    public function deleteAll() {
        // \DB::connection()->enableQueryLog();
        $this->model->whereNotNull('role_id')->delete();
        // $queries = \DB::getQueryLog();
        // dd($queries);
    }
    /**
     * 
     */
    public function insertMulti(array $data){
        $this->model->insert($data);
    }
}