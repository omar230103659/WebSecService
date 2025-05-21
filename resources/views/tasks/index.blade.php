@extends('layouts.master')
@section('title', 'To-Do List')
@section('content')
<div class="container">
    <h2>To-Do List</h2>
    <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Task name" required>
            <button class="btn btn-primary" type="submit">Add Task</button>
        </div>
        @error('name')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </form>
    <ul class="list-group">
        @forelse($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span @if($task->status) style="text-decoration: line-through;" @endif>
                    {{ $task->name }}
                </span>
                @if(!$task->status)
                    <form action="{{ route('tasks.complete', $task) }}" method="POST">
                        @csrf
                        <button class="btn btn-success btn-sm">Mark as completed</button>
                    </form>
                @else
                    <span class="badge bg-success">Completed</span>
                @endif
            </li>
        @empty
            <li class="list-group-item">No tasks yet.</li>
        @endforelse
    </ul>
</div>
@endsection
