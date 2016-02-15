var done = [],
    loaded = [];

var defects = true,
    features = true,
    accessories = true,
    credit = true;

$( document ).ready(function() {
    //ДАТАПИКЕР
    $("#doc_create").delegate("#date_of_contract", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD', locale: ru
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




    $('.document').on('change','#defects_yes', function() {

        if(defects == true) $('#defects_block').append('<div id="defects_additional_block" class = "content-input-group">'+
                                                            '<input class="form-control" type="text"  name="defects[]"  placeholder="Дефекты">'+
                                                            '</div>');
        defects=false;
    });


    $('.document').on('change','#features_yes', function() {

        if(features == true) $('#features_block').append('<div id="features_additional_block" class = "content-input-group">'+
                                                              '<input class="form-control" type="text"  name="features[]"  placeholder="Особенности">'+
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
                                                                    '<input class="form-control" type="text"  name="accessories[]"  placeholder="Дополнительные принадлежности:">'+
                                                                    '</div>');
        accessories=false;
    });



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

    $('.document').on('change', '#modal_ready', function () {
        $.post('/ajax/personal_data',function(data){
            $('.document').find("#myModal").html(data);
        });
    });




});







