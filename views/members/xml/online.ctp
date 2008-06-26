<classmates>
	<online>
		<?php
			echo $xml->serialize($classmates['Online']);
		?>
	</online>
	<away>
		<?php
			echo $xml->serialize($classmates['Away']);
		?>
	</away>
	<offline>
		<?php
			echo $xml->serialize($classmates['Offline']);
		?>
	</offline>
</classmates>