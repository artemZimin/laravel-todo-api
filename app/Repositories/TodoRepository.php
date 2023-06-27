<?php

namespace App\Repositories;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class TodoRepository {

    public function getAll(Request $request)
    {
        return $request->user()->todos()->get();
    }

    public function store(StoreTodoRequest $request)
    {
        return Todo::query()
            ->create(
                array_merge(
                    $request->all(),
                    ['user_id' => $request->user()->id]
                )
            );
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        try {
            $result_todo = $request->user()->todos()->find($todo->id);
            $result_todo->fill($request->all());
            $result_todo->save();

            return $result_todo;
            
        } catch (Throwable $e) {
            throw new HttpException(404, 'Not Found');
        }
    }

    public function destroy(Todo $todo, Request $request)
    {
        try {
            return $request->user()->todos()->find($todo->id)->delete();
        } catch (Throwable $e) {
            throw new HttpException(404, 'Not Found');
        }
    }

    public function show(Todo $todo, Request $request)
    {
        try {
            $todo = $request->user()->todos()->find($todo->id);
            return $todo;
        } catch (Throwable $e) {
            throw new HttpException(404, 'Not Found');
        }
    }

}
