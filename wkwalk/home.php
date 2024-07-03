<?php
// include required classes and configs 
require_once 'includes/config.php';
require_once 'includes/functions.php';
require_once 'includes/dbcon.php';

?>

<div id="weekly">
<h1>This Weeks Top 5 Individuals</h1>
<table id="ranktable">
    <thead>
    	<tr>
        	<th width="20px" scope="col">Rank</th>
            <th width="150px" scope="col">Individual</th>
			<th width="65px" scope="col">Steps Taken</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$oneweekago = time() - 604800;
		$sql = "SELECT s.*,u.firstname,u.lastname FROM  steps AS s LEFT JOIN users as u ON s.userid =u.userid WHERE timestamp > '" . $oneweekago . "'";
		$query = mysql_query($sql);
		
		$rows = array();
		
		while ($row = mysql_fetch_assoc($query)) {
			$rows[$row['userid']][] = $row;
		}

		foreach ($rows as $w) {
			$count = 0;
			foreach ($w as $key => $p) {
				$winner[$w[0]['userid']]['name']= $p['firstname'].' '.$p['lastname'];
				$count =  $count + $p['stepcount'];
			}
			$winner[$w[0]['userid']]['totalsteps'] = $count;
		}
		
		$winners = array_sort($winner, 'totalsteps', SORT_DESC);
		
		$rank = 1;

		foreach($winners as $winner) {
			echo '<tr>';
			echo '<td>'.$rank.'</td>';
			echo '<td>'.$winner['name'].'</td>';
			echo '<td>'.$winner['totalsteps'].'</td>';
			echo '</tr>';
			$rank++;
			if ($rank > 5) {
				break;
			}
		}
	
	?>
	    </tbody>
</table>
</div>

<div id="people">
<h1>Individual Rankings</h1>
<table id="ranktable">
    <thead>
    	<tr>
        	<th width="20px" scope="col">Rank</th>
            <th width="150px" scope="col">Individual</th>
			<th width="65px" scope="col">Steps Taken</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$sql = "SELECT s.*,u.firstname,u.lastname FROM  steps AS s LEFT JOIN users as u ON s.userid =u.userid";
		$query = mysql_query($sql);
		
		$rows = array();
		
		while ($row = mysql_fetch_assoc($query)) {
			$rows[$row['userid']][] = $row;
		}
		
		foreach ($rows as $r) {
			$count = 0;
			foreach ($r as $key => $v) {
				$user[$r[0]['userid']]['name']= $v['firstname'].' '.$v['lastname'];
				$count =  $count + $v['stepcount'];
			}
			$user[$r[0]['userid']]['totalsteps'] = $count;
		}
		
		$users = array_sort($user, 'totalsteps', SORT_DESC);
		
		$rank = 1;
		foreach($users as $user) {
			echo '<tr>';
			echo '<td>'.$rank.'</td>';
			echo '<td>'.$user['name'].'</td>';
			echo '<td>'.$user['totalsteps'].'</td>';
			echo '</tr>';
			$rank++;
		}
		
	?>
	    </tbody>
</table>
</div>

<div id="teams">
<h1>Team Rankings</h1>
<table id="ranktable">
    <thead>
    	<tr>
        	<th width="20px" scope="col">Rank</th>
            <th width="150px" scope="col">Team Name</th>
			<th width="65px" scope="col">Steps Taken</th>
        </tr>
    </thead>
    <tbody>
<?php

	$sql = "SELECT s.*,t.teamname FROM steps AS s LEFT JOIN team as t ON s.teamid = t.teamid";
	$query = mysql_query($sql);
	
	$rows = array();
	
	while ($row = mysql_fetch_assoc($query)) {
		$rows[$row['teamid']][] = $row;
	}
	
	if (empty($rows)) {
		echo '<tr span=3><td>No steps recorded.</td></tr>';
		return;
	}

	foreach ($rows as $t) {
		$count = 0;
		foreach ($t as $key => $m) {
			$team[$t[0]['teamid']]['teamname']= $m['teamname'];
			$count =  $count + $m['stepcount'];
		}
		$team[$t[0]['teamid']]['totalsteps'] = $count;
	}
	
	
	$teams = array_sort($team, 'totalsteps', SORT_DESC);

	$rank = 1;
	foreach($teams as $team) {
		echo '<tr>';
		echo '<td>'.$rank.'</td>';
		echo '<td>'.$team['teamname'].'</td>';
		echo '<td>'.$team['totalsteps'].'</td>';
		echo '</tr>';
		$rank++;
		
	}
	
	
	function array_sort($array, $on, $order=SORT_ASC)
	{
		$new_array = array();
		$sortable_array = array();

		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}

			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}

			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}

		return $new_array;
	}

?>
    </tbody>
</table>
</div>