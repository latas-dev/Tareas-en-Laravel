@extends('app')

@section('content')

    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('todos') }}" method="POST">
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>    
                
            @endif

            @error('title')
                <h6 class="alert alert-danger">{{ $message }}</h6> 
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Título de la Tarea</label>
                <input type="text"  name="title" class="form-control">
            </div>

            <label for="category_id" class="form-label">Categoría de la tarea</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Crear Nueva Tarea</button>
        </form>

        <div>
            @foreach ($todos as $todo)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route ('todos-edit', ['id' => $todo->id])  }}">{{ $todo->title }}</a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('todos-destroy', [$todo->id]) }}", method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>                        
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection