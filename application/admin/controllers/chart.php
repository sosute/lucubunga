<?php

class Chart extends Application {

	var $db_esta;

	public function __construct()
	{
		parent::__construct();
		$this->ag_auth->restrict('admin');
		$this->config->load('admin_calendar');
		$this->db_esta = $this->load->database('esta_onlinecenter', TRUE);
		$this->load->library('calendar', $this->config->item('calendar_prefs'));
	}

	public function index($ad = 'all', $year = '', $month = '', $day = '')
	{
		// SQLの条件指定文作成
		if ($year !== '' && $month !== '' && $day !== '')
		{
			$y = sprintf('%04d', $year);
			$m = sprintf('%02d', $month);
			$d = sprintf('%02d', $day);
			$cond = "date = '{$year}-{$month}-{$day}'";
		}
		elseif ($year !== '' && $month !== '' && $day === '')
		{
			$y = sprintf('%04d', $year);
			$m = sprintf('%02d', $month);
			$d = '01';
			$cond = "date like '{$year}-{$month}-%'";
		}
		elseif ($year !== '' && ($month === '' || $day === ''))
		{
			$y = sprintf('%04d', $year);
			$m = '01';
			$d = '01';
			$cond = "date like '{$year}-%'";
		}
		else
		{
			$y = $year = date('Y');
			$m = $month = date('m');
			$d = $day = date('d');
			$cond = "date = '{$y}-{$m}-{$d}'";
		}
		$cond .= ' and ad = "'.$ad.'"';

		// 日次集計データを取り出す
		$sql = ''.
			'select '.
				'date_format(date, "%Y") as year, '.
				'date_format(date, "%c") as month, '.
				'date_format(date, "%e") as day, '.
				'apply, '.
				'paid '.
			'from '.
				'chart '.
			'where '.
				$cond;

		$query = $this->db_esta->query($sql);
		$timelines = $query->result_array();

		// 申請数, 決済数
		$sql_sum_count = ''.
			'select '.
				'sum(apply) as apply ,'.
				'sum(paid) as paid '.
			'from '.
				'chart '.
			'where '.
				$cond;

		$query_sum_count = $this->db_esta->query($sql_sum_count);
		$sum_count = $query_sum_count->row_array();

		// 性別
		$sql_sex_sum = ''.
			'select '.
				'sum(sex_m) as M ,'.
				'sum(sex_f) as F '.
			'from '.
				'chart '.
			'where '.
				$cond;

		$query_sex_sum = $this->db_esta->query($sql_sex_sum);
		$sum_sex = $query_sex_sum->row_array();

		// 時間帯
		$sql_time_sum = ''.
			'select '.
				'sum(time_0) as time_00 ,'.
				'sum(time_3) as time_03 ,'.
				'sum(time_6) as time_06 ,'.
				'sum(time_9) as time_09 ,'.
				'sum(time_12) as time_12 ,'.
				'sum(time_15) as time_15 ,'.
				'sum(time_18) as time_18 ,'.
				'sum(time_21) as time_21 '.
			'from '.
				'chart '.
			'where '.
				$cond;

		$query_time_sum = $this->db_esta->query($sql_time_sum);
		$sum_time = $query_time_sum->row_array();

		// 年齢層
		$sql_age_sum = ''.
			'select '.
				'sum(age_0) as age_000 ,'.
				'sum(age_10) as age_010 ,'.
				'sum(age_20) as age_020 ,'.
				'sum(age_30) as age_030 ,'.
				'sum(age_40) as age_040 ,'.
				'sum(age_50) as age_050 ,'.
				'sum(age_60) as age_060 ,'.
				'sum(age_70) as age_070 ,'.
				'sum(age_80) as age_080 ,'.
				'sum(age_90) as age_090 ,'.
				'sum(age_100) as age_100 '.
			'from '.
				'chart '.
			'where '.
				$cond;

		$query_age_sum = $this->db_esta->query($sql_age_sum);
		$sum_age = $query_age_sum->row_array();

		// 都道府県
		$sql_pref_sum = ''.
			'select '.
				'sum(hokkaido) as Hokkaido ,'.
				'sum(aomori) as Aomori ,'.
				'sum(iwate) as Iwate ,'.
				'sum(miyagi) as Miyagi ,'.
				'sum(akita) as Akita ,'.
				'sum(yamagata) as Yamagata ,'.
				'sum(fukushima) as Fukushima ,'.
				'sum(ibaraki) as Ibaraki ,'.
				'sum(tochigi) as Tochigi ,'.
				'sum(gunma) as Gunma ,'.
				'sum(saitama) as Saitama ,'.
				'sum(chiba) as Chiba ,'.
				'sum(tokyo) as Tokyo ,'.
				'sum(kanagawa) as Kanagawa ,'.
				'sum(niigata) as Niigata ,'.
				'sum(toyama) as Toyama ,'.
				'sum(ishikawa) as Ishikawa ,'.
				'sum(fukui) as Fukui ,'.
				'sum(yamanashi) as Yamanashi ,'.
				'sum(nagano) as Nagano ,'.
				'sum(gifu) as Gifu ,'.
				'sum(shizuoka) as Shizuoka ,'.
				'sum(aichi) as Aichi ,'.
				'sum(mie) as Mie ,'.
				'sum(shiga) as Shiga ,'.
				'sum(kyoto) as Kyoto ,'.
				'sum(osaka) as Osaka ,'.
				'sum(hyogo) as Hyogo ,'.
				'sum(nara) as Nara ,'.
				'sum(wakayama) as Wakayama ,'.
				'sum(tottori) as Tottori ,'.
				'sum(shimane) as Shimane ,'.
				'sum(okayama) as Okayama ,'.
				'sum(hiroshima) as Hiroshima ,'.
				'sum(yamaguchi) as Yamaguchi ,'.
				'sum(tokushima) as Tokushima ,'.
				'sum(kagawa) as Kagawa ,'.
				'sum(ehime) as Ehime ,'.
				'sum(kochi) as Kochi ,'.
				'sum(fukuoka) as Fukuoka ,'.
				'sum(saga) as Saga ,'.
				'sum(nagasaki) as Nagasaki ,'.
				'sum(kumamoto) as Kumamoto ,'.
				'sum(oita) as Oita ,'.
				'sum(miyazaki) as Miyazaki ,'.
				'sum(kagoshima) as Kagoshima ,'.
				'sum(okinawa) as Okinawa '.
			'from '.
				'chart '.
			'where '.
				$cond;

		$query_pref_sum = $this->db_esta->query($sql_pref_sum);
		$sum_pref = $query_pref_sum->row_array();

		// 曜日
		$sql_week_sum = ''.
			'select '.
				'sum(monday) as 1_monday ,'.
				'sum(tuesday) as 2_tuesday ,'.
				'sum(wednesday) as 3_wednesday ,'.
				'sum(thursday) as 4_thursday ,'.
				'sum(friday) as 5_friday ,'.
				'sum(saturday) as 6_saturday ,'.
				'sum(sunday) as 7_sunday '.
			'from '.
				'chart '.
			'where '.
				$cond;

		$query_week_sum = $this->db_esta->query($sql_week_sum);
		$sum_week = $query_week_sum->row_array();

		// チャート出力用にデータを加工
		$values = array();
		$tmp = array();
		foreach ($timelines as $timeline)
		{
			$month_js = $timeline['month'] - 1;
			$date_js = "new Date({$timeline['year']}, {$month_js}, {$timeline['day']})";
			$tmp[] = "[{$date_js}, {$timeline['apply']}, null, null, {$timeline['paid']}, null, null]";
		}
		$values['timeline'] = implode(',', $tmp);
		$targets = array(
			'sex'   => $sum_sex,
			'time'  => $sum_time,
			'age'   => $sum_age,
			'pref'  => $sum_pref,
			'week'  => $sum_week,
		);
		foreach ($targets as $key => $target)
		{
			$tmp = array();
			foreach ($target as $element => $counts)
			{
				if (is_array($counts))
				{
					$tmp[] = json_encode(array_values($counts));
				}
				else
				{
					$tmp[] = json_encode(array($element, (int)$counts));
				}
			}
			$values['sum'][$key] = str_replace('"', "'", implode(',', $tmp));
		}
		$values['apply'] = $sum_count['apply'];
		$values['paid']  = $sum_count['paid'];
		$values['year']  = $year;
		$values['month'] = $month;
		$values['day']   = $day;
		$values['ad']    = $ad;

		// カレンダー
		$calendar_links = array();
		for ($i = 1; $i <= date('t', strtotime($y.$m.$d)); $i++)
		{
			if ($day === '' || $i !== (int)$d)
			{
				$calendar_links[$i] = base_url('chart/index/'.$ad.'/'.$y.'/'.$m.'/'.sprintf('%02d', $i).'/');
			}
		}
		$values['calendar'] = $this->calendar->generate($ad, $y, $m, $calendar_links);

		// 出力
		$this->ag_auth->view('tools/chart/index', $values);
	}
}
