@extends('layouts.app')
@section('content')
    @foreach($posts as $post)
        <div class="container mt-2 mb-2">
            <div class="row card p-2">
                <div class= "col-lg-12">
                    <div class="row">
                        <div class= "col-lg-12">
                            <h4><b><a href="{{route('posts.show',['post_id'=>$post->id])}}">{{$post->title}}</a></b></h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class= "col-lg-12">
                            <pre>{{$post->user_id}}    {{$post->created_at}}</pre>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
@endsection


