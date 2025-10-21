<?php

namespace App\Services\impl;

use App\Services\TodolistService;
use Session;

class TodolistServiceImpl implements TodolistService {

    public function saveTodo(string $id, string $todo): void {
        if(!Session::has("todolist")) {
            Session::put("todolist", []);
        }
        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    public function getTodos(): array {
        return Session::get("todolist", []);
    }

    public function deleteTodo(string $id): void {
        $todolist = Session::get("todolist", []);
        foreach($todolist as $index => $item) {
            if($item["id"] === $id) {
                unset($todolist[$index]);
                break;
            }
        }
        Session::put("todolist", $todolist);
    }
}
