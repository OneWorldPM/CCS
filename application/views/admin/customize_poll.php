<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
    .form-control{
        max-width: 300px;
    }
</style>
<!---->
<?php //echo($this->session->flashdata('response'));
//
//die;
//?>


<div class="main-content ">
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">Customize Poll Stlye</h1>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col">
                <table id="table-theme" class="table table-striped">
                    <thead>
                    <th>Theme Name</th>
                    <th>Theme Color</th>
                    <th>Option Button Color</th>
                    <th>Timer Color</th>
                    <th>Timer BgColor</th>
                    <th>Assessment Color</th>
                    <th>Presurvey Color</th>
                    <th>Correct Answer </th>
                    <th> Option </th>
                    </thead>
                    <tbody>
                        <?php if(isset($pollThemeData) && !empty($pollThemeData)):?>
                        <?php foreach ($pollThemeData as $theme): ?>

                            <tr>
                                <td><?=$theme->name?></td>
                                <td><?=$theme->cust_theme_color?></td>
                                <td><?=$theme->cust_radio_color?></td>
                                <td><?=$theme->cust_timer_color?></td>
                                <td><?=$theme->cust_timer_bg_color?></td>
                                <td><?=$theme->cust_assessment_color?></td>
                                <td><?=$theme->cust_presurvey_color?></td>
                                <td><?=$theme->cust_correct_color?></td>

                                <td>
                                    <a href="<?=base_url().'admin/sessions/deletePollTheme/'.$theme->id?>" class="btn btn-danger"> Delete </a>
                                    <a href="" id="edit_poll_theme" data-theme_id = '<?=$theme->id?>' class="btn btn-info"> Edit </a>
                                </td>

                            </tr>
                        <?php endforeach;?>
                         <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <label style="margin-left: 20px; color:darkgray">Colors can be set like ColorName(red), ColorCode Hex(#FF0000), RgbColors(255,0,0)</label><br><br>
            <form id="form" action="<?=base_url()?>admin/sessions/save_poll_style" method="POST">
            <div class="col-lg-5" >


                <div class="form-group row">
                    <label for="poll_style_name" class="col-sm-4 col-form-label">Custom Theme Name</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="poll_style_name" name="poll_style_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="custom_theme_color" class="col-sm-4 col-form-label">Custom Theme Color</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="custom_theme_color" name="cust_theme_color">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="custom_radio_color" class="col-sm-4 col-form-label">Custom Option Button Color</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="custom_radio_color" name="cust_radio_color" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="custom_radio_color" class="col-sm-4 col-form-label">Custom Timer Color</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="custom_timer_color" name="cust_timer_color">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="custom_timer_background_color" class="col-sm-4 col-form-label">Custom Timer BgColor</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="custom_timer_background_color" name="cust_timer_bg_color">
                    </div>
                </div>
            </div>
            <div class="col-lg-5">

                <div class="form-group row">
                    <label for="custom_assessment_color" class="col-sm-4 col-form-label">Custom Assessment PrgoressBar Color</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="custom_assessment_color" name="cust_assessment_color">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="custom_presurvey_color" class="col-sm-4 col-form-label">Custom Presurvey ProgressBar Color</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="custom_presurvey_color" name="cust_presurvey_color">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cust_correct_color" class="col-sm-4 col-form-label">Custom Correct Answer Color</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="cust_correct_color" name="cust_correct_color">
                    </div>
                </div>
<!--                <div class="form-group row">-->
<!--                    <label for="custom_progress_shadow_color" class="col-sm-4 col-form-label">Custom ProgressBar Shadow Color</label>-->
<!--                    <div class="col-sm-8">-->
<!--                        <input type="text"  class="form-control" id="custom_progress_shadow_color" name="custom_progress_shadow_color">-->
<!--                    </div>-->
<!--                </div>-->
                <div class="">
                    <button type="submit" id="submit" class="btn btn-green " style="display: inline-block" > Save Style </button>
                    <button class="btn" id="update" style="display: none; background-color: #fd7e14; color:white" > Update Style </button>
                    <button type="reset" class="btn" id="cancel" style="background-color: red; color:white" > Cancel </button>
                </div>
            </div>
            </form>
        </div>
        <div class="row">

            <div class="col" style="margin-left: 50px; margin-top: 50px;">

                </div>
                <div class="col">



            </div>

        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var response = "<?= $this->session->flashdata('msg') ?>";
    console.log(response);
    if(response){
        if(response == 'success'){
            Swal.fire(
                'Success',
                response,
                'success'
            )
        }else if(response === 'no changes made')
            Swal.fire(
                'info',
                response,
                'info'
            )
        else{
            Swal.fire(
                'Error',
                response,
                'error'
            )
        }
    }
</script>
<script>
    $(function(){
        $('#table-theme').on('click', '#edit_poll_theme', function(e){
            e.preventDefault();
            var theme_id = $(this).attr('data-theme_id');

            $.post('<?=base_url()?>/admin/sessions/editPollTheme',
                {'theme_id':theme_id},
            function(data){
                data = JSON.parse(data);

                $.each(data, function (index, value){
                    console.log(value);
                    if(value.id !=='' ){
                        $('#poll_style_name').val(value.name);
                        $('#custom_theme_color').val(value.cust_theme_color);
                        $('#custom_radio_color').val(value.cust_radio_color);
                        $('#custom_timer_color').val(value.cust_timer_color);
                        $('#custom_timer_background_color').val(value.cust_timer_bg_color);
                        $('#custom_assessment_color').val(value.cust_assessment_color);
                        $('#custom_presurvey_color').val(value.cust_presurvey_color);
                        $('#cust_correct_color').val(value.cust_correct_color);
                    }
                })
            })
            $('#submit').css('display','none');
            $('#update').css('display','inline-block').attr('data-theme_id',theme_id);
            $('#form').attr('action','<?=base_url()?>/admin/sessions/updatePollTheme/'+theme_id);
        })

        $('#cancel').on('click', function(){
            $('#submit').css('display','inline-block');
            $('#update').css('display','none');
            $('#form').attr('action','<?=base_url()?>admin/sessions/save_poll_style');
        })
    })

</script>

<?php $this->session->unset_userdata('msg');?>