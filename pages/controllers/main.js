/**
 * 
 * 
 * ----------------LIST OF FUNCTIONS---------------------
 * 
 * 
 * -------------FORM SUBMISSIONS HANDLER-------------
 * --submitform(formName='', btnName='', btnOVal='', url='', reload=false, formreset=false, redirectTo='', bMsg='', sMsg='', isInput = true, testing=false);
 * 
 * 
 * ---------------FORM RESET FUNCTION-----------------
 * --resetForm(formName='');
 * 
 * 
 * ---------------CREATE STANDARD SELECT WITH SEARCH OPTION-----------
 * --createStandardSelect(ref='');
 * 
 * 
 * -----------------SEND BTN REQUEST TO AJAX----------------------
 * --sendBtnAjaxRequest(btnName='', url='', reload=false, redirectTo='', testing=false);
 * 
 * 
 * -----------------SEND DATA TO AJAX -----------------------------
 * --sendAjaxData(ref='', url='', page='', action='');
 * 
 * 
 * ----------------DATA FETCH (SELECT TO SELECT)-------------------------
 * --fetchDataOnSelect(ref='', ref2='', url='', page='', action='');
 * 
 * 
 * ---------------CREATE SUMMERNOTE-----------------------------------
 * --summernote(refId='');
 * 
*/







function submitform(
	formName='', btnName='', btnOVal='', url='',  
	reload=false, formreset=false, redirectTo='',
    bMsg='', sMsg='', isInput = true, testing=false
) {
    jQuery('#'+formName).parsley();

    jQuery('#'+formName).submit(function(e){
        e.preventDefault();

        if(jQuery('#'+formName).parsley().validate()){
            // var btnOVal = '';
            // if(isInput == true) btnOVal = jQuery('#'+btnName).val();
            // if(isInput == false) btnOVal = jQuery('#'+btnName).text();
            // alert(jQuery('#'+btnName).val());
            jQuery.ajax({
                url:'ajax/'+url+'.php',
                method:'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend:function(){
                    jQuery('#'+btnName).attr('disabled','disabled');
                    if(isInput == true) jQuery('#'+btnName).val(bMsg);
                    if(isInput == false) jQuery('#'+btnName).html(bMsg); 
                },
                success:function(data){
                    jQuery('#'+btnName).attr('disabled',false);

                    if(isInput == true) jQuery('#'+btnName).val(btnOVal);
                    if(isInput == false) jQuery('#'+btnName).html(btnOVal);

                    if(testing == true) alert(data);
                    if(testing == false) data = JSON.parse(data);

                    if(data.status !== 1){
                        jQuery('.alert-danger').html(data.message);
                        jQuery('.alert-danger').show();
                    }else{
                        if(sMsg.trim().length == 0) jQuery('.alert-success').text(data.message);
                        if(sMsg.trim().length !== 0) jQuery('.alert-success').text(sMsg);
                        jQuery('.alert-success').show();

                        if(redirectTo.trim().length !== 0){
                            window.location = redirectTo;
                        }

                        if(reload == true){
                            location.reload(true);
                        }

                        if(formreset == true){
                        	resetForm(formName);
                        }
                    }
                }
            })
        }
    });
}

function resetForm(formName='')
{
    jQuery('#'+formName)[0].reset();
    jQuery('#'+formName).parsley().reset();
}


function createStandardSelect(ref='')
{
    return jQuery("#"+ref).chosen({
        enable_search_threshold: 10,
        no_results_text: "Oops, nothing found!",
        width: "100%"
    });
}



function sendAjaxData(ref='', url='', page='', action='')
{
    var $attrs = '';
    var $vals = '';
    jQuery('#'+ref).each(function(){
        // var $len = this.attributes.length;
        jQuery.each(this.attributes, function(){
            if(this.name.includes('data-')){
                var $newattr = this.name.replace('data-', '');
                $attrs += $newattr+",";
                $vals += this.value+";";
            }
        });
    });

    jQuery.ajax({
        url:'ajax/'+url+'.php',
        method:'post',
        data: {page:page, action:action, names: $attrs, values: $vals},
        success:function(data)
        {
            return data;
        }
    });
}


function fetchDataOnSelect(ref='', ref2='', url='', page='', action='')
{
    jQuery(document).change('#'+ref, function(){
        var data = sendAjaxData(ref, url, page, action);

        jQuery('#'+ref2).html(data);
    });
}


function sendBtnAjaxRequest(btnName='', url='', reload=false, redirectTo='', testing=false)
{
    jQuery(document).on('click', '#'+btnName, function(e){
        e.preventDefault();

        var $cols = jQuery(this).data('cols');

        var $id = jQuery(this).data('vals');

        var $page = jQuery(this).data('page');
        
        var $action = jQuery(this).data('action');

        // if(window.confirm('Are you sure you want to delete this data?')){
            jQuery.ajax({
                url: "ajax/"+url+".php",
                method:'post',
                data:{page:$page, action:$action, vals:$id, cols:$cols},
                type:'json',
                success:function(data)
                {
                    if(testing == true) alert(data);
                    if(testing == false) data = JSON.parse(data);
                    
                    if(data.status !== 1){
                        jQuery('.alert-danger').html(data.message);
                        jQuery('.alert-danger').show();
                    }else{
                        jQuery('.alert-success').text(data.message);
                        jQuery('.alert-success').show();
                        
                        setTimeout(function(){
                            if(redirectTo.trim().length !== 0){
                                window.location = redirectTo;
                            }
                            
                            if(reload == true){
                                location.reload(true);
                            }
                        }, 3000);
                    }
                }
            })
        // }else{
        //     alert('Delete request canceled');
        // }
    })
}


function create_summernote(refId='')
{
    jQuery('#'+refId).summernote();
}


