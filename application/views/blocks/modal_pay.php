<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Спасибо за испольование нашего сервиса.</h4>
        </div>
        <?if($user_id){?>
            <div class="modal-body">
                Для того чтобы скачать документ нужно оплатить сумму в размере 390 руб.<br>
                Скачать документ вы сможете после оплаты.
            </div>
        <? }else{ ?>
            <div class="modal-body">
                Для того чтобы скачать документ нужно оплатить сумму в размере 390 руб.<br>
                На указанный вами E-mail прийдет созданный для вас логин и пароль.<br>
                Скачать документ вы сможете после оплаты.
                <div class="content-input-group">
                    <input class="form-control" type="text" name="email" id="user-email"  placeholder="E-mail">
                </div>
            </div>
        <? } ?>
        <div class="modal-footer" style="text-align: center">
            <button id="ready_button" type="submit" class="btn btn-success">Перейти к оплате</button>
        </div>
    </div>
</div>