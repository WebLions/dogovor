/**
 * Created by Swarge on 12/29/2015.
 */
var files= new Array(   'data_city',
                        'sealer',
                        'sealer_info',
                        'buyer',
                        'buyer_info',
                        'car_info',
                        'car_info_pts',
                        'car_coast',
                        'mods',
                        'mods_info',
                        'car_state',
                        'last_ts',
                        'damage',
                        'special_info',
                        'payment_date',
                        'seller_docs',
                        'seller_items',
                        'wife',
                        'wife_info',
                        'penalty');

var i = 0;

$(document).ready(function(){

    $('.next').click(function(){
        $('.next').remove();
        string = "/blocks/load/"+files[i];
        $('.wrapper').load(string);
        i++;
    })

});