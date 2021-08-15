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

    public function all()
    {
        return $this->getModel()->all();
    }

    public function delete($id)
    {
        return $this->getModel()->destroy($id);
    }

    public function update(array $data)
    {
        return $this->getModel()->update($data);
    }

    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function create($data)
    {
        return $this->getModel()->create($data);
    }
}
