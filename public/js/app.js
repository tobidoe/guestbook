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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

//comment: Don't use public folder to create styles. Use frontend compilation instead.
// Do not use js-generated html by hand.
//replaces post with form for editing current post
function showFormEditPost(post_id) {
  var html_form_filler = '<div class="newPost">' + //todo: is there a better place to put these kind of html constructs?
  '<form action="/guestbook/editPost" method="post">' + '<input type="hidden" name="_token" value="' + document.head.querySelector("[id~=csrf-token][content]").content + '">' + //todo: is there a better way to query the csrf-token?
  '<input type="hidden" name="post_id" value="' + post_id + '">' + '<label for="post">Ändere deinen Eintrag:</label>' + '<br>' + '<textarea id="post" name="post"' + 'placeholder="Bis zu 800 Zeichen"' + 'rows="10" cols="50"' + 'required ' + 'minlength="5"' + 'maxlength="800">' + document.querySelector("#post" + post_id).innerHTML + '</textarea>' + '<br>' + '<input type="submit" value="Eintrag ändern">  ' + '<a href="/guestbook">Änderung abbrechen</a>' + '</form>' + '</div>';
  document.getElementById(post_id).innerHTML = html_form_filler;
} //appends a form for creating an answer to current post


function showFormAnswer(post_id) {
  var html_form_filler = '<div class="newPost">' + //todo: is there a better place to put these kind of html constructs?
  '<form action="/guestbook/newPost" method="post">' + '<input type="hidden" name="_token" value="' + document.head.querySelector("[id~=csrf-token][content]").content + '">' + //todo: is there a better way to query the csrf-token?
  '<input type="hidden" name="post_id" value="' + post_id + '">' + '<label for="post">Antworte auf diesen Eintrag:</label>' + '<br>' + '<textarea id="post" name="post"' + 'placeholder="Bis zu 800 Zeichen"' + 'rows="10" cols="50"' + 'required ' + 'minlength="5"' + 'maxlength="800"></textarea>' + '<br>' + '<input type="submit" value="Antworten">  ' + '<a href="/guestbook">Abbrechen</a>' + '</form>' + '</div>';
  var node = document.createElement("div");
  node.innerHTML = html_form_filler;
  document.getElementById(post_id).appendChild(node);
}

/***/ }),

/***/ 0:
/*!***********************************************************!*\
  !*** multi ./resources/js/app.js ./resources/css/app.css ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\tobi-\code\guestbook\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\Users\tobi-\code\guestbook\resources\css\app.css */"./resources/css/app.css");


/***/ })

/******/ });