@extends('layouts.app')

@section('content')
    <ol>
    @forelse($users as $user)
        <ul>
            <user-form name="{{$user['name']}}"
                       link="/users/{{$user['id']}}"
                       subscribe_url="/subscribe/{{$user['id']}}"
                       unsubscribe_url="/unsubscribe/{{$user['id']}}"
                       @if(Auth::id() != $user['id'])
                       @auth
                       subscribed = "{{
                               isset($subs) && in_array(['id'=>$user['id']],$subs) ? 'true' : 'false' }}"
                       @if(Auth::user()->type != 0)
                       deletable = "true"
                       delete_url="users/delete"
                    @endif
                    @endauth
                    @endif
            ></user-form>
        </ul>
    @empty
        <h1>Sorry, no user found</h1>
    @endforelse
    </ol>
@endsection