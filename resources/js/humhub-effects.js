humhub.module('effects', function (module, require, $) {
    var snowStorm = function (g, f) {
        function k(a, d) {
            isNaN(d) && (d = 0);
            return Math.random() * a + d;
        }

        function x() {
            g.setTimeout(function () {
                a.start(!0)
            }, 20);
            a.events.remove(m ? f : g, "mousemove", x)
        }

        function y() {
            (!a.excludeMobile || !D) && x();
            a.events.remove(g, "load", y)
        }

        this.excludeMobile = this.autoStart = !0;
        this.flakesMax = 128;
        this.flakesMaxActive = 64;
        this.animationInterval = 33;
        this.useGPU = !0;
        this.className = null;
        this.excludeMobile = !0;
        this.flakeBottom = null;
        this.followMouse = !0;
        this.snowColor = "#fff";
        this.snowCharacter = "&bull;";
        this.snowStick = !0;
        this.targetElement = null;
        this.useMeltEffect = !0;
        this.usePixelPosition = this.usePositionFixed = this.useTwinkleEffect = !1;
        this.freezeOnBlur = !0;
        this.flakeRightOffset = this.flakeLeftOffset = 0;
        this.flakeHeight = this.flakeWidth = 8;
        this.vMaxX = 5;
        this.vMaxY = 4;
        this.zIndex = 0;
        var a = this, q, m = navigator.userAgent.match(/msie/i), E = navigator.userAgent.match(/msie 6/i), D = navigator.userAgent.match(/mobile|opera m(ob|in)/i), r = m && "BackCompat" === f.compatMode || E, h = null, n = null, l = null, p = null, s = null, z = null, A = null, v = 1, t = !1, w = !1, u;
        a:{try {
            f.createElement("div").style.opacity = "0.5"
        } catch (F) {
            u = !1;
            break a
        }
            u = !0
        }
        var B = !1, C = f.createDocumentFragment();
        q = function () {
            function c(b) {
                b = b.call(b);
                var c = b.length;
                e ? (b[1] = "on" + b[1], 3 < c && b.pop()) : 3 === c && b.push(!1);
                return b
            }

            function d(a, b) {
                var c = a.shift(), d = [f[b]];
                if (e) c[d](a[0], a[1]); else c[d].apply(c, a)
            }

            var e = !g.addEventListener && g.attachEvent, b = Array.prototype.slice, k = {add: e ? "attachEvent" : "addEventListener", remove: e ? "detachEvent" : "removeEventListener"};
            return {add: function () {
                d(c(arguments), "add")
            }, remove: function () {
                d(c(arguments), "remove")
            }}
        }();
        a.randomizeWind = function () {
            var c;
            c = k(a.vMaxX, 0.2);
            z = 1 === parseInt(k(2), 10) ? -1 * c : c;
            A = k(a.vMaxY, 0.2);
            if (this.flakes) for (c = 0; c < this.flakes.length; c++) this.flakes[c].active && this.flakes[c].setVelocities()
        };
        a.scrollHandler = function () {
            var c;
            p = a.flakeBottom ? 0 : parseInt(g.scrollY || f.documentElement.scrollTop || (r ? f.body.scrollTop : 0), 10);
            isNaN(p) && (p = 0);
            if (!t && !a.flakeBottom && a.flakes) for (c = 0; c < a.flakes.length; c++) 0 === a.flakes[c].active && a.flakes[c].stick()
        };
        a.resizeHandler = function () {
            g.innerWidth || g.innerHeight ? (h = g.innerWidth - 16 - a.flakeRightOffset, l = a.flakeBottom || g.innerHeight) : (h = (f.documentElement.clientWidth || f.body.clientWidth || f.body.scrollWidth) - (!m ? 8 : 0) - a.flakeRightOffset, l = a.flakeBottom || f.documentElement.clientHeight || f.body.clientHeight || f.body.scrollHeight);
            s = f.body.offsetHeight;
            n = parseInt(h / 2, 10)
        };
        a.resizeHandlerAlt = function () {
            h = a.targetElement.offsetWidth - a.flakeRightOffset;
            l = a.flakeBottom || a.targetElement.offsetHeight;
            n = parseInt(h / 2, 10);
            s = f.body.offsetHeight
        };
        a.freeze = function () {
            if (a.disabled) return !1;
            a.disabled = 1;
            a.timer = null
        };
        a.resume = function () {
            if (a.disabled) a.disabled = 0; else return !1;
            a.timerInit()
        };
        a.toggleSnow = function () {
            a.flakes.length ? (a.active = !a.active, a.active ? (a.show(), a.resume()) : (a.stop(), a.freeze())) : a.start()
        };
        a.stop = function () {
            var c;
            this.freeze();
            for (c = 0; c < this.flakes.length; c++) this.flakes[c].o.style.display = "none";
            a.events.remove(g, "scroll", a.scrollHandler);
            a.events.remove(g, "resize", a.resizeHandler);
            a.freezeOnBlur && (m ? (a.events.remove(f, "focusout", a.freeze), a.events.remove(f, "focusin", a.resume)) : (a.events.remove(g, "blur", a.freeze), a.events.remove(g, "focus", a.resume)))
        };
        a.show = function () {
            var a;
            for (a = 0; a < this.flakes.length; a++) this.flakes[a].o.style.display = "block"
        };
        a.SnowFlake = function (c, d, e) {
            var b = this;
            this.type = c;
            this.x = d || parseInt(k(h - 20), 10);
            this.y = !isNaN(e) ? e : -k(l) - 12;
            this.vY = this.vX = null;
            this.vAmpTypes = [1, 1.2, 1.4, 1.6, 1.8];
            this.vAmp = this.vAmpTypes[this.type] || 1;
            this.melting = !1;
            this.meltFrameCount = a.meltFrameCount;
            this.meltFrames = a.meltFrames;
            this.twinkleFrame = this.meltFrame = 0;
            this.active = 1;
            this.fontSize = 10 + 10 * (this.type / 5);
            this.o = f.createElement("div");
            this.o.innerHTML = a.snowCharacter;
            a.className && this.o.setAttribute("class", a.className);
            this.o.style.color = a.snowColor;
            this.o.style.position = t ? "fixed" : "absolute";
            a.useGPU && q.transform.prop && (this.o.style[q.transform.prop] = "translate3d(0px, 0px, 0px)");
            this.o.style.width = a.flakeWidth + "px";
            this.o.style.height = a.flakeHeight + "px";
            this.o.style.fontFamily = "arial,verdana";
            this.o.style.cursor = "default";
            this.o.style.overflow = "hidden";
            this.o.style.fontWeight = "normal";
            this.o.style.zIndex = a.zIndex;
            C.appendChild(this.o);
            this.refresh = function () {
                if (isNaN(b.x) || isNaN(b.y)) return !1;
                a.setXY(b.o, b.x, b.y)
            };
            this.stick = function () {
                r || a.targetElement !== f.documentElement && a.targetElement !== f.body ? b.o.style.top = l + p - a.flakeHeight + "px" : a.flakeBottom ? b.o.style.top = a.flakeBottom + "px" : (b.o.style.display = "none", b.o.style.top = "auto", b.o.style.bottom = "0%", b.o.style.position = "fixed", b.o.style.display = "block")
            };
            this.vCheck = function () {
                0 <= b.vX && 0.2 > b.vX ? b.vX = 0.2 : 0 > b.vX && -0.2 < b.vX && (b.vX = -0.2);
                0 <= b.vY && 0.2 > b.vY && (b.vY = 0.2)
            };
            this.move = function () {
                var c = b.vX * v;
                b.x += c;
                b.y += b.vY * b.vAmp;
                b.x >= h || h - b.x < a.flakeWidth ? b.x = 0 : 0 > c && b.x - a.flakeLeftOffset < -a.flakeWidth && (b.x = h - a.flakeWidth - 1);
                b.refresh();
                l + p - b.y + a.flakeHeight < a.flakeHeight ? (b.active = 0, a.snowStick ? b.stick() : b.recycle()) : (a.useMeltEffect && (b.active && 3 > b.type && !b.melting && 0.998 < Math.random()) && (b.melting = !0, b.melt()), a.useTwinkleEffect && (0 > b.twinkleFrame ? 0.97 < Math.random() && (b.twinkleFrame = parseInt(8 * Math.random(), 10)) : b.twinkleFrame--, u ? b.o.style.opacity = b.twinkleFrame && 0 === b.twinkleFrame % 2 ? 0 : 1 : b.o.style.visibility = b.twinkleFrame && 0 === b.twinkleFrame % 2 ? "hidden" : "visible"))
            };
            this.animate = function () {
                b.move()
            };
            this.setVelocities = function () {
                b.vX = z + k(0.12 * a.vMaxX, 0.1);
                b.vY = A + k(0.12 * a.vMaxY, 0.1)
            };
            this.recycle = function () {
                b.o.style.display = "none";
                b.o.style.position = t ? "fixed" : "absolute";
                b.o.style.bottom = "auto";
                b.setVelocities();
                b.vCheck();
                b.meltFrame = 0;
                b.melting = !1;
                b.setOpacity(b.o, 1);
                b.o.style.padding = "0px";
                b.o.style.margin = "0px";
                b.o.style.fontSize = b.fontSize + "px";
                b.o.style.lineHeight = a.flakeHeight + 2 + 0.75 * a.flakeHeight + "px";
                b.o.style.textAlign = "center";
                b.o.style.verticalAlign = "baseline";
                b.x = parseInt(k(h - a.flakeWidth - 20), 10);
                b.y = parseInt(-1 * k(l), 10) - a.flakeHeight;
                b.refresh();
                b.o.style.display = "block";
                b.active = 1
            };
            this.recycle();
            this.refresh()
        };
        a.snow = function () {
            var c = 0, d = null, e;
            for (e = 0; e < a.meltFrameCount; e++) a.meltFrames.push(1 - e / a.meltFrameCount);
            a.randomizeWind();
            a.createSnow(a.flakesMax);
            a.events.add(g, "resize", a.resizeHandler);
            a.events.add(g, "scroll", a.scrollHandler);
            a.freezeOnBlur && (m ? (a.events.add(f, "focusout", a.freeze), a.events.add(f, "focusin", a.resume)) : (a.events.add(g, "blur", a.freeze), a.events.add(g, "focus", a.resume)));
            a.resizeHandler();
            a.scrollHandler();
            a.followMouse && a.events.add(m ? f : g, "mousemove", a.mouseMove);
            a.animationInterval = Math.max(20, a.animationInterval);
            a.timerInit()
        };
        a.mouseMove = function (c) {
            if (!a.followMouse) return !0;
            c = parseInt(c.clientX, 10);
            c < n ? v = -2 + 2 * (c / n) : (c -= n, v = 2 * (c / n))
        };
        a.createSnow = function (c, d) {
            var e;
            for (e = 0; e < c; e++) if (a.flakes[a.flakes.length] = new a.SnowFlake(parseInt(k(6), 10)), d || e > a.flakesMaxActive) a.flakes[a.flakes.length - 1].active = -1;
            a.targetElement.appendChild(C)
        };
        a.timerInit = function () {
            a.timer = !0;
            a.snow()
        };
        a.init = function () {
            var c;
            for (c = 0; c < a.meltFrameCount; c++) a.meltFrames.push(1 - c / a.meltFrameCount);
            a.randomizeWind();
            a.createSnow(a.flakesMax);
            a.events.add(g, "resize", a.resizeHandler);
            a.events.add(g, "scroll", a.scrollHandler);
            a.freezeOnBlur && (m ? (a.events.add(f, "focusout", a.freeze), a.events.add(f, "focusin", a.resume)) : (a.events.add(g, "blur", a.freeze), a.events.add(g, "focus", a.resume)));
            a.resizeHandler();
            a.scrollHandler();
            a.followMouse && a.events.add(m ? f : g, "mousemove", a.mouseMove);
            a.animationInterval = Math.max(20, a.animationInterval);
            a.timerInit()
        };
        a.start = function (c) {
            B ? c || (y(), a.active = !0) : (B = !0, c && y());
            if ("string" === typeof a.targetElement && (c = a.targetElement, a.targetElement = f.getElementById(c), !a.targetElement)) throw Error('Snowstorm: Unable to get targetElement "' + c + '"');
            a.targetElement || (a.targetElement = f.body || f.documentElement);
            a.targetElement !== f.documentElement && a.targetElement !== f.body && (a.resizeHandler = a.resizeHandlerAlt, a.usePixelPosition = !0);
            a.resizeHandler();
            a.usePositionFixed = a.usePositionFixed && !r && !a.flakeBottom;
            h && (l && !a.disabled) && (a.init(), a.active = !0)
        };
        a.autoStart && a.events.add(g, "load", y, !1);
        return this
    }(window, document);

    module.export({
        initOnPjaxLoad: true,
        init: function () {
            snowStorm.start();
        }
    });

    // Initialize snowfall when the page loads
    snowStorm.start();
});