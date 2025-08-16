@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">My To-Do List</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="title" class="form-control" placeholder="What needs to be done?"
                                required>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </div>
                        <textarea name="description" class="form-control mt-2" placeholder="Description (optional)"
                            rows="2"></textarea>
                    </form>

                    @if($tasks->isEmpty())
                        <div class="text-center py-4">
                            <h5>No tasks yet!</h5>
                            <p class="text-muted">Add your first task above</p>
                        </div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($tasks as $task)
                                <li class="list-group-item d-flex align-items-center">
                                    <div class="form-check flex-grow-1">
                                        <form action="{{ route('tasks.update', $task) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <input type="checkbox" name="completed" onchange="this.form.submit()"
                                                class="form-check-input me-3" {{ $task->completed ? 'checked' : '' }}>
                                            <label class="form-check-label {{ $task->completed ? 'task-completed' : '' }}">
                                                {{ $task->title }}
                                                @if($task->description)
                                                    <small class="d-block text-muted">{{ $task->description }}</small>
                                                @endif
                                            </label>
                                        </form>
                                    </div>
                                   <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
    @csrf 
    @method('DELETE')
    
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
        Delete
    </button>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $task->id }}">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete "{{ $task->title }}"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection