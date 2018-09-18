@extends('layouts.app')

@section('content')
    <form url="" method="POST">
        <div>
            <input name="title" type="text" value="{{$title}}">
        </div>
        <div>
            <textarea name="text" style="width:1000px; height:400px;">
                {{$text}}
            </textarea>
        </div>
        <div>
            <input type="submit" value="Save">
        </div>
        <input name="_token" type="hidden" value="{{csrf_token()}}">
    </form>
@endsection
