<?php

class Mail2bookmarklet extends Application {

	public function __construct()
	{
		parent::__construct();
		$this->ag_auth->restrict('ops');
		$this->load->library('form_validation');
	}

	public function index()
	{
		// 申請メール情報を配列に展開
		$app_values = array(
			'lastname' => '',
			'firstname' => '',
			'country_birth' => '',
			'country_national' => '',
			'country_live' => '',
			'birth_year' => '',
			'birth_month' => '',
			'birth_day' => '',
			'sex' => '',
			'passport_number' => '',
			'passport_from_year' => '',
			'passport_from_month' => '',
			'passport_from_day' => '',
			'passport_to_year' => '',
			'passport_to_month' => '',
			'passport_to_day' => '',
			'q1' => '',
			'q2' => '',
			'q3' => '',
			'q4' => '',
			'q5' => '',
			'q6' => '',
			'q6_when' => '',
			'q6_where' => '',
			'q7' => '',
			'id_sex' => '',
			'id_q1' => '',
			'id_q2' => '',
			'id_q3' => '',
			'id_q4' => '',
			'id_q5' => '',
			'id_q6' => '',
			'id_q7' => '',
			'mail_body' => '',
		);

		$app_values['mail_body'] = trim($this->input->post('mail_body'));
		if ( ! empty($app_values['mail_body']))
		{
			$lines = explode("/n", $app_values['mail_body']);
			foreach ($lines as $line)
			{
				if (preg_match('/姓（英文）：(.+)/', $line, $matches))
				{
					$app_values['lastname'] = strtoupper(mb_convert_kana($matches[1], 'ras'));
				}
				if (preg_match('/名（英文）：(.+)/', $line, $matches))
				{
					$app_values['firstname'] = strtoupper(mb_convert_kana($matches[1], 'ras'));
				}
				$app_values['sex'] = (preg_match('/性別：(M|F)/', $line, $matches)) ? $matches[1] : '';
				if (preg_match('/パスポート番　　号：(.+)/', $line, $matches))
				{
					$app_values['passport_number'] = strtoupper(mb_convert_kana($matches[1], 'ras'));
				}
				if (preg_match('/生年月日：(.+)/', $line, $matches))
				{
					list(
						$app_values['birth_year'],
						$app_values['birth_month'],
						$app_values['birth_day']
					) = sscanf($matches[1], '%4d年%2d月%2d日');
				}
				if (preg_match('/パスポート発 行 日：(.+)/', $line, $matches))
				{
					list(
						$app_values['passport_from_year'],
						$app_values['passport_from_month'],
						$app_values['passport_from_day']
					) = sscanf($matches[1], '%4d年%2d月%2d日');
				}
				if (preg_match('/パスポート有効期限：(.+)/', $line, $matches))
				{
					list(
						$app_values['passport_to_year'],
						$app_values['passport_to_month'],
						$app_values['passport_to_day']
					) = sscanf($matches[1], '%4d年%2d月%2d日');
				}
				if (preg_match('/国籍：(.+)/', $line, $matches))
				{
					if ($matches[1] === 'JAPAN (JPN)')
						$app_values['country_national'] = 'JP';
				}
				if (preg_match('/出生国：(.+)/', $line, $matches))
				{
					if ($matches[1] === 'JAPAN (JPN)')
						$app_values['country_birth'] = 'JP';
				}
				if (preg_match('/居住国：(.+)/', $line, $matches))
				{
					if ($matches[1] === 'JAPAN (JPN)')
						$app_values['country_live'] = 'JP';
				}
				if (preg_match('/質問A：(.+)/', $line, $matches)) $app_values['q1'] = ucfirst(strtolower($matches[1]));
				if (preg_match('/質問B：(.+)/', $line, $matches)) $app_values['q2'] = ucfirst(strtolower($matches[1]));
				if (preg_match('/質問C：(.+)/', $line, $matches)) $app_values['q3'] = ucfirst(strtolower($matches[1]));
				if (preg_match('/質問D：(.+)/', $line, $matches)) $app_values['q4'] = ucfirst(strtolower($matches[1]));
				if (preg_match('/質問E：(.+)/', $line, $matches)) $app_values['q5'] = ucfirst(strtolower($matches[1]));
				if (preg_match('/質問F：(.+)/', $line, $matches)) $app_values['q6'] = ucfirst(strtolower($matches[1]));
				if (preg_match('/質問G：(.+)/', $line, $matches)) $app_values['q7'] = ucfirst(strtolower($matches[1]));
				if (preg_match('/いつ（(.*)）\/どこで（(.*)）/', $line, $matches))
				{
					$app_values['q6_when'] = $matches[1];
					$app_values['q6_where'] = $matches[2];
				}
				if ($app_values['sex'] === 'M')
				{
					$app_values['id_sex'] = '1';
				}
				elseif ($app_values['sex'] === 'F')
				{
					$app_values['id_sex'] = '2';
				}
				else
				{
					$app_values['id_sex'] = '';
				}
				$app_values['id_q1'] = ($app_values['q1'] === '-----[yes]-----') ? '1' : '2';
				$app_values['id_q2'] = ($app_values['q2'] === '-----[yes]-----') ? '1' : '2';
				$app_values['id_q3'] = ($app_values['q3'] === '-----[yes]-----') ? '1' : '2';
				$app_values['id_q4'] = ($app_values['q4'] === '-----[yes]-----') ? '1' : '2';
				$app_values['id_q5'] = ($app_values['q5'] === '-----[yes]-----') ? '1' : '2';
				$app_values['id_q6'] = ($app_values['q6'] === '-----[yes]-----') ? '1' : '2';
				$app_values['id_q7'] = ($app_values['q7'] === '-----[yes]-----') ? '1' : '2';
			}
		}
		$_POST = $app_values;
		if ($this->form_validation->run('mail2bookmarklet') === FALSE)
		{
			$app_values['is_valid'] = FALSE;
		}
		else
		{
			$app_values['is_valid'] = TRUE;
		}
		$this->ag_auth->view('tools/mail2bookmarklet/index', $app_values);
	}
}
