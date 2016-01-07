/**
 * Created by Swarge on 1/7/2016.
 */
$( document ).ready(function() {
    $('.document').on('click','#ready-button',function(){
        $.post( "/ajax/addUser",  $("#confirmation_form").serialize() , function( data ) {
            var obj = jQuery.parseJSON( data );
            if(obj.error == 0)
            {
                $("#ready_button").trigger('click');
            }
            else{
            }
        });
        return false;
        e.preventDefault();
    });