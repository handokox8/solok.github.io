			 
						<?php
						if($widget_satu == "NULL"){
							echo "Belum ada widget";
						} else {
							foreach ($widget_satu as $widget1) {
								?>
									<div class="kolom-left-box">
										<?php echo $widget1->widget; ?>
									</div>
								<?php
							}

						}
						?>
						<div class="clear"></div>
				