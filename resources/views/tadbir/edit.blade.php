@extends('layouts.layout')

@section('title', 'Tadbirni tahrirlash')

@section('content')
    @auth
        <div class="card">
            <div class="card-header">
                Tadbirni tahrirlash
            </div>
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tadbir.update', $tadbir->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Nomi</label>
                        <input type="text" name="nomi" class="form-control" value="{{ old('nomi', $tadbir->nomi) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Sanasi</label>
                        <input type="date" name="sanasi" class="form-control" value="{{ old('sanasi', $tadbir->sanasi) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Tavsifi</label>
                        <textarea name="tavsifi" class="form-control">{{ old('tavsifi', $tadbir->tavsifi) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Rasmi</label>
                        @if($tadbir->rasmi)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$tadbir->rasmi) }}" width="150" alt="rasm">
                            </div>
                        @endif
                        <input type="file" name="rasmi" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Yo‘nalishi</label>
                        <input type="text" name="yonalishi" class="form-control" value="{{ old('yonalishi', $tadbir->yonalishi) }}">
                    </div>
                    <div class="mb-3">
                        <label>Tashkilotchi</label>
                        <input type="text" name="tashkilotchi" class="form-control" value="{{ old('tashkilotchi', $tadbir->tashkilotchi) }}">
                    </div>
                    <button type="submit" class="btn btn-success">Yangilash</button>
                    <a href="{{ route('tadbir.index') }}" class="btn btn-secondary">Ortga</a>
                </form>

            </div>
        </div>
    @endauth
@endsection
