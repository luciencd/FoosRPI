<div id="liveScores">
	<div id="innerScores">
		<?php
		require(realpath(dirname(__FILE__)).'/../global_assets/global_php/connect.php');
		?>
	</div>
</div>
<div class="signInUp">
	<h2>Sign In</h2>
	<form method="POST" id="signInForm">
		<input type="text" name="email" id="email" value="Email" /><br>
		<input type="text" name="passwordFake" id="passwordFake" value="Password" /><input type="password" name="password" id="password" value="" style="display: none;" /><br>
		<input type="submit" name="submitButton" id="submitButton" value="Sign In" class="button" />
		<div class="error"></div>
	</form>
</div>

<div class="signInUp">
	<h2>Join</h2>
	<form method="POST" id="joinForm">
		<input type="text" name="name" id="name" value="Full Name" /><br>
		<input type="text" name="email" id="email" value="Email" /><br>
		<input type="text" name="rin" id="rin" value="RIN Number" /><br>
		<input type="text" name="phone" id="phone" value="Phone Number" /><br><span style="font-size: 10px; margin-top: -8px; display:block;">(e.g.: 1234567890)</span>
		<input type="text" name="passwordFake" id="passwordFake" value="Password" /><input type="password" name="password" id="password" value="" style="display: none;" /><br>
		<input type="text" name="password2Fake" id="password2Fake" value="Repeat Password" /><input type="password" name="password2" id="password2" value="" style="display: none;" /><br>
		<select name="dorm" style="width: 160px;">
			<option value="na">-- Select Residence --</option>
			<option value="Acacia">Acacia</option>
			<option value="Alpha Chi Rho">Alpha Chi Rho</option>
			<option value="Alpha Epsilon Pi">Alpha Epsilon Pi</option>
			<option value="Alpha Gamma Delta">Alpha Gamma Delta</option>
			<option value="Alpha Omega Epsilon">Alpha Omega Epsilon</option>
			<option value="Alpha Phi">Alpha Phi</option>
			<option value="Alpha Phi Alpha">Alpha Phi Alpha</option>
			<option value="Alpha Sigma Phi">Alpha Sigma Phi</option>
			<option value="BARH (Burdett Avenue Residence Hall)">BARH (Burdett Avenue Residence Hall)</option>
			<option value="Barton Hall">Barton Hall</option>
			<option value="Beman Lane Undergraduate RAHP Apartments">Beman Lane Undergraduate RAHP Apartments</option>
			<option value="Bi Beta Phi">Bi Beta Phi</option>
			<option value="Blitman Residence Commons">Blitman Residence Commons</option>
			<option value="Bray Hall">Bray Hall</option>
			<option value="Bryckwyck">Bryckwyck</option>
			<option value="Cary Hall">Cary Hall</option>
			<option value="Chi Phi">Chi Phi</option>
			<option value="Colonie Apartments">Colonie Apartments</option>
			<option value="Crockett Hall">Crockett Hall</option>
			<option value="Davison Hall">Davison Hall</option>
			<option value="Delta Phi">Delta Phi</option>
			<option value="Delta Tau Delta">Delta Tau Delta</option>
			<option value="E-Complex">E-Complex</option>
			<option value="Hall Hall">Hall Hall</option>
			<option value="Lambda Chi Alpha">Lambda Chi Alpha</option>
			<option value="Lambda Upsilon Lambda">Lambda Upsilon Lambda</option>
			<option value="Nason Hall">Nason Hall</option>
			<option value="North Hall">North Hall</option>
			<option value="Nugent Hall">Nugent Hall</option>
			<option value="Phi Gamma Delta">Phi Gamma Delta</option>
			<option value="Phi Iota Alpha">Phi Iota Alpha</option>
			<option value="Phi Kappa Tau">Phi Kappa Tau</option>
			<option value="Phi Kappa Theta">Phi Kappa Theta</option>
			<option value="Phi Mu Delta">Phi Mu Delta</option>
			<option value="Phi Sigma Kappa">Phi Sigma Kappa</option>
			<option value="Pi Delta Psi">Pi Delta Psi</option>
			<option value="Pi Kappa Alpha">Pi Kappa Alpha</option>
			<option value="Pi Kappa Phi">Pi Kappa Phi</option>
			<option value="Pi Lambda Phi">Pi Lambda Phi</option>
			<option value="Polytechnic Residence Commons">Polytechnic Residence Commons</option>
			<option value="Psi Upsilon">Psi Upsilon</option>
			<option value="Quadrangle (The Quad)">Quadrangle (The Quad)</option>
			<option value="Rensselaer Society of Engineers">Rensselaer Society of Engineers</option>
			<option value="Sharp Hall">Sharp Hall</option>
			<option value="Sigma Alpha Epsilon">Sigma Alpha Epsilon</option>
			<option value="Sigma Chi">Sigma Chi</option>
			<option value="Sigma Delta">Sigma Delta</option>
			<option value="Sigma Phi Epsilon">Sigma Phi Epsilon</option>
			<option value="Single RAHP">Single RAHP</option>
			<option value="Stacwyck Apartments">Stacwyck Apartments</option>
			<option value="Tau Epsilon Pi">Tau Epsilon Pi</option>
			<option value="Theta Chi">Theta Chi</option>
			<option value="Theta Xi">Theta Xi</option>
			<option value="Warren Hall">Warren Hall</option>
			<option value="Zeta Psi">Zeta Psi</option>
		</select><br>
		<input type="submit" name="submitButton" id="submitButton" value="Join" class="button" />
		<div class="error"></div>
	</form>
