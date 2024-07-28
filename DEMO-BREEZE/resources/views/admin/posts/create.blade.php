@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12  p-3">
                <h1>
                    Crea un nuovo post
                </h1>
                <a class="btn btn-light" href="{{ route('admin.posts.index') }}">
                    Torna alla lista dei progetti
                </a>
            </div>

            @include('shared.error')

            <div class="col-12 p-3">
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="post-title" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="post-title" placeholder="Inserisci il titolo"
                            name="title">
                    </div>
                    <div class="mb-3">
                        <label for="post-title" class="form-label">Tipologia - {{ old('type_id') }}</label>
                        <select class="form-select" aria-label="Default select example" name="type_id">
                            <option value="">Seleziona Tipologia</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                                    {{ $type->title }}
                                </option>
                            @endforeach
                            {{-- <option selected>Scegli la Tipologia</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option> --}}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="post-title" class="form-label">Technologie utilizzate
                        </label>
                        <div>
                            @foreach ($technologies as $technology)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="technology-{{ $technology->id }}"
                                        value="{{ $technology->id }}" name="technologies[]"
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="technology-{{ $technology->id }}">
                                        {{ $technology->title }}
                                    </label>
                                </div>
                            @endforeach

                        </div>



                    </div>

                    <div class="mb-3">
                        <label for="post-content" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="post-content" rows="5" name="content"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cover-image" class="form-label">Carica Immagine</label>
                        <input class="form-control" type="file" id="cover-image" name="cover_image"
                            value="{{ old('cover_image') }}">
                    </div>
                    <button class="btn btn-primary">
                        Crea nuovo progetto
                    </button>

                </form>



            </div>
        </div>
    </div>
@endsection
