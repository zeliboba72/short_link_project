@extends('layouts.main')
@section('content')
    <form method="POST" action="{{ route('createLink') }}">
        @csrf
        @if(session('url'))
            <div class="card mb-3">
                <div class="card-header">
                    Here is your short link:
                </div>
                <div class="card-body fw-bold">
                    {{ session('url') }}
                </div>
            </div>
        @endif
        <div class="mb-3">
            <label for="inputLink" class="form-label">Write your LONG link:</label>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <input name="link" type="text" class="form-control" id="inputLink" value="{{ old('link') }}" aria-describedby="linkHelp">
            <div id="linkHelp" class="form-text">Your link will become shorter.</div>
        </div>
        <button type="submit" class="btn btn-primary">Receive</button>
    </form>
@endsection
