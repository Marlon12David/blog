@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre etiqueta</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $tag->name }}">

                    @error('name')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug etiqueta</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ $tag->slug }}" readonly>

                    @error('slug')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color etiqueta</label>
                    <select name="color" class="form-control">
                        <option value="red">Color rojo</option>
                        <option value="blue">Color azul</option>
                        <option value="green">Color verde</option>
                        <option value="yellow">Color amarillo</option>
                        <option value="indigo">Color indigo</option>
                        <option value="purple">Color morado</option>
                        <option value="pink">Color rosado</option>
                        
                    </select>

                    @error('color')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Actualizar etiqueta</button>
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