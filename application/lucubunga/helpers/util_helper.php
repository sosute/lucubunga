<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * キャッシュ処理
 *
 * @access public
 * @param object
 *
 */
function mycache(&$CI, $minutes = 99999)
{
	if (ENVIRONMENT === 'production')
	{
		$CI->output->cache($minutes);
	}
}

/**
 * お申し込みID作成
 *
 * @access public
 * @param array
 * @return string
 *
 */
function get_esta_app_id($app_values)
{
	$app_id_key = $app_values['app_date']
	            . $app_values['lastname']
	            . $app_values['firstname']
	            . $app_values['passport_number'];
	$app_id = 'a' . md5($app_id_key);
	return $app_id;
}

/**
 * ユーザーID作成
 *
 * @access public
 * @param array
 * @return string
 *
 */
function get_esta_app_user_id($app_values)
{
	$app_user_id_key = $app_values['lastname']
	                 . $app_values['firstname']
	                 . $app_values['passport_number'];
	$app_user_id = 'u' . md5($app_user_id_key);
	return $app_user_id;
}

/**
 * 日本語曜日取得
 *
 * @access public
 * @param string
 * @return string
 *
 */
function get_mb_week($timestamp = '')
{
	$mb_weeks = array(
		0 => '日',
		1 => '月',
		2 => '火',
		3 => '水',
		4 => '木',
		5 => '金',
		6 => '土',
	);

	if ($timestamp === '')
	{
		$week = date('w');
	}
	else
	{
		$week = date('w', $timestamp);
	}
	return $mb_weeks[$week];
}

/**
 * 申請ページインプットモジュール出力
 *
 * @access public
 */
function output_html_f_box($id, $module, $error_module, &$param_metas)
{
	$meta = $param_metas[$id];

	// 表示や親子設定
	$f_box_classes[] = 'f_box';
	$f_error_box_classes[] = 'f_error_box';
	if (isset($meta['parent']) && $meta['parent'] !== '')
	{
		$f_error_box_classes[] = $f_box_classes[] = 'f_box_hide';
		$f_error_box_classes[] = $f_box_classes[] = 'child_f_box_'.$meta['parent'];
	}
	$f_box_class       = implode(' ', $f_box_classes);
	$f_error_box_class = implode(' ', $f_error_box_classes);

	// 必須項目
	$must_or_option = '';
	if ( ! isset($meta['is_must']))
	{
		$must_or_option = '';
	}
	else if ($meta['is_must'] === true)
	{
		//$must_or_option = '<img src="/assets/esta-o/img/must.gif" alt="必須項目" class="f_must_or_option">';
		$must_or_option = '<span class="f_must">必須</span>';
	}
	else if ($meta['is_must'] === false)
	{
		//$must_or_option = '<img src="/assets/esta-o/img/option.gif" alt="任意項目" class="f_must_or_option">';
		//$must_or_option = '<span class="f_option">任意</span>';
		$must_or_option = '';
	}

	// ヒントアイコン
	$hint = '';
	if (isset($meta['is_hint']) && $meta['is_hint'] === true)
	{
		$hint = ''.
			'<a href="#" class="f_hint" name="f_hint_'.$id.'">'.
			//'<img src="/assets/esta-o/img/hint.gif" alt="ヒントを表示する" class="f_hint" />'.
			'<span class="f_hint">？</span>'.
			//'<div class="f_hint">？</div>'.
			'</a>';
	}

	// エラー
	$error = '';
	if (isset($error_module) && ! empty($error_module))
	{
		$error = '<div class="'.$f_error_box_class.'">'.$error_module.'</div>';
	}

	$html = <<<EOD
{$error}
<div id="{$id}" class="{$f_box_class}">
<div class="f_left">
<span class="f_element">{$meta['name_mb']}</span>
</div><!--/f_left-->
<div class="f_center1">
{$hint}
</div>
<div class="f_center2">
{$must_or_option}
</div>
<div class="f_right">{$module}</div><!--/f_right-->
</div><!--/f_box-->
<div class="f_hint_box" id="f_hint_{$id}">{$meta['hint']}</div>
EOD;
	echo $html;
}

/**
 * 申請ページインプットモジュール出力（その他の質問事項）
 *
 * @access public
 */
function output_html_f_question_box($id, $module, $error_module, &$param_metas)
{
	$meta = $param_metas[$id];

	// ヒントアイコン
	$hint = '';
	if (isset($meta['is_hint']) && $meta['is_hint'] === true)
	{
		$hint = ''.
			'<a href="#" class="f_hint" name="f_hint_'.$id.'">'.
			'<div class="f_hint">？</div>'.
			'</a>';
	}

	// エラー
	$error = '';
	if (isset($error_module) && ! empty($error_module))
	{
		$error = '<div class="q_error_box">'.$error_module.'</div>';
	}

	$html = <<<EOD
{$error}
<div id="{$id}" class="q_box">
<div class="q_left">{$module}</div><!--/q_left-->
<div class="q_right">{$meta['desc']}</div><!--/q_right-->
</div><!--/q_box-->
<div class="q_hint_box" id="q_hint_{$id}">{$meta['hint']}</div>
EOD;
	echo $html;
}

/**
 * ヘルパー呼び出しラッパー
 *
 * @access public
 *
 */
function load_my_view(&$CI, $view, $data_contents = array(), $data_frame = array())
{
        $env = $CI->config->item('env');
		$env_url = $CI->config->item('env_url');

		// コンテンツ作成
        $data_contents['env']     = $env;
        $data_contents['env_url'] = $env_url;
        $contents = $CI->load->view(
			'pc/contents/'.$env.$view,
            $data_contents,
            TRUE
        );

		// フレームにコンテンツを結合して出力
		$data_frame['env'] = $env;
		$data_frame['env_url'] = $env_url;
		$data_frame['contents'] = $contents;
        $CI->load->view('pc/frame/'.$env.'main', $data_frame);
}
