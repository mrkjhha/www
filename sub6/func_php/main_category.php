<?
$init=0;
if($init2==0 && $main_cnt>1) {$init2=1; $sql.=" (";};

for($i=0; $i<4;$i++){
    if($main_category_set[$i]!=null){
        if($init==0){$init=1;}
        else {$sql.=" or ";};
        $item_main_category=$main_category_set[$i];
        $sql.="category='$item_main_category'";
    };
};
if($init2==1 && $init==1 && $main_cnt>1) {$sql.=")";};
?>