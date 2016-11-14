/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// function used in adding new PART/CHAMBER/SUPER CHAMBER to validate the ID if it is in DB
function validateInput(serial){
    
                //check value inserted is not in DB
            $.ajax({
                url: 'functions/ajaxActions.php?validateserial=true&partid='+serial,
                success: function(data){
                            if(data == 1){
                                $(".exist").show('');
                                $(".serialValidation").addClass('alert-danger');
                                return false;
                            }
                            else{
                                $('.exist').hide();
                                $(".serialValidation").removeClass('alert-danger');
                                $(".serialValidation").addClass('alert-success');
                                $(".newId").show();
                                
                                $(".newId").delay(700).fadeOut('fast');
                                $(".serialValidation").delay(700).removeClass('alert-success');
                                
                            }
                        }
            });
}

// Used to validate required inputs not empty use in Search Channel pin Page
function check_emptyness(e){
 
    var ev = e;
    try{
    if($(".searchby").val() !== "")
    {
        if($(".searchby").val() == "SECTOR - DEPTH - VFAT_POSN"){ 
            $(".query").val("sdv");
            if( $(".vfatpos").val() == "" || $(".sector").val() == "" || $(".depth").val() == "" ){
                $('.empty').show();
                throw "Exit Error";
                return false;
            }
        }
        if($(".searchby").val() == "IETA - IPHI - DEPTH"){
             $(".query").val("epd");
            if( $(".ieta").val() == "" || $(".iphi").val() == "" || $(".depth1").val() == "" ){
                $('.empty').show();
                throw "Exit Error";
                return false;
            }
        }
        
        
    }
    else
    {
        $('.empty').show();
        throw "Exit Error";
        return false;
    }
    }
    catch(e){ 
        //alert('catch');
        ev.preventDefault(); 
        return false; 
    }
}