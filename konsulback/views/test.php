<section>
	<?php 
foreach ($query->result() as $key ) {
	echo '<p>'.$key->isiPertanyaan.'</p>';
}
echo $this->pagination->create_links();
 ?>
</section>