</div>
<div class="clear"></div>
<div class="leaderboards" style="padding-bottom: 0px!important;">
	<h1>Leaderboard</h1>
	
	<div class="row" id="headRow">
		<div style="width: 8%; line-height: 32px;">Position</div>
		<div style="width: 25%; line-height: 32px; text-align: left;">Name</div>
		<div style="width: 7%; line-height: 32px;">Rating</div>
		<div style="width: 7%; line-height: 32px;">Played</div>
		<div style="width: 7%; line-height: 32px;">Wins</div>
		<div style="width: 7%; line-height: 32px;">Loses</div>
		<div style="width: 7%;">Goals For</div>
		<div style="width: 7%;">Goals Against</div>
		<div style="width: 7%;">Goal Diff.</div>
		<div class="clear" style="width: 0%;"></div>
	</div>
	<?php
	// Query to obtain top players
	$query = mysql_query('SELECT * FROM `users` ORDER BY `rating` DESC LIMIT 10');
	$i = 0;
	while($row=mysql_fetch_array($query)){
		?>
		<div class="row">
			<div style="width: 8%;"><?=($i+1)?></div>
			<div style="width: 25%; text-align: left;"><?=$row[name]?></div>
			<div style="width: 7%;"><?=$row[rating]?></div>
			<div style="width: 7%;"><?=($row[gamesWon]+$row[gamesLost])?></div>
			<div style="width: 7%;"><?=$row[gamesWon]?></div>
			<div style="width: 7%;"><?=$row[gamesLost]?></div>
			<div style="width: 7%;"><?=$row[goalsFor]?></div>
			<div style="width: 7%;"><?=$row[goalsAgainst]?></div>
			<div style="width: 7%;"><?=($row[goalsFor]-$row[goalsAgainst])?></div>
			<div class="clear" style="width: 0%;"></div>
		</div>
		<?php
		++$i;
	}
	?>
</div>
<div class="leaderboards" style="padding-bottom: 0px!important;">
	<h1>Residence Leaderboard</h1>
	
	<div class="row" id="headRow">
		<div style="width: 8%; line-height: 32px;">Position</div>
		<div style="width: 25%; line-height: 32px; text-align: left;">Name</div>
		<div style="width: 13%; line-height: normal;">Average Rating</div>
		<div style="width: 14%; line-height: 32px;">Total Played</div>
		<div style="width: 14%; line-height: 32px;">Percent Won</div>
		<div style="width: 14%; line-height: 32px;"># Players</div>
		<div class="clear" style="width: 0%;"></div>
	</div>
	<?php
	// Query to obtain top dorms
	$dorms = array('Acacia', 'Alpha Chi Rho', 'Alpha Epsilon Pi', 'Alpha Gamma Delta', 'Alpha Omega Epsilon', 'Alpha Phi', 'Alpha Phi Alpha', 'Alpha Sigma Phi', 'BARH (Burdett Avenue Residence Hall)', 'Barton Hall', 'Beman Lane Undergraduate RAHP Apartments', 'Bi Beta Phi', 'Blitman Residence Commons', 'Bray Hall', 'Bryckwyck', 'Cary Hall', 'Chi Phi', 'Colonie Apartments', 'Crockett Hall', 'Davison Hall', 'Delta Phi', 'Delta Tau Delta', 'E-Complex', 'Hall Hall', 'Lambda Chi Alpha', 'Lambda Upsilon Lambda', 'Nason Hall', 'North Hall', 'Nugent Hall', 'Phi Gamma Delta', 'Phi Iota Alpha', 'Phi Kappa Tau', 'Phi Kappa Theta', 'Phi Mu Delta', 'Phi Sigma Kappa', 'Pi Delta Psi', 'Pi Kappa Alpha', 'Pi Kappa Phi', 'Pi Lambda Phi', 'Polytechnic Residence Commons', 'Psi Upsilon', 'Quadrangle (The Quad)', 'Rensselaer Society of Engineers', 'Sharp Hall', 'Sigma Alpha Epsilon', 'Sigma Chi', 'Sigma Delta', 'Sigma Phi Epsilon', 'Single RAHP', 'Stacwyck Apartments', 'Tau Epsilon Pi', 'Theta Chi', 'Theta Xi', 'Warren Hall', 'Zeta Psi');
	$resultArray = array();
	foreach($dorms as $dorm){
	
		$query = mysql_query('SELECT * FROM `users` WHERE `dorm`="'.$dorm.'"');
		$gamesPlayed = 0;
		$aveRating = 0;
		$percentGamesWon = 0;
		$numPlayers = mysql_num_rows($query);
		if($numPlayers>0){
			while($row=mysql_fetch_array($query)){
				$gamesPlayed += $row[gamesWon]+$row[gamesLost];
				$aveRating += $row[rating];
				$percentGamesWon += $row[gamesWon]/($row[gamesWon]+$row[gamesLost]);
			}
			$aveRating = $aveRating/$numPlayers;
			$percentGamesWon = $percentGamesWon/$numPlayers;
			array_push($resultArray, array($dorm, $aveRating, $gamesPlayed, (round($percentGamesWon,2)*100), $numPlayers));
		}
	}
	
	function cmp_by_optionNumber($a, $b) {
		return $b[1] - $a[1];
	}
	
	usort($resultArray, "cmp_by_optionNumber");
	
	$i = 0;
	foreach($resultArray as $dorm){
		?>
		<div class="row">
			<div style="width: 8%;"><?=($i+1)?></div>
			<div style="width: 25%; text-align: left; white-space: normal;"><?=$dorm[0]?></div>
			<div style="width: 13%;"><?=$dorm[1]?></div>
			<div style="width: 14%;"><?=$dorm[2]?></div>
			<div style="width: 14%;"><?=$dorm[3]?>%</div>
			<div style="width: 14%;"><?=$dorm[4]?></div>
			<div class="clear" style="width: 0%;"></div>
		</div>
		<?php
		++$i;
	}
	?>
</div>