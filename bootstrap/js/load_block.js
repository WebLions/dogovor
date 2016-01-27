var bs_deal = true,
    mods_yes= true,
    mods_no = true,
    wife_no = true,
    wife_yes= true,
    defects_true= true,
    features_true= true;
    reg_ts  = true;

$( document ).ready(function() {
    $("#doc_create").delegate("#date_of_contract", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $('#bs_deal').change(function(){
         string = "/blocks/load/blocks";
        if(bs_deal == true)
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);

                }
            });
        bs_deal = false;
        });



    $('.document').on('change','#defects_yes', function() {

        if(defects_true == true) $('#defects_block').append('<div class = "content-input-group">'+
                                                            '<input class="form-control" type="text"  name="defects[]"  placeholder="Дефекты">'+
                                                            '</div>');
        defects_true=false;
    });
    $('.document').on('change','#features_yes', function() {

        if(features_true == true) $('#features_block').append('<div class = "content-input-group">'+
                                                              '<input class="form-control" type="text"  name="features[]"  placeholder="Особенности">'+
                                                              '</div>');
        features_true=false;
    });

    $('.document').on('click', '#ready-button', function () {
        $('#create-doc').trigger("submit");
    });

    $('.document').on('click', '#modal_pay', function () {
        $.post('/ajax/modal_pay',function(data){
           $('.document').find("#myModal").html(data);
        });
    });

});







