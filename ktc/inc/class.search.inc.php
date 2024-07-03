<?php

class KTCSearch
{
	public function searchAccountNum($num)
	{
		$sql = "SELECT * FROM customers WHERE account_number=$num";
		
	}
}