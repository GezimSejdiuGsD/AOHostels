@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}          
            </div>
        </div>
    </div>
    <h1> Upload </h1>
    <form method="POST" action="/upload" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit" name="Upload"> Upload </button>
    </form>
    <ul>
        @foreach ($photos as $photo)
        
            <li>  {{ $photo->name }} <img src="{{ asset('storage/images/' . $photo->name ) }}"> </li>
            <form method="POST" action="{{ route('upload.delete') }}">
                @csrf
                @method('DELETE')
            <button type="submit"> Delete </button>
            </form>
        @endforeach
      
    </ul>
    
</div>
@endsection




