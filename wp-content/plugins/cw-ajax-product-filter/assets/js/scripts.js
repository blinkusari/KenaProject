jQuery(document).ready(function($) {
	// return false if cwapf_params variable is not found
	if (typeof cwapf_params === 'undefined') {
		return false;
	}

	// store widget ids those will be replaced with new data
	var widgets = {};

	$('.cwapf-ajax-term-filter').each(function(index) {
		var widget_id = $(this).attr('id');
		widgets[index] = widget_id;
	});

	// scripts to run before updating shop loop
	cwapfBeforeUpdate = function() {
		var overlay_color;
		
		if (cwapf_params.overlay_bg_color.length) {
			overlay_color = cwapf_params.overlay_bg_color;
		} else {
			overlay_color = '#fff';
		}

		var markup = '<div class="cwapf-before-update" style="background-color: ' + overlay_color + '"></div>',
			holder,
			top_scroll_offset = 0;

		if ($(cwapf_params.shop_loop_container.length)) {
			holder = cwapf_params.shop_loop_container;
		} else if ($(cwapf_params.not_found_container).length) {
			holder = cwapf_params.not_found_container;
		}

		if (holder.length) {
			// show loading image
			$(markup).prependTo(holder);
	
			// scroll to top
			if (typeof cwapf_params.scroll_to_top !== 'undefined' && cwapf_params.scroll_to_top == true) {
				var scroll_to_top_offset,
					top_scroll_offset;

				if (typeof cwapf_params.scroll_to_top_offset !== 'undefined' && cwapf_params.scroll_to_top_offset.length) {
					scroll_to_top_offset = parseInt(cwapf_params.scroll_to_top_offset);
				} else {
					scroll_to_top_offset = 100;
				}

				top_scroll_offset = $(holder).offset().top - scroll_to_top_offset;
				
				if (top_scroll_offset < 0) {
					top_scroll_offset = 0;
				}

				$('html, body').animate({scrollTop: top_scroll_offset}, 'slow');		
			}
		}

	}

	// scripts to run after updating shop loop
	cwapfAfterUpdate = function() {
		// Compatibility with YITH Wishlist Pro
		setTimeout( function(){
			$(document).trigger( 'yith_infs_added_elem' );
		}, 1000 );
	}

	// load filtered products
	cwapfFilterProducts = function() {
		// run before update function: show a loading image and scroll to top
		cwapfBeforeUpdate();
		$(document).trigger('cwapf_before_filtered');
		$.get(window.location.href, function(data) {
			var $data = jQuery(data),
				shop_loop = $data.find(cwapf_params.shop_loop_container),
				not_found = $data.find(cwapf_params.not_found_container),
				breadcrump = $data.find(cwapf_params.shop_breadcrumb_container),
				pagination = $data.find(cwapf_params.pagination_container),
				resultCount = $data.find(cwapf_params.shop_result_count_container);

			// replace widgets data with new data
			$.each(widgets, function(index, id) {
				var single_widget = $data.find('#' + id),
					single_widget_class = $(single_widget).attr('class');

				// update class
				$('#' + id).attr('class', single_widget_class);
				// update widget
				$('#' + id).html(single_widget.html());
			});

			// replace old shop loop with new one
			if (breadcrump.length) {
				$(cwapf_params.shop_breadcrumb_container).html(breadcrump.html());
			}
			if (resultCount.length) {
				$(cwapf_params.shop_result_count_container).html(resultCount.html());
			}
			if (pagination.length) {
				$(cwapf_params.pagination_container).html(pagination.html());
			}else{
				$(cwapf_params.pagination_container).html('');
			}
			if (cwapf_params.shop_loop_container == cwapf_params.not_found_container) {
				$(cwapf_params.shop_loop_container).html(shop_loop.html());
			} else {

				if ($(cwapf_params.not_found_container).length) {
					if (shop_loop.length) {
						$(cwapf_params.not_found_container).html(shop_loop.html());
					} else if (not_found.length) {
						$(cwapf_params.not_found_container).html(not_found.html());
					}
				} else if ($(cwapf_params.shop_loop_container).length) {
					if (shop_loop.length) {
						$(cwapf_params.shop_loop_container).html(shop_loop.html());
					} else if (not_found.length) {
						$(cwapf_params.shop_loop_container).html(not_found.html());
					}
				}
			}

			// reinitialize ordering
			cwapfInitOrder();

			// reinitialize dropdown filter
			cwapfDropDownFilter();

			// after update
			cwapfAfterUpdate();

			// run scripts after shop loop undated
			if (typeof cwapf_params.custom_scripts !== 'undefined' && cwapf_params.custom_scripts.length > 0) {
				eval(cwapf_params.custom_scripts);
			}
			$(document).trigger('cwapf_after_filtered');
		});
	}

	// URL Parser
	cwapfGetUrlVars = function(url) {
	    var vars = {}, hash;

	    if (typeof url == 'undefined') {
	    	url = window.location.href;
	    } else {
	    	url = url;
	    }

	    var hashes = url.slice(url.indexOf('?') + 1).split('&');
	    for (var i = 0; i < hashes.length; i++) {
	        hash = hashes[i].split('=');
	        vars[hash[0]] = hash[1];
	    }
	    return vars;
	}

	// if current page is greater than 1 then we should set it to 1
	// everytime we add new query to url to prevent page not found error.
	cwapfFixPagination = function() {
		var url = window.location.href,
			params = cwapfGetUrlVars(url);

		if (current_page = parseInt(url.replace(/.+\/page\/([0-9]+)+/, "$1"))) {
			if (current_page > 1) {
				url = url.replace(/page\/([0-9]+)/, 'page/1');
			}
		}
		else if(typeof params['paged'] != 'undefined') {
			current_page = parseInt(params['paged']);
			if (current_page > 1) {
				url = url.replace('paged=' + current_page, 'paged=1');
			}
		}

		return url;
	}

	// update query string for categories, meta etc..
	cwapfUpdateQueryStringParameter = function(key, value, push_history, url) {
		if (typeof push_history === 'undefined') {
			push_history = true;
		}

		if (typeof url === 'undefined') {
			url = cwapfFixPagination();
		}

		var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i"),
			separator = url.indexOf('?') !== -1 ? "&" : "?",
			url_with_query;
		
		if (url.match(re)) {
			url_with_query = url.replace(re, '$1' + key + "=" + value + '$2');
		}
		else {
			url_with_query = url + separator + key + "=" + value;
		}

		if (push_history === true) {
			return history.pushState({}, '', url_with_query);
		} else {
			return url_with_query;
		}
	}

	// remove parameter from url
	cwapfRemoveQueryStringParameter = function(filter_key, url) {
		if (typeof url === 'undefined') {
			url = cwapfFixPagination();
		}

		var params = cwapfGetUrlVars(url),
			count_params = Object.keys(params).length,
			start_position = url.indexOf('?'),
			param_position = url.indexOf(filter_key),
			clean_url,
			clean_query;

		if (count_params > 1) {
			if ((param_position - start_position) > 1) {
				clean_url = url.replace('&' + filter_key + '=' + params[filter_key], '');
			} else {
				clean_url = url.replace(filter_key + '=' + params[filter_key] + '&', '');
			}

			var params = clean_url.split('?');
			clean_query = '?' + params[1];
		} else {
			clean_query = url.replace('?' + filter_key + '=' + params[filter_key], '');
		}

		return clean_query;
	}

	// add filter if not exists else remove filter
	cwapfSingleFilter = function(filter_key, filter_val) {
		var params = cwapfGetUrlVars(),
			query;

		if (typeof params[filter_key] !== 'undefined' && params[filter_key] == filter_val) {
			query = cwapfRemoveQueryStringParameter(filter_key);
		} else {
			query = cwapfUpdateQueryStringParameter(filter_key, filter_val, false);
		}

		// update url
		history.pushState({}, '', query);
		
		// filter products
		cwapfFilterProducts();
	}

	// take the key and value and make query
	cwapfMakeParameters = function(filter_key, filter_val, url) {
		var params,
			next_vals,
			empty_val = false;

		if (typeof url !== 'undefined') {
			params = cwapfGetUrlVars(url);
		} else {
			params = cwapfGetUrlVars();
		}
	
		if (typeof params[filter_key] != 'undefined') {
			var prev_vals = params[filter_key],
				prev_vals_array = prev_vals.split(',');
			
			if (prev_vals.length > 0) {
				var found = jQuery.inArray(filter_val, prev_vals_array);

				if (found >= 0) {
				    // Element was found, remove it.
				    prev_vals_array.splice(found, 1);

				    if (prev_vals_array.length == 0) {
				    	empty_val = true;
				    }
				} else {
				    // Element was not found, add it.
				    prev_vals_array.push(filter_val);
				}

				if (prev_vals_array.length > 1) {
					next_vals = prev_vals_array.join(',');
				} else {
					next_vals = prev_vals_array;
				}
			} else {
				next_vals = filter_val;
			}
		} else {
			next_vals = filter_val;
		}

		// update url and query string
		if (empty_val == false) {
			cwapfUpdateQueryStringParameter(filter_key, next_vals);
		} else {
			var query = cwapfRemoveQueryStringParameter(filter_key);
			history.pushState({}, '', query);
		}

		// filter products
		cwapfFilterProducts();
	}

	// handle the filter request
	$('.cwapf-ajax-term-filter').not('.cwapf-price-filter-widget').on('click', 'li a', function(event) {
		event.preventDefault();
		var element = $(this),
			filter_key = element.attr('data-key'),
			filter_val = element.attr('data-value'),
			enable_multiple_filter = element.attr('data-multiple-filter');

		if (enable_multiple_filter == true) {
			cwapfMakeParameters(filter_key, filter_val);
		} else {
			cwapfSingleFilter(filter_key, filter_val);
		}

	});

	// handle the filter request for price filter display type list
	$('.cwapf-price-filter-widget.cwapf-ajax-term-filter').on('click', 'li a', function(event) {
		event.preventDefault();
		var element = $(this),
			filter_key_min = element.attr('data-key-min'),
			filter_val_min = element.attr('data-value-min'),
			filter_key_max = element.attr('data-key-max'),
			filter_val_max = element.attr('data-value-max'),
			query;

		if (element.parent().hasClass('chosen')) {
			query = cwapfRemoveQueryStringParameter(filter_key_min);
			query = cwapfRemoveQueryStringParameter(filter_key_max, query);

			if (query == '') {
				query = window.location.href.split('?')[0];
			}

			history.pushState({}, '', query);
		} else {
			query = cwapfUpdateQueryStringParameter(filter_key_min, filter_val_min, false);
			query = cwapfUpdateQueryStringParameter(filter_key_max, filter_val_max, true, query);
		}

		// filter products
		cwapfFilterProducts();
	});

	// handle the pagination request
	if (cwapf_params.pagination_container.length > 0) {
		var holder = cwapf_params.pagination_container + ' a';

		$(document).on('click', holder, function(event) {
			event.preventDefault();
			var location = $(this).attr('href');
			history.pushState({}, '', location);
			
			// filter products
			cwapfFilterProducts();
		});
	}

	// history back and forward request handling
	$(window).bind('popstate', function(event) {
		// filter products
		cwapfFilterProducts();
    });

    // ordering
    cwapfInitOrder = function() {
    	if (typeof cwapf_params.sorting_control !== 'undefined' && cwapf_params.sorting_control.length && cwapf_params.sorting_control == true) {
	    	$('.cwapf-before-products').find('.woocommerce-ordering').each(function(index) {
	    		$(this).on('submit', function(event) {
	    			event.preventDefault();
	    		});

	    		$(this).on('change', 'select.orderby', function(event) {
	    			event.preventDefault();

	    			var order = $(this).val(),
	    				filter_key = 'orderby';

	    			// change url
	    			cwapfUpdateQueryStringParameter(filter_key, order);

	    			// filter products
	    			cwapfFilterProducts();
	    		});
	    	});
    	}
    }

    // init ordering
    cwapfInitOrder();

    // remove active filters
    $(document).on('click', '.cwapf-active-filters a:not(.cwapf-reset)', function(event) {
    	event.preventDefault();
    	var element = $(this),
    		filter_key = element.attr('data-key'),
    		filter_val = element.attr('data-value');

    	if (typeof filter_val === 'undefined') {
	    	var query = cwapfRemoveQueryStringParameter(filter_key);
	    	history.pushState({}, '', query);

	    	// price slider
	    	if ($('#cwapf-noui-slider').length) {
	    		var priceSlider = document.getElementById('cwapf-noui-slider'),
	    			min_val = parseInt($(priceSlider).attr('data-min')),
	    			max_val = parseInt($(priceSlider).attr('data-max'));

	    		if (min_val && max_val) {
			    	if (filter_key === 'min-price') {
			    		priceSlider.noUiSlider.set([min_val, null]);
			    	} else if (filter_key === 'max-price') {
			    		priceSlider.noUiSlider.set([null, max_val]);
			    	}
	    		}
	    	}

	    	// filter products
	    	cwapfFilterProducts();
    	} else {
    		cwapfMakeParameters(filter_key, filter_val);
    	}
    });

    // clear all filters
    $(document).on('click', '.cwapf-active-filters a.cwapf-reset', function(event) {
    	event.preventDefault();

    	var location = $(this).attr('data-location');
    	history.pushState({}, '', location);

    	if ($('#cwapf-noui-slider').length) {
    		var priceSlider = document.getElementById('cwapf-noui-slider'),
    			min_val = parseInt($(priceSlider).attr('data-min')),
    			max_val = parseInt($(priceSlider).attr('data-max'));

    		if (min_val && max_val) {
    			priceSlider.noUiSlider.set([min_val, max_val]);
    		}
    	}

    	// filter products
    	cwapfFilterProducts();
    });

	// dispaly type dropdown
	function formatState(state) {
	    var depth = $(state.element).attr('data-depth'),
	    	$state = $('<span class="depth depth-' + depth + '">' + state.text + '</span>');
		
		return $state;
	}

	cwapfDropDownFilter = function() {
		if ($('.cwapf-select2-single').length) {
			$('.cwapf-select2-single').select2({
			    templateResult: formatState,
			    minimumResultsForSearch: Infinity,
			    allowClear: true
			});
		}

		if ($('.cwapf-select2-multiple').length) {
			$('.cwapf-select2-multiple').select2({
			    templateResult: formatState,
			});
		}

		$('.select2-dropdown').css('display', 'none');
	}

	// initialize dropdown filter
	cwapfDropDownFilter();

	$(document).on('change', '.cwapf-select2', function(event) {
		event.preventDefault();
		var filter_key = $(this).attr('name'),
			filter_val = $(this).val();

		if (!filter_val) {
			var query = cwapfRemoveQueryStringParameter(filter_key);
			history.pushState({}, '', query);
		} else {
			filter_val = filter_val.toString();
			cwapfUpdateQueryStringParameter(filter_key, filter_val);
		}

		// filter products
		cwapfFilterProducts();
	});
});