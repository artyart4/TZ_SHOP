@extends('layouts.auth')
@section('content')
    <form METHOD="POST" ACTION="{{route('logOut')}}">
        @csrf
        @method('DELETE')
        <button type="submit">logOut</button>
    </form>
@endsection
