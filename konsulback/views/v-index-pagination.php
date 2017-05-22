

	
		<table class="table table-stiped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul Pertanyaan</th>
					<th>pertanyaan</th>    	
				</tr>
			</thead>
			<tbody>
                <?php $offset = $this->uri->segment(3, 0) + 1; ?>
                <?php foreach ($query->result() as $row): ?>
    				<tr>
    					<td><?php echo $offset++ ?></td>
    					<td><?php echo $row->judulPertanyaan ?></td> 
    					<td><?php echo $row->isiPertanyaan; ?></td>
    				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<nav class='text-center'>
            <?php echo $pagination_links; ?>
			<!-- <ul class="pagination">
				<li><a href="">1</a></li>
				<li><a href="">2</a></li>
				<li><a href="">3</a></li>
			</ul> -->
		</nav>
	
