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
        Component.prototype.attachEvent = function (eventName, callback) {
            this.root.addEventListener(eventName, callback);
        };
        return Component;
    }());
    exports.Component = Component;
});
define("common/system", ["require", "exports"], function (require, exports) {
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
        return System;
    }());
    exports.System = System;
});
define("common/Field", ["require", "exports", "common/component", "common/system"], function (require, exports, component_1, system_1) {
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
    }(component_1.Component));
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
define("common/button", ["require", "exports", "common/component"], function (require, exports, component_2) {
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
    }(component_2.Component));
    exports.Button = Button;
});
define("common/modal", ["require", "exports", "common/component", "common/button"], function (require, exports, component_3, button_1) {
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
        return Modal;
    }(component_3.Component));
    exports.Modal = Modal;
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
define("common/form", ["require", "exports", "common/component", "common/system", "common/button"], function (require, exports, component_4, system_3, button_2) {
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
            this.submitButton = new button_2.Button(document.getElementById(this.id + "-submit-btn"), this.submit.bind(this));
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
define("project/login-form", ["require", "exports", "common/form", "common/input-field"], function (require, exports, form_1, input_field_1) {
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
            this.emailField = new input_field_1.InputField(document.getElementById(this.id + "-email-field"));
            this.passwordField = new input_field_1.InputField(document.getElementById(this.id + "-password-field"));
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
define("common/text-area-field", ["require", "exports", "common/Field"], function (require, exports, Field_2) {
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
    }(Field_2.Field));
    exports.TextAreaField = TextAreaField;
});
define("project/create-owner-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/system"], function (require, exports, form_2, input_field_2, text_area_field_1, system_4) {
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
            this.firstNameField = new input_field_2.InputField(document.getElementById(this.id + "-first-name"));
            this.lastNameField = new input_field_2.InputField(document.getElementById(this.id + "-last-name"));
            this.telpField = new input_field_2.InputField(document.getElementById(this.id + "-telephone"));
            this.addrField = new text_area_field_1.TextAreaField(document.getElementById(this.id + "-address"));
            this.emailField = new input_field_2.InputField(document.getElementById(this.id + "-email"));
            this.passwordField = new input_field_2.InputField(document.getElementById(this.id + "-password"));
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
define("project/list-owner", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_7, button_3, system_5) {
    "use strict";
    var ListOwner = (function (_super) {
        __extends(ListOwner, _super);
        function ListOwner(root) {
            return _super.call(this, root) || this;
        }
        ListOwner.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addBtn = new button_3.Button(document.getElementById(this.id + "-add"), this.redirectToAddOwner.bind(this));
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
define("project/create-ship-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/system"], function (require, exports, form_3, input_field_3, text_area_field_2, system_6) {
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
            this.setRequiredField([this.nameField]);
            this.registerFields([this.nameField, this.descField]);
        };
        CreateShipForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.nameField = new input_field_3.InputField(document.getElementById(this.id + "-name"));
            this.descField = new text_area_field_2.TextAreaField(document.getElementById(this.id + "-desc"));
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
define("project/list-ship", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_9, button_4, system_7) {
    "use strict";
    var ListShip = (function (_super) {
        __extends(ListShip, _super);
        function ListShip(root) {
            return _super.call(this, root) || this;
        }
        ListShip.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addBtn = new button_4.Button(document.getElementById(this.id + "-add"), this.redirectToAddShip.bind(this));
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
            this.root.addEventListener("click", function (e) {
                this.root.dispatchEvent(this.clickSfdiEvent);
            }.bind(this));
        };
        SearchFieldDropdownItem.prototype.unbindEvent = function () {
            this.root.addEventListener(SearchFieldDropdownItem.CLICK_SFDI_EVENT, null);
            this.root.addEventListener("click", null);
        };
        return SearchFieldDropdownItem;
    }(component_10.Component));
    exports.SearchFieldDropdownItem = SearchFieldDropdownItem;
});
define("common/search-field", ["require", "exports", "common/Field", "common/system", "common/search-field-dropdown-item"], function (require, exports, field_1, system_8, search_field_dropdown_item_1) {
    "use strict";
    var SearchField = (function (_super) {
        __extends(SearchField, _super);
        function SearchField(root) {
            var _this = _super.call(this, root) || this;
            _this.additionalData = [];
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
            document.addEventListener('click', function (e) {
                if (e.target && !e.target.closest('.search-field-dropdown')) {
                    this.emptyDropdown();
                }
            }.bind(this));
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
                this.items[i].attachEvent(search_field_dropdown_item_1.SearchFieldDropdownItem.CLICK_SFDI_EVENT, function (e) {
                    this.setValue(e.detail.itemId, e.detail.text);
                    this.emptyDropdown();
                }.bind(this));
            }
            this.showDropdown();
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
        SearchField.prototype.disable = function () {
            this.input.setAttribute('disabled', "true");
        };
        SearchField.prototype.enable = function () {
            this.input.removeAttribute('disabled');
        };
        return SearchField;
    }(field_1.Field));
    exports.SearchField = SearchField;
});
define("project/ship-ownership", ["require", "exports", "common/component", "common/search-field", "common/button", "common/system"], function (require, exports, component_11, search_field_1, button_5, system_9) {
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
            this.add = new button_5.Button(document.getElementById(this.id + "-add"), this.assignShip.bind(this));
        };
        ShipOwnership.prototype.assignShip = function () {
            var data = {};
            data['ship_id'] = this.ship.getValue();
            data['owner_id'] = this.owner.getValue();
            data = system_9.System.addCsrf(data);
            this.add.disable(true);
            $.ajax({
                url: system_9.System.getBaseUrl() + "/ship/assign",
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
                url: system_9.System.getBaseUrl() + "/ship/get-ownership-gv",
                data: system_9.System.addCsrf(data),
                dataType: "json",
                context: this,
                method: "post",
                success: function (data) {
                    this.add.disable(false);
                    if (data.status) {
                        this.area.innerHTML = data.views;
                    }
                },
                error: function (data) {
                }
            });
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
    }(component_11.Component));
    exports.ShipOwnership = ShipOwnership;
});
define("project/add-report-form", ["require", "exports", "common/form", "common/input-field"], function (require, exports, form_4, input_field_4) {
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
            this.shipField = new input_field_4.InputField(document.getElementById(this.id + "-ship"));
            this.date = new input_field_4.InputField(document.getElementById(this.id + "-date"));
            this.debetField = new input_field_4.InputField(document.getElementById(this.id + "-debet"));
            this.remarkField = new input_field_4.InputField(document.getElementById(this.id + "-remark"));
            this.creditField = new input_field_4.InputField(document.getElementById(this.id + "-credit"));
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
define("project/daily-report-item", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_12, button_6, system_10) {
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
            this.removeBtn = new button_6.Button(document.getElementById(this.id + "-remove-btn"), this.removeItem.bind(this));
            this.cancelRemove = new button_6.Button(document.getElementById(this.id + "-cancel"), this.cancelRemoveItem.bind(this));
        };
        DailyReportItem.prototype.removeItem = function () {
            this.removeBtn.disable(true);
            var data = {};
            data['report_id'] = this.reportId;
            $.ajax({
                url: system_10.System.getBaseUrl() + "/report/remove",
                data: system_10.System.addCsrf(data),
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
                url: system_10.System.getBaseUrl() + "/report/cancel-remove",
                data: system_10.System.addCsrf(data),
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
    }(component_12.Component));
    exports.DailyReportItem = DailyReportItem;
});
define("project/daily-report-view", ["require", "exports", "common/component", "project/add-report-form", "project/daily-report-item"], function (require, exports, component_13, add_report_form_1, daily_report_item_1) {
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
    }(component_13.Component));
    exports.DailyReportView = DailyReportView;
});
define("project/daily-report", ["require", "exports", "common/component", "common/search-field", "common/input-field", "common/system", "project/daily-report-view", "common/button"], function (require, exports, component_14, search_field_2, input_field_5, system_11, daily_report_view_1, button_7) {
    "use strict";
    var DailyReport = (function (_super) {
        __extends(DailyReport, _super);
        function DailyReport(root) {
            return _super.call(this, root) || this;
        }
        DailyReport.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.ship = new search_field_2.SearchField(document.getElementById(this.id + "-ship"));
            this.date = new input_field_5.InputField(document.getElementById(this.id + "-date"));
            this.area = this.root.getElementsByClassName('daily-report-area')[0];
            this.refresh = new button_7.Button(document.getElementById(this.id + "-refresh"), this.getView.bind(this));
        };
        DailyReport.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.ship.attachEvent(search_field_2.SearchField.GET_VALUE_EVENT, this.enableDateField.bind(this));
            this.ship.attachEvent(search_field_2.SearchField.LOSE_VALUE_EVENT, this.disableDateField.bind(this));
            this.date.attachEvent(input_field_5.InputField.VALUE_CHANGED, this.getView.bind(this));
        };
        DailyReport.prototype.getView = function () {
            var data = {};
            data['ship_id'] = this.ship.getValue();
            data['date'] = this.date.getValue();
            this.area.innerHTML = "Loading . . .";
            this.refresh.disable(true);
            $.ajax({
                url: system_11.System.getBaseUrl() + "/report/get-daily-report-view",
                data: system_11.System.addCsrf(data),
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
            if (!system_11.System.isEmptyValue(this.reportView)) {
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
    }(component_14.Component));
    exports.DailyReport = DailyReport;
});
define("project/custom-report-form", ["require", "exports", "common/form", "common/search-field", "common/input-field"], function (require, exports, form_5, search_field_3, input_field_6) {
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
            this.from = new input_field_6.InputField(document.getElementById(this.id + "-from"));
            this.to = new input_field_6.InputField(document.getElementById(this.id + "-to"));
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
define("project/report-view", ["require", "exports", "common/component"], function (require, exports, component_15) {
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
    }(component_15.Component));
    exports.ReportView = ReportView;
});
define("project/custom-report", ["require", "exports", "common/component", "project/custom-report-form", "project/report-view"], function (require, exports, component_16, custom_report_form_1, report_view_1) {
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
    }(component_16.Component));
    exports.CustomReport = CustomReport;
});
define("project/app", ["require", "exports", "common/component", "project/login", "project/create-owner", "project/list-owner", "project/create-ship", "project/list-ship", "project/ship-ownership", "project/daily-report", "project/custom-report", "common/system"], function (require, exports, component_17, login_1, create_owner_1, list_owner_1, create_ship_1, list_ship_1, ship_ownership_1, daily_report_1, custom_report_1, system_12) {
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
            if (!system_12.System.isEmptyValue(this.hamburgerIcon)) {
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
    }(component_17.Component));
    exports.App = App;
});
define("project/init", ["require", "exports", "project/app"], function (require, exports, app_1) {
    "use strict";
    var root = document.getElementsByTagName("html")[0];
    var app = new app_1.App(root);
});
