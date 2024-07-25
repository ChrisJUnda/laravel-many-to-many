{{-- @dd($posts) --}}
@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-12 p-3 ">
                <div class="card d-flex align-items-center ">
                    @if ($post->cover_image)
                        <div>
                            <img class="w-100 card-img-top" src="{{ asset('storage/' . $post->cover_image) }}">
                        </div>
                    @endif
                    {{-- <img src="..." class="" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">Titolo: {{ $post->title }}</h5>
                        <hr>
                        <p class="card-text">
                            <strong>
                                Descrizione:
                            </strong>
                            {{ $post->content }}
                        </p>
                        <hr>
                        <p class="card-text">
                            <strong>
                                Tipologia:
                            </strong>
                            {{ $post->type?->title ?: 'Categoria non disponibile' }}
                        </p>
                        <hr>
                        <div class="text-center">
                            <a class="btn btn-primary mt-3" href="{{ route('admin.posts.index') }}">
                                Torna alla lista dei progetti
                            </a>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
