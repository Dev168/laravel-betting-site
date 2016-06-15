@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('layouts.partials.navbar', ['activePage' => 'myBets'])
            <div class="panel panel-default margin-top-20px">
                <div class="panel-heading">My Bets</div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Bet Id</th>
                            <th>Game</th>
                            <th>Team</th>
                            <th>Odds</th>
                            <th>Stake</th>
                            <th>Total</th>
                            <th>Pending</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    @foreach($bets as $bet)
                        <tr class="table-hover">
                            <td>{{ $bet->id }}</td>
                            <td>{{ $bet->game->game_name }}</td>
                            <td>{{ $bet->outcome_name }}</td>
                            <td>{{ $bet->odds }}</td>
                            <td>{{ $bet->stake }}</td>
                            <td>{{ $bet->total_amount }}</td>
                            <td>{{ $bet->pending_amount }}</td>
                            <td>{{ $bet->created_at }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection