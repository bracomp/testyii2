<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Apple model
 *
 * @property integer $id
 * @property string $color - цвет
 * @property int $date0  - дата появления
 * @property date $date1 -	дата падения
 * @property int $status (1- на дереве; 2 - упало )
 * @property int $eat - сколько осталось съесть
 * @property int $state (0- нормальное; 1- гнилое яблоко; 2 - испорчено)
 */


class Apple extends ActiveRecord 
{
	 
	public $size=1; 
	public $apples_count=10; // начальное количество яблок на дереве
	public $colors=['black','green','silver','lime','gray','olive','white','yellow',
		'red','blue','teal','fuchsia','aqua'];

	function __construct($color='')
    {
      	$this->color = $this->getColor($color);
        $this->status = 1;
		$this->eat = 100;
		$this->date0=time();
		
    }
	public static function tableName()
    {
        return '{{%apple}}';
    }
	
   public function getColor($n=null){ // возвращает цвет заданный либо случайно выбранный
		if(is_int($n)){
			$n= $n % count($this->colors) ;
		}
		elseif(is_string($n)){
			$n= strtolower($n);
			if(in_array($n,$this->colors)) return $n;
			else $n=rand(0,count($this->colors)-1);
		}
		elseif(is_null($n)) $n=rand(0,count($this->colors)-1);
		
		return $this->colors[$n];
   }
  
	public function eat($n){
		if($this->status==2){
			$this->eat=$this->eat-$n;
			if($this->eat < 0) $this->eat=0;
			$this->size= number_format( $this->eat/100,2,',','');
			echo "<br>";
		} else echo "<BR>Съесть нельзя, яблоко на дереве<BR>";
		
   }
	public function fallToGround(){
	//	$this->status0=2;
		$this->status=2;
	}

    public function generate()
    {	$flag=0;
        $this->deleteAll();
		$apple=new Apple();
		for($i=0; $i < $this->apples_count; $i++)
		{
			$apple->id=$i+1;
		//	$apple->color=$this->getColor();
		//	$apple->date0=time();
			$apple->date1=date('Y-m-d H:i:s');
		//	$apple->status=1;
		//	$apple->eat=100;
			$apple->state=rand(0,1);
			$apple->save();
			$flag=$apple;
			$apple=new Apple();
		}
		return $flag;
    }
	public function getAll(){
		$sql = "SELECT * FROM {{apple}} WHERE status=2 AND date0<".(time()- 5 * 60 * 60); // После лежания 5 часов - портится.
		$after5hours=$this->findBySql($sql)->all();
		if($after5hours){
			foreach($after5hours as $apple)
			{	$apple->state=2; // испорчено
				$apple->save();
			}
		}
		$ar=(new \yii\db\Query())->select(['*'])->from('apple')->all();
		for($i=0; $i<count($ar); $i++)
		{ $ar[$i]['size']=number_format( $ar[$i]['eat']/100,2,'.','');
		}
		return      $ar;
	}
	

}
?>