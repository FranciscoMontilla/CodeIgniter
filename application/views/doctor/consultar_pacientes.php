<section>
	<div class="table-wrapper">
		<table>
			<thead>
				<tr>	
					<th>#</th>
					<th>Paciente</th>
					<th>Cita</th>
					<th>-</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$indice = 0;
					foreach ($citas as $item ): 
					?>
					<tr id="row<?php echo $item['cve']; ?>">
						<td><?php echo $indice+=1; ?></td>
						<td id=""><?php echo $item['nombre']." ".$item['pat']; ?></td>
						<td id=""><?php echo $item['hora']; ?></td>
						<td id="btnRe<?php echo $item['cve']; ?>">
							<input value="Atender" onclick="atender(<?php echo $item['cvecita']; ?>)" type="button" />
						</td>
					</tr>	
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>
<script type="text/javascript">
	function atender(cve){
	    location.href="<?php echo base_url();?>index.php/Doctor/verUpdateConsulta/"+cve;
	}
</script>
