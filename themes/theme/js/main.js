/*!
 * jQuery JavaScript Library v3.7.1
 * https://jquery.com/
 *
 * Copyright OpenJS Foundation and other contributors
 * Released under the MIT license
 * https://jquery.org/license
 *
 * Date: 2023-08-28T13:37Z
 */
!function(e, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function(e) {
        if (!e.document) throw new Error("jQuery requires a window with a document");
        return t(e);
    } : t(e);
}("undefined" != typeof window ? window : this, (function(e, t) {
    "use strict";
    var i = [], n = Object.getPrototypeOf, s = i.slice, r = i.flat ? function(e) {
        return i.flat.call(e);
    } : function(e) {
        return i.concat.apply([], e);
    }, a = i.push, o = i.indexOf, l = {}, c = l.toString, d = l.hasOwnProperty, u = d.toString, p = u.call(Object), f = {}, h = function(e) {
        return "function" == typeof e && "number" != typeof e.nodeType && "function" != typeof e.item;
    }, m = function(e) {
        return null != e && e === e.window;
    }, g = e.document, v = {
        type: !0,
        src: !0,
        nonce: !0,
        noModule: !0
    };
    function y(e, t, i) {
        var n, s, r = (i = i || g).createElement("script");
        if (r.text = e, t) for (n in v) (s = t[n] || t.getAttribute && t.getAttribute(n)) && r.setAttribute(n, s);
        i.head.appendChild(r).parentNode.removeChild(r);
    }
    function b(e) {
        return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? l[c.call(e)] || "object" : typeof e;
    }
    var w = "3.7.1", x = /HTML$/i, E = function(e, t) {
        return new E.fn.init(e, t);
    };
    function _(e) {
        var t = !!e && "length" in e && e.length, i = b(e);
        return !h(e) && !m(e) && ("array" === i || 0 === t || "number" == typeof t && t > 0 && t - 1 in e);
    }
    function T(e, t) {
        return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase();
    }
    E.fn = E.prototype = {
        jquery: w,
        constructor: E,
        length: 0,
        toArray: function() {
            return s.call(this);
        },
        get: function(e) {
            return null == e ? s.call(this) : e < 0 ? this[e + this.length] : this[e];
        },
        pushStack: function(e) {
            var t = E.merge(this.constructor(), e);
            return t.prevObject = this, t;
        },
        each: function(e) {
            return E.each(this, e);
        },
        map: function(e) {
            return this.pushStack(E.map(this, (function(t, i) {
                return e.call(t, i, t);
            })));
        },
        slice: function() {
            return this.pushStack(s.apply(this, arguments));
        },
        first: function() {
            return this.eq(0);
        },
        last: function() {
            return this.eq(-1);
        },
        even: function() {
            return this.pushStack(E.grep(this, (function(e, t) {
                return (t + 1) % 2;
            })));
        },
        odd: function() {
            return this.pushStack(E.grep(this, (function(e, t) {
                return t % 2;
            })));
        },
        eq: function(e) {
            var t = this.length, i = +e + (e < 0 ? t : 0);
            return this.pushStack(i >= 0 && i < t ? [ this[i] ] : []);
        },
        end: function() {
            return this.prevObject || this.constructor();
        },
        push: a,
        sort: i.sort,
        splice: i.splice
    }, E.extend = E.fn.extend = function() {
        var e, t, i, n, s, r, a = arguments[0] || {}, o = 1, l = arguments.length, c = !1;
        for ("boolean" == typeof a && (c = a, a = arguments[o] || {}, o++), "object" == typeof a || h(a) || (a = {}), 
        o === l && (a = this, o--); o < l; o++) if (null != (e = arguments[o])) for (t in e) n = e[t], 
        "__proto__" !== t && a !== n && (c && n && (E.isPlainObject(n) || (s = Array.isArray(n))) ? (i = a[t], 
        r = s && !Array.isArray(i) ? [] : s || E.isPlainObject(i) ? i : {}, s = !1, a[t] = E.extend(c, r, n)) : void 0 !== n && (a[t] = n));
        return a;
    }, E.extend({
        expando: "jQuery" + (w + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(e) {
            throw new Error(e);
        },
        noop: function() {},
        isPlainObject: function(e) {
            var t, i;
            return !(!e || "[object Object]" !== c.call(e)) && (!(t = n(e)) || "function" == typeof (i = d.call(t, "constructor") && t.constructor) && u.call(i) === p);
        },
        isEmptyObject: function(e) {
            var t;
            for (t in e) return !1;
            return !0;
        },
        globalEval: function(e, t, i) {
            y(e, {
                nonce: t && t.nonce
            }, i);
        },
        each: function(e, t) {
            var i, n = 0;
            if (_(e)) for (i = e.length; n < i && !1 !== t.call(e[n], n, e[n]); n++) ; else for (n in e) if (!1 === t.call(e[n], n, e[n])) break;
            return e;
        },
        text: function(e) {
            var t, i = "", n = 0, s = e.nodeType;
            if (!s) for (;t = e[n++]; ) i += E.text(t);
            return 1 === s || 11 === s ? e.textContent : 9 === s ? e.documentElement.textContent : 3 === s || 4 === s ? e.nodeValue : i;
        },
        makeArray: function(e, t) {
            var i = t || [];
            return null != e && (_(Object(e)) ? E.merge(i, "string" == typeof e ? [ e ] : e) : a.call(i, e)), 
            i;
        },
        inArray: function(e, t, i) {
            return null == t ? -1 : o.call(t, e, i);
        },
        isXMLDoc: function(e) {
            var t = e && e.namespaceURI, i = e && (e.ownerDocument || e).documentElement;
            return !x.test(t || i && i.nodeName || "HTML");
        },
        merge: function(e, t) {
            for (var i = +t.length, n = 0, s = e.length; n < i; n++) e[s++] = t[n];
            return e.length = s, e;
        },
        grep: function(e, t, i) {
            for (var n = [], s = 0, r = e.length, a = !i; s < r; s++) !t(e[s], s) !== a && n.push(e[s]);
            return n;
        },
        map: function(e, t, i) {
            var n, s, a = 0, o = [];
            if (_(e)) for (n = e.length; a < n; a++) null != (s = t(e[a], a, i)) && o.push(s); else for (a in e) null != (s = t(e[a], a, i)) && o.push(s);
            return r(o);
        },
        guid: 1,
        support: f
    }), "function" == typeof Symbol && (E.fn[Symbol.iterator] = i[Symbol.iterator]), 
    E.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), (function(e, t) {
        l["[object " + t + "]"] = t.toLowerCase();
    }));
    var S = i.pop, C = i.sort, M = i.splice, A = "[\\x20\\t\\r\\n\\f]", k = new RegExp("^" + A + "+|((?:^|[^\\\\])(?:\\\\.)*)" + A + "+$", "g");
    E.contains = function(e, t) {
        var i = t && t.parentNode;
        return e === i || !(!i || 1 !== i.nodeType || !(e.contains ? e.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)));
    };
    var L = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\x80-\uFFFF\w-]/g;
    function P(e, t) {
        return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e;
    }
    E.escapeSelector = function(e) {
        return (e + "").replace(L, P);
    };
    var O = g, D = a;
    !function() {
        var t, n, r, a, l, c, u, p, h, m, g = D, v = E.expando, y = 0, b = 0, w = ee(), x = ee(), _ = ee(), L = ee(), P = function(e, t) {
            return e === t && (l = !0), 0;
        }, I = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", $ = "(?:\\\\[\\da-fA-F]{1,6}" + A + "?|\\\\[^\\r\\n\\f]|[\\w-]|[^\0-\\x7f])+", N = "\\[" + A + "*(" + $ + ")(?:" + A + "*([*^$|!~]?=)" + A + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + $ + "))|)" + A + "*\\]", j = ":(" + $ + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + N + ")*)|.*)\\)|)", z = new RegExp(A + "+", "g"), H = new RegExp("^" + A + "*," + A + "*"), q = new RegExp("^" + A + "*([>+~]|" + A + ")" + A + "*"), R = new RegExp(A + "|>"), B = new RegExp(j), F = new RegExp("^" + $ + "$"), W = {
            ID: new RegExp("^#(" + $ + ")"),
            CLASS: new RegExp("^\\.(" + $ + ")"),
            TAG: new RegExp("^(" + $ + "|[*])"),
            ATTR: new RegExp("^" + N),
            PSEUDO: new RegExp("^" + j),
            CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + A + "*(even|odd|(([+-]|)(\\d*)n|)" + A + "*(?:([+-]|)" + A + "*(\\d+)|))" + A + "*\\)|)", "i"),
            bool: new RegExp("^(?:" + I + ")$", "i"),
            needsContext: new RegExp("^" + A + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + A + "*((?:-\\d)?\\d*)" + A + "*\\)|)(?=[^-]|$)", "i")
        }, V = /^(?:input|select|textarea|button)$/i, X = /^h\d$/i, G = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, Y = /[+~]/, U = new RegExp("\\\\[\\da-fA-F]{1,6}" + A + "?|\\\\([^\\r\\n\\f])", "g"), K = function(e, t) {
            var i = "0x" + e.slice(1) - 65536;
            return t || (i < 0 ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320));
        }, Q = function() {
            le();
        }, J = pe((function(e) {
            return !0 === e.disabled && T(e, "fieldset");
        }), {
            dir: "parentNode",
            next: "legend"
        });
        try {
            g.apply(i = s.call(O.childNodes), O.childNodes), i[O.childNodes.length].nodeType;
        } catch (e) {
            g = {
                apply: function(e, t) {
                    D.apply(e, s.call(t));
                },
                call: function(e) {
                    D.apply(e, s.call(arguments, 1));
                }
            };
        }
        function Z(e, t, i, n) {
            var s, r, a, o, l, d, u, m = t && t.ownerDocument, y = t ? t.nodeType : 9;
            if (i = i || [], "string" != typeof e || !e || 1 !== y && 9 !== y && 11 !== y) return i;
            if (!n && (le(t), t = t || c, p)) {
                if (11 !== y && (l = G.exec(e))) if (s = l[1]) {
                    if (9 === y) {
                        if (!(a = t.getElementById(s))) return i;
                        if (a.id === s) return g.call(i, a), i;
                    } else if (m && (a = m.getElementById(s)) && Z.contains(t, a) && a.id === s) return g.call(i, a), 
                    i;
                } else {
                    if (l[2]) return g.apply(i, t.getElementsByTagName(e)), i;
                    if ((s = l[3]) && t.getElementsByClassName) return g.apply(i, t.getElementsByClassName(s)), 
                    i;
                }
                if (!(L[e + " "] || h && h.test(e))) {
                    if (u = e, m = t, 1 === y && (R.test(e) || q.test(e))) {
                        for ((m = Y.test(e) && oe(t.parentNode) || t) == t && f.scope || ((o = t.getAttribute("id")) ? o = E.escapeSelector(o) : t.setAttribute("id", o = v)), 
                        r = (d = de(e)).length; r--; ) d[r] = (o ? "#" + o : ":scope") + " " + ue(d[r]);
                        u = d.join(",");
                    }
                    try {
                        return g.apply(i, m.querySelectorAll(u)), i;
                    } catch (t) {
                        L(e, !0);
                    } finally {
                        o === v && t.removeAttribute("id");
                    }
                }
            }
            return ye(e.replace(k, "$1"), t, i, n);
        }
        function ee() {
            var e = [];
            return function t(i, s) {
                return e.push(i + " ") > n.cacheLength && delete t[e.shift()], t[i + " "] = s;
            };
        }
        function te(e) {
            return e[v] = !0, e;
        }
        function ie(e) {
            var t = c.createElement("fieldset");
            try {
                return !!e(t);
            } catch (e) {
                return !1;
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null;
            }
        }
        function ne(e) {
            return function(t) {
                return T(t, "input") && t.type === e;
            };
        }
        function se(e) {
            return function(t) {
                return (T(t, "input") || T(t, "button")) && t.type === e;
            };
        }
        function re(e) {
            return function(t) {
                return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && J(t) === e : t.disabled === e : "label" in t && t.disabled === e;
            };
        }
        function ae(e) {
            return te((function(t) {
                return t = +t, te((function(i, n) {
                    for (var s, r = e([], i.length, t), a = r.length; a--; ) i[s = r[a]] && (i[s] = !(n[s] = i[s]));
                }));
            }));
        }
        function oe(e) {
            return e && void 0 !== e.getElementsByTagName && e;
        }
        function le(e) {
            var t, i = e ? e.ownerDocument || e : O;
            return i != c && 9 === i.nodeType && i.documentElement ? (u = (c = i).documentElement, 
            p = !E.isXMLDoc(c), m = u.matches || u.webkitMatchesSelector || u.msMatchesSelector, 
            u.msMatchesSelector && O != c && (t = c.defaultView) && t.top !== t && t.addEventListener("unload", Q), 
            f.getById = ie((function(e) {
                return u.appendChild(e).id = E.expando, !c.getElementsByName || !c.getElementsByName(E.expando).length;
            })), f.disconnectedMatch = ie((function(e) {
                return m.call(e, "*");
            })), f.scope = ie((function() {
                return c.querySelectorAll(":scope");
            })), f.cssHas = ie((function() {
                try {
                    return c.querySelector(":has(*,:jqfake)"), !1;
                } catch (e) {
                    return !0;
                }
            })), f.getById ? (n.filter.ID = function(e) {
                var t = e.replace(U, K);
                return function(e) {
                    return e.getAttribute("id") === t;
                };
            }, n.find.ID = function(e, t) {
                if (void 0 !== t.getElementById && p) {
                    var i = t.getElementById(e);
                    return i ? [ i ] : [];
                }
            }) : (n.filter.ID = function(e) {
                var t = e.replace(U, K);
                return function(e) {
                    var i = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                    return i && i.value === t;
                };
            }, n.find.ID = function(e, t) {
                if (void 0 !== t.getElementById && p) {
                    var i, n, s, r = t.getElementById(e);
                    if (r) {
                        if ((i = r.getAttributeNode("id")) && i.value === e) return [ r ];
                        for (s = t.getElementsByName(e), n = 0; r = s[n++]; ) if ((i = r.getAttributeNode("id")) && i.value === e) return [ r ];
                    }
                    return [];
                }
            }), n.find.TAG = function(e, t) {
                return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : t.querySelectorAll(e);
            }, n.find.CLASS = function(e, t) {
                if (void 0 !== t.getElementsByClassName && p) return t.getElementsByClassName(e);
            }, h = [], ie((function(e) {
                var t;
                u.appendChild(e).innerHTML = "<a id='" + v + "' href='' disabled='disabled'></a><select id='" + v + "-\r\\' disabled='disabled'><option selected=''></option></select>", 
                e.querySelectorAll("[selected]").length || h.push("\\[" + A + "*(?:value|" + I + ")"), 
                e.querySelectorAll("[id~=" + v + "-]").length || h.push("~="), e.querySelectorAll("a#" + v + "+*").length || h.push(".#.+[+~]"), 
                e.querySelectorAll(":checked").length || h.push(":checked"), (t = c.createElement("input")).setAttribute("type", "hidden"), 
                e.appendChild(t).setAttribute("name", "D"), u.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && h.push(":enabled", ":disabled"), 
                (t = c.createElement("input")).setAttribute("name", ""), e.appendChild(t), e.querySelectorAll("[name='']").length || h.push("\\[" + A + "*name" + A + "*=" + A + "*(?:''|\"\")");
            })), f.cssHas || h.push(":has"), h = h.length && new RegExp(h.join("|")), P = function(e, t) {
                if (e === t) return l = !0, 0;
                var i = !e.compareDocumentPosition - !t.compareDocumentPosition;
                return i || (1 & (i = (e.ownerDocument || e) == (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !f.sortDetached && t.compareDocumentPosition(e) === i ? e === c || e.ownerDocument == O && Z.contains(O, e) ? -1 : t === c || t.ownerDocument == O && Z.contains(O, t) ? 1 : a ? o.call(a, e) - o.call(a, t) : 0 : 4 & i ? -1 : 1);
            }, c) : c;
        }
        for (t in Z.matches = function(e, t) {
            return Z(e, null, null, t);
        }, Z.matchesSelector = function(e, t) {
            if (le(e), p && !L[t + " "] && (!h || !h.test(t))) try {
                var i = m.call(e, t);
                if (i || f.disconnectedMatch || e.document && 11 !== e.document.nodeType) return i;
            } catch (e) {
                L(t, !0);
            }
            return Z(t, c, null, [ e ]).length > 0;
        }, Z.contains = function(e, t) {
            return (e.ownerDocument || e) != c && le(e), E.contains(e, t);
        }, Z.attr = function(e, t) {
            (e.ownerDocument || e) != c && le(e);
            var i = n.attrHandle[t.toLowerCase()], s = i && d.call(n.attrHandle, t.toLowerCase()) ? i(e, t, !p) : void 0;
            return void 0 !== s ? s : e.getAttribute(t);
        }, Z.error = function(e) {
            throw new Error("Syntax error, unrecognized expression: " + e);
        }, E.uniqueSort = function(e) {
            var t, i = [], n = 0, r = 0;
            if (l = !f.sortStable, a = !f.sortStable && s.call(e, 0), C.call(e, P), l) {
                for (;t = e[r++]; ) t === e[r] && (n = i.push(r));
                for (;n--; ) M.call(e, i[n], 1);
            }
            return a = null, e;
        }, E.fn.uniqueSort = function() {
            return this.pushStack(E.uniqueSort(s.apply(this)));
        }, n = E.expr = {
            cacheLength: 50,
            createPseudo: te,
            match: W,
            attrHandle: {},
            find: {},
            relative: {
                ">": {
                    dir: "parentNode",
                    first: !0
                },
                " ": {
                    dir: "parentNode"
                },
                "+": {
                    dir: "previousSibling",
                    first: !0
                },
                "~": {
                    dir: "previousSibling"
                }
            },
            preFilter: {
                ATTR: function(e) {
                    return e[1] = e[1].replace(U, K), e[3] = (e[3] || e[4] || e[5] || "").replace(U, K), 
                    "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4);
                },
                CHILD: function(e) {
                    return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || Z.error(e[0]), 
                    e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && Z.error(e[0]), 
                    e;
                },
                PSEUDO: function(e) {
                    var t, i = !e[6] && e[2];
                    return W.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : i && B.test(i) && (t = de(i, !0)) && (t = i.indexOf(")", i.length - t) - i.length) && (e[0] = e[0].slice(0, t), 
                    e[2] = i.slice(0, t)), e.slice(0, 3));
                }
            },
            filter: {
                TAG: function(e) {
                    var t = e.replace(U, K).toLowerCase();
                    return "*" === e ? function() {
                        return !0;
                    } : function(e) {
                        return T(e, t);
                    };
                },
                CLASS: function(e) {
                    var t = w[e + " "];
                    return t || (t = new RegExp("(^|" + A + ")" + e + "(" + A + "|$)")) && w(e, (function(e) {
                        return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "");
                    }));
                },
                ATTR: function(e, t, i) {
                    return function(n) {
                        var s = Z.attr(n, e);
                        return null == s ? "!=" === t : !t || (s += "", "=" === t ? s === i : "!=" === t ? s !== i : "^=" === t ? i && 0 === s.indexOf(i) : "*=" === t ? i && s.indexOf(i) > -1 : "$=" === t ? i && s.slice(-i.length) === i : "~=" === t ? (" " + s.replace(z, " ") + " ").indexOf(i) > -1 : "|=" === t && (s === i || s.slice(0, i.length + 1) === i + "-"));
                    };
                },
                CHILD: function(e, t, i, n, s) {
                    var r = "nth" !== e.slice(0, 3), a = "last" !== e.slice(-4), o = "of-type" === t;
                    return 1 === n && 0 === s ? function(e) {
                        return !!e.parentNode;
                    } : function(t, i, l) {
                        var c, d, u, p, f, h = r !== a ? "nextSibling" : "previousSibling", m = t.parentNode, g = o && t.nodeName.toLowerCase(), b = !l && !o, w = !1;
                        if (m) {
                            if (r) {
                                for (;h; ) {
                                    for (u = t; u = u[h]; ) if (o ? T(u, g) : 1 === u.nodeType) return !1;
                                    f = h = "only" === e && !f && "nextSibling";
                                }
                                return !0;
                            }
                            if (f = [ a ? m.firstChild : m.lastChild ], a && b) {
                                for (w = (p = (c = (d = m[v] || (m[v] = {}))[e] || [])[0] === y && c[1]) && c[2], 
                                u = p && m.childNodes[p]; u = ++p && u && u[h] || (w = p = 0) || f.pop(); ) if (1 === u.nodeType && ++w && u === t) {
                                    d[e] = [ y, p, w ];
                                    break;
                                }
                            } else if (b && (w = p = (c = (d = t[v] || (t[v] = {}))[e] || [])[0] === y && c[1]), 
                            !1 === w) for (;(u = ++p && u && u[h] || (w = p = 0) || f.pop()) && (!(o ? T(u, g) : 1 === u.nodeType) || !++w || (b && ((d = u[v] || (u[v] = {}))[e] = [ y, w ]), 
                            u !== t)); ) ;
                            return (w -= s) === n || w % n == 0 && w / n >= 0;
                        }
                    };
                },
                PSEUDO: function(e, t) {
                    var i, s = n.pseudos[e] || n.setFilters[e.toLowerCase()] || Z.error("unsupported pseudo: " + e);
                    return s[v] ? s(t) : s.length > 1 ? (i = [ e, e, "", t ], n.setFilters.hasOwnProperty(e.toLowerCase()) ? te((function(e, i) {
                        for (var n, r = s(e, t), a = r.length; a--; ) e[n = o.call(e, r[a])] = !(i[n] = r[a]);
                    })) : function(e) {
                        return s(e, 0, i);
                    }) : s;
                }
            },
            pseudos: {
                not: te((function(e) {
                    var t = [], i = [], n = ve(e.replace(k, "$1"));
                    return n[v] ? te((function(e, t, i, s) {
                        for (var r, a = n(e, null, s, []), o = e.length; o--; ) (r = a[o]) && (e[o] = !(t[o] = r));
                    })) : function(e, s, r) {
                        return t[0] = e, n(t, null, r, i), t[0] = null, !i.pop();
                    };
                })),
                has: te((function(e) {
                    return function(t) {
                        return Z(e, t).length > 0;
                    };
                })),
                contains: te((function(e) {
                    return e = e.replace(U, K), function(t) {
                        return (t.textContent || E.text(t)).indexOf(e) > -1;
                    };
                })),
                lang: te((function(e) {
                    return F.test(e || "") || Z.error("unsupported lang: " + e), e = e.replace(U, K).toLowerCase(), 
                    function(t) {
                        var i;
                        do {
                            if (i = p ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return (i = i.toLowerCase()) === e || 0 === i.indexOf(e + "-");
                        } while ((t = t.parentNode) && 1 === t.nodeType);
                        return !1;
                    };
                })),
                target: function(t) {
                    var i = e.location && e.location.hash;
                    return i && i.slice(1) === t.id;
                },
                root: function(e) {
                    return e === u;
                },
                focus: function(e) {
                    return e === function() {
                        try {
                            return c.activeElement;
                        } catch (e) {}
                    }() && c.hasFocus() && !!(e.type || e.href || ~e.tabIndex);
                },
                enabled: re(!1),
                disabled: re(!0),
                checked: function(e) {
                    return T(e, "input") && !!e.checked || T(e, "option") && !!e.selected;
                },
                selected: function(e) {
                    return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected;
                },
                empty: function(e) {
                    for (e = e.firstChild; e; e = e.nextSibling) if (e.nodeType < 6) return !1;
                    return !0;
                },
                parent: function(e) {
                    return !n.pseudos.empty(e);
                },
                header: function(e) {
                    return X.test(e.nodeName);
                },
                input: function(e) {
                    return V.test(e.nodeName);
                },
                button: function(e) {
                    return T(e, "input") && "button" === e.type || T(e, "button");
                },
                text: function(e) {
                    var t;
                    return T(e, "input") && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase());
                },
                first: ae((function() {
                    return [ 0 ];
                })),
                last: ae((function(e, t) {
                    return [ t - 1 ];
                })),
                eq: ae((function(e, t, i) {
                    return [ i < 0 ? i + t : i ];
                })),
                even: ae((function(e, t) {
                    for (var i = 0; i < t; i += 2) e.push(i);
                    return e;
                })),
                odd: ae((function(e, t) {
                    for (var i = 1; i < t; i += 2) e.push(i);
                    return e;
                })),
                lt: ae((function(e, t, i) {
                    var n;
                    for (n = i < 0 ? i + t : i > t ? t : i; --n >= 0; ) e.push(n);
                    return e;
                })),
                gt: ae((function(e, t, i) {
                    for (var n = i < 0 ? i + t : i; ++n < t; ) e.push(n);
                    return e;
                }))
            }
        }, n.pseudos.nth = n.pseudos.eq, {
            radio: !0,
            checkbox: !0,
            file: !0,
            password: !0,
            image: !0
        }) n.pseudos[t] = ne(t);
        for (t in {
            submit: !0,
            reset: !0
        }) n.pseudos[t] = se(t);
        function ce() {}
        function de(e, t) {
            var i, s, r, a, o, l, c, d = x[e + " "];
            if (d) return t ? 0 : d.slice(0);
            for (o = e, l = [], c = n.preFilter; o; ) {
                for (a in i && !(s = H.exec(o)) || (s && (o = o.slice(s[0].length) || o), l.push(r = [])), 
                i = !1, (s = q.exec(o)) && (i = s.shift(), r.push({
                    value: i,
                    type: s[0].replace(k, " ")
                }), o = o.slice(i.length)), n.filter) !(s = W[a].exec(o)) || c[a] && !(s = c[a](s)) || (i = s.shift(), 
                r.push({
                    value: i,
                    type: a,
                    matches: s
                }), o = o.slice(i.length));
                if (!i) break;
            }
            return t ? o.length : o ? Z.error(e) : x(e, l).slice(0);
        }
        function ue(e) {
            for (var t = 0, i = e.length, n = ""; t < i; t++) n += e[t].value;
            return n;
        }
        function pe(e, t, i) {
            var n = t.dir, s = t.next, r = s || n, a = i && "parentNode" === r, o = b++;
            return t.first ? function(t, i, s) {
                for (;t = t[n]; ) if (1 === t.nodeType || a) return e(t, i, s);
                return !1;
            } : function(t, i, l) {
                var c, d, u = [ y, o ];
                if (l) {
                    for (;t = t[n]; ) if ((1 === t.nodeType || a) && e(t, i, l)) return !0;
                } else for (;t = t[n]; ) if (1 === t.nodeType || a) if (d = t[v] || (t[v] = {}), 
                s && T(t, s)) t = t[n] || t; else {
                    if ((c = d[r]) && c[0] === y && c[1] === o) return u[2] = c[2];
                    if (d[r] = u, u[2] = e(t, i, l)) return !0;
                }
                return !1;
            };
        }
        function fe(e) {
            return e.length > 1 ? function(t, i, n) {
                for (var s = e.length; s--; ) if (!e[s](t, i, n)) return !1;
                return !0;
            } : e[0];
        }
        function he(e, t, i, n, s) {
            for (var r, a = [], o = 0, l = e.length, c = null != t; o < l; o++) (r = e[o]) && (i && !i(r, n, s) || (a.push(r), 
            c && t.push(o)));
            return a;
        }
        function me(e, t, i, n, s, r) {
            return n && !n[v] && (n = me(n)), s && !s[v] && (s = me(s, r)), te((function(r, a, l, c) {
                var d, u, p, f, h = [], m = [], v = a.length, y = r || function(e, t, i) {
                    for (var n = 0, s = t.length; n < s; n++) Z(e, t[n], i);
                    return i;
                }(t || "*", l.nodeType ? [ l ] : l, []), b = !e || !r && t ? y : he(y, h, e, l, c);
                if (i ? i(b, f = s || (r ? e : v || n) ? [] : a, l, c) : f = b, n) for (d = he(f, m), 
                n(d, [], l, c), u = d.length; u--; ) (p = d[u]) && (f[m[u]] = !(b[m[u]] = p));
                if (r) {
                    if (s || e) {
                        if (s) {
                            for (d = [], u = f.length; u--; ) (p = f[u]) && d.push(b[u] = p);
                            s(null, f = [], d, c);
                        }
                        for (u = f.length; u--; ) (p = f[u]) && (d = s ? o.call(r, p) : h[u]) > -1 && (r[d] = !(a[d] = p));
                    }
                } else f = he(f === a ? f.splice(v, f.length) : f), s ? s(null, a, f, c) : g.apply(a, f);
            }));
        }
        function ge(e) {
            for (var t, i, s, a = e.length, l = n.relative[e[0].type], c = l || n.relative[" "], d = l ? 1 : 0, u = pe((function(e) {
                return e === t;
            }), c, !0), p = pe((function(e) {
                return o.call(t, e) > -1;
            }), c, !0), f = [ function(e, i, n) {
                var s = !l && (n || i != r) || ((t = i).nodeType ? u(e, i, n) : p(e, i, n));
                return t = null, s;
            } ]; d < a; d++) if (i = n.relative[e[d].type]) f = [ pe(fe(f), i) ]; else {
                if ((i = n.filter[e[d].type].apply(null, e[d].matches))[v]) {
                    for (s = ++d; s < a && !n.relative[e[s].type]; s++) ;
                    return me(d > 1 && fe(f), d > 1 && ue(e.slice(0, d - 1).concat({
                        value: " " === e[d - 2].type ? "*" : ""
                    })).replace(k, "$1"), i, d < s && ge(e.slice(d, s)), s < a && ge(e = e.slice(s)), s < a && ue(e));
                }
                f.push(i);
            }
            return fe(f);
        }
        function ve(e, t) {
            var i, s = [], a = [], o = _[e + " "];
            if (!o) {
                for (t || (t = de(e)), i = t.length; i--; ) (o = ge(t[i]))[v] ? s.push(o) : a.push(o);
                o = _(e, function(e, t) {
                    var i = t.length > 0, s = e.length > 0, a = function(a, o, l, d, u) {
                        var f, h, m, v = 0, b = "0", w = a && [], x = [], _ = r, T = a || s && n.find.TAG("*", u), C = y += null == _ ? 1 : Math.random() || .1, M = T.length;
                        for (u && (r = o == c || o || u); b !== M && null != (f = T[b]); b++) {
                            if (s && f) {
                                for (h = 0, o || f.ownerDocument == c || (le(f), l = !p); m = e[h++]; ) if (m(f, o || c, l)) {
                                    g.call(d, f);
                                    break;
                                }
                                u && (y = C);
                            }
                            i && ((f = !m && f) && v--, a && w.push(f));
                        }
                        if (v += b, i && b !== v) {
                            for (h = 0; m = t[h++]; ) m(w, x, o, l);
                            if (a) {
                                if (v > 0) for (;b--; ) w[b] || x[b] || (x[b] = S.call(d));
                                x = he(x);
                            }
                            g.apply(d, x), u && !a && x.length > 0 && v + t.length > 1 && E.uniqueSort(d);
                        }
                        return u && (y = C, r = _), w;
                    };
                    return i ? te(a) : a;
                }(a, s)), o.selector = e;
            }
            return o;
        }
        function ye(e, t, i, s) {
            var r, a, o, l, c, d = "function" == typeof e && e, u = !s && de(e = d.selector || e);
            if (i = i || [], 1 === u.length) {
                if ((a = u[0] = u[0].slice(0)).length > 2 && "ID" === (o = a[0]).type && 9 === t.nodeType && p && n.relative[a[1].type]) {
                    if (!(t = (n.find.ID(o.matches[0].replace(U, K), t) || [])[0])) return i;
                    d && (t = t.parentNode), e = e.slice(a.shift().value.length);
                }
                for (r = W.needsContext.test(e) ? 0 : a.length; r-- && (o = a[r], !n.relative[l = o.type]); ) if ((c = n.find[l]) && (s = c(o.matches[0].replace(U, K), Y.test(a[0].type) && oe(t.parentNode) || t))) {
                    if (a.splice(r, 1), !(e = s.length && ue(a))) return g.apply(i, s), i;
                    break;
                }
            }
            return (d || ve(e, u))(s, t, !p, i, !t || Y.test(e) && oe(t.parentNode) || t), i;
        }
        ce.prototype = n.filters = n.pseudos, n.setFilters = new ce, f.sortStable = v.split("").sort(P).join("") === v, 
        le(), f.sortDetached = ie((function(e) {
            return 1 & e.compareDocumentPosition(c.createElement("fieldset"));
        })), E.find = Z, E.expr[":"] = E.expr.pseudos, E.unique = E.uniqueSort, Z.compile = ve, 
        Z.select = ye, Z.setDocument = le, Z.tokenize = de, Z.escape = E.escapeSelector, 
        Z.getText = E.text, Z.isXML = E.isXMLDoc, Z.selectors = E.expr, Z.support = E.support, 
        Z.uniqueSort = E.uniqueSort;
    }();
    var I = function(e, t, i) {
        for (var n = [], s = void 0 !== i; (e = e[t]) && 9 !== e.nodeType; ) if (1 === e.nodeType) {
            if (s && E(e).is(i)) break;
            n.push(e);
        }
        return n;
    }, $ = function(e, t) {
        for (var i = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && i.push(e);
        return i;
    }, N = E.expr.match.needsContext, j = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;
    function z(e, t, i) {
        return h(t) ? E.grep(e, (function(e, n) {
            return !!t.call(e, n, e) !== i;
        })) : t.nodeType ? E.grep(e, (function(e) {
            return e === t !== i;
        })) : "string" != typeof t ? E.grep(e, (function(e) {
            return o.call(t, e) > -1 !== i;
        })) : E.filter(t, e, i);
    }
    E.filter = function(e, t, i) {
        var n = t[0];
        return i && (e = ":not(" + e + ")"), 1 === t.length && 1 === n.nodeType ? E.find.matchesSelector(n, e) ? [ n ] : [] : E.find.matches(e, E.grep(t, (function(e) {
            return 1 === e.nodeType;
        })));
    }, E.fn.extend({
        find: function(e) {
            var t, i, n = this.length, s = this;
            if ("string" != typeof e) return this.pushStack(E(e).filter((function() {
                for (t = 0; t < n; t++) if (E.contains(s[t], this)) return !0;
            })));
            for (i = this.pushStack([]), t = 0; t < n; t++) E.find(e, s[t], i);
            return n > 1 ? E.uniqueSort(i) : i;
        },
        filter: function(e) {
            return this.pushStack(z(this, e || [], !1));
        },
        not: function(e) {
            return this.pushStack(z(this, e || [], !0));
        },
        is: function(e) {
            return !!z(this, "string" == typeof e && N.test(e) ? E(e) : e || [], !1).length;
        }
    });
    var H, q = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
    (E.fn.init = function(e, t, i) {
        var n, s;
        if (!e) return this;
        if (i = i || H, "string" == typeof e) {
            if (!(n = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [ null, e, null ] : q.exec(e)) || !n[1] && t) return !t || t.jquery ? (t || i).find(e) : this.constructor(t).find(e);
            if (n[1]) {
                if (t = t instanceof E ? t[0] : t, E.merge(this, E.parseHTML(n[1], t && t.nodeType ? t.ownerDocument || t : g, !0)), 
                j.test(n[1]) && E.isPlainObject(t)) for (n in t) h(this[n]) ? this[n](t[n]) : this.attr(n, t[n]);
                return this;
            }
            return (s = g.getElementById(n[2])) && (this[0] = s, this.length = 1), this;
        }
        return e.nodeType ? (this[0] = e, this.length = 1, this) : h(e) ? void 0 !== i.ready ? i.ready(e) : e(E) : E.makeArray(e, this);
    }).prototype = E.fn, H = E(g);
    var R = /^(?:parents|prev(?:Until|All))/, B = {
        children: !0,
        contents: !0,
        next: !0,
        prev: !0
    };
    function F(e, t) {
        for (;(e = e[t]) && 1 !== e.nodeType; ) ;
        return e;
    }
    E.fn.extend({
        has: function(e) {
            var t = E(e, this), i = t.length;
            return this.filter((function() {
                for (var e = 0; e < i; e++) if (E.contains(this, t[e])) return !0;
            }));
        },
        closest: function(e, t) {
            var i, n = 0, s = this.length, r = [], a = "string" != typeof e && E(e);
            if (!N.test(e)) for (;n < s; n++) for (i = this[n]; i && i !== t; i = i.parentNode) if (i.nodeType < 11 && (a ? a.index(i) > -1 : 1 === i.nodeType && E.find.matchesSelector(i, e))) {
                r.push(i);
                break;
            }
            return this.pushStack(r.length > 1 ? E.uniqueSort(r) : r);
        },
        index: function(e) {
            return e ? "string" == typeof e ? o.call(E(e), this[0]) : o.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1;
        },
        add: function(e, t) {
            return this.pushStack(E.uniqueSort(E.merge(this.get(), E(e, t))));
        },
        addBack: function(e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e));
        }
    }), E.each({
        parent: function(e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null;
        },
        parents: function(e) {
            return I(e, "parentNode");
        },
        parentsUntil: function(e, t, i) {
            return I(e, "parentNode", i);
        },
        next: function(e) {
            return F(e, "nextSibling");
        },
        prev: function(e) {
            return F(e, "previousSibling");
        },
        nextAll: function(e) {
            return I(e, "nextSibling");
        },
        prevAll: function(e) {
            return I(e, "previousSibling");
        },
        nextUntil: function(e, t, i) {
            return I(e, "nextSibling", i);
        },
        prevUntil: function(e, t, i) {
            return I(e, "previousSibling", i);
        },
        siblings: function(e) {
            return $((e.parentNode || {}).firstChild, e);
        },
        children: function(e) {
            return $(e.firstChild);
        },
        contents: function(e) {
            return null != e.contentDocument && n(e.contentDocument) ? e.contentDocument : (T(e, "template") && (e = e.content || e), 
            E.merge([], e.childNodes));
        }
    }, (function(e, t) {
        E.fn[e] = function(i, n) {
            var s = E.map(this, t, i);
            return "Until" !== e.slice(-5) && (n = i), n && "string" == typeof n && (s = E.filter(n, s)), 
            this.length > 1 && (B[e] || E.uniqueSort(s), R.test(e) && s.reverse()), this.pushStack(s);
        };
    }));
    var W = /[^\x20\t\r\n\f]+/g;
    function V(e) {
        return e;
    }
    function X(e) {
        throw e;
    }
    function G(e, t, i, n) {
        var s;
        try {
            e && h(s = e.promise) ? s.call(e).done(t).fail(i) : e && h(s = e.then) ? s.call(e, t, i) : t.apply(void 0, [ e ].slice(n));
        } catch (e) {
            i.apply(void 0, [ e ]);
        }
    }
    E.Callbacks = function(e) {
        e = "string" == typeof e ? function(e) {
            var t = {};
            return E.each(e.match(W) || [], (function(e, i) {
                t[i] = !0;
            })), t;
        }(e) : E.extend({}, e);
        var t, i, n, s, r = [], a = [], o = -1, l = function() {
            for (s = s || e.once, n = t = !0; a.length; o = -1) for (i = a.shift(); ++o < r.length; ) !1 === r[o].apply(i[0], i[1]) && e.stopOnFalse && (o = r.length, 
            i = !1);
            e.memory || (i = !1), t = !1, s && (r = i ? [] : "");
        }, c = {
            add: function() {
                return r && (i && !t && (o = r.length - 1, a.push(i)), function t(i) {
                    E.each(i, (function(i, n) {
                        h(n) ? e.unique && c.has(n) || r.push(n) : n && n.length && "string" !== b(n) && t(n);
                    }));
                }(arguments), i && !t && l()), this;
            },
            remove: function() {
                return E.each(arguments, (function(e, t) {
                    for (var i; (i = E.inArray(t, r, i)) > -1; ) r.splice(i, 1), i <= o && o--;
                })), this;
            },
            has: function(e) {
                return e ? E.inArray(e, r) > -1 : r.length > 0;
            },
            empty: function() {
                return r && (r = []), this;
            },
            disable: function() {
                return s = a = [], r = i = "", this;
            },
            disabled: function() {
                return !r;
            },
            lock: function() {
                return s = a = [], i || t || (r = i = ""), this;
            },
            locked: function() {
                return !!s;
            },
            fireWith: function(e, i) {
                return s || (i = [ e, (i = i || []).slice ? i.slice() : i ], a.push(i), t || l()), 
                this;
            },
            fire: function() {
                return c.fireWith(this, arguments), this;
            },
            fired: function() {
                return !!n;
            }
        };
        return c;
    }, E.extend({
        Deferred: function(t) {
            var i = [ [ "notify", "progress", E.Callbacks("memory"), E.Callbacks("memory"), 2 ], [ "resolve", "done", E.Callbacks("once memory"), E.Callbacks("once memory"), 0, "resolved" ], [ "reject", "fail", E.Callbacks("once memory"), E.Callbacks("once memory"), 1, "rejected" ] ], n = "pending", s = {
                state: function() {
                    return n;
                },
                always: function() {
                    return r.done(arguments).fail(arguments), this;
                },
                catch: function(e) {
                    return s.then(null, e);
                },
                pipe: function() {
                    var e = arguments;
                    return E.Deferred((function(t) {
                        E.each(i, (function(i, n) {
                            var s = h(e[n[4]]) && e[n[4]];
                            r[n[1]]((function() {
                                var e = s && s.apply(this, arguments);
                                e && h(e.promise) ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[n[0] + "With"](this, s ? [ e ] : arguments);
                            }));
                        })), e = null;
                    })).promise();
                },
                then: function(t, n, s) {
                    var r = 0;
                    function a(t, i, n, s) {
                        return function() {
                            var o = this, l = arguments, c = function() {
                                var e, c;
                                if (!(t < r)) {
                                    if ((e = n.apply(o, l)) === i.promise()) throw new TypeError("Thenable self-resolution");
                                    c = e && ("object" == typeof e || "function" == typeof e) && e.then, h(c) ? s ? c.call(e, a(r, i, V, s), a(r, i, X, s)) : (r++, 
                                    c.call(e, a(r, i, V, s), a(r, i, X, s), a(r, i, V, i.notifyWith))) : (n !== V && (o = void 0, 
                                    l = [ e ]), (s || i.resolveWith)(o, l));
                                }
                            }, d = s ? c : function() {
                                try {
                                    c();
                                } catch (e) {
                                    E.Deferred.exceptionHook && E.Deferred.exceptionHook(e, d.error), t + 1 >= r && (n !== X && (o = void 0, 
                                    l = [ e ]), i.rejectWith(o, l));
                                }
                            };
                            t ? d() : (E.Deferred.getErrorHook ? d.error = E.Deferred.getErrorHook() : E.Deferred.getStackHook && (d.error = E.Deferred.getStackHook()), 
                            e.setTimeout(d));
                        };
                    }
                    return E.Deferred((function(e) {
                        i[0][3].add(a(0, e, h(s) ? s : V, e.notifyWith)), i[1][3].add(a(0, e, h(t) ? t : V)), 
                        i[2][3].add(a(0, e, h(n) ? n : X));
                    })).promise();
                },
                promise: function(e) {
                    return null != e ? E.extend(e, s) : s;
                }
            }, r = {};
            return E.each(i, (function(e, t) {
                var a = t[2], o = t[5];
                s[t[1]] = a.add, o && a.add((function() {
                    n = o;
                }), i[3 - e][2].disable, i[3 - e][3].disable, i[0][2].lock, i[0][3].lock), a.add(t[3].fire), 
                r[t[0]] = function() {
                    return r[t[0] + "With"](this === r ? void 0 : this, arguments), this;
                }, r[t[0] + "With"] = a.fireWith;
            })), s.promise(r), t && t.call(r, r), r;
        },
        when: function(e) {
            var t = arguments.length, i = t, n = Array(i), r = s.call(arguments), a = E.Deferred(), o = function(e) {
                return function(i) {
                    n[e] = this, r[e] = arguments.length > 1 ? s.call(arguments) : i, --t || a.resolveWith(n, r);
                };
            };
            if (t <= 1 && (G(e, a.done(o(i)).resolve, a.reject, !t), "pending" === a.state() || h(r[i] && r[i].then))) return a.then();
            for (;i--; ) G(r[i], o(i), a.reject);
            return a.promise();
        }
    });
    var Y = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    E.Deferred.exceptionHook = function(t, i) {
        e.console && e.console.warn && t && Y.test(t.name) && e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, i);
    }, E.readyException = function(t) {
        e.setTimeout((function() {
            throw t;
        }));
    };
    var U = E.Deferred();
    function K() {
        g.removeEventListener("DOMContentLoaded", K), e.removeEventListener("load", K), 
        E.ready();
    }
    E.fn.ready = function(e) {
        return U.then(e).catch((function(e) {
            E.readyException(e);
        })), this;
    }, E.extend({
        isReady: !1,
        readyWait: 1,
        ready: function(e) {
            (!0 === e ? --E.readyWait : E.isReady) || (E.isReady = !0, !0 !== e && --E.readyWait > 0 || U.resolveWith(g, [ E ]));
        }
    }), E.ready.then = U.then, "complete" === g.readyState || "loading" !== g.readyState && !g.documentElement.doScroll ? e.setTimeout(E.ready) : (g.addEventListener("DOMContentLoaded", K), 
    e.addEventListener("load", K));
    var Q = function(e, t, i, n, s, r, a) {
        var o = 0, l = e.length, c = null == i;
        if ("object" === b(i)) for (o in s = !0, i) Q(e, t, o, i[o], !0, r, a); else if (void 0 !== n && (s = !0, 
        h(n) || (a = !0), c && (a ? (t.call(e, n), t = null) : (c = t, t = function(e, t, i) {
            return c.call(E(e), i);
        })), t)) for (;o < l; o++) t(e[o], i, a ? n : n.call(e[o], o, t(e[o], i)));
        return s ? e : c ? t.call(e) : l ? t(e[0], i) : r;
    }, J = /^-ms-/, Z = /-([a-z])/g;
    function ee(e, t) {
        return t.toUpperCase();
    }
    function te(e) {
        return e.replace(J, "ms-").replace(Z, ee);
    }
    var ie = function(e) {
        return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType;
    };
    function ne() {
        this.expando = E.expando + ne.uid++;
    }
    ne.uid = 1, ne.prototype = {
        cache: function(e) {
            var t = e[this.expando];
            return t || (t = {}, ie(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                value: t,
                configurable: !0
            }))), t;
        },
        set: function(e, t, i) {
            var n, s = this.cache(e);
            if ("string" == typeof t) s[te(t)] = i; else for (n in t) s[te(n)] = t[n];
            return s;
        },
        get: function(e, t) {
            return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][te(t)];
        },
        access: function(e, t, i) {
            return void 0 === t || t && "string" == typeof t && void 0 === i ? this.get(e, t) : (this.set(e, t, i), 
            void 0 !== i ? i : t);
        },
        remove: function(e, t) {
            var i, n = e[this.expando];
            if (void 0 !== n) {
                if (void 0 !== t) {
                    i = (t = Array.isArray(t) ? t.map(te) : (t = te(t)) in n ? [ t ] : t.match(W) || []).length;
                    for (;i--; ) delete n[t[i]];
                }
                (void 0 === t || E.isEmptyObject(n)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando]);
            }
        },
        hasData: function(e) {
            var t = e[this.expando];
            return void 0 !== t && !E.isEmptyObject(t);
        }
    };
    var se = new ne, re = new ne, ae = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, oe = /[A-Z]/g;
    function le(e, t, i) {
        var n;
        if (void 0 === i && 1 === e.nodeType) if (n = "data-" + t.replace(oe, "-$&").toLowerCase(), 
        "string" == typeof (i = e.getAttribute(n))) {
            try {
                i = function(e) {
                    return "true" === e || "false" !== e && ("null" === e ? null : e === +e + "" ? +e : ae.test(e) ? JSON.parse(e) : e);
                }(i);
            } catch (e) {}
            re.set(e, t, i);
        } else i = void 0;
        return i;
    }
    E.extend({
        hasData: function(e) {
            return re.hasData(e) || se.hasData(e);
        },
        data: function(e, t, i) {
            return re.access(e, t, i);
        },
        removeData: function(e, t) {
            re.remove(e, t);
        },
        _data: function(e, t, i) {
            return se.access(e, t, i);
        },
        _removeData: function(e, t) {
            se.remove(e, t);
        }
    }), E.fn.extend({
        data: function(e, t) {
            var i, n, s, r = this[0], a = r && r.attributes;
            if (void 0 === e) {
                if (this.length && (s = re.get(r), 1 === r.nodeType && !se.get(r, "hasDataAttrs"))) {
                    for (i = a.length; i--; ) a[i] && 0 === (n = a[i].name).indexOf("data-") && (n = te(n.slice(5)), 
                    le(r, n, s[n]));
                    se.set(r, "hasDataAttrs", !0);
                }
                return s;
            }
            return "object" == typeof e ? this.each((function() {
                re.set(this, e);
            })) : Q(this, (function(t) {
                var i;
                if (r && void 0 === t) return void 0 !== (i = re.get(r, e)) || void 0 !== (i = le(r, e)) ? i : void 0;
                this.each((function() {
                    re.set(this, e, t);
                }));
            }), null, t, arguments.length > 1, null, !0);
        },
        removeData: function(e) {
            return this.each((function() {
                re.remove(this, e);
            }));
        }
    }), E.extend({
        queue: function(e, t, i) {
            var n;
            if (e) return t = (t || "fx") + "queue", n = se.get(e, t), i && (!n || Array.isArray(i) ? n = se.access(e, t, E.makeArray(i)) : n.push(i)), 
            n || [];
        },
        dequeue: function(e, t) {
            t = t || "fx";
            var i = E.queue(e, t), n = i.length, s = i.shift(), r = E._queueHooks(e, t);
            "inprogress" === s && (s = i.shift(), n--), s && ("fx" === t && i.unshift("inprogress"), 
            delete r.stop, s.call(e, (function() {
                E.dequeue(e, t);
            }), r)), !n && r && r.empty.fire();
        },
        _queueHooks: function(e, t) {
            var i = t + "queueHooks";
            return se.get(e, i) || se.access(e, i, {
                empty: E.Callbacks("once memory").add((function() {
                    se.remove(e, [ t + "queue", i ]);
                }))
            });
        }
    }), E.fn.extend({
        queue: function(e, t) {
            var i = 2;
            return "string" != typeof e && (t = e, e = "fx", i--), arguments.length < i ? E.queue(this[0], e) : void 0 === t ? this : this.each((function() {
                var i = E.queue(this, e, t);
                E._queueHooks(this, e), "fx" === e && "inprogress" !== i[0] && E.dequeue(this, e);
            }));
        },
        dequeue: function(e) {
            return this.each((function() {
                E.dequeue(this, e);
            }));
        },
        clearQueue: function(e) {
            return this.queue(e || "fx", []);
        },
        promise: function(e, t) {
            var i, n = 1, s = E.Deferred(), r = this, a = this.length, o = function() {
                --n || s.resolveWith(r, [ r ]);
            };
            for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; a--; ) (i = se.get(r[a], e + "queueHooks")) && i.empty && (n++, 
            i.empty.add(o));
            return o(), s.promise(t);
        }
    });
    var ce = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, de = new RegExp("^(?:([+-])=|)(" + ce + ")([a-z%]*)$", "i"), ue = [ "Top", "Right", "Bottom", "Left" ], pe = g.documentElement, fe = function(e) {
        return E.contains(e.ownerDocument, e);
    }, he = {
        composed: !0
    };
    pe.getRootNode && (fe = function(e) {
        return E.contains(e.ownerDocument, e) || e.getRootNode(he) === e.ownerDocument;
    });
    var me = function(e, t) {
        return "none" === (e = t || e).style.display || "" === e.style.display && fe(e) && "none" === E.css(e, "display");
    };
    function ge(e, t, i, n) {
        var s, r, a = 20, o = n ? function() {
            return n.cur();
        } : function() {
            return E.css(e, t, "");
        }, l = o(), c = i && i[3] || (E.cssNumber[t] ? "" : "px"), d = e.nodeType && (E.cssNumber[t] || "px" !== c && +l) && de.exec(E.css(e, t));
        if (d && d[3] !== c) {
            for (l /= 2, c = c || d[3], d = +l || 1; a--; ) E.style(e, t, d + c), (1 - r) * (1 - (r = o() / l || .5)) <= 0 && (a = 0), 
            d /= r;
            d *= 2, E.style(e, t, d + c), i = i || [];
        }
        return i && (d = +d || +l || 0, s = i[1] ? d + (i[1] + 1) * i[2] : +i[2], n && (n.unit = c, 
        n.start = d, n.end = s)), s;
    }
    var ve = {};
    function ye(e) {
        var t, i = e.ownerDocument, n = e.nodeName, s = ve[n];
        return s || (t = i.body.appendChild(i.createElement(n)), s = E.css(t, "display"), 
        t.parentNode.removeChild(t), "none" === s && (s = "block"), ve[n] = s, s);
    }
    function be(e, t) {
        for (var i, n, s = [], r = 0, a = e.length; r < a; r++) (n = e[r]).style && (i = n.style.display, 
        t ? ("none" === i && (s[r] = se.get(n, "display") || null, s[r] || (n.style.display = "")), 
        "" === n.style.display && me(n) && (s[r] = ye(n))) : "none" !== i && (s[r] = "none", 
        se.set(n, "display", i)));
        for (r = 0; r < a; r++) null != s[r] && (e[r].style.display = s[r]);
        return e;
    }
    E.fn.extend({
        show: function() {
            return be(this, !0);
        },
        hide: function() {
            return be(this);
        },
        toggle: function(e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each((function() {
                me(this) ? E(this).show() : E(this).hide();
            }));
        }
    });
    var we, xe, Ee = /^(?:checkbox|radio)$/i, _e = /<([a-z][^\/\0>\x20\t\r\n\f]*)/i, Te = /^$|^module$|\/(?:java|ecma)script/i;
    we = g.createDocumentFragment().appendChild(g.createElement("div")), (xe = g.createElement("input")).setAttribute("type", "radio"), 
    xe.setAttribute("checked", "checked"), xe.setAttribute("name", "t"), we.appendChild(xe), 
    f.checkClone = we.cloneNode(!0).cloneNode(!0).lastChild.checked, we.innerHTML = "<textarea>x</textarea>", 
    f.noCloneChecked = !!we.cloneNode(!0).lastChild.defaultValue, we.innerHTML = "<option></option>", 
    f.option = !!we.lastChild;
    var Se = {
        thead: [ 1, "<table>", "</table>" ],
        col: [ 2, "<table><colgroup>", "</colgroup></table>" ],
        tr: [ 2, "<table><tbody>", "</tbody></table>" ],
        td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],
        _default: [ 0, "", "" ]
    };
    function Ce(e, t) {
        var i;
        return i = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], 
        void 0 === t || t && T(e, t) ? E.merge([ e ], i) : i;
    }
    function Me(e, t) {
        for (var i = 0, n = e.length; i < n; i++) se.set(e[i], "globalEval", !t || se.get(t[i], "globalEval"));
    }
    Se.tbody = Se.tfoot = Se.colgroup = Se.caption = Se.thead, Se.th = Se.td, f.option || (Se.optgroup = Se.option = [ 1, "<select multiple='multiple'>", "</select>" ]);
    var Ae = /<|&#?\w+;/;
    function ke(e, t, i, n, s) {
        for (var r, a, o, l, c, d, u = t.createDocumentFragment(), p = [], f = 0, h = e.length; f < h; f++) if ((r = e[f]) || 0 === r) if ("object" === b(r)) E.merge(p, r.nodeType ? [ r ] : r); else if (Ae.test(r)) {
            for (a = a || u.appendChild(t.createElement("div")), o = (_e.exec(r) || [ "", "" ])[1].toLowerCase(), 
            l = Se[o] || Se._default, a.innerHTML = l[1] + E.htmlPrefilter(r) + l[2], d = l[0]; d--; ) a = a.lastChild;
            E.merge(p, a.childNodes), (a = u.firstChild).textContent = "";
        } else p.push(t.createTextNode(r));
        for (u.textContent = "", f = 0; r = p[f++]; ) if (n && E.inArray(r, n) > -1) s && s.push(r); else if (c = fe(r), 
        a = Ce(u.appendChild(r), "script"), c && Me(a), i) for (d = 0; r = a[d++]; ) Te.test(r.type || "") && i.push(r);
        return u;
    }
    var Le = /^([^.]*)(?:\.(.+)|)/;
    function Pe() {
        return !0;
    }
    function Oe() {
        return !1;
    }
    function De(e, t, i, n, s, r) {
        var a, o;
        if ("object" == typeof t) {
            for (o in "string" != typeof i && (n = n || i, i = void 0), t) De(e, o, i, n, t[o], r);
            return e;
        }
        if (null == n && null == s ? (s = i, n = i = void 0) : null == s && ("string" == typeof i ? (s = n, 
        n = void 0) : (s = n, n = i, i = void 0)), !1 === s) s = Oe; else if (!s) return e;
        return 1 === r && (a = s, s = function(e) {
            return E().off(e), a.apply(this, arguments);
        }, s.guid = a.guid || (a.guid = E.guid++)), e.each((function() {
            E.event.add(this, t, s, n, i);
        }));
    }
    function Ie(e, t, i) {
        i ? (se.set(e, t, !1), E.event.add(e, t, {
            namespace: !1,
            handler: function(e) {
                var i, n = se.get(this, t);
                if (1 & e.isTrigger && this[t]) {
                    if (n) (E.event.special[t] || {}).delegateType && e.stopPropagation(); else if (n = s.call(arguments), 
                    se.set(this, t, n), this[t](), i = se.get(this, t), se.set(this, t, !1), n !== i) return e.stopImmediatePropagation(), 
                    e.preventDefault(), i;
                } else n && (se.set(this, t, E.event.trigger(n[0], n.slice(1), this)), e.stopPropagation(), 
                e.isImmediatePropagationStopped = Pe);
            }
        })) : void 0 === se.get(e, t) && E.event.add(e, t, Pe);
    }
    E.event = {
        global: {},
        add: function(e, t, i, n, s) {
            var r, a, o, l, c, d, u, p, f, h, m, g = se.get(e);
            if (ie(e)) for (i.handler && (i = (r = i).handler, s = r.selector), s && E.find.matchesSelector(pe, s), 
            i.guid || (i.guid = E.guid++), (l = g.events) || (l = g.events = Object.create(null)), 
            (a = g.handle) || (a = g.handle = function(t) {
                return void 0 !== E && E.event.triggered !== t.type ? E.event.dispatch.apply(e, arguments) : void 0;
            }), c = (t = (t || "").match(W) || [ "" ]).length; c--; ) f = m = (o = Le.exec(t[c]) || [])[1], 
            h = (o[2] || "").split(".").sort(), f && (u = E.event.special[f] || {}, f = (s ? u.delegateType : u.bindType) || f, 
            u = E.event.special[f] || {}, d = E.extend({
                type: f,
                origType: m,
                data: n,
                handler: i,
                guid: i.guid,
                selector: s,
                needsContext: s && E.expr.match.needsContext.test(s),
                namespace: h.join(".")
            }, r), (p = l[f]) || ((p = l[f] = []).delegateCount = 0, u.setup && !1 !== u.setup.call(e, n, h, a) || e.addEventListener && e.addEventListener(f, a)), 
            u.add && (u.add.call(e, d), d.handler.guid || (d.handler.guid = i.guid)), s ? p.splice(p.delegateCount++, 0, d) : p.push(d), 
            E.event.global[f] = !0);
        },
        remove: function(e, t, i, n, s) {
            var r, a, o, l, c, d, u, p, f, h, m, g = se.hasData(e) && se.get(e);
            if (g && (l = g.events)) {
                for (c = (t = (t || "").match(W) || [ "" ]).length; c--; ) if (f = m = (o = Le.exec(t[c]) || [])[1], 
                h = (o[2] || "").split(".").sort(), f) {
                    for (u = E.event.special[f] || {}, p = l[f = (n ? u.delegateType : u.bindType) || f] || [], 
                    o = o[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), a = r = p.length; r--; ) d = p[r], 
                    !s && m !== d.origType || i && i.guid !== d.guid || o && !o.test(d.namespace) || n && n !== d.selector && ("**" !== n || !d.selector) || (p.splice(r, 1), 
                    d.selector && p.delegateCount--, u.remove && u.remove.call(e, d));
                    a && !p.length && (u.teardown && !1 !== u.teardown.call(e, h, g.handle) || E.removeEvent(e, f, g.handle), 
                    delete l[f]);
                } else for (f in l) E.event.remove(e, f + t[c], i, n, !0);
                E.isEmptyObject(l) && se.remove(e, "handle events");
            }
        },
        dispatch: function(e) {
            var t, i, n, s, r, a, o = new Array(arguments.length), l = E.event.fix(e), c = (se.get(this, "events") || Object.create(null))[l.type] || [], d = E.event.special[l.type] || {};
            for (o[0] = l, t = 1; t < arguments.length; t++) o[t] = arguments[t];
            if (l.delegateTarget = this, !d.preDispatch || !1 !== d.preDispatch.call(this, l)) {
                for (a = E.event.handlers.call(this, l, c), t = 0; (s = a[t++]) && !l.isPropagationStopped(); ) for (l.currentTarget = s.elem, 
                i = 0; (r = s.handlers[i++]) && !l.isImmediatePropagationStopped(); ) l.rnamespace && !1 !== r.namespace && !l.rnamespace.test(r.namespace) || (l.handleObj = r, 
                l.data = r.data, void 0 !== (n = ((E.event.special[r.origType] || {}).handle || r.handler).apply(s.elem, o)) && !1 === (l.result = n) && (l.preventDefault(), 
                l.stopPropagation()));
                return d.postDispatch && d.postDispatch.call(this, l), l.result;
            }
        },
        handlers: function(e, t) {
            var i, n, s, r, a, o = [], l = t.delegateCount, c = e.target;
            if (l && c.nodeType && !("click" === e.type && e.button >= 1)) for (;c !== this; c = c.parentNode || this) if (1 === c.nodeType && ("click" !== e.type || !0 !== c.disabled)) {
                for (r = [], a = {}, i = 0; i < l; i++) void 0 === a[s = (n = t[i]).selector + " "] && (a[s] = n.needsContext ? E(s, this).index(c) > -1 : E.find(s, this, null, [ c ]).length), 
                a[s] && r.push(n);
                r.length && o.push({
                    elem: c,
                    handlers: r
                });
            }
            return c = this, l < t.length && o.push({
                elem: c,
                handlers: t.slice(l)
            }), o;
        },
        addProp: function(e, t) {
            Object.defineProperty(E.Event.prototype, e, {
                enumerable: !0,
                configurable: !0,
                get: h(t) ? function() {
                    if (this.originalEvent) return t(this.originalEvent);
                } : function() {
                    if (this.originalEvent) return this.originalEvent[e];
                },
                set: function(t) {
                    Object.defineProperty(this, e, {
                        enumerable: !0,
                        configurable: !0,
                        writable: !0,
                        value: t
                    });
                }
            });
        },
        fix: function(e) {
            return e[E.expando] ? e : new E.Event(e);
        },
        special: {
            load: {
                noBubble: !0
            },
            click: {
                setup: function(e) {
                    var t = this || e;
                    return Ee.test(t.type) && t.click && T(t, "input") && Ie(t, "click", !0), !1;
                },
                trigger: function(e) {
                    var t = this || e;
                    return Ee.test(t.type) && t.click && T(t, "input") && Ie(t, "click"), !0;
                },
                _default: function(e) {
                    var t = e.target;
                    return Ee.test(t.type) && t.click && T(t, "input") && se.get(t, "click") || T(t, "a");
                }
            },
            beforeunload: {
                postDispatch: function(e) {
                    void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result);
                }
            }
        }
    }, E.removeEvent = function(e, t, i) {
        e.removeEventListener && e.removeEventListener(t, i);
    }, E.Event = function(e, t) {
        if (!(this instanceof E.Event)) return new E.Event(e, t);
        e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? Pe : Oe, 
        this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, 
        this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, 
        t && E.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[E.expando] = !0;
    }, E.Event.prototype = {
        constructor: E.Event,
        isDefaultPrevented: Oe,
        isPropagationStopped: Oe,
        isImmediatePropagationStopped: Oe,
        isSimulated: !1,
        preventDefault: function() {
            var e = this.originalEvent;
            this.isDefaultPrevented = Pe, e && !this.isSimulated && e.preventDefault();
        },
        stopPropagation: function() {
            var e = this.originalEvent;
            this.isPropagationStopped = Pe, e && !this.isSimulated && e.stopPropagation();
        },
        stopImmediatePropagation: function() {
            var e = this.originalEvent;
            this.isImmediatePropagationStopped = Pe, e && !this.isSimulated && e.stopImmediatePropagation(), 
            this.stopPropagation();
        }
    }, E.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        code: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: !0
    }, E.event.addProp), E.each({
        focus: "focusin",
        blur: "focusout"
    }, (function(e, t) {
        function i(e) {
            if (g.documentMode) {
                var i = se.get(this, "handle"), n = E.event.fix(e);
                n.type = "focusin" === e.type ? "focus" : "blur", n.isSimulated = !0, i(e), n.target === n.currentTarget && i(n);
            } else E.event.simulate(t, e.target, E.event.fix(e));
        }
        E.event.special[e] = {
            setup: function() {
                var n;
                if (Ie(this, e, !0), !g.documentMode) return !1;
                (n = se.get(this, t)) || this.addEventListener(t, i), se.set(this, t, (n || 0) + 1);
            },
            trigger: function() {
                return Ie(this, e), !0;
            },
            teardown: function() {
                var e;
                if (!g.documentMode) return !1;
                (e = se.get(this, t) - 1) ? se.set(this, t, e) : (this.removeEventListener(t, i), 
                se.remove(this, t));
            },
            _default: function(t) {
                return se.get(t.target, e);
            },
            delegateType: t
        }, E.event.special[t] = {
            setup: function() {
                var n = this.ownerDocument || this.document || this, s = g.documentMode ? this : n, r = se.get(s, t);
                r || (g.documentMode ? this.addEventListener(t, i) : n.addEventListener(e, i, !0)), 
                se.set(s, t, (r || 0) + 1);
            },
            teardown: function() {
                var n = this.ownerDocument || this.document || this, s = g.documentMode ? this : n, r = se.get(s, t) - 1;
                r ? se.set(s, t, r) : (g.documentMode ? this.removeEventListener(t, i) : n.removeEventListener(e, i, !0), 
                se.remove(s, t));
            }
        };
    })), E.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, (function(e, t) {
        E.event.special[e] = {
            delegateType: t,
            bindType: t,
            handle: function(e) {
                var i, n = e.relatedTarget, s = e.handleObj;
                return n && (n === this || E.contains(this, n)) || (e.type = s.origType, i = s.handler.apply(this, arguments), 
                e.type = t), i;
            }
        };
    })), E.fn.extend({
        on: function(e, t, i, n) {
            return De(this, e, t, i, n);
        },
        one: function(e, t, i, n) {
            return De(this, e, t, i, n, 1);
        },
        off: function(e, t, i) {
            var n, s;
            if (e && e.preventDefault && e.handleObj) return n = e.handleObj, E(e.delegateTarget).off(n.namespace ? n.origType + "." + n.namespace : n.origType, n.selector, n.handler), 
            this;
            if ("object" == typeof e) {
                for (s in e) this.off(s, t, e[s]);
                return this;
            }
            return !1 !== t && "function" != typeof t || (i = t, t = void 0), !1 === i && (i = Oe), 
            this.each((function() {
                E.event.remove(this, e, i, t);
            }));
        }
    });
    var $e = /<script|<style|<link/i, Ne = /checked\s*(?:[^=]|=\s*.checked.)/i, je = /^\s*<!\[CDATA\[|\]\]>\s*$/g;
    function ze(e, t) {
        return T(e, "table") && T(11 !== t.nodeType ? t : t.firstChild, "tr") && E(e).children("tbody")[0] || e;
    }
    function He(e) {
        return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e;
    }
    function qe(e) {
        return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), 
        e;
    }
    function Re(e, t) {
        var i, n, s, r, a, o;
        if (1 === t.nodeType) {
            if (se.hasData(e) && (o = se.get(e).events)) for (s in se.remove(t, "handle events"), 
            o) for (i = 0, n = o[s].length; i < n; i++) E.event.add(t, s, o[s][i]);
            re.hasData(e) && (r = re.access(e), a = E.extend({}, r), re.set(t, a));
        }
    }
    function Be(e, t) {
        var i = t.nodeName.toLowerCase();
        "input" === i && Ee.test(e.type) ? t.checked = e.checked : "input" !== i && "textarea" !== i || (t.defaultValue = e.defaultValue);
    }
    function Fe(e, t, i, n) {
        t = r(t);
        var s, a, o, l, c, d, u = 0, p = e.length, m = p - 1, g = t[0], v = h(g);
        if (v || p > 1 && "string" == typeof g && !f.checkClone && Ne.test(g)) return e.each((function(s) {
            var r = e.eq(s);
            v && (t[0] = g.call(this, s, r.html())), Fe(r, t, i, n);
        }));
        if (p && (a = (s = ke(t, e[0].ownerDocument, !1, e, n)).firstChild, 1 === s.childNodes.length && (s = a), 
        a || n)) {
            for (l = (o = E.map(Ce(s, "script"), He)).length; u < p; u++) c = s, u !== m && (c = E.clone(c, !0, !0), 
            l && E.merge(o, Ce(c, "script"))), i.call(e[u], c, u);
            if (l) for (d = o[o.length - 1].ownerDocument, E.map(o, qe), u = 0; u < l; u++) c = o[u], 
            Te.test(c.type || "") && !se.access(c, "globalEval") && E.contains(d, c) && (c.src && "module" !== (c.type || "").toLowerCase() ? E._evalUrl && !c.noModule && E._evalUrl(c.src, {
                nonce: c.nonce || c.getAttribute("nonce")
            }, d) : y(c.textContent.replace(je, ""), c, d));
        }
        return e;
    }
    function We(e, t, i) {
        for (var n, s = t ? E.filter(t, e) : e, r = 0; null != (n = s[r]); r++) i || 1 !== n.nodeType || E.cleanData(Ce(n)), 
        n.parentNode && (i && fe(n) && Me(Ce(n, "script")), n.parentNode.removeChild(n));
        return e;
    }
    E.extend({
        htmlPrefilter: function(e) {
            return e;
        },
        clone: function(e, t, i) {
            var n, s, r, a, o = e.cloneNode(!0), l = fe(e);
            if (!(f.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || E.isXMLDoc(e))) for (a = Ce(o), 
            n = 0, s = (r = Ce(e)).length; n < s; n++) Be(r[n], a[n]);
            if (t) if (i) for (r = r || Ce(e), a = a || Ce(o), n = 0, s = r.length; n < s; n++) Re(r[n], a[n]); else Re(e, o);
            return (a = Ce(o, "script")).length > 0 && Me(a, !l && Ce(e, "script")), o;
        },
        cleanData: function(e) {
            for (var t, i, n, s = E.event.special, r = 0; void 0 !== (i = e[r]); r++) if (ie(i)) {
                if (t = i[se.expando]) {
                    if (t.events) for (n in t.events) s[n] ? E.event.remove(i, n) : E.removeEvent(i, n, t.handle);
                    i[se.expando] = void 0;
                }
                i[re.expando] && (i[re.expando] = void 0);
            }
        }
    }), E.fn.extend({
        detach: function(e) {
            return We(this, e, !0);
        },
        remove: function(e) {
            return We(this, e);
        },
        text: function(e) {
            return Q(this, (function(e) {
                return void 0 === e ? E.text(this) : this.empty().each((function() {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e);
                }));
            }), null, e, arguments.length);
        },
        append: function() {
            return Fe(this, arguments, (function(e) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || ze(this, e).appendChild(e);
            }));
        },
        prepend: function() {
            return Fe(this, arguments, (function(e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = ze(this, e);
                    t.insertBefore(e, t.firstChild);
                }
            }));
        },
        before: function() {
            return Fe(this, arguments, (function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this);
            }));
        },
        after: function() {
            return Fe(this, arguments, (function(e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling);
            }));
        },
        empty: function() {
            for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (E.cleanData(Ce(e, !1)), 
            e.textContent = "");
            return this;
        },
        clone: function(e, t) {
            return e = null != e && e, t = null == t ? e : t, this.map((function() {
                return E.clone(this, e, t);
            }));
        },
        html: function(e) {
            return Q(this, (function(e) {
                var t = this[0] || {}, i = 0, n = this.length;
                if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
                if ("string" == typeof e && !$e.test(e) && !Se[(_e.exec(e) || [ "", "" ])[1].toLowerCase()]) {
                    e = E.htmlPrefilter(e);
                    try {
                        for (;i < n; i++) 1 === (t = this[i] || {}).nodeType && (E.cleanData(Ce(t, !1)), 
                        t.innerHTML = e);
                        t = 0;
                    } catch (e) {}
                }
                t && this.empty().append(e);
            }), null, e, arguments.length);
        },
        replaceWith: function() {
            var e = [];
            return Fe(this, arguments, (function(t) {
                var i = this.parentNode;
                E.inArray(this, e) < 0 && (E.cleanData(Ce(this)), i && i.replaceChild(t, this));
            }), e);
        }
    }), E.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, (function(e, t) {
        E.fn[e] = function(e) {
            for (var i, n = [], s = E(e), r = s.length - 1, o = 0; o <= r; o++) i = o === r ? this : this.clone(!0), 
            E(s[o])[t](i), a.apply(n, i.get());
            return this.pushStack(n);
        };
    }));
    var Ve = new RegExp("^(" + ce + ")(?!px)[a-z%]+$", "i"), Xe = /^--/, Ge = function(t) {
        var i = t.ownerDocument.defaultView;
        return i && i.opener || (i = e), i.getComputedStyle(t);
    }, Ye = function(e, t, i) {
        var n, s, r = {};
        for (s in t) r[s] = e.style[s], e.style[s] = t[s];
        for (s in n = i.call(e), t) e.style[s] = r[s];
        return n;
    }, Ue = new RegExp(ue.join("|"), "i");
    function Ke(e, t, i) {
        var n, s, r, a, o = Xe.test(t), l = e.style;
        return (i = i || Ge(e)) && (a = i.getPropertyValue(t) || i[t], o && a && (a = a.replace(k, "$1") || void 0), 
        "" !== a || fe(e) || (a = E.style(e, t)), !f.pixelBoxStyles() && Ve.test(a) && Ue.test(t) && (n = l.width, 
        s = l.minWidth, r = l.maxWidth, l.minWidth = l.maxWidth = l.width = a, a = i.width, 
        l.width = n, l.minWidth = s, l.maxWidth = r)), void 0 !== a ? a + "" : a;
    }
    function Qe(e, t) {
        return {
            get: function() {
                if (!e()) return (this.get = t).apply(this, arguments);
                delete this.get;
            }
        };
    }
    !function() {
        function t() {
            if (d) {
                c.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", 
                d.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", 
                pe.appendChild(c).appendChild(d);
                var t = e.getComputedStyle(d);
                n = "1%" !== t.top, l = 12 === i(t.marginLeft), d.style.right = "60%", a = 36 === i(t.right), 
                s = 36 === i(t.width), d.style.position = "absolute", r = 12 === i(d.offsetWidth / 3), 
                pe.removeChild(c), d = null;
            }
        }
        function i(e) {
            return Math.round(parseFloat(e));
        }
        var n, s, r, a, o, l, c = g.createElement("div"), d = g.createElement("div");
        d.style && (d.style.backgroundClip = "content-box", d.cloneNode(!0).style.backgroundClip = "", 
        f.clearCloneStyle = "content-box" === d.style.backgroundClip, E.extend(f, {
            boxSizingReliable: function() {
                return t(), s;
            },
            pixelBoxStyles: function() {
                return t(), a;
            },
            pixelPosition: function() {
                return t(), n;
            },
            reliableMarginLeft: function() {
                return t(), l;
            },
            scrollboxSize: function() {
                return t(), r;
            },
            reliableTrDimensions: function() {
                var t, i, n, s;
                return null == o && (t = g.createElement("table"), i = g.createElement("tr"), n = g.createElement("div"), 
                t.style.cssText = "position:absolute;left:-11111px;border-collapse:separate", i.style.cssText = "box-sizing:content-box;border:1px solid", 
                i.style.height = "1px", n.style.height = "9px", n.style.display = "block", pe.appendChild(t).appendChild(i).appendChild(n), 
                s = e.getComputedStyle(i), o = parseInt(s.height, 10) + parseInt(s.borderTopWidth, 10) + parseInt(s.borderBottomWidth, 10) === i.offsetHeight, 
                pe.removeChild(t)), o;
            }
        }));
    }();
    var Je = [ "Webkit", "Moz", "ms" ], Ze = g.createElement("div").style, et = {};
    function tt(e) {
        var t = E.cssProps[e] || et[e];
        return t || (e in Ze ? e : et[e] = function(e) {
            for (var t = e[0].toUpperCase() + e.slice(1), i = Je.length; i--; ) if ((e = Je[i] + t) in Ze) return e;
        }(e) || e);
    }
    var it = /^(none|table(?!-c[ea]).+)/, nt = {
        position: "absolute",
        visibility: "hidden",
        display: "block"
    }, st = {
        letterSpacing: "0",
        fontWeight: "400"
    };
    function rt(e, t, i) {
        var n = de.exec(t);
        return n ? Math.max(0, n[2] - (i || 0)) + (n[3] || "px") : t;
    }
    function at(e, t, i, n, s, r) {
        var a = "width" === t ? 1 : 0, o = 0, l = 0, c = 0;
        if (i === (n ? "border" : "content")) return 0;
        for (;a < 4; a += 2) "margin" === i && (c += E.css(e, i + ue[a], !0, s)), n ? ("content" === i && (l -= E.css(e, "padding" + ue[a], !0, s)), 
        "margin" !== i && (l -= E.css(e, "border" + ue[a] + "Width", !0, s))) : (l += E.css(e, "padding" + ue[a], !0, s), 
        "padding" !== i ? l += E.css(e, "border" + ue[a] + "Width", !0, s) : o += E.css(e, "border" + ue[a] + "Width", !0, s));
        return !n && r >= 0 && (l += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - r - l - o - .5)) || 0), 
        l + c;
    }
    function ot(e, t, i) {
        var n = Ge(e), s = (!f.boxSizingReliable() || i) && "border-box" === E.css(e, "boxSizing", !1, n), r = s, a = Ke(e, t, n), o = "offset" + t[0].toUpperCase() + t.slice(1);
        if (Ve.test(a)) {
            if (!i) return a;
            a = "auto";
        }
        return (!f.boxSizingReliable() && s || !f.reliableTrDimensions() && T(e, "tr") || "auto" === a || !parseFloat(a) && "inline" === E.css(e, "display", !1, n)) && e.getClientRects().length && (s = "border-box" === E.css(e, "boxSizing", !1, n), 
        (r = o in e) && (a = e[o])), (a = parseFloat(a) || 0) + at(e, t, i || (s ? "border" : "content"), r, n, a) + "px";
    }
    function lt(e, t, i, n, s) {
        return new lt.prototype.init(e, t, i, n, s);
    }
    E.extend({
        cssHooks: {
            opacity: {
                get: function(e, t) {
                    if (t) {
                        var i = Ke(e, "opacity");
                        return "" === i ? "1" : i;
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            aspectRatio: !0,
            borderImageSlice: !0,
            columnCount: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            gridArea: !0,
            gridColumn: !0,
            gridColumnEnd: !0,
            gridColumnStart: !0,
            gridRow: !0,
            gridRowEnd: !0,
            gridRowStart: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            scale: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0,
            fillOpacity: !0,
            floodOpacity: !0,
            stopOpacity: !0,
            strokeMiterlimit: !0,
            strokeOpacity: !0
        },
        cssProps: {},
        style: function(e, t, i, n) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var s, r, a, o = te(t), l = Xe.test(t), c = e.style;
                if (l || (t = tt(o)), a = E.cssHooks[t] || E.cssHooks[o], void 0 === i) return a && "get" in a && void 0 !== (s = a.get(e, !1, n)) ? s : c[t];
                "string" === (r = typeof i) && (s = de.exec(i)) && s[1] && (i = ge(e, t, s), r = "number"), 
                null != i && i == i && ("number" !== r || l || (i += s && s[3] || (E.cssNumber[o] ? "" : "px")), 
                f.clearCloneStyle || "" !== i || 0 !== t.indexOf("background") || (c[t] = "inherit"), 
                a && "set" in a && void 0 === (i = a.set(e, i, n)) || (l ? c.setProperty(t, i) : c[t] = i));
            }
        },
        css: function(e, t, i, n) {
            var s, r, a, o = te(t);
            return Xe.test(t) || (t = tt(o)), (a = E.cssHooks[t] || E.cssHooks[o]) && "get" in a && (s = a.get(e, !0, i)), 
            void 0 === s && (s = Ke(e, t, n)), "normal" === s && t in st && (s = st[t]), "" === i || i ? (r = parseFloat(s), 
            !0 === i || isFinite(r) ? r || 0 : s) : s;
        }
    }), E.each([ "height", "width" ], (function(e, t) {
        E.cssHooks[t] = {
            get: function(e, i, n) {
                if (i) return !it.test(E.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? ot(e, t, n) : Ye(e, nt, (function() {
                    return ot(e, t, n);
                }));
            },
            set: function(e, i, n) {
                var s, r = Ge(e), a = !f.scrollboxSize() && "absolute" === r.position, o = (a || n) && "border-box" === E.css(e, "boxSizing", !1, r), l = n ? at(e, t, n, o, r) : 0;
                return o && a && (l -= Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - parseFloat(r[t]) - at(e, t, "border", !1, r) - .5)), 
                l && (s = de.exec(i)) && "px" !== (s[3] || "px") && (e.style[t] = i, i = E.css(e, t)), 
                rt(0, i, l);
            }
        };
    })), E.cssHooks.marginLeft = Qe(f.reliableMarginLeft, (function(e, t) {
        if (t) return (parseFloat(Ke(e, "marginLeft")) || e.getBoundingClientRect().left - Ye(e, {
            marginLeft: 0
        }, (function() {
            return e.getBoundingClientRect().left;
        }))) + "px";
    })), E.each({
        margin: "",
        padding: "",
        border: "Width"
    }, (function(e, t) {
        E.cssHooks[e + t] = {
            expand: function(i) {
                for (var n = 0, s = {}, r = "string" == typeof i ? i.split(" ") : [ i ]; n < 4; n++) s[e + ue[n] + t] = r[n] || r[n - 2] || r[0];
                return s;
            }
        }, "margin" !== e && (E.cssHooks[e + t].set = rt);
    })), E.fn.extend({
        css: function(e, t) {
            return Q(this, (function(e, t, i) {
                var n, s, r = {}, a = 0;
                if (Array.isArray(t)) {
                    for (n = Ge(e), s = t.length; a < s; a++) r[t[a]] = E.css(e, t[a], !1, n);
                    return r;
                }
                return void 0 !== i ? E.style(e, t, i) : E.css(e, t);
            }), e, t, arguments.length > 1);
        }
    }), E.Tween = lt, lt.prototype = {
        constructor: lt,
        init: function(e, t, i, n, s, r) {
            this.elem = e, this.prop = i, this.easing = s || E.easing._default, this.options = t, 
            this.start = this.now = this.cur(), this.end = n, this.unit = r || (E.cssNumber[i] ? "" : "px");
        },
        cur: function() {
            var e = lt.propHooks[this.prop];
            return e && e.get ? e.get(this) : lt.propHooks._default.get(this);
        },
        run: function(e) {
            var t, i = lt.propHooks[this.prop];
            return this.options.duration ? this.pos = t = E.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, 
            this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), 
            i && i.set ? i.set(this) : lt.propHooks._default.set(this), this;
        }
    }, lt.prototype.init.prototype = lt.prototype, lt.propHooks = {
        _default: {
            get: function(e) {
                var t;
                return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = E.css(e.elem, e.prop, "")) && "auto" !== t ? t : 0;
            },
            set: function(e) {
                E.fx.step[e.prop] ? E.fx.step[e.prop](e) : 1 !== e.elem.nodeType || !E.cssHooks[e.prop] && null == e.elem.style[tt(e.prop)] ? e.elem[e.prop] = e.now : E.style(e.elem, e.prop, e.now + e.unit);
            }
        }
    }, lt.propHooks.scrollTop = lt.propHooks.scrollLeft = {
        set: function(e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now);
        }
    }, E.easing = {
        linear: function(e) {
            return e;
        },
        swing: function(e) {
            return .5 - Math.cos(e * Math.PI) / 2;
        },
        _default: "swing"
    }, E.fx = lt.prototype.init, E.fx.step = {};
    var ct, dt, ut = /^(?:toggle|show|hide)$/, pt = /queueHooks$/;
    function ft() {
        dt && (!1 === g.hidden && e.requestAnimationFrame ? e.requestAnimationFrame(ft) : e.setTimeout(ft, E.fx.interval), 
        E.fx.tick());
    }
    function ht() {
        return e.setTimeout((function() {
            ct = void 0;
        })), ct = Date.now();
    }
    function mt(e, t) {
        var i, n = 0, s = {
            height: e
        };
        for (t = t ? 1 : 0; n < 4; n += 2 - t) s["margin" + (i = ue[n])] = s["padding" + i] = e;
        return t && (s.opacity = s.width = e), s;
    }
    function gt(e, t, i) {
        for (var n, s = (vt.tweeners[t] || []).concat(vt.tweeners["*"]), r = 0, a = s.length; r < a; r++) if (n = s[r].call(i, t, e)) return n;
    }
    function vt(e, t, i) {
        var n, s, r = 0, a = vt.prefilters.length, o = E.Deferred().always((function() {
            delete l.elem;
        })), l = function() {
            if (s) return !1;
            for (var t = ct || ht(), i = Math.max(0, c.startTime + c.duration - t), n = 1 - (i / c.duration || 0), r = 0, a = c.tweens.length; r < a; r++) c.tweens[r].run(n);
            return o.notifyWith(e, [ c, n, i ]), n < 1 && a ? i : (a || o.notifyWith(e, [ c, 1, 0 ]), 
            o.resolveWith(e, [ c ]), !1);
        }, c = o.promise({
            elem: e,
            props: E.extend({}, t),
            opts: E.extend(!0, {
                specialEasing: {},
                easing: E.easing._default
            }, i),
            originalProperties: t,
            originalOptions: i,
            startTime: ct || ht(),
            duration: i.duration,
            tweens: [],
            createTween: function(t, i) {
                var n = E.Tween(e, c.opts, t, i, c.opts.specialEasing[t] || c.opts.easing);
                return c.tweens.push(n), n;
            },
            stop: function(t) {
                var i = 0, n = t ? c.tweens.length : 0;
                if (s) return this;
                for (s = !0; i < n; i++) c.tweens[i].run(1);
                return t ? (o.notifyWith(e, [ c, 1, 0 ]), o.resolveWith(e, [ c, t ])) : o.rejectWith(e, [ c, t ]), 
                this;
            }
        }), d = c.props;
        for (!function(e, t) {
            var i, n, s, r, a;
            for (i in e) if (s = t[n = te(i)], r = e[i], Array.isArray(r) && (s = r[1], r = e[i] = r[0]), 
            i !== n && (e[n] = r, delete e[i]), (a = E.cssHooks[n]) && "expand" in a) for (i in r = a.expand(r), 
            delete e[n], r) i in e || (e[i] = r[i], t[i] = s); else t[n] = s;
        }(d, c.opts.specialEasing); r < a; r++) if (n = vt.prefilters[r].call(c, e, d, c.opts)) return h(n.stop) && (E._queueHooks(c.elem, c.opts.queue).stop = n.stop.bind(n)), 
        n;
        return E.map(d, gt, c), h(c.opts.start) && c.opts.start.call(e, c), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always), 
        E.fx.timer(E.extend(l, {
            elem: e,
            anim: c,
            queue: c.opts.queue
        })), c;
    }
    E.Animation = E.extend(vt, {
        tweeners: {
            "*": [ function(e, t) {
                var i = this.createTween(e, t);
                return ge(i.elem, e, de.exec(t), i), i;
            } ]
        },
        tweener: function(e, t) {
            h(e) ? (t = e, e = [ "*" ]) : e = e.match(W);
            for (var i, n = 0, s = e.length; n < s; n++) i = e[n], vt.tweeners[i] = vt.tweeners[i] || [], 
            vt.tweeners[i].unshift(t);
        },
        prefilters: [ function(e, t, i) {
            var n, s, r, a, o, l, c, d, u = "width" in t || "height" in t, p = this, f = {}, h = e.style, m = e.nodeType && me(e), g = se.get(e, "fxshow");
            for (n in i.queue || (null == (a = E._queueHooks(e, "fx")).unqueued && (a.unqueued = 0, 
            o = a.empty.fire, a.empty.fire = function() {
                a.unqueued || o();
            }), a.unqueued++, p.always((function() {
                p.always((function() {
                    a.unqueued--, E.queue(e, "fx").length || a.empty.fire();
                }));
            }))), t) if (s = t[n], ut.test(s)) {
                if (delete t[n], r = r || "toggle" === s, s === (m ? "hide" : "show")) {
                    if ("show" !== s || !g || void 0 === g[n]) continue;
                    m = !0;
                }
                f[n] = g && g[n] || E.style(e, n);
            }
            if ((l = !E.isEmptyObject(t)) || !E.isEmptyObject(f)) for (n in u && 1 === e.nodeType && (i.overflow = [ h.overflow, h.overflowX, h.overflowY ], 
            null == (c = g && g.display) && (c = se.get(e, "display")), "none" === (d = E.css(e, "display")) && (c ? d = c : (be([ e ], !0), 
            c = e.style.display || c, d = E.css(e, "display"), be([ e ]))), ("inline" === d || "inline-block" === d && null != c) && "none" === E.css(e, "float") && (l || (p.done((function() {
                h.display = c;
            })), null == c && (d = h.display, c = "none" === d ? "" : d)), h.display = "inline-block")), 
            i.overflow && (h.overflow = "hidden", p.always((function() {
                h.overflow = i.overflow[0], h.overflowX = i.overflow[1], h.overflowY = i.overflow[2];
            }))), l = !1, f) l || (g ? "hidden" in g && (m = g.hidden) : g = se.access(e, "fxshow", {
                display: c
            }), r && (g.hidden = !m), m && be([ e ], !0), p.done((function() {
                for (n in m || be([ e ]), se.remove(e, "fxshow"), f) E.style(e, n, f[n]);
            }))), l = gt(m ? g[n] : 0, n, p), n in g || (g[n] = l.start, m && (l.end = l.start, 
            l.start = 0));
        } ],
        prefilter: function(e, t) {
            t ? vt.prefilters.unshift(e) : vt.prefilters.push(e);
        }
    }), E.speed = function(e, t, i) {
        var n = e && "object" == typeof e ? E.extend({}, e) : {
            complete: i || !i && t || h(e) && e,
            duration: e,
            easing: i && t || t && !h(t) && t
        };
        return E.fx.off ? n.duration = 0 : "number" != typeof n.duration && (n.duration in E.fx.speeds ? n.duration = E.fx.speeds[n.duration] : n.duration = E.fx.speeds._default), 
        null != n.queue && !0 !== n.queue || (n.queue = "fx"), n.old = n.complete, n.complete = function() {
            h(n.old) && n.old.call(this), n.queue && E.dequeue(this, n.queue);
        }, n;
    }, E.fn.extend({
        fadeTo: function(e, t, i, n) {
            return this.filter(me).css("opacity", 0).show().end().animate({
                opacity: t
            }, e, i, n);
        },
        animate: function(e, t, i, n) {
            var s = E.isEmptyObject(e), r = E.speed(t, i, n), a = function() {
                var t = vt(this, E.extend({}, e), r);
                (s || se.get(this, "finish")) && t.stop(!0);
            };
            return a.finish = a, s || !1 === r.queue ? this.each(a) : this.queue(r.queue, a);
        },
        stop: function(e, t, i) {
            var n = function(e) {
                var t = e.stop;
                delete e.stop, t(i);
            };
            return "string" != typeof e && (i = t, t = e, e = void 0), t && this.queue(e || "fx", []), 
            this.each((function() {
                var t = !0, s = null != e && e + "queueHooks", r = E.timers, a = se.get(this);
                if (s) a[s] && a[s].stop && n(a[s]); else for (s in a) a[s] && a[s].stop && pt.test(s) && n(a[s]);
                for (s = r.length; s--; ) r[s].elem !== this || null != e && r[s].queue !== e || (r[s].anim.stop(i), 
                t = !1, r.splice(s, 1));
                !t && i || E.dequeue(this, e);
            }));
        },
        finish: function(e) {
            return !1 !== e && (e = e || "fx"), this.each((function() {
                var t, i = se.get(this), n = i[e + "queue"], s = i[e + "queueHooks"], r = E.timers, a = n ? n.length : 0;
                for (i.finish = !0, E.queue(this, e, []), s && s.stop && s.stop.call(this, !0), 
                t = r.length; t--; ) r[t].elem === this && r[t].queue === e && (r[t].anim.stop(!0), 
                r.splice(t, 1));
                for (t = 0; t < a; t++) n[t] && n[t].finish && n[t].finish.call(this);
                delete i.finish;
            }));
        }
    }), E.each([ "toggle", "show", "hide" ], (function(e, t) {
        var i = E.fn[t];
        E.fn[t] = function(e, n, s) {
            return null == e || "boolean" == typeof e ? i.apply(this, arguments) : this.animate(mt(t, !0), e, n, s);
        };
    })), E.each({
        slideDown: mt("show"),
        slideUp: mt("hide"),
        slideToggle: mt("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, (function(e, t) {
        E.fn[e] = function(e, i, n) {
            return this.animate(t, e, i, n);
        };
    })), E.timers = [], E.fx.tick = function() {
        var e, t = 0, i = E.timers;
        for (ct = Date.now(); t < i.length; t++) (e = i[t])() || i[t] !== e || i.splice(t--, 1);
        i.length || E.fx.stop(), ct = void 0;
    }, E.fx.timer = function(e) {
        E.timers.push(e), E.fx.start();
    }, E.fx.interval = 13, E.fx.start = function() {
        dt || (dt = !0, ft());
    }, E.fx.stop = function() {
        dt = null;
    }, E.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, E.fn.delay = function(t, i) {
        return t = E.fx && E.fx.speeds[t] || t, i = i || "fx", this.queue(i, (function(i, n) {
            var s = e.setTimeout(i, t);
            n.stop = function() {
                e.clearTimeout(s);
            };
        }));
    }, function() {
        var e = g.createElement("input"), t = g.createElement("select").appendChild(g.createElement("option"));
        e.type = "checkbox", f.checkOn = "" !== e.value, f.optSelected = t.selected, (e = g.createElement("input")).value = "t", 
        e.type = "radio", f.radioValue = "t" === e.value;
    }();
    var yt, bt = E.expr.attrHandle;
    E.fn.extend({
        attr: function(e, t) {
            return Q(this, E.attr, e, t, arguments.length > 1);
        },
        removeAttr: function(e) {
            return this.each((function() {
                E.removeAttr(this, e);
            }));
        }
    }), E.extend({
        attr: function(e, t, i) {
            var n, s, r = e.nodeType;
            if (3 !== r && 8 !== r && 2 !== r) return void 0 === e.getAttribute ? E.prop(e, t, i) : (1 === r && E.isXMLDoc(e) || (s = E.attrHooks[t.toLowerCase()] || (E.expr.match.bool.test(t) ? yt : void 0)), 
            void 0 !== i ? null === i ? void E.removeAttr(e, t) : s && "set" in s && void 0 !== (n = s.set(e, i, t)) ? n : (e.setAttribute(t, i + ""), 
            i) : s && "get" in s && null !== (n = s.get(e, t)) ? n : null == (n = E.find.attr(e, t)) ? void 0 : n);
        },
        attrHooks: {
            type: {
                set: function(e, t) {
                    if (!f.radioValue && "radio" === t && T(e, "input")) {
                        var i = e.value;
                        return e.setAttribute("type", t), i && (e.value = i), t;
                    }
                }
            }
        },
        removeAttr: function(e, t) {
            var i, n = 0, s = t && t.match(W);
            if (s && 1 === e.nodeType) for (;i = s[n++]; ) e.removeAttribute(i);
        }
    }), yt = {
        set: function(e, t, i) {
            return !1 === t ? E.removeAttr(e, i) : e.setAttribute(i, i), i;
        }
    }, E.each(E.expr.match.bool.source.match(/\w+/g), (function(e, t) {
        var i = bt[t] || E.find.attr;
        bt[t] = function(e, t, n) {
            var s, r, a = t.toLowerCase();
            return n || (r = bt[a], bt[a] = s, s = null != i(e, t, n) ? a : null, bt[a] = r), 
            s;
        };
    }));
    var wt = /^(?:input|select|textarea|button)$/i, xt = /^(?:a|area)$/i;
    function Et(e) {
        return (e.match(W) || []).join(" ");
    }
    function _t(e) {
        return e.getAttribute && e.getAttribute("class") || "";
    }
    function Tt(e) {
        return Array.isArray(e) ? e : "string" == typeof e && e.match(W) || [];
    }
    E.fn.extend({
        prop: function(e, t) {
            return Q(this, E.prop, e, t, arguments.length > 1);
        },
        removeProp: function(e) {
            return this.each((function() {
                delete this[E.propFix[e] || e];
            }));
        }
    }), E.extend({
        prop: function(e, t, i) {
            var n, s, r = e.nodeType;
            if (3 !== r && 8 !== r && 2 !== r) return 1 === r && E.isXMLDoc(e) || (t = E.propFix[t] || t, 
            s = E.propHooks[t]), void 0 !== i ? s && "set" in s && void 0 !== (n = s.set(e, i, t)) ? n : e[t] = i : s && "get" in s && null !== (n = s.get(e, t)) ? n : e[t];
        },
        propHooks: {
            tabIndex: {
                get: function(e) {
                    var t = E.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : wt.test(e.nodeName) || xt.test(e.nodeName) && e.href ? 0 : -1;
                }
            }
        },
        propFix: {
            for: "htmlFor",
            class: "className"
        }
    }), f.optSelected || (E.propHooks.selected = {
        get: function(e) {
            var t = e.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null;
        },
        set: function(e) {
            var t = e.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex);
        }
    }), E.each([ "tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable" ], (function() {
        E.propFix[this.toLowerCase()] = this;
    })), E.fn.extend({
        addClass: function(e) {
            var t, i, n, s, r, a;
            return h(e) ? this.each((function(t) {
                E(this).addClass(e.call(this, t, _t(this)));
            })) : (t = Tt(e)).length ? this.each((function() {
                if (n = _t(this), i = 1 === this.nodeType && " " + Et(n) + " ") {
                    for (r = 0; r < t.length; r++) s = t[r], i.indexOf(" " + s + " ") < 0 && (i += s + " ");
                    a = Et(i), n !== a && this.setAttribute("class", a);
                }
            })) : this;
        },
        removeClass: function(e) {
            var t, i, n, s, r, a;
            return h(e) ? this.each((function(t) {
                E(this).removeClass(e.call(this, t, _t(this)));
            })) : arguments.length ? (t = Tt(e)).length ? this.each((function() {
                if (n = _t(this), i = 1 === this.nodeType && " " + Et(n) + " ") {
                    for (r = 0; r < t.length; r++) for (s = t[r]; i.indexOf(" " + s + " ") > -1; ) i = i.replace(" " + s + " ", " ");
                    a = Et(i), n !== a && this.setAttribute("class", a);
                }
            })) : this : this.attr("class", "");
        },
        toggleClass: function(e, t) {
            var i, n, s, r, a = typeof e, o = "string" === a || Array.isArray(e);
            return h(e) ? this.each((function(i) {
                E(this).toggleClass(e.call(this, i, _t(this), t), t);
            })) : "boolean" == typeof t && o ? t ? this.addClass(e) : this.removeClass(e) : (i = Tt(e), 
            this.each((function() {
                if (o) for (r = E(this), s = 0; s < i.length; s++) n = i[s], r.hasClass(n) ? r.removeClass(n) : r.addClass(n); else void 0 !== e && "boolean" !== a || ((n = _t(this)) && se.set(this, "__className__", n), 
                this.setAttribute && this.setAttribute("class", n || !1 === e ? "" : se.get(this, "__className__") || ""));
            })));
        },
        hasClass: function(e) {
            var t, i, n = 0;
            for (t = " " + e + " "; i = this[n++]; ) if (1 === i.nodeType && (" " + Et(_t(i)) + " ").indexOf(t) > -1) return !0;
            return !1;
        }
    });
    var St = /\r/g;
    E.fn.extend({
        val: function(e) {
            var t, i, n, s = this[0];
            return arguments.length ? (n = h(e), this.each((function(i) {
                var s;
                1 === this.nodeType && (null == (s = n ? e.call(this, i, E(this).val()) : e) ? s = "" : "number" == typeof s ? s += "" : Array.isArray(s) && (s = E.map(s, (function(e) {
                    return null == e ? "" : e + "";
                }))), (t = E.valHooks[this.type] || E.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, s, "value") || (this.value = s));
            }))) : s ? (t = E.valHooks[s.type] || E.valHooks[s.nodeName.toLowerCase()]) && "get" in t && void 0 !== (i = t.get(s, "value")) ? i : "string" == typeof (i = s.value) ? i.replace(St, "") : null == i ? "" : i : void 0;
        }
    }), E.extend({
        valHooks: {
            option: {
                get: function(e) {
                    var t = E.find.attr(e, "value");
                    return null != t ? t : Et(E.text(e));
                }
            },
            select: {
                get: function(e) {
                    var t, i, n, s = e.options, r = e.selectedIndex, a = "select-one" === e.type, o = a ? null : [], l = a ? r + 1 : s.length;
                    for (n = r < 0 ? l : a ? r : 0; n < l; n++) if (((i = s[n]).selected || n === r) && !i.disabled && (!i.parentNode.disabled || !T(i.parentNode, "optgroup"))) {
                        if (t = E(i).val(), a) return t;
                        o.push(t);
                    }
                    return o;
                },
                set: function(e, t) {
                    for (var i, n, s = e.options, r = E.makeArray(t), a = s.length; a--; ) ((n = s[a]).selected = E.inArray(E.valHooks.option.get(n), r) > -1) && (i = !0);
                    return i || (e.selectedIndex = -1), r;
                }
            }
        }
    }), E.each([ "radio", "checkbox" ], (function() {
        E.valHooks[this] = {
            set: function(e, t) {
                if (Array.isArray(t)) return e.checked = E.inArray(E(e).val(), t) > -1;
            }
        }, f.checkOn || (E.valHooks[this].get = function(e) {
            return null === e.getAttribute("value") ? "on" : e.value;
        });
    }));
    var Ct = e.location, Mt = {
        guid: Date.now()
    }, At = /\?/;
    E.parseXML = function(t) {
        var i, n;
        if (!t || "string" != typeof t) return null;
        try {
            i = (new e.DOMParser).parseFromString(t, "text/xml");
        } catch (e) {}
        return n = i && i.getElementsByTagName("parsererror")[0], i && !n || E.error("Invalid XML: " + (n ? E.map(n.childNodes, (function(e) {
            return e.textContent;
        })).join("\n") : t)), i;
    };
    var kt = /^(?:focusinfocus|focusoutblur)$/, Lt = function(e) {
        e.stopPropagation();
    };
    E.extend(E.event, {
        trigger: function(t, i, n, s) {
            var r, a, o, l, c, u, p, f, v = [ n || g ], y = d.call(t, "type") ? t.type : t, b = d.call(t, "namespace") ? t.namespace.split(".") : [];
            if (a = f = o = n = n || g, 3 !== n.nodeType && 8 !== n.nodeType && !kt.test(y + E.event.triggered) && (y.indexOf(".") > -1 && (b = y.split("."), 
            y = b.shift(), b.sort()), c = y.indexOf(":") < 0 && "on" + y, (t = t[E.expando] ? t : new E.Event(y, "object" == typeof t && t)).isTrigger = s ? 2 : 3, 
            t.namespace = b.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, 
            t.result = void 0, t.target || (t.target = n), i = null == i ? [ t ] : E.makeArray(i, [ t ]), 
            p = E.event.special[y] || {}, s || !p.trigger || !1 !== p.trigger.apply(n, i))) {
                if (!s && !p.noBubble && !m(n)) {
                    for (l = p.delegateType || y, kt.test(l + y) || (a = a.parentNode); a; a = a.parentNode) v.push(a), 
                    o = a;
                    o === (n.ownerDocument || g) && v.push(o.defaultView || o.parentWindow || e);
                }
                for (r = 0; (a = v[r++]) && !t.isPropagationStopped(); ) f = a, t.type = r > 1 ? l : p.bindType || y, 
                (u = (se.get(a, "events") || Object.create(null))[t.type] && se.get(a, "handle")) && u.apply(a, i), 
                (u = c && a[c]) && u.apply && ie(a) && (t.result = u.apply(a, i), !1 === t.result && t.preventDefault());
                return t.type = y, s || t.isDefaultPrevented() || p._default && !1 !== p._default.apply(v.pop(), i) || !ie(n) || c && h(n[y]) && !m(n) && ((o = n[c]) && (n[c] = null), 
                E.event.triggered = y, t.isPropagationStopped() && f.addEventListener(y, Lt), n[y](), 
                t.isPropagationStopped() && f.removeEventListener(y, Lt), E.event.triggered = void 0, 
                o && (n[c] = o)), t.result;
            }
        },
        simulate: function(e, t, i) {
            var n = E.extend(new E.Event, i, {
                type: e,
                isSimulated: !0
            });
            E.event.trigger(n, null, t);
        }
    }), E.fn.extend({
        trigger: function(e, t) {
            return this.each((function() {
                E.event.trigger(e, t, this);
            }));
        },
        triggerHandler: function(e, t) {
            var i = this[0];
            if (i) return E.event.trigger(e, t, i, !0);
        }
    });
    var Pt = /\[\]$/, Ot = /\r?\n/g, Dt = /^(?:submit|button|image|reset|file)$/i, It = /^(?:input|select|textarea|keygen)/i;
    function $t(e, t, i, n) {
        var s;
        if (Array.isArray(t)) E.each(t, (function(t, s) {
            i || Pt.test(e) ? n(e, s) : $t(e + "[" + ("object" == typeof s && null != s ? t : "") + "]", s, i, n);
        })); else if (i || "object" !== b(t)) n(e, t); else for (s in t) $t(e + "[" + s + "]", t[s], i, n);
    }
    E.param = function(e, t) {
        var i, n = [], s = function(e, t) {
            var i = h(t) ? t() : t;
            n[n.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == i ? "" : i);
        };
        if (null == e) return "";
        if (Array.isArray(e) || e.jquery && !E.isPlainObject(e)) E.each(e, (function() {
            s(this.name, this.value);
        })); else for (i in e) $t(i, e[i], t, s);
        return n.join("&");
    }, E.fn.extend({
        serialize: function() {
            return E.param(this.serializeArray());
        },
        serializeArray: function() {
            return this.map((function() {
                var e = E.prop(this, "elements");
                return e ? E.makeArray(e) : this;
            })).filter((function() {
                var e = this.type;
                return this.name && !E(this).is(":disabled") && It.test(this.nodeName) && !Dt.test(e) && (this.checked || !Ee.test(e));
            })).map((function(e, t) {
                var i = E(this).val();
                return null == i ? null : Array.isArray(i) ? E.map(i, (function(e) {
                    return {
                        name: t.name,
                        value: e.replace(Ot, "\r\n")
                    };
                })) : {
                    name: t.name,
                    value: i.replace(Ot, "\r\n")
                };
            })).get();
        }
    });
    var Nt = /%20/g, jt = /#.*$/, zt = /([?&])_=[^&]*/, Ht = /^(.*?):[ \t]*([^\r\n]*)$/gm, qt = /^(?:GET|HEAD)$/, Rt = /^\/\//, Bt = {}, Ft = {}, Wt = "*/".concat("*"), Vt = g.createElement("a");
    function Xt(e) {
        return function(t, i) {
            "string" != typeof t && (i = t, t = "*");
            var n, s = 0, r = t.toLowerCase().match(W) || [];
            if (h(i)) for (;n = r[s++]; ) "+" === n[0] ? (n = n.slice(1) || "*", (e[n] = e[n] || []).unshift(i)) : (e[n] = e[n] || []).push(i);
        };
    }
    function Gt(e, t, i, n) {
        var s = {}, r = e === Ft;
        function a(o) {
            var l;
            return s[o] = !0, E.each(e[o] || [], (function(e, o) {
                var c = o(t, i, n);
                return "string" != typeof c || r || s[c] ? r ? !(l = c) : void 0 : (t.dataTypes.unshift(c), 
                a(c), !1);
            })), l;
        }
        return a(t.dataTypes[0]) || !s["*"] && a("*");
    }
    function Yt(e, t) {
        var i, n, s = E.ajaxSettings.flatOptions || {};
        for (i in t) void 0 !== t[i] && ((s[i] ? e : n || (n = {}))[i] = t[i]);
        return n && E.extend(!0, e, n), e;
    }
    Vt.href = Ct.href, E.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Ct.href,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(Ct.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Wt,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /\bxml\b/,
                html: /\bhtml/,
                json: /\bjson\b/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": JSON.parse,
                "text xml": E.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function(e, t) {
            return t ? Yt(Yt(e, E.ajaxSettings), t) : Yt(E.ajaxSettings, e);
        },
        ajaxPrefilter: Xt(Bt),
        ajaxTransport: Xt(Ft),
        ajax: function(t, i) {
            "object" == typeof t && (i = t, t = void 0), i = i || {};
            var n, s, r, a, o, l, c, d, u, p, f = E.ajaxSetup({}, i), h = f.context || f, m = f.context && (h.nodeType || h.jquery) ? E(h) : E.event, v = E.Deferred(), y = E.Callbacks("once memory"), b = f.statusCode || {}, w = {}, x = {}, _ = "canceled", T = {
                readyState: 0,
                getResponseHeader: function(e) {
                    var t;
                    if (c) {
                        if (!a) for (a = {}; t = Ht.exec(r); ) a[t[1].toLowerCase() + " "] = (a[t[1].toLowerCase() + " "] || []).concat(t[2]);
                        t = a[e.toLowerCase() + " "];
                    }
                    return null == t ? null : t.join(", ");
                },
                getAllResponseHeaders: function() {
                    return c ? r : null;
                },
                setRequestHeader: function(e, t) {
                    return null == c && (e = x[e.toLowerCase()] = x[e.toLowerCase()] || e, w[e] = t), 
                    this;
                },
                overrideMimeType: function(e) {
                    return null == c && (f.mimeType = e), this;
                },
                statusCode: function(e) {
                    var t;
                    if (e) if (c) T.always(e[T.status]); else for (t in e) b[t] = [ b[t], e[t] ];
                    return this;
                },
                abort: function(e) {
                    var t = e || _;
                    return n && n.abort(t), S(0, t), this;
                }
            };
            if (v.promise(T), f.url = ((t || f.url || Ct.href) + "").replace(Rt, Ct.protocol + "//"), 
            f.type = i.method || i.type || f.method || f.type, f.dataTypes = (f.dataType || "*").toLowerCase().match(W) || [ "" ], 
            null == f.crossDomain) {
                l = g.createElement("a");
                try {
                    l.href = f.url, l.href = l.href, f.crossDomain = Vt.protocol + "//" + Vt.host != l.protocol + "//" + l.host;
                } catch (e) {
                    f.crossDomain = !0;
                }
            }
            if (f.data && f.processData && "string" != typeof f.data && (f.data = E.param(f.data, f.traditional)), 
            Gt(Bt, f, i, T), c) return T;
            for (u in (d = E.event && f.global) && 0 == E.active++ && E.event.trigger("ajaxStart"), 
            f.type = f.type.toUpperCase(), f.hasContent = !qt.test(f.type), s = f.url.replace(jt, ""), 
            f.hasContent ? f.data && f.processData && 0 === (f.contentType || "").indexOf("application/x-www-form-urlencoded") && (f.data = f.data.replace(Nt, "+")) : (p = f.url.slice(s.length), 
            f.data && (f.processData || "string" == typeof f.data) && (s += (At.test(s) ? "&" : "?") + f.data, 
            delete f.data), !1 === f.cache && (s = s.replace(zt, "$1"), p = (At.test(s) ? "&" : "?") + "_=" + Mt.guid++ + p), 
            f.url = s + p), f.ifModified && (E.lastModified[s] && T.setRequestHeader("If-Modified-Since", E.lastModified[s]), 
            E.etag[s] && T.setRequestHeader("If-None-Match", E.etag[s])), (f.data && f.hasContent && !1 !== f.contentType || i.contentType) && T.setRequestHeader("Content-Type", f.contentType), 
            T.setRequestHeader("Accept", f.dataTypes[0] && f.accepts[f.dataTypes[0]] ? f.accepts[f.dataTypes[0]] + ("*" !== f.dataTypes[0] ? ", " + Wt + "; q=0.01" : "") : f.accepts["*"]), 
            f.headers) T.setRequestHeader(u, f.headers[u]);
            if (f.beforeSend && (!1 === f.beforeSend.call(h, T, f) || c)) return T.abort();
            if (_ = "abort", y.add(f.complete), T.done(f.success), T.fail(f.error), n = Gt(Ft, f, i, T)) {
                if (T.readyState = 1, d && m.trigger("ajaxSend", [ T, f ]), c) return T;
                f.async && f.timeout > 0 && (o = e.setTimeout((function() {
                    T.abort("timeout");
                }), f.timeout));
                try {
                    c = !1, n.send(w, S);
                } catch (e) {
                    if (c) throw e;
                    S(-1, e);
                }
            } else S(-1, "No Transport");
            function S(t, i, a, l) {
                var u, p, g, w, x, _ = i;
                c || (c = !0, o && e.clearTimeout(o), n = void 0, r = l || "", T.readyState = t > 0 ? 4 : 0, 
                u = t >= 200 && t < 300 || 304 === t, a && (w = function(e, t, i) {
                    for (var n, s, r, a, o = e.contents, l = e.dataTypes; "*" === l[0]; ) l.shift(), 
                    void 0 === n && (n = e.mimeType || t.getResponseHeader("Content-Type"));
                    if (n) for (s in o) if (o[s] && o[s].test(n)) {
                        l.unshift(s);
                        break;
                    }
                    if (l[0] in i) r = l[0]; else {
                        for (s in i) {
                            if (!l[0] || e.converters[s + " " + l[0]]) {
                                r = s;
                                break;
                            }
                            a || (a = s);
                        }
                        r = r || a;
                    }
                    if (r) return r !== l[0] && l.unshift(r), i[r];
                }(f, T, a)), !u && E.inArray("script", f.dataTypes) > -1 && E.inArray("json", f.dataTypes) < 0 && (f.converters["text script"] = function() {}), 
                w = function(e, t, i, n) {
                    var s, r, a, o, l, c = {}, d = e.dataTypes.slice();
                    if (d[1]) for (a in e.converters) c[a.toLowerCase()] = e.converters[a];
                    for (r = d.shift(); r; ) if (e.responseFields[r] && (i[e.responseFields[r]] = t), 
                    !l && n && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = r, r = d.shift()) if ("*" === r) r = l; else if ("*" !== l && l !== r) {
                        if (!(a = c[l + " " + r] || c["* " + r])) for (s in c) if ((o = s.split(" "))[1] === r && (a = c[l + " " + o[0]] || c["* " + o[0]])) {
                            !0 === a ? a = c[s] : !0 !== c[s] && (r = o[0], d.unshift(o[1]));
                            break;
                        }
                        if (!0 !== a) if (a && e.throws) t = a(t); else try {
                            t = a(t);
                        } catch (e) {
                            return {
                                state: "parsererror",
                                error: a ? e : "No conversion from " + l + " to " + r
                            };
                        }
                    }
                    return {
                        state: "success",
                        data: t
                    };
                }(f, w, T, u), u ? (f.ifModified && ((x = T.getResponseHeader("Last-Modified")) && (E.lastModified[s] = x), 
                (x = T.getResponseHeader("etag")) && (E.etag[s] = x)), 204 === t || "HEAD" === f.type ? _ = "nocontent" : 304 === t ? _ = "notmodified" : (_ = w.state, 
                p = w.data, u = !(g = w.error))) : (g = _, !t && _ || (_ = "error", t < 0 && (t = 0))), 
                T.status = t, T.statusText = (i || _) + "", u ? v.resolveWith(h, [ p, _, T ]) : v.rejectWith(h, [ T, _, g ]), 
                T.statusCode(b), b = void 0, d && m.trigger(u ? "ajaxSuccess" : "ajaxError", [ T, f, u ? p : g ]), 
                y.fireWith(h, [ T, _ ]), d && (m.trigger("ajaxComplete", [ T, f ]), --E.active || E.event.trigger("ajaxStop")));
            }
            return T;
        },
        getJSON: function(e, t, i) {
            return E.get(e, t, i, "json");
        },
        getScript: function(e, t) {
            return E.get(e, void 0, t, "script");
        }
    }), E.each([ "get", "post" ], (function(e, t) {
        E[t] = function(e, i, n, s) {
            return h(i) && (s = s || n, n = i, i = void 0), E.ajax(E.extend({
                url: e,
                type: t,
                dataType: s,
                data: i,
                success: n
            }, E.isPlainObject(e) && e));
        };
    })), E.ajaxPrefilter((function(e) {
        var t;
        for (t in e.headers) "content-type" === t.toLowerCase() && (e.contentType = e.headers[t] || "");
    })), E._evalUrl = function(e, t, i) {
        return E.ajax({
            url: e,
            type: "GET",
            dataType: "script",
            cache: !0,
            async: !1,
            global: !1,
            converters: {
                "text script": function() {}
            },
            dataFilter: function(e) {
                E.globalEval(e, t, i);
            }
        });
    }, E.fn.extend({
        wrapAll: function(e) {
            var t;
            return this[0] && (h(e) && (e = e.call(this[0])), t = E(e, this[0].ownerDocument).eq(0).clone(!0), 
            this[0].parentNode && t.insertBefore(this[0]), t.map((function() {
                for (var e = this; e.firstElementChild; ) e = e.firstElementChild;
                return e;
            })).append(this)), this;
        },
        wrapInner: function(e) {
            return h(e) ? this.each((function(t) {
                E(this).wrapInner(e.call(this, t));
            })) : this.each((function() {
                var t = E(this), i = t.contents();
                i.length ? i.wrapAll(e) : t.append(e);
            }));
        },
        wrap: function(e) {
            var t = h(e);
            return this.each((function(i) {
                E(this).wrapAll(t ? e.call(this, i) : e);
            }));
        },
        unwrap: function(e) {
            return this.parent(e).not("body").each((function() {
                E(this).replaceWith(this.childNodes);
            })), this;
        }
    }), E.expr.pseudos.hidden = function(e) {
        return !E.expr.pseudos.visible(e);
    }, E.expr.pseudos.visible = function(e) {
        return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length);
    }, E.ajaxSettings.xhr = function() {
        try {
            return new e.XMLHttpRequest;
        } catch (e) {}
    };
    var Ut = {
        0: 200,
        1223: 204
    }, Kt = E.ajaxSettings.xhr();
    f.cors = !!Kt && "withCredentials" in Kt, f.ajax = Kt = !!Kt, E.ajaxTransport((function(t) {
        var i, n;
        if (f.cors || Kt && !t.crossDomain) return {
            send: function(s, r) {
                var a, o = t.xhr();
                if (o.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields) for (a in t.xhrFields) o[a] = t.xhrFields[a];
                for (a in t.mimeType && o.overrideMimeType && o.overrideMimeType(t.mimeType), t.crossDomain || s["X-Requested-With"] || (s["X-Requested-With"] = "XMLHttpRequest"), 
                s) o.setRequestHeader(a, s[a]);
                i = function(e) {
                    return function() {
                        i && (i = n = o.onload = o.onerror = o.onabort = o.ontimeout = o.onreadystatechange = null, 
                        "abort" === e ? o.abort() : "error" === e ? "number" != typeof o.status ? r(0, "error") : r(o.status, o.statusText) : r(Ut[o.status] || o.status, o.statusText, "text" !== (o.responseType || "text") || "string" != typeof o.responseText ? {
                            binary: o.response
                        } : {
                            text: o.responseText
                        }, o.getAllResponseHeaders()));
                    };
                }, o.onload = i(), n = o.onerror = o.ontimeout = i("error"), void 0 !== o.onabort ? o.onabort = n : o.onreadystatechange = function() {
                    4 === o.readyState && e.setTimeout((function() {
                        i && n();
                    }));
                }, i = i("abort");
                try {
                    o.send(t.hasContent && t.data || null);
                } catch (e) {
                    if (i) throw e;
                }
            },
            abort: function() {
                i && i();
            }
        };
    })), E.ajaxPrefilter((function(e) {
        e.crossDomain && (e.contents.script = !1);
    })), E.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /\b(?:java|ecma)script\b/
        },
        converters: {
            "text script": function(e) {
                return E.globalEval(e), e;
            }
        }
    }), E.ajaxPrefilter("script", (function(e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET");
    })), E.ajaxTransport("script", (function(e) {
        var t, i;
        if (e.crossDomain || e.scriptAttrs) return {
            send: function(n, s) {
                t = E("<script>").attr(e.scriptAttrs || {}).prop({
                    charset: e.scriptCharset,
                    src: e.url
                }).on("load error", i = function(e) {
                    t.remove(), i = null, e && s("error" === e.type ? 404 : 200, e.type);
                }), g.head.appendChild(t[0]);
            },
            abort: function() {
                i && i();
            }
        };
    }));
    var Qt, Jt = [], Zt = /(=)\?(?=&|$)|\?\?/;
    E.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var e = Jt.pop() || E.expando + "_" + Mt.guid++;
            return this[e] = !0, e;
        }
    }), E.ajaxPrefilter("json jsonp", (function(t, i, n) {
        var s, r, a, o = !1 !== t.jsonp && (Zt.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && Zt.test(t.data) && "data");
        if (o || "jsonp" === t.dataTypes[0]) return s = t.jsonpCallback = h(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, 
        o ? t[o] = t[o].replace(Zt, "$1" + s) : !1 !== t.jsonp && (t.url += (At.test(t.url) ? "&" : "?") + t.jsonp + "=" + s), 
        t.converters["script json"] = function() {
            return a || E.error(s + " was not called"), a[0];
        }, t.dataTypes[0] = "json", r = e[s], e[s] = function() {
            a = arguments;
        }, n.always((function() {
            void 0 === r ? E(e).removeProp(s) : e[s] = r, t[s] && (t.jsonpCallback = i.jsonpCallback, 
            Jt.push(s)), a && h(r) && r(a[0]), a = r = void 0;
        })), "script";
    })), f.createHTMLDocument = ((Qt = g.implementation.createHTMLDocument("").body).innerHTML = "<form></form><form></form>", 
    2 === Qt.childNodes.length), E.parseHTML = function(e, t, i) {
        return "string" != typeof e ? [] : ("boolean" == typeof t && (i = t, t = !1), t || (f.createHTMLDocument ? ((n = (t = g.implementation.createHTMLDocument("")).createElement("base")).href = g.location.href, 
        t.head.appendChild(n)) : t = g), r = !i && [], (s = j.exec(e)) ? [ t.createElement(s[1]) ] : (s = ke([ e ], t, r), 
        r && r.length && E(r).remove(), E.merge([], s.childNodes)));
        var n, s, r;
    }, E.fn.load = function(e, t, i) {
        var n, s, r, a = this, o = e.indexOf(" ");
        return o > -1 && (n = Et(e.slice(o)), e = e.slice(0, o)), h(t) ? (i = t, t = void 0) : t && "object" == typeof t && (s = "POST"), 
        a.length > 0 && E.ajax({
            url: e,
            type: s || "GET",
            dataType: "html",
            data: t
        }).done((function(e) {
            r = arguments, a.html(n ? E("<div>").append(E.parseHTML(e)).find(n) : e);
        })).always(i && function(e, t) {
            a.each((function() {
                i.apply(this, r || [ e.responseText, t, e ]);
            }));
        }), this;
    }, E.expr.pseudos.animated = function(e) {
        return E.grep(E.timers, (function(t) {
            return e === t.elem;
        })).length;
    }, E.offset = {
        setOffset: function(e, t, i) {
            var n, s, r, a, o, l, c = E.css(e, "position"), d = E(e), u = {};
            "static" === c && (e.style.position = "relative"), o = d.offset(), r = E.css(e, "top"), 
            l = E.css(e, "left"), ("absolute" === c || "fixed" === c) && (r + l).indexOf("auto") > -1 ? (a = (n = d.position()).top, 
            s = n.left) : (a = parseFloat(r) || 0, s = parseFloat(l) || 0), h(t) && (t = t.call(e, i, E.extend({}, o))), 
            null != t.top && (u.top = t.top - o.top + a), null != t.left && (u.left = t.left - o.left + s), 
            "using" in t ? t.using.call(e, u) : d.css(u);
        }
    }, E.fn.extend({
        offset: function(e) {
            if (arguments.length) return void 0 === e ? this : this.each((function(t) {
                E.offset.setOffset(this, e, t);
            }));
            var t, i, n = this[0];
            return n ? n.getClientRects().length ? (t = n.getBoundingClientRect(), i = n.ownerDocument.defaultView, 
            {
                top: t.top + i.pageYOffset,
                left: t.left + i.pageXOffset
            }) : {
                top: 0,
                left: 0
            } : void 0;
        },
        position: function() {
            if (this[0]) {
                var e, t, i, n = this[0], s = {
                    top: 0,
                    left: 0
                };
                if ("fixed" === E.css(n, "position")) t = n.getBoundingClientRect(); else {
                    for (t = this.offset(), i = n.ownerDocument, e = n.offsetParent || i.documentElement; e && (e === i.body || e === i.documentElement) && "static" === E.css(e, "position"); ) e = e.parentNode;
                    e && e !== n && 1 === e.nodeType && ((s = E(e).offset()).top += E.css(e, "borderTopWidth", !0), 
                    s.left += E.css(e, "borderLeftWidth", !0));
                }
                return {
                    top: t.top - s.top - E.css(n, "marginTop", !0),
                    left: t.left - s.left - E.css(n, "marginLeft", !0)
                };
            }
        },
        offsetParent: function() {
            return this.map((function() {
                for (var e = this.offsetParent; e && "static" === E.css(e, "position"); ) e = e.offsetParent;
                return e || pe;
            }));
        }
    }), E.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, (function(e, t) {
        var i = "pageYOffset" === t;
        E.fn[e] = function(n) {
            return Q(this, (function(e, n, s) {
                var r;
                if (m(e) ? r = e : 9 === e.nodeType && (r = e.defaultView), void 0 === s) return r ? r[t] : e[n];
                r ? r.scrollTo(i ? r.pageXOffset : s, i ? s : r.pageYOffset) : e[n] = s;
            }), e, n, arguments.length);
        };
    })), E.each([ "top", "left" ], (function(e, t) {
        E.cssHooks[t] = Qe(f.pixelPosition, (function(e, i) {
            if (i) return i = Ke(e, t), Ve.test(i) ? E(e).position()[t] + "px" : i;
        }));
    })), E.each({
        Height: "height",
        Width: "width"
    }, (function(e, t) {
        E.each({
            padding: "inner" + e,
            content: t,
            "": "outer" + e
        }, (function(i, n) {
            E.fn[n] = function(s, r) {
                var a = arguments.length && (i || "boolean" != typeof s), o = i || (!0 === s || !0 === r ? "margin" : "border");
                return Q(this, (function(t, i, s) {
                    var r;
                    return m(t) ? 0 === n.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (r = t.documentElement, 
                    Math.max(t.body["scroll" + e], r["scroll" + e], t.body["offset" + e], r["offset" + e], r["client" + e])) : void 0 === s ? E.css(t, i, o) : E.style(t, i, s, o);
                }), t, a ? s : void 0, a);
            };
        }));
    })), E.each([ "ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend" ], (function(e, t) {
        E.fn[t] = function(e) {
            return this.on(t, e);
        };
    })), E.fn.extend({
        bind: function(e, t, i) {
            return this.on(e, null, t, i);
        },
        unbind: function(e, t) {
            return this.off(e, null, t);
        },
        delegate: function(e, t, i, n) {
            return this.on(t, e, i, n);
        },
        undelegate: function(e, t, i) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", i);
        },
        hover: function(e, t) {
            return this.on("mouseenter", e).on("mouseleave", t || e);
        }
    }), E.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), (function(e, t) {
        E.fn[t] = function(e, i) {
            return arguments.length > 0 ? this.on(t, null, e, i) : this.trigger(t);
        };
    }));
    var ei = /^[\s\uFEFF\xA0]+|([^\s\uFEFF\xA0])[\s\uFEFF\xA0]+$/g;
    E.proxy = function(e, t) {
        var i, n, r;
        if ("string" == typeof t && (i = e[t], t = e, e = i), h(e)) return n = s.call(arguments, 2), 
        r = function() {
            return e.apply(t || this, n.concat(s.call(arguments)));
        }, r.guid = e.guid = e.guid || E.guid++, r;
    }, E.holdReady = function(e) {
        e ? E.readyWait++ : E.ready(!0);
    }, E.isArray = Array.isArray, E.parseJSON = JSON.parse, E.nodeName = T, E.isFunction = h, 
    E.isWindow = m, E.camelCase = te, E.type = b, E.now = Date.now, E.isNumeric = function(e) {
        var t = E.type(e);
        return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e));
    }, E.trim = function(e) {
        return null == e ? "" : (e + "").replace(ei, "$1");
    }, "function" == typeof define && define.amd && define("jquery", [], (function() {
        return E;
    }));
    var ti = e.jQuery, ii = e.$;
    return E.noConflict = function(t) {
        return e.$ === E && (e.$ = ii), t && e.jQuery === E && (e.jQuery = ti), E;
    }, void 0 === t && (e.jQuery = e.$ = E), E;
})), 
/*!
  * Bootstrap v5.3.2 (https://getbootstrap.com/)
  * Copyright 2011-2023 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
  */
function(e, t) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : (e = "undefined" != typeof globalThis ? globalThis : e || self).bootstrap = t();
}(this, (function() {
    "use strict";
    const e = new Map, t = {
        set(t, i, n) {
            e.has(t) || e.set(t, new Map);
            const s = e.get(t);
            s.has(i) || 0 === s.size ? s.set(i, n) : console.error(`Bootstrap doesn't allow more than one instance per element. Bound instance: ${Array.from(s.keys())[0]}.`);
        },
        get: (t, i) => e.has(t) && e.get(t).get(i) || null,
        remove(t, i) {
            if (!e.has(t)) return;
            const n = e.get(t);
            n.delete(i), 0 === n.size && e.delete(t);
        }
    }, i = "transitionend", n = e => (e && window.CSS && window.CSS.escape && (e = e.replace(/#([^\s"#']+)/g, ((e, t) => `#${CSS.escape(t)}`))), 
    e), s = e => {
        e.dispatchEvent(new Event(i));
    }, r = e => !(!e || "object" != typeof e) && (void 0 !== e.jquery && (e = e[0]), 
    void 0 !== e.nodeType), a = e => r(e) ? e.jquery ? e[0] : e : "string" == typeof e && e.length > 0 ? document.querySelector(n(e)) : null, o = e => {
        if (!r(e) || 0 === e.getClientRects().length) return !1;
        const t = "visible" === getComputedStyle(e).getPropertyValue("visibility"), i = e.closest("details:not([open])");
        if (!i) return t;
        if (i !== e) {
            const t = e.closest("summary");
            if (t && t.parentNode !== i) return !1;
            if (null === t) return !1;
        }
        return t;
    }, l = e => !e || e.nodeType !== Node.ELEMENT_NODE || (!!e.classList.contains("disabled") || (void 0 !== e.disabled ? e.disabled : e.hasAttribute("disabled") && "false" !== e.getAttribute("disabled"))), c = e => {
        if (!document.documentElement.attachShadow) return null;
        if ("function" == typeof e.getRootNode) {
            const t = e.getRootNode();
            return t instanceof ShadowRoot ? t : null;
        }
        return e instanceof ShadowRoot ? e : e.parentNode ? c(e.parentNode) : null;
    }, d = () => {}, u = e => {
        e.offsetHeight;
    }, p = () => window.jQuery && !document.body.hasAttribute("data-bs-no-jquery") ? window.jQuery : null, f = [], h = () => "rtl" === document.documentElement.dir, m = e => {
        var t;
        t = () => {
            const t = p();
            if (t) {
                const i = e.NAME, n = t.fn[i];
                t.fn[i] = e.jQueryInterface, t.fn[i].Constructor = e, t.fn[i].noConflict = () => (t.fn[i] = n, 
                e.jQueryInterface);
            }
        }, "loading" === document.readyState ? (f.length || document.addEventListener("DOMContentLoaded", (() => {
            for (const e of f) e();
        })), f.push(t)) : t();
    }, g = (e, t = [], i = e) => "function" == typeof e ? e(...t) : i, v = (e, t, n = !0) => {
        if (!n) return void g(e);
        const r = (e => {
            if (!e) return 0;
            let {transitionDuration: t, transitionDelay: i} = window.getComputedStyle(e);
            const n = Number.parseFloat(t), s = Number.parseFloat(i);
            return n || s ? (t = t.split(",")[0], i = i.split(",")[0], 1e3 * (Number.parseFloat(t) + Number.parseFloat(i))) : 0;
        })(t) + 5;
        let a = !1;
        const o = ({target: n}) => {
            n === t && (a = !0, t.removeEventListener(i, o), g(e));
        };
        t.addEventListener(i, o), setTimeout((() => {
            a || s(t);
        }), r);
    }, y = (e, t, i, n) => {
        const s = e.length;
        let r = e.indexOf(t);
        return -1 === r ? !i && n ? e[s - 1] : e[0] : (r += i ? 1 : -1, n && (r = (r + s) % s), 
        e[Math.max(0, Math.min(r, s - 1))]);
    }, b = /[^.]*(?=\..*)\.|.*/, w = /\..*/, x = /::\d+$/, E = {};
    let _ = 1;
    const T = {
        mouseenter: "mouseover",
        mouseleave: "mouseout"
    }, S = new Set([ "click", "dblclick", "mouseup", "mousedown", "contextmenu", "mousewheel", "DOMMouseScroll", "mouseover", "mouseout", "mousemove", "selectstart", "selectend", "keydown", "keypress", "keyup", "orientationchange", "touchstart", "touchmove", "touchend", "touchcancel", "pointerdown", "pointermove", "pointerup", "pointerleave", "pointercancel", "gesturestart", "gesturechange", "gestureend", "focus", "blur", "change", "reset", "select", "submit", "focusin", "focusout", "load", "unload", "beforeunload", "resize", "move", "DOMContentLoaded", "readystatechange", "error", "abort", "scroll" ]);
    function C(e, t) {
        return t && `${t}::${_++}` || e.uidEvent || _++;
    }
    function M(e) {
        const t = C(e);
        return e.uidEvent = t, E[t] = E[t] || {}, E[t];
    }
    function A(e, t, i = null) {
        return Object.values(e).find((e => e.callable === t && e.delegationSelector === i));
    }
    function k(e, t, i) {
        const n = "string" == typeof t, s = n ? i : t || i;
        let r = D(e);
        return S.has(r) || (r = e), [ n, s, r ];
    }
    function L(e, t, i, n, s) {
        if ("string" != typeof t || !e) return;
        let [r, a, o] = k(t, i, n);
        if (t in T) {
            const e = e => function(t) {
                if (!t.relatedTarget || t.relatedTarget !== t.delegateTarget && !t.delegateTarget.contains(t.relatedTarget)) return e.call(this, t);
            };
            a = e(a);
        }
        const l = M(e), c = l[o] || (l[o] = {}), d = A(c, a, r ? i : null);
        if (d) return void (d.oneOff = d.oneOff && s);
        const u = C(a, t.replace(b, "")), p = r ? function(e, t, i) {
            return function n(s) {
                const r = e.querySelectorAll(t);
                for (let {target: a} = s; a && a !== this; a = a.parentNode) for (const o of r) if (o === a) return $(s, {
                    delegateTarget: a
                }), n.oneOff && I.off(e, s.type, t, i), i.apply(a, [ s ]);
            };
        }(e, i, a) : function(e, t) {
            return function i(n) {
                return $(n, {
                    delegateTarget: e
                }), i.oneOff && I.off(e, n.type, t), t.apply(e, [ n ]);
            };
        }(e, a);
        p.delegationSelector = r ? i : null, p.callable = a, p.oneOff = s, p.uidEvent = u, 
        c[u] = p, e.addEventListener(o, p, r);
    }
    function P(e, t, i, n, s) {
        const r = A(t[i], n, s);
        r && (e.removeEventListener(i, r, Boolean(s)), delete t[i][r.uidEvent]);
    }
    function O(e, t, i, n) {
        const s = t[i] || {};
        for (const [r, a] of Object.entries(s)) r.includes(n) && P(e, t, i, a.callable, a.delegationSelector);
    }
    function D(e) {
        return e = e.replace(w, ""), T[e] || e;
    }
    const I = {
        on(e, t, i, n) {
            L(e, t, i, n, !1);
        },
        one(e, t, i, n) {
            L(e, t, i, n, !0);
        },
        off(e, t, i, n) {
            if ("string" != typeof t || !e) return;
            const [s, r, a] = k(t, i, n), o = a !== t, l = M(e), c = l[a] || {}, d = t.startsWith(".");
            if (void 0 === r) {
                if (d) for (const i of Object.keys(l)) O(e, l, i, t.slice(1));
                for (const [i, n] of Object.entries(c)) {
                    const s = i.replace(x, "");
                    o && !t.includes(s) || P(e, l, a, n.callable, n.delegationSelector);
                }
            } else {
                if (!Object.keys(c).length) return;
                P(e, l, a, r, s ? i : null);
            }
        },
        trigger(e, t, i) {
            if ("string" != typeof t || !e) return null;
            const n = p();
            let s = null, r = !0, a = !0, o = !1;
            t !== D(t) && n && (s = n.Event(t, i), n(e).trigger(s), r = !s.isPropagationStopped(), 
            a = !s.isImmediatePropagationStopped(), o = s.isDefaultPrevented());
            const l = $(new Event(t, {
                bubbles: r,
                cancelable: !0
            }), i);
            return o && l.preventDefault(), a && e.dispatchEvent(l), l.defaultPrevented && s && s.preventDefault(), 
            l;
        }
    };
    function $(e, t = {}) {
        for (const [i, n] of Object.entries(t)) try {
            e[i] = n;
        } catch (t) {
            Object.defineProperty(e, i, {
                configurable: !0,
                get: () => n
            });
        }
        return e;
    }
    function N(e) {
        if ("true" === e) return !0;
        if ("false" === e) return !1;
        if (e === Number(e).toString()) return Number(e);
        if ("" === e || "null" === e) return null;
        if ("string" != typeof e) return e;
        try {
            return JSON.parse(decodeURIComponent(e));
        } catch (t) {
            return e;
        }
    }
    function j(e) {
        return e.replace(/[A-Z]/g, (e => `-${e.toLowerCase()}`));
    }
    const z = {
        setDataAttribute(e, t, i) {
            e.setAttribute(`data-bs-${j(t)}`, i);
        },
        removeDataAttribute(e, t) {
            e.removeAttribute(`data-bs-${j(t)}`);
        },
        getDataAttributes(e) {
            if (!e) return {};
            const t = {}, i = Object.keys(e.dataset).filter((e => e.startsWith("bs") && !e.startsWith("bsConfig")));
            for (const n of i) {
                let i = n.replace(/^bs/, "");
                i = i.charAt(0).toLowerCase() + i.slice(1, i.length), t[i] = N(e.dataset[n]);
            }
            return t;
        },
        getDataAttribute: (e, t) => N(e.getAttribute(`data-bs-${j(t)}`))
    };
    class H {
        static get Default() {
            return {};
        }
        static get DefaultType() {
            return {};
        }
        static get NAME() {
            throw new Error('You have to implement the static method "NAME", for each component!');
        }
        _getConfig(e) {
            return e = this._mergeConfigObj(e), e = this._configAfterMerge(e), this._typeCheckConfig(e), 
            e;
        }
        _configAfterMerge(e) {
            return e;
        }
        _mergeConfigObj(e, t) {
            const i = r(t) ? z.getDataAttribute(t, "config") : {};
            return {
                ...this.constructor.Default,
                ..."object" == typeof i ? i : {},
                ...r(t) ? z.getDataAttributes(t) : {},
                ..."object" == typeof e ? e : {}
            };
        }
        _typeCheckConfig(e, t = this.constructor.DefaultType) {
            for (const [n, s] of Object.entries(t)) {
                const t = e[n], a = r(t) ? "element" : null == (i = t) ? `${i}` : Object.prototype.toString.call(i).match(/\s([a-z]+)/i)[1].toLowerCase();
                if (!new RegExp(s).test(a)) throw new TypeError(`${this.constructor.NAME.toUpperCase()}: Option "${n}" provided type "${a}" but expected type "${s}".`);
            }
            var i;
        }
    }
    class q extends H {
        constructor(e, i) {
            super(), (e = a(e)) && (this._element = e, this._config = this._getConfig(i), t.set(this._element, this.constructor.DATA_KEY, this));
        }
        dispose() {
            t.remove(this._element, this.constructor.DATA_KEY), I.off(this._element, this.constructor.EVENT_KEY);
            for (const e of Object.getOwnPropertyNames(this)) this[e] = null;
        }
        _queueCallback(e, t, i = !0) {
            v(e, t, i);
        }
        _getConfig(e) {
            return e = this._mergeConfigObj(e, this._element), e = this._configAfterMerge(e), 
            this._typeCheckConfig(e), e;
        }
        static getInstance(e) {
            return t.get(a(e), this.DATA_KEY);
        }
        static getOrCreateInstance(e, t = {}) {
            return this.getInstance(e) || new this(e, "object" == typeof t ? t : null);
        }
        static get VERSION() {
            return "5.3.2";
        }
        static get DATA_KEY() {
            return `bs.${this.NAME}`;
        }
        static get EVENT_KEY() {
            return `.${this.DATA_KEY}`;
        }
        static eventName(e) {
            return `${e}${this.EVENT_KEY}`;
        }
    }
    const R = e => {
        let t = e.getAttribute("data-bs-target");
        if (!t || "#" === t) {
            let i = e.getAttribute("href");
            if (!i || !i.includes("#") && !i.startsWith(".")) return null;
            i.includes("#") && !i.startsWith("#") && (i = `#${i.split("#")[1]}`), t = i && "#" !== i ? n(i.trim()) : null;
        }
        return t;
    }, B = {
        find: (e, t = document.documentElement) => [].concat(...Element.prototype.querySelectorAll.call(t, e)),
        findOne: (e, t = document.documentElement) => Element.prototype.querySelector.call(t, e),
        children: (e, t) => [].concat(...e.children).filter((e => e.matches(t))),
        parents(e, t) {
            const i = [];
            let n = e.parentNode.closest(t);
            for (;n; ) i.push(n), n = n.parentNode.closest(t);
            return i;
        },
        prev(e, t) {
            let i = e.previousElementSibling;
            for (;i; ) {
                if (i.matches(t)) return [ i ];
                i = i.previousElementSibling;
            }
            return [];
        },
        next(e, t) {
            let i = e.nextElementSibling;
            for (;i; ) {
                if (i.matches(t)) return [ i ];
                i = i.nextElementSibling;
            }
            return [];
        },
        focusableChildren(e) {
            const t = [ "a", "button", "input", "textarea", "select", "details", "[tabindex]", '[contenteditable="true"]' ].map((e => `${e}:not([tabindex^="-"])`)).join(",");
            return this.find(t, e).filter((e => !l(e) && o(e)));
        },
        getSelectorFromElement(e) {
            const t = R(e);
            return t && B.findOne(t) ? t : null;
        },
        getElementFromSelector(e) {
            const t = R(e);
            return t ? B.findOne(t) : null;
        },
        getMultipleElementsFromSelector(e) {
            const t = R(e);
            return t ? B.find(t) : [];
        }
    }, F = (e, t = "hide") => {
        const i = `click.dismiss${e.EVENT_KEY}`, n = e.NAME;
        I.on(document, i, `[data-bs-dismiss="${n}"]`, (function(i) {
            if ([ "A", "AREA" ].includes(this.tagName) && i.preventDefault(), l(this)) return;
            const s = B.getElementFromSelector(this) || this.closest(`.${n}`);
            e.getOrCreateInstance(s)[t]();
        }));
    }, W = ".bs.alert", V = `close${W}`, X = `closed${W}`;
    class G extends q {
        static get NAME() {
            return "alert";
        }
        close() {
            if (I.trigger(this._element, V).defaultPrevented) return;
            this._element.classList.remove("show");
            const e = this._element.classList.contains("fade");
            this._queueCallback((() => this._destroyElement()), this._element, e);
        }
        _destroyElement() {
            this._element.remove(), I.trigger(this._element, X), this.dispose();
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = G.getOrCreateInstance(this);
                if ("string" == typeof e) {
                    if (void 0 === t[e] || e.startsWith("_") || "constructor" === e) throw new TypeError(`No method named "${e}"`);
                    t[e](this);
                }
            }));
        }
    }
    F(G, "close"), m(G);
    const Y = '[data-bs-toggle="button"]';
    class U extends q {
        static get NAME() {
            return "button";
        }
        toggle() {
            this._element.setAttribute("aria-pressed", this._element.classList.toggle("active"));
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = U.getOrCreateInstance(this);
                "toggle" === e && t[e]();
            }));
        }
    }
    I.on(document, "click.bs.button.data-api", Y, (e => {
        e.preventDefault();
        const t = e.target.closest(Y);
        U.getOrCreateInstance(t).toggle();
    })), m(U);
    const K = ".bs.swipe", Q = `touchstart${K}`, J = `touchmove${K}`, Z = `touchend${K}`, ee = `pointerdown${K}`, te = `pointerup${K}`, ie = {
        endCallback: null,
        leftCallback: null,
        rightCallback: null
    }, ne = {
        endCallback: "(function|null)",
        leftCallback: "(function|null)",
        rightCallback: "(function|null)"
    };
    class se extends H {
        constructor(e, t) {
            super(), this._element = e, e && se.isSupported() && (this._config = this._getConfig(t), 
            this._deltaX = 0, this._supportPointerEvents = Boolean(window.PointerEvent), this._initEvents());
        }
        static get Default() {
            return ie;
        }
        static get DefaultType() {
            return ne;
        }
        static get NAME() {
            return "swipe";
        }
        dispose() {
            I.off(this._element, K);
        }
        _start(e) {
            this._supportPointerEvents ? this._eventIsPointerPenTouch(e) && (this._deltaX = e.clientX) : this._deltaX = e.touches[0].clientX;
        }
        _end(e) {
            this._eventIsPointerPenTouch(e) && (this._deltaX = e.clientX - this._deltaX), this._handleSwipe(), 
            g(this._config.endCallback);
        }
        _move(e) {
            this._deltaX = e.touches && e.touches.length > 1 ? 0 : e.touches[0].clientX - this._deltaX;
        }
        _handleSwipe() {
            const e = Math.abs(this._deltaX);
            if (e <= 40) return;
            const t = e / this._deltaX;
            this._deltaX = 0, t && g(t > 0 ? this._config.rightCallback : this._config.leftCallback);
        }
        _initEvents() {
            this._supportPointerEvents ? (I.on(this._element, ee, (e => this._start(e))), I.on(this._element, te, (e => this._end(e))), 
            this._element.classList.add("pointer-event")) : (I.on(this._element, Q, (e => this._start(e))), 
            I.on(this._element, J, (e => this._move(e))), I.on(this._element, Z, (e => this._end(e))));
        }
        _eventIsPointerPenTouch(e) {
            return this._supportPointerEvents && ("pen" === e.pointerType || "touch" === e.pointerType);
        }
        static isSupported() {
            return "ontouchstart" in document.documentElement || navigator.maxTouchPoints > 0;
        }
    }
    const re = ".bs.carousel", ae = ".data-api", oe = "next", le = "prev", ce = "left", de = "right", ue = `slide${re}`, pe = `slid${re}`, fe = `keydown${re}`, he = `mouseenter${re}`, me = `mouseleave${re}`, ge = `dragstart${re}`, ve = `load${re}${ae}`, ye = `click${re}${ae}`, be = "carousel", we = "active", xe = ".active", Ee = ".carousel-item", _e = xe + Ee, Te = {
        ArrowLeft: de,
        ArrowRight: ce
    }, Se = {
        interval: 5e3,
        keyboard: !0,
        pause: "hover",
        ride: !1,
        touch: !0,
        wrap: !0
    }, Ce = {
        interval: "(number|boolean)",
        keyboard: "boolean",
        pause: "(string|boolean)",
        ride: "(boolean|string)",
        touch: "boolean",
        wrap: "boolean"
    };
    class Me extends q {
        constructor(e, t) {
            super(e, t), this._interval = null, this._activeElement = null, this._isSliding = !1, 
            this.touchTimeout = null, this._swipeHelper = null, this._indicatorsElement = B.findOne(".carousel-indicators", this._element), 
            this._addEventListeners(), this._config.ride === be && this.cycle();
        }
        static get Default() {
            return Se;
        }
        static get DefaultType() {
            return Ce;
        }
        static get NAME() {
            return "carousel";
        }
        next() {
            this._slide(oe);
        }
        nextWhenVisible() {
            !document.hidden && o(this._element) && this.next();
        }
        prev() {
            this._slide(le);
        }
        pause() {
            this._isSliding && s(this._element), this._clearInterval();
        }
        cycle() {
            this._clearInterval(), this._updateInterval(), this._interval = setInterval((() => this.nextWhenVisible()), this._config.interval);
        }
        _maybeEnableCycle() {
            this._config.ride && (this._isSliding ? I.one(this._element, pe, (() => this.cycle())) : this.cycle());
        }
        to(e) {
            const t = this._getItems();
            if (e > t.length - 1 || e < 0) return;
            if (this._isSliding) return void I.one(this._element, pe, (() => this.to(e)));
            const i = this._getItemIndex(this._getActive());
            if (i === e) return;
            const n = e > i ? oe : le;
            this._slide(n, t[e]);
        }
        dispose() {
            this._swipeHelper && this._swipeHelper.dispose(), super.dispose();
        }
        _configAfterMerge(e) {
            return e.defaultInterval = e.interval, e;
        }
        _addEventListeners() {
            this._config.keyboard && I.on(this._element, fe, (e => this._keydown(e))), "hover" === this._config.pause && (I.on(this._element, he, (() => this.pause())), 
            I.on(this._element, me, (() => this._maybeEnableCycle()))), this._config.touch && se.isSupported() && this._addTouchEventListeners();
        }
        _addTouchEventListeners() {
            for (const e of B.find(".carousel-item img", this._element)) I.on(e, ge, (e => e.preventDefault()));
            const e = {
                leftCallback: () => this._slide(this._directionToOrder(ce)),
                rightCallback: () => this._slide(this._directionToOrder(de)),
                endCallback: () => {
                    "hover" === this._config.pause && (this.pause(), this.touchTimeout && clearTimeout(this.touchTimeout), 
                    this.touchTimeout = setTimeout((() => this._maybeEnableCycle()), 500 + this._config.interval));
                }
            };
            this._swipeHelper = new se(this._element, e);
        }
        _keydown(e) {
            if (/input|textarea/i.test(e.target.tagName)) return;
            const t = Te[e.key];
            t && (e.preventDefault(), this._slide(this._directionToOrder(t)));
        }
        _getItemIndex(e) {
            return this._getItems().indexOf(e);
        }
        _setActiveIndicatorElement(e) {
            if (!this._indicatorsElement) return;
            const t = B.findOne(xe, this._indicatorsElement);
            t.classList.remove(we), t.removeAttribute("aria-current");
            const i = B.findOne(`[data-bs-slide-to="${e}"]`, this._indicatorsElement);
            i && (i.classList.add(we), i.setAttribute("aria-current", "true"));
        }
        _updateInterval() {
            const e = this._activeElement || this._getActive();
            if (!e) return;
            const t = Number.parseInt(e.getAttribute("data-bs-interval"), 10);
            this._config.interval = t || this._config.defaultInterval;
        }
        _slide(e, t = null) {
            if (this._isSliding) return;
            const i = this._getActive(), n = e === oe, s = t || y(this._getItems(), i, n, this._config.wrap);
            if (s === i) return;
            const r = this._getItemIndex(s), a = t => I.trigger(this._element, t, {
                relatedTarget: s,
                direction: this._orderToDirection(e),
                from: this._getItemIndex(i),
                to: r
            });
            if (a(ue).defaultPrevented) return;
            if (!i || !s) return;
            const o = Boolean(this._interval);
            this.pause(), this._isSliding = !0, this._setActiveIndicatorElement(r), this._activeElement = s;
            const l = n ? "carousel-item-start" : "carousel-item-end", c = n ? "carousel-item-next" : "carousel-item-prev";
            s.classList.add(c), u(s), i.classList.add(l), s.classList.add(l);
            this._queueCallback((() => {
                s.classList.remove(l, c), s.classList.add(we), i.classList.remove(we, c, l), this._isSliding = !1, 
                a(pe);
            }), i, this._isAnimated()), o && this.cycle();
        }
        _isAnimated() {
            return this._element.classList.contains("slide");
        }
        _getActive() {
            return B.findOne(_e, this._element);
        }
        _getItems() {
            return B.find(Ee, this._element);
        }
        _clearInterval() {
            this._interval && (clearInterval(this._interval), this._interval = null);
        }
        _directionToOrder(e) {
            return h() ? e === ce ? le : oe : e === ce ? oe : le;
        }
        _orderToDirection(e) {
            return h() ? e === le ? ce : de : e === le ? de : ce;
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = Me.getOrCreateInstance(this, e);
                if ("number" != typeof e) {
                    if ("string" == typeof e) {
                        if (void 0 === t[e] || e.startsWith("_") || "constructor" === e) throw new TypeError(`No method named "${e}"`);
                        t[e]();
                    }
                } else t.to(e);
            }));
        }
    }
    I.on(document, ye, "[data-bs-slide], [data-bs-slide-to]", (function(e) {
        const t = B.getElementFromSelector(this);
        if (!t || !t.classList.contains(be)) return;
        e.preventDefault();
        const i = Me.getOrCreateInstance(t), n = this.getAttribute("data-bs-slide-to");
        return n ? (i.to(n), void i._maybeEnableCycle()) : "next" === z.getDataAttribute(this, "slide") ? (i.next(), 
        void i._maybeEnableCycle()) : (i.prev(), void i._maybeEnableCycle());
    })), I.on(window, ve, (() => {
        const e = B.find('[data-bs-ride="carousel"]');
        for (const t of e) Me.getOrCreateInstance(t);
    })), m(Me);
    const Ae = ".bs.collapse", ke = `show${Ae}`, Le = `shown${Ae}`, Pe = `hide${Ae}`, Oe = `hidden${Ae}`, De = `click${Ae}.data-api`, Ie = "show", $e = "collapse", Ne = "collapsing", je = `:scope .${$e} .${$e}`, ze = '[data-bs-toggle="collapse"]', He = {
        parent: null,
        toggle: !0
    }, qe = {
        parent: "(null|element)",
        toggle: "boolean"
    };
    class Re extends q {
        constructor(e, t) {
            super(e, t), this._isTransitioning = !1, this._triggerArray = [];
            const i = B.find(ze);
            for (const e of i) {
                const t = B.getSelectorFromElement(e), i = B.find(t).filter((e => e === this._element));
                null !== t && i.length && this._triggerArray.push(e);
            }
            this._initializeChildren(), this._config.parent || this._addAriaAndCollapsedClass(this._triggerArray, this._isShown()), 
            this._config.toggle && this.toggle();
        }
        static get Default() {
            return He;
        }
        static get DefaultType() {
            return qe;
        }
        static get NAME() {
            return "collapse";
        }
        toggle() {
            this._isShown() ? this.hide() : this.show();
        }
        show() {
            if (this._isTransitioning || this._isShown()) return;
            let e = [];
            if (this._config.parent && (e = this._getFirstLevelChildren(".collapse.show, .collapse.collapsing").filter((e => e !== this._element)).map((e => Re.getOrCreateInstance(e, {
                toggle: !1
            })))), e.length && e[0]._isTransitioning) return;
            if (I.trigger(this._element, ke).defaultPrevented) return;
            for (const t of e) t.hide();
            const t = this._getDimension();
            this._element.classList.remove($e), this._element.classList.add(Ne), this._element.style[t] = 0, 
            this._addAriaAndCollapsedClass(this._triggerArray, !0), this._isTransitioning = !0;
            const i = `scroll${t[0].toUpperCase() + t.slice(1)}`;
            this._queueCallback((() => {
                this._isTransitioning = !1, this._element.classList.remove(Ne), this._element.classList.add($e, Ie), 
                this._element.style[t] = "", I.trigger(this._element, Le);
            }), this._element, !0), this._element.style[t] = `${this._element[i]}px`;
        }
        hide() {
            if (this._isTransitioning || !this._isShown()) return;
            if (I.trigger(this._element, Pe).defaultPrevented) return;
            const e = this._getDimension();
            this._element.style[e] = `${this._element.getBoundingClientRect()[e]}px`, u(this._element), 
            this._element.classList.add(Ne), this._element.classList.remove($e, Ie);
            for (const e of this._triggerArray) {
                const t = B.getElementFromSelector(e);
                t && !this._isShown(t) && this._addAriaAndCollapsedClass([ e ], !1);
            }
            this._isTransitioning = !0;
            this._element.style[e] = "", this._queueCallback((() => {
                this._isTransitioning = !1, this._element.classList.remove(Ne), this._element.classList.add($e), 
                I.trigger(this._element, Oe);
            }), this._element, !0);
        }
        _isShown(e = this._element) {
            return e.classList.contains(Ie);
        }
        _configAfterMerge(e) {
            return e.toggle = Boolean(e.toggle), e.parent = a(e.parent), e;
        }
        _getDimension() {
            return this._element.classList.contains("collapse-horizontal") ? "width" : "height";
        }
        _initializeChildren() {
            if (!this._config.parent) return;
            const e = this._getFirstLevelChildren(ze);
            for (const t of e) {
                const e = B.getElementFromSelector(t);
                e && this._addAriaAndCollapsedClass([ t ], this._isShown(e));
            }
        }
        _getFirstLevelChildren(e) {
            const t = B.find(je, this._config.parent);
            return B.find(e, this._config.parent).filter((e => !t.includes(e)));
        }
        _addAriaAndCollapsedClass(e, t) {
            if (e.length) for (const i of e) i.classList.toggle("collapsed", !t), i.setAttribute("aria-expanded", t);
        }
        static jQueryInterface(e) {
            const t = {};
            return "string" == typeof e && /show|hide/.test(e) && (t.toggle = !1), this.each((function() {
                const i = Re.getOrCreateInstance(this, t);
                if ("string" == typeof e) {
                    if (void 0 === i[e]) throw new TypeError(`No method named "${e}"`);
                    i[e]();
                }
            }));
        }
    }
    I.on(document, De, ze, (function(e) {
        ("A" === e.target.tagName || e.delegateTarget && "A" === e.delegateTarget.tagName) && e.preventDefault();
        for (const e of B.getMultipleElementsFromSelector(this)) Re.getOrCreateInstance(e, {
            toggle: !1
        }).toggle();
    })), m(Re);
    var Be = "top", Fe = "bottom", We = "right", Ve = "left", Xe = "auto", Ge = [ Be, Fe, We, Ve ], Ye = "start", Ue = "end", Ke = "clippingParents", Qe = "viewport", Je = "popper", Ze = "reference", et = Ge.reduce((function(e, t) {
        return e.concat([ t + "-" + Ye, t + "-" + Ue ]);
    }), []), tt = [].concat(Ge, [ Xe ]).reduce((function(e, t) {
        return e.concat([ t, t + "-" + Ye, t + "-" + Ue ]);
    }), []), it = "beforeRead", nt = "read", st = "afterRead", rt = "beforeMain", at = "main", ot = "afterMain", lt = "beforeWrite", ct = "write", dt = "afterWrite", ut = [ it, nt, st, rt, at, ot, lt, ct, dt ];
    function pt(e) {
        return e ? (e.nodeName || "").toLowerCase() : null;
    }
    function ft(e) {
        if (null == e) return window;
        if ("[object Window]" !== e.toString()) {
            var t = e.ownerDocument;
            return t && t.defaultView || window;
        }
        return e;
    }
    function ht(e) {
        return e instanceof ft(e).Element || e instanceof Element;
    }
    function mt(e) {
        return e instanceof ft(e).HTMLElement || e instanceof HTMLElement;
    }
    function gt(e) {
        return "undefined" != typeof ShadowRoot && (e instanceof ft(e).ShadowRoot || e instanceof ShadowRoot);
    }
    const vt = {
        name: "applyStyles",
        enabled: !0,
        phase: "write",
        fn: function(e) {
            var t = e.state;
            Object.keys(t.elements).forEach((function(e) {
                var i = t.styles[e] || {}, n = t.attributes[e] || {}, s = t.elements[e];
                mt(s) && pt(s) && (Object.assign(s.style, i), Object.keys(n).forEach((function(e) {
                    var t = n[e];
                    !1 === t ? s.removeAttribute(e) : s.setAttribute(e, !0 === t ? "" : t);
                })));
            }));
        },
        effect: function(e) {
            var t = e.state, i = {
                popper: {
                    position: t.options.strategy,
                    left: "0",
                    top: "0",
                    margin: "0"
                },
                arrow: {
                    position: "absolute"
                },
                reference: {}
            };
            return Object.assign(t.elements.popper.style, i.popper), t.styles = i, t.elements.arrow && Object.assign(t.elements.arrow.style, i.arrow), 
            function() {
                Object.keys(t.elements).forEach((function(e) {
                    var n = t.elements[e], s = t.attributes[e] || {}, r = Object.keys(t.styles.hasOwnProperty(e) ? t.styles[e] : i[e]).reduce((function(e, t) {
                        return e[t] = "", e;
                    }), {});
                    mt(n) && pt(n) && (Object.assign(n.style, r), Object.keys(s).forEach((function(e) {
                        n.removeAttribute(e);
                    })));
                }));
            };
        },
        requires: [ "computeStyles" ]
    };
    function yt(e) {
        return e.split("-")[0];
    }
    var bt = Math.max, wt = Math.min, xt = Math.round;
    function Et() {
        var e = navigator.userAgentData;
        return null != e && e.brands && Array.isArray(e.brands) ? e.brands.map((function(e) {
            return e.brand + "/" + e.version;
        })).join(" ") : navigator.userAgent;
    }
    function _t() {
        return !/^((?!chrome|android).)*safari/i.test(Et());
    }
    function Tt(e, t, i) {
        void 0 === t && (t = !1), void 0 === i && (i = !1);
        var n = e.getBoundingClientRect(), s = 1, r = 1;
        t && mt(e) && (s = e.offsetWidth > 0 && xt(n.width) / e.offsetWidth || 1, r = e.offsetHeight > 0 && xt(n.height) / e.offsetHeight || 1);
        var a = (ht(e) ? ft(e) : window).visualViewport, o = !_t() && i, l = (n.left + (o && a ? a.offsetLeft : 0)) / s, c = (n.top + (o && a ? a.offsetTop : 0)) / r, d = n.width / s, u = n.height / r;
        return {
            width: d,
            height: u,
            top: c,
            right: l + d,
            bottom: c + u,
            left: l,
            x: l,
            y: c
        };
    }
    function St(e) {
        var t = Tt(e), i = e.offsetWidth, n = e.offsetHeight;
        return Math.abs(t.width - i) <= 1 && (i = t.width), Math.abs(t.height - n) <= 1 && (n = t.height), 
        {
            x: e.offsetLeft,
            y: e.offsetTop,
            width: i,
            height: n
        };
    }
    function Ct(e, t) {
        var i = t.getRootNode && t.getRootNode();
        if (e.contains(t)) return !0;
        if (i && gt(i)) {
            var n = t;
            do {
                if (n && e.isSameNode(n)) return !0;
                n = n.parentNode || n.host;
            } while (n);
        }
        return !1;
    }
    function Mt(e) {
        return ft(e).getComputedStyle(e);
    }
    function At(e) {
        return [ "table", "td", "th" ].indexOf(pt(e)) >= 0;
    }
    function kt(e) {
        return ((ht(e) ? e.ownerDocument : e.document) || window.document).documentElement;
    }
    function Lt(e) {
        return "html" === pt(e) ? e : e.assignedSlot || e.parentNode || (gt(e) ? e.host : null) || kt(e);
    }
    function Pt(e) {
        return mt(e) && "fixed" !== Mt(e).position ? e.offsetParent : null;
    }
    function Ot(e) {
        for (var t = ft(e), i = Pt(e); i && At(i) && "static" === Mt(i).position; ) i = Pt(i);
        return i && ("html" === pt(i) || "body" === pt(i) && "static" === Mt(i).position) ? t : i || function(e) {
            var t = /firefox/i.test(Et());
            if (/Trident/i.test(Et()) && mt(e) && "fixed" === Mt(e).position) return null;
            var i = Lt(e);
            for (gt(i) && (i = i.host); mt(i) && [ "html", "body" ].indexOf(pt(i)) < 0; ) {
                var n = Mt(i);
                if ("none" !== n.transform || "none" !== n.perspective || "paint" === n.contain || -1 !== [ "transform", "perspective" ].indexOf(n.willChange) || t && "filter" === n.willChange || t && n.filter && "none" !== n.filter) return i;
                i = i.parentNode;
            }
            return null;
        }(e) || t;
    }
    function Dt(e) {
        return [ "top", "bottom" ].indexOf(e) >= 0 ? "x" : "y";
    }
    function It(e, t, i) {
        return bt(e, wt(t, i));
    }
    function $t(e) {
        return Object.assign({}, {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        }, e);
    }
    function Nt(e, t) {
        return t.reduce((function(t, i) {
            return t[i] = e, t;
        }), {});
    }
    const jt = {
        name: "arrow",
        enabled: !0,
        phase: "main",
        fn: function(e) {
            var t, i = e.state, n = e.name, s = e.options, r = i.elements.arrow, a = i.modifiersData.popperOffsets, o = yt(i.placement), l = Dt(o), c = [ Ve, We ].indexOf(o) >= 0 ? "height" : "width";
            if (r && a) {
                var d = function(e, t) {
                    return $t("number" != typeof (e = "function" == typeof e ? e(Object.assign({}, t.rects, {
                        placement: t.placement
                    })) : e) ? e : Nt(e, Ge));
                }(s.padding, i), u = St(r), p = "y" === l ? Be : Ve, f = "y" === l ? Fe : We, h = i.rects.reference[c] + i.rects.reference[l] - a[l] - i.rects.popper[c], m = a[l] - i.rects.reference[l], g = Ot(r), v = g ? "y" === l ? g.clientHeight || 0 : g.clientWidth || 0 : 0, y = h / 2 - m / 2, b = d[p], w = v - u[c] - d[f], x = v / 2 - u[c] / 2 + y, E = It(b, x, w), _ = l;
                i.modifiersData[n] = ((t = {})[_] = E, t.centerOffset = E - x, t);
            }
        },
        effect: function(e) {
            var t = e.state, i = e.options.element, n = void 0 === i ? "[data-popper-arrow]" : i;
            null != n && ("string" != typeof n || (n = t.elements.popper.querySelector(n))) && Ct(t.elements.popper, n) && (t.elements.arrow = n);
        },
        requires: [ "popperOffsets" ],
        requiresIfExists: [ "preventOverflow" ]
    };
    function zt(e) {
        return e.split("-")[1];
    }
    var Ht = {
        top: "auto",
        right: "auto",
        bottom: "auto",
        left: "auto"
    };
    function qt(e) {
        var t, i = e.popper, n = e.popperRect, s = e.placement, r = e.variation, a = e.offsets, o = e.position, l = e.gpuAcceleration, c = e.adaptive, d = e.roundOffsets, u = e.isFixed, p = a.x, f = void 0 === p ? 0 : p, h = a.y, m = void 0 === h ? 0 : h, g = "function" == typeof d ? d({
            x: f,
            y: m
        }) : {
            x: f,
            y: m
        };
        f = g.x, m = g.y;
        var v = a.hasOwnProperty("x"), y = a.hasOwnProperty("y"), b = Ve, w = Be, x = window;
        if (c) {
            var E = Ot(i), _ = "clientHeight", T = "clientWidth";
            if (E === ft(i) && "static" !== Mt(E = kt(i)).position && "absolute" === o && (_ = "scrollHeight", 
            T = "scrollWidth"), s === Be || (s === Ve || s === We) && r === Ue) w = Fe, m -= (u && E === x && x.visualViewport ? x.visualViewport.height : E[_]) - n.height, 
            m *= l ? 1 : -1;
            if (s === Ve || (s === Be || s === Fe) && r === Ue) b = We, f -= (u && E === x && x.visualViewport ? x.visualViewport.width : E[T]) - n.width, 
            f *= l ? 1 : -1;
        }
        var S, C = Object.assign({
            position: o
        }, c && Ht), M = !0 === d ? function(e, t) {
            var i = e.x, n = e.y, s = t.devicePixelRatio || 1;
            return {
                x: xt(i * s) / s || 0,
                y: xt(n * s) / s || 0
            };
        }({
            x: f,
            y: m
        }, ft(i)) : {
            x: f,
            y: m
        };
        return f = M.x, m = M.y, l ? Object.assign({}, C, ((S = {})[w] = y ? "0" : "", S[b] = v ? "0" : "", 
        S.transform = (x.devicePixelRatio || 1) <= 1 ? "translate(" + f + "px, " + m + "px)" : "translate3d(" + f + "px, " + m + "px, 0)", 
        S)) : Object.assign({}, C, ((t = {})[w] = y ? m + "px" : "", t[b] = v ? f + "px" : "", 
        t.transform = "", t));
    }
    const Rt = {
        name: "computeStyles",
        enabled: !0,
        phase: "beforeWrite",
        fn: function(e) {
            var t = e.state, i = e.options, n = i.gpuAcceleration, s = void 0 === n || n, r = i.adaptive, a = void 0 === r || r, o = i.roundOffsets, l = void 0 === o || o, c = {
                placement: yt(t.placement),
                variation: zt(t.placement),
                popper: t.elements.popper,
                popperRect: t.rects.popper,
                gpuAcceleration: s,
                isFixed: "fixed" === t.options.strategy
            };
            null != t.modifiersData.popperOffsets && (t.styles.popper = Object.assign({}, t.styles.popper, qt(Object.assign({}, c, {
                offsets: t.modifiersData.popperOffsets,
                position: t.options.strategy,
                adaptive: a,
                roundOffsets: l
            })))), null != t.modifiersData.arrow && (t.styles.arrow = Object.assign({}, t.styles.arrow, qt(Object.assign({}, c, {
                offsets: t.modifiersData.arrow,
                position: "absolute",
                adaptive: !1,
                roundOffsets: l
            })))), t.attributes.popper = Object.assign({}, t.attributes.popper, {
                "data-popper-placement": t.placement
            });
        },
        data: {}
    };
    var Bt = {
        passive: !0
    };
    const Ft = {
        name: "eventListeners",
        enabled: !0,
        phase: "write",
        fn: function() {},
        effect: function(e) {
            var t = e.state, i = e.instance, n = e.options, s = n.scroll, r = void 0 === s || s, a = n.resize, o = void 0 === a || a, l = ft(t.elements.popper), c = [].concat(t.scrollParents.reference, t.scrollParents.popper);
            return r && c.forEach((function(e) {
                e.addEventListener("scroll", i.update, Bt);
            })), o && l.addEventListener("resize", i.update, Bt), function() {
                r && c.forEach((function(e) {
                    e.removeEventListener("scroll", i.update, Bt);
                })), o && l.removeEventListener("resize", i.update, Bt);
            };
        },
        data: {}
    };
    var Wt = {
        left: "right",
        right: "left",
        bottom: "top",
        top: "bottom"
    };
    function Vt(e) {
        return e.replace(/left|right|bottom|top/g, (function(e) {
            return Wt[e];
        }));
    }
    var Xt = {
        start: "end",
        end: "start"
    };
    function Gt(e) {
        return e.replace(/start|end/g, (function(e) {
            return Xt[e];
        }));
    }
    function Yt(e) {
        var t = ft(e);
        return {
            scrollLeft: t.pageXOffset,
            scrollTop: t.pageYOffset
        };
    }
    function Ut(e) {
        return Tt(kt(e)).left + Yt(e).scrollLeft;
    }
    function Kt(e) {
        var t = Mt(e), i = t.overflow, n = t.overflowX, s = t.overflowY;
        return /auto|scroll|overlay|hidden/.test(i + s + n);
    }
    function Qt(e) {
        return [ "html", "body", "#document" ].indexOf(pt(e)) >= 0 ? e.ownerDocument.body : mt(e) && Kt(e) ? e : Qt(Lt(e));
    }
    function Jt(e, t) {
        var i;
        void 0 === t && (t = []);
        var n = Qt(e), s = n === (null == (i = e.ownerDocument) ? void 0 : i.body), r = ft(n), a = s ? [ r ].concat(r.visualViewport || [], Kt(n) ? n : []) : n, o = t.concat(a);
        return s ? o : o.concat(Jt(Lt(a)));
    }
    function Zt(e) {
        return Object.assign({}, e, {
            left: e.x,
            top: e.y,
            right: e.x + e.width,
            bottom: e.y + e.height
        });
    }
    function ei(e, t, i) {
        return t === Qe ? Zt(function(e, t) {
            var i = ft(e), n = kt(e), s = i.visualViewport, r = n.clientWidth, a = n.clientHeight, o = 0, l = 0;
            if (s) {
                r = s.width, a = s.height;
                var c = _t();
                (c || !c && "fixed" === t) && (o = s.offsetLeft, l = s.offsetTop);
            }
            return {
                width: r,
                height: a,
                x: o + Ut(e),
                y: l
            };
        }(e, i)) : ht(t) ? function(e, t) {
            var i = Tt(e, !1, "fixed" === t);
            return i.top = i.top + e.clientTop, i.left = i.left + e.clientLeft, i.bottom = i.top + e.clientHeight, 
            i.right = i.left + e.clientWidth, i.width = e.clientWidth, i.height = e.clientHeight, 
            i.x = i.left, i.y = i.top, i;
        }(t, i) : Zt(function(e) {
            var t, i = kt(e), n = Yt(e), s = null == (t = e.ownerDocument) ? void 0 : t.body, r = bt(i.scrollWidth, i.clientWidth, s ? s.scrollWidth : 0, s ? s.clientWidth : 0), a = bt(i.scrollHeight, i.clientHeight, s ? s.scrollHeight : 0, s ? s.clientHeight : 0), o = -n.scrollLeft + Ut(e), l = -n.scrollTop;
            return "rtl" === Mt(s || i).direction && (o += bt(i.clientWidth, s ? s.clientWidth : 0) - r), 
            {
                width: r,
                height: a,
                x: o,
                y: l
            };
        }(kt(e)));
    }
    function ti(e, t, i, n) {
        var s = "clippingParents" === t ? function(e) {
            var t = Jt(Lt(e)), i = [ "absolute", "fixed" ].indexOf(Mt(e).position) >= 0 && mt(e) ? Ot(e) : e;
            return ht(i) ? t.filter((function(e) {
                return ht(e) && Ct(e, i) && "body" !== pt(e);
            })) : [];
        }(e) : [].concat(t), r = [].concat(s, [ i ]), a = r[0], o = r.reduce((function(t, i) {
            var s = ei(e, i, n);
            return t.top = bt(s.top, t.top), t.right = wt(s.right, t.right), t.bottom = wt(s.bottom, t.bottom), 
            t.left = bt(s.left, t.left), t;
        }), ei(e, a, n));
        return o.width = o.right - o.left, o.height = o.bottom - o.top, o.x = o.left, o.y = o.top, 
        o;
    }
    function ii(e) {
        var t, i = e.reference, n = e.element, s = e.placement, r = s ? yt(s) : null, a = s ? zt(s) : null, o = i.x + i.width / 2 - n.width / 2, l = i.y + i.height / 2 - n.height / 2;
        switch (r) {
          case Be:
            t = {
                x: o,
                y: i.y - n.height
            };
            break;

          case Fe:
            t = {
                x: o,
                y: i.y + i.height
            };
            break;

          case We:
            t = {
                x: i.x + i.width,
                y: l
            };
            break;

          case Ve:
            t = {
                x: i.x - n.width,
                y: l
            };
            break;

          default:
            t = {
                x: i.x,
                y: i.y
            };
        }
        var c = r ? Dt(r) : null;
        if (null != c) {
            var d = "y" === c ? "height" : "width";
            switch (a) {
              case Ye:
                t[c] = t[c] - (i[d] / 2 - n[d] / 2);
                break;

              case Ue:
                t[c] = t[c] + (i[d] / 2 - n[d] / 2);
            }
        }
        return t;
    }
    function ni(e, t) {
        void 0 === t && (t = {});
        var i = t, n = i.placement, s = void 0 === n ? e.placement : n, r = i.strategy, a = void 0 === r ? e.strategy : r, o = i.boundary, l = void 0 === o ? Ke : o, c = i.rootBoundary, d = void 0 === c ? Qe : c, u = i.elementContext, p = void 0 === u ? Je : u, f = i.altBoundary, h = void 0 !== f && f, m = i.padding, g = void 0 === m ? 0 : m, v = $t("number" != typeof g ? g : Nt(g, Ge)), y = p === Je ? Ze : Je, b = e.rects.popper, w = e.elements[h ? y : p], x = ti(ht(w) ? w : w.contextElement || kt(e.elements.popper), l, d, a), E = Tt(e.elements.reference), _ = ii({
            reference: E,
            element: b,
            strategy: "absolute",
            placement: s
        }), T = Zt(Object.assign({}, b, _)), S = p === Je ? T : E, C = {
            top: x.top - S.top + v.top,
            bottom: S.bottom - x.bottom + v.bottom,
            left: x.left - S.left + v.left,
            right: S.right - x.right + v.right
        }, M = e.modifiersData.offset;
        if (p === Je && M) {
            var A = M[s];
            Object.keys(C).forEach((function(e) {
                var t = [ We, Fe ].indexOf(e) >= 0 ? 1 : -1, i = [ Be, Fe ].indexOf(e) >= 0 ? "y" : "x";
                C[e] += A[i] * t;
            }));
        }
        return C;
    }
    function si(e, t) {
        void 0 === t && (t = {});
        var i = t, n = i.placement, s = i.boundary, r = i.rootBoundary, a = i.padding, o = i.flipVariations, l = i.allowedAutoPlacements, c = void 0 === l ? tt : l, d = zt(n), u = d ? o ? et : et.filter((function(e) {
            return zt(e) === d;
        })) : Ge, p = u.filter((function(e) {
            return c.indexOf(e) >= 0;
        }));
        0 === p.length && (p = u);
        var f = p.reduce((function(t, i) {
            return t[i] = ni(e, {
                placement: i,
                boundary: s,
                rootBoundary: r,
                padding: a
            })[yt(i)], t;
        }), {});
        return Object.keys(f).sort((function(e, t) {
            return f[e] - f[t];
        }));
    }
    const ri = {
        name: "flip",
        enabled: !0,
        phase: "main",
        fn: function(e) {
            var t = e.state, i = e.options, n = e.name;
            if (!t.modifiersData[n]._skip) {
                for (var s = i.mainAxis, r = void 0 === s || s, a = i.altAxis, o = void 0 === a || a, l = i.fallbackPlacements, c = i.padding, d = i.boundary, u = i.rootBoundary, p = i.altBoundary, f = i.flipVariations, h = void 0 === f || f, m = i.allowedAutoPlacements, g = t.options.placement, v = yt(g), y = l || (v === g || !h ? [ Vt(g) ] : function(e) {
                    if (yt(e) === Xe) return [];
                    var t = Vt(e);
                    return [ Gt(e), t, Gt(t) ];
                }(g)), b = [ g ].concat(y).reduce((function(e, i) {
                    return e.concat(yt(i) === Xe ? si(t, {
                        placement: i,
                        boundary: d,
                        rootBoundary: u,
                        padding: c,
                        flipVariations: h,
                        allowedAutoPlacements: m
                    }) : i);
                }), []), w = t.rects.reference, x = t.rects.popper, E = new Map, _ = !0, T = b[0], S = 0; S < b.length; S++) {
                    var C = b[S], M = yt(C), A = zt(C) === Ye, k = [ Be, Fe ].indexOf(M) >= 0, L = k ? "width" : "height", P = ni(t, {
                        placement: C,
                        boundary: d,
                        rootBoundary: u,
                        altBoundary: p,
                        padding: c
                    }), O = k ? A ? We : Ve : A ? Fe : Be;
                    w[L] > x[L] && (O = Vt(O));
                    var D = Vt(O), I = [];
                    if (r && I.push(P[M] <= 0), o && I.push(P[O] <= 0, P[D] <= 0), I.every((function(e) {
                        return e;
                    }))) {
                        T = C, _ = !1;
                        break;
                    }
                    E.set(C, I);
                }
                if (_) for (var $ = function(e) {
                    var t = b.find((function(t) {
                        var i = E.get(t);
                        if (i) return i.slice(0, e).every((function(e) {
                            return e;
                        }));
                    }));
                    if (t) return T = t, "break";
                }, N = h ? 3 : 1; N > 0; N--) {
                    if ("break" === $(N)) break;
                }
                t.placement !== T && (t.modifiersData[n]._skip = !0, t.placement = T, t.reset = !0);
            }
        },
        requiresIfExists: [ "offset" ],
        data: {
            _skip: !1
        }
    };
    function ai(e, t, i) {
        return void 0 === i && (i = {
            x: 0,
            y: 0
        }), {
            top: e.top - t.height - i.y,
            right: e.right - t.width + i.x,
            bottom: e.bottom - t.height + i.y,
            left: e.left - t.width - i.x
        };
    }
    function oi(e) {
        return [ Be, We, Fe, Ve ].some((function(t) {
            return e[t] >= 0;
        }));
    }
    const li = {
        name: "hide",
        enabled: !0,
        phase: "main",
        requiresIfExists: [ "preventOverflow" ],
        fn: function(e) {
            var t = e.state, i = e.name, n = t.rects.reference, s = t.rects.popper, r = t.modifiersData.preventOverflow, a = ni(t, {
                elementContext: "reference"
            }), o = ni(t, {
                altBoundary: !0
            }), l = ai(a, n), c = ai(o, s, r), d = oi(l), u = oi(c);
            t.modifiersData[i] = {
                referenceClippingOffsets: l,
                popperEscapeOffsets: c,
                isReferenceHidden: d,
                hasPopperEscaped: u
            }, t.attributes.popper = Object.assign({}, t.attributes.popper, {
                "data-popper-reference-hidden": d,
                "data-popper-escaped": u
            });
        }
    };
    const ci = {
        name: "offset",
        enabled: !0,
        phase: "main",
        requires: [ "popperOffsets" ],
        fn: function(e) {
            var t = e.state, i = e.options, n = e.name, s = i.offset, r = void 0 === s ? [ 0, 0 ] : s, a = tt.reduce((function(e, i) {
                return e[i] = function(e, t, i) {
                    var n = yt(e), s = [ Ve, Be ].indexOf(n) >= 0 ? -1 : 1, r = "function" == typeof i ? i(Object.assign({}, t, {
                        placement: e
                    })) : i, a = r[0], o = r[1];
                    return a = a || 0, o = (o || 0) * s, [ Ve, We ].indexOf(n) >= 0 ? {
                        x: o,
                        y: a
                    } : {
                        x: a,
                        y: o
                    };
                }(i, t.rects, r), e;
            }), {}), o = a[t.placement], l = o.x, c = o.y;
            null != t.modifiersData.popperOffsets && (t.modifiersData.popperOffsets.x += l, 
            t.modifiersData.popperOffsets.y += c), t.modifiersData[n] = a;
        }
    };
    const di = {
        name: "popperOffsets",
        enabled: !0,
        phase: "read",
        fn: function(e) {
            var t = e.state, i = e.name;
            t.modifiersData[i] = ii({
                reference: t.rects.reference,
                element: t.rects.popper,
                strategy: "absolute",
                placement: t.placement
            });
        },
        data: {}
    };
    const ui = {
        name: "preventOverflow",
        enabled: !0,
        phase: "main",
        fn: function(e) {
            var t = e.state, i = e.options, n = e.name, s = i.mainAxis, r = void 0 === s || s, a = i.altAxis, o = void 0 !== a && a, l = i.boundary, c = i.rootBoundary, d = i.altBoundary, u = i.padding, p = i.tether, f = void 0 === p || p, h = i.tetherOffset, m = void 0 === h ? 0 : h, g = ni(t, {
                boundary: l,
                rootBoundary: c,
                padding: u,
                altBoundary: d
            }), v = yt(t.placement), y = zt(t.placement), b = !y, w = Dt(v), x = "x" === w ? "y" : "x", E = t.modifiersData.popperOffsets, _ = t.rects.reference, T = t.rects.popper, S = "function" == typeof m ? m(Object.assign({}, t.rects, {
                placement: t.placement
            })) : m, C = "number" == typeof S ? {
                mainAxis: S,
                altAxis: S
            } : Object.assign({
                mainAxis: 0,
                altAxis: 0
            }, S), M = t.modifiersData.offset ? t.modifiersData.offset[t.placement] : null, A = {
                x: 0,
                y: 0
            };
            if (E) {
                if (r) {
                    var k, L = "y" === w ? Be : Ve, P = "y" === w ? Fe : We, O = "y" === w ? "height" : "width", D = E[w], I = D + g[L], $ = D - g[P], N = f ? -T[O] / 2 : 0, j = y === Ye ? _[O] : T[O], z = y === Ye ? -T[O] : -_[O], H = t.elements.arrow, q = f && H ? St(H) : {
                        width: 0,
                        height: 0
                    }, R = t.modifiersData["arrow#persistent"] ? t.modifiersData["arrow#persistent"].padding : {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    }, B = R[L], F = R[P], W = It(0, _[O], q[O]), V = b ? _[O] / 2 - N - W - B - C.mainAxis : j - W - B - C.mainAxis, X = b ? -_[O] / 2 + N + W + F + C.mainAxis : z + W + F + C.mainAxis, G = t.elements.arrow && Ot(t.elements.arrow), Y = G ? "y" === w ? G.clientTop || 0 : G.clientLeft || 0 : 0, U = null != (k = null == M ? void 0 : M[w]) ? k : 0, K = D + X - U, Q = It(f ? wt(I, D + V - U - Y) : I, D, f ? bt($, K) : $);
                    E[w] = Q, A[w] = Q - D;
                }
                if (o) {
                    var J, Z = "x" === w ? Be : Ve, ee = "x" === w ? Fe : We, te = E[x], ie = "y" === x ? "height" : "width", ne = te + g[Z], se = te - g[ee], re = -1 !== [ Be, Ve ].indexOf(v), ae = null != (J = null == M ? void 0 : M[x]) ? J : 0, oe = re ? ne : te - _[ie] - T[ie] - ae + C.altAxis, le = re ? te + _[ie] + T[ie] - ae - C.altAxis : se, ce = f && re ? function(e, t, i) {
                        var n = It(e, t, i);
                        return n > i ? i : n;
                    }(oe, te, le) : It(f ? oe : ne, te, f ? le : se);
                    E[x] = ce, A[x] = ce - te;
                }
                t.modifiersData[n] = A;
            }
        },
        requiresIfExists: [ "offset" ]
    };
    function pi(e, t, i) {
        void 0 === i && (i = !1);
        var n, s, r = mt(t), a = mt(t) && function(e) {
            var t = e.getBoundingClientRect(), i = xt(t.width) / e.offsetWidth || 1, n = xt(t.height) / e.offsetHeight || 1;
            return 1 !== i || 1 !== n;
        }(t), o = kt(t), l = Tt(e, a, i), c = {
            scrollLeft: 0,
            scrollTop: 0
        }, d = {
            x: 0,
            y: 0
        };
        return (r || !r && !i) && (("body" !== pt(t) || Kt(o)) && (c = (n = t) !== ft(n) && mt(n) ? {
            scrollLeft: (s = n).scrollLeft,
            scrollTop: s.scrollTop
        } : Yt(n)), mt(t) ? ((d = Tt(t, !0)).x += t.clientLeft, d.y += t.clientTop) : o && (d.x = Ut(o))), 
        {
            x: l.left + c.scrollLeft - d.x,
            y: l.top + c.scrollTop - d.y,
            width: l.width,
            height: l.height
        };
    }
    function fi(e) {
        var t = new Map, i = new Set, n = [];
        function s(e) {
            i.add(e.name), [].concat(e.requires || [], e.requiresIfExists || []).forEach((function(e) {
                if (!i.has(e)) {
                    var n = t.get(e);
                    n && s(n);
                }
            })), n.push(e);
        }
        return e.forEach((function(e) {
            t.set(e.name, e);
        })), e.forEach((function(e) {
            i.has(e.name) || s(e);
        })), n;
    }
    var hi = {
        placement: "bottom",
        modifiers: [],
        strategy: "absolute"
    };
    function mi() {
        for (var e = arguments.length, t = new Array(e), i = 0; i < e; i++) t[i] = arguments[i];
        return !t.some((function(e) {
            return !(e && "function" == typeof e.getBoundingClientRect);
        }));
    }
    function gi(e) {
        void 0 === e && (e = {});
        var t = e, i = t.defaultModifiers, n = void 0 === i ? [] : i, s = t.defaultOptions, r = void 0 === s ? hi : s;
        return function(e, t, i) {
            void 0 === i && (i = r);
            var s, a, o = {
                placement: "bottom",
                orderedModifiers: [],
                options: Object.assign({}, hi, r),
                modifiersData: {},
                elements: {
                    reference: e,
                    popper: t
                },
                attributes: {},
                styles: {}
            }, l = [], c = !1, d = {
                state: o,
                setOptions: function(i) {
                    var s = "function" == typeof i ? i(o.options) : i;
                    u(), o.options = Object.assign({}, r, o.options, s), o.scrollParents = {
                        reference: ht(e) ? Jt(e) : e.contextElement ? Jt(e.contextElement) : [],
                        popper: Jt(t)
                    };
                    var a, c, p = function(e) {
                        var t = fi(e);
                        return ut.reduce((function(e, i) {
                            return e.concat(t.filter((function(e) {
                                return e.phase === i;
                            })));
                        }), []);
                    }((a = [].concat(n, o.options.modifiers), c = a.reduce((function(e, t) {
                        var i = e[t.name];
                        return e[t.name] = i ? Object.assign({}, i, t, {
                            options: Object.assign({}, i.options, t.options),
                            data: Object.assign({}, i.data, t.data)
                        }) : t, e;
                    }), {}), Object.keys(c).map((function(e) {
                        return c[e];
                    }))));
                    return o.orderedModifiers = p.filter((function(e) {
                        return e.enabled;
                    })), o.orderedModifiers.forEach((function(e) {
                        var t = e.name, i = e.options, n = void 0 === i ? {} : i, s = e.effect;
                        if ("function" == typeof s) {
                            var r = s({
                                state: o,
                                name: t,
                                instance: d,
                                options: n
                            }), a = function() {};
                            l.push(r || a);
                        }
                    })), d.update();
                },
                forceUpdate: function() {
                    if (!c) {
                        var e = o.elements, t = e.reference, i = e.popper;
                        if (mi(t, i)) {
                            o.rects = {
                                reference: pi(t, Ot(i), "fixed" === o.options.strategy),
                                popper: St(i)
                            }, o.reset = !1, o.placement = o.options.placement, o.orderedModifiers.forEach((function(e) {
                                return o.modifiersData[e.name] = Object.assign({}, e.data);
                            }));
                            for (var n = 0; n < o.orderedModifiers.length; n++) if (!0 !== o.reset) {
                                var s = o.orderedModifiers[n], r = s.fn, a = s.options, l = void 0 === a ? {} : a, u = s.name;
                                "function" == typeof r && (o = r({
                                    state: o,
                                    options: l,
                                    name: u,
                                    instance: d
                                }) || o);
                            } else o.reset = !1, n = -1;
                        }
                    }
                },
                update: (s = function() {
                    return new Promise((function(e) {
                        d.forceUpdate(), e(o);
                    }));
                }, function() {
                    return a || (a = new Promise((function(e) {
                        Promise.resolve().then((function() {
                            a = void 0, e(s());
                        }));
                    }))), a;
                }),
                destroy: function() {
                    u(), c = !0;
                }
            };
            if (!mi(e, t)) return d;
            function u() {
                l.forEach((function(e) {
                    return e();
                })), l = [];
            }
            return d.setOptions(i).then((function(e) {
                !c && i.onFirstUpdate && i.onFirstUpdate(e);
            })), d;
        };
    }
    var vi = gi(), yi = gi({
        defaultModifiers: [ Ft, di, Rt, vt ]
    }), bi = gi({
        defaultModifiers: [ Ft, di, Rt, vt, ci, ri, ui, jt, li ]
    });
    const wi = Object.freeze(Object.defineProperty({
        __proto__: null,
        afterMain: ot,
        afterRead: st,
        afterWrite: dt,
        applyStyles: vt,
        arrow: jt,
        auto: Xe,
        basePlacements: Ge,
        beforeMain: rt,
        beforeRead: it,
        beforeWrite: lt,
        bottom: Fe,
        clippingParents: Ke,
        computeStyles: Rt,
        createPopper: bi,
        createPopperBase: vi,
        createPopperLite: yi,
        detectOverflow: ni,
        end: Ue,
        eventListeners: Ft,
        flip: ri,
        hide: li,
        left: Ve,
        main: at,
        modifierPhases: ut,
        offset: ci,
        placements: tt,
        popper: Je,
        popperGenerator: gi,
        popperOffsets: di,
        preventOverflow: ui,
        read: nt,
        reference: Ze,
        right: We,
        start: Ye,
        top: Be,
        variationPlacements: et,
        viewport: Qe,
        write: ct
    }, Symbol.toStringTag, {
        value: "Module"
    })), xi = "dropdown", Ei = ".bs.dropdown", _i = ".data-api", Ti = "ArrowUp", Si = "ArrowDown", Ci = `hide${Ei}`, Mi = `hidden${Ei}`, Ai = `show${Ei}`, ki = `shown${Ei}`, Li = `click${Ei}${_i}`, Pi = `keydown${Ei}${_i}`, Oi = `keyup${Ei}${_i}`, Di = "show", Ii = '[data-bs-toggle="dropdown"]:not(.disabled):not(:disabled)', $i = `${Ii}.${Di}`, Ni = ".dropdown-menu", ji = h() ? "top-end" : "top-start", zi = h() ? "top-start" : "top-end", Hi = h() ? "bottom-end" : "bottom-start", qi = h() ? "bottom-start" : "bottom-end", Ri = h() ? "left-start" : "right-start", Bi = h() ? "right-start" : "left-start", Fi = {
        autoClose: !0,
        boundary: "clippingParents",
        display: "dynamic",
        offset: [ 0, 2 ],
        popperConfig: null,
        reference: "toggle"
    }, Wi = {
        autoClose: "(boolean|string)",
        boundary: "(string|element)",
        display: "string",
        offset: "(array|string|function)",
        popperConfig: "(null|object|function)",
        reference: "(string|element|object)"
    };
    class Vi extends q {
        constructor(e, t) {
            super(e, t), this._popper = null, this._parent = this._element.parentNode, this._menu = B.next(this._element, Ni)[0] || B.prev(this._element, Ni)[0] || B.findOne(Ni, this._parent), 
            this._inNavbar = this._detectNavbar();
        }
        static get Default() {
            return Fi;
        }
        static get DefaultType() {
            return Wi;
        }
        static get NAME() {
            return xi;
        }
        toggle() {
            return this._isShown() ? this.hide() : this.show();
        }
        show() {
            if (l(this._element) || this._isShown()) return;
            const e = {
                relatedTarget: this._element
            };
            if (!I.trigger(this._element, Ai, e).defaultPrevented) {
                if (this._createPopper(), "ontouchstart" in document.documentElement && !this._parent.closest(".navbar-nav")) for (const e of [].concat(...document.body.children)) I.on(e, "mouseover", d);
                this._element.focus(), this._element.setAttribute("aria-expanded", !0), this._menu.classList.add(Di), 
                this._element.classList.add(Di), I.trigger(this._element, ki, e);
            }
        }
        hide() {
            if (l(this._element) || !this._isShown()) return;
            const e = {
                relatedTarget: this._element
            };
            this._completeHide(e);
        }
        dispose() {
            this._popper && this._popper.destroy(), super.dispose();
        }
        update() {
            this._inNavbar = this._detectNavbar(), this._popper && this._popper.update();
        }
        _completeHide(e) {
            if (!I.trigger(this._element, Ci, e).defaultPrevented) {
                if ("ontouchstart" in document.documentElement) for (const e of [].concat(...document.body.children)) I.off(e, "mouseover", d);
                this._popper && this._popper.destroy(), this._menu.classList.remove(Di), this._element.classList.remove(Di), 
                this._element.setAttribute("aria-expanded", "false"), z.removeDataAttribute(this._menu, "popper"), 
                I.trigger(this._element, Mi, e);
            }
        }
        _getConfig(e) {
            if ("object" == typeof (e = super._getConfig(e)).reference && !r(e.reference) && "function" != typeof e.reference.getBoundingClientRect) throw new TypeError(`${xi.toUpperCase()}: Option "reference" provided type "object" without a required "getBoundingClientRect" method.`);
            return e;
        }
        _createPopper() {
            if (void 0 === wi) throw new TypeError("Bootstrap's dropdowns require Popper (https://popper.js.org)");
            let e = this._element;
            "parent" === this._config.reference ? e = this._parent : r(this._config.reference) ? e = a(this._config.reference) : "object" == typeof this._config.reference && (e = this._config.reference);
            const t = this._getPopperConfig();
            this._popper = bi(e, this._menu, t);
        }
        _isShown() {
            return this._menu.classList.contains(Di);
        }
        _getPlacement() {
            const e = this._parent;
            if (e.classList.contains("dropend")) return Ri;
            if (e.classList.contains("dropstart")) return Bi;
            if (e.classList.contains("dropup-center")) return "top";
            if (e.classList.contains("dropdown-center")) return "bottom";
            const t = "end" === getComputedStyle(this._menu).getPropertyValue("--bs-position").trim();
            return e.classList.contains("dropup") ? t ? zi : ji : t ? qi : Hi;
        }
        _detectNavbar() {
            return null !== this._element.closest(".navbar");
        }
        _getOffset() {
            const {offset: e} = this._config;
            return "string" == typeof e ? e.split(",").map((e => Number.parseInt(e, 10))) : "function" == typeof e ? t => e(t, this._element) : e;
        }
        _getPopperConfig() {
            const e = {
                placement: this._getPlacement(),
                modifiers: [ {
                    name: "preventOverflow",
                    options: {
                        boundary: this._config.boundary
                    }
                }, {
                    name: "offset",
                    options: {
                        offset: this._getOffset()
                    }
                } ]
            };
            return (this._inNavbar || "static" === this._config.display) && (z.setDataAttribute(this._menu, "popper", "static"), 
            e.modifiers = [ {
                name: "applyStyles",
                enabled: !1
            } ]), {
                ...e,
                ...g(this._config.popperConfig, [ e ])
            };
        }
        _selectMenuItem({key: e, target: t}) {
            const i = B.find(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)", this._menu).filter((e => o(e)));
            i.length && y(i, t, e === Si, !i.includes(t)).focus();
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = Vi.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e]) throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            }));
        }
        static clearMenus(e) {
            if (2 === e.button || "keyup" === e.type && "Tab" !== e.key) return;
            const t = B.find($i);
            for (const i of t) {
                const t = Vi.getInstance(i);
                if (!t || !1 === t._config.autoClose) continue;
                const n = e.composedPath(), s = n.includes(t._menu);
                if (n.includes(t._element) || "inside" === t._config.autoClose && !s || "outside" === t._config.autoClose && s) continue;
                if (t._menu.contains(e.target) && ("keyup" === e.type && "Tab" === e.key || /input|select|option|textarea|form/i.test(e.target.tagName))) continue;
                const r = {
                    relatedTarget: t._element
                };
                "click" === e.type && (r.clickEvent = e), t._completeHide(r);
            }
        }
        static dataApiKeydownHandler(e) {
            const t = /input|textarea/i.test(e.target.tagName), i = "Escape" === e.key, n = [ Ti, Si ].includes(e.key);
            if (!n && !i) return;
            if (t && !i) return;
            e.preventDefault();
            const s = this.matches(Ii) ? this : B.prev(this, Ii)[0] || B.next(this, Ii)[0] || B.findOne(Ii, e.delegateTarget.parentNode), r = Vi.getOrCreateInstance(s);
            if (n) return e.stopPropagation(), r.show(), void r._selectMenuItem(e);
            r._isShown() && (e.stopPropagation(), r.hide(), s.focus());
        }
    }
    I.on(document, Pi, Ii, Vi.dataApiKeydownHandler), I.on(document, Pi, Ni, Vi.dataApiKeydownHandler), 
    I.on(document, Li, Vi.clearMenus), I.on(document, Oi, Vi.clearMenus), I.on(document, Li, Ii, (function(e) {
        e.preventDefault(), Vi.getOrCreateInstance(this).toggle();
    })), m(Vi);
    const Xi = "backdrop", Gi = "show", Yi = `mousedown.bs.${Xi}`, Ui = {
        className: "modal-backdrop",
        clickCallback: null,
        isAnimated: !1,
        isVisible: !0,
        rootElement: "body"
    }, Ki = {
        className: "string",
        clickCallback: "(function|null)",
        isAnimated: "boolean",
        isVisible: "boolean",
        rootElement: "(element|string)"
    };
    class Qi extends H {
        constructor(e) {
            super(), this._config = this._getConfig(e), this._isAppended = !1, this._element = null;
        }
        static get Default() {
            return Ui;
        }
        static get DefaultType() {
            return Ki;
        }
        static get NAME() {
            return Xi;
        }
        show(e) {
            if (!this._config.isVisible) return void g(e);
            this._append();
            const t = this._getElement();
            this._config.isAnimated && u(t), t.classList.add(Gi), this._emulateAnimation((() => {
                g(e);
            }));
        }
        hide(e) {
            this._config.isVisible ? (this._getElement().classList.remove(Gi), this._emulateAnimation((() => {
                this.dispose(), g(e);
            }))) : g(e);
        }
        dispose() {
            this._isAppended && (I.off(this._element, Yi), this._element.remove(), this._isAppended = !1);
        }
        _getElement() {
            if (!this._element) {
                const e = document.createElement("div");
                e.className = this._config.className, this._config.isAnimated && e.classList.add("fade"), 
                this._element = e;
            }
            return this._element;
        }
        _configAfterMerge(e) {
            return e.rootElement = a(e.rootElement), e;
        }
        _append() {
            if (this._isAppended) return;
            const e = this._getElement();
            this._config.rootElement.append(e), I.on(e, Yi, (() => {
                g(this._config.clickCallback);
            })), this._isAppended = !0;
        }
        _emulateAnimation(e) {
            v(e, this._getElement(), this._config.isAnimated);
        }
    }
    const Ji = ".bs.focustrap", Zi = `focusin${Ji}`, en = `keydown.tab${Ji}`, tn = "backward", nn = {
        autofocus: !0,
        trapElement: null
    }, sn = {
        autofocus: "boolean",
        trapElement: "element"
    };
    class rn extends H {
        constructor(e) {
            super(), this._config = this._getConfig(e), this._isActive = !1, this._lastTabNavDirection = null;
        }
        static get Default() {
            return nn;
        }
        static get DefaultType() {
            return sn;
        }
        static get NAME() {
            return "focustrap";
        }
        activate() {
            this._isActive || (this._config.autofocus && this._config.trapElement.focus(), I.off(document, Ji), 
            I.on(document, Zi, (e => this._handleFocusin(e))), I.on(document, en, (e => this._handleKeydown(e))), 
            this._isActive = !0);
        }
        deactivate() {
            this._isActive && (this._isActive = !1, I.off(document, Ji));
        }
        _handleFocusin(e) {
            const {trapElement: t} = this._config;
            if (e.target === document || e.target === t || t.contains(e.target)) return;
            const i = B.focusableChildren(t);
            0 === i.length ? t.focus() : this._lastTabNavDirection === tn ? i[i.length - 1].focus() : i[0].focus();
        }
        _handleKeydown(e) {
            "Tab" === e.key && (this._lastTabNavDirection = e.shiftKey ? tn : "forward");
        }
    }
    const an = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top", on = ".sticky-top", ln = "padding-right", cn = "margin-right";
    class dn {
        constructor() {
            this._element = document.body;
        }
        getWidth() {
            const e = document.documentElement.clientWidth;
            return Math.abs(window.innerWidth - e);
        }
        hide() {
            const e = this.getWidth();
            this._disableOverFlow(), this._setElementAttributes(this._element, ln, (t => t + e)), 
            this._setElementAttributes(an, ln, (t => t + e)), this._setElementAttributes(on, cn, (t => t - e));
        }
        reset() {
            this._resetElementAttributes(this._element, "overflow"), this._resetElementAttributes(this._element, ln), 
            this._resetElementAttributes(an, ln), this._resetElementAttributes(on, cn);
        }
        isOverflowing() {
            return this.getWidth() > 0;
        }
        _disableOverFlow() {
            this._saveInitialAttribute(this._element, "overflow"), this._element.style.overflow = "hidden";
        }
        _setElementAttributes(e, t, i) {
            const n = this.getWidth();
            this._applyManipulationCallback(e, (e => {
                if (e !== this._element && window.innerWidth > e.clientWidth + n) return;
                this._saveInitialAttribute(e, t);
                const s = window.getComputedStyle(e).getPropertyValue(t);
                e.style.setProperty(t, `${i(Number.parseFloat(s))}px`);
            }));
        }
        _saveInitialAttribute(e, t) {
            const i = e.style.getPropertyValue(t);
            i && z.setDataAttribute(e, t, i);
        }
        _resetElementAttributes(e, t) {
            this._applyManipulationCallback(e, (e => {
                const i = z.getDataAttribute(e, t);
                null !== i ? (z.removeDataAttribute(e, t), e.style.setProperty(t, i)) : e.style.removeProperty(t);
            }));
        }
        _applyManipulationCallback(e, t) {
            if (r(e)) t(e); else for (const i of B.find(e, this._element)) t(i);
        }
    }
    const un = ".bs.modal", pn = `hide${un}`, fn = `hidePrevented${un}`, hn = `hidden${un}`, mn = `show${un}`, gn = `shown${un}`, vn = `resize${un}`, yn = `click.dismiss${un}`, bn = `mousedown.dismiss${un}`, wn = `keydown.dismiss${un}`, xn = `click${un}.data-api`, En = "modal-open", _n = "show", Tn = "modal-static", Sn = {
        backdrop: !0,
        focus: !0,
        keyboard: !0
    }, Cn = {
        backdrop: "(boolean|string)",
        focus: "boolean",
        keyboard: "boolean"
    };
    class Mn extends q {
        constructor(e, t) {
            super(e, t), this._dialog = B.findOne(".modal-dialog", this._element), this._backdrop = this._initializeBackDrop(), 
            this._focustrap = this._initializeFocusTrap(), this._isShown = !1, this._isTransitioning = !1, 
            this._scrollBar = new dn, this._addEventListeners();
        }
        static get Default() {
            return Sn;
        }
        static get DefaultType() {
            return Cn;
        }
        static get NAME() {
            return "modal";
        }
        toggle(e) {
            return this._isShown ? this.hide() : this.show(e);
        }
        show(e) {
            if (this._isShown || this._isTransitioning) return;
            I.trigger(this._element, mn, {
                relatedTarget: e
            }).defaultPrevented || (this._isShown = !0, this._isTransitioning = !0, this._scrollBar.hide(), 
            document.body.classList.add(En), this._adjustDialog(), this._backdrop.show((() => this._showElement(e))));
        }
        hide() {
            if (!this._isShown || this._isTransitioning) return;
            I.trigger(this._element, pn).defaultPrevented || (this._isShown = !1, this._isTransitioning = !0, 
            this._focustrap.deactivate(), this._element.classList.remove(_n), this._queueCallback((() => this._hideModal()), this._element, this._isAnimated()));
        }
        dispose() {
            I.off(window, un), I.off(this._dialog, un), this._backdrop.dispose(), this._focustrap.deactivate(), 
            super.dispose();
        }
        handleUpdate() {
            this._adjustDialog();
        }
        _initializeBackDrop() {
            return new Qi({
                isVisible: Boolean(this._config.backdrop),
                isAnimated: this._isAnimated()
            });
        }
        _initializeFocusTrap() {
            return new rn({
                trapElement: this._element
            });
        }
        _showElement(e) {
            document.body.contains(this._element) || document.body.append(this._element), this._element.style.display = "block", 
            this._element.removeAttribute("aria-hidden"), this._element.setAttribute("aria-modal", !0), 
            this._element.setAttribute("role", "dialog"), this._element.scrollTop = 0;
            const t = B.findOne(".modal-body", this._dialog);
            t && (t.scrollTop = 0), u(this._element), this._element.classList.add(_n);
            this._queueCallback((() => {
                this._config.focus && this._focustrap.activate(), this._isTransitioning = !1, I.trigger(this._element, gn, {
                    relatedTarget: e
                });
            }), this._dialog, this._isAnimated());
        }
        _addEventListeners() {
            I.on(this._element, wn, (e => {
                "Escape" === e.key && (this._config.keyboard ? this.hide() : this._triggerBackdropTransition());
            })), I.on(window, vn, (() => {
                this._isShown && !this._isTransitioning && this._adjustDialog();
            })), I.on(this._element, bn, (e => {
                I.one(this._element, yn, (t => {
                    this._element === e.target && this._element === t.target && ("static" !== this._config.backdrop ? this._config.backdrop && this.hide() : this._triggerBackdropTransition());
                }));
            }));
        }
        _hideModal() {
            this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), 
            this._element.removeAttribute("aria-modal"), this._element.removeAttribute("role"), 
            this._isTransitioning = !1, this._backdrop.hide((() => {
                document.body.classList.remove(En), this._resetAdjustments(), this._scrollBar.reset(), 
                I.trigger(this._element, hn);
            }));
        }
        _isAnimated() {
            return this._element.classList.contains("fade");
        }
        _triggerBackdropTransition() {
            if (I.trigger(this._element, fn).defaultPrevented) return;
            const e = this._element.scrollHeight > document.documentElement.clientHeight, t = this._element.style.overflowY;
            "hidden" === t || this._element.classList.contains(Tn) || (e || (this._element.style.overflowY = "hidden"), 
            this._element.classList.add(Tn), this._queueCallback((() => {
                this._element.classList.remove(Tn), this._queueCallback((() => {
                    this._element.style.overflowY = t;
                }), this._dialog);
            }), this._dialog), this._element.focus());
        }
        _adjustDialog() {
            const e = this._element.scrollHeight > document.documentElement.clientHeight, t = this._scrollBar.getWidth(), i = t > 0;
            if (i && !e) {
                const e = h() ? "paddingLeft" : "paddingRight";
                this._element.style[e] = `${t}px`;
            }
            if (!i && e) {
                const e = h() ? "paddingRight" : "paddingLeft";
                this._element.style[e] = `${t}px`;
            }
        }
        _resetAdjustments() {
            this._element.style.paddingLeft = "", this._element.style.paddingRight = "";
        }
        static jQueryInterface(e, t) {
            return this.each((function() {
                const i = Mn.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === i[e]) throw new TypeError(`No method named "${e}"`);
                    i[e](t);
                }
            }));
        }
    }
    I.on(document, xn, '[data-bs-toggle="modal"]', (function(e) {
        const t = B.getElementFromSelector(this);
        [ "A", "AREA" ].includes(this.tagName) && e.preventDefault(), I.one(t, mn, (e => {
            e.defaultPrevented || I.one(t, hn, (() => {
                o(this) && this.focus();
            }));
        }));
        const i = B.findOne(".modal.show");
        i && Mn.getInstance(i).hide();
        Mn.getOrCreateInstance(t).toggle(this);
    })), F(Mn), m(Mn);
    const An = ".bs.offcanvas", kn = ".data-api", Ln = `load${An}${kn}`, Pn = "show", On = "showing", Dn = "hiding", In = ".offcanvas.show", $n = `show${An}`, Nn = `shown${An}`, jn = `hide${An}`, zn = `hidePrevented${An}`, Hn = `hidden${An}`, qn = `resize${An}`, Rn = `click${An}${kn}`, Bn = `keydown.dismiss${An}`, Fn = {
        backdrop: !0,
        keyboard: !0,
        scroll: !1
    }, Wn = {
        backdrop: "(boolean|string)",
        keyboard: "boolean",
        scroll: "boolean"
    };
    class Vn extends q {
        constructor(e, t) {
            super(e, t), this._isShown = !1, this._backdrop = this._initializeBackDrop(), this._focustrap = this._initializeFocusTrap(), 
            this._addEventListeners();
        }
        static get Default() {
            return Fn;
        }
        static get DefaultType() {
            return Wn;
        }
        static get NAME() {
            return "offcanvas";
        }
        toggle(e) {
            return this._isShown ? this.hide() : this.show(e);
        }
        show(e) {
            if (this._isShown) return;
            if (I.trigger(this._element, $n, {
                relatedTarget: e
            }).defaultPrevented) return;
            this._isShown = !0, this._backdrop.show(), this._config.scroll || (new dn).hide(), 
            this._element.setAttribute("aria-modal", !0), this._element.setAttribute("role", "dialog"), 
            this._element.classList.add(On);
            this._queueCallback((() => {
                this._config.scroll && !this._config.backdrop || this._focustrap.activate(), this._element.classList.add(Pn), 
                this._element.classList.remove(On), I.trigger(this._element, Nn, {
                    relatedTarget: e
                });
            }), this._element, !0);
        }
        hide() {
            if (!this._isShown) return;
            if (I.trigger(this._element, jn).defaultPrevented) return;
            this._focustrap.deactivate(), this._element.blur(), this._isShown = !1, this._element.classList.add(Dn), 
            this._backdrop.hide();
            this._queueCallback((() => {
                this._element.classList.remove(Pn, Dn), this._element.removeAttribute("aria-modal"), 
                this._element.removeAttribute("role"), this._config.scroll || (new dn).reset(), 
                I.trigger(this._element, Hn);
            }), this._element, !0);
        }
        dispose() {
            this._backdrop.dispose(), this._focustrap.deactivate(), super.dispose();
        }
        _initializeBackDrop() {
            const e = Boolean(this._config.backdrop);
            return new Qi({
                className: "offcanvas-backdrop",
                isVisible: e,
                isAnimated: !0,
                rootElement: this._element.parentNode,
                clickCallback: e ? () => {
                    "static" !== this._config.backdrop ? this.hide() : I.trigger(this._element, zn);
                } : null
            });
        }
        _initializeFocusTrap() {
            return new rn({
                trapElement: this._element
            });
        }
        _addEventListeners() {
            I.on(this._element, Bn, (e => {
                "Escape" === e.key && (this._config.keyboard ? this.hide() : I.trigger(this._element, zn));
            }));
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = Vn.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e] || e.startsWith("_") || "constructor" === e) throw new TypeError(`No method named "${e}"`);
                    t[e](this);
                }
            }));
        }
    }
    I.on(document, Rn, '[data-bs-toggle="offcanvas"]', (function(e) {
        const t = B.getElementFromSelector(this);
        if ([ "A", "AREA" ].includes(this.tagName) && e.preventDefault(), l(this)) return;
        I.one(t, Hn, (() => {
            o(this) && this.focus();
        }));
        const i = B.findOne(In);
        i && i !== t && Vn.getInstance(i).hide();
        Vn.getOrCreateInstance(t).toggle(this);
    })), I.on(window, Ln, (() => {
        for (const e of B.find(In)) Vn.getOrCreateInstance(e).show();
    })), I.on(window, qn, (() => {
        for (const e of B.find("[aria-modal][class*=show][class*=offcanvas-]")) "fixed" !== getComputedStyle(e).position && Vn.getOrCreateInstance(e).hide();
    })), F(Vn), m(Vn);
    const Xn = {
        "*": [ "class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i ],
        a: [ "target", "href", "title", "rel" ],
        area: [],
        b: [],
        br: [],
        col: [],
        code: [],
        div: [],
        em: [],
        hr: [],
        h1: [],
        h2: [],
        h3: [],
        h4: [],
        h5: [],
        h6: [],
        i: [],
        img: [ "src", "srcset", "alt", "title", "width", "height" ],
        li: [],
        ol: [],
        p: [],
        pre: [],
        s: [],
        small: [],
        span: [],
        sub: [],
        sup: [],
        strong: [],
        u: [],
        ul: []
    }, Gn = new Set([ "background", "cite", "href", "itemtype", "longdesc", "poster", "src", "xlink:href" ]), Yn = /^(?!javascript:)(?:[a-z0-9+.-]+:|[^&:/?#]*(?:[/?#]|$))/i, Un = (e, t) => {
        const i = e.nodeName.toLowerCase();
        return t.includes(i) ? !Gn.has(i) || Boolean(Yn.test(e.nodeValue)) : t.filter((e => e instanceof RegExp)).some((e => e.test(i)));
    };
    const Kn = {
        allowList: Xn,
        content: {},
        extraClass: "",
        html: !1,
        sanitize: !0,
        sanitizeFn: null,
        template: "<div></div>"
    }, Qn = {
        allowList: "object",
        content: "object",
        extraClass: "(string|function)",
        html: "boolean",
        sanitize: "boolean",
        sanitizeFn: "(null|function)",
        template: "string"
    }, Jn = {
        entry: "(string|element|function|null)",
        selector: "(string|element)"
    };
    class Zn extends H {
        constructor(e) {
            super(), this._config = this._getConfig(e);
        }
        static get Default() {
            return Kn;
        }
        static get DefaultType() {
            return Qn;
        }
        static get NAME() {
            return "TemplateFactory";
        }
        getContent() {
            return Object.values(this._config.content).map((e => this._resolvePossibleFunction(e))).filter(Boolean);
        }
        hasContent() {
            return this.getContent().length > 0;
        }
        changeContent(e) {
            return this._checkContent(e), this._config.content = {
                ...this._config.content,
                ...e
            }, this;
        }
        toHtml() {
            const e = document.createElement("div");
            e.innerHTML = this._maybeSanitize(this._config.template);
            for (const [t, i] of Object.entries(this._config.content)) this._setContent(e, i, t);
            const t = e.children[0], i = this._resolvePossibleFunction(this._config.extraClass);
            return i && t.classList.add(...i.split(" ")), t;
        }
        _typeCheckConfig(e) {
            super._typeCheckConfig(e), this._checkContent(e.content);
        }
        _checkContent(e) {
            for (const [t, i] of Object.entries(e)) super._typeCheckConfig({
                selector: t,
                entry: i
            }, Jn);
        }
        _setContent(e, t, i) {
            const n = B.findOne(i, e);
            n && ((t = this._resolvePossibleFunction(t)) ? r(t) ? this._putElementInTemplate(a(t), n) : this._config.html ? n.innerHTML = this._maybeSanitize(t) : n.textContent = t : n.remove());
        }
        _maybeSanitize(e) {
            return this._config.sanitize ? function(e, t, i) {
                if (!e.length) return e;
                if (i && "function" == typeof i) return i(e);
                const n = (new window.DOMParser).parseFromString(e, "text/html"), s = [].concat(...n.body.querySelectorAll("*"));
                for (const e of s) {
                    const i = e.nodeName.toLowerCase();
                    if (!Object.keys(t).includes(i)) {
                        e.remove();
                        continue;
                    }
                    const n = [].concat(...e.attributes), s = [].concat(t["*"] || [], t[i] || []);
                    for (const t of n) Un(t, s) || e.removeAttribute(t.nodeName);
                }
                return n.body.innerHTML;
            }(e, this._config.allowList, this._config.sanitizeFn) : e;
        }
        _resolvePossibleFunction(e) {
            return g(e, [ this ]);
        }
        _putElementInTemplate(e, t) {
            if (this._config.html) return t.innerHTML = "", void t.append(e);
            t.textContent = e.textContent;
        }
    }
    const es = new Set([ "sanitize", "allowList", "sanitizeFn" ]), ts = "fade", is = "show", ns = ".modal", ss = "hide.bs.modal", rs = "hover", as = "focus", os = {
        AUTO: "auto",
        TOP: "top",
        RIGHT: h() ? "left" : "right",
        BOTTOM: "bottom",
        LEFT: h() ? "right" : "left"
    }, ls = {
        allowList: Xn,
        animation: !0,
        boundary: "clippingParents",
        container: !1,
        customClass: "",
        delay: 0,
        fallbackPlacements: [ "top", "right", "bottom", "left" ],
        html: !1,
        offset: [ 0, 6 ],
        placement: "top",
        popperConfig: null,
        sanitize: !0,
        sanitizeFn: null,
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        title: "",
        trigger: "hover focus"
    }, cs = {
        allowList: "object",
        animation: "boolean",
        boundary: "(string|element)",
        container: "(string|element|boolean)",
        customClass: "(string|function)",
        delay: "(number|object)",
        fallbackPlacements: "array",
        html: "boolean",
        offset: "(array|string|function)",
        placement: "(string|function)",
        popperConfig: "(null|object|function)",
        sanitize: "boolean",
        sanitizeFn: "(null|function)",
        selector: "(string|boolean)",
        template: "string",
        title: "(string|element|function)",
        trigger: "string"
    };
    class ds extends q {
        constructor(e, t) {
            if (void 0 === wi) throw new TypeError("Bootstrap's tooltips require Popper (https://popper.js.org)");
            super(e, t), this._isEnabled = !0, this._timeout = 0, this._isHovered = null, this._activeTrigger = {}, 
            this._popper = null, this._templateFactory = null, this._newContent = null, this.tip = null, 
            this._setListeners(), this._config.selector || this._fixTitle();
        }
        static get Default() {
            return ls;
        }
        static get DefaultType() {
            return cs;
        }
        static get NAME() {
            return "tooltip";
        }
        enable() {
            this._isEnabled = !0;
        }
        disable() {
            this._isEnabled = !1;
        }
        toggleEnabled() {
            this._isEnabled = !this._isEnabled;
        }
        toggle() {
            this._isEnabled && (this._activeTrigger.click = !this._activeTrigger.click, this._isShown() ? this._leave() : this._enter());
        }
        dispose() {
            clearTimeout(this._timeout), I.off(this._element.closest(ns), ss, this._hideModalHandler), 
            this._element.getAttribute("data-bs-original-title") && this._element.setAttribute("title", this._element.getAttribute("data-bs-original-title")), 
            this._disposePopper(), super.dispose();
        }
        show() {
            if ("none" === this._element.style.display) throw new Error("Please use show on visible elements");
            if (!this._isWithContent() || !this._isEnabled) return;
            const e = I.trigger(this._element, this.constructor.eventName("show")), t = (c(this._element) || this._element.ownerDocument.documentElement).contains(this._element);
            if (e.defaultPrevented || !t) return;
            this._disposePopper();
            const i = this._getTipElement();
            this._element.setAttribute("aria-describedby", i.getAttribute("id"));
            const {container: n} = this._config;
            if (this._element.ownerDocument.documentElement.contains(this.tip) || (n.append(i), 
            I.trigger(this._element, this.constructor.eventName("inserted"))), this._popper = this._createPopper(i), 
            i.classList.add(is), "ontouchstart" in document.documentElement) for (const e of [].concat(...document.body.children)) I.on(e, "mouseover", d);
            this._queueCallback((() => {
                I.trigger(this._element, this.constructor.eventName("shown")), !1 === this._isHovered && this._leave(), 
                this._isHovered = !1;
            }), this.tip, this._isAnimated());
        }
        hide() {
            if (!this._isShown()) return;
            if (I.trigger(this._element, this.constructor.eventName("hide")).defaultPrevented) return;
            if (this._getTipElement().classList.remove(is), "ontouchstart" in document.documentElement) for (const e of [].concat(...document.body.children)) I.off(e, "mouseover", d);
            this._activeTrigger.click = !1, this._activeTrigger[as] = !1, this._activeTrigger[rs] = !1, 
            this._isHovered = null;
            this._queueCallback((() => {
                this._isWithActiveTrigger() || (this._isHovered || this._disposePopper(), this._element.removeAttribute("aria-describedby"), 
                I.trigger(this._element, this.constructor.eventName("hidden")));
            }), this.tip, this._isAnimated());
        }
        update() {
            this._popper && this._popper.update();
        }
        _isWithContent() {
            return Boolean(this._getTitle());
        }
        _getTipElement() {
            return this.tip || (this.tip = this._createTipElement(this._newContent || this._getContentForTemplate())), 
            this.tip;
        }
        _createTipElement(e) {
            const t = this._getTemplateFactory(e).toHtml();
            if (!t) return null;
            t.classList.remove(ts, is), t.classList.add(`bs-${this.constructor.NAME}-auto`);
            const i = (e => {
                do {
                    e += Math.floor(1e6 * Math.random());
                } while (document.getElementById(e));
                return e;
            })(this.constructor.NAME).toString();
            return t.setAttribute("id", i), this._isAnimated() && t.classList.add(ts), t;
        }
        setContent(e) {
            this._newContent = e, this._isShown() && (this._disposePopper(), this.show());
        }
        _getTemplateFactory(e) {
            return this._templateFactory ? this._templateFactory.changeContent(e) : this._templateFactory = new Zn({
                ...this._config,
                content: e,
                extraClass: this._resolvePossibleFunction(this._config.customClass)
            }), this._templateFactory;
        }
        _getContentForTemplate() {
            return {
                ".tooltip-inner": this._getTitle()
            };
        }
        _getTitle() {
            return this._resolvePossibleFunction(this._config.title) || this._element.getAttribute("data-bs-original-title");
        }
        _initializeOnDelegatedTarget(e) {
            return this.constructor.getOrCreateInstance(e.delegateTarget, this._getDelegateConfig());
        }
        _isAnimated() {
            return this._config.animation || this.tip && this.tip.classList.contains(ts);
        }
        _isShown() {
            return this.tip && this.tip.classList.contains(is);
        }
        _createPopper(e) {
            const t = g(this._config.placement, [ this, e, this._element ]), i = os[t.toUpperCase()];
            return bi(this._element, e, this._getPopperConfig(i));
        }
        _getOffset() {
            const {offset: e} = this._config;
            return "string" == typeof e ? e.split(",").map((e => Number.parseInt(e, 10))) : "function" == typeof e ? t => e(t, this._element) : e;
        }
        _resolvePossibleFunction(e) {
            return g(e, [ this._element ]);
        }
        _getPopperConfig(e) {
            const t = {
                placement: e,
                modifiers: [ {
                    name: "flip",
                    options: {
                        fallbackPlacements: this._config.fallbackPlacements
                    }
                }, {
                    name: "offset",
                    options: {
                        offset: this._getOffset()
                    }
                }, {
                    name: "preventOverflow",
                    options: {
                        boundary: this._config.boundary
                    }
                }, {
                    name: "arrow",
                    options: {
                        element: `.${this.constructor.NAME}-arrow`
                    }
                }, {
                    name: "preSetPlacement",
                    enabled: !0,
                    phase: "beforeMain",
                    fn: e => {
                        this._getTipElement().setAttribute("data-popper-placement", e.state.placement);
                    }
                } ]
            };
            return {
                ...t,
                ...g(this._config.popperConfig, [ t ])
            };
        }
        _setListeners() {
            const e = this._config.trigger.split(" ");
            for (const t of e) if ("click" === t) I.on(this._element, this.constructor.eventName("click"), this._config.selector, (e => {
                this._initializeOnDelegatedTarget(e).toggle();
            })); else if ("manual" !== t) {
                const e = t === rs ? this.constructor.eventName("mouseenter") : this.constructor.eventName("focusin"), i = t === rs ? this.constructor.eventName("mouseleave") : this.constructor.eventName("focusout");
                I.on(this._element, e, this._config.selector, (e => {
                    const t = this._initializeOnDelegatedTarget(e);
                    t._activeTrigger["focusin" === e.type ? as : rs] = !0, t._enter();
                })), I.on(this._element, i, this._config.selector, (e => {
                    const t = this._initializeOnDelegatedTarget(e);
                    t._activeTrigger["focusout" === e.type ? as : rs] = t._element.contains(e.relatedTarget), 
                    t._leave();
                }));
            }
            this._hideModalHandler = () => {
                this._element && this.hide();
            }, I.on(this._element.closest(ns), ss, this._hideModalHandler);
        }
        _fixTitle() {
            const e = this._element.getAttribute("title");
            e && (this._element.getAttribute("aria-label") || this._element.textContent.trim() || this._element.setAttribute("aria-label", e), 
            this._element.setAttribute("data-bs-original-title", e), this._element.removeAttribute("title"));
        }
        _enter() {
            this._isShown() || this._isHovered ? this._isHovered = !0 : (this._isHovered = !0, 
            this._setTimeout((() => {
                this._isHovered && this.show();
            }), this._config.delay.show));
        }
        _leave() {
            this._isWithActiveTrigger() || (this._isHovered = !1, this._setTimeout((() => {
                this._isHovered || this.hide();
            }), this._config.delay.hide));
        }
        _setTimeout(e, t) {
            clearTimeout(this._timeout), this._timeout = setTimeout(e, t);
        }
        _isWithActiveTrigger() {
            return Object.values(this._activeTrigger).includes(!0);
        }
        _getConfig(e) {
            const t = z.getDataAttributes(this._element);
            for (const e of Object.keys(t)) es.has(e) && delete t[e];
            return e = {
                ...t,
                ..."object" == typeof e && e ? e : {}
            }, e = this._mergeConfigObj(e), e = this._configAfterMerge(e), this._typeCheckConfig(e), 
            e;
        }
        _configAfterMerge(e) {
            return e.container = !1 === e.container ? document.body : a(e.container), "number" == typeof e.delay && (e.delay = {
                show: e.delay,
                hide: e.delay
            }), "number" == typeof e.title && (e.title = e.title.toString()), "number" == typeof e.content && (e.content = e.content.toString()), 
            e;
        }
        _getDelegateConfig() {
            const e = {};
            for (const [t, i] of Object.entries(this._config)) this.constructor.Default[t] !== i && (e[t] = i);
            return e.selector = !1, e.trigger = "manual", e;
        }
        _disposePopper() {
            this._popper && (this._popper.destroy(), this._popper = null), this.tip && (this.tip.remove(), 
            this.tip = null);
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = ds.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e]) throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            }));
        }
    }
    m(ds);
    const us = {
        ...ds.Default,
        content: "",
        offset: [ 0, 8 ],
        placement: "right",
        template: '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
        trigger: "click"
    }, ps = {
        ...ds.DefaultType,
        content: "(null|string|element|function)"
    };
    class fs extends ds {
        static get Default() {
            return us;
        }
        static get DefaultType() {
            return ps;
        }
        static get NAME() {
            return "popover";
        }
        _isWithContent() {
            return this._getTitle() || this._getContent();
        }
        _getContentForTemplate() {
            return {
                ".popover-header": this._getTitle(),
                ".popover-body": this._getContent()
            };
        }
        _getContent() {
            return this._resolvePossibleFunction(this._config.content);
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = fs.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e]) throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            }));
        }
    }
    m(fs);
    const hs = ".bs.scrollspy", ms = `activate${hs}`, gs = `click${hs}`, vs = `load${hs}.data-api`, ys = "active", bs = "[href]", ws = ".nav-link", xs = `${ws}, .nav-item > ${ws}, .list-group-item`, Es = {
        offset: null,
        rootMargin: "0px 0px -25%",
        smoothScroll: !1,
        target: null,
        threshold: [ .1, .5, 1 ]
    }, _s = {
        offset: "(number|null)",
        rootMargin: "string",
        smoothScroll: "boolean",
        target: "element",
        threshold: "array"
    };
    class Ts extends q {
        constructor(e, t) {
            super(e, t), this._targetLinks = new Map, this._observableSections = new Map, this._rootElement = "visible" === getComputedStyle(this._element).overflowY ? null : this._element, 
            this._activeTarget = null, this._observer = null, this._previousScrollData = {
                visibleEntryTop: 0,
                parentScrollTop: 0
            }, this.refresh();
        }
        static get Default() {
            return Es;
        }
        static get DefaultType() {
            return _s;
        }
        static get NAME() {
            return "scrollspy";
        }
        refresh() {
            this._initializeTargetsAndObservables(), this._maybeEnableSmoothScroll(), this._observer ? this._observer.disconnect() : this._observer = this._getNewObserver();
            for (const e of this._observableSections.values()) this._observer.observe(e);
        }
        dispose() {
            this._observer.disconnect(), super.dispose();
        }
        _configAfterMerge(e) {
            return e.target = a(e.target) || document.body, e.rootMargin = e.offset ? `${e.offset}px 0px -30%` : e.rootMargin, 
            "string" == typeof e.threshold && (e.threshold = e.threshold.split(",").map((e => Number.parseFloat(e)))), 
            e;
        }
        _maybeEnableSmoothScroll() {
            this._config.smoothScroll && (I.off(this._config.target, gs), I.on(this._config.target, gs, bs, (e => {
                const t = this._observableSections.get(e.target.hash);
                if (t) {
                    e.preventDefault();
                    const i = this._rootElement || window, n = t.offsetTop - this._element.offsetTop;
                    if (i.scrollTo) return void i.scrollTo({
                        top: n,
                        behavior: "smooth"
                    });
                    i.scrollTop = n;
                }
            })));
        }
        _getNewObserver() {
            const e = {
                root: this._rootElement,
                threshold: this._config.threshold,
                rootMargin: this._config.rootMargin
            };
            return new IntersectionObserver((e => this._observerCallback(e)), e);
        }
        _observerCallback(e) {
            const t = e => this._targetLinks.get(`#${e.target.id}`), i = e => {
                this._previousScrollData.visibleEntryTop = e.target.offsetTop, this._process(t(e));
            }, n = (this._rootElement || document.documentElement).scrollTop, s = n >= this._previousScrollData.parentScrollTop;
            this._previousScrollData.parentScrollTop = n;
            for (const r of e) {
                if (!r.isIntersecting) {
                    this._activeTarget = null, this._clearActiveClass(t(r));
                    continue;
                }
                const e = r.target.offsetTop >= this._previousScrollData.visibleEntryTop;
                if (s && e) {
                    if (i(r), !n) return;
                } else s || e || i(r);
            }
        }
        _initializeTargetsAndObservables() {
            this._targetLinks = new Map, this._observableSections = new Map;
            const e = B.find(bs, this._config.target);
            for (const t of e) {
                if (!t.hash || l(t)) continue;
                const e = B.findOne(decodeURI(t.hash), this._element);
                o(e) && (this._targetLinks.set(decodeURI(t.hash), t), this._observableSections.set(t.hash, e));
            }
        }
        _process(e) {
            this._activeTarget !== e && (this._clearActiveClass(this._config.target), this._activeTarget = e, 
            e.classList.add(ys), this._activateParents(e), I.trigger(this._element, ms, {
                relatedTarget: e
            }));
        }
        _activateParents(e) {
            if (e.classList.contains("dropdown-item")) B.findOne(".dropdown-toggle", e.closest(".dropdown")).classList.add(ys); else for (const t of B.parents(e, ".nav, .list-group")) for (const e of B.prev(t, xs)) e.classList.add(ys);
        }
        _clearActiveClass(e) {
            e.classList.remove(ys);
            const t = B.find(`${bs}.${ys}`, e);
            for (const e of t) e.classList.remove(ys);
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = Ts.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e] || e.startsWith("_") || "constructor" === e) throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            }));
        }
    }
    I.on(window, vs, (() => {
        for (const e of B.find('[data-bs-spy="scroll"]')) Ts.getOrCreateInstance(e);
    })), m(Ts);
    const Ss = ".bs.tab", Cs = `hide${Ss}`, Ms = `hidden${Ss}`, As = `show${Ss}`, ks = `shown${Ss}`, Ls = `click${Ss}`, Ps = `keydown${Ss}`, Os = `load${Ss}`, Ds = "ArrowLeft", Is = "ArrowRight", $s = "ArrowUp", Ns = "ArrowDown", js = "Home", zs = "End", Hs = "active", qs = "fade", Rs = "show", Bs = ".dropdown-toggle", Fs = `:not(${Bs})`, Ws = '[data-bs-toggle="tab"], [data-bs-toggle="pill"], [data-bs-toggle="list"]', Vs = `${`.nav-link${Fs}, .list-group-item${Fs}, [role="tab"]${Fs}`}, ${Ws}`, Xs = `.${Hs}[data-bs-toggle="tab"], .${Hs}[data-bs-toggle="pill"], .${Hs}[data-bs-toggle="list"]`;
    class Gs extends q {
        constructor(e) {
            super(e), this._parent = this._element.closest('.list-group, .nav, [role="tablist"]'), 
            this._parent && (this._setInitialAttributes(this._parent, this._getChildren()), 
            I.on(this._element, Ps, (e => this._keydown(e))));
        }
        static get NAME() {
            return "tab";
        }
        show() {
            const e = this._element;
            if (this._elemIsActive(e)) return;
            const t = this._getActiveElem(), i = t ? I.trigger(t, Cs, {
                relatedTarget: e
            }) : null;
            I.trigger(e, As, {
                relatedTarget: t
            }).defaultPrevented || i && i.defaultPrevented || (this._deactivate(t, e), this._activate(e, t));
        }
        _activate(e, t) {
            if (!e) return;
            e.classList.add(Hs), this._activate(B.getElementFromSelector(e));
            this._queueCallback((() => {
                "tab" === e.getAttribute("role") ? (e.removeAttribute("tabindex"), e.setAttribute("aria-selected", !0), 
                this._toggleDropDown(e, !0), I.trigger(e, ks, {
                    relatedTarget: t
                })) : e.classList.add(Rs);
            }), e, e.classList.contains(qs));
        }
        _deactivate(e, t) {
            if (!e) return;
            e.classList.remove(Hs), e.blur(), this._deactivate(B.getElementFromSelector(e));
            this._queueCallback((() => {
                "tab" === e.getAttribute("role") ? (e.setAttribute("aria-selected", !1), e.setAttribute("tabindex", "-1"), 
                this._toggleDropDown(e, !1), I.trigger(e, Ms, {
                    relatedTarget: t
                })) : e.classList.remove(Rs);
            }), e, e.classList.contains(qs));
        }
        _keydown(e) {
            if (![ Ds, Is, $s, Ns, js, zs ].includes(e.key)) return;
            e.stopPropagation(), e.preventDefault();
            const t = this._getChildren().filter((e => !l(e)));
            let i;
            if ([ js, zs ].includes(e.key)) i = t[e.key === js ? 0 : t.length - 1]; else {
                const n = [ Is, Ns ].includes(e.key);
                i = y(t, e.target, n, !0);
            }
            i && (i.focus({
                preventScroll: !0
            }), Gs.getOrCreateInstance(i).show());
        }
        _getChildren() {
            return B.find(Vs, this._parent);
        }
        _getActiveElem() {
            return this._getChildren().find((e => this._elemIsActive(e))) || null;
        }
        _setInitialAttributes(e, t) {
            this._setAttributeIfNotExists(e, "role", "tablist");
            for (const e of t) this._setInitialAttributesOnChild(e);
        }
        _setInitialAttributesOnChild(e) {
            e = this._getInnerElement(e);
            const t = this._elemIsActive(e), i = this._getOuterElement(e);
            e.setAttribute("aria-selected", t), i !== e && this._setAttributeIfNotExists(i, "role", "presentation"), 
            t || e.setAttribute("tabindex", "-1"), this._setAttributeIfNotExists(e, "role", "tab"), 
            this._setInitialAttributesOnTargetPanel(e);
        }
        _setInitialAttributesOnTargetPanel(e) {
            const t = B.getElementFromSelector(e);
            t && (this._setAttributeIfNotExists(t, "role", "tabpanel"), e.id && this._setAttributeIfNotExists(t, "aria-labelledby", `${e.id}`));
        }
        _toggleDropDown(e, t) {
            const i = this._getOuterElement(e);
            if (!i.classList.contains("dropdown")) return;
            const n = (e, n) => {
                const s = B.findOne(e, i);
                s && s.classList.toggle(n, t);
            };
            n(Bs, Hs), n(".dropdown-menu", Rs), i.setAttribute("aria-expanded", t);
        }
        _setAttributeIfNotExists(e, t, i) {
            e.hasAttribute(t) || e.setAttribute(t, i);
        }
        _elemIsActive(e) {
            return e.classList.contains(Hs);
        }
        _getInnerElement(e) {
            return e.matches(Vs) ? e : B.findOne(Vs, e);
        }
        _getOuterElement(e) {
            return e.closest(".nav-item, .list-group-item") || e;
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = Gs.getOrCreateInstance(this);
                if ("string" == typeof e) {
                    if (void 0 === t[e] || e.startsWith("_") || "constructor" === e) throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            }));
        }
    }
    I.on(document, Ls, Ws, (function(e) {
        [ "A", "AREA" ].includes(this.tagName) && e.preventDefault(), l(this) || Gs.getOrCreateInstance(this).show();
    })), I.on(window, Os, (() => {
        for (const e of B.find(Xs)) Gs.getOrCreateInstance(e);
    })), m(Gs);
    const Ys = ".bs.toast", Us = `mouseover${Ys}`, Ks = `mouseout${Ys}`, Qs = `focusin${Ys}`, Js = `focusout${Ys}`, Zs = `hide${Ys}`, er = `hidden${Ys}`, tr = `show${Ys}`, ir = `shown${Ys}`, nr = "hide", sr = "show", rr = "showing", ar = {
        animation: "boolean",
        autohide: "boolean",
        delay: "number"
    }, or = {
        animation: !0,
        autohide: !0,
        delay: 5e3
    };
    class lr extends q {
        constructor(e, t) {
            super(e, t), this._timeout = null, this._hasMouseInteraction = !1, this._hasKeyboardInteraction = !1, 
            this._setListeners();
        }
        static get Default() {
            return or;
        }
        static get DefaultType() {
            return ar;
        }
        static get NAME() {
            return "toast";
        }
        show() {
            if (I.trigger(this._element, tr).defaultPrevented) return;
            this._clearTimeout(), this._config.animation && this._element.classList.add("fade");
            this._element.classList.remove(nr), u(this._element), this._element.classList.add(sr, rr), 
            this._queueCallback((() => {
                this._element.classList.remove(rr), I.trigger(this._element, ir), this._maybeScheduleHide();
            }), this._element, this._config.animation);
        }
        hide() {
            if (!this.isShown()) return;
            if (I.trigger(this._element, Zs).defaultPrevented) return;
            this._element.classList.add(rr), this._queueCallback((() => {
                this._element.classList.add(nr), this._element.classList.remove(rr, sr), I.trigger(this._element, er);
            }), this._element, this._config.animation);
        }
        dispose() {
            this._clearTimeout(), this.isShown() && this._element.classList.remove(sr), super.dispose();
        }
        isShown() {
            return this._element.classList.contains(sr);
        }
        _maybeScheduleHide() {
            this._config.autohide && (this._hasMouseInteraction || this._hasKeyboardInteraction || (this._timeout = setTimeout((() => {
                this.hide();
            }), this._config.delay)));
        }
        _onInteraction(e, t) {
            switch (e.type) {
              case "mouseover":
              case "mouseout":
                this._hasMouseInteraction = t;
                break;

              case "focusin":
              case "focusout":
                this._hasKeyboardInteraction = t;
            }
            if (t) return void this._clearTimeout();
            const i = e.relatedTarget;
            this._element === i || this._element.contains(i) || this._maybeScheduleHide();
        }
        _setListeners() {
            I.on(this._element, Us, (e => this._onInteraction(e, !0))), I.on(this._element, Ks, (e => this._onInteraction(e, !1))), 
            I.on(this._element, Qs, (e => this._onInteraction(e, !0))), I.on(this._element, Js, (e => this._onInteraction(e, !1)));
        }
        _clearTimeout() {
            clearTimeout(this._timeout), this._timeout = null;
        }
        static jQueryInterface(e) {
            return this.each((function() {
                const t = lr.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e]) throw new TypeError(`No method named "${e}"`);
                    t[e](this);
                }
            }));
        }
    }
    F(lr), m(lr);
    return {
        Alert: G,
        Button: U,
        Carousel: Me,
        Collapse: Re,
        Dropdown: Vi,
        Modal: Mn,
        Offcanvas: Vn,
        Popover: fs,
        ScrollSpy: Ts,
        Tab: Gs,
        Toast: lr,
        Tooltip: ds
    };
}));

var Swiper = function() {
    "use strict";
    function e(e) {
        return null !== e && "object" == typeof e && "constructor" in e && e.constructor === Object;
    }
    function t(i, n) {
        void 0 === i && (i = {}), void 0 === n && (n = {}), Object.keys(n).forEach((s => {
            void 0 === i[s] ? i[s] = n[s] : e(n[s]) && e(i[s]) && Object.keys(n[s]).length > 0 && t(i[s], n[s]);
        }));
    }
    const i = {
        body: {},
        addEventListener() {},
        removeEventListener() {},
        activeElement: {
            blur() {},
            nodeName: ""
        },
        querySelector: () => null,
        querySelectorAll: () => [],
        getElementById: () => null,
        createEvent: () => ({
            initEvent() {}
        }),
        createElement: () => ({
            children: [],
            childNodes: [],
            style: {},
            setAttribute() {},
            getElementsByTagName: () => []
        }),
        createElementNS: () => ({}),
        importNode: () => null,
        location: {
            hash: "",
            host: "",
            hostname: "",
            href: "",
            origin: "",
            pathname: "",
            protocol: "",
            search: ""
        }
    };
    function n() {
        const e = "undefined" != typeof document ? document : {};
        return t(e, i), e;
    }
    const s = {
        document: i,
        navigator: {
            userAgent: ""
        },
        location: {
            hash: "",
            host: "",
            hostname: "",
            href: "",
            origin: "",
            pathname: "",
            protocol: "",
            search: ""
        },
        history: {
            replaceState() {},
            pushState() {},
            go() {},
            back() {}
        },
        CustomEvent: function() {
            return this;
        },
        addEventListener() {},
        removeEventListener() {},
        getComputedStyle: () => ({
            getPropertyValue: () => ""
        }),
        Image() {},
        Date() {},
        screen: {},
        setTimeout() {},
        clearTimeout() {},
        matchMedia: () => ({}),
        requestAnimationFrame: e => "undefined" == typeof setTimeout ? (e(), null) : setTimeout(e, 0),
        cancelAnimationFrame(e) {
            "undefined" != typeof setTimeout && clearTimeout(e);
        }
    };
    function r() {
        const e = "undefined" != typeof window ? window : {};
        return t(e, s), e;
    }
    function a(e) {
        return void 0 === e && (e = ""), e.trim().split(" ").filter((e => !!e.trim()));
    }
    function o(e, t) {
        return void 0 === t && (t = 0), setTimeout(e, t);
    }
    function l() {
        return Date.now();
    }
    function c(e, t) {
        void 0 === t && (t = "x");
        const i = r();
        let n, s, a;
        const o = function(e) {
            const t = r();
            let i;
            return t.getComputedStyle && (i = t.getComputedStyle(e, null)), !i && e.currentStyle && (i = e.currentStyle), 
            i || (i = e.style), i;
        }(e);
        return i.WebKitCSSMatrix ? (s = o.transform || o.webkitTransform, s.split(",").length > 6 && (s = s.split(", ").map((e => e.replace(",", "."))).join(", ")), 
        a = new i.WebKitCSSMatrix("none" === s ? "" : s)) : (a = o.MozTransform || o.OTransform || o.MsTransform || o.msTransform || o.transform || o.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,"), 
        n = a.toString().split(",")), "x" === t && (s = i.WebKitCSSMatrix ? a.m41 : 16 === n.length ? parseFloat(n[12]) : parseFloat(n[4])), 
        "y" === t && (s = i.WebKitCSSMatrix ? a.m42 : 16 === n.length ? parseFloat(n[13]) : parseFloat(n[5])), 
        s || 0;
    }
    function d(e) {
        return "object" == typeof e && null !== e && e.constructor && "Object" === Object.prototype.toString.call(e).slice(8, -1);
    }
    function u() {
        const e = Object(arguments.length <= 0 ? void 0 : arguments[0]), t = [ "__proto__", "constructor", "prototype" ];
        for (let n = 1; n < arguments.length; n += 1) {
            const s = n < 0 || arguments.length <= n ? void 0 : arguments[n];
            if (null != s && (i = s, !("undefined" != typeof window && void 0 !== window.HTMLElement ? i instanceof HTMLElement : i && (1 === i.nodeType || 11 === i.nodeType)))) {
                const i = Object.keys(Object(s)).filter((e => t.indexOf(e) < 0));
                for (let t = 0, n = i.length; t < n; t += 1) {
                    const n = i[t], r = Object.getOwnPropertyDescriptor(s, n);
                    void 0 !== r && r.enumerable && (d(e[n]) && d(s[n]) ? s[n].__swiper__ ? e[n] = s[n] : u(e[n], s[n]) : !d(e[n]) && d(s[n]) ? (e[n] = {}, 
                    s[n].__swiper__ ? e[n] = s[n] : u(e[n], s[n])) : e[n] = s[n]);
                }
            }
        }
        var i;
        return e;
    }
    function p(e, t, i) {
        e.style.setProperty(t, i);
    }
    function f(e) {
        let {swiper: t, targetPosition: i, side: n} = e;
        const s = r(), a = -t.translate;
        let o, l = null;
        const c = t.params.speed;
        t.wrapperEl.style.scrollSnapType = "none", s.cancelAnimationFrame(t.cssModeFrameID);
        const d = i > a ? "next" : "prev", u = (e, t) => "next" === d && e >= t || "prev" === d && e <= t, p = () => {
            o = (new Date).getTime(), null === l && (l = o);
            const e = Math.max(Math.min((o - l) / c, 1), 0), r = .5 - Math.cos(e * Math.PI) / 2;
            let d = a + r * (i - a);
            if (u(d, i) && (d = i), t.wrapperEl.scrollTo({
                [n]: d
            }), u(d, i)) return t.wrapperEl.style.overflow = "hidden", t.wrapperEl.style.scrollSnapType = "", 
            setTimeout((() => {
                t.wrapperEl.style.overflow = "", t.wrapperEl.scrollTo({
                    [n]: d
                });
            })), void s.cancelAnimationFrame(t.cssModeFrameID);
            t.cssModeFrameID = s.requestAnimationFrame(p);
        };
        p();
    }
    function h(e) {
        return e.querySelector(".swiper-slide-transform") || e.shadowRoot && e.shadowRoot.querySelector(".swiper-slide-transform") || e;
    }
    function m(e, t) {
        return void 0 === t && (t = ""), [ ...e.children ].filter((e => e.matches(t)));
    }
    function g(e) {
        try {
            return void console.warn(e);
        } catch (e) {}
    }
    function v(e, t) {
        void 0 === t && (t = []);
        const i = document.createElement(e);
        return i.classList.add(...Array.isArray(t) ? t : a(t)), i;
    }
    function y(e) {
        const t = r(), i = n(), s = e.getBoundingClientRect(), a = i.body, o = e.clientTop || a.clientTop || 0, l = e.clientLeft || a.clientLeft || 0, c = e === t ? t.scrollY : e.scrollTop, d = e === t ? t.scrollX : e.scrollLeft;
        return {
            top: s.top + c - o,
            left: s.left + d - l
        };
    }
    function b(e, t) {
        return r().getComputedStyle(e, null).getPropertyValue(t);
    }
    function w(e) {
        let t, i = e;
        if (i) {
            for (t = 0; null !== (i = i.previousSibling); ) 1 === i.nodeType && (t += 1);
            return t;
        }
    }
    function x(e, t) {
        const i = [];
        let n = e.parentElement;
        for (;n; ) t ? n.matches(t) && i.push(n) : i.push(n), n = n.parentElement;
        return i;
    }
    function E(e, t) {
        t && e.addEventListener("transitionend", (function i(n) {
            n.target === e && (t.call(e, n), e.removeEventListener("transitionend", i));
        }));
    }
    function _(e, t, i) {
        const n = r();
        return i ? e["width" === t ? "offsetWidth" : "offsetHeight"] + parseFloat(n.getComputedStyle(e, null).getPropertyValue("width" === t ? "margin-right" : "margin-top")) + parseFloat(n.getComputedStyle(e, null).getPropertyValue("width" === t ? "margin-left" : "margin-bottom")) : e.offsetWidth;
    }
    let T, S, C;
    function M() {
        return T || (T = function() {
            const e = r(), t = n();
            return {
                smoothScroll: t.documentElement && t.documentElement.style && "scrollBehavior" in t.documentElement.style,
                touch: !!("ontouchstart" in e || e.DocumentTouch && t instanceof e.DocumentTouch)
            };
        }()), T;
    }
    function A(e) {
        return void 0 === e && (e = {}), S || (S = function(e) {
            let {userAgent: t} = void 0 === e ? {} : e;
            const i = M(), n = r(), s = n.navigator.platform, a = t || n.navigator.userAgent, o = {
                ios: !1,
                android: !1
            }, l = n.screen.width, c = n.screen.height, d = a.match(/(Android);?[\s\/]+([\d.]+)?/);
            let u = a.match(/(iPad).*OS\s([\d_]+)/);
            const p = a.match(/(iPod)(.*OS\s([\d_]+))?/), f = !u && a.match(/(iPhone\sOS|iOS)\s([\d_]+)/), h = "Win32" === s;
            let m = "MacIntel" === s;
            return !u && m && i.touch && [ "1024x1366", "1366x1024", "834x1194", "1194x834", "834x1112", "1112x834", "768x1024", "1024x768", "820x1180", "1180x820", "810x1080", "1080x810" ].indexOf(`${l}x${c}`) >= 0 && (u = a.match(/(Version)\/([\d.]+)/), 
            u || (u = [ 0, 1, "13_0_0" ]), m = !1), d && !h && (o.os = "android", o.android = !0), 
            (u || f || p) && (o.os = "ios", o.ios = !0), o;
        }(e)), S;
    }
    function k() {
        return C || (C = function() {
            const e = r();
            let t = !1;
            function i() {
                const t = e.navigator.userAgent.toLowerCase();
                return t.indexOf("safari") >= 0 && t.indexOf("chrome") < 0 && t.indexOf("android") < 0;
            }
            if (i()) {
                const i = String(e.navigator.userAgent);
                if (i.includes("Version/")) {
                    const [e, n] = i.split("Version/")[1].split(" ")[0].split(".").map((e => Number(e)));
                    t = e < 16 || 16 === e && n < 2;
                }
            }
            return {
                isSafari: t || i(),
                needPerspectiveFix: t,
                isWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(e.navigator.userAgent)
            };
        }()), C;
    }
    var L = {
        on(e, t, i) {
            const n = this;
            if (!n.eventsListeners || n.destroyed) return n;
            if ("function" != typeof t) return n;
            const s = i ? "unshift" : "push";
            return e.split(" ").forEach((e => {
                n.eventsListeners[e] || (n.eventsListeners[e] = []), n.eventsListeners[e][s](t);
            })), n;
        },
        once(e, t, i) {
            const n = this;
            if (!n.eventsListeners || n.destroyed) return n;
            if ("function" != typeof t) return n;
            function s() {
                n.off(e, s), s.__emitterProxy && delete s.__emitterProxy;
                for (var i = arguments.length, r = new Array(i), a = 0; a < i; a++) r[a] = arguments[a];
                t.apply(n, r);
            }
            return s.__emitterProxy = t, n.on(e, s, i);
        },
        onAny(e, t) {
            const i = this;
            if (!i.eventsListeners || i.destroyed) return i;
            if ("function" != typeof e) return i;
            const n = t ? "unshift" : "push";
            return i.eventsAnyListeners.indexOf(e) < 0 && i.eventsAnyListeners[n](e), i;
        },
        offAny(e) {
            const t = this;
            if (!t.eventsListeners || t.destroyed) return t;
            if (!t.eventsAnyListeners) return t;
            const i = t.eventsAnyListeners.indexOf(e);
            return i >= 0 && t.eventsAnyListeners.splice(i, 1), t;
        },
        off(e, t) {
            const i = this;
            return !i.eventsListeners || i.destroyed ? i : i.eventsListeners ? (e.split(" ").forEach((e => {
                void 0 === t ? i.eventsListeners[e] = [] : i.eventsListeners[e] && i.eventsListeners[e].forEach(((n, s) => {
                    (n === t || n.__emitterProxy && n.__emitterProxy === t) && i.eventsListeners[e].splice(s, 1);
                }));
            })), i) : i;
        },
        emit() {
            const e = this;
            if (!e.eventsListeners || e.destroyed) return e;
            if (!e.eventsListeners) return e;
            let t, i, n;
            for (var s = arguments.length, r = new Array(s), a = 0; a < s; a++) r[a] = arguments[a];
            "string" == typeof r[0] || Array.isArray(r[0]) ? (t = r[0], i = r.slice(1, r.length), 
            n = e) : (t = r[0].events, i = r[0].data, n = r[0].context || e), i.unshift(n);
            return (Array.isArray(t) ? t : t.split(" ")).forEach((t => {
                e.eventsAnyListeners && e.eventsAnyListeners.length && e.eventsAnyListeners.forEach((e => {
                    e.apply(n, [ t, ...i ]);
                })), e.eventsListeners && e.eventsListeners[t] && e.eventsListeners[t].forEach((e => {
                    e.apply(n, i);
                }));
            })), e;
        }
    };
    const P = (e, t) => {
        if (!e || e.destroyed || !e.params) return;
        const i = t.closest(e.isElement ? "swiper-slide" : `.${e.params.slideClass}`);
        if (i) {
            let t = i.querySelector(`.${e.params.lazyPreloaderClass}`);
            !t && e.isElement && (i.shadowRoot ? t = i.shadowRoot.querySelector(`.${e.params.lazyPreloaderClass}`) : requestAnimationFrame((() => {
                i.shadowRoot && (t = i.shadowRoot.querySelector(`.${e.params.lazyPreloaderClass}`), 
                t && t.remove());
            }))), t && t.remove();
        }
    }, O = (e, t) => {
        if (!e.slides[t]) return;
        const i = e.slides[t].querySelector('[loading="lazy"]');
        i && i.removeAttribute("loading");
    }, D = e => {
        if (!e || e.destroyed || !e.params) return;
        let t = e.params.lazyPreloadPrevNext;
        const i = e.slides.length;
        if (!i || !t || t < 0) return;
        t = Math.min(t, i);
        const n = "auto" === e.params.slidesPerView ? e.slidesPerViewDynamic() : Math.ceil(e.params.slidesPerView), s = e.activeIndex;
        if (e.params.grid && e.params.grid.rows > 1) {
            const i = s, r = [ i - t ];
            return r.push(...Array.from({
                length: t
            }).map(((e, t) => i + n + t))), void e.slides.forEach(((t, i) => {
                r.includes(t.column) && O(e, i);
            }));
        }
        const r = s + n - 1;
        if (e.params.rewind || e.params.loop) for (let n = s - t; n <= r + t; n += 1) {
            const t = (n % i + i) % i;
            (t < s || t > r) && O(e, t);
        } else for (let n = Math.max(s - t, 0); n <= Math.min(r + t, i - 1); n += 1) n !== s && (n > r || n < s) && O(e, n);
    };
    var I = {
        updateSize: function() {
            const e = this;
            let t, i;
            const n = e.el;
            t = void 0 !== e.params.width && null !== e.params.width ? e.params.width : n.clientWidth, 
            i = void 0 !== e.params.height && null !== e.params.height ? e.params.height : n.clientHeight, 
            0 === t && e.isHorizontal() || 0 === i && e.isVertical() || (t = t - parseInt(b(n, "padding-left") || 0, 10) - parseInt(b(n, "padding-right") || 0, 10), 
            i = i - parseInt(b(n, "padding-top") || 0, 10) - parseInt(b(n, "padding-bottom") || 0, 10), 
            Number.isNaN(t) && (t = 0), Number.isNaN(i) && (i = 0), Object.assign(e, {
                width: t,
                height: i,
                size: e.isHorizontal() ? t : i
            }));
        },
        updateSlides: function() {
            const e = this;
            function t(t, i) {
                return parseFloat(t.getPropertyValue(e.getDirectionLabel(i)) || 0);
            }
            const i = e.params, {wrapperEl: n, slidesEl: s, size: r, rtlTranslate: a, wrongRTL: o} = e, l = e.virtual && i.virtual.enabled, c = l ? e.virtual.slides.length : e.slides.length, d = m(s, `.${e.params.slideClass}, swiper-slide`), u = l ? e.virtual.slides.length : d.length;
            let f = [];
            const h = [], g = [];
            let v = i.slidesOffsetBefore;
            "function" == typeof v && (v = i.slidesOffsetBefore.call(e));
            let y = i.slidesOffsetAfter;
            "function" == typeof y && (y = i.slidesOffsetAfter.call(e));
            const w = e.snapGrid.length, x = e.slidesGrid.length;
            let E = i.spaceBetween, T = -v, S = 0, C = 0;
            if (void 0 === r) return;
            "string" == typeof E && E.indexOf("%") >= 0 ? E = parseFloat(E.replace("%", "")) / 100 * r : "string" == typeof E && (E = parseFloat(E)), 
            e.virtualSize = -E, d.forEach((e => {
                a ? e.style.marginLeft = "" : e.style.marginRight = "", e.style.marginBottom = "", 
                e.style.marginTop = "";
            })), i.centeredSlides && i.cssMode && (p(n, "--swiper-centered-offset-before", ""), 
            p(n, "--swiper-centered-offset-after", ""));
            const M = i.grid && i.grid.rows > 1 && e.grid;
            let A;
            M ? e.grid.initSlides(d) : e.grid && e.grid.unsetSlides();
            const k = "auto" === i.slidesPerView && i.breakpoints && Object.keys(i.breakpoints).filter((e => void 0 !== i.breakpoints[e].slidesPerView)).length > 0;
            for (let n = 0; n < u; n += 1) {
                let s;
                if (A = 0, d[n] && (s = d[n]), M && e.grid.updateSlide(n, s, d), !d[n] || "none" !== b(s, "display")) {
                    if ("auto" === i.slidesPerView) {
                        k && (d[n].style[e.getDirectionLabel("width")] = "");
                        const r = getComputedStyle(s), a = s.style.transform, o = s.style.webkitTransform;
                        if (a && (s.style.transform = "none"), o && (s.style.webkitTransform = "none"), 
                        i.roundLengths) A = e.isHorizontal() ? _(s, "width", !0) : _(s, "height", !0); else {
                            const e = t(r, "width"), i = t(r, "padding-left"), n = t(r, "padding-right"), a = t(r, "margin-left"), o = t(r, "margin-right"), l = r.getPropertyValue("box-sizing");
                            if (l && "border-box" === l) A = e + a + o; else {
                                const {clientWidth: t, offsetWidth: r} = s;
                                A = e + i + n + a + o + (r - t);
                            }
                        }
                        a && (s.style.transform = a), o && (s.style.webkitTransform = o), i.roundLengths && (A = Math.floor(A));
                    } else A = (r - (i.slidesPerView - 1) * E) / i.slidesPerView, i.roundLengths && (A = Math.floor(A)), 
                    d[n] && (d[n].style[e.getDirectionLabel("width")] = `${A}px`);
                    d[n] && (d[n].swiperSlideSize = A), g.push(A), i.centeredSlides ? (T = T + A / 2 + S / 2 + E, 
                    0 === S && 0 !== n && (T = T - r / 2 - E), 0 === n && (T = T - r / 2 - E), Math.abs(T) < .001 && (T = 0), 
                    i.roundLengths && (T = Math.floor(T)), C % i.slidesPerGroup == 0 && f.push(T), h.push(T)) : (i.roundLengths && (T = Math.floor(T)), 
                    (C - Math.min(e.params.slidesPerGroupSkip, C)) % e.params.slidesPerGroup == 0 && f.push(T), 
                    h.push(T), T = T + A + E), e.virtualSize += A + E, S = A, C += 1;
                }
            }
            if (e.virtualSize = Math.max(e.virtualSize, r) + y, a && o && ("slide" === i.effect || "coverflow" === i.effect) && (n.style.width = `${e.virtualSize + E}px`), 
            i.setWrapperSize && (n.style[e.getDirectionLabel("width")] = `${e.virtualSize + E}px`), 
            M && e.grid.updateWrapperSize(A, f), !i.centeredSlides) {
                const t = [];
                for (let n = 0; n < f.length; n += 1) {
                    let s = f[n];
                    i.roundLengths && (s = Math.floor(s)), f[n] <= e.virtualSize - r && t.push(s);
                }
                f = t, Math.floor(e.virtualSize - r) - Math.floor(f[f.length - 1]) > 1 && f.push(e.virtualSize - r);
            }
            if (l && i.loop) {
                const t = g[0] + E;
                if (i.slidesPerGroup > 1) {
                    const n = Math.ceil((e.virtual.slidesBefore + e.virtual.slidesAfter) / i.slidesPerGroup), s = t * i.slidesPerGroup;
                    for (let e = 0; e < n; e += 1) f.push(f[f.length - 1] + s);
                }
                for (let n = 0; n < e.virtual.slidesBefore + e.virtual.slidesAfter; n += 1) 1 === i.slidesPerGroup && f.push(f[f.length - 1] + t), 
                h.push(h[h.length - 1] + t), e.virtualSize += t;
            }
            if (0 === f.length && (f = [ 0 ]), 0 !== E) {
                const t = e.isHorizontal() && a ? "marginLeft" : e.getDirectionLabel("marginRight");
                d.filter(((e, t) => !(i.cssMode && !i.loop) || t !== d.length - 1)).forEach((e => {
                    e.style[t] = `${E}px`;
                }));
            }
            if (i.centeredSlides && i.centeredSlidesBounds) {
                let e = 0;
                g.forEach((t => {
                    e += t + (E || 0);
                })), e -= E;
                const t = e - r;
                f = f.map((e => e <= 0 ? -v : e > t ? t + y : e));
            }
            if (i.centerInsufficientSlides) {
                let e = 0;
                if (g.forEach((t => {
                    e += t + (E || 0);
                })), e -= E, e < r) {
                    const t = (r - e) / 2;
                    f.forEach(((e, i) => {
                        f[i] = e - t;
                    })), h.forEach(((e, i) => {
                        h[i] = e + t;
                    }));
                }
            }
            if (Object.assign(e, {
                slides: d,
                snapGrid: f,
                slidesGrid: h,
                slidesSizesGrid: g
            }), i.centeredSlides && i.cssMode && !i.centeredSlidesBounds) {
                p(n, "--swiper-centered-offset-before", -f[0] + "px"), p(n, "--swiper-centered-offset-after", e.size / 2 - g[g.length - 1] / 2 + "px");
                const t = -e.snapGrid[0], i = -e.slidesGrid[0];
                e.snapGrid = e.snapGrid.map((e => e + t)), e.slidesGrid = e.slidesGrid.map((e => e + i));
            }
            if (u !== c && e.emit("slidesLengthChange"), f.length !== w && (e.params.watchOverflow && e.checkOverflow(), 
            e.emit("snapGridLengthChange")), h.length !== x && e.emit("slidesGridLengthChange"), 
            i.watchSlidesProgress && e.updateSlidesOffset(), e.emit("slidesUpdated"), !(l || i.cssMode || "slide" !== i.effect && "fade" !== i.effect)) {
                const t = `${i.containerModifierClass}backface-hidden`, n = e.el.classList.contains(t);
                u <= i.maxBackfaceHiddenSlides ? n || e.el.classList.add(t) : n && e.el.classList.remove(t);
            }
        },
        updateAutoHeight: function(e) {
            const t = this, i = [], n = t.virtual && t.params.virtual.enabled;
            let s, r = 0;
            "number" == typeof e ? t.setTransition(e) : !0 === e && t.setTransition(t.params.speed);
            const a = e => n ? t.slides[t.getSlideIndexByData(e)] : t.slides[e];
            if ("auto" !== t.params.slidesPerView && t.params.slidesPerView > 1) if (t.params.centeredSlides) (t.visibleSlides || []).forEach((e => {
                i.push(e);
            })); else for (s = 0; s < Math.ceil(t.params.slidesPerView); s += 1) {
                const e = t.activeIndex + s;
                if (e > t.slides.length && !n) break;
                i.push(a(e));
            } else i.push(a(t.activeIndex));
            for (s = 0; s < i.length; s += 1) if (void 0 !== i[s]) {
                const e = i[s].offsetHeight;
                r = e > r ? e : r;
            }
            (r || 0 === r) && (t.wrapperEl.style.height = `${r}px`);
        },
        updateSlidesOffset: function() {
            const e = this, t = e.slides, i = e.isElement ? e.isHorizontal() ? e.wrapperEl.offsetLeft : e.wrapperEl.offsetTop : 0;
            for (let n = 0; n < t.length; n += 1) t[n].swiperSlideOffset = (e.isHorizontal() ? t[n].offsetLeft : t[n].offsetTop) - i - e.cssOverflowAdjustment();
        },
        updateSlidesProgress: function(e) {
            void 0 === e && (e = this && this.translate || 0);
            const t = this, i = t.params, {slides: n, rtlTranslate: s, snapGrid: r} = t;
            if (0 === n.length) return;
            void 0 === n[0].swiperSlideOffset && t.updateSlidesOffset();
            let a = -e;
            s && (a = e), n.forEach((e => {
                e.classList.remove(i.slideVisibleClass, i.slideFullyVisibleClass);
            })), t.visibleSlidesIndexes = [], t.visibleSlides = [];
            let o = i.spaceBetween;
            "string" == typeof o && o.indexOf("%") >= 0 ? o = parseFloat(o.replace("%", "")) / 100 * t.size : "string" == typeof o && (o = parseFloat(o));
            for (let e = 0; e < n.length; e += 1) {
                const l = n[e];
                let c = l.swiperSlideOffset;
                i.cssMode && i.centeredSlides && (c -= n[0].swiperSlideOffset);
                const d = (a + (i.centeredSlides ? t.minTranslate() : 0) - c) / (l.swiperSlideSize + o), u = (a - r[0] + (i.centeredSlides ? t.minTranslate() : 0) - c) / (l.swiperSlideSize + o), p = -(a - c), f = p + t.slidesSizesGrid[e], h = p >= 0 && p <= t.size - t.slidesSizesGrid[e];
                (p >= 0 && p < t.size - 1 || f > 1 && f <= t.size || p <= 0 && f >= t.size) && (t.visibleSlides.push(l), 
                t.visibleSlidesIndexes.push(e), n[e].classList.add(i.slideVisibleClass)), h && n[e].classList.add(i.slideFullyVisibleClass), 
                l.progress = s ? -d : d, l.originalProgress = s ? -u : u;
            }
        },
        updateProgress: function(e) {
            const t = this;
            if (void 0 === e) {
                const i = t.rtlTranslate ? -1 : 1;
                e = t && t.translate && t.translate * i || 0;
            }
            const i = t.params, n = t.maxTranslate() - t.minTranslate();
            let {progress: s, isBeginning: r, isEnd: a, progressLoop: o} = t;
            const l = r, c = a;
            if (0 === n) s = 0, r = !0, a = !0; else {
                s = (e - t.minTranslate()) / n;
                const i = Math.abs(e - t.minTranslate()) < 1, o = Math.abs(e - t.maxTranslate()) < 1;
                r = i || s <= 0, a = o || s >= 1, i && (s = 0), o && (s = 1);
            }
            if (i.loop) {
                const i = t.getSlideIndexByData(0), n = t.getSlideIndexByData(t.slides.length - 1), s = t.slidesGrid[i], r = t.slidesGrid[n], a = t.slidesGrid[t.slidesGrid.length - 1], l = Math.abs(e);
                o = l >= s ? (l - s) / a : (l + a - r) / a, o > 1 && (o -= 1);
            }
            Object.assign(t, {
                progress: s,
                progressLoop: o,
                isBeginning: r,
                isEnd: a
            }), (i.watchSlidesProgress || i.centeredSlides && i.autoHeight) && t.updateSlidesProgress(e), 
            r && !l && t.emit("reachBeginning toEdge"), a && !c && t.emit("reachEnd toEdge"), 
            (l && !r || c && !a) && t.emit("fromEdge"), t.emit("progress", s);
        },
        updateSlidesClasses: function() {
            const e = this, {slides: t, params: i, slidesEl: n, activeIndex: s} = e, r = e.virtual && i.virtual.enabled, a = e.grid && i.grid && i.grid.rows > 1, o = e => m(n, `.${i.slideClass}${e}, swiper-slide${e}`)[0];
            let l, c, d;
            if (t.forEach((e => {
                e.classList.remove(i.slideActiveClass, i.slideNextClass, i.slidePrevClass);
            })), r) if (i.loop) {
                let t = s - e.virtual.slidesBefore;
                t < 0 && (t = e.virtual.slides.length + t), t >= e.virtual.slides.length && (t -= e.virtual.slides.length), 
                l = o(`[data-swiper-slide-index="${t}"]`);
            } else l = o(`[data-swiper-slide-index="${s}"]`); else a ? (l = t.filter((e => e.column === s))[0], 
            d = t.filter((e => e.column === s + 1))[0], c = t.filter((e => e.column === s - 1))[0]) : l = t[s];
            l && (l.classList.add(i.slideActiveClass), a ? (d && d.classList.add(i.slideNextClass), 
            c && c.classList.add(i.slidePrevClass)) : (d = function(e, t) {
                const i = [];
                for (;e.nextElementSibling; ) {
                    const n = e.nextElementSibling;
                    t ? n.matches(t) && i.push(n) : i.push(n), e = n;
                }
                return i;
            }(l, `.${i.slideClass}, swiper-slide`)[0], i.loop && !d && (d = t[0]), d && d.classList.add(i.slideNextClass), 
            c = function(e, t) {
                const i = [];
                for (;e.previousElementSibling; ) {
                    const n = e.previousElementSibling;
                    t ? n.matches(t) && i.push(n) : i.push(n), e = n;
                }
                return i;
            }(l, `.${i.slideClass}, swiper-slide`)[0], i.loop && 0 === !c && (c = t[t.length - 1]), 
            c && c.classList.add(i.slidePrevClass))), e.emitSlidesClasses();
        },
        updateActiveIndex: function(e) {
            const t = this, i = t.rtlTranslate ? t.translate : -t.translate, {snapGrid: n, params: s, activeIndex: r, realIndex: a, snapIndex: o} = t;
            let l, c = e;
            const d = e => {
                let i = e - t.virtual.slidesBefore;
                return i < 0 && (i = t.virtual.slides.length + i), i >= t.virtual.slides.length && (i -= t.virtual.slides.length), 
                i;
            };
            if (void 0 === c && (c = function(e) {
                const {slidesGrid: t, params: i} = e, n = e.rtlTranslate ? e.translate : -e.translate;
                let s;
                for (let e = 0; e < t.length; e += 1) void 0 !== t[e + 1] ? n >= t[e] && n < t[e + 1] - (t[e + 1] - t[e]) / 2 ? s = e : n >= t[e] && n < t[e + 1] && (s = e + 1) : n >= t[e] && (s = e);
                return i.normalizeSlideIndex && (s < 0 || void 0 === s) && (s = 0), s;
            }(t)), n.indexOf(i) >= 0) l = n.indexOf(i); else {
                const e = Math.min(s.slidesPerGroupSkip, c);
                l = e + Math.floor((c - e) / s.slidesPerGroup);
            }
            if (l >= n.length && (l = n.length - 1), c === r && !t.params.loop) return void (l !== o && (t.snapIndex = l, 
            t.emit("snapIndexChange")));
            if (c === r && t.params.loop && t.virtual && t.params.virtual.enabled) return void (t.realIndex = d(c));
            const u = t.grid && s.grid && s.grid.rows > 1;
            let p;
            if (t.virtual && s.virtual.enabled && s.loop) p = d(c); else if (u) {
                const e = t.slides.filter((e => e.column === c))[0];
                let i = parseInt(e.getAttribute("data-swiper-slide-index"), 10);
                Number.isNaN(i) && (i = Math.max(t.slides.indexOf(e), 0)), p = Math.floor(i / s.grid.rows);
            } else if (t.slides[c]) {
                const e = t.slides[c].getAttribute("data-swiper-slide-index");
                p = e ? parseInt(e, 10) : c;
            } else p = c;
            Object.assign(t, {
                previousSnapIndex: o,
                snapIndex: l,
                previousRealIndex: a,
                realIndex: p,
                previousIndex: r,
                activeIndex: c
            }), t.initialized && D(t), t.emit("activeIndexChange"), t.emit("snapIndexChange"), 
            (t.initialized || t.params.runCallbacksOnInit) && (a !== p && t.emit("realIndexChange"), 
            t.emit("slideChange"));
        },
        updateClickedSlide: function(e, t) {
            const i = this, n = i.params;
            let s = e.closest(`.${n.slideClass}, swiper-slide`);
            !s && i.isElement && t && t.length > 1 && t.includes(e) && [ ...t.slice(t.indexOf(e) + 1, t.length) ].forEach((e => {
                !s && e.matches && e.matches(`.${n.slideClass}, swiper-slide`) && (s = e);
            }));
            let r, a = !1;
            if (s) for (let e = 0; e < i.slides.length; e += 1) if (i.slides[e] === s) {
                a = !0, r = e;
                break;
            }
            if (!s || !a) return i.clickedSlide = void 0, void (i.clickedIndex = void 0);
            i.clickedSlide = s, i.virtual && i.params.virtual.enabled ? i.clickedIndex = parseInt(s.getAttribute("data-swiper-slide-index"), 10) : i.clickedIndex = r, 
            n.slideToClickedSlide && void 0 !== i.clickedIndex && i.clickedIndex !== i.activeIndex && i.slideToClickedSlide();
        }
    };
    var $ = {
        getTranslate: function(e) {
            void 0 === e && (e = this.isHorizontal() ? "x" : "y");
            const {params: t, rtlTranslate: i, translate: n, wrapperEl: s} = this;
            if (t.virtualTranslate) return i ? -n : n;
            if (t.cssMode) return n;
            let r = c(s, e);
            return r += this.cssOverflowAdjustment(), i && (r = -r), r || 0;
        },
        setTranslate: function(e, t) {
            const i = this, {rtlTranslate: n, params: s, wrapperEl: r, progress: a} = i;
            let o, l = 0, c = 0;
            i.isHorizontal() ? l = n ? -e : e : c = e, s.roundLengths && (l = Math.floor(l), 
            c = Math.floor(c)), i.previousTranslate = i.translate, i.translate = i.isHorizontal() ? l : c, 
            s.cssMode ? r[i.isHorizontal() ? "scrollLeft" : "scrollTop"] = i.isHorizontal() ? -l : -c : s.virtualTranslate || (i.isHorizontal() ? l -= i.cssOverflowAdjustment() : c -= i.cssOverflowAdjustment(), 
            r.style.transform = `translate3d(${l}px, ${c}px, 0px)`);
            const d = i.maxTranslate() - i.minTranslate();
            o = 0 === d ? 0 : (e - i.minTranslate()) / d, o !== a && i.updateProgress(e), i.emit("setTranslate", i.translate, t);
        },
        minTranslate: function() {
            return -this.snapGrid[0];
        },
        maxTranslate: function() {
            return -this.snapGrid[this.snapGrid.length - 1];
        },
        translateTo: function(e, t, i, n, s) {
            void 0 === e && (e = 0), void 0 === t && (t = this.params.speed), void 0 === i && (i = !0), 
            void 0 === n && (n = !0);
            const r = this, {params: a, wrapperEl: o} = r;
            if (r.animating && a.preventInteractionOnTransition) return !1;
            const l = r.minTranslate(), c = r.maxTranslate();
            let d;
            if (d = n && e > l ? l : n && e < c ? c : e, r.updateProgress(d), a.cssMode) {
                const e = r.isHorizontal();
                if (0 === t) o[e ? "scrollLeft" : "scrollTop"] = -d; else {
                    if (!r.support.smoothScroll) return f({
                        swiper: r,
                        targetPosition: -d,
                        side: e ? "left" : "top"
                    }), !0;
                    o.scrollTo({
                        [e ? "left" : "top"]: -d,
                        behavior: "smooth"
                    });
                }
                return !0;
            }
            return 0 === t ? (r.setTransition(0), r.setTranslate(d), i && (r.emit("beforeTransitionStart", t, s), 
            r.emit("transitionEnd"))) : (r.setTransition(t), r.setTranslate(d), i && (r.emit("beforeTransitionStart", t, s), 
            r.emit("transitionStart")), r.animating || (r.animating = !0, r.onTranslateToWrapperTransitionEnd || (r.onTranslateToWrapperTransitionEnd = function(e) {
                r && !r.destroyed && e.target === this && (r.wrapperEl.removeEventListener("transitionend", r.onTranslateToWrapperTransitionEnd), 
                r.onTranslateToWrapperTransitionEnd = null, delete r.onTranslateToWrapperTransitionEnd, 
                i && r.emit("transitionEnd"));
            }), r.wrapperEl.addEventListener("transitionend", r.onTranslateToWrapperTransitionEnd))), 
            !0;
        }
    };
    function N(e) {
        let {swiper: t, runCallbacks: i, direction: n, step: s} = e;
        const {activeIndex: r, previousIndex: a} = t;
        let o = n;
        if (o || (o = r > a ? "next" : r < a ? "prev" : "reset"), t.emit(`transition${s}`), 
        i && r !== a) {
            if ("reset" === o) return void t.emit(`slideResetTransition${s}`);
            t.emit(`slideChangeTransition${s}`), "next" === o ? t.emit(`slideNextTransition${s}`) : t.emit(`slidePrevTransition${s}`);
        }
    }
    var j = {
        slideTo: function(e, t, i, n, s) {
            void 0 === e && (e = 0), void 0 === t && (t = this.params.speed), void 0 === i && (i = !0), 
            "string" == typeof e && (e = parseInt(e, 10));
            const r = this;
            let a = e;
            a < 0 && (a = 0);
            const {params: o, snapGrid: l, slidesGrid: c, previousIndex: d, activeIndex: u, rtlTranslate: p, wrapperEl: h, enabled: m} = r;
            if (r.animating && o.preventInteractionOnTransition || !m && !n && !s) return !1;
            const g = Math.min(r.params.slidesPerGroupSkip, a);
            let v = g + Math.floor((a - g) / r.params.slidesPerGroup);
            v >= l.length && (v = l.length - 1);
            const y = -l[v];
            if (o.normalizeSlideIndex) for (let e = 0; e < c.length; e += 1) {
                const t = -Math.floor(100 * y), i = Math.floor(100 * c[e]), n = Math.floor(100 * c[e + 1]);
                void 0 !== c[e + 1] ? t >= i && t < n - (n - i) / 2 ? a = e : t >= i && t < n && (a = e + 1) : t >= i && (a = e);
            }
            if (r.initialized && a !== u) {
                if (!r.allowSlideNext && (p ? y > r.translate && y > r.minTranslate() : y < r.translate && y < r.minTranslate())) return !1;
                if (!r.allowSlidePrev && y > r.translate && y > r.maxTranslate() && (u || 0) !== a) return !1;
            }
            let b;
            if (a !== (d || 0) && i && r.emit("beforeSlideChangeStart"), r.updateProgress(y), 
            b = a > u ? "next" : a < u ? "prev" : "reset", p && -y === r.translate || !p && y === r.translate) return r.updateActiveIndex(a), 
            o.autoHeight && r.updateAutoHeight(), r.updateSlidesClasses(), "slide" !== o.effect && r.setTranslate(y), 
            "reset" !== b && (r.transitionStart(i, b), r.transitionEnd(i, b)), !1;
            if (o.cssMode) {
                const e = r.isHorizontal(), i = p ? y : -y;
                if (0 === t) {
                    const t = r.virtual && r.params.virtual.enabled;
                    t && (r.wrapperEl.style.scrollSnapType = "none", r._immediateVirtual = !0), t && !r._cssModeVirtualInitialSet && r.params.initialSlide > 0 ? (r._cssModeVirtualInitialSet = !0, 
                    requestAnimationFrame((() => {
                        h[e ? "scrollLeft" : "scrollTop"] = i;
                    }))) : h[e ? "scrollLeft" : "scrollTop"] = i, t && requestAnimationFrame((() => {
                        r.wrapperEl.style.scrollSnapType = "", r._immediateVirtual = !1;
                    }));
                } else {
                    if (!r.support.smoothScroll) return f({
                        swiper: r,
                        targetPosition: i,
                        side: e ? "left" : "top"
                    }), !0;
                    h.scrollTo({
                        [e ? "left" : "top"]: i,
                        behavior: "smooth"
                    });
                }
                return !0;
            }
            return r.setTransition(t), r.setTranslate(y), r.updateActiveIndex(a), r.updateSlidesClasses(), 
            r.emit("beforeTransitionStart", t, n), r.transitionStart(i, b), 0 === t ? r.transitionEnd(i, b) : r.animating || (r.animating = !0, 
            r.onSlideToWrapperTransitionEnd || (r.onSlideToWrapperTransitionEnd = function(e) {
                r && !r.destroyed && e.target === this && (r.wrapperEl.removeEventListener("transitionend", r.onSlideToWrapperTransitionEnd), 
                r.onSlideToWrapperTransitionEnd = null, delete r.onSlideToWrapperTransitionEnd, 
                r.transitionEnd(i, b));
            }), r.wrapperEl.addEventListener("transitionend", r.onSlideToWrapperTransitionEnd)), 
            !0;
        },
        slideToLoop: function(e, t, i, n) {
            if (void 0 === e && (e = 0), void 0 === t && (t = this.params.speed), void 0 === i && (i = !0), 
            "string" == typeof e) {
                e = parseInt(e, 10);
            }
            const s = this, r = s.grid && s.params.grid && s.params.grid.rows > 1;
            let a = e;
            if (s.params.loop) if (s.virtual && s.params.virtual.enabled) a += s.virtual.slidesBefore; else {
                let e;
                if (r) {
                    const t = a * s.params.grid.rows;
                    e = s.slides.filter((e => 1 * e.getAttribute("data-swiper-slide-index") === t))[0].column;
                } else e = s.getSlideIndexByData(a);
                const t = r ? Math.ceil(s.slides.length / s.params.grid.rows) : s.slides.length, {centeredSlides: i} = s.params;
                let n = s.params.slidesPerView;
                "auto" === n ? n = s.slidesPerViewDynamic() : (n = Math.ceil(parseFloat(s.params.slidesPerView, 10)), 
                i && n % 2 == 0 && (n += 1));
                let o = t - e < n;
                if (i && (o = o || e < Math.ceil(n / 2)), o) {
                    const n = i ? e < s.activeIndex ? "prev" : "next" : e - s.activeIndex - 1 < s.params.slidesPerView ? "next" : "prev";
                    s.loopFix({
                        direction: n,
                        slideTo: !0,
                        activeSlideIndex: "next" === n ? e + 1 : e - t + 1,
                        slideRealIndex: "next" === n ? s.realIndex : void 0
                    });
                }
                if (r) {
                    const e = a * s.params.grid.rows;
                    a = s.slides.filter((t => 1 * t.getAttribute("data-swiper-slide-index") === e))[0].column;
                } else a = s.getSlideIndexByData(a);
            }
            return requestAnimationFrame((() => {
                s.slideTo(a, t, i, n);
            })), s;
        },
        slideNext: function(e, t, i) {
            void 0 === e && (e = this.params.speed), void 0 === t && (t = !0);
            const n = this, {enabled: s, params: r, animating: a} = n;
            if (!s) return n;
            let o = r.slidesPerGroup;
            "auto" === r.slidesPerView && 1 === r.slidesPerGroup && r.slidesPerGroupAuto && (o = Math.max(n.slidesPerViewDynamic("current", !0), 1));
            const l = n.activeIndex < r.slidesPerGroupSkip ? 1 : o, c = n.virtual && r.virtual.enabled;
            if (r.loop) {
                if (a && !c && r.loopPreventsSliding) return !1;
                if (n.loopFix({
                    direction: "next"
                }), n._clientLeft = n.wrapperEl.clientLeft, n.activeIndex === n.slides.length - 1 && r.cssMode) return requestAnimationFrame((() => {
                    n.slideTo(n.activeIndex + l, e, t, i);
                })), !0;
            }
            return r.rewind && n.isEnd ? n.slideTo(0, e, t, i) : n.slideTo(n.activeIndex + l, e, t, i);
        },
        slidePrev: function(e, t, i) {
            void 0 === e && (e = this.params.speed), void 0 === t && (t = !0);
            const n = this, {params: s, snapGrid: r, slidesGrid: a, rtlTranslate: o, enabled: l, animating: c} = n;
            if (!l) return n;
            const d = n.virtual && s.virtual.enabled;
            if (s.loop) {
                if (c && !d && s.loopPreventsSliding) return !1;
                n.loopFix({
                    direction: "prev"
                }), n._clientLeft = n.wrapperEl.clientLeft;
            }
            function u(e) {
                return e < 0 ? -Math.floor(Math.abs(e)) : Math.floor(e);
            }
            const p = u(o ? n.translate : -n.translate), f = r.map((e => u(e)));
            let h = r[f.indexOf(p) - 1];
            if (void 0 === h && s.cssMode) {
                let e;
                r.forEach(((t, i) => {
                    p >= t && (e = i);
                })), void 0 !== e && (h = r[e > 0 ? e - 1 : e]);
            }
            let m = 0;
            if (void 0 !== h && (m = a.indexOf(h), m < 0 && (m = n.activeIndex - 1), "auto" === s.slidesPerView && 1 === s.slidesPerGroup && s.slidesPerGroupAuto && (m = m - n.slidesPerViewDynamic("previous", !0) + 1, 
            m = Math.max(m, 0))), s.rewind && n.isBeginning) {
                const s = n.params.virtual && n.params.virtual.enabled && n.virtual ? n.virtual.slides.length - 1 : n.slides.length - 1;
                return n.slideTo(s, e, t, i);
            }
            return s.loop && 0 === n.activeIndex && s.cssMode ? (requestAnimationFrame((() => {
                n.slideTo(m, e, t, i);
            })), !0) : n.slideTo(m, e, t, i);
        },
        slideReset: function(e, t, i) {
            return void 0 === e && (e = this.params.speed), void 0 === t && (t = !0), this.slideTo(this.activeIndex, e, t, i);
        },
        slideToClosest: function(e, t, i, n) {
            void 0 === e && (e = this.params.speed), void 0 === t && (t = !0), void 0 === n && (n = .5);
            const s = this;
            let r = s.activeIndex;
            const a = Math.min(s.params.slidesPerGroupSkip, r), o = a + Math.floor((r - a) / s.params.slidesPerGroup), l = s.rtlTranslate ? s.translate : -s.translate;
            if (l >= s.snapGrid[o]) {
                const e = s.snapGrid[o];
                l - e > (s.snapGrid[o + 1] - e) * n && (r += s.params.slidesPerGroup);
            } else {
                const e = s.snapGrid[o - 1];
                l - e <= (s.snapGrid[o] - e) * n && (r -= s.params.slidesPerGroup);
            }
            return r = Math.max(r, 0), r = Math.min(r, s.slidesGrid.length - 1), s.slideTo(r, e, t, i);
        },
        slideToClickedSlide: function() {
            const e = this, {params: t, slidesEl: i} = e, n = "auto" === t.slidesPerView ? e.slidesPerViewDynamic() : t.slidesPerView;
            let s, r = e.clickedIndex;
            const a = e.isElement ? "swiper-slide" : `.${t.slideClass}`;
            if (t.loop) {
                if (e.animating) return;
                s = parseInt(e.clickedSlide.getAttribute("data-swiper-slide-index"), 10), t.centeredSlides ? r < e.loopedSlides - n / 2 || r > e.slides.length - e.loopedSlides + n / 2 ? (e.loopFix(), 
                r = e.getSlideIndex(m(i, `${a}[data-swiper-slide-index="${s}"]`)[0]), o((() => {
                    e.slideTo(r);
                }))) : e.slideTo(r) : r > e.slides.length - n ? (e.loopFix(), r = e.getSlideIndex(m(i, `${a}[data-swiper-slide-index="${s}"]`)[0]), 
                o((() => {
                    e.slideTo(r);
                }))) : e.slideTo(r);
            } else e.slideTo(r);
        }
    };
    var z = {
        loopCreate: function(e) {
            const t = this, {params: i, slidesEl: n} = t;
            if (!i.loop || t.virtual && t.params.virtual.enabled) return;
            const s = () => {
                m(n, `.${i.slideClass}, swiper-slide`).forEach(((e, t) => {
                    e.setAttribute("data-swiper-slide-index", t);
                }));
            }, r = t.grid && i.grid && i.grid.rows > 1, a = i.slidesPerGroup * (r ? i.grid.rows : 1), o = t.slides.length % a != 0, l = r && t.slides.length % i.grid.rows != 0, c = e => {
                for (let n = 0; n < e; n += 1) {
                    const e = t.isElement ? v("swiper-slide", [ i.slideBlankClass ]) : v("div", [ i.slideClass, i.slideBlankClass ]);
                    t.slidesEl.append(e);
                }
            };
            if (o) {
                if (i.loopAddBlankSlides) {
                    c(a - t.slides.length % a), t.recalcSlides(), t.updateSlides();
                } else g("Swiper Loop Warning: The number of slides is not even to slidesPerGroup, loop mode may not function properly. You need to add more slides (or make duplicates, or empty slides)");
                s();
            } else if (l) {
                if (i.loopAddBlankSlides) {
                    c(i.grid.rows - t.slides.length % i.grid.rows), t.recalcSlides(), t.updateSlides();
                } else g("Swiper Loop Warning: The number of slides is not even to grid.rows, loop mode may not function properly. You need to add more slides (or make duplicates, or empty slides)");
                s();
            } else s();
            t.loopFix({
                slideRealIndex: e,
                direction: i.centeredSlides ? void 0 : "next"
            });
        },
        loopFix: function(e) {
            let {slideRealIndex: t, slideTo: i = !0, direction: n, setTranslate: s, activeSlideIndex: r, byController: a, byMousewheel: o} = void 0 === e ? {} : e;
            const l = this;
            if (!l.params.loop) return;
            l.emit("beforeLoopFix");
            const {slides: c, allowSlidePrev: d, allowSlideNext: u, slidesEl: p, params: f} = l, {centeredSlides: h} = f;
            if (l.allowSlidePrev = !0, l.allowSlideNext = !0, l.virtual && f.virtual.enabled) return i && (f.centeredSlides || 0 !== l.snapIndex ? f.centeredSlides && l.snapIndex < f.slidesPerView ? l.slideTo(l.virtual.slides.length + l.snapIndex, 0, !1, !0) : l.snapIndex === l.snapGrid.length - 1 && l.slideTo(l.virtual.slidesBefore, 0, !1, !0) : l.slideTo(l.virtual.slides.length, 0, !1, !0)), 
            l.allowSlidePrev = d, l.allowSlideNext = u, void l.emit("loopFix");
            let m = f.slidesPerView;
            "auto" === m ? m = l.slidesPerViewDynamic() : (m = Math.ceil(parseFloat(f.slidesPerView, 10)), 
            h && m % 2 == 0 && (m += 1));
            const v = f.slidesPerGroupAuto ? m : f.slidesPerGroup;
            let y = v;
            y % v != 0 && (y += v - y % v), y += f.loopAdditionalSlides, l.loopedSlides = y;
            const b = l.grid && f.grid && f.grid.rows > 1;
            c.length < m + y ? g("Swiper Loop Warning: The number of slides is not enough for loop mode, it will be disabled and not function properly. You need to add more slides (or make duplicates) or lower the values of slidesPerView and slidesPerGroup parameters") : b && "row" === f.grid.fill && g("Swiper Loop Warning: Loop mode is not compatible with grid.fill = `row`");
            const w = [], x = [];
            let E = l.activeIndex;
            void 0 === r ? r = l.getSlideIndex(c.filter((e => e.classList.contains(f.slideActiveClass)))[0]) : E = r;
            const _ = "next" === n || !n, T = "prev" === n || !n;
            let S = 0, C = 0;
            const M = b ? Math.ceil(c.length / f.grid.rows) : c.length, A = (b ? c[r].column : r) + (h && void 0 === s ? -m / 2 + .5 : 0);
            if (A < y) {
                S = Math.max(y - A, v);
                for (let e = 0; e < y - A; e += 1) {
                    const t = e - Math.floor(e / M) * M;
                    if (b) {
                        const e = M - t - 1;
                        for (let t = c.length - 1; t >= 0; t -= 1) c[t].column === e && w.push(t);
                    } else w.push(M - t - 1);
                }
            } else if (A + m > M - y) {
                C = Math.max(A - (M - 2 * y), v);
                for (let e = 0; e < C; e += 1) {
                    const t = e - Math.floor(e / M) * M;
                    b ? c.forEach(((e, i) => {
                        e.column === t && x.push(i);
                    })) : x.push(t);
                }
            }
            if (l.__preventObserver__ = !0, requestAnimationFrame((() => {
                l.__preventObserver__ = !1;
            })), T && w.forEach((e => {
                c[e].swiperLoopMoveDOM = !0, p.prepend(c[e]), c[e].swiperLoopMoveDOM = !1;
            })), _ && x.forEach((e => {
                c[e].swiperLoopMoveDOM = !0, p.append(c[e]), c[e].swiperLoopMoveDOM = !1;
            })), l.recalcSlides(), "auto" === f.slidesPerView ? l.updateSlides() : b && (w.length > 0 && T || x.length > 0 && _) && l.slides.forEach(((e, t) => {
                l.grid.updateSlide(t, e, l.slides);
            })), f.watchSlidesProgress && l.updateSlidesOffset(), i) if (w.length > 0 && T) {
                if (void 0 === t) {
                    const e = l.slidesGrid[E], t = l.slidesGrid[E + S] - e;
                    o ? l.setTranslate(l.translate - t) : (l.slideTo(E + S, 0, !1, !0), s && (l.touchEventsData.startTranslate = l.touchEventsData.startTranslate - t, 
                    l.touchEventsData.currentTranslate = l.touchEventsData.currentTranslate - t));
                } else if (s) {
                    const e = b ? w.length / f.grid.rows : w.length;
                    l.slideTo(l.activeIndex + e, 0, !1, !0), l.touchEventsData.currentTranslate = l.translate;
                }
            } else if (x.length > 0 && _) if (void 0 === t) {
                const e = l.slidesGrid[E], t = l.slidesGrid[E - C] - e;
                o ? l.setTranslate(l.translate - t) : (l.slideTo(E - C, 0, !1, !0), s && (l.touchEventsData.startTranslate = l.touchEventsData.startTranslate - t, 
                l.touchEventsData.currentTranslate = l.touchEventsData.currentTranslate - t));
            } else {
                const e = b ? x.length / f.grid.rows : x.length;
                l.slideTo(l.activeIndex - e, 0, !1, !0);
            }
            if (l.allowSlidePrev = d, l.allowSlideNext = u, l.controller && l.controller.control && !a) {
                const e = {
                    slideRealIndex: t,
                    direction: n,
                    setTranslate: s,
                    activeSlideIndex: r,
                    byController: !0
                };
                Array.isArray(l.controller.control) ? l.controller.control.forEach((t => {
                    !t.destroyed && t.params.loop && t.loopFix({
                        ...e,
                        slideTo: t.params.slidesPerView === f.slidesPerView && i
                    });
                })) : l.controller.control instanceof l.constructor && l.controller.control.params.loop && l.controller.control.loopFix({
                    ...e,
                    slideTo: l.controller.control.params.slidesPerView === f.slidesPerView && i
                });
            }
            l.emit("loopFix");
        },
        loopDestroy: function() {
            const e = this, {params: t, slidesEl: i} = e;
            if (!t.loop || e.virtual && e.params.virtual.enabled) return;
            e.recalcSlides();
            const n = [];
            e.slides.forEach((e => {
                const t = void 0 === e.swiperSlideIndex ? 1 * e.getAttribute("data-swiper-slide-index") : e.swiperSlideIndex;
                n[t] = e;
            })), e.slides.forEach((e => {
                e.removeAttribute("data-swiper-slide-index");
            })), n.forEach((e => {
                i.append(e);
            })), e.recalcSlides(), e.slideTo(e.realIndex, 0);
        }
    };
    function H(e, t, i) {
        const n = r(), {params: s} = e, a = s.edgeSwipeDetection, o = s.edgeSwipeThreshold;
        return !a || !(i <= o || i >= n.innerWidth - o) || "prevent" === a && (t.preventDefault(), 
        !0);
    }
    function q(e) {
        const t = this, i = n();
        let s = e;
        s.originalEvent && (s = s.originalEvent);
        const a = t.touchEventsData;
        if ("pointerdown" === s.type) {
            if (null !== a.pointerId && a.pointerId !== s.pointerId) return;
            a.pointerId = s.pointerId;
        } else "touchstart" === s.type && 1 === s.targetTouches.length && (a.touchId = s.targetTouches[0].identifier);
        if ("touchstart" === s.type) return void H(t, s, s.targetTouches[0].pageX);
        const {params: o, touches: c, enabled: d} = t;
        if (!d) return;
        if (!o.simulateTouch && "mouse" === s.pointerType) return;
        if (t.animating && o.preventInteractionOnTransition) return;
        !t.animating && o.cssMode && o.loop && t.loopFix();
        let u = s.target;
        if ("wrapper" === o.touchEventsTarget && !t.wrapperEl.contains(u)) return;
        if ("which" in s && 3 === s.which) return;
        if ("button" in s && s.button > 0) return;
        if (a.isTouched && a.isMoved) return;
        const p = !!o.noSwipingClass && "" !== o.noSwipingClass, f = s.composedPath ? s.composedPath() : s.path;
        p && s.target && s.target.shadowRoot && f && (u = f[0]);
        const h = o.noSwipingSelector ? o.noSwipingSelector : `.${o.noSwipingClass}`, m = !(!s.target || !s.target.shadowRoot);
        if (o.noSwiping && (m ? function(e, t) {
            return void 0 === t && (t = this), function t(i) {
                if (!i || i === n() || i === r()) return null;
                i.assignedSlot && (i = i.assignedSlot);
                const s = i.closest(e);
                return s || i.getRootNode ? s || t(i.getRootNode().host) : null;
            }(t);
        }(h, u) : u.closest(h))) return void (t.allowClick = !0);
        if (o.swipeHandler && !u.closest(o.swipeHandler)) return;
        c.currentX = s.pageX, c.currentY = s.pageY;
        const g = c.currentX, v = c.currentY;
        if (!H(t, s, g)) return;
        Object.assign(a, {
            isTouched: !0,
            isMoved: !1,
            allowTouchCallbacks: !0,
            isScrolling: void 0,
            startMoving: void 0
        }), c.startX = g, c.startY = v, a.touchStartTime = l(), t.allowClick = !0, t.updateSize(), 
        t.swipeDirection = void 0, o.threshold > 0 && (a.allowThresholdMove = !1);
        let y = !0;
        u.matches(a.focusableElements) && (y = !1, "SELECT" === u.nodeName && (a.isTouched = !1)), 
        i.activeElement && i.activeElement.matches(a.focusableElements) && i.activeElement !== u && i.activeElement.blur();
        const b = y && t.allowTouchMove && o.touchStartPreventDefault;
        !o.touchStartForcePreventDefault && !b || u.isContentEditable || s.preventDefault(), 
        o.freeMode && o.freeMode.enabled && t.freeMode && t.animating && !o.cssMode && t.freeMode.onTouchStart(), 
        t.emit("touchStart", s);
    }
    function R(e) {
        const t = n(), i = this, s = i.touchEventsData, {params: r, touches: a, rtlTranslate: o, enabled: c} = i;
        if (!c) return;
        if (!r.simulateTouch && "mouse" === e.pointerType) return;
        let d, u = e;
        if (u.originalEvent && (u = u.originalEvent), "pointermove" === u.type) {
            if (null !== s.touchId) return;
            if (u.pointerId !== s.pointerId) return;
        }
        if ("touchmove" === u.type) {
            if (d = [ ...u.changedTouches ].filter((e => e.identifier === s.touchId))[0], !d || d.identifier !== s.touchId) return;
        } else d = u;
        if (!s.isTouched) return void (s.startMoving && s.isScrolling && i.emit("touchMoveOpposite", u));
        const p = d.pageX, f = d.pageY;
        if (u.preventedByNestedSwiper) return a.startX = p, void (a.startY = f);
        if (!i.allowTouchMove) return u.target.matches(s.focusableElements) || (i.allowClick = !1), 
        void (s.isTouched && (Object.assign(a, {
            startX: p,
            startY: f,
            currentX: p,
            currentY: f
        }), s.touchStartTime = l()));
        if (r.touchReleaseOnEdges && !r.loop) if (i.isVertical()) {
            if (f < a.startY && i.translate <= i.maxTranslate() || f > a.startY && i.translate >= i.minTranslate()) return s.isTouched = !1, 
            void (s.isMoved = !1);
        } else if (p < a.startX && i.translate <= i.maxTranslate() || p > a.startX && i.translate >= i.minTranslate()) return;
        if (t.activeElement && u.target === t.activeElement && u.target.matches(s.focusableElements)) return s.isMoved = !0, 
        void (i.allowClick = !1);
        s.allowTouchCallbacks && i.emit("touchMove", u), a.previousX = a.currentX, a.previousY = a.currentY, 
        a.currentX = p, a.currentY = f;
        const h = a.currentX - a.startX, m = a.currentY - a.startY;
        if (i.params.threshold && Math.sqrt(h ** 2 + m ** 2) < i.params.threshold) return;
        if (void 0 === s.isScrolling) {
            let e;
            i.isHorizontal() && a.currentY === a.startY || i.isVertical() && a.currentX === a.startX ? s.isScrolling = !1 : h * h + m * m >= 25 && (e = 180 * Math.atan2(Math.abs(m), Math.abs(h)) / Math.PI, 
            s.isScrolling = i.isHorizontal() ? e > r.touchAngle : 90 - e > r.touchAngle);
        }
        if (s.isScrolling && i.emit("touchMoveOpposite", u), void 0 === s.startMoving && (a.currentX === a.startX && a.currentY === a.startY || (s.startMoving = !0)), 
        s.isScrolling) return void (s.isTouched = !1);
        if (!s.startMoving) return;
        i.allowClick = !1, !r.cssMode && u.cancelable && u.preventDefault(), r.touchMoveStopPropagation && !r.nested && u.stopPropagation();
        let g = i.isHorizontal() ? h : m, v = i.isHorizontal() ? a.currentX - a.previousX : a.currentY - a.previousY;
        r.oneWayMovement && (g = Math.abs(g) * (o ? 1 : -1), v = Math.abs(v) * (o ? 1 : -1)), 
        a.diff = g, g *= r.touchRatio, o && (g = -g, v = -v);
        const y = i.touchesDirection;
        i.swipeDirection = g > 0 ? "prev" : "next", i.touchesDirection = v > 0 ? "prev" : "next";
        const b = i.params.loop && !r.cssMode, w = "next" === i.touchesDirection && i.allowSlideNext || "prev" === i.touchesDirection && i.allowSlidePrev;
        if (!s.isMoved) {
            if (b && w && i.loopFix({
                direction: i.swipeDirection
            }), s.startTranslate = i.getTranslate(), i.setTransition(0), i.animating) {
                const e = new window.CustomEvent("transitionend", {
                    bubbles: !0,
                    cancelable: !0
                });
                i.wrapperEl.dispatchEvent(e);
            }
            s.allowMomentumBounce = !1, !r.grabCursor || !0 !== i.allowSlideNext && !0 !== i.allowSlidePrev || i.setGrabCursor(!0), 
            i.emit("sliderFirstMove", u);
        }
        if ((new Date).getTime(), s.isMoved && s.allowThresholdMove && y !== i.touchesDirection && b && w && Math.abs(g) >= 1) return Object.assign(a, {
            startX: p,
            startY: f,
            currentX: p,
            currentY: f,
            startTranslate: s.currentTranslate
        }), s.loopSwapReset = !0, void (s.startTranslate = s.currentTranslate);
        i.emit("sliderMove", u), s.isMoved = !0, s.currentTranslate = g + s.startTranslate;
        let x = !0, E = r.resistanceRatio;
        if (r.touchReleaseOnEdges && (E = 0), g > 0 ? (b && w && s.allowThresholdMove && s.currentTranslate > (r.centeredSlides ? i.minTranslate() - i.slidesSizesGrid[i.activeIndex + 1] : i.minTranslate()) && i.loopFix({
            direction: "prev",
            setTranslate: !0,
            activeSlideIndex: 0
        }), s.currentTranslate > i.minTranslate() && (x = !1, r.resistance && (s.currentTranslate = i.minTranslate() - 1 + (-i.minTranslate() + s.startTranslate + g) ** E))) : g < 0 && (b && w && s.allowThresholdMove && s.currentTranslate < (r.centeredSlides ? i.maxTranslate() + i.slidesSizesGrid[i.slidesSizesGrid.length - 1] : i.maxTranslate()) && i.loopFix({
            direction: "next",
            setTranslate: !0,
            activeSlideIndex: i.slides.length - ("auto" === r.slidesPerView ? i.slidesPerViewDynamic() : Math.ceil(parseFloat(r.slidesPerView, 10)))
        }), s.currentTranslate < i.maxTranslate() && (x = !1, r.resistance && (s.currentTranslate = i.maxTranslate() + 1 - (i.maxTranslate() - s.startTranslate - g) ** E))), 
        x && (u.preventedByNestedSwiper = !0), !i.allowSlideNext && "next" === i.swipeDirection && s.currentTranslate < s.startTranslate && (s.currentTranslate = s.startTranslate), 
        !i.allowSlidePrev && "prev" === i.swipeDirection && s.currentTranslate > s.startTranslate && (s.currentTranslate = s.startTranslate), 
        i.allowSlidePrev || i.allowSlideNext || (s.currentTranslate = s.startTranslate), 
        r.threshold > 0) {
            if (!(Math.abs(g) > r.threshold || s.allowThresholdMove)) return void (s.currentTranslate = s.startTranslate);
            if (!s.allowThresholdMove) return s.allowThresholdMove = !0, a.startX = a.currentX, 
            a.startY = a.currentY, s.currentTranslate = s.startTranslate, void (a.diff = i.isHorizontal() ? a.currentX - a.startX : a.currentY - a.startY);
        }
        r.followFinger && !r.cssMode && ((r.freeMode && r.freeMode.enabled && i.freeMode || r.watchSlidesProgress) && (i.updateActiveIndex(), 
        i.updateSlidesClasses()), r.freeMode && r.freeMode.enabled && i.freeMode && i.freeMode.onTouchMove(), 
        i.updateProgress(s.currentTranslate), i.setTranslate(s.currentTranslate));
    }
    function B(e) {
        const t = this, i = t.touchEventsData;
        let n, s = e;
        s.originalEvent && (s = s.originalEvent);
        if ("touchend" === s.type || "touchcancel" === s.type) {
            if (n = [ ...s.changedTouches ].filter((e => e.identifier === i.touchId))[0], !n || n.identifier !== i.touchId) return;
        } else {
            if (null !== i.touchId) return;
            if (s.pointerId !== i.pointerId) return;
            n = s;
        }
        if ([ "pointercancel", "pointerout", "pointerleave", "contextmenu" ].includes(s.type)) {
            if (!([ "pointercancel", "contextmenu" ].includes(s.type) && (t.browser.isSafari || t.browser.isWebView))) return;
        }
        i.pointerId = null, i.touchId = null;
        const {params: r, touches: a, rtlTranslate: c, slidesGrid: d, enabled: u} = t;
        if (!u) return;
        if (!r.simulateTouch && "mouse" === s.pointerType) return;
        if (i.allowTouchCallbacks && t.emit("touchEnd", s), i.allowTouchCallbacks = !1, 
        !i.isTouched) return i.isMoved && r.grabCursor && t.setGrabCursor(!1), i.isMoved = !1, 
        void (i.startMoving = !1);
        r.grabCursor && i.isMoved && i.isTouched && (!0 === t.allowSlideNext || !0 === t.allowSlidePrev) && t.setGrabCursor(!1);
        const p = l(), f = p - i.touchStartTime;
        if (t.allowClick) {
            const e = s.path || s.composedPath && s.composedPath();
            t.updateClickedSlide(e && e[0] || s.target, e), t.emit("tap click", s), f < 300 && p - i.lastClickTime < 300 && t.emit("doubleTap doubleClick", s);
        }
        if (i.lastClickTime = l(), o((() => {
            t.destroyed || (t.allowClick = !0);
        })), !i.isTouched || !i.isMoved || !t.swipeDirection || 0 === a.diff && !i.loopSwapReset || i.currentTranslate === i.startTranslate && !i.loopSwapReset) return i.isTouched = !1, 
        i.isMoved = !1, void (i.startMoving = !1);
        let h;
        if (i.isTouched = !1, i.isMoved = !1, i.startMoving = !1, h = r.followFinger ? c ? t.translate : -t.translate : -i.currentTranslate, 
        r.cssMode) return;
        if (r.freeMode && r.freeMode.enabled) return void t.freeMode.onTouchEnd({
            currentPos: h
        });
        const m = h >= -t.maxTranslate() && !t.params.loop;
        let g = 0, v = t.slidesSizesGrid[0];
        for (let e = 0; e < d.length; e += e < r.slidesPerGroupSkip ? 1 : r.slidesPerGroup) {
            const t = e < r.slidesPerGroupSkip - 1 ? 1 : r.slidesPerGroup;
            void 0 !== d[e + t] ? (m || h >= d[e] && h < d[e + t]) && (g = e, v = d[e + t] - d[e]) : (m || h >= d[e]) && (g = e, 
            v = d[d.length - 1] - d[d.length - 2]);
        }
        let y = null, b = null;
        r.rewind && (t.isBeginning ? b = r.virtual && r.virtual.enabled && t.virtual ? t.virtual.slides.length - 1 : t.slides.length - 1 : t.isEnd && (y = 0));
        const w = (h - d[g]) / v, x = g < r.slidesPerGroupSkip - 1 ? 1 : r.slidesPerGroup;
        if (f > r.longSwipesMs) {
            if (!r.longSwipes) return void t.slideTo(t.activeIndex);
            "next" === t.swipeDirection && (w >= r.longSwipesRatio ? t.slideTo(r.rewind && t.isEnd ? y : g + x) : t.slideTo(g)), 
            "prev" === t.swipeDirection && (w > 1 - r.longSwipesRatio ? t.slideTo(g + x) : null !== b && w < 0 && Math.abs(w) > r.longSwipesRatio ? t.slideTo(b) : t.slideTo(g));
        } else {
            if (!r.shortSwipes) return void t.slideTo(t.activeIndex);
            t.navigation && (s.target === t.navigation.nextEl || s.target === t.navigation.prevEl) ? s.target === t.navigation.nextEl ? t.slideTo(g + x) : t.slideTo(g) : ("next" === t.swipeDirection && t.slideTo(null !== y ? y : g + x), 
            "prev" === t.swipeDirection && t.slideTo(null !== b ? b : g));
        }
    }
    function F() {
        const e = this, {params: t, el: i} = e;
        if (i && 0 === i.offsetWidth) return;
        t.breakpoints && e.setBreakpoint();
        const {allowSlideNext: n, allowSlidePrev: s, snapGrid: r} = e, a = e.virtual && e.params.virtual.enabled;
        e.allowSlideNext = !0, e.allowSlidePrev = !0, e.updateSize(), e.updateSlides(), 
        e.updateSlidesClasses();
        const o = a && t.loop;
        !("auto" === t.slidesPerView || t.slidesPerView > 1) || !e.isEnd || e.isBeginning || e.params.centeredSlides || o ? e.params.loop && !a ? e.slideToLoop(e.realIndex, 0, !1, !0) : e.slideTo(e.activeIndex, 0, !1, !0) : e.slideTo(e.slides.length - 1, 0, !1, !0), 
        e.autoplay && e.autoplay.running && e.autoplay.paused && (clearTimeout(e.autoplay.resizeTimeout), 
        e.autoplay.resizeTimeout = setTimeout((() => {
            e.autoplay && e.autoplay.running && e.autoplay.paused && e.autoplay.resume();
        }), 500)), e.allowSlidePrev = s, e.allowSlideNext = n, e.params.watchOverflow && r !== e.snapGrid && e.checkOverflow();
    }
    function W(e) {
        const t = this;
        t.enabled && (t.allowClick || (t.params.preventClicks && e.preventDefault(), t.params.preventClicksPropagation && t.animating && (e.stopPropagation(), 
        e.stopImmediatePropagation())));
    }
    function V() {
        const e = this, {wrapperEl: t, rtlTranslate: i, enabled: n} = e;
        if (!n) return;
        let s;
        e.previousTranslate = e.translate, e.isHorizontal() ? e.translate = -t.scrollLeft : e.translate = -t.scrollTop, 
        0 === e.translate && (e.translate = 0), e.updateActiveIndex(), e.updateSlidesClasses();
        const r = e.maxTranslate() - e.minTranslate();
        s = 0 === r ? 0 : (e.translate - e.minTranslate()) / r, s !== e.progress && e.updateProgress(i ? -e.translate : e.translate), 
        e.emit("setTranslate", e.translate, !1);
    }
    function X(e) {
        const t = this;
        P(t, e.target), t.params.cssMode || "auto" !== t.params.slidesPerView && !t.params.autoHeight || t.update();
    }
    function G() {
        const e = this;
        e.documentTouchHandlerProceeded || (e.documentTouchHandlerProceeded = !0, e.params.touchReleaseOnEdges && (e.el.style.touchAction = "auto"));
    }
    const Y = (e, t) => {
        const i = n(), {params: s, el: r, wrapperEl: a, device: o} = e, l = !!s.nested, c = "on" === t ? "addEventListener" : "removeEventListener", d = t;
        i[c]("touchstart", e.onDocumentTouchStart, {
            passive: !1,
            capture: l
        }), r[c]("touchstart", e.onTouchStart, {
            passive: !1
        }), r[c]("pointerdown", e.onTouchStart, {
            passive: !1
        }), i[c]("touchmove", e.onTouchMove, {
            passive: !1,
            capture: l
        }), i[c]("pointermove", e.onTouchMove, {
            passive: !1,
            capture: l
        }), i[c]("touchend", e.onTouchEnd, {
            passive: !0
        }), i[c]("pointerup", e.onTouchEnd, {
            passive: !0
        }), i[c]("pointercancel", e.onTouchEnd, {
            passive: !0
        }), i[c]("touchcancel", e.onTouchEnd, {
            passive: !0
        }), i[c]("pointerout", e.onTouchEnd, {
            passive: !0
        }), i[c]("pointerleave", e.onTouchEnd, {
            passive: !0
        }), i[c]("contextmenu", e.onTouchEnd, {
            passive: !0
        }), (s.preventClicks || s.preventClicksPropagation) && r[c]("click", e.onClick, !0), 
        s.cssMode && a[c]("scroll", e.onScroll), s.updateOnWindowResize ? e[d](o.ios || o.android ? "resize orientationchange observerUpdate" : "resize observerUpdate", F, !0) : e[d]("observerUpdate", F, !0), 
        r[c]("load", e.onLoad, {
            capture: !0
        });
    };
    const U = (e, t) => e.grid && t.grid && t.grid.rows > 1;
    var K = {
        init: !0,
        direction: "horizontal",
        oneWayMovement: !1,
        touchEventsTarget: "wrapper",
        initialSlide: 0,
        speed: 300,
        cssMode: !1,
        updateOnWindowResize: !0,
        resizeObserver: !0,
        nested: !1,
        createElements: !1,
        eventsPrefix: "swiper",
        enabled: !0,
        focusableElements: "input, select, option, textarea, button, video, label",
        width: null,
        height: null,
        preventInteractionOnTransition: !1,
        userAgent: null,
        url: null,
        edgeSwipeDetection: !1,
        edgeSwipeThreshold: 20,
        autoHeight: !1,
        setWrapperSize: !1,
        virtualTranslate: !1,
        effect: "slide",
        breakpoints: void 0,
        breakpointsBase: "window",
        spaceBetween: 0,
        slidesPerView: 1,
        slidesPerGroup: 1,
        slidesPerGroupSkip: 0,
        slidesPerGroupAuto: !1,
        centeredSlides: !1,
        centeredSlidesBounds: !1,
        slidesOffsetBefore: 0,
        slidesOffsetAfter: 0,
        normalizeSlideIndex: !0,
        centerInsufficientSlides: !1,
        watchOverflow: !0,
        roundLengths: !1,
        touchRatio: 1,
        touchAngle: 45,
        simulateTouch: !0,
        shortSwipes: !0,
        longSwipes: !0,
        longSwipesRatio: .5,
        longSwipesMs: 300,
        followFinger: !0,
        allowTouchMove: !0,
        threshold: 5,
        touchMoveStopPropagation: !1,
        touchStartPreventDefault: !0,
        touchStartForcePreventDefault: !1,
        touchReleaseOnEdges: !1,
        uniqueNavElements: !0,
        resistance: !0,
        resistanceRatio: .85,
        watchSlidesProgress: !1,
        grabCursor: !1,
        preventClicks: !0,
        preventClicksPropagation: !0,
        slideToClickedSlide: !1,
        loop: !1,
        loopAddBlankSlides: !0,
        loopAdditionalSlides: 0,
        loopPreventsSliding: !0,
        rewind: !1,
        allowSlidePrev: !0,
        allowSlideNext: !0,
        swipeHandler: null,
        noSwiping: !0,
        noSwipingClass: "swiper-no-swiping",
        noSwipingSelector: null,
        passiveListeners: !0,
        maxBackfaceHiddenSlides: 10,
        containerModifierClass: "swiper-",
        slideClass: "swiper-slide",
        slideBlankClass: "swiper-slide-blank",
        slideActiveClass: "swiper-slide-active",
        slideVisibleClass: "swiper-slide-visible",
        slideFullyVisibleClass: "swiper-slide-fully-visible",
        slideNextClass: "swiper-slide-next",
        slidePrevClass: "swiper-slide-prev",
        wrapperClass: "swiper-wrapper",
        lazyPreloaderClass: "swiper-lazy-preloader",
        lazyPreloadPrevNext: 0,
        runCallbacksOnInit: !0,
        _emitClasses: !1
    };
    function Q(e, t) {
        return function(i) {
            void 0 === i && (i = {});
            const n = Object.keys(i)[0], s = i[n];
            "object" == typeof s && null !== s ? (!0 === e[n] && (e[n] = {
                enabled: !0
            }), "navigation" === n && e[n] && e[n].enabled && !e[n].prevEl && !e[n].nextEl && (e[n].auto = !0), 
            [ "pagination", "scrollbar" ].indexOf(n) >= 0 && e[n] && e[n].enabled && !e[n].el && (e[n].auto = !0), 
            n in e && "enabled" in s ? ("object" != typeof e[n] || "enabled" in e[n] || (e[n].enabled = !0), 
            e[n] || (e[n] = {
                enabled: !1
            }), u(t, i)) : u(t, i)) : u(t, i);
        };
    }
    const J = {
        eventsEmitter: L,
        update: I,
        translate: $,
        transition: {
            setTransition: function(e, t) {
                const i = this;
                i.params.cssMode || (i.wrapperEl.style.transitionDuration = `${e}ms`, i.wrapperEl.style.transitionDelay = 0 === e ? "0ms" : ""), 
                i.emit("setTransition", e, t);
            },
            transitionStart: function(e, t) {
                void 0 === e && (e = !0);
                const i = this, {params: n} = i;
                n.cssMode || (n.autoHeight && i.updateAutoHeight(), N({
                    swiper: i,
                    runCallbacks: e,
                    direction: t,
                    step: "Start"
                }));
            },
            transitionEnd: function(e, t) {
                void 0 === e && (e = !0);
                const i = this, {params: n} = i;
                i.animating = !1, n.cssMode || (i.setTransition(0), N({
                    swiper: i,
                    runCallbacks: e,
                    direction: t,
                    step: "End"
                }));
            }
        },
        slide: j,
        loop: z,
        grabCursor: {
            setGrabCursor: function(e) {
                const t = this;
                if (!t.params.simulateTouch || t.params.watchOverflow && t.isLocked || t.params.cssMode) return;
                const i = "container" === t.params.touchEventsTarget ? t.el : t.wrapperEl;
                t.isElement && (t.__preventObserver__ = !0), i.style.cursor = "move", i.style.cursor = e ? "grabbing" : "grab", 
                t.isElement && requestAnimationFrame((() => {
                    t.__preventObserver__ = !1;
                }));
            },
            unsetGrabCursor: function() {
                const e = this;
                e.params.watchOverflow && e.isLocked || e.params.cssMode || (e.isElement && (e.__preventObserver__ = !0), 
                e["container" === e.params.touchEventsTarget ? "el" : "wrapperEl"].style.cursor = "", 
                e.isElement && requestAnimationFrame((() => {
                    e.__preventObserver__ = !1;
                })));
            }
        },
        events: {
            attachEvents: function() {
                const e = this, {params: t} = e;
                e.onTouchStart = q.bind(e), e.onTouchMove = R.bind(e), e.onTouchEnd = B.bind(e), 
                e.onDocumentTouchStart = G.bind(e), t.cssMode && (e.onScroll = V.bind(e)), e.onClick = W.bind(e), 
                e.onLoad = X.bind(e), Y(e, "on");
            },
            detachEvents: function() {
                Y(this, "off");
            }
        },
        breakpoints: {
            setBreakpoint: function() {
                const e = this, {realIndex: t, initialized: i, params: n, el: s} = e, r = n.breakpoints;
                if (!r || r && 0 === Object.keys(r).length) return;
                const a = e.getBreakpoint(r, e.params.breakpointsBase, e.el);
                if (!a || e.currentBreakpoint === a) return;
                const o = (a in r ? r[a] : void 0) || e.originalParams, l = U(e, n), c = U(e, o), d = n.enabled;
                l && !c ? (s.classList.remove(`${n.containerModifierClass}grid`, `${n.containerModifierClass}grid-column`), 
                e.emitContainerClasses()) : !l && c && (s.classList.add(`${n.containerModifierClass}grid`), 
                (o.grid.fill && "column" === o.grid.fill || !o.grid.fill && "column" === n.grid.fill) && s.classList.add(`${n.containerModifierClass}grid-column`), 
                e.emitContainerClasses()), [ "navigation", "pagination", "scrollbar" ].forEach((t => {
                    if (void 0 === o[t]) return;
                    const i = n[t] && n[t].enabled, s = o[t] && o[t].enabled;
                    i && !s && e[t].disable(), !i && s && e[t].enable();
                }));
                const p = o.direction && o.direction !== n.direction, f = n.loop && (o.slidesPerView !== n.slidesPerView || p), h = n.loop;
                p && i && e.changeDirection(), u(e.params, o);
                const m = e.params.enabled, g = e.params.loop;
                Object.assign(e, {
                    allowTouchMove: e.params.allowTouchMove,
                    allowSlideNext: e.params.allowSlideNext,
                    allowSlidePrev: e.params.allowSlidePrev
                }), d && !m ? e.disable() : !d && m && e.enable(), e.currentBreakpoint = a, e.emit("_beforeBreakpoint", o), 
                i && (f ? (e.loopDestroy(), e.loopCreate(t), e.updateSlides()) : !h && g ? (e.loopCreate(t), 
                e.updateSlides()) : h && !g && e.loopDestroy()), e.emit("breakpoint", o);
            },
            getBreakpoint: function(e, t, i) {
                if (void 0 === t && (t = "window"), !e || "container" === t && !i) return;
                let n = !1;
                const s = r(), a = "window" === t ? s.innerHeight : i.clientHeight, o = Object.keys(e).map((e => {
                    if ("string" == typeof e && 0 === e.indexOf("@")) {
                        const t = parseFloat(e.substr(1));
                        return {
                            value: a * t,
                            point: e
                        };
                    }
                    return {
                        value: e,
                        point: e
                    };
                }));
                o.sort(((e, t) => parseInt(e.value, 10) - parseInt(t.value, 10)));
                for (let e = 0; e < o.length; e += 1) {
                    const {point: r, value: a} = o[e];
                    "window" === t ? s.matchMedia(`(min-width: ${a}px)`).matches && (n = r) : a <= i.clientWidth && (n = r);
                }
                return n || "max";
            }
        },
        checkOverflow: {
            checkOverflow: function() {
                const e = this, {isLocked: t, params: i} = e, {slidesOffsetBefore: n} = i;
                if (n) {
                    const t = e.slides.length - 1, i = e.slidesGrid[t] + e.slidesSizesGrid[t] + 2 * n;
                    e.isLocked = e.size > i;
                } else e.isLocked = 1 === e.snapGrid.length;
                !0 === i.allowSlideNext && (e.allowSlideNext = !e.isLocked), !0 === i.allowSlidePrev && (e.allowSlidePrev = !e.isLocked), 
                t && t !== e.isLocked && (e.isEnd = !1), t !== e.isLocked && e.emit(e.isLocked ? "lock" : "unlock");
            }
        },
        classes: {
            addClasses: function() {
                const e = this, {classNames: t, params: i, rtl: n, el: s, device: r} = e, a = function(e, t) {
                    const i = [];
                    return e.forEach((e => {
                        "object" == typeof e ? Object.keys(e).forEach((n => {
                            e[n] && i.push(t + n);
                        })) : "string" == typeof e && i.push(t + e);
                    })), i;
                }([ "initialized", i.direction, {
                    "free-mode": e.params.freeMode && i.freeMode.enabled
                }, {
                    autoheight: i.autoHeight
                }, {
                    rtl: n
                }, {
                    grid: i.grid && i.grid.rows > 1
                }, {
                    "grid-column": i.grid && i.grid.rows > 1 && "column" === i.grid.fill
                }, {
                    android: r.android
                }, {
                    ios: r.ios
                }, {
                    "css-mode": i.cssMode
                }, {
                    centered: i.cssMode && i.centeredSlides
                }, {
                    "watch-progress": i.watchSlidesProgress
                } ], i.containerModifierClass);
                t.push(...a), s.classList.add(...t), e.emitContainerClasses();
            },
            removeClasses: function() {
                const {el: e, classNames: t} = this;
                e.classList.remove(...t), this.emitContainerClasses();
            }
        }
    }, Z = {};
    class ee {
        constructor() {
            let e, t;
            for (var i = arguments.length, s = new Array(i), r = 0; r < i; r++) s[r] = arguments[r];
            1 === s.length && s[0].constructor && "Object" === Object.prototype.toString.call(s[0]).slice(8, -1) ? t = s[0] : [e, t] = s, 
            t || (t = {}), t = u({}, t), e && !t.el && (t.el = e);
            const a = n();
            if (t.el && "string" == typeof t.el && a.querySelectorAll(t.el).length > 1) {
                const e = [];
                return a.querySelectorAll(t.el).forEach((i => {
                    const n = u({}, t, {
                        el: i
                    });
                    e.push(new ee(n));
                })), e;
            }
            const o = this;
            o.__swiper__ = !0, o.support = M(), o.device = A({
                userAgent: t.userAgent
            }), o.browser = k(), o.eventsListeners = {}, o.eventsAnyListeners = [], o.modules = [ ...o.__modules__ ], 
            t.modules && Array.isArray(t.modules) && o.modules.push(...t.modules);
            const l = {};
            o.modules.forEach((e => {
                e({
                    params: t,
                    swiper: o,
                    extendParams: Q(t, l),
                    on: o.on.bind(o),
                    once: o.once.bind(o),
                    off: o.off.bind(o),
                    emit: o.emit.bind(o)
                });
            }));
            const c = u({}, K, l);
            return o.params = u({}, c, Z, t), o.originalParams = u({}, o.params), o.passedParams = u({}, t), 
            o.params && o.params.on && Object.keys(o.params.on).forEach((e => {
                o.on(e, o.params.on[e]);
            })), o.params && o.params.onAny && o.onAny(o.params.onAny), Object.assign(o, {
                enabled: o.params.enabled,
                el: e,
                classNames: [],
                slides: [],
                slidesGrid: [],
                snapGrid: [],
                slidesSizesGrid: [],
                isHorizontal: () => "horizontal" === o.params.direction,
                isVertical: () => "vertical" === o.params.direction,
                activeIndex: 0,
                realIndex: 0,
                isBeginning: !0,
                isEnd: !1,
                translate: 0,
                previousTranslate: 0,
                progress: 0,
                velocity: 0,
                animating: !1,
                cssOverflowAdjustment() {
                    return Math.trunc(this.translate / 2 ** 23) * 2 ** 23;
                },
                allowSlideNext: o.params.allowSlideNext,
                allowSlidePrev: o.params.allowSlidePrev,
                touchEventsData: {
                    isTouched: void 0,
                    isMoved: void 0,
                    allowTouchCallbacks: void 0,
                    touchStartTime: void 0,
                    isScrolling: void 0,
                    currentTranslate: void 0,
                    startTranslate: void 0,
                    allowThresholdMove: void 0,
                    focusableElements: o.params.focusableElements,
                    lastClickTime: 0,
                    clickTimeout: void 0,
                    velocities: [],
                    allowMomentumBounce: void 0,
                    startMoving: void 0,
                    pointerId: null,
                    touchId: null
                },
                allowClick: !0,
                allowTouchMove: o.params.allowTouchMove,
                touches: {
                    startX: 0,
                    startY: 0,
                    currentX: 0,
                    currentY: 0,
                    diff: 0
                },
                imagesToLoad: [],
                imagesLoaded: 0
            }), o.emit("_swiper"), o.params.init && o.init(), o;
        }
        getDirectionLabel(e) {
            return this.isHorizontal() ? e : {
                width: "height",
                "margin-top": "margin-left",
                "margin-bottom ": "margin-right",
                "margin-left": "margin-top",
                "margin-right": "margin-bottom",
                "padding-left": "padding-top",
                "padding-right": "padding-bottom",
                marginRight: "marginBottom"
            }[e];
        }
        getSlideIndex(e) {
            const {slidesEl: t, params: i} = this, n = w(m(t, `.${i.slideClass}, swiper-slide`)[0]);
            return w(e) - n;
        }
        getSlideIndexByData(e) {
            return this.getSlideIndex(this.slides.filter((t => 1 * t.getAttribute("data-swiper-slide-index") === e))[0]);
        }
        recalcSlides() {
            const {slidesEl: e, params: t} = this;
            this.slides = m(e, `.${t.slideClass}, swiper-slide`);
        }
        enable() {
            const e = this;
            e.enabled || (e.enabled = !0, e.params.grabCursor && e.setGrabCursor(), e.emit("enable"));
        }
        disable() {
            const e = this;
            e.enabled && (e.enabled = !1, e.params.grabCursor && e.unsetGrabCursor(), e.emit("disable"));
        }
        setProgress(e, t) {
            const i = this;
            e = Math.min(Math.max(e, 0), 1);
            const n = i.minTranslate(), s = (i.maxTranslate() - n) * e + n;
            i.translateTo(s, void 0 === t ? 0 : t), i.updateActiveIndex(), i.updateSlidesClasses();
        }
        emitContainerClasses() {
            const e = this;
            if (!e.params._emitClasses || !e.el) return;
            const t = e.el.className.split(" ").filter((t => 0 === t.indexOf("swiper") || 0 === t.indexOf(e.params.containerModifierClass)));
            e.emit("_containerClasses", t.join(" "));
        }
        getSlideClasses(e) {
            const t = this;
            return t.destroyed ? "" : e.className.split(" ").filter((e => 0 === e.indexOf("swiper-slide") || 0 === e.indexOf(t.params.slideClass))).join(" ");
        }
        emitSlidesClasses() {
            const e = this;
            if (!e.params._emitClasses || !e.el) return;
            const t = [];
            e.slides.forEach((i => {
                const n = e.getSlideClasses(i);
                t.push({
                    slideEl: i,
                    classNames: n
                }), e.emit("_slideClass", i, n);
            })), e.emit("_slideClasses", t);
        }
        slidesPerViewDynamic(e, t) {
            void 0 === e && (e = "current"), void 0 === t && (t = !1);
            const {params: i, slides: n, slidesGrid: s, slidesSizesGrid: r, size: a, activeIndex: o} = this;
            let l = 1;
            if ("number" == typeof i.slidesPerView) return i.slidesPerView;
            if (i.centeredSlides) {
                let e, t = n[o] ? n[o].swiperSlideSize : 0;
                for (let i = o + 1; i < n.length; i += 1) n[i] && !e && (t += n[i].swiperSlideSize, 
                l += 1, t > a && (e = !0));
                for (let i = o - 1; i >= 0; i -= 1) n[i] && !e && (t += n[i].swiperSlideSize, l += 1, 
                t > a && (e = !0));
            } else if ("current" === e) for (let e = o + 1; e < n.length; e += 1) {
                (t ? s[e] + r[e] - s[o] < a : s[e] - s[o] < a) && (l += 1);
            } else for (let e = o - 1; e >= 0; e -= 1) {
                s[o] - s[e] < a && (l += 1);
            }
            return l;
        }
        update() {
            const e = this;
            if (!e || e.destroyed) return;
            const {snapGrid: t, params: i} = e;
            function n() {
                const t = e.rtlTranslate ? -1 * e.translate : e.translate, i = Math.min(Math.max(t, e.maxTranslate()), e.minTranslate());
                e.setTranslate(i), e.updateActiveIndex(), e.updateSlidesClasses();
            }
            let s;
            if (i.breakpoints && e.setBreakpoint(), [ ...e.el.querySelectorAll('[loading="lazy"]') ].forEach((t => {
                t.complete && P(e, t);
            })), e.updateSize(), e.updateSlides(), e.updateProgress(), e.updateSlidesClasses(), 
            i.freeMode && i.freeMode.enabled && !i.cssMode) n(), i.autoHeight && e.updateAutoHeight(); else {
                if (("auto" === i.slidesPerView || i.slidesPerView > 1) && e.isEnd && !i.centeredSlides) {
                    const t = e.virtual && i.virtual.enabled ? e.virtual.slides : e.slides;
                    s = e.slideTo(t.length - 1, 0, !1, !0);
                } else s = e.slideTo(e.activeIndex, 0, !1, !0);
                s || n();
            }
            i.watchOverflow && t !== e.snapGrid && e.checkOverflow(), e.emit("update");
        }
        changeDirection(e, t) {
            void 0 === t && (t = !0);
            const i = this, n = i.params.direction;
            return e || (e = "horizontal" === n ? "vertical" : "horizontal"), e === n || "horizontal" !== e && "vertical" !== e || (i.el.classList.remove(`${i.params.containerModifierClass}${n}`), 
            i.el.classList.add(`${i.params.containerModifierClass}${e}`), i.emitContainerClasses(), 
            i.params.direction = e, i.slides.forEach((t => {
                "vertical" === e ? t.style.width = "" : t.style.height = "";
            })), i.emit("changeDirection"), t && i.update()), i;
        }
        changeLanguageDirection(e) {
            const t = this;
            t.rtl && "rtl" === e || !t.rtl && "ltr" === e || (t.rtl = "rtl" === e, t.rtlTranslate = "horizontal" === t.params.direction && t.rtl, 
            t.rtl ? (t.el.classList.add(`${t.params.containerModifierClass}rtl`), t.el.dir = "rtl") : (t.el.classList.remove(`${t.params.containerModifierClass}rtl`), 
            t.el.dir = "ltr"), t.update());
        }
        mount(e) {
            const t = this;
            if (t.mounted) return !0;
            let i = e || t.params.el;
            if ("string" == typeof i && (i = document.querySelector(i)), !i) return !1;
            i.swiper = t, i.parentNode && i.parentNode.host && "SWIPER-CONTAINER" === i.parentNode.host.nodeName && (t.isElement = !0);
            const n = () => `.${(t.params.wrapperClass || "").trim().split(" ").join(".")}`;
            let s = (() => {
                if (i && i.shadowRoot && i.shadowRoot.querySelector) {
                    return i.shadowRoot.querySelector(n());
                }
                return m(i, n())[0];
            })();
            return !s && t.params.createElements && (s = v("div", t.params.wrapperClass), i.append(s), 
            m(i, `.${t.params.slideClass}`).forEach((e => {
                s.append(e);
            }))), Object.assign(t, {
                el: i,
                wrapperEl: s,
                slidesEl: t.isElement && !i.parentNode.host.slideSlots ? i.parentNode.host : s,
                hostEl: t.isElement ? i.parentNode.host : i,
                mounted: !0,
                rtl: "rtl" === i.dir.toLowerCase() || "rtl" === b(i, "direction"),
                rtlTranslate: "horizontal" === t.params.direction && ("rtl" === i.dir.toLowerCase() || "rtl" === b(i, "direction")),
                wrongRTL: "-webkit-box" === b(s, "display")
            }), !0;
        }
        init(e) {
            const t = this;
            if (t.initialized) return t;
            if (!1 === t.mount(e)) return t;
            t.emit("beforeInit"), t.params.breakpoints && t.setBreakpoint(), t.addClasses(), 
            t.updateSize(), t.updateSlides(), t.params.watchOverflow && t.checkOverflow(), t.params.grabCursor && t.enabled && t.setGrabCursor(), 
            t.params.loop && t.virtual && t.params.virtual.enabled ? t.slideTo(t.params.initialSlide + t.virtual.slidesBefore, 0, t.params.runCallbacksOnInit, !1, !0) : t.slideTo(t.params.initialSlide, 0, t.params.runCallbacksOnInit, !1, !0), 
            t.params.loop && t.loopCreate(), t.attachEvents();
            const i = [ ...t.el.querySelectorAll('[loading="lazy"]') ];
            return t.isElement && i.push(...t.hostEl.querySelectorAll('[loading="lazy"]')), 
            i.forEach((e => {
                e.complete ? P(t, e) : e.addEventListener("load", (e => {
                    P(t, e.target);
                }));
            })), D(t), t.initialized = !0, D(t), t.emit("init"), t.emit("afterInit"), t;
        }
        destroy(e, t) {
            void 0 === e && (e = !0), void 0 === t && (t = !0);
            const i = this, {params: n, el: s, wrapperEl: r, slides: a} = i;
            return void 0 === i.params || i.destroyed || (i.emit("beforeDestroy"), i.initialized = !1, 
            i.detachEvents(), n.loop && i.loopDestroy(), t && (i.removeClasses(), s.removeAttribute("style"), 
            r.removeAttribute("style"), a && a.length && a.forEach((e => {
                e.classList.remove(n.slideVisibleClass, n.slideFullyVisibleClass, n.slideActiveClass, n.slideNextClass, n.slidePrevClass), 
                e.removeAttribute("style"), e.removeAttribute("data-swiper-slide-index");
            }))), i.emit("destroy"), Object.keys(i.eventsListeners).forEach((e => {
                i.off(e);
            })), !1 !== e && (i.el.swiper = null, function(e) {
                const t = e;
                Object.keys(t).forEach((e => {
                    try {
                        t[e] = null;
                    } catch (e) {}
                    try {
                        delete t[e];
                    } catch (e) {}
                }));
            }(i)), i.destroyed = !0), null;
        }
        static extendDefaults(e) {
            u(Z, e);
        }
        static get extendedDefaults() {
            return Z;
        }
        static get defaults() {
            return K;
        }
        static installModule(e) {
            ee.prototype.__modules__ || (ee.prototype.__modules__ = []);
            const t = ee.prototype.__modules__;
            "function" == typeof e && t.indexOf(e) < 0 && t.push(e);
        }
        static use(e) {
            return Array.isArray(e) ? (e.forEach((e => ee.installModule(e))), ee) : (ee.installModule(e), 
            ee);
        }
    }
    function te(e, t, i, n) {
        return e.params.createElements && Object.keys(n).forEach((s => {
            if (!i[s] && !0 === i.auto) {
                let r = m(e.el, `.${n[s]}`)[0];
                r || (r = v("div", n[s]), r.className = n[s], e.el.append(r)), i[s] = r, t[s] = r;
            }
        })), i;
    }
    function ie(e) {
        return void 0 === e && (e = ""), `.${e.trim().replace(/([\.:!+\/])/g, "\\$1").replace(/ /g, ".")}`;
    }
    function ne(e) {
        const t = this, {params: i, slidesEl: n} = t;
        i.loop && t.loopDestroy();
        const s = e => {
            if ("string" == typeof e) {
                const t = document.createElement("div");
                t.innerHTML = e, n.append(t.children[0]), t.innerHTML = "";
            } else n.append(e);
        };
        if ("object" == typeof e && "length" in e) for (let t = 0; t < e.length; t += 1) e[t] && s(e[t]); else s(e);
        t.recalcSlides(), i.loop && t.loopCreate(), i.observer && !t.isElement || t.update();
    }
    function se(e) {
        const t = this, {params: i, activeIndex: n, slidesEl: s} = t;
        i.loop && t.loopDestroy();
        let r = n + 1;
        const a = e => {
            if ("string" == typeof e) {
                const t = document.createElement("div");
                t.innerHTML = e, s.prepend(t.children[0]), t.innerHTML = "";
            } else s.prepend(e);
        };
        if ("object" == typeof e && "length" in e) {
            for (let t = 0; t < e.length; t += 1) e[t] && a(e[t]);
            r = n + e.length;
        } else a(e);
        t.recalcSlides(), i.loop && t.loopCreate(), i.observer && !t.isElement || t.update(), 
        t.slideTo(r, 0, !1);
    }
    function re(e, t) {
        const i = this, {params: n, activeIndex: s, slidesEl: r} = i;
        let a = s;
        n.loop && (a -= i.loopedSlides, i.loopDestroy(), i.recalcSlides());
        const o = i.slides.length;
        if (e <= 0) return void i.prependSlide(t);
        if (e >= o) return void i.appendSlide(t);
        let l = a > e ? a + 1 : a;
        const c = [];
        for (let t = o - 1; t >= e; t -= 1) {
            const e = i.slides[t];
            e.remove(), c.unshift(e);
        }
        if ("object" == typeof t && "length" in t) {
            for (let e = 0; e < t.length; e += 1) t[e] && r.append(t[e]);
            l = a > e ? a + t.length : a;
        } else r.append(t);
        for (let e = 0; e < c.length; e += 1) r.append(c[e]);
        i.recalcSlides(), n.loop && i.loopCreate(), n.observer && !i.isElement || i.update(), 
        n.loop ? i.slideTo(l + i.loopedSlides, 0, !1) : i.slideTo(l, 0, !1);
    }
    function ae(e) {
        const t = this, {params: i, activeIndex: n} = t;
        let s = n;
        i.loop && (s -= t.loopedSlides, t.loopDestroy());
        let r, a = s;
        if ("object" == typeof e && "length" in e) {
            for (let i = 0; i < e.length; i += 1) r = e[i], t.slides[r] && t.slides[r].remove(), 
            r < a && (a -= 1);
            a = Math.max(a, 0);
        } else r = e, t.slides[r] && t.slides[r].remove(), r < a && (a -= 1), a = Math.max(a, 0);
        t.recalcSlides(), i.loop && t.loopCreate(), i.observer && !t.isElement || t.update(), 
        i.loop ? t.slideTo(a + t.loopedSlides, 0, !1) : t.slideTo(a, 0, !1);
    }
    function oe() {
        const e = this, t = [];
        for (let i = 0; i < e.slides.length; i += 1) t.push(i);
        e.removeSlide(t);
    }
    function le(e) {
        const {effect: t, swiper: i, on: n, setTranslate: s, setTransition: r, overwriteParams: a, perspective: o, recreateShadows: l, getEffectParams: c} = e;
        let d;
        n("beforeInit", (() => {
            if (i.params.effect !== t) return;
            i.classNames.push(`${i.params.containerModifierClass}${t}`), o && o() && i.classNames.push(`${i.params.containerModifierClass}3d`);
            const e = a ? a() : {};
            Object.assign(i.params, e), Object.assign(i.originalParams, e);
        })), n("setTranslate", (() => {
            i.params.effect === t && s();
        })), n("setTransition", ((e, n) => {
            i.params.effect === t && r(n);
        })), n("transitionEnd", (() => {
            if (i.params.effect === t && l) {
                if (!c || !c().slideShadows) return;
                i.slides.forEach((e => {
                    e.querySelectorAll(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").forEach((e => e.remove()));
                })), l();
            }
        })), n("virtualUpdate", (() => {
            i.params.effect === t && (i.slides.length || (d = !0), requestAnimationFrame((() => {
                d && i.slides && i.slides.length && (s(), d = !1);
            })));
        }));
    }
    function ce(e, t) {
        const i = h(t);
        return i !== t && (i.style.backfaceVisibility = "hidden", i.style["-webkit-backface-visibility"] = "hidden"), 
        i;
    }
    function de(e) {
        let {swiper: t, duration: i, transformElements: n, allSlides: s} = e;
        const {activeIndex: r} = t;
        if (t.params.virtualTranslate && 0 !== i) {
            let e, i = !1;
            e = s ? n : n.filter((e => {
                const i = e.classList.contains("swiper-slide-transform") ? (e => {
                    if (!e.parentElement) return t.slides.filter((t => t.shadowRoot && t.shadowRoot === e.parentNode))[0];
                    return e.parentElement;
                })(e) : e;
                return t.getSlideIndex(i) === r;
            })), e.forEach((e => {
                E(e, (() => {
                    if (i) return;
                    if (!t || t.destroyed) return;
                    i = !0, t.animating = !1;
                    const e = new window.CustomEvent("transitionend", {
                        bubbles: !0,
                        cancelable: !0
                    });
                    t.wrapperEl.dispatchEvent(e);
                }));
            }));
        }
    }
    function ue(e, t, i) {
        const n = `swiper-slide-shadow${i ? `-${i}` : ""}${e ? ` swiper-slide-shadow-${e}` : ""}`, s = h(t);
        let r = s.querySelector(`.${n.split(" ").join(".")}`);
        return r || (r = v("div", n.split(" ")), s.append(r)), r;
    }
    Object.keys(J).forEach((e => {
        Object.keys(J[e]).forEach((t => {
            ee.prototype[t] = J[e][t];
        }));
    })), ee.use([ function(e) {
        let {swiper: t, on: i, emit: n} = e;
        const s = r();
        let a = null, o = null;
        const l = () => {
            t && !t.destroyed && t.initialized && (n("beforeResize"), n("resize"));
        }, c = () => {
            t && !t.destroyed && t.initialized && n("orientationchange");
        };
        i("init", (() => {
            t.params.resizeObserver && void 0 !== s.ResizeObserver ? t && !t.destroyed && t.initialized && (a = new ResizeObserver((e => {
                o = s.requestAnimationFrame((() => {
                    const {width: i, height: n} = t;
                    let s = i, r = n;
                    e.forEach((e => {
                        let {contentBoxSize: i, contentRect: n, target: a} = e;
                        a && a !== t.el || (s = n ? n.width : (i[0] || i).inlineSize, r = n ? n.height : (i[0] || i).blockSize);
                    })), s === i && r === n || l();
                }));
            })), a.observe(t.el)) : (s.addEventListener("resize", l), s.addEventListener("orientationchange", c));
        })), i("destroy", (() => {
            o && s.cancelAnimationFrame(o), a && a.unobserve && t.el && (a.unobserve(t.el), 
            a = null), s.removeEventListener("resize", l), s.removeEventListener("orientationchange", c);
        }));
    }, function(e) {
        let {swiper: t, extendParams: i, on: n, emit: s} = e;
        const a = [], o = r(), l = function(e, i) {
            void 0 === i && (i = {});
            const n = new (o.MutationObserver || o.WebkitMutationObserver)((e => {
                if (t.__preventObserver__) return;
                if (1 === e.length) return void s("observerUpdate", e[0]);
                const i = function() {
                    s("observerUpdate", e[0]);
                };
                o.requestAnimationFrame ? o.requestAnimationFrame(i) : o.setTimeout(i, 0);
            }));
            n.observe(e, {
                attributes: void 0 === i.attributes || i.attributes,
                childList: void 0 === i.childList || i.childList,
                characterData: void 0 === i.characterData || i.characterData
            }), a.push(n);
        };
        i({
            observer: !1,
            observeParents: !1,
            observeSlideChildren: !1
        }), n("init", (() => {
            if (t.params.observer) {
                if (t.params.observeParents) {
                    const e = x(t.hostEl);
                    for (let t = 0; t < e.length; t += 1) l(e[t]);
                }
                l(t.hostEl, {
                    childList: t.params.observeSlideChildren
                }), l(t.wrapperEl, {
                    attributes: !1
                });
            }
        })), n("destroy", (() => {
            a.forEach((e => {
                e.disconnect();
            })), a.splice(0, a.length);
        }));
    } ]);
    const pe = [ function(e) {
        let t, {swiper: i, extendParams: s, on: r, emit: a} = e;
        s({
            virtual: {
                enabled: !1,
                slides: [],
                cache: !0,
                renderSlide: null,
                renderExternal: null,
                renderExternalUpdate: !0,
                addSlidesBefore: 0,
                addSlidesAfter: 0
            }
        });
        const o = n();
        i.virtual = {
            cache: {},
            from: void 0,
            to: void 0,
            slides: [],
            offset: 0,
            slidesGrid: []
        };
        const l = o.createElement("div");
        function c(e, t) {
            const n = i.params.virtual;
            if (n.cache && i.virtual.cache[t]) return i.virtual.cache[t];
            let s;
            return n.renderSlide ? (s = n.renderSlide.call(i, e, t), "string" == typeof s && (l.innerHTML = s, 
            s = l.children[0])) : s = i.isElement ? v("swiper-slide") : v("div", i.params.slideClass), 
            s.setAttribute("data-swiper-slide-index", t), n.renderSlide || (s.innerHTML = e), 
            n.cache && (i.virtual.cache[t] = s), s;
        }
        function d(e) {
            const {slidesPerView: t, slidesPerGroup: n, centeredSlides: s, loop: r} = i.params, {addSlidesBefore: o, addSlidesAfter: l} = i.params.virtual, {from: d, to: u, slides: p, slidesGrid: f, offset: h} = i.virtual;
            i.params.cssMode || i.updateActiveIndex();
            const g = i.activeIndex || 0;
            let v, y, b;
            v = i.rtlTranslate ? "right" : i.isHorizontal() ? "left" : "top", s ? (y = Math.floor(t / 2) + n + l, 
            b = Math.floor(t / 2) + n + o) : (y = t + (n - 1) + l, b = (r ? t : n) + o);
            let w = g - b, x = g + y;
            r || (w = Math.max(w, 0), x = Math.min(x, p.length - 1));
            let E = (i.slidesGrid[w] || 0) - (i.slidesGrid[0] || 0);
            function _() {
                i.updateSlides(), i.updateProgress(), i.updateSlidesClasses(), a("virtualUpdate");
            }
            if (r && g >= b ? (w -= b, s || (E += i.slidesGrid[0])) : r && g < b && (w = -b, 
            s && (E += i.slidesGrid[0])), Object.assign(i.virtual, {
                from: w,
                to: x,
                offset: E,
                slidesGrid: i.slidesGrid,
                slidesBefore: b,
                slidesAfter: y
            }), d === w && u === x && !e) return i.slidesGrid !== f && E !== h && i.slides.forEach((e => {
                e.style[v] = E - Math.abs(i.cssOverflowAdjustment()) + "px";
            })), i.updateProgress(), void a("virtualUpdate");
            if (i.params.virtual.renderExternal) return i.params.virtual.renderExternal.call(i, {
                offset: E,
                from: w,
                to: x,
                slides: function() {
                    const e = [];
                    for (let t = w; t <= x; t += 1) e.push(p[t]);
                    return e;
                }()
            }), void (i.params.virtual.renderExternalUpdate ? _() : a("virtualUpdate"));
            const T = [], S = [], C = e => {
                let t = e;
                return e < 0 ? t = p.length + e : t >= p.length && (t -= p.length), t;
            };
            if (e) i.slides.filter((e => e.matches(`.${i.params.slideClass}, swiper-slide`))).forEach((e => {
                e.remove();
            })); else for (let e = d; e <= u; e += 1) if (e < w || e > x) {
                const t = C(e);
                i.slides.filter((e => e.matches(`.${i.params.slideClass}[data-swiper-slide-index="${t}"], swiper-slide[data-swiper-slide-index="${t}"]`))).forEach((e => {
                    e.remove();
                }));
            }
            const M = r ? -p.length : 0, A = r ? 2 * p.length : p.length;
            for (let t = M; t < A; t += 1) if (t >= w && t <= x) {
                const i = C(t);
                void 0 === u || e ? S.push(i) : (t > u && S.push(i), t < d && T.push(i));
            }
            if (S.forEach((e => {
                i.slidesEl.append(c(p[e], e));
            })), r) for (let e = T.length - 1; e >= 0; e -= 1) {
                const t = T[e];
                i.slidesEl.prepend(c(p[t], t));
            } else T.sort(((e, t) => t - e)), T.forEach((e => {
                i.slidesEl.prepend(c(p[e], e));
            }));
            m(i.slidesEl, ".swiper-slide, swiper-slide").forEach((e => {
                e.style[v] = E - Math.abs(i.cssOverflowAdjustment()) + "px";
            })), _();
        }
        r("beforeInit", (() => {
            if (!i.params.virtual.enabled) return;
            let e;
            if (void 0 === i.passedParams.virtual.slides) {
                const t = [ ...i.slidesEl.children ].filter((e => e.matches(`.${i.params.slideClass}, swiper-slide`)));
                t && t.length && (i.virtual.slides = [ ...t ], e = !0, t.forEach(((e, t) => {
                    e.setAttribute("data-swiper-slide-index", t), i.virtual.cache[t] = e, e.remove();
                })));
            }
            e || (i.virtual.slides = i.params.virtual.slides), i.classNames.push(`${i.params.containerModifierClass}virtual`), 
            i.params.watchSlidesProgress = !0, i.originalParams.watchSlidesProgress = !0, d();
        })), r("setTranslate", (() => {
            i.params.virtual.enabled && (i.params.cssMode && !i._immediateVirtual ? (clearTimeout(t), 
            t = setTimeout((() => {
                d();
            }), 100)) : d());
        })), r("init update resize", (() => {
            i.params.virtual.enabled && i.params.cssMode && p(i.wrapperEl, "--swiper-virtual-size", `${i.virtualSize}px`);
        })), Object.assign(i.virtual, {
            appendSlide: function(e) {
                if ("object" == typeof e && "length" in e) for (let t = 0; t < e.length; t += 1) e[t] && i.virtual.slides.push(e[t]); else i.virtual.slides.push(e);
                d(!0);
            },
            prependSlide: function(e) {
                const t = i.activeIndex;
                let n = t + 1, s = 1;
                if (Array.isArray(e)) {
                    for (let t = 0; t < e.length; t += 1) e[t] && i.virtual.slides.unshift(e[t]);
                    n = t + e.length, s = e.length;
                } else i.virtual.slides.unshift(e);
                if (i.params.virtual.cache) {
                    const e = i.virtual.cache, t = {};
                    Object.keys(e).forEach((i => {
                        const n = e[i], r = n.getAttribute("data-swiper-slide-index");
                        r && n.setAttribute("data-swiper-slide-index", parseInt(r, 10) + s), t[parseInt(i, 10) + s] = n;
                    })), i.virtual.cache = t;
                }
                d(!0), i.slideTo(n, 0);
            },
            removeSlide: function(e) {
                if (null == e) return;
                let t = i.activeIndex;
                if (Array.isArray(e)) for (let n = e.length - 1; n >= 0; n -= 1) i.params.virtual.cache && (delete i.virtual.cache[e[n]], 
                Object.keys(i.virtual.cache).forEach((t => {
                    t > e && (i.virtual.cache[t - 1] = i.virtual.cache[t], i.virtual.cache[t - 1].setAttribute("data-swiper-slide-index", t - 1), 
                    delete i.virtual.cache[t]);
                }))), i.virtual.slides.splice(e[n], 1), e[n] < t && (t -= 1), t = Math.max(t, 0); else i.params.virtual.cache && (delete i.virtual.cache[e], 
                Object.keys(i.virtual.cache).forEach((t => {
                    t > e && (i.virtual.cache[t - 1] = i.virtual.cache[t], i.virtual.cache[t - 1].setAttribute("data-swiper-slide-index", t - 1), 
                    delete i.virtual.cache[t]);
                }))), i.virtual.slides.splice(e, 1), e < t && (t -= 1), t = Math.max(t, 0);
                d(!0), i.slideTo(t, 0);
            },
            removeAllSlides: function() {
                i.virtual.slides = [], i.params.virtual.cache && (i.virtual.cache = {}), d(!0), 
                i.slideTo(0, 0);
            },
            update: d
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: s, emit: a} = e;
        const o = n(), l = r();
        function c(e) {
            if (!t.enabled) return;
            const {rtlTranslate: i} = t;
            let n = e;
            n.originalEvent && (n = n.originalEvent);
            const s = n.keyCode || n.charCode, r = t.params.keyboard.pageUpDown, c = r && 33 === s, d = r && 34 === s, u = 37 === s, p = 39 === s, f = 38 === s, h = 40 === s;
            if (!t.allowSlideNext && (t.isHorizontal() && p || t.isVertical() && h || d)) return !1;
            if (!t.allowSlidePrev && (t.isHorizontal() && u || t.isVertical() && f || c)) return !1;
            if (!(n.shiftKey || n.altKey || n.ctrlKey || n.metaKey || o.activeElement && o.activeElement.nodeName && ("input" === o.activeElement.nodeName.toLowerCase() || "textarea" === o.activeElement.nodeName.toLowerCase()))) {
                if (t.params.keyboard.onlyInViewport && (c || d || u || p || f || h)) {
                    let e = !1;
                    if (x(t.el, `.${t.params.slideClass}, swiper-slide`).length > 0 && 0 === x(t.el, `.${t.params.slideActiveClass}`).length) return;
                    const n = t.el, s = n.clientWidth, r = n.clientHeight, a = l.innerWidth, o = l.innerHeight, c = y(n);
                    i && (c.left -= n.scrollLeft);
                    const d = [ [ c.left, c.top ], [ c.left + s, c.top ], [ c.left, c.top + r ], [ c.left + s, c.top + r ] ];
                    for (let t = 0; t < d.length; t += 1) {
                        const i = d[t];
                        if (i[0] >= 0 && i[0] <= a && i[1] >= 0 && i[1] <= o) {
                            if (0 === i[0] && 0 === i[1]) continue;
                            e = !0;
                        }
                    }
                    if (!e) return;
                }
                t.isHorizontal() ? ((c || d || u || p) && (n.preventDefault ? n.preventDefault() : n.returnValue = !1), 
                ((d || p) && !i || (c || u) && i) && t.slideNext(), ((c || u) && !i || (d || p) && i) && t.slidePrev()) : ((c || d || f || h) && (n.preventDefault ? n.preventDefault() : n.returnValue = !1), 
                (d || h) && t.slideNext(), (c || f) && t.slidePrev()), a("keyPress", s);
            }
        }
        function d() {
            t.keyboard.enabled || (o.addEventListener("keydown", c), t.keyboard.enabled = !0);
        }
        function u() {
            t.keyboard.enabled && (o.removeEventListener("keydown", c), t.keyboard.enabled = !1);
        }
        t.keyboard = {
            enabled: !1
        }, i({
            keyboard: {
                enabled: !1,
                onlyInViewport: !0,
                pageUpDown: !0
            }
        }), s("init", (() => {
            t.params.keyboard.enabled && d();
        })), s("destroy", (() => {
            t.keyboard.enabled && u();
        })), Object.assign(t.keyboard, {
            enable: d,
            disable: u
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n, emit: s} = e;
        const a = r();
        let c;
        i({
            mousewheel: {
                enabled: !1,
                releaseOnEdges: !1,
                invert: !1,
                forceToAxis: !1,
                sensitivity: 1,
                eventsTarget: "container",
                thresholdDelta: null,
                thresholdTime: null,
                noMousewheelClass: "swiper-no-mousewheel"
            }
        }), t.mousewheel = {
            enabled: !1
        };
        let d, u = l();
        const p = [];
        function f() {
            t.enabled && (t.mouseEntered = !0);
        }
        function h() {
            t.enabled && (t.mouseEntered = !1);
        }
        function m(e) {
            return !(t.params.mousewheel.thresholdDelta && e.delta < t.params.mousewheel.thresholdDelta) && (!(t.params.mousewheel.thresholdTime && l() - u < t.params.mousewheel.thresholdTime) && (e.delta >= 6 && l() - u < 60 || (e.direction < 0 ? t.isEnd && !t.params.loop || t.animating || (t.slideNext(), 
            s("scroll", e.raw)) : t.isBeginning && !t.params.loop || t.animating || (t.slidePrev(), 
            s("scroll", e.raw)), u = (new a.Date).getTime(), !1)));
        }
        function g(e) {
            let i = e, n = !0;
            if (!t.enabled) return;
            if (e.target.closest(`.${t.params.mousewheel.noMousewheelClass}`)) return;
            const r = t.params.mousewheel;
            t.params.cssMode && i.preventDefault();
            let a = t.el;
            "container" !== t.params.mousewheel.eventsTarget && (a = document.querySelector(t.params.mousewheel.eventsTarget));
            const u = a && a.contains(i.target);
            if (!t.mouseEntered && !u && !r.releaseOnEdges) return !0;
            i.originalEvent && (i = i.originalEvent);
            let f = 0;
            const h = t.rtlTranslate ? -1 : 1, g = function(e) {
                let t = 0, i = 0, n = 0, s = 0;
                return "detail" in e && (i = e.detail), "wheelDelta" in e && (i = -e.wheelDelta / 120), 
                "wheelDeltaY" in e && (i = -e.wheelDeltaY / 120), "wheelDeltaX" in e && (t = -e.wheelDeltaX / 120), 
                "axis" in e && e.axis === e.HORIZONTAL_AXIS && (t = i, i = 0), n = 10 * t, s = 10 * i, 
                "deltaY" in e && (s = e.deltaY), "deltaX" in e && (n = e.deltaX), e.shiftKey && !n && (n = s, 
                s = 0), (n || s) && e.deltaMode && (1 === e.deltaMode ? (n *= 40, s *= 40) : (n *= 800, 
                s *= 800)), n && !t && (t = n < 1 ? -1 : 1), s && !i && (i = s < 1 ? -1 : 1), {
                    spinX: t,
                    spinY: i,
                    pixelX: n,
                    pixelY: s
                };
            }(i);
            if (r.forceToAxis) if (t.isHorizontal()) {
                if (!(Math.abs(g.pixelX) > Math.abs(g.pixelY))) return !0;
                f = -g.pixelX * h;
            } else {
                if (!(Math.abs(g.pixelY) > Math.abs(g.pixelX))) return !0;
                f = -g.pixelY;
            } else f = Math.abs(g.pixelX) > Math.abs(g.pixelY) ? -g.pixelX * h : -g.pixelY;
            if (0 === f) return !0;
            r.invert && (f = -f);
            let v = t.getTranslate() + f * r.sensitivity;
            if (v >= t.minTranslate() && (v = t.minTranslate()), v <= t.maxTranslate() && (v = t.maxTranslate()), 
            n = !!t.params.loop || !(v === t.minTranslate() || v === t.maxTranslate()), n && t.params.nested && i.stopPropagation(), 
            t.params.freeMode && t.params.freeMode.enabled) {
                const e = {
                    time: l(),
                    delta: Math.abs(f),
                    direction: Math.sign(f)
                }, n = d && e.time < d.time + 500 && e.delta <= d.delta && e.direction === d.direction;
                if (!n) {
                    d = void 0;
                    let a = t.getTranslate() + f * r.sensitivity;
                    const l = t.isBeginning, u = t.isEnd;
                    if (a >= t.minTranslate() && (a = t.minTranslate()), a <= t.maxTranslate() && (a = t.maxTranslate()), 
                    t.setTransition(0), t.setTranslate(a), t.updateProgress(), t.updateActiveIndex(), 
                    t.updateSlidesClasses(), (!l && t.isBeginning || !u && t.isEnd) && t.updateSlidesClasses(), 
                    t.params.loop && t.loopFix({
                        direction: e.direction < 0 ? "next" : "prev",
                        byMousewheel: !0
                    }), t.params.freeMode.sticky) {
                        clearTimeout(c), c = void 0, p.length >= 15 && p.shift();
                        const i = p.length ? p[p.length - 1] : void 0, n = p[0];
                        if (p.push(e), i && (e.delta > i.delta || e.direction !== i.direction)) p.splice(0); else if (p.length >= 15 && e.time - n.time < 500 && n.delta - e.delta >= 1 && e.delta <= 6) {
                            const i = f > 0 ? .8 : .2;
                            d = e, p.splice(0), c = o((() => {
                                t.slideToClosest(t.params.speed, !0, void 0, i);
                            }), 0);
                        }
                        c || (c = o((() => {
                            d = e, p.splice(0), t.slideToClosest(t.params.speed, !0, void 0, .5);
                        }), 500));
                    }
                    if (n || s("scroll", i), t.params.autoplay && t.params.autoplayDisableOnInteraction && t.autoplay.stop(), 
                    r.releaseOnEdges && (a === t.minTranslate() || a === t.maxTranslate())) return !0;
                }
            } else {
                const i = {
                    time: l(),
                    delta: Math.abs(f),
                    direction: Math.sign(f),
                    raw: e
                };
                p.length >= 2 && p.shift();
                const n = p.length ? p[p.length - 1] : void 0;
                if (p.push(i), n ? (i.direction !== n.direction || i.delta > n.delta || i.time > n.time + 150) && m(i) : m(i), 
                function(e) {
                    const i = t.params.mousewheel;
                    if (e.direction < 0) {
                        if (t.isEnd && !t.params.loop && i.releaseOnEdges) return !0;
                    } else if (t.isBeginning && !t.params.loop && i.releaseOnEdges) return !0;
                    return !1;
                }(i)) return !0;
            }
            return i.preventDefault ? i.preventDefault() : i.returnValue = !1, !1;
        }
        function v(e) {
            let i = t.el;
            "container" !== t.params.mousewheel.eventsTarget && (i = document.querySelector(t.params.mousewheel.eventsTarget)), 
            i[e]("mouseenter", f), i[e]("mouseleave", h), i[e]("wheel", g);
        }
        function y() {
            return t.params.cssMode ? (t.wrapperEl.removeEventListener("wheel", g), !0) : !t.mousewheel.enabled && (v("addEventListener"), 
            t.mousewheel.enabled = !0, !0);
        }
        function b() {
            return t.params.cssMode ? (t.wrapperEl.addEventListener(event, g), !0) : !!t.mousewheel.enabled && (v("removeEventListener"), 
            t.mousewheel.enabled = !1, !0);
        }
        n("init", (() => {
            !t.params.mousewheel.enabled && t.params.cssMode && b(), t.params.mousewheel.enabled && y();
        })), n("destroy", (() => {
            t.params.cssMode && y(), t.mousewheel.enabled && b();
        })), Object.assign(t.mousewheel, {
            enable: y,
            disable: b
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n, emit: s} = e;
        i({
            navigation: {
                nextEl: null,
                prevEl: null,
                hideOnClick: !1,
                disabledClass: "swiper-button-disabled",
                hiddenClass: "swiper-button-hidden",
                lockClass: "swiper-button-lock",
                navigationDisabledClass: "swiper-navigation-disabled"
            }
        }), t.navigation = {
            nextEl: null,
            prevEl: null
        };
        const r = e => (Array.isArray(e) ? e : [ e ]).filter((e => !!e));
        function a(e) {
            let i;
            return e && "string" == typeof e && t.isElement && (i = t.el.querySelector(e), i) ? i : (e && ("string" == typeof e && (i = [ ...document.querySelectorAll(e) ]), 
            t.params.uniqueNavElements && "string" == typeof e && i.length > 1 && 1 === t.el.querySelectorAll(e).length && (i = t.el.querySelector(e))), 
            e && !i ? e : i);
        }
        function o(e, i) {
            const n = t.params.navigation;
            (e = r(e)).forEach((e => {
                e && (e.classList[i ? "add" : "remove"](...n.disabledClass.split(" ")), "BUTTON" === e.tagName && (e.disabled = i), 
                t.params.watchOverflow && t.enabled && e.classList[t.isLocked ? "add" : "remove"](n.lockClass));
            }));
        }
        function l() {
            const {nextEl: e, prevEl: i} = t.navigation;
            if (t.params.loop) return o(i, !1), void o(e, !1);
            o(i, t.isBeginning && !t.params.rewind), o(e, t.isEnd && !t.params.rewind);
        }
        function c(e) {
            e.preventDefault(), (!t.isBeginning || t.params.loop || t.params.rewind) && (t.slidePrev(), 
            s("navigationPrev"));
        }
        function d(e) {
            e.preventDefault(), (!t.isEnd || t.params.loop || t.params.rewind) && (t.slideNext(), 
            s("navigationNext"));
        }
        function u() {
            const e = t.params.navigation;
            if (t.params.navigation = te(t, t.originalParams.navigation, t.params.navigation, {
                nextEl: "swiper-button-next",
                prevEl: "swiper-button-prev"
            }), !e.nextEl && !e.prevEl) return;
            let i = a(e.nextEl), n = a(e.prevEl);
            Object.assign(t.navigation, {
                nextEl: i,
                prevEl: n
            }), i = r(i), n = r(n);
            const s = (i, n) => {
                i && i.addEventListener("click", "next" === n ? d : c), !t.enabled && i && i.classList.add(...e.lockClass.split(" "));
            };
            i.forEach((e => s(e, "next"))), n.forEach((e => s(e, "prev")));
        }
        function p() {
            let {nextEl: e, prevEl: i} = t.navigation;
            e = r(e), i = r(i);
            const n = (e, i) => {
                e.removeEventListener("click", "next" === i ? d : c), e.classList.remove(...t.params.navigation.disabledClass.split(" "));
            };
            e.forEach((e => n(e, "next"))), i.forEach((e => n(e, "prev")));
        }
        n("init", (() => {
            !1 === t.params.navigation.enabled ? f() : (u(), l());
        })), n("toEdge fromEdge lock unlock", (() => {
            l();
        })), n("destroy", (() => {
            p();
        })), n("enable disable", (() => {
            let {nextEl: e, prevEl: i} = t.navigation;
            e = r(e), i = r(i), t.enabled ? l() : [ ...e, ...i ].filter((e => !!e)).forEach((e => e.classList.add(t.params.navigation.lockClass)));
        })), n("click", ((e, i) => {
            let {nextEl: n, prevEl: a} = t.navigation;
            n = r(n), a = r(a);
            const o = i.target;
            if (t.params.navigation.hideOnClick && !a.includes(o) && !n.includes(o)) {
                if (t.pagination && t.params.pagination && t.params.pagination.clickable && (t.pagination.el === o || t.pagination.el.contains(o))) return;
                let e;
                n.length ? e = n[0].classList.contains(t.params.navigation.hiddenClass) : a.length && (e = a[0].classList.contains(t.params.navigation.hiddenClass)), 
                s(!0 === e ? "navigationShow" : "navigationHide"), [ ...n, ...a ].filter((e => !!e)).forEach((e => e.classList.toggle(t.params.navigation.hiddenClass)));
            }
        }));
        const f = () => {
            t.el.classList.add(...t.params.navigation.navigationDisabledClass.split(" ")), p();
        };
        Object.assign(t.navigation, {
            enable: () => {
                t.el.classList.remove(...t.params.navigation.navigationDisabledClass.split(" ")), 
                u(), l();
            },
            disable: f,
            update: l,
            init: u,
            destroy: p
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n, emit: s} = e;
        const r = "swiper-pagination";
        let a;
        i({
            pagination: {
                el: null,
                bulletElement: "span",
                clickable: !1,
                hideOnClick: !1,
                renderBullet: null,
                renderProgressbar: null,
                renderFraction: null,
                renderCustom: null,
                progressbarOpposite: !1,
                type: "bullets",
                dynamicBullets: !1,
                dynamicMainBullets: 1,
                formatFractionCurrent: e => e,
                formatFractionTotal: e => e,
                bulletClass: `${r}-bullet`,
                bulletActiveClass: `${r}-bullet-active`,
                modifierClass: `${r}-`,
                currentClass: `${r}-current`,
                totalClass: `${r}-total`,
                hiddenClass: `${r}-hidden`,
                progressbarFillClass: `${r}-progressbar-fill`,
                progressbarOppositeClass: `${r}-progressbar-opposite`,
                clickableClass: `${r}-clickable`,
                lockClass: `${r}-lock`,
                horizontalClass: `${r}-horizontal`,
                verticalClass: `${r}-vertical`,
                paginationDisabledClass: `${r}-disabled`
            }
        }), t.pagination = {
            el: null,
            bullets: []
        };
        let o = 0;
        const l = e => (Array.isArray(e) ? e : [ e ]).filter((e => !!e));
        function c() {
            return !t.params.pagination.el || !t.pagination.el || Array.isArray(t.pagination.el) && 0 === t.pagination.el.length;
        }
        function d(e, i) {
            const {bulletActiveClass: n} = t.params.pagination;
            e && (e = e[("prev" === i ? "previous" : "next") + "ElementSibling"]) && (e.classList.add(`${n}-${i}`), 
            (e = e[("prev" === i ? "previous" : "next") + "ElementSibling"]) && e.classList.add(`${n}-${i}-${i}`));
        }
        function u(e) {
            const i = e.target.closest(ie(t.params.pagination.bulletClass));
            if (!i) return;
            e.preventDefault();
            const n = w(i) * t.params.slidesPerGroup;
            if (t.params.loop) {
                if (t.realIndex === n) return;
                t.slideToLoop(n);
            } else t.slideTo(n);
        }
        function p() {
            const e = t.rtl, i = t.params.pagination;
            if (c()) return;
            let n, r, u = t.pagination.el;
            u = l(u);
            const p = t.virtual && t.params.virtual.enabled ? t.virtual.slides.length : t.slides.length, f = t.params.loop ? Math.ceil(p / t.params.slidesPerGroup) : t.snapGrid.length;
            if (t.params.loop ? (r = t.previousRealIndex || 0, n = t.params.slidesPerGroup > 1 ? Math.floor(t.realIndex / t.params.slidesPerGroup) : t.realIndex) : void 0 !== t.snapIndex ? (n = t.snapIndex, 
            r = t.previousSnapIndex) : (r = t.previousIndex || 0, n = t.activeIndex || 0), "bullets" === i.type && t.pagination.bullets && t.pagination.bullets.length > 0) {
                const s = t.pagination.bullets;
                let l, c, p;
                if (i.dynamicBullets && (a = _(s[0], t.isHorizontal() ? "width" : "height", !0), 
                u.forEach((e => {
                    e.style[t.isHorizontal() ? "width" : "height"] = a * (i.dynamicMainBullets + 4) + "px";
                })), i.dynamicMainBullets > 1 && void 0 !== r && (o += n - (r || 0), o > i.dynamicMainBullets - 1 ? o = i.dynamicMainBullets - 1 : o < 0 && (o = 0)), 
                l = Math.max(n - o, 0), c = l + (Math.min(s.length, i.dynamicMainBullets) - 1), 
                p = (c + l) / 2), s.forEach((e => {
                    const t = [ ...[ "", "-next", "-next-next", "-prev", "-prev-prev", "-main" ].map((e => `${i.bulletActiveClass}${e}`)) ].map((e => "string" == typeof e && e.includes(" ") ? e.split(" ") : e)).flat();
                    e.classList.remove(...t);
                })), u.length > 1) s.forEach((e => {
                    const s = w(e);
                    s === n ? e.classList.add(...i.bulletActiveClass.split(" ")) : t.isElement && e.setAttribute("part", "bullet"), 
                    i.dynamicBullets && (s >= l && s <= c && e.classList.add(...`${i.bulletActiveClass}-main`.split(" ")), 
                    s === l && d(e, "prev"), s === c && d(e, "next"));
                })); else {
                    const e = s[n];
                    if (e && e.classList.add(...i.bulletActiveClass.split(" ")), t.isElement && s.forEach(((e, t) => {
                        e.setAttribute("part", t === n ? "bullet-active" : "bullet");
                    })), i.dynamicBullets) {
                        const e = s[l], t = s[c];
                        for (let e = l; e <= c; e += 1) s[e] && s[e].classList.add(...`${i.bulletActiveClass}-main`.split(" "));
                        d(e, "prev"), d(t, "next");
                    }
                }
                if (i.dynamicBullets) {
                    const n = Math.min(s.length, i.dynamicMainBullets + 4), r = (a * n - a) / 2 - p * a, o = e ? "right" : "left";
                    s.forEach((e => {
                        e.style[t.isHorizontal() ? o : "top"] = `${r}px`;
                    }));
                }
            }
            u.forEach(((e, r) => {
                if ("fraction" === i.type && (e.querySelectorAll(ie(i.currentClass)).forEach((e => {
                    e.textContent = i.formatFractionCurrent(n + 1);
                })), e.querySelectorAll(ie(i.totalClass)).forEach((e => {
                    e.textContent = i.formatFractionTotal(f);
                }))), "progressbar" === i.type) {
                    let s;
                    s = i.progressbarOpposite ? t.isHorizontal() ? "vertical" : "horizontal" : t.isHorizontal() ? "horizontal" : "vertical";
                    const r = (n + 1) / f;
                    let a = 1, o = 1;
                    "horizontal" === s ? a = r : o = r, e.querySelectorAll(ie(i.progressbarFillClass)).forEach((e => {
                        e.style.transform = `translate3d(0,0,0) scaleX(${a}) scaleY(${o})`, e.style.transitionDuration = `${t.params.speed}ms`;
                    }));
                }
                "custom" === i.type && i.renderCustom ? (e.innerHTML = i.renderCustom(t, n + 1, f), 
                0 === r && s("paginationRender", e)) : (0 === r && s("paginationRender", e), s("paginationUpdate", e)), 
                t.params.watchOverflow && t.enabled && e.classList[t.isLocked ? "add" : "remove"](i.lockClass);
            }));
        }
        function f() {
            const e = t.params.pagination;
            if (c()) return;
            const i = t.virtual && t.params.virtual.enabled ? t.virtual.slides.length : t.grid && t.params.grid.rows > 1 ? t.slides.length / Math.ceil(t.params.grid.rows) : t.slides.length;
            let n = t.pagination.el;
            n = l(n);
            let r = "";
            if ("bullets" === e.type) {
                let n = t.params.loop ? Math.ceil(i / t.params.slidesPerGroup) : t.snapGrid.length;
                t.params.freeMode && t.params.freeMode.enabled && n > i && (n = i);
                for (let i = 0; i < n; i += 1) e.renderBullet ? r += e.renderBullet.call(t, i, e.bulletClass) : r += `<${e.bulletElement} ${t.isElement ? 'part="bullet"' : ""} class="${e.bulletClass}"></${e.bulletElement}>`;
            }
            "fraction" === e.type && (r = e.renderFraction ? e.renderFraction.call(t, e.currentClass, e.totalClass) : `<span class="${e.currentClass}"></span> / <span class="${e.totalClass}"></span>`), 
            "progressbar" === e.type && (r = e.renderProgressbar ? e.renderProgressbar.call(t, e.progressbarFillClass) : `<span class="${e.progressbarFillClass}"></span>`), 
            t.pagination.bullets = [], n.forEach((i => {
                "custom" !== e.type && (i.innerHTML = r || ""), "bullets" === e.type && t.pagination.bullets.push(...i.querySelectorAll(ie(e.bulletClass)));
            })), "custom" !== e.type && s("paginationRender", n[0]);
        }
        function h() {
            t.params.pagination = te(t, t.originalParams.pagination, t.params.pagination, {
                el: "swiper-pagination"
            });
            const e = t.params.pagination;
            if (!e.el) return;
            let i;
            "string" == typeof e.el && t.isElement && (i = t.el.querySelector(e.el)), i || "string" != typeof e.el || (i = [ ...document.querySelectorAll(e.el) ]), 
            i || (i = e.el), i && 0 !== i.length && (t.params.uniqueNavElements && "string" == typeof e.el && Array.isArray(i) && i.length > 1 && (i = [ ...t.el.querySelectorAll(e.el) ], 
            i.length > 1 && (i = i.filter((e => x(e, ".swiper")[0] === t.el))[0])), Array.isArray(i) && 1 === i.length && (i = i[0]), 
            Object.assign(t.pagination, {
                el: i
            }), i = l(i), i.forEach((i => {
                "bullets" === e.type && e.clickable && i.classList.add(...(e.clickableClass || "").split(" ")), 
                i.classList.add(e.modifierClass + e.type), i.classList.add(t.isHorizontal() ? e.horizontalClass : e.verticalClass), 
                "bullets" === e.type && e.dynamicBullets && (i.classList.add(`${e.modifierClass}${e.type}-dynamic`), 
                o = 0, e.dynamicMainBullets < 1 && (e.dynamicMainBullets = 1)), "progressbar" === e.type && e.progressbarOpposite && i.classList.add(e.progressbarOppositeClass), 
                e.clickable && i.addEventListener("click", u), t.enabled || i.classList.add(e.lockClass);
            })));
        }
        function m() {
            const e = t.params.pagination;
            if (c()) return;
            let i = t.pagination.el;
            i && (i = l(i), i.forEach((i => {
                i.classList.remove(e.hiddenClass), i.classList.remove(e.modifierClass + e.type), 
                i.classList.remove(t.isHorizontal() ? e.horizontalClass : e.verticalClass), e.clickable && (i.classList.remove(...(e.clickableClass || "").split(" ")), 
                i.removeEventListener("click", u));
            }))), t.pagination.bullets && t.pagination.bullets.forEach((t => t.classList.remove(...e.bulletActiveClass.split(" "))));
        }
        n("changeDirection", (() => {
            if (!t.pagination || !t.pagination.el) return;
            const e = t.params.pagination;
            let {el: i} = t.pagination;
            i = l(i), i.forEach((i => {
                i.classList.remove(e.horizontalClass, e.verticalClass), i.classList.add(t.isHorizontal() ? e.horizontalClass : e.verticalClass);
            }));
        })), n("init", (() => {
            !1 === t.params.pagination.enabled ? g() : (h(), f(), p());
        })), n("activeIndexChange", (() => {
            void 0 === t.snapIndex && p();
        })), n("snapIndexChange", (() => {
            p();
        })), n("snapGridLengthChange", (() => {
            f(), p();
        })), n("destroy", (() => {
            m();
        })), n("enable disable", (() => {
            let {el: e} = t.pagination;
            e && (e = l(e), e.forEach((e => e.classList[t.enabled ? "remove" : "add"](t.params.pagination.lockClass))));
        })), n("lock unlock", (() => {
            p();
        })), n("click", ((e, i) => {
            const n = i.target, r = l(t.pagination.el);
            if (t.params.pagination.el && t.params.pagination.hideOnClick && r && r.length > 0 && !n.classList.contains(t.params.pagination.bulletClass)) {
                if (t.navigation && (t.navigation.nextEl && n === t.navigation.nextEl || t.navigation.prevEl && n === t.navigation.prevEl)) return;
                const e = r[0].classList.contains(t.params.pagination.hiddenClass);
                s(!0 === e ? "paginationShow" : "paginationHide"), r.forEach((e => e.classList.toggle(t.params.pagination.hiddenClass)));
            }
        }));
        const g = () => {
            t.el.classList.add(t.params.pagination.paginationDisabledClass);
            let {el: e} = t.pagination;
            e && (e = l(e), e.forEach((e => e.classList.add(t.params.pagination.paginationDisabledClass)))), 
            m();
        };
        Object.assign(t.pagination, {
            enable: () => {
                t.el.classList.remove(t.params.pagination.paginationDisabledClass);
                let {el: e} = t.pagination;
                e && (e = l(e), e.forEach((e => e.classList.remove(t.params.pagination.paginationDisabledClass)))), 
                h(), f(), p();
            },
            disable: g,
            render: f,
            update: p,
            init: h,
            destroy: m
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: s, emit: r} = e;
        const l = n();
        let c, d, u, p, f = !1, h = null, m = null;
        function g() {
            if (!t.params.scrollbar.el || !t.scrollbar.el) return;
            const {scrollbar: e, rtlTranslate: i} = t, {dragEl: n, el: s} = e, r = t.params.scrollbar, a = t.params.loop ? t.progressLoop : t.progress;
            let o = d, l = (u - d) * a;
            i ? (l = -l, l > 0 ? (o = d - l, l = 0) : -l + d > u && (o = u + l)) : l < 0 ? (o = d + l, 
            l = 0) : l + d > u && (o = u - l), t.isHorizontal() ? (n.style.transform = `translate3d(${l}px, 0, 0)`, 
            n.style.width = `${o}px`) : (n.style.transform = `translate3d(0px, ${l}px, 0)`, 
            n.style.height = `${o}px`), r.hide && (clearTimeout(h), s.style.opacity = 1, h = setTimeout((() => {
                s.style.opacity = 0, s.style.transitionDuration = "400ms";
            }), 1e3));
        }
        function b() {
            if (!t.params.scrollbar.el || !t.scrollbar.el) return;
            const {scrollbar: e} = t, {dragEl: i, el: n} = e;
            i.style.width = "", i.style.height = "", u = t.isHorizontal() ? n.offsetWidth : n.offsetHeight, 
            p = t.size / (t.virtualSize + t.params.slidesOffsetBefore - (t.params.centeredSlides ? t.snapGrid[0] : 0)), 
            d = "auto" === t.params.scrollbar.dragSize ? u * p : parseInt(t.params.scrollbar.dragSize, 10), 
            t.isHorizontal() ? i.style.width = `${d}px` : i.style.height = `${d}px`, n.style.display = p >= 1 ? "none" : "", 
            t.params.scrollbar.hide && (n.style.opacity = 0), t.params.watchOverflow && t.enabled && e.el.classList[t.isLocked ? "add" : "remove"](t.params.scrollbar.lockClass);
        }
        function w(e) {
            return t.isHorizontal() ? e.clientX : e.clientY;
        }
        function x(e) {
            const {scrollbar: i, rtlTranslate: n} = t, {el: s} = i;
            let r;
            r = (w(e) - y(s)[t.isHorizontal() ? "left" : "top"] - (null !== c ? c : d / 2)) / (u - d), 
            r = Math.max(Math.min(r, 1), 0), n && (r = 1 - r);
            const a = t.minTranslate() + (t.maxTranslate() - t.minTranslate()) * r;
            t.updateProgress(a), t.setTranslate(a), t.updateActiveIndex(), t.updateSlidesClasses();
        }
        function E(e) {
            const i = t.params.scrollbar, {scrollbar: n, wrapperEl: s} = t, {el: a, dragEl: o} = n;
            f = !0, c = e.target === o ? w(e) - e.target.getBoundingClientRect()[t.isHorizontal() ? "left" : "top"] : null, 
            e.preventDefault(), e.stopPropagation(), s.style.transitionDuration = "100ms", o.style.transitionDuration = "100ms", 
            x(e), clearTimeout(m), a.style.transitionDuration = "0ms", i.hide && (a.style.opacity = 1), 
            t.params.cssMode && (t.wrapperEl.style["scroll-snap-type"] = "none"), r("scrollbarDragStart", e);
        }
        function _(e) {
            const {scrollbar: i, wrapperEl: n} = t, {el: s, dragEl: a} = i;
            f && (e.preventDefault ? e.preventDefault() : e.returnValue = !1, x(e), n.style.transitionDuration = "0ms", 
            s.style.transitionDuration = "0ms", a.style.transitionDuration = "0ms", r("scrollbarDragMove", e));
        }
        function T(e) {
            const i = t.params.scrollbar, {scrollbar: n, wrapperEl: s} = t, {el: a} = n;
            f && (f = !1, t.params.cssMode && (t.wrapperEl.style["scroll-snap-type"] = "", s.style.transitionDuration = ""), 
            i.hide && (clearTimeout(m), m = o((() => {
                a.style.opacity = 0, a.style.transitionDuration = "400ms";
            }), 1e3)), r("scrollbarDragEnd", e), i.snapOnRelease && t.slideToClosest());
        }
        function S(e) {
            const {scrollbar: i, params: n} = t, s = i.el;
            if (!s) return;
            const r = s, a = !!n.passiveListeners && {
                passive: !1,
                capture: !1
            }, o = !!n.passiveListeners && {
                passive: !0,
                capture: !1
            };
            if (!r) return;
            const c = "on" === e ? "addEventListener" : "removeEventListener";
            r[c]("pointerdown", E, a), l[c]("pointermove", _, a), l[c]("pointerup", T, o);
        }
        function C() {
            const {scrollbar: e, el: i} = t;
            t.params.scrollbar = te(t, t.originalParams.scrollbar, t.params.scrollbar, {
                el: "swiper-scrollbar"
            });
            const n = t.params.scrollbar;
            if (!n.el) return;
            let s, r;
            if ("string" == typeof n.el && t.isElement && (s = t.el.querySelector(n.el)), s || "string" != typeof n.el) s || (s = n.el); else if (s = l.querySelectorAll(n.el), 
            !s.length) return;
            t.params.uniqueNavElements && "string" == typeof n.el && s.length > 1 && 1 === i.querySelectorAll(n.el).length && (s = i.querySelector(n.el)), 
            s.length > 0 && (s = s[0]), s.classList.add(t.isHorizontal() ? n.horizontalClass : n.verticalClass), 
            s && (r = s.querySelector(ie(t.params.scrollbar.dragClass)), r || (r = v("div", t.params.scrollbar.dragClass), 
            s.append(r))), Object.assign(e, {
                el: s,
                dragEl: r
            }), n.draggable && t.params.scrollbar.el && t.scrollbar.el && S("on"), s && s.classList[t.enabled ? "remove" : "add"](...a(t.params.scrollbar.lockClass));
        }
        function M() {
            const e = t.params.scrollbar, i = t.scrollbar.el;
            i && i.classList.remove(...a(t.isHorizontal() ? e.horizontalClass : e.verticalClass)), 
            t.params.scrollbar.el && t.scrollbar.el && S("off");
        }
        i({
            scrollbar: {
                el: null,
                dragSize: "auto",
                hide: !1,
                draggable: !1,
                snapOnRelease: !0,
                lockClass: "swiper-scrollbar-lock",
                dragClass: "swiper-scrollbar-drag",
                scrollbarDisabledClass: "swiper-scrollbar-disabled",
                horizontalClass: "swiper-scrollbar-horizontal",
                verticalClass: "swiper-scrollbar-vertical"
            }
        }), t.scrollbar = {
            el: null,
            dragEl: null
        }, s("init", (() => {
            !1 === t.params.scrollbar.enabled ? A() : (C(), b(), g());
        })), s("update resize observerUpdate lock unlock", (() => {
            b();
        })), s("setTranslate", (() => {
            g();
        })), s("setTransition", ((e, i) => {
            !function(e) {
                t.params.scrollbar.el && t.scrollbar.el && (t.scrollbar.dragEl.style.transitionDuration = `${e}ms`);
            }(i);
        })), s("enable disable", (() => {
            const {el: e} = t.scrollbar;
            e && e.classList[t.enabled ? "remove" : "add"](...a(t.params.scrollbar.lockClass));
        })), s("destroy", (() => {
            M();
        }));
        const A = () => {
            t.el.classList.add(...a(t.params.scrollbar.scrollbarDisabledClass)), t.scrollbar.el && t.scrollbar.el.classList.add(...a(t.params.scrollbar.scrollbarDisabledClass)), 
            M();
        };
        Object.assign(t.scrollbar, {
            enable: () => {
                t.el.classList.remove(...a(t.params.scrollbar.scrollbarDisabledClass)), t.scrollbar.el && t.scrollbar.el.classList.remove(...a(t.params.scrollbar.scrollbarDisabledClass)), 
                C(), b(), g();
            },
            disable: A,
            updateSize: b,
            setTranslate: g,
            init: C,
            destroy: M
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            parallax: {
                enabled: !1
            }
        });
        const s = "[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y], [data-swiper-parallax-opacity], [data-swiper-parallax-scale]", r = (e, i) => {
            const {rtl: n} = t, s = n ? -1 : 1, r = e.getAttribute("data-swiper-parallax") || "0";
            let a = e.getAttribute("data-swiper-parallax-x"), o = e.getAttribute("data-swiper-parallax-y");
            const l = e.getAttribute("data-swiper-parallax-scale"), c = e.getAttribute("data-swiper-parallax-opacity"), d = e.getAttribute("data-swiper-parallax-rotate");
            if (a || o ? (a = a || "0", o = o || "0") : t.isHorizontal() ? (a = r, o = "0") : (o = r, 
            a = "0"), a = a.indexOf("%") >= 0 ? parseInt(a, 10) * i * s + "%" : a * i * s + "px", 
            o = o.indexOf("%") >= 0 ? parseInt(o, 10) * i + "%" : o * i + "px", null != c) {
                const t = c - (c - 1) * (1 - Math.abs(i));
                e.style.opacity = t;
            }
            let u = `translate3d(${a}, ${o}, 0px)`;
            if (null != l) {
                u += ` scale(${l - (l - 1) * (1 - Math.abs(i))})`;
            }
            if (d && null != d) {
                u += ` rotate(${d * i * -1}deg)`;
            }
            e.style.transform = u;
        }, a = () => {
            const {el: e, slides: i, progress: n, snapGrid: a, isElement: o} = t, l = m(e, s);
            t.isElement && l.push(...m(t.hostEl, s)), l.forEach((e => {
                r(e, n);
            })), i.forEach(((e, i) => {
                let o = e.progress;
                t.params.slidesPerGroup > 1 && "auto" !== t.params.slidesPerView && (o += Math.ceil(i / 2) - n * (a.length - 1)), 
                o = Math.min(Math.max(o, -1), 1), e.querySelectorAll(`${s}, [data-swiper-parallax-rotate]`).forEach((e => {
                    r(e, o);
                }));
            }));
        };
        n("beforeInit", (() => {
            t.params.parallax.enabled && (t.params.watchSlidesProgress = !0, t.originalParams.watchSlidesProgress = !0);
        })), n("init", (() => {
            t.params.parallax.enabled && a();
        })), n("setTranslate", (() => {
            t.params.parallax.enabled && a();
        })), n("setTransition", ((e, i) => {
            t.params.parallax.enabled && function(e) {
                void 0 === e && (e = t.params.speed);
                const {el: i, hostEl: n} = t, r = [ ...i.querySelectorAll(s) ];
                t.isElement && r.push(...n.querySelectorAll(s)), r.forEach((t => {
                    let i = parseInt(t.getAttribute("data-swiper-parallax-duration"), 10) || e;
                    0 === e && (i = 0), t.style.transitionDuration = `${i}ms`;
                }));
            }(i);
        }));
    }, function(e) {
        let {swiper: t, extendParams: i, on: n, emit: s} = e;
        const a = r();
        i({
            zoom: {
                enabled: !1,
                maxRatio: 3,
                minRatio: 1,
                toggle: !0,
                containerClass: "swiper-zoom-container",
                zoomedSlideClass: "swiper-slide-zoomed"
            }
        }), t.zoom = {
            enabled: !1
        };
        let o, l, d = 1, u = !1;
        const p = [], f = {
            originX: 0,
            originY: 0,
            slideEl: void 0,
            slideWidth: void 0,
            slideHeight: void 0,
            imageEl: void 0,
            imageWrapEl: void 0,
            maxRatio: 3
        }, h = {
            isTouched: void 0,
            isMoved: void 0,
            currentX: void 0,
            currentY: void 0,
            minX: void 0,
            minY: void 0,
            maxX: void 0,
            maxY: void 0,
            width: void 0,
            height: void 0,
            startX: void 0,
            startY: void 0,
            touchesStart: {},
            touchesCurrent: {}
        }, g = {
            x: void 0,
            y: void 0,
            prevPositionX: void 0,
            prevPositionY: void 0,
            prevTime: void 0
        };
        let v = 1;
        function b() {
            if (p.length < 2) return 1;
            const e = p[0].pageX, t = p[0].pageY, i = p[1].pageX, n = p[1].pageY;
            return Math.sqrt((i - e) ** 2 + (n - t) ** 2);
        }
        function w(e) {
            const i = t.isElement ? "swiper-slide" : `.${t.params.slideClass}`;
            return !!e.target.matches(i) || t.slides.filter((t => t.contains(e.target))).length > 0;
        }
        function E(e) {
            if ("mouse" === e.pointerType && p.splice(0, p.length), !w(e)) return;
            const i = t.params.zoom;
            if (o = !1, l = !1, p.push(e), !(p.length < 2)) {
                if (o = !0, f.scaleStart = b(), !f.slideEl) {
                    f.slideEl = e.target.closest(`.${t.params.slideClass}, swiper-slide`), f.slideEl || (f.slideEl = t.slides[t.activeIndex]);
                    let n = f.slideEl.querySelector(`.${i.containerClass}`);
                    if (n && (n = n.querySelectorAll("picture, img, svg, canvas, .swiper-zoom-target")[0]), 
                    f.imageEl = n, f.imageWrapEl = n ? x(f.imageEl, `.${i.containerClass}`)[0] : void 0, 
                    !f.imageWrapEl) return void (f.imageEl = void 0);
                    f.maxRatio = f.imageWrapEl.getAttribute("data-swiper-zoom") || i.maxRatio;
                }
                if (f.imageEl) {
                    const [e, t] = function() {
                        if (p.length < 2) return {
                            x: null,
                            y: null
                        };
                        const e = f.imageEl.getBoundingClientRect();
                        return [ (p[0].pageX + (p[1].pageX - p[0].pageX) / 2 - e.x - a.scrollX) / d, (p[0].pageY + (p[1].pageY - p[0].pageY) / 2 - e.y - a.scrollY) / d ];
                    }();
                    f.originX = e, f.originY = t, f.imageEl.style.transitionDuration = "0ms";
                }
                u = !0;
            }
        }
        function _(e) {
            if (!w(e)) return;
            const i = t.params.zoom, n = t.zoom, s = p.findIndex((t => t.pointerId === e.pointerId));
            s >= 0 && (p[s] = e), p.length < 2 || (l = !0, f.scaleMove = b(), f.imageEl && (n.scale = f.scaleMove / f.scaleStart * d, 
            n.scale > f.maxRatio && (n.scale = f.maxRatio - 1 + (n.scale - f.maxRatio + 1) ** .5), 
            n.scale < i.minRatio && (n.scale = i.minRatio + 1 - (i.minRatio - n.scale + 1) ** .5), 
            f.imageEl.style.transform = `translate3d(0,0,0) scale(${n.scale})`));
        }
        function T(e) {
            if (!w(e)) return;
            if ("mouse" === e.pointerType && "pointerout" === e.type) return;
            const i = t.params.zoom, n = t.zoom, s = p.findIndex((t => t.pointerId === e.pointerId));
            s >= 0 && p.splice(s, 1), o && l && (o = !1, l = !1, f.imageEl && (n.scale = Math.max(Math.min(n.scale, f.maxRatio), i.minRatio), 
            f.imageEl.style.transitionDuration = `${t.params.speed}ms`, f.imageEl.style.transform = `translate3d(0,0,0) scale(${n.scale})`, 
            d = n.scale, u = !1, n.scale > 1 && f.slideEl ? f.slideEl.classList.add(`${i.zoomedSlideClass}`) : n.scale <= 1 && f.slideEl && f.slideEl.classList.remove(`${i.zoomedSlideClass}`), 
            1 === n.scale && (f.originX = 0, f.originY = 0, f.slideEl = void 0)));
        }
        function S(e) {
            if (!w(e) || !function(e) {
                const i = `.${t.params.zoom.containerClass}`;
                return !!e.target.matches(i) || [ ...t.hostEl.querySelectorAll(i) ].filter((t => t.contains(e.target))).length > 0;
            }(e)) return;
            const i = t.zoom;
            if (!f.imageEl) return;
            if (!h.isTouched || !f.slideEl) return;
            h.isMoved || (h.width = f.imageEl.offsetWidth, h.height = f.imageEl.offsetHeight, 
            h.startX = c(f.imageWrapEl, "x") || 0, h.startY = c(f.imageWrapEl, "y") || 0, f.slideWidth = f.slideEl.offsetWidth, 
            f.slideHeight = f.slideEl.offsetHeight, f.imageWrapEl.style.transitionDuration = "0ms");
            const n = h.width * i.scale, s = h.height * i.scale;
            if (n < f.slideWidth && s < f.slideHeight) return;
            h.minX = Math.min(f.slideWidth / 2 - n / 2, 0), h.maxX = -h.minX, h.minY = Math.min(f.slideHeight / 2 - s / 2, 0), 
            h.maxY = -h.minY, h.touchesCurrent.x = p.length > 0 ? p[0].pageX : e.pageX, h.touchesCurrent.y = p.length > 0 ? p[0].pageY : e.pageY;
            if (Math.max(Math.abs(h.touchesCurrent.x - h.touchesStart.x), Math.abs(h.touchesCurrent.y - h.touchesStart.y)) > 5 && (t.allowClick = !1), 
            !h.isMoved && !u) {
                if (t.isHorizontal() && (Math.floor(h.minX) === Math.floor(h.startX) && h.touchesCurrent.x < h.touchesStart.x || Math.floor(h.maxX) === Math.floor(h.startX) && h.touchesCurrent.x > h.touchesStart.x)) return void (h.isTouched = !1);
                if (!t.isHorizontal() && (Math.floor(h.minY) === Math.floor(h.startY) && h.touchesCurrent.y < h.touchesStart.y || Math.floor(h.maxY) === Math.floor(h.startY) && h.touchesCurrent.y > h.touchesStart.y)) return void (h.isTouched = !1);
            }
            e.cancelable && e.preventDefault(), e.stopPropagation(), h.isMoved = !0;
            const r = (i.scale - d) / (f.maxRatio - t.params.zoom.minRatio), {originX: a, originY: o} = f;
            h.currentX = h.touchesCurrent.x - h.touchesStart.x + h.startX + r * (h.width - 2 * a), 
            h.currentY = h.touchesCurrent.y - h.touchesStart.y + h.startY + r * (h.height - 2 * o), 
            h.currentX < h.minX && (h.currentX = h.minX + 1 - (h.minX - h.currentX + 1) ** .8), 
            h.currentX > h.maxX && (h.currentX = h.maxX - 1 + (h.currentX - h.maxX + 1) ** .8), 
            h.currentY < h.minY && (h.currentY = h.minY + 1 - (h.minY - h.currentY + 1) ** .8), 
            h.currentY > h.maxY && (h.currentY = h.maxY - 1 + (h.currentY - h.maxY + 1) ** .8), 
            g.prevPositionX || (g.prevPositionX = h.touchesCurrent.x), g.prevPositionY || (g.prevPositionY = h.touchesCurrent.y), 
            g.prevTime || (g.prevTime = Date.now()), g.x = (h.touchesCurrent.x - g.prevPositionX) / (Date.now() - g.prevTime) / 2, 
            g.y = (h.touchesCurrent.y - g.prevPositionY) / (Date.now() - g.prevTime) / 2, Math.abs(h.touchesCurrent.x - g.prevPositionX) < 2 && (g.x = 0), 
            Math.abs(h.touchesCurrent.y - g.prevPositionY) < 2 && (g.y = 0), g.prevPositionX = h.touchesCurrent.x, 
            g.prevPositionY = h.touchesCurrent.y, g.prevTime = Date.now(), f.imageWrapEl.style.transform = `translate3d(${h.currentX}px, ${h.currentY}px,0)`;
        }
        function C() {
            const e = t.zoom;
            f.slideEl && t.activeIndex !== t.slides.indexOf(f.slideEl) && (f.imageEl && (f.imageEl.style.transform = "translate3d(0,0,0) scale(1)"), 
            f.imageWrapEl && (f.imageWrapEl.style.transform = "translate3d(0,0,0)"), f.slideEl.classList.remove(`${t.params.zoom.zoomedSlideClass}`), 
            e.scale = 1, d = 1, f.slideEl = void 0, f.imageEl = void 0, f.imageWrapEl = void 0, 
            f.originX = 0, f.originY = 0);
        }
        function M(e) {
            const i = t.zoom, n = t.params.zoom;
            if (!f.slideEl) {
                e && e.target && (f.slideEl = e.target.closest(`.${t.params.slideClass}, swiper-slide`)), 
                f.slideEl || (t.params.virtual && t.params.virtual.enabled && t.virtual ? f.slideEl = m(t.slidesEl, `.${t.params.slideActiveClass}`)[0] : f.slideEl = t.slides[t.activeIndex]);
                let i = f.slideEl.querySelector(`.${n.containerClass}`);
                i && (i = i.querySelectorAll("picture, img, svg, canvas, .swiper-zoom-target")[0]), 
                f.imageEl = i, f.imageWrapEl = i ? x(f.imageEl, `.${n.containerClass}`)[0] : void 0;
            }
            if (!f.imageEl || !f.imageWrapEl) return;
            let s, r, o, l, c, u, p, g, v, b, w, E, _, T, S, C, M, A;
            t.params.cssMode && (t.wrapperEl.style.overflow = "hidden", t.wrapperEl.style.touchAction = "none"), 
            f.slideEl.classList.add(`${n.zoomedSlideClass}`), void 0 === h.touchesStart.x && e ? (s = e.pageX, 
            r = e.pageY) : (s = h.touchesStart.x, r = h.touchesStart.y);
            const k = "number" == typeof e ? e : null;
            1 === d && k && (s = void 0, r = void 0), i.scale = k || f.imageWrapEl.getAttribute("data-swiper-zoom") || n.maxRatio, 
            d = k || f.imageWrapEl.getAttribute("data-swiper-zoom") || n.maxRatio, !e || 1 === d && k ? (p = 0, 
            g = 0) : (M = f.slideEl.offsetWidth, A = f.slideEl.offsetHeight, o = y(f.slideEl).left + a.scrollX, 
            l = y(f.slideEl).top + a.scrollY, c = o + M / 2 - s, u = l + A / 2 - r, v = f.imageEl.offsetWidth, 
            b = f.imageEl.offsetHeight, w = v * i.scale, E = b * i.scale, _ = Math.min(M / 2 - w / 2, 0), 
            T = Math.min(A / 2 - E / 2, 0), S = -_, C = -T, p = c * i.scale, g = u * i.scale, 
            p < _ && (p = _), p > S && (p = S), g < T && (g = T), g > C && (g = C)), k && 1 === i.scale && (f.originX = 0, 
            f.originY = 0), f.imageWrapEl.style.transitionDuration = "300ms", f.imageWrapEl.style.transform = `translate3d(${p}px, ${g}px,0)`, 
            f.imageEl.style.transitionDuration = "300ms", f.imageEl.style.transform = `translate3d(0,0,0) scale(${i.scale})`;
        }
        function A() {
            const e = t.zoom, i = t.params.zoom;
            if (!f.slideEl) {
                t.params.virtual && t.params.virtual.enabled && t.virtual ? f.slideEl = m(t.slidesEl, `.${t.params.slideActiveClass}`)[0] : f.slideEl = t.slides[t.activeIndex];
                let e = f.slideEl.querySelector(`.${i.containerClass}`);
                e && (e = e.querySelectorAll("picture, img, svg, canvas, .swiper-zoom-target")[0]), 
                f.imageEl = e, f.imageWrapEl = e ? x(f.imageEl, `.${i.containerClass}`)[0] : void 0;
            }
            f.imageEl && f.imageWrapEl && (t.params.cssMode && (t.wrapperEl.style.overflow = "", 
            t.wrapperEl.style.touchAction = ""), e.scale = 1, d = 1, f.imageWrapEl.style.transitionDuration = "300ms", 
            f.imageWrapEl.style.transform = "translate3d(0,0,0)", f.imageEl.style.transitionDuration = "300ms", 
            f.imageEl.style.transform = "translate3d(0,0,0) scale(1)", f.slideEl.classList.remove(`${i.zoomedSlideClass}`), 
            f.slideEl = void 0, f.originX = 0, f.originY = 0);
        }
        function k(e) {
            const i = t.zoom;
            i.scale && 1 !== i.scale ? A() : M(e);
        }
        function L() {
            return {
                passiveListener: !!t.params.passiveListeners && {
                    passive: !0,
                    capture: !1
                },
                activeListenerWithCapture: !t.params.passiveListeners || {
                    passive: !1,
                    capture: !0
                }
            };
        }
        function P() {
            const e = t.zoom;
            if (e.enabled) return;
            e.enabled = !0;
            const {passiveListener: i, activeListenerWithCapture: n} = L();
            t.wrapperEl.addEventListener("pointerdown", E, i), t.wrapperEl.addEventListener("pointermove", _, n), 
            [ "pointerup", "pointercancel", "pointerout" ].forEach((e => {
                t.wrapperEl.addEventListener(e, T, i);
            })), t.wrapperEl.addEventListener("pointermove", S, n);
        }
        function O() {
            const e = t.zoom;
            if (!e.enabled) return;
            e.enabled = !1;
            const {passiveListener: i, activeListenerWithCapture: n} = L();
            t.wrapperEl.removeEventListener("pointerdown", E, i), t.wrapperEl.removeEventListener("pointermove", _, n), 
            [ "pointerup", "pointercancel", "pointerout" ].forEach((e => {
                t.wrapperEl.removeEventListener(e, T, i);
            })), t.wrapperEl.removeEventListener("pointermove", S, n);
        }
        Object.defineProperty(t.zoom, "scale", {
            get: () => v,
            set(e) {
                if (v !== e) {
                    const t = f.imageEl, i = f.slideEl;
                    s("zoomChange", e, t, i);
                }
                v = e;
            }
        }), n("init", (() => {
            t.params.zoom.enabled && P();
        })), n("destroy", (() => {
            O();
        })), n("touchStart", ((e, i) => {
            t.zoom.enabled && function(e) {
                const i = t.device;
                if (!f.imageEl) return;
                if (h.isTouched) return;
                i.android && e.cancelable && e.preventDefault(), h.isTouched = !0;
                const n = p.length > 0 ? p[0] : e;
                h.touchesStart.x = n.pageX, h.touchesStart.y = n.pageY;
            }(i);
        })), n("touchEnd", ((e, i) => {
            t.zoom.enabled && function() {
                const e = t.zoom;
                if (!f.imageEl) return;
                if (!h.isTouched || !h.isMoved) return h.isTouched = !1, void (h.isMoved = !1);
                h.isTouched = !1, h.isMoved = !1;
                let i = 300, n = 300;
                const s = g.x * i, r = h.currentX + s, a = g.y * n, o = h.currentY + a;
                0 !== g.x && (i = Math.abs((r - h.currentX) / g.x)), 0 !== g.y && (n = Math.abs((o - h.currentY) / g.y));
                const l = Math.max(i, n);
                h.currentX = r, h.currentY = o;
                const c = h.width * e.scale, d = h.height * e.scale;
                h.minX = Math.min(f.slideWidth / 2 - c / 2, 0), h.maxX = -h.minX, h.minY = Math.min(f.slideHeight / 2 - d / 2, 0), 
                h.maxY = -h.minY, h.currentX = Math.max(Math.min(h.currentX, h.maxX), h.minX), h.currentY = Math.max(Math.min(h.currentY, h.maxY), h.minY), 
                f.imageWrapEl.style.transitionDuration = `${l}ms`, f.imageWrapEl.style.transform = `translate3d(${h.currentX}px, ${h.currentY}px,0)`;
            }();
        })), n("doubleTap", ((e, i) => {
            !t.animating && t.params.zoom.enabled && t.zoom.enabled && t.params.zoom.toggle && k(i);
        })), n("transitionEnd", (() => {
            t.zoom.enabled && t.params.zoom.enabled && C();
        })), n("slideChange", (() => {
            t.zoom.enabled && t.params.zoom.enabled && t.params.cssMode && C();
        })), Object.assign(t.zoom, {
            enable: P,
            disable: O,
            in: M,
            out: A,
            toggle: k
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        function s(e, t) {
            const i = function() {
                let e, t, i;
                return (n, s) => {
                    for (t = -1, e = n.length; e - t > 1; ) i = e + t >> 1, n[i] <= s ? t = i : e = i;
                    return e;
                };
            }();
            let n, s;
            return this.x = e, this.y = t, this.lastIndex = e.length - 1, this.interpolate = function(e) {
                return e ? (s = i(this.x, e), n = s - 1, (e - this.x[n]) * (this.y[s] - this.y[n]) / (this.x[s] - this.x[n]) + this.y[n]) : 0;
            }, this;
        }
        function r() {
            t.controller.control && t.controller.spline && (t.controller.spline = void 0, delete t.controller.spline);
        }
        i({
            controller: {
                control: void 0,
                inverse: !1,
                by: "slide"
            }
        }), t.controller = {
            control: void 0
        }, n("beforeInit", (() => {
            if ("undefined" != typeof window && ("string" == typeof t.params.controller.control || t.params.controller.control instanceof HTMLElement)) {
                const e = document.querySelector(t.params.controller.control);
                if (e && e.swiper) t.controller.control = e.swiper; else if (e) {
                    const i = n => {
                        t.controller.control = n.detail[0], t.update(), e.removeEventListener("init", i);
                    };
                    e.addEventListener("init", i);
                }
            } else t.controller.control = t.params.controller.control;
        })), n("update", (() => {
            r();
        })), n("resize", (() => {
            r();
        })), n("observerUpdate", (() => {
            r();
        })), n("setTranslate", ((e, i, n) => {
            t.controller.control && !t.controller.control.destroyed && t.controller.setTranslate(i, n);
        })), n("setTransition", ((e, i, n) => {
            t.controller.control && !t.controller.control.destroyed && t.controller.setTransition(i, n);
        })), Object.assign(t.controller, {
            setTranslate: function(e, i) {
                const n = t.controller.control;
                let r, a;
                const o = t.constructor;
                function l(e) {
                    if (e.destroyed) return;
                    const i = t.rtlTranslate ? -t.translate : t.translate;
                    "slide" === t.params.controller.by && (!function(e) {
                        t.controller.spline = t.params.loop ? new s(t.slidesGrid, e.slidesGrid) : new s(t.snapGrid, e.snapGrid);
                    }(e), a = -t.controller.spline.interpolate(-i)), a && "container" !== t.params.controller.by || (r = (e.maxTranslate() - e.minTranslate()) / (t.maxTranslate() - t.minTranslate()), 
                    !Number.isNaN(r) && Number.isFinite(r) || (r = 1), a = (i - t.minTranslate()) * r + e.minTranslate()), 
                    t.params.controller.inverse && (a = e.maxTranslate() - a), e.updateProgress(a), 
                    e.setTranslate(a, t), e.updateActiveIndex(), e.updateSlidesClasses();
                }
                if (Array.isArray(n)) for (let e = 0; e < n.length; e += 1) n[e] !== i && n[e] instanceof o && l(n[e]); else n instanceof o && i !== n && l(n);
            },
            setTransition: function(e, i) {
                const n = t.constructor, s = t.controller.control;
                let r;
                function a(i) {
                    i.destroyed || (i.setTransition(e, t), 0 !== e && (i.transitionStart(), i.params.autoHeight && o((() => {
                        i.updateAutoHeight();
                    })), E(i.wrapperEl, (() => {
                        s && i.transitionEnd();
                    }))));
                }
                if (Array.isArray(s)) for (r = 0; r < s.length; r += 1) s[r] !== i && s[r] instanceof n && a(s[r]); else s instanceof n && i !== s && a(s);
            }
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            a11y: {
                enabled: !0,
                notificationClass: "swiper-notification",
                prevSlideMessage: "Previous slide",
                nextSlideMessage: "Next slide",
                firstSlideMessage: "This is the first slide",
                lastSlideMessage: "This is the last slide",
                paginationBulletMessage: "Go to slide {{index}}",
                slideLabelMessage: "{{index}} / {{slidesLength}}",
                containerMessage: null,
                containerRoleDescriptionMessage: null,
                itemRoleDescriptionMessage: null,
                slideRole: "group",
                id: null
            }
        }), t.a11y = {
            clicked: !1
        };
        let s = null;
        function r(e) {
            const t = s;
            0 !== t.length && (t.innerHTML = "", t.innerHTML = e);
        }
        const a = e => (Array.isArray(e) ? e : [ e ]).filter((e => !!e));
        function o(e) {
            (e = a(e)).forEach((e => {
                e.setAttribute("tabIndex", "0");
            }));
        }
        function l(e) {
            (e = a(e)).forEach((e => {
                e.setAttribute("tabIndex", "-1");
            }));
        }
        function c(e, t) {
            (e = a(e)).forEach((e => {
                e.setAttribute("role", t);
            }));
        }
        function d(e, t) {
            (e = a(e)).forEach((e => {
                e.setAttribute("aria-roledescription", t);
            }));
        }
        function u(e, t) {
            (e = a(e)).forEach((e => {
                e.setAttribute("aria-label", t);
            }));
        }
        function p(e) {
            (e = a(e)).forEach((e => {
                e.setAttribute("aria-disabled", !0);
            }));
        }
        function f(e) {
            (e = a(e)).forEach((e => {
                e.setAttribute("aria-disabled", !1);
            }));
        }
        function h(e) {
            if (13 !== e.keyCode && 32 !== e.keyCode) return;
            const i = t.params.a11y, n = e.target;
            t.pagination && t.pagination.el && (n === t.pagination.el || t.pagination.el.contains(e.target)) && !e.target.matches(ie(t.params.pagination.bulletClass)) || (t.navigation && t.navigation.nextEl && n === t.navigation.nextEl && (t.isEnd && !t.params.loop || t.slideNext(), 
            t.isEnd ? r(i.lastSlideMessage) : r(i.nextSlideMessage)), t.navigation && t.navigation.prevEl && n === t.navigation.prevEl && (t.isBeginning && !t.params.loop || t.slidePrev(), 
            t.isBeginning ? r(i.firstSlideMessage) : r(i.prevSlideMessage)), t.pagination && n.matches(ie(t.params.pagination.bulletClass)) && n.click());
        }
        function m() {
            return t.pagination && t.pagination.bullets && t.pagination.bullets.length;
        }
        function g() {
            return m() && t.params.pagination.clickable;
        }
        const y = (e, t, i) => {
            o(e), "BUTTON" !== e.tagName && (c(e, "button"), e.addEventListener("keydown", h)), 
            u(e, i), function(e, t) {
                (e = a(e)).forEach((e => {
                    e.setAttribute("aria-controls", t);
                }));
            }(e, t);
        }, b = () => {
            t.a11y.clicked = !0;
        }, x = () => {
            requestAnimationFrame((() => {
                requestAnimationFrame((() => {
                    t.destroyed || (t.a11y.clicked = !1);
                }));
            }));
        }, E = e => {
            if (t.a11y.clicked) return;
            const i = e.target.closest(`.${t.params.slideClass}, swiper-slide`);
            if (!i || !t.slides.includes(i)) return;
            const n = t.slides.indexOf(i) === t.activeIndex, s = t.params.watchSlidesProgress && t.visibleSlides && t.visibleSlides.includes(i);
            n || s || e.sourceCapabilities && e.sourceCapabilities.firesTouchEvents || (t.isHorizontal() ? t.el.scrollLeft = 0 : t.el.scrollTop = 0, 
            t.slideTo(t.slides.indexOf(i), 0));
        }, _ = () => {
            const e = t.params.a11y;
            e.itemRoleDescriptionMessage && d(t.slides, e.itemRoleDescriptionMessage), e.slideRole && c(t.slides, e.slideRole);
            const i = t.slides.length;
            e.slideLabelMessage && t.slides.forEach(((n, s) => {
                const r = t.params.loop ? parseInt(n.getAttribute("data-swiper-slide-index"), 10) : s;
                u(n, e.slideLabelMessage.replace(/\{\{index\}\}/, r + 1).replace(/\{\{slidesLength\}\}/, i));
            }));
        }, T = () => {
            const e = t.params.a11y;
            t.el.append(s);
            const i = t.el;
            e.containerRoleDescriptionMessage && d(i, e.containerRoleDescriptionMessage), e.containerMessage && u(i, e.containerMessage);
            const n = t.wrapperEl, r = e.id || n.getAttribute("id") || `swiper-wrapper-${o = 16, 
            void 0 === o && (o = 16), "x".repeat(o).replace(/x/g, (() => Math.round(16 * Math.random()).toString(16)))}`;
            var o;
            const l = t.params.autoplay && t.params.autoplay.enabled ? "off" : "polite";
            var c;
            c = r, a(n).forEach((e => {
                e.setAttribute("id", c);
            })), function(e, t) {
                (e = a(e)).forEach((e => {
                    e.setAttribute("aria-live", t);
                }));
            }(n, l), _();
            let {nextEl: p, prevEl: f} = t.navigation ? t.navigation : {};
            if (p = a(p), f = a(f), p && p.forEach((t => y(t, r, e.nextSlideMessage))), f && f.forEach((t => y(t, r, e.prevSlideMessage))), 
            g()) {
                a(t.pagination.el).forEach((e => {
                    e.addEventListener("keydown", h);
                }));
            }
            t.el.addEventListener("focus", E, !0), t.el.addEventListener("pointerdown", b, !0), 
            t.el.addEventListener("pointerup", x, !0);
        };
        n("beforeInit", (() => {
            s = v("span", t.params.a11y.notificationClass), s.setAttribute("aria-live", "assertive"), 
            s.setAttribute("aria-atomic", "true");
        })), n("afterInit", (() => {
            t.params.a11y.enabled && T();
        })), n("slidesLengthChange snapGridLengthChange slidesGridLengthChange", (() => {
            t.params.a11y.enabled && _();
        })), n("fromEdge toEdge afterInit lock unlock", (() => {
            t.params.a11y.enabled && function() {
                if (t.params.loop || t.params.rewind || !t.navigation) return;
                const {nextEl: e, prevEl: i} = t.navigation;
                i && (t.isBeginning ? (p(i), l(i)) : (f(i), o(i))), e && (t.isEnd ? (p(e), l(e)) : (f(e), 
                o(e)));
            }();
        })), n("paginationUpdate", (() => {
            t.params.a11y.enabled && function() {
                const e = t.params.a11y;
                m() && t.pagination.bullets.forEach((i => {
                    t.params.pagination.clickable && (o(i), t.params.pagination.renderBullet || (c(i, "button"), 
                    u(i, e.paginationBulletMessage.replace(/\{\{index\}\}/, w(i) + 1)))), i.matches(ie(t.params.pagination.bulletActiveClass)) ? i.setAttribute("aria-current", "true") : i.removeAttribute("aria-current");
                }));
            }();
        })), n("destroy", (() => {
            t.params.a11y.enabled && function() {
                s && s.remove();
                let {nextEl: e, prevEl: i} = t.navigation ? t.navigation : {};
                e = a(e), i = a(i), e && e.forEach((e => e.removeEventListener("keydown", h))), 
                i && i.forEach((e => e.removeEventListener("keydown", h))), g() && a(t.pagination.el).forEach((e => {
                    e.removeEventListener("keydown", h);
                }));
                t.el.removeEventListener("focus", E, !0), t.el.removeEventListener("pointerdown", b, !0), 
                t.el.removeEventListener("pointerup", x, !0);
            }();
        }));
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            history: {
                enabled: !1,
                root: "",
                replaceState: !1,
                key: "slides",
                keepQuery: !1
            }
        });
        let s = !1, a = {};
        const o = e => e.toString().replace(/\s+/g, "-").replace(/[^\w-]+/g, "").replace(/--+/g, "-").replace(/^-+/, "").replace(/-+$/, ""), l = e => {
            const t = r();
            let i;
            i = e ? new URL(e) : t.location;
            const n = i.pathname.slice(1).split("/").filter((e => "" !== e)), s = n.length;
            return {
                key: n[s - 2],
                value: n[s - 1]
            };
        }, c = (e, i) => {
            const n = r();
            if (!s || !t.params.history.enabled) return;
            let a;
            a = t.params.url ? new URL(t.params.url) : n.location;
            const l = t.slides[i];
            let c = o(l.getAttribute("data-history"));
            if (t.params.history.root.length > 0) {
                let i = t.params.history.root;
                "/" === i[i.length - 1] && (i = i.slice(0, i.length - 1)), c = `${i}/${e ? `${e}/` : ""}${c}`;
            } else a.pathname.includes(e) || (c = `${e ? `${e}/` : ""}${c}`);
            t.params.history.keepQuery && (c += a.search);
            const d = n.history.state;
            d && d.value === c || (t.params.history.replaceState ? n.history.replaceState({
                value: c
            }, null, c) : n.history.pushState({
                value: c
            }, null, c));
        }, d = (e, i, n) => {
            if (i) for (let s = 0, r = t.slides.length; s < r; s += 1) {
                const r = t.slides[s];
                if (o(r.getAttribute("data-history")) === i) {
                    const i = t.getSlideIndex(r);
                    t.slideTo(i, e, n);
                }
            } else t.slideTo(0, e, n);
        }, u = () => {
            a = l(t.params.url), d(t.params.speed, a.value, !1);
        };
        n("init", (() => {
            t.params.history.enabled && (() => {
                const e = r();
                if (t.params.history) {
                    if (!e.history || !e.history.pushState) return t.params.history.enabled = !1, void (t.params.hashNavigation.enabled = !0);
                    s = !0, a = l(t.params.url), a.key || a.value ? (d(0, a.value, t.params.runCallbacksOnInit), 
                    t.params.history.replaceState || e.addEventListener("popstate", u)) : t.params.history.replaceState || e.addEventListener("popstate", u);
                }
            })();
        })), n("destroy", (() => {
            t.params.history.enabled && (() => {
                const e = r();
                t.params.history.replaceState || e.removeEventListener("popstate", u);
            })();
        })), n("transitionEnd _freeModeNoMomentumRelease", (() => {
            s && c(t.params.history.key, t.activeIndex);
        })), n("slideChange", (() => {
            s && t.params.cssMode && c(t.params.history.key, t.activeIndex);
        }));
    }, function(e) {
        let {swiper: t, extendParams: i, emit: s, on: a} = e, o = !1;
        const l = n(), c = r();
        i({
            hashNavigation: {
                enabled: !1,
                replaceState: !1,
                watchState: !1,
                getSlideIndex(e, i) {
                    if (t.virtual && t.params.virtual.enabled) {
                        const e = t.slides.filter((e => e.getAttribute("data-hash") === i))[0];
                        if (!e) return 0;
                        return parseInt(e.getAttribute("data-swiper-slide-index"), 10);
                    }
                    return t.getSlideIndex(m(t.slidesEl, `.${t.params.slideClass}[data-hash="${i}"], swiper-slide[data-hash="${i}"]`)[0]);
                }
            }
        });
        const d = () => {
            s("hashChange");
            const e = l.location.hash.replace("#", ""), i = t.virtual && t.params.virtual.enabled ? t.slidesEl.querySelector(`[data-swiper-slide-index="${t.activeIndex}"]`) : t.slides[t.activeIndex];
            if (e !== (i ? i.getAttribute("data-hash") : "")) {
                const i = t.params.hashNavigation.getSlideIndex(t, e);
                if (void 0 === i || Number.isNaN(i)) return;
                t.slideTo(i);
            }
        }, u = () => {
            if (!o || !t.params.hashNavigation.enabled) return;
            const e = t.virtual && t.params.virtual.enabled ? t.slidesEl.querySelector(`[data-swiper-slide-index="${t.activeIndex}"]`) : t.slides[t.activeIndex], i = e ? e.getAttribute("data-hash") || e.getAttribute("data-history") : "";
            t.params.hashNavigation.replaceState && c.history && c.history.replaceState ? (c.history.replaceState(null, null, `#${i}` || ""), 
            s("hashSet")) : (l.location.hash = i || "", s("hashSet"));
        };
        a("init", (() => {
            t.params.hashNavigation.enabled && (() => {
                if (!t.params.hashNavigation.enabled || t.params.history && t.params.history.enabled) return;
                o = !0;
                const e = l.location.hash.replace("#", "");
                if (e) {
                    const i = 0, n = t.params.hashNavigation.getSlideIndex(t, e);
                    t.slideTo(n || 0, i, t.params.runCallbacksOnInit, !0);
                }
                t.params.hashNavigation.watchState && c.addEventListener("hashchange", d);
            })();
        })), a("destroy", (() => {
            t.params.hashNavigation.enabled && t.params.hashNavigation.watchState && c.removeEventListener("hashchange", d);
        })), a("transitionEnd _freeModeNoMomentumRelease", (() => {
            o && u();
        })), a("slideChange", (() => {
            o && t.params.cssMode && u();
        }));
    }, function(e) {
        let t, i, {swiper: s, extendParams: r, on: a, emit: o, params: l} = e;
        s.autoplay = {
            running: !1,
            paused: !1,
            timeLeft: 0
        }, r({
            autoplay: {
                enabled: !1,
                delay: 3e3,
                waitForTransition: !0,
                disableOnInteraction: !1,
                stopOnLastSlide: !1,
                reverseDirection: !1,
                pauseOnMouseEnter: !1
            }
        });
        let c, d, u, p, f, h, m, g, v = l && l.autoplay ? l.autoplay.delay : 3e3, y = l && l.autoplay ? l.autoplay.delay : 3e3, b = (new Date).getTime();
        function w(e) {
            s && !s.destroyed && s.wrapperEl && e.target === s.wrapperEl && (s.wrapperEl.removeEventListener("transitionend", w), 
            g || C());
        }
        const x = () => {
            if (s.destroyed || !s.autoplay.running) return;
            s.autoplay.paused ? d = !0 : d && (y = c, d = !1);
            const e = s.autoplay.paused ? c : b + y - (new Date).getTime();
            s.autoplay.timeLeft = e, o("autoplayTimeLeft", e, e / v), i = requestAnimationFrame((() => {
                x();
            }));
        }, E = e => {
            if (s.destroyed || !s.autoplay.running) return;
            cancelAnimationFrame(i), x();
            let n = void 0 === e ? s.params.autoplay.delay : e;
            v = s.params.autoplay.delay, y = s.params.autoplay.delay;
            const r = (() => {
                let e;
                if (e = s.virtual && s.params.virtual.enabled ? s.slides.filter((e => e.classList.contains("swiper-slide-active")))[0] : s.slides[s.activeIndex], 
                !e) return;
                return parseInt(e.getAttribute("data-swiper-autoplay"), 10);
            })();
            !Number.isNaN(r) && r > 0 && void 0 === e && (n = r, v = r, y = r), c = n;
            const a = s.params.speed, l = () => {
                s && !s.destroyed && (s.params.autoplay.reverseDirection ? !s.isBeginning || s.params.loop || s.params.rewind ? (s.slidePrev(a, !0, !0), 
                o("autoplay")) : s.params.autoplay.stopOnLastSlide || (s.slideTo(s.slides.length - 1, a, !0, !0), 
                o("autoplay")) : !s.isEnd || s.params.loop || s.params.rewind ? (s.slideNext(a, !0, !0), 
                o("autoplay")) : s.params.autoplay.stopOnLastSlide || (s.slideTo(0, a, !0, !0), 
                o("autoplay")), s.params.cssMode && (b = (new Date).getTime(), requestAnimationFrame((() => {
                    E();
                }))));
            };
            return n > 0 ? (clearTimeout(t), t = setTimeout((() => {
                l();
            }), n)) : requestAnimationFrame((() => {
                l();
            })), n;
        }, _ = () => {
            b = (new Date).getTime(), s.autoplay.running = !0, E(), o("autoplayStart");
        }, T = () => {
            s.autoplay.running = !1, clearTimeout(t), cancelAnimationFrame(i), o("autoplayStop");
        }, S = (e, i) => {
            if (s.destroyed || !s.autoplay.running) return;
            clearTimeout(t), e || (m = !0);
            const n = () => {
                o("autoplayPause"), s.params.autoplay.waitForTransition ? s.wrapperEl.addEventListener("transitionend", w) : C();
            };
            if (s.autoplay.paused = !0, i) return h && (c = s.params.autoplay.delay), h = !1, 
            void n();
            const r = c || s.params.autoplay.delay;
            c = r - ((new Date).getTime() - b), s.isEnd && c < 0 && !s.params.loop || (c < 0 && (c = 0), 
            n());
        }, C = () => {
            s.isEnd && c < 0 && !s.params.loop || s.destroyed || !s.autoplay.running || (b = (new Date).getTime(), 
            m ? (m = !1, E(c)) : E(), s.autoplay.paused = !1, o("autoplayResume"));
        }, M = () => {
            if (s.destroyed || !s.autoplay.running) return;
            const e = n();
            "hidden" === e.visibilityState && (m = !0, S(!0)), "visible" === e.visibilityState && C();
        }, A = e => {
            "mouse" === e.pointerType && (m = !0, g = !0, s.animating || s.autoplay.paused || S(!0));
        }, k = e => {
            "mouse" === e.pointerType && (g = !1, s.autoplay.paused && C());
        };
        a("init", (() => {
            s.params.autoplay.enabled && (s.params.autoplay.pauseOnMouseEnter && (s.el.addEventListener("pointerenter", A), 
            s.el.addEventListener("pointerleave", k)), n().addEventListener("visibilitychange", M), 
            _());
        })), a("destroy", (() => {
            s.el.removeEventListener("pointerenter", A), s.el.removeEventListener("pointerleave", k), 
            n().removeEventListener("visibilitychange", M), s.autoplay.running && T();
        })), a("_freeModeStaticRelease", (() => {
            (p || m) && C();
        })), a("_freeModeNoMomentumRelease", (() => {
            s.params.autoplay.disableOnInteraction ? T() : S(!0, !0);
        })), a("beforeTransitionStart", ((e, t, i) => {
            !s.destroyed && s.autoplay.running && (i || !s.params.autoplay.disableOnInteraction ? S(!0, !0) : T());
        })), a("sliderFirstMove", (() => {
            !s.destroyed && s.autoplay.running && (s.params.autoplay.disableOnInteraction ? T() : (u = !0, 
            p = !1, m = !1, f = setTimeout((() => {
                m = !0, p = !0, S(!0);
            }), 200)));
        })), a("touchEnd", (() => {
            if (!s.destroyed && s.autoplay.running && u) {
                if (clearTimeout(f), clearTimeout(t), s.params.autoplay.disableOnInteraction) return p = !1, 
                void (u = !1);
                p && s.params.cssMode && C(), p = !1, u = !1;
            }
        })), a("slideChange", (() => {
            !s.destroyed && s.autoplay.running && (h = !0);
        })), Object.assign(s.autoplay, {
            start: _,
            stop: T,
            pause: S,
            resume: C
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: s} = e;
        i({
            thumbs: {
                swiper: null,
                multipleActiveThumbs: !0,
                autoScrollOffset: 0,
                slideThumbActiveClass: "swiper-slide-thumb-active",
                thumbsContainerClass: "swiper-thumbs"
            }
        });
        let r = !1, a = !1;
        function o() {
            const e = t.thumbs.swiper;
            if (!e || e.destroyed) return;
            const i = e.clickedIndex, n = e.clickedSlide;
            if (n && n.classList.contains(t.params.thumbs.slideThumbActiveClass)) return;
            if (null == i) return;
            let s;
            s = e.params.loop ? parseInt(e.clickedSlide.getAttribute("data-swiper-slide-index"), 10) : i, 
            t.params.loop ? t.slideToLoop(s) : t.slideTo(s);
        }
        function l() {
            const {thumbs: e} = t.params;
            if (r) return !1;
            r = !0;
            const i = t.constructor;
            if (e.swiper instanceof i) t.thumbs.swiper = e.swiper, Object.assign(t.thumbs.swiper.originalParams, {
                watchSlidesProgress: !0,
                slideToClickedSlide: !1
            }), Object.assign(t.thumbs.swiper.params, {
                watchSlidesProgress: !0,
                slideToClickedSlide: !1
            }), t.thumbs.swiper.update(); else if (d(e.swiper)) {
                const n = Object.assign({}, e.swiper);
                Object.assign(n, {
                    watchSlidesProgress: !0,
                    slideToClickedSlide: !1
                }), t.thumbs.swiper = new i(n), a = !0;
            }
            return t.thumbs.swiper.el.classList.add(t.params.thumbs.thumbsContainerClass), t.thumbs.swiper.on("tap", o), 
            !0;
        }
        function c(e) {
            const i = t.thumbs.swiper;
            if (!i || i.destroyed) return;
            const n = "auto" === i.params.slidesPerView ? i.slidesPerViewDynamic() : i.params.slidesPerView;
            let s = 1;
            const r = t.params.thumbs.slideThumbActiveClass;
            if (t.params.slidesPerView > 1 && !t.params.centeredSlides && (s = t.params.slidesPerView), 
            t.params.thumbs.multipleActiveThumbs || (s = 1), s = Math.floor(s), i.slides.forEach((e => e.classList.remove(r))), 
            i.params.loop || i.params.virtual && i.params.virtual.enabled) for (let e = 0; e < s; e += 1) m(i.slidesEl, `[data-swiper-slide-index="${t.realIndex + e}"]`).forEach((e => {
                e.classList.add(r);
            })); else for (let e = 0; e < s; e += 1) i.slides[t.realIndex + e] && i.slides[t.realIndex + e].classList.add(r);
            const a = t.params.thumbs.autoScrollOffset, o = a && !i.params.loop;
            if (t.realIndex !== i.realIndex || o) {
                const s = i.activeIndex;
                let r, l;
                if (i.params.loop) {
                    const e = i.slides.filter((e => e.getAttribute("data-swiper-slide-index") === `${t.realIndex}`))[0];
                    r = i.slides.indexOf(e), l = t.activeIndex > t.previousIndex ? "next" : "prev";
                } else r = t.realIndex, l = r > t.previousIndex ? "next" : "prev";
                o && (r += "next" === l ? a : -1 * a), i.visibleSlidesIndexes && i.visibleSlidesIndexes.indexOf(r) < 0 && (i.params.centeredSlides ? r = r > s ? r - Math.floor(n / 2) + 1 : r + Math.floor(n / 2) - 1 : r > s && i.params.slidesPerGroup, 
                i.slideTo(r, e ? 0 : void 0));
            }
        }
        t.thumbs = {
            swiper: null
        }, s("beforeInit", (() => {
            const {thumbs: e} = t.params;
            if (e && e.swiper) if ("string" == typeof e.swiper || e.swiper instanceof HTMLElement) {
                const i = n(), s = () => {
                    const n = "string" == typeof e.swiper ? i.querySelector(e.swiper) : e.swiper;
                    if (n && n.swiper) e.swiper = n.swiper, l(), c(!0); else if (n) {
                        const i = s => {
                            e.swiper = s.detail[0], n.removeEventListener("init", i), l(), c(!0), e.swiper.update(), 
                            t.update();
                        };
                        n.addEventListener("init", i);
                    }
                    return n;
                }, r = () => {
                    if (t.destroyed) return;
                    s() || requestAnimationFrame(r);
                };
                requestAnimationFrame(r);
            } else l(), c(!0);
        })), s("slideChange update resize observerUpdate", (() => {
            c();
        })), s("setTransition", ((e, i) => {
            const n = t.thumbs.swiper;
            n && !n.destroyed && n.setTransition(i);
        })), s("beforeDestroy", (() => {
            const e = t.thumbs.swiper;
            e && !e.destroyed && a && e.destroy();
        })), Object.assign(t.thumbs, {
            init: l,
            update: c
        });
    }, function(e) {
        let {swiper: t, extendParams: i, emit: n, once: s} = e;
        i({
            freeMode: {
                enabled: !1,
                momentum: !0,
                momentumRatio: 1,
                momentumBounce: !0,
                momentumBounceRatio: 1,
                momentumVelocityRatio: 1,
                sticky: !1,
                minimumVelocity: .02
            }
        }), Object.assign(t, {
            freeMode: {
                onTouchStart: function() {
                    if (t.params.cssMode) return;
                    const e = t.getTranslate();
                    t.setTranslate(e), t.setTransition(0), t.touchEventsData.velocities.length = 0, 
                    t.freeMode.onTouchEnd({
                        currentPos: t.rtl ? t.translate : -t.translate
                    });
                },
                onTouchMove: function() {
                    if (t.params.cssMode) return;
                    const {touchEventsData: e, touches: i} = t;
                    0 === e.velocities.length && e.velocities.push({
                        position: i[t.isHorizontal() ? "startX" : "startY"],
                        time: e.touchStartTime
                    }), e.velocities.push({
                        position: i[t.isHorizontal() ? "currentX" : "currentY"],
                        time: l()
                    });
                },
                onTouchEnd: function(e) {
                    let {currentPos: i} = e;
                    if (t.params.cssMode) return;
                    const {params: r, wrapperEl: a, rtlTranslate: o, snapGrid: c, touchEventsData: d} = t, u = l() - d.touchStartTime;
                    if (i < -t.minTranslate()) t.slideTo(t.activeIndex); else if (i > -t.maxTranslate()) t.slides.length < c.length ? t.slideTo(c.length - 1) : t.slideTo(t.slides.length - 1); else {
                        if (r.freeMode.momentum) {
                            if (d.velocities.length > 1) {
                                const e = d.velocities.pop(), i = d.velocities.pop(), n = e.position - i.position, s = e.time - i.time;
                                t.velocity = n / s, t.velocity /= 2, Math.abs(t.velocity) < r.freeMode.minimumVelocity && (t.velocity = 0), 
                                (s > 150 || l() - e.time > 300) && (t.velocity = 0);
                            } else t.velocity = 0;
                            t.velocity *= r.freeMode.momentumVelocityRatio, d.velocities.length = 0;
                            let e = 1e3 * r.freeMode.momentumRatio;
                            const i = t.velocity * e;
                            let u = t.translate + i;
                            o && (u = -u);
                            let p, f = !1;
                            const h = 20 * Math.abs(t.velocity) * r.freeMode.momentumBounceRatio;
                            let m;
                            if (u < t.maxTranslate()) r.freeMode.momentumBounce ? (u + t.maxTranslate() < -h && (u = t.maxTranslate() - h), 
                            p = t.maxTranslate(), f = !0, d.allowMomentumBounce = !0) : u = t.maxTranslate(), 
                            r.loop && r.centeredSlides && (m = !0); else if (u > t.minTranslate()) r.freeMode.momentumBounce ? (u - t.minTranslate() > h && (u = t.minTranslate() + h), 
                            p = t.minTranslate(), f = !0, d.allowMomentumBounce = !0) : u = t.minTranslate(), 
                            r.loop && r.centeredSlides && (m = !0); else if (r.freeMode.sticky) {
                                let e;
                                for (let t = 0; t < c.length; t += 1) if (c[t] > -u) {
                                    e = t;
                                    break;
                                }
                                u = Math.abs(c[e] - u) < Math.abs(c[e - 1] - u) || "next" === t.swipeDirection ? c[e] : c[e - 1], 
                                u = -u;
                            }
                            if (m && s("transitionEnd", (() => {
                                t.loopFix();
                            })), 0 !== t.velocity) {
                                if (e = o ? Math.abs((-u - t.translate) / t.velocity) : Math.abs((u - t.translate) / t.velocity), 
                                r.freeMode.sticky) {
                                    const i = Math.abs((o ? -u : u) - t.translate), n = t.slidesSizesGrid[t.activeIndex];
                                    e = i < n ? r.speed : i < 2 * n ? 1.5 * r.speed : 2.5 * r.speed;
                                }
                            } else if (r.freeMode.sticky) return void t.slideToClosest();
                            r.freeMode.momentumBounce && f ? (t.updateProgress(p), t.setTransition(e), t.setTranslate(u), 
                            t.transitionStart(!0, t.swipeDirection), t.animating = !0, E(a, (() => {
                                t && !t.destroyed && d.allowMomentumBounce && (n("momentumBounce"), t.setTransition(r.speed), 
                                setTimeout((() => {
                                    t.setTranslate(p), E(a, (() => {
                                        t && !t.destroyed && t.transitionEnd();
                                    }));
                                }), 0));
                            }))) : t.velocity ? (n("_freeModeNoMomentumRelease"), t.updateProgress(u), t.setTransition(e), 
                            t.setTranslate(u), t.transitionStart(!0, t.swipeDirection), t.animating || (t.animating = !0, 
                            E(a, (() => {
                                t && !t.destroyed && t.transitionEnd();
                            })))) : t.updateProgress(u), t.updateActiveIndex(), t.updateSlidesClasses();
                        } else {
                            if (r.freeMode.sticky) return void t.slideToClosest();
                            r.freeMode && n("_freeModeNoMomentumRelease");
                        }
                        (!r.freeMode.momentum || u >= r.longSwipesMs) && (n("_freeModeStaticRelease"), t.updateProgress(), 
                        t.updateActiveIndex(), t.updateSlidesClasses());
                    }
                }
            }
        });
    }, function(e) {
        let t, i, n, s, {swiper: r, extendParams: a, on: o} = e;
        a({
            grid: {
                rows: 1,
                fill: "column"
            }
        });
        const l = () => {
            let e = r.params.spaceBetween;
            return "string" == typeof e && e.indexOf("%") >= 0 ? e = parseFloat(e.replace("%", "")) / 100 * r.size : "string" == typeof e && (e = parseFloat(e)), 
            e;
        };
        o("init", (() => {
            s = r.params.grid && r.params.grid.rows > 1;
        })), o("update", (() => {
            const {params: e, el: t} = r, i = e.grid && e.grid.rows > 1;
            s && !i ? (t.classList.remove(`${e.containerModifierClass}grid`, `${e.containerModifierClass}grid-column`), 
            n = 1, r.emitContainerClasses()) : !s && i && (t.classList.add(`${e.containerModifierClass}grid`), 
            "column" === e.grid.fill && t.classList.add(`${e.containerModifierClass}grid-column`), 
            r.emitContainerClasses()), s = i;
        })), r.grid = {
            initSlides: e => {
                const {slidesPerView: s} = r.params, {rows: a, fill: o} = r.params.grid, l = r.virtual && r.params.virtual.enabled ? r.virtual.slides.length : e.length;
                n = Math.floor(l / a), t = Math.floor(l / a) === l / a ? l : Math.ceil(l / a) * a, 
                "auto" !== s && "row" === o && (t = Math.max(t, s * a)), i = t / a;
            },
            unsetSlides: () => {
                r.slides && r.slides.forEach((e => {
                    e.swiperSlideGridSet && (e.style.height = "", e.style[r.getDirectionLabel("margin-top")] = "");
                }));
            },
            updateSlide: (e, s, a) => {
                const {slidesPerGroup: o} = r.params, c = l(), {rows: d, fill: u} = r.params.grid, p = r.virtual && r.params.virtual.enabled ? r.virtual.slides.length : a.length;
                let f, h, m;
                if ("row" === u && o > 1) {
                    const i = Math.floor(e / (o * d)), n = e - d * o * i, r = 0 === i ? o : Math.min(Math.ceil((p - i * d * o) / d), o);
                    m = Math.floor(n / r), h = n - m * r + i * o, f = h + m * t / d, s.style.order = f;
                } else "column" === u ? (h = Math.floor(e / d), m = e - h * d, (h > n || h === n && m === d - 1) && (m += 1, 
                m >= d && (m = 0, h += 1))) : (m = Math.floor(e / i), h = e - m * i);
                s.row = m, s.column = h, s.style.height = `calc((100% - ${(d - 1) * c}px) / ${d})`, 
                s.style[r.getDirectionLabel("margin-top")] = 0 !== m ? c && `${c}px` : "", s.swiperSlideGridSet = !0;
            },
            updateWrapperSize: (e, i) => {
                const {centeredSlides: n, roundLengths: s} = r.params, a = l(), {rows: o} = r.params.grid;
                if (r.virtualSize = (e + a) * t, r.virtualSize = Math.ceil(r.virtualSize / o) - a, 
                r.params.cssMode || (r.wrapperEl.style[r.getDirectionLabel("width")] = `${r.virtualSize + a}px`), 
                n) {
                    const e = [];
                    for (let t = 0; t < i.length; t += 1) {
                        let n = i[t];
                        s && (n = Math.floor(n)), i[t] < r.virtualSize + i[0] && e.push(n);
                    }
                    i.splice(0, i.length), i.push(...e);
                }
            }
        };
    }, function(e) {
        let {swiper: t} = e;
        Object.assign(t, {
            appendSlide: ne.bind(t),
            prependSlide: se.bind(t),
            addSlide: re.bind(t),
            removeSlide: ae.bind(t),
            removeAllSlides: oe.bind(t)
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            fadeEffect: {
                crossFade: !1
            }
        }), le({
            effect: "fade",
            swiper: t,
            on: n,
            setTranslate: () => {
                const {slides: e} = t;
                t.params.fadeEffect;
                for (let i = 0; i < e.length; i += 1) {
                    const e = t.slides[i];
                    let n = -e.swiperSlideOffset;
                    t.params.virtualTranslate || (n -= t.translate);
                    let s = 0;
                    t.isHorizontal() || (s = n, n = 0);
                    const r = t.params.fadeEffect.crossFade ? Math.max(1 - Math.abs(e.progress), 0) : 1 + Math.min(Math.max(e.progress, -1), 0), a = ce(0, e);
                    a.style.opacity = r, a.style.transform = `translate3d(${n}px, ${s}px, 0px)`;
                }
            },
            setTransition: e => {
                const i = t.slides.map((e => h(e)));
                i.forEach((t => {
                    t.style.transitionDuration = `${e}ms`;
                })), de({
                    swiper: t,
                    duration: e,
                    transformElements: i,
                    allSlides: !0
                });
            },
            overwriteParams: () => ({
                slidesPerView: 1,
                slidesPerGroup: 1,
                watchSlidesProgress: !0,
                spaceBetween: 0,
                virtualTranslate: !t.params.cssMode
            })
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            cubeEffect: {
                slideShadows: !0,
                shadow: !0,
                shadowOffset: 20,
                shadowScale: .94
            }
        });
        const s = (e, t, i) => {
            let n = i ? e.querySelector(".swiper-slide-shadow-left") : e.querySelector(".swiper-slide-shadow-top"), s = i ? e.querySelector(".swiper-slide-shadow-right") : e.querySelector(".swiper-slide-shadow-bottom");
            n || (n = v("div", ("swiper-slide-shadow-cube swiper-slide-shadow-" + (i ? "left" : "top")).split(" ")), 
            e.append(n)), s || (s = v("div", ("swiper-slide-shadow-cube swiper-slide-shadow-" + (i ? "right" : "bottom")).split(" ")), 
            e.append(s)), n && (n.style.opacity = Math.max(-t, 0)), s && (s.style.opacity = Math.max(t, 0));
        };
        le({
            effect: "cube",
            swiper: t,
            on: n,
            setTranslate: () => {
                const {el: e, wrapperEl: i, slides: n, width: r, height: a, rtlTranslate: o, size: l, browser: c} = t, d = t.params.cubeEffect, u = t.isHorizontal(), p = t.virtual && t.params.virtual.enabled;
                let f, h = 0;
                d.shadow && (u ? (f = t.wrapperEl.querySelector(".swiper-cube-shadow"), f || (f = v("div", "swiper-cube-shadow"), 
                t.wrapperEl.append(f)), f.style.height = `${r}px`) : (f = e.querySelector(".swiper-cube-shadow"), 
                f || (f = v("div", "swiper-cube-shadow"), e.append(f))));
                for (let e = 0; e < n.length; e += 1) {
                    const i = n[e];
                    let r = e;
                    p && (r = parseInt(i.getAttribute("data-swiper-slide-index"), 10));
                    let a = 90 * r, c = Math.floor(a / 360);
                    o && (a = -a, c = Math.floor(-a / 360));
                    const f = Math.max(Math.min(i.progress, 1), -1);
                    let m = 0, g = 0, v = 0;
                    r % 4 == 0 ? (m = 4 * -c * l, v = 0) : (r - 1) % 4 == 0 ? (m = 0, v = 4 * -c * l) : (r - 2) % 4 == 0 ? (m = l + 4 * c * l, 
                    v = l) : (r - 3) % 4 == 0 && (m = -l, v = 3 * l + 4 * l * c), o && (m = -m), u || (g = m, 
                    m = 0);
                    const y = `rotateX(${u ? 0 : -a}deg) rotateY(${u ? a : 0}deg) translate3d(${m}px, ${g}px, ${v}px)`;
                    f <= 1 && f > -1 && (h = 90 * r + 90 * f, o && (h = 90 * -r - 90 * f), t.browser && t.browser.isSafari && Math.abs(h) / 90 % 2 == 1 && (h += .001)), 
                    i.style.transform = y, d.slideShadows && s(i, f, u);
                }
                if (i.style.transformOrigin = `50% 50% -${l / 2}px`, i.style["-webkit-transform-origin"] = `50% 50% -${l / 2}px`, 
                d.shadow) if (u) f.style.transform = `translate3d(0px, ${r / 2 + d.shadowOffset}px, ${-r / 2}px) rotateX(89.99deg) rotateZ(0deg) scale(${d.shadowScale})`; else {
                    const e = Math.abs(h) - 90 * Math.floor(Math.abs(h) / 90), t = 1.5 - (Math.sin(2 * e * Math.PI / 360) / 2 + Math.cos(2 * e * Math.PI / 360) / 2), i = d.shadowScale, n = d.shadowScale / t, s = d.shadowOffset;
                    f.style.transform = `scale3d(${i}, 1, ${n}) translate3d(0px, ${a / 2 + s}px, ${-a / 2 / n}px) rotateX(-89.99deg)`;
                }
                const m = (c.isSafari || c.isWebView) && c.needPerspectiveFix ? -l / 2 : 0;
                i.style.transform = `translate3d(0px,0,${m}px) rotateX(${t.isHorizontal() ? 0 : h}deg) rotateY(${t.isHorizontal() ? -h : 0}deg)`, 
                i.style.setProperty("--swiper-cube-translate-z", `${m}px`);
            },
            setTransition: e => {
                const {el: i, slides: n} = t;
                if (n.forEach((t => {
                    t.style.transitionDuration = `${e}ms`, t.querySelectorAll(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").forEach((t => {
                        t.style.transitionDuration = `${e}ms`;
                    }));
                })), t.params.cubeEffect.shadow && !t.isHorizontal()) {
                    const t = i.querySelector(".swiper-cube-shadow");
                    t && (t.style.transitionDuration = `${e}ms`);
                }
            },
            recreateShadows: () => {
                const e = t.isHorizontal();
                t.slides.forEach((t => {
                    const i = Math.max(Math.min(t.progress, 1), -1);
                    s(t, i, e);
                }));
            },
            getEffectParams: () => t.params.cubeEffect,
            perspective: () => !0,
            overwriteParams: () => ({
                slidesPerView: 1,
                slidesPerGroup: 1,
                watchSlidesProgress: !0,
                resistanceRatio: 0,
                spaceBetween: 0,
                centeredSlides: !1,
                virtualTranslate: !0
            })
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            flipEffect: {
                slideShadows: !0,
                limitRotation: !0
            }
        });
        const s = (e, i) => {
            let n = t.isHorizontal() ? e.querySelector(".swiper-slide-shadow-left") : e.querySelector(".swiper-slide-shadow-top"), s = t.isHorizontal() ? e.querySelector(".swiper-slide-shadow-right") : e.querySelector(".swiper-slide-shadow-bottom");
            n || (n = ue("flip", e, t.isHorizontal() ? "left" : "top")), s || (s = ue("flip", e, t.isHorizontal() ? "right" : "bottom")), 
            n && (n.style.opacity = Math.max(-i, 0)), s && (s.style.opacity = Math.max(i, 0));
        };
        le({
            effect: "flip",
            swiper: t,
            on: n,
            setTranslate: () => {
                const {slides: e, rtlTranslate: i} = t, n = t.params.flipEffect;
                for (let r = 0; r < e.length; r += 1) {
                    const a = e[r];
                    let o = a.progress;
                    t.params.flipEffect.limitRotation && (o = Math.max(Math.min(a.progress, 1), -1));
                    const l = a.swiperSlideOffset;
                    let c = -180 * o, d = 0, u = t.params.cssMode ? -l - t.translate : -l, p = 0;
                    t.isHorizontal() ? i && (c = -c) : (p = u, u = 0, d = -c, c = 0), t.browser && t.browser.isSafari && (Math.abs(c) / 90 % 2 == 1 && (c += .001), 
                    Math.abs(d) / 90 % 2 == 1 && (d += .001)), a.style.zIndex = -Math.abs(Math.round(o)) + e.length, 
                    n.slideShadows && s(a, o);
                    const f = `translate3d(${u}px, ${p}px, 0px) rotateX(${d}deg) rotateY(${c}deg)`;
                    ce(0, a).style.transform = f;
                }
            },
            setTransition: e => {
                const i = t.slides.map((e => h(e)));
                i.forEach((t => {
                    t.style.transitionDuration = `${e}ms`, t.querySelectorAll(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").forEach((t => {
                        t.style.transitionDuration = `${e}ms`;
                    }));
                })), de({
                    swiper: t,
                    duration: e,
                    transformElements: i
                });
            },
            recreateShadows: () => {
                t.params.flipEffect, t.slides.forEach((e => {
                    let i = e.progress;
                    t.params.flipEffect.limitRotation && (i = Math.max(Math.min(e.progress, 1), -1)), 
                    s(e, i);
                }));
            },
            getEffectParams: () => t.params.flipEffect,
            perspective: () => !0,
            overwriteParams: () => ({
                slidesPerView: 1,
                slidesPerGroup: 1,
                watchSlidesProgress: !0,
                spaceBetween: 0,
                virtualTranslate: !t.params.cssMode
            })
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                scale: 1,
                modifier: 1,
                slideShadows: !0
            }
        }), le({
            effect: "coverflow",
            swiper: t,
            on: n,
            setTranslate: () => {
                const {width: e, height: i, slides: n, slidesSizesGrid: s} = t, r = t.params.coverflowEffect, a = t.isHorizontal(), o = t.translate, l = a ? e / 2 - o : i / 2 - o, c = a ? r.rotate : -r.rotate, d = r.depth;
                for (let e = 0, i = n.length; e < i; e += 1) {
                    const i = n[e], o = s[e], u = (l - i.swiperSlideOffset - o / 2) / o, p = "function" == typeof r.modifier ? r.modifier(u) : u * r.modifier;
                    let f = a ? c * p : 0, h = a ? 0 : c * p, m = -d * Math.abs(p), g = r.stretch;
                    "string" == typeof g && -1 !== g.indexOf("%") && (g = parseFloat(r.stretch) / 100 * o);
                    let v = a ? 0 : g * p, y = a ? g * p : 0, b = 1 - (1 - r.scale) * Math.abs(p);
                    Math.abs(y) < .001 && (y = 0), Math.abs(v) < .001 && (v = 0), Math.abs(m) < .001 && (m = 0), 
                    Math.abs(f) < .001 && (f = 0), Math.abs(h) < .001 && (h = 0), Math.abs(b) < .001 && (b = 0), 
                    t.browser && t.browser.isSafari && (Math.abs(f) / 90 % 2 == 1 && (f += .001), Math.abs(h) / 90 % 2 == 1 && (h += .001));
                    const w = `translate3d(${y}px,${v}px,${m}px)  rotateX(${h}deg) rotateY(${f}deg) scale(${b})`;
                    if (ce(0, i).style.transform = w, i.style.zIndex = 1 - Math.abs(Math.round(p)), 
                    r.slideShadows) {
                        let e = a ? i.querySelector(".swiper-slide-shadow-left") : i.querySelector(".swiper-slide-shadow-top"), t = a ? i.querySelector(".swiper-slide-shadow-right") : i.querySelector(".swiper-slide-shadow-bottom");
                        e || (e = ue("coverflow", i, a ? "left" : "top")), t || (t = ue("coverflow", i, a ? "right" : "bottom")), 
                        e && (e.style.opacity = p > 0 ? p : 0), t && (t.style.opacity = -p > 0 ? -p : 0);
                    }
                }
            },
            setTransition: e => {
                t.slides.map((e => h(e))).forEach((t => {
                    t.style.transitionDuration = `${e}ms`, t.querySelectorAll(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").forEach((t => {
                        t.style.transitionDuration = `${e}ms`;
                    }));
                }));
            },
            perspective: () => !0,
            overwriteParams: () => ({
                watchSlidesProgress: !0
            })
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            creativeEffect: {
                limitProgress: 1,
                shadowPerProgress: !1,
                progressMultiplier: 1,
                perspective: !0,
                prev: {
                    translate: [ 0, 0, 0 ],
                    rotate: [ 0, 0, 0 ],
                    opacity: 1,
                    scale: 1
                },
                next: {
                    translate: [ 0, 0, 0 ],
                    rotate: [ 0, 0, 0 ],
                    opacity: 1,
                    scale: 1
                }
            }
        });
        const s = e => "string" == typeof e ? e : `${e}px`;
        le({
            effect: "creative",
            swiper: t,
            on: n,
            setTranslate: () => {
                const {slides: e, wrapperEl: i, slidesSizesGrid: n} = t, r = t.params.creativeEffect, {progressMultiplier: a} = r, o = t.params.centeredSlides;
                if (o) {
                    const e = n[0] / 2 - t.params.slidesOffsetBefore || 0;
                    i.style.transform = `translateX(calc(50% - ${e}px))`;
                }
                for (let i = 0; i < e.length; i += 1) {
                    const n = e[i], l = n.progress, c = Math.min(Math.max(n.progress, -r.limitProgress), r.limitProgress);
                    let d = c;
                    o || (d = Math.min(Math.max(n.originalProgress, -r.limitProgress), r.limitProgress));
                    const u = n.swiperSlideOffset, p = [ t.params.cssMode ? -u - t.translate : -u, 0, 0 ], f = [ 0, 0, 0 ];
                    let h = !1;
                    t.isHorizontal() || (p[1] = p[0], p[0] = 0);
                    let m = {
                        translate: [ 0, 0, 0 ],
                        rotate: [ 0, 0, 0 ],
                        scale: 1,
                        opacity: 1
                    };
                    c < 0 ? (m = r.next, h = !0) : c > 0 && (m = r.prev, h = !0), p.forEach(((e, t) => {
                        p[t] = `calc(${e}px + (${s(m.translate[t])} * ${Math.abs(c * a)}))`;
                    })), f.forEach(((e, i) => {
                        let n = m.rotate[i] * Math.abs(c * a);
                        t.browser && t.browser.isSafari && Math.abs(n) / 90 % 2 == 1 && (n += .001), f[i] = n;
                    })), n.style.zIndex = -Math.abs(Math.round(l)) + e.length;
                    const g = p.join(", "), v = `rotateX(${f[0]}deg) rotateY(${f[1]}deg) rotateZ(${f[2]}deg)`, y = d < 0 ? `scale(${1 + (1 - m.scale) * d * a})` : `scale(${1 - (1 - m.scale) * d * a})`, b = d < 0 ? 1 + (1 - m.opacity) * d * a : 1 - (1 - m.opacity) * d * a, w = `translate3d(${g}) ${v} ${y}`;
                    if (h && m.shadow || !h) {
                        let e = n.querySelector(".swiper-slide-shadow");
                        if (!e && m.shadow && (e = ue("creative", n)), e) {
                            const t = r.shadowPerProgress ? c * (1 / r.limitProgress) : c;
                            e.style.opacity = Math.min(Math.max(Math.abs(t), 0), 1);
                        }
                    }
                    const x = ce(0, n);
                    x.style.transform = w, x.style.opacity = b, m.origin && (x.style.transformOrigin = m.origin);
                }
            },
            setTransition: e => {
                const i = t.slides.map((e => h(e)));
                i.forEach((t => {
                    t.style.transitionDuration = `${e}ms`, t.querySelectorAll(".swiper-slide-shadow").forEach((t => {
                        t.style.transitionDuration = `${e}ms`;
                    }));
                })), de({
                    swiper: t,
                    duration: e,
                    transformElements: i,
                    allSlides: !0
                });
            },
            perspective: () => t.params.creativeEffect.perspective,
            overwriteParams: () => ({
                watchSlidesProgress: !0,
                virtualTranslate: !t.params.cssMode
            })
        });
    }, function(e) {
        let {swiper: t, extendParams: i, on: n} = e;
        i({
            cardsEffect: {
                slideShadows: !0,
                rotate: !0,
                perSlideRotate: 2,
                perSlideOffset: 8
            }
        }), le({
            effect: "cards",
            swiper: t,
            on: n,
            setTranslate: () => {
                const {slides: e, activeIndex: i, rtlTranslate: n} = t, s = t.params.cardsEffect, {startTranslate: r, isTouched: a} = t.touchEventsData, o = n ? -t.translate : t.translate;
                for (let l = 0; l < e.length; l += 1) {
                    const c = e[l], d = c.progress, u = Math.min(Math.max(d, -4), 4);
                    let p = c.swiperSlideOffset;
                    t.params.centeredSlides && !t.params.cssMode && (t.wrapperEl.style.transform = `translateX(${t.minTranslate()}px)`), 
                    t.params.centeredSlides && t.params.cssMode && (p -= e[0].swiperSlideOffset);
                    let f = t.params.cssMode ? -p - t.translate : -p, h = 0;
                    const m = -100 * Math.abs(u);
                    let g = 1, v = -s.perSlideRotate * u, y = s.perSlideOffset - .75 * Math.abs(u);
                    const b = t.virtual && t.params.virtual.enabled ? t.virtual.from + l : l, w = (b === i || b === i - 1) && u > 0 && u < 1 && (a || t.params.cssMode) && o < r, x = (b === i || b === i + 1) && u < 0 && u > -1 && (a || t.params.cssMode) && o > r;
                    if (w || x) {
                        const e = (1 - Math.abs((Math.abs(u) - .5) / .5)) ** .5;
                        v += -28 * u * e, g += -.5 * e, y += 96 * e, h = -25 * e * Math.abs(u) + "%";
                    }
                    if (f = u < 0 ? `calc(${f}px ${n ? "-" : "+"} (${y * Math.abs(u)}%))` : u > 0 ? `calc(${f}px ${n ? "-" : "+"} (-${y * Math.abs(u)}%))` : `${f}px`, 
                    !t.isHorizontal()) {
                        const e = h;
                        h = f, f = e;
                    }
                    const E = u < 0 ? "" + (1 + (1 - g) * u) : "" + (1 - (1 - g) * u), _ = `\n        translate3d(${f}, ${h}, ${m}px)\n        rotateZ(${s.rotate ? n ? -v : v : 0}deg)\n        scale(${E})\n      `;
                    if (s.slideShadows) {
                        let e = c.querySelector(".swiper-slide-shadow");
                        e || (e = ue("cards", c)), e && (e.style.opacity = Math.min(Math.max((Math.abs(u) - .5) / .5, 0), 1));
                    }
                    c.style.zIndex = -Math.abs(Math.round(d)) + e.length;
                    ce(0, c).style.transform = _;
                }
            },
            setTransition: e => {
                const i = t.slides.map((e => h(e)));
                i.forEach((t => {
                    t.style.transitionDuration = `${e}ms`, t.querySelectorAll(".swiper-slide-shadow").forEach((t => {
                        t.style.transitionDuration = `${e}ms`;
                    }));
                })), de({
                    swiper: t,
                    duration: e,
                    transformElements: i
                });
            },
            perspective: () => !0,
            overwriteParams: () => ({
                watchSlidesProgress: !0,
                virtualTranslate: !t.params.cssMode
            })
        });
    } ];
    return ee.use(pe), ee;
}();

!function(e) {
    const t = e(".contact-form");
    t.on("submit", (function(t) {
        const i = this;
        t.preventDefault();
        const n = e(this).find('button[type="submit"]').text();
        return e(this).find('button[type="submit"]').prop("disabled", !0).text("Sending..."), 
        e.post(e(this).attr("action"), e(this).serialize(), (function(t) {
            var s;
            (s = t.message) && (e("#contact-form-modal").modal("hide"), e("#feedback-message").text(s), 
            e("#feedback-modal").modal("show")), e(i).find('button[type="submit"]').prop("disabled", !1).text(n);
        }), "json"), !1;
    }));
    const i = e("form img.captcha"), n = i.attr("src");
    e("form .captcha").on("click", (function() {
        i.attr("src", n + "?s=" + Math.random());
    }));
}(jQuery), function() {
    const e = $(".page-achievements-content"), t = e.find(".content").find(".row"), i = e.find("#load-more"), n = e.find(".no-more");
    let s = 1;
    i.on("click", (function(e) {
        e.preventDefault();
        const r = 2 * (s - 1), a = r + 2;
        return function(e, i) {
            t.each((function(t, n) {
                t >= e && t < i && $(this).removeClass("d-none");
            })), e && $("html, body").animate({
                scrollTop: t.eq(e).offset().top
            });
        }(r, a), a > t.length && (i.toggleClass("d-none"), n.toggleClass("d-none")), s++, 
        !1;
    })).trigger("click");
}(), function(e) {
    e(".slide-toggle").on("click", (function() {
        const t = e(this).parent(), i = t.find(".slide-content-wrap"), n = t.find(".slide-content");
        t.toggleClass("open"), t.find(".toggle i").toggleClass(".bi-chevron-compact-down bi-chevron-compact-up"), 
        t.hasClass("open") ? i.animate({
            height: n.outerHeight()
        }) : i.animate({
            height: 0
        });
    })), e(".offices-list > .office-item:first").find(".slide-toggle").trigger("click");
}(jQuery), function(e) {
    new e(".slideshow-home1 .swiper", {
        loop: !0,
        autoplay: {
            delay: 5e3
        },
        pagination: {
            el: ".slideshow-home1 .swiper-pagination",
            clickable: !0
        }
    }), new e(".slideshow-achievements .swiper", {
        loop: !0,
        slidesPerView: 2,
        spaceBetween: 10,
        autoplay: {
            delay: 3e3
        },
        breakpoints: {
            640: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 40
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 100
            }
        }
    }), new e(".slideshow-scope-services .swiper", {
        loop: !0,
        slidesPerView: 1,
        spaceBetween: 0,
        autoplay: {
            delay: 4e3
        },
        navigation: {
            nextEl: ".block-scope-services .swiper-button-next",
            prevEl: ".block-scope-services .swiper-button-prev"
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1200: {
                slidesPerView: "auto",
                spaceBetween: 30
            }
        }
    }), new e(".slideshow-client-testimonials .swiper", {
        slidesPerView: 1,
        spaceBetween: 2,
        autoplay: {
            delay: 4e3
        },
        pagination: {
            el: ".slideshow-client-testimonials .swiper-pagination",
            type: "fraction",
            renderFraction: function(e, t) {
                return '<span class="' + e + '"></span> / <span class="' + t + '"></span>';
            }
        },
        navigation: {
            nextEl: ".slideshow-client-testimonials .swiper-button-next",
            prevEl: ".slideshow-client-testimonials .swiper-button-prev"
        }
    }), new e(".slideshow-newsletter .swiper", {
        loop: !0,
        slidesPerView: 1,
        spaceBetween: 0,
        autoplay: {
            delay: 3e3
        },
        navigation: {
            nextEl: ".slideshow-newsletter .swiper-button-next",
            prevEl: ".slideshow-newsletter .swiper-button-prev"
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        }
    }), new e(".slideshow-related .swiper", {
        loop: !0,
        slidesPerView: 1,
        spaceBetween: 0,
        autoplay: {
            delay: 3e3
        },
        navigation: {
            nextEl: ".slideshow-related .swiper-button-next",
            prevEl: ".slideshow-related .swiper-button-prev"
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 80
            }
        }
    });
    $(".achievement-slideshow").each((function(t, i) {
        new e(".achievement-slideshow" + (t + 1) + " .swiper", {
            loop: !0,
            slidesPerView: 1,
            spaceBetween: 0,
            autoplay: {
                delay: Math.floor(6e3 * Math.random() + 1e3)
            },
            pagination: {
                el: ".achievement-slideshow" + (t + 1) + " .swiper-pagination",
                clickable: !0
            }
        });
    }));
}(Swiper);