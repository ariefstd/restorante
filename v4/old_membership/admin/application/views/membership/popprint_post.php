<?php
$this->load->view('includes/header');
?>
<table>
	<tr>
		<td align="center"><br />
		<?php
		if($page>0){
		?>
		<ul id="pp">
		<?php 
		for($i=1;$i<=$page;$i++){
			$start = $i==1 ? "1" : ($i * $range) - ($range - 1);
			$end = ($i * $range >= $total) ? $total : ($i * $range);
		?>
		<li><a target="_blank" href="<?php echo base_url("index.php/membership/print_post/".$type."/".$i)?>"><?php echo $start?> - <?php echo $end?></a></li>
		<?php 
		} 
		?>
		</ul>
		<?php 
		}else{
		?>	
		No data
		<?php	
		}
		?>
		</td>
	</tr>
</table>
<?php
$this->load->view('includes/footer');
?>