			 <div class="kolom-right">
						<?php
						if($widget_dua == "NULL"){
							echo "Belum ada widget";
						} else {
							foreach ($widget_dua as $widget2) {
								?>
									
										<?php echo $widget2->widget; ?>
									
								<?php
							}

						}
						?>
						<div class="clear"></div>
				</div>