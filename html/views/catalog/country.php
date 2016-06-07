<head>
	<link rel="stylesheet" type="text/css" href="/style1.css">
</head>
<body>

<?php include ("header.htm"); ?>
                    <?php foreach ($tours as $tour): ?>
                    	<div class="sub_tour_desc">
                                        <h2><?php echo $tour['value']; ?></h2>
                                        <p>
                                                <?php echo $tour['country']; ?>
                                                <?php echo $tour['name']; ?>
                                    	</p>
                        </div>
                    <?php endforeach; ?>                              
                <!-- Постраничная навигация -->
                <div class = "sub_tour_desc"><?php echo $pagination->get(); ?></div>
</body>
<?php include ("footer.htm"); ?>