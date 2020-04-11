$('.NewRow').hide();
$(document).ready(function (){
    $('#cancel').click(function(){
        $("[name='username']").val('');
        $("[name='password']").val('');
    });
    

    $('.update').prop("readonly", true);

    $.fn.invisible = function() {
        return this.css('visibility', 'hidden');
    }; // Define the visibility property in CSS [Not availible in jquery]

    $.fn.visible = function() {
        return this.css('visibility', 'visible');
    }; // Define the visibility property in CSS [Not availible in jquery]

    setTimeout(function(){
        $('#successMsg').invisible();
    },3000); 
    
    $('.updateRecord').click(function() {
        $(this).fadeOut(50);
        $(this).siblings('.saveRecord, .cancel').fadeIn(500);
        var value = $(this).val();
        value = value.split(' ');
        value = value[0];
        $('.'+value).prop("readonly", false);
        $('.'+value).css('text-align','center');

        $('.NewRow').animate({left: '250px'}).visible();

    });

    $('.cancel').click(function() {
        $(this).siblings('.updateRecord').fadeIn(400);
        $(this).siblings('.saveRecord').fadeOut(100);
        $(this).fadeOut(100);
        // $.post(ajaxurl, data);
        var value = $(this).val();
        value = value.split(' ');
        value = value[0];
        $('.'+value).prop("readonly", true);


    });

    $('.saveRecord').click(function() {
        $(this).siblings('.updateRecord').fadeIn(200);
        $(this).siblings('.cancel').fadeOut(10);
        $(this).fadeOut(100);

        var value = $(this).val();
        var functionName = $(this).attr('name');
        var ajaxurl = 'noteUpdate.php';
        value = value.split(' ');
        var Name = value[0];
        var ID = value[1];
        var fieldName = $('.'+Name).filter('.Name' ).val();
        var fieldMath = $('.'+Name).filter('.Math' ).val();
        var fieldInfo = $('.'+Name).filter('.Info' ).val();
        data = {
            'save': functionName,
            'ID': ID,
            'Name': Name, //Name from the notes file
            'fieldName':fieldName, // Name from the field
            'Math': fieldMath,
            'Info':fieldInfo
        };
        $.post(ajaxurl, data, function (data,status,xhr) {
             location.reload();
        });
        var value = $(this).val();
        value = value.split(' ');
        value = value[0];
        $('.'+value).prop("readonly", true);
        
    });

    $('.AddStudent').click(function(){
        $('.NewRow').fadeIn(500);
        $(this).fadeOut(300);
    });

    $('.NewCancel').click(function(){
        $('.NewRow').fadeOut(200);
        $('.AddStudent').fadeIn(100);
    });

    $('.NewSave').click(function(){
        // var userId = <?php echo json_encode($_SESSION['UserID'], JSON_HEX_TAG); ?>;
        // var value =  $('.removeRecord').val();
        // alert(value);
        // var userId = value[1];
        var Name = $('.NewName').val();
        var Maths = $('.NewMath').val();
        var Info = $('.NewInfo').val();
        var ajaxurl = 'addStudentNote.php'; 
        data = {
            // 'userId':userId,
            'Name':Name,
            'Maths':Maths,
            'Info':Info
        }
        $.post(ajaxurl, data,function(data, status, xhr){
            location.reload();  
        });

    });
    
});   
    $('.logout-btn').click(function(){
        var ajaxurl = 'logout.php';
        var data = {'logout':ajaxurl};
        $.post(ajaxurl,data,function(data,status,xhr){
            window.location.replace("index.php");
        });
    });
$('.removeRecord').click(function(){
    var ajaxurl = "noteManipulation.php";
    var value =  $(this).val().split(' ');
    var userID = value[1];
    var Name = value[0];
    data = {
        'removeRecord':userID,
        'userI':userID,
        'Name':Name
    }
    $.post(ajaxurl, data,function(data, status, xhr){
        location.reload();
    });
});  