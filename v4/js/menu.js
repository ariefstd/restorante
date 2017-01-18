$(document).ready(function(){
    var urlpath = "get_list_menu.php";
    $.ajax({
        type: "POST",
        dataType: "json",
        url: urlpath,
        success: function(result){
            if(!result.empty){
                tr ='<ul class="slides">';
                for (j = 0; j < result.data.length; j++)
                {

                    tr += '<li>';
                    tr += '<img src="'+ result.data[j].menutype_path +'" />';
                    tr += '<a href="menupop.php?cat='+result.data[j].menutype_id+'" class="fancybox" ><div class="information">';
                    tr += '<div class="title">'+result.data[j].name_package+'</div>';
                    tr += '<div class="btn-order">Order Now</div>';
                    tr += '</div></a>';
                    tr += '</li>';
                }
                tr +='</ul>';
                $('.flexslider').append().html(tr);
            }
        }
    });
});
