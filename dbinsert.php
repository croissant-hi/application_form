<?php
function insert(){
    //database登録
    try{
        global $table;
        global $columns;
        global $dbh;
        $sql_set1 = "";
        $sql_set2 = "";
        $execute_args = array();

        foreach($columns as $val){
            $sql_set1 .= "`{$val}`, ";
            $sql_set2 .= ":{$val}, ";
            $execute_args = array_merge($execute_args,array(":".$val=>$_POST[$val]));
        }
        $sql_set1 = rtrim($sql_set1,', ');
        $sql_set2 = rtrim($sql_set2,', ');
        $sql = "INSERT INTO `{$table}`({$sql_set1},`date`) VALUES ({$sql_set2},NOW())";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute($execute_args);

    }catch (PDOException $e){
        die();
    }

    $dbh = null;
}
?>
