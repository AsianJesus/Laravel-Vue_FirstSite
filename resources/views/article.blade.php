@extends('layouts.app')

@section('content')
    <div style="margin: 0 20%; item-align:center;">
    <article-component
            title=" {{$title}}"
            user="{{$author}}"
            user_url="/users/{{$uid}}"
    >
        {{ $text }}
    </article-component>
            <like-component
                        liked= "{{ $liked }}"
                        @auth
                        like_url = "/like/1/{{$id}}"
                        @else
                                like_url="#"
                    @endauth
                    like_count = "{{$like_count}}"
                    dislike_url = "/unlike/1/{{$id}}"
            >
            </like-component>
        @auth
        @if(Auth::user()->type !=  0 || $uid == Auth::id())
            <a href="/edit/{{$id}}">
                <button>
                    Edit
                </button>
            </a>

        @endif
        @endauth
        <div>
            <div>
    @forelse($comments as $comment)
        <div>
        <like-component
            liked = false,
            like_count="{{$comment->likes}}"
            like_url = '/like/2/{{$comment->id}}'
            dislike_url = '/unlike/2/{{$comment->id}}'
        >

        </like-component>
        <comment-component
            author="{{$comment->name}}"
            deletable = {{Auth::user()->type != 0 || Auth::id() == $comment->uid}}}
            delete_url = '/comment/delete/{{$comment->id}}'>
            {{$comment->text}}
        </comment-component>
        </div>
    @empty
        <span>No comment found</span>
    @endforelse

            </div>
    @auth
        <add-comment-component
            article="{{$id}}"
            user="{{Auth::id()}}"
            submit_url="/comment/add"
            csrf = "{{csrf_token()}}"
        ></add-comment-component>
    @else
        <span>Sorry, you can't leave comment here. Please login.</span>
    @endauth
        </div>
    </div>
@endsection