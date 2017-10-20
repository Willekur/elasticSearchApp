@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="center">
            <h3>Enter a search query</h3>
            <a href="{{ route('advancedsearch') }}">Advanced search</a>
        </div>
        <br/>
        {!! Form::open(['route' => 'result', 'method' => 'POST']) !!}

        <div class="form-group">
            <div class="input-group">
                {!! Form::text('query', null, ['class' => 'form-control']) !!}
                <span class="input-group-btn">
                {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                </span>
            </div>
        </div>

        @if(Route::currentRouteName() == "result")
            @if($results != [])
                @foreach($results as $result)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('article', $result['_id']) }}">{{ $result['_source']['title'] }}</a>
                        </div>
                        <div class="panel-body">
                            {{ str_limit($result['_source']['text'], $limit=500, $end='....') }}
                        </div>
                    </div>
                @endforeach
            @else
                No results found :(
            @endif
        @endif

        {!! Form::close() !!}
    </div>

@endsection

@section('logo')
    @if(Route::currentRouteName() == "result")
        @if($results != [])
            <img src="{{ asset("img/search.jpg") }}" style="height:225px">
        @else
            <img src="{{ asset("img/crash.jpg") }}" style="height:225px">
        @endif
    @else
        <img src="{{ asset("img/init.jpg") }}" style="height:225px">
    @endif
@endsection