<?php
$user_role = $this->session->userdata('role');
?>
<div class="main-content">
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">Notes Details</h1>
                </div>
            </div>
        </section>

        <div class="container-fluid container-fullw">
            <div class="row">
            <form name="add_notes_frm"  id="add_sessions_frm" method="POST" action="<?= base_url()?>admin/Notes/create_notes" >
            <div class="col-md-6">
            <div class="panel panel-primary" id="panel5">
            <div class="panel-heading">
                            <h4 class="panel-title  text-bold">Note Details</h4>
                            <div class="panel-body bg-white" style="border: 1px solid #b2b7bb!important;">
                            <div class="col-md-12">
                            <div class="form-group">
                                    <label for="note_title" class="text-large text-bold">Note Title</label>
                                    <input type="text" name="note_title" id="note_title" class="form-control">
                            </div>
                                     <div class="form-group">
                                    <label for="note_content" class="text-large text-bold">Note Content</label><br>
                                    <textarea name="note_content" rows="10" cols="50" class="form-control text text-black" id="note_content" style="color:black" ></textarea><br>
                                    <input type="submit" class="btn btn-success">
                                     </div>
                           
                            </div>
                            
                            </div>

                        </div>
            </div>
            </div>
               
              
                </form>
            </div>
        </div>