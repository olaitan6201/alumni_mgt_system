///submission snippet
/*submitform(formName='', btnName='', btnOVal='', url='',  
    reload=false, formreset=false, redirectTo='',
    bMsg='', sMsg='', isInput = true, testing=false
);*/


///Btn Data to Ajax snippet 
/*sendBtnAjaxRequest(
    btnName='', url='', reload=false, 
    redirectTo='', testing=false
);*/


jQuery(document).ready(function(){
    
    ////Logins-Register
    submitform('login_form', 'login_btn', 'Sign In', 'auth', false, false, 'admin/dashboard', 'Authenticating . . . !', 'Login Successful', false);
    submitform('loginForm', 'loginBtn', 'Sign In', 'auth', true, false, '', 'Authenticating . . . !', 'Login Successful', false);
    

    //Update profile
    submitform('updateForm', 'updateBtn', 'Update Profile', 'auth', false, false, '', 'Authenticating . . .!', 'Profile Updated Successfully', false);
    submitform('changePassForm', 'changePassBtn', 'Change Password', 'auth', false, false, 'logout', 'Authenticating . . .!', 'Password Changed Successfully', false);




    ////ADD POST
    submitform('add_post_form', 'add_post_btn', btnOVal='Submit', url='posts',  true, false, '',
        'Adding post . . . ', 'Post Added Successfully', true
    );

    ////ADD SESSION
    submitform('add_session_form', 'add_session_btn', btnOVal='Submit', url='sessions',  true, false, '',
        'Adding session . . . ', 'Session Added Successfully', true
    );

    ////ADD ALUMNI
    submitform('add_alumni_form', 'add_alumni_btn', btnOVal='Submit', url='alumnis',  false, true, '',
        'Adding Alumni Info . . . ', 'Alumni Added Successfully', true
    );

    ////UPDATE ALUMNI
    submitform('update_alumni_form', 'update_alumni_btn', btnOVal='Update', url='alumnis',  true, false, '',
        'Updating Alumni Info . . . ', 'Alumni Updated Successfully', true
    );

    ////ADD SPEECH
    submitform('add_speech_form', 'add_speech_btn', btnOVal='Submit', url='alumnis',  true, false, '',
        'Adding Speech . . . ', 'Speech Added Successfully', true
    );


    ////ADD EVENT
    submitform('add_event_form', 'add_event_btn', btnOVal='Submit', url='events',  true, false, '',
        'Adding Event . . . ', 'Event Added Successfully', true
    );

    ////UPDATE EVENT
    submitform('edit_event_form', 'edit_event_btn', btnOVal='Update', url='events',  false, false, 'admin/events/add',
        'Updating Event . . . ', 'Event Updated Successfully', true
    );

    ///DELET EVENT
    sendBtnAjaxRequest('deleteEvent', 'events', true);




    jQuery('.alert').hide();

    jQuery(document).bind('input select change click', 'input select button .alert', function(){
        jQuery('.alert').hide();
    });



    ////Create a Standard Select with search attribute
    createStandardSelect('postSelect');
    
    createStandardSelect('sessionSelect');
    create_summernote('summernote3');

    ////Send ajax data
    // fetchDataOnSelect('cat_name', 'sub_cat_name', 'category', 'category', 'fetchSubCats');

    jQuery('#cat_name').change(function(){
        var name = jQuery(this).val();

        jQuery.ajax({
            url: 'ajax/category.php',
            method:'post',
            data:{page:'category', action:'fetchSubCats', val:name},
            success:function(data)
            {
                // alert(data);
                jQuery('#sub_cat_name').html(data);
            }
        })
    });



    jQuery(document).on('click','#mode', function(e){
        e.preventDefault();

        var mode = jQuery('#mode').attr('data-mode');
        
        if(mode == 'on')
        {
            jQuery('#mode').attr('data-mode', 'off');
            jQuery('.mode').removeClass('fa-toggle-on');
            jQuery('.mode').addClass('fa-toggle-off');
            jQuery('body').removeClass('dark');
            mode= 'off';
        }
        else if(mode == 'off'){
            jQuery('#mode').attr('data-mode', 'on');
            jQuery('.mode').removeClass('fa-toggle-off');
            jQuery('.mode').addClass('fa-toggle-on');
            jQuery('body').addClass('dark');
            mode = 'on';
        }

        jQuery.ajax({
            url:"ajax/auth.php",
            method:'post',
            type:'json',
            data:{mode: mode},
            success:function(){}
        })

    })

    jQuery('#exampleModalCenter').on('show.bs.modal', function (e) {
        jQuery('#registerForm').hide();

        jQuery('.modal-title').text('Sign In');
    })

    jQuery('#toSignUp').click(function(){
        jQuery('#loginForm').hide();
        jQuery('#registerForm').show();
        jQuery('.modal-title').text('Sign Up');
    })
    jQuery('#toSignIn').click(function(){
        jQuery('#registerForm').hide();
        jQuery('#loginForm').show();
        jQuery('.modal-title').text('Sign In');
    })
})