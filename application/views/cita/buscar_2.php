			<section>
				<h1><?php echo $title; ?></h1>		
<div class="table-wrapper">
	<table>
		<thead>
			<tr>	
				<th>Clave</th>
				<th>Nombre doctor</th>
				<th>fecha</th>
				<th>hora</th>
				<th>Actualizar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php $indice = 0; foreach ($citas as $item): ?>
				<tr id="row<?php echo $item['cve']; ?>">
					<td><?php echo $indice+=1; ?></td>
					<td id="tddesc<?php echo $item['cve']; ?>"><?php echo $item['nombre']." ".$item['apellido']; ?> </td>
					<td id="tddesc<?php echo $item['cve']; ?>"><?php echo $item['fecha']; ?> </td>
					<td id="tddesc<?php echo $item['cve']; ?>"><?php echo $item['hora']; ?></td>
					<td id="btnRe<?php echo $item['cve']; ?>">
							<input value="Actualizar" onclick="alertUpdate(<?php echo $item['cve']; ?>)" type="button" />
						</td>
						<td> <input value = "Borrar" type="button" onclick="alertDelete(<?php echo $item['cve']; ?>);"/></td>
				</tr>	
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</section>
<script type="text/javascript">
	function alertUpdate(cve){
	    location.href="<?php echo base_url();?>index.php/Cita/verUpdateCita/"+cve;
	}
	function alertDelete(cve){
	    if (confirm("¿Desas hacer eliminar este campo?") == true) {
	        location.href="<?php echo base_url();?>index.php/Cita/decit/"+cve;
	    }
	}
</script>
