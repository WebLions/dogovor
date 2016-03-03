<section id="main-content">
    <section class="wrapper">
        <!--overview start-->

        <div class = "row">
            <div class = "col-lg-6 col-lg-offset-3">
                <form action="/document/saveEdit" method="post" id="editForm" class="document">
                    <input type="text" value="<?=$doc_id?>" name="doc_id" hidden>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-1">
                            <h4 class="panel-title">
                                <a role="button" data-load="false" data-type="bs_block_deal" data-toggle="collapse" data-parent="#accordion" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                    Город и дата заключения договора
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-1">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-2">
                            <h4 class="panel-title">
                                <a role="button" data-load="false" data-type="bs_vendor" data-toggle="collapse" data-parent="#accordion" href="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
                                    Продавец
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-2">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-3">
                            <h4 class="panel-title">
                                <a role="button" data-load="false" data-type="bs_block_buyer" data-toggle="collapse" data-parent="#accordion" href="#collapse-3" aria-expanded="true" aria-controls="collapse-3">
                                    Покупатель
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-3">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-4">
                            <h4 class="panel-title">
                                <a role="button" data-load="false" data-type="bs_block_ts_info" data-toggle="collapse" data-parent="#accordion" href="#collapse-4" aria-expanded="true" aria-controls="collapse-4">
                                    Машина
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-4">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-5">
                            <h4 class="panel-title">
                                <a role="button" data-load="false" data-type="bs_block_car_price" data-toggle="collapse" data-parent="#accordion" href="#collapse-5" aria-expanded="true" aria-controls="collapse-5">
                                    Цена (+ Сороки + Неустойка)
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-5">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-6">
                            <h4 class="panel-title">
                                <a role="button" data-load="false" data-type="bs_block_car_in_marriage" data-toggle="collapse" data-parent="#accordion" href="#collapse-6" aria-expanded="true" aria-controls="collapse-6">
                                    Супруг(а)
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-6">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-7">
                            <h4 class="panel-title">
                                <a role="button" data-load="false" data-type="bs_block_police_yes" data-toggle="collapse" data-parent="#accordion" href="#collapse-7" aria-expanded="true" aria-controls="collapse-7">
                                    Заявление ГИБДД
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-7">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
</section>
