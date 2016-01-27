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
                <table style="width: 100%">
                    <thead>
                        <th style="width: 25%">Название документа</th>
                        <th style="width: 20%">Срок хранения</th>
                        <th style="width: 20%">Состояние оплаты</th>
                        <th style="width: 20%">Дата создания</th>
                        <th style="width: 15%">Действия</th>
                    </thead>
                    <? foreach ($documents as $document) {?>
                    <tr>
                        <td><?=$document['document_name']?></td>
                        <td>30 дней</td>
                        <td>Оплачено</td>
                        <td><?=$document['date']?></td>
                        <td style="float: left">
                            <a class="glyphicon glyphicon-pencil btn btn-success btn-xs" style="float:right;" href=""></a>
                            <a class="glyphicon glyphicon-trash btn btn-danger btn-xs" style="float:right;" href=""></a>
                            <a class="glyphicon glyphicon-shopping-cart btn btn-info btn-xs" style="float:right;" href="">
                            <a class="glyphicon glyphicon-floppy-save btn btn-primary btn-xs" style="float:right;" href="/document/<?=$document['url']?>/<?=$document['id']?>"></a>
                        <td>
                    </tr>
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




