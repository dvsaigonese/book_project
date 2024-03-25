@extends('layouts.app')

@section('title', 'Review ' . $book->name)

@section('content')
    <div class="container margin_30">
        <h4>Leave your review about {{ $book->name }}</h4>
        <form action="{{ route('review.store', $book->slug) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rating">Score</label>
                <select name="score" id="rating" class="form-select">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <div class="form-group">
                <label for="review">Review Title</label>
                <input type="text" name="title" id="review" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="review">Review Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
