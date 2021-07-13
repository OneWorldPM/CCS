<?php
?>


<div class="main-content">
    <div class="jumbotron">
        <h2 style="text-align: center"> Admin Shared Files </h2>
        <p style="text-align: center"></p>
    </div>
    <div class="container-fluid" style="margin: 20px">
        <div class="row">
            <div class="col">
                <?php if($this->session->userdata['role']==='publisher'):?>
                <a id="upload-btn" href="" class="btn btn-primary pull-right" style="margin-right: 40px">Upload</a>
                <?php endif;?>
                <table class="table table-striped" id="upload_list_table">
                    <thead>
                        <th>#</th>
                        <th>Subject</th>
                        <th>File Name</th>
                        <th>Publisher</th>
                        <th>Date Uploaded</th>
                        <th>Option</th>
                    </thead>
                    <tbody id="upload_list_body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="title" value="" placeholder="Title | Subject" id="title" >
                    <input class="form-control" type="file" name="user_file" id="user_file">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success upload-btn">Upload</button>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

<script>
    $(function(){
        getUploadedData();

        $('#upload-btn').on('click', function(e){
            e.preventDefault();

            $('#upload-modal').modal('show');
        });

        //  ****  Upload Image ***
        $('.upload-btn').on('click', function() {
            let formData = new FormData();
            formData.append('user_file', $('.modal-body #user_file')[0].files[0]);
            formData.append('title', $('#title').val());

            swal.showLoading();
            $.ajax({
                url: "<?=base_url()?>/admin/shared_files/upload_file/",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    getUploadedData();
                    $('#upload-modal').modal('hide');

                    Swal.fire(
                        'Success!',
                        ''+data[0].name+' Successfully Uploaded',
                        'success'
                    )
                }, error: function (e) {
                    Swal.fire(
                        'Problem!',
                        e.responseText,
                        'error'
                    ).then(() => {

                    });
                }

            })
            swal.close();

        })



        $('#upload_list_table').on('click', '#deleteBtn', function(e){
            e.preventDefault();

            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var file_name = $(this).attr('data-file_name');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("<?=base_url()?>/admin/shared_files/deleteUploadedData/",
                        {
                            'id':id,
                            'file_name':file_name
                        },
                        function(data){
                            console.log(data)
                            if(data==="success"){
                                Swal.fire(
                                    'Deleted!',
                                    ''+name+'<br> file has been deleted.',
                                    'success'
                                )
                                getUploadedData();
                            }else{
                                Swal.fire(
                                    'Error!',
                                    '"'+data+'"',
                                    'error'
                                )
                                getUploadedData();
                            }
                        },'json');


                }
            })


        });

        function getUploadedData(){
            $.post("<?=base_url()?>/admin/shared_files/getUploadedData/",function(data){


                if ( $.fn.DataTable.isDataTable('#upload_list_table') ) {
                    $('#upload_list_table').DataTable().destroy();
                }

                $('#upload_list_body').html('')
                $.each(data, function (index, val){
                    console.log(val);
                    let user_id = "<?=$this->session->userdata['aid']?>";
                    let base_url = "<?=base_url()?>"
                    let deleteBtn='';
                    if(val.user_id === user_id){
                         deleteBtn = "<a href='' id='deleteBtn' class='btn btn-danger btn-sm' data-id='"+val.id+"' data-name='"+val.name+"' data-file_name='"+val.file_name+"'><i class='fa fa-trash-o'></i> Delete</a>"
                    }
                    let openBtn = "<a href='"+base_url+'uploads/admin_shared_files/'+val.file_name+"' download='"+val.name+"' enBtn' class='btn btn-success btn-sm' data-id='"+val.id+"' data-name='"+val.name+"' data-file_name='"+val.file_name+"'><i class='fa fa-download'></i> Open</a>"

                    $('#upload_list_body').append(

                        '<tr>' +
                        '<td>'+(index+1)+'</td>' +
                        '<td>'+val.title+'</td>' +
                        '<td>'+val.name+'</td>' +
                        '<td>'+val.username+'</td>' +
                        '<td>'+val.date_time+'</td>' +
                        '<td>'+deleteBtn+' '+openBtn+'</td>' +
                        '</tr>'
                    )
                })

                $('#upload_list_table').DataTable({
                    initComplete: function() {
                        $(this.api().table().container()).find('input').attr('autocomplete', 'off');
                        $(this.api().table().container()).find('input').attr('type', 'text');
                        $(this.api().table().container()).find('input').val('upload');
                        //$(this.api().table().container()).find('input').val('');
                    },

                });

            },'json')
        }
    })

</script>