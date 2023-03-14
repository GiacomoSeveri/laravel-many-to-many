@extends('layouts.app')

@section('title', 'projects')

@section('content')
<section id="projects">
    <div class="container">
        <div class="row">
            @foreach ($projects as $project)
            <div class="custom-card col-3 my-3 text-center">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h5 class="m-0">{{ $project->title }}</h5>
                    <a href="{{route('admin.projects.show', $project->id)}}" class="btn btn-sm btn-primary-custom text-light">Vedi</a>
                </div>
                <img src="{{ asset('storage/' . $project->image) }}" width="300">
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center my-4">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-primary-custom text-light">Aggiungi</a>
        </div>
    </div>
</section>
@endsection
