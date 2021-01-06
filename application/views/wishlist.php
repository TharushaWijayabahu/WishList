<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Wish List - Login</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/wishlist.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    </head>
    <body>

        <div class="container mb-4">
            <div class="row">
                <div class="col-lg-4 pb-5">
                    <!-- Account Sidebar-->
                    <div class="author-card pb-3">
                        <div class="author-card-cover"
                             style="background-image: url(<?php echo base_url('assets/img/cover.jpg') ?>);"><a
                                    class="btn btn-style-1 btn-white btn-sm" href="#" data-toggle="tooltip" title=""
                                    data-original-title="You currently have 290 Reward points to spend"><i
                                        class="fa fa-award text-md"></i>&nbsp;290 points</a></div>
                        <div class="author-card-profile">
                            <div class="author-card-avatar"><img
                                        src="<?php echo base_url('assets/img/profile-pic-1.png') ?>" alt="Daniel Adams">
                            </div>
                            <div class="author-card-details">
                                <h5 class="author-card-name text-lg">Daniel Adams</h5><span
                                        class="author-card-position">Joined February 06, 2017</span>
                            </div>
                        </div>
                    </div>
                    <div class="wizard">
                        <nav class="list-group list-group-flush">
                            <a class="list-group-item active" href="#">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fa fa-shopping-bag mr-1 text-muted"></i>
                                        <div class="d-inline-block font-weight-medium text-uppercase">My Wishlis</div>
                                    </div>
                                    <span class="badge badge-secondary">6</span>
                                </div>
                            </a><a class="list-group-item" href="#profile"><i class="fa fa-user text-muted"></i>Profile </a>
                            <a class="list-group-item" href="#shared-list">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fa fa-heart mr-1 text-muted"></i>
                                        <div class="d-inline-block font-weight-medium text-uppercase">Shared List</div>
                                    </div>
                                    <span class="badge badge-secondary">3</span>
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>
                <!-- Wishlist-->

                <div class="col-lg-8 pb-5" id="wishListView"></div>

            </div>
            <!--                            -->


            <!-- Add Item Modal HTML -->
            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="avatar">
                                <img src="<?php echo base_url('assets/img/present-modal.png') ?>" alt="Avatar">
                            </div>
                            <h4 class="modal-title">Add Item</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" placeholder="Title"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="price" min="0"
                                           placeholder="Price"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="quantity" min="0"
                                           placeholder="Quantity" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="url" placeholder="URL"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="img_url" placeholder="Image URL"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker form-control" data-live-search="true">
                                        <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                                        <option data-tokens="mustard">Burger, Shake and a Smile</option>
                                        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <input type="button" id="addItemBtn" class="btn btn-primary btn-lg btn-block login-btn"
                                           value="Add"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/underscore-min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/backbone-min.js"></script>
            <script id="wishListTemplate" type="text/html">
                <div class="text-center" style="margin-bottom: 2%;">
                    <button type="button" id="addItem" class="btn btn-success" data-toggle="modal"
                            data-target="#myModal">
                        <i class="fas fa-plus"></i> Add Item
                    </button>
                </div>
                <% if(models){
                } %>
                <% _.each(models, function(car) { %>
                <div id="<%= car.get('id') %>">
                    <div class="cart-item d-md-flex justify-content-between">
                        <div class="px-3 my-3">
                            <a class="cart-item-product" href="<%= car.get('url') %>">
                                <div class="cart-item-product-thumb">
                                    <img id="itemImg" src="<%= car.get('imgUrl') %>" alt="Product">
                                </div>
                                <div class="cart-item-product-info">
                                    <h4 class="cart-item-product-title" id="itemTitle"><%= car.get('title') %></h4>
                                    <div class="text-lg text-body font-weight-medium pb-1">$ <%= car.get('price') %></div>
                                    <span>Quantity: <span
                                                class="text-warning font-weight-medium"><%= car.get('qty') %></span></span>
                                </div>
                            </a>
                        </div>
                        <div class="px-3 my-3">
                            <div class="row" style="margin-top: 50%;">
                                <button rel="tooltip" id="editItemBtn" class="btn btn-default"><i
                                            class="fas fa-edit fa-lg"></i></button>
                                <button rel="tooltip" id="deleteItemBtn" class="btn btn-default"><i
                                            class="fas fa-trash-alt fa-lg"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
                <% }); %>

            </script>
            <script type="text/javascript">
                //            Creating backbone model for Item
                let Item = Backbone.Model.extend({
                    //url: "<?php //echo base_url('index.php/api/wishlist/item');?>//",
                    idAttribute: 'id',
                    defaults: {
                        "id": null,
                        "title": "",
                        "priority": "",
                        "price": null,
                        "qty": null,
                        "url": "",
                        "imgUrl": ""
                    }
                });
                //            Creating backbone model for User
                let User = Backbone.Model.extend({
                    //url: "<?php //echo base_url('index.php/api/wishlist/item');?>//",
                    idAttribute: 'id',
                    defaults: {
                        "id": null,
                        "name": "",
                        "email": "",
                        "address": null,
                        "tel": null
                    }
                });

                let WishList = Backbone.Model.extend({
                    url: "<?php echo base_url('index.php/api/wishlist/wishlist');?>",
                    defaults: {
                        "name": "",
                        "occasion": "",
                        "description": ""
                    }
                });

                //    Views
                let WishListView = Backbone.View.extend({
                    el: '#wishListView',
                    template: _.template($("#wishListTemplate").html()),
                    initialize: function () {
                        this.listenTo(this.model, 'sync', this.render);
                        this.model.on('click', this.editItem, this);
                        this.model.fetch({
                            async: false,
                            success: function (data, statusText) {
                                console.log("success",statusText)
                            },
                            error:function (data, statusText) {
                                console.log(statusText.responseJSON.message)
                            }
                        });
                        // this.listenTo(this.model, 'sync click', this.deleteItem);

                        // this.render();
                    },
                    render: function () {
                        $(this.$el).html(this.template(this.model));
                        return this;
                    },
                    events: {
                        'click #addItemBtn': 'addItem',
                        'click #editItemBtn': 'editItem',
                        'click #deleteItemBtn': 'deleteItem'
                    },
                    addItem: function (item) {
                        console.log("add item",e)
                    },
                    editItem: function (item) {
                        console.log(this.$el.find("div#" + item.id).val())
                        // alert('Do Change');
                    },
                    deleteItem: function () {
                        alert('Do Delete');
                    }
                });

                let CreateWishView = Backbone.View.extend({
                    el: '#wishListView',
                    // template: _.template($("#wishListTemplate").html()),
                    initialize: function () {
                        this.listenTo(this.model, 'sync', this.render);
                        this.model.on('click', this.editItem, this);
                        this.model.save({}, {
                            async: false,
                            success: function (data, statusText) {
                                console.log("success",statusText)
                            },
                            error:function (data, statusText) {
                                console.log(statusText.responseJSON.message)
                            }
                        });
                        // this.listenTo(this.model, 'sync click', this.deleteItem);

                        // this.render();
                    },
                    render: function () {
                        $(this.$el).html(this.template(this.model));
                        return this;
                    },
                    events: {
                        'click #addItemBtn': 'addItem',
                        'click #editItemBtn': 'editItem',
                        'click #deleteItemBtn': 'deleteItem'
                    },
                    addItem: function (item) {
                        console.log("add item",e)
                    },
                    editItem: function (item) {
                        console.log(this.$el.find("div#" + item.id).val())
                        // alert('Do Change');
                    },
                    deleteItem: function () {
                        alert('Do Delete');
                    }
                });

                //Router
                let Router = Backbone.Router.extend({
                    routes: {
                        "": "createWishListView",
                        "wishlist": "wishItemView",
                        "profile": "profileView",
                        "shared-list": "sharedView"
                    },
                    createWishListView: function () {
                        // new WishListView({model: new ItemCollection()});
                        console.log("createWishListView");
                    },
                    wishItemView: function () {
                        new WishListView({model: new ItemCollection()});
                        console.log("wishItemView");
                    },
                    profileView: function () {
                        console.log("profileView");
                    },
                    sharedView: function () {
                        console.log("sharedView");
                    }
                });
                $("#addItemBtn").click(function () {
                    new Item({
                        "id": 3,
                        "title": "Apple iPhone X 256 GB Space Gray",
                        "priority": "Must Have",
                        "price": 1450.00,
                        "qty": 2,
                        "url": "#",
                        "imgUrl": "assets/img/present.jpg"
                    });

                    console.log("added");
                });
                let router = new Router();
                Backbone.history.start();

            </script>
    </body>
</html>
