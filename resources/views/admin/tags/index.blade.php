@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Mostrar listado de etiquetas</h1>
@stop
@section('content')
    @if (session('info'))
        <div class="alert alert-info">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('admin.tags.create') }}">Crear etiqueta</a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td width="10px"> 
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.tags.edit', $tag) }}">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
                                    @csrf @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

