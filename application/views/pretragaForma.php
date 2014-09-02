<div class="row">
	<div class="col-md-9 col-md-offset-2">
		<form role="form" style="width: 500px; margin: auto;" action="<?php echo base_url() . 'site/pretraziClanke/0';?>" method="get">
            <div id="kljucnaRecDiv" class="form-group">
              <label for="kljucnaRec">Kljucna rec: </label>
              <input type="text" class="form-control" id="kljucnaRec" name="kljucnaRec" placeholder="Unesite kljucnu rec za pretragu..." value="<?php echo set_value('kljucnaRec');?>"/>
            </div>
            <div id="kategorijeDiv" class="form-group">
              <label for="kategorije">Kategorije: </label>
              <div id="kategorije" class="dropdown">
              	<select name="kategorija" class="form-control">
              		<option value="0">----------</option>
              		<?php 
              			foreach($menu_items as $menuItem) {
              				echo '<option value="' . $menuItem->kategorijaID . '"> ' . $menuItem->naziv . '</option>';
              			}
              		?>
              	</select>
              </div>
            </div>
            <button type="submit" class="btn btn-default">Pretrazi</button>
          </form>
	</div>
	
</div>
