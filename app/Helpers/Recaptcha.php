<?php

namespace App\Helpers;

abstract class Recaptcha
{
	private const PRIVATE_KEY = '6LcOqTIUAAAAACKx-1jtYriImkcerRculHYedkVD';
	private const URL = 'https://www.google.com/recaptcha/api/siteverify';

	public static function check($response):bool{
		$request = file_get_contents(Recaptcha::fullUrl($response), true);
		$data = json_decode($request);
		return (isset($data->success) && $data->success==true);
	}

	private static function fullUrl($response) {
		return self::URL.'?secret='.self::PRIVATE_KEY.'&response='.$response.'&server=127.0.0.1';
	}
}