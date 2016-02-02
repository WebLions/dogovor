<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="main">Главная страница</a></li>
                    <li><i class="fa fa-laptop"></i>Список документов</li>
                </ol>
            </div>
        </div>

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
                    <? foreach ($documents as $key => $document) {
                        $difference = intval(abs(
                            strtotime($document['date']) - strtotime(date('Y-m-d H:i:s'))
                        )); ?>
                    <tr>
                        <td>Блок документов: <?=$document['doc'][0]['document_name']?></td>
                        <td><?= 31 - ceil((time() - strtotime($document['date'])) / 86400);?> дней</td>
                        <td><?=($document['type']==1)?"Оплаченно":"Не оплаченно"?></td>
                        <td><?=$document['date']?></td>
                        <td>
                            <a class="glyphicon glyphicon-pencil btn btn-success btn-xs" style="float:right;" href=""></a>
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
                            <a class="glyphicon glyphicon-floppy-save btn btn-primary btn-xs" style="float:right;" href="/document/<?=$doc['url']?>/<?=$key?>"></a>
                        <td>
                    </tr>
                        <? } ?>
                    <? } ?>
                </table>
                <br>
                <div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class = "content-button">
                                <button type="button" class="btn btn-success">Что-либо</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>




