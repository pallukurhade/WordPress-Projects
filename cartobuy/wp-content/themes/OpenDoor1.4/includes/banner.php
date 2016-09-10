<?php if ($banner != "Choose a banner:") { ?>


	<?php 
		$bannername = "";
		$bannercolor = "";
		$arr_banner = explode("|", $banner);
		$bannername=$arr_banner[0];
		if (count($arr_banner) == 2) {
		$bannercolor=$arr_banner[1];
		}
	?>

	<div class="banner" style="border-color: <?php echo $bannercolor ?>">
		<?php
			$bannertext = $bannername;
			
			if ($banner2 != "Choose a banner:") {
			
				//get just banner text, not possible color also
				$arr_banner2 = explode("|", $banner2);
				$bannername2 = $arr_banner2[0];
				$bannertext = $bannertext . ", " . $bannername2;
			}
		echo $bannertext; 
		?>
	</div>
<?php } ?>	