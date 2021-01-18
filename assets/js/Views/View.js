let ProfileView = Backbone.View.extend({
    el: '#wishListView',
    template: _.template($("#profileViewTemplate").html()),
    initialize: function () {
        let self = this;
        this.listenTo(this.model, 'change', this.render);
        this.model.fetch({data: $.param({'id': userId})}, {
            async: false,
            success: function (data, statusText) {
                self.render();
            },
            error: function (data, statusText) {
            }
        });
        self.render();
    },
    render: function () {
        $(this.$el).html(this.template(this.model));
        $("#wishListCount").text(wishList.get('id') ? 1 : 0);
        $("#wishItemCount").text(wishListItems.length);
        return this;
    }
});

let LeftView = Backbone.View.extend({
    el: '#profileView',
    template: _.template($("#leftViewTemplate").html()),
    initialize: function () {
        let self = this;
        this.listenTo(this.model, 'change sync', this.render);
        this.model.fetch({data: $.param({'id': userId})}, {
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
        $(this.$el).html(this.template(this.model));
        $("#wishListCount").text(wishList.get('id') ? 1 : 0);
        $("#wishItemCount").text(wishListItems.length);
        return this;
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
    destroy: function () {
        this.remove(); // removes view from  dom
        this.unbind();
    },
    displayListDiv: function () {
        $('.hasWishlist').show();
        $("#hasNotWishList").hide();
    },
    displayNoListDiv: function () {
        $('.hasNotWishList').show();
        $('#hasWishlist').hide();
    },
    render: function () {
        $("#wishListCount").text(wishList.get('id') ? 1 : 0);
        $("#wishItemCount").text(wishListItems.length);
        $(this.$el).html(this.template(this.model));
        wishList.has('id') ? this.displayListDiv() : this.displayNoListDiv()
        return this;
    },
    events: {
        'click #editListBtn': 'editList',
        'click #deleteListBtn': 'deleteList'
    },
    editList: function (item) {
        let id = $(item.currentTarget).data('id');
        updateList(id);
    },
    deleteList: function (item) {
        let id = $(item.currentTarget).data('id');
        deleteList(id);
    }
});

let WishItemView = Backbone.View.extend({
    el: '#wishListView',
    template: _.template($("#wishItemTemplate").html()),
    initialize: function () {
        let self = this;
        this.listenTo(this.collection, 'change remove reset sync', this.render);
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
    displayListDiv: function () {
        $('.wishListDiv').show();
        $(".noWishListDiv").hide();
    },
    displayNoListDiv: function () {
        $('.noWishListDiv').show();
        $('.wishListDiv').hide();
    },
    displayNoItemView: function () {
        $('.noItemView').show();
        $('.wishListItemView').hide();
    },
    displayItemView: function () {
        $('.wishListItemView').show();
        $('.noItemView').hide();
    },
    render: function () {
        $("#wishListCount").text(wishList.get('id') ? 1 : 0);
        $("#wishItemCount").text(wishListItems.length);
        $(this.$el).html(this.template(this.collection, wishList));
        wishList.has('id') ? this.displayListDiv() : this.displayNoListDiv()
        wishListItems.length === 0 ? this.displayNoItemView() : this.displayItemView()
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
        item.preventDefault();
        let id = $(item.currentTarget).data('id');
        deleteItem(id);
    }
});