@extends('layout.app')

@section('content')
<div class="container-fluid">
    <form action="{{ route('topic.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <h1 class="text-center">Add Topic</h1>
        </div>
        <div class="mb-3">
            <label for="Category" class="form-label">Categories</label>
            <select class="form-select" name="category_id">
                <option selected disabled>Select Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="topicName" class="form-label">Topic Name</label>
            <input type="text" class="form-control" id="topicName" placeholder="Topic Name" name="topic_name">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <div class="mb-3"></div>
    </form>
</div>
@endsection