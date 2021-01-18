
let WishList = Backbone.Model.extend({
    url: url + 'index.php/api/wishList/wishlist',
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

let Item = Backbone.Model.extend({
    url: url + 'index.php/api/wishItem/item',
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

let User = Backbone.Model.extend({
    url: url + 'index.php/api/users/user',
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

let ShareLink = Backbone.Model.extend({
    idAttribute: 'id',
    url: url + 'index.php/api/shareLink/link',
    defaults: {
        "id": null,
        "u_id": "",
        "w_id": "",
        "url": "",
        "is_shared": "",
        "created_at": "",
        "updated_at": ""
    }
});

let SignOut = Backbone.Model.extend({
    url: url + 'index.php/api/authentication/logout'
});