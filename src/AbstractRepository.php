<?php
namespace TheCodeRepublic\Repository;


Abstract class AbstractRepository
{ 
    protected $model;

    public function getModel()
    {
        return $this->model;
    }

    public function get()
    {
        return $this->getModel()->get();
    }

    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function all($columns = ['*'], $relations = [])
    {
        return $this->getModel()->with($relations)->get($columns);
    }

    public function allTrashed()
    {
        return $this->getModel()->onlyTrashed()->get();
    }

    public function findById($id, $columns=['*'], $relations=[], $append=[])
    {
        return $this->getModel()->select($columns)->with($relations)->findOrFail($id)->append($append);
    }

    public function findByColumns($conditions, $columns=['*'], $relations=[])
    {
        return $this->getModel()->where($conditions)->select($columns)->with($relations)->first();

    }

    public function findTrashedById($id)
    {
        return $this->getModel()->withTrashed()->findOrFail($id);
    }

    public function findOnlyTrashedById($id)
    {
        return $this->getModel()->onlyTrashed()->findOrFail($id);
    }

    public function create($data)
    {
        $newlyCreatedModel = $this->getModel()->create($data);

        return $newlyCreatedModel->fresh();
    }

    public function update($id, $data)
    {
        return $this->findById($id)->update($data);
    }

    public function deleteById($id)
    {
        return $this->findById($id)->delete();
    }

    public function deleteWithRelation($id,$relation){
        $el = $this->findById($id);
        $el->$relation()->delete();

        return $el->delete();

   }

    public function restoreById($id)
    {
        return $this->findOnlyTrashedById($id)->restore();
    }

    public function permanentDeleteById($id)
    {
        return $this->findTrashedById($id)->forceDelete();
    }

    public function first()
    {
        return $this->getModel()->first();
    }
    
    public function findByColumn($column,$value){
        return $this->getModel()->where($column,$value)->first();
    }

    public function getByColumn($column,$value,$relations = []){
        return $this->getModel()->with($relations)->where($column,$value)->get();
    }
    
    public function updateOrCreate($id,$data, $by = 'id'){

       return $this->model->updateOrCreate([
            $by => $id
        ],$data);
    }

    public function updateOrCreateByMultipleConditions($conditions,$data){
        return $this->model->updateOrCreate($conditions,$data);
    }
    
    public function toggle($id,$column){
       $this->update($id,[
           $column => !$this->findById($id)->$column
       ]);
    }

    public function findByArray(array $conditions){
        return $this->getModel()->where($conditions)->first();
    }

}
