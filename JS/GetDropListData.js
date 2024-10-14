function ClearDropDown(control){
    document.getElementById(control).innerHTML = '<option value="" ></option>';
 }

function GetDropListData(method,control,parentcontrol){
    var id ='';
    if (parentcontrol !== undefined && parentcontrol !==''){
         id = document.getElementById(parentcontrol).value;
    }
    
    
    $.ajax({
        
        type: "GET",
        url: "../ApiClass/GetDropListData.php",
        data: {
            Method:  method,
            control: control,
            id :id
        },
        success: function (results) {
          document.getElementById(control).innerHTML = results;
        },
        error: function (data) {
            alert(data);
        }
    });
}

 
function LoadDropDound(method,control,id){
     $.ajax({
         
         type: "GET",
         url: "../ApiClass/GetDropListData.php",
         data: {
             Method:  method,
             control: control,
             id :id
         },
         success: function (results) {
           document.getElementById(control).innerHTML = results;
         },
         error: function (data) {
             alert(data);
         }
     });    
     
     
 }
 