{{-- @dd($posts) --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center p-3">
                <h1>
                    Lista dei Progetti
                </h1>
                <div>
                    <a class="btn btn-primary" as="button" href="{{ route('admin.posts.create') }}">
                        Crea Progetto
                    </a>
                    {{-- <button class="btn btn-primary">
                        Crea Nuovo
                    </button> --}}
                </div>

            </div>
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @foreach ($posts as $post)
                <div class="col-4 g-3 ">
                    <div class="card p-3" style="width: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">Progetto N {{ $post->id }} </h5>

                            <p class="card-text">
                                <strong>
                                    Titolo:
                                </strong>
                                {{ $post->title }}
                            </p>
                            <p class="card-text">
                                <strong>
                                    Autore:
                                </strong>
                                {{ $post->user?->name ?: 'Ace' }}
                            </p>
                            <p class="card-text">
                                <strong>
                                    Slug:
                                </strong>
                                {{ $post->slug }}
                            </p>
                            <div class="d-flex gap-2 ">
                                <a href="{{ route('admin.posts.show', $post) }}" as="button" class="btn btn-info ">

                                    Visualizza
                                </a>
                                <a href="{{ route('admin.posts.edit', $post) }}" as="button" class="btn btn-warning ">
                                    Modifica
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger text-black">
                                        Elimina
                                    </button>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
@endsection
