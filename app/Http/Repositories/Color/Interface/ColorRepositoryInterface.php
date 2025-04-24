<?php 

namespace App\Http\Repositories\Color\Interface;

interface ColorRepositoryInterface 
{ 

    // Get all colors
    public function get(array $filters);

    // Get color by id
    public function find(int $id);

    // Create color
    public function create(array $data);

    // Update color
    public function update(array $data, int $id);

    // Delete color
    public function delete(int $id);
}
