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
    <h1>Domains list</h1>
        <p>
            <table class="table table-sm">
                <thead>
                <tr>
                    @foreach ($domains[0] as $key => $item)
                        @if ($key !== 'body')
                            <th>{{ $key }}</th>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($domains as $domain)
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
                @endforeach
                </tbody>
            </table>
        </p>
        <p>
            <nav aria-label="Domains navigation">
                {{ $domains->links() }}
            </nav>
        </p>
    </div>
@endsection
