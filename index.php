<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\module\admin\components\grid\GridView;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\module\admin\models\search\SupplierSearch $searchModel
 */
$this->title = 'Supplier';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clearfix">
    <h4></h4>
</div>
<section class="panel">
    <header class="panel-heading">
        <ul class="nav nav-pills pull-right">
            <li><?= Html::Button('Export', ['class' => 'btn btn-primary','id'=>'export']) ?></li>
        </ul>
        <i class="fa fa-user"></i> Supplier
    </header>
    <?= GridView::widget([
            'id'=>'supplierFrom',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],
            ['name'=>'id','class' => 'yii\grid\CheckboxColumn'],
            [
                'label' => 'ID',
                'attribute'=>'id',
                'value'=>function($model){
                    return  $model->id ;
                },
                'filter'=>['>'=>'>10','>='=>'>=10','<'=>'<10','<='=>'<=10']
            ],
            'name',
            'code',
            [
                'label' => 'T_status',
                'attribute'=>'t_status',
                'value'=>function($model){
                    return  $model->t_status ;
                },
                'filter'=>['ok'=>'ok','hold'=>'hold']
            ],
           // ['class' => 'app\module\admin\components\grid\ActionColumn'],
        ],
    ]); ?>
</section>
<div class="row" id="showselectnums"><div class="col-xs-6">all <span id="nums">50 </span> conversations in this search have been selected</div></div>
<script>
    var server_config = null;
    <?php
    ob_start();
    ?>
    $("#showselectnums").hide();
    $('#export').click(function(){
       // console.log($("*[name='SupplierSearch[id]']").val());
        top.location.href = '<?=Url::to(['export'])?>'+'?id='+$("*[name='SupplierSearch[id]']").val()+'&name='
            +$("*[name='SupplierSearch[name]']").val()+'&code='+$("*[name='SupplierSearch[code]']").val()+'&t_status='+$("*[name='SupplierSearch[t_status]']").val();

    });
    $("*[name='id_all']").click(function() {
        if($("*[name='id_all']").is(':checked')){
         $.getJSON('<?=Url::to(['export'])?>', {id: $("*[name='SupplierSearch[id]']").val(),'name':$("*[name='SupplierSearch[name]']").val(),'code':$("*[name='SupplierSearch[code]']").val(),'t_status':$("*[name='SupplierSearch[t_status]']").val()}, function (rs) {
             $("#nums").html(rs);
             console.log(rs);
             //if (rs.status)
               // $(me).parent().parent().remove();
             $("#showselectnums").show();
        })

        } else {
            $("#showselectnums").hide();
        }


    });

    <?php
    $js = ob_get_clean();
    $this->registerJs($js);
    ?>
</script>