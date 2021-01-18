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
        <nav class="navbar navbar-expand-lg header" id="myHeader">
            <h2>Wish List</h2>
        </nav>
    </head>
    <body>
        <div class="container body-container mb-4">
            <div class="row">
                <div class="col-lg-4 pb-5" id="profileView"></div>

                <!-- Wishlist-->
                <div class="col-lg-8 pb-5" id="wishListView"></div>
            </div>

            <!-- Add List Modal HTML -->
            <div id="addListModal" class="modal fade">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="avatar">
                                <img src="<?php echo base_url('assets/img/present-modal.png') ?>" alt="Avatar">
                            </div>
                            <h4 class="modal-title">Add List</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="occasion" placeholder="Occasion"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Description"
                                              id="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="list_img_url" placeholder="Image URL"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="button" id="addListBtn"
                                           class="btn btn-primary btn-lg btn-block"
                                           value="Add"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit List Modal HTML -->
            <div id="editListModal" class="modal fade">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="avatar">
                                <img src="<?php echo base_url('assets/img/present-modal.png') ?>" alt="Avatar">
                            </div>
                            <h4 class="modal-title">Update List</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="edit_name" placeholder="Name"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="edit_occasion" placeholder="Occasion"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Description"
                                              id="edit_description"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="edit_list_img_url"
                                           placeholder="Image URL"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <input type="button" id="updateListBtn"
                                           class="btn btn-primary btn-lg btn-block"
                                           value="Update"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                            <button type="button" class="close" data-dismiss="modal"
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
                                    <input type="text" class="form-control" name="editImg_url"
                                           placeholder="Image URL"
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

            <!-- Share list modal-->
            <div class="modal fade" id="shareListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content col-12">
                        <div class="modal-header">
                            <h5 class="modal-title">Share</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 icon-container2 d-flex text-center">
                                    <div class="form-group text-center" style="margin-top: 20%;">
                                        <select class="selectpicker form-control" id="shareLinkAccess"
                                                data-live-search="true">
                                            <option value="yes" data-name="Public">
                                                Public
                                            </option>
                                            <option value="no" data-name="Private">
                                                Private
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 icon-container2 d-flex">
                                    <div type="button" onclick="" class="smd"><i
                                                class="img-thumbnail fab fa-whatsapp fa-2x"
                                                style="color: #25D366;background-color: #cef5dc;"></i>
                                        <p>Whatsapp</p>
                                    </div>
                                    <div type="button" onclick="" class="smd"><i
                                                class="img-thumbnail far fa-envelope fa-2x"
                                                style="color:#4c6ef5;background-color: aliceblue"></i>
                                        <p>E-mail</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer share-modal-footer"><label style="font-weight: 600">Wish List Link
                                <span class="message"></span></label><br/>
                            <div class="row text-center">
                                <input class="col-10 ur" type="url" name="shareLinkUrl"
                                       value="" id="shareLinkUrl"
                                       aria-describedby="inputGroup-sizing-default" style="height: 40px;">
                                <button class="cpy" onclick="copyToClipboard()"><i class="far fa-clone"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- confirmation modal delete item-->
            <div id="confirm-modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                            <p id="confirmMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- confirmation modal Delete List-->
            <div id="confirm-modal-delete-list" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                            <p id="confirmMessage">Are you sure to delete this wish list? It will be deleted all
                                the items & shared links on your wish list.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmDeleteListBtn" class="btn btn-danger">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer text-center">
            &copy;
            2020
            <span>Wishlist.com</span>
        </div>
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/underscore-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

        <script id="leftViewTemplate" type="text/html">
            <div class="author-card pb-3">
                <div class="author-card-cover"
                     style="background-image: url(<?php echo base_url('assets/img/cover.jpg') ?>);"><a
                            class="btn btn-style-1 btn-white btn-sm" href="#" data-toggle="tooltip" title="">
                    </a>
                </div>
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img
                                src="<?php echo base_url('assets/img/profile-pic-1.png') ?>" alt="Daniel Adams">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg" id="user_name"><%= this.model.get('name')%></h5>
                        <span
                                class="author-card-position"
                                id="user_email"><%= this.model.get('email')%></span>
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
                    <a class="list-group-item" href="#" onclick="signOut(); return false;">
                        <i class="fas fa-sign-out-alt fa-rotate-180 text-muted"></i>
                        SignOut
                    </a>
                </nav>
            </div>
        </script>

        <script id="wishListTemplate" type="text/html">
            <div>
                <h3 class="text-center">MY WISH LIST</h3>
            </div>
            <div class="hasNotWishList" id="hasNotWishList">
                <div class="text-center" style="margin-bottom: 2%; margin-top: 2%">
                    <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#addListModal">
                        <i class="fas fa-plus"></i> Add Item
                    </button>
                </div>
                <div class="cart-item" style="min-height: 308px">
                    <p class="text-center">No Wish List has been created yet</p>
                </div>
            </div>
            <div id="hasWishlist" class="hasWishlist">
                <div class="cart-item d-md-flex justify-content-between">
                    <div class="px-3 my-3">
                        <a class="item-item-product" href="#wishlist">
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
                                    class="btn btn-default"
                                    data-toggle="modal"
                                    data-target="#confirm-modal-delete-list">
                                <i class="fas fa-trash-alt fa-lg"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </script>

        <script id="wishItemTemplate" type="text/html">
            <div class="wishListDiv">
                <div>
                    <h3 class="text-center"><%= wishList.get('name') %> (<%= wishList.get('occasion') %>)</h3>
                </div>
                <div class="row " style="margin-bottom: 2%; margin-top: 2%">
                    <div class="col-md-10 text-center">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#myModal" style="margin-left: 27%;">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
                    </div>
                    <div class='col-md-2 container d-flex justify-content-center mt-100'>
                        <button type="button" id="shareLinkBtn" class="btn btn-primary mx-auto" data-toggle="modal"
                                data-target="#shareListModal">
                            <i class="fas fa-share"></i> Share
                        </button>
                    </div>
                </div>
                <% if(models.length === 0){%>
                <div class="noItemView">
                    <div class="cart-item" style="min-height: 308px">
                        <p class="text-center">No items Found</p>
                    </div>
                </div>
                <div class="wishListItemView">
                    <% } _.each(models, function(item) { %>
                    <div id="<%= item.get('id') %>">
                        <div class="cart-item d-md-flex justify-content-between">
                            <div class="px-3 my-3">
                                <a target="_blank" class="item-item-product" href="<%= item.get('url') %>">
                                    <div class="cart-item-product-thumb">
                                        <img id="itemImg" src="<%= item.get('img_url') %>" alt="Product">
                                    </div>
                                    <div class="cart-item-product-info">
                                        <h4 class="cart-item-product-title" id="itemTitle"><%= item.get('title')
                                            %></h4>
                                        <div class="text-lg text-body font-weight-medium pb-1">$ <%=
                                            item.get('price')
                                            %>
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
                                            data-toggle="modal"
                                            data-target="#confirm-modal"
                                            class="btn btn-default"><i class="fas fa-trash-alt fa-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <% }); %>
                </div>
            </div>
            <div class="noWishListDiv">
                <p class="text-center" style="margin-top: 25%"> No wish list has been created yet. Please try
                    creating a
                    wish list.</p>
            </div>
        </script>
        <script type="text/html" id="profileViewTemplate">
            <div class="profile-card">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><%= user.get('name') %></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Address:</td>
                                            <td><%= user.get('address') %></td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td><%= user.get('email') %></td>
                                        </tr>
                                        <tr>
                                            <td>Tel:</td>
                                            <td><%= user.get('tel') %></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </script>
        <script src="<?php echo base_url(); ?>assets/js/config.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/Models/Model.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/Collections/Collection.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/Views/View.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/wishlist.js"></script>
        <script type="text/javascript">
            let userId = <?php echo $this->session->userdata('userId');?>;

            let user = new User();
            let wishList = new WishList();
            let wishListItems = new WishItemCollection();
            let priorities = new Priorities();
            let shareLink = new ShareLink();

            user.fetch({data: $.param({'id': userId})}, {async: false});
            wishList.fetch({async: false});
            wishListItems.fetch({async: false});
            priorities.fetch({async: false});
            shareLink.fetch({async: false});

            let leftView = new LeftView({model: user});
            //Router
            let Router = Backbone.Router.extend({
                routes: {
                    "": "showWishListView",
                    "wishlist": "showWishItemView",
                    "profile": "showProfileView"
                },
                showWishListView: function () {
                    new WishListView({model: wishList});
                },
                showWishItemView: function () {
                    new WishItemView({collection: wishListItems});
                    shareLink.fetch({async: false});
                    document.getElementById("shareLinkBtn").onclick = function fun() {
                        let shareLinkItem = new ShareLink();
                        if (!shareLink.has('id')) {
                            shareLinkItem.set({
                                'w_id': wishList.get('id'),
                                'is_shared': 'yes'
                            });
                            shareLinkItem.save({}, {
                                async: false,
                                success: function (data, statusText) {
                                    shareLink.set({
                                        "id": statusText.id,
                                        "u_id": statusText.u_id,
                                        "w_id": statusText.w_id,
                                        "url": statusText.url,
                                        "is_shared": statusText.is_shared,
                                        "created_at": statusText.created_at,
                                        "updated_at": statusText.updated_at,
                                    })
                                    $('#shareLinkAccess ').val(shareLink.get('is_shared')).prop('selected', true);
                                    $('#shareListModal').find('input[name="shareLinkUrl"]').val(shareLink.get('url'));
                                }, error: function (data, statusText) {
                                    alert(statusText.responseJSON.message);
                                }
                            });
                        } else {
                            $('#shareLinkAccess ').val(shareLink.get('is_shared')).prop('selected', true);
                            $('#shareListModal').find('input[name="shareLinkUrl"]').val(shareLink.get('url'));
                        }
                    }
                },
                showProfileView: function () {
                    new ProfileView({model: user});
                }
            });
            let router = new Router();
            Backbone.history.start();
        </script>
    </body>
</html>