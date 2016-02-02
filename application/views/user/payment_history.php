<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="/user/profile">Главная страница</a></li>
                    <li><i class="fa fa-laptop"></i>История платежей</li>
                </ol>
            </div>
        </div>

        <table style="width: 100%" class="table table-striped">
            <thead>
                <th style="width: 25%">Название документа</th>
                <th style="width: 25%">Дата создания</th>
                <th style="width: 25%">Статус оплаты</th>
            </thead>
            <? foreach ($payments as $payment) {?>
                <tr>
                    <td><?=($payment['subID']==0)?"Оплата документа №{$payment['payID']}":"Оплата подписки"?></td>
                    <td><?=$payment['date']?></td>
                    <td><?=($payment['type']==1)?"Оплаченно":"Не оплаченно"?></td>
                </tr>
            <? } ?>
        </table>

    </section>
</section>
<!--main content end-->
</section>