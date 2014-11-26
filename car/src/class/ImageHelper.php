<?php
class ImageHelper{
	private $class;
	private $src;
	private $alt;
	private $w;
	private $h;
	private $id;
	private $car_id;
	
	function __construct(){
		$this->class = 'img-thumbnail';
		$this->alt ='';
		$this->w = '240';
		$this->h ='240';
	}
	function init($src,$id,$car_id){
		$this->src = $src;
		$this->id = $id;
		$this->car_id = $car_id;
	}
	
	function process(){
		$temp ='<div class="form-group"><div class="col-md-4">';
		$temp .='<img src="'.$this->src.'" alt="'.$this->alt.'" class="'.$this->class.'" width="'.$this->w.'" height="'.$this->h.'">';
		$temp .='<div class="col-md-4"><a href="?delete=true&id='.$this->id.'&carid='.$this->car_id.'"><button type="button" class="btn btn-danger btn-lg">&nbsp;&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button></a></div>';
		$temp .='</div></div>';
		echo $temp;
	}
	
	

}
?>