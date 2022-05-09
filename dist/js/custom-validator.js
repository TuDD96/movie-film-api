/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/portal/custom-validator.js":
/*!*************************************************!*\
  !*** ./resources/js/portal/custom-validator.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

jQuery.extend(jQuery.validator.messages, {// required: "This field is required.",
  // remote: "Please fix this field.",
  // email: "Please enter a valid email address.",
  // url: "Please enter a valid URL.",
  // date: "Please enter a valid date.",
  // dateISO: "Please enter a valid date (ISO).",
  // number: "Please enter a valid number.",
  // digits: "Please enter only digits.",
  // creditcard: "Please enter a valid credit card number.",
  // equalTo: "Please enter the same value again.",
  // accept: "Please enter a value with a valid extension.",
  // maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
  // minlength: jQuery.validator.format("Please enter at least {0} characters."),
  // rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
  // range: jQuery.validator.format("Please enter a value between {0} and {1}."),
  // max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
  // min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
}); // jQuery.validator.addMethod('valid_zip_code', function (value) {
//   var regex = /^[0-9, -]+$/;
//
//   return value.trim().match(regex);
// });
//   $('form').validate({
//     rules: {
//       zip_code: {
//         minlength: 7,
//         maxlength: 8,
//         valid_zip_code: true
//       },
//     },
//     messages: {
//       "zip_code": {
//         valid_zip_code: "xxx"
//       },
//     },
//     submitHandler: function(form) {
//       form.submit();
//     }
//   });

$(document).ready(function (e) {
  // Auto open modal add when has validate error
  autoOpenModalWhenHasError(); // Remove error when keyup

  removeErrorWhenKeyup(); // Remove error when click button add

  removeErrorWhenClickButtonAdd(); // Disable submit form when press enter

  pressEnterInForm(); // Trim space

  trimSpace();
});

function autoOpenModalWhenHasError() {
  var errors = $('.error,.errors');

  if (errors.length > 0 && $('.modal-add').length != 0) {
    // check products screen has two modal add (product add, inventory add)
    if (window.location.pathname.search('/products') === 0) {
      var currentModal = localStorage.getItem('product_current_add_modal');

      if (currentModal === 'inventory') {
        $('.modal-add#modalAddInventory').modal('show');
      } else if (currentModal === 'product') {
        $('.modal-add#modalAddProduct').modal('show');
      }
    } else {
      $('.modal-add').modal('show');
    }
  }
}

function removeErrorWhenKeyup() {
  $(document).on('keyup', 'input.error,textarea.error', function () {
    $(this).removeClass('error');
    $(this).next().remove();
  });
  $(document).on('change', 'select.error', function () {
    $(this).removeClass('error');
    $(this).next().remove();
  });
  $(document).on('change', '.error.hasDatepicker', function () {
    $(this).removeClass('error');
    $(this).parent().find('.error').remove();
  });
}

function removeErrorWhenClickButtonAdd() {
  $('.add-popup').click(function () {
    $('input.error, textarea.error, select.error, .error.hasDatepicker').removeClass('error');
    $('label.error, div.errors').remove();
  });
}

function pressEnterInForm() {
  $(document).ready(function () {
    $(window).keydown(function (event) {
      if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });
}

function trimSpace() {
  var trim = document.querySelectorAll("#trim");

  for (var i = 0; i < trim.length; i++) {
    trim[i].addEventListener('change', function () {
      this.value = this.value.trim();
    });
  }
}

/***/ }),

/***/ 5:
/*!*******************************************************!*\
  !*** multi ./resources/js/portal/custom-validator.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/roober-backend/resources/js/portal/custom-validator.js */"./resources/js/portal/custom-validator.js");


/***/ })

/******/ });