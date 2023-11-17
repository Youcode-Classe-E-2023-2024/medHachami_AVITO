<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="app-container">
    <div class="sidebar-container">
        <ul class="sidebar-items">
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/home-icon.png" ><a href="" class="sidebar-link">Home</a></li>
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/add-icon.png" ><a href="<?php echo URLROOT; ?>/publications/add" class="sidebar-link">Add Publication</a></li>
            <li class="sidebar-item"><img src="<?php echo URLROOT; ?>/img/books-icon.png" ><a href="<?php echo URLROOT; ?>/publications/myPublication" class="sidebar-link">My publications</a></li>
        </ul>
    </div>
    <div class="publications-container">
        
        <?php foreach($data['publications'] as $pub) : ?>
        <div class="pub-card">
            <div class="pub-header">
                <div class="user-img">
                    <img src="<?php echo URLROOT. "/img/" . $pub->user_img ; ?>" >
                    
                </div>
                <div class="user-details">
                    <p class="user-name1"><?php echo $pub->user_name;  ?></p>
                    <p class="user-city"><?php echo $pub->user_city; ?></p>
                </div>
            </div>
            <div class="thumb" style="" >
                <img src="<?php echo URLROOT . "/img/" . $pub->pub_img; ?>" class="" style="width: 100%;" alt="Publication Image">
            </div>
            <div class="pub-footer">
                
            <?php if (!$this->isLiked($pub->pub_id, $_SESSION['user_id'])) { ?>
                
                <img class="heart" src="<?php echo URLROOT; ?>/img/heart-icon.png" alt="" onclick="like(<?php echo $pub->pub_id; ?>, <?php echo $_SESSION['user_id']; ?>)" >
            <?php } else { ?>
                
                <img class="heart" src="<?php echo URLROOT; ?>/img/like-heart.png" alt="" onclick="like(<?php echo $pub->pub_id; ?>, <?php echo $_SESSION['user_id']; ?>)" >
            <?php } ?>  
                <div class="row1">
                    <p class="user-name2"><?php echo $pub->user_name; ?></p>
                    <p class="description"><?php echo $pub->pub_description; ?></p>
                    
                </div>
                <p class="timeDiff"><?php echo $pub->diffTime; ?></p>
                
            </div>
            
        </div>
        <?php endforeach; ?>
        
        
        
    </div>
    <div class="users-container">
        <h3>Discrover users</h3>
        <?php foreach($data['users'] as $user) : ?>
        <div class="user-row">
                <div class="user-img">
                    <img src="<?php echo URLROOT . "/img/" . $user->imgUrl; ?>" >
                </div>
                <h2><?php echo $user->name; ?></h2>
        </div>
        
        <?php endforeach; ?>
    </div>
    
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

