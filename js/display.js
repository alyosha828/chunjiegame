

		//	define the variables

		var const_width 		= 640,
			const_height		= 1040,
			const_page_count	= 11;
		
		var isStart = false;
		var directionX = 0;
		var isGo = false;
		var directionY = 0;
		var firstY = 0;

		var isGetRandom = false;

		var resultId = 0;

		var nLightTime = 0;
		var firstSize = 40;
		var isLigthAni = false;

		var isFailedProcess = false;

		var animationArray = [];

		var timer = 0;

		//	--------------- for adjusting according to device display size ---------------

		$(document).ready(function(e) {
			
			adjustZoom();
			//document.getElementById('backgroundAudio').play();
			//playSound();
		});

		function adjustZoom(){
			
			var height, width;
			var rateWidth, rateHeight;			
			height = const_height / const_width * window.innerWidth;
			rateWidth = window.innerWidth / const_width;
			rateHeight =  window.innerHeight / const_height;
			
			var temp = 'scale(' + rateWidth + ',' + rateHeight + ')';
			$('#pages').css('transform', temp);
			temp = -const_height * (1 - rateHeight) / 2;
			temp = temp + 'px';
			$('#pages').css('top', temp);
			
		}

		//	--------------- web browser detecting of clients ---------------

		function detectWebBrowser() {
			
			var ua = navigator.userAgent.toLowerCase();
			var check = function(r) { return r.test(ua); };
			var DOC = document;
			var isStrict = DOC.compatMode == "CSS1Compat";
			var isOpera = check(/opera/);
			var isChrome = check(/chrome/);
			var isWebKit = check(/webkit/);
			var isSafari = !isChrome && check(/safari/);
			var isSafari2 = isSafari && check(/applewebkit\/4/); // unique to
			// Safari 2
			var isSafari3 = isSafari && check(/version\/3/);
			var isSafari4 = isSafari && check(/version\/4/);
			var isIE = !isOpera && check(/msie/);
			var isIE7 = isIE && check(/msie 7/);
			var isIE8 = isIE && check(/msie 8/);
			var isIE6 = isIE && !isIE7 && !isIE8;
			var isGecko = !isWebKit && check(/gecko/);
			var isGecko2 = isGecko && check(/rv:1\.8/);
			var isGecko3 = isGecko && check(/rv:1\.9/);
			var isBorderBox = isIE && !isStrict;
			var isWindows = check(/windows|win32/);
			var isMac = check(/macintosh|mac os x/);
			var isAir = check(/adobeair/);
			var isLinux = check(/linux/);
			var isSecure = /^https/i.test(window.location.protocol);
			var isIE7InIE8 = isIE7 && DOC.documentMode == 7;

			var jsType = '', browserType = '', browserVersion = '', osName = ''; /*
			var ua = navigator.userAgent.toLowerCase();
			var check = function(r) { return r.test(ua); };*/

			if (isWindows) {
				
				osName = 'Windows';

				if (check(/windows nt/)) {
					
					var start = ua.indexOf('windows nt');
					var end = ua.indexOf(';', start);
					osName = ua.substring(start, end);
					
				}
				
			} else {
				
				osName = isMac ? 'Mac' : isLinux ? 'Linux' : 'Other';
				
			} 

			if (isIE) {
				
				browserType = 'IE';
				jsType = 'IE';

				var versionStart = ua.indexOf('msie') + 5;
				var versionEnd = ua.indexOf(';', versionStart);
				browserVersion = ua.substring(versionStart, versionEnd);

				jsType = isIE6 ? 'IE6' : isIE7 ? 'IE7' : isIE8 ? 'IE8' : 'IE';
				
			} else if (isGecko) {
				
				var isFF =  check(/firefox/);
				browserType = isFF ? 'Firefox' : 'Others';;
				jsType = isGecko2 ? 'Gecko2' : isGecko3 ? 'Gecko3' : 'Gecko';

				if (isFF) {
					
					var versionStart = ua.indexOf('firefox') + 8;
					var versionEnd = ua.indexOf(' ', versionStart);
					if(versionEnd == -1){ versionEnd = ua.length; }
					browserVersion = ua.substring(versionStart, versionEnd);
					
				}
				
			} else if (isChrome) {
				
				browserType = 'Chrome';
				jsType = isWebKit ? 'Web Kit' : 'Other';

				var versionStart = ua.indexOf('chrome') + 7;
				var versionEnd = ua.indexOf(' ', versionStart);
				browserVersion = ua.substring(versionStart, versionEnd);
				
			} else {
				
				browserType = isOpera ? 'Opera' : isSafari ? 'Safari' : '';
				
			}

			return browserType;
			
		}

		//-------------  main btn event
		$('.btn_start').click(function() {
			//includeHTML();
			document.getElementById('buttonAudio').play();
		});
		

		$('.btn_role').click(function() {
			$('.tk').css('display', 'block');
			$('.tk').css('background-size', '100% 90%');					
			$('.cv').css('display', 'block');

			document.getElementById('buttonAudio').play();
		});

		$('.btn_close').click(function() {
			$('.tk').css('display', 'none');
			$('.cv').css('display', 'none');

			document.getElementById('buttonAudio').play();
			
		});

		$('.btn_close_result').click(function() {
			$('.tk').css('display', 'none');
			$('.cv').css('display', 'none');
			isGetRandom = false;

			document.getElementById("tongs").style.left = window.innerWidth * 0.5 - document.getElementById("tongs").offsetWidth * 0.5 + "px";
			//document.getElementById("tongs_bar").style.left = window.innerWidth * 0.5 + "px";
			document.getElementById("tongs_head").style.left = window.innerWidth * 0.5 - document.getElementById("tongs").offsetWidth * 0.5 - 2 + "px";
			document.getElementById("tongs").style.top = firstY + "px";
			directionX = 0;
			directionY = 0;
			isGo = false;
			isStart = false;
			isGetRandom = false;

			$('#sel_mouse').css('display', 'none');

			document.getElementById('buttonAudio').play();
		});

		$('.btn_result').click(function() {
			$('.tk').css('display', 'none');
			$('.cv').css('display', 'none');
			isGetRandom = false;

			document.getElementById("tongs").style.left = window.innerWidth * 0.5 - document.getElementById("tongs").offsetWidth * 0.5 + "px";
			//document.getElementById("tongs_bar").style.left = window.innerWidth * 0.5 + "px";
			document.getElementById("tongs_head").style.left = window.innerWidth * 0.5 - document.getElementById("tongs").offsetWidth * 0.5 - 2 + "px";
			document.getElementById("tongs").style.top = firstY + "px";
			directionX = 0;
			directionY = 0;
			isGo = false;
			isStart = false;
			isGetRandom = false;

			$('#sel_mouse').css('display', 'none');

			document.getElementById('buttonAudio').play();
		});

		$('.btn_again').click(function() {
			$('.tk').css('display', 'none');
			$('.cv').css('display', 'none');
			$('.again_fail').css('display', 'none');
			
			document.getElementById("tongs").style.left = window.innerWidth * 0.5 - document.getElementById("tongs").offsetWidth * 0.5 + "px";
			//document.getElementById("tongs_bar").style.left = window.innerWidth * 0.5 + "px";
			document.getElementById("tongs_head").style.left = window.innerWidth * 0.5 - document.getElementById("tongs").offsetWidth * 0.5 - 2 + "px";
			document.getElementById("tongs").style.top = firstY + "px";
			directionX = 0;
			directionY = 0;
			isGo = false;
			isStart = false;
			isGetRandom = false;

			document.getElementById('buttonAudio').play();
		});

		$('#btn_go').click(function() {
			console.log("ttttt = ",firstY);

			
			if (isGo){
				return;
			}
			if (!isStart){
				isStart = true;
				isGo = false;
				directionX = 1;
				//$("#total_tongs_hand").css("animation-play-state", "running");
			}
			else{
				isGo = true;
				directionY = 1;
				firstY = document.getElementById("tongs").offsetTop;
			}

			document.getElementById('buttonAudio').play();
			document.getElementById('backgroundAudio').play();

		});
		$('#btn_left').click(function() {
			
			var left = document.getElementById("tongs").offsetLeft
			directionX = -1;
			//document.getElementById("tongs").style.left = left + 1 + "px"
			isStart = true
			//$("#total_tongs_hand").css("animation-play-state", "running");
			document.getElementById('buttonAudio').play();
			document.getElementById('backgroundAudio').play();
		});
		$('#btn_right').click(function() {
			
			var left = document.getElementById("tongs").offsetLeft
			directionX = 1;
			isStart = true
			//$("#total_tongs_hand").css("animation-play-state", "running");
			document.getElementById('buttonAudio').play();
			document.getElementById('backgroundAudio').play();
		});
		var w = window.innerWidth;
		setInterval(updateTime, 25)
		
		function updateTime(){
			if (isStart && !isGo) {
				var left = document.getElementById("tongs").offsetLeft
				document.getElementById("tongs").style.left = left + directionX * 2 + "px"
				//document.getElementById("tongs_bar").style.left = left + directionX * 2 + "px"
				document.getElementById("tongs_head").style.left = left + directionX * 2 - 2 + "px"

				if (left < w * 0.1){
					directionX = 1;
				}
				else if(left > w * 0.78){
					directionX = -1;
				}

			}
			if (isGo){
				var top = document.getElementById("tongs").offsetTop
				document.getElementById("tongs").style.top = top + directionY * 3 + "px"
				var height = document.getElementById("tongs").offsetHeight
				console.log(height);
				
				//document.getElementById("tongs_bar").style.backgroundSize = "10% 100%"
				if (top > document.getElementById("main_up").offsetHeight + document.getElementById("main_middle").offsetHeight * 0.75
					- document.getElementById("tongs").offsetHeight){
					getRandomResult();
					if (resultId == 0){
						directionY = -1;
					}
					else{
						directionY = -1;
					}
				}
				if (top < firstY && isGetRandom){
					document.getElementById("tongs").style.top = firstY + "px"
					isGo = false;
					isStart = false;
					directionY = 0;
					directionX = 0;
					if(resultId == 0){
						isFailedProcess = true;
						emptyFunc();
						console.log("failed!! == ");
						document.getElementById('failedAudio').play();
					}
					else{
						isLigthAni = true;
						showResult();
						document.getElementById('successAudio').play();
						
					}
					$("#total_tongs_hand").css("animation-play-state", "paused");
					$("#total_tongs_hand").css("-webkit-transform", "rotate3d(0, 0, 1, 0deg");
					$("#total_tongs_hand").css("transform", "rotate3d(0, 0, 1, 0deg");
				}
			}

			//if (isLigthAni){
			//	aniLight()
			//}
		}
		function getRandomResult(){
			if (isGetRandom){
				return;
			}


			var randomVal = Math.floor((Math.random() * 10));
			if (randomVal > 6){
				resultId = 0;
			}
			else{
				resultId = Math.floor((Math.random() * 10)) + 1;
			}


			console.log("Card Number = ", resultId);
			//resultId = 1;
			//directionY = 0;
			isGetRandom = true;
			if(resultId != 0){
				$('#sel_mouse').css('background', 'url(css/imgs/mouses/mouse' + resultId + '.png)' + 'no-repeat left center');	
				$('#sel_mouse').css('background-size', '100% 100%');			
				$('#sel_mouse').css('display', 'block');
				$("#total_tongs_hand").css("animation-play-state", "running");
			}
			/*isLigthAni = true;
			isGo = false;
			isStart = false;
			timer = setInterval(showResult, 5);
			directionY = 0;*/
			

		}
		function emptyFunc(){
			console.log("failed!!10 == ");
			isGetRandom = false;
			isStart = false;
			//$('.again_fail').css('display', 'block');
			timer = setInterval(processAnimation, 400);
			//$('.again_fail').css('webkitAnimationName', 'bounceInUp');
			
		}
		function aniLight(){
			nLightTime = nLightTime + 1;
			firstSize = firstSize + 3;
			console.log("aniLight == " + firstSize);
			document.getElementById('img_light').style.width = firstSize + 'px';
			document.getElementById('img_light').style.height = firstSize + 'px';

			if (nLightTime > 150){
				
				document.getElementById('img_light').style.width = firstSize + 'px';
				document.getElementById('img_light').style.height = firstSize + 'px';
				nLightTime = 0;
				firstSize = 40;
				isLigthAni = false;
				
			}
		}
		function showResult(){
			$('.tk').css('background', 'url(css/imgs/result' + resultId + '.png)' + 'no-repeat left center');	
			$('.tk').css('background-size', '100% 100%');			
			$('.tk').css('display', 'block');	

			$('.cv').css('display', 'block');

			

			clearInterval(timer);
		}


		function processAnimation(){
			$('.again_fail').css('display', 'block');
			$('.cv').css('display', 'block');
			clearInterval(timer);
		}
		
		var timerSound = setInterval(playSou, 10);
		function playSou(){
			$('#main_up').click();
			$('#first_back').click();
			clearInterval(timerSound);
		}
		
		$('#main_up').click(function() {
			
			document.getElementById('backgroundAudio').play();
		});
		$('#main_middle').click(function() {
			
			document.getElementById('backgroundAudio').play();
		});
		$('#main_bottom').click(function() {
			
			document.getElementById('backgroundAudio').play();
		});

		$('#first_back').click(function() {
			
			document.getElementById('backgroundAudio').play();
		});

		$('.btn_start').click(function() {
			
			document.getElementById('backgroundAudio').play();
		});

		$('.btn_role').click(function() {
			
			document.getElementById('backgroundAudio').play();
		});
		

		  

	

