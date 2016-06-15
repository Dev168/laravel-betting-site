<ul class="nav nav-tabs">
	<li role="presentation" @if($activePage == "betting") class="active" @endif><a href="/betting">Betting</a></li>
	<li role="presentation" @if($activePage == "myBets") class="active" @endif><a href="/user/bets">My Bets</a></li>
	<li role="presentation" @if($activePage == "gamesAdmin") class="active" @endif><a href="/games">Games (Admin)</a></li>
</ul>