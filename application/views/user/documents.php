<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <?if($alert_save=='true'){?>
        <div class = "row">
            <div class = "col-lg-12">
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Отлично!</strong> Ваши изменения сохранены!
                </div>
            </div>
        </div>
        <?}?>
        <div class = "row">
            <div class = "col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <th style="width: 40%">Название документа</th>
                        <th style="width: 15%">Срок хранения</th>
                        <th style="width: 15%">Состояние оплаты</th>
                        <th style="width: 15%">Дата создания</th>
                        <th style="width: 15%;text-align: center;">Действия</th>
                    </thead>
                    <? foreach ($documents as $key => $document) {?>
                    <tr>
                        <td>Блок документов: <?=$document['block_name']?></td>
                        <td><?=$document['day']?> дней</td>
                        <td><?=$document['type_s']?></td>
                        <td><?=$document['date']?></td>
                        <td>
                            <a class="glyphicon glyphicon-pencil btn btn-success btn-xs" style="float:right;" href="/document/edit/<?=$key?>"></a>
                            <?if($document['type']==0){?>
                                <a class="glyphicon glyphicon-shopping-cart btn btn-info btn-xs" style="float:right;" target="_blank" href="/payment/doc/<?=$key?>"></a>
                            <? }?>
                        <td>
                    </tr>
                        <? foreach($document['doc'] as $doc) {?>
                    <tr>
                            <td style="padding-left: 30px">-  <?=$doc['document_name']?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <td>
                            <?if($document['type']==1 ){?>
                            <a class="glyphicon glyphicon-floppy-save btn btn-primary btn-xs" style="float:right;" href="/document/<?=$document['url']?>_<?=$doc['url']?>/<?=$key?>"></a>
                            <?}?>
                        </td>
                    </tr>
                        <? } ?>
                    <? } ?>
                </table>
                <div>
            </div>
            <div class = "col-lg-12">
                <ul class="pagination">
                    <? for($i = 0; $i < $pages; $i++){?>
                    <li class="<?=($i==$page)?'disabled':'active'?>"><a href="?page=<?=$i?>"><?=$i+1?></a></li>
                    <?}?>
                </ul>
            </div>
        </div>




