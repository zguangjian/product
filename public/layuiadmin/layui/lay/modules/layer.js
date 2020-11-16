/** layui-v2.5.5 MIT License By https://www.layui.com */
!function (i, d) {
    var e = i.layui && layui.define, f, h, j = {
        getPath: function () {
            var l = document.currentScript ? document.currentScript.src : function () {
                var o = document.scripts, n = o.length - 1, p;
                for (var m = n; m > 0; m--) {
                    if (o[m].readyState === "interactive") {
                        p = o[m].src;
                        break
                    }
                }
                return p || o[n].src
            }();
            return l.substring(0, l.lastIndexOf("/") + 1)
        }(),
        config: {},
        end: {},
        minIndex: 0,
        minLeft: [],
        btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
        type: ["dialog", "page", "iframe", "loading", "tips"],
        getStyle: function (n, l) {
            var m = n.currentStyle ? n.currentStyle : i.getComputedStyle(n, null);
            return m[m.getPropertyValue ? "getPropertyValue" : "getAttribute"](l)
        },
        link: function (l, s, m) {
            if (!g.path) {
                return
            }
            var t = document.getElementsByTagName("head")[0], r = document.createElement("link");
            if (typeof s === "string") {
                m = s
            }
            var o = (m || l).replace(/\.|\//g, "");
            var n = "layuicss-" + o, q = 0;
            r.rel = "stylesheet";
            r.href = g.path + l;
            r.id = n;
            if (!document.getElementById(n)) {
                t.appendChild(r)
            }
            if (typeof s !== "function") {
                return
            }
            (function p() {
                if (++q > 8 * 1000 / 100) {
                    return i.console && console.error("layer.css: Invalid")
                }
                parseInt(j.getStyle(document.getElementById(n), "width")) === 1989 ? s() : setTimeout(p, 100)
            }())
        }
    };
    var g = {
        v: "3.1.1", ie: function () {
            var l = navigator.userAgent.toLowerCase();
            return (!!i.ActiveXObject || "ActiveXObject" in i) ? ((l.match(/msie\s(\d+)/) || [])[1] || "11") : false
        }(), index: (i.layer && i.layer.v) ? 100000 : 0, path: j.getPath, config: function (l, m) {
            l = l || {};
            g.cache = j.config = f.extend({}, j.config, l);
            g.path = j.config.path || g.path;
            typeof l.extend === "string" && (l.extend = [l.extend]);
            if (j.config.path) {
                g.ready()
            }
            if (!l.extend) {
                return this
            }
            e ? layui.addcss("modules/layer/" + l.extend) : j.link("theme/" + l.extend);
            return this
        }, ready: function (o) {
            var m = "layer", l = "", n = (e ? "modules/layer/" : "theme/") + "default/layer.css?v=" + g.v + l;
            e ? layui.addcss(n, o, m) : j.link(n, o, m);
            return this
        }, alert: function (n, l, o) {
            var m = typeof l === "function";
            if (m) {
                o = l
            }
            return g.open(f.extend({content: n, yes: o}, m ? {} : l))
        }, confirm: function (o, l, p, n) {
            var m = typeof l === "function";
            if (m) {
                n = p;
                p = l
            }
            return g.open(f.extend({content: o, btn: j.btn, yes: p, btn2: n}, m ? {} : l))
        }, msg: function (o, m, l) {
            var n = typeof m === "function", r = j.config.skin;
            var q = (r ? r + " " + r + "-msg" : "") || "layui-layer-msg";
            var p = c.anim.length - 1;
            if (n) {
                l = m
            }
            return g.open(f.extend({
                content: o,
                time: 3000,
                shade: false,
                skin: q,
                title: false,
                closeBtn: false,
                btn: false,
                resize: false,
                end: l
            }, (n && !j.config.skin) ? {skin: q + " layui-layer-hui", anim: p} : function () {
                m = m || {};
                if (m.icon === -1 || m.icon === d && !j.config.skin) {
                    m.skin = q + " " + (m.skin || "layui-layer-hui")
                }
                return m
            }()))
        }, load: function (m, l) {
            return g.open(f.extend({type: 3, icon: m || 0, resize: false, shade: 0.01}, l))
        }, tips: function (n, l, m) {
            return g.open(f.extend({
                type: 4,
                content: [n, l],
                closeBtn: false,
                time: 3000,
                shade: false,
                resize: false,
                fixed: false,
                maxWidth: 210
            }, m))
        }
    };
    var b = function (l) {
        var m = this;
        m.index = ++g.index;
        m.config = f.extend({}, m.config, j.config, l);
        document.body ? m.creat() : setTimeout(function () {
            m.creat()
        }, 30)
    };
    b.pt = b.prototype;
    var c = ["layui-layer", ".layui-layer-title", ".layui-layer-main", ".layui-layer-dialog", "layui-layer-iframe", "layui-layer-content", "layui-layer-btn", "layui-layer-close"];
    c.anim = ["layer-anim-00", "layer-anim-01", "layer-anim-02", "layer-anim-03", "layer-anim-04", "layer-anim-05", "layer-anim-06"];
    b.pt.config = {
        type: 0,
        shade: 0.3,
        fixed: true,
        move: c[1],
        title: "&#x4FE1;&#x606F;",
        offset: "auto",
        area: "auto",
        closeBtn: 1,
        time: 0,
        zIndex: 19891014,
        maxWidth: 360,
        anim: 0,
        isOutAnim: true,
        icon: -1,
        moveType: 1,
        resize: true,
        scrollbar: true,
        tips: 2
    };
    b.pt.vessel = function (p, t) {
        var q = this, l = q.index, o = q.config;
        var s = o.zIndex + l, n = typeof o.title === "object";
        var r = o.maxmin && (o.type === 1 || o.type === 2);
        var m = (o.title ? '<div class="layui-layer-title" style="' + (n ? o.title[1] : "") + '">' + (n ? o.title[0] : o.title) + "</div>" : "");
        o.zIndex = s;
        t([o.shade ? ('<div class="layui-layer-shade" id="layui-layer-shade' + l + '" times="' + l + '" style="' + ("z-index:" + (s - 1) + "; ") + '"></div>') : "", '<div class="' + c[0] + (" layui-layer-" + j.type[o.type]) + (((o.type == 0 || o.type == 2) && !o.shade) ? " layui-layer-border" : "") + " " + (o.skin || "") + '" id="' + c[0] + l + '" type="' + j.type[o.type] + '" times="' + l + '" showtime="' + o.time + '" conType="' + (p ? "object" : "string") + '" style="z-index: ' + s + "; width:" + o.area[0] + ";height:" + o.area[1] + (o.fixed ? "" : ";position:absolute;") + '">' + (p && o.type != 2 ? "" : m) + '<div id="' + (o.id || "") + '" class="layui-layer-content' + ((o.type == 0 && o.icon !== -1) ? " layui-layer-padding" : "") + (o.type == 3 ? " layui-layer-loading" + o.icon : "") + '">' + (o.type == 0 && o.icon !== -1 ? '<i class="layui-layer-ico layui-layer-ico' + o.icon + '"></i>' : "") + (o.type == 1 && p ? "" : (o.content || "")) + "</div>" + '<span class="layui-layer-setwin">' + function () {
            var u = r ? '<a class="layui-layer-min" href="javascript:;"><cite></cite></a><a class="layui-layer-ico layui-layer-max" href="javascript:;"></a>' : "";
            o.closeBtn && (u += '<a class="layui-layer-ico ' + c[7] + " " + c[7] + (o.title ? o.closeBtn : (o.type == 4 ? "1" : "2")) + '" href="javascript:;"></a>');
            return u
        }() + "</span>" + (o.btn ? function () {
            var w = "";
            typeof o.btn === "string" && (o.btn = [o.btn]);
            for (var v = 0, u = o.btn.length; v < u; v++) {
                w += '<a class="' + c[6] + "" + v + '">' + o.btn[v] + "</a>"
            }
            return '<div class="' + c[6] + " layui-layer-btn-" + (o.btnAlign || "") + '">' + w + "</div>"
        }() : "") + (o.resize ? '<span class="layui-layer-resize"></span>' : "") + "</div>"], m, f('<div class="layui-layer-move"></div>'));
        return q
    };
    b.pt.creat = function () {
        var o = this, m = o.config, r = o.index, s, n = m.content, q = typeof n === "object", l = f("body");
        if (m.id && f("#" + m.id)[0]) {
            return
        }
        if (typeof m.area === "string") {
            m.area = m.area === "auto" ? ["", ""] : [m.area, ""]
        }
        if (m.shift) {
            m.anim = m.shift
        }
        if (g.ie == 6) {
            m.fixed = false
        }
        switch (m.type) {
            case 0:
                m.btn = ("btn" in m) ? m.btn : j.btn[0];
                g.closeAll("dialog");
                break;
            case 2:
                var n = m.content = q ? m.content : [m.content || "", "auto"];
                m.content = '<iframe scrolling="' + (m.content[1] || "auto") + '" allowtransparency="true" id="' + c[4] + "" + r + '" name="' + c[4] + "" + r + '" onload="this.className=\'\';" class="layui-layer-load" frameborder="0" src="' + m.content[0] + '"></iframe>';
                break;
            case 3:
                delete m.title;
                delete m.closeBtn;
                m.icon === -1 && (m.icon === 0);
                g.closeAll("loading");
                break;
            case 4:
                q || (m.content = [m.content, "body"]);
                m.follow = m.content[1];
                m.content = m.content[0] + '<i class="layui-layer-TipsG"></i>';
                delete m.title;
                m.tips = typeof m.tips === "object" ? m.tips : [m.tips, true];
                m.tipsMore || g.closeAll("tips");
                break
        }
        o.vessel(q, function (u, t, v) {
            l.append(u[0]);
            q ? function () {
                (m.type == 2 || m.type == 4) ? function () {
                    f("body").append(u[1])
                }() : function () {
                    if (!n.parents("." + c[0])[0]) {
                        n.data("display", n.css("display")).show().addClass("layui-layer-wrap").wrap(u[1]);
                        f("#" + c[0] + r).find("." + c[5]).before(t)
                    }
                }()
            }() : l.append(u[1]);
            f(".layui-layer-move")[0] || l.append(j.moveElem = v);
            o.layero = f("#" + c[0] + r);
            m.scrollbar || c.html.css("overflow", "hidden").attr("layer-full", r)
        }).auto(r);
        f("#layui-layer-shade" + o.index).css({
            "background-color": m.shade[1] || "#000",
            "opacity": m.shade[0] || m.shade
        });
        m.type == 2 && g.ie == 6 && o.layero.find("iframe").attr("src", n[0]);
        m.type == 4 ? o.tips() : o.offset();
        if (m.fixed) {
            h.on("resize", function () {
                o.offset();
                (/^\d+%$/.test(m.area[0]) || /^\d+%$/.test(m.area[1])) && o.auto(r);
                m.type == 4 && o.tips()
            })
        }
        m.time <= 0 || setTimeout(function () {
            g.close(o.index)
        }, m.time);
        o.move().callback();
        if (c.anim[m.anim]) {
            var p = "layer-anim " + c.anim[m.anim];
            o.layero.addClass(p).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                f(this).removeClass(p)
            })
        }
        if (m.isOutAnim) {
            o.layero.data("isOutAnim", true)
        }
    };
    b.pt.auto = function (p) {
        var r = this, o = r.config, n = f("#" + c[0] + p);
        if (o.area[0] === "" && o.maxWidth > 0) {
            if (g.ie && g.ie < 8 && o.btn) {
                n.width(n.innerWidth())
            }
            n.outerWidth() > o.maxWidth && n.width(o.maxWidth)
        }
        var q = [n.innerWidth(), n.innerHeight()], s = n.find(c[1]).outerHeight() || 0,
            m = n.find("." + c[6]).outerHeight() || 0, l = function (t) {
                t = n.find(t);
                t.height(q[1] - s - m - 2 * (parseFloat(t.css("padding-top")) | 0))
            };
        switch (o.type) {
            case 2:
                l("iframe");
                break;
            default:
                if (o.area[1] === "") {
                    if (o.maxHeight > 0 && n.outerHeight() > o.maxHeight) {
                        q[1] = o.maxHeight;
                        l("." + c[5])
                    } else {
                        if (o.fixed && q[1] >= h.height()) {
                            q[1] = h.height();
                            l("." + c[5])
                        }
                    }
                } else {
                    l("." + c[5])
                }
                break
        }
        return r
    };
    b.pt.offset = function () {
        var p = this, m = p.config, l = p.layero;
        var o = [l.outerWidth(), l.outerHeight()];
        var n = typeof m.offset === "object";
        p.offsetTop = (h.height() - o[1]) / 2;
        p.offsetLeft = (h.width() - o[0]) / 2;
        if (n) {
            p.offsetTop = m.offset[0];
            p.offsetLeft = m.offset[1] || p.offsetLeft
        } else {
            if (m.offset !== "auto") {
                if (m.offset === "t") {
                    p.offsetTop = 0
                } else {
                    if (m.offset === "r") {
                        p.offsetLeft = h.width() - o[0]
                    } else {
                        if (m.offset === "b") {
                            p.offsetTop = h.height() - o[1]
                        } else {
                            if (m.offset === "l") {
                                p.offsetLeft = 0
                            } else {
                                if (m.offset === "lt") {
                                    p.offsetTop = 0;
                                    p.offsetLeft = 0
                                } else {
                                    if (m.offset === "lb") {
                                        p.offsetTop = h.height() - o[1];
                                        p.offsetLeft = 0
                                    } else {
                                        if (m.offset === "rt") {
                                            p.offsetTop = 0;
                                            p.offsetLeft = h.width() - o[0]
                                        } else {
                                            if (m.offset === "rb") {
                                                p.offsetTop = h.height() - o[1];
                                                p.offsetLeft = h.width() - o[0]
                                            } else {
                                                p.offsetTop = m.offset
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if (!m.fixed) {
            p.offsetTop = /%$/.test(p.offsetTop) ? h.height() * parseFloat(p.offsetTop) / 100 : parseFloat(p.offsetTop);
            p.offsetLeft = /%$/.test(p.offsetLeft) ? h.width() * parseFloat(p.offsetLeft) / 100 : parseFloat(p.offsetLeft);
            p.offsetTop += h.scrollTop();
            p.offsetLeft += h.scrollLeft()
        }
        if (l.attr("minLeft")) {
            p.offsetTop = h.height() - (l.find(c[1]).outerHeight() || 0);
            p.offsetLeft = l.css("left")
        }
        l.css({top: p.offsetTop, left: p.offsetLeft})
    };
    b.pt.tips = function () {
        var s = this, r = s.config, n = s.layero;
        var q = [n.outerWidth(), n.outerHeight()], m = f(r.follow);
        if (!m[0]) {
            m = f("body")
        }
        var p = {width: m.outerWidth(), height: m.outerHeight(), top: m.offset().top, left: m.offset().left},
            o = n.find(".layui-layer-TipsG");
        var l = r.tips[0];
        r.tips[1] || o.remove();
        p.autoLeft = function () {
            if (p.left + q[0] - h.width() > 0) {
                p.tipLeft = p.left + p.width - q[0];
                o.css({right: 12, left: "auto"})
            } else {
                p.tipLeft = p.left
            }
        };
        p.where = [function () {
            p.autoLeft();
            p.tipTop = p.top - q[1] - 10;
            o.removeClass("layui-layer-TipsB").addClass("layui-layer-TipsT").css("border-top-color", r.tips[1]).css("border-bottom-color", "transparent")
        }, function () {
            p.tipLeft = p.left + p.width + 10;
            p.tipTop = p.top;
            o.removeClass("layui-layer-TipsL").addClass("layui-layer-TipsR").css("border-right-color", r.tips[1]).css("border-left-color", "transparent")
        }, function () {
            p.autoLeft();
            p.tipTop = p.top + p.height + 10;
            o.removeClass("layui-layer-TipsT").addClass("layui-layer-TipsB").css("border-bottom-color", r.tips[1]).css("border-top-color", "transparent")
        }, function () {
            p.tipLeft = p.left - q[0] - 10;
            p.tipTop = p.top;
            o.removeClass("layui-layer-TipsR").addClass("layui-layer-TipsL").css("border-left-color", r.tips[1]).css("border-right-color", "transparent")
        }];
        p.where[l - 1]();
        if (l === 1) {
            p.top - (h.scrollTop() + q[1] + 8 * 2) < 0 && p.where[2]()
        } else {
            if (l === 2) {
                h.width() - (p.left + p.width + q[0] + 8 * 2) > 0 || p.where[3]()
            } else {
                if (l === 3) {
                    (p.top - h.scrollTop() + p.height + q[1] + 8 * 2) - h.height() > 0 && p.where[0]()
                } else {
                    if (l === 4) {
                        q[0] + 8 * 2 - p.left > 0 && p.where[1]()
                    }
                }
            }
        }
        n.find("." + c[5]).css({"background-color": r.tips[1], "padding-right": (r.closeBtn ? "30px" : "")});
        n.css({left: p.tipLeft - (r.fixed ? h.scrollLeft() : 0), top: p.tipTop - (r.fixed ? h.scrollTop() : 0)})
    };
    b.pt.move = function () {
        var p = this, m = p.config, o = f(document), l = p.layero, n = l.find(m.move),
            q = l.find(".layui-layer-resize"), r = {};
        if (m.move) {
            n.css("cursor", "move")
        }
        n.on("mousedown", function (s) {
            s.preventDefault();
            if (m.move) {
                r.moveStart = true;
                r.offset = [s.clientX - parseFloat(l.css("left")), s.clientY - parseFloat(l.css("top"))];
                j.moveElem.css("cursor", "move").show()
            }
        });
        q.on("mousedown", function (s) {
            s.preventDefault();
            r.resizeStart = true;
            r.offset = [s.clientX, s.clientY];
            r.area = [l.outerWidth(), l.outerHeight()];
            j.moveElem.css("cursor", "se-resize").show()
        });
        o.on("mousemove", function (v) {
            if (r.moveStart) {
                var x = v.clientX - r.offset[0], w = v.clientY - r.offset[1], t = l.css("position") === "fixed";
                v.preventDefault();
                r.stX = t ? 0 : h.scrollLeft();
                r.stY = t ? 0 : h.scrollTop();
                if (!m.moveOut) {
                    var s = h.width() - l.outerWidth() + r.stX, u = h.height() - l.outerHeight() + r.stY;
                    x < r.stX && (x = r.stX);
                    x > s && (x = s);
                    w < r.stY && (w = r.stY);
                    w > u && (w = u)
                }
                l.css({left: x, top: w})
            }
            if (m.resize && r.resizeStart) {
                var x = v.clientX - r.offset[0], w = v.clientY - r.offset[1];
                v.preventDefault();
                g.style(p.index, {width: r.area[0] + x, height: r.area[1] + w});
                r.isResize = true;
                m.resizing && m.resizing(l)
            }
        }).on("mouseup", function (s) {
            if (r.moveStart) {
                delete r.moveStart;
                j.moveElem.hide();
                m.moveEnd && m.moveEnd(l)
            }
            if (r.resizeStart) {
                delete r.resizeStart;
                j.moveElem.hide()
            }
        });
        return p
    };
    b.pt.callback = function () {
        var o = this, l = o.layero, m = o.config;
        o.openLayer();
        if (m.success) {
            if (m.type == 2) {
                l.find("iframe").on("load", function () {
                    m.success(l, o.index)
                })
            } else {
                m.success(l, o.index)
            }
        }
        g.ie == 6 && o.IE6(l);
        l.find("." + c[6]).children("a").on("click", function () {
            var p = f(this).index();
            if (p === 0) {
                if (m.yes) {
                    m.yes(o.index, l)
                } else {
                    if (m["btn1"]) {
                        m["btn1"](o.index, l)
                    } else {
                        g.close(o.index)
                    }
                }
            } else {
                var q = m["btn" + (p + 1)] && m["btn" + (p + 1)](o.index, l);
                q === false || g.close(o.index)
            }
        });

        function n() {
            var p = m.cancel && m.cancel(o.index, l);
            p === false || g.close(o.index)
        }

        l.find("." + c[7]).on("click", n);
        if (m.shadeClose) {
            f("#layui-layer-shade" + o.index).on("click", function () {
                g.close(o.index)
            })
        }
        l.find(".layui-layer-min").on("click", function () {
            var p = m.min && m.min(l);
            p === false || g.min(o.index, m)
        });
        l.find(".layui-layer-max").on("click", function () {
            if (f(this).hasClass("layui-layer-maxmin")) {
                g.restore(o.index);
                m.restore && m.restore(l)
            } else {
                g.full(o.index, m);
                setTimeout(function () {
                    m.full && m.full(l)
                }, 100)
            }
        });
        m.end && (j.end[o.index] = m.end)
    };
    j.reselect = function () {
        f.each(f("select"), function (l, m) {
            var n = f(this);
            if (!n.parents("." + c[0])[0]) {
                (n.attr("layer") == 1 && f("." + c[0]).length < 1) && n.removeAttr("layer").show()
            }
            n = null
        })
    };
    b.pt.IE6 = function (l) {
        f("select").each(function (m, n) {
            var o = f(this);
            if (!o.parents("." + c[0])[0]) {
                o.css("display") === "none" || o.attr({"layer": "1"}).hide()
            }
            o = null
        })
    };
    b.pt.openLayer = function () {
        var l = this;
        g.zIndex = l.config.zIndex;
        g.setTop = function (m) {
            var n = function () {
                g.zIndex++;
                m.css("z-index", g.zIndex + 1)
            };
            g.zIndex = parseInt(m[0].style.zIndex);
            m.on("mousedown", n);
            return g.zIndex
        }
    };
    j.record = function (l) {
        var m = [l.width(), l.height(), l.position().top, l.position().left + parseFloat(l.css("margin-left"))];
        l.find(".layui-layer-max").addClass("layui-layer-maxmin");
        l.attr({area: m})
    };
    j.rescollbar = function (l) {
        if (c.html.attr("layer-full") == l) {
            if (c.html[0].style.removeProperty) {
                c.html[0].style.removeProperty("overflow")
            } else {
                c.html[0].style.removeAttribute("overflow")
            }
            c.html.removeAttr("layer-full")
        }
    };
    i.layer = g;
    g.getChildFrame = function (l, m) {
        m = m || f("." + c[4]).attr("times");
        return f("#" + c[0] + m).find("iframe").contents().find(l)
    };
    g.getFrameIndex = function (l) {
        return f("#" + l).parents("." + c[4]).attr("times")
    };
    g.iframeAuto = function (o) {
        if (!o) {
            return
        }
        var n = g.getChildFrame("html", o).outerHeight();
        var m = f("#" + c[0] + o);
        var p = m.find(c[1]).outerHeight() || 0;
        var l = m.find("." + c[6]).outerHeight() || 0;
        m.css({height: n + p + l});
        m.find("iframe").css({height: n})
    };
    g.iframeSrc = function (m, l) {
        f("#" + c[0] + m).find("iframe").attr("src", l)
    };
    g.style = function (p, t, m) {
        var q = f("#" + c[0] + p), r = q.find(".layui-layer-content"), s = q.attr("type"),
            l = q.find(c[1]).outerHeight() || 0, o = q.find("." + c[6]).outerHeight() || 0, n = q.attr("minLeft");
        if (s === j.type[3] || s === j.type[4]) {
            return
        }
        if (!m) {
            if (parseFloat(t.width) <= 260) {
                t.width = 260
            }
            if (parseFloat(t.height) - l - o <= 64) {
                t.height = 64 + l + o
            }
        }
        q.css(t);
        o = q.find("." + c[6]).outerHeight();
        if (s === j.type[2]) {
            q.find("iframe").css({height: parseFloat(t.height) - l - o})
        } else {
            r.css({height: parseFloat(t.height) - l - o - parseFloat(r.css("padding-top")) - parseFloat(r.css("padding-bottom"))})
        }
    };
    g.min = function (o, n) {
        var m = f("#" + c[0] + o), q = m.find(c[1]).outerHeight() || 0,
            p = m.attr("minLeft") || (181 * j.minIndex) + "px", l = m.css("position");
        j.record(m);
        if (j.minLeft[0]) {
            p = j.minLeft[0];
            j.minLeft.shift()
        }
        m.attr("position", l);
        g.style(o, {width: 180, height: q, left: p, top: h.height() - q, position: "fixed", overflow: "hidden"}, true);
        m.find(".layui-layer-min").hide();
        m.attr("type") === "page" && m.find(c[4]).hide();
        j.rescollbar(o);
        if (!m.attr("minLeft")) {
            j.minIndex++
        }
        m.attr("minLeft", p)
    };
    g.restore = function (m) {
        var l = f("#" + c[0] + m), o = l.attr("area").split(",");
        var n = l.attr("type");
        g.style(m, {
            width: parseFloat(o[0]),
            height: parseFloat(o[1]),
            top: parseFloat(o[2]),
            left: parseFloat(o[3]),
            position: l.attr("position"),
            overflow: "visible"
        }, true);
        l.find(".layui-layer-max").removeClass("layui-layer-maxmin");
        l.find(".layui-layer-min").show();
        l.attr("type") === "page" && l.find(c[4]).show();
        j.rescollbar(m)
    };
    g.full = function (m) {
        var l = f("#" + c[0] + m), n;
        j.record(l);
        if (!c.html.attr("layer-full")) {
            c.html.css("overflow", "hidden").attr("layer-full", m)
        }
        clearTimeout(n);
        n = setTimeout(function () {
            var o = l.css("position") === "fixed";
            g.style(m, {
                top: o ? 0 : h.scrollTop(),
                left: o ? 0 : h.scrollLeft(),
                width: h.width(),
                height: h.height()
            }, true);
            l.find(".layui-layer-min").hide()
        }, 100)
    };
    g.title = function (m, l) {
        var n = f("#" + c[0] + (l || g.index)).find(c[1]);
        n.html(m)
    };
    g.close = function (n) {
        var m = f("#" + c[0] + n), o = m.attr("type"), p = "layer-anim-close";
        if (!m[0]) {
            return
        }
        var q = "layui-layer-wrap", l = function () {
            if (o === j.type[1] && m.attr("conType") === "object") {
                m.children(":not(." + c[5] + ")").remove();
                var t = m.find("." + q);
                for (var r = 0; r < 2; r++) {
                    t.unwrap()
                }
                t.css("display", t.data("display")).removeClass(q)
            } else {
                if (o === j.type[2]) {
                    try {
                        var s = f("#" + c[4] + n)[0];
                        s.contentWindow.document.write("");
                        s.contentWindow.close();
                        m.find("." + c[5])[0].removeChild(s)
                    } catch (u) {
                    }
                }
                m[0].innerHTML = "";
                m.remove()
            }
            typeof j.end[n] === "function" && j.end[n]();
            delete j.end[n]
        };
        if (m.data("isOutAnim")) {
            m.addClass("layer-anim " + p)
        }
        f("#layui-layer-moves, #layui-layer-shade" + n).remove();
        g.ie == 6 && j.reselect();
        j.rescollbar(n);
        if (m.attr("minLeft")) {
            j.minIndex--;
            j.minLeft.push(m.attr("minLeft"))
        }
        if ((g.ie && g.ie < 10) || !m.data("isOutAnim")) {
            l()
        } else {
            setTimeout(function () {
                l()
            }, 200)
        }
    };
    g.closeAll = function (l) {
        f.each(f("." + c[0]), function () {
            var n = f(this);
            var m = l ? (n.attr("type") === l) : 1;
            m && g.close(n.attr("times"));
            m = null
        })
    };
    var a = g.cache || {}, k = function (l) {
        return (a.skin ? (" " + a.skin + " " + a.skin + "-" + l) : "")
    };
    g.prompt = function (m, r) {
        var n = "";
        m = m || {};
        if (typeof m === "function") {
            r = m
        }
        if (m.area) {
            var p = m.area;
            n = 'style="width: ' + p[0] + "; height: " + p[1] + ';"';
            delete m.area
        }
        var l, o = m.formType == 2 ? '<textarea class="layui-layer-input"' + n + "></textarea>" : function () {
            return '<input type="' + (m.formType == 1 ? "password" : "text") + '" class="layui-layer-input">'
        }();
        var q = m.success;
        delete m.success;
        return g.open(f.extend({
            type: 1,
            btn: ["&#x786E;&#x5B9A;", "&#x53D6;&#x6D88;"],
            content: o,
            skin: "layui-layer-prompt" + k("prompt"),
            maxWidth: h.width(),
            success: function (s) {
                l = s.find(".layui-layer-input");
                l.val(m.value || "").focus();
                typeof q === "function" && q(s)
            },
            resize: false,
            yes: function (s) {
                var t = l.val();
                if (t === "") {
                    l.focus()
                } else {
                    if (t.length > (m.maxlength || 500)) {
                        g.tips("&#x6700;&#x591A;&#x8F93;&#x5165;" + (m.maxlength || 500) + "&#x4E2A;&#x5B57;&#x6570;", l, {tips: 1})
                    } else {
                        r && r(t, s, l)
                    }
                }
            }
        }, m))
    };
    g.tab = function (l) {
        l = l || {};
        var m = l.tab || {}, n = "layui-this", o = l.success;
        delete l.success;
        return g.open(f.extend({
            type: 1, skin: "layui-layer-tab" + k("tab"), resize: false, title: function () {
                var p = m.length, q = 1, r = "";
                if (p > 0) {
                    r = '<span class="' + n + '">' + m[0].title + "</span>";
                    for (; q < p; q++) {
                        r += "<span>" + m[q].title + "</span>"
                    }
                }
                return r
            }(), content: '<ul class="layui-layer-tabmain">' + function () {
                var p = m.length, q = 1, r = "";
                if (p > 0) {
                    r = '<li class="layui-layer-tabli ' + n + '">' + (m[0].content || "no content") + "</li>";
                    for (; q < p; q++) {
                        r += '<li class="layui-layer-tabli">' + (m[q].content || "no  content") + "</li>"
                    }
                }
                return r
            }() + "</ul>", success: function (q) {
                var r = q.find(".layui-layer-title").children();
                var p = q.find(".layui-layer-tabmain").children();
                r.on("mousedown", function (u) {
                    u.stopPropagation ? u.stopPropagation() : u.cancelBubble = true;
                    var t = f(this), s = t.index();
                    t.addClass(n).siblings().removeClass(n);
                    p.eq(s).show().siblings().hide();
                    typeof l.change === "function" && l.change(s)
                });
                typeof o === "function" && o(q)
            }
        }, l))
    };
    g.photos = function (w, q, t) {
        var n = {};
        w = w || {};
        if (!w.photos) {
            return
        }
        var r = w.photos.constructor === Object;
        var v = r ? w.photos : {}, p = v.data || [];
        var m = v.start || 0;
        n.imgIndex = (m | 0) + 1;
        w.img = w.img || "img";
        var u = w.success;
        delete w.success;
        if (!r) {
            var s = f(w.photos), o = function () {
                p = [];
                s.find(w.img).each(function (x) {
                    var y = f(this);
                    y.attr("layer-index", x);
                    p.push({
                        alt: y.attr("alt"),
                        pid: y.attr("layer-pid"),
                        src: y.attr("layer-src") || y.attr("src"),
                        thumb: y.attr("src")
                    })
                })
            };
            o();
            if (p.length === 0) {
                return
            }
            q || s.on("click", w.img, function () {
                var y = f(this), x = y.attr("layer-index");
                g.photos(f.extend(w, {photos: {start: x, data: p, tab: w.tab}, full: w.full}), true);
                o()
            });
            if (!q) {
                return
            }
        } else {
            if (p.length === 0) {
                return g.msg("&#x6CA1;&#x6709;&#x56FE;&#x7247;")
            }
        }
        n.imgprev = function (x) {
            n.imgIndex--;
            if (n.imgIndex < 1) {
                n.imgIndex = p.length
            }
            n.tabimg(x)
        };
        n.imgnext = function (x, y) {
            n.imgIndex++;
            if (n.imgIndex > p.length) {
                n.imgIndex = 1;
                if (y) {
                    return
                }
            }
            n.tabimg(x)
        };
        n.keyup = function (y) {
            if (!n.end) {
                var x = y.keyCode;
                y.preventDefault();
                if (x === 37) {
                    n.imgprev(true)
                } else {
                    if (x === 39) {
                        n.imgnext(true)
                    } else {
                        if (x === 27) {
                            g.close(n.index)
                        }
                    }
                }
            }
        };
        n.tabimg = function (x) {
            if (p.length <= 1) {
                return
            }
            v.start = n.imgIndex - 1;
            g.close(n.index);
            return g.photos(w, true, x);
            setTimeout(function () {
                g.photos(w, true, x)
            }, 200)
        };
        n.event = function () {
            n.bigimg.hover(function () {
                n.imgsee.show()
            }, function () {
                n.imgsee.hide()
            });
            n.bigimg.find(".layui-layer-imgprev").on("click", function (x) {
                x.preventDefault();
                n.imgprev()
            });
            n.bigimg.find(".layui-layer-imgnext").on("click", function (x) {
                x.preventDefault();
                n.imgnext()
            });
            f(document).on("keyup", n.keyup)
        };

        function l(z, A, y) {
            var x = new Image();
            x.src = z;
            if (x.complete) {
                return A(x)
            }
            x.onload = function () {
                x.onload = null;
                A(x)
            };
            x.onerror = function (B) {
                x.onerror = null;
                y(B)
            }
        }

        n.loadi = g.load(1, {shade: "shade" in w ? false : 0.9, scrollbar: false});
        l(p[m].src, function (x) {
            g.close(n.loadi);
            n.index = g.open(f.extend({
                type: 1,
                id: "layui-layer-photos",
                area: function () {
                    var A = [x.width, x.height];
                    var z = [f(i).width() - 100, f(i).height() - 100];
                    if (!w.full && (A[0] > z[0] || A[1] > z[1])) {
                        var y = [A[0] / z[0], A[1] / z[1]];
                        if (y[0] > y[1]) {
                            A[0] = A[0] / y[0];
                            A[1] = A[1] / y[0]
                        } else {
                            if (y[0] < y[1]) {
                                A[0] = A[0] / y[1];
                                A[1] = A[1] / y[1]
                            }
                        }
                    }
                    return [A[0] + "px", A[1] + "px"]
                }(),
                title: false,
                shade: 0.9,
                shadeClose: true,
                closeBtn: false,
                move: ".layui-layer-phimg img",
                moveType: 1,
                scrollbar: false,
                moveOut: true,
                isOutAnim: false,
                skin: "layui-layer-photos" + k("photos"),
                content: '<div class="layui-layer-phimg">' + '<img src="' + p[m].src + '" alt="' + (p[m].alt || "") + '" layer-pid="' + p[m].pid + '">' + '<div class="layui-layer-imgsee">' + (p.length > 1 ? '<span class="layui-layer-imguide"><a href="javascript:;" class="layui-layer-iconext layui-layer-imgprev"></a><a href="javascript:;" class="layui-layer-iconext layui-layer-imgnext"></a></span>' : "") + '<div class="layui-layer-imgbar" style="display:' + (t ? "block" : "") + '"><span class="layui-layer-imgtit"><a href="javascript:;">' + (p[m].alt || "") + "</a><em>" + n.imgIndex + "/" + p.length + "</em></span></div>" + "</div>" + "</div>",
                success: function (y, z) {
                    n.bigimg = y.find(".layui-layer-phimg");
                    n.imgsee = y.find(".layui-layer-imguide,.layui-layer-imgbar");
                    n.event(y);
                    w.tab && w.tab(p[m], y);
                    typeof u === "function" && u(y)
                },
                end: function () {
                    n.end = true;
                    f(document).off("keyup", n.keyup)
                }
            }, w))
        }, function () {
            g.close(n.loadi);
            g.msg("&#x5F53;&#x524D;&#x56FE;&#x7247;&#x5730;&#x5740;&#x5F02;&#x5E38;<br>&#x662F;&#x5426;&#x7EE7;&#x7EED;&#x67E5;&#x770B;&#x4E0B;&#x4E00;&#x5F20;&#xFF1F;", {
                time: 30000,
                btn: ["&#x4E0B;&#x4E00;&#x5F20;", "&#x4E0D;&#x770B;&#x4E86;"],
                yes: function () {
                    p.length > 1 && n.imgnext(true, true)
                }
            })
        })
    };
    j.run = function (l) {
        f = l;
        h = f(i);
        c.html = f("html");
        g.open = function (n) {
            var m = new b(n);
            return m.index
        }
    };
    i.layui && layui.define ? (g.ready(), layui.define("jquery", function (l) {
        g.path = layui.cache.dir;
        j.run(layui.$);
        i.layer = g;
        l("layer", g)
    })) : ((typeof define === "function" && define.amd) ? define(["demo/layui/lay/modules/jquery"], function () {
        j.run(i.jQuery);
        return g
    }) : function () {
        j.run(i.jQuery);
        g.ready()
    }())
}(window);
