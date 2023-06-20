<?php
namespace App\Repositories\Eloquent;

use App\Models\Domain;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor
     * 
     * @param Model $model
     */
    public function __construct(Domain $model) {
        $this->model = $model;
    }
}