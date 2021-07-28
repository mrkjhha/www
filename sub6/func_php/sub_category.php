<?
$init=0;
if($init2==0 && $sub_cnt==1){$init2=1; $sql.=" and ";};
if($init2==0 && $sub_cnt>1) {$init2=1; $sql.=" and (";};

for($i=0; $i<15;$i++){
    if($sub_category_set[$i]!=null){
        if($init==0){$init=1;}
        else {$sql.=" or ";};
        $item_sub_category=$sub_category_set[$i];
        $sql.="sub_category='$item_sub_category'";        
    };
};
if($init2==1 && $init==1 && $sub_cnt>1) {$sql.=")";};
?>