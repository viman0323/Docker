window.onload = function() {
	'use strict';
	var Cropper = window.Cropper;
	var console = window.console || {
		log: function() {}
	};
	var container = document.querySelector('.img-container');
	var image = container.getElementsByTagName('img').item(0);
	var actions = document.getElementById('actions');
	var options = {
		aspectRatio: 1 / 1,
		preview: '.img-preview',
		build: function() {
			//console.log('build');
		},
		built: function() {
			//console.log('built');
		},
		cropstart: function(data) {
			//console.log('cropstart', data.action);
		},
		cropmove: function(data) {
			//console.log('cropmove', data.action);
		},
		cropend: function(data) {
			//console.log('cropend', data.action);
		},
		crop: function(data) {},
		zoom: function(data) {
			console.log('zoom', data.ratio);
		}
	};
	var cropper = new Cropper(image, options);

	function isUndefined(obj) {
		return typeof obj === 'undefined';
	}

	function preventDefault(e) {
		if (e) {
			if (e.preventDefault) {
				e.preventDefault();
			} else {
				e.returnValue = false;
			}
		}
	}
	// Tooltip
	$('[data-toggle="tooltip"]').tooltip();
	// Buttons
	if (!document.createElement('canvas').getContext) {
		$('button[data-method="getCroppedCanvas"]').prop('disabled', true);
	}
	if (typeof document.createElement('cropper').style.transition === 'undefined') {
		$('button[data-method="rotate"]').prop('disabled', true);
		$('button[data-method="scale"]').prop('disabled', true);
	}

	// Methods
	actions.querySelector('.docs-buttons').onclick = function(event) {
		var e = event || window.event;
		var target = e.target || e.srcElement;
		var result;
		var input;
		var data;
		if (!cropper) {
			return;
		}
		while (target !== this) {
			if (target.getAttribute('data-method')) {
				break;
			}
			target = target.parentNode;
		}
		if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
			return;
		}
		data = {
			method: target.getAttribute('data-method'),
			target: target.getAttribute('data-target'),
			option: target.getAttribute('data-option'),
			secondOption: target.getAttribute('data-second-option')
		};
		if (data.method) {
			if (typeof data.target !== 'undefined') {
				input = document.querySelector(data.target);
				if (!target.hasAttribute('data-option') && data.target && input) {
					try {
						data.option = JSON.parse(input.value);
					} catch (e) {
						console.log(e.message);
					}
				}
			}
			if (data.method === 'getCroppedCanvas') {
				data.option = JSON.parse(data.option);
			}
			result = cropper[data.method](data.option, data.secondOption);
			switch (data.method) {
				case 'scaleX':
				case 'scaleY':
					target.setAttribute('data-option', -data.option);
					break;
				case 'getCroppedCanvas':
					if (result) {
						// Bootstrap's Modal
						$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
						if (!download.disabled) {
							download.href = result.toDataURL();
						}
					}
					break;
				case 'destroy':
					cropper = null;
					break;
			}
			if (typeof result === 'object' && result !== cropper && input) {
				try {
					input.value = JSON.stringify(result);
				} catch (e) {
					console.log(e.message);
				}
			}
		}
	};
	// Import image
	var inputImage = document.getElementById('inputImage');
	var URL = window.URL || window.webkitURL;
	var blobURL;
	if (URL) {
		inputImage.onchange = function() {
			var files = this.files;
			var file;
			if (cropper && files && files.length) {
				file = files[0];
				if (/^image\/\w+/.test(file.type)) {
					blobURL = URL.createObjectURL(file);
					cropper.reset().replace(blobURL);
					inputImage.value = null;
				} else {
					window.alert('Please choose an image file.');
				}
			}
		};
	} else {
		inputImage.disabled = true;
		inputImage.parentNode.className += ' disabled';
	}
};