@extends('layouts.layout')

@section('content')
    <h2>Qizlar ro‘yxati</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @foreach($qizlar as $qiz)
        <div style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            @if($qiz->rasm)
                <img src="{{ asset('storage/' . $qiz->rasm) }}" width="120">
            @endif
            <h3>{{ $qiz->ism }}</h3>
            <p><strong>Sinf:</strong> {{ $qiz->sinfi }}</p>
            <p>{{ $qiz->tavsif }}</p>
            <p><strong>Ovozlar:</strong> {{ $qiz->ovoz }}</p>
        </div>
    @endforeach
@endsection
