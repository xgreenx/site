<body>
<?php include ("header.php"); ?>
<h2><?php echo $tour['name']; ?></h2>
	
					<div class='tour_content'>
                    	
                                        <h3><?php echo $tour['value']; ?></h3>
                                        <p>
                                                <?php echo $tour['summ_sign']; ?>
                                                <?php echo $tour['content']; ?>
                                    	</p>
                        </div> 
	<div class="slider">
		<div class="next"></div>
		<div class="prev"></div>
		<div class="slides">
			<?php $imgPath=Tour::getImages($tour['id_tour']);?>
			<?php foreach ($imgPath as $path):?>
			<div id='config' class="slide">
				<img src='<?php echo $path; ?>' />
			</div>
			<?php endforeach;?>
		</div>
	</div>                             
</body>
<?php include ("footer.htm"); ?>