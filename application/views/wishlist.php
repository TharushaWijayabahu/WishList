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
                <div class="col-lg-4 pb-5" id="profileView">
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
                                <h5 class="author-card-name text-lg" id="user_name">Daniel Adams</h5><span
                                        class="author-card-position" id="user_email">Joined February 06, 2017</span>
                            </div>
                        </div>
                    </div>
                    <div class="wizard">
                        <nav class="list-group list-group-flush">
                            <a class="list-group-item" href="#">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fa fa-shopping-bag mr-1 text-muted"></i>
                                        <div class="d-inline-block font-weight-medium text-uppercase">My Wishlist</div>
                                    </div>
                                    <span class="badge badge-secondary" id="wishListCount"></span>
                                </div>
                            </a><a class="list-group-item" href="#wishlist">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fa fa-heart mr-1 text-muted"></i>
                                        <div class="d-inline-block font-weight-medium text-uppercase">Wish Items</div>
                                    </div>
                                    <span class="badge badge-secondary" id="wishItemCount"></span>
                                </div>
                            </a><a class="list-group-item" href="#profile">
                                <i class="fa fa-user text-muted"></i>Profile </a>
                            <a class="list-group-item" href="#shared-list">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fa fa-heart mr-1 text-muted"></i>
                                        <div class="d-inline-block font-weight-medium text-uppercase">Shared List</div>
                                    </div>
                                    <span class="badge badge-secondary" id="sharedListCount"></span>
                                </div>
                            </a>
                            <a class="list-group-item" href="#" onclick="signOut(); return false;">
                                <i class="fas fa-sign-out-alt fa-rotate-180 text-muted"></i>
                                SignOut
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
                                    <select class="selectpicker form-control" id="priorities"
                                            data-live-search="true">
                                        <option value="1" data-name="Must-Have"
                                                data-pr_level="1" selected>Must-Have
                                        </option>
                                        <option value="2" data-name="Would be Nice to Have"
                                                data-pr_level="2">Would be Nice to Have
                                        </option>
                                        <option value="3" data-name="If possible"
                                                data-pr_level="3">If possible
                                        </option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <input type="button" id="addItemBtn"
                                           class="btn btn-primary btn-lg btn-block"
                                           value="Add"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="editItemModal" class="modal fade">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="avatar">
                                <img src="<?php echo base_url('assets/img/present-modal.png') ?>" alt="Avatar">
                            </div>
                            <h4 class="modal-title">Update an Item</h4>
                            <button type="button" class="close" iclass="close" data-dismiss="modal"
                                    aria-hidden="true">&times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="editTitle" placeholder="Title"
                                           value="" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="editPrice" min="0"
                                           placeholder="Price"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="editQuantity" min="0"
                                           placeholder="Quantity" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="editUrl" placeholder="URL"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="editImg_url" placeholder="Image URL"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker form-control" id="editPriorities"
                                            data-live-search="true">
                                        <option value="1" data-name="Must-Have"
                                                data-pr_level="1" selected>Must-Have
                                        </option>
                                        <option value="2" data-name="Would be Nice to Have"
                                                data-pr_level="2">Would be Nice to Have
                                        </option>
                                        <option value="3" data-name="If possible"
                                                data-pr_level="3">If possible
                                        </option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <input type="button" id="updateItemBtn"
                                           class="btn btn-primary btn-lg btn-block update-item-btn"

                                           value="Update"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                <div class="toast-header">
                    <img src="" class="rounded mr-2" alt="">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>

            <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/underscore-min.js"></script>
            <!--            <script src="--><?php //echo base_url(); ?><!--assets/js/backbone-min.js"></script>-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

            <script id="wishListTemplate" type="text/html">
                <div class="hasNotWishList" id="hasNotWishList">
                    <div class="text-center" style="margin-bottom: 2%; margin-top: 2%">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#myModal">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
                    </div>
                    <div class="cart-item" style="min-height: 342px">
                        <p class="text-center">No Wish List has been created yet</p>
                    </div>
                </div>
                <div id="hasWishlist" class="hasWishlist">
                    <div class="cart-item d-md-flex justify-content-between">
                        <div class="px-3 my-3">
                            <a target="_blank" class="item-item-product" href=" ">
                                <div class="cart-item-product-thumb">
                                    <img id="itemImg" src="<%= this.model.get('img_url') %>" alt="Product">
                                </div>
                                <div class="cart-item-product-info">
                                    <h4 class="cart-item-product-title" id="itemTitle">
                                        <%= this.model.get('name') %> (<%= this.model.get('occasion') %>)</h4>
                                    <div class="text-lg text-body font-weight-medium pb-1">
                                        <%= this.model.get('description') %>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="px-3 my-3">
                            <div class="row" style="margin-top: 50%;">
                                <button rel="tooltip" id="editListBtn" data-id="<%= this.model.get('id') %>"
                                        class="btn btn-default update-btn" data-toggle="modal"
                                        data-target="#editListModal">
                                    <i class="fas fa-edit fa-lg"></i></button>
                                <button rel="tooltip" id="deleteListBtn" data-id="<%= this.model.get('id') %>"
                                        class="btn btn-default"><i
                                            class="fas fa-trash-alt fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </script>

            <script id="wishItemTemplate" type="text/html">
                <% if(wishList.get('id')){%>
                <div>
                    <h3 class="text-center"><%= wishList.get('name') %> (<%= wishList.get('occasion') %>)</h3>
                </div>
                <div class="text-center" style="margin-bottom: 2%; margin-top: 2%">
                    <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#myModal">
                        <i class="fas fa-plus"></i> Add Item
                    </button>
                </div>
                <% if(models.length === 0){%>
                <% console.log('models', models, '\n wishList',wishList)%>
                <div class="cart-item" style="min-height: 75%">

                    <p class="text-center">No items Found</p>
                </div>
                <% } _.each(models, function(item) { %>
                <div id="<%= item.get('id') %>">
                    <div class="cart-item d-md-flex justify-content-between">
                        <div class="px-3 my-3">
                            <a target="_blank" class="item-item-product" href="<%= item.get('url') %>">
                                <div class="cart-item-product-thumb">
                                    <img id="itemImg" src="<%= item.get('img_url') %>" alt="Product">
                                </div>
                                <div class="cart-item-product-info">
                                    <h4 class="cart-item-product-title" id="itemTitle"><%= item.get('title') %></h4>
                                    <div class="text-lg text-body font-weight-medium pb-1">$ <%= item.get('price') %>
                                    </div>
                                    <span>Quantity: <span
                                                class="text-warning font-weight-medium"><%= item.get('qty') %></span>
                                    </span>
                                    <span> <%= item.get('pr_name') %> </span>
                                </div>
                            </a>
                        </div>
                        <div class="px-3 my-3">
                            <div class="row" style="margin-top: 50%;">
                                <button rel="tooltip" id="editItemBtn" data-id="<%= item.get('id') %>"
                                        class="btn btn-default update-btn"
                                        data-toggle="modal"
                                        data-target="#editItemModal">
                                    <i class="fas fa-edit fa-lg"></i></button>
                                <button rel="tooltip" id="deleteItemBtn" data-id="<%= item.get('id') %>"
                                        class="btn btn-default"><i
                                            class="fas fa-trash-alt fa-lg"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
                <% }); %>
                <% }else{ %>
                <p class="text-center" style="margin-top: 25%"> No wish list has been created yet. Please try creating a
                    wish list.</p>
                <% } %>

            </script>
            <script type="text/javascript">
                let userId = <?php echo $this->session->userdata('userId');?>;
                // Creating backbone model for Item
                let Item = Backbone.Model.extend({
                    url: "<?php echo base_url('index.php/api/wishitem/item');?>",
                    idAttribute: 'id',
                    defaults: {
                        "id": null,
                        "w_id": null,
                        "pr_id": null,
                        "title": "",
                        "price": null,
                        "qty": null,
                        "url": "",
                        "img_url": "",
                        "pr_name": "",
                        "pr_level": "",
                        "created_at": "",
                        "updated_at": "",
                    }
                });
                // Creating backbone collection for wishlist item
                let WishItemCollection = Backbone.Collection.extend({
                    url: "<?php echo base_url('index.php/api/wishitem/item');?>",
                    idAttribute: 'id',
                    model: Item,
                    comparator: function (item) {
                        return item.get("pr_level");
                    }
                });
                // Creating backbone model for User
                let User = Backbone.Model.extend({
                    url: "<?php echo base_url('index.php/api/users/user');?>",
                    idAttribute: 'id',
                    defaults: {
                        "id": null,
                        "name": "",
                        "email": "",
                        "address": null,
                        "tel": "",
                        "created_at": "",
                        "updated_at": ""
                    }
                });
                // Creating backbone model for Wishlist
                let WishList = Backbone.Model.extend({
                    url: "<?php echo base_url('index.php/api/wishlist/wishlist');?>",
                    idAttribute: 'id',
                    defaults: {
                        "id": null,
                        "u_id": "",
                        "name": "",
                        "occasion": "",
                        "description": "",
                        "img_url": "",
                        "created_at": "",
                        "updated_at": ""
                    }
                });
                let Priority = Backbone.Model.extend({
                    idAttribute: 'id',
                    defaults: {
                        "id": null,
                        "name": "",
                        "pr_level": "",
                        "created_at": "",
                        "updated_at": ""
                    }
                });
                // Creating backbone collection for Priorities
                let Priorities = Backbone.Collection.extend({
                    url: "<?php echo base_url('index.php/api/wishitem/priority');?>",
                    idAttribute: 'id',
                    model: Priority,
                });
                //Sign Out Model
                let SignOut = Backbone.Model.extend({
                    url: "<?php echo base_url('index.php/api/authentication/logout');?>"
                });
                let user = new User();
                let wishList = new WishList();
                let wishListItems = new WishItemCollection();
                let priorities = new Priorities();

                user.fetch({data: $.param({'id': userId})}, {async: false});
                wishList.fetch({async: false});
                wishListItems.fetch({async: false});
                priorities.fetch({async: false});

                //    Views
                let ProfileView = Backbone.View.extend({
                    el: '#profileView',
                    initialize: function () {
                        this.listenTo(this.model, 'change', this.render);
                        this.model.fetch({data: $.param({'id': userId})}, {
                            async: false,
                            success: function (data, statusText) {

                                console.log("success", statusText)
                            },
                            error: function (data, statusText) {
                            }
                        });
                        this.render();
                    },
                    render: function () {
                        $("#user_name").html(this.model.get('name'));
                        $("#user_email").html(this.model.get('email'));
                        $("#wishListCount").text(wishList.get('id') ? 1 : 0);
                        $("#wishItemCount").text(wishListItems.length);
                        $("#sharedListCount").text("testing");
                    }
                });

                let WishListView = Backbone.View.extend({
                    el: '#wishListView',
                    template: _.template($("#wishListTemplate").html()),
                    initialize: function () {
                        let self = this;
                        this.listenTo(this.model, 'change sync', this.render);
                        this.model.fetch({
                            async: false,
                            success: function (data, statusText) {
                                self.render();
                            },
                            error: function (data, statusText) {
                                self.render();
                            }
                        });
                    },
                    displayListDiv: function (){
                        $('.hasWishlist').show();
                        $("#hasNotWishList").hide();
                    },
                    displayNoListDiv: function (){
                        $('.hasNotWishList').show();
                        $('#hasWishlist').hide();
                    },
                    render: function () {
                        $("#wishListCount").text(wishList.get('id') ? 1 : 0);
                        $("#wishItemCount").text(wishListItems.length);
                        $("#sharedListCount").text("testing");
                        $(this.$el).html(this.template(this.model));
                        wishList.has('id') ? this.displayListDiv() : this.displayNoListDiv()
                        return this;
                    },
                    events: {
                        'click #editListBtn': 'editList',
                        // 'click #deleteListBtn': 'deleteList'
                    },
                    editList: function (item) {
                        let id = $(item.currentTarget).data('id');
                        updateList(id);

                    },
                    //deleteList: function (item) {
                    //    let self = this;
                    //    let id = $(item.currentTarget).data('id');
                    //    let modelToDelete = wishList;
                    //    if (modelToDelete) {
                    //        if (confirm('Are you sure to delete this wish list? It will be deleted all' +
                    //            ' the items & shared links on your wish list ')) {
                    //            modelToDelete.destroy({
                    //                async: false,
                    //                url: "<?php //echo base_url('index.php/api/wishlist/wishlist/id/');?>//" + id,
                    //                success: function (data, statusText) {
                    //                    wishList.clear(modelToDelete);
                    //                    self.render();
                    //                },
                    //                error: function (data, statusText) {
                    //                    alert(statusText.responseJSON.message);
                    //                }
                    //            });
                    //        }
                    //    }
                    //}
                });

                let WishItemView = Backbone.View.extend({
                    el: '#wishListView',
                    template: _.template($("#wishItemTemplate").html()),
                    initialize: function () {
                        let self = this;
                        this.listenTo(this.collection, 'change sync', this.render);
                        this.listenTo(this.collection, 'remove sync', this.render);
                        this.collection.fetch({
                            async: false,
                            success: function (data, statusText) {
                                self.render();
                            },
                            error: function (data, statusText) {
                                self.render();
                            }
                        });
                    },
                    render: function () {
                        $("#wishListCount").text(wishList.get('id') ? 1 : 0);
                        $("#wishItemCount").text(wishListItems.length);
                        $("#sharedListCount").text("testing");
                        $(this.$el).html(this.template(this.collection, wishList));
                        return this;
                    },
                    events: {
                        'click #editItemBtn': 'editItem',
                        'click #deleteItemBtn': 'deleteItem'
                    },
                    editItem: function (item) {
                        let id = $(item.currentTarget).data('id');
                        updateItem(id);
                    },
                    deleteItem: function (item) {
                        let self = this;
                        let id = $(item.currentTarget).data('id');
                        let modelToDelete = wishListItems.get(id);
                        if (modelToDelete) {
                            if (confirm('Are you sure to delete this item?')) {
                                modelToDelete.destroy({
                                    async: false,
                                    url: "<?php echo base_url('index.php/api/wishitem/item/id/');?>" + id,
                                    success: function (data, statusText) {
                                        wishListItems.remove(modelToDelete);
                                    },
                                    error: function (data, statusText) {
                                        alert(statusText.responseJSON.message);
                                    }
                                });
                            }
                        }
                    }
                });
                new ProfileView({model: user});
                //Router
                let Router = Backbone.Router.extend({
                    routes: {
                        "": "showWishListView",
                        "wishlist": "showWishItemView",
                        "profile": "showProfileView",
                        "shared-list": "showSharedView"
                    },
                    showWishListView: function () {
                        new WishListView({model: wishList});
                        console.log("createWishListView");
                    },
                    showWishItemView: function () {
                        new WishItemView({collection: wishListItems});
                        console.log("wishItemView");
                    },
                    showProfileView: function () {
                        new ProfileView({model: user});
                        console.log("profileView");
                    },
                    showSharedView: function () {
                        console.log("sharedView");
                    }
                });
                let router = new Router();
                Backbone.history.start();

                function updateItem(id) {
                    let modelToEdit = new Item();
                    modelToEdit = wishListItems.get(id);
                    $('#editItemModal').find('input[name="editTitle"]').val(modelToEdit.get('title'));
                    $('#editItemModal').find('input[name="editPrice"]').val(modelToEdit.get('price'));
                    $('#editItemModal').find('input[name="editQuantity"]').val(modelToEdit.get('qty'));
                    $('#editItemModal').find('input[name="editUrl"]').val(modelToEdit.get('url'));
                    $('#editItemModal').find('input[name="editImg_url"]').val(modelToEdit.get('imgUrl'));
                    $('#editPriorities').val(modelToEdit.get('pr_id'));
                    $('#editPriorities').data(modelToEdit.get('pr_name'));
                    $('#editPriorities').on('hidden.bs.modal', function (e) {
                    });

                    document.getElementById("updateItemBtn").onclick = function fun() {
                        let title = $("#editItemModal").find('input[name="editTitle"]').val();
                        let price = $("#editItemModal").find('input[name="editPrice"]').val();
                        let quantity = $("#editItemModal").find('input[name="editQuantity"]').val();
                        let url = $("#editItemModal").find('input[name="editUrl"]').val();
                        let img_url = $("#editItemModal").find('input[name="editImg_url"]').val();
                        let pr_id = $("#editPriorities option:selected").val();
                        let pr_name = $("#editPriorities option:selected").data('name');
                        let pr_level = $("#editPriorities option:selected").data('pr_level');

                        if (isEmpty(title) && isEmpty(price) && isEmpty(quantity) && isEmpty(url) && isEmpty(img_url)) {
                            modelToEdit.set({
                                "id": id,
                                "pr_id": pr_id,
                                "pr_name": pr_name,
                                "pr_level": pr_level,
                                "title": title,
                                "price": price,
                                "qty": quantity,
                                "url": url,
                                "img_url": img_url,
                            });
                            modelToEdit.save(null, {
                                async: false,
                                success: function (data, statusText) {
                                    wishListItems.add(modelToEdit);
                                    wishListItems.sort();
                                    $('#editItemModal').on('hidden.bs.modal', function (e) {
                                        $('#editItemModal').find('input[name="editTitle"]').val('');
                                        $('#editItemModal').find('input[name="editPrice"]').val('');
                                        $('#editItemModal').find('input[name="editQuantity"]').val('');
                                        $('#editItemModal').find('input[name="editUrl"]').val('');
                                        $('#editItemModal').find('input[name="editImg_url"]').val('');
                                    });
                                    $('#editItemModal').modal('hide');
                                },
                                error: function (data, statusText) {
                                    alert(statusText.responseJSON.message);
                                }
                            });
                        } else {
                            alert("You must fill out all fields.");
                        }
                    }
                }

                function updateList(id){
                    console.log(id);
                };

                document.getElementById("deleteListBtn").onclick = function fun() {
                    let modelToDelete = wishList;
                    let id = modelToDelete.get('id');
                    if (confirm('Are you sure to delete this wish list? It will be deleted all' +
                        ' the items & shared links on your wish list ')) {
                        modelToDelete.destroy({
                            async: false,
                            url: "<?php echo base_url('index.php/api/wishlist/wishlist/id/');?>" + id,
                            success: function (data, statusText) {
                                wishList.clear(modelToDelete);
                            },
                            error: function (data, statusText) {
                                alert(statusText.responseJSON.message);
                            }
                        });
                    }
                }

                document.getElementById("addItemBtn").onclick = function fun() {
                    let item = new Item();
                    let title = $("#myModal").find('input[name="title"]').val();
                    let price = $("#myModal").find('input[name="price"]').val();
                    let quantity = $("#myModal").find('input[name="quantity"]').val();
                    let url = $("#myModal").find('input[name="url"]').val();
                    let img_url = $("#myModal").find('input[name="img_url"]').val();
                    let pr_name = $("#priorities option:selected").data('name');
                    let pr_level = $("#priorities option:selected").data('pr_level');
                    let pr_id = $("#priorities option:selected").val();
                    if (isEmpty(title) && isEmpty(price) && isEmpty(quantity) && isEmpty(url)) {
                        item.set({
                            "pr_id": pr_id,
                            "pr_name": pr_name,
                            "pr_level": pr_level,
                            "title": title,
                            "price": price,
                            "qty": quantity,
                            "url": url,
                            "img_url": img_url,
                        })
                        item.save({}, {
                            async: false,
                            success: function (data, statusText) {
                                wishListItems.add(item);
                                wishListItems.sort();
                                $('#myModal').on('hidden.bs.modal', function (e) {
                                    $("#myModal").find('input[name="title"]').val('');
                                    $("#myModal").find('input[name="price"]').val('');
                                    $("#myModal").find('input[name="quantity"]').val('');
                                    $("#myModal").find('input[name="url"]').val('');
                                    $("#myModal").find('input[name="img_url"]').val('');
                                });
                                $('#myModal').modal('hide');
                            },
                            error: function (data, statusText) {
                                alert(statusText.responseJSON.message);
                            }
                        });
                    } else {
                        alert("You must fill out all fields.");
                    }
                }

                function signOut() {
                    let signOut = new SignOut();
                    signOut.save({}, {
                        async: false,
                        success: function (data, statusText) {
                            window.location = "<?php echo base_url('index.php/Login');?>"
                        },
                        error: function (data, statusText) {
                            alert(statusText.responseJSON.message);
                        }
                    });
                }

                function isEmpty(value) {
                    return !(value == null || value === '');
                }

            </script>
    </body>
</html>
