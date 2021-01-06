<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wish List - Login</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    </head>
    <body>
        <section>
            <div class="container">
                <div class="user signinBx" id = "login">
                    <div class="imgBx"><img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img1.jpg" alt="" /></div>
                    <div class="formBx">
                        <form action="" method="post">
                            <div class="form-group">
                                <span class="alert-danger text-center" id="login_alert"></span>
                                <h2>Sign In</h2>
                                <input type="text" name="user_email" id="user_email_login" class="form-control"
                                       placeholder="Username"/>

                                <input type="password" name="user_password" id="user_password_login" class="form-control"
                                       placeholder="Password"/>
                                <input type="button" name="login" value="Login" id="login_btn"/>
                                <p class="signup">
                                    Don't have an account ?
                                    <a href="#" onclick="toggleForm();">Sign Up.</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="user signupBx">
                    <div class="formBx" id = "registration">
                        <form action="" method="post">
                            <div class="form-group">
                                <span class="alert-danger" id="reg_alert"></span>
                                <span class="alert-success" id="reg_alert_success"></span>
                                <h2>Create an account</h2>
                                <input type="text" name="user_name" id="user_name_reg" class="form-control"
                                       placeholder="Name" required/>
                                <input type="email" name="user_email" id="user_email_reg" class="form-control"
                                       placeholder="Email Address" required/>
                                <input type="password" name="user_password" id="user_password_reg" class="form-control"
                                       placeholder="Password" required/>
                                <input type="text" name="user_address" id="user_address_reg" class="form-control"
                                       placeholder="Address" required/>
                                <input type="tel" name="user_mobile" id="user_mobile_reg" class="form-control"
                                       placeholder="Mobile Number" required/>
                                <input type="button" name="register" id="register_btn" class="form-control" value="Sign Up" />
                                <p class="signup">
                                    Already have an account ?
                                    <a href="#" onclick="toggleForm();">Sign in.</a>
                                </p>
                            </div>
                        </form>
                    </div>
                    <div class="imgBx"><img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img2.jpg" alt="" /></div>
                </div>
            </div>
        </section>

        <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/underscore-min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/backbone-min.js"></script>

        <script type="text/javascript">
            let User = Backbone.Model.extend({
                url: "<?php echo base_url('index.php/api/authentication/user');?>",
                defaults: {
                    "email": null,
                    "password": null
                }
            });

            let userEntry = new User();

            let LoginView = Backbone.View.extend({
                el: $("#login"),
                events: {
                    "click #login_btn" : "login"
                },

                initialize: function() {
                    let self = this;

                    this.email = $("#user_email_login");
                    this.password = $("#user_password_login");

                    this.email.change(function (e) {
                        self.model.set({email: $(e.currentTarget).val()});
                    });

                    this.password.change(function (e) {
                        self.model.set({password: $(e.currentTarget).val()});
                    });
                },

                login: function (){
                    let email = this.model.get('email');
                    let password = this.model.get('password');
                    if(isEmpty(email) && isEmpty(password)){
                        userEntry.save({},{
                            async: false,
                            success: function (data, statusText) {
                                window.location.href = '/2017296/WishList';
                            },
                            error:function (data, statusText) {
                                $("#login_alert").html(statusText.responseJSON.message);
                            }
                        });
                    }else{
                        $("#login_alert").html("You must fill out all fields.");
                    }
                }
            });
           let loginView = new LoginView({model: userEntry});

            let NewUser = Backbone.Model.extend({
                url: "<?php echo base_url('index.php/api/users/user');?>",
                defaults: {
                    name_reg: null,
                    email_reg: null,
                    password_reg: null,
                    address_reg: null,
                    mobile_reg: null
                }
            });

            let newUserEntity = new NewUser();

            let RegisterView = Backbone.View.extend({
                el: $("#registration"),
                events: {
                    "click #register_btn" : "register"
                },

                initialize: function() {
                    let self = this;

                    this.name_reg = $("#user_name_reg");
                    this.email_reg = $("#user_email_reg");
                    this.password_reg = $("#user_password_reg");
                    this.address_reg = $("#user_address_reg");
                    this.mobile_reg = $("#user_mobile_reg");

                    this.name_reg.change(function (e) {
                        self.model.set({name_reg: $(e.currentTarget).val()});
                    });

                    this.email_reg.change(function (e) {
                        self.model.set({email_reg: $(e.currentTarget).val()});
                    });
                    this.password_reg.change(function (e) {
                        self.model.set({password_reg: $(e.currentTarget).val()});
                    });
                    this.address_reg.change(function (e) {
                        self.model.set({address_reg: $(e.currentTarget).val()});
                    });
                    this.mobile_reg.change(function (e) {
                        self.model.set({mobile_reg: $(e.currentTarget).val()});
                    });
                },

                register: function (){
                    let name = this.model.get('name_reg');
                    let email = this.model.get('email_reg');
                    let password = this.model.get('password_reg');
                    let address = this.model.get('address_reg');
                    let mobile = this.model.get('mobile_reg');
                    if(isEmpty(name) && isEmpty(email) && isEmpty(password) && isEmpty(address) && isEmpty(mobile)){
                        newUserEntity.save({},{
                            async: false,
                            success: function (data, statusText) {
                                $("#reg_alert").empty();
                                $("#reg_alert_success").html(statusText.message);
                            },
                            error: function (data, statusText) {
                                $("#reg_alert_success").empty();
                                $("#reg_alert").html(statusText.responseJSON.message);
                            }
                        });
                    }else{
                        $("#reg_alert").html("You must fill out all fields.");
                    }
                }
            });
            let registerView = new RegisterView({model: newUserEntity});

            let Router = Backbone.Router.extend({
                routes : {
                    "" : "login",
                    "register": "register",
                    "register(/:id)": "view"
                },

                register: function() {
                    console.log("we are in register")
                    let newUser = new NewUser();
                    let registerView = new LoginView({model: newUser});
                    // newUser.fetch({async:false});
                },

                login: function() {
                    console.log("we are in login")
                    let user = new User();
                    let loginView = new LoginView({model: user});
                    // user.fetch({async:false});
                }
            });

            let router  = new Router();
            Backbone.history.start();

            function isEmpty(value){
                return !(value == null || value === '');
            }
        </script>

        <script type="text/javascript">
            const toggleForm = () => {
                $("#reg_alert").empty();
                $("#reg_alert_success").empty();
                $("#login_alert").empty();
                const container = document.querySelector('.container');
                container.classList.toggle('active');
            };
        </script>
    </body>
</html>
