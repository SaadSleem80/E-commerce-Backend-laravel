<?php 

namespace App\Http\Services\ColorServices;

use App\Http\Repositories\Color\Interface\ColorRepositoryInterface;

class ColorService 
{  
    protected $repo;

    public function __construct(ColorRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    // Get all colors
    public function get(array $filters)
    {
        return $this->repo->get($filters);
    }

    // Get color by id
    public function find(int $id)
    {
        return $this->repo->find($id);
    }
    
    // Create color
    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->repo->update($data, $id);
    }

    // Delete color
    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }
}