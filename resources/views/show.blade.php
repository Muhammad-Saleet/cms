@extends('layouts.app')
@section('content')

    <div class="container">
        <script src="{{ asset('js/show.js') }}"></script>
        <article>
            <header>

                <section>
                    <input type="text" id="post_id" value={{$post->id}} hidden>
                    @auth
                        <input type="text" id="is-logged-in" value='true' hidden>
                    @endauth
                    @guest
                        <input type="text" id="is-logged-in" value='false' hidden>
                    @endguest
                </section>

                <h1>{{$post->title}}</h1>
                <p>Author: {{$post->user_id}} <br>
                    Published: <time>{{$post->created_at}}</time></p>

            </header>

            <section>
                {{$post->text}}
            </section>

        </article>

        <section>

        <!-- Edit -->
            @can('update', $post)
                <button type="button" id="edit_button" class="btn btn-link" onclick="window.location='{{ route("posts.edit", ["post_id"=>$post->id]) }}'">Edit</button>
                <button type="button" id="delete_button" class="btn btn-link text-danger" onclick="window.location='{{ route("posts.destroy", ["post_id"=>$post->id]) }}'">Delete</button>
                <br>
            @endcan

        </section>

@endsection














