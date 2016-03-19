var done = [],
    loaded = [];

var defects = true,
    features = true,
    accessories = true,
    credit = true,
    police = true;

var vendor_state,
    buyer_state,
    type_of_contract;

var link;
var data_state = new Object();


$( document ).ready(function() {

    $('#editForm').on('change','.edit-ajax-button', function(e){

        var name = $(this).attr('data-name');
        var index = $('#editForm').find("#"+$(this).attr('data-id')).index()+1;
        var b = $('#editForm').find("#"+$(this).attr('data-id')).parent('div');

        if(name!='bs_block_additional_devices_yes'&&name!='bs_block_additional_devices_no')
            b.find('.row').slice(index).remove();
        else
            name = "bs_block_additional_devices_list";

        var id = $('input[name=doc_id]').val();
        var data = [];

        if(name=='gift_block_vendor_selected_not_owner')
            data = {type:'true'};
        if(name==('gift_block_vendor_selected_owner')||name==('gift_block_vendor_selected_not_owner')){
            switch ($('#editForm').find('input[name=type_of_giver]:checked').val()) {
                case 'physical': name = 'gift_block_vendor_info'; break;
                case 'law': name = 'gift_block_vendor_law_state'; break;
                case 'individual': name = 'gift_block_vendor_individual_state'; break;
            }
            $.get('/ajax/getBlock/'+name+'/'+id+'/true',data,function(block){
                b.append(block);
            });
            e.preventDefault();
            return false;
        }

        if(name=='gift_block_buyer_selected_not_owner')
            data = {type:'true'};
        if(name==('gift_block_buyer_selected_owner')||name==('gift_block_buyer_selected_not_owner')){
            switch ($('#editForm').find('input[name=type_of_taker]:checked').val()) {
                case 'physical': name = 'gift_block_buyer_info'; break;
                case 'law': name = 'gift_block_buyer_law_state'; break;
                case 'individual': name = 'gift_block_buyer_individual_state'; break;
            }
            $.get('/ajax/getBlock/'+name+'/'+id+'/true',data,function(block){
                b.append(block);
            });
            e.preventDefault();
            return false;
        }

        if(name=='bs_block_vendor_selected_not_owner')
            data = {type:'true'};
        if(name==('bs_block_vendor_selected_owner')||name==('bs_block_vendor_selected_not_owner'))
            switch ($('#editForm').find('input[name=type_of_giver]:checked').val()) {
                case 'physical': name = 'bs_block_vendor_info'; break;
                case 'law': name = 'bs_block_vendor_law_state'; break;
                case 'individual': name = 'bs_block_vendor_individual_state'; break;
            }

        if(name=='bs_block_buyer_selected_not_owner')
            data = {type:'true'};
        if(name==('bs_block_buyer_selected_owner')||name==('bs_block_buyer_selected_not_owner'))
            switch ($('#editForm').find('input[name=type_of_taker]:checked').val()) {
                case 'physical': name = 'bs_block_buyer_info'; break;
                case 'law': name = 'bs_block_buyer_law_state'; break;
                case 'individual': name = 'bs_block_buyer_individual_state'; break;
            }

        if(name=='bs_block_additional_devices_list'){
            $('#block_additional_devices_list').remove();
            console.log(name);
            if($(this).attr('data-name')=="bs_block_additional_devices_yes")
                $.get('/ajax/getBlock/'+name+'/'+id+'/true',data,function(block){
                    $('#block_additional_devices').after(block);
                });
        }else{
            $.get('/ajax/getBlock/'+name+'/'+id+'/true',data,function(block){
                b.append(block);
            });
        }
        e.preventDefault();
        return false;
    });

    $('.document').on('change', 'input[name="additional_devices_array[]"]', function(e){
        if($(this).prop('checked')==false)
            return false;
        var name = $(this).attr('data-name');
        $('.document').find('input[data-name='+name+']').each(function(){
           $(this).prop('checked',false);
        });
        $(this).prop('checked',true);
    });

    $('.document').on('change','#pact',function(e){
        documunt_type = $(this).attr('data-name');
        if($(this).prop('checked')){
            $('#consent').modal('show');
            $(".document").find('#pact').prop('checked', false);
        }else{
            $(".document").find('#pact').prop('checked', false);
            console.log('2');
            $(".document").find('.row').slice( $(this).parents("div[class=row]").index()+1).remove();
        }
        e.preventDefault();
        return false;
    });

    $('#yes_consent').click(function(e){
        $('#consent').modal('hide');
        $('.document').find('#pact').addClass('ajax-button');
        $('.document').find('#pact').trigger('change');
        $('.document').find('#pact').removeClass('ajax-button');
        $(".document").find('#pact').prop('checked', true);
        e.preventDefault();
        return false;
    });

    //ДАТАПИКЕР

    $("#editForm").delegate(".datetimepicker", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: 'ru'
        });
    });
    $("#doc_create").delegate(".datetimepicker", "focusin", function(){
        var name = $(this).attr('name');
        $('input[name='+name+']').datetimepicker({
            format: 'YYYY-MM-DD', locale: 'ru'
        });
    });


    //ДАТАПИКЕР

    $('.document').on('change','.agent',function(){

        $(".document").find('.row').slice( $('.agent').parents("div[class=row]").index()+1).remove();

    });

    //BLOCK FUNCTION
   $('.document').on('change','.ajax-button', function(){
       $('.document').append('<div class="row"><center><img src="/images/default.gif" width="20px"></center></div>');
       var func_name = $(this).attr('data-name');
       var state_name = $(this).attr('name');
       var height = $('.document').height();
       if(state_name == 'type_of_taker') data_state.buyer_state = $(this).val();
       if(state_name == 'type_of_giver') data_state.vendor_state = $(this).val();
       if(state_name == 'type_of_contract') data_state.type_of_contract = $(this).val();

       if(data_state.type_of_contract == 'buy_sell') link = "/document/data_for_canvas_buysale";
       else link = "/document/data_for_canvas_gift";

       var index = $(this).parents("div[class=row]").index()+1;
       //$(".document").children('div[class=row]').slice( index ).remove();

       $.ajax({
           url: '/blocks/'+func_name,
           dataType: "html",
           data: data_state,
           success: function (data, textStatus) {
               $(".document").children('div[class=row]').slice( index ).remove();
               $('.document').append(data);

               $("html, body").animate({ scrollTop: height }, 600);

           }
       });


   });
    //BLOCK MODAL FUNCTION
    $('.document').on('change','.modal-button', function() {
        var buyer = $('input[data-name=bs_block_buyer_selected_not_owner]:checked').val();
        if(buyer=='not_own_car')
            buyer='true';
        else
            buyer='false';
        if($(this).attr('data-type')=='final')
            $('.document').find('.modal-body-statement').empty();

        $('.document').find('.modal-body-' + $(this).attr('data-type')).load('/blocks/' + $(this).attr('data-name')+'?buyer='+buyer);

    });

    //BLOCK MODAL FUNCTION
    $('.modal-dialog').on('change','.ajax-button', function(e) {

        var func_name = $(this).attr('data-name');

        $.ajax({
            url: '/blocks/' + func_name,
            dataType: "html",
            success: function (data, textStatus) {
                $('.modal-dialog').append(data);
            }
        });
        return false;
        e.preventDefault();
    });



    $('.document').on('change','#defects_yes', function() {

        if(defects == true) $('#defects_block').append('<div id="defects_additional_block" class = "content-input-group">'+
                                                            '<input class="form-control" type="text"  name="defects"  placeholder="Дефекты">'+
                                                            '</div>');
        defects=false;
    });
    $('.document').on('change','#defects_no', function() {

        if(defects == false) $('#defects_additional_block').remove();
        defects=true;
    });
    $('.document').on('change','#features_yes', function() {

        if(features == true) $('#features_block').append('<div id="features_additional_block" class = "content-input-group">'+
                                                              '<input class="form-control" type="text"  name="features"  placeholder="Особенности">'+
                                                              '</div>');
        features=false;
    });
    $('.document').on('change','#features_no', function() {

        if(features == false) $('#features_additional_block').remove();
        features=true;
    });

    $('.document').on('change','#credit', function() {

        if(credit == true) $('#block_payment_date').append('<div class = "content-input-group">'+
                                                     '<input class="form-control" type="text"  name="credit_value[]"  placeholder="Сумма:">'+
                                                                '</div>');
        credit=false;
    });

    $('.document').on('change','#accessories_other', function() {

        if(accessories == true) $('#block_accessories').append('<div class = "content-input-group">'+
                                                                    '<input class="form-control" type="text"  name="accessories[]"  placeholder="Дополнительные принадлежности:">'+
                                                                    '</div>');
        accessories=false;
    });
    /*
    $('.document').on('change','#bs_block_car_in_marriage_yes', function() {

        $('#block_car_in_marriage').remove();

    });*/
    //render




    /*$('.document').on('click', '#ready-button', function () {
        $('#create-doc').trigger("submit");
    });*/

    $('.document').on('click', '#modal_pay', function () {
        $.post('/ajax/modal_pay',function(data){
           $('.document').find("#myModal").html(data);
        });
    });

    $('.document').on('change', '.personal', function () {
        $.post('/ajax/personal_data',function(data){
            $('.document').find("#myPersonal").html(data);
        });
    });

    $('.document').on('click', '#final_button', function () {
        $('#document_form').submit();
    });

    $('.document').on('change','input', function(){
        canvas_render(link);
    });


    $('#editForm a').click(function(){
        var type = $(this).attr('data-type');
        var load = $(this).attr('data-load');
        var id = $('input[name=doc_id]').val();
        if(load == 'false'){
            $(this).attr('data-load','true');
            $('#'+$(this).attr('aria-controls')+' div').html('<div style="background:url(/images/default.gif) no-repeat center center;width:32px;height:32px;"></div>');
            $('#'+$(this).attr('aria-controls')+' div').load('/ajax/getBlock/'+type+'/'+id);
        }
    });

});







