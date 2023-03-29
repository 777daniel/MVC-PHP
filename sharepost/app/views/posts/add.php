<?php require APPROOT.'/views/inc/header.php';?>
<?php flash('post_message'); ?>
    <a href="<?php echo URL;?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
        <div class="card card-body bg-light mt-5">

            <h2>Add post</h2>
            <p> Add a post using this form</p>
            <form action="<?php echo URL;?>/posts/add" method="post">
        <div class="form_group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err']))?'is-invalid' :''; ?>" value="<?php echo $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err'];?></span>  
        </div>
        <div class="form_group md-3">
            <label for="body">Body: <sup>*</sup></label>
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err']))?'is-invalid' :''; ?>"><?php echo $data['body']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err'];?></span>  
</div>
  <input type="submit" class="btn btn-success md-3" value="submit">

        </form>
        </div>



<?php require APPROOT.'/views/inc/footer.php';?>