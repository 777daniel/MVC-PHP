<?php require APPROOT.'/views/inc/header.php';?>

<a href="<?php echo URL;?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

<br>
<h1><?php echo $data['post']->title;?></h1>

<div class="bg-secondary text-white p-2 mb-3">
    Written By <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at;?>
</div>

<p><?php echo $data['post']->body;?></p>
<div class="row">
    <div class="col">
<?php if($data['post']->user_id == $_SESSION['user_id']):?>
<a href="<?php echo URL;?>/posts/edit/<?php echo $data['post']->id;?>" class="btn btn-dark">Edit </a>
</div>
<div class="col">
<form class="float-right" action="<?php echo URL;?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
<input type="submit" class="btn btn-danger" value="Delete">
</form>
</div>
</div>
<?php endif;?>
<?php require APPROOT.'/views/inc/footer.php';?>