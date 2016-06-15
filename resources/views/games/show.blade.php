@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('layouts.partials.navbar', ['activePage' => 'gamesAdmin'])
            <div class="panel panel-default margin-top-20px">
                <div class="panel-heading">Current odds on {{ $game->game_name }}</div>
                <table class="table table-hover table-bordered">
                    <tbody>
                        @foreach($game->outcomes as $outcome)
                            <tr>
                                <td class="col-md-5">{{ $outcome->outcome_name }}</td>
                                <td class="col-md-5">{{ $outcome->outcome_odds }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                @foreach($outcomes as $outcome)
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Bets on {{ $outcome->outcome_name }}
                                <div class="pull-right">Pending Volume {{ $outcome->total_volume_pending }}</div>
                            </div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Odds</th>
                                        <th>Stake</th>
                                        <th>Total</th>
                                        <th>Pending</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingBets as $bet)
                                        @if($bet->outcome_name == $outcome->outcome_name)
                                            <tr>
                                                <td>{{ $bet->user->name }}</td>
                                                <td>{{ $bet->odds }}</td>
                                                <td>{{ $bet->stake }}</td>
                                                <td>{{ $bet->total_amount }}</td>
                                                <td>{{ $bet->pending_amount }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach($outcomes as $outcome)
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Filled bets on {{ $outcome->outcome_name }}</div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Odds</th>
                                        <th>Stake</th>
                                        <th>Total</th>
                                        <th>Pending</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($filledBets as $bet)
                                        @if($bet->outcome_name == $outcome->outcome_name)
                                            <tr>
                                                <td>{{ $bet->user->name }}</td>
                                                <td>{{ $bet->odds }}</td>
                                                <td>{{ $bet->stake }}</td>
                                                <td>{{ $bet->total_amount }}</td>
                                                <td>{{ $bet->pending_amount }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection