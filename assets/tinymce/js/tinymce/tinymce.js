// 4.4.0 (2016-06-30)

/**
 * Compiled inline version. (Library mode)
 */

/*jshint smarttabs:true, undef:true, latedef:true, curly:true, bitwise:true, camelcase:true */
/*globals $code */

(function(exports, undefined) {
	"use strict";

	var modules = {};

	function require(ids, callback) {
		var module, defs = [];

		for (var i = 0; i < ids.length; ++i) {
			module = modules[ids[i]] || resolve(ids[i]);
			if (!module) {
				throw 'module definition dependecy not found: ' + ids[i];
			}

			defs.push(module);
		}

		callback.apply(null, defs);
	}

	function define(id, dependencies, definition) {
		if (typeof id !== 'string') {
			throw 'invalid module definition, module id must be defined and be a string';
		}

		if (dependencies === undefined) {
			throw 'invalid module definition, dependencies must be specified';
		}

		if (definition === undefined) {
			throw 'invalid module definition, definition function must be specified';
		}

		require(dependencies, function() {
			modules[id] = definition.apply(null, arguments);
		});
	}

	function defined(id) {
		return !!modules[id];
	}

	function resolve(id) {
		var target = exports;
		var fragments = id.split(/[.\/]/);

		for (var fi = 0; fi < fragments.length; ++fi) {
			if (!target[fragments[fi]]) {
				return;
			}

			target = target[fragments[fi]];
		}

		return target;
	}

	function expose(ids) {
		var i, target, id, fragments, privateModules;

		for (i = 0; i < ids.length; i++) {
			target = exports;
			id = ids[i];
			fragments = id.split(/[.\/]/);

			for (var fi = 0; fi < fragments.length - 1; ++fi) {
				if (target[fragments[fi]] === undefined) {
					target[fragments[fi]] = {};
				}

				target = target[fragments[fi]];
			}

			target[fragments[fragments.length - 1]] = modules[id];
		}
		
		// Expose private modules for unit tests
		if (exports.AMDLC_TESTS) {
			privateModules = exports.privateModules || {};

			for (id in modules) {
				privateModules[id] = modules[id];
			}

			for (i = 0; i < ids.length; i++) {
				delete privateModules[ids[i]];
			}

			exports.privateModules = privateModules;
		}
	}

// Included from: js/tinymce/classes/geom/Rect.js

/**
 * Rect.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 * Contains various tools for rect/position calculation.
 *
 * @class tinymce.geom.Rect
 */
define("tinymce/geom/Rect", [
], function() {
	"use strict";

	var min = Math.min, max = Math.max, round = Math.round;

	/**
	 * Returns the rect positioned based on the relative position name
	 * to the target rect.
	 *
	 * @method relativePosition
	 * @param {Rect} rect Source rect to modify into a new rect.
	 * @param {Rect} targetRect Rect to move relative to based on the rel option.
	 * @param {String} rel Relative position. For example: tr-bl.
	 */
	function relativePosition(rect, targetRect, rel) {
		var x, y, w, h, targetW, targetH;

		x = targetRect.x;
		y = targetRect.y;
		w = rect.w;
		h = rect.h;
		targetW = targetRect.w;
		targetH = targetRect.h;

		rel = (rel || '').split('');

		if (rel[0] === 'b') {
			y += targetH;
		}

		if (rel[1] === 'r') {
			x += targetW;
		}

		if (rel[0] === 'c') {
			y += round(targetH / 2);
		}

		if (rel[1] === 'c') {
			x += round(targetW / 2);
		}

		if (rel[3] === 'b') {
			y -= h;
		}

		if (rel[4] === 'r') {
			x -= w;
		}

		if (rel[3] === 'c') {
			y -= round(h / 2);
		}

		if (rel[4] === 'c') {
			x -= round(w / 2);
		}

		return create(x, y, w, h);
	}

	/**
	 * Tests various positions to get the most suitable one.
	 *
	 * @method findBestRelativePosition
	 * @param {Rect} rect Rect to use as source.
	 * @param {Rect} targetRect Rect to move relative to.
	 * @param {Rect} constrainRect Rect to constrain within.
	 * @param {Array} rels Array of relative positions to test against.
	 */
	function findBestRelativePosition(rect, targetRect, constrainRect, rels) {
		var pos, i;

		for (i = 0; i < rels.length; i++) {
			pos = relativePosition(rect, targetRect, rels[i]);

			if (pos.x >= constrainRect.x && pos.x + pos.w <= constrainRect.w + constrainRect.x &&
				pos.y >= constrainRect.y && pos.y + pos.h <= constrainRect.h + constrainRect.y) {
				return rels[i];
			}
		}

		return null;
	}

	/**
	 * Inflates the rect in all directions.
	 *
	 * @method inflate
	 * @param {Rect} rect Rect to expand.
	 * @param {Number} w Relative width to expand by.
	 * @param {Number} h Relative height to expand by.
	 * @return {Rect} New expanded rect.
	 */
	function inflate(rect, w, h) {
		return create(rect.x - w, rect.y - h, rect.w + w * 2, rect.h + h * 2);
	}

	/**
	 * Returns the intersection of the specified rectangles.
	 *
	 * @method intersect
	 * @param {Rect} rect The first rectangle to compare.
	 * @param {Rect} cropRect The second rectangle to compare.
	 * @return {Rect} The intersection of the two rectangles or null if they don't intersect.
	 */
	function intersect(rect, cropRect) {
		var x1, y1, x2, y2;

		x1 = max(rect.x, cropRect.x);
		y1 = max(rect.y, cropRect.y);
		x2 = min(rect.x + rect.w, cropRect.x + cropRect.w);
		y2 = min(rect.y + rect.h, cropRect.y + cropRect.h);

		if (x2 - x1 < 0 || y2 - y1 < 0) {
			return null;
		}

		return create(x1, y1, x2 - x1, y2 - y1);
	}

	/**
	 * Returns a rect clamped within the specified clamp rect. This forces the
	 * rect to be inside the clamp rect.
	 *
	 * @method clamp
	 * @param {Rect} rect Rectangle to force within clamp rect.
	 * @param {Rect} clampRect Rectable to force within.
	 * @param {Boolean} fixedSize True/false if size should be fixed.
	 * @return {Rect} Clamped rect.
	 */
	function clamp(rect, clampRect, fixedSize) {
		var underflowX1, underflowY1, overflowX2, overflowY2,
			x1, y1, x2, y2, cx2, cy2;

		x1 = rect.x;
		y1 = rect.y;
		x2 = rect.x + rect.w;
		y2 = rect.y + rect.h;
		cx2 = clampRect.x + clampRect.w;
		cy2 = clampRect.y + clampRect.h;

		underflowX1 = max(0, clampRect.x - x1);
		underflowY1 = max(0, clampRect.y - y1);
		overflowX2 = max(0, x2 - cx2);
		overflowY2 = max(0, y2 - cy2);

		x1 += underflowX1;
		y1 += underflowY1;

		if (fixedSize) {
			x2 += underflowX1;
			y2 += underflowY1;
			x1 -= overflowX2;
			y1 -= overflowY2;
		}

		x2 -= overflowX2;
		y2 -= overflowY2;

		return create(x1, y1, x2 - x1, y2 - y1);
	}

	/**
	 * Creates a new rectangle object.
	 *
	 * @method create
	 * @param {Number} x Rectangle x location.
	 * @param {Number} y Rectangle y location.
	 * @param {Number} w Rectangle width.
	 * @param {Number} h Rectangle height.
	 * @return {Rect} New rectangle object.
	 */
	function create(x, y, w, h) {
		return {x: x, y: y, w: w, h: h};
	}

	/**
	 * Creates a new rectangle object form a clientRects object.
	 *
	 * @method fromClientRect
	 * @param {ClientRect} clientRect DOM ClientRect object.
	 * @return {Rect} New rectangle object.
	 */
	function fromClientRect(clientRect) {
		return create(clientRect.left, clientRect.top, clientRect.width, clientRect.height);
	}

	return {
		inflate: inflate,
		relativePosition: relativePosition,
		findBestRelativePosition: findBestRelativePosition,
		intersect: intersect,
		clamp: clamp,
		create: create,
		fromClientRect: fromClientRect
	};
});

// Included from: js/tinymce/classes/util/Promise.js

/**
 * Promise.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * Promise polyfill under MIT license: https://github.com/taylorhakes/promise-polyfill
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/* eslint-disable */
/* jshint ignore:start */

/**
 * Modifed to be a feature fill and wrapped as tinymce module.
 */
define("tinymce/util/Promise", [], function() {
	if (window.Promise) {
		return window.Promise;
	}

	// Use polyfill for setImmediate for performance gains
	var asap = Promise.immediateFn || (typeof setImmediate === 'function' && setImmediate) ||
		function(fn) { setTimeout(fn, 1); };

	// Polyfill for Function.prototype.bind
	function bind(fn, thisArg) {
		return function() {
			fn.apply(thisArg, arguments);
		};
	}

	var isArray = Array.isArray || function(value) { return Object.prototype.toString.call(value) === "[object Array]"; };

	function Promise(fn) {
		if (typeof this !== 'object') throw new TypeError('Promises must be constructed via new');
		if (typeof fn !== 'function') throw new TypeError('not a function');
		this._state = null;
		this._value = null;
		this._deferreds = [];

		doResolve(fn, bind(resolve, this), bind(reject, this));
	}

	function handle(deferred) {
		var me = this;
		if (this._state === null) {
			this._deferreds.push(deferred);
			return;
		}
		asap(function() {
			var cb = me._state ? deferred.onFulfilled : deferred.onRejected;
			if (cb === null) {
				(me._state ? deferred.resolve : deferred.reject)(me._value);
				return;
			}
			var ret;
			try {
				ret = cb(me._value);
			}
			catch (e) {
				deferred.reject(e);
				return;
			}
			deferred.resolve(ret);
		});
	}

	function resolve(newValue) {
		try { //Promise Resolution Procedure: https://github.com/promises-aplus/promises-spec#the-promise-resolution-procedure
			if (newValue === this) throw new TypeError('A promise cannot be resolved with itself.');
			if (newValue && (typeof newValue === 'object' || typeof newValue === 'function')) {
				var then = newValue.then;
				if (typeof then === 'function') {
					doResolve(bind(then, newValue), bind(resolve, this), bind(reject, this));
					return;
				}
			}
			this._state = true;
			this._value = newValue;
			finale.call(this);
		} catch (e) { reject.call(this, e); }
	}

	function reject(newValue) {
		this._state = false;
		this._value = newValue;
		finale.call(this);
	}

	function finale() {
		for (var i = 0, len = this._deferreds.length; i < len; i++) {
			handle.call(this, this._deferreds[i]);
		}
		this._deferreds = null;
	}

	function Handler(onFulfilled, onRejected, resolve, reject){
		this.onFulfilled = typeof onFulfilled === 'function' ? onFulfilled : null;
		this.onRejected = typeof onRejected === 'function' ? onRejected : null;
		this.resolve = resolve;
		this.reject = reject;
	}

	/**
	 * Take a potentially misbehaving resolver function and make sure
	 * onFulfilled and onRejected are only called once.
	 *
	 * Makes no guarantees about asynchrony.
	 */
	function doResolve(fn, onFulfilled, onRejected) {
		var done = false;
		try {
			fn(function (value) {
				if (done) return;
				done = true;
				onFulfilled(value);
			}, function (reason) {
				if (done) return;
				done = true;
				onRejected(reason);
			});
		} catch (ex) {
			if (done) return;
			done = true;
			onRejected(ex);
		}
	}

	Promise.prototype['catch'] = function (onRejected) {
		return this.then(null, onRejected);
	};

	Promise.prototype.then = function(onFulfilled, onRejected) {
		var me = this;
		return new Promise(function(resolve, reject) {
			handle.call(me, new Handler(onFulfilled, onRejected, resolve, reject));
		});
	};

	Promise.all = function () {
		var args = Array.prototype.slice.call(arguments.length === 1 && isArray(arguments[0]) ? arguments[0] : arguments);

		return new Promise(function (resolve, reject) {
			if (args.length === 0) return resolve([]);
			var remaining = args.length;
			function res(i, val) {
				try {
					if (val && (typeof val === 'object' || typeof val === 'function')) {
						var then = val.then;
						if (typeof then === 'function') {
							then.call(val, function (val) { res(i, val); }, reject);
							return;
						}
					}
					args[i] = val;
					if (--remaining === 0) {
						resolve(args);
					}
				} catch (ex) {
					reject(ex);
				}
			}
			for (var i = 0; i < args.length; i++) {
				res(i, args[i]);
			}
		});
	};

	Promise.resolve = function (value) {
		if (value && typeof value === 'object' && value.constructor === Promise) {
			return value;
		}

		return new Promise(function (resolve) {
			resolve(value);
		});
	};

	Promise.reject = function (value) {
		return new Promise(function (resolve, reject) {
			reject(value);
		});
	};

	Promise.race = function (values) {
		return new Promise(function (resolve, reject) {
			for(var i = 0, len = values.length; i < len; i++) {
				values[i].then(resolve, reject);
			}
		});
	};

	return Promise;
});

/* jshint ignore:end */
/* eslint-enable */

// Included from: js/tinymce/classes/util/Delay.js

/**
 * Delay.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 * Utility class for working with delayed actions like setTimeout.
 *
 * @class tinymce.util.Delay
 */
define("tinymce/util/Delay", [
	"tinymce/util/Promise"
], function(Promise) {
	var requestAnimationFramePromise;

	function requestAnimationFrame(callback, element) {
		var i, requestAnimationFrameFunc = window.requestAnimationFrame, vendors = ['ms', 'moz', 'webkit'];

		function featurefill(callback) {
			window.setTimeout(callback, 0);
		}

		for (i = 0; i < vendors.length && !requestAnimationFrameFunc; i++) {
			requestAnimationFrameFunc = window[vendors[i] + 'RequestAnimationFrame'];
		}

		if (!requestAnimationFrameFunc) {
			requestAnimationFrameFunc = featurefill;
		}

		requestAnimationFrameFunc(callback, element);
	}

	function wrappedSetTimeout(callback, time) {
		if (typeof time != 'number') {
			time = 0;
		}

		return setTimeout(callback, time);
	}

	function wrappedSetInterval(callback, time) {
		if (typeof time != 'number') {
			time = 0;
		}

		return setInterval(callback, time);
	}

	function wrappedClearTimeout(id) {
		return clearTimeout(id);
	}

	function wrappedClearInterval(id) {
		return clearInterval(id);
	}

	return {
		/**
		 * Requests an animation frame and fallbacks to a timeout on older browsers.
		 *
		 * @method requestAnimationFrame
		 * @param {function} callback Callback to execute when a new frame is available.
		 * @param {DOMElement} element Optional element to scope it to.
		 */
		requestAnimationFrame: function(callback, element) {
			if (requestAnimationFramePromise) {
				requestAnimationFramePromise.then(callback);
				return;
			}

			requestAnimationFramePromise = new Promise(function(resolve) {
				if (!element) {
					element = document.body;
				}

				requestAnimationFrame(resolve, element);
			}).then(callback);
		},

		/**
		 * Sets a timer in ms and executes the specified callback when the timer runs out.
		 *
		 * @method setTimeout
		 * @param {function} callback Callback to execute when timer runs out.
		 * @param {Number} time Optional time to wait before the callback is executed, defaults to 0.
		 * @return {Number} Timeout id number.
		 */
		setTimeout: wrappedSetTimeout,

		/**
		 * Sets an interval timer in ms and executes the specified callback at every interval of that time.
		 *
		 * @method setInterval
		 * @param {function} callback Callback to execute when interval time runs out.
		 * @param {Number} time Optional time to wait before the callback is executed, defaults to 0.
		 * @return {Number} Timeout id number.
		 */
		setInterval: wrappedSetInterval,

		/**
		 * Sets an editor timeout it's similar to setTimeout except that it checks if the editor instance is
		 * still alive when the callback gets executed.
		 *
		 * @method setEditorTimeout
		 * @param {tinymce.Editor} editor Editor instance to check the removed state on.
		 * @param {function} callback Callback to execute when timer runs out.
		 * @param {Number} time Optional time to wait before the callback is executed, defaults to 0.
		 * @return {Number} Timeout id number.
		 */
		setEditorTimeout: function(editor, callback, time) {
			return wrappedSetTimeout(function() {
				if (!editor.removed) {
					callback();
				}
			}, time);
		},

		/**
		 * Sets an interval timer it's similar to setInterval except that it checks if the editor instance is
		 * still alive when the callback gets executed.
		 *
		 * @method setEditorInterval
		 * @param {function} callback Callback to execute when interval time runs out.
		 * @param {Number} time Optional time to wait before the callback is executed, defaults to 0.
		 * @return {Number} Timeout id number.
		 */
		setEditorInterval: function(editor, callback, time) {
			var timer;

			timer = wrappedSetInterval(function() {
				if (!editor.removed) {
					callback();
				} else {
					clearInterval(timer);
				}
			}, time);

			return timer;
		},

		/**
		 * Creates throttled callback function that only gets executed once within the specified time.
		 *
		 * @method throttle
		 * @param {function} callback Callback to execute when timer finishes.
		 * @param {Number} time Optional time to wait before the callback is executed, defaults to 0.
		 * @return {Function} Throttled function callback.
		 */
		throttle: function(callback, time) {
			var timer, func;

			func = function() {
				var args = arguments;

				clearTimeout(timer);

				timer = wrappedSetTimeout(function() {
					callback.apply(this, args);
				}, time);
			};

			func.stop = function() {
				clearTimeout(timer);
			};

			return func;
		},

		/**
		 * Clears an interval timer so it won't execute.
		 *
		 * @method clearInterval
		 * @param {Number} Interval timer id number.
		 */
		clearInterval: wrappedClearInterval,

		/**
		 * Clears an timeout timer so it won't execute.
		 *
		 * @method clearTimeout
		 * @param {Number} Timeout timer id number.
		 */
		clearTimeout: wrappedClearTimeout
	};
});

// Included from: js/tinymce/classes/Env.js

/**
 * Env.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 * This class contains various environment constants like browser versions etc.
 * Normally you don't want to sniff specific browser versions but sometimes you have
 * to when it's impossible to feature detect. So use this with care.
 *
 * @class tinymce.Env
 * @static
 */
define("tinymce/Env", [], function() {
	var nav = navigator, userAgent = nav.userAgent;
	var opera, webkit, ie, ie11, ie12, gecko, mac, iDevice, android, fileApi, phone, tablet, windowsPhone;

	function matchMediaQuery(query) {
		return "matchMedia" in window ? matchMedia(query).matches : false;
	}

	opera = window.opera && window.opera.buildNumber;
	android = /Android/.test(userAgent);
	webkit = /WebKit/.test(userAgent);
	ie = !webkit && !opera && (/MSIE/gi).test(userAgent) && (/Explorer/gi).test(nav.appName);
	ie = ie && /MSIE (\w+)\./.exec(userAgent)[1];
	ie11 = userAgent.indexOf('Trident/') != -1 && (userAgent.indexOf('rv:') != -1 || nav.appName.indexOf('Netscape') != -1) ? 11 : false;
	ie12 = (userAgent.indexOf('Edge/') != -1 && !ie && !ie11) ? 12 : false;
	ie = ie || ie11 || ie12;
	gecko = !webkit && !ie11 && /Gecko/.test(userAgent);
	mac = userAgent.indexOf('Mac') != -1;
	iDevice = /(iPad|iPhone)/.test(userAgent);
	fileApi = "FormData" in window && "FileReader" in window && "URL" in window && !!URL.createObjectURL;
	phone = matchMediaQuery("only screen and (max-device-width: 480px)") && (android || iDevice);
	tablet = matchMediaQuery("only screen and (min-width: 800px)") && (android || iDevice);
	windowsPhone = userAgent.indexOf('Windows Phone') != -1;

	if (ie12) {
		webkit = false;
	}

	// Is a iPad/iPhone and not on iOS5 sniff the WebKit version since older iOS WebKit versions
	// says it has contentEditable support but there is no visible caret.
	var contentEditable = !iDevice || fileApi || userAgent.match(/AppleWebKit\/(\d*)/)[1] >= 534;

	return {
		/**
		 * Constant that is true if the browser is Opera.
		 *
		 * @property opera
		 * @type Boolean
		 * @final
		 */
		opera: opera,

		/**
		 * Constant that is true if the browser is WebKit (Safari/Chrome).
		 *
		 * @property webKit
		 * @type Boolean
		 * @final
		 */
		webkit: webkit,

		/**
		 * Constant that is more than zero if the browser is IE.
		 *
		 * @property ie
		 * @type Boolean
		 * @final
		 */
		ie: ie,

		/**
		 * Constant that is true if the browser is Gecko.
		 *
		 * @property gecko
		 * @type Boolean
		 * @final
		 */
		gecko: gecko,

		/**
		 * Constant that is true if the os is Mac OS.
		 *
		 * @property mac
		 * @type Boolean
		 * @final
		 */
		mac: mac,

		/**
		 * Constant that is true if the os is iOS.
		 *
		 * @property iOS
		 * @type Boolean
		 * @final
		 */
		iOS: iDevice,

		/**
		 * Constant that is true if the os is android.
		 *
		 * @property android
		 * @type Boolean
		 * @final
		 */
		android: android,

		/**
		 * Constant that is true if the browser supports editing.
		 *
		 * @property contentEditable
		 * @type Boolean
		 * @final
		 */
		contentEditable: contentEditable,

		/**
		 * Transparent image data url.
		 *
		 * @property transparentSrc
		 * @type Boolean
		 * @final
		 */
		transparentSrc: "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",

		/**
		 * Returns true/false if the browser can or can't place the caret after a inline block like an image.
		 *
		 * @property noCaretAfter
		 * @type Boolean
		 * @final
		 */
		caretAfter: ie != 8,

		/**
		 * Constant that is true if the browser supports native DOM Ranges. IE 9+.
		 *
		 * @property range
		 * @type Boolean
		 */
		range: window.getSelection && "Range" in window,

		/**
		 * Returns the IE document mode for non IE browsers this will fake IE 10.
		 *
		 * @property documentMode
		 * @type Number
		 */
		documentMode: ie && !ie12 ? (document.documentMode || 7) : 10,

		/**
		 * Constant that is true if the browser has a modern file api.
		 *
		 * @property fileApi
		 * @type Boolean
		 */
		fileApi: fileApi,

		/**
		 * Constant that is true if the browser supports contentEditable=false regions.
		 *
		 * @property ceFalse
		 * @type Boolean
		 */
		ceFalse: (ie === false || ie > 8),

		desktop: !phone && !tablet,
		windowsPhone: windowsPhone
	};
});

// Included from: js/tinymce/classes/dom/EventUtils.js

/**
 * EventUtils.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/*jshint loopfunc:true*/
/*eslint no-loop-func:0 */

/**
 * This class wraps the browsers native event logic with more convenient methods.
 *
 * @class tinymce.dom.EventUtils
 */
define("tinymce/dom/EventUtils", [
	"tinymce/util/Delay",
	"tinymce/Env"
], function(Delay, Env) {
	"use strict";

	var eventExpandoPrefix = "mce-data-";
	var mouseEventRe = /^(?:mouse|contextmenu)|click/;
	var deprecated = {
		keyLocation: 1, layerX: 1, layerY: 1, returnValue: 1,
		webkitMovementX: 1, webkitMovementY: 1, keyIdentifier: 1
	};

	/**
	 * Binds a native event to a callback on the speified target.
	 */
	function addEvent(target, name, callback, capture) {
		if (target.addEventListener) {
			target.addEventListener(name, callback, capture || false);
		} else if (target.attachEvent) {
			target.attachEvent('on' + name, callback);
		}
	}

	/**
	 * Unbinds a native event callback on the specified target.
	 */
	function removeEvent(target, name, callback, capture) {
		if (target.removeEventListener) {
			target.removeEventListener(name, callback, capture || false);
		} else if (target.detachEvent) {
			target.detachEvent('on' + name, callback);
		}
	}

	/**
	 * Gets the event target based on shadow dom properties like path and deepPath.
	 */
	function getTargetFromShadowDom(event, defaultTarget) {
		var path, target = defaultTarget;

		// When target element is inside Shadow DOM we need to take first element from path
		// otherwise we'll get Shadow Root parent, not actual target element

		// Normalize target for WebComponents v0 implementation (in Chrome)
		path = event.path;
		if (path && path.length > 0) {
			target = path[0];
		}

		// Normalize target for WebComponents v1 implementation (standard)
		if (event.deepPath) {
			path = event.deepPath();
			if (path && path.length > 0) {
				target = path[0];
			}
		}

		return target;
	}

	/**
	 * Normalizes a native event object or just adds the event specific methods on a custom event.
	 */
	function fix(originalEvent, data) {
		var name, event = data || {}, undef;

		// Dummy function that gets replaced on the delegation state functions
		function returnFalse() {
			return false;
		}

		// Dummy function that gets replaced on the delegation state functions
		function returnTrue() {
			return true;
		}

		// Copy all properties from the original event
		for (name in originalEvent) {
			// layerX/layerY is deprecated in Chrome and produces a warning
			if (!deprecated[name]) {
				event[name] = originalEvent[name];
			}
		}

		// Normalize target IE uses srcElement
		if (!event.target) {
			event.target = event.srcElement || document;
		}

		// Experimental shadow dom support
		if (Env.experimentalShadowDom) {
			event.target = getTargetFromShadowDom(originalEvent, event.target);
		}

		// Calculate pageX/Y if missing and clientX/Y available
		if (originalEvent && mouseEventRe.test(originalEvent.type) && originalEvent.pageX === undef && originalEvent.clientX !== undef) {
			var eventDoc = event.target.ownerDocument || document;
			var doc = eventDoc.documentElement;
			var body = eventDoc.body;

			event.pageX = originalEvent.clientX + (doc && doc.scrollLeft || body && body.scrollLeft || 0) -
				(doc && doc.clientLeft || body && body.clientLeft || 0);

			event.pageY = originalEvent.clientY + (doc && doc.scrollTop || body && body.scrollTop || 0) -
				(doc && doc.clientTop || body && body.clientTop || 0);
		}

		// Add preventDefault method
		event.preventDefault = function() {
			event.isDefaultPrevented = returnTrue;

			// Execute preventDefault on the original event object
			if (originalEvent) {
				if (originalEvent.preventDefault) {
					originalEvent.preventDefault();
				} else {
					originalEvent.returnValue = false; // IE
				}
			}
		};

		// Add stopPropagation
		event.stopPropagation = function() {
			event.isPropagationStopped = returnTrue;

			// Execute stopPropagation on the original event object
			if (originalEvent) {
				if (originalEvent.stopPropagation) {
					originalEvent.stopPropagation();
				} else {
					originalEvent.cancelBubble = true; // IE
				}
			}
		};

		// Add stopImmediatePropagation
		event.stopImmediatePropagation = function() {
			event.isImmediatePropagationStopped = returnTrue;
			event.stopPropagation();
		};

		// Add event delegation states
		if (!event.isDefaultPrevented) {
			event.isDefaultPrevented = returnFalse;
			event.isPropagationStopped = returnFalse;
			event.isImmediatePropagationStopped = returnFalse;
		}

		// Add missing metaKey for IE 8
		if (typeof event.metaKey == 'undefined') {
			event.metaKey = false;
		}

		return event;
	}

	/**
	 * Bind a DOMContentLoaded event across browsers and executes the callback once the page DOM is initialized.
	 * It will also set/check the domLoaded state of the event_utils instance so ready isn't called multiple times.
	 */
	function bindOnReady(win, callback, eventUtils) {
		var doc = win.document, event = {type: 'ready'};

		if (eventUtils.domLoaded) {
			callback(event);
			return;
		}

		// Gets called when the DOM is ready
		function readyHandler() {
			if (!eventUtils.domLoaded) {
				eventUtils.domLoaded = true;
				callback(event);
			}
		}

		function waitForDomLoaded() {
			// Check complete or interactive state if there is a body
			// element on some iframes IE 8 will produce a null body
			if (doc.readyState === "complete" || (doc.readyState === "interactive" && doc.body)) {
				removeEvent(doc, "readystatechange", waitForDomLoaded);
				readyHandler();
			}
		}

		function tryScroll() {
			try {
				// If IE is used, use the trick by Diego Perini licensed under MIT by request to the author.
				// http://javascript.nwbox.com/IEContentLoaded/
				doc.documentElement.doScroll("left");
			} catch (ex) {
				Delay.setTimeout(tryScroll);
				return;
			}

			readyHandler();
		}

		// Use W3C method
		if (doc.addEventListener) {
			if (doc.readyState === "complete") {
				readyHandler();
			} else {
				addEvent(win, 'DOMContentLoaded', readyHandler);
			}
		} else {
			// Use IE method
			addEvent(doc, "readystatechange", waitForDomLoaded);

			// Wait until we can scroll, when we can the DOM is initialized
			if (doc.documentElement.doScroll && win.self === win.top) {
				tryScroll();
			}
		}

		// Fallback if any of the above methods should fail for some odd reason
		addEvent(win, 'load', readyHandler);
	}

	/**
	 * This class enables you to bind/unbind native events to elements and normalize it's behavior across browsers.
	 */
	function EventUtils() {
		var self = this, events = {}, count, expando, hasFocusIn, hasMouseEnterLeave, mouseEnterLeave;

		expando = eventExpandoPrefix + (+new Date()).toString(32);
		hasMouseEnterLeave = "onmouseenter" in document.documentElement;
		hasFocusIn = "onfocusin" in document.documentElement;
		mouseEnterLeave = {mouseenter: 'mouseover', mouseleave: 'mouseout'};
		count = 1;

		// State if the DOMContentLoaded was executed or not
		self.domLoaded = false;
		self.events = events;

		/**
		 * Executes all event handler callbacks for a specific event.
		 *
		 * @private
		 * @param {Event} evt Event object.
		 * @param {String} id Expando id value to look for.
		 */
		function executeHandlers(evt, id) {
			var callbackList, i, l, callback, container = events[id];

			callbackList = container && container[evt.type];
			if (callbackList) {
				for (i = 0, l = callbackList.length; i < l; i++) {
					callback = callbackList[i];

					// Check if callback exists might be removed if a unbind is called inside the callback
					if (callback && callback.func.call(callback.scope, evt) === false) {
						evt.preventDefault();
					}

					// Should we stop propagation to immediate listeners
					if (evt.isImmediatePropagationStopped()) {
						return;
					}
				}
			}
		}

		/**
		 * Binds a callback to an event on the specified target.
		 *
		 * @method bind
		 * @param {Object} target Target node/window or custom object.
		 * @param {String} names Name of the event to bind.
		 * @param {function} callback Callback function to execute when the event occurs.
		 * @param {Object} scope Scope to call the callback function on, defaults to target.
		 * @return {function} Callback function that got bound.
		 */
		self.bind = function(target, names, callback, scope) {
			var id, callbackList, i, name, fakeName, nativeHandler, capture, win = window;

			// Native event handler function patches the event and executes the callbacks for the expando
			function defaultNativeHandler(evt) {
				executeHandlers(fix(evt || win.event), id);
			}

			// Don't bind to text nodes or comments
			if (!target || target.nodeType === 3 || target.nodeType === 8) {
				return;
			}

			// Create or get events id for the target
			if (!target[expando]) {
				id = count++;
				target[expando] = id;
				events[id] = {};
			} else {
				id = target[expando];
			}

			// Setup the specified scope or use the target as a default
			scope = scope || target;

			// Split names and bind each event, enables you to bind multiple events with one call
			names = names.split(' ');
			i = names.length;
			while (i--) {
				name = names[i];
				nativeHandler = defaultNativeHandler;
				fakeName = capture = false;

				// Use ready instead of DOMContentLoaded
				if (name === "DOMContentLoaded") {
					name = "ready";
				}

				// DOM is already ready
				if (self.domLoaded && name === "ready" && target.readyState == 'complete') {
					callback.call(scope, fix({type: name}));
					continue;
				}

				// Handle mouseenter/mouseleaver
				if (!hasMouseEnterLeave) {
					fakeName = mouseEnterLeave[name];

					if (fakeName) {
						nativeHandler = function(evt) {
							var current, related;

							current = evt.currentTarget;
							related = evt.relatedTarget;

							// Check if related is inside the current target if it's not then the event should
							// be ignored since it's a mouseover/mouseout inside the element
							if (related && current.contains) {
								// Use contains for performance
								related = current.contains(related);
							} else {
								while (related && related !== current) {
									related = related.parentNode;
								}
							}

							// Fire fake event
							if (!related) {
								evt = fix(evt || win.event);
								evt.type = evt.type === 'mouseout' ? 'mouseleave' : 'mouseenter';
								evt.target = current;
								executeHandlers(evt, id);
							}
						};
					}
				}

				// Fake bubbling of focusin/focusout
				if (!hasFocusIn && (name === "focusin" || name === "focusout")) {
					capture = true;
					fakeName = name === "focusin" ? "focus" : "blur";
					nativeHandler = function(evt) {
						evt = fix(evt || win.event);
						evt.type = evt.type === 'focus' ? 'focusin' : 'focusout';
						executeHandlers(evt, id);
					};
				}

				// Setup callback list and bind native event
				callbackList = events[id][name];
				if (!callbackList) {
					events[id][name] = callbackList = [{func: callback, scope: scope}];
					callbackList.fakeName = fakeName;
					callbackList.capture = capture;
					//callbackList.callback = callback;

					// Add the nativeHandler to the callback list so that we can later unbind it
					callbackList.nativeHandler = nativeHandler;

					// Check if the target has native events support

					if (name === "ready") {
						bindOnReady(target, nativeHandler, self);
					} else {
						addEvent(target, fakeName || name, nativeHandler, capture);
					}
				} else {
					if (name === "ready" && self.domLoaded) {
						callback({type: name});
					} else {
						// If it already has an native handler then just push the callback
						callbackList.push({func: callback, scope: scope});
					}
				}
			}

			target = callbackList = 0; // Clean memory for IE

			return callback;
		};

		/**
		 * Unbinds the specified event by name, name and callback or all events on the target.
		 *
		 * @method unbind
		 * @param {Object} target Target node/window or custom object.
		 * @param {String} names Optional event name to unbind.
		 * @param {function} callback Optional callback function to unbind.
		 * @return {EventUtils} Event utils instance.
		 */
		self.unbind = function(target, names, callback) {
			var id, callbackList, i, ci, name, eventMap;

			// Don't bind to text nodes or comments
			if (!target || target.nodeType === 3 || target.nodeType === 8) {
				return self;
			}

			// Unbind event or events if the target has the expando
			id = target[expando];
			if (id) {
				eventMap = events[id];

				// Specific callback
				if (names) {
					names = names.split(' ');
					i = names.length;
					while (i--) {
						name = names[i];
						callbackList = eventMap[name];

						// Unbind the event if it exists in the map
						if (callbackList) {
							// Remove specified callback
							if (callback) {
								ci = callbackList.length;
								while (ci--) {
									if (callbackList[ci].func === callback) {
										var nativeHandler = callbackList.nativeHandler;
										var fakeName = callbackList.fakeName, capture = callbackList.capture;

										// Clone callbackList since unbind inside a callback would otherwise break the handlers loop
										callbackList = callbackList.slice(0, ci).concat(callbackList.slice(ci + 1));
										callbackList.nativeHandler = nativeHandler;
										callbackList.fakeName = fakeName;
										callbackList.capture = capture;

										eventMap[name] = callbackList;
									}
								}
							}

							// Remove all callbacks if there isn't a specified callback or there is no callbacks left
							if (!callback || callbackList.length === 0) {
								delete eventMap[name];
								removeEvent(target, callbackList.fakeName || name, callbackList.nativeHandler, callbackList.capture);
							}
						}
					}
				} else {
					// All events for a specific element
					for (name in eventMap) {
						callbackList = eventMap[name];
						removeEvent(target, callbackList.fakeName || name, callbackList.nativeHandler, callbackList.capture);
					}

					eventMap = {};
				}

				// Check if object is empty, if it isn't then we won't remove the expando map
				for (name in eventMap) {
					return self;
				}

				// Delete event object
				delete events[id];

				// Remove expando from target
				try {
					// IE will fail here since it can't delete properties from window
					delete target[expando];
				} catch (ex) {
					// IE will set it to null
					target[expando] = null;
				}
			}

			return self;
		};

		/**
		 * Fires the specified event on the specified target.
		 *
		 * @method fire
		 * @param {Object} target Target node/window or custom object.
		 * @param {String} name Event name to fire.
		 * @param {Object} args Optional arguments to send to the observers.
		 * @return {EventUtils} Event utils instance.
		 */
		self.fire = function(target, name, args) {
			var id;

			// Don't bind to text nodes or comments
			if (!target || target.nodeType === 3 || target.nodeType === 8) {
				return self;
			}

			// Build event object by patching the args
			args = fix(null, args);
			args.type = name;
			args.target = target;

			do {
				// Found an expando that means there is listeners to execute
				id = target[expando];
				if (id) {
					executeHandlers(args, id);
				}

				// Walk up the DOM
				target = target.parentNode || target.ownerDocument || target.defaultView || target.parentWindow;
			} while (target && !args.isPropagationStopped());

			return self;
		};

		/**
		 * Removes all bound event listeners for the specified target. This will also remove any bound
		 * listeners to child nodes within that target.
		 *
		 * @method clean
		 * @param {Object} target Target node/window object.
		 * @return {EventUtils} Event utils instance.
		 */
		self.clean = function(target) {
			var i, children, unbind = self.unbind;

			// Don't bind to text nodes or comments
			if (!target || target.nodeType === 3 || target.nodeType === 8) {
				return self;
			}

			// Unbind any element on the specified target
			if (target[expando]) {
				unbind(target);
			}

			// Target doesn't have getElementsByTagName it's probably a window object then use it's document to find the children
			if (!target.getElementsByTagName) {
				target = target.document;
			}

			// Remove events from each child element
			if (target && target.getElementsByTagName) {
				unbind(target);

				children = target.getElementsByTagName('*');
				i = children.length;
				while (i--) {
					target = children[i];

					if (target[expando]) {
						unbind(target);
					}
				}
			}

			return self;
		};

		/**
		 * Destroys the event object. Call this on IE to remove memory leaks.
		 */
		self.destroy = function() {
			events = {};
		};

		// Legacy function for canceling events
		self.cancel = function(e) {
			if (e) {
				e.preventDefault();
				e.stopImmediatePropagation();
			}

			return false;
		};
	}

	EventUtils.Event = new EventUtils();
	EventUtils.Event.bind(window, 'ready', function() {});

	return EventUtils;
});

// Included from: js/tinymce/classes/dom/Sizzle.js

/**
 * Sizzle.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 *
 * @ignore-file
 */

/*jshint bitwise:false, expr:true, noempty:false, sub:true, eqnull:true, latedef:false, maxlen:255 */
/*eslint-disable */

/**
 * Sizzle CSS Selector Engine v@VERSION
 * http://sizzlejs.com/
 *
 * Copyright 2008, 2014 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: @DATE
 */
define("tinymce/dom/Sizzle", [], function() {
var i,
	support,
	Expr,
	getText,
	isXML,
	tokenize,
	compile,
	select,
	outermostContext,
	sortInput,
	hasDuplicate,

	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,

	// Instance-specific data
	expando = "sizzle" + -(new Date()),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
		}
		return 0;
	},

	// General-purpose constants
	strundefined = typeof undefined,
	MAX_NEGATIVE = 1 << 31,

	// Instance methods
	hasOwn = ({}).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	push_native = arr.push,
	push = arr.push,
	slice = arr.slice,
	// Use a stripped-down indexOf if we can't use a native one
	indexOf = arr.indexOf || function( elem ) {
		var i = 0,
			len = this.length;
		for ( ; i < len; i++ ) {
			if ( this[i] === elem ) {
				return i;
			}
		}
		return -1;
	},

	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",

	// Regular expressions

	// http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",

	// http://www.w3.org/TR/CSS21/syndata.html#value-def-identifier
	identifier = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",

	// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + identifier + ")(?:" + whitespace +
		// Operator (capture 2)
		"*([*^$|!~]?=)" + whitespace +
		// "Attribute values must be CSS identifiers [capture 5] or strings [capture 3 or capture 4]"
		"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + identifier + "))|)" + whitespace +
		"*\\]",

	pseudos = ":(" + identifier + ")(?:\\((" +
		// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
		// 1. quoted (capture 3; capture 4 or capture 5)
		"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|" +
		// 2. simple (capture 6)
		"((?:\\\\.|[^\\\\()[\\]]|" + attributes + ")*)|" +
		// 3. anything else (capture 2)
		".*" +
		")\\)|)",

	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" + whitespace + "+$", "g" ),

	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace + "*" ),

	rattributeQuotes = new RegExp( "=" + whitespace + "*([^\\]'\"]*?)" + whitespace + "*\\]", "g" ),

	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),

	matchExpr = {
		"ID": new RegExp( "^#(" + identifier + ")" ),
		"CLASS": new RegExp( "^\\.(" + identifier + ")" ),
		"TAG": new RegExp( "^(" + identifier + "|[*])" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + whitespace +
			"*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" + whitespace +
			"*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),
		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
			whitespace + "*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},

	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,

	rnative = /^[^{]+\{\s*\[native \w/,

	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,

	rsibling = /[+~]/,
	rescape = /'|\\/g,

	// CSS escapes http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\([\\da-f]{1,6}" + whitespace + "?|(" + whitespace + ")|.)", "ig" ),
	funescape = function( _, escaped, escapedWhitespace ) {
		var high = "0x" + escaped - 0x10000;
		// NaN means non-codepoint
		// Support: Firefox<24
		// Workaround erroneous numeric interpretation of +"0x"
		return high !== high || escapedWhitespace ?
			escaped :
			high < 0 ?
				// BMP codepoint
				String.fromCharCode( high + 0x10000 ) :
				// Supplemental Plane codepoint (surrogate pair)
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	};

// Optimize for push.apply( _, NodeList )
try {
	push.apply(
		(arr = slice.call( preferredDoc.childNodes )),
		preferredDoc.childNodes
	);
	// Support: Android<4.0
	// Detect silently failing push.apply
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?

		// Leverage slice if possible
		function( target, els ) {
			push_native.apply( target, slice.call(els) );
		} :

		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;
			// Can't trust NodeList.length
			while ( (target[j++] = els[i++]) ) {}
			target.length = j - 1;
		}
	};
}

function Sizzle( selector, context, results, seed ) {
	var match, elem, m, nodeType,
		// QSA vars
		i, groups, old, nid, newContext, newSelector;

	if ( ( context ? context.ownerDocument || context : preferredDoc ) !== document ) {
		setDocument( context );
	}

	context = context || document;
	results = results || [];

	if ( !selector || typeof selector !== "string" ) {
		return results;
	}

	if ( (nodeType = context.nodeType) !== 1 && nodeType !== 9 ) {
		return [];
	}

	if ( documentIsHTML && !seed ) {

		// Shortcuts
		if ( (match = rquickExpr.exec( selector )) ) {
			// Speed-up: Sizzle("#ID")
			if ( (m = match[1]) ) {
				if ( nodeType === 9 ) {
					elem = context.getElementById( m );
					// Check parentNode to catch when Blackberry 4.6 returns
					// nodes that are no longer in the document (jQuery #6963)
					if ( elem && elem.parentNode ) {
						// Handle the case where IE, Opera, and Webkit return items
						// by name instead of ID
						if ( elem.id === m ) {
							results.push( elem );
							return results;
						}
					} else {
						return results;
					}
				} else {
					// Context is not a document
					if ( context.ownerDocument && (elem = context.ownerDocument.getElementById( m )) &&
						contains( context, elem ) && elem.id === m ) {
						results.push( elem );
						return results;
					}
				}

			// Speed-up: Sizzle("TAG")
			} else if ( match[2] ) {
				push.apply( results, context.getElementsByTagName( selector ) );
				return results;

			// Speed-up: Sizzle(".CLASS")
			} else if ( (m = match[3]) && support.getElementsByClassName ) {
				push.apply( results, context.getElementsByClassName( m ) );
				return results;
			}
		}

		// QSA path
		if ( support.qsa && (!rbuggyQSA || !rbuggyQSA.test( selector )) ) {
			nid = old = expando;
			newContext = context;
			newSelector = nodeType === 9 && selector;

			// qSA works strangely on Element-rooted queries
			// We can work around this by specifying an extra ID on the root
			// and working up from there (Thanks to Andrew Dupont for the technique)
			// IE 8 doesn't work on object elements
			if ( nodeType === 1 && context.nodeName.toLowerCase() !== "object" ) {
				groups = tokenize( selector );

				if ( (old = context.getAttribute("id")) ) {
					nid = old.replace( rescape, "\\$&" );
				} else {
					context.setAttribute( "id", nid );
				}
				nid = "[id='" + nid + "'] ";

				i = groups.length;
				while ( i-- ) {
					groups[i] = nid + toSelector( groups[i] );
				}
				newContext = rsibling.test( selector ) && testContext( context.parentNode ) || context;
				newSelector = groups.join(",");
			}

			if ( newSelector ) {
				try {
					push.apply( results,
						newContext.querySelectorAll( newSelector )
					);
					return results;
				} catch(qsaError) {
				} finally {
					if ( !old ) {
						context.removeAttribute("id");
					}
				}
			}
		}
	}

	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}

/**
 * Create key-value caches of limited size
 * @returns {Function(string, Object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function createCache() {
	var keys = [];

	function cache( key, value ) {
		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key + " " ) > Expr.cacheLength ) {
			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return (cache[ key + " " ] = value);
	}
	return cache;
}

/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}

/**
 * Support testing using an element
 * @param {Function} fn Passed the created div and expects a boolean result
 */
function assert( fn ) {
	var div = document.createElement("div");

	try {
		return !!fn( div );
	} catch (e) {
		return false;
	} finally {
		// Remove from its parent by default
		if ( div.parentNode ) {
			div.parentNode.removeChild( div );
		}
		// release memory in IE
		div = null;
	}
}

/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function addHandle( attrs, handler ) {
	var arr = attrs.split("|"),
		i = attrs.length;

	while ( i-- ) {
		Expr.attrHandle[ arr[i] ] = handler;
	}
}

/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			( ~b.sourceIndex || MAX_NEGATIVE ) -
			( ~a.sourceIndex || MAX_NEGATIVE );

	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}

	// Check if b follows a
	if ( cur ) {
		while ( (cur = cur.nextSibling) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}

	return a ? 1 : -1;
}

/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return (name === "input" || name === "button") && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function createPositionalPseudo( fn ) {
	return markFunction(function( argument ) {
		argument = +argument;
		return markFunction(function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;

			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ (j = matchIndexes[i]) ] ) {
					seed[j] = !(matches[j] = seed[j]);
				}
			}
		});
	});
}

/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function testContext( context ) {
	return context && typeof context.getElementsByTagName !== strundefined && context;
}

// Expose support vars for convenience
support = Sizzle.support = {};

/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
isXML = Sizzle.isXML = function( elem ) {
	// documentElement is verified for cases where it doesn't yet exist
	// (such as loading iframes in IE - #4833)
	var documentElement = elem && (elem.ownerDocument || elem).documentElement;
	return documentElement ? documentElement.nodeName !== "HTML" : false;
};

/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
setDocument = Sizzle.setDocument = function( node ) {
	var hasCompare,
		doc = node ? node.ownerDocument || node : preferredDoc,
		parent = doc.defaultView;

	function getTop(win) {
		// Edge throws a lovely Object expected if you try to get top on a detached reference see #2642
		try {
			return win.top;
		} catch (ex) {
			// Ignore
		}

		return null;
	}

	// If no document and documentElement is available, return
	if ( doc === document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}

	// Set our document
	document = doc;
	docElem = doc.documentElement;

	// Support tests
	documentIsHTML = !isXML( doc );

	// Support: IE>8
	// If iframe document is assigned to "document" variable and if iframe has been reloaded,
	// IE will throw "permission denied" error when accessing "document" variable, see jQuery #13936
	// IE6-8 do not support the defaultView property so parent will be undefined
	if ( parent && parent !== getTop(parent) ) {
		// IE11 does not have attachEvent, so all must suffer
		if ( parent.addEventListener ) {
			parent.addEventListener( "unload", function() {
				setDocument();
			}, false );
		} else if ( parent.attachEvent ) {
			parent.attachEvent( "onunload", function() {
				setDocument();
			});
		}
	}

	/* Attributes
	---------------------------------------------------------------------- */

	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties (excepting IE8 booleans)
	support.attributes = assert(function( div ) {
		div.className = "i";
		return !div.getAttribute("className");
	});

	/* getElement(s)By*
	---------------------------------------------------------------------- */

	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert(function( div ) {
		div.appendChild( doc.createComment("") );
		return !div.getElementsByTagName("*").length;
	});

	// Support: IE<9
	support.getElementsByClassName = rnative.test( doc.getElementsByClassName );

	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert(function( div ) {
		docElem.appendChild( div ).id = expando;
		return !doc.getElementsByName || !doc.getElementsByName( expando ).length;
	});

	// ID find and filter
	if ( support.getById ) {
		Expr.find["ID"] = function( id, context ) {
			if ( typeof context.getElementById !== strundefined && documentIsHTML ) {
				var m = context.getElementById( id );
				// Check parentNode to catch when Blackberry 4.6 returns
				// nodes that are no longer in the document #6963
				return m && m.parentNode ? [ m ] : [];
			}
		};
		Expr.filter["ID"] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute("id") === attrId;
			};
		};
	} else {
		// Support: IE6/7
		// getElementById is not reliable as a find shortcut
		delete Expr.find["ID"];

		Expr.filter["ID"] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== strundefined && elem.getAttributeNode("id");
				return node && node.value === attrId;
			};
		};
	}

	// Tag
	Expr.find["TAG"] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== strundefined ) {
				return context.getElementsByTagName( tag );
			}
		} :
		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,
				results = context.getElementsByTagName( tag );

			// Filter out possible comments
			if ( tag === "*" ) {
				while ( (elem = results[i++]) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}

				return tmp;
			}
			return results;
		};

	// Class
	Expr.find["CLASS"] = support.getElementsByClassName && function( className, context ) {
		if ( documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};

	/* QSA/matchesSelector
	---------------------------------------------------------------------- */

	// QSA and matchesSelector support

	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];

	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See http://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];

	if ( (support.qsa = rnative.test( doc.querySelectorAll )) ) {
		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert(function( div ) {
			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// http://bugs.jquery.com/ticket/12359
			div.innerHTML = "<select msallowcapture=''><option selected=''></option></select>";

			// Support: IE8, Opera 11-12.16
			// Nothing should be selected when empty strings follow ^= or $= or *=
			// The test attribute must be unknown in Opera but "safe" for WinRT
			// http://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
			if ( div.querySelectorAll("[msallowcapture^='']").length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}

			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !div.querySelectorAll("[selected]").length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}

			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":checked").length ) {
				rbuggyQSA.push(":checked");
			}
		});

		assert(function( div ) {
			// Support: Windows 8 Native Apps
			// The type and name attributes are restricted during .innerHTML assignment
			var input = doc.createElement("input");
			input.setAttribute( "type", "hidden" );
			div.appendChild( input ).setAttribute( "name", "D" );

			// Support: IE8
			// Enforce case-sensitivity of name attribute
			if ( div.querySelectorAll("[name=d]").length ) {
				rbuggyQSA.push( "name" + whitespace + "*[*^$|!~]?=" );
			}

			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":enabled").length ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Opera 10-11 does not throw on post-comma invalid pseudos
			div.querySelectorAll("*,:x");
			rbuggyQSA.push(",.*:");
		});
	}

	if ( (support.matchesSelector = rnative.test( (matches = docElem.matches ||
		docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector) )) ) {

		assert(function( div ) {
			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( div, "div" );

			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( div, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		});
	}

	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join("|") );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join("|") );

	/* Contains
	---------------------------------------------------------------------- */
	hasCompare = rnative.test( docElem.compareDocumentPosition );

	// Element contains another
	// Purposefully does not implement inclusive descendent
	// As in, an element does not contain itself
	contains = hasCompare || rnative.test( docElem.contains ) ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			));
		} :
		function( a, b ) {
			if ( b ) {
				while ( (b = b.parentNode) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};

	/* Sorting
	---------------------------------------------------------------------- */

	// Document order sorting
	sortOrder = hasCompare ?
	function( a, b ) {

		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		// Sort on method existence if only one input has compareDocumentPosition
		var compare = !a.compareDocumentPosition - !b.compareDocumentPosition;
		if ( compare ) {
			return compare;
		}

		// Calculate position if both inputs belong to the same document
		compare = ( a.ownerDocument || a ) === ( b.ownerDocument || b ) ?
			a.compareDocumentPosition( b ) :

			// Otherwise we know they are disconnected
			1;

		// Disconnected nodes
		if ( compare & 1 ||
			(!support.sortDetached && b.compareDocumentPosition( a ) === compare) ) {

			// Choose the first element that is related to our preferred document
			if ( a === doc || a.ownerDocument === preferredDoc && contains(preferredDoc, a) ) {
				return -1;
			}
			if ( b === doc || b.ownerDocument === preferredDoc && contains(preferredDoc, b) ) {
				return 1;
			}

			// Maintain original order
			return sortInput ?
				( indexOf.call( sortInput, a ) - indexOf.call( sortInput, b ) ) :
				0;
		}

		return compare & 4 ? -1 : 1;
	} :
	function( a, b ) {
		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];

		// Parentless nodes are either documents or disconnected
		if ( !aup || !bup ) {
			return a === doc ? -1 :
				b === doc ? 1 :
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf.call( sortInput, a ) - indexOf.call( sortInput, b ) ) :
				0;

		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}

		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( (cur = cur.parentNode) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( (cur = cur.parentNode) ) {
			bp.unshift( cur );
		}

		// Walk down the tree looking for a discrepancy
		while ( ap[i] === bp[i] ) {
			i++;
		}

		return i ?
			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[i], bp[i] ) :

			// Otherwise nodes in our document sort first
			ap[i] === preferredDoc ? -1 :
			bp[i] === preferredDoc ? 1 :
			0;
	};

	return doc;
};

Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};

Sizzle.matchesSelector = function( elem, expr ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	// Make sure that attribute selectors are quoted
	expr = expr.replace( rattributeQuotes, "='$1']" );

	if ( support.matchesSelector && documentIsHTML &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {

		try {
			var ret = matches.call( elem, expr );

			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||
					// As well, disconnected nodes are said to be in a document
					// fragment in IE 9
					elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch(e) {}
	}

	return Sizzle( expr, document, null, [ elem ] ).length > 0;
};

Sizzle.contains = function( context, elem ) {
	// Set document vars if needed
	if ( ( context.ownerDocument || context ) !== document ) {
		setDocument( context );
	}
	return contains( context, elem );
};

Sizzle.attr = function( elem, name ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	var fn = Expr.attrHandle[ name.toLowerCase() ],
		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;

	return val !== undefined ?
		val :
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			(val = elem.getAttributeNode(name)) && val.specified ?
				val.value :
				null;
};

Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};

/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;

	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );

	if ( hasDuplicate ) {
		while ( (elem = results[i++]) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}

	// Clear input after sorting to release objects
	// See https://github.com/jquery/sizzle/pull/225
	sortInput = null;

	return results;
};

/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;

	if ( !nodeType ) {
		// If no nodeType, this is expected to be an array
		while ( (node = elem[i++]) ) {
			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {
		// Use textContent for elements
		// innerText usage removed for consistency of new lines (jQuery #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {
			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}
	// Do not include comment or processing instruction nodes

	return ret;
};

Expr = Sizzle.selectors = {

	// Can be adjusted by the user
	cacheLength: 50,

	createPseudo: markFunction,

	match: matchExpr,

	attrHandle: {},

	find: {},

	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},

	preFilter: {
		"ATTR": function( match ) {
			match[1] = match[1].replace( runescape, funescape );

			// Move the given value to match[3] whether quoted or unquoted
			match[3] = ( match[3] || match[4] || match[5] || "" ).replace( runescape, funescape );

			if ( match[2] === "~=" ) {
				match[3] = " " + match[3] + " ";
			}

			return match.slice( 0, 4 );
		},

		"CHILD": function( match ) {
			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[1] = match[1].toLowerCase();

			if ( match[1].slice( 0, 3 ) === "nth" ) {
				// nth-* requires argument
				if ( !match[3] ) {
					Sizzle.error( match[0] );
				}

				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[4] = +( match[4] ? match[5] + (match[6] || 1) : 2 * ( match[3] === "even" || match[3] === "odd" ) );
				match[5] = +( ( match[7] + match[8] ) || match[3] === "odd" );

			// other types prohibit arguments
			} else if ( match[3] ) {
				Sizzle.error( match[0] );
			}

			return match;
		},

		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[6] && match[2];

			if ( matchExpr["CHILD"].test( match[0] ) ) {
				return null;
			}

			// Accept quoted arguments as-is
			if ( match[3] ) {
				match[2] = match[4] || match[5] || "";

			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&
				// Get excess from tokenize (recursively)
				(excess = tokenize( unquoted, true )) &&
				// advance to the next closing parenthesis
				(excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length) ) {

				// excess is a negative index
				match[0] = match[0].slice( 0, excess );
				match[2] = unquoted.slice( 0, excess );
			}

			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},

	filter: {

		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() { return true; } :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},

		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];

			return pattern ||
				(pattern = new RegExp( "(^|" + whitespace + ")" + className + "(" + whitespace + "|$)" )) &&
				classCache( className, function( elem ) {
					return pattern.test( typeof elem.className === "string" && elem.className || typeof elem.getAttribute !== strundefined && elem.getAttribute("class") || "" );
				});
		},

		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );

				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}

				result += "";

				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
			};
		},

		"CHILD": function( type, what, argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";

			return first === 1 && last === 0 ?

				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :

				function( elem, context, xml ) {
					var cache, outerCache, node, diff, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType;

					if ( parent ) {

						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( (node = node[ dir ]) ) {
									if ( ofType ? node.nodeName.toLowerCase() === name : node.nodeType === 1 ) {
										return false;
									}
								}
								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}

						start = [ forward ? parent.firstChild : parent.lastChild ];

						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {
							// Seek `elem` from a previously-cached index
							outerCache = parent[ expando ] || (parent[ expando ] = {});
							cache = outerCache[ type ] || [];
							nodeIndex = cache[0] === dirruns && cache[1];
							diff = cache[0] === dirruns && cache[2];
							node = nodeIndex && parent.childNodes[ nodeIndex ];

							while ( (node = ++nodeIndex && node && node[ dir ] ||

								// Fallback to seeking `elem` from the start
								(diff = nodeIndex = 0) || start.pop()) ) {

								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									outerCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}

						// Use previously-cached element index if available
						} else if ( useCache && (cache = (elem[ expando ] || (elem[ expando ] = {}))[ type ]) && cache[0] === dirruns ) {
							diff = cache[1];

						// xml :nth-child(...) or :nth-last-child(...) or :nth(-last)?-of-type(...)
						} else {
							// Use the same loop as above to seek `elem` from the start
							while ( (node = ++nodeIndex && node && node[ dir ] ||
								(diff = nodeIndex = 0) || start.pop()) ) {

								if ( ( ofType ? node.nodeName.toLowerCase() === name : node.nodeType === 1 ) && ++diff ) {
									// Cache the index of each encountered element
									if ( useCache ) {
										(node[ expando ] || (node[ expando ] = {}))[ type ] = [ dirruns, diff ];
									}

									if ( node === elem ) {
										break;
									}
								}
							}
						}

						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},

		"PSEUDO": function( pseudo, argument ) {
			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );

			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}

			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction(function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf.call( seed, matched[i] );
							seed[ idx ] = !( matches[ idx ] = matched[i] );
						}
					}) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}

			return fn;
		}
	},

	pseudos: {
		// Potentially complex pseudos
		"not": markFunction(function( selector ) {
			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );

			return matcher[ expando ] ?
				markFunction(function( seed, matches, context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;

					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( (elem = unmatched[i]) ) {
							seed[i] = !(matches[i] = elem);
						}
					}
				}) :
				function( elem, context, xml ) {
					input[0] = elem;
					matcher( input, null, xml, results );
					return !results.pop();
				};
		}),

		"has": markFunction(function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		}),

		"contains": markFunction(function( text ) {
			text = text.replace( runescape, funescape );
			return function( elem ) {
				return ( elem.textContent || elem.innerText || getText( elem ) ).indexOf( text ) > -1;
			};
		}),

		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {
			// lang value must be a valid identifier
			if ( !ridentifier.test(lang || "") ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( (elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute("xml:lang") || elem.getAttribute("lang")) ) {

						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( (elem = elem.parentNode) && elem.nodeType === 1 );
				return false;
			};
		}),

		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},

		"root": function( elem ) {
			return elem === docElem;
		},

		"focus": function( elem ) {
			return elem === document.activeElement && (!document.hasFocus || document.hasFocus()) && !!(elem.type || elem.href || ~elem.tabIndex);
		},

		// Boolean properties
		"enabled": function( elem ) {
			return elem.disabled === false;
		},

		"disabled": function( elem ) {
			return elem.disabled === true;
		},

		"checked": function( elem ) {
			// In CSS3, :checked should return both checked and selected elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			var nodeName = elem.nodeName.toLowerCase();
			return (nodeName === "input" && !!elem.checked) || (nodeName === "option" && !!elem.selected);
		},

		"selected": function( elem ) {
			// Accessing this property makes selected-by-default
			// options in Safari work properly
			if ( elem.parentNode ) {
				elem.parentNode.selectedIndex;
			}

			return elem.selected === true;
		},

		// Contents
		"empty": function( elem ) {
			// http://www.w3.org/TR/selectors/#empty-pseudo
			// :empty is negated by element (1) or content nodes (text: 3; cdata: 4; entity ref: 5),
			//   but not by others (comment: 8; processing instruction: 7; etc.)
			// nodeType < 6 works because attributes (2) do not appear as children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				if ( elem.nodeType < 6 ) {
					return false;
				}
			}
			return true;
		},

		"parent": function( elem ) {
			return !Expr.pseudos["empty"]( elem );
		},

		// Element/input types
		"header": function( elem ) {
			return rheader.test( elem.nodeName );
		},

		"input": function( elem ) {
			return rinputs.test( elem.nodeName );
		},

		"button": function( elem ) {
			var name = elem.nodeName.toLowerCase();
			return name === "input" && elem.type === "button" || name === "button";
		},

		"text": function( elem ) {
			var attr;
			return elem.nodeName.toLowerCase() === "input" &&
				elem.type === "text" &&

				// Support: IE<8
				// New HTML5 attribute values (e.g., "search") appear with elem.type === "text"
				( (attr = elem.getAttribute("type")) == null || attr.toLowerCase() === "text" );
		},

		// Position-in-collection
		"first": createPositionalPseudo(function() {
			return [ 0 ];
		}),

		"last": createPositionalPseudo(function( matchIndexes, length ) {
			return [ length - 1 ];
		}),

		"eq": createPositionalPseudo(function( matchIndexes, length, argument ) {
			return [ argument < 0 ? argument + length : argument ];
		}),

		"even": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 0;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"odd": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 1;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"lt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; --i >= 0; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"gt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; ++i < length; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		})
	}
};

Expr.pseudos["nth"] = Expr.pseudos["eq"];

// Add button/input type pseudos
for ( i in { radio: true, checkbox: true, file: true, password: true, image: true } ) {
	Expr.pseudos[ i ] = createInputPseudo( i );
}
for ( i in { submit: true, reset: true } ) {
	Expr.pseudos[ i ] = createButtonPseudo( i );
}

// Easy API for creating new setFilters
function setFilters() {}
setFilters.prototype = Expr.filters = Expr.pseudos;
Expr.setFilters = new setFilters();

tokenize = Sizzle.tokenize = function( selector, parseOnly ) {
	var matched, match, tokens, type,
		soFar, groups, preFilters,
		cached = tokenCache[ selector + " " ];

	if ( cached ) {
		return parseOnly ? 0 : cached.slice( 0 );
	}

	soFar = selector;
	groups = [];
	preFilters = Expr.preFilter;

	while ( soFar ) {

		// Comma and first run
		if ( !matched || (match = rcomma.exec( soFar )) ) {
			if ( match ) {
				// Don't consume trailing commas as valid
				soFar = soFar.slice( match[0].length ) || soFar;
			}
			groups.push( (tokens = []) );
		}

		matched = false;

		// Combinators
		if ( (match = rcombinators.exec( soFar )) ) {
			matched = match.shift();
			tokens.push({
				value: matched,
				// Cast descendant combinators to space
				type: match[0].replace( rtrim, " " )
			});
			soFar = soFar.slice( matched.length );
		}

		// Filters
		for ( type in Expr.filter ) {
			if ( (match = matchExpr[ type ].exec( soFar )) && (!preFilters[ type ] ||
				(match = preFilters[ type ]( match ))) ) {
				matched = match.shift();
				tokens.push({
					value: matched,
					type: type,
					matches: match
				});
				soFar = soFar.slice( matched.length );
			}
		}

		if ( !matched ) {
			break;
		}
	}

	// Return the length of the invalid excess
	// if we're just parsing
	// Otherwise, throw an error or return tokens
	return parseOnly ?
		soFar.length :
		soFar ?
			Sizzle.error( selector ) :
			// Cache the tokens
			tokenCache( selector, groups ).slice( 0 );
};

function toSelector( tokens ) {
	var i = 0,
		len = tokens.length,
		selector = "";
	for ( ; i < len; i++ ) {
		selector += tokens[i].value;
	}
	return selector;
}

function addCombinator( matcher, combinator, base ) {
	var dir = combinator.dir,
		checkNonElements = base && dir === "parentNode",
		doneName = done++;

	return combinator.first ?
		// Check against closest ancestor/preceding element
		function( elem, context, xml ) {
			while ( (elem = elem[ dir ]) ) {
				if ( elem.nodeType === 1 || checkNonElements ) {
					return matcher( elem, context, xml );
				}
			}
		} :

		// Check against all ancestor/preceding elements
		function( elem, context, xml ) {
			var oldCache, outerCache,
				newCache = [ dirruns, doneName ];

			// We can't set arbitrary data on XML nodes, so they don't benefit from dir caching
			if ( xml ) {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						if ( matcher( elem, context, xml ) ) {
							return true;
						}
					}
				}
			} else {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						outerCache = elem[ expando ] || (elem[ expando ] = {});
						if ( (oldCache = outerCache[ dir ]) &&
							oldCache[ 0 ] === dirruns && oldCache[ 1 ] === doneName ) {

							// Assign to newCache so results back-propagate to previous elements
							return (newCache[ 2 ] = oldCache[ 2 ]);
						} else {
							// Reuse newcache so results back-propagate to previous elements
							outerCache[ dir ] = newCache;

							// A match means we're done; a fail means we have to keep checking
							if ( (newCache[ 2 ] = matcher( elem, context, xml )) ) {
								return true;
							}
						}
					}
				}
			}
		};
}

function elementMatcher( matchers ) {
	return matchers.length > 1 ?
		function( elem, context, xml ) {
			var i = matchers.length;
			while ( i-- ) {
				if ( !matchers[i]( elem, context, xml ) ) {
					return false;
				}
			}
			return true;
		} :
		matchers[0];
}

function multipleContexts( selector, contexts, results ) {
	var i = 0,
		len = contexts.length;
	for ( ; i < len; i++ ) {
		Sizzle( selector, contexts[i], results );
	}
	return results;
}

function condense( unmatched, map, filter, context, xml ) {
	var elem,
		newUnmatched = [],
		i = 0,
		len = unmatched.length,
		mapped = map != null;

	for ( ; i < len; i++ ) {
		if ( (elem = unmatched[i]) ) {
			if ( !filter || filter( elem, context, xml ) ) {
				newUnmatched.push( elem );
				if ( mapped ) {
					map.push( i );
				}
			}
		}
	}

	return newUnmatched;
}

function setMatcher( preFilter, selector, matcher, postFilter, postFinder, postSelector ) {
	if ( postFilter && !postFilter[ expando ] ) {
		postFilter = setMatcher( postFilter );
	}
	if ( postFinder && !postFinder[ expando ] ) {
		postFinder = setMatcher( postFinder, postSelector );
	}
	return markFunction(function( seed, results, context, xml ) {
		var temp, i, elem,
			preMap = [],
			postMap = [],
			preexisting = results.length,

			// Get initial elements from seed or context
			elems = seed || multipleContexts( selector || "*", context.nodeType ? [ context ] : context, [] ),

			// Prefilter to get matcher input, preserving a map for seed-results synchronization
			matcherIn = preFilter && ( seed || !selector ) ?
				condense( elems, preMap, preFilter, context, xml ) :
				elems,

			matcherOut = matcher ?
				// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
				postFinder || ( seed ? preFilter : preexisting || postFilter ) ?

					// ...intermediate processing is necessary
					[] :

					// ...otherwise use results directly
					results :
				matcherIn;

		// Find primary matches
		if ( matcher ) {
			matcher( matcherIn, matcherOut, context, xml );
		}

		// Apply postFilter
		if ( postFilter ) {
			temp = condense( matcherOut, postMap );
			postFilter( temp, [], context, xml );

			// Un-match failing elements by moving them back to matcherIn
			i = temp.length;
			while ( i-- ) {
				if ( (elem = temp[i]) ) {
					matcherOut[ postMap[i] ] = !(matcherIn[ postMap[i] ] = elem);
				}
			}
		}

		if ( seed ) {
			if ( postFinder || preFilter ) {
				if ( postFinder ) {
					// Get the final matcherOut by condensing this intermediate into postFinder contexts
					temp = [];
					i = matcherOut.length;
					while ( i-- ) {
						if ( (elem = matcherOut[i]) ) {
							// Restore matcherIn since elem is not yet a final match
							temp.push( (matcherIn[i] = elem) );
						}
					}
					postFinder( null, (matcherOut = []), temp, xml );
				}

				// Move matched elements from seed to results to keep them synchronized
				i = matcherOut.length;
				while ( i-- ) {
					if ( (elem = matcherOut[i]) &&
						(temp = postFinder ? indexOf.call( seed, elem ) : preMap[i]) > -1 ) {

						seed[temp] = !(results[temp] = elem);
					}
				}
			}

		// Add elements to results, through postFinder if defined
		} else {
			matcherOut = condense(
				matcherOut === results ?
					matcherOut.splice( preexisting, matcherOut.length ) :
					matcherOut
			);
			if ( postFinder ) {
				postFinder( null, results, matcherOut, xml );
			} else {
				push.apply( results, matcherOut );
			}
		}
	});
}

function matcherFromTokens( tokens ) {
	var checkContext, matcher, j,
		len = tokens.length,
		leadingRelative = Expr.relative[ tokens[0].type ],
		implicitRelative = leadingRelative || Expr.relative[" "],
		i = leadingRelative ? 1 : 0,

		// The foundational matcher ensures that elements are reachable from top-level context(s)
		matchContext = addCombinator( function( elem ) {
			return elem === checkContext;
		}, implicitRelative, true ),
		matchAnyContext = addCombinator( function( elem ) {
			return indexOf.call( checkContext, elem ) > -1;
		}, implicitRelative, true ),
		matchers = [ function( elem, context, xml ) {
			return ( !leadingRelative && ( xml || context !== outermostContext ) ) || (
				(checkContext = context).nodeType ?
					matchContext( elem, context, xml ) :
					matchAnyContext( elem, context, xml ) );
		} ];

	for ( ; i < len; i++ ) {
		if ( (matcher = Expr.relative[ tokens[i].type ]) ) {
			matchers = [ addCombinator(elementMatcher( matchers ), matcher) ];
		} else {
			matcher = Expr.filter[ tokens[i].type ].apply( null, tokens[i].matches );

			// Return special upon seeing a positional matcher
			if ( matcher[ expando ] ) {
				// Find the next relative operator (if any) for proper handling
				j = ++i;
				for ( ; j < len; j++ ) {
					if ( Expr.relative[ tokens[j].type ] ) {
						break;
					}
				}
				return setMatcher(
					i > 1 && elementMatcher( matchers ),
					i > 1 && toSelector(
						// If the preceding token was a descendant combinator, insert an implicit any-element `*`
						tokens.slice( 0, i - 1 ).concat({ value: tokens[ i - 2 ].type === " " ? "*" : "" })
					).replace( rtrim, "$1" ),
					matcher,
					i < j && matcherFromTokens( tokens.slice( i, j ) ),
					j < len && matcherFromTokens( (tokens = tokens.slice( j )) ),
					j < len && toSelector( tokens )
				);
			}
			matchers.push( matcher );
		}
	}

	return elementMatcher( matchers );
}

function matcherFromGroupMatchers( elementMatchers, setMatchers ) {
	var bySet = setMatchers.length > 0,
		byElement = elementMatchers.length > 0,
		superMatcher = function( seed, context, xml, results, outermost ) {
			var elem, j, matcher,
				matchedCount = 0,
				i = "0",
				unmatched = seed && [],
				setMatched = [],
				contextBackup = outermostContext,
				// We must always have either seed elements or outermost context
				elems = seed || byElement && Expr.find["TAG"]( "*", outermost ),
				// Use integer dirruns iff this is the outermost matcher
				dirrunsUnique = (dirruns += contextBackup == null ? 1 : Math.random() || 0.1),
				len = elems.length;

			if ( outermost ) {
				outermostContext = context !== document && context;
			}

			// Add elements passing elementMatchers directly to results
			// Keep `i` a string if there are no elements so `matchedCount` will be "00" below
			// Support: IE<9, Safari
			// Tolerate NodeList properties (IE: "length"; Safari: <number>) matching elements by id
			for ( ; i !== len && (elem = elems[i]) != null; i++ ) {
				if ( byElement && elem ) {
					j = 0;
					while ( (matcher = elementMatchers[j++]) ) {
						if ( matcher( elem, context, xml ) ) {
							results.push( elem );
							break;
						}
					}
					if ( outermost ) {
						dirruns = dirrunsUnique;
					}
				}

				// Track unmatched elements for set filters
				if ( bySet ) {
					// They will have gone through all possible matchers
					if ( (elem = !matcher && elem) ) {
						matchedCount--;
					}

					// Lengthen the array for every element, matched or not
					if ( seed ) {
						unmatched.push( elem );
					}
				}
			}

			// Apply set filters to unmatched elements
			matchedCount += i;
			if ( bySet && i !== matchedCount ) {
				j = 0;
				while ( (matcher = setMatchers[j++]) ) {
					matcher( unmatched, setMatched, context, xml );
				}

				if ( seed ) {
					// Reintegrate element matches to eliminate the need for sorting
					if ( matchedCount > 0 ) {
						while ( i-- ) {
							if ( !(unmatched[i] || setMatched[i]) ) {
								setMatched[i] = pop.call( results );
							}
						}
					}

					// Discard index placeholder values to get only actual matches
					setMatched = condense( setMatched );
				}

				// Add matches to results
				push.apply( results, setMatched );

				// Seedless set matches succeeding multiple successful matchers stipulate sorting
				if ( outermost && !seed && setMatched.length > 0 &&
					( matchedCount + setMatchers.length ) > 1 ) {

					Sizzle.uniqueSort( results );
				}
			}

			// Override manipulation of globals by nested matchers
			if ( outermost ) {
				dirruns = dirrunsUnique;
				outermostContext = contextBackup;
			}

			return unmatched;
		};

	return bySet ?
		markFunction( superMatcher ) :
		superMatcher;
}

compile = Sizzle.compile = function( selector, match /* Internal Use Only */ ) {
	var i,
		setMatchers = [],
		elementMatchers = [],
		cached = compilerCache[ selector + " " ];

	if ( !cached ) {
		// Generate a function of recursive functions that can be used to check each element
		if ( !match ) {
			match = tokenize( selector );
		}
		i = match.length;
		while ( i-- ) {
			cached = matcherFromTokens( match[i] );
			if ( cached[ expando ] ) {
				setMatchers.push( cached );
			} else {
				elementMatchers.push( cached );
			}
		}

		// Cache the compiled function
		cached = compilerCache( selector, matcherFromGroupMatchers( elementMatchers, setMatchers ) );

		// Save selector and tokenization
		cached.selector = selector;
	}
	return cached;
};

/**
 * A low-level selection function that works with Sizzle's compiled
 *  selector functions
 * @param {String|Function} selector A selector or a pre-compiled
 *  selector function built with Sizzle.compile
 * @param {Element} context
 * @param {Array} [results]
 * @param {Array} [seed] A set of elements to match against
 */
select = Sizzle.select = function( selector, context, results, seed ) {
	var i, tokens, token, type, find,
		compiled = typeof selector === "function" && selector,
		match = !seed && tokenize( (selector = compiled.selector || selector) );

	results = results || [];

	// Try to minimize operations if there is no seed and only one group
	if ( match.length === 1 ) {

		// Take a shortcut and set the context if the root selector is an ID
		tokens = match[0] = match[0].slice( 0 );
		if ( tokens.length > 2 && (token = tokens[0]).type === "ID" &&
				support.getById && context.nodeType === 9 && documentIsHTML &&
				Expr.relative[ tokens[1].type ] ) {

			context = ( Expr.find["ID"]( token.matches[0].replace(runescape, funescape), context ) || [] )[0];
			if ( !context ) {
				return results;

			// Precompiled matchers will still verify ancestry, so step up a level
			} else if ( compiled ) {
				context = context.parentNode;
			}

			selector = selector.slice( tokens.shift().value.length );
		}

		// Fetch a seed set for right-to-left matching
		i = matchExpr["needsContext"].test( selector ) ? 0 : tokens.length;
		while ( i-- ) {
			token = tokens[i];

			// Abort if we hit a combinator
			if ( Expr.relative[ (type = token.type) ] ) {
				break;
			}
			if ( (find = Expr.find[ type ]) ) {
				// Search, expanding context for leading sibling combinators
				if ( (seed = find(
					token.matches[0].replace( runescape, funescape ),
					rsibling.test( tokens[0].type ) && testContext( context.parentNode ) || context
				)) ) {

					// If seed is empty or no tokens remain, we can return early
					tokens.splice( i, 1 );
					selector = seed.length && toSelector( tokens );
					if ( !selector ) {
						push.apply( results, seed );
						return results;
					}

					break;
				}
			}
		}
	}

	// Compile and execute a filtering function if one is not provided
	// Provide `match` to avoid retokenization if we modified the selector above
	( compiled || compile( selector, match ) )(
		seed,
		context,
		!documentIsHTML,
		results,
		rsibling.test( selector ) && testContext( context.parentNode ) || context
	);
	return results;
};

// One-time assignments

// Sort stability
support.sortStable = expando.split("").sort( sortOrder ).join("") === expando;

// Support: Chrome 14-35+
// Always assume duplicates if they aren't passed to the comparison function
support.detectDuplicates = !!hasDuplicate;

// Initialize against the default document
setDocument();

// Support: Webkit<537.32 - Safari 6.0.3/Chrome 25 (fixed in Chrome 27)
// Detached nodes confoundingly follow *each other*
support.sortDetached = assert(function( div1 ) {
	// Should return 1, but returns 4 (following)
	return div1.compareDocumentPosition( document.createElement("div") ) & 1;
});

// Support: IE<8
// Prevent attribute/property "interpolation"
// http://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if ( !assert(function( div ) {
	div.innerHTML = "<a href='#'></a>";
	return div.firstChild.getAttribute("href") === "#" ;
}) ) {
	addHandle( "type|href|height|width", function( elem, name, isXML ) {
		if ( !isXML ) {
			return elem.getAttribute( name, name.toLowerCase() === "type" ? 1 : 2 );
		}
	});
}

// Support: IE<9
// Use defaultValue in place of getAttribute("value")
if ( !support.attributes || !assert(function( div ) {
	div.innerHTML = "<input/>";
	div.firstChild.setAttribute( "value", "" );
	return div.firstChild.getAttribute( "value" ) === "";
}) ) {
	addHandle( "value", function( elem, name, isXML ) {
		if ( !isXML && elem.nodeName.toLowerCase() === "input" ) {
			return elem.defaultValue;
		}
	});
}

// Support: IE<9
// Use getAttributeNode to fetch booleans when getAttribute lies
if ( !assert(function( div ) {
	return div.getAttribute("disabled") == null;
}) ) {
	addHandle( booleans, function( elem, name, isXML ) {
		var val;
		if ( !isXML ) {
			return elem[ name ] === true ? name.toLowerCase() :
					(val = elem.getAttributeNode( name )) && val.specified ?
					val.value :
				null;
		}
	});
}

// EXPOSE
return Sizzle;
});

/*eslint-enable */

// Included from: js/tinymce/classes/util/Arr.js

/**
 * Arr.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 * Array utility class.
 *
 * @private
 * @class tinymce.util.Arr
 */
define("tinymce/util/Arr", [], function() {
	var isArray = Array.isArray || function(obj) {
		return Object.prototype.toString.call(obj) === "[object Array]";
	};

	function toArray(obj) {
		var array = obj, i, l;

		if (!isArray(obj)) {
			array = [];
			for (i = 0, l = obj.length; i < l; i++) {
				array[i] = obj[i];
			}
		}

		return array;
	}

	function each(o, cb, s) {
		var n, l;

		if (!o) {
			return 0;
		}

		s = s || o;

		if (o.length !== undefined) {
			// Indexed arrays, needed for Safari
			for (n = 0, l = o.length; n < l; n++) {
				if (cb.call(s, o[n], n, o) === false) {
					return 0;
				}
			}
		} else {
			// Hashtables
			for (n in o) {
				if (o.hasOwnProperty(n)) {
					if (cb.call(s, o[n], n, o) === false) {
						return 0;
					}
				}
			}
		}

		return 1;
	}

	function map(array, callback) {
		var out = [];

		each(array, function(item, index) {
			out.push(callback(item, index, array));
		});

		return out;
	}

	function filter(a, f) {
		var o = [];

		each(a, function(v, index) {
			if (!f || f(v, index, a)) {
				o.push(v);
			}
		});

		return o;
	}

	function indexOf(a, v) {
		var i, l;

		if (a) {
			for (i = 0, l = a.length; i < l; i++) {
				if (a[i] === v) {
					return i;
				}
			}
		}

		return -1;
	}

	function reduce(collection, iteratee, accumulator, thisArg) {
		var i = 0;

		if (arguments.length < 3) {
			accumulator = collection[0];
		}

		for (; i < collection.length; i++) {
			accumulator = iteratee.call(thisArg, accumulator, collection[i], i);
		}

		return accumulator;
	}

	function findIndex(array, predicate, thisArg) {
		var i, l;

		for (i = 0, l = array.length; i < l; i++) {
			if (predicate.call(thisArg, array[i], i, array)) {
				return i;
			}
		}

		return -1;
	}

	function find(array, predicate, thisArg) {
		var idx = findIndex(array, predicate, thisArg);

		if (idx !== -1) {
			return array[idx];
		}

		return undefined;
	}

	function last(collection) {
		return collection[collection.length - 1];
	}

	return {
		isArray: isArray,
		toArray: toArray,
		each: each,
		map: map,
		filter: filter,
		indexOf: indexOf,
		reduce: reduce,
		findIndex: findIndex,
		find: find,
		last: last
	};
});

// Included from: js/tinymce/classes/util/Tools.js

/**
 * Tools.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 * This class contains various utlity functions. These are also exposed
 * directly on the tinymce namespace.
 *
 * @class tinymce.util.Tools
 */
