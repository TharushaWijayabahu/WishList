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
        <div class="container body-container">
            <div id="wishListView"></div>
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
        <script id="wishItemTemplate" type="text/html">
            <% if(list.get('name') === null || list.get('name') === ""){%>
            <p class="text-center" style="margin-top: 25%"> Link might be private.
                Please contact owner of the list.</p>
            <% }else{%>
            <div>
                <h3 class="text-center">
                    <%= list.get('name') %> (<%= list.get('occasion') %>)
                </h3>
            </div>
            <div>
                <p class="text-center"> <%= list.get('description') %></p>
            </div>
            <% if(models.length === 0){%>
            <div class="noItemView">
                <div class="cart-item" style="min-height: 308px">
                    <p class="text-center">No items Found</p>
                </div>
            </div>
            <div class="wishListItemView">
                <% } _.each(models, function(item) { %>
                <a target="_blank" class="item-item-product" href="<%= item.get('url') %>">
                    <div id="<%= item.get('id') %>">
                        <div class="cart-item d-md-flex justify-content-between">
                            <div class="px-3 my-3">
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
                            </div>
                        </div>
                    </div>
                </a>
                <% }); %>
            </div>
            <% } %>
        </script>
        <script type="text/javascript">
            let url = window.location.href;
            let id = url.substring(url.lastIndexOf('/') + 1);
            let Item = Backbone.Model.extend({
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
                    "pr_level": ""
                }
            });
            // Creating backbone collection for wishlist item
            let WishItemCollection = Backbone.Collection.extend({
                url: "<?php echo base_url('index.php/api/sharelistpublic/list');?>?id=" + id,
                idAttribute: 'id',
                model: Item,
                comparator: function (item) {
                    return item.get("pr_level");
                }
            });

            let User = Backbone.Model.extend({
                url: "<?php echo base_url('index.php/api/sharelistpublic/user');?>?id=" + id,
                idAttribute: 'id',
                defaults: {
                    "name": ""
                }
            });

            let List = Backbone.Model.extend({
                url: "<?php echo base_url('index.php/api/sharelistpublic/wishlist');?>?id=" + id,
                idAttribute: 'id',
                defaults: {
                    "name": "",
                    "occasion": "",
                    "description": ""
                }
            });

            let wishListItems = new WishItemCollection();
            let user = new User();
            let list = new List();

            let WishItemView = Backbone.View.extend({
                el: '#wishListView',
                template: _.template($("#wishItemTemplate").html()),
                initialize: function () {
                    let self = this;
                    this.listenTo(this.collection, 'change sync', this.render);
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
                    $(this.$el).html(this.template(this.collection));
                    return this;
                }
            });
            let Router = Backbone.Router.extend({
                routes: {
                    "": "showWishListView",
                },
                showWishListView: function () {
                    list.fetch({async: false});
                    user.fetch({async: false});
                    new WishItemView({collection: wishListItems});
                }
            });
            let router = new Router();
            Backbone.history.start();
        </script>
    </body>
</html>