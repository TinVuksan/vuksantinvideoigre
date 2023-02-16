<?php
    get_header();
    ?>
    
    
		<article class="content px-3 py-5 p-md-5">
		
		<div class="filteri">
			<form method="GET">
				<div class="row">
					<div class="form-group">
					<label id="filtriraj-naslov"for="orderby">Filtriraj po:</label>
					<select class="form-control" name="orderby" id="orderby">
						<option value="date" <?php echo selected($_GET['orderby'], 'date');?>>Najnovije do najstarijeg</option>
						<option value="title" <?php echo selected($_GET['orderby'], 'title');?>>Abecedno</option>
					</select>
					<button  class="btn btn-outline-info" type="submit">Filtriraj</button>
					</div> <!--form-group end-->
				
				<input
				id="order" 
				type="hidden"
				name="order"
				value="<?php echo (isset($_GET['order']) && $_GET['order'] = 'ASC') ? 'ASC' : 'DESC'; ?>"
				/>
				<div class="form-group">
				<div class="col-lg">
				<h4>Žanrovima</h4>
				<?php
				$terms = get_terms([
					'taxonomy' => 'zanr',
					'hide_empty' => false
				]);

				foreach($terms as $term) :
				?>

				<div class="form-check">
				<label class="form-check-label" for="checkBoxZanr">
					<input 
					id="checkBoxZanr"
					type="checkbox"
					name="zanr[]"
					class="form-check-input"
					value = "<?php echo $term->slug; ?>" 
					<?php checked(isset($_GET['zanr']) && in_array($term->slug, $_GET['zanr']))?>
					/>
					<?php echo $term->name; ?>
				</label>
				</div> <!--form-check end-->
				

				<?php endforeach;?>
				</div> <!--column end-->
				</div> <!--form group end-->
				
				
				<div class="form-group">
				<div class="col-lg">
				<h4>Konzolama</h4>
				<?php
				$terms = get_terms([
					'taxonomy' => 'konzola',
					'hide_empty' => false
				]);

				foreach($terms as $term) :
				?>

				<div class="form-check">
				<label class="form-check-label" for="checkboxKonzola">
					<input 
					id="checkboxKonzola"
					type="checkbox"
					name="konzola[]"
					class="form-check-input"
					value = "<?php echo $term->slug; ?>" 
					<?php checked(isset($_GET['konzola']) && in_array($term->slug, $_GET['konzola']))?>
					/>
					<?php echo $term->name; ?>
				</label>
				</div> <!--form-check end-->
				

				<?php endforeach;?>
				</div> <!--column end-->
				</div> <!--form group end-->

	
				<div class="form-group" id="search-form">
				<div class="col-lg">
				<?php get_search_form();?>
				</div>
				</div>

				</div> <!--row end-->
				
				
			
			</form>
		</div>

		<?php
		if(have_posts()) {
			while(have_posts()) {
				the_post();
				get_template_part('template-parts/content', 'archive');
			}
		}
		?>
		<div class="paginacija">
		<?php 
		global $wp_query;
		$big = 999999999;
		echo paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $wp_query->max_num_pages
		));
		?>
		</div>
	    </article>
    <?php
    get_footer();
    ?>
	    

