
<!-- Modal -->
<div class="modal fade " id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Upload Files</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php if($this->session->userdata['role']!=="super_admin"):?>
                    <input type="text" name="title" value="" placeholder="Title | Subject" id="title" class="form-control"><br>
                    <input class="form-control" type="file" name="user_file" id="user_file">
                    <button type="button" class="btn btn-success upload-btn pull-right" style="margin-top: 10px; margin-bottom: 10px" id="modal-upload-btn">Upload</button>
                    <?php endif; ?>
                </div>
                <div>
                    <table class="table table-bordered table-striped text-center " id="upload_list_table" >
                        <thead>
                        <th>Subject</th>
                        <th>File Name</th>
                        <?=(isset($this->session->userdata['role']) && $this->session->userdata['role']==='super_admin')?'<th>Submitter</th>':''?>
                        <th>Date Uploaded</th>
                        <th>Option</th>
                        </thead>
                        <tbody id="upload_list_body">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

<script>
    $(function(){

        //  ****  Upload Image ***
        $('#upload-modal #modal-upload-btn').on('click', function() {
            var session_id = $(this).attr('data-session_id');
            console.log(session_id);
            let formData = new FormData();
            formData.append('user_file', $('.modal-body #user_file')[0].files[0]);
            formData.append('title', $('#title').val());
            formData.append('session_id', session_id);

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

                    $('#upload-modal').modal('hide');
                    getUploadedData();
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

    })
    function getUploadedData(session_id){

        $.post("<?=base_url()?>/admin/shared_files/getUploadedData/",
            {
                'session_id':session_id
            },function(data){

                if ( $.fn.DataTable.isDataTable('#upload_list_table') ) {
                    $('#upload_list_table').DataTable().destroy();
                }

                $('#upload_list_body').html('');
                $.each(data, function (index, val){
                    let role= "<?=$this->session->userdata['role']?>";
                    let user_id = "<?=$this->session->userdata['aid']?>";
                    let base_url = "<?=base_url()?>"
                    let deleteBtn='';
                    if(val.user_id === user_id){
                        deleteBtn = "<a href='' id='deleteBtn' class='btn btn-danger btn-sm' data-id='"+val.id+"' data-name='"+val.name+"' data-file_name='"+val.file_name+"'><i class='fa fa-trash-o'></i> Delete</a>"
                    }
                    let openBtn = "<a href='"+base_url+'uploads/admin_shared_files/'+val.file_name+"' download='"+val.name+"' enBtn' class='btn btn-success btn-sm' data-id='"+val.id+"' data-name='"+val.name+"' data-file_name='"+val.file_name+"'><i class='fa fa-download'></i> Open</a>"

                    $('#upload_list_body').append(

                        '<tr>' +
                        '<td>'+val.title+'</td>' +
                        '<td>'+val.name+'</td>' +
                        (role==='super_admin'? '<td>'+val.username+'</td>':'' )+
                        '<td>'+val.date_time+'</td>' +
                        '<td>'+deleteBtn+' '+openBtn+'</td>' +
                        '</tr>'
                    )
                })

                $('#upload_list_table').DataTable({
                    initComplete: function() {
                        $(this.api().table().container()).find('input').attr('autocomplete', 'off');
                        $(this.api().table().container()).find('input').attr('type', 'text');
                        //$(this.api().table().container()).find('input').val('');
                    },
                    "paging":   false,
                    "ordering": false,
                    "info":     false,
                    "filter": false
                });

            },'json')
    }
</script>