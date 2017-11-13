# JavaScript中"||"和"&&"的妙用 #

在js中,除了布尔值false以外，还有一些也能够判定为false：

**0、""、null、false、undefined、NaN都会判为false，其他都为true。**

那么通过这样的判定条件，再加上"||"和"&&"，可以写js的奇淫技巧：

**a&&b :如果执行a后返回true，则执行b并返回b的值；如果执行a后返回false，则整个表达式返回a的值，b不执行；**
	
	var a={};
	a.ifshow=1;
    a.ifshow && console.log("我会执行");
	a.hide="";
	a.ifshow && console.log("我不会执行);

**总结：a真返回b,a假返回a。**

**a||b:如果执行a后返回true，则整个表达式返回a的值，b不执行；如果执行a后返回false，则执行b并返回b的值；**
	
	var a={};
	a.ifshow=1;
    a.ifshow && console.log("我不会执行");
	a.hide="";
	a.ifshow && console.log("我会执行);

**总结：a真返回a,a假返回b。**

&& 优先级高于 ||;

其实在大部分语言中都遵循这种“短路原理”，在这种表达式中，总会先判断左边的值。

这个运算经常用来判断一个变量是否已定义，如果没有定义就给他一个初始值

另外!!的作用是把一个其他类型的变量转成的bool类型。

js中||和&&的特性帮我们精简了代码的同时，也带来了代码可读性的降低，所以利弊就需要自己的权衡了。


