<?php

namespace App\Repositories\Note;

interface NoteInterface
{
    public function index();
    public function show(int $id);
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
