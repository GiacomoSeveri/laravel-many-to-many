@extends('layouts.app')

@section('title', 'crea')

@section('content')
<div class="container p-0">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<section id="edit">
    <div class="container">
        <form method="POST" action="{{ route('admin.projects.store', $project->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="mb-3 col-6">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title', $project->title)}}">
            </div>

            <div class="mb-3 col-6">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" disabled value="{{old('title', $project->title)}}">
            </div>

            <div class="mb-3 col-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Nessuna categoria</option>
                    @foreach($categories as $category)
                    <option @if($project->category?->id == $category->id) selected @endif value="{{$category->id}}">{{$category->label}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-9">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="mb-3 col-12">
                <label for="content" class="form-label">Paragrafo</label>
                <textarea class="form-control" id="content" name="content" rows="6">{{old('content', $project->content)}}</textarea>
            </div>

            <div class="mb-3 col-10">
                @foreach($lenguage as $leng)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tag-{{$leng->label}}" value="{{$leng->id}}" name="lenguages[]">
                    <label class="form-check-label" for="tag-{{$leng->label}}">{{$leng->label}}</label>
                </div>
                @endforeach
            </div>

            <div class="mb-3 col-4">
                <label for="collab" class="form-label">Collaborazioni</label>
                <input type="text" class="form-control" id="collab" name="collab" value="{{old('collab', $project->collab)}}">
            </div>

        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary-custom text-light me-1">Vai</button>
            <a href="{{route('admin.projects.index')}}" class="btn btn-sm btn-primary-custom text-light">Indietro</a>
        </div>
    </form>
    </div>
</section>
@endsection

@section('scripts')
<script>
    //prendo gli elemneti 
    const slugInput = document.getElementById('slug');
    const titleInput = document.getElementById('title');

    titleInput.addEventListener('blur', () => {
        slugInput.value = titleInput.value.toLowerCase().split(' ').join('-');
    });
</script>
@endsection