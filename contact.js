/**
 * Created by sanjeev-budha on 2/25/16.
 */

function formValidation(){
    var msg = " ";
    if(document.getElementById("firstName").value == ""){
        msg = "Please enter name<br>";
    }
    if(document.getElementById("lastName").value == ""){
        msg  += "Please enter email<br>";
    }
    if(document.getElementById("address").value == ""){
        msg += "Please enter address<br>";
    }

    if(msg != " "){

        document.getElementById('message').innerHTML = msg;
        document.getElementById('message').style.color='red';

        return false;

    }else{
        return true;
    }

}

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});

$(document).ready(function(){
    $('#compulsory').hide();
    $('#alertDeleted').hide();
    $('#alertEdited').hide();
});

function deleteContact(id){

    var choice = confirm("Are you Sure you want to Delete?");

    if(choice){

        $.ajax({
            type:"GET",
            url:"delete.php",
            data:{del:id},
            success:function(data){
                var data = JSON.parse(data)
                if(data.success){


                    var delay=2000; //1 seconds

                    setTimeout(function(){
                        document.location.reload(true);
                    }, delay);
                    $('#alertDeleted').show();

                }else{
                    alert("Unable to delete");
                }
            },
            error:function(error){

            }

        })

    }
}

function editContact(incomingId){

    var id = '#' + incomingId;

    var firstname = $(id).children('#first_name').text();
    var lastname = $(id).children('#last_name').text();
    var mobileNumber = $(id).children('#mobile_number').text();
    var address      = $(id).children('#address').text();
    var serviceProvider = $(id).children('#service_provider').text();

    $("#firstName").val(firstname);
    $("#lastName").val(lastname);
    $("#mobileNumber").val(mobileNumber);
    $('#addresses').val(address)
    $('#operationMode').attr('value',1);
    $('#contact_id').attr('value',incomingId);
    if(serviceProvider == 'NTC')
    {
        $("#NTC").attr('checked',true);
    }
    if(serviceProvider == 'Ncell'){
        $("#Ncell").attr('checked',true);
    }


    $('#insert-contact').modal('show');
    $('#insert-contact .modal-title').html("Edit this Contact");
    $('#insert-contact button[type=submit]').html(" Save Changes");


};



/*,)*/


