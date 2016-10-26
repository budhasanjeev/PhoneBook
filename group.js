/**
 * Created by Sanjeev on 10/26/2016.
 */

function deleteGroup(id){

    var choice = confirm("Are you Sure you want to Delete?");

    if(choice){

        $.ajax({
            type:"GET",
            url:"deleteGroup.php",
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

function editGroup(incomingId){

    var id = '#' + incomingId;

    var firstname = $(id).children('#group_name').text();
    var lastname = $(id).children('#group_member').text();

    $("#group-name").val(firstname);
    $("#member").val(lastname);
    $('#operationMode').attr('value',1);
    $('#group_id').attr('value',incomingId);

    $('#insert-group').modal('show');
    $('#insert-group .modal-title').html("Edit this Group");
    $('#insert-group button[type=submit]').html(" Save Changes");


};
