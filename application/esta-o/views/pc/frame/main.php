<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="Pragma" content="no-cache" /> 
<meta http-equiv="Cache-Control" content="no-cache" /> 
<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="noindex,nofollow,noarchive" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="/assets/esta-o/img/201504/favicon.ico" />
<link rel="stylesheet" type="text/css" href="/assets/esta-o/css<?php echo $env_url;?>/advanced.css" />
<link rel="stylesheet" type="text/css" href="/assets/esta-o/css<?php echo $env_url;?>/style.css" />
<link rel="stylesheet" type="text/css" href="/assets/esta-o/css<?php echo $env_url;?>/form.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script type="text/javascript" src="/assets/esta-o/js<?php echo $env_url;?>/jquery.placeholder.js"></script>
<title><?php echo $env.' ';?>ESTA Online Center｜エスタ・オンライン・センター</title>
</head>
<body>
<!--headerここから-->
<div class="header">
<div class="summarytext"><p class="m0-t">エスタ・オンライン・センター　ESTA申請代行・日本語で24時間丁寧にサポート</p></div>

<!--menuここから-->
<ul class="menu clearfix">
<li><a href="<?php echo $env_url;?>/"><img src="/assets/esta-o/img/201504/gnavi01.png" alt="ホーム" /></a></li>
<li><a href="<?php echo $env_url;?>/apply/step1.html"><img src="/assets/esta-o/img/201504/gnavi02.png" alt="エスタ申請" /></a></li>
<li><a href="<?php echo $env_url;?>/status/index.html"><img src="/assets/esta-o/img/201504//gnavi03.png" alt="申請内容確認" /></a></li>
<li><a href="<?php echo $env_url;?>/service/index.html"><img src="/assets/esta-o/img/201504/gnavi04.png" alt="サービス内容" /></a></li>
<li><a href="<?php echo $env_url;?>/contact/index.html"><img src="/assets/esta-o/img/201504/gnavi05.png" alt="お問い合わせ" /></a></li>
</ul>
<!--menuここまで--> 
<img src="/assets/esta-o/img/201504/logo.png" alt="ESTA online center" class="logo" />
</div>
<?php if (isset($top) && $top === 'on'):?>
<div class="container-l"><img src="/assets/esta-o/img/201504/kv.jpg" height="134" width="930" alt="Welcome to the Electronic System for Travel Authorization" /></div>
<?php endif;?>
<div class="container-l p20-t"> 

<?php echo $contents;?>

<div class="footer clearfix">
<p class="fl-l">&#169;<?php echo date('Y');?> ESTA Online Center. All Rights Reserved.</p>
<ul>
<!--<li><a href="<?php echo $env_url;?>/contact/index.html">お問合わせ</a></li>-->
<li><a href="<?php echo $env_url;?>/agreement/index.html">利用規約</a></li>
<li><a href="<?php echo $env_url;?>/privacy/index.html">個人情報保護方針</a></li>
<li><a href="<?php echo $env_url;?>/aboutus/index.html">特定商取引法の表記</a></li>
</ul>
</div>
</div>
</body>
</html>
