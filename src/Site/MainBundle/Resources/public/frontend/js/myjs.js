$(function(){



	/*$(".menu1 img").mousemove(function(){
		$(".menu1 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/portH.png");
	});	*/





// Фикмированная шапка при скролле
$("#header").removeClass("default");
$(window).scroll(function(){
	if ($(this).scrollTop() > 20) {
		$("#header").addClass("default").fadeIn('fast');
	} else {
		$("#header").removeClass("default").fadeIn('fast');
	};
});

			// Плавный скролл по якорям
			$('a[href^="#"]').click(function () { 
				elementClick = $(this).attr("href");
				destination = $(elementClick).offset().top;
				if($.browser.safari){
					$('body').animate( { scrollTop: destination }, 9000 );
				} else {
					$('html').animate( { scrollTop: destination }, 9000 );
				}
				return false;
			});



			$(".hover-top .menu1").mousemove(function(){
				$(".hover-top .menu1 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/portH.png");
				$(".hover-top .menu1 a").css("color","#0089d1");
			});

			$(".hover-top .menu1 ").mouseout(function(){
				$(".hover-top .menu1 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/port.png");
				$(".hover-top .menu1 a").css("color","#ccc");
			});

			$(".hover-top .menu2").mousemove(function(){
				$(".hover-top .menu2 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/locationH.png");
				$(".hover-top .menu2 a").css("color","#0089d1");
			});
			$(".hover-top .menu2").mouseout(function(){
				$(".hover-top .menu2 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/location.png");
				$(".hover-top .menu2 a").css("color","#ccc");
			});	

			$(".hover-top .menu3").mousemove(function(){
				$(".hover-top .menu3 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/programmH.png");
				$(".hover-top .menu3 a").css("color","#0089d1");
			});
			$(".hover-top .menu3 ").mouseout(function(){
				$(".hover-top .menu3 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/programm.png");
				$(".hover-top .menu3 a").css("color","#ccc");
			});

			$(".hover-top .menu4").mousemove(function(){
				$(".hover-top .menu4 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/bukletH.png");
				$(".hover-top .menu4 a").css("color","#0089d1");
			});
			$(".hover-top .menu4 ").mouseout(function(){
				$(".hover-top .menu4 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/buklet.png");
				$(".hover-top .menu4 a").css("color","#ccc");
			});
			/**/
			$(".right-sidebar .menu1").mousemove(function(){
				$(".right-sidebar .menu1 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/portH.png");
				$(".right-sidebar .menu1 a").css("color","#0089d1");
			});

			$(".right-sidebar .menu1 ").mouseout(function(){
				$(".right-sidebar .menu1 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/port.png");
				$(".right-sidebar .menu1 a").css("color","#ccc");
			});

			$(".right-sidebar .menu2").mousemove(function(){
				$(".right-sidebar .menu2 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/locationH.png");
				$(".right-sidebar .menu2 a").css("color","#0089d1");
			});
			$(".right-sidebar .menu2").mouseout(function(){
				$(".right-sidebar .menu2 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/location.png");
				$(".right-sidebar .menu2 a").css("color","#ccc");
			});	

			$(".right-sidebar .menu3").mousemove(function(){
				$(".right-sidebar .menu3 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/programmH.png");
				$(".right-sidebar .menu3 a").css("color","#0089d1");
			});
			$(".right-sidebar .menu3 ").mouseout(function(){
				$(".right-sidebar .menu3 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/programm.png");
				$(".right-sidebar .menu3 a").css("color","#ccc");
			});

			$(".right-sidebar .menu4").mousemove(function(){
				$(".right-sidebar .menu4 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/bukletH.png");
				$(".right-sidebar .menu4 a").css("color","#0089d1");
			});
			$(".right-sidebar .menu4 ").mouseout(function(){
				$(".right-sidebar .menu4 img").removeAttr("src").attr("src","/bundles/sitemain/frontend/img/buklet.png");
				$(".right-sidebar .menu4 a").css("color","#ccc");
			});






});//exit function