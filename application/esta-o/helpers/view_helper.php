<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
