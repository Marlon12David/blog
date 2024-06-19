@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de posts</h1>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-info">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif
    
    @livewire('admin.post-index')
@stop
