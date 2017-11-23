# 关于this指向简单粗暴理解 #

通过构造函数new出来的对象，this指向new出来的对象：

	function Fn(obj){
		this.name=obj.name;
		this.do=function(){
			console.log(this.name);		
		}
	}
	
	var func=new Fn({
		el:"div"
	})

	//此时this指向func

通过"."调用的方法，this指向"."之前的对象

	func.do() //do这个方法里的this指向func；

如果都不是以上两种情况，那么this就指向window。

	