function id(domName){
	return document.getElementById(domName);
}

function cls(clsName){
	return document.getElementsByClassName(clsName);
	//得到class=clsName的所有dom元素，使用某一个时要带下标
	//dom树中只有一个该类名的node时，获取方法为cls(clsName)[0]
}

function clickEffect(element,newColor,oldColor) {
	//点击高亮，去除兄弟元素的被点击样式
	//调用时element传this可以直接绑定被点击的dom
	var sib=siblingElems(element);
	element.style.cssText="background-color:"+newColor+";";
	sib.forEach(function(value){
		value.style.cssText="background-color:"+oldColor+";";
		}
	)
}

function siblingElems(elem){
	//获取某个dom的兄弟元素集合，等同于jq的node.sibling()
        var nodes=[ ];
        var _elem=elem;
       while((elem=elem.previousSibling)){
              if(elem.nodeType==1){
                     nodes.push(elem);
              }
       }
       var elem=_elem;
      while((elem=elem.nextSibling)){
              if(elem.nodeType==1){
                     nodes.push(elem);
              }
       }
       return nodes;
}