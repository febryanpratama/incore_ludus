@extends('layout.app')

@section('content')
<div class="container-fluid topic">
    <h1 class="text-center">List of Topics</h1>
    <a href="{{ route('topic.create') }}" type="button" class="btn btn-primary">Add Topic</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Category</th>
                <th scope="col">Topic Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topics as $topic)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$topic->category->name}}</td>
                <td>{{$topic->topic_name}}</td>
                <td>{{$topic->slug}}</td>
                <td>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('topic.edit', $topic->id) }}" type="button" class="btn btn-success">Edit</a> 
                        </div>
                        <div class="col">
                            <form action="{{ route('topic.destroy', $topic->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection