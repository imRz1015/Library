### HTML自定义属性 ###

2018/1/27 9:43:32 

在HTML中可以通过在标签里面添加自定义属性：

	<div class="box" myAttr="1"></div>

我们可以通过js来获取到:

	var item=document.getElementsByClassName("box")[0].getAttribute("myAttr");
	console.log(item);	//1

HTML5中可以通过专属的方法来获取自定义属性，在HTML上添加自定义属性需要加上前缀data-

js就可以通过dataset来获取到相应的属性值

除此之外，H5的自定义属性还可以用在CSS的after伪类和content的attr中

注意：带有连接符的属性在Js中和CSS中要使用峰驼命名:

	
	<div class="box" data-myAttr="1"  data-animal-type="cat"></div>

	var item=document.getElementsByClassName("box")[0].dataset.myAttr;
	console.log(item);	//1
	var item=document.getElementsByClassName("box")[0].dataset.animalType;
	console.log(item);	//cat
	