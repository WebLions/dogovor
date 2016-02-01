var credit_true=true,
    accessories_true= true,
    defects_true= true,
    features_true= true;

var can_delete = false;
var done = [],
    loaded = [];

$( document ).ready(function() {
    //ДАТАПИКЕР
    $("#doc_create").delegate("#date_of_contract", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#vendor_birthday", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#vendor_passport_date", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#buyer_birthday", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#buyer_passport_date", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#date_of_product", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#date_of_serial_car", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#maintenance_date", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#spouse_birthday", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $("#doc_create").delegate("#marriage_svid_date", "focusin", function(){
        $(this).datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    //ДАТАПИКЕР


    //BLOCK FUNCTION
   $('.document').on('change','.ajax-button', function(){

        var func_name = $(this).attr('data-name');

       $( ".document").find(".row" ).slice( $(this).parents("div[class=row]").index()+1 ).remove();

       $.ajax({
           url: '/blocks/'+func_name,
           dataType: "html",
           success: function (data, textStatus) {
               $('.document').append(data);

           }
       });
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
    $('.document').on('change','#credit', function() {

        if(credit_true == true) $('#block_payment_date').append('<div class = "content-input-group">'+
                                                                '<input class="form-control" type="text"  name="credit_value[]"  placeholder="Сумма:">'+
                                                                '</div>');
        credit_true=false;
    });
    $('.document').on('change','#accessories_other', function() {

        if(accessories_true == true) $('#block_accessories').append('<div class = "content-input-group">'+
                                                                    '<input class="form-control" type="text"  name="accessories[]"  placeholder="Дополнительные принадлежности:">'+
                                                                    '</div>');
        accessories_true=false;
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







