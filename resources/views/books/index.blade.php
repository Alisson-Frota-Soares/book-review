@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Books</h1>

    <form class="mb-4 flex items-center space-x-2" action="{{route('book.index')}}" method="GET">
        <input class="input h-10" type="text" name="title" id="title" placeholder="Search by title" value="{{request('title')}}">
        <input type="hidden" name="filter" value="{{request('filter')}}">
        <button class="btn h-10" type="submit">Search</button>
        <a class="btn h-10" href="{{route('book.index')}}">Clear</a>
    </form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6month' => 'Popular Last 6 Month',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_6month' => 'Highest Rated Last 6 Month',
            ];
        @endphp

        @foreach ($filters as $key => $label)
            <a href="{{route('book.index', [...request()->query(), 'filter' => $key])}}" class="{{request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item'}}">
                {{$label}}
            </a>
        @endforeach
    </div>

    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div
                    class="flex flex-wrap items-center justify-between">
                    <div class="w-full flex-grow sm:w-auto">
                        <a href="{{route('book.show', $book)}}" class="book-title">{{$book->title}}</a>
                        <span class="book-author">by {{$book->author}}</span>
                    </div>
                    <div>
                        <div class="book-rating">
                        {{number_format($book->reviews_avg_rating, 1)}}
                        </div>
                        <div class="book-review-count">
                        out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count)}}
                        </div>
                    </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{route('book.index')}}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse

        {{$books->links()}}
    </ul>
@endsection