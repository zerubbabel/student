var select_class=[];
$(document).ready(function(){
	$(".tr_class").click(function(){select_item(this)});
})

function select_item(ele){
	$(ele).toggleClass("bgSelect");
	var box=$(ele)[0].children[0].children[0]
	var f=box.checked;
	box.checked=!f;
}

function selectAll(ele){
	var f=$(ele)[0].checked;
	$("tbody input").each(function(){
		this.checked=f;	
	});

}