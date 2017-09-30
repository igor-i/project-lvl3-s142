@extends('layouts.app')

@section('title', 'Home')

@section('domainsIsActive', 'active')

@section('domainsIsCurrent')
    <span class="sr-only">(current)</span>
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div>
    <h1>Test results</h1>
        <p>
            <table class="table table-sm">
                <thead>
                <tr>
                    @foreach ($domain as $key => $item)
                        @if ($key !== 'body')
                            <th>{{ $key }}</th>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach ($domain as $key => $item)
                        @if ($key === 'id')
                            <th scope="row">{{ $item }}</th>
                        @elseif ($key === 'name')
                            <td><a href="/domains/{{ $domain->id }}">{{ $item }}</a></td>
                        @elseif ($key !== 'body')
                            <td>{{ $item }}</td>
                        @endif
                    @endforeach
                </tr>
                </tbody>
            </table>
        </p>
    </div>
@endsection
