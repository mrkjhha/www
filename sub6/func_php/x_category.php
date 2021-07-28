<?
$init=0;
if($init2==0 && $x_cnt==1){$init2=1; $sql.=" and ";};
if($init2==0 && $x_cnt==2) {$init2=1; $sql.=" and (";};

if($min_size_x!=null){ $init=1; $min_size_x=(int)$min_size_x; $sql.="size_x>=$min_size_x"; };

if($max_size_x!=null){ 
    if($x_cnt==2){$sql.=" and ";}; 
    $max_size_x=(int)$max_size_x;
    $sql.=" size_x<=$max_size_x"; 
};

if($init2==1 && $init==1 && $x_cnt==2) {$sql.=")";};
?>