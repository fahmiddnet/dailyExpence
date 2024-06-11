<?php
include('Layout/header.php');
include('db/connect.php');


    $show_sql = "SELECT * FROM date_time WHERE id=(SELECT max(id) FROM date_time);";
    $show_date_query = mysqli_query($conn,$show_sql);
    // print_r($show_date_query);


    $show_catagory = "SELECT * FROM catagory_e";
    $show_catagory_query = mysqli_query($conn,$show_catagory);
    $show_all_catagory = mysqli_fetch_all($show_catagory_query,MYSQLI_ASSOC);
    // print_r($show_all_catagory);

    if (mysqli_num_rows($show_date_query) > 0) {
        $show_all_post = mysqli_fetch_all($show_date_query, MYSQLI_ASSOC);
        // print_r($show_all_post);
      } else {
        // Handle the case where no posts were found or there was an error
        echo "No posts found or an error occurred.";
      }
?>

<section class="expeses-item">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="auth/expenceauth.php" method="POST" id="add_form">
                    <div class="mb-3">
                        <label for="date_time">Pick a Date</label>
                        <input type="date" name="item_date" class="form-control">
                    </div>
                    <div class="expense-item" id="expense_box_item">
                        <div class="row">
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
                            <div class="col-md-3">
                                <div class="input-field">
                                    <label class="form-label">Catagory</label><br>
                                    <select class="form-select" name="item_catagory[]"  aria-label="Default select example">
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
                            <div class="col-md-3">
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
                        </div>
            `);
        });

        $(document).on('click','.remove_btn',function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    })
</script>
</body>
</html>