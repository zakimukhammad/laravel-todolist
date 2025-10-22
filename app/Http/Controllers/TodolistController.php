<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService) {
        $this->todolistService = $todolistService;
    }

    public function todoList() {
        $todolist = $this->todolistService->getTodos();
        return response()->view('todolist.todolist', [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request) {
        $todo = $request->input('todo');
        if (empty($todo)) {
            $todoList = $this->todolistService->getTodos();
            return response()->view('todolist.todolist', [
                "title" => "Todolist",
                "todolist" => $todoList,
                "error" => "Todo tidak boleh kosong"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class, 'todoList']);
    }

    public function removeTodo(Request $request, string $todoId) {
        $this->todolistService->deleteTodo($todoId);
        return redirect()->action([TodolistController::class, 'todoList']);
    }
}
