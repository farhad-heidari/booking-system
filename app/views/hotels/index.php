<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('hotel_message'); ?>
  <div class="row mb-3">
    <div class="col-md-6">
    <h1>Hotels</h1>
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <?php foreach($data['hotels'] as $hotel) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $hotel->name; ?></h4>
      <div class="bg-light p-2 mb-3">
      <div>
      <img src="<?php echo URLROOT.$hotel->image; ?>" class="img-thumbnail" alt="<?php echo $hotel->name; ?>" width="304" height="236">
      </div>
        Added on <?php echo $hotel->created_at; ?>
      </div>
      <p class="card-text"><?php echo $hotel->desc; ?></p>
        <hr>
        <form class="pull-right" action="<?php echo URLROOT; ?>/hotels
        <?php echo ($_SESSION['user_status'] == 0) ? '/book/' : '/approve/'?>
        <?php echo $hotel->id; ?>" method="post">
          <input type="submit" class="btn btn-block btn-success" 
          value="<?php echo ($_SESSION['user_status'] == 0) ? 'Book' : 'Approve'?>">
        </form>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>