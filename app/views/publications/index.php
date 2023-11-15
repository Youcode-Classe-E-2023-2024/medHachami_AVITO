<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="app-container">
    <div class="sidebar-container">
        <ul class="sidebar-items">
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/home-icon.png" ><a href="" class="sidebar-link">Home</a></li>
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/add-icon.png" ><a href="<?php echo URLROOT; ?>/publications/add" class="sidebar-link">Add Publication</a></li>
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/users-icon.png" ><a href="" class="sidebar-link">View User</a></li>
        </ul>
    </div>
    <div class="publications-container">
        <?php foreach($data['publications'] as $pub) : ?>
        <div class="pub-card">
            <div class="pub-header">
                <div class="user-img">
                    <img src="<?php echo URLROOT; ?>/img/med hachami.jpg" >
                </div>
                <div class="user-details">
                    <p class="user-name1"><?php echo $pub->user_name;  ?></p>
                    <p class="user-city"><?php echo $pub->user_city; ?></p>
                </div>
            </div>
            <div class="thumb" style="" >
                <img src="<?php echo URLROOT; ?>/img/teambg.jpeg" alt="" class="" style="width: 100%;" >
            </div>
            <div class="pub-footer">
                <img src="<?php echo URLROOT; ?>/img/heart-icon.png" alt="" >
                <div class="row1">
                    <p class="user-name2"><?php echo $pub->user_name; ?></p>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elits.amet consectetur adipisicing elits. </p>
                </div>
                
            </div>
            
        </div>
        <?php endforeach; ?>
        
        
        
    </div>
    <div class="users-container">
        <h3>Discrover users</h3>
        <div class="user-row">
                <div class="user-img">
                    <img src="<?php echo URLROOT; ?>/img/med hachami.jpg" >
                </div>
                <h2>MedHachami</h2>
        </div>
        <div class="user-row">
                <div class="user-img">
                    <img src="<?php echo URLROOT; ?>/img/med hachami.jpg" >
                </div>
                <h2>MedHachami</h2>
        </div>
    </div>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

