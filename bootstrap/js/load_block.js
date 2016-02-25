var done = [],
    loaded = [];

var defects = true,
    features = true,
    accessories = true,
    credit = true,
    police = true;

var vendor_state,
    buyer_state;


$( document ).ready(function() {

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
    $("#doc_create").delegate("#date_of_contract", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: 'ru'
        });
    });
    $("#doc_create").delegate("#vendor_birthday", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    $("#doc_create").delegate("#vendor_passport_date", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    $("#doc_create").delegate("#buyer_birthday", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    $("#doc_create").delegate("#buyer_passport_date", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    $("#doc_create").delegate("#date_of_product", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    $("#doc_create").delegate("#date_of_serial_car", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    $("#doc_create").delegate("#maintenance_date", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    $("#doc_create").delegate("#spouse_birthday", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    $("#doc_create").delegate("#marriage_svid_date", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
        });
    });
    //ДАТАПИКЕР


    //BLOCK FUNCTION
   $('.document').on('change','.ajax-button', function(){

       var func_name = $(this).attr('data-name');
       var state_name = $(this).attr('name');


       if(state_name == 'type_of_recipient') buyer_state = $(this).val();
       if(state_name == 'type_of_giver') vendor_state = $(this).val();

       if(state_name == 'buyer_is_owner_car')
       {
           $.ajax({
                    method:"GET",
                    url: '/blocks/'+func_name,
                    dataType: "html",
                    data:{buyer_state:buyer_state},
                    success: function (data, textStatus) {
                                                            $('.document').append(data);

                    }
           });
           return false;
       }
       if(state_name == 'vendor_is_owner_car')
       {
           $.ajax({
                   method:"GET",
                   url: '/blocks/'+func_name,
                   dataType: "html",
                   data:{vendor_state:vendor_state},
                   success: function (data, textStatus) {
                                                            $('.document').append(data);
                   }
           });
           return false;

       }

       $(".document").find('.row').slice( $(this).parents("div[class=row]").index()+1).remove();
       console.log($(this).parents("div[class=row]").index());

       $.ajax({
           url: '/blocks/'+func_name,
           dataType: "html",
           success: function (data, textStatus) {
               $('.document').append(data);

           }
       });

   });
    //BLOCK MODAL FUNCTION
    $('.document').on('change','.modal-button', function() {

        if($(this).attr('data-type')=='final')
            $('.document').find('.modal-body-statement').empty();

        $('.document').find('.modal-body-' + $(this).attr('data-type')).load('/blocks/' + $(this).attr('data-name'));

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


    $('.document').on('change','#features_yes', function() {

        if(features == true) $('#features_block').append('<div id="features_additional_block" class = "content-input-group">'+
                                                              '<input class="form-control" type="text"  name="features"  placeholder="Особенности">'+
                                                              '</div>');
        features=false;
    });

    $('.document').on('change','#block_payment_date', function() {

        if(credit == true) $('#payment_date').append('<div class = "content-input-group">'+
                                                     '<input class="form-control" type="text"  name="credit_value[]"  placeholder="Сумма:">'+
                                                                '</div>');
        credit=false;
    });
    $('.document').on('change','#block_accessories_other', function() {

        if(accessories == true) $('#block_accessories').append('<div class = "content-input-group">'+
                                                                    '<input class="form-control" type="text"  name="accessories"  placeholder="Дополнительные принадлежности:">'+
                                                                    '</div>');
        accessories=false;
    });

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
        canvas_render();
    });




});







