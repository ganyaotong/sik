<?php
/**
* 用戶數據模型
*/
class ModelCommonInit extends Model
{

    public function initmi($sql){
    	$ctime = date('y-m-d',time());
    }

    public function sql($sql){
    	foreach($sql as $b){ 
			$c=$b.";"; 
            if ($c==";") {
                continue;
            }
			$this->db->query($c);
		}
    }
    
}
?>