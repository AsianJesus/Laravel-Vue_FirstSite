@extends('layouts.app')

@section('content')
    @if($exists)
        <div class="user-profile" style="margin: 0 15%">
            <div style="">
                        <h2>Name: {{$name}}</h2>
                        <h2>Type: {{$role}}</h2>
                        <h2>Total likes: {{$likes}}</h2>
                        <h2>Followers: {{$subs}}</h2>
            </div>
            <div >
                @forelse($articles as $article)
                    <article-preview
                            title="{{$article['title']}}"
                            full_article_url="/article/{{$article['id']}}"
                            @if(Auth::user()->type != 0)
                            editable="true"
                            edit_url="/edit/{{$article['id']}}"
                            @endif
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