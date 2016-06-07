<head>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<?php include ("header.htm"); ?>
                    <h2>Lastest Tours : </h2>
                    <?php foreach ($tours as $tour): ?>
                    	<div class='tour_short_desc'>                    	
                    		<h2><?php echo $tour['name'];?></h2>
                        	<h4>From $<?php echo $tour['value'];?></h4>
                    		<div class='sub_tour_desc'>
                    			<img class='tour_img' src="<?php  echo Tour::getImages($tour['id_tour'])[0];?>"/>
                        			<p style="margin-left: 250px">
                               			<?php echo $tour['country'];?>
                               			<?php echo $tour['short_content'];?>
                               			
                        			</p>
                        			<a href="<?php echo 'tour/'.$tour['id_tour'];?>"> 
                        			<img class= 'learn_more_button' src="/img/learn-more.png" />
                        			</a> 
                       		</div>

                      </div>
                       <?php endforeach;?>        
                                    <!--    <a href="#" data-id="<?php echo $product['id'];?>"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>-->             

    

<?php include ("footer.htm"); ?>