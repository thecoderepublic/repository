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
        return $this->model->get();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function delete($id)
    {
        $this->model->destroy($id);
    }

    public function update($id, array $data)
    {
        return $this->model->update($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }
}
