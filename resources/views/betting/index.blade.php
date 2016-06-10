@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="/betting">Betting</a></li>
              <li role="presentation"><a href="/games">Games</a></li>
            </ul>
            <div class="panel panel-default margin-top-20px">
                <div class="panel-heading">Select a game to bet on</div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Game Name</th>
                            <th>Game Start Time</th>
                            <th>Team 1</th>
                            <th>Odds</th>
                            <th>Team 2</th>
                            <th>Odds</th>
                        </tr>
                    </thead>
                    @foreach($games as $game)
                        <tr class="table-hover clickable-row" data-href="games/{{ $game->id }}">
                            <td>{{ $game->game_name }}</td>
                            <td>{{ $game->game_time }}</td>
                            <td>{{ $game->outcome_1_name }}</td>
                            <td>{{ $game->outcome_1_odds }}</td>
                            <td>{{ $game->outcome_2_name }}</td>
                            <td>{{ $game->outcome_1_odds }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
</script>
@endsection