@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Crear nuevo post</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del post</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre del post"  value="{{ old('name') }}" autocomplete="off">

                    @error('name')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug del post</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug del post" readonly>

                    @error('slug')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Categorías del post</label>
                    <select name="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @error('category')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <p class="font-weight-bold" >Etiquetas</p>
                    
                    @foreach ($tags as $tag)
                        <label class="mr-2">
                            <input type="checkbox" name="tags" value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    @endforeach

                    @error('tags')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <p class="font-weight-bold" >Estado</p>
                    
                    <label for="status">
                        <input type="radio" name="status" value="1">
                        Borrador
                    </label>
                    <label for="status">
                        <input type="radio" name="status" value="2">
                        Publicado
                    </label>

                    @error('status')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="extract" class="form-label">Extracto del post</label>
                    <textarea class="form-control" name="extract" id="extract">{{ old('extract') }}</textarea>
                    
                    @error('extract')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Cuerpo del post</label>
                    <textarea class="form-control" name="body" id="body">{{ old('body') }}</textarea>
                    
                    @error('body')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary">Crear post</button>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
            });
        });

        ClassicEditor
        .create( document.querySelector( '#extract' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endsection