<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">{{$product->product_name}} - {{$product->sub_sku}}</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="form-group col-xs-12 @if(!auth()->user()->can('edit_product_price_from_sale_screen')) hide @endif">
					@php
					$pos_unit_price = !empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price;
					@endphp
					<label>@lang('sale.unit_price')</label>
					<input type="text" name="products[{{$row_count}}][unit_price]" class="form-control pos_unit_price input_number mousetrap" value="{{@num_format($pos_unit_price)}}" @if(!empty($pos_settings['enable_msp'])) data-rule-min-value="{{$pos_unit_price}}" data-msg-min-value="{{__('lang_v1.minimum_selling_price_error_msg', ['price' => @num_format($pos_unit_price)])}}" @endif>
				</div>
				@if(!auth()->user()->can('edit_product_price_from_sale_screen'))
				<div class="form-group col-xs-12">
					<strong>@lang('sale.unit_price'):</strong> {{@num_format(!empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price)}}
				</div>
				@endif
				<div class="form-group col-xs-12 col-sm-6 @if(!$edit_discount) hide @endif">
					<label>@lang('sale.discount_type')</label>
					{!! Form::select("products[$row_count][line_discount_type]", ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $discount_type , ['class' => 'form-control row_discount_type']); !!}
				</div>
				<div class="form-group col-xs-12 col-sm-6 @if(!$edit_discount) hide @endif">
					<label>@lang('sale.discount_amount')</label>
					{!! Form::text("products[$row_count][line_discount_amount]", @num_format($discount_amount), ['class' => 'form-control input_number row_discount_amount']); !!}
				</div>
				@if(!empty($discount))
				<div class="form-group col-xs-12">
					<p class="help-block">{!! __('lang_v1.applied_discount_text', ['discount_name' => $discount->name, 'starts_at' => $discount->formated_starts_at, 'ends_at' => $discount->formated_ends_at]) !!}</p>
				</div>
				@endif

				<!-- masukan rumus Kanan -->
				<!-- <label>Jauh</label> -->
				<div class="form-check form-group col-xs-12 col-sm-4 ">
					<label>RUMUS </label> 
				   <br>
 					<div class="form-check col-xs-12 col-sm-6">
						<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
						<label class="form-check-label" for="exampleRadios1">
							Jauh
						</label>
					</div>
					<div class="form-check col-xs-12 col-sm-6">
						<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
						<label class="form-check-label" for="exampleRadios2">
							Dekat
						</label>
					</div>
				</div>

				<div class="form-check form-group col-xs-12 col-sm-12 ">
  					<div class="form-check col-xs-12 col-sm-3">
					 <label class="form-label">BKL [R]</label>
					 <i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body" data-toggle="popover" data-placement="auto bottom" data-content="Pilih kekuatan lensa Kanan" data-html="true" data-trigger="hover" data-original-title=" Besaran Kekuatan Lensa" title=""></i>
					{!! Form::select("products[$row_count][line_discount_type]", ['sph' => "SPH", 'cly' => "CLY", 'axis' => "AXIS"], $discount_type , ['class' => 'form-control row_discount_type']); !!}
					</div>
					<div class="form-check col-xs-12 col-sm-3">
					<label class="form-label">SDO [R]</label><i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body" data-toggle="popover" data-placement="auto bottom" data-content="Masukan Satuan Diopsir Kanan" data-html="true" data-trigger="hover" data-original-title="Satuan Dioptri (D), " title=""></i>
					{{ Form::text('title', old('title'), ['class' => 'form-control','id' => 'ukkanan', 'placeholder' => 'Ukuran ', 'required']) }}

					</div>
 					<div class="form-check col-xs-12 col-sm-3">
					 <label class="form-label">BKL [L]</label>
					 <i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body" data-toggle="popover" data-placement="auto bottom" data-content="kekuatan lensa Kiri" data-html="true" data-trigger="hover" data-original-title=" Besaran Kekuatan Lensa" title=""></i>
					{!! Form::select("products[$row_count][line_discount_type]", ['sph' => "SPH", 'cly' => "CLY", 'axis' => "AXIS"], $discount_type , ['class' => 'form-control row_discount_type']); !!}
					</div>
					<div class="form-check col-xs-12 col-sm-3">
					<label class="form-label">SDO [L]</label>
					<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" data-container="body" data-toggle="popover" data-placement="auto bottom" data-content="Masukan Satuan Diopsir  Kiri" data-html="true" data-trigger="hover" data-original-title="Satuan Dioptri (D)" title=""></i>
					{{ Form::text('title', old('title'), ['class' => 'form-control','id' => 'ukkiri', 'placeholder' => 'Ukuran ', 'required']) }}

					</div>
				</div>
				 

				<!-- masukan rumus -->


				<div class="form-group col-xs-12 {{$hide_tax}}">
					<label>@lang('sale.tax')</label>

					{!! Form::hidden("products[$row_count][item_tax]", @num_format($item_tax), ['class' => 'item_tax']); !!}

					{!! Form::select("products[$row_count][tax_id]", $tax_dropdown['tax_rates'], $tax_id, ['placeholder' => 'Select', 'class' => 'form-control tax_id'], $tax_dropdown['attributes']); !!}
				</div>
				@if(!empty($warranties))
				<div class="form-group col-xs-12">
					<label>@lang('lang_v1.warranty')</label>
					{!! Form::select("products[$row_count][warranty_id]", $warranties, $warranty_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control']); !!}
				</div>
				@endif
				<div class="form-group col-xs-12">
					<label>@lang('lang_v1.description')</label>
					<textarea class="form-control" name="products[{{$row_count}}][sell_line_note]" rows="3">{{$sell_line_note}}</textarea>
					<p class="help-block">Keterangan lainnya</p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
		</div>
	</div>
</div>