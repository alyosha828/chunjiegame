<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxa97ecf90b0108f36", "ab9045c6d348b1625746b75d8317601d");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv-"X-UA-Compatible" content="IE=edge" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="msapplication-tap-highlight" content="no" />
		<!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
		<!--<meta name="viewport" content="user-scalable=0, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=160dpi" />-->
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />

		<title>金鼠贺岁娃娃机</title>

		<link rel="stylesheet" type="text/css" href="css/queryLoader.css" />
		<link rel="stylesheet" type="text/css" href="css/play.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/display.css" />
		<link rel="stylesheet" type="text/css" href="css/animation.css" />
		
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
		<link type="text/css" rel='stylesheet' href='css/style.css'/>
		<link type="text/css" rel="stylesheet" href="css/separate.css">
		
	</head>
    <body>
		<div id="pages" class="pages" style="position: fixed;top: 0px;left: 50%;width: 640px;height: 1040px;display: none;">
			<!--第一页-->
			<section class="page z-current" id="page-0" index="0" pageindex="0" animation-in="0" animation-out="0" bg-layout="center" islockpageflip="undefined" style="background: none;background-color: #fff;" >				
				<div id = first_back class="f-abs c-c-container c-singleimage bg" style="position: absolute;
																			top: 0px;
																			left: 0px;
																			width: 640px;
																			height: 1040px;
																			border-color: rgb(204, 204, 204);
																			border-radius: 0px;
																			border-width: 0px;
																			z-index: 2100;
																			background-color: #760b4c;
																			-webkit-animation: a_slide_topIn 0.5s ease-out; 
																			animation-duration: 0.5s; 
																			animation-timing-function: ease-out; 
																			animation-delay: initial; 
																			animation-iteration-count: initial; 
																			animation-direction: initial; 
																			animation-fill-mode: backwards;
																			-webkit-animation-fill-mode: backwards; 
																			-webkit-animation-play-state: initial; 
																			animation-play-state: initial; 
																			animation-name: a_slide_topIn;">
					<img src="css/imgs/main.png" style="border-radius: 0px;display: inline;">
				</div>
				<div class="btn_start btn_ f-abs c-c-container c-singleimage z-hasAnimationIn" style="position: absolute; 
																						display: block; 
																						top: 785px;
																						left: 170px;
																						width: 300px;
																						height: 100px;
																						border-color: rgb(204, 204, 204); 
																						border-radius: 0px; 
																						border-width: 0px;
																						z-index: 2299; 
																						-webkit-animation: fadeInBottom 1s 0.5s; 
																						animation-duration: 1s; 
																						animation-timing-function: linear; 
																						animation-delay: 0.5s; 
																						animation-iteration-count: 1; 
																						animation-direction: initial; 
																						animation-fill-mode: backwards;
																						-webkit-animation-fill-mode: backwards; 
																						-webkit-animation-play-state: initial; 
																						animation-play-state: initial; 
																						animation-name: fadeInBottom;">
																						<a href="main.html" style="position: absolute;width: 100%;height: 100%;"></a>
					
				</div>
				<div class="btn_role btn_ f-abs c-c-container c-singleimage z-hasAnimationIn" style="position: absolute; 
																						display: block; 
																						top: 900px;
																						left: 200px;
																						width: 240px;
																						height: 40px;
																						border-color: rgb(204, 204, 204); 
																						border-radius: 0px; 
																						border-width: 0px;
																						z-index: 2299; 
																						-webkit-animation: fadeInBottom 1s 0.5s; 
																						animation-duration: 1s; 
																						animation-timing-function: linear; 
																						animation-delay: 0.5s; 
																						animation-iteration-count: 1; 
																						animation-direction: initial; 
																						animation-fill-mode: backwards;
																						-webkit-animation-fill-mode: backwards; 
																						-webkit-animation-play-state: initial; 
																						animation-play-state: initial; 
																						animation-name: fadeInBottom;">
					
				</div>
			</section>
			
			
			<!--第八页-->
			<section class="page" id="page-7" index="7" pageindex="7" animation-in="0" animation-out="0" bg-layout="center" islockpageflip="undefined">				
				<div class="f-abs c-c-container c-singleimage bg" style="position: absolute;
																			top: 0px;
																			left: 0px;
																			width: 640px;
																			height: 1040px;
																			border-color: rgb(204, 204, 204);
																			border-radius: 0px;
																			border-width: 0px;
																			z-index: 1;">
					<img src="css/img/common/bg_main.jpg" style="border-radius: 0px;display: inline;">
				</div>
			</section>
			
		</div>

		<div class='cv'></div>
		<div class="tk">
			<div class="btn_close btn_"></div>
		</div>
			
		<audio id="buttonAudio" src="css/music/button.mp3" autostart="True" preload="auto" style="display:block"></audio>
		<audio id="backgroundAudio" src="css/music/back.mp3" autostart="True" preload="auto" loop style="display:block"></audio>
		
		
   
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/queryLoader.js"></script>
		<script type="text/javascript" src="js/cookie.min.js"></script>
		<script>
			QueryLoader.selectorPreload = "body";
			QueryLoader.init();
		</script>

		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/three.min.js"></script>
		<script type="text/javascript" src="js/Projector.js"></script>
		<script type="text/javascript" src="js/CanvasRenderer.js"></script>
		<script type="text/javascript" src="js/stats.min.js"></script>
		<script type="text/javascript" src="js/display.js"></script>
		
		<script type="text/javascript" src="js/playsound.js"></script>
		
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script>
		  /*
		   * 注意：
		   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
		   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
		   * 3. 完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
		   *
		   * 如有问题请通过以下渠道反馈：
		   * 邮箱地址：weixin-open@qq.com
		   * 邮件主题：【微信JS-SDK反馈】具体问题
		   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
		   */
		  wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: <?php echo $signPackage["timestamp"];?>,
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
			  'onMenuShareTimeline', 'onMenuShareAppMessage'
			]
		  });
		  
		  wx.ready(function(res){
			// 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
			wx.onMenuShareTimeline({
				title: 	"金鼠贺岁来抓“福”，福瑞满堂惠添富", 																		// 分享标题
				link:	"http://www.jianyi.ink/h5/chunjiegame/index.php",
				imgUrl: "http://www.jianyi.ink/h5/chunjiegame/css/imgs/logo.png", 		// 分享图标
			});
			// 获取“分享给朋友”按钮点击状态及自定义分享内容接口
			wx.onMenuShareAppMessage({
				title:	"金鼠贺岁来抓“福”，福瑞满堂惠添富",																		// 分享标题
				desc:	'惠添富娃娃机，快来抓“福”呦!',																						// 分享描述
				link:	"http://www.jianyi.ink/h5/chunjiegame/index.php",
				imgUrl: "http://www.jianyi.ink/h5/chunjiegame/css/imgs/logo.png", 			// 分享图标
				type:	"link", 																				// 分享类型,music、video或link，不填默认为link
			});
		});
		</script>

	</body>
</html>

