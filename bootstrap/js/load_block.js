/**
 * Created by Swarge on 12/29/2015.
 */
var bs_deal_1 = new Array(   'data_city',
                        'seller',
                        'seller_info',
                        'buyer',
                        'buyer_info',
                        'car_info',
                        'car_info_pts',
                        'car_coast',
                        'mods');


var mods = new Array(    'mods_info',
                        'car_state',
                        'last_ts',
                        'damage',
                        'special_info',
                        'payment_date',
                        'seller_docs',
                        'seller_items',
                        'wife');



var bs_deal_2 = new Array('car_state',
                        'last_ts',
                        'damage',
                        'special_info',
                        'payment_date',
                        'seller_docs',
                        'seller_items',
                        'wife');


var wife = new Array(   'wife_info',
                        'penalty',
                        'ready_button');

var no_wife = new Array('penalty',
                        'ready_button');



    $('#bs_deal').change(function(){
        bs_deal_1.forEach(function(file) {
            string = "/blocks/load/" + file;
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);

                }
            });
            });
       });


        $('.document').on('change','#mods_yes', function() {
            mods.forEach(function (file) {
                string = "/blocks/load/" + file;
                $.ajax({
                    url: string,
                    dataType: "html",
                    success: function (data, textStatus) {
                        $('.document').append(data);
                    }
                });
            });
        });

    $('.document').on('change','#mods_no', function() {
            bs_deal_2.forEach(function (file) {
                string = "/blocks/load/" + file;
                $.ajax({
                    url: string,
                    dataType: "html",
                    success: function (data, textStatus) {
                        $('.document').append(data);
                    }
                });
            });
            });

    $('.document').on('change','#wife_no', function() {
        no_wife.forEach(function (file) {
            string = "/blocks/load/" + file;
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);
                }
            });
        });
    });

    $('.document').on('change','#wife_yes', function() {
        wife.forEach(function (file) {
            string = "/blocks/load/" + file;
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);
                }
            });
        });
    });

    $('.document').on('chacked','#reg_ts', function() {
              $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.content-seller-doc').append('<div class = "content-input-group">'+
                                          '<input class="form-control" type="text" name="qwe"  placeholder="Документы">'+
                                          '</div>');
                }
            });
        });
    $('.document').on('click','#ready-button',function(){



    })








