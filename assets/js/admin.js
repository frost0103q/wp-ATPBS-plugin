( function( $ ) {
    console.log("Auto Publish Script Works !");
    $(document).ready(function (){
        $(".j-select2").select2({
          allowClear:true,                    
          width: '100%' ,
          placeholder: 'Search for a base page'
        });
    })
    $(document).on('select2:unselecting', '#base_page_select', function(e){
        $(".j-apply-btn").attr("disabled",'true');
        $(".j-test-btn").attr("disabled",'true');
    })
    $(document).on('click', '#j-apply-btn', function(e){
        $(".base_page_wrap .j-update-result-msg").addClass("j-hide");
        var basepage_id = $("#base_page_select").val();
        var data = {
            action                              : 'apply_base_page_id',
            basepage_id                         : basepage_id,
        };
        $.ajax({
            type: 'post',
            url: atpbs_js_obj.ajax_url,
            data: data ,
            success: function (response) {
                console.log(response);
                if (response.error) {
                    $(".base_page_wrap .j-update-failed").removeClass("j-hide");
                } else {
                    $(".base_page_wrap .j-update-success").removeClass("j-hide");
                    setTimeout(() => {
                        $(".base_page_wrap .j-update-result-msg").addClass("j-hide");
                    }, 7000);
                }
            },
        });
    })
    $(document).on('click', '#j-test-btn', function(e){
        $(".base_page_wrap .j-update-result-msg").addClass("j-hide");
        var basepage_id = $("#base_page_select").val();
        var data = {
            action  : 'create_test_page'
        };
        $.ajax({
            type: 'post',
            url: atpbs_js_obj.ajax_url,
            data: data ,
            success: function (response) {
                if (response.error) {
                    console.log(response);
                } else {
                    $(".base_page_wrap .j-create-success").removeClass("j-hide");
                    if (response.result){
                        $(".base_page_wrap .j-create-success").html(response.result_msg);
                    }else{
                        $(".base_page_wrap .j-create-success").html(response.error_msg);
                    }
                    setTimeout(() => {
                        $(".base_page_wrap .j-update-result-msg").addClass("j-hide");
                    }, 60000);
                }
            },
        });
    })
    $(document).on('select2:select', '#base_page_select', function(e){
        var basepage_id = $(this).val();
        if (basepage_id > 0){
            $(".j-apply-btn").removeAttr("disabled");
            $(".j-test-btn").removeAttr("disabled");

        }else{
            $(".j-apply-btn").attr("disabled",'true');
            $(".j-test-btn").attr("disabled",'true');
        }
    });
} ( jQuery ));
