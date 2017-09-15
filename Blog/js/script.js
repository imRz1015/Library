	$(function() {
	    // console.log($("td div"));
	    // HEADER部分根据高度自适应变色
	    var b = "#ffffff";
	    var isHeader = $("#header");
	    var isWords = $(".headerLeft,.h-li")
	    var time;

	    time = setInterval(function() {
	        if (document.body.scrollTop >= 580) {
	            flashBar(true);
	        } else {
	            flashBar(false);
	        }
	    }, 10);

	    function flashBar(flag) {
	        if (flag) {
	            isHeader.css({
	                "background-color": b,
	                "transition": "background-color 0.5s linear"
	            });
	            $(".headerLeft,.h-li").css({
	                'color': '#000000',
	                'transition': 'color 0.5s linear'
	            });
	        } else {
	            isHeader.css({
	                "background-color": "transparent",
	                "transition": "background-color 0.5s linear"
	            });
	            $(".headerLeft,.h-li").css({
	                'color': '#ffffff',
	                'transition': 'color 0.5s linear'
	            });
	        }
	    }

	    isHeader.mouseover(function() {
	        clearInterval(time);
	        flashBar(true);
	    });
	    isHeader.mouseout(function() {
	        time = setInterval(function() {
	            if (document.body.scrollTop >= 580) {
	                flashBar(true);
	            } else {
	                flashBar(false);
	            }
	        }, 10);
	    });
	    // 文字的浮动效果
	    var slideClear = setInterval(function() {
	        if (document.body.scrollTop >= 200) {
	            $(".skillsIntro").css({
	                "transform": "translateY(0)",
	                "opacity": "1",
	                "transition": "all 0.4s linear"
	            });
	            setTimeout(function() {
	                $(".skillsIntro2").css({
	                    "transform": "translateY(0)",
	                    "opacity": "1",
	                    "transition": "all 0.4s linear"
	                });
	            }, 500);

	            setTimeout(function() {
	                $(".firstRow div").each(function(index) {
	                    $(this).css({
	                        "transform": "translateY(0)",
	                        "opacity": "1",
	                        "transition": "all " + (index + 1.5) * 0.2 + "s linear"
	                    });
	                });
	                // $(".secondRow div").each
	                // setTimeout(function(){
	                for (var i = 3; i >= 0; i--) {
	                    // console.log($(".secondRow div")[i]);
	                    $(".secondRow div")[i].style.cssText = "transform:translateY(0);opacity:1;transition:all " + (1.6 - i * 0.1) + "s linear;"
	                };
	                // },1000); 
	            }, 900);
	            clearInterval(slideClear);
	        }
	    }, 10);

	    // 渐变效果
	    function thisFlash(clsName) {
	        $('.' + clsName).animate({
	            opacity: "1"
	        }, 500);
	    }
	    // thisFlash("codePic");

	    var showCode = setInterval(function() {
	        if (document.body.scrollTop >= 900) {
	            thisFlash("codePic");
	            setTimeout(function() {
	                thisFlash("jobTitle");
	                setTimeout(function() {
	                    thisFlash("codeWords");
	                }, 500);
	            }, 500);
	            clearInterval(showCode);
	        }
	    }, 50);

	    var showLifeStyle = setInterval(function() {
	        if (document.body.scrollTop >= 1250) {
	            $(".isPicTitle").css({
	                "transform": "translateX(0px)",
	                "opacity": "1",
	                "transition": "all 1s linear"
	            });
	            setTimeout(function() {
	                $(".workMore").css({
	                    "transform": "translateY(0px)",
	                    "opacity": "1",
	                    "transition": "all 1s linear"
	                });
	                setTimeout(function() {
	                    $(".threePic li div").each(function(index) {
	                        // console.log($(this).index);
	                        // console.log($(this));
	                        $(this).css({
	                            "transform": "translateY(0px)",
	                            "opacity": "1",
	                            "transition": "all " + index * 0.3 + "s linear"
	                        });
	                    });
	                }, 500);
	            }, 800);

	            clearInterval(showLifeStyle);
	        }
	    }, 50);

	    var playMusic = setInterval(function() {
	        if (document.body.scrollTop >= 1900) {
	            thisFlash("musicTitle");
	            setTimeout(function() {
	                $(".musicPart,.musicPart2").css({
	                    "transform": "translateX(0)",
	                    "opacity": '1',
	                    "transition": "all 1s linear"
	                });
	            }, 800);
	            clearInterval(playMusic);
	        }
	    }, 50);

	    $(".picLi div div").each(function() {
	        // console.log($(this));
	        $(this).mouseover(function() {
	            /* Act on the event */
	            // console.log($(this));
	            $(this).css({
	                "opacity": "0.8",
	                "background-color": "#ffffff",
	                "box-shadow": "0px 0px 15px 10px #d0d0d0",
	                "transition": "all 0.3s linear"
	            });
	        });
	        $(this).mouseout(function() {
	            /* Act on the event */
	            // console.log($(this));
	            $(this).css({
	                "opacity": "0",
	                "background-color": "transparent",
	                "transition": "all 0.5s linear"
	            });
	        });
	    })

	});
