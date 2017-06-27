var select_class=[];
$(document).ready(function(){
	$(".tr_class").click(function(){select_item(this)});
})

function select_item(ele){
	$(ele).toggleClass("bgSelect");
}
