@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="/betting">Betting</a></li>
              <li role="presentation"><a href="/games">Games (Admin)</a></li>
            </ul>
            <div class="panel panel-default margin-top-20px">
                <div class="panel-heading">Betting on {{ $game->game_name }}</div>
                <table class="table table-hover table-bordered">
                    <tbody>
                        @foreach($game->outcomes as $outcome)
                            <tr>
                                <td class="col-md-5">{{ $outcome->outcome_name }}</td>
                                <td class="col-md-5">{{ $outcome->outcome_odds }}</td>
                                <td class="col-md-2">
                                    <button 
                                        type="button" 
                                        class="btn btn-success" 
                                        data-toggle="modal" 
                                        data-target="#betting-modal" 
                                        data-outcome="{{ $outcome->outcome_name }}"
                                        data-odds="{{ $outcome->outcome_odds }}"
                                    >
                                    Place Bet
                                    </button>
                                </td>
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

<!-- Betting Modal -->
<div class="modal fade" id="betting-modal" tabindex="-1" role="dialog" aria-labelledby="bettingModalTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="bettingModalTitle">Place bet on {{ $game->game_name }}</h4>
            </div>
            <div class="modal-body">
                <form action="/betting" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="gameId" value="{{ $game->id }}">
                    <div class="form-group">
                        <label for="outcome_name">Betting on</label>
                        <input class="form-control" type="text" name="outcome_name" id="outcome_name" readonly>
                    </div>

                    <div class="form-group">
                        <label for="odds">Odds</label>
                        <input class="form-control" type="text" name="odds" id="odds" readonly>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount ($)</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input class="form-control" type="text" name="amount" id="amount" value="50.00" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary pull-right" type="submit">Place Bet</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#betting-modal').on('show.bs.modal', function (event){
        var button = $(event.relatedTarget)
        var outcome = button.data('outcome')
        var odds = button.data('odds')

        $(".modal-body #outcome_name").val( outcome );
        $(".modal-body #odds").val( odds );
    })
</script>

@endsection