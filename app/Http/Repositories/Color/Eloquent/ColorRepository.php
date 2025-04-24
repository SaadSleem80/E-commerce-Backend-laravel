<?php 

namespace App\Http\Repositories\Color\Eloquent;

use App\Http\Repositories\Color\Interface\ColorRepositoryInterface;
use App\Models\Color;

class ColorRepository implements ColorRepositoryInterface
{
    protected $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    // Get all colors
    public function get(array $filters)
    {
        $query = $this->color
            ->orderBy($filters['orderBy'] ?? 'id', $filters['order'] ?? 'asc');

        if($filters['paginate']){
            return $query->paginate($filters['perPage'] ?? 10);
        }

        return $query->get();
    }

    // Get color by id
    public function find(int $id)
    {
        $color = $this->color->find($id);

        if(!$color){
            throw new \Exception(__('responses.not_found'));
        }

        return $color;
    }

    // Create color 
    public function create(array $data)
    {
        return $this->color->create($data);
    }
    
    public function update(array $data, int $id)
    {
        $color = $this->color->find($id);

        if(!$color){
            throw new \Exception(__('responses.not_found'));
        }

        $color->update($data);

        return $color->refresh();
    }

    public function delete(int $id)
    {
        $color = $this->color->find($id);

        if(!$color){
            throw new \Exception(__('responses.not_found'));
        }

        return $color->delete();
    }
}