define("tinymce/util/Tools", [
	"tinymce/Env",
	"tinymce/util/Arr"
], function(Env, Arr) {
	/**
	 * Removes whitespace from the beginning and end of a string.
	 *
	 * @method trim
	 * @param {String} s String to remove whitespace from.
	 * @return {String} New string with removed whitespace.
	 */
	var whiteSpaceRegExp = /^\s*|\s*$/g;

	function trim(str) {
		return (str === null || str === undefined) ? '' : ("" + str).replace(whiteSpaceRegExp, '');
	}

	/**
	 * Checks if a object is of a specific type for example an array.
	 *
	 * @method is
	 * @param {Object} obj Object to check type of.
	 * @param {string} type Optional type to check for.
	 * @return {Boolean} true/false if the object is of the specified type.
	 */
	function is(obj, type) {
		if (!type) {
			return obj !== undefined;
		}

		if (type == 'array' && Arr.isArray(obj)) {
			return true;
		}

		return typeof obj == type;
	}

	/**
	 * Makes a name/object map out of an array with names.
	 *
	 * @method makeMap
	 * @param {Array/String} items Items to make map out of.
	 * @param {String} delim Optional delimiter to split string by.
	 * @param {Object} map Optional map to add items to.
	 * @return {Object} Name/value map of items.
	 */
	function makeMap(items, delim, map) {
		var i;

		items = items || [];
		delim = delim || ',';

		if (typeof items == "string") {
			items = items.split(delim);
		}

		map = map || {};

		i = items.length;
		while (i--) {
			map[items[i]] = {};
		}

		return map;
	}

	/**
	 * Creates a class, subclass or static singleton.
	 * More details on this method can be found in the Wiki.
	 *
	 * @method create
	 * @param {String} s Class name, inheritance and prefix.
	 * @param {Object} p Collection of methods to add to the class.
	 * @param {Object} root Optional root object defaults to the global window object.
	 * @example
	 * // Creates a basic class
	 * tinymce.create('tinymce.somepackage.SomeClass', {
	 *     SomeClass: function() {
	 *         // Class constructor
	 *     },
	 *
	 *     method: function() {
	 *         // Some method
	 *     }
	 * });
	 *
	 * // Creates a basic subclass class
	 * tinymce.create('tinymce.somepackage.SomeSubClass:tinymce.somepackage.SomeClass', {
	 *     SomeSubClass: function() {
	 *         // Class constructor
	 *         this.parent(); // Call parent constructor
	 *     },
	 *
	 *     method: function() {
	 *         // Some method
	 *         this.parent(); // Call parent method
	 *     },
	 *
	 *     'static': {
	 *         staticMethod: function() {
	 *             // Static method
	 *         }
	 *     }
	 * });
	 *
	 * // Creates a singleton/static class
	 * tinymce.create('static tinymce.somepackage.SomeSingletonClass', {
	 *     method: function() {
	 *         // Some method
	 *     }
	 * });
	 */
	function create(s, p, root) {
		var self = this, sp, ns, cn, scn, c, de = 0;

		// Parse : <prefix> <class>:<super class>
		s = /^((static) )?([\w.]+)(:([\w.]+))?/.exec(s);
		cn = s[3].match(/(^|\.)(\w+)$/i)[2]; // Class name

		// Create namespace for new class
		ns = self.createNS(s[3].replace(/\.\w+$/, ''), root);

		// Class already exists
		if (ns[cn]) {
			return;
		}

		// Make pure static class
		if (s[2] == 'static') {
			ns[cn] = p;

			if (this.onCreate) {
				this.onCreate(s[2], s[3], ns[cn]);
			}

			return;
		}

		// Create default constructor
		if (!p[cn]) {
			p[cn] = function() {};
			de = 1;
		}

		// Add constructor and methods
		ns[cn] = p[cn];
		self.extend(ns[cn].prototype, p);

		// Extend
		if (s[5]) {
			sp = self.resolve(s[5]).prototype;
			scn = s[5].match(/\.(\w+)$/i)[1]; // Class name

			// Extend constructor
			c = ns[cn];
			if (de) {
				// Add passthrough constructor
				ns[cn] = function() {
					return sp[scn].apply(this, arguments);
				};
			} else {
				// Add inherit constructor
				ns[cn] = function() {
					this.parent = sp[scn];
					return c.apply(this, arguments);
				};
			}
			ns[cn].prototype[cn] = ns[cn];

			// Add super methods
			self.each(sp, function(f, n) {
				ns[cn].prototype[n] = sp[n];
			});

			// Add overridden methods
			self.each(p, function(f, n) {
				// Extend methods if needed
				if (sp[n]) {
					ns[cn].prototype[n] = function() {
						this.parent = sp[n];
						return f.apply(this, arguments);
					};
				} else {
					if (n != cn) {
						ns[cn].prototype[n] = f;
					}
				}
			});
		}

		// Add static methods
		/*jshint sub:true*/
		/*eslint dot-notation:0*/
		self.each(p['static'], function(f, n) {
			ns[cn][n] = f;
		});
	}

	function extend(obj, ext) {
		var i, l, name, args = arguments, value;

		for (i = 1, l = args.length; i < l; i++) {
			ext = args[i];
			for (name in ext) {
				if (ext.hasOwnProperty(name)) {
					value = ext[name];

					if (value !== undefined) {
						obj[name] = value;
					}
				}
			}
		}

		return obj;
	}

	/**
	 * Executed the specified function for each item in a object tree.
	 *
	 * @method walk
	 * @param {Object} o Object tree to walk though.
	 * @param {function} f Function to call for each item.
	 * @param {String} n Optional name of collection inside the objects to walk for example childNodes.
	 * @param {String} s Optional scope to execute the function in.
	 */
	function walk(o, f, n, s) {
		s = s || this;

		if (o) {
			if (n) {
				o = o[n];
			}

			Arr.each(o, function(o, i) {
				if (f.call(s, o, i, n) === false) {
					return false;
				}

				walk(o, f, n, s);
			});
		}
	}

	/**
	 * Creates a namespace on a specific object.
	 *
	 * @method createNS
	 * @param {String} n Namespace to create for example a.b.c.d.
	 * @param {Object} o Optional object to add namespace to, defaults to window.
	 * @return {Object} New namespace object the last item in path.
	 * @example
	 * // Create some namespace
	 * tinymce.createNS('tinymce.somepackage.subpackage');
	 *
	 * // Add a singleton
	 * var tinymce.somepackage.subpackage.SomeSingleton = {
	 *     method: function() {
	 *         // Some method
	 *     }
	 * };
	 */
	function createNS(n, o) {
		var i, v;

		o = o || window;

		n = n.split('.');
		for (i = 0; i < n.length; i++) {
			v = n[i];

			if (!o[v]) {
				o[v] = {};
			}

			o = o[v];
		}

		return o;
	}

	/**
	 * Resolves a string and returns the object from a specific structure.
	 *
	 * @method resolve
	 * @param {String} n Path to resolve for example a.b.c.d.
	 * @param {Object} o Optional object to search though, defaults to window.
	 * @return {Object} Last object in path or null if it couldn't be resolved.
	 * @example
	 * // Resolve a path into an object reference
	 * var obj = tinymce.resolve('a.b.c.d');
	 */
	function resolve(n, o) {
		var i, l;

		o = o || window;

		n = n.split('.');
		for (i = 0, l = n.length; i < l; i++) {
			o = o[n[i]];

			if (!o) {
				break;
			}
		}

		return o;
	}

	/**
	 * Splits a string but removes the whitespace before and after each value.
	 *
	 * @method explode
	 * @param {string} s String to split.
	 * @param {string} d Delimiter to split by.
	 * @example
	 * // Split a string into an array with a,b,c
	 * var arr = tinymce.explode('a, b,   c');
	 */
	function explode(s, d) {
		if (!s || is(s, 'array')) {
			return s;
		}

		return Arr.map(s.split(d || ','), trim);
	}

	function _addCacheSuffix(url) {
		var cacheSuffix = Env.cacheSuffix;

		if (cacheSuffix) {
			url += (url.indexOf('?') === -1 ? '?' : '&') + cacheSuffix;
		}

		return url;
	}

	return {
		trim: trim,

		/**
		 * Returns true/false if the object is an array or not.
		 *
		 * @method isArray
		 * @param {Object} obj Object to check.
		 * @return {boolean} true/false state if the object is an array or not.
		 */
		isArray: Arr.isArray,

		is: is,

		/**
		 * Converts the specified object into a real JavaScript array.
		 *
		 * @method toArray
		 * @param {Object} obj Object to convert into array.
		 * @return {Array} Array object based in input.
		 */
		toArray: Arr.toArray,
		makeMap: makeMap,

		/**
		 * Performs an iteration of all items in a collection such as an object or array. This method will execure the
		 * callback function for each item in the collection, if the callback returns false the iteration will terminate.
		 * The callback has the following format: cb(value, key_or_index).
		 *
		 * @method each
		 * @param {Object} o Collection to iterate.
		 * @param {function} cb Callback function to execute for each item.
		 * @param {Object} s Optional scope to execute the callback in.
		 * @example
		 * // Iterate an array
		 * tinymce.each([1,2,3], function(v, i) {
		 *     console.debug("Value: " + v + ", Index: " + i);
		 * });
		 *
		 * // Iterate an object
		 * tinymce.each({a: 1, b: 2, c: 3], function(v, k) {
		 *     console.debug("Value: " + v + ", Key: " + k);
		 * });
		 */
		each: Arr.each,

		/**
		 * Creates a new array by the return value of each iteration function call. This enables you to convert
		 * one array list into another.
		 *
		 * @method map
		 * @param {Array} array Array of items to iterate.
		 * @param {function} callback Function to call for each item. It's return value will be the new value.
		 * @return {Array} Array with new values based on function return values.
		 */
		map: Arr.map,

		/**
		 * Filters out items from the input array by calling the specified function for each item.
		 * If the function returns false the item will be excluded if it returns true it will be included.
		 *
		 * @method grep
		 * @param {Array} a Array of items to loop though.
		 * @param {function} f Function to call for each item. Include/exclude depends on it's return value.
		 * @return {Array} New array with values imported and filtered based in input.
		 * @example
		 * // Filter out some items, this will return an array with 4 and 5
		 * var items = tinymce.grep([1,2,3,4,5], function(v) {return v > 3;});
		 */
		grep: Arr.filter,

		/**
		 * Returns true/false if the object is an array or not.
		 *
		 * @method isArray
		 * @param {Object} obj Object to check.
		 * @return {boolean} true/false state if the object is an array or not.
		 */
		inArray: Arr.indexOf,

		extend: extend,
		create: create,
		walk: walk,
		createNS: createNS,
		resolve: resolve,
		explode: explode,
		_addCacheSuffix: _addCacheSuffix
	};
});

// Included from: js/tinymce/classes/dom/DomQuery.js

/**
 * DomQuery.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 * This class mimics most of the jQuery API:
 *
 * This is whats currently implemented:
 * - Utility functions
 * - DOM traversial
 * - DOM manipulation
 * - Event binding
 *
 * This is not currently implemented:
 * - Dimension
 * - Ajax
 * - Animation
 * - Advanced chaining
 *
 * @example
 * var $ = tinymce.dom.DomQuery;
 * $('p').attr('attr', 'value').addClass('class');
 *
 * @class tinymce.dom.DomQuery
 */
