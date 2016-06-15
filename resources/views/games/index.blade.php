@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs">
              <li role="presentation"><a href="/betting">Betting</a></li>
              <li role="presentation" class="active"><a href="/games">Games (Admin)</a></li>
            </ul>
            <div class="panel panel-default margin-top-20px">
                <div class="panel-heading">Create a game</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <form {{ action('GamesController@store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="game_name">Game Name</label>
                                <input type="text" class="form-control" name="game_name" placeholder="Game Name">
                            </div>
                            <div class="form-group">
                                <label for="outcome_1_name">Outcome 1 Name</label>
                                <input type="text" class="form-control" name="outcome_1_name" placeholder="Outcome 1 Name">
                            </div>
                            <div class="form-group">
                                <label for="outcome_2_name">Outcome 2 Name</label>
                                <input type="text" class="form-control" name="outcome_2_name" placeholder="Outcome 2 Name">
                            </div>
                            <button class="btn btn-primary" type="submit">Create</button>
                        </form>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if(isset($games))
                <div class="panel panel-default">
                    <div class="panel-heading">Current Games</div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Game Name</th>
                                <th>Game Start Time</th>
                            </tr>
                        </thead>
                        @foreach($games as $game)
                            <tr class="table-hover clickable-row" data-href="games/{{ $game->id }}">
                                <td>{{ $game->game_name }}</td>
                                <td>{{ $game->game_start_time }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection