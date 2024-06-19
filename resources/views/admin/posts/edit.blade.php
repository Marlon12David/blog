@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Editar post</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del post</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $post->name }}" autocomplete="off">

                    @error('name')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug del post</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ $post->slug }}" readonly>

                    @error('slug')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categorías del post</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            @if ($category->id == $post->category->id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
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
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $postTags) ? 'checked' : '' }}>
                            {{ $tag->name }}
                        </label>
                    @endforeach
                        
                    @error('tags')
                        <br>
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <p class="font-weight-bold" >Estado</p>
                    
                    @if ( $post->status == 1 )
                        <label for="status">
                            <input type="radio" name="status" value="1" checked>
                            Borrador
                        </label>
                        <label for="status">
                            <input type="radio" name="status" value="2">
                            Publicado
                        </label>
                    @else
                        <label for="status">
                            <input type="radio" name="status" value="1" >
                            Borrador
                        </label>
                        <label for="status">
                            <input type="radio" name="status" value="2" checked>
                            Publicado
                        </label>
                    @endif

                    @error('status')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <div class="image-wrapper">
                            @if ( $post->image )
                                <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="">
                            @else
                                <img id="picture" src="https://cdn.pixabay.com/photo/2015/09/04/21/29/yosemite-922757_1280.jpg" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="file">Imagen post</label>
                            <input type="file" name="file" id="file" class="form-control-file" accept="image/*" >
                        
                            @error('file')
                            <span class="text-danger" >{{ $message }}</span>
                            @enderror
                        </div>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit expedita quod aliquid tempora maiores dolorum omnis dolorem voluptas perferendis veniam, culpa id, eaque sunt molestias, tenetur in quaerat fugiat est.</p>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="extract" class="form-label">Extracto del post</label>
                    <textarea class="form-control" name="extract" id="extract">{{ $post->extract }}</textarea>
                    
                    @error('extract')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Cuerpo del post</label>
                    <textarea class="form-control" name="body" id="body">{{ $post->body }}</textarea>
                    
                    @error('body')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary">Actualizar post</button>
            </form>
        </div>
    </div>
@stop
@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;

        }

        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
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

        document.getElementById("file").addEventListener('change', cambiarImagen);
           function cambiarImagen(event){
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
           }
        
    </script>
@endsection