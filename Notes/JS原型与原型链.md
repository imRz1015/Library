# JavaScript 原型与原型链
- 原型是一个对象
- 其他对象可以通过它实现属性继承

### prototype和 \_\_proto\_\_ 的区别 ###

prototype是function才有的属性

\_\_proto\_\_是每个对象都有的属性

    var a = {};
    console.log(a.prototype);  //undefined
    console.log(a.__proto__);  //Object {}
    
    var b = function(){}
    console.log(b.prototype);  //b {}
    console.log(b.__proto__);  //function() {}

对象分为两种：**普通对象**和**函数对象**

**普通对象**：


- 最普通对象：有\_\_proto\_\_属性（指向其原型链），没有prototype属性



- 原型对象:(person.prototype 原型对象还有constructor属性（指向构造函数对象）)


**函数对象**：

- 凡是通过new Function()创建的都是函数对象(构造函数)



- 拥有\_\_proto\_\_、prototype属性（指向原型对象）


**通过new出来的对象，会继承原型的所有属性和方法：**
	
    function test(){
    	this.value=40;
    }
	var result=new test();
	console.log(result.value);//40
	//new出来的result对象继承了test的属性
	function foo(){};
	foo.prototype=new test();
	foo.prototype.word="Hello World!";
	console.log(foo.prototype); //value:40,word:"Hello World!"


	test.prototype={
		add:function(a,b){
			return a+b;
		},
		subtract:function(a,b){
			return a-b;		}
	}
	var result2=new test();
	console.log(result.add); //undefined
	console.log(result2.value); //40
	console.log(result2.add); //function(a,b) {return a+b};
	console.log(result2.subtract(3,2)); //1

	//向test添加了两个方法，new出来的result2继承了test的所有属性和方法


**原型链：**

实例化的对象在进行属性查找时，如果没有查找到这个属性或者方法，会逐级向上查找，直到查找到Object的原型上，这一个逐级向上查找的链，就是原型链：

	Object.prototype.bar=1;
	function test2(){
		this.val=10;
	}
	var result3=new test2();
	console.log(result3.val); //10
	console.log(result3.bar); //1
	//result3会依据原型链逐级向上查找存在该属性的原型，直到找到，否则为undefined
