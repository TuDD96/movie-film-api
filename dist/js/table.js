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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/portal/table.js":
/*!**************************************!*\
  !*** ./resources/js/portal/table.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // set value limit record
  setValueLimitRecord(); // handle click limit record

  handleClickLimitRecord(); // get value sort in url

  getValueSortInUrl(); // handleClickIconSort

  handleClickIconSort();
}); // handle limit record

var currentUrl = $(location).attr('href');
var url = new URL(currentUrl);
var limitUrl = url.searchParams.get('limit') || 10;

function getParamsUrl(url) {
  var params = {};
  var parser = document.createElement('a');
  parser.href = url;
  var query = parser.search.substring(1);
  var vars = query.split('&');

  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split('=');
    params[pair[0]] = decodeURIComponent(pair[1]);
  }

  return params;
}

function linkedParam(objects, keys) {
  var newObj = '';
  Object.keys(objects).forEach(function (key) {
    if (!keys.includes(key)) {
      newObj += '&' + key + '=' + objects[key];
    }
  });
  return newObj.replace('&', '');
}

function setValueLimitRecord() {
  $('#limit').val(limitUrl);
}

function handleClickLimitRecord() {
  $('.per-page').change(function () {
    var limit = $('.per-page option:selected').val();

    if (currentUrl.indexOf('limit') !== -1) {
      var href = new URL(currentUrl);
      href.searchParams.set('page', '1');
      var redirectUrl = href.toString().replace('limit=' + limitUrl, 'limit=' + limit);
      window.location = redirectUrl;
    } else {
      var _href = new URL(currentUrl);

      _href.searchParams.set('page', '1');

      _href += _href.toString().indexOf('?') !== -1 ? '&limit=' : '?limit=';
      _href += limit;
      window.location = _href;
    }
  });
}

var sortInput = url.searchParams.get('sort');

function getValueSortInUrl() {
  $('#sort').val(sortInput);

  if (sortInput) {
    var sortArray = sortInput.split(',');
    sortArray.forEach(function (value, index) {
      var dataInput = value.split('-');
      $('.parent_' + dataInput[0]).attr('aria-sort', dataInput[1] === 'asc' ? 'ascending' : 'descending');
    });
  }
}

function handleClickIconSort() {
  $('.sort').click(function () {
    var currentButtonSort = $(this).attr('aria-sort'); // none -> asc -> desc -> none

    switch (currentButtonSort) {
      case 'none':
        sortASC($(this));
        break;

      case 'ascending':
        sortDESC($(this));
        break;

      case 'descending':
        sortNone($(this));
        break;
    }
  });
}

function sortASC(elementSort) {
  elementSort.attr('aria-sort', 'ascending');
  fieldSort = elementSort.find('input').val();

  if (sortInput === '') {
    window.location = currentUrl.replace('sort=', 'sort=' + fieldSort + '-asc');
  } else {
    if (currentUrl.indexOf('sort') !== -1) {
      var regex = /[?&]([^=#]+)=([^&#]*)/g,
          params = {},
          match;

      while (match = regex.exec(currentUrl)) {
        params[match[1]] = match[2];
      }

      window.location = currentUrl.replace('sort=' + params['sort'], 'sort=' + params['sort'] + ',' + fieldSort + '-asc');
    } else {
      var href = currentUrl;
      href += currentUrl.indexOf('?') !== -1 ? '&sort=' : '?sort=';
      href += fieldSort + '-asc';
      window.location = href;
    }
  }
}

function sortDESC(elementSort) {
  elementSort.attr('aria-sort', 'descending');
  fieldSort = elementSort.find('input').val();

  if (currentUrl.indexOf('sort') !== -1) {
    if (sortInput.indexOf(fieldSort) !== -1) {
      window.location = currentUrl.replace(fieldSort + '-asc', fieldSort + '-desc');
    } else {
      window.location = currentUrl.replace('sort=' + sortInput, 'sort=' + sortInput + ',' + fieldSort + '-desc');
    }
  }
}

function sortNone(elementSort) {
  elementSort.attr('aria-sort', 'none');
  fieldSort = elementSort.find('input').val();
  var params = getParamsUrl(currentUrl);
  var paramSort = params.sort.split(',').filter(function (item) {
    return item != fieldSort + '-asc' && item != fieldSort + '-desc';
  }).join(',');
  var paramSearch = linkedParam(params, 'sort');
  var pathname = window.location.pathname;
  var href = window.location.origin + pathname + '?' + paramSearch + (paramSearch ? '&' : '') + 'sort=' + paramSort;
  window.location = href;
}

/***/ }),

/***/ 4:
/*!********************************************!*\
  !*** multi ./resources/js/portal/table.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/roober-backend/resources/js/portal/table.js */"./resources/js/portal/table.js");


/***/ })

/******/ });