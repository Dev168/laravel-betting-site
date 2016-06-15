@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('layouts.partials.navbar', ['activePage' => 'betting'])
            <div class="panel panel-default margin-top-20px">
                <div class="panel-heading">Select a game to bet on</div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Game Name</th>
                            <th>Game Start Time</th>
                            @foreach($games as $game)
                                @foreach($game->outcomes as $key => $outcome)
                                    <th>Team {{ $key+1 }}</th>
                                    <th>Odds</th>
                                @endforeach
                            @endforeach
                        </tr>
                    </thead>
                    @foreach($games as $game)
                        <tr class="table-hover clickable-row" data-href="betting/{{ $game->id }}">
                            <td>{{ $game->game_name }}</td>
                            <td>{{ $game->game_start_time }}</td>
                            @foreach($game->outcomes as $outcome)
                                <td>{{ $outcome->outcome_name }}</td>
                                <td>{{ $outcome->outcome_odds }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection