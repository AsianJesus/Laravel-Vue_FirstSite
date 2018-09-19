@extends('layouts.app')

@section('content')
    @if($exists)
        <div class="user-profile" style="margin: 0 15%">
            <div style="">
                        <h2>Name: {{$name}}</h2>
                        <h2>Type: {{$role}}</h2>
                        <h2>Total likes: {{$likes}}</h2>
                        <h2>Followers: {{$subs}}</h2>
                <user-form name=""
                           link="/users/{{$id}}"
                           subscribe_url="/subscribe/{{$id}}"
                           unsubscribe_url="/unsubscribe/{{$id}}"
                           @auth
                           @if(Auth::id() != $id)
                           subscribed = "{{
                               $subscribed ? 'true' : 'false' }}"

                           @if(Auth::user()->type != 0)
                           deletable = "true"
                           delete_url="users/delete"
                        @endif

                        @endauth
                        @endif
                ></user-form>
            </div>
            <div >
                @forelse($articles as $article)
                    <article-preview
                            title="{{$article['title']}}"
                            full_article_url="/article/{{$article['id']}}"
                            @auth
                            @if(Auth::user()->type != 0)
                            editable="true"
                            edit_url="/edit/{{$article['id']}}"
                            @endif
                            @endauth
                    >
                        {{substr($article['text'],0,300).'..'}}
                    </article-preview>
                @empty
                    <h2>Sorry, no articles found</h2>
                @endforelse
            </div>
        </div>
    @else
        <h1>No user found</h1>
    @endif
@endsection