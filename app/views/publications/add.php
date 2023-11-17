<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="app-container">
    <div class="sidebar-container">
        <ul class="sidebar-items">
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/home-icon.png" ><a href="<?php echo URLROOT; ?>/" class="sidebar-link">Home</a></li>
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/add-icon.png" ><a href="<?php echo URLROOT; ?>/publications/add" class="sidebar-link">Add Publication</a></li>
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/books-icon.png" ><a href="<?php echo URLROOT; ?>/publications/myPublication" class="sidebar-link">My publications</a></li>        </ul>
    </div>
    <div class="publications-container">
            <?php if(isset($_GET['action']) ){?>
                <div class="alert alert-primary" role="alert">
                    Publication added successfully
                </div>
            <?php }?>
            
        <form class="form" method="POST" action="<?php echo URLROOT; ?>/publications/add" enctype="multipart/form-data" >
            
            <div class="input-row">
                <span>title*</span>
                <input type="text" name="title" >
            </div>
            <div class="input-row">
                <span>Description*</span>
                <input type="text" name="description" >
            </div>
            <div class="input-row">
                <span>Price*</span>
                <input type="text" name="price" >
            </div>
            <div class="input-row">
                <span>Image*</span>
                <input type="file" name="image" name="image" >
            </div>
            <?php if (!empty($data['error'])) : ?>
                <div class="alert alert-danger"><?php echo $data['error']; ?></div>
            <?php endif; ?>
            <?php if (!empty($data['image_err'])) : ?>
                <div class="alert alert-danger"><?php echo $data['image_err']; ?></div>
            <?php endif; ?>
            <input type="submit" class="add-btn" value="Submit">
        </form>
    </div>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

