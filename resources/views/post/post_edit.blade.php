@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h2>Edit Post</h2>
            <form action="{{ route('post.update', $post->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $post->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" required>{{ $post->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ $post->price }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </section>
</div>
@endsection
