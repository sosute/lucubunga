<?php

class Proxy extends CI_Controller {

	public function roman()
	{
		//mycache($this);

		$address_romans = array();
		$address_roman = '';

		//$sentence = $_GET['sentence'];
		$sentence = $this->input->get('sentence');
		$url = 'http://jlp.yahooapis.jp/FuriganaService/V1/furigana';
		$post = array(
			'appid' => 'dj0zaiZpPTFuZXFSYWF0aWNGUSZkPVlXazlPREJOYkZSVk4ya21jR285TUEtLSZzPWNvbnN1bWVyc2VjcmV0Jng9N2E-',
			'sentence' => $sentence,
		);
		$url .= '?'.http_build_query($post);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$xml = simplexml_load_string($result);

		//var_dump($xml);
		$tmp = '';
		foreach ($xml->Result->WordList->Word as $word)
		{
			//$address_romans[] = ucfirst($word->Roman);
			if ((string)$word->Surface === '、')
			{        $address_romans[] = ucfirst($tmp);        $tmp = '';
			}
			else
			{        $tmp .= str_replace('si', 'shi', $word->Roman);
			}
		}
		$address_romans[] = $tmp;
		$address_roman = implode(' ', $address_romans);
		//echo $xml->Result->WordList->Word->Roman;
		echo $address_roman;
		//var_dump($xml);


		/*
		$data_contents = array();
		$contents = $this->load->view('pc/contents/top/index', $data_contents, TRUE);
		$data_frame = array();
		$data_frame['contents'] = $contents;
		$this->load->view('pc/frame/main', $data_frame);
		*/
	}
}
