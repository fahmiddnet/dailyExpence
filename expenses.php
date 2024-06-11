<?php session_start(); if(isset($_SESSION['id']) && isset($_SESSION['password'])){ ?>

<?php
include('Layout/header.php');
include('db/connect.php');



    $show_catagory = "SELECT * FROM catagory_e";
    $show_catagory_query = mysqli_query($conn,$show_catagory);
    $show_all_catagory = mysqli_fetch_all($show_catagory_query,MYSQLI_ASSOC);
?>

<section class="expeses-item">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php 
                if(isset($_GET['msg'])){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Infomation Insrted !!   Please Chack Here <a href="info.php" class="btn btn-info">Information</a>
                            <button type="button" class="btn-close alert_btn_close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                if(isset($_GET['msgErr'])){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something Wrong
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                ?>

                <form action="auth/expenceauth.php" method="POST" id="add_form">
                    <div class="mb-3" id="datepicker">
                        <label for="date_time" class="form-label">Pick a Date</label> <br>
                        <input type="date" name="item_date" required>
                    </div>
                    <div class="expense-item" id="expense_box_item">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="item_title[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-field">
                                    <label class="form-label">Amount</label>
                                    <input type="number" name="item_amount[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-field">
                                    <label class="form-label">Catagory</label><br>
                                    <select class="form-select" name="item_catagory[]"  aria-label="Default select example" required>
                                        <option selected>Open this select menu</option>
                                        <?php foreach($show_all_catagory as $item_catagory): ?>
                                        <option value="<?php echo $item_catagory['catagory_name'] ?>"><?php echo $item_catagory['catagory_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-field">
                                    <label class="form-label">Note</label>
                                    <input type="text" name="item_note[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="input-field">
                                    <label class="form-label">opt</label><br>
                                    <a class="btn btn-danger">x</a>
                                </div>
                            </div>
                        </div>
                        <div class="btn-add_new d-flex justify-content-end">
                            <a class="btn btn-dark" id="add_new_item">add new</a>
                        </div>
                    </div>
                    <button type="submit" name="submit_exp_value" class="btn btn-primary mb-5">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(function() {
        $("#datepicker").datepicker();
    })
    $(document).ready(function() {
        $("#add_new_item").click(function(e) {
            e.preventDefault();
            $("#expense_box_item").prepend(`
                <div class="row append_item">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="item_title[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-field">
                                    <label class="form-label">Amount</label>
                                    <input type="number" name="item_amount[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-field">
                                   <label class="form-label">Catagory</label><br>
                                    <select class="form-select" name="item_catagory[]" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <?php foreach($show_all_catagory as $item_catagory): ?>
                                        <option value="<?php echo $item_catagory['catagory_name'] ?>"><?php echo $item_catagory['catagory_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-field">
                                    <label class="form-label">Note</label>
                                    <input type="text" name="item_note[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1">
                            <div class="input-field">
                                    <label class="form-label">opt</label><br>
                                    <a class="btn btn-danger remove_btn">x</a>
                                </div>
                            </div>
                        </div>
            `);
        });

        $(document).on('click','.remove_btn',function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent().parent();
            $(row_item).remove();
        });
    })
</script>
</body>
</html>

<?php 
    }else { header('location: index.php'); } ;
?>