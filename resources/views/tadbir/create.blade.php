@extends('layouts.layout')

@section('title', 'Yangi tadbir qo‘shish')

@section('content')
    @auth
        <div class="card">
            <div class="card-header">
                Yangi tadbir qo‘shish
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

                <form action="{{ route('tadbir.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Nomi</label>
                        <input type="text" name="nomi" class="form-control" value="{{ old('nomi') }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Sanasi</label>
                        <input type="date" name="sanasi" class="form-control" value="{{ old('sanasi') }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Tavsifi</label>
                        <textarea name="tavsifi" class="form-control">{{ old('tavsifi') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Rasmi</label>
                        <input type="file" name="rasmi" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Yo‘nalishi</label>
                        <input type="text" name="yonalishi" class="form-control" value="{{ old('yonalishi') }}">
                    </div>
                    <div class="mb-3">
                        <label>Tashkilotchi</label>
                        <input type="text" name="tashkilotchi" class="form-control" value="{{ old('tashkilotchi') }}">
                    </div>
                    <button type="submit" class="btn btn-success">Saqlash</button>
                    <a href="{{ route('tadbir.index') }}" class="btn btn-secondary">Ortga</a>
                </form>

            </div>
        </div>
    @endauth
@endsection
