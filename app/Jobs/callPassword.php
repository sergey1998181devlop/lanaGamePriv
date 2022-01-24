<?php

namespace App\Jobs;
class CallPassword
{

	public  static function getToken(
		$methodName,
		$time,
		$keyNewtel,
		$params,
		$writeKey
	) {
		return $keyNewtel . $time . hash(
			'sha256',
			$methodName . "\n" . $time . "\n" . $keyNewtel . "\n" .
				$params . "\n" . $writeKey
		);
	}
	public  static function call($phone, $confirm_code)
	{
        return true;
		$dataArr = [
			'dstNumber' => '7'.$phone,
			'pin' => $confirm_code
		];
		$data = json_encode($dataArr);
		$time = time();
		$resId = curl_init();
		$token = CallPassword::getToken(
			'call-password/start-password-call',
			$time,
			env('KEYNEWTEL'),
			$data,
            env('WRITEKEY')
		);

		curl_setopt_array($resId, [
			CURLINFO_HEADER_OUT => true,
			CURLOPT_HEADER => 0,
			CURLOPT_HTTPHEADER => [
				'Authorization: Bearer ' . $token,
				'Content-Type: application/json',
			],
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_URL => 'https://api.new-tel.net/call-password/start-password-call',
			CURLOPT_POSTFIELDS => $data,
		]);
		$response = curl_exec($resId);
		// $curlInfo = curl_getinfo($resId);
		if ($response) {

			$response = json_decode($response);
			if (isset($response->status) && $response->status == 'success') {
				return true;
			}
		}
		return false;
	}
}
?>