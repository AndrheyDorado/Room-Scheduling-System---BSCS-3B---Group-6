<?php include 'db_connect.php' ?>

<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM faculty where id=".$_GET['id'])->fetch_array();
    foreach($qry as $k =>$v){
        $$k = $v;
    }
}
?>

<div class="container-fluid">
    <form action="" id="manage-faculty">
        <div id="msg"></div>
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" class="form-control">
        
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo isset($lastname) ? $lastname:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo isset($firstname) ? $firstname:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Middle Name</label>
                <input type="text" name="middlename" class="form-control" value="<?php echo isset($middlename) ? $middlename:'' ?>">
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Contact #</label>
                <input type="text" name="contact" class="form-control" value="<?php echo isset($contact) ? $contact:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Gender</label>
                <select name="gender" required class="custom-select">
                    <option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <label class="control-label">Address</label>
                <textarea name="address" class="form-control"><?php echo isset($address) ? $address : '' ?></textarea>
            </div>
        </div>
    </form>
</div>

<script>
    $('#manage-faculty').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_faculty',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Data successfully saved.",'success')
                    setTimeout(function(){
                        location.reload()
                    },1000)
                } else if(resp == 2){
                    $('#msg').html('<div class="alert alert-danger">ID No already existed.</div>')
                    end_load();
                }
            }
        })
    })
</script>