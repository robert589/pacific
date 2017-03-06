var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
define("common/component", ["require", "exports"], function (require, exports) {
    "use strict";
    var Component = (function () {
        function Component(root) {
            this.root = root;
            this.decorate();
            this.bindEvent();
        }
        Component.prototype.decorate = function () {
            this.id = this.root.getAttribute('id');
        };
        Component.prototype.bindEvent = function () {
        };
        Component.prototype.detach = function () {
        };
        /**
         * Remove completely
         */
        Component.prototype.remove = function () {
            this.detach();
            this.root.parentElement.removeChild(this.root);
        };
        Component.prototype.unbindEvent = function () {
        };
        Component.prototype.deconstruct = function () {
            this.detach();
            this.unbindEvent();
        };
        Component.prototype.getRoot = function () {
            return this.root;
        };
        Component.prototype.removeClass = function (className) {
            this.root.classList.remove(className);
        };
        Component.prototype.addClass = function (className) {
            this.root.classList.add(className);
        };
        Component.prototype.hasClass = function (className) {
            return this.root.classList.contains(className);
        };
        Component.prototype.releaseEvent = function (eventName) {
            this.root.dispatchEvent(new CustomEvent(eventName));
        };
        Component.prototype.attachEvent = function (eventName, callback) {
            this.root.addEventListener(eventName, callback);
        };
        return Component;
    }());
    exports.Component = Component;
});
define("common/button", ["require", "exports", "common/component"], function (require, exports, component_1) {
    "use strict";
    var Button = (function (_super) {
        __extends(Button, _super);
        function Button(root, clickEvent) {
            var _this = _super.call(this, root) || this;
            _this.addClickEvent(clickEvent);
            return _this;
        }
        Button.prototype.addClickEvent = function (cb) {
            this.root.onclick = function (e) {
                if (!this.isDisabled()) {
                    cb(e);
                }
            }.bind(this);
        };
        Button.prototype.disable = function (on) {
            this.root.disabled = on;
        };
        Button.prototype.isDisabled = function () {
            return this.root.disabled;
        };
        Button.prototype.detach = function () {
            _super.prototype.detach.call(this);
            this.root.onclick = null;
            this.root = null;
        };
        return Button;
    }(component_1.Component));
    exports.Button = Button;
});
define("common/modal", ["require", "exports", "common/component", "common/button"], function (require, exports, component_2, button_1) {
    "use strict";
    var Modal = (function (_super) {
        __extends(Modal, _super);
        function Modal(root) {
            return _super.call(this, root) || this;
        }
        Modal.prototype.show = function () {
            this.root.classList.add('modal-show');
            this.root.classList.remove('modal-hide');
        };
        Modal.prototype.hide = function () {
            this.root.classList.add('modal-hide');
            this.root.classList.remove('modal-show');
        };
        Modal.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.title = this.root.getElementsByClassName('modal-title')[0];
            this.closeButton = new button_1.Button(document.getElementById(this.id + "-close-button"), function (e) {
                this.hide();
            }.bind(this));
        };
        Modal.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.root.addEventListener('click', function (e) {
                if (e.target && !e.target.closest('.modal-content')) {
                    this.hide();
                }
            }.bind(this));
        };
        Modal.prototype.setTitle = function (title) {
            this.title.innerHTML = title;
        };
        return Modal;
    }(component_2.Component));
    exports.Modal = Modal;
});
define("common/confirm-dialog", ["require", "exports", "common/modal", "common/button"], function (require, exports, modal_1, button_2) {
    "use strict";
    var ConfirmDialog = (function (_super) {
        __extends(ConfirmDialog, _super);
        function ConfirmDialog(root) {
            return _super.call(this, root) || this;
        }
        ConfirmDialog.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.text = this.root.getElementsByClassName('cdialog-text')[0];
        };
        ConfirmDialog.prototype.setText = function (text) {
            this.text.innerHTML = text;
        };
        ConfirmDialog.prototype.clickOk = function (cb) {
            cb();
            this.hide();
        };
        ConfirmDialog.prototype.clickCancel = function () {
            this.hide();
        };
        ConfirmDialog.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ConfirmDialog.prototype.detach = function () {
        };
        ConfirmDialog.prototype.run = function (cb) {
            this.okBtn = new button_2.Button(document.getElementById(this.id + "-ok"), this.clickOk.bind(this, cb));
            this.cancelBtn = new button_2.Button(document.getElementById(this.id + "-cancel"), this.clickCancel.bind(this));
            this.show();
        };
        return ConfirmDialog;
    }(modal_1.Modal));
    exports.ConfirmDialog = ConfirmDialog;
});
define("common/empty-modal", ["require", "exports", "common/modal"], function (require, exports, modal_2) {
    "use strict";
    var EmptyModal = (function (_super) {
        __extends(EmptyModal, _super);
        function EmptyModal(root) {
            var _this = _super.call(this, root) || this;
            _this.setContent("Loading...");
            return _this;
        }
        EmptyModal.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.contentEl = this.root.getElementsByClassName('emodal-content')[0];
        };
        EmptyModal.prototype.setContent = function (text) {
            this.contentEl.innerHTML = text;
        };
        EmptyModal.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        EmptyModal.prototype.detach = function () {
        };
        return EmptyModal;
    }(modal_2.Modal));
    exports.EmptyModal = EmptyModal;
});
define("common/system", ["require", "exports", "common/confirm-dialog"], function (require, exports, confirm_dialog_1) {
    "use strict";
    var System = (function () {
        function System() {
        }
        System.getUserId = function () {
        };
        System.getBaseUrl = function () {
            return document.getElementById('base-url').value;
        };
        System.isEmptyValue = function (x) {
            return x === null || typeof x === 'undefined' || x === '';
        };
        System.capitalizeFirstLetter = function (text) {
            return text.charAt(0).toUpperCase() + text.slice(1);
        };
        System.isEmail = function (text) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(text);
        };
        System.addCsrf = function (data) {
            var csrfParam = System.getCsrfParam();
            var csrfToken = System.getCsrfValue();
            data[csrfParam] = csrfToken;
            return data;
        };
        System.addCsrfToUrl = function (url) {
            var csrfParam = System.getCsrfParam();
            var csrfToken = System.getCsrfValue();
            return url + "?" + csrfParam + "=" + csrfToken;
        };
        System.getCsrfParam = function () {
            return document.querySelector('meta[name="csrf-param"]').getAttribute('content');
        };
        System.getCsrfValue = function () {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        };
        System.checkIdExist = function (id) {
            return !System.isEmptyValue(document.getElementById(id));
        };
        System.showConfirmDialog = function (cb, title, content) {
            var dialog = new confirm_dialog_1.ConfirmDialog(document.getElementById('confirmdialog'));
            dialog.setText(content);
            dialog.setTitle(title);
            dialog.run(cb);
        };
        System.printToPrinter = function (html) {
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = html;
            window.print();
            document.body.innerHTML = originalContents;
        };
        return System;
    }());
    exports.System = System;
});
define("common/Field", ["require", "exports", "common/component", "common/system"], function (require, exports, component_3, system_1) {
    "use strict";
    var Field = (function (_super) {
        __extends(Field, _super);
        function Field(root) {
            return _super.call(this, root) || this;
        }
        Field.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.fieldError = this.root.getElementsByClassName('field-error')[0];
            this.name = this.root.getAttribute('data-name');
        };
        Field.prototype.showError = function (errorMessage) {
            this.fieldError.innerHTML = errorMessage;
            this.fieldError.classList.remove('app-hide');
        };
        Field.prototype.hideError = function () {
            this.fieldError.classList.add('app-hide');
        };
        Field.prototype.getName = function () {
            return this.name;
        };
        Field.prototype.getDisplayName = function () {
            var constructedName = "";
            var first = true;
            var piecesOfName = this.name.split("_");
            for (var _i = 0, piecesOfName_1 = piecesOfName; _i < piecesOfName_1.length; _i++) {
                var piece = piecesOfName_1[_i];
                if (first) {
                    first = false;
                }
                else {
                    constructedName += " ";
                }
                constructedName += system_1.System.capitalizeFirstLetter(piece);
            }
            return constructedName;
        };
        Field.prototype.setIndex = function (index) {
            this.root.setAttribute('data-index', index + "");
        };
        Field.prototype.getIndex = function () {
            return parseInt(this.root.getAttribute('data-index'));
        };
        return Field;
    }(component_3.Component));
    exports.Field = Field;
});
define("common/input-field", ["require", "exports", "common/Field", "common/system"], function (require, exports, Field_1, system_2) {
    "use strict";
    var InputField = (function (_super) {
        __extends(InputField, _super);
        function InputField(root) {
            var _this = _super.call(this, root) || this;
            _this.dateFormat = 'dd-mm-yy';
            _this.type = _this.inputElement.getAttribute("type");
            return _this;
        }
        Object.defineProperty(InputField, "VALUE_CHANGED", {
            get: function () { return "INPUT_FIELD_VALUE_CHANGED"; },
            enumerable: true,
            configurable: true
        });
        ;
        InputField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.inputElement = this.root.getElementsByClassName('input-field-input')[0];
            if (!system_2.System.isEmptyValue(this.root.getAttribute('data-datepicker'))) {
                $("#" + this.id).find(".input-field-input")
                    .datepicker({ dateFormat: "dd/mm/yy",
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function (date) {
                        this.triggerValueChangedEvent();
                    }.bind(this)
                });
            }
            else if (!system_2.System.isEmptyValue(this.root.getAttribute('data-timepicker'))) {
                $("#" + this.id).find(".input-field-input")
                    .timepicker({
                    change: function (time) {
                        this.triggerValueChangedEvent();
                    }.bind(this)
                });
            }
        };
        InputField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.valueChangeEvent = new CustomEvent(InputField.VALUE_CHANGED);
            this.inputElement.addEventListener('change', this.triggerValueChangedEvent.bind(this));
            if (this.type === "file") {
                this.inputElement.addEventListener('change click', this.triggerValueChangedEvent.bind(this));
            }
        };
        InputField.prototype.triggerValueChangedEvent = function () {
            this.inputElement.setAttribute('value', this.inputElement.value);
            this.root.dispatchEvent(this.valueChangeEvent);
        };
        InputField.prototype.detach = function () {
            this.inputElement = null;
        };
        InputField.prototype.unbindEvent = function () {
        };
        InputField.prototype.getValue = function () {
            if (this.type === "file") {
                return this.inputElement.files[0];
            }
            return this.inputElement.value;
        };
        InputField.prototype.setValue = function (val) {
            this.inputElement.value = val;
        };
        InputField.prototype.getDateFormat = function () {
            return this.dateFormat;
        };
        InputField.prototype.disable = function () {
            this.inputElement.setAttribute('disabled', "true");
        };
        InputField.prototype.enable = function () {
            this.inputElement.removeAttribute('disabled');
        };
        InputField.prototype.setMax = function (max) {
            try {
                if (this.type !== "number") {
                    throw new TypeError("Input field must be a number type");
                }
                else {
                    this.inputElement.max = max + "";
                }
            }
            catch (e) {
                console.log(e.message);
            }
        };
        InputField.prototype.setMin = function (min) {
            try {
                if (this.type !== "number") {
                    throw new TypeError("Input field must be a number type");
                }
                else {
                    this.inputElement.min = min + "";
                }
            }
            catch (e) {
                console.log(e.message);
            }
        };
        return InputField;
    }(Field_1.Field));
    exports.InputField = InputField;
});
define("common/upload-field", ["require", "exports", "common/Field", "common/input-field"], function (require, exports, Field_2, input_field_1) {
    "use strict";
    var UploadField = (function (_super) {
        __extends(UploadField, _super);
        function UploadField(root) {
            var _this = _super.call(this, root) || this;
            _this.url = _this.root.getAttribute('data-url');
            return _this;
        }
        UploadField.prototype.getValue = function () {
            return this.fileField.getValue();
        };
        UploadField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.fileField = new input_field_1.InputField(document.getElementById(this.id + "-file"));
        };
        UploadField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.fileField.attachEvent('change', this.uploadField.bind(this));
        };
        UploadField.prototype.uploadField = function () {
            $.ajax({
                url: this.url,
            });
        };
        UploadField.prototype.detach = function () {
        };
        return UploadField;
    }(Field_2.Field));
    exports.UploadField = UploadField;
});
define("common/validation", ["require", "exports"], function (require, exports) {
    "use strict";
    var Validation = (function () {
        function Validation() {
        }
        return Validation;
    }());
    exports.Validation = Validation;
});
define("common/range-validation", ["require", "exports", "common/validation"], function (require, exports, validation_1) {
    "use strict";
    var RangeValidation = (function (_super) {
        __extends(RangeValidation, _super);
        function RangeValidation(targetField, min, max) {
            var _this = _super.call(this) || this;
            _this.targetField = targetField;
            _this.min = min;
            _this.max = max;
            _this.errorMessage = _this.getErrorMessage();
            _this.validate = _this.validateRange.bind(_this);
            return _this;
        }
        RangeValidation.prototype.getErrorMessage = function () {
            var message;
            if (this.max !== null && this.min !== null) {
                message =
                    this.targetField.getDisplayName() + " must be in the range of " +
                        this.min + " to " + this.max;
            }
            else if (this.min !== null) {
                message = this.targetField.getDisplayName() + " cannot be less than "
                    + this.min;
            }
            else {
                message = this.targetField.getDisplayName() + " must be at most "
                    + this.min;
            }
            return message;
        };
        RangeValidation.prototype.validateRange = function () {
            var valid = (this.min === null ||
                this.targetField.getValue() >= this.min)
                && (this.max === null ||
                    this.targetField.getValue() <= this.max);
            if (!valid) {
                this.targetField.showError(this.errorMessage);
            }
            return valid;
        };
        return RangeValidation;
    }(validation_1.Validation));
    exports.RangeValidation = RangeValidation;
});
define("common/form", ["require", "exports", "common/component", "common/system", "common/button"], function (require, exports, component_4, system_3, button_3) {
    "use strict";
    var Form = (function (_super) {
        __extends(Form, _super);
        function Form(root) {
            var _this = _super.call(this, root) || this;
            _this.enableSubmit = 0;
            _this.rules();
            return _this;
        }
        Form.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            //init variable
            this.requiredFields = [];
            this.allFields = [];
            this.emailFields = [];
            this.rangeValidations = [];
            this.validations = [];
            this.method = this.root.getAttribute('method');
            this.url = this.root.getAttribute('url');
            this.file = Boolean(this.root.getAttribute('data-file'));
            this.submitButton = new button_3.Button(document.getElementById(this.id + "-submit-btn"), this.submit.bind(this));
        };
        Form.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.root.onsubmit = function (e) {
                return false;
            };
            this.root.onkeypress = function (e) {
                if (e.keyCode === 13) {
                    this.submit(e);
                }
            }.bind(this);
        };
        Form.prototype.registerFields = function (fields) {
            this.allFields = this.allFields.concat(fields);
        };
        Form.prototype.setRequiredField = function (fields) {
            this.requiredFields = this.requiredFields.concat(fields);
        };
        Form.prototype.setRangeValidations = function (validations) {
            this.rangeValidations = this.rangeValidations.concat(validations);
        };
        Form.prototype.setValidations = function (validations) {
            this.validations = this.validations.concat(validations);
        };
        Form.prototype.setEmailField = function (fields) {
            this.emailFields = this.emailFields.concat(fields);
        };
        Form.prototype.validate = function () {
            this.hideAllErrors();
            var valid = true;
            //validate required fields
            for (var _i = 0, _a = this.requiredFields; _i < _a.length; _i++) {
                var field = _a[_i];
                if (system_3.System.isEmptyValue(field.getValue())) {
                    field.showError(field.getDisplayName() + " is required");
                    valid = false;
                }
            }
            //validate email fields
            for (var _b = 0, _c = this.emailFields; _b < _c.length; _b++) {
                var field = _c[_b];
                if (!system_3.System.isEmail(field.getValue())) {
                    field.showError("The input must be a valid email address");
                    valid = false;
                }
            }
            //execute range validations
            for (var _d = 0, _e = this.rangeValidations; _d < _e.length; _d++) {
                var validation = _e[_d];
                if (!validation.validate()) {
                    valid = false;
                }
            }
            //execute all validations
            for (var _f = 0, _g = this.validations; _f < _g.length; _f++) {
                var validation = _g[_f];
                if (!validation.validate()) {
                    validation.targetField.showError(validation.errorMessage);
                    valid = false;
                }
            }
            return valid;
        };
        Form.prototype.hideAllErrors = function () {
            for (var _i = 0, _a = this.allFields; _i < _a.length; _i++) {
                var field = _a[_i];
                field.hideError();
            }
        };
        Form.prototype.getJson = function (sendCsrf) {
            var data = {};
            if (sendCsrf) {
                data = system_3.System.addCsrf(data);
            }
            for (var _i = 0, _a = this.allFields; _i < _a.length; _i++) {
                var field = _a[_i];
                data[field.getName()] = field.getValue();
            }
            return data;
        };
        Form.prototype.submit = function (e) {
            e.preventDefault();
            if (this.enableSubmit !== 0) {
                return false;
            }
            var valid = this.validate();
            if (valid) {
                this.sendToServerSide();
            }
            return false;
        };
        Form.prototype.sendToServerSide = function () {
            this.submitButton.disable(true);
            var ajaxSettings = {
                url: this.file ? system_3.System.addCsrfToUrl(this.url) : this.url,
                type: this.method,
                context: this,
                data: this.getJson(true),
                success: function (data) {
                    var parsed = JSON.parse(data);
                    if (parsed['status'] === 1) {
                        this.successCb(parsed);
                    }
                    else {
                        if (!system_3.System.isEmptyValue(parsed['errors'])) {
                            this.handleErrors(parsed['errors']);
                        }
                    }
                    this.submitButton.disable(false);
                },
                error: function () {
                    this.submitButton.disable(false);
                }
            };
            if (this.file) {
                ajaxSettings['processData'] = false;
                ajaxSettings['cache'] = false;
                ajaxSettings['contentType'] = false;
            }
            $.ajax(ajaxSettings);
        };
        Form.prototype.handleErrors = function (errors) {
            for (var _i = 0, _a = this.allFields; _i < _a.length; _i++) {
                var field = _a[_i];
                if (!system_3.System.isEmptyValue(errors[field.getName()])) {
                    field.showError(errors[field.getName()][0]);
                }
            }
        };
        Form.prototype.findField = function (name) {
            for (var _i = 0, _a = this.allFields; _i < _a.length; _i++) {
                var field = _a[_i];
                if (field.getName() === name) {
                    return field;
                }
            }
        };
        return Form;
    }(component_4.Component));
    exports.Form = Form;
});
define("project/login-form", ["require", "exports", "common/form", "common/input-field"], function (require, exports, form_1, input_field_2) {
    "use strict";
    var LoginForm = (function (_super) {
        __extends(LoginForm, _super);
        function LoginForm(root) {
            var _this = _super.call(this, root) || this;
            _this.failCb = function () {
            }.bind(_this);
            _this.successCb = function (data) {
                window.location.reload();
            }.bind(_this);
            return _this;
        }
        LoginForm.prototype.rules = function () {
            this.setRequiredField([this.emailField, this.passwordField]);
            this.setEmailField([this.emailField]);
        };
        LoginForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.emailField = new input_field_2.InputField(document.getElementById(this.id + "-email-field"));
            this.passwordField = new input_field_2.InputField(document.getElementById(this.id + "-password-field"));
            this.registerFields([this.emailField, this.passwordField]);
        };
        return LoginForm;
    }(form_1.Form));
    exports.LoginForm = LoginForm;
});
define("project/login", ["require", "exports", "common/component", "project/login-form"], function (require, exports, component_5, login_form_1) {
    "use strict";
    var Login = (function (_super) {
        __extends(Login, _super);
        function Login(root) {
            return _super.call(this, root) || this;
        }
        Login.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.loginForm = new login_form_1.LoginForm(document.getElementById(this.id + "form"));
        };
        Login.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        Login.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        Login.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return Login;
    }(component_5.Component));
    exports.Login = Login;
});
define("common/text-area-field", ["require", "exports", "common/Field"], function (require, exports, Field_3) {
    "use strict";
    var TextAreaField = (function (_super) {
        __extends(TextAreaField, _super);
        function TextAreaField(root) {
            return _super.call(this, root) || this;
        }
        TextAreaField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.inputElement = this.root.getElementsByClassName('text-area-field-edit')[0];
        };
        TextAreaField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        TextAreaField.prototype.getValue = function () {
            return this.inputElement.innerHTML;
        };
        TextAreaField.prototype.resetValue = function () {
            this.inputElement.innerHTML = null;
        };
        return TextAreaField;
    }(Field_3.Field));
    exports.TextAreaField = TextAreaField;
});
define("project/create-owner-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/system"], function (require, exports, form_2, input_field_3, text_area_field_1, system_4) {
    "use strict";
    var CreateOwnerForm = (function (_super) {
        __extends(CreateOwnerForm, _super);
        function CreateOwnerForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_4.System.getBaseUrl() + "/owner/index";
            }.bind(_this);
            return _this;
        }
        CreateOwnerForm.prototype.rules = function () {
            this.setRequiredField([this.firstNameField, this.emailField, this.passwordField]);
            this.registerFields([this.firstNameField, this.lastNameField,
                this.telpField, this.addrField, this.emailField, this.passwordField]);
        };
        CreateOwnerForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.firstNameField = new input_field_3.InputField(document.getElementById(this.id + "-first-name"));
            this.lastNameField = new input_field_3.InputField(document.getElementById(this.id + "-last-name"));
            this.telpField = new input_field_3.InputField(document.getElementById(this.id + "-telephone"));
            this.addrField = new text_area_field_1.TextAreaField(document.getElementById(this.id + "-address"));
            this.emailField = new input_field_3.InputField(document.getElementById(this.id + "-email"));
            this.passwordField = new input_field_3.InputField(document.getElementById(this.id + "-password"));
        };
        CreateOwnerForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateOwnerForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateOwnerForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateOwnerForm;
    }(form_2.Form));
    exports.CreateOwnerForm = CreateOwnerForm;
});
define("project/create-owner", ["require", "exports", "common/component", "project/create-owner-form"], function (require, exports, component_6, create_owner_form_1) {
    "use strict";
    var CreateOwner = (function (_super) {
        __extends(CreateOwner, _super);
        function CreateOwner(root) {
            return _super.call(this, root) || this;
        }
        CreateOwner.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_owner_form_1.CreateOwnerForm(document.getElementById(this.id + "-form"));
        };
        CreateOwner.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateOwner.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateOwner.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateOwner;
    }(component_6.Component));
    exports.CreateOwner = CreateOwner;
});
define("project/list-owner", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_7, button_4, system_5) {
    "use strict";
    var ListOwner = (function (_super) {
        __extends(ListOwner, _super);
        function ListOwner(root) {
            return _super.call(this, root) || this;
        }
        ListOwner.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addBtn = new button_4.Button(document.getElementById(this.id + "-add"), this.redirectToAddOwner.bind(this));
        };
        ListOwner.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ListOwner.prototype.redirectToAddOwner = function () {
            window.location.href = system_5.System.getBaseUrl() + "/owner/create";
        };
        ListOwner.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ListOwner.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ListOwner;
    }(component_7.Component));
    exports.ListOwner = ListOwner;
});
define("project/create-ship-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/system"], function (require, exports, form_3, input_field_4, text_area_field_2, system_6) {
    "use strict";
    var CreateShipForm = (function (_super) {
        __extends(CreateShipForm, _super);
        function CreateShipForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_6.System.getBaseUrl() + "/ship/index";
            };
            return _this;
        }
        CreateShipForm.prototype.rules = function () {
            this.setRequiredField([this.nameField, this.codeField]);
            this.registerFields([this.nameField, this.descField, this.codeField]);
        };
        CreateShipForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.nameField = new input_field_4.InputField(document.getElementById(this.id + "-name"));
            this.descField = new text_area_field_2.TextAreaField(document.getElementById(this.id + "-desc"));
            this.codeField = new input_field_4.InputField(document.getElementById(this.id + "-code"));
        };
        CreateShipForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateShipForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateShipForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateShipForm;
    }(form_3.Form));
    exports.CreateShipForm = CreateShipForm;
});
define("project/create-ship", ["require", "exports", "common/component", "project/create-ship-form"], function (require, exports, component_8, create_ship_form_1) {
    "use strict";
    var CreateShip = (function (_super) {
        __extends(CreateShip, _super);
        function CreateShip(root) {
            return _super.call(this, root) || this;
        }
        CreateShip.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_ship_form_1.CreateShipForm(document.getElementById(this.id + "-form"));
        };
        CreateShip.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateShip.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateShip.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateShip;
    }(component_8.Component));
    exports.CreateShip = CreateShip;
});
define("project/list-ship", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_9, button_5, system_7) {
    "use strict";
    var ListShip = (function (_super) {
        __extends(ListShip, _super);
        function ListShip(root) {
            return _super.call(this, root) || this;
        }
        ListShip.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addBtn = new button_5.Button(document.getElementById(this.id + "-add"), this.redirectToAddShip.bind(this));
            this.deletes = [];
            var deleteRaws = this.root.getElementsByClassName('list-ship-delete');
            for (var i = 0; i < deleteRaws.length; i++) {
                this.deletes.push(new button_5.Button(deleteRaws.item(i), this.showDeleteDialog.bind(this, deleteRaws.item(i))));
            }
            this.edits = [];
            var editRaws = this.root.getElementsByClassName('list-ship-edit');
            for (var i = 0; i < editRaws.length; i++) {
                this.edits.push(new button_5.Button(editRaws.item(i), this.redirectToEditShip.bind(this, editRaws.item(i))));
            }
        };
        ListShip.prototype.redirectToEditShip = function (raw) {
            window.location.href = system_7.System.getBaseUrl() + "/ship/edit?id=" + raw.getAttribute('data-ship-id');
        };
        ListShip.prototype.showDeleteDialog = function (raw) {
            system_7.System.showConfirmDialog(this.deleteShip.bind(null, raw), "Are you sure", "Once it is deleted, you have to ask admin to retrieve it");
        };
        ListShip.prototype.deleteShip = function (raw) {
            var shipId = raw.getAttribute('data-ship-id');
            var data = {};
            data['ship_id'] = shipId;
            $.ajax({
                url: system_7.System.getBaseUrl() + "/ship/remove",
                data: system_7.System.addCsrf(data),
                context: this,
                dataType: "json",
                method: "post",
                success: function (data) {
                    if (data.status) {
                        window.location.reload();
                    }
                },
                error: function (data) {
                }
            });
        };
        ListShip.prototype.redirectToAddShip = function () {
            window.location.href = system_7.System.getBaseUrl() + "/ship/create";
        };
        ListShip.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ListShip.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ListShip.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ListShip;
    }(component_9.Component));
    exports.ListShip = ListShip;
});
define("common/search-field-dropdown-item", ["require", "exports", "common/component"], function (require, exports, component_10) {
    "use strict";
    var SearchFieldDropdownItem = (function (_super) {
        __extends(SearchFieldDropdownItem, _super);
        function SearchFieldDropdownItem(root) {
            return _super.call(this, root) || this;
        }
        Object.defineProperty(SearchFieldDropdownItem, "CLICK_SFDI_EVENT", {
            get: function () { return "CLICK_SFDI_EVENT"; },
            enumerable: true,
            configurable: true
        });
        ;
        Object.defineProperty(SearchFieldDropdownItem, "HOVER_SFDI_EVENT", {
            get: function () { return "HOVER_SFDI_EVENT"; },
            enumerable: true,
            configurable: true
        });
        ;
        SearchFieldDropdownItem.prototype.getItemId = function () {
            return this.itemId;
        };
        SearchFieldDropdownItem.prototype.getText = function () {
            return this.text;
        };
        SearchFieldDropdownItem.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.text = this.root.getAttribute("data-text");
            this.itemId = this.root.getAttribute("data-itemId");
        };
        SearchFieldDropdownItem.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            var sfdiJson = {
                text: this.text,
                itemId: this.itemId
            };
            this.clickSfdiEvent = new CustomEvent(SearchFieldDropdownItem.CLICK_SFDI_EVENT, { detail: sfdiJson });
            this.hoverSfdiEvent = new CustomEvent(SearchFieldDropdownItem.HOVER_SFDI_EVENT, { detail: sfdiJson });
            this.root.addEventListener("click", this.dispatchClickSfdiEvent.bind(this));
            this.root.addEventListener("mouseover", this.addHoverClass.bind(this));
            this.root.addEventListener("mouseout", this.removeHoverClass.bind(this));
        };
        SearchFieldDropdownItem.prototype.dispatchClickSfdiEvent = function () {
            this.root.dispatchEvent(this.clickSfdiEvent);
        };
        SearchFieldDropdownItem.prototype.addHoverClass = function () {
            this.root.dispatchEvent(this.hoverSfdiEvent);
            this.addClass("sfdi-hover");
        };
        SearchFieldDropdownItem.prototype.removeHoverClass = function () {
            this.removeClass("sfdi-hover");
        };
        SearchFieldDropdownItem.prototype.unbindEvent = function () {
            this.root.addEventListener("mouseover", this.addHoverClass.bind(this));
            this.root.addEventListener("mouseout", this.removeHoverClass.bind(this));
            this.root.addEventListener("click", this.dispatchClickSfdiEvent.bind(this));
        };
        SearchFieldDropdownItem.prototype.disabled = function (on) {
            if (on) {
                this.root.classList.add('disabled');
            }
            else {
                this.root.classList.remove('disabled');
            }
        };
        return SearchFieldDropdownItem;
    }(component_10.Component));
    exports.SearchFieldDropdownItem = SearchFieldDropdownItem;
});
define("common/key-code", ["require", "exports"], function (require, exports) {
    "use strict";
    var KeyCode = (function () {
        function KeyCode() {
        }
        Object.defineProperty(KeyCode, "DOWN_KEY", {
            get: function () {
                return 40;
            },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(KeyCode, "UP_KEY", {
            get: function () {
                return 38;
            },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(KeyCode, "ENTER_KEY", {
            get: function () {
                return 13;
            },
            enumerable: true,
            configurable: true
        });
        return KeyCode;
    }());
    exports.KeyCode = KeyCode;
});
define("common/math", ["require", "exports"], function (require, exports) {
    "use strict";
    var Math = (function () {
        function Math() {
        }
        Math.modulo = function (value, base) {
            return ((value % base) + base) % base;
        };
        return Math;
    }());
    exports.Math = Math;
});
define("common/search-field", ["require", "exports", "common/Field", "common/system", "common/search-field-dropdown-item", "common/button", "common/key-code", "common/math"], function (require, exports, field_1, system_8, search_field_dropdown_item_1, button_6, key_code_1, math_1) {
    "use strict";
    var SearchField = (function (_super) {
        __extends(SearchField, _super);
        function SearchField(root) {
            var _this = _super.call(this, root) || this;
            _this.additionalData = [];
            _this.disabledItems = [];
            _this.initValue();
            return _this;
        }
        Object.defineProperty(SearchField, "GET_VALUE_EVENT", {
            get: function () { return "SEARCH_FIELD_GET_VALUE_EVENT"; },
            enumerable: true,
            configurable: true
        });
        ;
        Object.defineProperty(SearchField, "LOSE_VALUE_EVENT", {
            get: function () { return "SEARCH_FIELD_LOSE_VALUE_EVENT"; },
            enumerable: true,
            configurable: true
        });
        ;
        SearchField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.url = this.root.getAttribute('data-url');
            this.items = [];
            this.input = this.root.getElementsByClassName('search-field-input')[0];
            this.dropdown = this.root.getElementsByClassName('search-field-dropdown')[0];
            this.loading = this.root.getElementsByClassName('search-field-loading')[0];
            this.resetBtn = new button_6.Button(document.getElementById(this.id + "-reset"), this.reset.bind(this));
        };
        SearchField.prototype.reset = function () {
            this.resetValue();
            this.emptyText();
        };
        SearchField.prototype.bindEvent = function () {
            this.input.addEventListener('input', function (e) {
                this.sendAjax();
                if (this.curText !== this.input.value) {
                    this.resetValue();
                }
            }.bind(this));
            this.input.addEventListener('click', function (e) {
                this.sendAjax();
            }.bind(this));
            this.getValueEvent = new CustomEvent(SearchField.GET_VALUE_EVENT);
            this.loseValueEvent = new CustomEvent(SearchField.LOSE_VALUE_EVENT);
            this.root.addEventListener('keydown', this.controlEvent.bind(this));
            document.addEventListener('click', function (e) {
                if (e.target && !e.target.closest('.search-field-dropdown')) {
                    this.emptyDropdown();
                }
                if (e.target && e.target.closest('.search-field-input')) {
                }
                else if (e.target && !e.target.closest('.search-field-input')) {
                }
            }.bind(this));
        };
        SearchField.prototype.registerControlEvent = function () {
            this.root.addEventListener('keydown', this.controlEvent.bind(this));
        };
        SearchField.prototype.controlEvent = function (e) {
            if (e.which === key_code_1.KeyCode.DOWN_KEY) {
                this.searchDownDropdown();
            }
            else if (e.which === key_code_1.KeyCode.UP_KEY) {
                this.searchUpDropdown();
            }
            else if (e.which === key_code_1.KeyCode.ENTER_KEY) {
                e.preventDefault();
                this.selectHoverDropdown();
            }
        };
        SearchField.prototype.deregisterControlEvent = function () {
            this.root.removeEventListener('keydown', this.controlEvent.bind(this));
        };
        SearchField.prototype.searchDownDropdown = function () {
            if (this.items.length === 0) {
                return;
            }
            for (var i = 0; i < this.items.length; i++) {
                if (this.items[i].hasClass("sfdi-hover")) {
                    this.items[i].removeClass("sfdi-hover");
                    this.items[math_1.Math.modulo((i + 1), this.items.length)].addClass("sfdi-hover");
                    return;
                }
            }
            this.items[0].addClass("sfdi-hover");
        };
        SearchField.prototype.searchUpDropdown = function () {
            if (this.items.length === 0) {
                return;
            }
            for (var i = 0; i < this.items.length; i++) {
                if (this.items[i].hasClass("sfdi-hover")) {
                    this.items[i].removeClass("sfdi-hover");
                    this.items[math_1.Math.modulo((i - 1), this.items.length)].addClass("sfdi-hover");
                    return;
                }
            }
            this.items[this.items.length - 1].addClass("sfdi-hover");
        };
        SearchField.prototype.selectHoverDropdown = function () {
            for (var i = 0; i < this.items.length; i++) {
                if (this.items[i].hasClass("sfdi-hover")) {
                    this.items[i].releaseEvent("click");
                }
            }
            this.emptyDropdown();
        };
        SearchField.prototype.resetValue = function () {
            this.curText = null;
            this.valueId = null;
            this.input.classList.remove('selected');
            this.root.dispatchEvent(this.loseValueEvent);
        };
        SearchField.prototype.emptyText = function () {
            this.input.value = null;
        };
        SearchField.prototype.emptyDropdown = function () {
            this.hideDropdown();
            this.dropdown.innerHTML = null;
            var i = 0;
            for (i = 0; i < this.items.length; i++) {
                this.items[i].deconstruct();
            }
            this.items = [];
        };
        SearchField.prototype.setAdditionalData = function (data) {
            this.additionalData = data;
        };
        SearchField.prototype.showLoading = function () {
            this.loading.classList.remove('app-hide');
        };
        SearchField.prototype.hideLoading = function () {
            this.loading.classList.add('app-hide');
        };
        SearchField.prototype.sendAjax = function () {
            this.showLoading();
            var data = {};
            data['q'] = this.input.value;
            data['id'] = this.id;
            //merge
            for (var attrname in this.additionalData) {
                data[attrname] = this.additionalData[attrname];
            }
            system_8.System.addCsrf(data);
            $.ajax({
                url: this.url,
                method: 'get',
                context: this,
                data: data,
                success: function (data) {
                    this.hideLoading();
                    var parsed = JSON.parse(data);
                    if (parsed.status === 1) {
                        this.emptyDropdown();
                        this.setDropdown(parsed.views);
                    }
                },
                error: function () {
                    this.hideLoading();
                }
            });
        };
        SearchField.prototype.initValue = function () {
            /**
             * Need improvement
             */
            if (!system_8.System.isEmptyValue(this.input.value)) {
                var index = this.root.getAttribute('data-index');
                var id = (system_8.System.isEmptyValue(index)) ? this.input.value : index;
                this.setValue(id, this.input.value);
            }
        };
        SearchField.prototype.setDropdown = function (views) {
            this.dropdown.innerHTML = views;
            var results = this.dropdown.getElementsByClassName('sfdi');
            var i;
            for (i = 0; i < results.length; i++) {
                this.items.push(new search_field_dropdown_item_1.SearchFieldDropdownItem(results.item(i)));
                if (this.disabledItems.indexOf(this.items[i].getItemId() + "") !== -1) {
                    this.items[i].disabled(true);
                }
                this.items[i].attachEvent(search_field_dropdown_item_1.SearchFieldDropdownItem.CLICK_SFDI_EVENT, function (e) {
                    this.setValue(e.detail.itemId, e.detail.text);
                    this.emptyDropdown();
                }.bind(this));
                this.items[i].attachEvent(search_field_dropdown_item_1.SearchFieldDropdownItem.HOVER_SFDI_EVENT, this.removeHoverExcept.bind(this));
            }
            this.showDropdown();
        };
        SearchField.prototype.removeHoverExcept = function (e) {
            var itemId = e.detail.itemId;
            for (var i = 0; i < this.items.length; i++) {
                if (this.items[i].hasClass("sfdi-hover") &&
                    this.items[i].getItemId() !== itemId) {
                    this.items[i].removeClass("sfdi-hover");
                }
            }
        };
        SearchField.prototype.hideDropdown = function () {
            this.dropdown.classList.add('app-hide');
        };
        SearchField.prototype.showDropdown = function () {
            this.dropdown.classList.remove('app-hide');
        };
        SearchField.prototype.setValue = function (id, text) {
            this.input.value = text;
            this.valueId = id;
            this.curText = text;
            this.input.classList.add('selected');
            this.root.dispatchEvent(this.getValueEvent);
        };
        SearchField.prototype.getValue = function () {
            return this.valueId;
        };
        SearchField.prototype.getCurText = function () {
            return this.curText;
        };
        SearchField.prototype.disable = function () {
            this.input.setAttribute('disabled', "true");
        };
        SearchField.prototype.enable = function () {
            this.input.removeAttribute('disabled');
        };
        SearchField.prototype.disableItem = function (id) {
            this.disabledItems.push(id);
        };
        SearchField.prototype.enableItem = function (id) {
            var index = this.disabledItems.indexOf(id);
            if (index > -1) {
                this.disabledItems.splice(index, 1);
            }
        };
        SearchField.prototype.clearDisabledItems = function () {
            this.disabledItems = [];
        };
        return SearchField;
    }(field_1.Field));
    exports.SearchField = SearchField;
});
define("project/ownership-gridview", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_11, button_7, system_9) {
    "use strict";
    var OwnershipGridview = (function (_super) {
        __extends(OwnershipGridview, _super);
        function OwnershipGridview(root) {
            return _super.call(this, root) || this;
        }
        OwnershipGridview.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            var elements = this.root.getElementsByClassName('own-gv-delete');
            this.deletes = [];
            for (var i = 0; i < elements.length; i++) {
                this.deletes.push(new button_7.Button(elements.item(i), this.showDeleteDialog.bind(this, elements.item(i))));
            }
        };
        OwnershipGridview.prototype.showDeleteDialog = function (raw) {
            system_9.System.showConfirmDialog(this.deleteOwnership.bind(null, raw), "Are you sure", "Are you sure?");
        };
        OwnershipGridview.prototype.deleteOwnership = function (raw) {
            var shipId = raw.getAttribute('data-ship-id');
            var ownerId = raw.getAttribute('data-owner-id');
            var data = {};
            data['ship_id'] = shipId;
            data['owner_id'] = ownerId;
            $.ajax({
                url: system_9.System.getBaseUrl() + "/ship/remove-owner",
                data: system_9.System.addCsrf(data),
                context: this,
                dataType: "json",
                method: "post",
                success: function (data) {
                    if (data.status) {
                        window.location.reload();
                    }
                },
                error: function (data) {
                }
            });
        };
        OwnershipGridview.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        OwnershipGridview.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        OwnershipGridview.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return OwnershipGridview;
    }(component_11.Component));
    exports.OwnershipGridview = OwnershipGridview;
});
define("project/ship-ownership", ["require", "exports", "common/component", "common/search-field", "common/button", "common/system", "project/ownership-gridview"], function (require, exports, component_12, search_field_1, button_8, system_10, ownership_gridview_1) {
    "use strict";
    var ShipOwnership = (function (_super) {
        __extends(ShipOwnership, _super);
        function ShipOwnership(root) {
            return _super.call(this, root) || this;
        }
        ShipOwnership.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.ship = new search_field_1.SearchField(document.getElementById(this.id + "-ship"));
            this.area = this.root.getElementsByClassName('ship-owner-area')[0];
            this.owner = new search_field_1.SearchField(document.getElementById(this.id + "-owner"));
            this.add = new button_8.Button(document.getElementById(this.id + "-add"), this.assignShip.bind(this));
        };
        ShipOwnership.prototype.assignShip = function () {
            var data = {};
            data['ship_id'] = this.ship.getValue();
            data['owner_id'] = this.owner.getValue();
            data = system_10.System.addCsrf(data);
            this.add.disable(true);
            $.ajax({
                url: system_10.System.getBaseUrl() + "/ship/assign",
                data: data,
                dataType: "json",
                context: this,
                method: "post",
                success: function (data) {
                    this.add.disable(false);
                    if (data.status) {
                        window.location.reload();
                    }
                },
                error: function (data) {
                }
            });
        };
        ShipOwnership.prototype.enableOwnerField = function () {
            this.owner.enable();
            this.owner.resetValue();
            this.owner.emptyText();
        };
        ShipOwnership.prototype.getOwnershipGridview = function () {
            var data = {};
            data['ship_id'] = this.ship.getValue();
            $.ajax({
                url: system_10.System.getBaseUrl() + "/ship/get-ownership-gv",
                data: system_10.System.addCsrf(data),
                dataType: "json",
                context: this,
                method: "post",
                success: function (data) {
                    this.add.disable(false);
                    if (data.status) {
                        this.addGridviewToArea(data.views);
                    }
                },
                error: function (data) {
                }
            });
        };
        ShipOwnership.prototype.addGridviewToArea = function (views) {
            this.area.innerHTML = "";
            if (!system_10.System.isEmptyValue(this.ownershipGridview)) {
                this.ownershipGridview.deconstruct();
            }
            var wrapper = document.createElement("div");
            wrapper.innerHTML = views;
            var raw = wrapper.getElementsByClassName('grid-view')[0];
            this.area.appendChild(raw);
            this.ownershipGridview = new ownership_gridview_1.OwnershipGridview(raw);
        };
        ShipOwnership.prototype.disableOwnerField = function () {
            this.owner.disable();
            this.owner.resetValue();
            this.owner.emptyText();
        };
        ShipOwnership.prototype.enableAddBtn = function () {
            this.add.disable(false);
        };
        ShipOwnership.prototype.disableAddBtn = function () {
            this.add.disable(true);
        };
        ShipOwnership.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.ship.attachEvent(search_field_1.SearchField.GET_VALUE_EVENT, this.enableOwnerField.bind(this));
            this.ship.attachEvent(search_field_1.SearchField.GET_VALUE_EVENT, this.getOwnershipGridview.bind(this));
            this.ship.attachEvent(search_field_1.SearchField.LOSE_VALUE_EVENT, this.disableOwnerField.bind(this));
            this.owner.attachEvent(search_field_1.SearchField.GET_VALUE_EVENT, this.enableAddBtn.bind(this));
            this.owner.attachEvent(search_field_1.SearchField.LOSE_VALUE_EVENT, this.disableAddBtn.bind(this));
        };
        ShipOwnership.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ShipOwnership.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ShipOwnership;
    }(component_12.Component));
    exports.ShipOwnership = ShipOwnership;
});
define("project/add-report-form", ["require", "exports", "common/form", "common/input-field"], function (require, exports, form_4, input_field_5) {
    "use strict";
    var AddReportForm = (function (_super) {
        __extends(AddReportForm, _super);
        function AddReportForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = _this.successCallback.bind(_this);
            return _this;
        }
        Object.defineProperty(AddReportForm, "ADD_REPORT_FORM_SUCCESS", {
            get: function () { return "addreportformsuccess"; },
            enumerable: true,
            configurable: true
        });
        ;
        AddReportForm.prototype.rules = function () {
            this.registerFields([this.debetField, this.remarkField,
                this.shipField, this.date, this.creditField]);
            this.setRequiredField([this.debetField, this.shipField,
                this.date,
                this.remarkField, this.creditField]);
        };
        AddReportForm.prototype.successCallback = function (data) {
            var json = {
                views: data.views
            };
            this.successEvent = new CustomEvent(AddReportForm.ADD_REPORT_FORM_SUCCESS, { detail: json });
            this.root.dispatchEvent(this.successEvent);
            this.debetField.setValue("0");
            this.remarkField.setValue("");
            this.creditField.setValue("0");
        };
        AddReportForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.shipField = new input_field_5.InputField(document.getElementById(this.id + "-ship"));
            this.date = new input_field_5.InputField(document.getElementById(this.id + "-date"));
            this.debetField = new input_field_5.InputField(document.getElementById(this.id + "-debet"));
            this.remarkField = new input_field_5.InputField(document.getElementById(this.id + "-remark"));
            this.creditField = new input_field_5.InputField(document.getElementById(this.id + "-credit"));
        };
        AddReportForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddReportForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddReportForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddReportForm;
    }(form_4.Form));
    exports.AddReportForm = AddReportForm;
});
define("project/daily-report-item", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_13, button_9, system_11) {
    "use strict";
    var DailyReportItem = (function (_super) {
        __extends(DailyReportItem, _super);
        function DailyReportItem(root) {
            var _this = _super.call(this, root) || this;
            _this.reportId = _this.root.getAttribute('data-report-id');
            return _this;
        }
        DailyReportItem.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.viewArea = document.getElementById(this.id + "-view");
            this.removeArea = document.getElementById(this.id + "-remove-area");
            this.removeBtn = new button_9.Button(document.getElementById(this.id + "-remove-btn"), this.removeItem.bind(this));
            this.cancelRemove = new button_9.Button(document.getElementById(this.id + "-cancel"), this.cancelRemoveItem.bind(this));
        };
        DailyReportItem.prototype.removeItem = function () {
            this.removeBtn.disable(true);
            var data = {};
            data['report_id'] = this.reportId;
            $.ajax({
                url: system_11.System.getBaseUrl() + "/report/remove",
                data: system_11.System.addCsrf(data),
                dataType: "json",
                method: "post",
                context: this,
                success: function (data) {
                    this.removeBtn.disable(false);
                    this.viewArea.classList.add('app-hide');
                    this.removeArea.classList.remove('app-hide');
                },
                error: function (data) {
                    this.removeBtn.disable(false);
                }
            });
        };
        DailyReportItem.prototype.cancelRemoveItem = function () {
            this.cancelRemove.disable(true);
            var data = {};
            data['report_id'] = this.reportId;
            $.ajax({
                url: system_11.System.getBaseUrl() + "/report/cancel-remove",
                data: system_11.System.addCsrf(data),
                dataType: "json",
                method: "post",
                context: this,
                success: function (data) {
                    this.cancelRemove.disable(false);
                    this.viewArea.classList.remove('app-hide');
                    this.removeArea.classList.add('app-hide');
                },
                error: function (data) {
                    this.removeBtn.disable(false);
                }
            });
        };
        DailyReportItem.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        DailyReportItem.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DailyReportItem.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DailyReportItem;
    }(component_13.Component));
    exports.DailyReportItem = DailyReportItem;
});
define("project/daily-report-view", ["require", "exports", "common/component", "project/add-report-form", "project/daily-report-item"], function (require, exports, component_14, add_report_form_1, daily_report_item_1) {
    "use strict";
    var DailyReportView = (function (_super) {
        __extends(DailyReportView, _super);
        function DailyReportView(root) {
            return _super.call(this, root) || this;
        }
        DailyReportView.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.arForm = new add_report_form_1.AddReportForm(document.getElementById(this.id + "-arform"));
            this.area = this.root.getElementsByClassName('dr-view-area')[0];
            this.items = [];
            var itemsRaw = this.root.getElementsByClassName('dr-item');
            for (var i = 0; i < itemsRaw.length; i++) {
                this.items.push(new daily_report_item_1.DailyReportItem(itemsRaw.item(i)));
            }
        };
        DailyReportView.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.arForm.attachEvent(add_report_form_1.AddReportForm.ADD_REPORT_FORM_SUCCESS, this.addNewDailyItem.bind(this));
        };
        DailyReportView.prototype.addNewDailyItem = function (e) {
            var json = e.detail;
            var areaRaws = json.views;
            var div = document.createElement('div');
            div.innerHTML = areaRaws;
            var itemRaw = div.getElementsByClassName('dr-item')[0];
            this.area.appendChild(itemRaw);
            this.items.push(new daily_report_item_1.DailyReportItem(itemRaw));
        };
        DailyReportView.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DailyReportView.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DailyReportView;
    }(component_14.Component));
    exports.DailyReportView = DailyReportView;
});
define("project/daily-report", ["require", "exports", "common/component", "common/search-field", "common/input-field", "common/system", "project/daily-report-view", "common/button"], function (require, exports, component_15, search_field_2, input_field_6, system_12, daily_report_view_1, button_10) {
    "use strict";
    var DailyReport = (function (_super) {
        __extends(DailyReport, _super);
        function DailyReport(root) {
            return _super.call(this, root) || this;
        }
        DailyReport.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.ship = new search_field_2.SearchField(document.getElementById(this.id + "-ship"));
            this.date = new input_field_6.InputField(document.getElementById(this.id + "-date"));
            this.area = this.root.getElementsByClassName('daily-report-area')[0];
            this.refresh = new button_10.Button(document.getElementById(this.id + "-refresh"), this.getView.bind(this));
        };
        DailyReport.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.ship.attachEvent(search_field_2.SearchField.GET_VALUE_EVENT, this.enableDateField.bind(this));
            this.ship.attachEvent(search_field_2.SearchField.LOSE_VALUE_EVENT, this.disableDateField.bind(this));
            this.date.attachEvent(input_field_6.InputField.VALUE_CHANGED, this.getView.bind(this));
        };
        DailyReport.prototype.getView = function () {
            var data = {};
            data['ship_id'] = this.ship.getValue();
            data['date'] = this.date.getValue();
            this.area.innerHTML = "Loading . . .";
            this.refresh.disable(true);
            $.ajax({
                url: system_12.System.getBaseUrl() + "/report/get-daily-report-view",
                data: system_12.System.addCsrf(data),
                context: this,
                dataType: "json",
                method: "post",
                success: function (data) {
                    if (data.status) {
                        this.addViewToArea(data.views);
                        this.refresh.disable(false);
                    }
                },
                error: function (data) {
                }
            });
        };
        DailyReport.prototype.addViewToArea = function (views) {
            this.area.innerHTML = "";
            if (!system_12.System.isEmptyValue(this.reportView)) {
                this.reportView.deconstruct();
            }
            var wrapper = document.createElement("div");
            wrapper.innerHTML = views;
            var reportViewRaw = wrapper.getElementsByClassName('dr-view')[0];
            this.area.appendChild(reportViewRaw);
            this.reportView = new daily_report_view_1.DailyReportView(reportViewRaw);
        };
        DailyReport.prototype.enableDateField = function () {
            this.date.enable();
            this.date.setValue("");
        };
        DailyReport.prototype.disableDateField = function () {
            this.date.disable();
            this.date.setValue("");
        };
        DailyReport.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DailyReport.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DailyReport;
    }(component_15.Component));
    exports.DailyReport = DailyReport;
});
define("project/custom-report-form", ["require", "exports", "common/form", "common/search-field", "common/input-field"], function (require, exports, form_5, search_field_3, input_field_7) {
    "use strict";
    var CustomReportForm = (function (_super) {
        __extends(CustomReportForm, _super);
        function CustomReportForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = _this.successCallback.bind(_this);
            return _this;
        }
        Object.defineProperty(CustomReportForm, "SUCCESS_EVENT", {
            get: function () { return "CUSTOM_REPORT_FORM_SUCCESS_EVENT"; },
            enumerable: true,
            configurable: true
        });
        CustomReportForm.prototype.rules = function () {
            this.registerFields([this.ship, this.from, this.to]);
            this.setRequiredField([this.ship, this.from, this.to]);
        };
        CustomReportForm.prototype.successCallback = function (data) {
            var json = {
                views: data.views
            };
            this.successEvent = new CustomEvent(CustomReportForm.SUCCESS_EVENT, { detail: json });
            this.root.dispatchEvent(this.successEvent);
        };
        CustomReportForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.ship = new search_field_3.SearchField(document.getElementById(this.id + "-ship"));
            this.from = new input_field_7.InputField(document.getElementById(this.id + "-from"));
            this.to = new input_field_7.InputField(document.getElementById(this.id + "-to"));
        };
        CustomReportForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CustomReportForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CustomReportForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CustomReportForm;
    }(form_5.Form));
    exports.CustomReportForm = CustomReportForm;
});
define("project/report-view", ["require", "exports", "common/component"], function (require, exports, component_16) {
    "use strict";
    var ReportView = (function (_super) {
        __extends(ReportView, _super);
        function ReportView(root) {
            return _super.call(this, root) || this;
        }
        ReportView.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
        };
        ReportView.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ReportView.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ReportView.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ReportView;
    }(component_16.Component));
    exports.ReportView = ReportView;
});
define("project/custom-report", ["require", "exports", "common/component", "project/custom-report-form", "project/report-view"], function (require, exports, component_17, custom_report_form_1, report_view_1) {
    "use strict";
    var CustomReport = (function (_super) {
        __extends(CustomReport, _super);
        function CustomReport(root) {
            return _super.call(this, root) || this;
        }
        CustomReport.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new custom_report_form_1.CustomReportForm(document.getElementById(this.id + "-form"));
            this.area = this.root.getElementsByClassName('custom-report-area')[0];
        };
        CustomReport.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.form.attachEvent(custom_report_form_1.CustomReportForm.SUCCESS_EVENT, this.addArea.bind(this));
        };
        CustomReport.prototype.addArea = function (e) {
            if (this.reportView) {
                this.reportView.deconstruct();
            }
            this.area.innerHTML = "";
            var json = e.detail;
            var div = document.createElement('div');
            div.innerHTML = json.views;
            var reportViewRaw = div.getElementsByClassName('report-view')[0];
            this.area.appendChild(reportViewRaw);
            this.reportView = new report_view_1.ReportView(reportViewRaw);
        };
        return CustomReport;
    }(component_17.Component));
    exports.CustomReport = CustomReport;
});
define("project/add-selling-form", ["require", "exports", "common/form", "common/input-field", "common/button"], function (require, exports, form_6, input_field_8, button_11) {
    "use strict";
    var AddSellingForm = (function (_super) {
        __extends(AddSellingForm, _super);
        function AddSellingForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = _this.successCallback.bind(_this);
            return _this;
        }
        Object.defineProperty(AddSellingForm, "ADD_SELLING_FORM_SUCCESS", {
            get: function () { return "addsellingformsuccess"; },
            enumerable: true,
            configurable: true
        });
        ;
        AddSellingForm.prototype.successCallback = function (data) {
            var json = {
                views: data.views
            };
            this.successEvent = new CustomEvent(AddSellingForm.ADD_SELLING_FORM_SUCCESS, { detail: json });
            this.root.dispatchEvent(this.successEvent);
            this.price.setValue("0");
            this.tonase.setValue("0");
            this.total.setValue("0");
        };
        AddSellingForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.ship = new input_field_8.InputField(document.getElementById(this.id + "-ship"));
            this.date = new input_field_8.InputField(document.getElementById(this.id + "-date"));
            this.remark = new input_field_8.InputField(document.getElementById(this.id + "-remark"));
            this.price = new input_field_8.InputField(document.getElementById(this.id + "-price"));
            this.tonase = new input_field_8.InputField(document.getElementById(this.id + "-tonase"));
            this.total = new input_field_8.InputField(document.getElementById(this.id + "-total"));
            this.switch = new button_11.Button(document.getElementById(this.id + "-switch"), this.clickSwitch.bind(this));
            this.totalField = document.getElementById(this.id + "total-el");
            this.priceField = document.getElementById(this.id + "price-el");
            this.tonaseField = document.getElementById(this.id + "tonase-el");
        };
        AddSellingForm.prototype.clickSwitch = function (e) {
            e.preventDefault();
            if (this.totalField.classList.contains('app-hide')) {
                this.totalField.classList.remove('app-hide');
                this.priceField.classList.add('app-hide');
                this.tonaseField.classList.add('app-hide');
            }
            else {
                this.totalField.classList.add('app-hide');
                this.priceField.classList.remove('app-hide');
                this.tonaseField.classList.remove('app-hide');
            }
            this.total.setValue("0");
            this.price.setValue("0");
            this.tonase.setValue("0");
        };
        AddSellingForm.prototype.rules = function () {
            this.setRequiredField([this.total, this.price, this.tonase, this.remark, this.date, this.ship]);
            this.registerFields([this.total, this.price, this.tonase, this.date, this.ship, this.remark]);
            var validation = {
                errorMessage: "Total price atau (harga dan tonase) harus diisi",
                validate: this.validateFields.bind(this),
                targetField: this.total
            };
            var validation1 = {
                errorMessage: "Total price atau (harga dan tonase) harus diisi",
                validate: this.validateFields.bind(this),
                targetField: this.tonase
            };
            this.setValidations([validation, validation1]);
        };
        AddSellingForm.prototype.validateFields = function () {
            if (parseFloat(this.total.getValue()) <= 0.00000001) {
                if (parseFloat(this.tonase.getValue()) <= 0.0000001 ||
                    parseFloat(this.price.getValue()) <= 0.000001) {
                    return false;
                }
            }
            return true;
        };
        AddSellingForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddSellingForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddSellingForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddSellingForm;
    }(form_6.Form));
    exports.AddSellingForm = AddSellingForm;
});
define("project/daily-selling-item", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_18, button_12, system_13) {
    "use strict";
    var DailySellingItem = (function (_super) {
        __extends(DailySellingItem, _super);
        function DailySellingItem(root) {
            var _this = _super.call(this, root) || this;
            _this.sellingId = _this.root.getAttribute('data-selling-id');
            return _this;
        }
        DailySellingItem.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.viewArea = document.getElementById(this.id + "-view");
            this.removeArea = document.getElementById(this.id + "-remove-area");
            this.removeBtn = new button_12.Button(document.getElementById(this.id + "-remove-btn"), this.removeItem.bind(this));
            this.cancelRemove = new button_12.Button(document.getElementById(this.id + "-cancel"), this.cancelRemoveItem.bind(this));
        };
        DailySellingItem.prototype.removeItem = function () {
            this.removeBtn.disable(true);
            var data = {};
            data['selling_id'] = this.sellingId;
            $.ajax({
                url: system_13.System.getBaseUrl() + "/selling/remove",
                data: system_13.System.addCsrf(data),
                dataType: "json",
                method: "post",
                context: this,
                success: function (data) {
                    this.removeBtn.disable(false);
                    this.viewArea.classList.add('app-hide');
                    this.removeArea.classList.remove('app-hide');
                },
                error: function (data) {
                    this.removeBtn.disable(false);
                }
            });
        };
        DailySellingItem.prototype.cancelRemoveItem = function () {
            this.cancelRemove.disable(true);
            var data = {};
            data['selling_id'] = this.sellingId;
            $.ajax({
                url: system_13.System.getBaseUrl() + "/selling/cancel-remove",
                data: system_13.System.addCsrf(data),
                dataType: "json",
                method: "post",
                context: this,
                success: function (data) {
                    this.cancelRemove.disable(false);
                    this.viewArea.classList.remove('app-hide');
                    this.removeArea.classList.add('app-hide');
                },
                error: function (data) {
                    this.removeBtn.disable(false);
                }
            });
        };
        return DailySellingItem;
    }(component_18.Component));
    exports.DailySellingItem = DailySellingItem;
});
define("project/daily-selling-view", ["require", "exports", "common/component", "project/add-selling-form", "project/daily-selling-item"], function (require, exports, component_19, add_selling_form_1, daily_selling_item_1) {
    "use strict";
    var DailySellingView = (function (_super) {
        __extends(DailySellingView, _super);
        function DailySellingView(root) {
            return _super.call(this, root) || this;
        }
        DailySellingView.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.asForm = new add_selling_form_1.AddSellingForm(document.getElementById(this.id + "-asform"));
            this.area = this.root.getElementsByClassName('ds-view-area')[0];
            this.items = [];
            var itemsRaw = this.root.getElementsByClassName('ds-item');
            for (var i = 0; i < itemsRaw.length; i++) {
                this.items.push(new daily_selling_item_1.DailySellingItem(itemsRaw.item(i)));
            }
        };
        DailySellingView.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.asForm.attachEvent(add_selling_form_1.AddSellingForm.ADD_SELLING_FORM_SUCCESS, this.addNewDailyItem.bind(this));
        };
        DailySellingView.prototype.addNewDailyItem = function (e) {
            var json = e.detail;
            var areaRaws = json.views;
            var div = document.createElement('div');
            div.innerHTML = areaRaws;
            var itemRaw = div.getElementsByClassName('ds-item')[0];
            this.area.appendChild(itemRaw);
            this.items.push(new daily_selling_item_1.DailySellingItem(itemRaw));
        };
        DailySellingView.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DailySellingView.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DailySellingView;
    }(component_19.Component));
    exports.DailySellingView = DailySellingView;
});
define("project/daily-selling", ["require", "exports", "common/component", "common/search-field", "common/input-field", "common/system", "project/daily-selling-view", "common/button"], function (require, exports, component_20, search_field_4, input_field_9, system_14, daily_selling_view_1, button_13) {
    "use strict";
    var DailySelling = (function (_super) {
        __extends(DailySelling, _super);
        function DailySelling(root) {
            return _super.call(this, root) || this;
        }
        DailySelling.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.ship = new search_field_4.SearchField(document.getElementById(this.id + "-ship"));
            this.date = new input_field_9.InputField(document.getElementById(this.id + "-date"));
            this.area = this.root.getElementsByClassName('daily-selling-area')[0];
            this.refresh = new button_13.Button(document.getElementById(this.id + "-refresh"), this.getView.bind(this));
        };
        DailySelling.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.ship.attachEvent(search_field_4.SearchField.GET_VALUE_EVENT, this.enableDateField.bind(this));
            this.ship.attachEvent(search_field_4.SearchField.LOSE_VALUE_EVENT, this.disableDateField.bind(this));
            this.date.attachEvent(input_field_9.InputField.VALUE_CHANGED, this.getView.bind(this));
        };
        DailySelling.prototype.getView = function () {
            var data = {};
            data['ship_id'] = this.ship.getValue();
            data['date'] = this.date.getValue();
            this.area.innerHTML = "Loading . . .";
            this.refresh.disable(true);
            $.ajax({
                url: system_14.System.getBaseUrl() + "/selling/get-daily-selling-view",
                data: system_14.System.addCsrf(data),
                context: this,
                dataType: "json",
                method: "post",
                success: function (data) {
                    if (data.status) {
                        this.addViewToArea(data.views);
                        this.refresh.disable(false);
                    }
                },
                error: function (data) {
                }
            });
        };
        DailySelling.prototype.addViewToArea = function (views) {
            this.area.innerHTML = "";
            if (!system_14.System.isEmptyValue(this.sellingView)) {
                this.sellingView.deconstruct();
            }
            var wrapper = document.createElement("div");
            wrapper.innerHTML = views;
            var sellingViewRaw = wrapper.getElementsByClassName('ds-view')[0];
            this.area.appendChild(sellingViewRaw);
            this.sellingView = new daily_selling_view_1.DailySellingView(sellingViewRaw);
        };
        DailySelling.prototype.enableDateField = function () {
            this.date.enable();
            this.date.setValue("");
        };
        DailySelling.prototype.disableDateField = function () {
            this.date.disable();
            this.date.setValue("");
        };
        DailySelling.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DailySelling.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DailySelling;
    }(component_20.Component));
    exports.DailySelling = DailySelling;
});
define("project/custom-selling-form", ["require", "exports", "common/form", "common/search-field", "common/input-field"], function (require, exports, form_7, search_field_5, input_field_10) {
    "use strict";
    var CustomSellingForm = (function (_super) {
        __extends(CustomSellingForm, _super);
        function CustomSellingForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = _this.successCallback.bind(_this);
            return _this;
        }
        Object.defineProperty(CustomSellingForm, "SUCCESS_EVENT", {
            get: function () { return "CUSTOM_SELLING_FORM_SUCCESS_EVENT"; },
            enumerable: true,
            configurable: true
        });
        CustomSellingForm.prototype.rules = function () {
            this.registerFields([this.ship, this.from, this.to]);
            this.setRequiredField([this.ship, this.from, this.to]);
        };
        CustomSellingForm.prototype.successCallback = function (data) {
            var json = {
                views: data.views
            };
            this.successEvent = new CustomEvent(CustomSellingForm.SUCCESS_EVENT, { detail: json });
            this.root.dispatchEvent(this.successEvent);
        };
        CustomSellingForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.ship = new search_field_5.SearchField(document.getElementById(this.id + "-ship"));
            this.from = new input_field_10.InputField(document.getElementById(this.id + "-from"));
            this.to = new input_field_10.InputField(document.getElementById(this.id + "-to"));
        };
        CustomSellingForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CustomSellingForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CustomSellingForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CustomSellingForm;
    }(form_7.Form));
    exports.CustomSellingForm = CustomSellingForm;
});
define("project/selling-view", ["require", "exports", "common/component"], function (require, exports, component_21) {
    "use strict";
    var SellingView = (function (_super) {
        __extends(SellingView, _super);
        function SellingView(root) {
            return _super.call(this, root) || this;
        }
        SellingView.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
        };
        SellingView.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        SellingView.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        SellingView.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return SellingView;
    }(component_21.Component));
    exports.SellingView = SellingView;
});
define("project/custom-selling", ["require", "exports", "common/component", "project/custom-selling-form", "project/selling-view"], function (require, exports, component_22, custom_selling_form_1, selling_view_1) {
    "use strict";
    var CustomSelling = (function (_super) {
        __extends(CustomSelling, _super);
        function CustomSelling(root) {
            return _super.call(this, root) || this;
        }
        CustomSelling.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new custom_selling_form_1.CustomSellingForm(document.getElementById(this.id + "-form"));
            this.area = this.root.getElementsByClassName('custom-selling-area')[0];
        };
        CustomSelling.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.form.attachEvent(custom_selling_form_1.CustomSellingForm.SUCCESS_EVENT, this.addArea.bind(this));
        };
        CustomSelling.prototype.addArea = function (e) {
            if (this.sellingView) {
                this.sellingView.deconstruct();
            }
            this.area.innerHTML = "";
            var json = e.detail;
            var div = document.createElement('div');
            div.innerHTML = json.views;
            var sellingViewRaw = div.getElementsByClassName('selling-view')[0];
            this.area.appendChild(sellingViewRaw);
            this.sellingView = new selling_view_1.SellingView(sellingViewRaw);
        };
        return CustomSelling;
    }(component_22.Component));
    exports.CustomSelling = CustomSelling;
});
define("project/list-code", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_23, button_14, system_15) {
    "use strict";
    var ListCode = (function (_super) {
        __extends(ListCode, _super);
        function ListCode(root) {
            return _super.call(this, root) || this;
        }
        ListCode.prototype.redirectToAdd = function () {
            window.location.href = system_15.System.getBaseUrl() + "/code/create";
        };
        ListCode.prototype.redirectToCodeType = function () {
            window.location.href = system_15.System.getBaseUrl() + "/code/type";
        };
        ListCode.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addBtn = new button_14.Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
            this.codeType = new button_14.Button(document.getElementById(this.id + "-codetype"), this.redirectToCodeType.bind(this));
            this.addRelations = [];
            var relationRaws = this.root.getElementsByClassName('list-code-add');
            for (var i = 0; i < relationRaws.length; i++) {
                this.addRelations.push(new button_14.Button(relationRaws.item(i), this.redirectToAddRelation.bind(this, relationRaws.item(i))));
            }
            this.redirectEditBtns = [];
            var redirectEditBtnsRaw = this.root.getElementsByClassName('list-code-edit');
            for (var i = 0; i < redirectEditBtnsRaw.length; i++) {
                this.redirectEditBtns.push(new button_14.Button(redirectEditBtnsRaw.item(i), this.redirectToEdit.bind(this, redirectEditBtnsRaw.item(i))));
            }
            this.removeBtns = [];
            var removeBtnsRaw = this.root.getElementsByClassName('list-code-remove');
            for (var i = 0; i < removeBtnsRaw.length; i++) {
                this.removeBtns.push(new button_14.Button(removeBtnsRaw.item(i), this.showRemoveDialog.bind(this, removeBtnsRaw.item(i))));
            }
        };
        ListCode.prototype.showRemoveDialog = function (raw) {
            system_15.System.showConfirmDialog(this.removeCode.bind(null, raw), "Are you sure", "Once it is deleted, you will lose the code");
        };
        ListCode.prototype.removeCode = function (raw) {
            var entity_id = raw.getAttribute('data-entity-id');
            var data = {};
            data['entity_id'] = entity_id;
            $.ajax({
                url: system_15.System.getBaseUrl() + "/code/remove",
                data: system_15.System.addCsrf(data),
                context: this,
                dataType: "json",
                method: "post",
                success: function (data) {
                    if (data.status) {
                        window.location.reload();
                    }
                },
                error: function (data) {
                }
            });
        };
        ListCode.prototype.redirectToEdit = function (raw) {
            window.location.href = system_15.System.getBaseUrl() + "/code/edit?id=" + raw.getAttribute('data-entity-id');
        };
        ListCode.prototype.redirectToAddRelation = function (raw) {
            window.location.href = system_15.System.getBaseUrl() + "/code/add-relation?id=" + raw.getAttribute('data-entity-id');
        };
        ListCode.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ListCode.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ListCode.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ListCode;
    }(component_23.Component));
    exports.ListCode = ListCode;
});
define("project/list-code-type", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_24, button_15, system_16) {
    "use strict";
    var ListCodeType = (function (_super) {
        __extends(ListCodeType, _super);
        function ListCodeType(root) {
            return _super.call(this, root) || this;
        }
        ListCodeType.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addBtn = new button_15.Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
            this.redirectEditBtns = [];
            var redirectEditBtnsRaw = this.root.getElementsByClassName('list-code-type-edit');
            for (var i = 0; i < redirectEditBtnsRaw.length; i++) {
                this.redirectEditBtns.push(new button_15.Button(redirectEditBtnsRaw.item(i), this.redirectToEdit.bind(this, redirectEditBtnsRaw.item(i))));
            }
            this.removeBtns = [];
            var removeBtnsRaw = this.root.getElementsByClassName('list-code-type-remove');
            for (var i = 0; i < removeBtnsRaw.length; i++) {
                this.removeBtns.push(new button_15.Button(removeBtnsRaw.item(i), this.showRemoveDialog.bind(this, removeBtnsRaw.item(i))));
            }
        };
        ListCodeType.prototype.redirectToAdd = function () {
            window.location.href = system_16.System.getBaseUrl() + "/code/create-type";
        };
        ListCodeType.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ListCodeType.prototype.showRemoveDialog = function (raw) {
            system_16.System.showConfirmDialog(this.removeCode.bind(null, raw), "Are you sure", "Once it is deleted, you will have to ask the developer to retrieve it");
        };
        ListCodeType.prototype.removeCode = function (raw) {
            var entity_id = raw.getAttribute('data-entity-type-id');
            var data = {};
            data['entity_type_id'] = entity_id;
            $.ajax({
                url: system_16.System.getBaseUrl() + "/code/remove-type",
                data: system_16.System.addCsrf(data),
                context: this,
                dataType: "json",
                method: "post",
                success: function (data) {
                    if (data.status) {
                        window.location.reload();
                    }
                },
                error: function (data) {
                }
            });
        };
        ListCodeType.prototype.redirectToEdit = function (raw) {
            window.location.href = system_16.System.getBaseUrl() + "/code/edit-type?id=" + raw.getAttribute('data-entity-type-id');
        };
        ListCodeType.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ListCodeType.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ListCodeType;
    }(component_24.Component));
    exports.ListCodeType = ListCodeType;
});
define("project/create-code-type-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/system"], function (require, exports, form_8, input_field_11, text_area_field_3, system_17) {
    "use strict";
    var CreateCodeTypeForm = (function (_super) {
        __extends(CreateCodeTypeForm, _super);
        function CreateCodeTypeForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_17.System.getBaseUrl() + "/code/type";
            };
            return _this;
        }
        CreateCodeTypeForm.prototype.rules = function () {
            this.setRequiredField([this.nameField]);
            this.registerFields([this.nameField, this.descField]);
        };
        CreateCodeTypeForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.nameField = new input_field_11.InputField(document.getElementById(this.id + "-name"));
            this.descField = new text_area_field_3.TextAreaField(document.getElementById(this.id + "-desc"));
        };
        CreateCodeTypeForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateCodeTypeForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateCodeTypeForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateCodeTypeForm;
    }(form_8.Form));
    exports.CreateCodeTypeForm = CreateCodeTypeForm;
});
define("project/create-code-type", ["require", "exports", "common/component", "project/create-code-type-form"], function (require, exports, component_25, create_code_type_form_1) {
    "use strict";
    var CreateCodeType = (function (_super) {
        __extends(CreateCodeType, _super);
        function CreateCodeType(root) {
            return _super.call(this, root) || this;
        }
        CreateCodeType.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_code_type_form_1.CreateCodeTypeForm(document.getElementById(this.id + "-form"));
        };
        CreateCodeType.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateCodeType.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateCodeType.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateCodeType;
    }(component_25.Component));
    exports.CreateCodeType = CreateCodeType;
});
define("project/create-code-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/search-field", "common/system"], function (require, exports, form_9, input_field_12, text_area_field_4, search_field_6, system_18) {
    "use strict";
    var CreateCodeForm = (function (_super) {
        __extends(CreateCodeForm, _super);
        function CreateCodeForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_18.System.getBaseUrl() + "/code/index";
            };
            return _this;
        }
        CreateCodeForm.prototype.rules = function () {
            this.setRequiredField([this.nameField, this.typeIdField, this.codeField]);
            this.registerFields([this.nameField, this.descField, this.typeIdField, this.codeField]);
        };
        CreateCodeForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.codeField = new input_field_12.InputField(document.getElementById(this.id + "-code"));
            this.typeIdField = new search_field_6.SearchField(document.getElementById(this.id + "-type-id"));
            this.nameField = new input_field_12.InputField(document.getElementById(this.id + "-name"));
            this.descField = new text_area_field_4.TextAreaField(document.getElementById(this.id + "-desc"));
        };
        CreateCodeForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateCodeForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateCodeForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateCodeForm;
    }(form_9.Form));
    exports.CreateCodeForm = CreateCodeForm;
});
define("project/create-code", ["require", "exports", "common/component", "project/create-code-form"], function (require, exports, component_26, create_code_form_1) {
    "use strict";
    var CreateCode = (function (_super) {
        __extends(CreateCode, _super);
        function CreateCode(root) {
            return _super.call(this, root) || this;
        }
        CreateCode.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_code_form_1.CreateCodeForm(document.getElementById(this.id + "-form"));
        };
        CreateCode.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateCode.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateCode.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateCode;
    }(component_26.Component));
    exports.CreateCode = CreateCode;
});
define("project/add-transaction-form", ["require", "exports", "common/form", "common/input-field", "common/search-field"], function (require, exports, form_10, input_field_13, search_field_7) {
    "use strict";
    var AddTransactionForm = (function (_super) {
        __extends(AddTransactionForm, _super);
        function AddTransactionForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = _this.successCallback.bind(_this);
            return _this;
        }
        Object.defineProperty(AddTransactionForm, "ADD_TRANSACTION_FORM_SUCCESS", {
            get: function () { return "addtransactionformsuccess"; },
            enumerable: true,
            configurable: true
        });
        ;
        AddTransactionForm.prototype.rules = function () {
            this.registerFields([this.debetField, this.remarkField,
                this.codeField, this.date, this.creditField]);
            this.setRequiredField([this.debetField, this.codeField,
                this.date,
                this.remarkField, this.creditField]);
        };
        AddTransactionForm.prototype.successCallback = function (data) {
            var json = {
                views: data.views
            };
            this.successEvent = new CustomEvent(AddTransactionForm.ADD_TRANSACTION_FORM_SUCCESS, { detail: json });
            this.root.dispatchEvent(this.successEvent);
            this.debetField.setValue("0");
            this.remarkField.setValue("");
            this.creditField.setValue("0");
        };
        AddTransactionForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.date = new input_field_13.InputField(document.getElementById(this.id + "-date"));
            this.debetField = new input_field_13.InputField(document.getElementById(this.id + "-debet"));
            this.remarkField = new input_field_13.InputField(document.getElementById(this.id + "-remark"));
            this.creditField = new input_field_13.InputField(document.getElementById(this.id + "-credit"));
            this.codeField = new search_field_7.SearchField(document.getElementById(this.id + "-code"));
        };
        AddTransactionForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddTransactionForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddTransactionForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddTransactionForm;
    }(form_10.Form));
    exports.AddTransactionForm = AddTransactionForm;
});
define("project/daily-transaction-item", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_27, button_16, system_19) {
    "use strict";
    var DailyTransactionItem = (function (_super) {
        __extends(DailyTransactionItem, _super);
        function DailyTransactionItem(root) {
            var _this = _super.call(this, root) || this;
            _this.transactionId = _this.root.getAttribute('data-transaction-id');
            return _this;
        }
        DailyTransactionItem.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.viewArea = document.getElementById(this.id + "-view");
            this.removeArea = document.getElementById(this.id + "-remove-area");
            this.removeBtn = new button_16.Button(document.getElementById(this.id + "-remove-btn"), this.removeItem.bind(this));
            this.cancelRemove = new button_16.Button(document.getElementById(this.id + "-cancel"), this.cancelRemoveItem.bind(this));
        };
        DailyTransactionItem.prototype.removeItem = function () {
            this.removeBtn.disable(true);
            var data = {};
            data['transaction_id'] = this.transactionId;
            $.ajax({
                url: system_19.System.getBaseUrl() + "/transaction/remove",
                data: system_19.System.addCsrf(data),
                dataType: "json",
                method: "post",
                context: this,
                success: function (data) {
                    this.removeBtn.disable(false);
                    this.viewArea.classList.add('app-hide');
                    this.removeArea.classList.remove('app-hide');
                },
                error: function (data) {
                    this.removeBtn.disable(false);
                }
            });
        };
        DailyTransactionItem.prototype.cancelRemoveItem = function () {
            this.cancelRemove.disable(true);
            var data = {};
            data['transaction_id'] = this.transactionId;
            $.ajax({
                url: system_19.System.getBaseUrl() + "/transaction/cancel-remove",
                data: system_19.System.addCsrf(data),
                dataType: "json",
                method: "post",
                context: this,
                success: function (data) {
                    this.cancelRemove.disable(false);
                    this.viewArea.classList.remove('app-hide');
                    this.removeArea.classList.add('app-hide');
                },
                error: function (data) {
                    this.removeBtn.disable(false);
                }
            });
        };
        DailyTransactionItem.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        DailyTransactionItem.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DailyTransactionItem.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DailyTransactionItem;
    }(component_27.Component));
    exports.DailyTransactionItem = DailyTransactionItem;
});
define("project/daily-transaction-view", ["require", "exports", "common/component", "project/add-transaction-form", "project/daily-transaction-item"], function (require, exports, component_28, add_transaction_form_1, daily_transaction_item_1) {
    "use strict";
    var DailyTransactionView = (function (_super) {
        __extends(DailyTransactionView, _super);
        function DailyTransactionView(root) {
            return _super.call(this, root) || this;
        }
        DailyTransactionView.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.atForm = new add_transaction_form_1.AddTransactionForm(document.getElementById(this.id + "-atform"));
            this.area = this.root.getElementsByClassName('dt-view-area')[0];
            this.items = [];
            var itemsRaw = this.root.getElementsByClassName('dt-item');
            for (var i = 0; i < itemsRaw.length; i++) {
                this.items.push(new daily_transaction_item_1.DailyTransactionItem(itemsRaw.item(i)));
            }
        };
        DailyTransactionView.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.atForm.attachEvent(add_transaction_form_1.AddTransactionForm.ADD_TRANSACTION_FORM_SUCCESS, this.addNewDailyItem.bind(this));
        };
        DailyTransactionView.prototype.addNewDailyItem = function (e) {
            var json = e.detail;
            var areaRaws = json.views;
            var div = document.createElement('div');
            div.innerHTML = areaRaws;
            var itemRaw = div.getElementsByClassName('dt-item')[0];
            this.area.appendChild(itemRaw);
            this.items.push(new daily_transaction_item_1.DailyTransactionItem(itemRaw));
        };
        DailyTransactionView.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DailyTransactionView.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DailyTransactionView;
    }(component_28.Component));
    exports.DailyTransactionView = DailyTransactionView;
});
define("project/daily-transaction", ["require", "exports", "common/component", "common/input-field", "common/system", "project/daily-transaction-view", "common/button"], function (require, exports, component_29, input_field_14, system_20, daily_transaction_view_1, button_17) {
    "use strict";
    var DailyTransaction = (function (_super) {
        __extends(DailyTransaction, _super);
        function DailyTransaction(root) {
            return _super.call(this, root) || this;
        }
        DailyTransaction.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.date = new input_field_14.InputField(document.getElementById(this.id + "-date"));
            this.area = this.root.getElementsByClassName('daily-transact-area')[0];
            this.refresh = new button_17.Button(document.getElementById(this.id + "-refresh"), this.getView.bind(this));
        };
        DailyTransaction.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.date.attachEvent(input_field_14.InputField.VALUE_CHANGED, this.getView.bind(this));
        };
        DailyTransaction.prototype.getView = function () {
            var data = {};
            data['date'] = this.date.getValue();
            this.area.innerHTML = "Loading . . .";
            this.refresh.disable(true);
            $.ajax({
                url: system_20.System.getBaseUrl() + "/transaction/get-daily-view",
                data: system_20.System.addCsrf(data),
                context: this,
                dataType: "json",
                method: "post",
                success: function (data) {
                    if (data.status) {
                        this.addViewToArea(data.views);
                        this.refresh.disable(false);
                    }
                },
                error: function (data) {
                }
            });
        };
        DailyTransaction.prototype.addViewToArea = function (views) {
            this.area.innerHTML = "";
            if (!system_20.System.isEmptyValue(this.transactView)) {
                this.transactView.deconstruct();
            }
            var wrapper = document.createElement("div");
            wrapper.innerHTML = views;
            var transactViewRaw = wrapper.getElementsByClassName('dt-view')[0];
            this.area.appendChild(transactViewRaw);
            this.transactView = new daily_transaction_view_1.DailyTransactionView(transactViewRaw);
        };
        DailyTransaction.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DailyTransaction.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DailyTransaction;
    }(component_29.Component));
    exports.DailyTransaction = DailyTransaction;
});
define("project/custom-transaction-form", ["require", "exports", "common/form", "common/search-field", "common/input-field"], function (require, exports, form_11, search_field_8, input_field_15) {
    "use strict";
    var CustomTransactionForm = (function (_super) {
        __extends(CustomTransactionForm, _super);
        function CustomTransactionForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = _this.successCallback.bind(_this);
            return _this;
        }
        Object.defineProperty(CustomTransactionForm, "SUCCESS_EVENT", {
            get: function () { return "CUSTOM_TRANSACTION_FORM_SUCCESS_EVENT"; },
            enumerable: true,
            configurable: true
        });
        CustomTransactionForm.prototype.rules = function () {
            this.registerFields([this.code, this.from, this.to]);
            this.setRequiredField([this.code, this.from, this.to]);
        };
        CustomTransactionForm.prototype.successCallback = function (data) {
            var json = {
                views: data.views
            };
            this.successEvent = new CustomEvent(CustomTransactionForm.SUCCESS_EVENT, { detail: json });
            this.root.dispatchEvent(this.successEvent);
        };
        CustomTransactionForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.code = new search_field_8.SearchField(document.getElementById(this.id + "-code"));
            this.from = new input_field_15.InputField(document.getElementById(this.id + "-from"));
            this.to = new input_field_15.InputField(document.getElementById(this.id + "-to"));
        };
        CustomTransactionForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CustomTransactionForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CustomTransactionForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CustomTransactionForm;
    }(form_11.Form));
    exports.CustomTransactionForm = CustomTransactionForm;
});
define("project/transaction-view", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_30, button_18, system_21) {
    "use strict";
    var TransactionView = (function (_super) {
        __extends(TransactionView, _super);
        function TransactionView(root) {
            return _super.call(this, root) || this;
        }
        TransactionView.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.printBtn = new button_18.Button(document.getElementById(this.id + "-printer"), this.print.bind(this));
            this.area = this.root.getElementsByClassName('transaction-view-area')[0];
        };
        TransactionView.prototype.print = function (e) {
            system_21.System.printToPrinter(this.area.innerHTML);
        };
        TransactionView.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        TransactionView.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        TransactionView.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return TransactionView;
    }(component_30.Component));
    exports.TransactionView = TransactionView;
});
define("project/custom-transaction", ["require", "exports", "common/component", "project/custom-transaction-form", "project/transaction-view"], function (require, exports, component_31, custom_transaction_form_1, transaction_view_1) {
    "use strict";
    var CustomTransaction = (function (_super) {
        __extends(CustomTransaction, _super);
        function CustomTransaction(root) {
            return _super.call(this, root) || this;
        }
        CustomTransaction.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new custom_transaction_form_1.CustomTransactionForm(document.getElementById(this.id + "-form"));
            this.area = this.root.getElementsByClassName('custom-transaction-area')[0];
        };
        CustomTransaction.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.form.attachEvent(custom_transaction_form_1.CustomTransactionForm.SUCCESS_EVENT, this.addArea.bind(this));
        };
        CustomTransaction.prototype.addArea = function (e) {
            if (this.transactionView) {
                this.transactionView.deconstruct();
            }
            this.area.innerHTML = "";
            var json = e.detail;
            var div = document.createElement('div');
            div.innerHTML = json.views;
            var transactionViewRaw = div.getElementsByClassName('transaction-view')[0];
            this.area.appendChild(transactionViewRaw);
            this.transactionView = new transaction_view_1.TransactionView(transactionViewRaw);
        };
        return CustomTransaction;
    }(component_31.Component));
    exports.CustomTransaction = CustomTransaction;
});
define("common/equal-validation", ["require", "exports", "common/validation"], function (require, exports, validation_2) {
    "use strict";
    var EqualValidation = (function (_super) {
        __extends(EqualValidation, _super);
        function EqualValidation(targetField, sourceField) {
            var _this = _super.call(this) || this;
            _this.targetField = targetField;
            _this.sourceField = sourceField;
            _this.errorMessage = _this.sourceField.getDisplayName() + " and this field must be the same";
            _this.validate = _this.validateEquality.bind(_this);
            return _this;
        }
        EqualValidation.prototype.validateEquality = function () {
            return this.sourceField.getValue() === this.targetField.getValue();
        };
        return EqualValidation;
    }(validation_2.Validation));
    exports.EqualValidation = EqualValidation;
});
define("project/change-password-form", ["require", "exports", "common/form", "common/input-field", "common/equal-validation"], function (require, exports, form_12, input_field_16, equal_validation_1) {
    "use strict";
    var ChangePasswordForm = (function (_super) {
        __extends(ChangePasswordForm, _super);
        function ChangePasswordForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function () {
                window.location.reload();
            };
            return _this;
        }
        ChangePasswordForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.curPasswordField = new input_field_16.InputField(document.getElementById(this.id + "-cur-password-field"));
            this.newPasswordField = new input_field_16.InputField(document.getElementById(this.id + "-new-password-field"));
            this.confPasswordField = new input_field_16.InputField(document.getElementById(this.id + "-conf-password-field"));
        };
        ChangePasswordForm.prototype.rules = function () {
            this.registerFields([this.curPasswordField, this.newPasswordField, this.confPasswordField]);
            this.setRequiredField([this.curPasswordField, this.newPasswordField, this.confPasswordField]);
            this.setValidations([new equal_validation_1.EqualValidation(this.newPasswordField, this.confPasswordField)]);
        };
        ChangePasswordForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ChangePasswordForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ChangePasswordForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ChangePasswordForm;
    }(form_12.Form));
    exports.ChangePasswordForm = ChangePasswordForm;
});
define("project/change-password", ["require", "exports", "common/component", "project/change-password-form"], function (require, exports, component_32, change_password_form_1) {
    "use strict";
    var ChangePassword = (function (_super) {
        __extends(ChangePassword, _super);
        function ChangePassword(root) {
            return _super.call(this, root) || this;
        }
        ChangePassword.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new change_password_form_1.ChangePasswordForm(document.getElementById(this.id + "-form"));
        };
        ChangePassword.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ChangePassword.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ChangePassword.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ChangePassword;
    }(component_32.Component));
    exports.ChangePassword = ChangePassword;
});
define("project/assign-code-to-ship", ["require", "exports", "common/component"], function (require, exports, component_33) {
    "use strict";
    var AssignCodeToShip = (function (_super) {
        __extends(AssignCodeToShip, _super);
        function AssignCodeToShip(root) {
            return _super.call(this, root) || this;
        }
        AssignCodeToShip.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
        };
        AssignCodeToShip.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AssignCodeToShip.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AssignCodeToShip.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AssignCodeToShip;
    }(component_33.Component));
    exports.AssignCodeToShip = AssignCodeToShip;
});
define("project/edit-ship-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/system"], function (require, exports, form_13, input_field_17, text_area_field_5, system_22) {
    "use strict";
    var EditShipForm = (function (_super) {
        __extends(EditShipForm, _super);
        function EditShipForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_22.System.getBaseUrl() + "/ship/index";
            }.bind(_this);
            return _this;
        }
        EditShipForm.prototype.rules = function () {
            this.setRequiredField([this.nameField, this.idField, this.codeField]);
            this.registerFields([this.nameField, this.descField, this.idField, this.codeField]);
        };
        EditShipForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.nameField = new input_field_17.InputField(document.getElementById(this.id + "-name"));
            this.descField = new text_area_field_5.TextAreaField(document.getElementById(this.id + "-desc"));
            this.idField = new input_field_17.InputField(document.getElementById(this.id + "-id"));
            this.codeField = new input_field_17.InputField(document.getElementById(this.id + "-code"));
        };
        EditShipForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        EditShipForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        EditShipForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return EditShipForm;
    }(form_13.Form));
    exports.EditShipForm = EditShipForm;
});
define("project/edit-ship", ["require", "exports", "common/component", "project/edit-ship-form"], function (require, exports, component_34, edit_ship_form_1) {
    "use strict";
    var EditShip = (function (_super) {
        __extends(EditShip, _super);
        function EditShip(root) {
            return _super.call(this, root) || this;
        }
        EditShip.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new edit_ship_form_1.EditShipForm(document.getElementById(this.id + "-form"));
        };
        EditShip.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        EditShip.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        EditShip.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return EditShip;
    }(component_34.Component));
    exports.EditShip = EditShip;
});
define("project/add-entity-relation-form", ["require", "exports", "common/form", "common/input-field", "common/search-field"], function (require, exports, form_14, input_field_18, search_field_9) {
    "use strict";
    var AddEntityRelationForm = (function (_super) {
        __extends(AddEntityRelationForm, _super);
        function AddEntityRelationForm(root) {
            var _this = _super.call(this, root) || this;
            _this.subcode.disableItem(_this.codeField.getValue());
            _this.successCb = function (data) {
                window.location.reload();
            };
            return _this;
        }
        AddEntityRelationForm.prototype.rules = function () {
            this.registerFields([this.codeField, this.subcode]);
            this.setRequiredField([this.codeField, this.subcode]);
        };
        AddEntityRelationForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.codeField = new input_field_18.InputField(document.getElementById(this.id + "-code"));
            this.subcode = new search_field_9.SearchField(document.getElementById(this.id + "-subcode"));
        };
        AddEntityRelationForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddEntityRelationForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddEntityRelationForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddEntityRelationForm;
    }(form_14.Form));
    exports.AddEntityRelationForm = AddEntityRelationForm;
});
define("project/add-entity-relation-range-form", ["require", "exports", "common/form", "common/input-field", "common/range-validation"], function (require, exports, form_15, input_field_19, range_validation_1) {
    "use strict";
    var AddEntityRelationRangeForm = (function (_super) {
        __extends(AddEntityRelationRangeForm, _super);
        function AddEntityRelationRangeForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.reload();
            };
            return _this;
        }
        AddEntityRelationRangeForm.prototype.rules = function () {
            this.setRequiredField([this.fromField, this.toField, this.code]);
            this.registerFields([this.fromField, this.toField, this.code]);
            var validation1 = new range_validation_1.RangeValidation(this.fromField, 1, null);
            var validation2 = new range_validation_1.RangeValidation(this.toField, 1, null);
            this.setRangeValidations([validation1, validation2]);
            var validation = {
                "errorMessage": "Field 'Dari' harus tidak lebih besar dari Field 'Sampai' ",
                "targetField": this.toField,
                "validate": function () {
                    return this.fromField.getValue() < this.toField.getValue();
                }.bind(this)
            };
            this.setValidations([validation]);
        };
        AddEntityRelationRangeForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.fromField = new input_field_19.InputField(document.getElementById(this.id + "-from"));
            this.toField = new input_field_19.InputField(document.getElementById(this.id + "-to"));
            this.code = new input_field_19.InputField(document.getElementById(this.id + "-code"));
        };
        AddEntityRelationRangeForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddEntityRelationRangeForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddEntityRelationRangeForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddEntityRelationRangeForm;
    }(form_15.Form));
    exports.AddEntityRelationRangeForm = AddEntityRelationRangeForm;
});
define("project/add-entity-relation", ["require", "exports", "common/component", "project/add-entity-relation-form", "project/add-entity-relation-range-form", "common/button", "common/system"], function (require, exports, component_35, add_entity_relation_form_1, add_entity_relation_range_form_1, button_19, system_23) {
    "use strict";
    var AddEntityRelation = (function (_super) {
        __extends(AddEntityRelation, _super);
        function AddEntityRelation(root) {
            var _this = _super.call(this, root) || this;
            _this.codeId = _this.root.getAttribute('data-code-id');
            return _this;
        }
        AddEntityRelation.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.aerForm = new add_entity_relation_form_1.AddEntityRelationForm(document.getElementById(this.id + "-form"));
            this.aerRangeForm = new add_entity_relation_range_form_1.AddEntityRelationRangeForm(document.getElementById(this.id + "-rform"));
            var removeRelationsRaw = this.root.getElementsByClassName('aer-remove');
            this.removeRelationBtns = [];
            for (var i = 0; i < removeRelationsRaw.length; i++) {
                this.removeRelationBtns.push(new button_19.Button(removeRelationsRaw.item(i), this.showRemoveRelationDialog.bind(this, removeRelationsRaw.item(i))));
            }
            this.removeAllRelationBtn = new button_19.Button(document.getElementById(this.id + "-remove-all"), this.showRemoveAllRelationDialog.bind(this));
        };
        AddEntityRelation.prototype.showRemoveAllRelationDialog = function () {
            system_23.System.showConfirmDialog(this.removeAllRelation.bind(this), "Hapus Semua Subkode", "Apakah anda yakin?");
        };
        AddEntityRelation.prototype.showRemoveRelationDialog = function (raw) {
            system_23.System.showConfirmDialog(this.removeRelation.bind(this, raw), "Hapus Subkode", "Apakah anda yakin?");
        };
        AddEntityRelation.prototype.removeAllRelation = function () {
            var data = {};
            data['code'] = this.codeId;
            $.ajax({
                url: system_23.System.getBaseUrl() + "/code/remove-all-relation",
                data: system_23.System.addCsrf(data),
                dataType: "json",
                context: this,
                method: "post",
                success: function (data) {
                    window.location.reload();
                },
                error: function (data) {
                }
            });
        };
        AddEntityRelation.prototype.removeRelation = function (removeRelationRaw) {
            var subcodeId = removeRelationRaw.getAttribute('data-entity-id');
            var data = {};
            data['subcode'] = subcodeId;
            data['code'] = this.codeId;
            $.ajax({
                url: system_23.System.getBaseUrl() + "/code/remove-relation",
                data: system_23.System.addCsrf(data),
                dataType: "json",
                context: this,
                method: "post",
                success: function (data) {
                    window.location.reload();
                },
                error: function (data) {
                }
            });
        };
        AddEntityRelation.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddEntityRelation.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddEntityRelation.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddEntityRelation;
    }(component_35.Component));
    exports.AddEntityRelation = AddEntityRelation;
});
define("project/list-user", ["require", "exports", "common/component", "common/system", "common/button"], function (require, exports, component_36, system_24, button_20) {
    "use strict";
    var ListUser = (function (_super) {
        __extends(ListUser, _super);
        function ListUser(root) {
            var _this = _super.call(this, root) || this;
            _this.addBtn = new button_20.Button(document.getElementById(_this.id + "-add"), _this.redirectToAdd.bind(_this));
            return _this;
        }
        ListUser.prototype.redirectToAdd = function () {
            window.location.href = system_24.System.getBaseUrl() + "/user/add";
        };
        ListUser.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
        };
        ListUser.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ListUser.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ListUser.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ListUser;
    }(component_36.Component));
    exports.ListUser = ListUser;
});
define("project/edit-code-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/search-field", "common/system"], function (require, exports, form_16, input_field_20, text_area_field_6, search_field_10, system_25) {
    "use strict";
    var EditCodeForm = (function (_super) {
        __extends(EditCodeForm, _super);
        function EditCodeForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_25.System.getBaseUrl() + "/code/index";
            };
            return _this;
        }
        EditCodeForm.prototype.rules = function () {
            this.setRequiredField([this.nameField, this.typeIdField,
                this.idField, this.codeField]);
            this.registerFields([this.nameField, this.descField, this.idField,
                this.typeIdField, this.codeField]);
        };
        EditCodeForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.idField = new input_field_20.InputField(document.getElementById(this.id + "-id"));
            this.codeField = new input_field_20.InputField(document.getElementById(this.id + "-code"));
            this.typeIdField = new search_field_10.SearchField(document.getElementById(this.id + "-type-id"));
            this.nameField = new input_field_20.InputField(document.getElementById(this.id + "-name"));
            this.descField = new text_area_field_6.TextAreaField(document.getElementById(this.id + "-desc"));
        };
        EditCodeForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        EditCodeForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        EditCodeForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return EditCodeForm;
    }(form_16.Form));
    exports.EditCodeForm = EditCodeForm;
});
define("project/edit-code", ["require", "exports", "common/component", "project/edit-code-form"], function (require, exports, component_37, edit_code_form_1) {
    "use strict";
    var EditCode = (function (_super) {
        __extends(EditCode, _super);
        function EditCode(root) {
            return _super.call(this, root) || this;
        }
        EditCode.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new edit_code_form_1.EditCodeForm(document.getElementById(this.id + "-form"));
        };
        EditCode.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        EditCode.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        EditCode.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return EditCode;
    }(component_37.Component));
    exports.EditCode = EditCode;
});
define("project/edit-code-type-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/system"], function (require, exports, form_17, input_field_21, text_area_field_7, system_26) {
    "use strict";
    var EditCodeTypeForm = (function (_super) {
        __extends(EditCodeTypeForm, _super);
        function EditCodeTypeForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_26.System.getBaseUrl() + "/code/type";
            };
            return _this;
        }
        EditCodeTypeForm.prototype.rules = function () {
            this.setRequiredField([this.nameField, this.idField]);
            this.registerFields([this.nameField, this.descField, this.idField]);
        };
        EditCodeTypeForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.idField = new input_field_21.InputField(document.getElementById(this.id + "-id"));
            this.nameField = new input_field_21.InputField(document.getElementById(this.id + "-name"));
            this.descField = new text_area_field_7.TextAreaField(document.getElementById(this.id + "-desc"));
        };
        EditCodeTypeForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        EditCodeTypeForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        EditCodeTypeForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return EditCodeTypeForm;
    }(form_17.Form));
    exports.EditCodeTypeForm = EditCodeTypeForm;
});
define("project/edit-code-type", ["require", "exports", "common/component", "project/edit-code-type-form"], function (require, exports, component_38, edit_code_type_form_1) {
    "use strict";
    var EditCodeType = (function (_super) {
        __extends(EditCodeType, _super);
        function EditCodeType(root) {
            return _super.call(this, root) || this;
        }
        EditCodeType.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new edit_code_type_form_1.EditCodeTypeForm(document.getElementById(this.id + "-form"));
        };
        EditCodeType.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        EditCodeType.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        EditCodeType.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return EditCodeType;
    }(component_38.Component));
    exports.EditCodeType = EditCodeType;
});
define("project/app", ["require", "exports", "common/component", "project/login", "project/create-owner", "project/list-owner", "project/create-ship", "project/list-ship", "project/ship-ownership", "project/daily-report", "project/custom-report", "common/system", "project/daily-selling", "project/custom-selling", "project/list-code", "project/list-code-type", "project/create-code-type", "project/create-code", "project/daily-transaction", "project/custom-transaction", "project/change-password", "project/assign-code-to-ship", "project/edit-ship", "project/add-entity-relation", "project/list-user", "project/edit-code", "project/edit-code-type"], function (require, exports, component_39, login_1, create_owner_1, list_owner_1, create_ship_1, list_ship_1, ship_ownership_1, daily_report_1, custom_report_1, system_27, daily_selling_1, custom_selling_1, list_code_1, list_code_type_1, create_code_type_1, create_code_1, daily_transaction_1, custom_transaction_1, change_password_1, assign_code_to_ship_1, edit_ship_1, add_entity_relation_1, list_user_1, edit_code_1, edit_code_type_1) {
    "use strict";
    var App = (function (_super) {
        __extends(App, _super);
        function App(root) {
            var _this = _super.call(this, root) || this;
            if (window.innerWidth < 600) {
                _this.leftSide.classList.add('app-hide');
            }
            return _this;
        }
        App.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            if (this.root.getElementsByClassName('login').length !== 0) {
                this.login = new login_1.Login(document.getElementById("lgn"));
            }
            else if (this.root.getElementsByClassName('create-owner').length !== 0) {
                this.createOwner = new create_owner_1.CreateOwner(document.getElementById("oco"));
            }
            else if (this.root.getElementsByClassName('list-owner').length !== 0) {
                this.listOwner = new list_owner_1.ListOwner(document.getElementById("olo"));
            }
            else if (this.root.getElementsByClassName('list-ship').length !== 0) {
                this.listShip = new list_ship_1.ListShip(document.getElementById("sls"));
            }
            else if (this.root.getElementsByClassName('create-ship').length !== 0) {
                this.createShip = new create_ship_1.CreateShip(document.getElementById("scs"));
            }
            else if (this.root.getElementsByClassName('ship-owner').length !== 0) {
                this.shipOwnership = new ship_ownership_1.ShipOwnership(document.getElementById("sso"));
            }
            else if (this.root.getElementsByClassName('daily-report').length !== 0) {
                this.dailyReport = new daily_report_1.DailyReport(document.getElementById("rdr"));
            }
            else if (this.root.getElementsByClassName('custom-report').length !== 0) {
                this.customReport = new custom_report_1.CustomReport(document.getElementById("rcr"));
            }
            else if (this.root.getElementsByClassName('daily-selling').length !== 0) {
                this.dailySelling = new daily_selling_1.DailySelling(document.getElementById("sds"));
            }
            else if (this.root.getElementsByClassName('daily-transact').length !== 0) {
                this.dailyTransact = new daily_transaction_1.DailyTransaction(document.getElementById("tdt"));
            }
            else if (this.root.getElementsByClassName('custom-selling').length !== 0) {
                this.customSelling = new custom_selling_1.CustomSelling(document.getElementById("scs"));
            }
            else if (this.root.getElementsByClassName('list-code').length !== 0) {
                this.listCode = new list_code_1.ListCode(document.getElementById("clc"));
            }
            else if (this.root.getElementsByClassName('list-code-type').length !== 0) {
                this.listCodeType = new list_code_type_1.ListCodeType(document.getElementById("clct"));
            }
            else if (this.root.getElementsByClassName('list-user').length !== 0) {
                this.listUser = new list_user_1.ListUser(document.getElementById("ulu"));
            }
            else if (this.root.getElementsByClassName('create-codetype').length !== 0) {
                this.createCodeType = new create_code_type_1.CreateCodeType(document.getElementById("ccct"));
            }
            else if (this.root.getElementsByClassName('create-code').length !== 0) {
                this.createCode = new create_code_1.CreateCode(document.getElementById("ccc"));
            }
            else if (this.root.getElementsByClassName('edit-code').length !== 0) {
                this.editCode = new edit_code_1.EditCode(document.getElementById("cec"));
            }
            else if (this.root.getElementsByClassName('edit-code-type').length !== 0) {
                this.editCodeType = new edit_code_type_1.EditCodeType(document.getElementById("cect"));
            }
            else if (this.root.getElementsByClassName('custom-transaction').length !== 0) {
                this.customTransact = new custom_transaction_1.CustomTransaction(document.getElementById("tct"));
            }
            else if (this.root.getElementsByClassName('change-pass').length !== 0) {
                this.changePassword = new change_password_1.ChangePassword(document.getElementById("ucp"));
            }
            else if (this.root.getElementsByClassName('act-ship').length !== 0) {
                this.actShip = new assign_code_to_ship_1.AssignCodeToShip(document.getElementById("sacts"));
            }
            else if (this.root.getElementsByClassName('edit-ship').length !== 0) {
                this.editShip = new edit_ship_1.EditShip(document.getElementById("ses"));
            }
            else if (this.root.getElementsByClassName('aer').length !== 0) {
                this.addEntityRelation = new add_entity_relation_1.AddEntityRelation(document.getElementById("caer"));
            }
            this.hamburgerIcon = this.root.getElementsByClassName('app-hamburger')[0];
            this.leftSide = this.root.getElementsByClassName('left-side')[0];
        };
        App.prototype.toggleLeftSide = function () {
            if (this.leftSide.classList.contains('app-hide')) {
                this.leftSide.classList.remove('app-hide');
            }
            else {
                this.leftSide.classList.add('app-hide');
            }
        };
        App.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            if (!system_27.System.isEmptyValue(this.hamburgerIcon)) {
                this.hamburgerIcon.addEventListener('click', this.toggleLeftSide.bind(this));
            }
        };
        App.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        App.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return App;
    }(component_39.Component));
    exports.App = App;
});
define("project/init", ["require", "exports", "project/app"], function (require, exports, app_1) {
    "use strict";
    var root = document.getElementsByTagName("html")[0];
    var app = new app_1.App(root);
});
