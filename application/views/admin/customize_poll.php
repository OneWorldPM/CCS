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


<div class="main-content">
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
            <div class="col " style="margin-left: 50px; margin-top: 50px;">
                <form action="<?=base_url()?>admin/sessions/save_poll_style" method="POST">
                    <label>Colors can be set like ColorName(red), ColorCode Hex(#FF0000), RgbColors(255,0,0)</label>

                    <div class="form-group row">
                        <label for="poll_style_name" class="col-sm-2 col-form-label">Custom Theme Name</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="poll_style_name" name="poll_style_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_theme_color" class="col-sm-2 col-form-label">Custom Theme Color</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="custom_theme_color" name="cust_theme_color">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_radio_color" class="col-sm-2 col-form-label">Custom Option Button Color</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="custom_radio_color" name="cust_radio_color" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_radio_color" class="col-sm-2 col-form-label">Custom Timer Color</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="custom_timer_color" name="cust_timer_color">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_timer_background_color" class="col-sm-2 col-form-label">Custom Timer BgColor</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="custom_timer_background_color" name="cust_timer_bg_color">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_assessment_color" class="col-sm-2 col-form-label">Custom Assessment PrgoressBar Color</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="custom_assessment_color" name="cust_assessment_color">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_presurvey_color" class="col-sm-2 col-form-label">Custom Presurvey ProgressBar Color</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="custom_presurvey_color" name="cust_presurvey_color">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cust_correct_color" class="col-sm-2 col-form-label">Custom Correct Answer ProgressBar Color</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="cust_correct_color" name="cust_correct_color">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_progress_shadow_color" class="col-sm-2 col-form-label">Custom ProgressBar Shadow Color</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="custom_progress_shadow_color" name="custom_progress_shadow_color">
                        </div>
                    </div>

                    <div >
                        <button type="submit" class="btn btn-green " > Save Style </button>
                    </div>
                </form>
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
        }else{
            Swal.fire(
                'Error',
                response,
                'error'
            )
        }
    }
</script>

<?php $this->session->unset_userdata('msg');?>