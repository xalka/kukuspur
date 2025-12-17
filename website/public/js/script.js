/*
Author		:	Joshua Musyoka
Date 		: 	2nd April 2025
Title   	: 	Evet commerce
Company   	: 	Techxal ( techxal.com )
Customer    :   evet ( Benard )
*/

"use strict";

var loader = $('.loader'),
	evet = {

	redirect : function(page=null){
		if(page==null){ location.reload();
		} else { window.location.replace(page); }
	},

	loading : function(show=1){
		if(show){ loader.removeClass('invisible').addClass('visible')
		} else { loader.removeClass('visible').addClass('invisible')};
	},

	pageload : function(){
		evet.loading(0);
		$('body').removeClass("invisible").addClass("visible");
	},

	history : function(page,url){
		var obj = { page: page, url: url };
		history.pushState(obj, obj.page, obj.url);
	},

	popstate : function(){
		$(window).on('popstate',function(e){
	        var state = e.originalEvent.state,
	        	url = location.pathname+location.search;

	        if(state !== null){
				$.ajax({
					url : url,
					headers: {"X-Header-xaltype": "precise"},
					beforeSend: function(){
						xal.loading(1);
					},
					success : function(results){
						// console.log(results);
						$('section#content').html(results);
					},
					error : function(){
						console.log('error');
						alert('Hello');
						xal.redirect(window.location.pathname);
					}
				});
	        } else {
				xal.redirect(window.location.pathname);
	        }
		});



		$(window).on('popstate',function(e){
	        var state = e.originalEvent.state,
	        	url = location.pathname+location.search;
	        if(state !== null){
				// $('section').html(state.page);
				HMS.loading(1);
				$.get(url,function(resp,status){
					$('section').html(resp);
					HMS.loading(0);
				});
	        } else {
				HMS.redirect(window.location.pathname);
	        }
		});
	},

	ajaxPage : function(url){
		$.ajax({
			url : url,
			headers: {"X-Loadtype": "precise"},
			beforeSend: function(){
				evet.loading(1);
				$('.loadingOverlay').removeClass('hidden');
			},
			success : function(results,textStatus,xhr){
				if(results.includes('action="/login"') && url != '/login'){
					window.location.reload();
				}
				
				// $('section.main-content').html(results);

				let $mainContent = $('.main-content');
				$mainContent.addClass('opacity-0 scale-95 transition-all duration-300 ease-out');
				setTimeout(() => {
					$mainContent.html(results);
				 	$mainContent.removeClass('opacity-0 scale-95').addClass('opacity-100 scale-100 transition-all duration-300 ease-in');
					evet.history(results,url);
					evet.plugins();
				},150);	
				
				$("html, body").animate({ scrollTop: 0 }, "fast");
				setTimeout(()=>{
					$('.loadingOverlay').addClass('hidden');
				},3000);
				// evet.history(results,url);
				// evet.plugins();
			},
			error : function(){
				console.log('error');
			},
			complete : function(){
				$('.loadingOverlay').addClass('hidden');
			}
		});
	},

	quickLoad : function(){
		// $(document).on('click','aside#sidebar a[data-href]',function(evt){
		// $(document).on('click','*[data-href]',function(evt){
		$(document).on('click','a',function(evt){
			evt.preventDefault();
			var de = $(this),
				url = de.attr('href'); 
			if(url=='/logout'){
				window.location.href = '/logout';
				return true;
			}
			if(de.attr('data-tab')){
				return false;
			}
			evet.ajaxPage(url);
		});
	},

	checkboxToggleAll : function(event,closest='table'){
		var target = $(event.target);
		target.closest(closest).find('input[name="perms[]"]').prop("checked",target.prop("checked"));
	},

	passwordEyeToggle : function(){
		$(document).on('click','.password-toggle',function(){
			var toggler = $(this),
				password = toggler.closest('.input-password').find('input[name="password"]');
			toggler.toggleClass('fa-eye-slash fa-eye');
			password.attr('type',password.attr('type')=='password'?'text':'password');
		});
	},

	modal : function(){
		$(document).on('click','*[data-modal-href]',function(evt){
			var de = $(this),
				// modal = $(de.attr('data-modal-target')),
				modal = $('#modal'),
				// url = de.attr('data-modal-href'),
				// modalsize = de.closest('.modal-size'),
				size = de.attr('data-size') ?? '',
				title = de.attr('data-title');

			modal.removeClass('hidden'); // console.log(size); return false;

			$.ajax({
				url : de.attr('data-modal-href'),
				type : 'GET',
				headers: {"X-Header-Type": "modal"},
				beforeSend: function(){
					modal.find('.modal-title').text(title);
					// modal.find('.modal-content').addClass('opacity-0 scale-90 transition-all duration-300');
					// modal.find('.modal-dialog').addClass('modal-'+trigger.attr('data-modal-size'));
					// modal.find('.modal-dialog').removeClass('modal-sm modal-lg modal-xl');
					// modal.find('h3.modal-title').text(title);
					// modal.find('.modal-header').removeClass('invisible');
				},
				success : function(dom){ 
					if(dom.includes('action="/login"')){
						window.location.reload();
					}					
					setTimeout(() => {
						// modal.find('.modal-dialog').addClass('modal-'+size);
						// modal.find('.modal-body').html(results);
						// modal.find('.modal-footer').removeClass('invisible');
						modal.find('.modal-content').removeClass('opacity-0 scale-90').addClass('opacity-100 scale-100 transition-all duration-300');
						// modal.find('.modal-size').addClass(size);
						if(size=='lg'){
							modal.find('.modal-size').addClass('w-4/6, lg:w-2/3').removeClass('lg:w-1/3');
						}

						modal.find('.modal-content').html(dom);
						evet.plugins();
					},300);
				},
				error : function(){
					console.log('error');
				},
			});		

			// Trigger to close the modal
			modal.find('button[data-close="true"]').click(function(){
				evet.modalclose(modal);
			});				

		});		
	},

	modalclose : function(modal=null){
		if(modal==null){
			modal = $('#modal');
		}
		modal.addClass('hidden');
		modal.find('.modal-content').html('<div class="flex flex-col items-center justify-center mt-4"> \
                            <svg class="animate-spin h-8 w-8 text-blue" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"> \
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle> \
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path> \
                            </svg> \
                            <p class="mt-6 text-gray">Please wait...</p> \
                        </div>');
		// modal.find('[class*="w-"]').removeClass(function(index, className) {
		// 	return className.split(" ").filter(c => c.startsWith("w-")).join(" ");
		// });
		//modal.find('.modal-size').addClass('xs:w-11/12 sm:w-11/12 md:w-4/5 lg:w-1/3');
		modal.find('.modal-size').addClass('w-4/6, lg:w-1/3').removeClass('lg:w-2/3');
	},

	tabs : function(){
		$(".tab-button").on("click", function() {
			let tabId = $(this).data("tab");
			$(".tab-button").removeClass("active").addClass("inactive");
			$(this).removeClass("inactive").addClass("active");

			$(".tab-content").addClass("hidden");
			$("#" + tabId).removeClass("hidden");
		});

		// Nested Tabs Functionality
		$(".tab-button-nested").on("click", function() {
			let nestedTabId = $(this).data("nested-tab");
			$(".tab-button-nested").removeClass("active").addClass("inactive");
			$(this).removeClass("inactive").addClass("active");

			$(".tab-content-nested").addClass("hidden");
			$("#" + nestedTabId).removeClass("hidden");
		});		
	},

	modalloadingdom : function(){
		return '<div class="d-flex justify-content-center m-5"> \
					<div class="spinner-border" role="status"> \
						<span class="visually-hidden">Loading...</span> \
					</div> \
				</div>';
	},

	numberFormat : function(){
		$.each($('.money'),function(key,value){
			var de = $(this);
			// console.log( parseInt( de.text()) );
			de.text(Number(de.text()).toLocaleString('en'));
		});
	},

	tagsinput: function(){
		var input = document.querySelector('input[data-role=tagsinput]');
		//var input = $('input[data-role="tagsinput"]');
		new Tagify(input);
	},

	ajaxSelectSearch : function(domClass,url,id,text,subtext){
		if($('select.'+domClass).length){
			$('.selectpicker')
				.selectpicker({liveSearch : true})
				.filter('.with-ajax.'+domClass)
				.ajaxSelectPicker({
					ajax: {
						url: url,
						type: 'GET',
						dataType: 'json',
						data: {
							name: '{{{q}}}'
						}
					},
					preprocessData: function (data) {
						var i, l = data.length, array = [];
						if (l) {
							for (i = 0; i < l; i++) {
								array.push($.extend(true,data[i],{
									text : data[i][text],
									value: data[i][id],
									data : {
										subtext: data[i][subtext]
									}
								}));
							}
						}
						return array;
					},
					preserveSelected: false
				});			
		};
	},

	plugins : function(){
		var tabButtons = $(".tab-button"),
			tabPanes = $(".tab-pane");
			
		tabButtons.on("click", function () {
			var tabId = $(this).data("tab");
			tabButtons.removeClass("active");
			tabPanes.removeClass("active");
			$(this).addClass("active");
			$("#"+tabId).addClass("active");
		});


		// $('input[date-plugin="datetime"]').datetimepicker({
		//     format: 'yyyy-mm-dd'
		// // });
		// $('input[date-plugin="datetime"]').datetimepicker({
		// 	container: 'body',
		// 	language: 'en',
		// 	pickerPosition: 'bottom-right',
		// 	// initialDate: new date(),
		// 	format: 'mm/dd/yyyy',
		// });

	   	// $('input[data-date="datetimepicker"]').datetimepicker();
		// this.tagsinput();

	   		// format: 'HH:mm DD-MM-YYYY',
	   		// initialDate: Date.now(),
	 //        format: "dd MM yyyy - hh:ii",
	 //        autoclose: true,
	 //        todayBtn: true,
	 //        startDate: "2013-02-14 10:00",
	 //        minuteStep: 10
		// });
			// .val( $(this).val().format('HH:mm DD-MM-YYYY') );
			// .val( moment().format('HH:mm DD-MM-YYYY') );


		// $('input[data-date="datepicker"]').datepicker()

		// //evet.numberFormat();
		// var location = window.location.pathname;
		// // console.log(location);
		// // ?action=select&activity=users&naming=fname&id=providerId
		// evet.ajaxSelectSearch('select-guarantor',location+'?action=guarator&view=json','guarantorId','member','phone');
		// evet.ajaxSelectSearch('select-bank',location+'?action=bank&view=json','bankId','bank');

		if($('.datepicker').length){
			flatpickr(".datepicker", {
				dateFormat: "Y-m-d",
				enableTime: false,
				theme: "light"
			});
		}

		if($('.datetimepicker').length){
			flatpickr(".datetimepicker", {
				dateFormat: "Y-m-d H:i",
				enableTime: true,
				time_24hr: true,
				theme: "light",
				defaultDate: (() => {
					let now = new Date();
					now.setMinutes(now.getMinutes()+30);
					return now;
				})()				
			});
		}

		evet.dashboard();
		evet.tabs();
		evet.formNotificationDom();
		evet.calcAmountSMS();
		evet.passwordEyeToggle();
		evet.initMap();
	},

	submitstatus : function(event,name='status',value=0){
		var target = $(event.target),
			form = target.closest('form'); // console.log(form.find('input[name="status"]').val());
		// $(form+' input[name="'+name+'"]').val(value);
		form.find('button[type="submit"]').attr('type',null);
		form.find('input[name="statusId"]').val(value);
		form.find('button[data-type="'+value+'"]').attr('type','submit');
		// $(form+' input[data-type="'+value+'"]').attr('type','submit');
		// $(form+' input[name="'+value+'"]').val(status);
	},

	formloading : function(form,show=1,text=null){
		if(show){ text = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...' };
		form.find('*[type="submit"]').html(text);
	},

	submitForm: function(){
		$(document).on('submit','form',function(evt){
			evt.preventDefault();

			const form = $(this),
				  notification = form.find('div[data-class="form-notification"]'),
				  submitButton = form.find('button[type="submit"]'),
				  btnText = submitButton.html();

			let data;
			
			// Check for specific form handling
			if (form.hasClass("submit-json")) {
				// const group = {
				// 	title: form.find('input[name="title"]').val(),
				// 	contacts: form.find('tbody tr').map(function () {
				// 		const de = $(this);
				// 		return {
				// 			phone: de.find('input[name="phone"]').val(),
				// 			names: de.find('input[name="names"]').val(),
				// 		};
				// 	}).get(),
				// };

				// data = JSON.stringify(group);
				return false;

			} else if (form.attr("enctype") == "multipart/form-data") {
				data = new FormData(this);

			} else {
				data = form.serialize();
			}

			// AJAX request
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				// dataType: 'json',
				data: data,		
				beforeSend: function () {
					// notification.removeClass('hidden');
					notification.removeClass('hidden').addClass('info-box').html('<p>Processing  <span class="dots"></span></p>'); // .text('Successful');
					form.find('*[data-error]').addClass('hidden');
					evet.formloading(form, 1);
				},
				success: function (results){
					if(form.attr('data-filter') === 'true') {
						$('.table-div').html(results);
						// pushState
					} else {
						evet.handleFormSuccess(results, form, notification);
					}
				},
				error: function () {
					notification.removeClass('hidden').addClass('error-box').find('p').text('Technical problems, try again');
				},
				complete: function () {
					evet.formloading(form, 0, btnText);
					submitButton.prop('disabled', false);
					evet.plugins();
				},
				...(form.find('input[type="file"]').length > 0 ? { contentType: false, processData: false } : {})
			});
		});
	},

    handleFormSuccess: function (results, form, notification) {
        let delayTime = results?.delay ?? 2000; // console.log(results); return true;

        /*if (results?.confirm !== undefined) {
            form.find('input[name="paymentId"]').val(results.paymentId);
			// let btnSubmit = form.find('button[type="submit"]');
			// notification.removeClass('hidden').addClass('info').find('p').html('Processing  <span class="dots"></span>');
			notification.removeClass('info-box').addClass('error-box').html('Technical error'); // .text('Successful');
			// form.find('input[name="phone"], input[name="amount"]').prop('disabled', true);
			// btnSubmit.addClass('hidden');
			// evet.confirmMpesaPayment(results.paymentId,notification,btnSubmit);

        } else  */
		
		if ([200,201].includes(results?.status)){
			notification.removeClass('info-box').addClass('success-box').html('Successful');
			if(results.confirm){
				notification.removeClass('success-box').addClass('info-box').text('Check your phone to complete the payment');
				return false;
			}
            if(delayTime){
                setTimeout(() => {
                    if (results.url) {
                        evet.ajaxPage(results.url);
                    } else {
                        location.reload(true);
                    }
                }, delayTime);
            } 
			if (results.url !== undefined) {
                evet.redirect(results.url);
            }

		} else if ([400,401,402,403].includes(results?.status)) {  
            if (results.message && results.message.length > 0) notification.removeClass('hidden info-box').addClass('error-box').find('p').text(results.message);
            if (results.errors) {
                $.each(results.errors, function (key, value) {
                    form.find(`*[data-name="${key}"]`).addClass('error').text(value);
                });
            }

        } else {
            notification.removeClass('hidden info-box').addClass('error-box').find('p').text(results.message?? 'Technical problems, try again');
            // if (results.errors) {
            //     $.each(results.errors, function (key, value) { console.log(key); console.log(value);
            //         form.find(`*[data-name="${key}"]`).addClass('error').text(value);
            //     });
            // }
        }
    },	

	previewImage: function () {
		$(document).on('change', 'input[name="imgs[]"]', function() { // Target the input with the array name
			let $input = $(this);
			let $previewContainer = $('.preview-images'); // Assuming a container to hold multiple previews
			$previewContainer.empty(); // Clear any existing previews
	
			if ($input[0].files) {
				let files = $input[0].files;
	
				for (let i = 0; i < files.length; i++) {
					let file = files[i];
	
					if (file.type.startsWith('image/')) { // Only process image files
						let reader = new FileReader();
						let $img = $('<img>').attr('src', '#').addClass('preview-item'); // Create an image element for each preview
	
						reader.onload = function(e) {
							$previewContainer.append(evet.previewImageDiv(e.target.result));
							// $img.attr('src', e.target.result);
						}
	
						reader.readAsDataURL(file);
						// $previewContainer.append($img); // Add the image to the preview container
					}
				}
			} else {
				$previewContainer.empty(); // Clear previews if no files are selected
			}
		});
	},	

	previewImageDiv : function(src){
		return '<div class="relative"> \
                    <img src="'+src+'" class="h-24 w-full object-cover rounded-md border"> \
                    <button class="absolute top-1 right-1 p-1 bg-white text-red rounded-full hover:bg-red-600"> \
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"> \
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/> \
                        </svg> \
                    </button> \
                </div>';
	},

	removePreviousErrors: function () {
		$(document).on('input','input',function(){
			$(this).closest('.form-control').find('[data-name]').removeClass('error').text('');
		});
	},

	shoppingCartAdd : function(){
		$(document).on('click','*[data-add-cart]',function(){
			let de = $(this);

			$.ajax({
				url: '/cart?action=modify', // Or a more specific update endpoint
				method: 'POST',
				data: {
					productId: de.attr('data-add-cart'),
					qty: 1
				},
				success: function(response) {
					if(response.status == 201){
						$('.cart-item-count a').text(response.cartCount);
						de.closest('.item-details').find('input[name="qty"]').val(1);
					}
					console.log("Cart updated successfully:", response);
					// Optionally update UI elements based on the response
				},
				error: function(xhr, status, error) {
					console.error("Error updating cart:", error);
					// Optionally revert the UI change or display an error message
				}
			});
		});
	},

	buyNow : function(){
		$(document).on('click','*[data-buy]',function(){
			let de = $(this);

			$.ajax({
				url: '/cart?action=modify',
				method: 'POST',
				data: {
					productId: de.attr('data-buy'),
					qty: 1
				},
				success: function(response) {
					if(response.status == 201){
						$('.cart-item-count a').text(response.cartCount);
						evet.redirect('/checkout');
					}
					console.log("Cart updated successfully:", response);
					// Optionally update UI elements based on the response
				},
				error: function(xhr, status, error) {
					console.error("Error updating cart:", error);
					// Optionally revert the UI change or display an error message
				}
			});
		});
	},

	increaseItemCart : function(){
		$(document).on('click','*[data-increase]',function(){
			let de = $(this),
				qtyInput = de.parent().find('input[name="qty"]'),
				currentQty = parseInt(qtyInput.val());
			
			if(isNaN(currentQty) || currentQty == 0){
				qtyInput.val(1);
				currentQty = 1;
				qtyInput.val(currentQty);
			} else {
				qtyInput.val(currentQty+=1);
			}

			$.ajax({
				url: '/cart?action=modify', // Or a more specific update endpoint
				method: 'POST',
				data: {
					productId: de.attr('data-increase'),
					qty: qtyInput.val()
				},
				success: function(response) {
					$('.cart-item-count a').text(response.cartCount);
					if($(location).attr('pathname')=='/cart'){
						evet.cartSummaryUpdate();
					}
				},
				error: function(xhr, status, error) {
					console.error("Error updating cart:", error);
					// Optionally revert the UI change or display an error message
				}
			});
		});
	},

	decreaseItemCart : function(){
		$(document).on('click','*[data-decrease]',function(){
			let de = $(this),
				qtyInput = de.parent().find('input[name="qty"]'),
				currentQty = parseInt(qtyInput.val());
			
			qtyInput.val(currentQty-=1);
			
			$.ajax({
				url: '/cart?action=modify',
				method: 'POST',
				data: {
					productId: de.attr('data-decrease'),
					qty: qtyInput.val()
				},
				success: function(response) {
					$('.cart-item-count a').text(response.cartCount);
					if($(location).attr('pathname')=='/cart'){
						evet.cartSummaryUpdate();
					}
					if(currentQty==0){
						de.closest('tr').remove();
					}
				},
				error: function(xhr, status, error) {
					console.error("Error updating cart:", error);
					// Optionally revert the UI change or display an error message
				}
			});
		});
	},

	omitItemCart : function(){
		$(document).on('click','*[data-omit]',function(){
			var de = $(this);

			$.ajax({
				url: '/cart?action=modify', // Or a more specific update endpoint
				method: 'POST',
				data: {
					productId: de.attr('data-omit'),
					qty: 0
				},
				success: function(response) {
					$('.cart-item-count a').text(response.cartCount);
					if($(location).attr('pathname')=='/cart'){
						evet.cartSummaryUpdate();
					}
				},
				error: function(xhr, status, error) {
					console.error("Error updating cart:", error);
					// Optionally revert the UI change or display an error message
				}
			});
		});
	},	

	qtyDirectly : function(){
		$(document).on('change','input[name="qty"]',function(){
			let de = $(this),
				qty = de.val();

			$.ajax({
				url: '/cart?action=modify',
				method: 'POST',
				data: {
					productId: de.attr('data-productId'),
					qty: qty
				},
				success: function(response) {
					$('.cart-item-count a').text(response.cartCount);
					de.closest('.item-details').find('input[name="qty"]').val(qty);
					if($(location).attr('pathname')=='/cart'){
						evet.cartSummaryUpdate();
					}
				},
				error: function(xhr, status, error) {
					console.error("Error updating cart:", error);
					// Optionally revert the UI change or display an error message
				}
			});
		});
	},

	cartSummaryUpdate : function(){
		$.ajax({
			url: '/cart?cart=summary',
			method: 'GET',
			success: function(response){
				var cartSummary = $('aside.cart-summary'); 
				cartSummary.find('span[data-class="subtotal"]').text(response.totals.subtotal);
				cartSummary.find('span[data-class="discount"]').text(response.totals.totalDiscount);
				cartSummary.find('span[data-class="tax"]').text(response.totals.totalTax);
				cartSummary.find('span[data-class="shipping"]').text(response.totals.shipping);
				cartSummary.find('span[data-class="total"]').text(response.totals.grandTotal);
			},
			error: function(xhr, status, error) {
				console.error("Error updating cart:", error);
				// Optionally revert the UI change or display an error message
			}
		});
	},

	initMap : function(){
		if ($("#map").length > 0){
			let map, marker;
			const defaultLocation = { lat: -1.286389, lng: 36.817223 }; // Nairobi

			map = new google.maps.Map($("#map")[0],{
				center: defaultLocation,
				zoom: 8,
			});
		
			map.addListener("click", function (event) {
				const lat = event.latLng.lat();
				const lng = event.latLng.lng();
			
				$("input[name='latitude']").val(lat); // $("#latitude").val(lat);
				$("input[name='longitude']").val(lng); // $("#longitude").val(lng);
			
				if (marker) {
					marker.setMap(null); // remove old marker
				}
			
				marker = new google.maps.Marker({
					position: { lat, lng },
					map: map,
				});
			});
		};
	},





	confirmMpesaPayment : function(paymentId,notification,btnSubmit){
		var trials = 0;
		let interval = setInterval(function(){
			let req = {'view' : 'json','status' : true,'paymentId' : paymentId};
			$.get('/payment', req, function(results){ console.log(trials);
				if(results.status=='approved'){  console.log(results);
					notification.removeClass('info').addClass('success').find('p').text('Successful');
					clearInterval(interval);
					evet.ajaxPage('/payment');
					evet.modalclose();
				} else if(results.status=='processing'){
					if(trials>10){
						notification.removeClass('info').addClass('error-box').find('p').text('Technical problems, try again');
						clearInterval(interval);
						btnSubmit.removeClass('hidden');
					}
					trials++;
				} else {
					notification.removeClass('info').addClass('error-box').find('p').text('Technical problems, try again');
					clearInterval(interval);
					btnSubmit.removeClass('hidden');
				}
			})
		},4000);
	},

	mpesastatusresubmit : function(){
		return '<span class="btn btn-success p-2" data-submit="confirm">Confirm</span> \
				<span class="btn-evetaccount text-white border border-warning p-3" data-submit="stkpush">Re-Mpesa</span>';
	},

	// confirm mpesa payment
	stkpushconfirm : function(){
		$(document).on('click','span[data-submit="confirm"]',function(){
			var form = $(this).closest('form'),
				notification = form.find('p[data-class="form-notification"]'),
				data = {
					'view' : 'json',
					'phone' : form.find('input[name="phone"]').val(),
					'MerchantRequestID' : form.find('input[name="MerchantRequestID"]').val(),
					'CheckoutRequestID' : form.find('input[name="CheckoutRequestID"]').val()
				};

			evet.formloading(form,1);

			$.get('/payment',data,function(results,status){
				if($.isArray(results) && results.length === 0){
					notification.text('Please re-try the payment').addClass('alert alert-warning');

					console.log(status);
					console.log(results);

					// notification.empty().removeClass();
					evet.formloading(form,0);
				} else {
					console.log(results[0]);
					if(results[0].status=='approved'){
						notification.text('Successful').addClass('alert alert-success');
						setTimeout(function(){
							evet.redirect(window.location.pathname);
						},2000);						
					} else {
						notification.text('The payment is '+results[0].status).addClass('alert alert-info');
					}
				}
			});
				
		});
	},

	// remove
	stkpush : function(){
		$(document).on('click','span[data-submit="stkpush"]',function(evt){
			evt.preventDefault();
			var de = $(this),
				form = de.closest('form'),
				notification = form.find('p[data-class="form-notification"]');

			var data = {
				'contributionId' : form.find('input[name="contributionId"]').val(),
				'phone' : form.find('input[name="phone"]').val(),
				'amount' : form.find('input[name="amount"]').val(),
				'userId' : form.find('select[name="userId"]').val(), 
				'description' : form.find('textarea[name="description"]').val()
			}; 

			$.ajax({
				dataType: "json",
				url : '/contribution?action=re-mpesa',
				type : 'POST',
				// headers: {
				// 	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				// },
				data : data,
				beforeSend: function(){				
					notification.empty().removeClass();
					evet.formloading(form,1);
				},
				success : function(results){
					if(results.code==201){
						form.find('input[name="MerchantRequestID"]').val(results.MerchantRequestID);
						form.find('input[name="CheckoutRequestID"]').val(results.CheckoutRequestID);
						notification.text(results.message).addClass('alert alert-info');
					} else {
						notification.text(results.message).addClass('alert alert-warning');
					}
				},
				error : function(){
					notification.text('Technical problems, try again').addClass('error-box');
					// xal.loading(0);
				},
				complete : function(){
					// evet.formloading(form,0,btnText);
					// form.find('button[type="submit"],button[type="null"]').prop('disabled',false);
					evet.plugins();
				}				
			});

		});
	},

	stkstatus : function(form){ console.log(form);
		var loop = true;
		//while(loop){
			var data = {
				'view' : 'json',
				'phone' : form.find('input[name="phone"]').val(),
				'MerchantRequestID' : form.find('input[name="MerchantRequestID"]').val(),
				'CheckoutRequestID' : form.find('input[name="CheckoutRequestID"]').val()
			};

			setInterval(function(){
				$.get('/payment',data,function(results,status){
					if($.isArray(results) && results.length === 0){
						console.log('failed, re-initiate stk push');
						// $("span").html(result);
						
					} else {
						console.log(results);
						console.log(status);
						loop = false;
						return true;
					}
				});
			},5000);
		//}
	},

	dashboard : function(){
		let lineChart = $('#lineChart');
		if(lineChart.length){
			const chart = lineChart[0].getContext('2d');
			
			lineChart = new Chart(chart, {
			  	type: 'line',
				data: {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // X-axis labels
					datasets: [
						{
							label: 'SMS Sent',
							data: [1200, 1500, 1000, 1800, 2000, 2300, 1900],
							borderColor: '#10B981', // Tailwind green-500
							backgroundColor: 'rgba(16, 185, 129, 0.2)', // Semi-transparent green
							tension: 0.4, // Smoothing the line
							fill: true,
						},
						{
							label: 'Payments Done ($)',
							data: [800, 1200, 1100, 1500, 1700, 1900, 2100],
							borderColor: '#3B82F6', // Tailwind blue-500
							backgroundColor: 'rgba(59, 130, 246, 0.2)', // Semi-transparent blue
							tension: 0.4,
							fill: true,
						}
					]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					fullSize: true,
					// animations: {
					// 	tension: {
					// 	  	duration: 1000,
					// 	  	easing: 'linear',
					// 	  	from: 1,
					// 	  	to: 0,
					// 	  	loop: true
					// 	}
					// },					
					scales: {
						x: {
							grid: { display: false }
						},
						y: {
							grid: { color: '#E5E7EB' }
						}
					}
				},
				plugins: {
					legend: {
						position: 'top'
					}
				}
			});
		}
	},

	asideActiveLink : function(){
		$(document).on('click', 'aside a > .aside-link', function(){
			// Apply fade-out effect to the current active link
			$('.aside-link.active').removeClass('active').addClass('opacity-0');
			
			// Wait for the fade-out to complete (500ms), then reset opacity and remove class
			// setTimeout(() => {
				$('.aside-link').removeClass('opacity-0');
			//}, 500);
			
			// Add the active class to the clicked link with a fade-in effect
			$(this).addClass('active').removeClass('opacity-0').addClass('opacity-100');
		});
		
	},

	formNotificationDom : function(){
		$(document).ready(function(){
			$("form").each(function(){
				var form = $(this);		
				if (form.find('div[data-class="form-notification"]').length===0){
					form.prepend('<div data-class="form-notification" class="hidden" role="alert"><p></p></div>');
				}
			});
		});
	},

	export : function(){
		$(document).on('click', '.export-btn', function (event) {
			event.preventDefault();
			$(".export-dropdown").toggleClass("opacity-100 scale-y-100").toggleClass("opacity-0 scale-y-0");
		});

		// Close dropdown when clicking outside
		$(document).click(function (event) {
			if (!$(event.target).closest(".export-btn, .export-dropdown").length) {
				$(".export-dropdown").addClass("opacity-0 scale-y-0").removeClass("opacity-100 scale-y-100");
			}
		});		
	},

	calcAmountSMS : function() {
		$(document).on('input', '#amount', function() {
			let amount = parseFloat($(this).val()) || 0;
			let pricingTable = [
				{ from: 1, to: 100000, price: 0.5 },
				{ from: 100001, to: 500000, price: 0.4 },
				{ from: 500001, to: 1000000, price: 0.35 }
			];
	
			let pricePerSMS = 0.35;
	
			// Find the applicable price per SMS
			for (let i = 0; i < pricingTable.length; i++) {
				if (amount >= pricingTable[i].from && amount <= pricingTable[i].to) {
					pricePerSMS = pricingTable[i].price;
					break;
				}
			}
	
			// Calculate and return the number of SMS
			$('.sms-units').text(amount > 0 ? Math.floor(amount / pricePerSMS) : "0");
		});
    },

	drawer : function(){
		$(document).on('click', 'button.barger', function(evt){
			evt.preventDefault();
			let aside = $('aside');
			aside.toggleClass('lg:w-[300px]');
			// $('main').toggleClass('w-full');
			aside.find('.text-aside-link, .btn-compose span, .btn-setting span').toggleClass('lg:hidden');
			aside.find('.logo a').toggleClass('lg:hidden');

			if(aside.hasClass('lg:w-[300px]')){
				$('canvas#lineChart').css('width','calc(100% - 310px)');
			}
		});
	},

	selectTemplate: function(){
		$(document).on('change','select[data-name="template"]', function(evt){
			evt.preventDefault();
			let de = $(this),
				templateId = de.val();
			$.get("/template?view=json&id="+templateId,function(resp) {
				let form = de.closest('form'),
					title = form.find('input[name="title"]');
					
				form.find('textarea[name="message"]').val(resp.message).trigger("input");
				// if(title.val().length===0) title.val(resp.title);
				title.val(resp.title);
			});
		});
	},

	messageCounter : function(){
		$(document).on('input', 'textarea[name="message"]', function(){
			let de = $(this), 
				message = de.val();
			de.parent().find('.message-counter').text(Math.ceil(message.length/smsChar));
			de.parent().find('.message-characters').text(message.length);
		});
	},

	addContactRow : function(){
		$(document).on('click', '.addContactRow', function(){
			let de = $(this),
				tr = de.closest('tr'),
				clone = tr.clone();
			if(tr.find('input[name="phone"]').val().length==0) return;
			tr.find('.removeContactRow').removeClass('hidden');
			de.addClass('hidden');
			tr.after(clone);
			clone.find('input').val('');
		});
	},

	removeContactRow : function(){
		$(document).on('click', '.removeContactRow', function(){
			let de = $(this),
				tbody = de.closest('tbody');
			de.closest('tr').remove();
			let tr = tbody.find('tr:last');
			tr.find('.removeContactRow').addClass('hidden');
			tr.find('.addContactRow').removeClass('hidden');
		});
	},

	draftMessage : function(evt){
		let form = $(evt.target).closest('form');
		form.find('input[name="status"]').val(1);

		if (form[0].checkValidity()) {
			form.submit();
		} else {
			form.find(':input[required]').each(function () {
				let input = $(this);
				if (!input.val().trim()) {
					input.addClass('border-red-500');
				} else {
					input.removeClass('border-red-500');
				}
			});
			form[0].reportValidity();
		}
	},

	scheduleRecurringMessage : function(){
		$(document).on('click','.schedule-trigger',function(){
			let schedule = $('.schedule-section'),
				recurring = $('.recurring-message');

			recurring.addClass('hidden');
			schedule.toggleClass('hidden');
			if (schedule.hasClass('hidden')) {
				schedule.find('input[name="scheduled"]').val('');
			}
		});
		$(document).on('click','.recurring-trigger',function(){
			let schedule = $('.schedule-section'),
				recurring = $('.recurring-message');
				
			schedule.addClass('hidden');
			recurring.toggleClass('hidden');
			// if (schedule.hasClass('hidden')) {
			// 	schedule.find('input[name="scheduled"]').val('');
			// }
		});
	},

	formStatus : function(evt,status){
		$(evt.target).closest('form').find('input[name="status"]').val(status);
	},

	messageMode : function(evt,mode){
		let de = $(evt.target),
			form = de.closest('form');
		form.find('input[name="mode"]').val(mode);
		form.find('.btn-message-mode span').toggleClass('active');
	},

	toggleRecurrenceFields : function() {
		$(document).on('change','select[name="recurrence"]',function(){
			console.log($(this).val());
			let de = $(this),
				recurrence = de.val(),
				form = de.closest('form');

			form.find('.recurrence-options > div').addClass('hidden');
			
			if(recurrence == 1){
				de.closest('form').find('.time-field').removeClass('hidden');
			} else if(recurrence == 2){
				de.closest('form').find('.time-field').removeClass('hidden');
				de.closest('form').find('.days-field').removeClass('hidden');
			} else if(recurrence == 3 || recurrence == 4){
				de.closest('form').find('.date-field').removeClass('hidden');
			} else {
				de.closest('form').find('.recurrence-fields').removeClass('hidden');
			}
		});
	},	

	init : function(){
        this.submitForm();
		this.removePreviousErrors();
		this.quickLoad();
		// // this.popstate();
		// // this.sms();
		// // this.accounting();
		this.plugins();
		// // this.pageload();
		this.modal();
		// this.tabs();
		// // this.modalDomGenerator();
        // this.submitform();
		// this.passwordEyeToggle();
		// this.loanschedule();
		// this.stkpushconfirm();
		// this.stkpush();
		// this.guarantor();
		// this.dashboard();
		this.asideActiveLink();
		this.export();
		this.drawer();
		this.selectTemplate();
		this.messageCounter();
		this.addContactRow();
		this.removeContactRow();
		this.scheduleRecurringMessage();
		this.toggleRecurrenceFields();
		this.shoppingCartAdd();
		this.buyNow();
		this.increaseItemCart();
		this.decreaseItemCart();
		this.omitItemCart();
		this.previewImage();
		this.qtyDirectly();
		// this.initMap();
	}

}

$(function(){
	evet.init();
});