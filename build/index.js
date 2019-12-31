!function (e) {
    var t = {};

    function n(a) {
        if (t[a]) return t[a].exports;
        var s = t[a] = {i: a, l: !1, exports: {}};
        return e[a].call(s.exports, s, s.exports, n), s.l = !0, s.exports
    }

    n.m = e, n.c = t, n.d = function (e, t, a) {
        n.o(e, t) || Object.defineProperty(e, t, {configurable: !1, enumerable: !0, get: a})
    }, n.r = function (e) {
        Object.defineProperty(e, "__esModule", {value: !0})
    }, n.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return n.d(t, "a", t), t
    }, n.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, n.p = "", n(n.s = 1)
}([function (e, t) {
    !function () {
        e.exports = this.wp.element
    }()
}, function (e, t, n) {
    "use strict";
    n.r(t);
    var a = n(0), s = wp.i18n.__, c = wp.blocks.registerBlockType, l = wp.editor, r = l.RichText, o = l.URLInputButton;
    c("nhsblocks/nhsbutton", {
        title: s("Button", "nhsblocks"),
        category: "nhsblocks",
        attributes: {
            buttonLabel: {type: "string", source: "html", selector: ".nhsuk-button"},
            buttonLink: {
                type: "string",
                source: "attribute",
                selector: ".wp-block-nhsblocks-nhsbutton a",
                attribute: "href"
            }
        },
        edit: function (e) {
            var t = e.attributes, n = t.buttonLabel, c = t.buttonLink, l = e.className, i = e.setAttributes;
            return Object(a.createElement)("div", {className: "".concat(l, " something")}, Object(a.createElement)("a", {
                href: "#0",
                className: "nhsuk-button"
            }, Object(a.createElement)(r, {
                placeholder: s("Button Label", "nhsblocks"),
                value: n,
                onChange: function (e) {
                    i({buttonLabel: e})
                }
            })), Object(a.createElement)(o, {
                className: "nhsblocks-dropdown__input",
                label: s("Button URL", "nhsblocks"),
                onChange: function (e) {
                    i({buttonLink: e})
                },
                url: c
            }))
        },
        save: function (e) {
            var t = e.attributes, n = t.buttonLabel, s = t.buttonLink;
            return Object(a.createElement)("div", {className: "wp-block-nhsblocks-nhsbutton"}, Object(a.createElement)("a", {
                href: s,
                className: "nhsuk-button"
            }, Object(a.createElement)(r.Content, {value: n})))
        }
    });
    var i = wp.i18n.__, u = wp.blocks.registerBlockType, m = wp.editor.RichText;
    u("nhsblocks/reveal1", {
        title: i("Simple Reveal", "nhsblocks"),
        category: "nhsblocks",
        attributes: {
            revealTitle: {type: "string", source: "html", selector: ".nhsuk-details__summary-text"},
            revealText: {type: "string", source: "html", selector: ".nhsuk-details__text"},
            expanderBox: {type: "string"}
        },
        edit: function (e) {
            var t = e.attributes, n = t.revealTitle, s = t.revealText, c = (e.className, e.setAttributes);
            return Object(a.createElement)("details", {
                className: "nhsuk-details newstyle",
                open: !0
            }, Object(a.createElement)("summary", {
                className: "nhsuk-details__summary",
                role: "button",
                "aria-controls": "details-content-",
                "aria-expanded": "true"
            }, Object(a.createElement)("span", {className: "nhsuk-details__summary-text"}, Object(a.createElement)(m, {
                placeholder: i("Reveal Title", "nhsblocks"),
                value: n,
                onChange: function (e) {
                    c({revealTitle: e})
                }
            }))), Object(a.createElement)("div", {
                className: "nhsuk-details__text",
                id: "details-content-",
                "aria-hidden": "false"
            }, Object(a.createElement)(m, {
                multiline: "p",
                placeholder: i("Reveal Contents", "nhsblocks"),
                onChange: function (e) {
                    c({revealText: e})
                },
                value: s
            })))
        },
        save: function (e) {
            var t = e.attributes, n = t.revealTitle, s = t.revealText;
            return Object(a.createElement)("details", {className: "nhsuk-details extrastyle"}, Object(a.createElement)("summary", {
                className: "nhsuk-details__summary",
                role: "button",
                "aria-controls": "details-content-",
                "aria-expanded": "false"
            }, Object(a.createElement)("span", {className: "nhsuk-details__summary-text"}, Object(a.createElement)(m.Content, {value: n}))), Object(a.createElement)("div", {
                className: "nhsuk-details__text",
                id: "details-content-",
                "aria-hidden": "false"
            }, Object(a.createElement)(m.Content, {multiline: "p", value: s})))
        }
    });
    var b = wp.i18n.__, h = wp.blocks.registerBlockType, d = wp.editor.RichText;
    h("nhsblocks/panel1", {
        title: b("Panel Region", "nhsblocks"),
        category: "nhsblocks",
        attributes: {
            panelTitle: {type: "string", source: "html", selector: ".nhsuk-panel-with-label__label"},
            panelText: {type: "array", source: "children", multiline: "p", selector: ".paneltext"}
        },
        edit: function (e) {
            var t = e.attributes, n = t.panelTitle, s = t.panelText, c = (e.className, e.setAttributes);
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-size"}, Object(a.createElement)("div", {className: "nhsuk-panel-with-label"}, Object(a.createElement)("h3", {className: "nhsuk-panel-with-label__label"}, Object(a.createElement)(d, {
                placeholder: b("Panel Title", "nhsblocks"),
                value: n,
                onChange: function (e) {
                    c({panelTitle: e})
                }
            })), Object(a.createElement)("div", {className: "paneltext"}, Object(a.createElement)(d, {
                multiline: "p",
                placeholder: b("Panel Contents", "nhsblocks"),
                onChange: function (e) {
                    c({panelText: e})
                },
                value: s
            }))))
        },
        save: function (e) {
            var t = e.attributes, n = t.panelTitle, s = t.panelText;
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-size"}, Object(a.createElement)("div", {className: "nhsuk-panel-with-label"}, Object(a.createElement)("h3", {className: "nhsuk-panel-with-label__label"}, Object(a.createElement)(d.Content, {value: n})), Object(a.createElement)("div", {className: "paneltext"}, Object(a.createElement)(d.Content, {
                multiline: "p",
                value: s
            }))))
        }
    });
    var p = wp.i18n.__, k = wp.blocks.registerBlockType, _ = wp.editor.RichText, v = wp.data.withSelect;
    k("nhsblocks/latestnews", {
        title: p("Latest Posts / News", "nhsblocks"),
        category: "nhsblocks",
        supports: {align: ["wide", "full"]},
        edit: v(function (e) {
            return {posts: e("core").getEntityRecords("postType", "post", {per_page: 6})}
        })(function (e) {
            var t = e.posts;
            e.className;
            if (!t) return "Loading...";
            if (t && 0 === t.length) return "No posts";
            var n = t[0];
            console.info(n);
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-one-'.$width.' nhsuk-panel-group__item"}, Object(a.createElement)("div", {className: "nhsuk-panel"}, Object(a.createElement)("h3", null, Object(a.createElement)(_.Content, {value: n.title.rendered})), Object(a.createElement)("img", {
                src: function (e) {
                    return e || ""
                }(n.featured_image_nhsblocksFeatImg_url), alt: "{post.title.rendered}"
            }), Object(a.createElement)(_.Content, {value: n.excerpt.rendered}), Object(a.createElement)("a", {href: n.link}, "Read More Link")))
        }),
        save: function (e) {
            return null
        }
    });
    var O = wp.i18n.__, j = wp.blocks.registerBlockType, E = wp.editor.RichText;
    j("nhsblocks/promo1", {
        title: O("Promo Region", "nhsblocks"),
        category: "nhsblocks",
        attributes: {
            promoTitle: {type: "string", source: "html", selector: ".nhsuk-promo__heading"},
            promoText: {type: "string", source: "html", selector: ".nhsuk-promo__description"}
        },
        edit: function (e) {
            var t = e.attributes, n = t.promoTitle, s = t.promoText, c = (e.className, e.setAttributes);
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-size nhsuk-promo-group__item"}, Object(a.createElement)("div", {className: "nhsuk-promo"}, Object(a.createElement)("div", {class: "nhsuk-promo__content"}, Object(a.createElement)("h3", {class: "nhsuk-promo__heading"}, Object(a.createElement)(E, {
                placeholder: O("Promo Title", "nhsblocks"),
                value: n,
                onChange: function (e) {
                    c({promoTitle: e})
                }
            })), Object(a.createElement)("div", {className: "nhsuk-promo__description"}, Object(a.createElement)(E, {
                multiline: "p",
                placeholder: O("Promo Contents", "nhsblocks"),
                onChange: function (e) {
                    c({promoText: e})
                },
                value: s
            })))))
        },
        save: function (e) {
            var t = e.attributes, n = t.promoTitle, s = t.promoText;
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-size nhsuk-promo-group__item"}, Object(a.createElement)("div", {className: "nhsuk-promo"}, Object(a.createElement)("div", {class: "nhsuk-promo__content"}, Object(a.createElement)("h3", {class: "nhsuk-promo__heading"}, Object(a.createElement)(E.Content, {value: n})), Object(a.createElement)("div", {className: "nhsuk-promo__description"}, Object(a.createElement)(E.Content, {
                multiline: "p",
                value: s
            })))))
        }
    });
    var g = wp.i18n.__, N = wp.blocks.registerBlockType, x = wp.editor.RichText;
    N("nhsblocks/quote1", {
        title: g("Simple Quote", "nhsblocks"),
        category: "nhsblocks",
        attributes: {
            quoteName: {type: "string", source: "html", selector: ".nhsuk-inset-text__quote-attribution"},
            quoteText: {type: "string", source: "html", selector: ".nhsuk-inset-text__quote"}
        },
        edit: function (e) {
            var t = e.attributes, n = t.quoteName, s = t.quoteText, c = (e.className, e.setAttributes);
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-size nhsuk-promo-group__item"}, Object(a.createElement)("div", {className: "nhsuk-inset-text"}, Object(a.createElement)("span", {className: "nhsuk-u-visually-hidden"}, "Quote / Testimonial: "), Object(a.createElement)("div", {className: "nhsuk-inset-text__quote"}, Object(a.createElement)(x, {
                multiline: "p",
                placeholder: g("Quote", "nhsblocks"),
                onChange: function (e) {
                    c({quoteText: e})
                },
                value: s
            })), Object(a.createElement)("span", {className: "nhsuk-inset-text__quote-attribution"}, Object(a.createElement)(x, {
                placeholder: g("Quote Name", "nhsblocks"),
                value: n,
                onChange: function (e) {
                    c({quoteName: e})
                }
            }))))
        },
        save: function (e) {
            var t = e.attributes, n = t.quoteName, s = t.quoteText;
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-size nhsuk-promo-group__item"}, Object(a.createElement)("div", {className: "nhsuk-inset-text"}, Object(a.createElement)("span", {className: "nhsuk-u-visually-hidden"}, "Quote / Testimonial: "), Object(a.createElement)("div", {className: "nhsuk-inset-text__quote"}, Object(a.createElement)(x.Content, {
                multiline: "p",
                value: s
            })), Object(a.createElement)("span", {className: "nhsuk-inset-text__quote-attribution"}, Object(a.createElement)(x.Content, {value: n}))))
        }
    });
    var T = wp.i18n.__, f = wp.blocks.registerBlockType, y = wp.editor.RichText;
    f("nhsblocks/card1", {
        title: T("Card Region", "nhsblocks"),
        category: "nhsblocks",
        attributes: {
            cardTitle: {type: "string", source: "html", selector: ".nhsuk-care-card__heading-text"},
            cardText: {type: "array", source: "children", multiline: "p", selector: ".nhsuk-care-card__content"}
        },
        edit: function (e) {
            var t = e.attributes, n = t.cardTitle, s = t.cardText, c = (e.className, e.setAttributes);
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-width nhsuk-care-card nhsuk-care-card--type"}, Object(a.createElement)("div", {className: "nhsuk-care-card__heading-container"}, Object(a.createElement)("h3", {className: "nhsuk-care-card__heading"}, Object(a.createElement)("span", {role: "text"}, Object(a.createElement)("span", {className: "nhsuk-u-visually-hidden"}, "Non-urgent advice: "), Object(a.createElement)("span", {className: "nhsuk-care-card__heading-text"}, Object(a.createElement)(y, {
                placeholder: T("Card Title", "nhsblocks"),
                value: n,
                onChange: function (e) {
                    c({cardTitle: e})
                }
            })))), Object(a.createElement)("span", {
                className: "nhsuk-care-card__arrow",
                "aria-hidden": "true"
            })), Object(a.createElement)("div", {className: "nhsuk-care-card__content"}, Object(a.createElement)(y, {
                multiline: "p",
                placeholder: T("Card Contents", "nhsblocks"),
                onChange: function (e) {
                    c({cardText: e})
                },
                value: s
            })))
        },
        save: function (e) {
            var t = e.attributes, n = t.cardTitle, s = t.cardText;
            return Object(a.createElement)("div", {className: "nhsuk-grid-column-width nhsuk-care-card nhsuk-care-card--type"}, Object(a.createElement)("div", {className: "nhsuk-care-card__heading-container"}, Object(a.createElement)("h3", {className: "nhsuk-care-card__heading"}, Object(a.createElement)("span", {role: "text"}, Object(a.createElement)("span", {className: "nhsuk-u-visually-hidden"}, "Non-urgent advice: "), Object(a.createElement)("span", {className: "nhsuk-care-card__heading-text"}, Object(a.createElement)(y.Content, {value: n})))), Object(a.createElement)("span", {
                className: "nhsuk-care-card__arrow",
                "aria-hidden": "true"
            })), Object(a.createElement)("div", {className: "nhsuk-care-card__content"}, Object(a.createElement)(y.Content, {
                multiline: "p",
                value: s
            })))
        }
    })
}]);

