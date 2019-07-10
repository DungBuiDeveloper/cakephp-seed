﻿var PBSyntaxHighlighter = function() {
		function a(a) {
			switch (a) {
				case "HIGHLIGHT":
					this.sh = HIGHLIGHT;
					break;
				case "PRETTIFY":
					this.sh = PRETTIFY;
					break;
				case "PRISM":
					this.sh = PRISM;
					break;
				case "SYNTAX_HIGHLIGHTER":
					this.sh = SYNTAX_HIGHLIGHTER;
					break;
				default:
					this.sh = {
						_type: "DEFAULT",
						_cls: "",
						_tag: "pre"
					}
			}
		}
		a.prototype.setType = function(a) {
			this.sh._type = a
		};
		a.prototype.getType = function() {
			return this.sh._type
		};
		a.prototype.setCls = function(a) {
			this.sh.cls = this.sh._cls + a
		};
		a.prototype.getCls = function() {
			return this.sh.cls
		};
		a.prototype.getTag =
			function() {
				return this.sh._tag
			};
		return a
	}(),
	HIGHLIGHT = {
		_type: "HIGHLIGHT",
		_cls: "",
		_tag: "code"
	},
	PRETTIFY = {
		_type: "PRETTIFY",
		_cls: "prettyprint linenums lang-",
		_tag: "pre"
	},
	PRISM = {
		_type: "PRISM",
		_cls: "language-",
		_tag: "code"
	},
	SYNTAX_HIGHLIGHTER = {
		_type: "SYNTAX_HIGHLIGHTER",
		_cls: "brush: ",
		_tag: "pre"
	};
