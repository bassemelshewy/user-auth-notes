<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\CreateRequest;
use App\Http\Requests\Note\UpdateRequest;
use App\Models\Note;
use App\Repositories\Note\NoteInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function __construct(protected NoteInterface $note)
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            // $notes = Note::all();
            $notes = $this->note->index();
            return response()->json([
                'status' => 'success',
                'notes' => $notes,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            $inputs = [
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id(),
            ];
            $note = $this->note->store($inputs);

            return response()->json([
                'status' => 'success',
                'message' => 'Note created successfully',
                'note' => $note,
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $note = $this->note->show($id);
            return response()->json([
                'status' => 'success',
                'note' => $note,
            ]);
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'This note is not available',
            ], 404);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $note = $this->note->show($id);

            if ($note->user_id !== auth()->id()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized access to this note',
                ], 403);
            }

            $inputs = [
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id(),
            ];
            $note = $this->note->update($id, $inputs);

            return response()->json([
                'status' => 'success',
                'message' => 'Note updated successfully',
                'note' => $note,
            ]);
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'This note is not available',
            ], 404);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $e->getmessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $note = $this->note->delete($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Note deleted successfully',
                'note' => $note,
            ]);
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'This note is not available',
            ], 404);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }
}
