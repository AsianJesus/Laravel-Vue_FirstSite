@extends('layouts.app')

@section('content')
    <h1>Welcome, {{ $user->name }}</h1>
    <table>
        <tr>
            <th>
                Total likes:
            </th>
            <th>
                {{$total_likes}}
            </th>
        </tr>
        <tr>
            <th>
                Total followers:
            </th>
            <th>
                {{count($subs)}}
            </th>
        </tr>

        <tr>
            <th>
                Total subscriptions:
            </th>
            <th>
                {{count($follows)}}
            </th>
        </tr>

    </table>
    <ol>
        <h3>Followers</h3>
        @forelse($subs as $sub)
            <li>
                <a href="/users/{{$sub['id']}}">{{$sub['name']}}</a>
            </li>
        @empty
            <h4>Sorry, you don't have any follower</h4>
        @endforelse
    </ol>
    <ol>
        <h3>Subscriptions</h3>
        @forelse($follows as $sub)
            <li>
                <a href="/users/{{$sub['id']}}">{{$sub['name']}}</a>
            </li>
        @empty
            <h4>You don't have any</h4>
        @endforelse
    </ol>
    <a href="/articles/new"><button> Create new article</button></a>)
    <h3>Your recent articles</h3>
    @forelse($articles as $article)
        <article-preview title="{{$article['title']}}"
                         full_article_url="/article/{{$article['id']}}"
                         editable="true"
                         edit_url="/edit/{{$article['id']}}"
        >
            {{substr($article['text'],0,300).'..'}}
        </article-preview>
    @empty
        <h3>Sorry, but you don't have any article</h3>
    @endforelse

@endsection