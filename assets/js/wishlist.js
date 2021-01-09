//            Creating backbone model for Item
let Item = Backbone.Model.extend({
    url: "<?php echo base_url('index.php/api/wishlist/item');?>",
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
let ItemCollection = Backbone.Collection.extend({
    url: "<?php echo base_url('index.php/api/wishlist/item');?>",
    model: Item,
});

let data = [{
    "id": 1,
    "title": "Apple iPhone X 256 GB Space Gray",
    "priority": "Must Have",
    "price": 1450.00,
    "qty": 2,
    "url": "#",
    "imgUrl": "assets/img/present.jpg"
}, {
    "id": 2,
    "title": "Apple iPhone X 256 GB Space Gray",
    "priority": "Must Have",
    "price": 1450.00,
    "qty": 2,
    "url": "#",
    "imgUrl": "assets/img/present.jpg"
}];
//            Creating backbone model for WishList
let WishList = Backbone.Model.extend({
    url: "<?php echo base_url('index.php/api/wishlist/wishlist');?>",
    defaults: {
        "name": "",
        "occasion": "",
        "description": ""
    }
});
//            Creating backbone model for SharedLink
let SharedLink = Backbone.Model.extend({
    url: "<?php echo base_url('index.php/api/wishlist/sharelink');?>",
    defaults: {
        "isShared": false
    }
});
//            Creating backbone model for Logout
let Logout = Backbone.Model.extend({
    url: "<?php echo base_url('ndex.php/api/authentication/logout');?>",
    defaults: {
        "isLogin": true
    }
});

//    Views
let WishListView = Backbone.View.extend({
    el: '#wishListView',
    template: _.template($("#wishListTemplate").html()),
    initialize: function () {
        // this.listenTo(this.model, 'sync', this.render);
        // this.model.fetch();
        this.render();
    },
    render: function () {
        // let template = _.template($("#wishListTemplate").html())
        // let html = template(this.Model.toJSON());
        // this.$el.html(html);
        // return this;
        return this.$el.html(this.template(new ItemCollection(data)));
        // let stuff = 'Hi';
        // this.$el.html(stuff);
        //$("#itemImg").attr("src", "<?php //echo base_url('assets/img/present.jpg')?>//");
        // this.model.each(function (item) {
        //
        // });
        // $('#userData').html(stuff);
    },
    events: {
        // 'click #addItem': 'addItem',
        // 'click #editItem': 'editItem',
        // 'click #deleteItem': 'deleteItem'
    },
    // addItem: function () {
    //     alert('Do addItem');
    // },
    // editItem: function () {
    //     alert('Do Change');
    // },
    // deleteItem: function () {
    //     alert('Do Delete');
    // }
});

//Router
let Router = Backbone.Router.extend({
    routes: {
        "": "wishItemView",
        "profile": "profileView",
        "shared-list": "sharedView"
    },
    wishItemView: function () {
        new WishListView();
        console.log("wishItemView");
    },
    profileView: function () {
        console.log("profileView");
    },
    sharedView: function () {
        console.log("sharedView");
    }
});

let router = new Router();
Backbone.history.start();