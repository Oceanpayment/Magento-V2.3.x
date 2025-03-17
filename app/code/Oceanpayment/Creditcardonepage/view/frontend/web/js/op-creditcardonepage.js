
                var oceanpaymentCallBack = function(data){
                    console.log(data);
                    $("#card_data").val(data.card_data);
                    $("#errorMsg").val(data.errorMsg);
        
                }
                
     
            