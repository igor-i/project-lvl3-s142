@extends('layouts.app')

@section('title', 'Home')

@section('homeIsActive', 'active')

@section('homeIsCurrent')
    <span class="sr-only">(current)</span>
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Page Analyzer</h1>
        <p class="lead">This is a website, which analyzes the specified pages for SEO suitability.</p>
        <hr class="my-4">
        <p>Enter webpage URL for test:</p>
        <p>
        <form action="{{ route('storeDomain') }}" method="POST" class="form-inline">
            <div class="form-group mx-sm-3">
                <label for="inputUrl" class="sr-only">https://example.com</label>
                <input type="text" name="url" id="inputUrl" required class="form-control" placeholder="https://example.com">
            </div>
            <button type="submit" class="btn btn-primary">Test</button>
        </form>
        </p>
    </div>
@endsection
