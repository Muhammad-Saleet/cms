@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-sm-8 offset-sm-2">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('posts.update')}}" method = "post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <input type="hidden" name="id" value = "{{$post->id}}">

                    <label for="title">Title:</label>
                    <input type="text" name = "title" id = "title" class="form-control" value = "{{$post->title}}" required>
                    <br>

                    <label for="text">Post:</label>
                    <textarea rows="12" cols="50" name = "text" id = "text" class="form-control" required>{{$post->text}}</textarea>
                    <br>

                </div>
                <button type = "submit" class = "btn btn-primary mb-5">Submit</button>
                <button class="btn btn-secondary mb-5 ml-3" onclick=cancel(event)>Cancel</button>
            </form>
        </div>
    </div>

    <script>function cancel(event) {
            event.preventDefault();
            window.location='{{ redirect()->back() }}'

        }</script>

@endsection

