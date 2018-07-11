window.quix_filemanager_url = "index.php?source=admin&file=";

! function(e, t) {
    function n(e) {
        var t = e.length,
            n = le.type(e);
        return le.isWindow(e) ? !1 : 1 === e.nodeType && t ? !0 : "array" === n || "function" !== n && (0 === t || "number" == typeof t && t > 0 && t - 1 in e) }

    function i(e) {
        var t = ke[e] = {};
        return le.each(e.match(ue) || [], function(e, n) { t[n] = !0 }), t }

    function o(e, n, i, o) {
        if (le.acceptData(e)) {
            var r, s, a = le.expando,
                l = "string" == typeof n,
                c = e.nodeType,
                u = c ? le.cache : e,
                d = c ? e[a] : e[a] && a;
            if (d && u[d] && (o || u[d].data) || !l || i !== t) return d || (c ? e[a] = d = Z.pop() || le.guid++ : d = a), u[d] || (u[d] = {}, c || (u[d].toJSON = le.noop)), ("object" == typeof n || "function" == typeof n) && (o ? u[d] = le.extend(u[d], n) : u[d].data = le.extend(u[d].data, n)), r = u[d], o || (r.data || (r.data = {}), r = r.data), i !== t && (r[le.camelCase(n)] = i), l ? (s = r[n], null == s && (s = r[le.camelCase(n)])) : s = r, s } }

    function r(e, t, n) {
        if (le.acceptData(e)) {
            var i, o, r, s = e.nodeType,
                l = s ? le.cache : e,
                c = s ? e[le.expando] : le.expando;
            if (l[c]) {
                if (t && (r = n ? l[c] : l[c].data)) { le.isArray(t) ? t = t.concat(le.map(t, le.camelCase)) : t in r ? t = [t] : (t = le.camelCase(t), t = t in r ? [t] : t.split(" "));
                    for (i = 0, o = t.length; o > i; i++) delete r[t[i]];
                    if (!(n ? a : le.isEmptyObject)(r)) return }(n || (delete l[c].data, a(l[c]))) && (s ? le.cleanData([e], !0) : le.support.deleteExpando || l != l.window ? delete l[c] : l[c] = null) } } }

    function s(e, n, i) {
        if (i === t && 1 === e.nodeType) {
            var o = "data-" + n.replace(Ee, "-$1").toLowerCase();
            if (i = e.getAttribute(o), "string" == typeof i) {
                try { i = "true" === i ? !0 : "false" === i ? !1 : "null" === i ? null : +i + "" === i ? +i : Te.test(i) ? le.parseJSON(i) : i } catch (r) {}
                le.data(e, n, i) } else i = t }
        return i }

    function a(e) {
        var t;
        for (t in e)
            if (("data" !== t || !le.isEmptyObject(e[t])) && "toJSON" !== t) return !1;
        return !0 }

    function l() {
        return !0 }

    function c() {
        return !1 }

    function u(e, t) { do e = e[t]; while (e && 1 !== e.nodeType);
        return e }

    function d(e, t, n) {
        if (t = t || 0, le.isFunction(t)) return le.grep(e, function(e, i) {
            var o = !!t.call(e, i, e);
            return o === n });
        if (t.nodeType) return le.grep(e, function(e) {
            return e === t === n });
        if ("string" == typeof t) {
            var i = le.grep(e, function(e) {
                return 1 === e.nodeType });
            if (Be.test(t)) return le.filter(t, i, !n);
            t = le.filter(t, i) }
        return le.grep(e, function(e) {
            return le.inArray(e, t) >= 0 === n }) }

    function p(e) {
        var t = Xe.split("|"),
            n = e.createDocumentFragment();
        if (n.createElement)
            for (; t.length;) n.createElement(t.pop());
        return n }

    function h(e, t) {
        return e.getElementsByTagName(t)[0] || e.appendChild(e.ownerDocument.createElement(t)) }

    function f(e) {
        var t = e.getAttributeNode("type");
        return e.type = (t && t.specified) + "/" + e.type, e }

    function m(e) {
        var t = ot.exec(e.type);
        return t ? e.type = t[1] : e.removeAttribute("type"), e }

    function g(e, t) {
        for (var n, i = 0; null != (n = e[i]); i++) le._data(n, "globalEval", !t || le._data(t[i], "globalEval")) }

    function v(e, t) {
        if (1 === t.nodeType && le.hasData(e)) {
            var n, i, o, r = le._data(e),
                s = le._data(t, r),
                a = r.events;
            if (a) { delete s.handle, s.events = {};
                for (n in a)
                    for (i = 0, o = a[n].length; o > i; i++) le.event.add(t, n, a[n][i]) }
            s.data && (s.data = le.extend({}, s.data)) } }

    function y(e, t) {
        var n, i, o;
        if (1 === t.nodeType) {
            if (n = t.nodeName.toLowerCase(), !le.support.noCloneEvent && t[le.expando]) { o = le._data(t);
                for (i in o.events) le.removeEvent(t, i, o.handle);
                t.removeAttribute(le.expando) } "script" === n && t.text !== e.text ? (f(t).text = e.text, m(t)) : "object" === n ? (t.parentNode && (t.outerHTML = e.outerHTML), le.support.html5Clone && e.innerHTML && !le.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === n && tt.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : "option" === n ? t.defaultSelected = t.selected = e.defaultSelected : ("input" === n || "textarea" === n) && (t.defaultValue = e.defaultValue) } }

    function b(e, n) {
        var i, o, r = 0,
            s = typeof e.getElementsByTagName !== Y ? e.getElementsByTagName(n || "*") : typeof e.querySelectorAll !== Y ? e.querySelectorAll(n || "*") : t;
        if (!s)
            for (s = [], i = e.childNodes || e; null != (o = i[r]); r++) !n || le.nodeName(o, n) ? s.push(o) : le.merge(s, b(o, n));
        return n === t || n && le.nodeName(e, n) ? le.merge([e], s) : s }

    function w(e) { tt.test(e.type) && (e.defaultChecked = e.checked) }

    function x(e, t) {
        if (t in e) return t;
        for (var n = t.charAt(0).toUpperCase() + t.slice(1), i = t, o = Tt.length; o--;)
            if (t = Tt[o] + n, t in e) return t;
        return i }

    function C(e, t) {
        return e = t || e, "none" === le.css(e, "display") || !le.contains(e.ownerDocument, e) }

    function k(e, t) {
        for (var n, i, o, r = [], s = 0, a = e.length; a > s; s++) i = e[s], i.style && (r[s] = le._data(i, "olddisplay"), n = i.style.display, t ? (r[s] || "none" !== n || (i.style.display = ""), "" === i.style.display && C(i) && (r[s] = le._data(i, "olddisplay", N(i.nodeName)))) : r[s] || (o = C(i), (n && "none" !== n || !o) && le._data(i, "olddisplay", o ? n : le.css(i, "display"))));
        for (s = 0; a > s; s++) i = e[s], i.style && (t && "none" !== i.style.display && "" !== i.style.display || (i.style.display = t ? r[s] || "" : "none"));
        return e }

    function T(e, t, n) {
        var i = vt.exec(t);
        return i ? Math.max(0, i[1] - (n || 0)) + (i[2] || "px") : t }

    function E(e, t, n, i, o) {
        for (var r = n === (i ? "border" : "content") ? 4 : "width" === t ? 1 : 0, s = 0; 4 > r; r += 2) "margin" === n && (s += le.css(e, n + kt[r], !0, o)), i ? ("content" === n && (s -= le.css(e, "padding" + kt[r], !0, o)), "margin" !== n && (s -= le.css(e, "border" + kt[r] + "Width", !0, o))) : (s += le.css(e, "padding" + kt[r], !0, o), "padding" !== n && (s += le.css(e, "border" + kt[r] + "Width", !0, o)));
        return s }

    function $(e, t, n) {
        var i = !0,
            o = "width" === t ? e.offsetWidth : e.offsetHeight,
            r = ut(e),
            s = le.support.boxSizing && "border-box" === le.css(e, "boxSizing", !1, r);
        if (0 >= o || null == o) {
            if (o = dt(e, t, r), (0 > o || null == o) && (o = e.style[t]), yt.test(o)) return o;
            i = s && (le.support.boxSizingReliable || o === e.style[t]), o = parseFloat(o) || 0 }
        return o + E(e, t, n || (s ? "border" : "content"), i, r) + "px" }

    function N(e) {
        var t = Q,
            n = wt[e];
        return n || (n = _(e, t), "none" !== n && n || (ct = (ct || le("<iframe frameborder='0' width='0' height='0'/>").css("cssText", "display:block !important")).appendTo(t.documentElement), t = (ct[0].contentWindow || ct[0].contentDocument).document, t.write("<!doctype html><html><body>"), t.close(), n = _(e, t), ct.detach()), wt[e] = n), n }

    function _(e, t) {
        var n = le(t.createElement(e)).appendTo(t.body),
            i = le.css(n[0], "display");
        return n.remove(), i }

    function S(e, t, n, i) {
        var o;
        if (le.isArray(t)) le.each(t, function(t, o) { n || $t.test(e) ? i(e, o) : S(e + "[" + ("object" == typeof o ? t : "") + "]", o, n, i) });
        else if (n || "object" !== le.type(t)) i(e, t);
        else
            for (o in t) S(e + "[" + o + "]", t[o], n, i) }

    function D(e) {
        return function(t, n) { "string" != typeof t && (n = t, t = "*");
            var i, o = 0,
                r = t.toLowerCase().match(ue) || [];
            if (le.isFunction(n))
                for (; i = r[o++];) "+" === i[0] ? (i = i.slice(1) || "*", (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n) } }

    function A(e, t, n, i) {
        function o(a) {
            var l;
            return r[a] = !0, le.each(e[a] || [], function(e, a) {
                var c = a(t, n, i);
                return "string" != typeof c || s || r[c] ? s ? !(l = c) : void 0 : (t.dataTypes.unshift(c), o(c), !1) }), l }
        var r = {},
            s = e === Bt;
        return o(t.dataTypes[0]) || !r["*"] && o("*") }

    function M(e, n) {
        var i, o, r = le.ajaxSettings.flatOptions || {};
        for (o in n) n[o] !== t && ((r[o] ? e : i || (i = {}))[o] = n[o]);
        return i && le.extend(!0, e, i), e }

    function L(e, n, i) {
        var o, r, s, a, l = e.contents,
            c = e.dataTypes,
            u = e.responseFields;
        for (a in u) a in i && (n[u[a]] = i[a]);
        for (;
            "*" === c[0];) c.shift(), r === t && (r = e.mimeType || n.getResponseHeader("Content-Type"));
        if (r)
            for (a in l)
                if (l[a] && l[a].test(r)) { c.unshift(a);
                    break }
        if (c[0] in i) s = c[0];
        else {
            for (a in i) {
                if (!c[0] || e.converters[a + " " + c[0]]) { s = a;
                    break }
                o || (o = a) }
            s = s || o }
        return s ? (s !== c[0] && c.unshift(s), i[s]) : void 0 }

    function P(e, t) {
        var n, i, o, r, s = {},
            a = 0,
            l = e.dataTypes.slice(),
            c = l[0];
        if (e.dataFilter && (t = e.dataFilter(t, e.dataType)), l[1])
            for (o in e.converters) s[o.toLowerCase()] = e.converters[o];
        for (; i = l[++a];)
            if ("*" !== i) {
                if ("*" !== c && c !== i) {
                    if (o = s[c + " " + i] || s["* " + i], !o)
                        for (n in s)
                            if (r = n.split(" "), r[1] === i && (o = s[c + " " + r[0]] || s["* " + r[0]])) { o === !0 ? o = s[n] : s[n] !== !0 && (i = r[0], l.splice(a--, 0, i));
                                break }
                    if (o !== !0)
                        if (o && e["throws"]) t = o(t);
                        else try { t = o(t) } catch (u) {
                            return { state: "parsererror", error: o ? u : "No conversion from " + c + " to " + i } } }
                c = i }
        return { state: "success", data: t } }

    function F() {
        try {
            return new e.XMLHttpRequest } catch (t) {} }

    function O() {
        try {
            return new e.ActiveXObject("Microsoft.XMLHTTP") } catch (t) {} }

    function I() {
        return setTimeout(function() { Jt = t }), Jt = le.now() }

    function H(e, t) { le.each(t, function(t, n) {
            for (var i = (rn[t] || []).concat(rn["*"]), o = 0, r = i.length; r > o; o++)
                if (i[o].call(e, t, n)) return }) }

    function j(e, t, n) {
        var i, o, r = 0,
            s = on.length,
            a = le.Deferred().always(function() { delete l.elem }),
            l = function() {
                if (o) return !1;
                for (var t = Jt || I(), n = Math.max(0, c.startTime + c.duration - t), i = n / c.duration || 0, r = 1 - i, s = 0, l = c.tweens.length; l > s; s++) c.tweens[s].run(r);
                return a.notifyWith(e, [c, r, n]), 1 > r && l ? n : (a.resolveWith(e, [c]), !1) },
            c = a.promise({ elem: e, props: le.extend({}, t), opts: le.extend(!0, { specialEasing: {} }, n), originalProperties: t, originalOptions: n, startTime: Jt || I(), duration: n.duration, tweens: [], createTween: function(t, n) {
                    var i = le.Tween(e, c.opts, t, n, c.opts.specialEasing[t] || c.opts.easing);
                    return c.tweens.push(i), i }, stop: function(t) {
                    var n = 0,
                        i = t ? c.tweens.length : 0;
                    if (o) return this;
                    for (o = !0; i > n; n++) c.tweens[n].run(1);
                    return t ? a.resolveWith(e, [c, t]) : a.rejectWith(e, [c, t]), this } }),
            u = c.props;
        for (z(u, c.opts.specialEasing); s > r; r++)
            if (i = on[r].call(c, e, u, c.opts)) return i;
        return H(c, u), le.isFunction(c.opts.start) && c.opts.start.call(e, c), le.fx.timer(le.extend(l, { elem: e, anim: c, queue: c.opts.queue })), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always) }

    function z(e, t) {
        var n, i, o, r, s;
        for (o in e)
            if (i = le.camelCase(o), r = t[i], n = e[o], le.isArray(n) && (r = n[1], n = e[o] = n[0]), o !== i && (e[i] = n, delete e[o]), s = le.cssHooks[i], s && "expand" in s) { n = s.expand(n), delete e[i];
                for (o in n) o in e || (e[o] = n[o], t[o] = r) } else t[i] = r }

    function W(e, t, n) {
        var i, o, r, s, a, l, c, u, d, p = this,
            h = e.style,
            f = {},
            m = [],
            g = e.nodeType && C(e);
        n.queue || (u = le._queueHooks(e, "fx"), null == u.unqueued && (u.unqueued = 0, d = u.empty.fire, u.empty.fire = function() { u.unqueued || d() }), u.unqueued++, p.always(function() { p.always(function() { u.unqueued--, le.queue(e, "fx").length || u.empty.fire() }) })), 1 === e.nodeType && ("height" in t || "width" in t) && (n.overflow = [h.overflow, h.overflowX, h.overflowY], "inline" === le.css(e, "display") && "none" === le.css(e, "float") && (le.support.inlineBlockNeedsLayout && "inline" !== N(e.nodeName) ? h.zoom = 1 : h.display = "inline-block")), n.overflow && (h.overflow = "hidden", le.support.shrinkWrapBlocks || p.always(function() { h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2] }));
        for (o in t)
            if (s = t[o], en.exec(s)) {
                if (delete t[o], l = l || "toggle" === s, s === (g ? "hide" : "show")) continue;
                m.push(o) }
        if (r = m.length) { a = le._data(e, "fxshow") || le._data(e, "fxshow", {}), "hidden" in a && (g = a.hidden), l && (a.hidden = !g), g ? le(e).show() : p.done(function() { le(e).hide() }), p.done(function() {
                var t;
                le._removeData(e, "fxshow");
                for (t in f) le.style(e, t, f[t]) });
            for (o = 0; r > o; o++) i = m[o], c = p.createTween(i, g ? a[i] : 0), f[i] = a[i] || le.style(e, i), i in a || (a[i] = c.start, g && (c.end = c.start, c.start = "width" === i || "height" === i ? 1 : 0)) } }

    function R(e, t, n, i, o) {
        return new R.prototype.init(e, t, n, i, o) }

    function B(e, t) {
        var n, i = { height: e },
            o = 0;
        for (t = t ? 1 : 0; 4 > o; o += 2 - t) n = kt[o], i["margin" + n] = i["padding" + n] = e;
        return t && (i.opacity = i.width = e), i }

    function q(e) {
        return le.isWindow(e) ? e : 9 === e.nodeType ? e.defaultView || e.parentWindow : !1 }
    var U, X, Y = typeof t,
        Q = e.document,
        K = e.location,
        G = e.jQuery,
        V = e.$,
        J = {},
        Z = [],
        ee = "1.9.1",
        te = Z.concat,
        ne = Z.push,
        ie = Z.slice,
        oe = Z.indexOf,
        re = J.toString,
        se = J.hasOwnProperty,
        ae = ee.trim,
        le = function(e, t) {
            return new le.fn.init(e, t, X) },
        ce = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        ue = /\S+/g,
        de = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        pe = /^(?:(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        he = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
        fe = /^[\],:{}\s]*$/,
        me = /(?:^|:|,)(?:\s*\[)+/g,
        ge = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
        ve = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,
        ye = /^-ms-/,
        be = /-([\da-z])/gi,
        we = function(e, t) {
            return t.toUpperCase() },
        xe = function(e) {
            (Q.addEventListener || "load" === e.type || "complete" === Q.readyState) && (Ce(), le.ready()) },
        Ce = function() { Q.addEventListener ? (Q.removeEventListener("DOMContentLoaded", xe, !1), e.removeEventListener("load", xe, !1)) : (Q.detachEvent("onreadystatechange", xe), e.detachEvent("onload", xe)) };
    le.fn = le.prototype = { jquery: ee, constructor: le, init: function(e, n, i) {
            var o, r;
            if (!e) return this;
            if ("string" == typeof e) {
                if (o = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && e.length >= 3 ? [null, e, null] : pe.exec(e), !o || !o[1] && n) return !n || n.jquery ? (n || i).find(e) : this.constructor(n).find(e);
                if (o[1]) {
                    if (n = n instanceof le ? n[0] : n, le.merge(this, le.parseHTML(o[1], n && n.nodeType ? n.ownerDocument || n : Q, !0)), he.test(o[1]) && le.isPlainObject(n))
                        for (o in n) le.isFunction(this[o]) ? this[o](n[o]) : this.attr(o, n[o]);
                    return this }
                if (r = Q.getElementById(o[2]), r && r.parentNode) {
                    if (r.id !== o[2]) return i.find(e);
                    this.length = 1, this[0] = r }
                return this.context = Q, this.selector = e, this }
            return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : le.isFunction(e) ? i.ready(e) : (e.selector !== t && (this.selector = e.selector, this.context = e.context), le.makeArray(e, this)) }, selector: "", length: 0, size: function() {
            return this.length }, toArray: function() {
            return ie.call(this) }, get: function(e) {
            return null == e ? this.toArray() : 0 > e ? this[this.length + e] : this[e] }, pushStack: function(e) {
            var t = le.merge(this.constructor(), e);
            return t.prevObject = this, t.context = this.context, t }, each: function(e, t) {
            return le.each(this, e, t) }, ready: function(e) {
            return le.ready.promise().done(e), this }, slice: function() {
            return this.pushStack(ie.apply(this, arguments)) }, first: function() {
            return this.eq(0) }, last: function() {
            return this.eq(-1) }, eq: function(e) {
            var t = this.length,
                n = +e + (0 > e ? t : 0);
            return this.pushStack(n >= 0 && t > n ? [this[n]] : []) }, map: function(e) {
            return this.pushStack(le.map(this, function(t, n) {
                return e.call(t, n, t) })) }, end: function() {
            return this.prevObject || this.constructor(null) }, push: ne, sort: [].sort, splice: [].splice }, le.fn.init.prototype = le.fn, le.extend = le.fn.extend = function() {
        var e, n, i, o, r, s, a = arguments[0] || {},
            l = 1,
            c = arguments.length,
            u = !1;
        for ("boolean" == typeof a && (u = a, a = arguments[1] || {}, l = 2), "object" == typeof a || le.isFunction(a) || (a = {}), c === l && (a = this, --l); c > l; l++)
            if (null != (r = arguments[l]))
                for (o in r) e = a[o], i = r[o], a !== i && (u && i && (le.isPlainObject(i) || (n = le.isArray(i))) ? (n ? (n = !1, s = e && le.isArray(e) ? e : []) : s = e && le.isPlainObject(e) ? e : {}, a[o] = le.extend(u, s, i)) : i !== t && (a[o] = i));
        return a }, le.extend({ noConflict: function(t) {
            return e.$ === le && (e.$ = V), t && e.jQuery === le && (e.jQuery = G), le }, isReady: !1, readyWait: 1, holdReady: function(e) { e ? le.readyWait++ : le.ready(!0) }, ready: function(e) {
            if (e === !0 ? !--le.readyWait : !le.isReady) {
                if (!Q.body) return setTimeout(le.ready);
                le.isReady = !0, e !== !0 && --le.readyWait > 0 || (U.resolveWith(Q, [le]), le.fn.trigger && le(Q).trigger("ready").off("ready")) } }, isFunction: function(e) {
            return "function" === le.type(e) }, isArray: Array.isArray || function(e) {
            return "array" === le.type(e) }, isWindow: function(e) {
            return null != e && e == e.window }, isNumeric: function(e) {
            return !isNaN(parseFloat(e)) && isFinite(e) }, type: function(e) {
            return null == e ? String(e) : "object" == typeof e || "function" == typeof e ? J[re.call(e)] || "object" : typeof e }, isPlainObject: function(e) {
            if (!e || "object" !== le.type(e) || e.nodeType || le.isWindow(e)) return !1;
            try {
                if (e.constructor && !se.call(e, "constructor") && !se.call(e.constructor.prototype, "isPrototypeOf")) return !1 } catch (n) {
                return !1 }
            var i;
            for (i in e);
            return i === t || se.call(e, i) }, isEmptyObject: function(e) {
            var t;
            for (t in e) return !1;
            return !0 }, error: function(e) {
            throw new Error(e) }, parseHTML: function(e, t, n) {
            if (!e || "string" != typeof e) return null; "boolean" == typeof t && (n = t, t = !1), t = t || Q;
            var i = he.exec(e),
                o = !n && [];
            return i ? [t.createElement(i[1])] : (i = le.buildFragment([e], t, o), o && le(o).remove(), le.merge([], i.childNodes)) }, parseJSON: function(t) {
            return e.JSON && e.JSON.parse ? e.JSON.parse(t) : null === t ? t : "string" == typeof t && (t = le.trim(t), t && fe.test(t.replace(ge, "@").replace(ve, "]").replace(me, ""))) ? new Function("return " + t)() : void le.error("Invalid JSON: " + t) }, parseXML: function(n) {
            var i, o;
            if (!n || "string" != typeof n) return null;
            try { e.DOMParser ? (o = new DOMParser, i = o.parseFromString(n, "text/xml")) : (i = new ActiveXObject("Microsoft.XMLDOM"), i.async = "false", i.loadXML(n)) } catch (r) { i = t }
            return i && i.documentElement && !i.getElementsByTagName("parsererror").length || le.error("Invalid XML: " + n), i }, noop: function() {}, globalEval: function(t) { t && le.trim(t) && (e.execScript || function(t) { e.eval.call(e, t) })(t) }, camelCase: function(e) {
            return e.replace(ye, "ms-").replace(be, we) }, nodeName: function(e, t) {
            return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase() }, each: function(e, t, i) {
            var o, r = 0,
                s = e.length,
                a = n(e);
            if (i) {
                if (a)
                    for (; s > r && (o = t.apply(e[r], i), o !== !1); r++);
                else
                    for (r in e)
                        if (o = t.apply(e[r], i), o === !1) break } else if (a)
                for (; s > r && (o = t.call(e[r], r, e[r]), o !== !1); r++);
            else
                for (r in e)
                    if (o = t.call(e[r], r, e[r]), o === !1) break; return e }, trim: ae && !ae.call("\ufeff ") ? function(e) {
            return null == e ? "" : ae.call(e) } : function(e) {
            return null == e ? "" : (e + "").replace(de, "") }, makeArray: function(e, t) {
            var i = t || [];
            return null != e && (n(Object(e)) ? le.merge(i, "string" == typeof e ? [e] : e) : ne.call(i, e)), i }, inArray: function(e, t, n) {
            var i;
            if (t) {
                if (oe) return oe.call(t, e, n);
                for (i = t.length, n = n ? 0 > n ? Math.max(0, i + n) : n : 0; i > n; n++)
                    if (n in t && t[n] === e) return n }
            return -1 }, merge: function(e, n) {
            var i = n.length,
                o = e.length,
                r = 0;
            if ("number" == typeof i)
                for (; i > r; r++) e[o++] = n[r];
            else
                for (; n[r] !== t;) e[o++] = n[r++];
            return e.length = o, e }, grep: function(e, t, n) {
            var i, o = [],
                r = 0,
                s = e.length;
            for (n = !!n; s > r; r++) i = !!t(e[r], r), n !== i && o.push(e[r]);
            return o }, map: function(e, t, i) {
            var o, r = 0,
                s = e.length,
                a = n(e),
                l = [];
            if (a)
                for (; s > r; r++) o = t(e[r], r, i), null != o && (l[l.length] = o);
            else
                for (r in e) o = t(e[r], r, i), null != o && (l[l.length] = o);
            return te.apply([], l) }, guid: 1, proxy: function(e, n) {
            var i, o, r;
            return "string" == typeof n && (r = e[n], n = e, e = r), le.isFunction(e) ? (i = ie.call(arguments, 2), o = function() {
                return e.apply(n || this, i.concat(ie.call(arguments))) }, o.guid = e.guid = e.guid || le.guid++, o) : t }, access: function(e, n, i, o, r, s, a) {
            var l = 0,
                c = e.length,
                u = null == i;
            if ("object" === le.type(i)) { r = !0;
                for (l in i) le.access(e, n, l, i[l], !0, s, a) } else if (o !== t && (r = !0, le.isFunction(o) || (a = !0), u && (a ? (n.call(e, o), n = null) : (u = n, n = function(e, t, n) {
                    return u.call(le(e), n) })), n))
                for (; c > l; l++) n(e[l], i, a ? o : o.call(e[l], l, n(e[l], i)));
            return r ? e : u ? n.call(e) : c ? n(e[0], i) : s }, now: function() {
            return (new Date).getTime() } }), le.ready.promise = function(t) {
        if (!U)
            if (U = le.Deferred(), "complete" === Q.readyState) setTimeout(le.ready);
            else if (Q.addEventListener) Q.addEventListener("DOMContentLoaded", xe, !1), e.addEventListener("load", xe, !1);
        else { Q.attachEvent("onreadystatechange", xe), e.attachEvent("onload", xe);
            var n = !1;
            try { n = null == e.frameElement && Q.documentElement } catch (i) {}
            n && n.doScroll && ! function o() {
                if (!le.isReady) {
                    try { n.doScroll("left") } catch (e) {
                        return setTimeout(o, 50) }
                    Ce(), le.ready() } }() }
        return U.promise(t) }, le.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(e, t) { J["[object " + t + "]"] = t.toLowerCase() }), X = le(Q);
    var ke = {};
    le.Callbacks = function(e) { e = "string" == typeof e ? ke[e] || i(e) : le.extend({}, e);
        var n, o, r, s, a, l, c = [],
            u = !e.once && [],
            d = function(t) {
                for (o = e.memory && t, r = !0, a = l || 0, l = 0, s = c.length, n = !0; c && s > a; a++)
                    if (c[a].apply(t[0], t[1]) === !1 && e.stopOnFalse) { o = !1;
                        break }
                n = !1, c && (u ? u.length && d(u.shift()) : o ? c = [] : p.disable()) },
            p = { add: function() {
                    if (c) {
                        var t = c.length;! function i(t) { le.each(t, function(t, n) {
                                var o = le.type(n); "function" === o ? e.unique && p.has(n) || c.push(n) : n && n.length && "string" !== o && i(n) }) }(arguments), n ? s = c.length : o && (l = t, d(o)) }
                    return this }, remove: function() {
                    return c && le.each(arguments, function(e, t) {
                        for (var i;
                            (i = le.inArray(t, c, i)) > -1;) c.splice(i, 1), n && (s >= i && s--, a >= i && a--) }), this }, has: function(e) {
                    return e ? le.inArray(e, c) > -1 : !(!c || !c.length) }, empty: function() {
                    return c = [], this }, disable: function() {
                    return c = u = o = t, this }, disabled: function() {
                    return !c }, lock: function() {
                    return u = t, o || p.disable(), this }, locked: function() {
                    return !u }, fireWith: function(e, t) {
                    return t = t || [], t = [e, t.slice ? t.slice() : t], !c || r && !u || (n ? u.push(t) : d(t)), this }, fire: function() {
                    return p.fireWith(this, arguments), this }, fired: function() {
                    return !!r } };
        return p }, le.extend({ Deferred: function(e) {
            var t = [
                    ["resolve", "done", le.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", le.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", le.Callbacks("memory")]
                ],
                n = "pending",
                i = { state: function() {
                        return n }, always: function() {
                        return o.done(arguments).fail(arguments), this }, then: function() {
                        var e = arguments;
                        return le.Deferred(function(n) { le.each(t, function(t, r) {
                                var s = r[0],
                                    a = le.isFunction(e[t]) && e[t];
                                o[r[1]](function() {
                                    var e = a && a.apply(this, arguments);
                                    e && le.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[s + "With"](this === i ? n.promise() : this, a ? [e] : arguments) }) }), e = null }).promise() }, promise: function(e) {
                        return null != e ? le.extend(e, i) : i } },
                o = {};
            return i.pipe = i.then, le.each(t, function(e, r) {
                var s = r[2],
                    a = r[3];
                i[r[1]] = s.add, a && s.add(function() { n = a }, t[1 ^ e][2].disable, t[2][2].lock), o[r[0]] = function() {
                    return o[r[0] + "With"](this === o ? i : this, arguments), this }, o[r[0] + "With"] = s.fireWith }), i.promise(o), e && e.call(o, o), o }, when: function(e) {
            var t, n, i, o = 0,
                r = ie.call(arguments),
                s = r.length,
                a = 1 !== s || e && le.isFunction(e.promise) ? s : 0,
                l = 1 === a ? e : le.Deferred(),
                c = function(e, n, i) {
                    return function(o) { n[e] = this, i[e] = arguments.length > 1 ? ie.call(arguments) : o, i === t ? l.notifyWith(n, i) : --a || l.resolveWith(n, i) } };
            if (s > 1)
                for (t = new Array(s), n = new Array(s), i = new Array(s); s > o; o++) r[o] && le.isFunction(r[o].promise) ? r[o].promise().done(c(o, i, r)).fail(l.reject).progress(c(o, n, t)) : --a;
            return a || l.resolveWith(i, r), l.promise() } }), le.support = function() {
        var t, n, i, o, r, s, a, l, c, u, d = Q.createElement("div");
        if (d.setAttribute("className", "t"), d.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = d.getElementsByTagName("*"), i = d.getElementsByTagName("a")[0], !n || !i || !n.length) return {};
        r = Q.createElement("select"), a = r.appendChild(Q.createElement("option")), o = d.getElementsByTagName("input")[0], i.style.cssText = "top:1px;float:left;opacity:.5", t = { getSetAttribute: "t" !== d.className, leadingWhitespace: 3 === d.firstChild.nodeType, tbody: !d.getElementsByTagName("tbody").length, htmlSerialize: !!d.getElementsByTagName("link").length, style: /top/.test(i.getAttribute("style")), hrefNormalized: "/a" === i.getAttribute("href"), opacity: /^0.5/.test(i.style.opacity), cssFloat: !!i.style.cssFloat, checkOn: !!o.value, optSelected: a.selected, enctype: !!Q.createElement("form").enctype, html5Clone: "<:nav></:nav>" !== Q.createElement("nav").cloneNode(!0).outerHTML, boxModel: "CSS1Compat" === Q.compatMode, deleteExpando: !0, noCloneEvent: !0, inlineBlockNeedsLayout: !1, shrinkWrapBlocks: !1, reliableMarginRight: !0, boxSizingReliable: !0, pixelPosition: !1 }, o.checked = !0, t.noCloneChecked = o.cloneNode(!0).checked, r.disabled = !0, t.optDisabled = !a.disabled;
        try { delete d.test } catch (p) { t.deleteExpando = !1 }
        o = Q.createElement("input"), o.setAttribute("value", ""), t.input = "" === o.getAttribute("value"), o.value = "t", o.setAttribute("type", "radio"), t.radioValue = "t" === o.value, o.setAttribute("checked", "t"), o.setAttribute("name", "t"), s = Q.createDocumentFragment(), s.appendChild(o), t.appendChecked = o.checked, t.checkClone = s.cloneNode(!0).cloneNode(!0).lastChild.checked, d.attachEvent && (d.attachEvent("onclick", function() { t.noCloneEvent = !1 }), d.cloneNode(!0).click());
        for (u in { submit: !0, change: !0, focusin: !0 }) d.setAttribute(l = "on" + u, "t"), t[u + "Bubbles"] = l in e || d.attributes[l].expando === !1;
        return d.style.backgroundClip = "content-box", d.cloneNode(!0).style.backgroundClip = "", t.clearCloneStyle = "content-box" === d.style.backgroundClip, le(function() {
            var n, i, o, r = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",
                s = Q.getElementsByTagName("body")[0];
            s && (n = Q.createElement("div"), n.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", s.appendChild(n).appendChild(d), d.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", o = d.getElementsByTagName("td"), o[0].style.cssText = "padding:0;margin:0;border:0;display:none", c = 0 === o[0].offsetHeight, o[0].style.display = "", o[1].style.display = "none", t.reliableHiddenOffsets = c && 0 === o[0].offsetHeight, d.innerHTML = "", d.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", t.boxSizing = 4 === d.offsetWidth, t.doesNotIncludeMarginInBodyOffset = 1 !== s.offsetTop, e.getComputedStyle && (t.pixelPosition = "1%" !== (e.getComputedStyle(d, null) || {}).top, t.boxSizingReliable = "4px" === (e.getComputedStyle(d, null) || { width: "4px" }).width, i = d.appendChild(Q.createElement("div")), i.style.cssText = d.style.cssText = r, i.style.marginRight = i.style.width = "0", d.style.width = "1px", t.reliableMarginRight = !parseFloat((e.getComputedStyle(i, null) || {}).marginRight)), typeof d.style.zoom !== Y && (d.innerHTML = "", d.style.cssText = r + "width:1px;padding:1px;display:inline;zoom:1", t.inlineBlockNeedsLayout = 3 === d.offsetWidth, d.style.display = "block", d.innerHTML = "<div></div>", d.firstChild.style.width = "5px", t.shrinkWrapBlocks = 3 !== d.offsetWidth, t.inlineBlockNeedsLayout && (s.style.zoom = 1)), s.removeChild(n), n = d = o = i = null) }), n = r = s = a = i = o = null, t }();
    var Te = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
        Ee = /([A-Z])/g;
    le.extend({ cache: {}, expando: "jQuery" + (ee + Math.random()).replace(/\D/g, ""), noData: { embed: !0, object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", applet: !0 }, hasData: function(e) {
            return e = e.nodeType ? le.cache[e[le.expando]] : e[le.expando], !!e && !a(e) }, data: function(e, t, n) {
            return o(e, t, n) }, removeData: function(e, t) {
            return r(e, t) }, _data: function(e, t, n) {
            return o(e, t, n, !0) }, _removeData: function(e, t) {
            return r(e, t, !0) }, acceptData: function(e) {
            if (e.nodeType && 1 !== e.nodeType && 9 !== e.nodeType) return !1;
            var t = e.nodeName && le.noData[e.nodeName.toLowerCase()];
            return !t || t !== !0 && e.getAttribute("classid") === t } }), le.fn.extend({ data: function(e, n) {
            var i, o, r = this[0],
                a = 0,
                l = null;
            if (e === t) {
                if (this.length && (l = le.data(r), 1 === r.nodeType && !le._data(r, "parsedAttrs"))) {
                    for (i = r.attributes; a < i.length; a++) o = i[a].name, o.indexOf("data-") || (o = le.camelCase(o.slice(5)), s(r, o, l[o]));
                    le._data(r, "parsedAttrs", !0) }
                return l }
            return "object" == typeof e ? this.each(function() { le.data(this, e) }) : le.access(this, function(n) {
                return n === t ? r ? s(r, e, le.data(r, e)) : null : void this.each(function() { le.data(this, e, n) }) }, null, n, arguments.length > 1, null, !0) }, removeData: function(e) {
            return this.each(function() { le.removeData(this, e) }) } }), le.extend({ queue: function(e, t, n) {
            var i;
            return e ? (t = (t || "fx") + "queue", i = le._data(e, t), n && (!i || le.isArray(n) ? i = le._data(e, t, le.makeArray(n)) : i.push(n)), i || []) : void 0 }, dequeue: function(e, t) { t = t || "fx";
            var n = le.queue(e, t),
                i = n.length,
                o = n.shift(),
                r = le._queueHooks(e, t),
                s = function() { le.dequeue(e, t) }; "inprogress" === o && (o = n.shift(), i--), r.cur = o, o && ("fx" === t && n.unshift("inprogress"), delete r.stop, o.call(e, s, r)), !i && r && r.empty.fire() }, _queueHooks: function(e, t) {
            var n = t + "queueHooks";
            return le._data(e, n) || le._data(e, n, { empty: le.Callbacks("once memory").add(function() { le._removeData(e, t + "queue"), le._removeData(e, n) }) }) } }), le.fn.extend({ queue: function(e, n) {
            var i = 2;
            return "string" != typeof e && (n = e, e = "fx", i--), arguments.length < i ? le.queue(this[0], e) : n === t ? this : this.each(function() {
                var t = le.queue(this, e, n);
                le._queueHooks(this, e), "fx" === e && "inprogress" !== t[0] && le.dequeue(this, e) }) }, dequeue: function(e) {
            return this.each(function() { le.dequeue(this, e) }) }, delay: function(e, t) {
            return e = le.fx ? le.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function(t, n) {
                var i = setTimeout(t, e);
                n.stop = function() { clearTimeout(i) } }) }, clearQueue: function(e) {
            return this.queue(e || "fx", []) }, promise: function(e, n) {
            var i, o = 1,
                r = le.Deferred(),
                s = this,
                a = this.length,
                l = function() {--o || r.resolveWith(s, [s]) };
            for ("string" != typeof e && (n = e, e = t), e = e || "fx"; a--;) i = le._data(s[a], e + "queueHooks"), i && i.empty && (o++, i.empty.add(l));
            return l(), r.promise(n) } });
    var $e, Ne, _e = /[\t\r\n]/g,
        Se = /\r/g,
        De = /^(?:input|select|textarea|button|object)$/i,
        Ae = /^(?:a|area)$/i,
        Me = /^(?:checked|selected|autofocus|autoplay|async|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped)$/i,
        Le = /^(?:checked|selected)$/i,
        Pe = le.support.getSetAttribute,
        Fe = le.support.input;
    le.fn.extend({ attr: function(e, t) {
            return le.access(this, le.attr, e, t, arguments.length > 1) }, removeAttr: function(e) {
            return this.each(function() { le.removeAttr(this, e) }) }, prop: function(e, t) {
            return le.access(this, le.prop, e, t, arguments.length > 1) }, removeProp: function(e) {
            return e = le.propFix[e] || e, this.each(function() {
                try { this[e] = t, delete this[e] } catch (n) {} }) }, addClass: function(e) {
            var t, n, i, o, r, s = 0,
                a = this.length,
                l = "string" == typeof e && e;
            if (le.isFunction(e)) return this.each(function(t) { le(this).addClass(e.call(this, t, this.className)) });
            if (l)
                for (t = (e || "").match(ue) || []; a > s; s++)
                    if (n = this[s], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(_e, " ") : " ")) {
                        for (r = 0; o = t[r++];) i.indexOf(" " + o + " ") < 0 && (i += o + " ");
                        n.className = le.trim(i) }
            return this }, removeClass: function(e) {
            var t, n, i, o, r, s = 0,
                a = this.length,
                l = 0 === arguments.length || "string" == typeof e && e;
            if (le.isFunction(e)) return this.each(function(t) { le(this).removeClass(e.call(this, t, this.className)) });
            if (l)
                for (t = (e || "").match(ue) || []; a > s; s++)
                    if (n = this[s], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(_e, " ") : "")) {
                        for (r = 0; o = t[r++];)
                            for (; i.indexOf(" " + o + " ") >= 0;) i = i.replace(" " + o + " ", " ");
                        n.className = e ? le.trim(i) : "" }
            return this }, toggleClass: function(e, t) {
            var n = typeof e,
                i = "boolean" == typeof t;
            return this.each(le.isFunction(e) ? function(n) { le(this).toggleClass(e.call(this, n, this.className, t), t) } : function() {
                if ("string" === n)
                    for (var o, r = 0, s = le(this), a = t, l = e.match(ue) || []; o = l[r++];) a = i ? a : !s.hasClass(o), s[a ? "addClass" : "removeClass"](o);
                else(n === Y || "boolean" === n) && (this.className && le._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : le._data(this, "__className__") || "") }) }, hasClass: function(e) {
            for (var t = " " + e + " ", n = 0, i = this.length; i > n; n++)
                if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(_e, " ").indexOf(t) >= 0) return !0;
            return !1 }, val: function(e) {
            var n, i, o, r = this[0]; {
                if (arguments.length) return o = le.isFunction(e), this.each(function(n) {
                    var r, s = le(this);
                    1 === this.nodeType && (r = o ? e.call(this, n, s.val()) : e, null == r ? r = "" : "number" == typeof r ? r += "" : le.isArray(r) && (r = le.map(r, function(e) {
                        return null == e ? "" : e + "" })), i = le.valHooks[this.type] || le.valHooks[this.nodeName.toLowerCase()], i && "set" in i && i.set(this, r, "value") !== t || (this.value = r)) });
                if (r) return i = le.valHooks[r.type] || le.valHooks[r.nodeName.toLowerCase()], i && "get" in i && (n = i.get(r, "value")) !== t ? n : (n = r.value, "string" == typeof n ? n.replace(Se, "") : null == n ? "" : n) } } }), le.extend({ valHooks: { option: { get: function(e) {
                    var t = e.attributes.value;
                    return !t || t.specified ? e.value : e.text } }, select: { get: function(e) {
                    for (var t, n, i = e.options, o = e.selectedIndex, r = "select-one" === e.type || 0 > o, s = r ? null : [], a = r ? o + 1 : i.length, l = 0 > o ? a : r ? o : 0; a > l; l++)
                        if (n = i[l], !(!n.selected && l !== o || (le.support.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && le.nodeName(n.parentNode, "optgroup"))) {
                            if (t = le(n).val(), r) return t;
                            s.push(t) }
                    return s }, set: function(e, t) {
                    var n = le.makeArray(t);
                    return le(e).find("option").each(function() { this.selected = le.inArray(le(this).val(), n) >= 0 }), n.length || (e.selectedIndex = -1), n } } }, attr: function(e, n, i) {
            var o, r, s, a = e.nodeType;
            if (e && 3 !== a && 8 !== a && 2 !== a) return typeof e.getAttribute === Y ? le.prop(e, n, i) : (r = 1 !== a || !le.isXMLDoc(e), r && (n = n.toLowerCase(), o = le.attrHooks[n] || (Me.test(n) ? Ne : $e)), i === t ? o && r && "get" in o && null !== (s = o.get(e, n)) ? s : (typeof e.getAttribute !== Y && (s = e.getAttribute(n)), null == s ? t : s) : null !== i ? o && r && "set" in o && (s = o.set(e, i, n)) !== t ? s : (e.setAttribute(n, i + ""), i) : void le.removeAttr(e, n)) }, removeAttr: function(e, t) {
            var n, i, o = 0,
                r = t && t.match(ue);
            if (r && 1 === e.nodeType)
                for (; n = r[o++];) i = le.propFix[n] || n, Me.test(n) ? !Pe && Le.test(n) ? e[le.camelCase("default-" + n)] = e[i] = !1 : e[i] = !1 : le.attr(e, n, ""), e.removeAttribute(Pe ? n : i) }, attrHooks: { type: { set: function(e, t) {
                    if (!le.support.radioValue && "radio" === t && le.nodeName(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t } } } }, propFix: { tabindex: "tabIndex", readonly: "readOnly", "for": "htmlFor", "class": "className", maxlength: "maxLength", cellspacing: "cellSpacing", cellpadding: "cellPadding", rowspan: "rowSpan", colspan: "colSpan", usemap: "useMap", frameborder: "frameBorder", contenteditable: "contentEditable" }, prop: function(e, n, i) {
            var o, r, s, a = e.nodeType;
            if (e && 3 !== a && 8 !== a && 2 !== a) return s = 1 !== a || !le.isXMLDoc(e), s && (n = le.propFix[n] || n, r = le.propHooks[n]), i !== t ? r && "set" in r && (o = r.set(e, i, n)) !== t ? o : e[n] = i : r && "get" in r && null !== (o = r.get(e, n)) ? o : e[n] }, propHooks: { tabIndex: { get: function(e) {
                    var n = e.getAttributeNode("tabindex");
                    return n && n.specified ? parseInt(n.value, 10) : De.test(e.nodeName) || Ae.test(e.nodeName) && e.href ? 0 : t } } } }), Ne = {
        get: function(e, n) {
            var i = le.prop(e, n),
                o = "boolean" == typeof i && e.getAttribute(n),
                r = "boolean" == typeof i ? Fe && Pe ? null != o : Le.test(n) ? e[le.camelCase("default-" + n)] : !!o : e.getAttributeNode(n);
            return r && r.value !== !1 ? n.toLowerCase() : t;

        },
        set: function(e, t, n) {
            return t === !1 ? le.removeAttr(e, n) : Fe && Pe || !Le.test(n) ? e.setAttribute(!Pe && le.propFix[n] || n, n) : e[le.camelCase("default-" + n)] = e[n] = !0, n }
    }, Fe && Pe || (le.attrHooks.value = { get: function(e, n) {
            var i = e.getAttributeNode(n);
            return le.nodeName(e, "input") ? e.defaultValue : i && i.specified ? i.value : t }, set: function(e, t, n) {
            return le.nodeName(e, "input") ? void(e.defaultValue = t) : $e && $e.set(e, t, n) } }), Pe || ($e = le.valHooks.button = { get: function(e, n) {
            var i = e.getAttributeNode(n);
            return i && ("id" === n || "name" === n || "coords" === n ? "" !== i.value : i.specified) ? i.value : t }, set: function(e, n, i) {
            var o = e.getAttributeNode(i);
            return o || e.setAttributeNode(o = e.ownerDocument.createAttribute(i)), o.value = n += "", "value" === i || n === e.getAttribute(i) ? n : t } }, le.attrHooks.contenteditable = { get: $e.get, set: function(e, t, n) { $e.set(e, "" === t ? !1 : t, n) } }, le.each(["width", "height"], function(e, t) { le.attrHooks[t] = le.extend(le.attrHooks[t], { set: function(e, n) {
                return "" === n ? (e.setAttribute(t, "auto"), n) : void 0 } }) })), le.support.hrefNormalized || (le.each(["href", "src", "width", "height"], function(e, n) { le.attrHooks[n] = le.extend(le.attrHooks[n], { get: function(e) {
                var i = e.getAttribute(n, 2);
                return null == i ? t : i } }) }), le.each(["href", "src"], function(e, t) { le.propHooks[t] = { get: function(e) {
                return e.getAttribute(t, 4) } } })), le.support.style || (le.attrHooks.style = { get: function(e) {
            return e.style.cssText || t }, set: function(e, t) {
            return e.style.cssText = t + "" } }), le.support.optSelected || (le.propHooks.selected = le.extend(le.propHooks.selected, { get: function(e) {
            var t = e.parentNode;
            return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null } })), le.support.enctype || (le.propFix.enctype = "encoding"), le.support.checkOn || le.each(["radio", "checkbox"], function() { le.valHooks[this] = { get: function(e) {
                return null === e.getAttribute("value") ? "on" : e.value } } }), le.each(["radio", "checkbox"], function() { le.valHooks[this] = le.extend(le.valHooks[this], { set: function(e, t) {
                return le.isArray(t) ? e.checked = le.inArray(le(e).val(), t) >= 0 : void 0 } }) });
    var Oe = /^(?:input|select|textarea)$/i,
        Ie = /^key/,
        He = /^(?:mouse|contextmenu)|click/,
        je = /^(?:focusinfocus|focusoutblur)$/,
        ze = /^([^.]*)(?:\.(.+)|)$/;
    le.event = { global: {}, add: function(e, n, i, o, r) {
                var s, a, l, c, u, d, p, h, f, m, g, v = le._data(e);
                if (v) {
                    for (i.handler && (c = i, i = c.handler, r = c.selector), i.guid || (i.guid = le.guid++), (a = v.events) || (a = v.events = {}), (d = v.handle) || (d = v.handle = function(e) {
                            return typeof le === Y || e && le.event.triggered === e.type ? t : le.event.dispatch.apply(d.elem, arguments) }, d.elem = e), n = (n || "").match(ue) || [""], l = n.length; l--;) s = ze.exec(n[l]) || [], f = g = s[1], m = (s[2] || "").split(".").sort(), u = le.event.special[f] || {}, f = (r ? u.delegateType : u.bindType) || f, u = le.event.special[f] || {}, p = le.extend({ type: f, origType: g, data: o, handler: i, guid: i.guid, selector: r, needsContext: r && le.expr.match.needsContext.test(r), namespace: m.join(".") }, c), (h = a[f]) || (h = a[f] = [], h.delegateCount = 0, u.setup && u.setup.call(e, o, m, d) !== !1 || (e.addEventListener ? e.addEventListener(f, d, !1) : e.attachEvent && e.attachEvent("on" + f, d))), u.add && (u.add.call(e, p), p.handler.guid || (p.handler.guid = i.guid)), r ? h.splice(h.delegateCount++, 0, p) : h.push(p), le.event.global[f] = !0;
                    e = null } }, remove: function(e, t, n, i, o) {
                var r, s, a, l, c, u, d, p, h, f, m, g = le.hasData(e) && le._data(e);
                if (g && (u = g.events)) {
                    for (t = (t || "").match(ue) || [""], c = t.length; c--;)
                        if (a = ze.exec(t[c]) || [], h = m = a[1], f = (a[2] || "").split(".").sort(), h) {
                            for (d = le.event.special[h] || {}, h = (i ? d.delegateType : d.bindType) || h, p = u[h] || [], a = a[2] && new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)"), l = r = p.length; r--;) s = p[r], !o && m !== s.origType || n && n.guid !== s.guid || a && !a.test(s.namespace) || i && i !== s.selector && ("**" !== i || !s.selector) || (p.splice(r, 1), s.selector && p.delegateCount--, d.remove && d.remove.call(e, s));
                            l && !p.length && (d.teardown && d.teardown.call(e, f, g.handle) !== !1 || le.removeEvent(e, h, g.handle), delete u[h]) } else
                            for (h in u) le.event.remove(e, h + t[c], n, i, !0);
                    le.isEmptyObject(u) && (delete g.handle, le._removeData(e, "events")) } }, trigger: function(n, i, o, r) {
                var s, a, l, c, u, d, p, h = [o || Q],
                    f = se.call(n, "type") ? n.type : n,
                    m = se.call(n, "namespace") ? n.namespace.split(".") : [];
                if (l = d = o = o || Q, 3 !== o.nodeType && 8 !== o.nodeType && !je.test(f + le.event.triggered) && (f.indexOf(".") >= 0 && (m = f.split("."), f = m.shift(), m.sort()), a = f.indexOf(":") < 0 && "on" + f, n = n[le.expando] ? n : new le.Event(f, "object" == typeof n && n), n.isTrigger = !0, n.namespace = m.join("."), n.namespace_re = n.namespace ? new RegExp("(^|\\.)" + m.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, n.result = t, n.target || (n.target = o), i = null == i ? [n] : le.makeArray(i, [n]), u = le.event.special[f] || {}, r || !u.trigger || u.trigger.apply(o, i) !== !1)) {
                    if (!r && !u.noBubble && !le.isWindow(o)) {
                        for (c = u.delegateType || f, je.test(c + f) || (l = l.parentNode); l; l = l.parentNode) h.push(l), d = l;
                        d === (o.ownerDocument || Q) && h.push(d.defaultView || d.parentWindow || e) }
                    for (p = 0;
                        (l = h[p++]) && !n.isPropagationStopped();) n.type = p > 1 ? c : u.bindType || f, s = (le._data(l, "events") || {})[n.type] && le._data(l, "handle"), s && s.apply(l, i), s = a && l[a], s && le.acceptData(l) && s.apply && s.apply(l, i) === !1 && n.preventDefault();
                    if (n.type = f, !(r || n.isDefaultPrevented() || u._default && u._default.apply(o.ownerDocument, i) !== !1 || "click" === f && le.nodeName(o, "a") || !le.acceptData(o) || !a || !o[f] || le.isWindow(o))) { d = o[a], d && (o[a] = null), le.event.triggered = f;
                        try { o[f]() } catch (g) {}
                        le.event.triggered = t, d && (o[a] = d) }
                    return n.result } }, dispatch: function(e) { e = le.event.fix(e);
                var n, i, o, r, s, a = [],
                    l = ie.call(arguments),
                    c = (le._data(this, "events") || {})[e.type] || [],
                    u = le.event.special[e.type] || {};
                if (l[0] = e, e.delegateTarget = this, !u.preDispatch || u.preDispatch.call(this, e) !== !1) {
                    for (a = le.event.handlers.call(this, e, c), n = 0;
                        (r = a[n++]) && !e.isPropagationStopped();)
                        for (e.currentTarget = r.elem, s = 0;
                            (o = r.handlers[s++]) && !e.isImmediatePropagationStopped();)(!e.namespace_re || e.namespace_re.test(o.namespace)) && (e.handleObj = o, e.data = o.data, i = ((le.event.special[o.origType] || {}).handle || o.handler).apply(r.elem, l), i !== t && (e.result = i) === !1 && (e.preventDefault(), e.stopPropagation()));
                    return u.postDispatch && u.postDispatch.call(this, e), e.result } }, handlers: function(e, n) {
                var i, o, r, s, a = [],
                    l = n.delegateCount,
                    c = e.target;
                if (l && c.nodeType && (!e.button || "click" !== e.type))
                    for (; c != this; c = c.parentNode || this)
                        if (1 === c.nodeType && (c.disabled !== !0 || "click" !== e.type)) {
                            for (r = [], s = 0; l > s; s++) o = n[s], i = o.selector + " ", r[i] === t && (r[i] = o.needsContext ? le(i, this).index(c) >= 0 : le.find(i, this, null, [c]).length), r[i] && r.push(o);
                            r.length && a.push({ elem: c, handlers: r }) }
                return l < n.length && a.push({ elem: this, handlers: n.slice(l) }), a }, fix: function(e) {
                if (e[le.expando]) return e;
                var t, n, i, o = e.type,
                    r = e,
                    s = this.fixHooks[o];
                for (s || (this.fixHooks[o] = s = He.test(o) ? this.mouseHooks : Ie.test(o) ? this.keyHooks : {}), i = s.props ? this.props.concat(s.props) : this.props, e = new le.Event(r), t = i.length; t--;) n = i[t], e[n] = r[n];
                return e.target || (e.target = r.srcElement || Q), 3 === e.target.nodeType && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, s.filter ? s.filter(e, r) : e }, props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "), fixHooks: {}, keyHooks: { props: "char charCode key keyCode".split(" "), filter: function(e, t) {
                    return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e } }, mouseHooks: { props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "), filter: function(e, n) {
                    var i, o, r, s = n.button,
                        a = n.fromElement;
                    return null == e.pageX && null != n.clientX && (o = e.target.ownerDocument || Q, r = o.documentElement, i = o.body, e.pageX = n.clientX + (r && r.scrollLeft || i && i.scrollLeft || 0) - (r && r.clientLeft || i && i.clientLeft || 0), e.pageY = n.clientY + (r && r.scrollTop || i && i.scrollTop || 0) - (r && r.clientTop || i && i.clientTop || 0)), !e.relatedTarget && a && (e.relatedTarget = a === e.target ? n.toElement : a), e.which || s === t || (e.which = 1 & s ? 1 : 2 & s ? 3 : 4 & s ? 2 : 0), e } }, special: { load: { noBubble: !0 }, click: { trigger: function() {
                        return le.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0 } }, focus: { trigger: function() {
                        if (this !== Q.activeElement && this.focus) try {
                            return this.focus(), !1 } catch (e) {} }, delegateType: "focusin" }, blur: { trigger: function() {
                        return this === Q.activeElement && this.blur ? (this.blur(), !1) : void 0 }, delegateType: "focusout" }, beforeunload: { postDispatch: function(e) { e.result !== t && (e.originalEvent.returnValue = e.result) } } }, simulate: function(e, t, n, i) {
                var o = le.extend(new le.Event, n, { type: e, isSimulated: !0, originalEvent: {} });
                i ? le.event.trigger(o, null, t) : le.event.dispatch.call(t, o), o.isDefaultPrevented() && n.preventDefault() } }, le.removeEvent = Q.removeEventListener ? function(e, t, n) { e.removeEventListener && e.removeEventListener(t, n, !1) } : function(e, t, n) {
            var i = "on" + t;
            e.detachEvent && (typeof e[i] === Y && (e[i] = null), e.detachEvent(i, n)) }, le.Event = function(e, t) {
            return this instanceof le.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? l : c) : this.type = e, t && le.extend(this, t), this.timeStamp = e && e.timeStamp || le.now(), void(this[le.expando] = !0)) : new le.Event(e, t) }, le.Event.prototype = { isDefaultPrevented: c, isPropagationStopped: c, isImmediatePropagationStopped: c, preventDefault: function() {
                var e = this.originalEvent;
                this.isDefaultPrevented = l, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1) }, stopPropagation: function() {
                var e = this.originalEvent;
                this.isPropagationStopped = l, e && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0) }, stopImmediatePropagation: function() { this.isImmediatePropagationStopped = l, this.stopPropagation() } }, le.each({ mouseenter: "mouseover", mouseleave: "mouseout" }, function(e, t) { le.event.special[e] = { delegateType: t, bindType: t, handle: function(e) {
                    var n, i = this,
                        o = e.relatedTarget,
                        r = e.handleObj;
                    return (!o || o !== i && !le.contains(i, o)) && (e.type = r.origType, n = r.handler.apply(this, arguments), e.type = t), n } } }), le.support.submitBubbles || (le.event.special.submit = { setup: function() {
                return le.nodeName(this, "form") ? !1 : void le.event.add(this, "click._submit keypress._submit", function(e) {
                    var n = e.target,
                        i = le.nodeName(n, "input") || le.nodeName(n, "button") ? n.form : t;
                    i && !le._data(i, "submitBubbles") && (le.event.add(i, "submit._submit", function(e) { e._submit_bubble = !0 }), le._data(i, "submitBubbles", !0)) }) }, postDispatch: function(e) { e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && le.event.simulate("submit", this.parentNode, e, !0)) }, teardown: function() {
                return le.nodeName(this, "form") ? !1 : void le.event.remove(this, "._submit") } }), le.support.changeBubbles || (le.event.special.change = { setup: function() {
                return Oe.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (le.event.add(this, "propertychange._change", function(e) { "checked" === e.originalEvent.propertyName && (this._just_changed = !0) }), le.event.add(this, "click._change", function(e) { this._just_changed && !e.isTrigger && (this._just_changed = !1), le.event.simulate("change", this, e, !0) })), !1) : void le.event.add(this, "beforeactivate._change", function(e) {
                    var t = e.target;
                    Oe.test(t.nodeName) && !le._data(t, "changeBubbles") && (le.event.add(t, "change._change", function(e) {!this.parentNode || e.isSimulated || e.isTrigger || le.event.simulate("change", this.parentNode, e, !0) }), le._data(t, "changeBubbles", !0)) }) }, handle: function(e) {
                var t = e.target;
                return this !== t || e.isSimulated || e.isTrigger || "radio" !== t.type && "checkbox" !== t.type ? e.handleObj.handler.apply(this, arguments) : void 0 }, teardown: function() {
                return le.event.remove(this, "._change"), !Oe.test(this.nodeName) } }), le.support.focusinBubbles || le.each({ focus: "focusin", blur: "focusout" }, function(e, t) {
            var n = 0,
                i = function(e) { le.event.simulate(t, e.target, le.event.fix(e), !0) };
            le.event.special[t] = { setup: function() { 0 === n++ && Q.addEventListener(e, i, !0) }, teardown: function() { 0 === --n && Q.removeEventListener(e, i, !0) } } }), le.fn.extend({ on: function(e, n, i, o, r) {
                var s, a;
                if ("object" == typeof e) { "string" != typeof n && (i = i || n, n = t);
                    for (s in e) this.on(s, n, i, e[s], r);
                    return this }
                if (null == i && null == o ? (o = n, i = n = t) : null == o && ("string" == typeof n ? (o = i, i = t) : (o = i, i = n, n = t)), o === !1) o = c;
                else if (!o) return this;
                return 1 === r && (a = o, o = function(e) {
                    return le().off(e), a.apply(this, arguments) }, o.guid = a.guid || (a.guid = le.guid++)), this.each(function() { le.event.add(this, e, o, i, n) }) }, one: function(e, t, n, i) {
                return this.on(e, t, n, i, 1) }, off: function(e, n, i) {
                var o, r;
                if (e && e.preventDefault && e.handleObj) return o = e.handleObj, le(e.delegateTarget).off(o.namespace ? o.origType + "." + o.namespace : o.origType, o.selector, o.handler), this;
                if ("object" == typeof e) {
                    for (r in e) this.off(r, n, e[r]);
                    return this }
                return (n === !1 || "function" == typeof n) && (i = n, n = t), i === !1 && (i = c), this.each(function() { le.event.remove(this, e, i, n) }) }, bind: function(e, t, n) {
                return this.on(e, null, t, n) }, unbind: function(e, t) {
                return this.off(e, null, t) }, delegate: function(e, t, n, i) {
                return this.on(t, e, n, i) }, undelegate: function(e, t, n) {
                return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n) }, trigger: function(e, t) {
                return this.each(function() { le.event.trigger(e, t, this) }) }, triggerHandler: function(e, t) {
                var n = this[0];
                return n ? le.event.trigger(e, t, n, !0) : void 0 } }),
        function(e, t) {
            function n(e) {
                return fe.test(e + "") }

            function i() {
                var e, t = [];
                return e = function(n, i) {
                    return t.push(n += " ") > T.cacheLength && delete e[t.shift()], e[n] = i } }

            function o(e) {
                return e[j] = !0, e }

            function r(e) {
                var t = A.createElement("div");
                try {
                    return e(t) } catch (n) {
                    return !1 } finally { t = null } }

            function s(e, t, n, i) {
                var o, r, s, a, l, c, u, h, f, m;
                if ((t ? t.ownerDocument || t : z) !== A && D(t), t = t || A, n = n || [], !e || "string" != typeof e) return n;
                if (1 !== (a = t.nodeType) && 9 !== a) return [];
                if (!L && !i) {
                    if (o = me.exec(e))
                        if (s = o[1]) {
                            if (9 === a) {
                                if (r = t.getElementById(s), !r || !r.parentNode) return n;
                                if (r.id === s) return n.push(r), n } else if (t.ownerDocument && (r = t.ownerDocument.getElementById(s)) && I(t, r) && r.id === s) return n.push(r), n } else {
                            if (o[2]) return V.apply(n, J.call(t.getElementsByTagName(e), 0)), n;
                            if ((s = o[3]) && W.getByClassName && t.getElementsByClassName) return V.apply(n, J.call(t.getElementsByClassName(s), 0)), n }
                    if (W.qsa && !P.test(e)) {
                        if (u = !0, h = j, f = t, m = 9 === a && e, 1 === a && "object" !== t.nodeName.toLowerCase()) {
                            for (c = d(e), (u = t.getAttribute("id")) ? h = u.replace(ye, "\\$&") : t.setAttribute("id", h), h = "[id='" + h + "'] ", l = c.length; l--;) c[l] = h + p(c[l]);
                            f = he.test(e) && t.parentNode || t, m = c.join(",") }
                        if (m) try {
                            return V.apply(n, J.call(f.querySelectorAll(m), 0)), n } catch (g) {} finally { u || t.removeAttribute("id") } } }
                return w(e.replace(se, "$1"), t, n, i) }

            function a(e, t) {
                var n = t && e,
                    i = n && (~t.sourceIndex || Q) - (~e.sourceIndex || Q);
                if (i) return i;
                if (n)
                    for (; n = n.nextSibling;)
                        if (n === t) return -1;
                return e ? 1 : -1 }

            function l(e) {
                return function(t) {
                    var n = t.nodeName.toLowerCase();
                    return "input" === n && t.type === e } }

            function c(e) {
                return function(t) {
                    var n = t.nodeName.toLowerCase();
                    return ("input" === n || "button" === n) && t.type === e } }

            function u(e) {
                return o(function(t) {
                    return t = +t, o(function(n, i) {
                        for (var o, r = e([], n.length, t), s = r.length; s--;) n[o = r[s]] && (n[o] = !(i[o] = n[o])) }) }) }

            function d(e, t) {
                var n, i, o, r, a, l, c, u = U[e + " "];
                if (u) return t ? 0 : u.slice(0);
                for (a = e, l = [], c = T.preFilter; a;) {
                    (!n || (i = ae.exec(a))) && (i && (a = a.slice(i[0].length) || a), l.push(o = [])), n = !1, (i = ce.exec(a)) && (n = i.shift(), o.push({ value: n, type: i[0].replace(se, " ") }), a = a.slice(n.length));
                    for (r in T.filter) !(i = pe[r].exec(a)) || c[r] && !(i = c[r](i)) || (n = i.shift(), o.push({ value: n, type: r, matches: i }), a = a.slice(n.length));
                    if (!n) break }
                return t ? a.length : a ? s.error(e) : U(e, l).slice(0) }

            function p(e) {
                for (var t = 0, n = e.length, i = ""; n > t; t++) i += e[t].value;
                return i }

            function h(e, t, n) {
                var i = t.dir,
                    o = n && "parentNode" === i,
                    r = B++;
                return t.first ? function(t, n, r) {
                    for (; t = t[i];)
                        if (1 === t.nodeType || o) return e(t, n, r) } : function(t, n, s) {
                    var a, l, c, u = R + " " + r;
                    if (s) {
                        for (; t = t[i];)
                            if ((1 === t.nodeType || o) && e(t, n, s)) return !0 } else
                        for (; t = t[i];)
                            if (1 === t.nodeType || o)
                                if (c = t[j] || (t[j] = {}), (l = c[i]) && l[0] === u) {
                                    if ((a = l[1]) === !0 || a === k) return a === !0 } else if (l = c[i] = [u], l[1] = e(t, n, s) || k, l[1] === !0) return !0 } }

            function f(e) {
                return e.length > 1 ? function(t, n, i) {
                    for (var o = e.length; o--;)
                        if (!e[o](t, n, i)) return !1;
                    return !0 } : e[0] }

            function m(e, t, n, i, o) {
                for (var r, s = [], a = 0, l = e.length, c = null != t; l > a; a++)(r = e[a]) && (!n || n(r, i, o)) && (s.push(r), c && t.push(a));
                return s }

            function g(e, t, n, i, r, s) {
                return i && !i[j] && (i = g(i)), r && !r[j] && (r = g(r, s)), o(function(o, s, a, l) {
                    var c, u, d, p = [],
                        h = [],
                        f = s.length,
                        g = o || b(t || "*", a.nodeType ? [a] : a, []),
                        v = !e || !o && t ? g : m(g, p, e, a, l),
                        y = n ? r || (o ? e : f || i) ? [] : s : v;
                    if (n && n(v, y, a, l), i)
                        for (c = m(y, h), i(c, [], a, l), u = c.length; u--;)(d = c[u]) && (y[h[u]] = !(v[h[u]] = d));
                    if (o) {
                        if (r || e) {
                            if (r) {
                                for (c = [], u = y.length; u--;)(d = y[u]) && c.push(v[u] = d);
                                r(null, y = [], c, l) }
                            for (u = y.length; u--;)(d = y[u]) && (c = r ? Z.call(o, d) : p[u]) > -1 && (o[c] = !(s[c] = d)) } } else y = m(y === s ? y.splice(f, y.length) : y), r ? r(null, s, y, l) : V.apply(s, y) }) }

            function v(e) {
                for (var t, n, i, o = e.length, r = T.relative[e[0].type], s = r || T.relative[" "], a = r ? 1 : 0, l = h(function(e) {
                        return e === t }, s, !0), c = h(function(e) {
                        return Z.call(t, e) > -1 }, s, !0), u = [function(e, n, i) {
                        return !r && (i || n !== S) || ((t = n).nodeType ? l(e, n, i) : c(e, n, i)) }]; o > a; a++)
                    if (n = T.relative[e[a].type]) u = [h(f(u), n)];
                    else {
                        if (n = T.filter[e[a].type].apply(null, e[a].matches), n[j]) {
                            for (i = ++a; o > i && !T.relative[e[i].type]; i++);
                            return g(a > 1 && f(u), a > 1 && p(e.slice(0, a - 1)).replace(se, "$1"), n, i > a && v(e.slice(a, i)), o > i && v(e = e.slice(i)), o > i && p(e)) }
                        u.push(n) }
                return f(u) }

            function y(e, t) {
                var n = 0,
                    i = t.length > 0,
                    r = e.length > 0,
                    a = function(o, a, l, c, u) {
                        var d, p, h, f = [],
                            g = 0,
                            v = "0",
                            y = o && [],
                            b = null != u,
                            w = S,
                            x = o || r && T.find.TAG("*", u && a.parentNode || a),
                            C = R += null == w ? 1 : Math.random() || .1;
                        for (b && (S = a !== A && a, k = n); null != (d = x[v]); v++) {
                            if (r && d) {
                                for (p = 0; h = e[p++];)
                                    if (h(d, a, l)) { c.push(d);
                                        break }
                                b && (R = C, k = ++n) }
                            i && ((d = !h && d) && g--, o && y.push(d)) }
                        if (g += v, i && v !== g) {
                            for (p = 0; h = t[p++];) h(y, f, a, l);
                            if (o) {
                                if (g > 0)
                                    for (; v--;) y[v] || f[v] || (f[v] = G.call(c));
                                f = m(f) }
                            V.apply(c, f), b && !o && f.length > 0 && g + t.length > 1 && s.uniqueSort(c) }
                        return b && (R = C, S = w), y };
                return i ? o(a) : a }

            function b(e, t, n) {
                for (var i = 0, o = t.length; o > i; i++) s(e, t[i], n);
                return n }

            function w(e, t, n, i) {
                var o, r, s, a, l, c = d(e);
                if (!i && 1 === c.length) {
                    if (r = c[0] = c[0].slice(0), r.length > 2 && "ID" === (s = r[0]).type && 9 === t.nodeType && !L && T.relative[r[1].type]) {
                        if (t = T.find.ID(s.matches[0].replace(we, xe), t)[0], !t) return n;
                        e = e.slice(r.shift().value.length) }
                    for (o = pe.needsContext.test(e) ? 0 : r.length; o-- && (s = r[o], !T.relative[a = s.type]);)
                        if ((l = T.find[a]) && (i = l(s.matches[0].replace(we, xe), he.test(r[0].type) && t.parentNode || t))) {
                            if (r.splice(o, 1), e = i.length && p(r), !e) return V.apply(n, J.call(i, 0)), n;
                            break } }
                return N(e, c)(i, t, L, n, he.test(e)), n }

            function x() {}
            var C, k, T, E, $, N, _, S, D, A, M, L, P, F, O, I, H, j = "sizzle" + -new Date,
                z = e.document,
                W = {},
                R = 0,
                B = 0,
                q = i(),
                U = i(),
                X = i(),
                Y = typeof t,
                Q = 1 << 31,
                K = [],
                G = K.pop,
                V = K.push,
                J = K.slice,
                Z = K.indexOf || function(e) {
                    for (var t = 0, n = this.length; n > t; t++)
                        if (this[t] === e) return t;
                    return -1 },
                ee = "[\\x20\\t\\r\\n\\f]",
                te = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
                ne = te.replace("w", "w#"),
                ie = "([*^$|!~]?=)",
                oe = "\\[" + ee + "*(" + te + ")" + ee + "*(?:" + ie + ee + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + ne + ")|)|)" + ee + "*\\]",
                re = ":(" + te + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + oe.replace(3, 8) + ")*)|.*)\\)|)",
                se = new RegExp("^" + ee + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ee + "+$", "g"),
                ae = new RegExp("^" + ee + "*," + ee + "*"),
                ce = new RegExp("^" + ee + "*([\\x20\\t\\r\\n\\f>+~])" + ee + "*"),
                ue = new RegExp(re),
                de = new RegExp("^" + ne + "$"),
                pe = { ID: new RegExp("^#(" + te + ")"), CLASS: new RegExp("^\\.(" + te + ")"), NAME: new RegExp("^\\[name=['\"]?(" + te + ")['\"]?\\]"), TAG: new RegExp("^(" + te.replace("w", "w*") + ")"), ATTR: new RegExp("^" + oe), PSEUDO: new RegExp("^" + re), CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ee + "*(even|odd|(([+-]|)(\\d*)n|)" + ee + "*(?:([+-]|)" + ee + "*(\\d+)|))" + ee + "*\\)|)", "i"), needsContext: new RegExp("^" + ee + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ee + "*((?:-\\d)?\\d*)" + ee + "*\\)|)(?=[^-]|$)", "i") },
                he = /[\x20\t\r\n\f]*[+~]/,
                fe = /^[^{]+\{\s*\[native code/,
                me = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
                ge = /^(?:input|select|textarea|button)$/i,
                ve = /^h\d$/i,
                ye = /'|\\/g,
                be = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g,
                we = /\\([\da-fA-F]{1,6}[\x20\t\r\n\f]?|.)/g,
                xe = function(e, t) {
                    var n = "0x" + t - 65536;
                    return n !== n ? t : 0 > n ? String.fromCharCode(n + 65536) : String.fromCharCode(n >> 10 | 55296, 1023 & n | 56320) };
            try { J.call(z.documentElement.childNodes, 0)[0].nodeType } catch (Ce) { J = function(e) {
                    for (var t, n = []; t = this[e++];) n.push(t);
                    return n } }
            $ = s.isXML = function(e) {
                var t = e && (e.ownerDocument || e).documentElement;
                return t ? "HTML" !== t.nodeName : !1 }, D = s.setDocument = function(e) {
                var i = e ? e.ownerDocument || e : z;
                return i !== A && 9 === i.nodeType && i.documentElement ? (A = i, M = i.documentElement, L = $(i), W.tagNameNoComments = r(function(e) {
                    return e.appendChild(i.createComment("")), !e.getElementsByTagName("*").length }), W.attributes = r(function(e) { e.innerHTML = "<select></select>";
                    var t = typeof e.lastChild.getAttribute("multiple");
                    return "boolean" !== t && "string" !== t }), W.getByClassName = r(function(e) {
                    return e.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>", e.getElementsByClassName && e.getElementsByClassName("e").length ? (e.lastChild.className = "e", 2 === e.getElementsByClassName("e").length) : !1 }), W.getByName = r(function(e) { e.id = j + 0, e.innerHTML = "<a name='" + j + "'></a><div name='" + j + "'></div>", M.insertBefore(e, M.firstChild);
                    var t = i.getElementsByName && i.getElementsByName(j).length === 2 + i.getElementsByName(j + 0).length;
                    return W.getIdNotName = !i.getElementById(j), M.removeChild(e), t }), T.attrHandle = r(function(e) {
                    return e.innerHTML = "<a href='#'></a>", e.firstChild && typeof e.firstChild.getAttribute !== Y && "#" === e.firstChild.getAttribute("href") }) ? {} : { href: function(e) {
                        return e.getAttribute("href", 2) }, type: function(e) {
                        return e.getAttribute("type") } }, W.getIdNotName ? (T.find.ID = function(e, t) {
                    if (typeof t.getElementById !== Y && !L) {
                        var n = t.getElementById(e);
                        return n && n.parentNode ? [n] : [] } }, T.filter.ID = function(e) {
                    var t = e.replace(we, xe);
                    return function(e) {
                        return e.getAttribute("id") === t } }) : (T.find.ID = function(e, n) {
                    if (typeof n.getElementById !== Y && !L) {
                        var i = n.getElementById(e);
                        return i ? i.id === e || typeof i.getAttributeNode !== Y && i.getAttributeNode("id").value === e ? [i] : t : [] } }, T.filter.ID = function(e) {
                    var t = e.replace(we, xe);
                    return function(e) {
                        var n = typeof e.getAttributeNode !== Y && e.getAttributeNode("id");
                        return n && n.value === t } }), T.find.TAG = W.tagNameNoComments ? function(e, t) {
                    return typeof t.getElementsByTagName !== Y ? t.getElementsByTagName(e) : void 0 } : function(e, t) {
                    var n, i = [],
                        o = 0,
                        r = t.getElementsByTagName(e);
                    if ("*" === e) {
                        for (; n = r[o++];) 1 === n.nodeType && i.push(n);
                        return i }
                    return r }, T.find.NAME = W.getByName && function(e, t) {
                    return typeof t.getElementsByName !== Y ? t.getElementsByName(name) : void 0 }, T.find.CLASS = W.getByClassName && function(e, t) {
                    return typeof t.getElementsByClassName === Y || L ? void 0 : t.getElementsByClassName(e) }, F = [], P = [":focus"], (W.qsa = n(i.querySelectorAll)) && (r(function(e) { e.innerHTML = "<select><option selected=''></option></select>", e.querySelectorAll("[selected]").length || P.push("\\[" + ee + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"), e.querySelectorAll(":checked").length || P.push(":checked") }), r(function(e) { e.innerHTML = "<input type='hidden' i=''/>", e.querySelectorAll("[i^='']").length && P.push("[*^$]=" + ee + "*(?:\"\"|'')"), e.querySelectorAll(":enabled").length || P.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), P.push(",.*:") })), (W.matchesSelector = n(O = M.matchesSelector || M.mozMatchesSelector || M.webkitMatchesSelector || M.oMatchesSelector || M.msMatchesSelector)) && r(function(e) { W.disconnectedMatch = O.call(e, "div"), O.call(e, "[s!='']:x"), F.push("!=", re) }), P = new RegExp(P.join("|")), F = new RegExp(F.join("|")), I = n(M.contains) || M.compareDocumentPosition ? function(e, t) {
                    var n = 9 === e.nodeType ? e.documentElement : e,
                        i = t && t.parentNode;
                    return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i))) } : function(e, t) {
                    if (t)
                        for (; t = t.parentNode;)
                            if (t === e) return !0;
                    return !1 }, H = M.compareDocumentPosition ? function(e, t) {
                    var n;
                    return e === t ? (_ = !0, 0) : (n = t.compareDocumentPosition && e.compareDocumentPosition && e.compareDocumentPosition(t)) ? 1 & n || e.parentNode && 11 === e.parentNode.nodeType ? e === i || I(z, e) ? -1 : t === i || I(z, t) ? 1 : 0 : 4 & n ? -1 : 1 : e.compareDocumentPosition ? -1 : 1 } : function(e, t) {
                    var n, o = 0,
                        r = e.parentNode,
                        s = t.parentNode,
                        l = [e],
                        c = [t];
                    if (e === t) return _ = !0, 0;
                    if (!r || !s) return e === i ? -1 : t === i ? 1 : r ? -1 : s ? 1 : 0;
                    if (r === s) return a(e, t);
                    for (n = e; n = n.parentNode;) l.unshift(n);
                    for (n = t; n = n.parentNode;) c.unshift(n);
                    for (; l[o] === c[o];) o++;
                    return o ? a(l[o], c[o]) : l[o] === z ? -1 : c[o] === z ? 1 : 0 }, _ = !1, [0, 0].sort(H), W.detectDuplicates = _, A) : A }, s.matches = function(e, t) {
                return s(e, null, null, t) }, s.matchesSelector = function(e, t) {
                if ((e.ownerDocument || e) !== A && D(e), t = t.replace(be, "='$1']"), !(!W.matchesSelector || L || F && F.test(t) || P.test(t))) try {
                    var n = O.call(e, t);
                    if (n || W.disconnectedMatch || e.document && 11 !== e.document.nodeType) return n } catch (i) {}
                return s(t, A, null, [e]).length > 0 }, s.contains = function(e, t) {
                return (e.ownerDocument || e) !== A && D(e), I(e, t) }, s.attr = function(e, t) {
                var n;
                return (e.ownerDocument || e) !== A && D(e), L || (t = t.toLowerCase()), (n = T.attrHandle[t]) ? n(e) : L || W.attributes ? e.getAttribute(t) : ((n = e.getAttributeNode(t)) || e.getAttribute(t)) && e[t] === !0 ? t : n && n.specified ? n.value : null }, s.error = function(e) {
                throw new Error("Syntax error, unrecognized expression: " + e) }, s.uniqueSort = function(e) {
                var t, n = [],
                    i = 1,
                    o = 0;
                if (_ = !W.detectDuplicates, e.sort(H), _) {
                    for (; t = e[i]; i++) t === e[i - 1] && (o = n.push(i));
                    for (; o--;) e.splice(n[o], 1) }
                return e }, E = s.getText = function(e) {
                var t, n = "",
                    i = 0,
                    o = e.nodeType;
                if (o) {
                    if (1 === o || 9 === o || 11 === o) {
                        if ("string" == typeof e.textContent) return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling) n += E(e) } else if (3 === o || 4 === o) return e.nodeValue } else
                    for (; t = e[i]; i++) n += E(t);
                return n }, T = s.selectors = { cacheLength: 50, createPseudo: o, match: pe, find: {}, relative: { ">": { dir: "parentNode", first: !0 }, " ": { dir: "parentNode" }, "+": { dir: "previousSibling", first: !0 }, "~": { dir: "previousSibling" } }, preFilter: { ATTR: function(e) {
                        return e[1] = e[1].replace(we, xe), e[3] = (e[4] || e[5] || "").replace(we, xe), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4) }, CHILD: function(e) {
                        return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || s.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && s.error(e[0]), e }, PSEUDO: function(e) {
                        var t, n = !e[5] && e[2];
                        return pe.CHILD.test(e[0]) ? null : (e[4] ? e[2] = e[4] : n && ue.test(n) && (t = d(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3)) } }, filter: { TAG: function(e) {
                        return "*" === e ? function() {
                            return !0 } : (e = e.replace(we, xe).toLowerCase(), function(t) {
                            return t.nodeName && t.nodeName.toLowerCase() === e }) }, CLASS: function(e) {
                        var t = q[e + " "];
                        return t || (t = new RegExp("(^|" + ee + ")" + e + "(" + ee + "|$)")) && q(e, function(e) {
                            return t.test(e.className || typeof e.getAttribute !== Y && e.getAttribute("class") || "") }) }, ATTR: function(e, t, n) {
                        return function(i) {
                            var o = s.attr(i, e);
                            return null == o ? "!=" === t : t ? (o += "", "=" === t ? o === n : "!=" === t ? o !== n : "^=" === t ? n && 0 === o.indexOf(n) : "*=" === t ? n && o.indexOf(n) > -1 : "$=" === t ? n && o.slice(-n.length) === n : "~=" === t ? (" " + o + " ").indexOf(n) > -1 : "|=" === t ? o === n || o.slice(0, n.length + 1) === n + "-" : !1) : !0 } }, CHILD: function(e, t, n, i, o) {
                        var r = "nth" !== e.slice(0, 3),
                            s = "last" !== e.slice(-4),
                            a = "of-type" === t;
                        return 1 === i && 0 === o ? function(e) {
                            return !!e.parentNode } : function(t, n, l) {
                            var c, u, d, p, h, f, m = r !== s ? "nextSibling" : "previousSibling",
                                g = t.parentNode,
                                v = a && t.nodeName.toLowerCase(),
                                y = !l && !a;
                            if (g) {
                                if (r) {
                                    for (; m;) {
                                        for (d = t; d = d[m];)
                                            if (a ? d.nodeName.toLowerCase() === v : 1 === d.nodeType) return !1;
                                        f = m = "only" === e && !f && "nextSibling" }
                                    return !0 }
                                if (f = [s ? g.firstChild : g.lastChild], s && y) {
                                    for (u = g[j] || (g[j] = {}), c = u[e] || [], h = c[0] === R && c[1], p = c[0] === R && c[2], d = h && g.childNodes[h]; d = ++h && d && d[m] || (p = h = 0) || f.pop();)
                                        if (1 === d.nodeType && ++p && d === t) { u[e] = [R, h, p];
                                            break } } else if (y && (c = (t[j] || (t[j] = {}))[e]) && c[0] === R) p = c[1];
                                else
                                    for (;
                                        (d = ++h && d && d[m] || (p = h = 0) || f.pop()) && ((a ? d.nodeName.toLowerCase() !== v : 1 !== d.nodeType) || !++p || (y && ((d[j] || (d[j] = {}))[e] = [R, p]), d !== t)););
                                return p -= o, p === i || p % i === 0 && p / i >= 0 } } }, PSEUDO: function(e, t) {
                        var n, i = T.pseudos[e] || T.setFilters[e.toLowerCase()] || s.error("unsupported pseudo: " + e);
                        return i[j] ? i(t) : i.length > 1 ? (n = [e, e, "", t], T.setFilters.hasOwnProperty(e.toLowerCase()) ? o(function(e, n) {
                            for (var o, r = i(e, t), s = r.length; s--;) o = Z.call(e, r[s]), e[o] = !(n[o] = r[s]) }) : function(e) {
                            return i(e, 0, n) }) : i } }, pseudos: { not: o(function(e) {
                        var t = [],
                            n = [],
                            i = N(e.replace(se, "$1"));
                        return i[j] ? o(function(e, t, n, o) {
                            for (var r, s = i(e, null, o, []), a = e.length; a--;)(r = s[a]) && (e[a] = !(t[a] = r)) }) : function(e, o, r) {
                            return t[0] = e, i(t, null, r, n), !n.pop() } }), has: o(function(e) {
                        return function(t) {
                            return s(e, t).length > 0 } }), contains: o(function(e) {
                        return function(t) {
                            return (t.textContent || t.innerText || E(t)).indexOf(e) > -1 } }), lang: o(function(e) {
                        return de.test(e || "") || s.error("unsupported lang: " + e), e = e.replace(we, xe).toLowerCase(),
                            function(t) {
                                var n;
                                do
                                    if (n = L ? t.getAttribute("xml:lang") || t.getAttribute("lang") : t.lang) return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-");
                                while ((t = t.parentNode) && 1 === t.nodeType);
                                return !1 } }), target: function(t) {
                        var n = e.location && e.location.hash;
                        return n && n.slice(1) === t.id }, root: function(e) {
                        return e === M }, focus: function(e) {
                        return e === A.activeElement && (!A.hasFocus || A.hasFocus()) && !!(e.type || e.href || ~e.tabIndex) }, enabled: function(e) {
                        return e.disabled === !1 }, disabled: function(e) {
                        return e.disabled === !0 }, checked: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && !!e.checked || "option" === t && !!e.selected }, selected: function(e) {
                        return e.parentNode && e.parentNode.selectedIndex, e.selected === !0 }, empty: function(e) {
                        for (e = e.firstChild; e; e = e.nextSibling)
                            if (e.nodeName > "@" || 3 === e.nodeType || 4 === e.nodeType) return !1;
                        return !0 }, parent: function(e) {
                        return !T.pseudos.empty(e) }, header: function(e) {
                        return ve.test(e.nodeName) }, input: function(e) {
                        return ge.test(e.nodeName) }, button: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t }, text: function(e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || t.toLowerCase() === e.type) }, first: u(function() {
                        return [0] }), last: u(function(e, t) {
                        return [t - 1] }), eq: u(function(e, t, n) {
                        return [0 > n ? n + t : n] }), even: u(function(e, t) {
                        for (var n = 0; t > n; n += 2) e.push(n);
                        return e }), odd: u(function(e, t) {
                        for (var n = 1; t > n; n += 2) e.push(n);
                        return e }), lt: u(function(e, t, n) {
                        for (var i = 0 > n ? n + t : n; --i >= 0;) e.push(i);
                        return e }), gt: u(function(e, t, n) {
                        for (var i = 0 > n ? n + t : n; ++i < t;) e.push(i);
                        return e }) } };
            for (C in { radio: !0, checkbox: !0, file: !0, password: !0, image: !0 }) T.pseudos[C] = l(C);
            for (C in { submit: !0, reset: !0 }) T.pseudos[C] = c(C);
            N = s.compile = function(e, t) {
                var n, i = [],
                    o = [],
                    r = X[e + " "];
                if (!r) {
                    for (t || (t = d(e)), n = t.length; n--;) r = v(t[n]), r[j] ? i.push(r) : o.push(r);
                    r = X(e, y(o, i)) }
                return r }, T.pseudos.nth = T.pseudos.eq, T.filters = x.prototype = T.pseudos, T.setFilters = new x, D(), s.attr = le.attr, le.find = s, le.expr = s.selectors, le.expr[":"] = le.expr.pseudos, le.unique = s.uniqueSort, le.text = s.getText, le.isXMLDoc = s.isXML, le.contains = s.contains }(e);
    var We = /Until$/,
        Re = /^(?:parents|prev(?:Until|All))/,
        Be = /^.[^:#\[\.,]*$/,
        qe = le.expr.match.needsContext,
        Ue = { children: !0, contents: !0, next: !0, prev: !0 };
    le.fn.extend({ find: function(e) {
            var t, n, i, o = this.length;
            if ("string" != typeof e) return i = this, this.pushStack(le(e).filter(function() {
                for (t = 0; o > t; t++)
                    if (le.contains(i[t], this)) return !0 }));
            for (n = [], t = 0; o > t; t++) le.find(e, this[t], n);
            return n = this.pushStack(o > 1 ? le.unique(n) : n), n.selector = (this.selector ? this.selector + " " : "") + e, n }, has: function(e) {
            var t, n = le(e, this),
                i = n.length;
            return this.filter(function() {
                for (t = 0; i > t; t++)
                    if (le.contains(this, n[t])) return !0 }) }, not: function(e) {
            return this.pushStack(d(this, e, !1)) }, filter: function(e) {
            return this.pushStack(d(this, e, !0)) }, is: function(e) {
            return !!e && ("string" == typeof e ? qe.test(e) ? le(e, this.context).index(this[0]) >= 0 : le.filter(e, this).length > 0 : this.filter(e).length > 0) }, closest: function(e, t) {
            for (var n, i = 0, o = this.length, r = [], s = qe.test(e) || "string" != typeof e ? le(e, t || this.context) : 0; o > i; i++)
                for (n = this[i]; n && n.ownerDocument && n !== t && 11 !== n.nodeType;) {
                    if (s ? s.index(n) > -1 : le.find.matchesSelector(n, e)) { r.push(n);
                        break }
                    n = n.parentNode }
            return this.pushStack(r.length > 1 ? le.unique(r) : r) }, index: function(e) {
            return e ? "string" == typeof e ? le.inArray(this[0], le(e)) : le.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1 }, add: function(e, t) {
            var n = "string" == typeof e ? le(e, t) : le.makeArray(e && e.nodeType ? [e] : e),
                i = le.merge(this.get(), n);
            return this.pushStack(le.unique(i)) }, addBack: function(e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e)) } }), le.fn.andSelf = le.fn.addBack, le.each({
        parent: function(e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null },
        parents: function(e) {
            return le.dir(e, "parentNode") },
        parentsUntil: function(e, t, n) {
            return le.dir(e, "parentNode", n) },
        next: function(e) {
            return u(e, "nextSibling");

        },
        prev: function(e) {
            return u(e, "previousSibling") },
        nextAll: function(e) {
            return le.dir(e, "nextSibling") },
        prevAll: function(e) {
            return le.dir(e, "previousSibling") },
        nextUntil: function(e, t, n) {
            return le.dir(e, "nextSibling", n) },
        prevUntil: function(e, t, n) {
            return le.dir(e, "previousSibling", n) },
        siblings: function(e) {
            return le.sibling((e.parentNode || {}).firstChild, e) },
        children: function(e) {
            return le.sibling(e.firstChild) },
        contents: function(e) {
            return le.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : le.merge([], e.childNodes) }
    }, function(e, t) { le.fn[e] = function(n, i) {
            var o = le.map(this, t, n);
            return We.test(e) || (i = n), i && "string" == typeof i && (o = le.filter(i, o)), o = this.length > 1 && !Ue[e] ? le.unique(o) : o, this.length > 1 && Re.test(e) && (o = o.reverse()), this.pushStack(o) } }), le.extend({ filter: function(e, t, n) {
            return n && (e = ":not(" + e + ")"), 1 === t.length ? le.find.matchesSelector(t[0], e) ? [t[0]] : [] : le.find.matches(e, t) }, dir: function(e, n, i) {
            for (var o = [], r = e[n]; r && 9 !== r.nodeType && (i === t || 1 !== r.nodeType || !le(r).is(i));) 1 === r.nodeType && o.push(r), r = r[n];
            return o }, sibling: function(e, t) {
            for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
            return n } });
    var Xe = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        Ye = / jQuery\d+="(?:null|\d+)"/g,
        Qe = new RegExp("<(?:" + Xe + ")[\\s/>]", "i"),
        Ke = /^\s+/,
        Ge = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
        Ve = /<([\w:]+)/,
        Je = /<tbody/i,
        Ze = /<|&#?\w+;/,
        et = /<(?:script|style|link)/i,
        tt = /^(?:checkbox|radio)$/i,
        nt = /checked\s*(?:[^=]|=\s*.checked.)/i,
        it = /^$|\/(?:java|ecma)script/i,
        ot = /^true\/(.*)/,
        rt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        st = { option: [1, "<select multiple='multiple'>", "</select>"], legend: [1, "<fieldset>", "</fieldset>"], area: [1, "<map>", "</map>"], param: [1, "<object>", "</object>"], thead: [1, "<table>", "</table>"], tr: [2, "<table><tbody>", "</tbody></table>"], col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"], td: [3, "<table><tbody><tr>", "</tr></tbody></table>"], _default: le.support.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"] },
        at = p(Q),
        lt = at.appendChild(Q.createElement("div"));
    st.optgroup = st.option, st.tbody = st.tfoot = st.colgroup = st.caption = st.thead, st.th = st.td, le.fn.extend({ text: function(e) {
            return le.access(this, function(e) {
                return e === t ? le.text(this) : this.empty().append((this[0] && this[0].ownerDocument || Q).createTextNode(e)) }, null, e, arguments.length) }, wrapAll: function(e) {
            if (le.isFunction(e)) return this.each(function(t) { le(this).wrapAll(e.call(this, t)) });
            if (this[0]) {
                var t = le(e, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && t.insertBefore(this[0]), t.map(function() {
                    for (var e = this; e.firstChild && 1 === e.firstChild.nodeType;) e = e.firstChild;
                    return e }).append(this) }
            return this }, wrapInner: function(e) {
            return this.each(le.isFunction(e) ? function(t) { le(this).wrapInner(e.call(this, t)) } : function() {
                var t = le(this),
                    n = t.contents();
                n.length ? n.wrapAll(e) : t.append(e) }) }, wrap: function(e) {
            var t = le.isFunction(e);
            return this.each(function(n) { le(this).wrapAll(t ? e.call(this, n) : e) }) }, unwrap: function() {
            return this.parent().each(function() { le.nodeName(this, "body") || le(this).replaceWith(this.childNodes) }).end() }, append: function() {
            return this.domManip(arguments, !0, function(e) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.appendChild(e) }) }, prepend: function() {
            return this.domManip(arguments, !0, function(e) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.insertBefore(e, this.firstChild) }) }, before: function() {
            return this.domManip(arguments, !1, function(e) { this.parentNode && this.parentNode.insertBefore(e, this) }) }, after: function() {
            return this.domManip(arguments, !1, function(e) { this.parentNode && this.parentNode.insertBefore(e, this.nextSibling) }) }, remove: function(e, t) {
            for (var n, i = 0; null != (n = this[i]); i++)(!e || le.filter(e, [n]).length > 0) && (t || 1 !== n.nodeType || le.cleanData(b(n)), n.parentNode && (t && le.contains(n.ownerDocument, n) && g(b(n, "script")), n.parentNode.removeChild(n)));
            return this }, empty: function() {
            for (var e, t = 0; null != (e = this[t]); t++) {
                for (1 === e.nodeType && le.cleanData(b(e, !1)); e.firstChild;) e.removeChild(e.firstChild);
                e.options && le.nodeName(e, "select") && (e.options.length = 0) }
            return this }, clone: function(e, t) {
            return e = null == e ? !1 : e, t = null == t ? e : t, this.map(function() {
                return le.clone(this, e, t) }) }, html: function(e) {
            return le.access(this, function(e) {
                var n = this[0] || {},
                    i = 0,
                    o = this.length;
                if (e === t) return 1 === n.nodeType ? n.innerHTML.replace(Ye, "") : t;
                if (!("string" != typeof e || et.test(e) || !le.support.htmlSerialize && Qe.test(e) || !le.support.leadingWhitespace && Ke.test(e) || st[(Ve.exec(e) || ["", ""])[1].toLowerCase()])) { e = e.replace(Ge, "<$1></$2>");
                    try {
                        for (; o > i; i++) n = this[i] || {}, 1 === n.nodeType && (le.cleanData(b(n, !1)), n.innerHTML = e);
                        n = 0 } catch (r) {} }
                n && this.empty().append(e) }, null, e, arguments.length) }, replaceWith: function(e) {
            var t = le.isFunction(e);
            return t || "string" == typeof e || (e = le(e).not(this).detach()), this.domManip([e], !0, function(e) {
                var t = this.nextSibling,
                    n = this.parentNode;
                n && (le(this).remove(), n.insertBefore(e, t)) }) }, detach: function(e) {
            return this.remove(e, !0) }, domManip: function(e, n, i) { e = te.apply([], e);
            var o, r, s, a, l, c, u = 0,
                d = this.length,
                p = this,
                g = d - 1,
                v = e[0],
                y = le.isFunction(v);
            if (y || !(1 >= d || "string" != typeof v || le.support.checkClone) && nt.test(v)) return this.each(function(o) {
                var r = p.eq(o);
                y && (e[0] = v.call(this, o, n ? r.html() : t)), r.domManip(e, n, i) });
            if (d && (c = le.buildFragment(e, this[0].ownerDocument, !1, this), o = c.firstChild, 1 === c.childNodes.length && (c = o), o)) {
                for (n = n && le.nodeName(o, "tr"), a = le.map(b(c, "script"), f), s = a.length; d > u; u++) r = c, u !== g && (r = le.clone(r, !0, !0), s && le.merge(a, b(r, "script"))), i.call(n && le.nodeName(this[u], "table") ? h(this[u], "tbody") : this[u], r, u);
                if (s)
                    for (l = a[a.length - 1].ownerDocument, le.map(a, m), u = 0; s > u; u++) r = a[u], it.test(r.type || "") && !le._data(r, "globalEval") && le.contains(l, r) && (r.src ? le.ajax({ url: r.src, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0 }) : le.globalEval((r.text || r.textContent || r.innerHTML || "").replace(rt, "")));
                c = o = null }
            return this } }), le.each({ appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith" }, function(e, t) { le.fn[e] = function(e) {
            for (var n, i = 0, o = [], r = le(e), s = r.length - 1; s >= i; i++) n = i === s ? this : this.clone(!0), le(r[i])[t](n), ne.apply(o, n.get());
            return this.pushStack(o) } }), le.extend({ clone: function(e, t, n) {
            var i, o, r, s, a, l = le.contains(e.ownerDocument, e);
            if (le.support.html5Clone || le.isXMLDoc(e) || !Qe.test("<" + e.nodeName + ">") ? r = e.cloneNode(!0) : (lt.innerHTML = e.outerHTML, lt.removeChild(r = lt.firstChild)), !(le.support.noCloneEvent && le.support.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || le.isXMLDoc(e)))
                for (i = b(r), a = b(e), s = 0; null != (o = a[s]); ++s) i[s] && y(o, i[s]);
            if (t)
                if (n)
                    for (a = a || b(e), i = i || b(r), s = 0; null != (o = a[s]); s++) v(o, i[s]);
                else v(e, r);
            return i = b(r, "script"), i.length > 0 && g(i, !l && b(e, "script")), i = a = o = null, r }, buildFragment: function(e, t, n, i) {
            for (var o, r, s, a, l, c, u, d = e.length, h = p(t), f = [], m = 0; d > m; m++)
                if (r = e[m], r || 0 === r)
                    if ("object" === le.type(r)) le.merge(f, r.nodeType ? [r] : r);
                    else if (Ze.test(r)) {
                for (a = a || h.appendChild(t.createElement("div")), l = (Ve.exec(r) || ["", ""])[1].toLowerCase(), u = st[l] || st._default, a.innerHTML = u[1] + r.replace(Ge, "<$1></$2>") + u[2], o = u[0]; o--;) a = a.lastChild;
                if (!le.support.leadingWhitespace && Ke.test(r) && f.push(t.createTextNode(Ke.exec(r)[0])), !le.support.tbody)
                    for (r = "table" !== l || Je.test(r) ? "<table>" !== u[1] || Je.test(r) ? 0 : a : a.firstChild, o = r && r.childNodes.length; o--;) le.nodeName(c = r.childNodes[o], "tbody") && !c.childNodes.length && r.removeChild(c);
                for (le.merge(f, a.childNodes), a.textContent = ""; a.firstChild;) a.removeChild(a.firstChild);
                a = h.lastChild } else f.push(t.createTextNode(r));
            for (a && h.removeChild(a), le.support.appendChecked || le.grep(b(f, "input"), w), m = 0; r = f[m++];)
                if ((!i || -1 === le.inArray(r, i)) && (s = le.contains(r.ownerDocument, r), a = b(h.appendChild(r), "script"), s && g(a), n))
                    for (o = 0; r = a[o++];) it.test(r.type || "") && n.push(r);
            return a = null, h }, cleanData: function(e, t) {
            for (var n, i, o, r, s = 0, a = le.expando, l = le.cache, c = le.support.deleteExpando, u = le.event.special; null != (n = e[s]); s++)
                if ((t || le.acceptData(n)) && (o = n[a], r = o && l[o])) {
                    if (r.events)
                        for (i in r.events) u[i] ? le.event.remove(n, i) : le.removeEvent(n, i, r.handle);
                    l[o] && (delete l[o], c ? delete n[a] : typeof n.removeAttribute !== Y ? n.removeAttribute(a) : n[a] = null, Z.push(o)) } } });
    var ct, ut, dt, pt = /alpha\([^)]*\)/i,
        ht = /opacity\s*=\s*([^)]*)/,
        ft = /^(top|right|bottom|left)$/,
        mt = /^(none|table(?!-c[ea]).+)/,
        gt = /^margin/,
        vt = new RegExp("^(" + ce + ")(.*)$", "i"),
        yt = new RegExp("^(" + ce + ")(?!px)[a-z%]+$", "i"),
        bt = new RegExp("^([+-])=(" + ce + ")", "i"),
        wt = { BODY: "block" },
        xt = { position: "absolute", visibility: "hidden", display: "block" },
        Ct = { letterSpacing: 0, fontWeight: 400 },
        kt = ["Top", "Right", "Bottom", "Left"],
        Tt = ["Webkit", "O", "Moz", "ms"];
    le.fn.extend({ css: function(e, n) {
            return le.access(this, function(e, n, i) {
                var o, r, s = {},
                    a = 0;
                if (le.isArray(n)) {
                    for (r = ut(e), o = n.length; o > a; a++) s[n[a]] = le.css(e, n[a], !1, r);
                    return s }
                return i !== t ? le.style(e, n, i) : le.css(e, n) }, e, n, arguments.length > 1) }, show: function() {
            return k(this, !0) }, hide: function() {
            return k(this) }, toggle: function(e) {
            var t = "boolean" == typeof e;
            return this.each(function() {
                (t ? e : C(this)) ? le(this).show(): le(this).hide() }) } }), le.extend({ cssHooks: { opacity: { get: function(e, t) {
                    if (t) {
                        var n = dt(e, "opacity");
                        return "" === n ? "1" : n } } } }, cssNumber: { columnCount: !0, fillOpacity: !0, fontWeight: !0, lineHeight: !0, opacity: !0, orphans: !0, widows: !0, zIndex: !0, zoom: !0 }, cssProps: { "float": le.support.cssFloat ? "cssFloat" : "styleFloat" }, style: function(e, n, i, o) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var r, s, a, l = le.camelCase(n),
                    c = e.style;
                if (n = le.cssProps[l] || (le.cssProps[l] = x(c, l)), a = le.cssHooks[n] || le.cssHooks[l], i === t) return a && "get" in a && (r = a.get(e, !1, o)) !== t ? r : c[n];
                if (s = typeof i, "string" === s && (r = bt.exec(i)) && (i = (r[1] + 1) * r[2] + parseFloat(le.css(e, n)), s = "number"), !(null == i || "number" === s && isNaN(i) || ("number" !== s || le.cssNumber[l] || (i += "px"), le.support.clearCloneStyle || "" !== i || 0 !== n.indexOf("background") || (c[n] = "inherit"), a && "set" in a && (i = a.set(e, i, o)) === t))) try { c[n] = i } catch (u) {} } }, css: function(e, n, i, o) {
            var r, s, a, l = le.camelCase(n);
            return n = le.cssProps[l] || (le.cssProps[l] = x(e.style, l)), a = le.cssHooks[n] || le.cssHooks[l], a && "get" in a && (s = a.get(e, !0, i)), s === t && (s = dt(e, n, o)), "normal" === s && n in Ct && (s = Ct[n]), "" === i || i ? (r = parseFloat(s), i === !0 || le.isNumeric(r) ? r || 0 : s) : s }, swap: function(e, t, n, i) {
            var o, r, s = {};
            for (r in t) s[r] = e.style[r], e.style[r] = t[r];
            o = n.apply(e, i || []);
            for (r in t) e.style[r] = s[r];
            return o } }), e.getComputedStyle ? (ut = function(t) {
        return e.getComputedStyle(t, null) }, dt = function(e, n, i) {
        var o, r, s, a = i || ut(e),
            l = a ? a.getPropertyValue(n) || a[n] : t,
            c = e.style;
        return a && ("" !== l || le.contains(e.ownerDocument, e) || (l = le.style(e, n)), yt.test(l) && gt.test(n) && (o = c.width, r = c.minWidth, s = c.maxWidth, c.minWidth = c.maxWidth = c.width = l, l = a.width, c.width = o, c.minWidth = r, c.maxWidth = s)), l }) : Q.documentElement.currentStyle && (ut = function(e) {
        return e.currentStyle }, dt = function(e, n, i) {
        var o, r, s, a = i || ut(e),
            l = a ? a[n] : t,
            c = e.style;
        return null == l && c && c[n] && (l = c[n]), yt.test(l) && !ft.test(n) && (o = c.left, r = e.runtimeStyle, s = r && r.left, s && (r.left = e.currentStyle.left), c.left = "fontSize" === n ? "1em" : l, l = c.pixelLeft + "px", c.left = o, s && (r.left = s)), "" === l ? "auto" : l }), le.each(["height", "width"], function(e, t) { le.cssHooks[t] = { get: function(e, n, i) {
                return n ? 0 === e.offsetWidth && mt.test(le.css(e, "display")) ? le.swap(e, xt, function() {
                    return $(e, t, i) }) : $(e, t, i) : void 0 }, set: function(e, n, i) {
                var o = i && ut(e);
                return T(e, n, i ? E(e, t, i, le.support.boxSizing && "border-box" === le.css(e, "boxSizing", !1, o), o) : 0) } } }), le.support.opacity || (le.cssHooks.opacity = { get: function(e, t) {
            return ht.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : "" }, set: function(e, t) {
            var n = e.style,
                i = e.currentStyle,
                o = le.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : "",
                r = i && i.filter || n.filter || "";
            n.zoom = 1, (t >= 1 || "" === t) && "" === le.trim(r.replace(pt, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === t || i && !i.filter) || (n.filter = pt.test(r) ? r.replace(pt, o) : r + " " + o) } }), le(function() { le.support.reliableMarginRight || (le.cssHooks.marginRight = { get: function(e, t) {
                return t ? le.swap(e, { display: "inline-block" }, dt, [e, "marginRight"]) : void 0 } }), !le.support.pixelPosition && le.fn.position && le.each(["top", "left"], function(e, t) { le.cssHooks[t] = { get: function(e, n) {
                    return n ? (n = dt(e, t), yt.test(n) ? le(e).position()[t] + "px" : n) : void 0 } } }) }), le.expr && le.expr.filters && (le.expr.filters.hidden = function(e) {
        return e.offsetWidth <= 0 && e.offsetHeight <= 0 || !le.support.reliableHiddenOffsets && "none" === (e.style && e.style.display || le.css(e, "display")) }, le.expr.filters.visible = function(e) {
        return !le.expr.filters.hidden(e) }), le.each({ margin: "", padding: "", border: "Width" }, function(e, t) { le.cssHooks[e + t] = { expand: function(n) {
                for (var i = 0, o = {}, r = "string" == typeof n ? n.split(" ") : [n]; 4 > i; i++) o[e + kt[i] + t] = r[i] || r[i - 2] || r[0];
                return o } }, gt.test(e) || (le.cssHooks[e + t].set = T) });
    var Et = /%20/g,
        $t = /\[\]$/,
        Nt = /\r?\n/g,
        _t = /^(?:submit|button|image|reset|file)$/i,
        St = /^(?:input|select|textarea|keygen)/i;
    le.fn.extend({ serialize: function() {
            return le.param(this.serializeArray()) }, serializeArray: function() {
            return this.map(function() {
                var e = le.prop(this, "elements");
                return e ? le.makeArray(e) : this }).filter(function() {
                var e = this.type;
                return this.name && !le(this).is(":disabled") && St.test(this.nodeName) && !_t.test(e) && (this.checked || !tt.test(e)) }).map(function(e, t) {
                var n = le(this).val();
                return null == n ? null : le.isArray(n) ? le.map(n, function(e) {
                    return { name: t.name, value: e.replace(Nt, "\r\n") } }) : { name: t.name, value: n.replace(Nt, "\r\n") } }).get() } }), le.param = function(e, n) {
        var i, o = [],
            r = function(e, t) { t = le.isFunction(t) ? t() : null == t ? "" : t, o[o.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t) };
        if (n === t && (n = le.ajaxSettings && le.ajaxSettings.traditional), le.isArray(e) || e.jquery && !le.isPlainObject(e)) le.each(e, function() { r(this.name, this.value) });
        else
            for (i in e) S(i, e[i], n, r);
        return o.join("&").replace(Et, "+") }, le.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(e, t) { le.fn[t] = function(e, n) {
            return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t) } }), le.fn.hover = function(e, t) {
        return this.mouseenter(e).mouseleave(t || e) };
    var Dt, At, Mt = le.now(),
        Lt = /\?/,
        Pt = /#.*$/,
        Ft = /([?&])_=[^&]*/,
        Ot = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        It = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        Ht = /^(?:GET|HEAD)$/,
        jt = /^\/\//,
        zt = /^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
        Wt = le.fn.load,
        Rt = {},
        Bt = {},
        qt = "*/".concat("*");
    try { At = K.href } catch (Ut) { At = Q.createElement("a"), At.href = "", At = At.href }
    Dt = zt.exec(At.toLowerCase()) || [], le.fn.load = function(e, n, i) {
        if ("string" != typeof e && Wt) return Wt.apply(this, arguments);
        var o, r, s, a = this,
            l = e.indexOf(" ");
        return l >= 0 && (o = e.slice(l, e.length), e = e.slice(0, l)), le.isFunction(n) ? (i = n, n = t) : n && "object" == typeof n && (s = "POST"), a.length > 0 && le.ajax({ url: e, type: s, dataType: "html", data: n }).done(function(e) { r = arguments, a.html(o ? le("<div>").append(le.parseHTML(e)).find(o) : e) }).complete(i && function(e, t) { a.each(i, r || [e.responseText, t, e]) }), this }, le.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) { le.fn[t] = function(e) {
            return this.on(t, e) } }), le.each(["get", "post"], function(e, n) { le[n] = function(e, i, o, r) {
            return le.isFunction(i) && (r = r || o, o = i, i = t), le.ajax({ url: e, type: n, dataType: r, data: i, success: o }) } }), le.extend({ active: 0, lastModified: {}, etag: {}, ajaxSettings: { url: At, type: "GET", isLocal: It.test(Dt[1]), global: !0, processData: !0, async: !0, contentType: "application/x-www-form-urlencoded; charset=UTF-8", accepts: { "*": qt, text: "text/plain", html: "text/html", xml: "application/xml, text/xml", json: "application/json, text/javascript" }, contents: { xml: /xml/, html: /html/, json: /json/ }, responseFields: { xml: "responseXML", text: "responseText" }, converters: { "* text": e.String, "text html": !0, "text json": le.parseJSON, "text xml": le.parseXML }, flatOptions: { url: !0, context: !0 } }, ajaxSetup: function(e, t) {
            return t ? M(M(e, le.ajaxSettings), t) : M(le.ajaxSettings, e) }, ajaxPrefilter: D(Rt), ajaxTransport: D(Bt), ajax: function(e, n) {
            function i(e, n, i, o) {
                var r, d, y, b, x, k = n;
                2 !== w && (w = 2, l && clearTimeout(l), u = t, a = o || "", C.readyState = e > 0 ? 4 : 0, i && (b = L(p, C, i)), e >= 200 && 300 > e || 304 === e ? (p.ifModified && (x = C.getResponseHeader("Last-Modified"), x && (le.lastModified[s] = x), x = C.getResponseHeader("etag"), x && (le.etag[s] = x)), 204 === e ? (r = !0, k = "nocontent") : 304 === e ? (r = !0, k = "notmodified") : (r = P(p, b), k = r.state, d = r.data, y = r.error, r = !y)) : (y = k, (e || !k) && (k = "error", 0 > e && (e = 0))), C.status = e, C.statusText = (n || k) + "", r ? m.resolveWith(h, [d, k, C]) : m.rejectWith(h, [C, k, y]), C.statusCode(v), v = t, c && f.trigger(r ? "ajaxSuccess" : "ajaxError", [C, p, r ? d : y]), g.fireWith(h, [C, k]), c && (f.trigger("ajaxComplete", [C, p]), --le.active || le.event.trigger("ajaxStop"))) } "object" == typeof e && (n = e, e = t), n = n || {};
            var o, r, s, a, l, c, u, d, p = le.ajaxSetup({}, n),
                h = p.context || p,
                f = p.context && (h.nodeType || h.jquery) ? le(h) : le.event,
                m = le.Deferred(),
                g = le.Callbacks("once memory"),
                v = p.statusCode || {},
                y = {},
                b = {},
                w = 0,
                x = "canceled",
                C = { readyState: 0, getResponseHeader: function(e) {
                        var t;
                        if (2 === w) {
                            if (!d)
                                for (d = {}; t = Ot.exec(a);) d[t[1].toLowerCase()] = t[2];
                            t = d[e.toLowerCase()] }
                        return null == t ? null : t }, getAllResponseHeaders: function() {
                        return 2 === w ? a : null }, setRequestHeader: function(e, t) {
                        var n = e.toLowerCase();
                        return w || (e = b[n] = b[n] || e, y[e] = t), this }, overrideMimeType: function(e) {
                        return w || (p.mimeType = e), this }, statusCode: function(e) {
                        var t;
                        if (e)
                            if (2 > w)
                                for (t in e) v[t] = [v[t], e[t]];
                            else C.always(e[C.status]);
                        return this }, abort: function(e) {
                        var t = e || x;
                        return u && u.abort(t), i(0, t), this } };
            if (m.promise(C).complete = g.add, C.success = C.done, C.error = C.fail, p.url = ((e || p.url || At) + "").replace(Pt, "").replace(jt, Dt[1] + "//"), p.type = n.method || n.type || p.method || p.type, p.dataTypes = le.trim(p.dataType || "*").toLowerCase().match(ue) || [""], null == p.crossDomain && (o = zt.exec(p.url.toLowerCase()), p.crossDomain = !(!o || o[1] === Dt[1] && o[2] === Dt[2] && (o[3] || ("http:" === o[1] ? 80 : 443)) == (Dt[3] || ("http:" === Dt[1] ? 80 : 443)))), p.data && p.processData && "string" != typeof p.data && (p.data = le.param(p.data, p.traditional)), A(Rt, p, n, C), 2 === w) return C;
            c = p.global, c && 0 === le.active++ && le.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !Ht.test(p.type), s = p.url, p.hasContent || (p.data && (s = p.url += (Lt.test(s) ? "&" : "?") + p.data, delete p.data), p.cache === !1 && (p.url = Ft.test(s) ? s.replace(Ft, "$1_=" + Mt++) : s + (Lt.test(s) ? "&" : "?") + "_=" + Mt++)), p.ifModified && (le.lastModified[s] && C.setRequestHeader("If-Modified-Since", le.lastModified[s]), le.etag[s] && C.setRequestHeader("If-None-Match", le.etag[s])), (p.data && p.hasContent && p.contentType !== !1 || n.contentType) && C.setRequestHeader("Content-Type", p.contentType), C.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + qt + "; q=0.01" : "") : p.accepts["*"]);
            for (r in p.headers) C.setRequestHeader(r, p.headers[r]);
            if (p.beforeSend && (p.beforeSend.call(h, C, p) === !1 || 2 === w)) return C.abort();
            x = "abort";
            for (r in { success: 1, error: 1, complete: 1 }) C[r](p[r]);
            if (u = A(Bt, p, n, C)) { C.readyState = 1, c && f.trigger("ajaxSend", [C, p]), p.async && p.timeout > 0 && (l = setTimeout(function() { C.abort("timeout") }, p.timeout));
                try { w = 1, u.send(y, i) } catch (k) {
                    if (!(2 > w)) throw k;
                    i(-1, k) } } else i(-1, "No Transport");
            return C }, getScript: function(e, n) {
            return le.get(e, t, n, "script") }, getJSON: function(e, t, n) {
            return le.get(e, t, n, "json") } }), le.ajaxSetup({ accepts: { script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript" }, contents: { script: /(?:java|ecma)script/ }, converters: { "text script": function(e) {
                return le.globalEval(e), e } } }), le.ajaxPrefilter("script", function(e) { e.cache === t && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1) }), le.ajaxTransport("script", function(e) {
        if (e.crossDomain) {
            var n, i = Q.head || le("head")[0] || Q.documentElement;
            return { send: function(t, o) { n = Q.createElement("script"), n.async = !0, e.scriptCharset && (n.charset = e.scriptCharset), n.src = e.url, n.onload = n.onreadystatechange = function(e, t) {
                        (t || !n.readyState || /loaded|complete/.test(n.readyState)) && (n.onload = n.onreadystatechange = null, n.parentNode && n.parentNode.removeChild(n), n = null, t || o(200, "success")) }, i.insertBefore(n, i.firstChild) }, abort: function() { n && n.onload(t, !0) } } } });
    var Xt = [],
        Yt = /(=)\?(?=&|$)|\?\?/;
    le.ajaxSetup({ jsonp: "callback", jsonpCallback: function() {
            var e = Xt.pop() || le.expando + "_" + Mt++;
            return this[e] = !0, e } }), le.ajaxPrefilter("json jsonp", function(n, i, o) {
        var r, s, a, l = n.jsonp !== !1 && (Yt.test(n.url) ? "url" : "string" == typeof n.data && !(n.contentType || "").indexOf("application/x-www-form-urlencoded") && Yt.test(n.data) && "data");
        return l || "jsonp" === n.dataTypes[0] ? (r = n.jsonpCallback = le.isFunction(n.jsonpCallback) ? n.jsonpCallback() : n.jsonpCallback, l ? n[l] = n[l].replace(Yt, "$1" + r) : n.jsonp !== !1 && (n.url += (Lt.test(n.url) ? "&" : "?") + n.jsonp + "=" + r), n.converters["script json"] = function() {
            return a || le.error(r + " was not called"), a[0] }, n.dataTypes[0] = "json", s = e[r], e[r] = function() { a = arguments }, o.always(function() { e[r] = s, n[r] && (n.jsonpCallback = i.jsonpCallback, Xt.push(r)), a && le.isFunction(s) && s(a[0]), a = s = t }), "script") : void 0 });
    var Qt, Kt, Gt = 0,
        Vt = e.ActiveXObject && function() {
            var e;
            for (e in Qt) Qt[e](t, !0) };
    le.ajaxSettings.xhr = e.ActiveXObject ? function() {
        return !this.isLocal && F() || O() } : F, Kt = le.ajaxSettings.xhr(), le.support.cors = !!Kt && "withCredentials" in Kt, Kt = le.support.ajax = !!Kt, Kt && le.ajaxTransport(function(n) {
        if (!n.crossDomain || le.support.cors) {
            var i;
            return { send: function(o, r) {
                    var s, a, l = n.xhr();
                    if (n.username ? l.open(n.type, n.url, n.async, n.username, n.password) : l.open(n.type, n.url, n.async), n.xhrFields)
                        for (a in n.xhrFields) l[a] = n.xhrFields[a];
                    n.mimeType && l.overrideMimeType && l.overrideMimeType(n.mimeType), n.crossDomain || o["X-Requested-With"] || (o["X-Requested-With"] = "XMLHttpRequest");
                    try {
                        for (a in o) l.setRequestHeader(a, o[a]) } catch (c) {}
                    l.send(n.hasContent && n.data || null), i = function(e, o) {
                        var a, c, u, d;
                        try {
                            if (i && (o || 4 === l.readyState))
                                if (i = t, s && (l.onreadystatechange = le.noop, Vt && delete Qt[s]), o) 4 !== l.readyState && l.abort();
                                else { d = {}, a = l.status, c = l.getAllResponseHeaders(), "string" == typeof l.responseText && (d.text = l.responseText);
                                    try { u = l.statusText } catch (p) { u = "" }
                                    a || !n.isLocal || n.crossDomain ? 1223 === a && (a = 204) : a = d.text ? 200 : 404 } } catch (h) { o || r(-1, h) }
                        d && r(a, u, d, c) }, n.async ? 4 === l.readyState ? setTimeout(i) : (s = ++Gt, Vt && (Qt || (Qt = {}, le(e).unload(Vt)), Qt[s] = i), l.onreadystatechange = i) : i() }, abort: function() { i && i(t, !0) } } } });
    var Jt, Zt, en = /^(?:toggle|show|hide)$/,
        tn = new RegExp("^(?:([+-])=|)(" + ce + ")([a-z%]*)$", "i"),
        nn = /queueHooks$/,
        on = [W],
        rn = { "*": [function(e, t) {
                var n, i, o = this.createTween(e, t),
                    r = tn.exec(t),
                    s = o.cur(),
                    a = +s || 0,
                    l = 1,
                    c = 20;
                if (r) {
                    if (n = +r[2], i = r[3] || (le.cssNumber[e] ? "" : "px"), "px" !== i && a) { a = le.css(o.elem, e, !0) || n || 1;
                        do l = l || ".5", a /= l, le.style(o.elem, e, a + i); while (l !== (l = o.cur() / s) && 1 !== l && --c) }
                    o.unit = i, o.start = a, o.end = r[1] ? a + (r[1] + 1) * n : n }
                return o }] };
    le.Animation = le.extend(j, { tweener: function(e, t) { le.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
            for (var n, i = 0, o = e.length; o > i; i++) n = e[i], rn[n] = rn[n] || [], rn[n].unshift(t) }, prefilter: function(e, t) { t ? on.unshift(e) : on.push(e) } }), le.Tween = R, R.prototype = { constructor: R, init: function(e, t, n, i, o, r) { this.elem = e, this.prop = n, this.easing = o || "swing", this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = r || (le.cssNumber[n] ? "" : "px") }, cur: function() {
            var e = R.propHooks[this.prop];
            return e && e.get ? e.get(this) : R.propHooks._default.get(this) }, run: function(e) {
            var t, n = R.propHooks[this.prop];
            return this.pos = t = this.options.duration ? le.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : R.propHooks._default.set(this), this } }, R.prototype.init.prototype = R.prototype, R.propHooks = { _default: { get: function(e) {
                var t;
                return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = le.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0) : e.elem[e.prop] }, set: function(e) { le.fx.step[e.prop] ? le.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[le.cssProps[e.prop]] || le.cssHooks[e.prop]) ? le.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now } } }, R.propHooks.scrollTop = R.propHooks.scrollLeft = { set: function(e) { e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now) } }, le.each(["toggle", "show", "hide"], function(e, t) {
        var n = le.fn[t];
        le.fn[t] = function(e, i, o) {
            return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(B(t, !0), e, i, o) } }), le.fn.extend({ fadeTo: function(e, t, n, i) {
            return this.filter(C).css("opacity", 0).show().end().animate({ opacity: t }, e, n, i) }, animate: function(e, t, n, i) {
            var o = le.isEmptyObject(e),
                r = le.speed(t, n, i),
                s = function() {
                    var t = j(this, le.extend({}, e), r);
                    s.finish = function() { t.stop(!0) }, (o || le._data(this, "finish")) && t.stop(!0) };
            return s.finish = s, o || r.queue === !1 ? this.each(s) : this.queue(r.queue, s) }, stop: function(e, n, i) {
            var o = function(e) {
                var t = e.stop;
                delete e.stop, t(i) };
            return "string" != typeof e && (i = n, n = e, e = t), n && e !== !1 && this.queue(e || "fx", []), this.each(function() {
                var t = !0,
                    n = null != e && e + "queueHooks",
                    r = le.timers,
                    s = le._data(this);
                if (n) s[n] && s[n].stop && o(s[n]);
                else
                    for (n in s) s[n] && s[n].stop && nn.test(n) && o(s[n]);
                for (n = r.length; n--;) r[n].elem !== this || null != e && r[n].queue !== e || (r[n].anim.stop(i), t = !1, r.splice(n, 1));
                (t || !i) && le.dequeue(this, e) }) }, finish: function(e) {
            return e !== !1 && (e = e || "fx"), this.each(function() {
                var t, n = le._data(this),
                    i = n[e + "queue"],
                    o = n[e + "queueHooks"],
                    r = le.timers,
                    s = i ? i.length : 0;
                for (n.finish = !0, le.queue(this, e, []), o && o.cur && o.cur.finish && o.cur.finish.call(this), t = r.length; t--;) r[t].elem === this && r[t].queue === e && (r[t].anim.stop(!0), r.splice(t, 1));
                for (t = 0; s > t; t++) i[t] && i[t].finish && i[t].finish.call(this);
                delete n.finish }) } }), le.each({ slideDown: B("show"), slideUp: B("hide"), slideToggle: B("toggle"), fadeIn: { opacity: "show" }, fadeOut: { opacity: "hide" }, fadeToggle: { opacity: "toggle" } }, function(e, t) { le.fn[e] = function(e, n, i) {
            return this.animate(t, e, n, i) } }), le.speed = function(e, t, n) {
        var i = e && "object" == typeof e ? le.extend({}, e) : { complete: n || !n && t || le.isFunction(e) && e, duration: e, easing: n && t || t && !le.isFunction(t) && t };
        return i.duration = le.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in le.fx.speeds ? le.fx.speeds[i.duration] : le.fx.speeds._default, (null == i.queue || i.queue === !0) && (i.queue = "fx"), i.old = i.complete, i.complete = function() { le.isFunction(i.old) && i.old.call(this), i.queue && le.dequeue(this, i.queue) }, i }, le.easing = { linear: function(e) {
            return e }, swing: function(e) {
            return .5 - Math.cos(e * Math.PI) / 2 } }, le.timers = [], le.fx = R.prototype.init, le.fx.tick = function() {
        var e, n = le.timers,
            i = 0;
        for (Jt = le.now(); i < n.length; i++) e = n[i], e() || n[i] !== e || n.splice(i--, 1);
        n.length || le.fx.stop(), Jt = t }, le.fx.timer = function(e) { e() && le.timers.push(e) && le.fx.start() }, le.fx.interval = 13, le.fx.start = function() { Zt || (Zt = setInterval(le.fx.tick, le.fx.interval)) }, le.fx.stop = function() { clearInterval(Zt), Zt = null }, le.fx.speeds = { slow: 600, fast: 200, _default: 400 }, le.fx.step = {}, le.expr && le.expr.filters && (le.expr.filters.animated = function(e) {
        return le.grep(le.timers, function(t) {
            return e === t.elem }).length }), le.fn.offset = function(e) {
        if (arguments.length) return e === t ? this : this.each(function(t) { le.offset.setOffset(this, e, t) });
        var n, i, o = { top: 0, left: 0 },
            r = this[0],
            s = r && r.ownerDocument;
        if (s) return n = s.documentElement, le.contains(n, r) ? (typeof r.getBoundingClientRect !== Y && (o = r.getBoundingClientRect()), i = q(s), { top: o.top + (i.pageYOffset || n.scrollTop) - (n.clientTop || 0), left: o.left + (i.pageXOffset || n.scrollLeft) - (n.clientLeft || 0) }) : o }, le.offset = { setOffset: function(e, t, n) {
            var i = le.css(e, "position"); "static" === i && (e.style.position = "relative");
            var o, r, s = le(e),
                a = s.offset(),
                l = le.css(e, "top"),
                c = le.css(e, "left"),
                u = ("absolute" === i || "fixed" === i) && le.inArray("auto", [l, c]) > -1,
                d = {},
                p = {};
            u ? (p = s.position(), o = p.top, r = p.left) : (o = parseFloat(l) || 0, r = parseFloat(c) || 0), le.isFunction(t) && (t = t.call(e, n, a)), null != t.top && (d.top = t.top - a.top + o), null != t.left && (d.left = t.left - a.left + r), "using" in t ? t.using.call(e, d) : s.css(d) } }, le.fn.extend({ position: function() {
            if (this[0]) {
                var e, t, n = { top: 0, left: 0 },
                    i = this[0];
                return "fixed" === le.css(i, "position") ? t = i.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), le.nodeName(e[0], "html") || (n = e.offset()), n.top += le.css(e[0], "borderTopWidth", !0), n.left += le.css(e[0], "borderLeftWidth", !0)), { top: t.top - n.top - le.css(i, "marginTop", !0), left: t.left - n.left - le.css(i, "marginLeft", !0) } } }, offsetParent: function() {
            return this.map(function() {
                for (var e = this.offsetParent || Q.documentElement; e && !le.nodeName(e, "html") && "static" === le.css(e, "position");) e = e.offsetParent;
                return e || Q.documentElement }) } }), le.each({ scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function(e, n) {
        var i = /Y/.test(n);
        le.fn[e] = function(o) {
            return le.access(this, function(e, o, r) {
                var s = q(e);
                return r === t ? s ? n in s ? s[n] : s.document.documentElement[o] : e[o] : void(s ? s.scrollTo(i ? le(s).scrollLeft() : r, i ? r : le(s).scrollTop()) : e[o] = r) }, e, o, arguments.length, null) } }), le.each({ Height: "height", Width: "width" }, function(e, n) { le.each({ padding: "inner" + e, content: n, "": "outer" + e }, function(i, o) { le.fn[o] = function(o, r) {
                var s = arguments.length && (i || "boolean" != typeof o),
                    a = i || (o === !0 || r === !0 ? "margin" : "border");
                return le.access(this, function(n, i, o) {
                    var r;
                    return le.isWindow(n) ? n.document.documentElement["client" + e] : 9 === n.nodeType ? (r = n.documentElement, Math.max(n.body["scroll" + e], r["scroll" + e], n.body["offset" + e], r["offset" + e], r["client" + e])) : o === t ? le.css(n, i, a) : le.style(n, i, o, a) }, n, s ? o : t, s, null) } }) }), e.jQuery = e.$ = le, "function" == typeof define && define.amd && define.amd.jQuery && define("jquery", [], function() {
        return le })
}(window), ! function(e) { "use strict";
    e(function() { e.support.transition = function() {
            var e = function() {
                var e, t = document.createElement("bootstrap"),
                    n = { WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "oTransitionEnd otransitionend", transition: "transitionend" };
                for (e in n)
                    if (void 0 !== t.style[e]) return n[e] }();
            return e && { end: e } }() }) }(window.jQuery), ! function(e) { "use strict";
    var t = function(t, n) { this.options = e.extend({}, e.fn.affix.defaults, n), this.$window = e(window).on("scroll.affix.data-api", e.proxy(this.checkPosition, this)).on("click.affix.data-api", e.proxy(function() { setTimeout(e.proxy(this.checkPosition, this), 1) }, this)), this.$element = e(t), this.checkPosition() };
    t.prototype.checkPosition = function() {
        if (this.$element.is(":visible")) {
            var t, n = e(document).height(),
                i = this.$window.scrollTop(),
                o = this.$element.offset(),
                r = this.options.offset,
                s = r.bottom,
                a = r.top,
                l = "affix affix-top affix-bottom"; "object" != typeof r && (s = a = r), "function" == typeof a && (a = r.top()), "function" == typeof s && (s = r.bottom()), t = null != this.unpin && i + this.unpin <= o.top ? !1 : null != s && o.top + this.$element.height() >= n - s ? "bottom" : null != a && a >= i ? "top" : !1, this.affixed !== t && (this.affixed = t, this.unpin = "bottom" == t ? o.top - i : null, this.$element.removeClass(l).addClass("affix" + (t ? "-" + t : ""))) } };
    var n = e.fn.affix;
    e.fn.affix = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("affix"),
                r = "object" == typeof n && n;
            o || i.data("affix", o = new t(this, r)), "string" == typeof n && o[n]() }) }, e.fn.affix.Constructor = t, e.fn.affix.defaults = { offset: 0 }, e.fn.affix.noConflict = function() {
        return e.fn.affix = n, this }, e(window).on("load", function() { e('[data-spy="affix"]').each(function() {
            var t = e(this),
                n = t.data();
            n.offset = n.offset || {}, n.offsetBottom && (n.offset.bottom = n.offsetBottom), n.offsetTop && (n.offset.top = n.offsetTop), t.affix(n) }) }) }(window.jQuery), ! function(e) {
    "use strict";

    function t() { e(i).each(function() { n(e(this)).removeClass("open") }) }

    function n(t) {
        var n, i = t.attr("data-target");
        return i || (i = t.attr("href"), i = i && /#/.test(i) && i.replace(/.*(?=#[^\s]*$)/, "")), n = i && e(i), n && n.length || (n = t.parent()), n }
    var i = "[data-toggle=dropdown]",
        o = function(t) {
            var n = e(t).on("click.dropdown.data-api", this.toggle);
            e("html").on("click.dropdown.data-api", function() { n.parent().removeClass("open") }) };
    o.prototype = {
        constructor: o,
        toggle: function(i) {
            var o, r, s = e(this);
            if (!s.is(".disabled, :disabled")) return o = n(s), r = o.hasClass("open"), t(), r || o.toggleClass("open"), s.focus(), !1 },
        keydown: function(t) {
            var o, r, s, a, l;
            if (/(38|40|27)/.test(t.keyCode) && (o = e(this), t.preventDefault(), t.stopPropagation(), !o.is(".disabled, :disabled"))) {
                if (s = n(o), a = s.hasClass("open"), !a || a && 27 == t.keyCode) return 27 == t.which && s.find(i).focus(), o.click();
                r = e("[role=menu] li:not(.divider):visible a", s), r.length && (l = r.index(r.filter(":focus")),
                    38 == t.keyCode && l > 0 && l--, 40 == t.keyCode && l < r.length - 1 && l++, ~l || (l = 0), r.eq(l).focus())
            }
        }
    };
    var r = e.fn.dropdown;
    e.fn.dropdown = function(t) {
        return this.each(function() {
            var n = e(this),
                i = n.data("dropdown");
            i || n.data("dropdown", i = new o(this)), "string" == typeof t && i[t].call(n) }) }, e.fn.dropdown.Constructor = o, e.fn.dropdown.noConflict = function() {
        return e.fn.dropdown = r, this }, e(document).on("click.dropdown.data-api", t).on("click.dropdown.data-api", ".dropdown form", function(e) { e.stopPropagation() }).on("click.dropdown-menu", function(e) { e.stopPropagation() }).on("click.dropdown.data-api", i, o.prototype.toggle).on("keydown.dropdown.data-api", i + ", [role=menu]", o.prototype.keydown)
}(window.jQuery), ! function(e) { "use strict";
    var t = '[data-dismiss="alert"]',
        n = function(n) { e(n).on("click", t, this.close) };
    n.prototype.close = function(t) {
        function n() { i.trigger("closed").remove() }
        var i, o = e(this),
            r = o.attr("data-target");
        r || (r = o.attr("href"), r = r && r.replace(/.*(?=#[^\s]*$)/, "")), i = e(r), t && t.preventDefault(), i.length || (i = o.hasClass("alert") ? o : o.parent()), i.trigger(t = e.Event("close")), t.isDefaultPrevented() || (i.removeClass("in"), e.support.transition && i.hasClass("fade") ? i.on(e.support.transition.end, n) : n()) };
    var i = e.fn.alert;
    e.fn.alert = function(t) {
        return this.each(function() {
            var i = e(this),
                o = i.data("alert");
            o || i.data("alert", o = new n(this)), "string" == typeof t && o[t].call(i) }) }, e.fn.alert.Constructor = n, e.fn.alert.noConflict = function() {
        return e.fn.alert = i, this }, e(document).on("click.alert.data-api", t, n.prototype.close) }(window.jQuery), ! function(e) { "use strict";
    var t = function(t, n) { this.$element = e(t), this.options = e.extend({}, e.fn.button.defaults, n) };
    t.prototype.setState = function(e) {
        var t = "disabled",
            n = this.$element,
            i = n.data(),
            o = n.is("input") ? "val" : "html";
        e += "Text", i.resetText || n.data("resetText", n[o]()), n[o](i[e] || this.options[e]), setTimeout(function() { "loadingText" == e ? n.addClass(t).attr(t, t) : n.removeClass(t).removeAttr(t) }, 0) }, t.prototype.toggle = function() {
        var e = this.$element.closest('[data-toggle="buttons-radio"]');
        e && e.find(".active").removeClass("active"), this.$element.toggleClass("active") };
    var n = e.fn.button;
    e.fn.button = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("button"),
                r = "object" == typeof n && n;
            o || i.data("button", o = new t(this, r)), "toggle" == n ? o.toggle() : n && o.setState(n) }) }, e.fn.button.defaults = { loadingText: "loading..." }, e.fn.button.Constructor = t, e.fn.button.noConflict = function() {
        return e.fn.button = n, this }, e(document).on("click.button.data-api", "[data-toggle^=button]", function(t) {
        var n = e(t.target);
        n.hasClass("btn") || (n = n.closest(".btn")), n.button("toggle") }) }(window.jQuery), ! function(e) { "use strict";
    var t = function(t, n) { this.$element = e(t), this.options = e.extend({}, e.fn.collapse.defaults, n), this.options.parent && (this.$parent = e(this.options.parent)), this.options.toggle && this.toggle() };
    t.prototype = { constructor: t, dimension: function() {
            var e = this.$element.hasClass("width");
            return e ? "width" : "height" }, show: function() {
            var t, n, i, o;
            if (!this.transitioning && !this.$element.hasClass("in")) {
                if (t = this.dimension(), n = e.camelCase(["scroll", t].join("-")), i = this.$parent && this.$parent.find("> .accordion-group > .in"), i && i.length) {
                    if (o = i.data("collapse"), o && o.transitioning) return;
                    i.collapse("hide"), o || i.data("collapse", null) }
                this.$element[t](0), this.transition("addClass", e.Event("show"), "shown"), e.support.transition && this.$element[t](this.$element[0][n]) } }, hide: function() {
            var t;!this.transitioning && this.$element.hasClass("in") && (t = this.dimension(), this.reset(this.$element[t]()), this.transition("removeClass", e.Event("hide"), "hidden"), this.$element[t](0)) }, reset: function(e) {
            var t = this.dimension();
            return this.$element.removeClass("collapse")[t](e || "auto")[0].offsetWidth, this.$element[null !== e ? "addClass" : "removeClass"]("collapse"), this }, transition: function(t, n, i) {
            var o = this,
                r = function() { "show" == n.type && o.reset(), o.transitioning = 0, o.$element.trigger(i) };
            this.$element.trigger(n), n.isDefaultPrevented() || (this.transitioning = 1, this.$element[t]("in"), e.support.transition && this.$element.hasClass("collapse") ? this.$element.one(e.support.transition.end, r) : r()) }, toggle: function() { this[this.$element.hasClass("in") ? "hide" : "show"]() } };
    var n = e.fn.collapse;
    e.fn.collapse = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("collapse"),
                r = e.extend({}, e.fn.collapse.defaults, i.data(), "object" == typeof n && n);
            o || i.data("collapse", o = new t(this, r)), "string" == typeof n && o[n]() }) }, e.fn.collapse.defaults = { toggle: !0 }, e.fn.collapse.Constructor = t, e.fn.collapse.noConflict = function() {
        return e.fn.collapse = n, this }, e(document).on("click.collapse.data-api", "[data-toggle=collapse]", function(t) {
        var n, i = e(this),
            o = i.attr("data-target") || t.preventDefault() || (n = i.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, ""),
            r = e(o).data("collapse") ? "toggle" : i.data();
        i[e(o).hasClass("in") ? "addClass" : "removeClass"]("collapsed"), e(o).collapse(r) }) }(window.jQuery), ! function(e) { "use strict";
    var t = function(t, n) { this.options = n, this.$element = e(t).delegate('[data-dismiss="modal"]', "click.dismiss.modal", e.proxy(this.hide, this)), this.options.remote && this.$element.find(".modal-body").load(this.options.remote) };
    t.prototype = { constructor: t, toggle: function() {
            return this[this.isShown ? "hide" : "show"]() }, show: function() {
            var t = this,
                n = e.Event("show");
            this.$element.trigger(n), this.isShown || n.isDefaultPrevented() || (this.isShown = !0, this.escape(), this.backdrop(function() {
                var n = e.support.transition && t.$element.hasClass("fade");
                t.$element.parent().length || t.$element.appendTo(document.body), t.$element.show(), n && t.$element[0].offsetWidth, t.$element.addClass("in").attr("aria-hidden", !1), t.enforceFocus(), n ? t.$element.one(e.support.transition.end, function() { t.$element.focus().trigger("shown") }) : t.$element.focus().trigger("shown") })) }, hide: function(t) { t && t.preventDefault();
            t = e.Event("hide"), this.$element.trigger(t), this.isShown && !t.isDefaultPrevented() && (this.isShown = !1, this.escape(), e(document).off("focusin.modal"), this.$element.removeClass("in").attr("aria-hidden", !0), e.support.transition && this.$element.hasClass("fade") ? this.hideWithTransition() : this.hideModal()) }, enforceFocus: function() {
            var t = this;
            e(document).on("focusin.modal", function(e) { t.$element[0] === e.target || t.$element.has(e.target).length || t.$element.focus() }) }, escape: function() {
            var e = this;
            this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.modal", function(t) { 27 == t.which && e.hide() }) : this.isShown || this.$element.off("keyup.dismiss.modal") }, hideWithTransition: function() {
            var t = this,
                n = setTimeout(function() { t.$element.off(e.support.transition.end), t.hideModal() }, 500);
            this.$element.one(e.support.transition.end, function() { clearTimeout(n), t.hideModal() }) }, hideModal: function() {
            var e = this;
            this.$element.hide(), this.backdrop(function() { e.removeBackdrop(), e.$element.trigger("hidden") }) }, removeBackdrop: function() { this.$backdrop && this.$backdrop.remove(), this.$backdrop = null }, backdrop: function(t) {
            var n = this.$element.hasClass("fade") ? "fade" : "";
            if (this.isShown && this.options.backdrop) {
                var i = e.support.transition && n;
                if (this.$backdrop = e('<div class="modal-backdrop ' + n + '" />').appendTo(document.body), this.$backdrop.click("static" == this.options.backdrop ? e.proxy(this.$element[0].focus, this.$element[0]) : e.proxy(this.hide, this)), i && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !t) return;
                i ? this.$backdrop.one(e.support.transition.end, t) : t() } else !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"), e.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(e.support.transition.end, t) : t()) : t && t() } };
    var n = e.fn.modal;
    e.fn.modal = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("modal"),
                r = e.extend({}, e.fn.modal.defaults, i.data(), "object" == typeof n && n);
            o || i.data("modal", o = new t(this, r)), "string" == typeof n ? o[n]() : r.show && o.show() }) }, e.fn.modal.defaults = { backdrop: !0, keyboard: !0, show: !0 }, e.fn.modal.Constructor = t, e.fn.modal.noConflict = function() {
        return e.fn.modal = n, this }, e(document).on("click.modal.data-api", '[data-toggle="modal"]', function(t) {
        var n = e(this),
            i = n.attr("href"),
            o = e(n.attr("data-target") || i && i.replace(/.*(?=#[^\s]+$)/, "")),
            r = o.data("modal") ? "toggle" : e.extend({ remote: !/#/.test(i) && i }, o.data(), n.data());
        t.preventDefault(), o.modal(r).one("hide", function() { n.focus() }) }) }(window.jQuery), ! function(e) { "use strict";
    var t = function(e, t) { this.init("tooltip", e, t) };
    t.prototype = { constructor: t, init: function(t, n, i) {
            var o, r, s, a, l;
            for (this.type = t, this.$element = e(n), this.options = this.getOptions(i), this.enabled = !0, s = this.options.trigger.split(" "), l = s.length; l--;) a = s[l], "click" == a ? this.$element.on("click." + this.type, this.options.selector, e.proxy(this.toggle, this)) : "manual" != a && (o = "hover" == a ? "mouseenter" : "focus", r = "hover" == a ? "mouseleave" : "blur", this.$element.on(o + "." + this.type, this.options.selector, e.proxy(this.enter, this)), this.$element.on(r + "." + this.type, this.options.selector, e.proxy(this.leave, this)));
            this.options.selector ? this._options = e.extend({}, this.options, { trigger: "manual", selector: "" }) : this.fixTitle() }, getOptions: function(t) {
            return t = e.extend({}, e.fn[this.type].defaults, this.$element.data(), t), t.delay && "number" == typeof t.delay && (t.delay = { show: t.delay, hide: t.delay }), t }, enter: function(t) {
            var n, i = e.fn[this.type].defaults,
                o = {};
            return this._options && e.each(this._options, function(e, t) { i[e] != t && (o[e] = t) }, this), n = e(t.currentTarget)[this.type](o).data(this.type), n.options.delay && n.options.delay.show ? (clearTimeout(this.timeout), n.hoverState = "in", void(this.timeout = setTimeout(function() { "in" == n.hoverState && n.show() }, n.options.delay.show))) : n.show() }, leave: function(t) {
            var n = e(t.currentTarget)[this.type](this._options).data(this.type);
            return this.timeout && clearTimeout(this.timeout), n.options.delay && n.options.delay.hide ? (n.hoverState = "out", void(this.timeout = setTimeout(function() { "out" == n.hoverState && n.hide() }, n.options.delay.hide))) : n.hide() }, show: function() {
            var t, n, i, o, r, s, a = e.Event("show");
            if (this.hasContent() && this.enabled) {
                if (this.$element.trigger(a), a.isDefaultPrevented()) return;
                switch (t = this.tip(), this.setContent(), this.options.animation && t.addClass("fade"), r = "function" == typeof this.options.placement ? this.options.placement.call(this, t[0], this.$element[0]) : this.options.placement, t.detach().css({ top: 0, left: 0, display: "block" }), this.options.container ? t.appendTo(this.options.container) : t.insertAfter(this.$element), n = this.getPosition(), i = t[0].offsetWidth, o = t[0].offsetHeight, r) {
                    case "bottom":
                        s = { top: n.top + n.height, left: n.left + n.width / 2 - i / 2 };
                        break;
                    case "top":
                        s = { top: n.top - o, left: n.left + n.width / 2 - i / 2 };
                        break;
                    case "left":
                        s = { top: n.top + n.height / 2 - o / 2, left: n.left - i };
                        break;
                    case "right":
                        s = { top: n.top + n.height / 2 - o / 2, left: n.left + n.width } }
                this.applyPlacement(s, r), this.$element.trigger("shown") } }, applyPlacement: function(e, t) {
            var n, i, o, r, s = this.tip(),
                a = s[0].offsetWidth,
                l = s[0].offsetHeight;
            s.offset(e).addClass(t).addClass("in"), n = s[0].offsetWidth, i = s[0].offsetHeight, "top" == t && i != l && (e.top = e.top + l - i, r = !0), "bottom" == t || "top" == t ? (o = 0, e.left < 0 && (o = -2 * e.left, e.left = 0, s.offset(e), n = s[0].offsetWidth, i = s[0].offsetHeight), this.replaceArrow(o - a + n, n, "left")) : this.replaceArrow(i - l, i, "top"), r && s.offset(e) }, replaceArrow: function(e, t, n) { this.arrow().css(n, e ? 50 * (1 - e / t) + "%" : "") }, setContent: function() {
            var e = this.tip(),
                t = this.getTitle();
            e.find(".tooltip-inner")[this.options.html ? "html" : "text"](t), e.removeClass("fade in top bottom left right") }, hide: function() {
            function t() {
                var t = setTimeout(function() { n.off(e.support.transition.end).detach() }, 500);
                n.one(e.support.transition.end, function() { clearTimeout(t), n.detach() }) }
            var n = this.tip(),
                i = e.Event("hide");
            return this.$element.trigger(i), i.isDefaultPrevented() ? void 0 : (n.removeClass("in"), e.support.transition && this.$tip.hasClass("fade") ? t() : n.detach(), this.$element.trigger("hidden"), this) }, fixTitle: function() {
            var e = this.$element;
            (e.attr("title") || "string" != typeof e.attr("data-original-title")) && e.attr("data-original-title", e.attr("title") || "").attr("title", "") }, hasContent: function() {
            return this.getTitle() }, getPosition: function() {
            var t = this.$element[0];
            return e.extend({}, "function" == typeof t.getBoundingClientRect ? t.getBoundingClientRect() : { width: t.offsetWidth, height: t.offsetHeight }, this.$element.offset()) }, getTitle: function() {
            var e, t = this.$element,
                n = this.options;
            return e = t.attr("data-original-title") || ("function" == typeof n.title ? n.title.call(t[0]) : n.title) }, tip: function() {
            return this.$tip = this.$tip || e(this.options.template) }, arrow: function() {
            return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow") }, validate: function() { this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null) }, enable: function() { this.enabled = !0 }, disable: function() { this.enabled = !1 }, toggleEnabled: function() { this.enabled = !this.enabled }, toggle: function(t) {
            var n = t ? e(t.currentTarget)[this.type](this._options).data(this.type) : this;
            n.tip().hasClass("in") ? n.hide() : n.show() }, destroy: function() { this.hide().$element.off("." + this.type).removeData(this.type) } };
    var n = e.fn.tooltip;
    e.fn.tooltip = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("tooltip"),
                r = "object" == typeof n && n;
            o || i.data("tooltip", o = new t(this, r)), "string" == typeof n && o[n]() }) }, e.fn.tooltip.Constructor = t, e.fn.tooltip.defaults = { animation: !0, placement: "top", selector: !1, template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>', trigger: "hover focus", title: "", delay: 0, html: !1, container: !1 }, e.fn.tooltip.noConflict = function() {
        return e.fn.tooltip = n, this } }(window.jQuery), ! function(e) { "use strict";
    var t = function(e, t) { this.init("popover", e, t) };
    t.prototype = e.extend({}, e.fn.tooltip.Constructor.prototype, { constructor: t, setContent: function() {
            var e = this.tip(),
                t = this.getTitle(),
                n = this.getContent();
            e.find(".popover-title")[this.options.html ? "html" : "text"](t), e.find(".popover-content")[this.options.html ? "html" : "text"](n), e.removeClass("fade top bottom left right in") }, hasContent: function() {
            return this.getTitle() || this.getContent() }, getContent: function() {
            var e, t = this.$element,
                n = this.options;
            return e = ("function" == typeof n.content ? n.content.call(t[0]) : n.content) || t.attr("data-content") }, tip: function() {
            return this.$tip || (this.$tip = e(this.options.template)), this.$tip }, destroy: function() { this.hide().$element.off("." + this.type).removeData(this.type) } });
    var n = e.fn.popover;
    e.fn.popover = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("popover"),
                r = "object" == typeof n && n;
            o || i.data("popover", o = new t(this, r)), "string" == typeof n && o[n]() }) }, e.fn.popover.Constructor = t, e.fn.popover.defaults = e.extend({}, e.fn.tooltip.defaults, { placement: "right", trigger: "click", content: "", template: '<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' }), e.fn.popover.noConflict = function() {
        return e.fn.popover = n, this } }(window.jQuery), ! function(e) { "use strict";

    function t(t, n) {
        var i, o = e.proxy(this.process, this),
            r = e(e(t).is("body") ? window : t);
        this.options = e.extend({}, e.fn.scrollspy.defaults, n), this.$scrollElement = r.on("scroll.scroll-spy.data-api", o), this.selector = (this.options.target || (i = e(t).attr("href")) && i.replace(/.*(?=#[^\s]+$)/, "") || "") + " .nav li > a", this.$body = e("body"), this.refresh(), this.process() }
    t.prototype = { constructor: t, refresh: function() {
            var t, n = this;
            this.offsets = e([]), this.targets = e([]), t = this.$body.find(this.selector).map(function() {
                var t = e(this),
                    i = t.data("target") || t.attr("href"),
                    o = /^#\w/.test(i) && e(i);
                return o && o.length && [
                    [o.position().top + (!e.isWindow(n.$scrollElement.get(0)) && n.$scrollElement.scrollTop()), i]
                ] || null }).sort(function(e, t) {
                return e[0] - t[0] }).each(function() { n.offsets.push(this[0]), n.targets.push(this[1]) }) }, process: function() {
            var e, t = this.$scrollElement.scrollTop() + this.options.offset,
                n = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight,
                i = n - this.$scrollElement.height(),
                o = this.offsets,
                r = this.targets,
                s = this.activeTarget;
            if (t >= i) return s != (e = r.last()[0]) && this.activate(e);
            for (e = o.length; e--;) s != r[e] && t >= o[e] && (!o[e + 1] || t <= o[e + 1]) && this.activate(r[e]) }, activate: function(t) {
            var n, i;
            this.activeTarget = t, e(this.selector).parent(".active").removeClass("active"), i = this.selector + '[data-target="' + t + '"],' + this.selector + '[href="' + t + '"]', n = e(i).parent("li").addClass("active"), n.parent(".dropdown-menu").length && (n = n.closest("li.dropdown").addClass("active")), n.trigger("activate") } };
    var n = e.fn.scrollspy;
    e.fn.scrollspy = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("scrollspy"),
                r = "object" == typeof n && n;
            o || i.data("scrollspy", o = new t(this, r)), "string" == typeof n && o[n]() }) }, e.fn.scrollspy.Constructor = t, e.fn.scrollspy.defaults = { offset: 10 }, e.fn.scrollspy.noConflict = function() {
        return e.fn.scrollspy = n, this }, e(window).on("load", function() { e('[data-spy="scroll"]').each(function() {
            var t = e(this);
            t.scrollspy(t.data()) }) }) }(window.jQuery), ! function(e) { "use strict";
    var t = function(t) { this.element = e(t) };
    t.prototype = { constructor: t, show: function() {
            var t, n, i, o = this.element,
                r = o.closest("ul:not(.dropdown-menu)"),
                s = o.attr("data-target");
            s || (s = o.attr("href"), s = s && s.replace(/.*(?=#[^\s]*$)/, "")), o.parent("li").hasClass("active") || (t = r.find(".active:last a")[0], i = e.Event("show", { relatedTarget: t }), o.trigger(i), i.isDefaultPrevented() || (n = e(s), this.activate(o.parent("li"), r), this.activate(n, n.parent(), function() { o.trigger({ type: "shown", relatedTarget: t }) }))) }, activate: function(t, n, i) {
            function o() { r.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"), t.addClass("active"), s ? (t[0].offsetWidth, t.addClass("in")) : t.removeClass("fade"), t.parent(".dropdown-menu") && t.closest("li.dropdown").addClass("active"), i && i() }
            var r = n.find("> .active"),
                s = i && e.support.transition && r.hasClass("fade");
            s ? r.one(e.support.transition.end, o) : o(), r.removeClass("in") } };
    var n = e.fn.tab;
    e.fn.tab = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("tab");
            o || i.data("tab", o = new t(this)), "string" == typeof n && o[n]() }) }, e.fn.tab.Constructor = t, e.fn.tab.noConflict = function() {
        return e.fn.tab = n, this }, e(document).on("click.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', function(t) { t.preventDefault(), e(this).tab("show") }) }(window.jQuery), ! function(e) { "use strict";
    var t = function(t, n) { this.$element = e(t), this.options = e.extend({}, e.fn.typeahead.defaults, n), this.matcher = this.options.matcher || this.matcher, this.sorter = this.options.sorter || this.sorter, this.highlighter = this.options.highlighter || this.highlighter, this.updater = this.options.updater || this.updater, this.source = this.options.source, this.$menu = e(this.options.menu), this.shown = !1, this.listen() };
    t.prototype = { constructor: t, select: function() {
            var e = this.$menu.find(".active").attr("data-value");
            return this.$element.val(this.updater(e)).change(), this.hide() }, updater: function(e) {
            return e }, show: function() {
            var t = e.extend({}, this.$element.position(), { height: this.$element[0].offsetHeight });
            return this.$menu.insertAfter(this.$element).css({ top: t.top + t.height, left: t.left }).show(), this.shown = !0, this }, hide: function() {
            return this.$menu.hide(), this.shown = !1, this }, lookup: function(t) {
            var n;
            return this.query = this.$element.val(), !this.query || this.query.length < this.options.minLength ? this.shown ? this.hide() : this : (n = e.isFunction(this.source) ? this.source(this.query, e.proxy(this.process, this)) : this.source, n ? this.process(n) : this) }, process: function(t) {
            var n = this;
            return t = e.grep(t, function(e) {
                return n.matcher(e) }), t = this.sorter(t), t.length ? this.render(t.slice(0, this.options.items)).show() : this.shown ? this.hide() : this }, matcher: function(e) {
            return ~e.toLowerCase().indexOf(this.query.toLowerCase()) }, sorter: function(e) {
            for (var t, n = [], i = [], o = []; t = e.shift();) t.toLowerCase().indexOf(this.query.toLowerCase()) ? ~t.indexOf(this.query) ? i.push(t) : o.push(t) : n.push(t);
            return n.concat(i, o) }, highlighter: function(e) {
            var t = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            return e.replace(new RegExp("(" + t + ")", "ig"), function(e, t) {
                return "<strong>" + t + "</strong>" }) }, render: function(t) {
            var n = this;
            return t = e(t).map(function(t, i) {
                return t = e(n.options.item).attr("data-value", i), t.find("a").html(n.highlighter(i)), t[0] }), t.first().addClass("active"), this.$menu.html(t), this }, next: function(t) {
            var n = this.$menu.find(".active").removeClass("active"),
                i = n.next();
            i.length || (i = e(this.$menu.find("li")[0])), i.addClass("active") }, prev: function(e) {
            var t = this.$menu.find(".active").removeClass("active"),
                n = t.prev();
            n.length || (n = this.$menu.find("li").last()), n.addClass("active") }, listen: function() { this.$element.on("focus", e.proxy(this.focus, this)).on("blur", e.proxy(this.blur, this)).on("keypress", e.proxy(this.keypress, this)).on("keyup", e.proxy(this.keyup, this)), this.eventSupported("keydown") && this.$element.on("keydown", e.proxy(this.keydown, this)), this.$menu.on("click", e.proxy(this.click, this)).on("mouseenter", "li", e.proxy(this.mouseenter, this)).on("mouseleave", "li", e.proxy(this.mouseleave, this)) }, eventSupported: function(e) {
            var t = e in this.$element;
            return t || (this.$element.setAttribute(e, "return;"), t = "function" == typeof this.$element[e]), t }, move: function(e) {
            if (this.shown) {
                switch (e.keyCode) {
                    case 9:
                    case 13:
                    case 27:
                        e.preventDefault();
                        break;
                    case 38:
                        e.preventDefault(), this.prev();
                        break;
                    case 40:
                        e.preventDefault(), this.next() }
                e.stopPropagation() } }, keydown: function(t) { this.suppressKeyPressRepeat = ~e.inArray(t.keyCode, [40, 38, 9, 13, 27]), this.move(t) }, keypress: function(e) { this.suppressKeyPressRepeat || this.move(e) }, keyup: function(e) {
            switch (e.keyCode) {
                case 40:
                case 38:
                case 16:
                case 17:
                case 18:
                    break;
                case 9:
                case 13:
                    if (!this.shown) return;
                    this.select();
                    break;
                case 27:
                    if (!this.shown) return;
                    this.hide();
                    break;
                default:
                    this.lookup() }
            e.stopPropagation(), e.preventDefault() }, focus: function(e) { this.focused = !0 }, blur: function(e) { this.focused = !1, !this.mousedover && this.shown && this.hide() }, click: function(e) { e.stopPropagation(), e.preventDefault(), this.select(), this.$element.focus() }, mouseenter: function(t) { this.mousedover = !0, this.$menu.find(".active").removeClass("active"), e(t.currentTarget).addClass("active") }, mouseleave: function(e) { this.mousedover = !1, !this.focused && this.shown && this.hide() } };
    var n = e.fn.typeahead;
    e.fn.typeahead = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("typeahead"),
                r = "object" == typeof n && n;
            o || i.data("typeahead", o = new t(this, r)), "string" == typeof n && o[n]() }) }, e.fn.typeahead.defaults = { source: [], items: 8, menu: '<ul class="typeahead dropdown-menu"></ul>', item: '<li><a href="#"></a></li>', minLength: 1 }, e.fn.typeahead.Constructor = t, e.fn.typeahead.noConflict = function() {
        return e.fn.typeahead = n, this }, e(document).on("focus.typeahead.data-api", '[data-provide="typeahead"]', function(t) {
        var n = e(this);
        n.data("typeahead") || n.typeahead(n.data()) }) }(window.jQuery), ! function(e) { "use strict";
    var t = function(t, n) { this.options = n, this.$element = e(t).delegate('[data-dismiss="lightbox"]', "click.dismiss.lightbox", e.proxy(this.hide, this)), this.options.remote && this.$element.find(".lightbox-body").load(this.options.remote) };
    t.prototype = e.extend({}, e.fn.modal.Constructor.prototype), t.prototype.constructor = t, t.prototype.enforceFocus = function() {
        var t = this;
        e(document).on("focusin.lightbox", function(e) { t.$element[0] === e.target || t.$element.has(e.target).length || t.$element.focus() }) }, t.prototype.show = function() {
        var t = this,
            n = e.Event("show");
        this.$element.trigger(n), this.isShown || n.isDefaultPrevented() || (this.isShown = !0, this.escape(), this.preloadSize(function() { t.backdrop(function() {
                var n = e.support.transition && t.$element.hasClass("fade");
                t.$element.parent().length || t.$element.appendTo(document.body), t.$element.show(), n && t.$element[0].offsetWidth, t.$element.addClass("in").attr("aria-hidden", !1), t.enforceFocus(), n ? t.$element.one(e.support.transition.end, function() { t.$element.focus().trigger("shown") }) : t.$element.focus().trigger("shown") }) })) }, t.prototype.hide = function(t) { t && t.preventDefault();
        t = e.Event("hide"), this.$element.trigger(t), this.isShown && !t.isDefaultPrevented() && (this.isShown = !1, this.escape(), e(document).off("focusin.lightbox"), this.$element.removeClass("in").attr("aria-hidden", !0), e.support.transition && this.$element.hasClass("fade") ? this.hideWithTransition() : this.hideModal()) }, t.prototype.escape = function() {
        var e = this;
        this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.lightbox", function(t) { 27 == t.which && e.hide() }) : this.isShown || this.$element.off("keyup.dismiss.lightbox") }, t.prototype.preloadSize = function(t) {
        var n = e.Callbacks();
        t && n.add(t);
        var i, o, r, s, a, l, c, u, d, p, h = this;
        i = e(window).height(), o = e(window).width(), r = parseInt(h.$element.find(".lightbox-content").css("padding-top"), 10), s = parseInt(h.$element.find(".lightbox-content").css("padding-bottom"), 10), a = parseInt(h.$element.find(".lightbox-content").css("padding-left"), 10), l = parseInt(h.$element.find(".lightbox-content").css("padding-right"), 10), c = h.$element.find(".lightbox-content").find("img:first"), u = new Image, u.onload = function() { u.width + a + l >= o && (d = u.width, p = u.height, u.width = o - a - l, u.height = p / d * u.width), u.height + r + s >= i && (d = u.width, p = u.height, u.height = i - r - s, u.width = d / p * u.height), h.$element.css({ position: "fixed", width: u.width + a + l, height: u.height + r + s, top: i / 2 - (u.height + r + s) / 2, left: "50%", "margin-left": -1 * (u.width + a + l) / 2 }), h.$element.find(".lightbox-content").css({ width: u.width, height: u.height }), n.fire() }, u.src = c.attr("src") };
    var n = e.fn.lightbox;
    e.fn.lightbox = function(n) {
        return this.each(function() {
            var i = e(this),
                o = i.data("lightbox"),
                r = e.extend({}, e.fn.lightbox.defaults, i.data(), "object" == typeof n && n);
            o || i.data("lightbox", o = new t(this, r)), "string" == typeof n ? o[n]() : r.show && o.show() }) }, e.fn.lightbox.defaults = { backdrop: !0, keyboard: !0, show: !0 }, e.fn.lightbox.Constructor = t, e.fn.lightbox.noConflict = function() {
        return e.fn.lightbox = n, this }, e(document).on("click.lightbox.data-api", '[data-toggle="lightbox"]', function(t) {
        var n = e(this),
            i = n.attr("href"),
            o = e(n.attr("data-target") || i && i.replace(/.*(?=#[^\s]+$)/, "")),
            r = o.data("lightbox") ? "toggle" : e.extend({ remote: !/#/.test(i) && i }, o.data(), n.data());
        t.preventDefault(), o.lightbox(r).one("hide", function() { n.focus() }) }) }(window.jQuery),
function(e, t) {
    function n(e) {
        for (var t, n = e.split(/\s+/), i = [], o = 0; t = n[o]; o++) t = t[0].toUpperCase(), i.push(t);
        return i }

    function i(t) {
        return t.id && e('label[for="' + t.id + '"]').val() || t.name }

    function o(n, r, s) {
        return s || (s = 0), r.each(function() {
            var r, a, l = e(this),
                c = this,
                u = this.nodeName.toLowerCase();
            switch ("label" == u && l.find("input, textarea, select").length && (r = l.text(), l = l.children().first(), c = l.get(0), u = c.nodeName.toLowerCase()), u) {
                case "menu":
                    a = { name: l.attr("label"), items: {} }, s = o(a.items, l.children(), s);
                    break;
                case "a":
                case "button":
                    a = { name: l.text(), disabled: !!l.attr("disabled"), callback: function() {
                            return function() { l.click() } }() };
                    break;
                case "menuitem":
                case "command":
                    switch (l.attr("type")) {
                        case t:
                        case "command":
                        case "menuitem":
                            a = { name: l.attr("label"), disabled: !!l.attr("disabled"), callback: function() {
                                    return function() { l.click() } }() };
                            break;
                        case "checkbox":
                            a = { type: "checkbox", disabled: !!l.attr("disabled"), name: l.attr("label"), selected: !!l.attr("checked") };
                            break;
                        case "radio":
                            a = { type: "radio", disabled: !!l.attr("disabled"), name: l.attr("label"), radio: l.attr("radiogroup"), value: l.attr("id"), selected: !!l.attr("checked") };
                            break;
                        default:
                            a = t }
                    break;
                case "hr":
                    a = "-------";
                    break;
                case "input":
                    switch (l.attr("type")) {
                        case "text":
                            a = { type: "text", name: r || i(c), disabled: !!l.attr("disabled"), value: l.val() };
                            break;
                        case "checkbox":
                            a = { type: "checkbox", name: r || i(c), disabled: !!l.attr("disabled"), selected: !!l.attr("checked") };
                            break;
                        case "radio":
                            a = { type: "radio", name: r || i(c), disabled: !!l.attr("disabled"), radio: !!l.attr("name"), value: l.val(), selected: !!l.attr("checked") };
                            break;
                        default:
                            a = t }
                    break;
                case "select":
                    a = { type: "select", name: r || i(c), disabled: !!l.attr("disabled"), selected: l.val(), options: {} }, l.children().each(function() { a.options[this.value] = e(this).text() });
                    break;
                case "textarea":
                    a = { type: "textarea", name: r || i(c), disabled: !!l.attr("disabled"), value: l.val() };
                    break;
                case "label":
                    break;
                default:
                    a = { type: "html", html: l.clone(!0) } }
            a && (s++, n["key" + s] = a) }), s }
    if (e.support.htmlMenuitem = "HTMLMenuItemElement" in window, e.support.htmlCommand = "HTMLCommandElement" in window, e.support.eventSelectstart = "onselectstart" in document.documentElement, !e.ui || !e.ui.widget) {
        var r = e.cleanData;
        e.cleanData = function(t) {
            for (var n, i = 0; null != (n = t[i]); i++) try { e(n).triggerHandler("remove") } catch (o) {}
            r(t) } }
    var s = null,
        a = !1,
        l = e(window),
        c = 0,
        u = {},
        d = {},
        p = {},
        h = { selector: null, appendTo: null, trigger: "right", autoHide: !1, delay: 200, reposition: !0, determinePosition: function(t) {
                if (e.ui && e.ui.position) t.css("display", "block").position({ my: "center top", at: "center bottom", of: this, offset: "0 5", collision: "fit" }).css("display", "none");
                else {
                    var n = this.offset();
                    n.top += this.outerHeight(), n.left += this.outerWidth() / 2 - t.outerWidth() / 2, t.css(n) } }, position: function(e, t, n) {
                var i;
                if (!t && !n) return void e.determinePosition.call(this, e.$menu);
                i = "maintain" === t && "maintain" === n ? e.$menu.position() : { top: n, left: t };
                var o = l.scrollTop() + l.height(),
                    r = l.scrollLeft() + l.width(),
                    s = e.$menu.height(),
                    a = e.$menu.width();
                i.top + s > o && (i.top -= s), i.left + a > r && (i.left -= a), e.$menu.css(i) }, positionSubmenu: function(t) {
                if (e.ui && e.ui.position) t.css("display", "block").position({ my: "left top", at: "right top", of: this, collision: "flipfit fit" }).css("display", "");
                else {
                    var n = { top: 0, left: this.outerWidth() };
                    t.css(n) } }, zIndex: 1, animation: { duration: 50, show: "slideDown", hide: "slideUp" }, events: { show: e.noop, hide: e.noop }, callback: null, items: {} },
        f = { timer: null, pageX: null, pageY: null },
        m = function(e) {
            for (var t = 0, n = e;;)
                if (t = Math.max(t, parseInt(n.css("z-index"), 10) || 0), n = n.parent(), !n || !n.length || "html body".indexOf(n.prop("nodeName").toLowerCase()) > -1) break;
            return t },
        g = {
            abortevent: function(e) { e.preventDefault(), e.stopImmediatePropagation() },
            contextmenu: function(t) {
                var n = e(this);
                if (t.preventDefault(), t.stopImmediatePropagation(), !("right" != t.data.trigger && t.originalEvent || n.hasClass("context-menu-active") || n.hasClass("context-menu-disabled"))) {
                    if (s = n, t.data.build) {
                        var i = t.data.build(s, t);
                        if (i === !1) return;
                        if (t.data = e.extend(!0, {}, h, t.data, i || {}), !t.data.items || e.isEmptyObject(t.data.items)) throw window.console && (console.error || console.log)("No items specified to show in contextMenu"), new Error("No Items specified");
                        t.data.$trigger = s, v.create(t.data) }
                    v.show.call(n, t.data, t.pageX, t.pageY) } },
            click: function(t) { t.preventDefault(), t.stopImmediatePropagation(), e(this).trigger(e.Event("contextmenu", { data: t.data, pageX: t.pageX, pageY: t.pageY })) },
            mousedown: function(t) {
                var n = e(this);
                s && s.length && !s.is(n) && s.data("contextMenu").$menu.trigger("contextmenu:hide"), 2 == t.button && (s = n.data("contextMenuActive", !0)) },
            mouseup: function(t) {
                var n = e(this);
                n.data("contextMenuActive") && s && s.length && s.is(n) && !n.hasClass("context-menu-disabled") && (t.preventDefault(), t.stopImmediatePropagation(), s = n, n.trigger(e.Event("contextmenu", { data: t.data, pageX: t.pageX, pageY: t.pageY }))), n.removeData("contextMenuActive") },
            mouseenter: function(t) {
                var n = e(this),
                    i = e(t.relatedTarget),
                    o = e(document);
                i.is(".context-menu-list") || i.closest(".context-menu-list").length || s && s.length || (f.pageX = t.pageX, f.pageY = t.pageY, f.data = t.data, o.on("mousemove.contextMenuShow", g.mousemove), f.timer = setTimeout(function() { f.timer = null, o.off("mousemove.contextMenuShow"), s = n, n.trigger(e.Event("contextmenu", { data: f.data, pageX: f.pageX, pageY: f.pageY })) }, t.data.delay)) },
            mousemove: function(e) { f.pageX = e.pageX, f.pageY = e.pageY },
            mouseleave: function(t) {
                var n = e(t.relatedTarget);
                if (!n.is(".context-menu-list") && !n.closest(".context-menu-list").length) {
                    try { clearTimeout(f.timer) } catch (t) {}
                    f.timer = null } },
            layerClick: function(t) {
                var n, i, o = e(this),
                    r = o.data("contextMenuRoot"),
                    s = t.button,
                    a = t.pageX,
                    c = t.pageY;
                t.preventDefault(), t.stopImmediatePropagation(), setTimeout(function() {
                    var o, u = "left" == r.trigger && 0 === s || "right" == r.trigger && 2 === s;
                    if (document.elementFromPoint && (r.$layer.hide(), n = document.elementFromPoint(a - l.scrollLeft(), c - l.scrollTop()), r.$layer.show()), r.reposition && u)
                        if (document.elementFromPoint) {
                            if (r.$trigger.is(n) || r.$trigger.has(n).length) return void r.position.call(r.$trigger, r, a, c) } else if (i = r.$trigger.offset(), o = e(window), i.top += o.scrollTop(), i.top <= t.pageY && (i.left += o.scrollLeft(), i.left <= t.pageX && (i.bottom = i.top + r.$trigger.outerHeight(), i.bottom >= t.pageY && (i.right = i.left + r.$trigger.outerWidth(), i.right >= t.pageX)))) return void r.position.call(r.$trigger, r, a, c);
                    n && u && r.$trigger.one("contextmenu:hidden", function() {
                        e(n).contextMenu({
                            x: a,
                            y: c
                        })
                    }), r.$menu.trigger("contextmenu:hide")
                }, 50)
            },
            keyStop: function(e, t) { t.isInput || e.preventDefault(), e.stopPropagation() },
            key: function(e) {
                var t = s.data("contextMenu") || {};
                switch (e.keyCode) {
                    case 9:
                    case 38:
                        if (g.keyStop(e, t), t.isInput) {
                            if (9 == e.keyCode && e.shiftKey) return e.preventDefault(), t.$selected && t.$selected.find("input, textarea, select").blur(), void t.$menu.trigger("prevcommand");
                            if (38 == e.keyCode && "checkbox" == t.$selected.find("input, textarea, select").prop("type")) return void e.preventDefault() } else if (9 != e.keyCode || e.shiftKey) return void t.$menu.trigger("prevcommand");
                    case 40:
                        if (g.keyStop(e, t), !t.isInput) return void t.$menu.trigger("nextcommand");
                        if (9 == e.keyCode) return e.preventDefault(), t.$selected && t.$selected.find("input, textarea, select").blur(), void t.$menu.trigger("nextcommand");
                        if (40 == e.keyCode && "checkbox" == t.$selected.find("input, textarea, select").prop("type")) return void e.preventDefault();
                        break;
                    case 37:
                        if (g.keyStop(e, t), t.isInput || !t.$selected || !t.$selected.length) break;
                        if (!t.$selected.parent().hasClass("context-menu-root")) {
                            var n = t.$selected.parent().parent();
                            return t.$selected.trigger("contextmenu:blur"), void(t.$selected = n) }
                        break;
                    case 39:
                        if (g.keyStop(e, t), t.isInput || !t.$selected || !t.$selected.length) break;
                        var i = t.$selected.data("contextMenu") || {};
                        if (i.$menu && t.$selected.hasClass("context-menu-submenu")) return t.$selected = null, i.$selected = null, void i.$menu.trigger("nextcommand");
                        break;
                    case 35:
                    case 36:
                        return t.$selected && t.$selected.find("input, textarea, select").length ? void 0 : ((t.$selected && t.$selected.parent() || t.$menu).children(":not(.disabled, .not-selectable)")[36 == e.keyCode ? "first" : "last"]().trigger("contextmenu:focus"), void e.preventDefault());
                    case 13:
                        if (g.keyStop(e, t), t.isInput) {
                            if (t.$selected && !t.$selected.is("textarea, select")) return void e.preventDefault();
                            break }
                        return void(t.$selected && t.$selected.trigger("mouseup"));
                    case 32:
                    case 33:
                    case 34:
                        return void g.keyStop(e, t);
                    case 27:
                        return g.keyStop(e, t), void t.$menu.trigger("contextmenu:hide");
                    default:
                        var o = String.fromCharCode(e.keyCode).toUpperCase();
                        if (t.accesskeys[o]) return void t.accesskeys[o].$node.trigger(t.accesskeys[o].$menu ? "contextmenu:focus" : "mouseup") }
                e.stopPropagation(), t.$selected && t.$selected.trigger(e) },
            prevItem: function(t) { t.stopPropagation();
                var n = e(this).data("contextMenu") || {};
                if (n.$selected) {
                    var i = n.$selected;
                    n = n.$selected.parent().data("contextMenu") || {}, n.$selected = i }
                for (var o = n.$menu.children(), r = n.$selected && n.$selected.prev().length ? n.$selected.prev() : o.last(), s = r; r.hasClass("disabled") || r.hasClass("not-selectable");)
                    if (r = r.prev().length ? r.prev() : o.last(), r.is(s)) return;
                n.$selected && g.itemMouseleave.call(n.$selected.get(0), t), g.itemMouseenter.call(r.get(0), t);
                var a = r.find("input, textarea, select");
                a.length && a.focus() },
            nextItem: function(t) { t.stopPropagation();
                var n = e(this).data("contextMenu") || {};
                if (n.$selected) {
                    var i = n.$selected;
                    n = n.$selected.parent().data("contextMenu") || {}, n.$selected = i }
                for (var o = n.$menu.children(), r = n.$selected && n.$selected.next().length ? n.$selected.next() : o.first(), s = r; r.hasClass("disabled") || r.hasClass("not-selectable");)
                    if (r = r.next().length ? r.next() : o.first(), r.is(s)) return;
                n.$selected && g.itemMouseleave.call(n.$selected.get(0), t), g.itemMouseenter.call(r.get(0), t);
                var a = r.find("input, textarea, select");
                a.length && a.focus() },
            focusInput: function(t) {
                var n = e(this).closest(".context-menu-item"),
                    i = n.data(),
                    o = i.contextMenu,
                    r = i.contextMenuRoot;
                r.$selected = o.$selected = n, r.isInput = o.isInput = !0 },
            blurInput: function(t) {
                var n = e(this).closest(".context-menu-item"),
                    i = n.data(),
                    o = i.contextMenu,
                    r = i.contextMenuRoot;
                r.isInput = o.isInput = !1 },
            menuMouseenter: function(t) {
                var n = e(this).data().contextMenuRoot;
                n.hovering = !0 },
            menuMouseleave: function(t) {
                var n = e(this).data().contextMenuRoot;
                n.$layer && n.$layer.is(t.relatedTarget) && (n.hovering = !1) },
            itemMouseenter: function(t) {
                var n = e(this),
                    i = n.data(),
                    o = i.contextMenu,
                    r = i.contextMenuRoot;
                return r.hovering = !0, t && r.$layer && r.$layer.is(t.relatedTarget) && (t.preventDefault(), t.stopImmediatePropagation()), (o.$menu ? o : r).$menu.children(".hover").trigger("contextmenu:blur"), n.hasClass("disabled") || n.hasClass("not-selectable") ? void(o.$selected = null) : void n.trigger("contextmenu:focus") },
            itemMouseleave: function(t) {
                var n = e(this),
                    i = n.data(),
                    o = i.contextMenu,
                    r = i.contextMenuRoot;
                return r !== o && r.$layer && r.$layer.is(t.relatedTarget) ? (r.$selected && r.$selected.trigger("contextmenu:blur"), t.preventDefault(), t.stopImmediatePropagation(), void(r.$selected = o.$selected = o.$node)) : void n.trigger("contextmenu:blur") },
            itemClick: function(t) {
                var n, i = e(this),
                    o = i.data(),
                    r = o.contextMenu,
                    s = o.contextMenuRoot,
                    a = o.contextMenuKey;
                if (r.items[a] && !i.is(".disabled, .context-menu-submenu, .context-menu-separator, .not-selectable")) {
                    if (t.preventDefault(), t.stopImmediatePropagation(), e.isFunction(s.callbacks[a]) && Object.prototype.hasOwnProperty.call(s.callbacks, a)) n = s.callbacks[a];
                    else {
                        if (!e.isFunction(s.callback)) return;
                        n = s.callback }
                    n.call(s.$trigger, a, s) !== !1 ? s.$menu.trigger("contextmenu:hide") : s.$menu.parent().length && v.update.call(s.$trigger, s) } },
            inputClick: function(e) { e.stopImmediatePropagation() },
            hideMenu: function(t, n) {
                var i = e(this).data("contextMenuRoot");
                v.hide.call(i.$trigger, i, n && n.force) },
            focusItem: function(t) { t.stopPropagation();
                var n = e(this),
                    i = n.data(),
                    o = i.contextMenu,
                    r = i.contextMenuRoot;
                n.addClass("hover").siblings(".hover").trigger("contextmenu:blur"), o.$selected = r.$selected = n, o.$node && r.positionSubmenu.call(o.$node, o.$menu) },
            blurItem: function(t) { t.stopPropagation(); {
                    var n = e(this),
                        i = n.data(),
                        o = i.contextMenu;
                    i.contextMenuRoot }
                n.removeClass("hover"), o.$selected = null }
        },
        v = { show: function(t, n, i) {
                var o = e(this),
                    r = {};
                return e("#context-menu-layer").trigger("mousedown"), t.$trigger = o, t.events.show.call(o, t) === !1 ? void(s = null) : (v.update.call(o, t), t.position.call(o, t, n, i), t.zIndex && (r.zIndex = m(o) + t.zIndex), v.layer.call(t.$menu, t, r.zIndex), t.$menu.find("ul").css("zIndex", r.zIndex + 1), t.$menu.css(r)[t.animation.show](t.animation.duration, function() { o.trigger("contextmenu:visible") }), o.data("contextMenu", t).addClass("context-menu-active"), e(document).off("keydown.contextMenu").on("keydown.contextMenu", g.key), void(t.autoHide && e(document).on("mousemove.contextMenuAutoHide", function(e) {
                    var n = o.offset();
                    n.right = n.left + o.outerWidth(), n.bottom = n.top + o.outerHeight(), !t.$layer || t.hovering || e.pageX >= n.left && e.pageX <= n.right && e.pageY >= n.top && e.pageY <= n.bottom || t.$menu.trigger("contextmenu:hide") }))) }, hide: function(n, i) {
                var o = e(this);
                if (n || (n = o.data("contextMenu") || {}), i || !n.events || n.events.hide.call(o, n) !== !1) {
                    if (o.removeData("contextMenu").removeClass("context-menu-active"), n.$layer) { setTimeout(function(e) {
                            return function() { e.remove() } }(n.$layer), 10);
                        try { delete n.$layer } catch (r) { n.$layer = null } }
                    s = null, n.$menu.find(".hover").trigger("contextmenu:blur"), n.$selected = null, e(document).off(".contextMenuAutoHide").off("keydown.contextMenu"), n.$menu && n.$menu[n.animation.hide](n.animation.duration, function() { n.build && (n.$menu.remove(), e.each(n, function(e, i) {
                            switch (e) {
                                case "ns":
                                case "selector":
                                case "build":
                                case "trigger":
                                    return !0;
                                default:
                                    n[e] = t;
                                    try { delete n[e] } catch (o) {}
                                    return !0 } })), setTimeout(function() { o.trigger("contextmenu:hidden") }, 10) }) } }, create: function(i, o) { o === t && (o = i), i.$menu = e('<ul class="context-menu-list"></ul>').addClass(i.className || "").data({ contextMenu: i, contextMenuRoot: o }), e.each(["callbacks", "commands", "inputs"], function(e, t) { i[t] = {}, o[t] || (o[t] = {}) }), o.accesskeys || (o.accesskeys = {}), e.each(i.items, function(t, r) {
                    var s = e('<li class="context-menu-item"></li>').addClass(r.className || ""),
                        a = null,
                        l = null;
                    if (s.on("click", e.noop), r.$node = s.data({ contextMenu: i, contextMenuRoot: o, contextMenuKey: t }), r.accesskey)
                        for (var c, u = n(r.accesskey), d = 0; c = u[d]; d++)
                            if (!o.accesskeys[c]) { o.accesskeys[c] = r, r._name = r.name.replace(new RegExp("(" + c + ")", "i"), '<span class="context-menu-accesskey">$1</span>');
                                break }
                    if ("string" == typeof r) s.addClass("context-menu-separator not-selectable");
                    else if (r.type && p[r.type]) p[r.type].call(s, r, i, o), e.each([i, o], function(n, i) { i.commands[t] = r, e.isFunction(r.callback) && (i.callbacks[t] = r.callback) });
                    else {
                        switch ("html" == r.type ? s.addClass("context-menu-html not-selectable") : r.type ? (a = e("<label></label>").appendTo(s), e("<span></span>").html(r._name || r.name).appendTo(a), s.addClass("context-menu-input"), i.hasTypes = !0, e.each([i, o], function(e, n) { n.commands[t] = r, n.inputs[t] = r })) : r.items && (r.type = "sub"), r.type) {
                            case "text":
                                l = e('<input type="text" value="1" name="" value="">').attr("name", "context-menu-input-" + t).val(r.value || "").appendTo(a);
                                break;
                            case "textarea":
                                l = e('<textarea name=""></textarea>').attr("name", "context-menu-input-" + t).val(r.value || "").appendTo(a), r.height && l.height(r.height);
                                break;
                            case "checkbox":
                                l = e('<input type="checkbox" value="1" name="" value="">').attr("name", "context-menu-input-" + t).val(r.value || "").prop("checked", !!r.selected).prependTo(a);
                                break;
                            case "radio":
                                l = e('<input type="radio" value="1" name="" value="">').attr("name", "context-menu-input-" + r.radio).val(r.value || "").prop("checked", !!r.selected).prependTo(a);
                                break;
                            case "select":
                                l = e('<select name="">').attr("name", "context-menu-input-" + t).appendTo(a), r.options && (e.each(r.options, function(t, n) { e("<option></option>").val(t).text(n).appendTo(l) }), l.val(r.selected));
                                break;
                            case "sub":
                                e("<span></span>").html(r._name || r.name).appendTo(s), r.appendTo = r.$node, v.create(r, o), s.data("contextMenu", r).addClass("context-menu-submenu"), r.callback = null;
                                break;
                            case "html":
                                e(r.html).appendTo(s);
                                break;
                            default:
                                e.each([i, o], function(n, i) { i.commands[t] = r, e.isFunction(r.callback) && (i.callbacks[t] = r.callback) }), e("<span></span>").html(r._name || r.name || "").appendTo(s) }
                        r.type && "sub" != r.type && "html" != r.type && (l.on("focus", g.focusInput).on("blur", g.blurInput), r.events && l.on(r.events, i)), r.icon && s.addClass("icon icon-" + r.icon) }
                    r.$input = l, r.$label = a, s.appendTo(i.$menu), !i.hasTypes && e.support.eventSelectstart && s.on("selectstart.disableTextSelect", g.abortevent) }), i.$node || i.$menu.css("display", "none").addClass("context-menu-root"), i.$menu.appendTo(i.appendTo || document.body) }, resize: function(t, n) { t.css({ position: "absolute", display: "block" }), t.data("width", Math.ceil(t.width()) + 1), t.css({ position: "static", minWidth: "0px", maxWidth: "100000px" }), t.find("> li > ul").each(function() { v.resize(e(this), !0) }), n || t.find("ul").andSelf().css({ position: "", display: "", minWidth: "", maxWidth: "" }).width(function() {
                    return e(this).data("width") }) }, update: function(n, i) {
                var o = this;
                i === t && (i = n, v.resize(n.$menu)), n.$menu.children().each(function() {
                    var t = e(this),
                        r = t.data("contextMenuKey"),
                        s = n.items[r],
                        a = e.isFunction(s.disabled) && s.disabled.call(o, r, i) || s.disabled === !0;
                    if (t[a ? "addClass" : "removeClass"]("disabled"), s.type) switch (t.find("input, select, textarea").prop("disabled", a), s.type) {
                        case "text":
                        case "textarea":
                            s.$input.val(s.value || "");
                            break;
                        case "checkbox":
                        case "radio":
                            s.$input.val(s.value || "").prop("checked", !!s.selected);
                            break;
                        case "select":
                            s.$input.val(s.selected || "") }
                    s.$menu && v.update.call(o, s, i) }) }, layer: function(t, n) {
                var i = t.$layer = e('<div id="context-menu-layer" style="position:fixed; z-index:' + n + '; top:0; left:0; opacity: 0; filter: alpha(opacity=0); background-color: #000;"></div>').css({ height: l.height(), width: l.width(), display: "block" }).data("contextMenuRoot", t).insertBefore(this).on("contextmenu", g.abortevent).on("mousedown", g.layerClick);
                return e.support.fixedPosition || i.css({ position: "absolute", height: e(document).height() }), i } };
    e.fn.contextMenu = function(n) {
        if (n === t) this.first().trigger("contextmenu");
        else if (n.x && n.y) this.first().trigger(e.Event("contextmenu", { pageX: n.x, pageY: n.y }));
        else if ("hide" === n) {
            var i = this.data("contextMenu").$menu;
            i && i.trigger("contextmenu:hide") } else "destroy" === n ? e.contextMenu("destroy", { context: this }) : e.isPlainObject(n) ? (n.context = this, e.contextMenu("create", n)) : n ? this.removeClass("context-menu-disabled") : n || this.addClass("context-menu-disabled");
        return this }, e.contextMenu = function(n, i) { "string" != typeof n && (i = n, n = "create"), "string" == typeof i ? i = { selector: i } : i === t && (i = {});
        var o = e.extend(!0, {}, h, i || {}),
            r = e(document),
            s = r,
            l = !1;
        switch (o.context && o.context.length ? (s = e(o.context).first(), o.context = s.get(0), l = o.context !== document) : o.context = document, n) {
            case "create":
                if (!o.selector) throw new Error("No selector specified");
                if (o.selector.match(/.context-menu-(list|item|input)($|\s)/)) throw new Error('Cannot bind to selector "' + o.selector + '" as it contains a reserved className');
                if (!o.build && (!o.items || e.isEmptyObject(o.items))) throw new Error("No Items specified");
                switch (c++, o.ns = ".contextMenu" + c, l || (u[o.selector] = o.ns), d[o.ns] = o, o.trigger || (o.trigger = "right"), a || (r.on({ "contextmenu:hide.contextMenu": g.hideMenu, "prevcommand.contextMenu": g.prevItem, "nextcommand.contextMenu": g.nextItem, "contextmenu.contextMenu": g.abortevent, "mouseenter.contextMenu": g.menuMouseenter, "mouseleave.contextMenu": g.menuMouseleave }, ".context-menu-list").on("mouseup.contextMenu", ".context-menu-input", g.inputClick).on({ "mouseup.contextMenu": g.itemClick, "contextmenu:focus.contextMenu": g.focusItem, "contextmenu:blur.contextMenu": g.blurItem, "contextmenu.contextMenu": g.abortevent, "mouseenter.contextMenu": g.itemMouseenter, "mouseleave.contextMenu": g.itemMouseleave }, ".context-menu-item"), a = !0), s.on("contextmenu" + o.ns, o.selector, o, g.contextmenu), l && s.on("remove" + o.ns, function() { e(this).contextMenu("destroy") }), o.trigger) {
                    case "hover":
                        s.on("mouseenter" + o.ns, o.selector, o, g.mouseenter).on("mouseleave" + o.ns, o.selector, o, g.mouseleave);
                        break;
                    case "left":
                        s.on("click" + o.ns, o.selector, o, g.click) }
                o.build || v.create(o);
                break;
            case "destroy":
                var p;
                if (l) {
                    var f = o.context;
                    e.each(d, function(t, n) {
                        if (n.context !== f) return !0;
                        p = e(".context-menu-list").filter(":visible"), p.length && p.data().contextMenuRoot.$trigger.is(e(n.context).find(n.selector)) && p.trigger("contextmenu:hide", { force: !0 });
                        try { d[n.ns].$menu && d[n.ns].$menu.remove(), delete d[n.ns] } catch (i) { d[n.ns] = null }
                        return e(n.context).off(n.ns), !0 }) } else if (o.selector) {
                    if (u[o.selector]) { p = e(".context-menu-list").filter(":visible"), p.length && p.data().contextMenuRoot.$trigger.is(o.selector) && p.trigger("contextmenu:hide", { force: !0 });
                        try { d[u[o.selector]].$menu && d[u[o.selector]].$menu.remove(), delete d[u[o.selector]] } catch (m) { d[u[o.selector]] = null }
                        r.off(u[o.selector]) } } else r.off(".contextMenu .contextMenuAutoHide"), e.each(d, function(t, n) { e(n.context).off(n.ns) }), u = {}, d = {}, c = 0, a = !1, e("#context-menu-layer, .context-menu-list").remove();
                break;
            case "html5":
                (!e.support.htmlCommand && !e.support.htmlMenuitem || "boolean" == typeof i && i) && e('menu[type="context"]').each(function() { this.id && e.contextMenu({ selector: "[contextmenu=" + this.id + "]", items: e.contextMenu.fromMenu(this) }) }).css("display", "none");
                break;
            default:
                throw new Error('Unknown operation "' + n + '"') }
        return this }, e.contextMenu.setInputValues = function(n, i) { i === t && (i = {}), e.each(n.inputs, function(e, t) {
            switch (t.type) {
                case "text":
                case "textarea":
                    t.value = i[e] || "";
                    break;
                case "checkbox":
                    t.selected = i[e] ? !0 : !1;
                    break;
                case "radio":
                    t.selected = (i[t.radio] || "") == t.value ? !0 : !1;
                    break;
                case "select":
                    t.selected = i[e] || "" } }) }, e.contextMenu.getInputValues = function(n, i) {
        return i === t && (i = {}), e.each(n.inputs, function(e, t) {
            switch (t.type) {
                case "text":
                case "textarea":
                case "select":
                    i[e] = t.$input.val();
                    break;
                case "checkbox":
                    i[e] = t.$input.prop("checked");
                    break;
                case "radio":
                    t.$input.prop("checked") && (i[t.radio] = t.value) } }), i }, e.contextMenu.fromMenu = function(t) {
        var n = e(t),
            i = {};
        return o(i, n.children()), i }, e.contextMenu.defaults = h, e.contextMenu.types = p, e.contextMenu.handle = g, e.contextMenu.op = v, e.contextMenu.menus = d
}(jQuery),
function(e, t, n, i) {
    var o = e(t);
    e.fn.lazyload = function(r) {
        function s() {
            var t = 0;
            l.each(function() {
                var n = e(this);
                if (!c.skip_invisible || n.is(":visible"))
                    if (e.abovethetop(this, c) || e.leftofbegin(this, c));
                    else if (e.belowthefold(this, c) || e.rightoffold(this, c)) {
                    if (++t > c.failure_limit) return !1 } else n.trigger("appear"), t = 0 }) }
        var a, l = this,
            c = { threshold: 0, failure_limit: 0, event: "scroll", effect: "show", container: t, data_attribute: "original", skip_invisible: !0, appear: null, load: null, placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" };
        return r && (i !== r.failurelimit && (r.failure_limit = r.failurelimit, delete r.failurelimit), i !== r.effectspeed && (r.effect_speed = r.effectspeed, delete r.effectspeed), e.extend(c, r)), a = c.container === i || c.container === t ? o : e(c.container), 0 === c.event.indexOf("scroll") && a.bind(c.event, function() {
            return s() }), this.each(function() {
            var t = this,
                n = e(t);
            t.loaded = !1, (n.attr("src") === i || n.attr("src") === !1) && n.is("img") && n.attr("src", c.placeholder), n.one("appear", function() {
                if (!this.loaded) {
                    if (c.appear) {
                        var i = l.length;
                        c.appear.call(t, i, c) }
                    e("<img />").bind("load", function() {
                        var i = n.attr("data-" + c.data_attribute);
                        n.hide(), n.is("img") ? n.attr("src", i) : n.css("background-image", "url('" + i + "')"), n[c.effect](c.effect_speed), t.loaded = !0;
                        var o = e.grep(l, function(e) {
                            return !e.loaded });
                        if (l = e(o), c.load) {
                            var r = l.length;
                            c.load.call(t, r, c) } }).attr("src", n.attr("data-" + c.data_attribute)) } }), 0 !== c.event.indexOf("scroll") && n.bind(c.event, function() { t.loaded || n.trigger("appear") }) }), o.bind("resize", function() { s() }), /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && o.bind("pageshow", function(t) { t.originalEvent && t.originalEvent.persisted && l.each(function() { e(this).trigger("appear") }) }), e(n).ready(function() { s() }), this }, e.belowthefold = function(n, r) {
        var s;
        return s = r.container === i || r.container === t ? (t.innerHeight ? t.innerHeight : o.height()) + o.scrollTop() : e(r.container).offset().top + e(r.container).height(), s <= e(n).offset().top - r.threshold }, e.rightoffold = function(n, r) {
        var s;
        return s = r.container === i || r.container === t ? o.width() + o.scrollLeft() : e(r.container).offset().left + e(r.container).width(), s <= e(n).offset().left - r.threshold }, e.abovethetop = function(n, r) {
        var s;
        return s = r.container === i || r.container === t ? o.scrollTop() : e(r.container).offset().top, s >= e(n).offset().top + r.threshold + e(n).height() }, e.leftofbegin = function(n, r) {
        var s;
        return s = r.container === i || r.container === t ? o.scrollLeft() : e(r.container).offset().left, s >= e(n).offset().left + r.threshold + e(n).width() }, e.inviewport = function(t, n) {
        return !(e.rightoffold(t, n) || e.leftofbegin(t, n) || e.belowthefold(t, n) || e.abovethetop(t, n)) }, e.extend(e.expr[":"], { "below-the-fold": function(t) {
            return e.belowthefold(t, { threshold: 0 }) }, "above-the-top": function(t) {
            return !e.belowthefold(t, { threshold: 0 }) }, "right-of-screen": function(t) {
            return e.rightoffold(t, { threshold: 0 }) }, "left-of-screen": function(t) {
            return !e.rightoffold(t, { threshold: 0 }) }, "in-viewport": function(t) {
            return e.inviewport(t, { threshold: 0 }) }, "above-the-fold": function(t) {
            return !e.belowthefold(t, { threshold: 0 }) }, "right-of-fold": function(t) {
            return e.rightoffold(t, { threshold: 0 }) }, "left-of-fold": function(t) {
            return !e.rightoffold(t, { threshold: 0 }) } }) }(jQuery, window, document),
function(e) { "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e(require("jquery")) : e(jQuery) }(function(e) {
    var t = e.event.dispatch || e.event.handle,
        n = e.event.special,
        i = "D" + +new Date,
        o = "D" + (+new Date + 1);
    n.scrollstart = { setup: function(o) {
            var r, s = e.extend({ latency: n.scrollstop.latency }, o),
                a = function(e) {
                    var n = this,
                        i = arguments;
                    r ? clearTimeout(r) : (e.type = "scrollstart", t.apply(n, i)), r = setTimeout(function() { r = null }, s.latency) };
            e(this).bind("scroll", a).data(i, a) }, teardown: function() { e(this).unbind("scroll", e(this).data(i)) } }, n.scrollstop = { latency: 250, setup: function(i) {
            var r, s = e.extend({ latency: n.scrollstop.latency }, i),
                a = function(e) {
                    var n = this,
                        i = arguments;
                    r && clearTimeout(r), r = setTimeout(function() { r = null, e.type = "scrollstop", t.apply(n, i) }, s.latency) };
            e(this).bind("scroll", a).data(o, a) }, teardown: function() { e(this).unbind("scroll", e(this).data(o)) } } });
var bootbox = window.bootbox || function(e, t) {
    function n(e, t) {
        return "undefined" == typeof t && (t = i), "string" == typeof p[t][e] ? p[t][e] : t != o ? n(e, o) : e }
    var i = "en",
        o = "en",
        r = !0,
        s = "static",
        a = "javascript:;",
        l = "",
        c = {},
        u = {},
        d = {};
    d.setLocale = function(e) {
        for (var t in p)
            if (t == e) return void(i = e);
        throw new Error("Invalid locale: " + e) }, d.addLocale = function(e, t) { "undefined" == typeof p[e] && (p[e] = {});
        for (var n in t) p[e][n] = t[n] }, d.setIcons = function(e) { u = e, ("object" != typeof u || null === u) && (u = {}) }, d.setBtnClasses = function(e) { c = e, ("object" != typeof c || null === c) && (c = {}) }, d.alert = function() {
        var e = "",
            t = n("OK"),
            i = null;
        switch (arguments.length) {
            case 1:
                e = arguments[0];
                break;
            case 2:
                e = arguments[0], "function" == typeof arguments[1] ? i = arguments[1] : t = arguments[1];
                break;
            case 3:
                e = arguments[0], t = arguments[1], i = arguments[2];
                break;
            default:
                throw new Error("Incorrect number of arguments: expected 1-3") }
        return d.dialog(e, { label: t, icon: u.OK, "class": c.OK, callback: i }, { onEscape: i || !0 }) }, d.confirm = function() {
        var e = "",
            t = n("CANCEL"),
            i = n("CONFIRM"),
            o = null;
        switch (arguments.length) {
            case 1:
                e = arguments[0];
                break;
            case 2:
                e = arguments[0], "function" == typeof arguments[1] ? o = arguments[1] : t = arguments[1];
                break;
            case 3:
                e = arguments[0], t = arguments[1], "function" == typeof arguments[2] ? o = arguments[2] : i = arguments[2];
                break;
            case 4:
                e = arguments[0], t = arguments[1], i = arguments[2], o = arguments[3];
                break;
            default:
                throw new Error("Incorrect number of arguments: expected 1-4") }
        var r = function() {
                return "function" == typeof o ? o(!1) : void 0 },
            s = function() {
                return "function" == typeof o ? o(!0) : void 0 };
        return d.dialog(e, [{ label: t, icon: u.CANCEL, "class": c.CANCEL, callback: r }, { label: i, icon: u.CONFIRM, "class": c.CONFIRM, callback: s }], { onEscape: r }) }, d.prompt = function() {
        var e = "",
            i = n("CANCEL"),
            o = n("CONFIRM"),
            r = null,
            s = "";
        switch (arguments.length) {
            case 1:
                e = arguments[0];
                break;
            case 2:
                e = arguments[0], "function" == typeof arguments[1] ? r = arguments[1] : i = arguments[1];
                break;
            case 3:
                e = arguments[0], i = arguments[1], "function" == typeof arguments[2] ? r = arguments[2] : o = arguments[2];
                break;
            case 4:
                e = arguments[0], i = arguments[1], o = arguments[2], r = arguments[3];
                break;
            case 5:
                e = arguments[0], i = arguments[1], o = arguments[2], r = arguments[3], s = arguments[4];
                break;
            default:
                throw new Error("Incorrect number of arguments: expected 1-5") }
        var a = e,
            l = t("<form></form>");
        l.append("<input class='input-block-level' autocomplete=off type=text value='" + s + "' />");
        var p = function() {
                return "function" == typeof r ? r(null) : void 0 },
            h = function() {
                return "function" == typeof r ? r(l.find("input[type=text]").val()) : void 0 },
            f = d.dialog(l, [{ label: i, icon: u.CANCEL, "class": c.CANCEL, callback: p }, { label: o, icon: u.CONFIRM, "class": c.CONFIRM, callback: h }], { header: a, show: !1, onEscape: p });
        return f.on("shown", function() { l.find("input[type=text]").focus(), l.on("submit", function(e) { e.preventDefault(), f.find(".btn-primary").click() }) }), f.modal("show"), f }, d.dialog = function(n, i, o) {
        function c(e) {
            var t = null; "function" == typeof o.onEscape && (t = o.onEscape()), t !== !1 && k.modal("hide") }
        var u = "",
            d = [];
        o || (o = {}), "undefined" == typeof i ? i = [] : "undefined" == typeof i.length && (i = [i]);
        for (var p = i.length; p--;) {
            var h = null,
                f = null,
                m = null,
                g = "",
                v = null;
            if ("undefined" == typeof i[p].label && "undefined" == typeof i[p]["class"] && "undefined" == typeof i[p].callback) {
                var y = 0,
                    b = null;
                for (var w in i[p])
                    if (b = w, ++y > 1) break;
                1 == y && "function" == typeof i[p][w] && (i[p].label = b, i[p].callback = i[p][w]) } "function" == typeof i[p].callback && (v = i[p].callback), i[p]["class"] ? m = i[p]["class"] : p == i.length - 1 && i.length <= 2 && (m = "btn-primary"), i[p].link !== !0 && (m = "btn " + m), h = i[p].label ? i[p].label : "Option " + (p + 1), i[p].icon && (g = "<i class='" + i[p].icon + "'></i> "), f = i[p].href ? i[p].href : a, u = "<a data-handler='" + p + "' class='" + m + "' href='" + f + "'>" + g + h + "</a>" + u, d[p] = v }
        var x = ["<div class='bootbox modal' tabindex='-1' style='overflow:hidden;'>"];
        if (o.header) {
            var C = "";
            ("undefined" == typeof o.headerCloseButton || o.headerCloseButton) && (C = "<a href='" + a + "' class='close'>&times;</a>"), x.push("<div class='modal-header'>" + C + "<h3>" + o.header + "</h3></div>") }
        x.push("<div class='modal-body'></div>"), u && x.push("<div class='modal-footer'>" + u + "</div>"), x.push("</div>");
        var k = t(x.join("\n")),
            T = "undefined" == typeof o.animate ? r : o.animate;
        T && k.addClass("fade");
        var E = "undefined" == typeof o.classes ? l : o.classes;
        return E && k.addClass(E), k.find(".modal-body").html(n), k.on("keyup.dismiss.modal", function(e) { 27 === e.which && o.onEscape && c("escape") }), k.on("click", "a.close", function(e) { e.preventDefault(), c("close") }), k.on("shown", function() { k.find("a.btn-primary:first").focus() }), k.on("hidden", function(e) { e.target === this && k.remove() }), k.on("click", ".modal-footer a", function(e) {
            var n = t(this).data("handler"),
                o = d[n],
                r = null;
            ("undefined" == typeof n || "undefined" == typeof i[n].href) && (e.preventDefault(), "function" == typeof o && (r = o(e)), r !== !1 && k.modal("hide")) }), t("body").append(k), k.modal({ backdrop: "undefined" == typeof o.backdrop ? s : o.backdrop, keyboard: !1, show: !1 }), k.on("show", function(n) { t(e).off("focusin.modal") }), ("undefined" == typeof o.show || o.show === !0) && k.modal("show"), k }, d.modal = function() {
        var e, n, i, o = { onEscape: null, keyboard: !0, backdrop: s };
        switch (arguments.length) {
            case 1:
                e = arguments[0];
                break;
            case 2:
                e = arguments[0], "object" == typeof arguments[1] ? i = arguments[1] : n = arguments[1];
                break;
            case 3:
                e = arguments[0], n = arguments[1], i = arguments[2];
                break;
            default:
                throw new Error("Incorrect number of arguments: expected 1-3") }
        return o.header = n, i = "object" == typeof i ? t.extend(o, i) : o, d.dialog(e, [], i) }, d.hideAll = function() { t(".bootbox").modal("hide") }, d.animate = function(e) { r = e }, d.backdrop = function(e) { s = e }, d.classes = function(e) { l = e };
    var p = { br: { OK: "OK", CANCEL: "Cancelar", CONFIRM: "Sim" }, da: { OK: "OK", CANCEL: "Annuller", CONFIRM: "Accepter" }, de: { OK: "OK", CANCEL: "Abbrechen", CONFIRM: "Akzeptieren" }, en: { OK: "OK", CANCEL: "Cancel", CONFIRM: "OK" }, es: { OK: "OK", CANCEL: "Cancelar", CONFIRM: "Aceptar" }, fr: { OK: "OK", CANCEL: "Annuler", CONFIRM: "D'accord" }, it: { OK: "OK", CANCEL: "Annulla", CONFIRM: "Conferma" }, nl: { OK: "OK", CANCEL: "Annuleren", CONFIRM: "Accepteren" }, pl: { OK: "OK", CANCEL: "Anuluj", CONFIRM: "Potwierdź" }, ru: { OK: "OK", CANCEL: "Отмена", CONFIRM: "Применить" }, zh_CN: { OK: "OK", CANCEL: "取消", CONFIRM: "确认" }, zh_TW: { OK: "OK", CANCEL: "取消", CONFIRM: "確認" } };
    return d }(document, window.jQuery);
window.bootbox = bootbox,
    function() {
        var e, t, n, i, o, r, s, a, l = [].slice,
            c = {}.hasOwnProperty,
            u = function(e, t) {
                function n() { this.constructor = e }
                for (var i in t) c.call(t, i) && (e[i] = t[i]);
                return n.prototype = t.prototype, e.prototype = new n, e.__super__ = t.prototype, e };
        s = function() {}, t = function() {
            function e() {}
            return e.prototype.addEventListener = e.prototype.on, e.prototype.on = function(e, t) {
                return this._callbacks = this._callbacks || {}, this._callbacks[e] || (this._callbacks[e] = []), this._callbacks[e].push(t), this }, e.prototype.emit = function() {
                var e, t, n, i, o, r;
                if (i = arguments[0], e = 2 <= arguments.length ? l.call(arguments, 1) : [], this._callbacks = this._callbacks || {}, n = this._callbacks[i])
                    for (o = 0, r = n.length; r > o; o++) t = n[o], t.apply(this, e);
                return this }, e.prototype.removeListener = e.prototype.off, e.prototype.removeAllListeners = e.prototype.off, e.prototype.removeEventListener = e.prototype.off, e.prototype.off = function(e, t) {
                var n, i, o, r, s;
                if (!this._callbacks || 0 === arguments.length) return this._callbacks = {}, this;
                if (i = this._callbacks[e], !i) return this;
                if (1 === arguments.length) return delete this._callbacks[e], this;
                for (o = r = 0, s = i.length; s > r; o = ++r)
                    if (n = i[o], n === t) { i.splice(o, 1);
                        break }
                return this }, e }(), e = function(e) {
            function n(e, t) {
                var o, r, s;
                if (this.element = e, this.version = n.version, this.defaultOptions.previewTemplate = this.defaultOptions.previewTemplate.replace(/\n*/g, ""), this.clickableElements = [], this.listeners = [], this.files = [], "string" == typeof this.element && (this.element = document.querySelector(this.element)), !this.element || null == this.element.nodeType) throw new Error("Invalid dropzone element.");
                if (this.element.dropzone) throw new Error("Dropzone already attached.");
                if (n.instances.push(this), this.element.dropzone = this, o = null != (s = n.optionsForElement(this.element)) ? s : {}, this.options = i({}, this.defaultOptions, o, null != t ? t : {}), this.options.forceFallback || !n.isBrowserSupported()) return this.options.fallback.call(this);
                if (null == this.options.url && (this.options.url = this.element.getAttribute("action")), !this.options.url) throw new Error("No URL provided.");
                if (this.options.acceptedFiles && this.options.acceptedMimeTypes) throw new Error("You can't provide both 'acceptedFiles' and 'acceptedMimeTypes'. 'acceptedMimeTypes' is deprecated.");
                this.options.acceptedMimeTypes && (this.options.acceptedFiles = this.options.acceptedMimeTypes, delete this.options.acceptedMimeTypes), this.options.method = this.options.method.toUpperCase(), (r = this.getExistingFallback()) && r.parentNode && r.parentNode.removeChild(r), this.options.previewsContainer !== !1 && (this.previewsContainer = this.options.previewsContainer ? n.getElement(this.options.previewsContainer, "previewsContainer") : this.element), this.options.clickable && (this.clickableElements = this.options.clickable === !0 ? [this.element] : n.getElements(this.options.clickable, "clickable")), this.init() }
            var i, o;
            return u(n, e), n.prototype.Emitter = t, n.prototype.events = ["drop", "dragstart", "dragend", "dragenter", "dragover", "dragleave", "addedfile", "removedfile", "thumbnail", "error", "errormultiple", "processing", "processingmultiple", "uploadprogress", "totaluploadprogress", "sending", "sendingmultiple", "success", "successmultiple", "canceled", "canceledmultiple", "complete", "completemultiple", "reset", "maxfilesexceeded", "maxfilesreached", "queuecomplete"], n.prototype.defaultOptions = {
                url: null,
                method: "post",
                withCredentials: !1,
                parallelUploads: 2,
                uploadMultiple: !1,
                maxFilesize: 256,
                paramName: "file",
                createImageThumbnails: !0,
                maxThumbnailFilesize: 10,
                thumbnailWidth: 120,
                thumbnailHeight: 120,
                filesizeBase: 1e3,
                maxFiles: null,
                filesizeBase: 1e3,
                params: {},
                clickable: !0,
                ignoreHiddenFiles: !0,
                acceptedFiles: null,
                acceptedMimeTypes: null,
                autoProcessQueue: !0,
                autoQueue: !0,
                addRemoveLinks: !1,
                previewsContainer: null,
                capture: null,
                dictDefaultMessage: "Drop files here to upload",
                dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
                dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
                dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
                dictInvalidFileType: "You can't upload files of this type.",
                dictResponseError: "Server responded with {{statusCode}} code.",
                dictCancelUpload: "Cancel upload",
                dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
                dictRemoveFile: "Remove file",
                dictRemoveFileConfirmation: null,
                dictMaxFilesExceeded: "You can not upload any more files.",
                accept: function(e, t) {
                    return t() },
                init: function() {
                    return s },
                forceFallback: !1,
                fallback: function() {
                    var e, t, i, o, r, s;
                    for (this.element.className = "" + this.element.className + " dz-browser-not-supported", s = this.element.getElementsByTagName("div"), o = 0, r = s.length; r > o; o++) e = s[o], /(^| )dz-message($| )/.test(e.className) && (t = e, e.className = "dz-message");
                    return t || (t = n.createElement('<div class="dz-message"><span></span></div>'), this.element.appendChild(t)), i = t.getElementsByTagName("span")[0], i && (i.textContent = this.options.dictFallbackMessage), this.element.appendChild(this.getFallbackForm()) },
                resize: function(e) {
                    var t, n, i;
                    return t = { srcX: 0, srcY: 0, srcWidth: e.width, srcHeight: e.height }, n = e.width / e.height, t.optWidth = this.options.thumbnailWidth, t.optHeight = this.options.thumbnailHeight, null == t.optWidth && null == t.optHeight ? (t.optWidth = t.srcWidth, t.optHeight = t.srcHeight) : null == t.optWidth ? t.optWidth = n * t.optHeight : null == t.optHeight && (t.optHeight = 1 / n * t.optWidth), i = t.optWidth / t.optHeight, e.height < t.optHeight || e.width < t.optWidth ? (t.trgHeight = t.srcHeight, t.trgWidth = t.srcWidth) : n > i ? (t.srcHeight = e.height, t.srcWidth = t.srcHeight * i) : (t.srcWidth = e.width, t.srcHeight = t.srcWidth / i), t.srcX = (e.width - t.srcWidth) / 2, t.srcY = (e.height - t.srcHeight) / 2, t },
                drop: function(e) {
                    return this.element.classList.remove("dz-drag-hover") },
                dragstart: s,
                dragend: function(e) {
                    return this.element.classList.remove("dz-drag-hover") },
                dragenter: function(e) {
                    return this.element.classList.add("dz-drag-hover") },
                dragover: function(e) {
                    return this.element.classList.add("dz-drag-hover") },
                dragleave: function(e) {
                    return this.element.classList.remove("dz-drag-hover") },
                paste: s,
                reset: function() {
                    return this.element.classList.remove("dz-started") },
                addedfile: function(e) {
                    var t, i, o, r, s, a, l, c, u, d, p, h, f;
                    if (this.element === this.previewsContainer && this.element.classList.add("dz-started"), this.previewsContainer) {
                        for (e.previewElement = n.createElement(this.options.previewTemplate.trim()), e.previewTemplate = e.previewElement, this.previewsContainer.appendChild(e.previewElement),
                            d = e.previewElement.querySelectorAll("[data-dz-name]"), r = 0, l = d.length; l > r; r++) t = d[r], t.textContent = e.name;
                        for (p = e.previewElement.querySelectorAll("[data-dz-size]"), s = 0, c = p.length; c > s; s++) t = p[s], t.innerHTML = this.filesize(e.size);
                        for (this.options.addRemoveLinks && (e._removeLink = n.createElement('<a class="dz-remove" href="javascript:undefined;" data-dz-remove>' + this.options.dictRemoveFile + "</a>"), e.previewElement.appendChild(e._removeLink)), i = function(t) {
                                return function(i) {
                                    return i.preventDefault(), i.stopPropagation(), e.status === n.UPLOADING ? n.confirm(t.options.dictCancelUploadConfirmation, function() {
                                        return t.removeFile(e) }) : t.options.dictRemoveFileConfirmation ? n.confirm(t.options.dictRemoveFileConfirmation, function() {
                                        return t.removeFile(e) }) : t.removeFile(e) } }(this), h = e.previewElement.querySelectorAll("[data-dz-remove]"), f = [], a = 0, u = h.length; u > a; a++) o = h[a], f.push(o.addEventListener("click", i));
                        return f
                    }
                },
                removedfile: function(e) {
                    var t;
                    return e.previewElement && null != (t = e.previewElement) && t.parentNode.removeChild(e.previewElement), this._updateMaxFilesReachedClass() },
                thumbnail: function(e, t) {
                    var n, i, o, r;
                    if (e.previewElement) {
                        for (e.previewElement.classList.remove("dz-file-preview"), r = e.previewElement.querySelectorAll("[data-dz-thumbnail]"), i = 0, o = r.length; o > i; i++) n = r[i], n.alt = e.name, n.src = t;
                        return setTimeout(function(t) {
                            return function() {
                                return e.previewElement.classList.add("dz-image-preview") } }(this), 1) } },
                error: function(e, t) {
                    var n, i, o, r, s;
                    if (e.previewElement) {
                        for (e.previewElement.classList.add("dz-error"), "String" != typeof t && t.error && (t = t.error), r = e.previewElement.querySelectorAll("[data-dz-errormessage]"), s = [], i = 0, o = r.length; o > i; i++) n = r[i], s.push(n.textContent = t);
                        return s } },
                errormultiple: s,
                processing: function(e) {
                    return e.previewElement && (e.previewElement.classList.add("dz-processing"), e._removeLink) ? e._removeLink.textContent = this.options.dictCancelUpload : void 0 },
                processingmultiple: s,
                uploadprogress: function(e, t, n) {
                    var i, o, r, s, a;
                    if (e.previewElement) {
                        for (s = e.previewElement.querySelectorAll("[data-dz-uploadprogress]"), a = [], o = 0, r = s.length; r > o; o++) i = s[o], a.push("PROGRESS" === i.nodeName ? i.value = t : i.style.width = "" + t + "%");
                        return a } },
                totaluploadprogress: s,
                sending: s,
                sendingmultiple: s,
                success: function(e) {
                    return e.previewElement ? e.previewElement.classList.add("dz-success") : void 0 },
                successmultiple: s,
                canceled: function(e) {
                    return this.emit("error", e, "Upload canceled.") },
                canceledmultiple: s,
                complete: function(e) {
                    return e._removeLink && (e._removeLink.textContent = this.options.dictRemoveFile), e.previewElement ? e.previewElement.classList.add("dz-complete") : void 0 },
                completemultiple: s,
                maxfilesexceeded: s,
                maxfilesreached: s,
                queuecomplete: s,
                previewTemplate: '<div class="dz-preview dz-file-preview">\n  <div class="dz-image"><img data-dz-thumbnail /></div>\n  <div class="dz-details">\n    <div class="dz-size"><span data-dz-size></span></div>\n    <div class="dz-filename"><span data-dz-name></span></div>\n  </div>\n  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\n  <div class="dz-error-message"><span data-dz-errormessage></span></div>\n  <div class="dz-success-mark">\n    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">\n      <title>Check</title>\n      <defs></defs>\n      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">\n        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>\n      </g>\n    </svg>\n  </div>\n  <div class="dz-error-mark">\n    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">\n      <title>Error</title>\n      <defs></defs>\n      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">\n        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">\n          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>\n        </g>\n      </g>\n    </svg>\n  </div>\n</div>'
            }, i = function() {
                var e, t, n, i, o, r, s;
                for (i = arguments[0], n = 2 <= arguments.length ? l.call(arguments, 1) : [], r = 0, s = n.length; s > r; r++) { t = n[r];
                    for (e in t) o = t[e], i[e] = o }
                return i }, n.prototype.getAcceptedFiles = function() {
                var e, t, n, i, o;
                for (i = this.files, o = [], t = 0, n = i.length; n > t; t++) e = i[t], e.accepted && o.push(e);
                return o }, n.prototype.getRejectedFiles = function() {
                var e, t, n, i, o;
                for (i = this.files, o = [], t = 0, n = i.length; n > t; t++) e = i[t], e.accepted || o.push(e);
                return o }, n.prototype.getFilesWithStatus = function(e) {
                var t, n, i, o, r;
                for (o = this.files, r = [], n = 0, i = o.length; i > n; n++) t = o[n], t.status === e && r.push(t);
                return r }, n.prototype.getQueuedFiles = function() {
                return this.getFilesWithStatus(n.QUEUED) }, n.prototype.getUploadingFiles = function() {
                return this.getFilesWithStatus(n.UPLOADING) }, n.prototype.getActiveFiles = function() {
                var e, t, i, o, r;
                for (o = this.files, r = [], t = 0, i = o.length; i > t; t++) e = o[t], (e.status === n.UPLOADING || e.status === n.QUEUED) && r.push(e);
                return r }, n.prototype.init = function() {
                var e, t, i, o, r, s, a;
                for ("form" === this.element.tagName && this.element.setAttribute("enctype", "multipart/form-data"), this.element.classList.contains("dropzone") && !this.element.querySelector(".dz-message") && this.element.appendChild(n.createElement('<div class="dz-default dz-message"><span>' + this.options.dictDefaultMessage + "</span></div>")), this.clickableElements.length && (i = function(e) {
                        return function() {
                            return e.hiddenFileInput && document.body.removeChild(e.hiddenFileInput), e.hiddenFileInput = document.createElement("input"), e.hiddenFileInput.setAttribute("type", "file"), (null == e.options.maxFiles || e.options.maxFiles > 1) && e.hiddenFileInput.setAttribute("multiple", "multiple"), e.hiddenFileInput.className = "dz-hidden-input", null != e.options.acceptedFiles && e.hiddenFileInput.setAttribute("accept", e.options.acceptedFiles), null != e.options.capture && e.hiddenFileInput.setAttribute("capture", e.options.capture), e.hiddenFileInput.style.visibility = "hidden", e.hiddenFileInput.style.position = "absolute", e.hiddenFileInput.style.top = "0", e.hiddenFileInput.style.left = "0", e.hiddenFileInput.style.height = "0", e.hiddenFileInput.style.width = "0", document.body.appendChild(e.hiddenFileInput), e.hiddenFileInput.addEventListener("change", function() {
                                var t, n, o, r;
                                if (n = e.hiddenFileInput.files, n.length)
                                    for (o = 0, r = n.length; r > o; o++) t = n[o], e.addFile(t);
                                return i() }) } }(this))(), this.URL = null != (s = window.URL) ? s : window.webkitURL, a = this.events, o = 0, r = a.length; r > o; o++) e = a[o], this.on(e, this.options[e]);
                return this.on("uploadprogress", function(e) {
                    return function() {
                        return e.updateTotalUploadProgress() } }(this)), this.on("removedfile", function(e) {
                    return function() {
                        return e.updateTotalUploadProgress() } }(this)), this.on("canceled", function(e) {
                    return function(t) {
                        return e.emit("complete", t) } }(this)), this.on("complete", function(e) {
                    return function(t) {
                        return 0 === e.getUploadingFiles().length && 0 === e.getQueuedFiles().length ? setTimeout(function() {
                            return e.emit("queuecomplete") }, 0) : void 0 } }(this)), t = function(e) {
                    return e.stopPropagation(), e.preventDefault ? e.preventDefault() : e.returnValue = !1 }, this.listeners = [{ element: this.element, events: { dragstart: function(e) {
                            return function(t) {
                                return e.emit("dragstart", t) } }(this), dragenter: function(e) {
                            return function(n) {
                                return t(n), e.emit("dragenter", n) } }(this), dragover: function(e) {
                            return function(n) {
                                var i;
                                try { i = n.dataTransfer.effectAllowed } catch (o) {}
                                return n.dataTransfer.dropEffect = "move" === i || "linkMove" === i ? "move" : "copy", t(n), e.emit("dragover", n) } }(this), dragleave: function(e) {
                            return function(t) {
                                return e.emit("dragleave", t) } }(this), drop: function(e) {
                            return function(n) {
                                return t(n), e.drop(n) } }(this), dragend: function(e) {
                            return function(t) {
                                return e.emit("dragend", t) } }(this) } }], this.clickableElements.forEach(function(e) {
                    return function(t) {
                        return e.listeners.push({ element: t, events: { click: function(i) {
                                    return t !== e.element || i.target === e.element || n.elementInside(i.target, e.element.querySelector(".dz-message")) ? e.hiddenFileInput.click() : void 0 } } }) } }(this)), this.enable(), this.options.init.call(this) }, n.prototype.destroy = function() {
                var e;
                return this.disable(), this.removeAllFiles(!0), (null != (e = this.hiddenFileInput) ? e.parentNode : void 0) && (this.hiddenFileInput.parentNode.removeChild(this.hiddenFileInput), this.hiddenFileInput = null), delete this.element.dropzone, n.instances.splice(n.instances.indexOf(this), 1) }, n.prototype.updateTotalUploadProgress = function() {
                var e, t, n, i, o, r, s, a;
                if (i = 0, n = 0, e = this.getActiveFiles(), e.length) {
                    for (a = this.getActiveFiles(), r = 0, s = a.length; s > r; r++) t = a[r], i += t.upload.bytesSent, n += t.upload.total;
                    o = 100 * i / n } else o = 100;
                return this.emit("totaluploadprogress", o, n, i) }, n.prototype._getParamName = function(e) {
                return "function" == typeof this.options.paramName ? this.options.paramName(e) : "" + this.options.paramName + (this.options.uploadMultiple ? "[" + e + "]" : "") }, n.prototype.getFallbackForm = function() {
                var e, t, i, o;
                return (e = this.getExistingFallback()) ? e : (i = '<div class="dz-fallback">', this.options.dictFallbackText && (i += "<p>" + this.options.dictFallbackText + "</p>"), i += '<input type="file" name="' + this._getParamName(0) + '" ' + (this.options.uploadMultiple ? 'multiple="multiple"' : void 0) + ' /><input type="submit" value="Upload!"></div>', t = n.createElement(i), "FORM" !== this.element.tagName ? (o = n.createElement('<form action="' + this.options.url + '" enctype="multipart/form-data" method="' + this.options.method + '"></form>'), o.appendChild(t)) : (this.element.setAttribute("enctype", "multipart/form-data"), this.element.setAttribute("method", this.options.method)), null != o ? o : t) }, n.prototype.getExistingFallback = function() {
                var e, t, n, i, o, r;
                for (t = function(e) {
                        var t, n, i;
                        for (n = 0, i = e.length; i > n; n++)
                            if (t = e[n], /(^| )fallback($| )/.test(t.className)) return t }, r = ["div", "form"], i = 0, o = r.length; o > i; i++)
                    if (n = r[i], e = t(this.element.getElementsByTagName(n))) return e }, n.prototype.setupEventListeners = function() {
                var e, t, n, i, o, r, s;
                for (r = this.listeners, s = [], i = 0, o = r.length; o > i; i++) e = r[i], s.push(function() {
                    var i, o;
                    i = e.events, o = [];
                    for (t in i) n = i[t], o.push(e.element.addEventListener(t, n, !1));
                    return o }());
                return s }, n.prototype.removeEventListeners = function() {
                var e, t, n, i, o, r, s;
                for (r = this.listeners, s = [], i = 0, o = r.length; o > i; i++) e = r[i], s.push(function() {
                    var i, o;
                    i = e.events, o = [];
                    for (t in i) n = i[t], o.push(e.element.removeEventListener(t, n, !1));
                    return o }());
                return s }, n.prototype.disable = function() {
                var e, t, n, i, o;
                for (this.clickableElements.forEach(function(e) {
                        return e.classList.remove("dz-clickable") }), this.removeEventListeners(), i = this.files, o = [], t = 0, n = i.length; n > t; t++) e = i[t], o.push(this.cancelUpload(e));
                return o }, n.prototype.enable = function() {
                return this.clickableElements.forEach(function(e) {
                    return e.classList.add("dz-clickable") }), this.setupEventListeners() }, n.prototype.filesize = function(e) {
                var t, n, i, o, r, s, a, l;
                for (s = ["TB", "GB", "MB", "KB", "b"], i = o = null, n = a = 0, l = s.length; l > a; n = ++a)
                    if (r = s[n], t = Math.pow(this.options.filesizeBase, 4 - n) / 10, e >= t) { i = e / Math.pow(this.options.filesizeBase, 4 - n), o = r;
                        break }
                return i = Math.round(10 * i) / 10, "<strong>" + i + "</strong> " + o }, n.prototype._updateMaxFilesReachedClass = function() {
                return null != this.options.maxFiles && this.getAcceptedFiles().length >= this.options.maxFiles ? (this.getAcceptedFiles().length === this.options.maxFiles && this.emit("maxfilesreached", this.files), this.element.classList.add("dz-max-files-reached")) : this.element.classList.remove("dz-max-files-reached") }, n.prototype.drop = function(e) {
                var t, n;
                e.dataTransfer && (this.emit("drop", e), t = e.dataTransfer.files, t.length && (n = e.dataTransfer.items, n && n.length && null != n[0].webkitGetAsEntry ? this._addFilesFromItems(n) : this.handleFiles(t))) }, n.prototype.paste = function(e) {
                var t, n;
                if (null != (null != e && null != (n = e.clipboardData) ? n.items : void 0)) return this.emit("paste", e), t = e.clipboardData.items, t.length ? this._addFilesFromItems(t) : void 0 }, n.prototype.handleFiles = function(e) {
                var t, n, i, o;
                for (o = [], n = 0, i = e.length; i > n; n++) t = e[n], o.push(this.addFile(t));
                return o }, n.prototype._addFilesFromItems = function(e) {
                var t, n, i, o, r;
                for (r = [], i = 0, o = e.length; o > i; i++) n = e[i], r.push(null != n.webkitGetAsEntry && (t = n.webkitGetAsEntry()) ? t.isFile ? this.addFile(n.getAsFile()) : t.isDirectory ? this._addFilesFromDirectory(t, t.name) : void 0 : null != n.getAsFile ? null == n.kind || "file" === n.kind ? this.addFile(n.getAsFile()) : void 0 : void 0);
                return r }, n.prototype._addFilesFromDirectory = function(e, t) {
                var n, i;
                return n = e.createReader(), i = function(e) {
                    return function(n) {
                        var i, o, r;
                        for (o = 0, r = n.length; r > o; o++) i = n[o], i.isFile ? i.file(function(n) {
                            return e.options.ignoreHiddenFiles && "." === n.name.substring(0, 1) ? void 0 : (n.fullPath = "" + t + "/" + n.name, e.addFile(n)) }) : i.isDirectory && e._addFilesFromDirectory(i, "" + t + "/" + i.name) } }(this), n.readEntries(i, function(e) {
                    return "undefined" != typeof console && null !== console && "function" == typeof console.log ? console.log(e) : void 0 }) }, n.prototype.accept = function(e, t) {
                return e.size > 1024 * this.options.maxFilesize * 1024 ? t(this.options.dictFileTooBig.replace("{{filesize}}", Math.round(e.size / 1024 / 10.24) / 100).replace("{{maxFilesize}}", this.options.maxFilesize)) : n.isValidFile(e, this.options.acceptedFiles) ? null != this.options.maxFiles && this.getAcceptedFiles().length >= this.options.maxFiles ? (t(this.options.dictMaxFilesExceeded.replace("{{maxFiles}}", this.options.maxFiles)), this.emit("maxfilesexceeded", e)) : this.options.accept.call(this, e, t) : t(this.options.dictInvalidFileType) }, n.prototype.addFile = function(e) {
                return e.upload = { progress: 0, total: e.size, bytesSent: 0 }, this.files.push(e), e.status = n.ADDED, this.emit("addedfile", e), this._enqueueThumbnail(e), this.accept(e, function(t) {
                    return function(n) {
                        return n ? (e.accepted = !1, t._errorProcessing([e], n)) : (e.accepted = !0, t.options.autoQueue && t.enqueueFile(e)), t._updateMaxFilesReachedClass() } }(this)) }, n.prototype.enqueueFiles = function(e) {
                var t, n, i;
                for (n = 0, i = e.length; i > n; n++) t = e[n], this.enqueueFile(t);
                return null }, n.prototype.enqueueFile = function(e) {
                if (e.status !== n.ADDED || e.accepted !== !0) throw new Error("This file can't be queued because it has already been processed or was rejected.");
                return e.status = n.QUEUED, this.options.autoProcessQueue ? setTimeout(function(e) {
                    return function() {
                        return e.processQueue() } }(this), 0) : void 0 }, n.prototype._thumbnailQueue = [], n.prototype._processingThumbnail = !1, n.prototype._enqueueThumbnail = function(e) {
                return this.options.createImageThumbnails && e.type.match(/image.*/) && e.size <= 1024 * this.options.maxThumbnailFilesize * 1024 ? (this._thumbnailQueue.push(e), setTimeout(function(e) {
                    return function() {
                        return e._processThumbnailQueue() } }(this), 0)) : void 0 }, n.prototype._processThumbnailQueue = function() {
                return this._processingThumbnail || 0 === this._thumbnailQueue.length ? void 0 : (this._processingThumbnail = !0, this.createThumbnail(this._thumbnailQueue.shift(), function(e) {
                    return function() {
                        return e._processingThumbnail = !1, e._processThumbnailQueue() } }(this))) }, n.prototype.removeFile = function(e) {
                return e.status === n.UPLOADING && this.cancelUpload(e), this.files = a(this.files, e), this.emit("removedfile", e), 0 === this.files.length ? this.emit("reset") : void 0 }, n.prototype.removeAllFiles = function(e) {
                var t, i, o, r;
                for (null == e && (e = !1), r = this.files.slice(), i = 0, o = r.length; o > i; i++) t = r[i], (t.status !== n.UPLOADING || e) && this.removeFile(t);
                return null }, n.prototype.createThumbnail = function(e, t) {
                var n;
                return n = new FileReader, n.onload = function(i) {
                    return function() {
                        return "image/svg+xml" === e.type ? (i.emit("thumbnail", e, n.result), void(null != t && t())) : i.createThumbnailFromUrl(e, n.result, t) } }(this), n.readAsDataURL(e) }, n.prototype.createThumbnailFromUrl = function(e, t, n) {
                var i;
                return i = document.createElement("img"), i.onload = function(t) {
                    return function() {
                        var o, s, a, l, c, u, d, p;
                        return e.width = i.width, e.height = i.height, a = t.options.resize.call(t, e), null == a.trgWidth && (a.trgWidth = a.optWidth), null == a.trgHeight && (a.trgHeight = a.optHeight), o = document.createElement("canvas"), s = o.getContext("2d"), o.width = a.trgWidth, o.height = a.trgHeight, r(s, i, null != (c = a.srcX) ? c : 0, null != (u = a.srcY) ? u : 0, a.srcWidth, a.srcHeight, null != (d = a.trgX) ? d : 0, null != (p = a.trgY) ? p : 0, a.trgWidth, a.trgHeight), l = o.toDataURL("image/png"), t.emit("thumbnail", e, l), null != n ? n() : void 0 } }(this), null != n && (i.onerror = n), i.src = t }, n.prototype.processQueue = function() {
                var e, t, n, i;
                if (t = this.options.parallelUploads, n = this.getUploadingFiles().length, e = n, !(n >= t) && (i = this.getQueuedFiles(), i.length > 0)) {
                    if (this.options.uploadMultiple) return this.processFiles(i.slice(0, t - n));
                    for (; t > e;) {
                        if (!i.length) return;
                        this.processFile(i.shift()), e++ } } }, n.prototype.processFile = function(e) {
                return this.processFiles([e]) }, n.prototype.processFiles = function(e) {
                var t, i, o;
                for (i = 0, o = e.length; o > i; i++) t = e[i], t.processing = !0, t.status = n.UPLOADING, this.emit("processing", t);
                return this.options.uploadMultiple && this.emit("processingmultiple", e), this.uploadFiles(e) }, n.prototype._getFilesWithXhr = function(e) {
                var t, n;
                return n = function() {
                    var n, i, o, r;
                    for (o = this.files, r = [], n = 0, i = o.length; i > n; n++) t = o[n], t.xhr === e && r.push(t);
                    return r }.call(this) }, n.prototype.cancelUpload = function(e) {
                var t, i, o, r, s, a, l;
                if (e.status === n.UPLOADING) {
                    for (i = this._getFilesWithXhr(e.xhr), o = 0, s = i.length; s > o; o++) t = i[o], t.status = n.CANCELED;
                    for (e.xhr.abort(), r = 0, a = i.length; a > r; r++) t = i[r], this.emit("canceled", t);
                    this.options.uploadMultiple && this.emit("canceledmultiple", i) } else((l = e.status) === n.ADDED || l === n.QUEUED) && (e.status = n.CANCELED, this.emit("canceled", e), this.options.uploadMultiple && this.emit("canceledmultiple", [e]));
                return this.options.autoProcessQueue ? this.processQueue() : void 0 }, o = function() {
                var e, t;
                return t = arguments[0], e = 2 <= arguments.length ? l.call(arguments, 1) : [], "function" == typeof t ? t.apply(this, e) : t }, n.prototype.uploadFile = function(e) {
                return this.uploadFiles([e]) }, n.prototype.uploadFiles = function(e) {
                var t, r, s, a, l, c, u, d, p, h, f, m, g, v, y, b, w, x, C, k, T, E, $, N, _, S, D, A, M, L, P, F, O, I;
                for (C = new XMLHttpRequest, k = 0, N = e.length; N > k; k++) t = e[k], t.xhr = C;
                m = o(this.options.method, e), w = o(this.options.url, e), C.open(m, w, !0), C.withCredentials = !!this.options.withCredentials, y = null, s = function(n) {
                    return function() {
                        var i, o, r;
                        for (r = [], i = 0, o = e.length; o > i; i++) t = e[i], r.push(n._errorProcessing(e, y || n.options.dictResponseError.replace("{{statusCode}}", C.status), C));
                        return r } }(this), b = function(n) {
                    return function(i) {
                        var o, r, s, a, l, c, u, d, p;
                        if (null != i)
                            for (r = 100 * i.loaded / i.total, s = 0, c = e.length; c > s; s++) t = e[s], t.upload = { progress: r, total: i.total, bytesSent: i.loaded };
                        else {
                            for (o = !0, r = 100, a = 0, u = e.length; u > a; a++) t = e[a], (100 !== t.upload.progress || t.upload.bytesSent !== t.upload.total) && (o = !1), t.upload.progress = r, t.upload.bytesSent = t.upload.total;
                            if (o) return }
                        for (p = [], l = 0, d = e.length; d > l; l++) t = e[l], p.push(n.emit("uploadprogress", t, r, t.upload.bytesSent));
                        return p } }(this), C.onload = function(t) {
                    return function(i) {
                        var o;
                        if (e[0].status !== n.CANCELED && 4 === C.readyState) {
                            if (y = C.responseText, C.getResponseHeader("content-type") && ~C.getResponseHeader("content-type").indexOf("application/json")) try { y = JSON.parse(y) } catch (r) { i = r, y = "Invalid JSON response from server." }
                            return b(), 200 <= (o = C.status) && 300 > o ? t._finished(e, y, i) : s() } } }(this), C.onerror = function(t) {
                    return function() {
                        return e[0].status !== n.CANCELED ? s() : void 0 } }(this), v = null != (M = C.upload) ? M : C, v.onprogress = b, c = { Accept: "application/json", "Cache-Control": "no-cache", "X-Requested-With": "XMLHttpRequest" }, this.options.headers && i(c, this.options.headers);
                for (a in c) l = c[a], C.setRequestHeader(a, l);
                if (r = new FormData, this.options.params) { L = this.options.params;
                    for (f in L) x = L[f], r.append(f, x) }
                for (T = 0, _ = e.length; _ > T; T++) t = e[T], this.emit("sending", t, C, r);
                if (this.options.uploadMultiple && this.emit("sendingmultiple", e, C, r), "FORM" === this.element.tagName)
                    for (P = this.element.querySelectorAll("input, textarea, select, button"), E = 0, S = P.length; S > E; E++)
                        if (d = P[E], p = d.getAttribute("name"), h = d.getAttribute("type"), "SELECT" === d.tagName && d.hasAttribute("multiple"))
                            for (F = d.options, $ = 0, D = F.length; D > $; $++) g = F[$], g.selected && r.append(p, g.value);
                        else(!h || "checkbox" !== (O = h.toLowerCase()) && "radio" !== O || d.checked) && r.append(p, d.value);
                for (u = A = 0, I = e.length - 1; I >= 0 ? I >= A : A >= I; u = I >= 0 ? ++A : --A) r.append(this._getParamName(u), e[u], e[u].name);
                return C.send(r) }, n.prototype._finished = function(e, t, i) {
                var o, r, s;
                for (r = 0, s = e.length; s > r; r++) o = e[r], o.status = n.SUCCESS, this.emit("success", o, t, i), this.emit("complete", o);
                return this.options.uploadMultiple && (this.emit("successmultiple", e, t, i), this.emit("completemultiple", e)), this.options.autoProcessQueue ? this.processQueue() : void 0 }, n.prototype._errorProcessing = function(e, t, i) {
                var o, r, s;
                for (r = 0, s = e.length; s > r; r++) o = e[r], o.status = n.ERROR, this.emit("error", o, t, i), this.emit("complete", o);
                return this.options.uploadMultiple && (this.emit("errormultiple", e, t, i), this.emit("completemultiple", e)), this.options.autoProcessQueue ? this.processQueue() : void 0 }, n
        }(t), e.version = "4.0.1", e.options = {}, e.optionsForElement = function(t) {
            return t.getAttribute("id") ? e.options[n(t.getAttribute("id"))] : void 0 }, e.instances = [], e.forElement = function(e) {
            if ("string" == typeof e && (e = document.querySelector(e)), null == (null != e ? e.dropzone : void 0)) throw new Error("No Dropzone found for given element. This is probably because you're trying to access it before Dropzone had the time to initialize. Use the `init` option to setup any additional observers on your Dropzone.");
            return e.dropzone }, e.autoDiscover = !0, e.discover = function() {
            var t, n, i, o, r, s;
            for (document.querySelectorAll ? i = document.querySelectorAll(".dropzone") : (i = [], t = function(e) {
                    var t, n, o, r;
                    for (r = [], n = 0, o = e.length; o > n; n++) t = e[n], r.push(/(^| )dropzone($| )/.test(t.className) ? i.push(t) : void 0);
                    return r }, t(document.getElementsByTagName("div")), t(document.getElementsByTagName("form"))), s = [], o = 0, r = i.length; r > o; o++) n = i[o], s.push(e.optionsForElement(n) !== !1 ? new e(n) : void 0);
            return s }, e.blacklistedBrowsers = [/opera.*Macintosh.*version\/12/i], e.isBrowserSupported = function() {
            var t, n, i, o, r;
            if (t = !0, window.File && window.FileReader && window.FileList && window.Blob && window.FormData && document.querySelector)
                if ("classList" in document.createElement("a"))
                    for (r = e.blacklistedBrowsers, i = 0, o = r.length; o > i; i++) n = r[i], n.test(navigator.userAgent) && (t = !1);
                else t = !1;
            else t = !1;
            return t }, a = function(e, t) {
            var n, i, o, r;
            for (r = [], i = 0, o = e.length; o > i; i++) n = e[i], n !== t && r.push(n);
            return r }, n = function(e) {
            return e.replace(/[\-_](\w)/g, function(e) {
                return e.charAt(1).toUpperCase() }) }, e.createElement = function(e) {
            var t;
            return t = document.createElement("div"), t.innerHTML = e, t.childNodes[0] }, e.elementInside = function(e, t) {
            if (e === t) return !0;
            for (; e = e.parentNode;)
                if (e === t) return !0;
            return !1 }, e.getElement = function(e, t) {
            var n;
            if ("string" == typeof e ? n = document.querySelector(e) : null != e.nodeType && (n = e), null == n) throw new Error("Invalid `" + t + "` option provided. Please provide a CSS selector or a plain HTML element.");
            return n }, e.getElements = function(e, t) {
            var n, i, o, r, s, a, l, c;
            if (e instanceof Array) { o = [];
                try {
                    for (r = 0, a = e.length; a > r; r++) i = e[r], o.push(this.getElement(i, t)) } catch (u) { n = u, o = null } } else if ("string" == typeof e)
                for (o = [], c = document.querySelectorAll(e), s = 0, l = c.length; l > s; s++) i = c[s], o.push(i);
            else null != e.nodeType && (o = [e]);
            if (null == o || !o.length) throw new Error("Invalid `" + t + "` option provided. Please provide a CSS selector, a plain HTML element or a list of those.");
            return o }, e.confirm = function(e, t, n) {
            return window.confirm(e) ? t() : null != n ? n() : void 0 }, e.isValidFile = function(e, t) {
            var n, i, o, r, s;
            if (!t) return !0;
            for (t = t.split(","), i = e.type, n = i.replace(/\/.*$/, ""), r = 0, s = t.length; s > r; r++)
                if (o = t[r], o = o.trim(), "." === o.charAt(0)) {
                    if (-1 !== e.name.toLowerCase().indexOf(o.toLowerCase(), e.name.length - o.length)) return !0 } else if (/\/\*$/.test(o)) {
                if (n === o.replace(/\/.*$/, "")) return !0 } else if (i === o) return !0;
            return !1 }, "undefined" != typeof jQuery && null !== jQuery && (jQuery.fn.dropzone = function(t) {
            return this.each(function() {
                return new e(this, t) }) }), "undefined" != typeof module && null !== module ? module.exports = e : window.Dropzone = e, e.ADDED = "added", e.QUEUED = "queued", e.ACCEPTED = e.QUEUED, e.UPLOADING = "uploading", e.PROCESSING = e.UPLOADING, e.CANCELED = "canceled", e.ERROR = "error", e.SUCCESS = "success", o = function(e) {
            var t, n, i, o, r, s, a, l, c, u;
            for (a = e.naturalWidth, s = e.naturalHeight, n = document.createElement("canvas"), n.width = 1, n.height = s, i = n.getContext("2d"), i.drawImage(e, 0, 0), o = i.getImageData(0, 0, 1, s).data, u = 0, r = s, l = s; l > u;) t = o[4 * (l - 1) + 3], 0 === t ? r = l : u = l, l = r + u >> 1;
            return c = l / s, 0 === c ? 1 : c }, r = function(e, t, n, i, r, s, a, l, c, u) {
            var d;
            return d = o(t), e.drawImage(t, n, i, r, s, a, l, c, u / d) }, i = function(e, t) {
            var n, i, o, r, s, a, l, c, u;
            if (o = !1, u = !0, i = e.document, c = i.documentElement, n = i.addEventListener ? "addEventListener" : "attachEvent", l = i.addEventListener ? "removeEventListener" : "detachEvent", a = i.addEventListener ? "" : "on", r = function(n) {
                    return "readystatechange" !== n.type || "complete" === i.readyState ? (("load" === n.type ? e : i)[l](a + n.type, r, !1), !o && (o = !0) ? t.call(e, n.type || n) : void 0) : void 0 }, s = function() {
                    var e;
                    try { c.doScroll("left") } catch (t) {
                        return e = t, void setTimeout(s, 50) }
                    return r("poll") }, "complete" !== i.readyState) {
                if (i.createEventObject && c.doScroll) {
                    try { u = !e.frameElement } catch (d) {}
                    u && s() }
                return i[n](a + "DOMContentLoaded", r, !1), i[n](a + "readystatechange", r, !1), e[n](a + "load", r, !1) } }, e._autoDiscoverFunction = function() {
            return e.autoDiscover ? e.discover() : void 0 }, i(window, e._autoDiscoverFunction)
    }.call(this),
    function(e) { "function" == typeof define && define.amd && define.amd.jQuery ? define(["jquery"], e) : e(jQuery) }(function(e) {
        "use strict";

        function t(t) {
            return !t || void 0 !== t.allowPageScroll || void 0 === t.swipe && void 0 === t.swipeStatus || (t.allowPageScroll = c), void 0 !== t.click && void 0 === t.tap && (t.tap = t.click), t || (t = {}), t = e.extend({}, e.fn.swipe.defaults, t), this.each(function() {
                var i = e(this),
                    o = i.data(N);
                o || (o = new n(this, t), i.data(N, o)) }) }

        function n(t, n) {
            function _(t) {
                if (!(ce() || e(t.target).closest(n.excludedElements, qe).length > 0)) {
                    var i, o = t.originalEvent ? t.originalEvent : t,
                        r = T ? o.touches[0] : o;
                    return Ue = w, T ? Xe = o.touches.length : t.preventDefault(), Fe = 0, Oe = null, Re = null, Ie = 0, He = 0, je = 0, ze = 1, We = 0, Ye = fe(), Be = ve(), ae(), !T || Xe === n.fingers || n.fingers === y || B() ? (de(0, r), Qe = $e(), 2 == Xe && (de(1, o.touches[1]), He = je = we(Ye[0].start, Ye[1].start)), (n.swipeStatus || n.pinchStatus) && (i = F(o, Ue))) : i = !1, i === !1 ? (Ue = k, F(o, Ue), i) : (n.hold && (et = setTimeout(e.proxy(function() { qe.trigger("hold", [o.target]), n.hold && (i = n.hold.call(qe, o, o.target)) }, this), n.longTapThreshold)), ue(!0), null) } }

            function S(e) {
                var t = e.originalEvent ? e.originalEvent : e;
                if (Ue !== C && Ue !== k && !le()) {
                    var i, o = T ? t.touches[0] : t,
                        r = pe(o);
                    if (Ke = $e(), T && (Xe = t.touches.length), n.hold && clearTimeout(et), Ue = x, 2 == Xe && (0 == He ? (de(1, t.touches[1]), He = je = we(Ye[0].start, Ye[1].start)) : (pe(t.touches[1]), je = we(Ye[0].end, Ye[1].end), Re = Ce(Ye[0].end, Ye[1].end)), ze = xe(He, je), We = Math.abs(He - je)), Xe === n.fingers || n.fingers === y || !T || B()) {
                        if (Oe = Ee(r.start, r.end), W(e, Oe), Fe = ke(r.start, r.end), Ie = be(), me(Oe, Fe), (n.swipeStatus || n.pinchStatus) && (i = F(t, Ue)), !n.triggerOnTouchEnd || n.triggerOnTouchLeave) {
                            var s = !0;
                            if (n.triggerOnTouchLeave) {
                                var a = Ne(this);
                                s = _e(r.end, a) }!n.triggerOnTouchEnd && s ? Ue = P(x) : n.triggerOnTouchLeave && !s && (Ue = P(C)), (Ue == k || Ue == C) && F(t, Ue) } } else Ue = k, F(t, Ue);
                    i === !1 && (Ue = k, F(t, Ue)) } }

            function D(e) {
                var t = e.originalEvent;
                return T && t.touches.length > 0 ? (se(), !0) : (le() && (Xe = Ve), Ke = $e(), Ie = be(), H() || !I() ? (Ue = k, F(t, Ue)) : n.triggerOnTouchEnd || 0 == n.triggerOnTouchEnd && Ue === x ? (e.preventDefault(), Ue = C, F(t, Ue)) : !n.triggerOnTouchEnd && G() ? (Ue = C, O(t, Ue, h)) : Ue === x && (Ue = k, F(t, Ue)), ue(!1), null) }

            function A() { Xe = 0, Ke = 0, Qe = 0, He = 0, je = 0, ze = 1, ae(), ue(!1) }

            function M(e) {
                var t = e.originalEvent;
                n.triggerOnTouchLeave && (Ue = P(C), F(t, Ue)) }

            function L() { qe.unbind(De, _), qe.unbind(Pe, A), qe.unbind(Ae, S), qe.unbind(Me, D), Le && qe.unbind(Le, M), ue(!1) }

            function P(e) {
                var t = e,
                    i = z(),
                    o = I(),
                    r = H();
                return !i || r ? t = k : !o || e != x || n.triggerOnTouchEnd && !n.triggerOnTouchLeave ? !o && e == C && n.triggerOnTouchLeave && (t = k) : t = C, t }

            function F(e, t) {
                var n = void 0;
                return Y() || X() || q() || B() ? ((Y() || X()) && (n = O(e, t, d)), (q() || B()) && n !== !1 && (n = O(e, t, p))) : oe() && n !== !1 ? n = O(e, t, f) : re() && n !== !1 ? n = O(e, t, m) : ie() && n !== !1 && (n = O(e, t, h)), t === k && A(e), t === C && (T ? 0 == e.touches.length && A(e) : A(e)), n }

            function O(t, c, u) {
                var g = void 0;
                if (u == d) {
                    if (qe.trigger("swipeStatus", [c, Oe || null, Fe || 0, Ie || 0, Xe, Ye]), n.swipeStatus && (g = n.swipeStatus.call(qe, t, c, Oe || null, Fe || 0, Ie || 0, Xe, Ye), g === !1)) return !1;
                    if (c == C && U()) {
                        if (qe.trigger("swipe", [Oe, Fe, Ie, Xe, Ye]), n.swipe && (g = n.swipe.call(qe, t, Oe, Fe, Ie, Xe, Ye), g === !1)) return !1;
                        switch (Oe) {
                            case i:
                                qe.trigger("swipeLeft", [Oe, Fe, Ie, Xe, Ye]), n.swipeLeft && (g = n.swipeLeft.call(qe, t, Oe, Fe, Ie, Xe, Ye));
                                break;
                            case o:
                                qe.trigger("swipeRight", [Oe, Fe, Ie, Xe, Ye]), n.swipeRight && (g = n.swipeRight.call(qe, t, Oe, Fe, Ie, Xe, Ye));
                                break;
                            case r:
                                qe.trigger("swipeUp", [Oe, Fe, Ie, Xe, Ye]), n.swipeUp && (g = n.swipeUp.call(qe, t, Oe, Fe, Ie, Xe, Ye));
                                break;
                            case s:
                                qe.trigger("swipeDown", [Oe, Fe, Ie, Xe, Ye]), n.swipeDown && (g = n.swipeDown.call(qe, t, Oe, Fe, Ie, Xe, Ye)) } } }
                if (u == p) {
                    if (qe.trigger("pinchStatus", [c, Re || null, We || 0, Ie || 0, Xe, ze, Ye]), n.pinchStatus && (g = n.pinchStatus.call(qe, t, c, Re || null, We || 0, Ie || 0, Xe, ze, Ye), g === !1)) return !1;
                    if (c == C && R()) switch (Re) {
                        case a:
                            qe.trigger("pinchIn", [Re || null, We || 0, Ie || 0, Xe, ze, Ye]), n.pinchIn && (g = n.pinchIn.call(qe, t, Re || null, We || 0, Ie || 0, Xe, ze, Ye));
                            break;
                        case l:
                            qe.trigger("pinchOut", [Re || null, We || 0, Ie || 0, Xe, ze, Ye]), n.pinchOut && (g = n.pinchOut.call(qe, t, Re || null, We || 0, Ie || 0, Xe, ze, Ye)) } }
                return u == h ? (c === k || c === C) && (clearTimeout(Ze), clearTimeout(et), V() && !ee() ? (Je = $e(), Ze = setTimeout(e.proxy(function() { Je = null, qe.trigger("tap", [t.target]), n.tap && (g = n.tap.call(qe, t, t.target)) }, this), n.doubleTapThreshold)) : (Je = null, qe.trigger("tap", [t.target]), n.tap && (g = n.tap.call(qe, t, t.target)))) : u == f ? (c === k || c === C) && (clearTimeout(Ze), Je = null, qe.trigger("doubletap", [t.target]), n.doubleTap && (g = n.doubleTap.call(qe, t, t.target))) : u == m && (c === k || c === C) && (clearTimeout(Ze), Je = null, qe.trigger("longtap", [t.target]), n.longTap && (g = n.longTap.call(qe, t, t.target))), g }

            function I() {
                var e = !0;
                return null !== n.threshold && (e = Fe >= n.threshold), e }

            function H() {
                var e = !1;
                return null !== n.cancelThreshold && null !== Oe && (e = ge(Oe) - Fe >= n.cancelThreshold), e }

            function j() {
                return null !== n.pinchThreshold ? We >= n.pinchThreshold : !0 }

            function z() {
                var e;
                return e = n.maxTimeThreshold && Ie >= n.maxTimeThreshold ? !1 : !0 }

            function W(e, t) {
                if (n.preventDefaultEvents !== !1)
                    if (n.allowPageScroll === c) e.preventDefault();
                    else {
                        var a = n.allowPageScroll === u;
                        switch (t) {
                            case i:
                                (n.swipeLeft && a || !a && n.allowPageScroll != g) && e.preventDefault();
                                break;
                            case o:
                                (n.swipeRight && a || !a && n.allowPageScroll != g) && e.preventDefault();
                                break;
                            case r:
                                (n.swipeUp && a || !a && n.allowPageScroll != v) && e.preventDefault();
                                break;
                            case s:
                                (n.swipeDown && a || !a && n.allowPageScroll != v) && e.preventDefault() } } }

            function R() {
                var e = Q(),
                    t = K(),
                    n = j();
                return e && t && n }

            function B() {
                return !!(n.pinchStatus || n.pinchIn || n.pinchOut) }

            function q() {
                return !(!R() || !B()) }

            function U() {
                var e = z(),
                    t = I(),
                    n = Q(),
                    i = K(),
                    o = H(),
                    r = !o && i && n && t && e;

                return r
            }

            function X() {
                return !!(n.swipe || n.swipeStatus || n.swipeLeft || n.swipeRight || n.swipeUp || n.swipeDown) }

            function Y() {
                return !(!U() || !X()) }

            function Q() {
                return Xe === n.fingers || n.fingers === y || !T }

            function K() {
                return 0 !== Ye[0].end.x }

            function G() {
                return !!n.tap }

            function V() {
                return !!n.doubleTap }

            function J() {
                return !!n.longTap }

            function Z() {
                if (null == Je) return !1;
                var e = $e();
                return V() && e - Je <= n.doubleTapThreshold }

            function ee() {
                return Z() }

            function te() {
                return (1 === Xe || !T) && (isNaN(Fe) || Fe < n.threshold) }

            function ne() {
                return Ie > n.longTapThreshold && b > Fe }

            function ie() {
                return !(!te() || !G()) }

            function oe() {
                return !(!Z() || !V()) }

            function re() {
                return !(!ne() || !J()) }

            function se() { Ge = $e(), Ve = event.touches.length + 1 }

            function ae() { Ge = 0, Ve = 0 }

            function le() {
                var e = !1;
                if (Ge) {
                    var t = $e() - Ge;
                    t <= n.fingerReleaseThreshold && (e = !0) }
                return e }

            function ce() {
                return !(qe.data(N + "_intouch") !== !0) }

            function ue(e) { e === !0 ? (qe.bind(Ae, S), qe.bind(Me, D), Le && qe.bind(Le, M)) : (qe.unbind(Ae, S, !1), qe.unbind(Me, D, !1), Le && qe.unbind(Le, M, !1)), qe.data(N + "_intouch", e === !0) }

            function de(e, t) {
                var n = void 0 !== t.identifier ? t.identifier : 0;
                return Ye[e].identifier = n, Ye[e].start.x = Ye[e].end.x = t.pageX || t.clientX, Ye[e].start.y = Ye[e].end.y = t.pageY || t.clientY, Ye[e] }

            function pe(e) {
                var t = void 0 !== e.identifier ? e.identifier : 0,
                    n = he(t);
                return n.end.x = e.pageX || e.clientX, n.end.y = e.pageY || e.clientY, n }

            function he(e) {
                for (var t = 0; t < Ye.length; t++)
                    if (Ye[t].identifier == e) return Ye[t] }

            function fe() {
                for (var e = [], t = 0; 5 >= t; t++) e.push({ start: { x: 0, y: 0 }, end: { x: 0, y: 0 }, identifier: 0 });
                return e }

            function me(e, t) { t = Math.max(t, ge(e)), Be[e].distance = t }

            function ge(e) {
                return Be[e] ? Be[e].distance : void 0 }

            function ve() {
                var e = {};
                return e[i] = ye(i), e[o] = ye(o), e[r] = ye(r), e[s] = ye(s), e }

            function ye(e) {
                return { direction: e, distance: 0 } }

            function be() {
                return Ke - Qe }

            function we(e, t) {
                var n = Math.abs(e.x - t.x),
                    i = Math.abs(e.y - t.y);
                return Math.round(Math.sqrt(n * n + i * i)) }

            function xe(e, t) {
                var n = t / e * 1;
                return n.toFixed(2) }

            function Ce() {
                return 1 > ze ? l : a }

            function ke(e, t) {
                return Math.round(Math.sqrt(Math.pow(t.x - e.x, 2) + Math.pow(t.y - e.y, 2))) }

            function Te(e, t) {
                var n = e.x - t.x,
                    i = t.y - e.y,
                    o = Math.atan2(i, n),
                    r = Math.round(180 * o / Math.PI);
                return 0 > r && (r = 360 - Math.abs(r)), r }

            function Ee(e, t) {
                var n = Te(e, t);
                return 45 >= n && n >= 0 ? i : 360 >= n && n >= 315 ? i : n >= 135 && 225 >= n ? o : n > 45 && 135 > n ? s : r }

            function $e() {
                var e = new Date;
                return e.getTime() }

            function Ne(t) { t = e(t);
                var n = t.offset(),
                    i = { left: n.left, right: n.left + t.outerWidth(), top: n.top, bottom: n.top + t.outerHeight() };
                return i }

            function _e(e, t) {
                return e.x > t.left && e.x < t.right && e.y > t.top && e.y < t.bottom }
            var Se = T || $ || !n.fallbackToMouseEvents,
                De = Se ? $ ? E ? "MSPointerDown" : "pointerdown" : "touchstart" : "mousedown",
                Ae = Se ? $ ? E ? "MSPointerMove" : "pointermove" : "touchmove" : "mousemove",
                Me = Se ? $ ? E ? "MSPointerUp" : "pointerup" : "touchend" : "mouseup",
                Le = Se ? null : "mouseleave",
                Pe = $ ? E ? "MSPointerCancel" : "pointercancel" : "touchcancel",
                Fe = 0,
                Oe = null,
                Ie = 0,
                He = 0,
                je = 0,
                ze = 1,
                We = 0,
                Re = 0,
                Be = null,
                qe = e(t),
                Ue = "start",
                Xe = 0,
                Ye = null,
                Qe = 0,
                Ke = 0,
                Ge = 0,
                Ve = 0,
                Je = 0,
                Ze = null,
                et = null;
            try { qe.bind(De, _), qe.bind(Pe, A) } catch (tt) { e.error("events not supported " + De + "," + Pe + " on jQuery.swipe") }
            this.enable = function() {
                return qe.bind(De, _), qe.bind(Pe, A), qe }, this.disable = function() {
                return L(), qe }, this.destroy = function() { L(), qe.data(N, null), qe = null }, this.option = function(t, i) {
                if (void 0 !== n[t]) {
                    if (void 0 === i) return n[t];
                    n[t] = i } else e.error("Option " + t + " does not exist on jQuery.swipe.options");
                return null }
        }
        var i = "left",
            o = "right",
            r = "up",
            s = "down",
            a = "in",
            l = "out",
            c = "none",
            u = "auto",
            d = "swipe",
            p = "pinch",
            h = "tap",
            f = "doubletap",
            m = "longtap",
            g = "horizontal",
            v = "vertical",
            y = "all",
            b = 10,
            w = "start",
            x = "move",
            C = "end",
            k = "cancel",
            T = "ontouchstart" in window,
            E = window.navigator.msPointerEnabled && !window.navigator.pointerEnabled,
            $ = window.navigator.pointerEnabled || window.navigator.msPointerEnabled,
            N = "TouchSwipe",
            _ = { fingers: 1, threshold: 75, cancelThreshold: null, pinchThreshold: 20, maxTimeThreshold: null, fingerReleaseThreshold: 250, longTapThreshold: 500, doubleTapThreshold: 200, swipe: null, swipeLeft: null, swipeRight: null, swipeUp: null, swipeDown: null, swipeStatus: null, pinchIn: null, pinchOut: null, pinchStatus: null, click: null, tap: null, doubleTap: null, longTap: null, hold: null, triggerOnTouchEnd: !0, triggerOnTouchLeave: !1, allowPageScroll: "auto", fallbackToMouseEvents: !0, excludedElements: "label, button, input, select, textarea, a, .noSwipe", preventDefaultEvents: !0 };
        e.fn.swipe = function(n) {
            var i = e(this),
                o = i.data(N);
            if (o && "string" == typeof n) {
                if (o[n]) return o[n].apply(this, Array.prototype.slice.call(arguments, 1));
                e.error("Method " + n + " does not exist on jQuery.swipe") } else if (!(o || "object" != typeof n && n)) return t.apply(this, arguments);
            return i }, e.fn.swipe.defaults = _, e.fn.swipe.phases = { PHASE_START: w, PHASE_MOVE: x, PHASE_END: C, PHASE_CANCEL: k }, e.fn.swipe.directions = { LEFT: i, RIGHT: o, UP: r, DOWN: s, IN: a, OUT: l }, e.fn.swipe.pageScroll = { NONE: c, HORIZONTAL: g, VERTICAL: v, AUTO: u }, e.fn.swipe.fingers = { ONE: 1, TWO: 2, THREE: 3, ALL: y }
    }), ! function(e) { "use strict";

        function t(e) {
            return function(t) {
                return t && this === t.target ? e.apply(this, arguments) : void 0 } }
        var n = function(e, t) { this.init(e, t) };
        n.prototype = { constructor: n, init: function(t, n) {
                if (this.$element = e(t), this.options = e.extend({}, e.fn.modalmanager.defaults, this.$element.data(), "object" == typeof n && n), this.stack = [], this.backdropCount = 0, this.options.resize) {
                    var i, o = this;
                    e(window).on("resize.modal", function() { i && clearTimeout(i), i = setTimeout(function() {
                            for (var e = 0; e < o.stack.length; e++) o.stack[e].isShown && o.stack[e].layout() }, 10) }) } }, createModal: function(t, n) { e(t).modal(e.extend({ manager: this }, n)) }, appendModal: function(n) { this.stack.push(n);
                var i = this;
                n.$element.on("show.modalmanager", t(function(t) {
                    var o = function() { n.isShown = !0;
                        var t = e.support.transition && n.$element.hasClass("fade");
                        i.$element.toggleClass("modal-open", i.hasOpenModal()).toggleClass("page-overflow", e(window).height() < i.$element.height()), n.$parent = n.$element.parent(), n.$container = i.createContainer(n), n.$element.appendTo(n.$container), i.backdrop(n, function() { n.$element.show(), t && n.$element[0].offsetWidth, n.layout(), n.$element.addClass("in").attr("aria-hidden", !1);
                            var o = function() { i.setFocus(), n.$element.trigger("shown") };
                            t ? n.$element.one(e.support.transition.end, o) : o() }) };
                    n.options.replace ? i.replace(o) : o() })), n.$element.on("hidden.modalmanager", t(function(t) {
                    if (i.backdrop(n), n.$element.parent().length)
                        if (n.$backdrop) {
                            var o = e.support.transition && n.$element.hasClass("fade");
                            o && n.$element[0].offsetWidth, e.support.transition && n.$element.hasClass("fade") ? n.$backdrop.one(e.support.transition.end, function() { n.destroy() }) : n.destroy() } else n.destroy();
                    else i.destroyModal(n) })), n.$element.on("destroyed.modalmanager", t(function(e) { i.destroyModal(n) })) }, getOpenModals: function() {
                for (var e = [], t = 0; t < this.stack.length; t++) this.stack[t].isShown && e.push(this.stack[t]);
                return e }, hasOpenModal: function() {
                return this.getOpenModals().length > 0 }, setFocus: function() {
                for (var e, t = 0; t < this.stack.length; t++) this.stack[t].isShown && (e = this.stack[t]);
                e && e.focus() }, destroyModal: function(e) { e.$element.off(".modalmanager"), e.$backdrop && this.removeBackdrop(e), this.stack.splice(this.getIndexOfModal(e), 1);
                var t = this.hasOpenModal();
                this.$element.toggleClass("modal-open", t), t || this.$element.removeClass("page-overflow"), this.removeContainer(e), this.setFocus() }, getModalAt: function(e) {
                return this.stack[e] }, getIndexOfModal: function(e) {
                for (var t = 0; t < this.stack.length; t++)
                    if (e === this.stack[t]) return t }, replace: function(n) {
                for (var i, o = 0; o < this.stack.length; o++) this.stack[o].isShown && (i = this.stack[o]);
                i ? (this.$backdropHandle = i.$backdrop, i.$backdrop = null, n && i.$element.one("hidden", t(e.proxy(n, this))), i.hide()) : n && n() }, removeBackdrop: function(e) { e.$backdrop.remove(), e.$backdrop = null }, createBackdrop: function(t, n) {
                var i;
                return this.$backdropHandle ? (i = this.$backdropHandle, i.off(".modalmanager"), this.$backdropHandle = null, this.isLoading && this.removeSpinner()) : i = e(n).addClass(t).appendTo(this.$element), i }, removeContainer: function(e) { e.$container.remove(), e.$container = null }, createContainer: function(n) {
                var o;
                return o = e('<div class="modal-scrollable">').css("z-index", i("modal", this.getOpenModals().length)).appendTo(this.$element), n && "static" != n.options.backdrop ? o.on("click.modal", t(function(e) { n.hide() })) : n && o.on("click.modal", t(function(e) { n.attention() })), o }, backdrop: function(t, n) {
                var o = t.$element.hasClass("fade") ? "fade" : "",
                    r = t.options.backdrop && this.backdropCount < this.options.backdropLimit;
                if (t.isShown && r) {
                    var s = e.support.transition && o && !this.$backdropHandle;
                    t.$backdrop = this.createBackdrop(o, t.options.backdropTemplate), t.$backdrop.css("z-index", i("backdrop", this.getOpenModals().length)), s && t.$backdrop[0].offsetWidth, t.$backdrop.addClass("in"), this.backdropCount += 1, s ? t.$backdrop.one(e.support.transition.end, n) : n() } else if (!t.isShown && t.$backdrop) { t.$backdrop.removeClass("in"), this.backdropCount -= 1;
                    var a = this;
                    e.support.transition && t.$element.hasClass("fade") ? t.$backdrop.one(e.support.transition.end, function() { a.removeBackdrop(t) }) : a.removeBackdrop(t) } else n && n() }, removeSpinner: function() { this.$spinner && this.$spinner.remove(), this.$spinner = null, this.isLoading = !1 }, removeLoading: function() { this.$backdropHandle && this.$backdropHandle.remove(), this.$backdropHandle = null, this.removeSpinner() }, loading: function(t) {
                if (t = t || function() {}, this.$element.toggleClass("modal-open", !this.isLoading || this.hasOpenModal()).toggleClass("page-overflow", e(window).height() < this.$element.height()), this.isLoading)
                    if (this.isLoading && this.$backdropHandle) { this.$backdropHandle.removeClass("in");
                        var n = this;
                        e.support.transition ? this.$backdropHandle.one(e.support.transition.end, function() { n.removeLoading() }) : n.removeLoading() } else t && t(this.isLoading);
                else { this.$backdropHandle = this.createBackdrop("fade", this.options.backdropTemplate), this.$backdropHandle[0].offsetWidth;
                    var o = this.getOpenModals();
                    this.$backdropHandle.css("z-index", i("backdrop", o.length + 1)).addClass("in");
                    var r = e(this.options.spinner).css("z-index", i("modal", o.length + 1)).appendTo(this.$element).addClass("in");
                    this.$spinner = e(this.createContainer()).append(r).on("click.modalmanager", e.proxy(this.loading, this)), this.isLoading = !0, e.support.transition ? this.$backdropHandle.one(e.support.transition.end, t) : t() } } };
        var i = function() {
            var t, n = {};
            return function(i, o) {
                if ("undefined" == typeof t) {
                    var r = e('<div class="modal hide" />').appendTo("body"),
                        s = e('<div class="modal-backdrop hide" />').appendTo("body");
                    n.modal = +r.css("z-index"), n.backdrop = +s.css("z-index"), t = n.modal - n.backdrop, r.remove(), s.remove(), s = r = null }
                return n[i] + t * o } }();
        e.fn.modalmanager = function(t, i) {
            return this.each(function() {
                var o = e(this),
                    r = o.data("modalmanager");
                r || o.data("modalmanager", r = new n(this, t)), "string" == typeof t && r[t].apply(r, [].concat(i)) }) }, e.fn.modalmanager.defaults = { backdropLimit: 999, resize: !0, spinner: '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div>', backdropTemplate: '<div class="modal-backdrop" />' }, e.fn.modalmanager.Constructor = n, e(function() { e(document).off("show.bs.modal").off("hidden.bs.modal") }) }(jQuery), ! function(e) { "use strict";
        var t = function(e, t) { this.init(e, t) };
        t.prototype = { constructor: t, init: function(t, n) {
                var i = this;
                this.options = n, this.$element = e(t).delegate('[data-dismiss="modal"]', "click.dismiss.modal", e.proxy(this.hide, this)), this.options.remote && this.$element.find(".modal-body").load(this.options.remote, function() {
                    var t = e.Event("loaded");
                    i.$element.trigger(t) });
                var o = "function" == typeof this.options.manager ? this.options.manager.call(this) : this.options.manager;
                o = o.appendModal ? o : e(o).modalmanager().data("modalmanager"), o.appendModal(this) }, toggle: function() {
                return this[this.isShown ? "hide" : "show"]() }, show: function() {
                var t = e.Event("show");
                this.isShown || (this.$element.trigger(t), t.isDefaultPrevented() || (this.escape(), this.tab(), this.options.loading && this.loading())) }, hide: function(t) { t && t.preventDefault(), t = e.Event("hide"), this.$element.trigger(t), this.isShown && !t.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.tab(), this.isLoading && this.loading(), e(document).off("focusin.modal"), this.$element.removeClass("in").removeClass("animated").removeClass(this.options.attentionAnimation).removeClass("modal-overflow").attr("aria-hidden", !0), e.support.transition && this.$element.hasClass("fade") ? this.hideWithTransition() : this.hideModal()) }, layout: function() {
                var t = this.options.height ? "height" : "max-height",
                    n = this.options.height || this.options.maxHeight;
                if (this.options.width) { this.$element.css("width", this.options.width);
                    var i = this;
                    this.$element.css("margin-left", function() {
                        return /%/gi.test(i.options.width) ? -(parseInt(i.options.width) / 2) + "%" : -(e(this).width() / 2) + "px" }) } else this.$element.css("width", ""), this.$element.css("margin-left", "");
                this.$element.find(".modal-body").css("overflow", "").css(t, ""), n && this.$element.find(".modal-body").css("overflow", "auto").css(t, n);
                var o = e(window).height() - 10 < this.$element.height();
                o || this.options.modalOverflow ? this.$element.css("margin-top", 0).addClass("modal-overflow") : this.$element.css("margin-top", 0 - this.$element.height() / 2).removeClass("modal-overflow") }, tab: function() {
                var t = this;
                this.isShown && this.options.consumeTab ? this.$element.on("keydown.tabindex.modal", "[data-tabindex]", function(n) {
                    if (n.keyCode && 9 == n.keyCode) {
                        var i = e(this),
                            o = e(this);
                        t.$element.find("[data-tabindex]:enabled:not([readonly])").each(function(t) { i = t.shiftKey ? i.data("tabindex") > e(this).data("tabindex") ? i = e(this) : o = e(this) : i.data("tabindex") < e(this).data("tabindex") ? i = e(this) : o = e(this) }), i[0] !== e(this)[0] ? i.focus() : o.focus(), n.preventDefault() } }) : this.isShown || this.$element.off("keydown.tabindex.modal") }, escape: function() {
                var e = this;
                this.isShown && this.options.keyboard ? (this.$element.attr("tabindex") || this.$element.attr("tabindex", -1), this.$element.on("keyup.dismiss.modal", function(t) { 27 == t.which && e.hide() })) : this.isShown || this.$element.off("keyup.dismiss.modal") }, hideWithTransition: function() {
                var t = this,
                    n = setTimeout(function() { t.$element.off(e.support.transition.end), t.hideModal() }, 500);
                this.$element.one(e.support.transition.end, function() { clearTimeout(n), t.hideModal() }) }, hideModal: function() {
                var e = this.options.height ? "height" : "max-height",
                    t = this.options.height || this.options.maxHeight;
                t && this.$element.find(".modal-body").css("overflow", "").css(e, ""), this.$element.hide().trigger("hidden") }, removeLoading: function() { this.$loading.remove(), this.$loading = null, this.isLoading = !1 }, loading: function(t) { t = t || function() {};
                var n = this.$element.hasClass("fade") ? "fade" : "";
                if (this.isLoading)
                    if (this.isLoading && this.$loading) { this.$loading.removeClass("in");
                        var i = this;
                        e.support.transition && this.$element.hasClass("fade") ? this.$loading.one(e.support.transition.end, function() { i.removeLoading() }) : i.removeLoading() } else t && t(this.isLoading);
                else {
                    var o = e.support.transition && n;
                    this.$loading = e('<div class="loading-mask ' + n + '">').append(this.options.spinner).appendTo(this.$element), o && this.$loading[0].offsetWidth, this.$loading.addClass("in"), this.isLoading = !0, o ? this.$loading.one(e.support.transition.end, t) : t() } }, focus: function() {
                var e = this.$element.find(this.options.focusOn);
                e = e.length ? e : this.$element, e.focus() }, attention: function() {
                if (this.options.attentionAnimation) { this.$element.removeClass("animated").removeClass(this.options.attentionAnimation);
                    var e = this;
                    setTimeout(function() { e.$element.addClass("animated").addClass(e.options.attentionAnimation) }, 0) }
                this.focus() }, destroy: function() {
                var t = e.Event("destroy");
                this.$element.trigger(t), t.isDefaultPrevented() || (this.$element.off(".modal").removeData("modal").removeClass("in").attr("aria-hidden", !0), this.$parent !== this.$element.parent() ? this.$element.appendTo(this.$parent) : this.$parent.length || (this.$element.remove(), this.$element = null), this.$element.trigger("destroyed")) } }, e.fn.modal = function(n, i) {
            return this.each(function() {
                var o = e(this),
                    r = o.data("modal"),
                    s = e.extend({}, e.fn.modal.defaults, o.data(), "object" == typeof n && n);
                r || o.data("modal", r = new t(this, s)), "string" == typeof n ? r[n].apply(r, [].concat(i)) : s.show && r.show() }) }, e.fn.modal.defaults = { keyboard: !0, backdrop: !0, loading: !1, show: !0, width: null, height: null, maxHeight: null, modalOverflow: !1, consumeTab: !0, focusOn: null, replace: !1, resize: !1, attentionAnimation: "shake", manager: "body", spinner: '<div class="loading-spinner" style="width: 200px; margin-left: -100px;"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div>', backdropTemplate: '<div class="modal-backdrop" />' }, e.fn.modal.Constructor = t, e(function() { e(document).off("click.modal").on("click.modal.data-api", '[data-toggle="modal"]', function(t) {
                var n = e(this),
                    i = n.attr("href"),
                    o = e(n.attr("data-target") || i && i.replace(/.*(?=#[^\s]+$)/, "")),
                    r = o.data("modal") ? "toggle" : e.extend({ remote: !/#/.test(i) && i }, o.data(), n.data());
                t.preventDefault(), o.modal(r).one("hide", function() { n.focus() }) }) }) }(window.jQuery),
    function(e, t) {
        "use strict";
        var n, i, o = e,
            r = o.document,
            s = o.navigator,
            a = o.setTimeout,
            l = o.encodeURIComponent,
            c = o.ActiveXObject,
            u = o.Error,
            d = o.Number.parseInt || o.parseInt,
            p = o.Number.parseFloat || o.parseFloat,
            h = o.Number.isNaN || o.isNaN,
            f = o.Math.round,
            m = o.Date.now,
            g = o.Object.keys,
            v = o.Object.defineProperty,
            y = o.Object.prototype.hasOwnProperty,
            b = o.Array.prototype.slice,
            w = function() {
                var e = function(e) {
                    return e };
                if ("function" == typeof o.wrap && "function" == typeof o.unwrap) try {
                    var t = r.createElement("div"),
                        n = o.unwrap(t);
                    1 === t.nodeType && n && 1 === n.nodeType && (e = o.unwrap) } catch (i) {}
                return e }(),
            x = function(e) {
                return b.call(e, 0) },
            C = function() {
                var e, n, i, o, r, s, a = x(arguments),
                    l = a[0] || {};
                for (e = 1, n = a.length; n > e; e++)
                    if (null != (i = a[e]))
                        for (o in i) y.call(i, o) && (r = l[o], s = i[o], l !== s && s !== t && (l[o] = s));
                return l },
            k = function(e) {
                var t, n, i, o;
                if ("object" != typeof e || null == e) t = e;
                else if ("number" == typeof e.length)
                    for (t = [], n = 0, i = e.length; i > n; n++) y.call(e, n) && (t[n] = k(e[n]));
                else { t = {};
                    for (o in e) y.call(e, o) && (t[o] = k(e[o])) }
                return t },
            T = function(e, t) {
                for (var n = {}, i = 0, o = t.length; o > i; i++) t[i] in e && (n[t[i]] = e[t[i]]);
                return n },
            E = function(e, t) {
                var n = {};
                for (var i in e) - 1 === t.indexOf(i) && (n[i] = e[i]);
                return n },
            $ = function(e) {
                if (e)
                    for (var t in e) y.call(e, t) && delete e[t];
                return e },
            N = function(e, t) {
                if (e && 1 === e.nodeType && e.ownerDocument && t && (1 === t.nodeType && t.ownerDocument && t.ownerDocument === e.ownerDocument || 9 === t.nodeType && !t.ownerDocument && t === e.ownerDocument))
                    do {
                        if (e === t) return !0;
                        e = e.parentNode } while (e);
                return !1 },
            _ = function(e) {
                var t;
                return "string" == typeof e && e && (t = e.split("#")[0].split("?")[0], t = e.slice(0, e.lastIndexOf("/") + 1)), t },
            S = function(e) {
                var t, n;
                return "string" == typeof e && e && (n = e.match(/^(?:|[^:@]*@|.+\)@(?=http[s]?|file)|.+?\s+(?: at |@)(?:[^:\(]+ )*[\(]?)((?:http[s]?|file):\/\/[\/]?.+?\/[^:\)]*?)(?::\d+)(?::\d+)?/), n && n[1] ? t = n[1] : (n = e.match(/\)@((?:http[s]?|file):\/\/[\/]?.+?\/[^:\)]*?)(?::\d+)(?::\d+)?/), n && n[1] && (t = n[1]))), t },
            D = function() {
                var e, t;
                try {
                    throw new u } catch (n) { t = n }
                return t && (e = t.sourceURL || t.fileName || S(t.stack)), e },
            A = function() {
                var e, n, i;
                if (r.currentScript && (e = r.currentScript.src)) return e;
                if (n = r.getElementsByTagName("script"), 1 === n.length) return n[0].src || t;
                if ("readyState" in n[0])
                    for (i = n.length; i--;)
                        if ("interactive" === n[i].readyState && (e = n[i].src)) return e;
                return "loading" === r.readyState && (e = n[n.length - 1].src) ? e : (e = D()) ? e : t },
            M = function() {
                var e, n, i, o = r.getElementsByTagName("script");
                for (e = o.length; e--;) {
                    if (!(i = o[e].src)) { n = null;
                        break }
                    if (i = _(i), null == n) n = i;
                    else if (n !== i) { n = null;
                        break } }
                return n || t },
            L = function() {
                var e = _(A()) || M() || "";
                return e + "ZeroClipboard.swf" },
            P = { bridge: null, version: "0.0.0", pluginType: "unknown", disabled: null, outdated: null, unavailable: null, deactivated: null, overdue: null, ready: null },
            F = "11.0.0",
            O = {},
            I = {},
            H = null,
            j = { ready: "Flash communication is established", error: { "flash-disabled": "Flash is disabled or not installed", "flash-outdated": "Flash is too outdated to support ZeroClipboard", "flash-unavailable": "Flash is unable to communicate bidirectionally with JavaScript", "flash-deactivated": "Flash is too outdated for your browser and/or is configured as click-to-activate", "flash-overdue": "Flash communication was established but NOT within the acceptable time limit" } },
            z = { swfPath: L(), trustedDomains: e.location.host ? [e.location.host] : [], cacheBust: !0, forceEnhancedClipboard: !1, flashLoadTimeout: 3e4, autoActivate: !0, bubbleEvents: !0, containerId: "global-zeroclipboard-html-bridge", containerClass: "global-zeroclipboard-container", swfObjectId: "global-zeroclipboard-flash-bridge", hoverClass: "zeroclipboard-is-hover", activeClass: "zeroclipboard-is-active", forceHandCursor: !1, title: null, zIndex: 999999999 },
            W = function(e) {
                if ("object" == typeof e && null !== e)
                    for (var t in e)
                        if (y.call(e, t))
                            if (/^(?:forceHandCursor|title|zIndex|bubbleEvents)$/.test(t)) z[t] = e[t];
                            else if (null == P.bridge)
                    if ("containerId" === t || "swfObjectId" === t) {
                        if (!ne(e[t])) throw new Error("The specified `" + t + "` value is not valid as an HTML4 Element ID");
                        z[t] = e[t] } else z[t] = e[t]; {
                        if ("string" != typeof e || !e) return k(z);
                        if (y.call(z, e)) return z[e] } },
            R = function() {
                return { browser: T(s, ["userAgent", "platform", "appName"]), flash: E(P, ["bridge"]), zeroclipboard: { version: Ae.version, config: Ae.config() } } },
            B = function() {
                return !!(P.disabled || P.outdated || P.unavailable || P.deactivated) },
            q = function(e, t) {
                var n, i, o, r = {};
                if ("string" == typeof e && e) o = e.toLowerCase().split(/\s+/);
                else if ("object" == typeof e && e && "undefined" == typeof t)
                    for (n in e) y.call(e, n) && "string" == typeof n && n && "function" == typeof e[n] && Ae.on(n, e[n]);
                if (o && o.length) {
                    for (n = 0, i = o.length; i > n; n++) e = o[n].replace(/^on/, ""), r[e] = !0, O[e] || (O[e] = []), O[e].push(t);
                    if (r.ready && P.ready && Ae.emit({ type: "ready" }), r.error) {
                        var s = ["disabled", "outdated", "unavailable", "deactivated", "overdue"];
                        for (n = 0, i = s.length; i > n; n++)
                            if (P[s[n]] === !0) { Ae.emit({ type: "error", name: "flash-" + s[n] });
                                break } } }
                return Ae },
            U = function(e, t) {
                var n, i, o, r, s;
                if (0 === arguments.length) r = g(O);
                else if ("string" == typeof e && e) r = e.split(/\s+/);
                else if ("object" == typeof e && e && "undefined" == typeof t)
                    for (n in e) y.call(e, n) && "string" == typeof n && n && "function" == typeof e[n] && Ae.off(n, e[n]);
                if (r && r.length)
                    for (n = 0, i = r.length; i > n; n++)
                        if (e = r[n].toLowerCase().replace(/^on/, ""), s = O[e], s && s.length)
                            if (t)
                                for (o = s.indexOf(t); - 1 !== o;) s.splice(o, 1), o = s.indexOf(t, o);
                            else s.length = 0;
                return Ae },
            X = function(e) {
                var t;
                return t = "string" == typeof e && e ? k(O[e]) || null : k(O) },
            Y = function(e) {
                var t, n, i;
                return e = ie(e), e && !ce(e) ? "ready" === e.type && P.overdue === !0 ? Ae.emit({ type: "error", name: "flash-overdue" }) : (t = C({}, e), le.call(this, t), "copy" === e.type && (i = me(I), n = i.data, H = i.formatMap), n) : void 0 },
            Q = function() {
                if ("boolean" != typeof P.ready && (P.ready = !1), !Ae.isFlashUnusable() && null === P.bridge) {
                    var e = z.flashLoadTimeout; "number" == typeof e && e >= 0 && a(function() { "boolean" != typeof P.deactivated && (P.deactivated = !0), P.deactivated === !0 && Ae.emit({ type: "error", name: "flash-deactivated" }) }, e), P.overdue = !1, he() } },
            K = function() { Ae.clearData(), Ae.blur(), Ae.emit("destroy"), fe(), Ae.off() },
            G = function(e, t) {
                var n;
                if ("object" == typeof e && e && "undefined" == typeof t) n = e, Ae.clearData();
                else {
                    if ("string" != typeof e || !e) return;
                    n = {}, n[e] = t }
                for (var i in n) "string" == typeof i && i && y.call(n, i) && "string" == typeof n[i] && n[i] && (I[i] = n[i]) },
            V = function(e) { "undefined" == typeof e ? ($(I), H = null) : "string" == typeof e && y.call(I, e) && delete I[e] },
            J = function(e) {
                return "undefined" == typeof e ? k(I) : "string" == typeof e && y.call(I, e) ? I[e] : void 0 },
            Z = function(e) {
                if (e && 1 === e.nodeType) { n && (ke(n, z.activeClass), n !== e && ke(n, z.hoverClass)), n = e, Ce(e, z.hoverClass);
                    var t = e.getAttribute("title") || z.title;
                    if ("string" == typeof t && t) {
                        var i = pe(P.bridge);
                        i && i.setAttribute("title", t) }
                    var o = z.forceHandCursor === !0 || "pointer" === Te(e, "cursor");
                    _e(o), Ne() } },
            ee = function() {
                var e = pe(P.bridge);
                e && (e.removeAttribute("title"), e.style.left = "0px", e.style.top = "-9999px", e.style.width = "1px", e.style.top = "1px"), n && (ke(n, z.hoverClass), ke(n, z.activeClass), n = null) },
            te = function() {
                return n || null },
            ne = function(e) {
                return "string" == typeof e && e && /^[A-Za-z][A-Za-z0-9_:\-\.]*$/.test(e) },
            ie = function(e) {
                var t;
                if ("string" == typeof e && e ? (t = e, e = {}) : "object" == typeof e && e && "string" == typeof e.type && e.type && (t = e.type), t) {!e.target && /^(copy|aftercopy|_click)$/.test(t.toLowerCase()) && (e.target = i), C(e, { type: t.toLowerCase(), target: e.target || n || null, relatedTarget: e.relatedTarget || null, currentTarget: P && P.bridge || null, timeStamp: e.timeStamp || m() || null });
                    var o = j[e.type];
                    return "error" === e.type && e.name && o && (o = o[e.name]), o && (e.message = o), "ready" === e.type && C(e, { target: null, version: P.version }), "error" === e.type && (/^flash-(disabled|outdated|unavailable|deactivated|overdue)$/.test(e.name) && C(e, { target: null, minimumVersion: F }), /^flash-(outdated|unavailable|deactivated|overdue)$/.test(e.name) && C(e, { version: P.version })), "copy" === e.type && (e.clipboardData = { setData: Ae.setData, clearData: Ae.clearData }), "aftercopy" === e.type && (e = ge(e, H)), e.target && !e.relatedTarget && (e.relatedTarget = oe(e.target)), e = re(e) } },
            oe = function(e) {
                var t = e && e.getAttribute && e.getAttribute("data-clipboard-target");
                return t ? r.getElementById(t) : null },
            re = function(e) {
                if (e && /^_(?:click|mouse(?:over|out|down|up|move))$/.test(e.type)) {
                    var n = e.target,
                        i = "_mouseover" === e.type && e.relatedTarget ? e.relatedTarget : t,
                        s = "_mouseout" === e.type && e.relatedTarget ? e.relatedTarget : t,
                        a = $e(n),
                        l = o.screenLeft || o.screenX || 0,
                        c = o.screenTop || o.screenY || 0,
                        u = r.body.scrollLeft + r.documentElement.scrollLeft,
                        d = r.body.scrollTop + r.documentElement.scrollTop,
                        p = a.left + ("number" == typeof e._stageX ? e._stageX : 0),
                        h = a.top + ("number" == typeof e._stageY ? e._stageY : 0),
                        f = p - u,
                        m = h - d,
                        g = l + f,
                        v = c + m,
                        y = "number" == typeof e.movementX ? e.movementX : 0,
                        b = "number" == typeof e.movementY ? e.movementY : 0;
                    delete e._stageX, delete e._stageY, C(e, { srcElement: n, fromElement: i, toElement: s, screenX: g, screenY: v, pageX: p, pageY: h, clientX: f, clientY: m, x: f, y: m, movementX: y, movementY: b, offsetX: 0, offsetY: 0, layerX: 0, layerY: 0 }) }
                return e },
            se = function(e) {
                var t = e && "string" == typeof e.type && e.type || "";
                return !/^(?:(?:before)?copy|destroy)$/.test(t) },
            ae = function(e, t, n, i) { i ? a(function() { e.apply(t, n) }, 0) : e.apply(t, n) },
            le = function(e) {
                if ("object" == typeof e && e && e.type) {
                    var t = se(e),
                        n = O["*"] || [],
                        i = O[e.type] || [],
                        r = n.concat(i);
                    if (r && r.length) {
                        var s, a, l, c, u, d = this;
                        for (s = 0, a = r.length; a > s; s++) l = r[s], c = d, "string" == typeof l && "function" == typeof o[l] && (l = o[l]), "object" == typeof l && l && "function" == typeof l.handleEvent && (c = l, l = l.handleEvent), "function" == typeof l && (u = C({}, e), ae(l, c, [u], t)) }
                    return this } },
            ce = function(e) {
                var t = e.target || n || null,
                    o = "swf" === e._source;
                delete e._source;
                var r = ["flash-disabled", "flash-outdated", "flash-unavailable", "flash-deactivated", "flash-overdue"];
                switch (e.type) {
                    case "error":
                        -1 !== r.indexOf(e.name) && C(P, { disabled: "flash-disabled" === e.name, outdated: "flash-outdated" === e.name, unavailable: "flash-unavailable" === e.name, deactivated: "flash-deactivated" === e.name, overdue: "flash-overdue" === e.name, ready: !1 });
                        break;
                    case "ready":
                        var s = P.deactivated === !0;
                        C(P, { disabled: !1, outdated: !1, unavailable: !1, deactivated: !1, overdue: s, ready: !s });
                        break;
                    case "beforecopy":
                        i = t;
                        break;
                    case "copy":
                        var a, l, c = e.relatedTarget;!I["text/html"] && !I["text/plain"] && c && (l = c.value || c.outerHTML || c.innerHTML) && (a = c.value || c.textContent || c.innerText) ? (e.clipboardData.clearData(), e.clipboardData.setData("text/plain", a), l !== a && e.clipboardData.setData("text/html", l)) : !I["text/plain"] && e.target && (a = e.target.getAttribute("data-clipboard-text")) && (e.clipboardData.clearData(), e.clipboardData.setData("text/plain", a));
                        break;
                    case "aftercopy":
                        Ae.clearData(), t && t !== xe() && t.focus && t.focus();
                        break;
                    case "_mouseover":
                        Ae.focus(t), z.bubbleEvents === !0 && o && (t && t !== e.relatedTarget && !N(e.relatedTarget, t) && ue(C({}, e, { type: "mouseenter", bubbles: !1, cancelable: !1 })), ue(C({}, e, { type: "mouseover" })));
                        break;
                    case "_mouseout":
                        Ae.blur(), z.bubbleEvents === !0 && o && (t && t !== e.relatedTarget && !N(e.relatedTarget, t) && ue(C({}, e, { type: "mouseleave", bubbles: !1, cancelable: !1 })), ue(C({}, e, { type: "mouseout" })));
                        break;
                    case "_mousedown":
                        Ce(t, z.activeClass), z.bubbleEvents === !0 && o && ue(C({}, e, { type: e.type.slice(1) }));
                        break;
                    case "_mouseup":
                        ke(t, z.activeClass), z.bubbleEvents === !0 && o && ue(C({}, e, { type: e.type.slice(1) }));
                        break;
                    case "_click":
                        i = null, z.bubbleEvents === !0 && o && ue(C({}, e, { type: e.type.slice(1) }));
                        break;
                    case "_mousemove":
                        z.bubbleEvents === !0 && o && ue(C({}, e, { type: e.type.slice(1) })) }
                return /^_(?:click|mouse(?:over|out|down|up|move))$/.test(e.type) ? !0 : void 0 },
            ue = function(e) {
                if (e && "string" == typeof e.type && e) {
                    var t, n = e.target || null,
                        i = n && n.ownerDocument || r,
                        s = { view: i.defaultView || o, canBubble: !0, cancelable: !0, detail: "click" === e.type ? 1 : 0, button: "number" == typeof e.which ? e.which - 1 : "number" == typeof e.button ? e.button : i.createEvent ? 0 : 1 },
                        a = C(s, e);
                    n && i.createEvent && n.dispatchEvent && (a = [a.type, a.canBubble, a.cancelable, a.view, a.detail, a.screenX, a.screenY, a.clientX, a.clientY, a.ctrlKey, a.altKey, a.shiftKey, a.metaKey, a.button, a.relatedTarget], t = i.createEvent("MouseEvents"), t.initMouseEvent && (t.initMouseEvent.apply(t, a), t._source = "js", n.dispatchEvent(t))) } },
            de = function() {
                var e = r.createElement("div");
                return e.id = z.containerId, e.className = z.containerClass, e.style.position = "absolute", e.style.left = "0px", e.style.top = "-9999px", e.style.width = "1px", e.style.height = "1px", e.style.zIndex = "" + Se(z.zIndex), e },
            pe = function(e) {
                for (var t = e && e.parentNode; t && "OBJECT" === t.nodeName && t.parentNode;) t = t.parentNode;
                return t || null },
            he = function() {
                var e, t = P.bridge,
                    n = pe(t);
                if (!t) {
                    var i = we(o.location.host, z),
                        s = "never" === i ? "none" : "all",
                        a = ye(z),
                        l = z.swfPath + ve(z.swfPath, z);
                    n = de();
                    var c = r.createElement("div");
                    n.appendChild(c), r.body.appendChild(n);
                    var u = r.createElement("div"),
                        d = "activex" === P.pluginType;
                    u.innerHTML = '<object id="' + z.swfObjectId + '" name="' + z.swfObjectId + '" width="100%" height="100%" ' + (d ? 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"' : 'type="application/x-shockwave-flash" data="' + l + '"') + ">" + (d ? '<param name="movie" value="' + l + '"/>' : "") + '<param name="allowScriptAccess" value="' + i + '"/><param name="allowNetworking" value="' + s + '"/><param name="menu" value="false"/><param name="wmode" value="transparent"/><param name="flashvars" value="' + a + '"/></object>', t = u.firstChild, u = null, w(t).ZeroClipboard = Ae, n.replaceChild(t, c) }
                return t || (t = r[z.swfObjectId], t && (e = t.length) && (t = t[e - 1]), !t && n && (t = n.firstChild)), P.bridge = t || null, t },
            fe = function() {
                var e = P.bridge;
                if (e) {
                    var t = pe(e);
                    t && ("activex" === P.pluginType && "readyState" in e ? (e.style.display = "none", function n() {
                        if (4 === e.readyState) {
                            for (var i in e) "function" == typeof e[i] && (e[i] = null);
                            e.parentNode && e.parentNode.removeChild(e), t.parentNode && t.parentNode.removeChild(t) } else a(n, 10) }()) : (e.parentNode && e.parentNode.removeChild(e), t.parentNode && t.parentNode.removeChild(t))), P.ready = null, P.bridge = null, P.deactivated = null } },
            me = function(e) {
                var t = {},
                    n = {};
                if ("object" == typeof e && e) {
                    for (var i in e)
                        if (i && y.call(e, i) && "string" == typeof e[i] && e[i]) switch (i.toLowerCase()) {
                            case "text/plain":
                            case "text":
                            case "air:text":
                            case "flash:text":
                                t.text = e[i], n.text = i;
                                break;
                            case "text/html":
                            case "html":
                            case "air:html":
                            case "flash:html":
                                t.html = e[i], n.html = i;
                                break;
                            case "application/rtf":
                            case "text/rtf":
                            case "rtf":
                            case "richtext":
                            case "air:rtf":
                            case "flash:rtf":
                                t.rtf = e[i], n.rtf = i }
                        return { data: t, formatMap: n } } },
            ge = function(e, t) {
                if ("object" != typeof e || !e || "object" != typeof t || !t) return e;
                var n = {};
                for (var i in e)
                    if (y.call(e, i)) {
                        if ("success" !== i && "data" !== i) { n[i] = e[i];
                            continue }
                        n[i] = {};
                        var o = e[i];
                        for (var r in o) r && y.call(o, r) && y.call(t, r) && (n[i][t[r]] = o[r]) }
                return n },
            ve = function(e, t) {
                var n = null == t || t && t.cacheBust === !0;
                return n ? (-1 === e.indexOf("?") ? "?" : "&") + "noCache=" + m() : "" },
            ye = function(e) {
                var t, n, i, r, s = "",
                    a = [];
                if (e.trustedDomains && ("string" == typeof e.trustedDomains ? r = [e.trustedDomains] : "object" == typeof e.trustedDomains && "length" in e.trustedDomains && (r = e.trustedDomains)), r && r.length)
                    for (t = 0, n = r.length; n > t; t++)
                        if (y.call(r, t) && r[t] && "string" == typeof r[t]) {
                            if (i = be(r[t]), !i) continue;
                            if ("*" === i) { a.length = 0, a.push(i);
                                break }
                            a.push.apply(a, [i, "//" + i, o.location.protocol + "//" + i]) }
                return a.length && (s += "trustedOrigins=" + l(a.join(","))), e.forceEnhancedClipboard === !0 && (s += (s ? "&" : "") + "forceEnhancedClipboard=true"), "string" == typeof e.swfObjectId && e.swfObjectId && (s += (s ? "&" : "") + "swfObjectId=" + l(e.swfObjectId)), s },
            be = function(e) {
                if (null == e || "" === e) return null;
                if (e = e.replace(/^\s+|\s+$/g, ""), "" === e) return null;
                var t = e.indexOf("//");
                e = -1 === t ? e : e.slice(t + 2);
                var n = e.indexOf("/");
                return e = -1 === n ? e : -1 === t || 0 === n ? null : e.slice(0, n), e && ".swf" === e.slice(-4).toLowerCase() ? null : e || null },
            we = function() {
                var e = function(e) {
                    var t, n, i, o = [];
                    if ("string" == typeof e && (e = [e]),
                        "object" != typeof e || !e || "number" != typeof e.length) return o;
                    for (t = 0, n = e.length; n > t; t++)
                        if (y.call(e, t) && (i = be(e[t]))) {
                            if ("*" === i) { o.length = 0, o.push("*");
                                break } - 1 === o.indexOf(i) && o.push(i) }
                    return o
                };
                return function(t, n) {
                    var i = be(n.swfPath);
                    null === i && (i = t);
                    var o = e(n.trustedDomains),
                        r = o.length;
                    if (r > 0) {
                        if (1 === r && "*" === o[0]) return "always";
                        if (-1 !== o.indexOf(t)) return 1 === r && t === i ? "sameDomain" : "always" }
                    return "never" }
            }(),
            xe = function() {
                try {
                    return r.activeElement } catch (e) {
                    return null } },
            Ce = function(e, t) {
                if (!e || 1 !== e.nodeType) return e;
                if (e.classList) return e.classList.contains(t) || e.classList.add(t), e;
                if (t && "string" == typeof t) {
                    var n = (t || "").split(/\s+/);
                    if (1 === e.nodeType)
                        if (e.className) {
                            for (var i = " " + e.className + " ", o = e.className, r = 0, s = n.length; s > r; r++) i.indexOf(" " + n[r] + " ") < 0 && (o += " " + n[r]);
                            e.className = o.replace(/^\s+|\s+$/g, "") } else e.className = t }
                return e },
            ke = function(e, t) {
                if (!e || 1 !== e.nodeType) return e;
                if (e.classList) return e.classList.contains(t) && e.classList.remove(t), e;
                if ("string" == typeof t && t) {
                    var n = t.split(/\s+/);
                    if (1 === e.nodeType && e.className) {
                        for (var i = (" " + e.className + " ").replace(/[\n\t]/g, " "), o = 0, r = n.length; r > o; o++) i = i.replace(" " + n[o] + " ", " ");
                        e.className = i.replace(/^\s+|\s+$/g, "") } }
                return e },
            Te = function(e, t) {
                var n = o.getComputedStyle(e, null).getPropertyValue(t);
                return "cursor" !== t || n && "auto" !== n || "A" !== e.nodeName ? n : "pointer" },
            Ee = function() {
                var e, t, n, i = 1;
                return "function" == typeof r.body.getBoundingClientRect && (e = r.body.getBoundingClientRect(), t = e.right - e.left, n = r.body.offsetWidth, i = f(t / n * 100) / 100), i },
            $e = function(e) {
                var t = { left: 0, top: 0, width: 0, height: 0 };
                if (e.getBoundingClientRect) {
                    var n, i, s, a = e.getBoundingClientRect(); "pageXOffset" in o && "pageYOffset" in o ? (n = o.pageXOffset, i = o.pageYOffset) : (s = Ee(), n = f(r.documentElement.scrollLeft / s), i = f(r.documentElement.scrollTop / s));
                    var l = r.documentElement.clientLeft || 0,
                        c = r.documentElement.clientTop || 0;
                    t.left = a.left + n - l, t.top = a.top + i - c, t.width = "width" in a ? a.width : a.right - a.left, t.height = "height" in a ? a.height : a.bottom - a.top }
                return t },
            Ne = function() {
                var e;
                if (n && (e = pe(P.bridge))) {
                    var t = $e(n);
                    C(e.style, { width: t.width + "px", height: t.height + "px", top: t.top + "px", left: t.left + "px", zIndex: "" + Se(z.zIndex) }) } },
            _e = function(e) { P.ready === !0 && (P.bridge && "function" == typeof P.bridge.setHandCursor ? P.bridge.setHandCursor(e) : P.ready = !1) },
            Se = function(e) {
                if (/^(?:auto|inherit)$/.test(e)) return e;
                var t;
                return "number" != typeof e || h(e) ? "string" == typeof e && (t = Se(d(e, 10))) : t = e, "number" == typeof t ? t : "auto" },
            De = function(e) {
                function t(e) {
                    var t = e.match(/[\d]+/g);
                    return t.length = 3, t.join(".") }

                function n(e) {
                    return !!e && (e = e.toLowerCase()) && (/^(pepflashplayer\.dll|libpepflashplayer\.so|pepperflashplayer\.plugin)$/.test(e) || "chrome.plugin" === e.slice(-13)) }

                function i(e) { e && (l = !0, e.version && (d = t(e.version)), !d && e.description && (d = t(e.description)), e.filename && (u = n(e.filename))) }
                var o, r, a, l = !1,
                    c = !1,
                    u = !1,
                    d = "";
                if (s.plugins && s.plugins.length) o = s.plugins["Shockwave Flash"], i(o), s.plugins["Shockwave Flash 2.0"] && (l = !0, d = "2.0.0.11");
                else if (s.mimeTypes && s.mimeTypes.length) a = s.mimeTypes["application/x-shockwave-flash"], o = a && a.enabledPlugin, i(o);
                else if ("undefined" != typeof e) { c = !0;
                    try { r = new e("ShockwaveFlash.ShockwaveFlash.7"), l = !0, d = t(r.GetVariable("$version")) } catch (h) {
                        try { r = new e("ShockwaveFlash.ShockwaveFlash.6"), l = !0, d = "6.0.21" } catch (f) {
                            try { r = new e("ShockwaveFlash.ShockwaveFlash"), l = !0, d = t(r.GetVariable("$version")) } catch (m) { c = !1 } } } }
                P.disabled = l !== !0, P.outdated = d && p(d) < p(F), P.version = d || "0.0.0", P.pluginType = u ? "pepper" : c ? "activex" : l ? "netscape" : "unknown" };
        De(c);
        var Ae = function() {
            return this instanceof Ae ? void("function" == typeof Ae._createClient && Ae._createClient.apply(this, x(arguments))) : new Ae };
        v(Ae, "version", { value: "2.1.6", writable: !1, configurable: !0, enumerable: !0 }), Ae.config = function() {
            return W.apply(this, x(arguments)) }, Ae.state = function() {
            return R.apply(this, x(arguments)) }, Ae.isFlashUnusable = function() {
            return B.apply(this, x(arguments)) }, Ae.on = function() {
            return q.apply(this, x(arguments)) }, Ae.off = function() {
            return U.apply(this, x(arguments)) }, Ae.handlers = function() {
            return X.apply(this, x(arguments)) }, Ae.emit = function() {
            return Y.apply(this, x(arguments)) }, Ae.create = function() {
            return Q.apply(this, x(arguments)) }, Ae.destroy = function() {
            return K.apply(this, x(arguments)) }, Ae.setData = function() {
            return G.apply(this, x(arguments)) }, Ae.clearData = function() {
            return V.apply(this, x(arguments)) }, Ae.getData = function() {
            return J.apply(this, x(arguments)) }, Ae.focus = Ae.activate = function() {
            return Z.apply(this, x(arguments)) }, Ae.blur = Ae.deactivate = function() {
            return ee.apply(this, x(arguments)) }, Ae.activeElement = function() {
            return te.apply(this, x(arguments)) };
        var Me = 0,
            Le = {},
            Pe = 0,
            Fe = {},
            Oe = {};
        C(z, { autoActivate: !0 });
        var Ie = function(e) {
                var t = this;
                t.id = "" + Me++, Le[t.id] = { instance: t, elements: [], handlers: {} }, e && t.clip(e), Ae.on("*", function(e) {
                    return t.emit(e) }), Ae.on("destroy", function() { t.destroy() }), Ae.create() },
            He = function(e, t) {
                var n, i, o, r = {},
                    s = Le[this.id] && Le[this.id].handlers;
                if ("string" == typeof e && e) o = e.toLowerCase().split(/\s+/);
                else if ("object" == typeof e && e && "undefined" == typeof t)
                    for (n in e) y.call(e, n) && "string" == typeof n && n && "function" == typeof e[n] && this.on(n, e[n]);
                if (o && o.length) {
                    for (n = 0, i = o.length; i > n; n++) e = o[n].replace(/^on/, ""), r[e] = !0, s[e] || (s[e] = []), s[e].push(t);
                    if (r.ready && P.ready && this.emit({ type: "ready", client: this }), r.error) {
                        var a = ["disabled", "outdated", "unavailable", "deactivated", "overdue"];
                        for (n = 0, i = a.length; i > n; n++)
                            if (P[a[n]]) { this.emit({ type: "error", name: "flash-" + a[n], client: this });
                                break } } }
                return this },
            je = function(e, t) {
                var n, i, o, r, s, a = Le[this.id] && Le[this.id].handlers;
                if (0 === arguments.length) r = g(a);
                else if ("string" == typeof e && e) r = e.split(/\s+/);
                else if ("object" == typeof e && e && "undefined" == typeof t)
                    for (n in e) y.call(e, n) && "string" == typeof n && n && "function" == typeof e[n] && this.off(n, e[n]);
                if (r && r.length)
                    for (n = 0, i = r.length; i > n; n++)
                        if (e = r[n].toLowerCase().replace(/^on/, ""), s = a[e], s && s.length)
                            if (t)
                                for (o = s.indexOf(t); - 1 !== o;) s.splice(o, 1), o = s.indexOf(t, o);
                            else s.length = 0;
                return this },
            ze = function(e) {
                var t = null,
                    n = Le[this.id] && Le[this.id].handlers;
                return n && (t = "string" == typeof e && e ? n[e] ? n[e].slice(0) : [] : k(n)), t },
            We = function(e) {
                if (Xe.call(this, e)) { "object" == typeof e && e && "string" == typeof e.type && e.type && (e = C({}, e));
                    var t = C({}, ie(e), { client: this });
                    Ye.call(this, t) }
                return this },
            Re = function(e) { e = Qe(e);
                for (var t = 0; t < e.length; t++)
                    if (y.call(e, t) && e[t] && 1 === e[t].nodeType) { e[t].zcClippingId ? -1 === Fe[e[t].zcClippingId].indexOf(this.id) && Fe[e[t].zcClippingId].push(this.id) : (e[t].zcClippingId = "zcClippingId_" + Pe++, Fe[e[t].zcClippingId] = [this.id], z.autoActivate === !0 && Ke(e[t]));
                        var n = Le[this.id] && Le[this.id].elements; - 1 === n.indexOf(e[t]) && n.push(e[t]) }
                return this },
            Be = function(e) {
                var t = Le[this.id];
                if (!t) return this;
                var n, i = t.elements;
                e = "undefined" == typeof e ? i.slice(0) : Qe(e);
                for (var o = e.length; o--;)
                    if (y.call(e, o) && e[o] && 1 === e[o].nodeType) {
                        for (n = 0; - 1 !== (n = i.indexOf(e[o], n));) i.splice(n, 1);
                        var r = Fe[e[o].zcClippingId];
                        if (r) {
                            for (n = 0; - 1 !== (n = r.indexOf(this.id, n));) r.splice(n, 1);
                            0 === r.length && (z.autoActivate === !0 && Ge(e[o]), delete e[o].zcClippingId) } }
                return this },
            qe = function() {
                var e = Le[this.id];
                return e && e.elements ? e.elements.slice(0) : [] },
            Ue = function() { this.unclip(), this.off(), delete Le[this.id] },
            Xe = function(e) {
                if (!e || !e.type) return !1;
                if (e.client && e.client !== this) return !1;
                var t = Le[this.id] && Le[this.id].elements,
                    n = !!t && t.length > 0,
                    i = !e.target || n && -1 !== t.indexOf(e.target),
                    o = e.relatedTarget && n && -1 !== t.indexOf(e.relatedTarget),
                    r = e.client && e.client === this;
                return i || o || r ? !0 : !1 },
            Ye = function(e) {
                if ("object" == typeof e && e && e.type) {
                    var t = se(e),
                        n = Le[this.id] && Le[this.id].handlers["*"] || [],
                        i = Le[this.id] && Le[this.id].handlers[e.type] || [],
                        r = n.concat(i);
                    if (r && r.length) {
                        var s, a, l, c, u, d = this;
                        for (s = 0, a = r.length; a > s; s++) l = r[s], c = d, "string" == typeof l && "function" == typeof o[l] && (l = o[l]), "object" == typeof l && l && "function" == typeof l.handleEvent && (c = l, l = l.handleEvent), "function" == typeof l && (u = C({}, e), ae(l, c, [u], t)) }
                    return this } },
            Qe = function(e) {
                return "string" == typeof e && (e = []), "number" != typeof e.length ? [e] : e },
            Ke = function(e) {
                if (e && 1 === e.nodeType) {
                    var t = function(e) {
                            (e || (e = o.event)) && ("js" !== e._source && (e.stopImmediatePropagation(), e.preventDefault()), delete e._source) },
                        n = function(n) {
                            (n || (n = o.event)) && (t(n), Ae.focus(e)) };
                    e.addEventListener("mouseover", n, !1), e.addEventListener("mouseout", t, !1), e.addEventListener("mouseenter", t, !1), e.addEventListener("mouseleave", t, !1), e.addEventListener("mousemove", t, !1), Oe[e.zcClippingId] = { mouseover: n, mouseout: t, mouseenter: t, mouseleave: t, mousemove: t } } },
            Ge = function(e) {
                if (e && 1 === e.nodeType) {
                    var t = Oe[e.zcClippingId];
                    if ("object" == typeof t && t) {
                        for (var n, i, o = ["move", "leave", "enter", "out", "over"], r = 0, s = o.length; s > r; r++) n = "mouse" + o[r], i = t[n], "function" == typeof i && e.removeEventListener(n, i, !1);
                        delete Oe[e.zcClippingId] } } };
        Ae._createClient = function() { Ie.apply(this, x(arguments)) }, Ae.prototype.on = function() {
            return He.apply(this, x(arguments)) }, Ae.prototype.off = function() {
            return je.apply(this, x(arguments)) }, Ae.prototype.handlers = function() {
            return ze.apply(this, x(arguments)) }, Ae.prototype.emit = function() {
            return We.apply(this, x(arguments)) }, Ae.prototype.clip = function() {
            return Re.apply(this, x(arguments)) }, Ae.prototype.unclip = function() {
            return Be.apply(this, x(arguments)) }, Ae.prototype.elements = function() {
            return qe.apply(this, x(arguments)) }, Ae.prototype.destroy = function() {
            return Ue.apply(this, x(arguments)) }, Ae.prototype.setText = function(e) {
            return Ae.setData("text/plain", e), this }, Ae.prototype.setHtml = function(e) {
            return Ae.setData("text/html", e), this }, Ae.prototype.setRichText = function(e) {
            return Ae.setData("application/rtf", e), this }, Ae.prototype.setData = function() {
            return Ae.setData.apply(this, x(arguments)), this }, Ae.prototype.clearData = function() {
            return Ae.clearData.apply(this, x(arguments)), this }, Ae.prototype.getData = function() {
            return Ae.getData.apply(this, x(arguments)) }, "function" == typeof define && define.amd ? define(function() {
            return Ae }) : "object" == typeof module && module && "object" == typeof module.exports && module.exports ? module.exports = Ae : e.ZeroClipboard = Ae
    }(function() {
        return this || window }()),
    function(e, t) {
        function n(t, n) {
            var o, r, s, a = t.nodeName.toLowerCase();
            return "area" === a ? (o = t.parentNode, r = o.name, t.href && r && "map" === o.nodeName.toLowerCase() ? (s = e("img[usemap=#" + r + "]")[0], !!s && i(s)) : !1) : (/input|select|textarea|button|object/.test(a) ? !t.disabled : "a" === a ? t.href || n : n) && i(t) }

        function i(t) {
            return e.expr.filters.visible(t) && !e(t).parents().addBack().filter(function() {
                return "hidden" === e.css(this, "visibility") }).length }
        var o = 0,
            r = /^ui-id-\d+$/;
        e.ui = e.ui || {}, e.extend(e.ui, { version: "1.10.4", keyCode: { BACKSPACE: 8, COMMA: 188, DELETE: 46, DOWN: 40, END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, LEFT: 37, NUMPAD_ADD: 107, NUMPAD_DECIMAL: 110, NUMPAD_DIVIDE: 111, NUMPAD_ENTER: 108, NUMPAD_MULTIPLY: 106, NUMPAD_SUBTRACT: 109, PAGE_DOWN: 34, PAGE_UP: 33, PERIOD: 190, RIGHT: 39, SPACE: 32, TAB: 9, UP: 38 } }), e.fn.extend({ focus: function(t) {
                return function(n, i) {
                    return "number" == typeof n ? this.each(function() {
                        var t = this;
                        setTimeout(function() { e(t).focus(), i && i.call(t) }, n) }) : t.apply(this, arguments) } }(e.fn.focus), scrollParent: function() {
                var t;
                return t = e.ui.ie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? this.parents().filter(function() {
                    return /(relative|absolute|fixed)/.test(e.css(this, "position")) && /(auto|scroll)/.test(e.css(this, "overflow") + e.css(this, "overflow-y") + e.css(this, "overflow-x")) }).eq(0) : this.parents().filter(function() {
                    return /(auto|scroll)/.test(e.css(this, "overflow") + e.css(this, "overflow-y") + e.css(this, "overflow-x")) }).eq(0), /fixed/.test(this.css("position")) || !t.length ? e(document) : t }, zIndex: function(n) {
                if (n !== t) return this.css("zIndex", n);
                if (this.length)
                    for (var i, o, r = e(this[0]); r.length && r[0] !== document;) {
                        if (i = r.css("position"), ("absolute" === i || "relative" === i || "fixed" === i) && (o = parseInt(r.css("zIndex"), 10), !isNaN(o) && 0 !== o)) return o;
                        r = r.parent() }
                return 0 }, uniqueId: function() {
                return this.each(function() { this.id || (this.id = "ui-id-" + ++o) }) }, removeUniqueId: function() {
                return this.each(function() { r.test(this.id) && e(this).removeAttr("id") }) } }), e.extend(e.expr[":"], { data: e.expr.createPseudo ? e.expr.createPseudo(function(t) {
                return function(n) {
                    return !!e.data(n, t) } }) : function(t, n, i) {
                return !!e.data(t, i[3]) }, focusable: function(t) {
                return n(t, !isNaN(e.attr(t, "tabindex"))) }, tabbable: function(t) {
                var i = e.attr(t, "tabindex"),
                    o = isNaN(i);
                return (o || i >= 0) && n(t, !o) } }), e("<a>").outerWidth(1).jquery || e.each(["Width", "Height"], function(n, i) {
            function o(t, n, i, o) {
                return e.each(r, function() { n -= parseFloat(e.css(t, "padding" + this)) || 0, i && (n -= parseFloat(e.css(t, "border" + this + "Width")) || 0), o && (n -= parseFloat(e.css(t, "margin" + this)) || 0) }), n }
            var r = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
                s = i.toLowerCase(),
                a = { innerWidth: e.fn.innerWidth, innerHeight: e.fn.innerHeight, outerWidth: e.fn.outerWidth, outerHeight: e.fn.outerHeight };
            e.fn["inner" + i] = function(n) {
                return n === t ? a["inner" + i].call(this) : this.each(function() { e(this).css(s, o(this, n) + "px") }) }, e.fn["outer" + i] = function(t, n) {
                return "number" != typeof t ? a["outer" + i].call(this, t) : this.each(function() { e(this).css(s, o(this, t, !0, n) + "px") }) } }), e.fn.addBack || (e.fn.addBack = function(e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e)) }), e("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (e.fn.removeData = function(t) {
            return function(n) {
                return arguments.length ? t.call(this, e.camelCase(n)) : t.call(this) } }(e.fn.removeData)), e.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), e.support.selectstart = "onselectstart" in document.createElement("div"), e.fn.extend({ disableSelection: function() {
                return this.bind((e.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", function(e) { e.preventDefault() }) }, enableSelection: function() {
                return this.unbind(".ui-disableSelection") } }), e.extend(e.ui, { plugin: { add: function(t, n, i) {
                    var o, r = e.ui[t].prototype;
                    for (o in i) r.plugins[o] = r.plugins[o] || [], r.plugins[o].push([n, i[o]]) }, call: function(e, t, n) {
                    var i, o = e.plugins[t];
                    if (o && e.element[0].parentNode && 11 !== e.element[0].parentNode.nodeType)
                        for (i = 0; i < o.length; i++) e.options[o[i][0]] && o[i][1].apply(e.element, n) } }, hasScroll: function(t, n) {
                if ("hidden" === e(t).css("overflow")) return !1;
                var i = n && "left" === n ? "scrollLeft" : "scrollTop",
                    o = !1;
                return t[i] > 0 ? !0 : (t[i] = 1, o = t[i] > 0, t[i] = 0, o) } }) }(jQuery),
    function(e, t) {
        function n(e, t, n) {
            return [parseFloat(e[0]) * (h.test(e[0]) ? t / 100 : 1), parseFloat(e[1]) * (h.test(e[1]) ? n / 100 : 1)] }

        function i(t, n) {
            return parseInt(e.css(t, n), 10) || 0 }

        function o(t) {
            var n = t[0];
            return 9 === n.nodeType ? { width: t.width(), height: t.height(), offset: { top: 0, left: 0 } } : e.isWindow(n) ? { width: t.width(), height: t.height(), offset: { top: t.scrollTop(), left: t.scrollLeft() } } : n.preventDefault ? { width: 0, height: 0, offset: { top: n.pageY, left: n.pageX } } : { width: t.outerWidth(), height: t.outerHeight(), offset: t.offset() } }
        e.ui = e.ui || {};
        var r, s = Math.max,
            a = Math.abs,
            l = Math.round,
            c = /left|center|right/,
            u = /top|center|bottom/,
            d = /[\+\-]\d+(\.[\d]+)?%?/,
            p = /^\w+/,
            h = /%$/,
            f = e.fn.position;
        e.position = { scrollbarWidth: function() {
                    if (r !== t) return r;
                    var n, i, o = e("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                        s = o.children()[0];
                    return e("body").append(o), n = s.offsetWidth, o.css("overflow", "scroll"), i = s.offsetWidth, n === i && (i = o[0].clientWidth), o.remove(), r = n - i }, getScrollInfo: function(t) {
                    var n = t.isWindow || t.isDocument ? "" : t.element.css("overflow-x"),
                        i = t.isWindow || t.isDocument ? "" : t.element.css("overflow-y"),
                        o = "scroll" === n || "auto" === n && t.width < t.element[0].scrollWidth,
                        r = "scroll" === i || "auto" === i && t.height < t.element[0].scrollHeight;
                    return { width: r ? e.position.scrollbarWidth() : 0, height: o ? e.position.scrollbarWidth() : 0 } }, getWithinInfo: function(t) {
                    var n = e(t || window),
                        i = e.isWindow(n[0]),
                        o = !!n[0] && 9 === n[0].nodeType;
                    return { element: n, isWindow: i, isDocument: o, offset: n.offset() || { left: 0, top: 0 }, scrollLeft: n.scrollLeft(), scrollTop: n.scrollTop(), width: i ? n.width() : n.outerWidth(), height: i ? n.height() : n.outerHeight() } } }, e.fn.position = function(t) {
                if (!t || !t.of) return f.apply(this, arguments);
                t = e.extend({}, t);
                var r, h, m, g, v, y, b = e(t.of),
                    w = e.position.getWithinInfo(t.within),
                    x = e.position.getScrollInfo(w),
                    C = (t.collision || "flip").split(" "),
                    k = {};
                return y = o(b), b[0].preventDefault && (t.at = "left top"), h = y.width, m = y.height, g = y.offset, v = e.extend({}, g), e.each(["my", "at"], function() {
                    var e, n, i = (t[this] || "").split(" ");
                    1 === i.length && (i = c.test(i[0]) ? i.concat(["center"]) : u.test(i[0]) ? ["center"].concat(i) : ["center", "center"]), i[0] = c.test(i[0]) ? i[0] : "center", i[1] = u.test(i[1]) ? i[1] : "center", e = d.exec(i[0]), n = d.exec(i[1]), k[this] = [e ? e[0] : 0, n ? n[0] : 0], t[this] = [p.exec(i[0])[0], p.exec(i[1])[0]] }), 1 === C.length && (C[1] = C[0]), "right" === t.at[0] ? v.left += h : "center" === t.at[0] && (v.left += h / 2), "bottom" === t.at[1] ? v.top += m : "center" === t.at[1] && (v.top += m / 2), r = n(k.at, h, m), v.left += r[0], v.top += r[1], this.each(function() {
                    var o, c, u = e(this),
                        d = u.outerWidth(),
                        p = u.outerHeight(),
                        f = i(this, "marginLeft"),
                        y = i(this, "marginTop"),
                        T = d + f + i(this, "marginRight") + x.width,
                        E = p + y + i(this, "marginBottom") + x.height,
                        $ = e.extend({}, v),
                        N = n(k.my, u.outerWidth(), u.outerHeight()); "right" === t.my[0] ? $.left -= d : "center" === t.my[0] && ($.left -= d / 2), "bottom" === t.my[1] ? $.top -= p : "center" === t.my[1] && ($.top -= p / 2), $.left += N[0], $.top += N[1], e.support.offsetFractions || ($.left = l($.left), $.top = l($.top)), o = { marginLeft: f, marginTop: y }, e.each(["left", "top"], function(n, i) { e.ui.position[C[n]] && e.ui.position[C[n]][i]($, { targetWidth: h, targetHeight: m, elemWidth: d, elemHeight: p, collisionPosition: o, collisionWidth: T, collisionHeight: E, offset: [r[0] + N[0], r[1] + N[1]], my: t.my, at: t.at, within: w, elem: u }) }), t.using && (c = function(e) {
                        var n = g.left - $.left,
                            i = n + h - d,
                            o = g.top - $.top,
                            r = o + m - p,
                            l = { target: { element: b, left: g.left, top: g.top, width: h, height: m }, element: { element: u, left: $.left, top: $.top, width: d, height: p }, horizontal: 0 > i ? "left" : n > 0 ? "right" : "center", vertical: 0 > r ? "top" : o > 0 ? "bottom" : "middle" };
                        d > h && a(n + i) < h && (l.horizontal = "center"), p > m && a(o + r) < m && (l.vertical = "middle"), l.important = s(a(n), a(i)) > s(a(o), a(r)) ? "horizontal" : "vertical", t.using.call(this, e, l) }), u.offset(e.extend($, { using: c })) }) }, e.ui.position = { fit: { left: function(e, t) {
                        var n, i = t.within,
                            o = i.isWindow ? i.scrollLeft : i.offset.left,
                            r = i.width,
                            a = e.left - t.collisionPosition.marginLeft,
                            l = o - a,
                            c = a + t.collisionWidth - r - o;
                        t.collisionWidth > r ? l > 0 && 0 >= c ? (n = e.left + l + t.collisionWidth - r - o, e.left += l - n) : e.left = c > 0 && 0 >= l ? o : l > c ? o + r - t.collisionWidth : o : l > 0 ? e.left += l : c > 0 ? e.left -= c : e.left = s(e.left - a, e.left) }, top: function(e, t) {
                        var n, i = t.within,
                            o = i.isWindow ? i.scrollTop : i.offset.top,
                            r = t.within.height,
                            a = e.top - t.collisionPosition.marginTop,
                            l = o - a,
                            c = a + t.collisionHeight - r - o;
                        t.collisionHeight > r ? l > 0 && 0 >= c ? (n = e.top + l + t.collisionHeight - r - o, e.top += l - n) : e.top = c > 0 && 0 >= l ? o : l > c ? o + r - t.collisionHeight : o : l > 0 ? e.top += l : c > 0 ? e.top -= c : e.top = s(e.top - a, e.top) } }, flip: { left: function(e, t) {
                        var n, i, o = t.within,
                            r = o.offset.left + o.scrollLeft,
                            s = o.width,
                            l = o.isWindow ? o.scrollLeft : o.offset.left,
                            c = e.left - t.collisionPosition.marginLeft,
                            u = c - l,
                            d = c + t.collisionWidth - s - l,
                            p = "left" === t.my[0] ? -t.elemWidth : "right" === t.my[0] ? t.elemWidth : 0,
                            h = "left" === t.at[0] ? t.targetWidth : "right" === t.at[0] ? -t.targetWidth : 0,
                            f = -2 * t.offset[0];
                        0 > u ? (n = e.left + p + h + f + t.collisionWidth - s - r, (0 > n || n < a(u)) && (e.left += p + h + f)) : d > 0 && (i = e.left - t.collisionPosition.marginLeft + p + h + f - l, (i > 0 || a(i) < d) && (e.left += p + h + f)) }, top: function(e, t) {
                        var n, i, o = t.within,
                            r = o.offset.top + o.scrollTop,
                            s = o.height,
                            l = o.isWindow ? o.scrollTop : o.offset.top,
                            c = e.top - t.collisionPosition.marginTop,
                            u = c - l,
                            d = c + t.collisionHeight - s - l,
                            p = "top" === t.my[1],
                            h = p ? -t.elemHeight : "bottom" === t.my[1] ? t.elemHeight : 0,
                            f = "top" === t.at[1] ? t.targetHeight : "bottom" === t.at[1] ? -t.targetHeight : 0,
                            m = -2 * t.offset[1];
                        0 > u ? (i = e.top + h + f + m + t.collisionHeight - s - r, e.top + h + f + m > u && (0 > i || i < a(u)) && (e.top += h + f + m)) : d > 0 && (n = e.top - t.collisionPosition.marginTop + h + f + m - l, e.top + h + f + m > d && (n > 0 || a(n) < d) && (e.top += h + f + m)) } }, flipfit: { left: function() { e.ui.position.flip.left.apply(this, arguments), e.ui.position.fit.left.apply(this, arguments) }, top: function() { e.ui.position.flip.top.apply(this, arguments), e.ui.position.fit.top.apply(this, arguments) } } },
            function() {
                var t, n, i, o, r, s = document.getElementsByTagName("body")[0],
                    a = document.createElement("div");
                t = document.createElement(s ? "div" : "body"), i = { visibility: "hidden", width: 0, height: 0, border: 0, margin: 0, background: "none" }, s && e.extend(i, { position: "absolute", left: "-1000px", top: "-1000px" });
                for (r in i) t.style[r] = i[r];
                t.appendChild(a), n = s || document.documentElement, n.insertBefore(t, n.firstChild), a.style.cssText = "position: absolute; left: 10.7432222px;", o = e(a).offset().left, e.support.offsetFractions = o > 10 && 11 > o, t.innerHTML = "", n.removeChild(t) }() }(jQuery),
    function(e, t) {
        var n = 0,
            i = Array.prototype.slice,
            o = e.cleanData;
        e.cleanData = function(t) {
            for (var n, i = 0; null != (n = t[i]); i++) try { e(n).triggerHandler("remove") } catch (r) {}
            o(t) }, e.widget = function(t, n, i) {
            var o, r, s, a, l = {},
                c = t.split(".")[0];
            t = t.split(".")[1], o = c + "-" + t, i || (i = n, n = e.Widget), e.expr[":"][o.toLowerCase()] = function(t) {
                return !!e.data(t, o) }, e[c] = e[c] || {}, r = e[c][t], s = e[c][t] = function(e, t) {
                return this._createWidget ? void(arguments.length && this._createWidget(e, t)) : new s(e, t) }, e.extend(s, r, { version: i.version, _proto: e.extend({}, i), _childConstructors: [] }), a = new n, a.options = e.widget.extend({}, a.options), e.each(i, function(t, i) {
                return e.isFunction(i) ? void(l[t] = function() {
                    var e = function() {
                            return n.prototype[t].apply(this, arguments) },
                        o = function(e) {
                            return n.prototype[t].apply(this, e) };
                    return function() {
                        var t, n = this._super,
                            r = this._superApply;
                        return this._super = e, this._superApply = o, t = i.apply(this, arguments), this._super = n, this._superApply = r, t } }()) : void(l[t] = i) }), s.prototype = e.widget.extend(a, { widgetEventPrefix: r ? a.widgetEventPrefix || t : t }, l, { constructor: s, namespace: c, widgetName: t, widgetFullName: o }), r ? (e.each(r._childConstructors, function(t, n) {
                var i = n.prototype;
                e.widget(i.namespace + "." + i.widgetName, s, n._proto) }), delete r._childConstructors) : n._childConstructors.push(s), e.widget.bridge(t, s) }, e.widget.extend = function(n) {
            for (var o, r, s = i.call(arguments, 1), a = 0, l = s.length; l > a; a++)
                for (o in s[a]) r = s[a][o], s[a].hasOwnProperty(o) && r !== t && (n[o] = e.isPlainObject(r) ? e.isPlainObject(n[o]) ? e.widget.extend({}, n[o], r) : e.widget.extend({}, r) : r);
            return n }, e.widget.bridge = function(n, o) {
            var r = o.prototype.widgetFullName || n;
            e.fn[n] = function(s) {
                var a = "string" == typeof s,
                    l = i.call(arguments, 1),
                    c = this;
                return s = !a && l.length ? e.widget.extend.apply(null, [s].concat(l)) : s, this.each(a ? function() {
                    var i, o = e.data(this, r);
                    return o ? e.isFunction(o[s]) && "_" !== s.charAt(0) ? (i = o[s].apply(o, l), i !== o && i !== t ? (c = i && i.jquery ? c.pushStack(i.get()) : i, !1) : void 0) : e.error("no such method '" + s + "' for " + n + " widget instance") : e.error("cannot call methods on " + n + " prior to initialization; attempted to call method '" + s + "'") } : function() {
                    var t = e.data(this, r);
                    t ? t.option(s || {})._init() : e.data(this, r, new o(s, this)) }), c } }, e.Widget = function() {}, e.Widget._childConstructors = [], e.Widget.prototype = { widgetName: "widget", widgetEventPrefix: "", defaultElement: "<div>", options: { disabled: !1, create: null }, _createWidget: function(t, i) { i = e(i || this.defaultElement || this)[0], this.element = e(i), this.uuid = n++, this.eventNamespace = "." + this.widgetName + this.uuid, this.options = e.widget.extend({}, this.options, this._getCreateOptions(), t), this.bindings = e(), this.hoverable = e(), this.focusable = e(), i !== this && (e.data(i, this.widgetFullName, this), this._on(!0, this.element, { remove: function(e) { e.target === i && this.destroy() } }), this.document = e(i.style ? i.ownerDocument : i.document || i), this.window = e(this.document[0].defaultView || this.document[0].parentWindow)), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init() }, _getCreateOptions: e.noop, _getCreateEventData: e.noop, _create: e.noop, _init: e.noop, destroy: function() { this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(e.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus") }, _destroy: e.noop, widget: function() {
                return this.element }, option: function(n, i) {
                var o, r, s, a = n;
                if (0 === arguments.length) return e.widget.extend({}, this.options);
                if ("string" == typeof n)
                    if (a = {}, o = n.split("."), n = o.shift(), o.length) {
                        for (r = a[n] = e.widget.extend({}, this.options[n]), s = 0; s < o.length - 1; s++) r[o[s]] = r[o[s]] || {}, r = r[o[s]];
                        if (n = o.pop(), 1 === arguments.length) return r[n] === t ? null : r[n];
                        r[n] = i } else {
                        if (1 === arguments.length) return this.options[n] === t ? null : this.options[n];
                        a[n] = i }
                return this._setOptions(a), this }, _setOptions: function(e) {
                var t;
                for (t in e) this._setOption(t, e[t]);
                return this }, _setOption: function(e, t) {
                return this.options[e] = t, "disabled" === e && (this.widget().toggleClass(this.widgetFullName + "-disabled ui-state-disabled", !!t).attr("aria-disabled", t), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")), this }, enable: function() {
                return this._setOption("disabled", !1) }, disable: function() {
                return this._setOption("disabled", !0) }, _on: function(t, n, i) {
                var o, r = this; "boolean" != typeof t && (i = n, n = t, t = !1), i ? (n = o = e(n), this.bindings = this.bindings.add(n)) : (i = n, n = this.element, o = this.widget()), e.each(i, function(i, s) {
                    function a() {
                        return t || r.options.disabled !== !0 && !e(this).hasClass("ui-state-disabled") ? ("string" == typeof s ? r[s] : s).apply(r, arguments) : void 0 } "string" != typeof s && (a.guid = s.guid = s.guid || a.guid || e.guid++);
                    var l = i.match(/^(\w+)\s*(.*)$/),
                        c = l[1] + r.eventNamespace,
                        u = l[2];
                    u ? o.delegate(u, c, a) : n.bind(c, a) }) }, _off: function(e, t) { t = (t || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, e.unbind(t).undelegate(t) }, _delay: function(e, t) {
                function n() {
                    return ("string" == typeof e ? i[e] : e).apply(i, arguments) }
                var i = this;
                return setTimeout(n, t || 0) }, _hoverable: function(t) { this.hoverable = this.hoverable.add(t), this._on(t, { mouseenter: function(t) { e(t.currentTarget).addClass("ui-state-hover") }, mouseleave: function(t) { e(t.currentTarget).removeClass("ui-state-hover") } }) }, _focusable: function(t) { this.focusable = this.focusable.add(t), this._on(t, { focusin: function(t) { e(t.currentTarget).addClass("ui-state-focus") }, focusout: function(t) { e(t.currentTarget).removeClass("ui-state-focus") } }) }, _trigger: function(t, n, i) {
                var o, r, s = this.options[t];
                if (i = i || {}, n = e.Event(n), n.type = (t === this.widgetEventPrefix ? t : this.widgetEventPrefix + t).toLowerCase(), n.target = this.element[0], r = n.originalEvent)
                    for (o in r) o in n || (n[o] = r[o]);
                return this.element.trigger(n, i), !(e.isFunction(s) && s.apply(this.element[0], [n].concat(i)) === !1 || n.isDefaultPrevented()) } }, e.each({ show: "fadeIn", hide: "fadeOut" }, function(t, n) { e.Widget.prototype["_" + t] = function(i, o, r) { "string" == typeof o && (o = { effect: o });
                var s, a = o ? o === !0 || "number" == typeof o ? n : o.effect || n : t;
                o = o || {}, "number" == typeof o && (o = { duration: o }), s = !e.isEmptyObject(o), o.complete = r, o.delay && i.delay(o.delay), s && e.effects && e.effects.effect[a] ? i[t](o) : a !== t && i[a] ? i[a](o.duration, o.easing, r) : i.queue(function(n) { e(this)[t](), r && r.call(i[0]), n() }) } }) }(jQuery),
    function(e, t) {
        var n = !1;
        e(document).mouseup(function() { n = !1 }), e.widget("ui.mouse", { version: "1.10.4", options: { cancel: "input,textarea,button,select,option", distance: 1, delay: 0 }, _mouseInit: function() {
                var t = this;
                this.element.bind("mousedown." + this.widgetName, function(e) {
                    return t._mouseDown(e) }).bind("click." + this.widgetName, function(n) {
                    return !0 === e.data(n.target, t.widgetName + ".preventClickEvent") ? (e.removeData(n.target, t.widgetName + ".preventClickEvent"), n.stopImmediatePropagation(), !1) : void 0 }), this.started = !1 }, _mouseDestroy: function() { this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && e(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate) }, _mouseDown: function(t) {
                if (!n) { this._mouseStarted && this._mouseUp(t), this._mouseDownEvent = t;
                    var i = this,
                        o = 1 === t.which,
                        r = "string" == typeof this.options.cancel && t.target.nodeName ? e(t.target).closest(this.options.cancel).length : !1;
                    return o && !r && this._mouseCapture(t) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() { i.mouseDelayMet = !0 }, this.options.delay)), this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(t) !== !1, !this._mouseStarted) ? (t.preventDefault(), !0) : (!0 === e.data(t.target, this.widgetName + ".preventClickEvent") && e.removeData(t.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(e) {
                        return i._mouseMove(e) }, this._mouseUpDelegate = function(e) {
                        return i._mouseUp(e) }, e(document).bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), t.preventDefault(), n = !0, !0)) : !0 } }, _mouseMove: function(t) {
                return e.ui.ie && (!document.documentMode || document.documentMode < 9) && !t.button ? this._mouseUp(t) : this._mouseStarted ? (this._mouseDrag(t), t.preventDefault()) : (this._mouseDistanceMet(t) && this._mouseDelayMet(t) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, t) !== !1, this._mouseStarted ? this._mouseDrag(t) : this._mouseUp(t)), !this._mouseStarted) }, _mouseUp: function(t) {
                return e(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, t.target === this._mouseDownEvent.target && e.data(t.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(t)), !1 }, _mouseDistanceMet: function(e) {
                return Math.max(Math.abs(this._mouseDownEvent.pageX - e.pageX), Math.abs(this._mouseDownEvent.pageY - e.pageY)) >= this.options.distance }, _mouseDelayMet: function() {
                return this.mouseDelayMet }, _mouseStart: function() {}, _mouseDrag: function() {}, _mouseStop: function() {}, _mouseCapture: function() {
                return !0 } }) }(jQuery),
    function(e, t) {
        e.widget("ui.draggable", e.ui.mouse, {
            version: "1.10.4",
            widgetEventPrefix: "drag",
            options: { addClasses: !0, appendTo: "parent", axis: !1, connectToSortable: !1, containment: !1, cursor: "auto", cursorAt: !1, grid: !1, handle: !1, helper: "original", iframeFix: !1, opacity: !1, refreshPositions: !1, revert: !1, revertDuration: 500, scope: "default", scroll: !0, scrollSensitivity: 20, scrollSpeed: 20, snap: !1, snapMode: "both", snapTolerance: 20, stack: !1, zIndex: !1, drag: null, start: null, stop: null },
            _create: function() { "original" !== this.options.helper || /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._mouseInit() },
            _destroy: function() { this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._mouseDestroy() },
            _mouseCapture: function(t) {
                var n = this.options;
                return this.helper || n.disabled || e(t.target).closest(".ui-resizable-handle").length > 0 ? !1 : (this.handle = this._getHandle(t), this.handle ? (e(n.iframeFix === !0 ? "iframe" : n.iframeFix).each(function() { e("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({ width: this.offsetWidth + "px", height: this.offsetHeight + "px", position: "absolute", opacity: "0.001", zIndex: 1e3 }).css(e(this).offset()).appendTo("body") }), !0) : !1) },
            _mouseStart: function(t) {
                var n = this.options;
                return this.helper = this._createHelper(t), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), e.ui.ddmanager && (e.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(), this.offsetParent = this.helper.offsetParent(), this.offsetParentCssPosition = this.offsetParent.css("position"), this.offset = this.positionAbs = this.element.offset(), this.offset = { top: this.offset.top - this.margins.top, left: this.offset.left - this.margins.left }, this.offset.scroll = !1, e.extend(this.offset, { click: { left: t.pageX - this.offset.left, top: t.pageY - this.offset.top }, parent: this._getParentOffset(), relative: this._getRelativeOffset() }), this.originalPosition = this.position = this._generatePosition(t), this.originalPageX = t.pageX, this.originalPageY = t.pageY, n.cursorAt && this._adjustOffsetFromHelper(n.cursorAt), this._setContainment(), this._trigger("start", t) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), e.ui.ddmanager && !n.dropBehaviour && e.ui.ddmanager.prepareOffsets(this, t), this._mouseDrag(t, !0), e.ui.ddmanager && e.ui.ddmanager.dragStart(this, t), !0) },
            _mouseDrag: function(t, n) {
                if ("fixed" === this.offsetParentCssPosition && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(t), this.positionAbs = this._convertPositionTo("absolute"), !n) {
                    var i = this._uiHash();
                    if (this._trigger("drag", t, i) === !1) return this._mouseUp({}), !1;
                    this.position = i.position }
                return this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), e.ui.ddmanager && e.ui.ddmanager.drag(this, t), !1
            },
            _mouseStop: function(t) {
                var n = this,
                    i = !1;
                return e.ui.ddmanager && !this.options.dropBehaviour && (i = e.ui.ddmanager.drop(this, t)), this.dropped && (i = this.dropped, this.dropped = !1), "original" !== this.options.helper || e.contains(this.element[0].ownerDocument, this.element[0]) ? ("invalid" === this.options.revert && !i || "valid" === this.options.revert && i || this.options.revert === !0 || e.isFunction(this.options.revert) && this.options.revert.call(this.element, i) ? e(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() { n._trigger("stop", t) !== !1 && n._clear() }) : this._trigger("stop", t) !== !1 && this._clear(), !1) : !1 },
            _mouseUp: function(t) {
                return e("div.ui-draggable-iframeFix").each(function() { this.parentNode.removeChild(this) }), e.ui.ddmanager && e.ui.ddmanager.dragStop(this, t), e.ui.mouse.prototype._mouseUp.call(this, t) },
            cancel: function() {
                return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this },
            _getHandle: function(t) {
                return this.options.handle ? !!e(t.target).closest(this.element.find(this.options.handle)).length : !0 },
            _createHelper: function(t) {
                var n = this.options,
                    i = e.isFunction(n.helper) ? e(n.helper.apply(this.element[0], [t])) : "clone" === n.helper ? this.element.clone().removeAttr("id") : this.element;
                return i.parents("body").length || i.appendTo("parent" === n.appendTo ? this.element[0].parentNode : n.appendTo), i[0] === this.element[0] || /(fixed|absolute)/.test(i.css("position")) || i.css("position", "absolute"), i },
            _adjustOffsetFromHelper: function(t) { "string" == typeof t && (t = t.split(" ")), e.isArray(t) && (t = { left: +t[0], top: +t[1] || 0 }), "left" in t && (this.offset.click.left = t.left + this.margins.left), "right" in t && (this.offset.click.left = this.helperProportions.width - t.right + this.margins.left), "top" in t && (this.offset.click.top = t.top + this.margins.top), "bottom" in t && (this.offset.click.top = this.helperProportions.height - t.bottom + this.margins.top) },
            _getParentOffset: function() {
                var t = this.offsetParent.offset();
                return "absolute" === this.cssPosition && this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) && (t.left += this.scrollParent.scrollLeft(), t.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && e.ui.ie) && (t = { top: 0, left: 0 }), { top: t.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0), left: t.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0) } },
            _getRelativeOffset: function() {
                if ("relative" === this.cssPosition) {
                    var e = this.element.position();
                    return { top: e.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(), left: e.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft() } }
                return { top: 0, left: 0 } },
            _cacheMargins: function() { this.margins = { left: parseInt(this.element.css("marginLeft"), 10) || 0, top: parseInt(this.element.css("marginTop"), 10) || 0, right: parseInt(this.element.css("marginRight"), 10) || 0, bottom: parseInt(this.element.css("marginBottom"), 10) || 0 } },
            _cacheHelperProportions: function() { this.helperProportions = { width: this.helper.outerWidth(), height: this.helper.outerHeight() } },
            _setContainment: function() {
                var t, n, i, o = this.options;
                return o.containment ? "window" === o.containment ? void(this.containment = [e(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, e(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, e(window).scrollLeft() + e(window).width() - this.helperProportions.width - this.margins.left, e(window).scrollTop() + (e(window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : "document" === o.containment ? void(this.containment = [0, 0, e(document).width() - this.helperProportions.width - this.margins.left, (e(document).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : o.containment.constructor === Array ? void(this.containment = o.containment) : ("parent" === o.containment && (o.containment = this.helper[0].parentNode), n = e(o.containment), i = n[0], void(i && (t = "hidden" !== n.css("overflow"), this.containment = [(parseInt(n.css("borderLeftWidth"), 10) || 0) + (parseInt(n.css("paddingLeft"), 10) || 0), (parseInt(n.css("borderTopWidth"), 10) || 0) + (parseInt(n.css("paddingTop"), 10) || 0), (t ? Math.max(i.scrollWidth, i.offsetWidth) : i.offsetWidth) - (parseInt(n.css("borderRightWidth"), 10) || 0) - (parseInt(n.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (t ? Math.max(i.scrollHeight, i.offsetHeight) : i.offsetHeight) - (parseInt(n.css("borderBottomWidth"), 10) || 0) - (parseInt(n.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relative_container = n))) : void(this.containment = null) },
            _convertPositionTo: function(t, n) { n || (n = this.position);
                var i = "absolute" === t ? 1 : -1,
                    o = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent;
                return this.offset.scroll || (this.offset.scroll = { top: o.scrollTop(), left: o.scrollLeft() }), { top: n.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top) * i, left: n.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left) * i } },
            _generatePosition: function(t) {
                var n, i, o, r, s = this.options,
                    a = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                    l = t.pageX,
                    c = t.pageY;
                return this.offset.scroll || (this.offset.scroll = { top: a.scrollTop(), left: a.scrollLeft() }), this.originalPosition && (this.containment && (this.relative_container ? (i = this.relative_container.offset(), n = [this.containment[0] + i.left, this.containment[1] + i.top, this.containment[2] + i.left, this.containment[3] + i.top]) : n = this.containment, t.pageX - this.offset.click.left < n[0] && (l = n[0] + this.offset.click.left), t.pageY - this.offset.click.top < n[1] && (c = n[1] + this.offset.click.top), t.pageX - this.offset.click.left > n[2] && (l = n[2] + this.offset.click.left), t.pageY - this.offset.click.top > n[3] && (c = n[3] + this.offset.click.top)), s.grid && (o = s.grid[1] ? this.originalPageY + Math.round((c - this.originalPageY) / s.grid[1]) * s.grid[1] : this.originalPageY, c = n ? o - this.offset.click.top >= n[1] || o - this.offset.click.top > n[3] ? o : o - this.offset.click.top >= n[1] ? o - s.grid[1] : o + s.grid[1] : o, r = s.grid[0] ? this.originalPageX + Math.round((l - this.originalPageX) / s.grid[0]) * s.grid[0] : this.originalPageX, l = n ? r - this.offset.click.left >= n[0] || r - this.offset.click.left > n[2] ? r : r - this.offset.click.left >= n[0] ? r - s.grid[0] : r + s.grid[0] : r)), { top: c - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top), left: l - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left) } },
            _clear: function() { this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1 },
            _trigger: function(t, n, i) {
                return i = i || this._uiHash(), e.ui.plugin.call(this, t, [n, i]), "drag" === t && (this.positionAbs = this._convertPositionTo("absolute")), e.Widget.prototype._trigger.call(this, t, n, i) },
            plugins: {},
            _uiHash: function() {
                return { helper: this.helper, position: this.position, originalPosition: this.originalPosition, offset: this.positionAbs } }
        }), e.ui.plugin.add("draggable", "connectToSortable", { start: function(t, n) {
                var i = e(this).data("ui-draggable"),
                    o = i.options,
                    r = e.extend({}, n, { item: i.element });
                i.sortables = [], e(o.connectToSortable).each(function() {
                    var n = e.data(this, "ui-sortable");
                    n && !n.options.disabled && (i.sortables.push({ instance: n, shouldRevert: n.options.revert }), n.refreshPositions(), n._trigger("activate", t, r)) }) }, stop: function(t, n) {
                var i = e(this).data("ui-draggable"),
                    o = e.extend({}, n, { item: i.element });
                e.each(i.sortables, function() { this.instance.isOver ? (this.instance.isOver = 0, i.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = this.shouldRevert), this.instance._mouseStop(t), this.instance.options.helper = this.instance.options._helper, "original" === i.options.helper && this.instance.currentItem.css({ top: "auto", left: "auto" })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", t, o)) }) }, drag: function(t, n) {
                var i = e(this).data("ui-draggable"),
                    o = this;
                e.each(i.sortables, function() {
                    var r = !1,
                        s = this;
                    this.instance.positionAbs = i.positionAbs, this.instance.helperProportions = i.helperProportions, this.instance.offset.click = i.offset.click, this.instance._intersectsWith(this.instance.containerCache) && (r = !0, e.each(i.sortables, function() {
                        return this.instance.positionAbs = i.positionAbs, this.instance.helperProportions = i.helperProportions, this.instance.offset.click = i.offset.click, this !== s && this.instance._intersectsWith(this.instance.containerCache) && e.contains(s.instance.element[0], this.instance.element[0]) && (r = !1), r })), r ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = e(o).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", !0), this.instance.options._helper = this.instance.options.helper, this.instance.options.helper = function() {
                        return n.helper[0] }, t.target = this.instance.currentItem[0], this.instance._mouseCapture(t, !0), this.instance._mouseStart(t, !0, !0), this.instance.offset.click.top = i.offset.click.top, this.instance.offset.click.left = i.offset.click.left, this.instance.offset.parent.left -= i.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= i.offset.parent.top - this.instance.offset.parent.top, i._trigger("toSortable", t), i.dropped = this.instance.element, i.currentItem = i.element, this.instance.fromOutside = i), this.instance.currentItem && this.instance._mouseDrag(t)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", t, this.instance._uiHash(this.instance)), this.instance._mouseStop(t, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(), i._trigger("fromSortable", t), i.dropped = !1) }) } }), e.ui.plugin.add("draggable", "cursor", { start: function() {
                var t = e("body"),
                    n = e(this).data("ui-draggable").options;
                t.css("cursor") && (n._cursor = t.css("cursor")), t.css("cursor", n.cursor) }, stop: function() {
                var t = e(this).data("ui-draggable").options;
                t._cursor && e("body").css("cursor", t._cursor) } }), e.ui.plugin.add("draggable", "opacity", { start: function(t, n) {
                var i = e(n.helper),
                    o = e(this).data("ui-draggable").options;
                i.css("opacity") && (o._opacity = i.css("opacity")), i.css("opacity", o.opacity) }, stop: function(t, n) {
                var i = e(this).data("ui-draggable").options;
                i._opacity && e(n.helper).css("opacity", i._opacity) } }), e.ui.plugin.add("draggable", "scroll", { start: function() {
                var t = e(this).data("ui-draggable");
                t.scrollParent[0] !== document && "HTML" !== t.scrollParent[0].tagName && (t.overflowOffset = t.scrollParent.offset()) }, drag: function(t) {
                var n = e(this).data("ui-draggable"),
                    i = n.options,
                    o = !1;
                n.scrollParent[0] !== document && "HTML" !== n.scrollParent[0].tagName ? (i.axis && "x" === i.axis || (n.overflowOffset.top + n.scrollParent[0].offsetHeight - t.pageY < i.scrollSensitivity ? n.scrollParent[0].scrollTop = o = n.scrollParent[0].scrollTop + i.scrollSpeed : t.pageY - n.overflowOffset.top < i.scrollSensitivity && (n.scrollParent[0].scrollTop = o = n.scrollParent[0].scrollTop - i.scrollSpeed)), i.axis && "y" === i.axis || (n.overflowOffset.left + n.scrollParent[0].offsetWidth - t.pageX < i.scrollSensitivity ? n.scrollParent[0].scrollLeft = o = n.scrollParent[0].scrollLeft + i.scrollSpeed : t.pageX - n.overflowOffset.left < i.scrollSensitivity && (n.scrollParent[0].scrollLeft = o = n.scrollParent[0].scrollLeft - i.scrollSpeed))) : (i.axis && "x" === i.axis || (t.pageY - e(document).scrollTop() < i.scrollSensitivity ? o = e(document).scrollTop(e(document).scrollTop() - i.scrollSpeed) : e(window).height() - (t.pageY - e(document).scrollTop()) < i.scrollSensitivity && (o = e(document).scrollTop(e(document).scrollTop() + i.scrollSpeed))), i.axis && "y" === i.axis || (t.pageX - e(document).scrollLeft() < i.scrollSensitivity ? o = e(document).scrollLeft(e(document).scrollLeft() - i.scrollSpeed) : e(window).width() - (t.pageX - e(document).scrollLeft()) < i.scrollSensitivity && (o = e(document).scrollLeft(e(document).scrollLeft() + i.scrollSpeed)))), o !== !1 && e.ui.ddmanager && !i.dropBehaviour && e.ui.ddmanager.prepareOffsets(n, t) } }), e.ui.plugin.add("draggable", "snap", { start: function() {
                var t = e(this).data("ui-draggable"),
                    n = t.options;
                t.snapElements = [], e(n.snap.constructor !== String ? n.snap.items || ":data(ui-draggable)" : n.snap).each(function() {
                    var n = e(this),
                        i = n.offset();
                    this !== t.element[0] && t.snapElements.push({ item: this, width: n.outerWidth(), height: n.outerHeight(), top: i.top, left: i.left }) }) }, drag: function(t, n) {
                var i, o, r, s, a, l, c, u, d, p, h = e(this).data("ui-draggable"),
                    f = h.options,
                    m = f.snapTolerance,
                    g = n.offset.left,
                    v = g + h.helperProportions.width,
                    y = n.offset.top,
                    b = y + h.helperProportions.height;
                for (d = h.snapElements.length - 1; d >= 0; d--) a = h.snapElements[d].left, l = a + h.snapElements[d].width, c = h.snapElements[d].top, u = c + h.snapElements[d].height, a - m > v || g > l + m || c - m > b || y > u + m || !e.contains(h.snapElements[d].item.ownerDocument, h.snapElements[d].item) ? (h.snapElements[d].snapping && h.options.snap.release && h.options.snap.release.call(h.element, t, e.extend(h._uiHash(), { snapItem: h.snapElements[d].item })), h.snapElements[d].snapping = !1) : ("inner" !== f.snapMode && (i = Math.abs(c - b) <= m, o = Math.abs(u - y) <= m, r = Math.abs(a - v) <= m, s = Math.abs(l - g) <= m, i && (n.position.top = h._convertPositionTo("relative", { top: c - h.helperProportions.height, left: 0 }).top - h.margins.top), o && (n.position.top = h._convertPositionTo("relative", { top: u, left: 0 }).top - h.margins.top), r && (n.position.left = h._convertPositionTo("relative", { top: 0, left: a - h.helperProportions.width }).left - h.margins.left), s && (n.position.left = h._convertPositionTo("relative", { top: 0, left: l }).left - h.margins.left)), p = i || o || r || s, "outer" !== f.snapMode && (i = Math.abs(c - y) <= m, o = Math.abs(u - b) <= m, r = Math.abs(a - g) <= m, s = Math.abs(l - v) <= m, i && (n.position.top = h._convertPositionTo("relative", { top: c, left: 0 }).top - h.margins.top), o && (n.position.top = h._convertPositionTo("relative", { top: u - h.helperProportions.height, left: 0 }).top - h.margins.top), r && (n.position.left = h._convertPositionTo("relative", { top: 0, left: a }).left - h.margins.left), s && (n.position.left = h._convertPositionTo("relative", { top: 0, left: l - h.helperProportions.width }).left - h.margins.left)), !h.snapElements[d].snapping && (i || o || r || s || p) && h.options.snap.snap && h.options.snap.snap.call(h.element, t, e.extend(h._uiHash(), { snapItem: h.snapElements[d].item })), h.snapElements[d].snapping = i || o || r || s || p) } }), e.ui.plugin.add("draggable", "stack", { start: function() {
                var t, n = this.data("ui-draggable").options,
                    i = e.makeArray(e(n.stack)).sort(function(t, n) {
                        return (parseInt(e(t).css("zIndex"), 10) || 0) - (parseInt(e(n).css("zIndex"), 10) || 0) });
                i.length && (t = parseInt(e(i[0]).css("zIndex"), 10) || 0, e(i).each(function(n) { e(this).css("zIndex", t + n) }), this.css("zIndex", t + i.length)) } }), e.ui.plugin.add("draggable", "zIndex", { start: function(t, n) {
                var i = e(n.helper),
                    o = e(this).data("ui-draggable").options;
                i.css("zIndex") && (o._zIndex = i.css("zIndex")), i.css("zIndex", o.zIndex) }, stop: function(t, n) {
                var i = e(this).data("ui-draggable").options;
                i._zIndex && e(n.helper).css("zIndex", i._zIndex) } })
    }(jQuery),
    function(e, t) {
        function n(e, t, n) {
            return e > t && t + n > e }
        e.widget("ui.droppable", { version: "1.10.4", widgetEventPrefix: "drop", options: { accept: "*", activeClass: !1, addClasses: !0, greedy: !1, hoverClass: !1, scope: "default", tolerance: "intersect", activate: null, deactivate: null, drop: null, out: null, over: null }, _create: function() {
                var t, n = this.options,
                    i = n.accept;
                this.isover = !1, this.isout = !0, this.accept = e.isFunction(i) ? i : function(e) {
                    return e.is(i) }, this.proportions = function() {
                    return arguments.length ? void(t = arguments[0]) : t ? t : t = { width: this.element[0].offsetWidth, height: this.element[0].offsetHeight } }, e.ui.ddmanager.droppables[n.scope] = e.ui.ddmanager.droppables[n.scope] || [], e.ui.ddmanager.droppables[n.scope].push(this), n.addClasses && this.element.addClass("ui-droppable") }, _destroy: function() {
                for (var t = 0, n = e.ui.ddmanager.droppables[this.options.scope]; t < n.length; t++) n[t] === this && n.splice(t, 1);
                this.element.removeClass("ui-droppable ui-droppable-disabled") }, _setOption: function(t, n) { "accept" === t && (this.accept = e.isFunction(n) ? n : function(e) {
                    return e.is(n) }), e.Widget.prototype._setOption.apply(this, arguments) }, _activate: function(t) {
                var n = e.ui.ddmanager.current;
                this.options.activeClass && this.element.addClass(this.options.activeClass), n && this._trigger("activate", t, this.ui(n)) }, _deactivate: function(t) {
                var n = e.ui.ddmanager.current;
                this.options.activeClass && this.element.removeClass(this.options.activeClass), n && this._trigger("deactivate", t, this.ui(n)) }, _over: function(t) {
                var n = e.ui.ddmanager.current;
                n && (n.currentItem || n.element)[0] !== this.element[0] && this.accept.call(this.element[0], n.currentItem || n.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", t, this.ui(n))) }, _out: function(t) {
                var n = e.ui.ddmanager.current;
                n && (n.currentItem || n.element)[0] !== this.element[0] && this.accept.call(this.element[0], n.currentItem || n.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", t, this.ui(n))) }, _drop: function(t, n) {
                var i = n || e.ui.ddmanager.current,
                    o = !1;
                return i && (i.currentItem || i.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
                    var t = e.data(this, "ui-droppable");
                    return t.options.greedy && !t.options.disabled && t.options.scope === i.options.scope && t.accept.call(t.element[0], i.currentItem || i.element) && e.ui.intersect(i, e.extend(t, { offset: t.element.offset() }), t.options.tolerance) ? (o = !0, !1) : void 0 }), o ? !1 : this.accept.call(this.element[0], i.currentItem || i.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", t, this.ui(i)), this.element) : !1) : !1 }, ui: function(e) {
                return { draggable: e.currentItem || e.element, helper: e.helper, position: e.position, offset: e.positionAbs } } }), e.ui.intersect = function(e, t, i) {
            if (!t.offset) return !1;
            var o, r, s = (e.positionAbs || e.position.absolute).left,
                a = (e.positionAbs || e.position.absolute).top,
                l = s + e.helperProportions.width,
                c = a + e.helperProportions.height,
                u = t.offset.left,
                d = t.offset.top,
                p = u + t.proportions().width,
                h = d + t.proportions().height;
            switch (i) {
                case "fit":
                    return s >= u && p >= l && a >= d && h >= c;
                case "intersect":
                    return u < s + e.helperProportions.width / 2 && l - e.helperProportions.width / 2 < p && d < a + e.helperProportions.height / 2 && c - e.helperProportions.height / 2 < h;
                case "pointer":
                    return o = (e.positionAbs || e.position.absolute).left + (e.clickOffset || e.offset.click).left, r = (e.positionAbs || e.position.absolute).top + (e.clickOffset || e.offset.click).top, n(r, d, t.proportions().height) && n(o, u, t.proportions().width);
                case "touch":
                    return (a >= d && h >= a || c >= d && h >= c || d > a && c > h) && (s >= u && p >= s || l >= u && p >= l || u > s && l > p);
                default:
                    return !1 } }, e.ui.ddmanager = { current: null, droppables: { "default": [] }, prepareOffsets: function(t, n) {
                var i, o, r = e.ui.ddmanager.droppables[t.options.scope] || [],
                    s = n ? n.type : null,
                    a = (t.currentItem || t.element).find(":data(ui-droppable)").addBack();
                e: for (i = 0; i < r.length; i++)
                    if (!(r[i].options.disabled || t && !r[i].accept.call(r[i].element[0], t.currentItem || t.element))) {
                        for (o = 0; o < a.length; o++)
                            if (a[o] === r[i].element[0]) { r[i].proportions().height = 0;
                                continue e }
                        r[i].visible = "none" !== r[i].element.css("display"), r[i].visible && ("mousedown" === s && r[i]._activate.call(r[i], n), r[i].offset = r[i].element.offset(), r[i].proportions({ width: r[i].element[0].offsetWidth, height: r[i].element[0].offsetHeight })) } }, drop: function(t, n) {
                var i = !1;
                return e.each((e.ui.ddmanager.droppables[t.options.scope] || []).slice(), function() { this.options && (!this.options.disabled && this.visible && e.ui.intersect(t, this, this.options.tolerance) && (i = this._drop.call(this, n) || i), !this.options.disabled && this.visible && this.accept.call(this.element[0], t.currentItem || t.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, n))) }), i }, dragStart: function(t, n) { t.element.parentsUntil("body").bind("scroll.droppable", function() { t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, n) }) }, drag: function(t, n) { t.options.refreshPositions && e.ui.ddmanager.prepareOffsets(t, n), e.each(e.ui.ddmanager.droppables[t.options.scope] || [], function() {
                    if (!this.options.disabled && !this.greedyChild && this.visible) {
                        var i, o, r, s = e.ui.intersect(t, this, this.options.tolerance),
                            a = !s && this.isover ? "isout" : s && !this.isover ? "isover" : null;
                        a && (this.options.greedy && (o = this.options.scope, r = this.element.parents(":data(ui-droppable)").filter(function() {
                            return e.data(this, "ui-droppable").options.scope === o }), r.length && (i = e.data(r[0], "ui-droppable"), i.greedyChild = "isover" === a)), i && "isover" === a && (i.isover = !1, i.isout = !0, i._out.call(i, n)), this[a] = !0, this["isout" === a ? "isover" : "isout"] = !1, this["isover" === a ? "_over" : "_out"].call(this, n), i && "isout" === a && (i.isout = !1, i.isover = !0, i._over.call(i, n))) } }) }, dragStop: function(t, n) { t.element.parentsUntil("body").unbind("scroll.droppable"), t.options.refreshPositions || e.ui.ddmanager.prepareOffsets(t, n) } } }(jQuery),
    function(e) {
        function t(e, t) {
            if (!(e.originalEvent.touches.length > 1)) { e.preventDefault();
                var n = e.originalEvent.changedTouches[0],
                    i = document.createEvent("MouseEvents");
                i.initMouseEvent(t, !0, !0, window, 1, n.screenX, n.screenY, n.clientX, n.clientY, !1, !1, !1, !1, 0, null), e.target.dispatchEvent(i) } }
        if (e.support.touch = "ontouchend" in document, e.support.touch) {
            var n, i = e.ui.mouse.prototype,
                o = i._mouseInit,
                r = i._mouseDestroy;
            i._touchStart = function(e) {
                var i = this;!n && i._mouseCapture(e.originalEvent.changedTouches[0]) && (n = !0, i._touchMoved = !1, t(e, "mouseover"), t(e, "mousemove"), t(e, "mousedown")) }, i._touchMove = function(e) { n && (this._touchMoved = !0, t(e, "mousemove")) }, i._touchEnd = function(e) { n && (t(e, "mouseup"), t(e, "mouseout"), this._touchMoved || t(e, "click"), n = !1) }, i._mouseInit = function() {
                var t = this;
                t.element.bind({ touchstart: e.proxy(t, "_touchStart"), touchmove: e.proxy(t, "_touchMove"), touchend: e.proxy(t, "_touchEnd") }), o.call(t) }, i._mouseDestroy = function() {
                var t = this;
                t.element.unbind({ touchstart: e.proxy(t, "_touchStart"), touchmove: e.proxy(t, "_touchMove"), touchend: e.proxy(t, "_touchEnd") }), r.call(t) } } }(jQuery);
