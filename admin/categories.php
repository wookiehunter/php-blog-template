<?php include "includes/header.php" ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="col-xs-6">

                        <?php insert_categories(); ?>

                            <form action="" method="post">
                                <div class="form-group">
                                <label for="cat_title">Add Category:</label>
                                    <input class="form-control" type="text" name="cat_title" id="">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category" id="">
                                </div>
                            </form>

                            <?php if(isset($_GET['edit'])) {$cat_id = $_GET['edit']; include "includes/edit_categories.php"; } ?>
                        </div>

                        <div class="col-xs-6">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- FIND ALL CATEGORIES QUERY -->
                                <?php display_categories(); ?>

                            <!-- category delete -->
                            <?php delete_category() ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php"; ?>