<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php
                        if (!empty($category->id))
                            echo lang('pharmacy') . ' ' . lang('edit_expense_category');
                        else
                            echo lang('pharmacy') . ' ' . lang('add_expense_category');
                        ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($category->id))
                                                                echo lang('pharmacy') . ' ' . lang('edit_expense_category');
                                                            else
                                                                echo lang('pharmacy') . ' ' . lang('add_expense_category');
                                                            ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">All the department names and related informations</h3>
                        </div> -->
                        <!-- /.card-header --> 
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="finance/pharmacy/addExpenseCategory" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('category'); ?> &ast; </label>
                                    <input type="text" class="form-control" name="category" value='<?php
                                                                                                    if (!empty($category->category)) {
                                                                                                        echo $category->category;
                                                                                                    }
                                                                                                    ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast; </label>
                                    <input type="text" class="form-control" name="description" value='<?php
                                                                                                        if (!empty($category->description)) {
                                                                                                            echo $category->description;
                                                                                                        }
                                                                                                        ?>' placeholder="" required="">
                                </div>
                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($category->id)) {
                                                                            echo $category->id;
                                                                        }
                                                                        ?>'>


                                <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?> </button>


                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>



<!--main content end-->
<!--footer start-->