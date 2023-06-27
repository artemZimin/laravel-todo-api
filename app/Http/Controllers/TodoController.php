<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Repositories\TodoRepository;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(protected TodoRepository $todos)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($this->todos->getAll($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        return response()->json($this->todos->store($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo, Request $request)
    {
        return response()->json($this->todos->show($todo, $request));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        return response()
            ->json($this->todos->update($request, $todo));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo, Request $request)
    {
        return response()->json($this->todos->destroy($todo, $request));
    }
}
