@extends('layouts.app')

@section("title") {{ $article->title }} @endsection

@section('theme')
<style>
    .areabutton{
        background:#5f004f;
        color:#fff;
        margin:3px 5px;
        padding:10px;
        border-radius:3px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article Lists</a></li>
        <li class="breadcrumb-item active mb-3" aria-current="page">Article Details</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body case-detail my-3">
                    <h4 class="title">{{ $article->title }}</h4>
                    <hr class="text-primary">
                    <div class="mt-5 px-2 case-body">
                        <h4 class="fw-bold text-primary">Article Areas</h4>
                        @foreach($article->areas as $area)
                            <button class="areabutton">{{$area->title}}</button> 
                        @endforeach
                    </div>
                    <div class="mt-5 px-2 case-body">
                        <h4 class="fw-bold text-primary">Questions for Student Readers</h4>
                        <p class="mt-2 fs-5">{{$article->question_for_student_reader}}</p>
                    </div>
                    <div class="mt-5 px-2 case-body">
                        <h4 class="fw-bold text-primary">Description</h4>
                        {!! nl2br($article->description) !!} 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection