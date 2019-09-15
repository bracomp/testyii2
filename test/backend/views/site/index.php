<style>
.apple {
border:solid thin black;
border-radius:50%;
height:9em;
width:10em;
margin:3px;
text-align:center;
}
.apple0{
margin-top:3em;
}
.actform {
text-align:center;
}
.eat {
width:30px
}

</style>
<script>
eats = new Array();
</script>
<?php
use common\models\User;
use common\models\Apple;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
   <?php 
	if(!isset($model)){
 		$model=new Apple();
	}
	foreach($model->getAll() as $item){
		$act='Испорчено';
		$id=$item['id']; 
		$size=str_replace('.',',',$item['size']);
		if($item['size']==1.00) $size='1';
		echo "<script>eats[$id]=".$item['size'].";</script>";
		if($item['status']==1) $status='<BR>на дереве'; 
		elseif($item['status']==2) $status='<BR>упало';
		else $status='<BR>удалено';
		if($item['state']==1){
			$status.='<BR><b>гнилое</b>';
			$act='Удалить';
			$act="<form action='index.php'><input type=hidden name=r value='site/eatdelete'><input type=hidden name=id value=$id><input type=submit value='$act'></form>";



		} else {
			if($item['status']==1){
				$act='Сорвать';
			$act="<form action='index.php'><input type=hidden name=r value='site/falltoground'><input type=hidden name=id value=$id><input type=submit value='$act'></form>";
			}
		
			elseif($item['eat']>0 && $item['state']==0){ 
				$act='Откусить';
			$act="<form action='index.php'><input type=hidden name=r value='site/eat'><input type=hidden name=id value=$id><input name=eat value='' placeholder='%' class=eat id='".$id."' onkeyup='checkeat(this)' ><input type=submit value='$act'></form>";
			}
		}
		if($item['color']=='black' || $item['color']=='blue' || $item['color']=='green') $s="<font color='white'>".$size."$status</font>";
		else $s=$size.$status;
		$angle=round($item['size']*360)+90;
		if($item['eat']<50) $angle=180-$angle;
		if($item['size']<1){
			if($item['eat']>50)
			echo "<div class='col-lg-2' title='$size'><div class='apple' style='background-color:#DDD".
			";background-image:linear-gradient(".$angle."deg,".$item['color']." 50%, transparent 50%),linear-gradient(90deg, transparent 50%,".$item['color']." 50%)'><div class='apple0'>".$s.
			"</div></div><div class='actform'>$act</div></div>";
			else
			echo "<div class='col-lg-2' title='$size'><div class='apple' style='background-color:".$item['color'].
			";background-image:linear-gradient(".$angle."deg, #DDD 50%, transparent 50%),linear-gradient(90deg, transparent 50%, #DDD 50%)'><div class='apple0'>".$s.
			"</div></div><div class='actform'>$act</div></div>";
		}
		else
		echo "<div class='col-lg-2' ><div class='apple' style='background-color:".$item['color'].
			"'><div class='apple0'>".$s.
			"</div></div><div class='actform'>$act</div></div>";
	}
   ?>             
           </div>
        </div>
    </div>
	<BR><h3>Тест</h3>
		$apple = new Apple('green');<BR>
		echo $apple->color; // green<BR><BR>

		$apple->eat(50); // Бросить исключение - Съесть нельзя, яблоко на дереве<BR>
		echo $apple->size; // 1 - decimal<BR><BR>

		$apple->fallToGround(); // упасть на землю<BR>
		$apple->eat(25); // откусить четверть яблока<BR>
		echo $apple->size; // 0,75<BR><BR>

		$apple = new Apple(2); //цвет можно задать индексом из массива<BR>
		echo $apple->color; //  ['black','green','silver','lime','gray','olive','white','yellow','red','blue','teal','fuchsia','aqua']
	<BR><BR>
		$apple = new Apple(); // цвет выбирается случайным образом<BR>
		echo $apple->color;<BR><BR>
	<h4> Результат выполнения теста </h4>
	<? 
		$apple = new Apple('green');
		echo $apple->color; // green

		$apple->eat(50); // Бросить исключение - Съесть нельзя, яблоко на дереве
		echo $apple->size; // 1 - decimal

		$apple->fallToGround(); // упасть на землю
		$apple->eat(25); // откусить четверть яблока
		echo $apple->size; // 0,75

		$apple = new Apple(2); //цвет можно задать индексом из массива
		echo "<BR>".$apple->color; // ['black','green','silver','lime','gray','olive','white','yellow','red','blue','teal','fuchsia','aqua']
	
		$apple = new Apple(); // цвет выбирается случайным образом
		echo "<BR>".$apple->color;
	?>
</div>
<script>
function checkeat(t){
	v=parseInt($(t).val());
	if (isNaN(v)) v=''; 
	$(t).val(v);
	if(v > 0 ){
		id=$(t).attr('id')
		if(v > eats[id]*100){
			$(t).val('').focus();
		}
	}
	return false;
}
</script>