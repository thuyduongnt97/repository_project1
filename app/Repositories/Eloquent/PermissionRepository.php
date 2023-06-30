<?php
namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor
     * 
     * @param Model $model
     */
    public function __construct(Permission $model) {
        $this->model = $model;
    }
}