define("tinymce/dom/DomQuery", [
	"tinymce/dom/EventUtils",
	"tinymce/dom/Sizzle",
	"tinymce/util/Tools",
	"tinymce/Env"
], function(EventUtils, Sizzle, Tools, Env) {
	var doc = document, push = Array.prototype.push, slice = Array.prototype.slice;
	var rquickExpr = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/;
	var Event = EventUtils.Event, undef;
	var skipUniques = Tools.makeMap('children,contents,next,prev');

	function isDefined(obj) {
		return typeof obj !== 'undefined';
	}

	function isString(obj) {
		return typeof obj === 'string';
	}

	function isWindow(obj) {
		return obj && obj == obj.window;
	}

	function createFragment(html, fragDoc) {
		var frag, node, container;

		fragDoc = fragDoc || doc;
		container = fragDoc.createElement('div');
		frag = fragDoc.createDocumentFragment();
		container.innerHTML = html;

		while ((node = container.firstChild)) {
			frag.appendChild(node);
		}

		return frag;
	}

	function domManipulate(targetNodes, sourceItem, callback, reverse) {
		var i;

		if (isString(sourceItem)) {
			sourceItem = createFragment(sourceItem, getElementDocument(targetNodes[0]));
		} else if (sourceItem.length && !sourceItem.nodeType) {
			sourceItem = DomQuery.makeArray(sourceItem);

			if (reverse) {
				for (i = sourceItem.length - 1; i >= 0; i--) {
					domManipulate(targetNodes, sourceItem[i], callback, reverse);
				}
			} else {
				for (i = 0; i < sourceItem.length; i++) {
					domManipulate(targetNodes, sourceItem[i], callback, reverse);
				}
			}

			return targetNodes;
		}

		if (sourceItem.nodeType) {
			i = targetNodes.length;
			while (i--) {
				callback.call(targetNodes[i], sourceItem);
			}
		}

		return targetNodes;
	}

	function hasClass(node, className) {
		return node && className && (' ' + node.className + ' ').indexOf(' ' + className + ' ') !== -1;
	}

	function wrap(elements, wrapper, all) {
		var lastParent, newWrapper;

		wrapper = DomQuery(wrapper)[0];

		elements.each(function() {
			var self = this;

			if (!all || lastParent != self.parentNode) {
				lastParent = self.parentNode;
				newWrapper = wrapper.cloneNode(false);
				self.parentNode.insertBefore(newWrapper, self);
				newWrapper.appendChild(self);
			} else {
				newWrapper.appendChild(self);
			}
		});

		return elements;
	}

	var numericCssMap = Tools.makeMap('fillOpacity fontWeight lineHeight opacity orphans widows zIndex zoom', ' ');
	var booleanMap = Tools.makeMap('checked compact declare defer disabled ismap multiple nohref noshade nowrap readonly selected', ' ');
	var propFix = {
		'for': 'htmlFor',
		'class': 'className',
		'readonly': 'readOnly'
	};
	var cssFix = {
		'float': 'cssFloat'
	};

	var attrHooks = {}, cssHooks = {};

	function DomQuery(selector, context) {
		/*eslint new-cap:0 */
		return new DomQuery.fn.init(selector, context);
	}

	function inArray(item, array) {
		var i;

		if (array.indexOf) {
			return array.indexOf(item);
		}

		i = array.length;
		while (i--) {
			if (array[i] === item) {
				return i;
			}
		}

		return -1;
	}

	var whiteSpaceRegExp = /^\s*|\s*$/g;

	function trim(str) {
		return (str === null || str === undef) ? '' : ("" + str).replace(whiteSpaceRegExp, '');
	}

	function each(obj, callback) {
		var length, key, i, undef, value;

		if (obj) {
			length = obj.length;

			if (length === undef) {
				// Loop object items
				for (key in obj) {
					if (obj.hasOwnProperty(key)) {
						value = obj[key];
						if (callback.call(value, key, value) === false) {
							break;
						}
					}
				}
			} else {
				// Loop array items
				for (i = 0; i < length; i++) {
					value = obj[i];
					if (callback.call(value, i, value) === false) {
						break;
					}
				}
			}
		}

		return obj;
	}

	function grep(array, callback) {
		var out = [];

		each(array, function(i, item) {
			if (callback(item, i)) {
				out.push(item);
			}
		});

		return out;
	}

	function getElementDocument(element) {
		if (!element) {
			return doc;
		}

		if (element.nodeType == 9) {
			return element;
		}

		return element.ownerDocument;
	}

	DomQuery.fn = DomQuery.prototype = {
		constructor: DomQuery,

		/**
		 * Selector for the current set.
		 *
		 * @property selector
		 * @type String
		 */
		selector: "",

		/**
		 * Context used to create the set.
		 *
		 * @property context
		 * @type Element
		 */
		context: null,

		/**
		 * Number of items in the current set.
		 *
		 * @property length
		 * @type Number
		 */
		length: 0,

		/**
		 * Constructs a new DomQuery instance with the specified selector or context.
		 *
		 * @constructor
		 * @method init
		 * @param {String/Array/DomQuery} selector Optional CSS selector/Array or array like object or HTML string.
		 * @param {Document/Element} context Optional context to search in.
		 */
		init: function(selector, context) {
			var self = this, match, node;

			if (!selector) {
				return self;
			}

			if (selector.nodeType) {
				self.context = self[0] = selector;
				self.length = 1;

				return self;
			}

			if (context && context.nodeType) {
				self.context = context;
			} else {
				if (context) {
					return DomQuery(selector).attr(context);
				}

				self.context = context = document;
			}

			if (isString(selector)) {
				self.selector = selector;

				if (selector.charAt(0) === "<" && selector.charAt(selector.length - 1) === ">" && selector.length >= 3) {
					match = [null, selector, null];
				} else {
					match = rquickExpr.exec(selector);
				}

				if (match) {
					if (match[1]) {
						node = createFragment(selector, getElementDocument(context)).firstChild;

						while (node) {
							push.call(self, node);
							node = node.nextSibling;
						}
					} else {
						node = getElementDocument(context).getElementById(match[2]);

						if (!node) {
							return self;
						}

						if (node.id !== match[2]) {
							return self.find(selector);
						}

						self.length = 1;
						self[0] = node;
					}
				} else {
					return DomQuery(context).find(selector);
				}
			} else {
				this.add(selector, false);
			}

			return self;
		},

		/**
		 * Converts the current set to an array.
		 *
		 * @method toArray
		 * @return {Array} Array of all nodes in set.
		 */
		toArray: function() {
			return Tools.toArray(this);
		},

		/**
		 * Adds new nodes to the set.
		 *
		 * @method add
		 * @param {Array/tinymce.dom.DomQuery} items Array of all nodes to add to set.
		 * @param {Boolean} sort Optional sort flag that enables sorting of elements.
		 * @return {tinymce.dom.DomQuery} New instance with nodes added.
		 */
		add: function(items, sort) {
			var self = this, nodes, i;

			if (isString(items)) {
				return self.add(DomQuery(items));
			}

			if (sort !== false) {
				nodes = DomQuery.unique(self.toArray().concat(DomQuery.makeArray(items)));
				self.length = nodes.length;
				for (i = 0; i < nodes.length; i++) {
					self[i] = nodes[i];
				}
			} else {
				push.apply(self, DomQuery.makeArray(items));
			}

			return self;
		},

		/**
		 * Sets/gets attributes on the elements in the current set.
		 *
		 * @method attr
		 * @param {String/Object} name Name of attribute to get or an object with attributes to set.
		 * @param {String} value Optional value to set.
		 * @return {tinymce.dom.DomQuery/String} Current set or the specified attribute when only the name is specified.
		 */
		attr: function(name, value) {
			var self = this, hook;

			if (typeof name === "object") {
				each(name, function(name, value) {
					self.attr(name, value);
				});
			} else if (isDefined(value)) {
				this.each(function() {
					var hook;

					if (this.nodeType === 1) {
						hook = attrHooks[name];
						if (hook && hook.set) {
							hook.set(this, value);
							return;
						}

						if (value === null) {
							this.removeAttribute(name, 2);
						} else {
							this.setAttribute(name, value, 2);
						}
					}
				});
			} else {
				if (self[0] && self[0].nodeType === 1) {
					hook = attrHooks[name];
					if (hook && hook.get) {
						return hook.get(self[0], name);
					}

					if (booleanMap[name]) {
						return self.prop(name) ? name : undef;
					}

					value = self[0].getAttribute(name, 2);

					if (value === null) {
						value = undef;
					}
				}

				return value;
			}

			return self;
		},

		/**
		 * Removes attributse on the elements in the current set.
		 *
		 * @method removeAttr
		 * @param {String/Object} name Name of attribute to remove.
		 * @return {tinymce.dom.DomQuery/String} Current set.
		 */
		removeAttr: function(name) {
			return this.attr(name, null);
		},

		/**
		 * Sets/gets properties on the elements in the current set.
		 *
		 * @method attr
		 * @param {String/Object} name Name of property to get or an object with properties to set.
		 * @param {String} value Optional value to set.
		 * @return {tinymce.dom.DomQuery/String} Current set or the specified property when only the name is specified.
		 */
		prop: function(name, value) {
			var self = this;

			name = propFix[name] || name;

			if (typeof name === "object") {
				each(name, function(name, value) {
					self.prop(name, value);
				});
			} else if (isDefined(value)) {
				this.each(function() {
					if (this.nodeType == 1) {
						this[name] = value;
					}
				});
			} else {
				if (self[0] && self[0].nodeType && name in self[0]) {
					return self[0][name];
				}

				return value;
			}

			return self;
		},

		/**
		 * Sets/gets styles on the elements in the current set.
		 *
		 * @method css
		 * @param {String/Object} name Name of style to get or an object with styles to set.
		 * @param {String} value Optional value to set.
		 * @return {tinymce.dom.DomQuery/String} Current set or the specified style when only the name is specified.
		 */
		css: function(name, value) {
			var self = this, elm, hook;

			function camel(name) {
				return name.replace(/-(\D)/g, function(a, b) {
					return b.toUpperCase();
				});
			}

			function dashed(name) {
				return name.replace(/[A-Z]/g, function(a) {
					return '-' + a;
				});
			}

			if (typeof name === "object") {
				each(name, function(name, value) {
					self.css(name, value);
				});
			} else {
				if (isDefined(value)) {
					name = camel(name);

					// Default px suffix on these
					if (typeof value === 'number' && !numericCssMap[name]) {
						value += 'px';
					}

					self.each(function() {
						var style = this.style;

						hook = cssHooks[name];
						if (hook && hook.set) {
							hook.set(this, value);
							return;
						}

						try {
							this.style[cssFix[name] || name] = value;
						} catch (ex) {
							// Ignore
						}

						if (value === null || value === '') {
							if (style.removeProperty) {
								style.removeProperty(dashed(name));
							} else {
								style.removeAttribute(name);
							}
						}
					});
				} else {
					elm = self[0];

					hook = cssHooks[name];
					if (hook && hook.get) {
						return hook.get(elm);
					}

					if (elm.ownerDocument.defaultView) {
						try {
							return elm.ownerDocument.defaultView.getComputedStyle(elm, null).getPropertyValue(dashed(name));
						} catch (ex) {
							return undef;
						}
					} else if (elm.currentStyle) {
						return elm.currentStyle[camel(name)];
					}
				}
			}

			return self;
		},

		/**
		 * Removes all nodes in set from the document.
		 *
		 * @method remove
		 * @return {tinymce.dom.DomQuery} Current set with the removed nodes.
		 */
		remove: function() {
			var self = this, node, i = this.length;

			while (i--) {
				node = self[i];
				Event.clean(node);

				if (node.parentNode) {
					node.parentNode.removeChild(node);
				}
			}

			return this;
		},

		/**
		 * Empties all elements in set.
		 *
		 * @method empty
		 * @return {tinymce.dom.DomQuery} Current set with the empty nodes.
		 */
		empty: function() {
			var self = this, node, i = this.length;

			while (i--) {
				node = self[i];
				while (node.firstChild) {
					node.removeChild(node.firstChild);
				}
			}

			return this;
		},

		/**
		 * Sets or gets the HTML of the current set or first set node.
		 *
		 * @method html
		 * @param {String} value Optional innerHTML value to set on each element.
		 * @return {tinymce.dom.DomQuery/String} Current set or the innerHTML of the first element.
		 */
		html: function(value) {
			var self = this, i;

			if (isDefined(value)) {
				i = self.length;

				try {
					while (i--) {
						self[i].innerHTML = value;
					}
				} catch (ex) {
					// Workaround for "Unknown runtime error" when DIV is added to P on IE
					DomQuery(self[i]).empty().append(value);
				}

				return self;
			}

			return self[0] ? self[0].innerHTML : '';
		},

		/**
		 * Sets or gets the text of the current set or first set node.
		 *
		 * @method text
		 * @param {String} value Optional innerText value to set on each element.
		 * @return {tinymce.dom.DomQuery/String} Current set or the innerText of the first element.
		 */
		text: function(value) {
			var self = this, i;

			if (isDefined(value)) {
				i = self.length;
				while (i--) {
					if ("innerText" in self[i]) {
						self[i].innerText = value;
					} else {
						self[0].textContent = value;
					}
				}

				return self;
			}

			return self[0] ? (self[0].innerText || self[0].textContent) : '';
		},

		/**
		 * Appends the specified node/html or node set to the current set nodes.
		 *
		 * @method append
		 * @param {String/Element/Array/tinymce.dom.DomQuery} content Content to append to each element in set.
		 * @return {tinymce.dom.DomQuery} Current set.
		 */
		append: function() {
			return domManipulate(this, arguments, function(node) {
				// Either element or Shadow Root
				if (this.nodeType === 1 || (this.host && this.host.nodeType === 1)) {
					this.appendChild(node);
				}
			});
		},

		/**
		 * Prepends the specified node/html or node set to the current set nodes.
		 *
		 * @method prepend
		 * @param {String/Element/Array/tinymce.dom.DomQuery} content Content to prepend to each element in set.
		 * @return {tinymce.dom.DomQuery} Current set.
		 */
		prepend: function() {
			return domManipulate(this, arguments, function(node) {
				// Either element or Shadow Root
				if (this.nodeType === 1 || (this.host && this.host.nodeType === 1)) {
					this.insertBefore(node, this.firstChild);
				}
			}, true);
		},

		/**
		 * Adds the specified elements before current set nodes.
		 *
		 * @method before
		 * @param {String/Element/Array/tinymce.dom.DomQuery} content Content to add before to each element in set.
		 * @return {tinymce.dom.DomQuery} Current set.
		 */
		before: function() {
			var self = this;

			if (self[0] && self[0].parentNode) {
				return domManipulate(self, arguments, function(node) {
					this.parentNode.insertBefore(node, this);
				});
			}

			return self;
		},

		/**
		 * Adds the specified elements after current set nodes.
		 *
		 * @method after
		 * @param {String/Element/Array/tinymce.dom.DomQuery} content Content to add after to each element in set.
		 * @return {tinymce.dom.DomQuery} Current set.
		 */
		after: function() {
			var self = this;

			if (self[0] && self[0].parentNode) {
				return domManipulate(self, arguments, function(node) {
					this.parentNode.insertBefore(node, this.nextSibling);
				}, true);
			}

			return self;
		},

		/**
		 * Appends the specified set nodes to the specified selector/instance.
		 *
		 * @method appendTo
		 * @param {String/Element/Array/tinymce.dom.DomQuery} val Item to append the current set to.
		 * @return {tinymce.dom.DomQuery} Current set with the appended nodes.
		 */
		appendTo: function(val) {
			DomQuery(val).append(this);

			return this;
		},

		/**
		 * Prepends the specified set nodes to the specified selector/instance.
		 *
		 * @method prependTo
		 * @param {String/Element/Array/tinymce.dom.DomQuery} val Item to prepend the current set to.
		 * @return {tinymce.dom.DomQuery} Current set with the prepended nodes.
		 */
		prependTo: function(val) {
			DomQuery(val).prepend(this);

			return this;
		},

		/**
		 * Replaces the nodes in set with the specified content.
		 *
		 * @method replaceWith
		 * @param {String/Element/Array/tinymce.dom.DomQuery} content Content to replace nodes with.
		 * @return {tinymce.dom.DomQuery} Set with replaced nodes.
		 */
		replaceWith: function(content) {
			return this.before(content).remove();
		},

		/**
		 * Wraps all elements in set with the specified wrapper.
		 *
		 * @method wrap
		 * @param {String/Element/Array/tinymce.dom.DomQuery} content Content to wrap nodes with.
		 * @return {tinymce.dom.DomQuery} Set with wrapped nodes.
		 */
		wrap: function(content) {
			return wrap(this, content);
		},

		/**
		 * Wraps all nodes in set with the specified wrapper. If the nodes are siblings all of them
		 * will be wrapped in the same wrapper.
		 *
		 * @method wrapAll
		 * @param {String/Element/Array/tinymce.dom.DomQuery} content Content to wrap nodes with.
		 * @return {tinymce.dom.DomQuery} Set with wrapped nodes.
		 */
		wrapAll: function(content) {
			return wrap(this, content, true);
		},

		/**
		 * Wraps all elements inner contents in set with the specified wrapper.
		 *
		 * @method wrapInner
		 * @param {String/Element/Array/tinymce.dom.DomQuery} content Content to wrap nodes with.
		 * @return {tinymce.dom.DomQuery} Set with wrapped nodes.
		 */
		wrapInner: function(content) {
			this.each(function() {
				DomQuery(this).contents().wrapAll(content);
			});

			return this;
		},

		/**
		 * Unwraps all elements by removing the parent element of each item in set.
		 *
		 * @method unwrap
		 * @return {tinymce.dom.DomQuery} Set with unwrapped nodes.
		 */
		unwrap: function() {
			return this.parent().each(function() {
				DomQuery(this).replaceWith(this.childNodes);
			});
		},

		/**
		 * Clones all nodes in set.
		 *
		 * @method clone
		 * @return {tinymce.dom.DomQuery} Set with cloned nodes.
		 */
		clone: function() {
			var result = [];

			this.each(function() {
				result.push(this.cloneNode(true));
			});

			return DomQuery(result);
		},

		/**
		 * Adds the specified class name to the current set elements.
		 *
		 * @method addClass
		 * @param {String} className Class name to add.
		 * @return {tinymce.dom.DomQuery} Current set.
		 */
		addClass: function(className) {
			return this.toggleClass(className, true);
		},

		/**
		 * Removes the specified class name to the current set elements.
		 *
		 * @method removeClass
		 * @param {String} className Class name to remove.
		 * @return {tinymce.dom.DomQuery} Current set.
		 */
		removeClass: function(className) {
			return this.toggleClass(className, false);
		},

		/**
		 * Toggles the specified class name on the current set elements.
		 *
		 * @method toggleClass
		 * @param {String} className Class name to add/remove.
		 * @param {Boolean} state Optional state to toggle on/off.
		 * @return {tinymce.dom.DomQuery} Current set.
		 */
		toggleClass: function(className, state) {
			var self = this;

			// Functions are not supported
			if (typeof className != 'string') {
				return self;
			}

			if (className.indexOf(' ') !== -1) {
				each(className.split(' '), function() {
					self.toggleClass(this, state);
				});
			} else {
				self.each(function(index, node) {
					var existingClassName, classState;

					classState = hasClass(node, className);
					if (classState !== state) {
						existingClassName = node.className;

						if (classState) {
							node.className = trim((" " + existingClassName + " ").replace(' ' + className + ' ', ' '));
						} else {
							node.className += existingClassName ? ' ' + className : className;
						}
					}
				});
			}

			return self;
		},

		/**
		 * Returns true/fal