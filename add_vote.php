<?php
	session_start();

	$db = new mysqli('127.0.0.1', 'root', '', 'player_stats');

	$q = "SELECT ID, reg_br_igr FROM users_votes WHERE ID=" . $_SESSION['id'] . " AND reg_br_igr='" . $_GET['id'] . "'";

	$res = $db->query($q);

	if( $res->num_rows == 0 ) {
		$q = "INSERT INTO users_votes (ID, reg_br_igr) VALUES (" . $_SESSION['id'] . ", '" . $_GET['id'] . "')";
		$db->query($q);
		$q = "UPDATE igrac SET votes=votes+1 WHERE reg_br_igr='" . $_GET['id'] . "'";
		$db->query($q);
		
		header('Location: player.php?id=' . $_GET['id']);
	}else {
		header('Location: player.php?voted=1&id=' . $_GET['id']);
	}
?>