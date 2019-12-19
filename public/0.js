(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Comments.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Comments.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
$(function () {
  NProgress.start();
});
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['postId', 'bearerToken', 'userId'],
  data: function data() {
    return {
      comments: [],
      comment_id: '',
      comment_body: '',
      user_id: this.userId,
      edit: false
    };
  },
  mounted: function mounted() {
    this.fetchComments();
  },
  updated: function updated() {
    this.$nextTick(function () {
      NProgress.done();
      console.log("Done Loading!");
    });
  },
  methods: {
    fetchComments: function fetchComments() {
      var _this = this;

      console.log(this.user_id);
      axios.get(route('api.comments.show', {
        post_id: this.postId
      })).then(function (response) {
        console.log(response.data);
        _this.comments = response.data;
      })["catch"](function (error) {
        console.log(error);
      });
    },
    createComment: function createComment() {
      var _this2 = this;

      NProgress.start();
      console.log(this.bearerToken);

      if (this.edit == false) {
        axios.post(route('api.comments.store'), {
          api_token: this.bearerToken,
          post_id: this.postId,
          body: this.comment_body
        }).then(function (response) {
          _this2.comments.push(response.data);

          _this2.comment_body = '';
        })["catch"](function (error) {
          console.log(error);
        });
        NProgress.done();
      } else {
        axios.put(route('api.comments.update', {
          id: this.comment_id
        }), {
          api_token: this.bearerToken,
          post_id: this.postId,
          body: this.comment_body
        }).then(function (response) {
          console.log("Comment Updated!");
          _this2.edit = false;
          _this2.comment_body = '', _this2.comment_id = '', _this2.fetchComments();
        })["catch"](function (error) {
          console.log(error);
        });
      }
    },
    deleteComment: function deleteComment(id) {
      var _this3 = this;

      NProgress.start();
      var token = this.bearerToken;
      console.log(id);
      axios["delete"](route('api.comments.delete', {
        id: id
      }), {
        params: {
          'id': id
        },
        headers: {
          Authorization: 'Bearer ' + token
        }
      }).then(function (response) {
        console.log("Delete successful!");

        _this3.fetchComments();
      })["catch"](function (error) {
        console.log(error);
      });
    },
    editComment: function editComment(comment) {
      console.log(this.bearerToken + this.user_id + this.comment_body + this.comment_id);
      this.edit = true;
      this.comment_id = comment.id;
      this.comment_body = comment.body;
    },
    updateComment: function updateComment() {// Update comment after edit
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Comments.vue?vue&type=template&id=4aa6d95f&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Comments.vue?vue&type=template&id=4aa6d95f& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("form", { staticClass: "mb-3" }, [
        _c("div", { staticClass: "form-group" }, [
          _c("textarea", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.comment_body,
                expression: "comment_body"
              }
            ],
            staticClass: "form-control",
            attrs: {
              placeholder: "Post a new comment...",
              name: "comment_body",
              id: "editor"
            },
            domProps: { value: _vm.comment_body },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.comment_body = $event.target.value
              }
            }
          })
        ]),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-primary",
            on: {
              click: function($event) {
                $event.preventDefault()
                return _vm.createComment($event)
              }
            }
          },
          [_vm._v("Submit")]
        )
      ]),
      _vm._v(" "),
      _vm._l(_vm.comments, function(comment) {
        return _c("div", { key: comment.id, attrs: { id: comment.id } }, [
          _c("p", [
            _c("b", [_vm._v(_vm._s(comment.user_name))]),
            _vm._v(" | "),
            _c("small", [_vm._v(_vm._s(comment.updated_at))])
          ]),
          _vm._v(" "),
          _c("p", [_vm._v(_vm._s(comment.body))]),
          _vm._v(" "),
          _vm.user_id == comment.user_id
            ? _c(
                "button",
                {
                  staticClass: "btn btn-sm btn-deep-orange",
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      return _vm.editComment(comment)
                    }
                  }
                },
                [
                  _c(
                    "svg",
                    {
                      staticClass: "bi bi-pencil",
                      attrs: {
                        width: "2.5em",
                        height: "2.5em",
                        viewBox: "0 0 20 20",
                        fill: "currentColor",
                        xmlns: "http://www.w3.org/2000/svg"
                      }
                    },
                    [
                      _c("path", {
                        attrs: {
                          "fill-rule": "evenodd",
                          d:
                            "M13.293 3.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM14 4l2 2-9 9-3 1 1-3 9-9z",
                          "clip-rule": "evenodd"
                        }
                      }),
                      _vm._v(" "),
                      _c("path", {
                        attrs: {
                          "fill-rule": "evenodd",
                          d:
                            "M14.146 8.354l-2.5-2.5.708-.708 2.5 2.5-.708.708zM5 12v.5a.5.5 0 00.5.5H6v.5a.5.5 0 00.5.5H7v.5a.5.5 0 00.5.5H8v-1.5a.5.5 0 00-.5-.5H7v-.5a.5.5 0 00-.5-.5H5z",
                          "clip-rule": "evenodd"
                        }
                      })
                    ]
                  )
                ]
              )
            : _vm._e(),
          _vm._v(" "),
          _vm.user_id == comment.user_id
            ? _c(
                "button",
                {
                  staticClass: "btn btn-sm btn-danger",
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      return _vm.deleteComment(comment.id)
                    }
                  }
                },
                [
                  _c(
                    "svg",
                    {
                      staticClass: "bi bi-trash-fill",
                      attrs: {
                        width: "2.5em",
                        height: "2.5em",
                        viewBox: "0 0 20 20",
                        fill: "currentColor",
                        xmlns: "http://www.w3.org/2000/svg"
                      }
                    },
                    [
                      _c("path", {
                        attrs: {
                          "fill-rule": "evenodd",
                          d:
                            "M4.5 3a1 1 0 00-1 1v1a1 1 0 001 1H5v9a2 2 0 002 2h6a2 2 0 002-2V6h.5a1 1 0 001-1V4a1 1 0 00-1-1H12a1 1 0 00-1-1H9a1 1 0 00-1 1H4.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM10 7a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 0110 7zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z",
                          "clip-rule": "evenodd"
                        }
                      })
                    ]
                  )
                ]
              )
            : _vm._e(),
          _vm._v(" "),
          _c("hr")
        ])
      })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/Comments.vue":
/*!**********************************************!*\
  !*** ./resources/js/components/Comments.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Comments_vue_vue_type_template_id_4aa6d95f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Comments.vue?vue&type=template&id=4aa6d95f& */ "./resources/js/components/Comments.vue?vue&type=template&id=4aa6d95f&");
/* harmony import */ var _Comments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Comments.vue?vue&type=script&lang=js& */ "./resources/js/components/Comments.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Comments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Comments_vue_vue_type_template_id_4aa6d95f___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Comments_vue_vue_type_template_id_4aa6d95f___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Comments.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Comments.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/components/Comments.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Comments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Comments.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Comments.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Comments_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Comments.vue?vue&type=template&id=4aa6d95f&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/Comments.vue?vue&type=template&id=4aa6d95f& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Comments_vue_vue_type_template_id_4aa6d95f___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Comments.vue?vue&type=template&id=4aa6d95f& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Comments.vue?vue&type=template&id=4aa6d95f&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Comments_vue_vue_type_template_id_4aa6d95f___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Comments_vue_vue_type_template_id_4aa6d95f___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);