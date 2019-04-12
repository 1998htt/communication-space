$('#go').on('click',function(){
    $("#blog_list li").hide().filter($("#blog_list li:contains("+$('#txt_q').val()+")")).show();
})