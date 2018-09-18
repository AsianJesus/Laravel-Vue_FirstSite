@extends('layouts.app')

@section('content')
    <h1>New article</h1>
    <div class="new-article">
        <form method="POST" action="/articles/new">
            <div class="form-title">
                <input type="text" name="title" placeholder="Title">
            </div>
            <div class="form-text">
                <textarea name="text" placeholder="Text">

                </textarea>
            </div>
            <div class="form-submit">
                <input type="submit" value="Submit">
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
@endsection
