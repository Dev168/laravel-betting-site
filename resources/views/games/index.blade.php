@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs">
              <li role="presentation"><a href="/betting">Betting</a></li>
              <li role="presentation" class="active"><a href="/games">Games</a></li>
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
                    <div class="panel-body">
                        <ul>
                            @foreach($games as $game)
                                <li>{{ $game->game_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection