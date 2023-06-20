<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
interface EloquentRepositoryInterface{
    /**
     * Get all models
     * 
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $colums = ['*'], array $relations=[]) : Collection;

    /**
     * Get all trashed models
     * 
     * @return Collection
     */
    public function allTrashed() : Collection;

    /**
     * find model by id
     * 
     * @param int $modelId
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ) : ?Model;
    
    /**
     * create a model.
     * 
     * @param array $payload
     * @return Model
     */
    public function create(array $payload) : ?Model;

    /**
     * Update existing model.
     * 
     * @param int $modelId
     * @param array $payload
     * @return bool
     */
    public function update(int $modelId, array $payload) : bool;

    /**
     * Delete model by id.
     * 
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId) : bool;

    /**
     * Restore model by id.
     * 
     * @param int $modelId
     * @return bool
     */
    public function restoreById(int $modelId) : bool;

    /**
     * Permanently delete model by id
     * 
     * @param int $modelId
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId): bool;
}

?>