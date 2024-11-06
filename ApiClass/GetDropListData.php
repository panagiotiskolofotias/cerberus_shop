<?php
$Method = $_GET['Method'];
$id = "";
if(isset($_GET['id'])){  
    $id = $_GET['id'];
} 

$t = new GetDropListData();
require_once("ConnectionDB.php");

class GetDropListData{
    public  function GetCategory($id){
        $SqlQuery ="Select category_id ,name from categories";
        if ($id != null){
          $SqlQuery = $SqlQuery." where category_id = ".$id;  
        }
        $SqlResponce = ConnectionDB::SelectQuery($SqlQuery);
        $result="";
        if ($SqlResponce->num_rows > 0) {
            foreach($SqlResponce as $SubCatrow):
                $result= $result. '<option value="'.$SubCatrow["category_id"].'" >'.$SubCatrow["name"] .'</option>'; 
            endforeach;        
        }
        return $result;
    }
    public  function GetSubCategory1($id){
        $SqlQuery ="Select subcategory1_id ,category_id ,name from sub_category1";
        if ($id != null){
          $SqlQuery = $SqlQuery." where category_id = ".$id;  
        }
        $SqlResponce = ConnectionDB::SelectQuery($SqlQuery);
        $result="";
        if ($SqlResponce->num_rows > 0) {
            foreach($SqlResponce as $SubCatrow):
                $result= $result. '<option value="'.$SubCatrow["subcategory1_id"].'" >'.$SubCatrow["name"] .'</option>'; 
            endforeach;        
        }
        return $result;
    }    

    public  function GetSubCategory2($id){
        $SqlQuery ="Select subcategory2_id ,subcategory1_id ,name from sub_category2";
        
        $result="";
          $SqlQuery = $SqlQuery." where subcategory1_id = ".$id;  
     
        $SqlResponce = ConnectionDB::SelectQuery($SqlQuery);
        if ($SqlResponce->num_rows > 0) {
            foreach($SqlResponce as $SubCatrow):
                $result= $result. '<option value="'.$SubCatrow["subcategory2_id"].'" >'.$SubCatrow["name"] .'</option>'; 
            endforeach;        
        }
        return $result;
    }    
}

if ($Method == "GetCategory" ) { echo $t->GetCategory($id);}
if ($Method == "GetSubCategory1" ) { echo $t->GetSubCategory1($id);}
if ($Method == "GetSubCategory2" ) { echo $t->GetSubCategory2($id);}
?>

