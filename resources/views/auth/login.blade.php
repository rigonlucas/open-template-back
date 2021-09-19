@extends('__layouts.default.main')

@section('title', 'Login')

@section('content')
    <form action="{{ route('post.login') }}" method="post">
        @csrf
        <input type="text" name="email"/>
        <input type="text" name="password"/>
        <button type="submit">login</button>

        {{ $errors }}
    </form>
@endsection