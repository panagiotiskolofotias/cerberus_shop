<?php
require_once("ConnectionDB.php");
class MainMenu {
     public static function GetMainMenu(){
        $SqlResponce = ConnectionDB::SelectQuery("Select category_id ,name , icons from categories");
        if ($SqlResponce->num_rows > 0) {
            $result = "";
            $Submenu ="Submenu";
            $Submenuid =0;
            while ($row = mysqli_fetch_array($SqlResponce)) {

                $Subresult =  self::Get_MenuSubCategory1_count($row["category_id"]) ;
                if ($Subresult == 0){
                     $result =  $result . " <li class=\"sidebar-item\" >\n";
                     $result =  $result . "<a class=\"sidebar-link\" href=\"Products.php?Categoryid=". $row["category_id"] ."\">\n";
                     $result =$result . $row["icons"] ."\n";
                     $result =$result ."<span>". $row["name"]."</span>\n";
                     $result = $result ."</a></li>\n";
                }else{
                    $Submenuid +=1;    
                    $result =  $result . " <li class=\"sidebar-item\"> \n";
                    $result =  $result . "<a href=\"#\" class=\"sidebar-link collapsed has-dropdown\"  data-bs-toggle=\"collapse\" \n";
                    $result =  $result . " data-bs-target=\"#".$Submenu.$Submenuid ."\" aria-expanded=\"false\" aria-controls=\"".$row["name"]."\">\n";
                    $result =$result . $row["icons"] ."\n";
                    $result =$result ."<span>". $row["name"]."</span> \n";
                    $result = $result ."</a>\n";
                    $result = $result ."<ul id=\"". $Submenu.$Submenuid."\" class=\"sidebar-dropdown list-unstyled collapse\"  data-bs-parent=\"#sidebar\"> \n";
                    $result = $result . self::Get_MenuSubCategory1( $row["category_id"]) ."\n";
                    $result = $result ."</ul>\n";                  
                    $result = $result ."</li>\n";
                }
            }
        }
        return $result;
    }

    private static function Get_MenuSubCategory1_count($id){
        $SqlResponce = ConnectionDB::SelectQuery("Select count(*) as 'lines' from Sub_category1 where category_id = ".$id);
        $result = 0;
        if ($SqlResponce->num_rows > 0) {
            while ($row = mysqli_fetch_array($SqlResponce)) {
                $result =  $row["lines"];
            }
        }
        return $result;
    }
    private static function Get_MenuSubCategory1($id){
        $SqlResponce = ConnectionDB::SelectQuery("Select category_id, subcategory1_id ,name from Sub_category1 where category_id = ".$id);
        $result="";
        if ($SqlResponce->num_rows > 0) {
            while ($row = mysqli_fetch_array($SqlResponce)) {
                 $result = $result ."<li class=\"sidebar-item\"> \n";
                 $result = $result ."<a href=\"Products.php?Categoryid=". $row["category_id"] ."&SubCcategory1id=". $row["subcategory1_id"] ."\" class=\"sidebar-link\"> ".$row["name"]."</a> \n";
                 $result = $result ."</li>\n";
            }
        }
        return $result;
    }
}
