<?php

namespace App\Services;

interface TodolistService {
    public function saveTodo(string $id, string $todo): void;

    public function getTodos(): array;

    public function deleteTodo(string $id): void;
}
