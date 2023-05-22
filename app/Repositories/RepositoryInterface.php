<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);

    public function add($data = []);

    public function update($id, $data = []);

    public function delete($id);
}