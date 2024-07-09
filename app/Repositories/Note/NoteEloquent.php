<?php

namespace App\Repositories\Note;

use App\Helpers\ResponderHelper;
use App\Models\Note;

class NoteEloquent implements NoteInterface
{
    public function __construct(protected Note $note)
    {
    }

    public function index()
    {
        $user = auth()->user();
        return $user->notes()->latest()->get();
    }

    public function store(array $data)
    {
        return $this->note->create($data);
    }

    public function show(int $id)
    {
        return $this->note->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $note = $this->show($id);
        $note->update($data);
        return $note;
    }

    public function delete(int $id)
    {
        return $this->note->where('id', $id)->delete();
    }
}
