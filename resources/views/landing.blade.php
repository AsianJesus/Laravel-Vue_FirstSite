@extends('layouts.app')
@section('content')
    <table style="width:100%">
        <tr>
            <th><h1>Users</h1></th>
            @auth
            <th><h1>My articles</h1></th>
            <th><h1>Feed</h1></th>
            @endauth
            <th><h1>Recent articles</h1></th>
        </tr>
        <tr>
            <td>
                @forelse($users as $user)
                    <user-form name="{{$user['name']}}"
<<<<<<< HEAD
                               link="/users/{{$user['id']}}"
                               subscribe_url="/subscribe/{{$user['id']}}"
                               unsubscribe_url="/unsubscribe/{{$user['id']}}"
=======
                               id="{{$user['id']}}"
                               link="users"
                               subscribe_url="/subscribe"
                               unsubscribe_url="/unsubscribe"
>>>>>>> 4fdd5ae33a99efff60fdc6a19dc29f12b4d6bb88
                               @if(Auth::id() != $user['id'])
                               @auth
                               subscribed = "{{
                               isset($subs) && in_array(['id'=>$user['id']],$subs) ? 'true' : 'false' }}"
                               @endauth

                               @if($admin)
                               deletable = "true"
                               delete_url="users/delete"
                            @endif
                            @endif
                    ></user-form>
                @empty
                    <h3>Sorry, no user found</h3>
                @endforelse
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            @auth
            <td style="padding:0 100px; align-item: center;">
                <a href="/articles/new"><button> Create new article</button></a>
                @forelse($my_articles as $article)
                    <article-preview
                            title="{{$article['title']}}"
                            full_article_url="/article/{{$article['id']}}"
                            @if(Auth::user()->type != 0 || Auth::id() == $article['uid'])
                            editable="true"
                            edit_url="/edit/{{$article['id']}}"
                            @endif
                    >
                        {{substr($article['text'],0,300).'..'}}
                    </article-preview>
                    @empty
                <h2>You don't have any articles</h2>
                @endforelse
            </td>
            <td>
                @forelse($sub_articles as $article)
                    <article-preview author="{{$article['name']}}"
                                     author_url = "/users/{{$article['uid']}}"
                                     title="{{$article['title']}}"
                                     full_article_url="/article/{{$article['id']}}"
                                     @if(Auth::user() != 0 || Auth::id() == $article['uid']))
                                     editable="true"
                                     edit_url="/edit/{{$article['id']}}"
                                    @endif
                    >
                        {{substr($article['text'],0,300).'..'}}
                    </article-preview>
                @empty
                    <h2>Feed is empty</h2>
                @endforelse
            </td>
            @endauth
            <td>
                @isset($recents)
                @forelse($recents as $article)
                        <article-preview author="{{$article['name']}}"
                                         author_url = "/users/{{$article['uid']}}"
                                         title="{{$article['title']}}"
                                         full_article_url="/article/{{$article['id']}}"
                                         @auth
                                         @if(Auth::user()->type != 0 || Auth::id() == $article['uid'])
                                         editable="true"
                                         edit_url="/edit/{{$article['id']}}"
                                         deletable="true"
                                         delete_url="/delete/{{$article['id']}}"
                                            @endif
                                @endauth
                        >
                            {{substr($article['text'],0,300).'..'}}
                        </article-preview>
                @empty
                    <h2>Recents are empty</h2>
                @endforelse
                    @endisset
            </td>
        </tr>
    </table>
@endsection

<style>
    td{
        min-width: 200px;
        margin: 0;
    }
    th{
        min-width: 250px;
        margin:0;
    }
</style>
