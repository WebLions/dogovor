var bs_deal = true,
    mods_yes= true,
    mods_no = true,
    wife_no = true,
    wife_yes= true,
    reg_ts  = true;


    $('#bs_deal').change(function(){
         string = "/blocks/load/main_block_bs";
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



        $('.document').on('change','#mods_yes', function() {
         string = "/blocks/load/mods_bs";
            if(mods_yes == true)
                $.ajax({
                    url: string,
                    dataType: "html",
                    success: function (data, textStatus) {
                        $('.document').append(data);
                    }
                });
            mods_yes = false;
            });


    $('.document').on('change','#mods_no', function() {
        string = "/blocks/load/main_block_bs_2.php";
        if(mods_no == true)
                $.ajax({
                    url: string,
                    dataType: "html",
                    success: function (data, textStatus) {
                        $('.document').append(data);
                    }
                });
        mods_no = false;
        });


    $('.document').on('change','#wife_no', function() {
            string = "/blocks/load/main_block_nowife";
        if(wife_no == true)
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);
                }
            });
        wife_no = false;
        });


    $('.document').on('change','#wife_yes', function() {
            string = "/blocks/load/main_block_wife";
        if(wife_yes == true)
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);
                }
            });
        wife_yes = false;
        });


    $('.document').on('checked','#accessories', function() {
        i++;
              $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('#seller_tools').append('<div class = "content-input-group">'+
                                          '<input class="form-control" type="text" name="tools'+i+' "placeholder="Документы">'+
                                          '</div>');
                }
            });
        });

    $('.document').on('click','#ready-button',function(){



    })








