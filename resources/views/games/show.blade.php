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
                <div class="panel-heading">Betting on {{ $game->game_name }}</div>
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr>
                            <td class="col-md-5">{{ $game->outcome_1_name }}</td>
                            <td class="col-md-5">{{ $game->outcome_1_odds }}</td>
                            <td class="col-md-2">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#betting-modal">
                                Place Bet
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $game->outcome_2_name }}</td>
                            <td>{{ $game->outcome_2_odds }}</td>
                            <td class="white-space-no-wrap">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#betting-modal">
                                Place Bet
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                <h4 class="modal-title" id="bettingModalTitle">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection