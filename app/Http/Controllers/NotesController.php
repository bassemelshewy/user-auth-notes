<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\CreateRequest;
use App\Http\Requests\Note\UpdateRequest;
use App\Repositories\Note\NoteInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotesController extends Controller
{
    public function __construct(protected NoteInterface $note)
    {
    }
    public function index()
    {
        return view('front.notes.index');
    }

    public function search()
    {
        return DataTables::of($this->note->index())
            ->addIndexColumn()
            ->addColumn('title', function ($row) {
                return $row->title;
            })
            ->addColumn('content', function ($row) {
                return $row->content;
            })
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '<div class="dropdown">';
                $action .= '<a class="cursor-pointer" id="dropdownTable" role="button" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v text-secondary" aria-hidden="true"></i>
                            </a>';
                $action .= '<ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable" data-popper-placement="top-start">';
                    $action .= '<li ><a class="dropdown-item border-radius-md text-warning" href = "' . route('notes.edit', $row->id) . '" >Edit</a ></li >';
                    $action .= '<li >
                                <form method = "POST" action = "' . route('notes.destroy', $row->id) . '">' .
                        csrf_field() . ' ' .
                        method_field('DELETE')
                        . '<div class="form-group">
                                        <input type = "submit" class="dropdown-item text-danger border-radius-md delete" value = "Delete" >
                                    </div >
                                </form >
                            </li >';
                $action .= '</ul>';
                return $action;
            })
            ->rawColumns(['action', 'title', 'content'])
            ->make(true);
    }

    public function create()
    {
        return view('front.notes.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $inputs = [
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id(),
            ];
            $this->note->store($inputs);
            toastr()->success('Saved Successfully');
            return redirect()->route('notes.index');
        } catch (\Exception $e) {
            toastr()->error('Something went wrong');
            return redirect()->route('notes.index');
        }
    }

    public function edit(int $id)
    {
        $note = $this->note->show($id);
        return view('front.notes.edit', compact('note'));
    }



    public function update($id, UpdateRequest $request)
    {
        try {
            $inputs = [
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id(),
            ];
            $this->note->update($id, $inputs);
            toastr()->success('Updated successfully');
            return redirect()->route('notes.index');
        } catch (\Exception $e) {
            toastr()->error('Something went wrong');
            return redirect()->route('notes.index');
        }
    }

    public function delete(int $id)
    {
        try {
            $this->note->delete($id);
            toastr()->success('Deleted successfully');
            return redirect()->route('notes.index');
        } catch (\Exception $e) {
            toastr()->error('Something went wrong');
            return redirect()->route('notes.index');
        }
    }
}
