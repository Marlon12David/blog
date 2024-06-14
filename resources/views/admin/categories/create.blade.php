@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Crear una nueva categoría</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre categoría</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre categoría"  value="{{ old('name') }}">

                    @error('name')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug categoría</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug categoría" readonly>

                    @error('slug')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary">Crear categoría</button>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
            });
        });
    </script>
@endsection