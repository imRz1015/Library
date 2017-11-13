# JavaScript原生方法、属性 #

--------------------------

## Object： ##

### 一、属性 ###

Object自带一个prototype的属性，即Object.prototype，Object.prototype本身也是一个对象，也会有一些属性和方法。如下： 

1、属性
 
Object.prototype.writable：默认为false 

Object.prototype.enumerable：默认为false 

Object.prototype.configurable：默认为false 

Object.prototype.constructor：用于创建一个对象的原型。 

  	Object.defineProperty(person,'name',{
		configurable:false,能否使用delete、能否需改属性特性、或能否修改访问器属性、，false为不可重新定义，默认值为true
		enumerable:false,//对象属性是否可通过for-in循环，flase为不可循环，默认值为true
		writable:false,//对象属性是否可修改,flase为不可修改，默认值为true
		value:'xiaoming' //对象属性的默认值，默认值为undefined
	});

2.常用方法

Object.prototype.hasOwnProperty()

返回一个布尔值，表示某个对象是否含有指定的属性，而且此属性非原型链继承。

Object.prototype.isPrototypeOf()

返回一个布尔值，表示指定的对象是否在本对象的原型链中。

Object.prototype.propertyIsEnumerable()

判断指定属性是否可枚举

Object.prototype.toString()

返回对象的字符串表示

Object.prototype.watch()

给对象的某个属性增加监听

Object.prototype.unwatch()

移除对象某个属性的监听

Object.prototype.valueOf()

返回指定对象的原始值

### 二、方法 ###

Object.assign(target, …sources)

把任意多个的源对象自身的可枚举属性拷贝给目标对象，然后返回目标对象


Object.create(proto,[propertiesobject])

创建一个拥有指定原型和若干个指定属性的对象

Object.defineProperties(obj, props)

在一个对象上添加或修改一个或者多个自有属性，并返回该对象

Object.defineProperty(obj, prop, descriptor)

直接在一个对象上定义一个新属性，或者修改一个已经存在的属性， 并返回这个对象。obj：需要定义属性的对象。prop：需定义或修改的属性的名字。descriptor：将被定义或修改的属性的描述符。

Object.entries(obj)

返回一个包含由给定对象所有可枚举属性的属性名和属性值组成的 [属性名，属性值] 键值对的数组，数组中键值对的排列顺序和使用for…in循环遍历该对象时返回的顺序一致。 

举例： 
    
    var obj = { foo: “bar”, baz: 42 }; 
    console.log(Object.entries(obj)); // [ [‘foo’, ‘bar’], [‘baz’, 42] ]

Object.freeze(obj)

冻结一个对象，冻结指的是不能向这个对象添加新的属性，不能修改其已有属性的值，不能删除已有属性，以及不能修改该对象已有属性的可枚举性、可配置性、可写性。也就是说，这个对象永远是不可变的。该方法返回被冻结的对象

Object.getOwnPropertyDescriptor(obj, prop)

返回指定对象上一个自有属性对应的属性描述符

Object.getOwnPropertyNames(obj)

返回一个由指定对象的所有自身属性的属性名（包括不可枚举属性）组成的数组

举例：
    
    // 类数组对象 
    var obj = { 0: “a”, 1: “b”, 2: “c”}; 
    console.log(Object.getOwnPropertyNames(obj).sort()); // [“0”, “1”, “2”]

Object.getPrototypeOf(object)

返回该对象的原型

Object.is(value1, value2)

判断两个值是否是同一个值

Object.isExtensible(obj)

判断一个对象是否是可扩展的（是否可以在它上面添加新的属性）

Object.isFrozen(obj)

判断一个对象是否被冻结（frozen）

Object.isSealed(obj)

判断一个对象是否是密封的（sealed）。密封对象是指那些不可 扩展 的，且所有自身属性都不可配置的（non-configurable）且属性不可删除的对象（其可以是可写的）

Object.keys(obj)

返回一个由给定对象的所有可枚举自身属性的属性名组成的数组，数组中属性名的排列顺序和使用for-in循环遍历该对象时返回的顺序一致 

举例：
 
    var arr = [“a”, “b”, “c”]; 
    alert(Object.keys(arr)); // 弹出”0,1,2”
    
    // 类数组对象 
    var obj = { 0 : “a”, 1 : “b”, 2 : “c”}; 
    alert(Object.keys(obj)); // 弹出”0,1,2”

Object.preventExtensions(obj)

让一个对象变的不可扩展，也就是永远不能再添加新的属性

Object.setPrototypeOf(obj, prototype)

将一个指定的对象的原型设置为另一个对象或者null

Object.values(obj)

返回一个包含指定对象所有的可枚举属性值的数组，数组中的值顺序和使用for…in循环遍历的顺序一样

举例： 

    var obj = { foo: “bar”, baz: 42 }; 
    console.log(Object.values(obj)); // [‘bar’, 42]
    


