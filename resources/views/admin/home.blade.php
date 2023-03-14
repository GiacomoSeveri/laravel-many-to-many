@extends('layouts.app')

@section('title', 'home')

@section('content')
<section id="home">
    <div  class="container">
        <div class="row d-flex align-items-center">
            <div class="col-5">
                <h1 class="fw-bold">It's coding time!</h1>
                <p class="mb-4">Ciao, sono pronto per tutte le sfide di programmazione. E ricorda che non tutte le ciambelle escono con il buco, ma le mie si.</p>
                <a href="{{route('admin.projects.index') }}" class="btn btn-sm btn-primary-custom text-light fw-semibold">Projects<i class="ms-2 fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="col-7 text-center">
                <img src="{{ asset('img/profile.jpeg') }}" width="400">
            </div>
            <div class="social-bar">
                <div><a class="social-icon" href="https://www.instagram.com/succo.di.seve/"><i class="fa-brands fa-instagram"></a></i></div>
                <div><a class="social-icon" href="https://www.pinterest.it/EzilSupremo/"><i class="fa-brands fa-pinterest-p"></a></i></div>
                <div><a class="social-icon" href="https://www.youtube.com/channel/UCYPCu-iKAovobpF08rSFz0Q"><i class="fa-brands fa-youtube"></i></a></i></div>
            </div>
        </div>
    </div>
</section>
@endsection