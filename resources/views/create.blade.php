@extends('layouts.app')
@section('content')
    <div class="row mt-3">
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

            <form action="{{route('posts.store')}}" method = "post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Give your post a title:</label>
                    <input type="text" name = "title" id = "title" class="form-control" required>
                    <br>

                    <label for="text">Write your post:</label>
                    <textarea rows="12" cols="50" name = "text" id = "text" class="form-control" required></textarea>
                    <br>
                </div>
                <button type = "submit" class="btn btn-primary mb-5" >Submit</button>
                <button class="btn btn-secondary mb-5 ml-3" onclick=cancel(event)>Cancel</button>
            </form>
        </div>
    </div>

    <script>function cancel(event) {
            event.preventDefault();
            window.location='http://localhost:8000/';
        }
    </script>

@endsection

