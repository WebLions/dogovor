
    $('#bs_deal').change(function(){
         string = "/blocks/load/main_block_bs";
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);

                }
            });
            });



        $('.document').on('change','#mods_yes', function() {
                           string = "/blocks/load/mods_bs";
                $.ajax({
                    url: string,
                    dataType: "html",
                    success: function (data, textStatus) {
                        $('.document').append(data);
                    }
                });
            });


    $('.document').on('change','#mods_no', function() {

                string = "/blocks/load/main_block_bs_2";
                $.ajax({
                    url: string,
                    dataType: "html",
                    success: function (data, textStatus) {
                        $('.document').append(data);
                    }
                });
            });


    $('.document').on('change','#wife_no', function() {

            string = "/blocks/load/main_block_nowife";
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);
                }
            });
        });


    $('.document').on('change','#wife_yes', function() {

            string = "/blocks/load/main_block)wife";
            $.ajax({
                url: string,
                dataType: "html",
                success: function (data, textStatus) {
                    $('.document').append(data);
                }
            });
        });


    $('.document').on('checked','#reg_ts', function() {
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








