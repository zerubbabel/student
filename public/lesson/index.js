var current=null;
$(document).ready(function(){
	problem_init();
	current=0;
	show_problem(current);
})

function problem_init(){
	$('.question').hide();
}
function show_problem(i){
	$($('.question')[i]).show();
	$('#p_id').val(i);
}
function hide_problem(i){
	$($('.question')[i]).hide();
}

function next_problem(){
	var i=current;
	hide_problem(i);
	show_problem(parseInt(i)+1);
	current+=1;
}