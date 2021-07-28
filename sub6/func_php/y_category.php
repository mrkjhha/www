<?
$init=0;
if($init2==0 && $y_cnt==1) {$init2=1; $sql.=" and ";};
if($init2==0 && $y_cnt==2) {$init2=1; $sql.=" and (";};
// if(($init2==2 && $x_cnt!=null) || ($init2==2 && $search!=null)) {$sql.=" (";};

if($min_size_y!=null){ $init=1; $min_size_y=(int)$min_size_y; $sql.="size_y>=$min_size_y";};

if($max_size_y!=null){
    if($y_cnt==2){$sql.=" and ";};
    $max_size_y=(int)$max_size_y; 
    $sql.=" size_y<=$max_size_y";
};

if($init2==1 && $init==1 && $y_cnt==2) {$sql.=")";};
// if(($init2==2 && $x_cnt!=null) || ($init2==2 && $search!=null)) {$sql.=")";};
?>